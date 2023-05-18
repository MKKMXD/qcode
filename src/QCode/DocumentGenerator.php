<?php
namespace QCode;
use QCode\Finder\ClassesFinder;
use QCode\Finder\Finder;
use QCode\Render\Render;
use QCode\Finder\MethodsFinder;
use QCode\Finder\PropertiesFinder;
use PhpParser\ParserFactory;
use PhpParser\Parser;

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

    public function generate($toDir)
    {
        $files = $this->getFiles($this->inDir);
        //Add search objects
        $this->finder->addFinder(new PropertiesFinder())
            ->addFinder(new ClassesFinder())
            ->addFinder(new MethodsFinder());

        $result = [];
        $mdText = "";
        foreach ($files as $file) {
            $code = file_get_contents($file->getPathName());            
            $stmts = $this->parser->parse($code);
            
            echo '<pre>';
            var_dump($stmts);
            echo '</pre>';
            $result = $this->finder->search($stmts);
            $mdText .= $this->render->render($result)
            ->getText();
        }

         
        file_put_contents(
            __DIR__ . "/Test/result.md",
            $mdText
        );
    }

    private function getFiles($inDir): \RegexIterator
    {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($inDir));
        $files = new \RegexIterator($files, '/\.php$/');

        return $files;
    }
}