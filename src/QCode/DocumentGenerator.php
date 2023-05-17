<?php

require_once 'vendor\autoload.php';

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
        $this->finder->addFinder(new PropertiesFinder());
        $this->finder->addFinder(new ClassesFinder());
        $this->finder->addFinder(new MethodsFinder());

        foreach ($files as $file) {
            $code = file_get_contents($file->getPathName());
            $stmts = $this->parser->parse($code);

            $result = $this->finder->search($stmts);
        }

        return $result;
    }

    private function getFiles($inDir): \RegexIterator
    {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($inDir));
        $files = new \RegexIterator($files, '/\.php$/');

        return $files;
    }
}