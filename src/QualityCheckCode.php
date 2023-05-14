<?php

namespace QCode;

require_once 'vendor\autoload.php';

use PhpParser\Error;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;
use PhpParser\PrettyPrinter\Standard;
use PhpParser\NodeFinder;

final class QualityCheckCode
{
    private NodeFinder $nodeFinder;
    private Standard $prettyPrinter;
    private Parser $parser;

    private string $inDir;

    public function __construct()
    {
        $this->inDir = "";
        $this->parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $this->prettyPrinter = new PrettyPrinter\Standard;
        $this->nodeFinder = new NodeFinder();
        
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->inDir));
        $files = new \RegexIterator($files, '/\.php$/');
    } 
}