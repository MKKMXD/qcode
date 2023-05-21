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

final class DocumentGenerator
{
    private Finder $finder; 
    private Parser $parser; 
    private Render $render; 
    private string $inDir;
    private float $rr = 15.5;

    public function __construct($inDir)
    {
        $this->finder = new Finder();
        $this->render = new Render();
        $this->parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);

        $this->inDir = $inDir;
    }

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
        foreach ($files as $file) {
            $code = file_get_contents($file->getPathName());            
            $stmts = $this->parser->parse($code);
            $result = $this->finder->search($stmts);
            $mdText = $this->render->render($result)
                ->getText();
            $this->render->reset();
            file_put_contents(
                __DIR__ . "/Test/" . str_replace("php", "md", $file->getBasename()),
                $mdText
            );
            $mdText = "";
        }
        /*file_put_contents(
                __DIR__ . "/Test/result.md",
                $mdText
            );*/
        /*file_put_contents(
            __DIR__ . "/Test/" . str_replace("/", "_", $file->getPathName(),
            $mdText
        );*/
    }

    private function getFiles($inDir): \RegexIterator
    {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($inDir));
        $files = new \RegexIterator($files, '/\.php$/');

        return $files;
    }
}