<?php
namespace QCode;
use QCode\Finder\ClassesFinder;
use QCode\Finder\Finder;
use QCode\Render\Render;
use QCode\Finder\MethodsFinder;
use QCode\Finder\PropertiesFinder;
use QCode\Finder\ClassFinder;
use PhpParser\ParserFactory;
use PhpParser\Parser;
/**
 * Hello man!
 * 
 * 
 */
final class DocumentGenerator
{
    private Finder $finder; 
    private Parser $parser; 
    private Render $render; 
    private string $inDir;

    public function __construct($inDir)
    {
        $this->finder = new Finder();
        $this->render = new Render();
        $this->parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);

        $this->inDir = $inDir;
    }

    /**
     * Undocumented function
     *
     * @param [type] $toDir
     * @return void
     */
    public function generate($toDir)
    {
        $files = $this->getFiles($this->inDir);
        //Add search objects
        $this->finder->addFinder(new ClassFinder())
            ->addFinder(new PropertiesFinder())
            ->addFinder(new MethodsFinder())
            ->addFinder(new ClassesFinder());

        $result = [];
        $mdText = "";
        echo "<pre>";
        foreach ($files as $file) {
            try {
                $code = file_get_contents($file->getPathName());            
                $stmts = $this->parser->parse($code);
                $this->finder->setPathFile($file->getPathName());
                $result = $this->finder->search($stmts);
                $mdText = $this->render->render($result)
                    ->getText();
                $this->render->reset();
                $dirPath = __DIR__ . "/Test/" . str_replace([$this->inDir, "\\"], "", $file->getPath());
                var_dump($dirPath . "/" . $file->getBasename('.php') . ".md");
                if (!is_dir($dirPath)) {
                    mkdir($dirPath, 0777, true);
                }
                file_put_contents(
                    $dirPath . "/" . $file->getBasename('.php') . ".md",
                    $mdText
                );
                $mdText = ""; 
            } catch (\Excepiton $e) {

            }
        }
        echo "</pre>";
    }

    private function getFiles($inDir): \RegexIterator
    {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($inDir));
        $files = new \RegexIterator($files, '/\.php$/');

        return $files;
    }
}