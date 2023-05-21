# final class DocumentGenerator
## Properties
- private Finder $finder;- private Parser $parser;- private Render $render;- private string $inDir;- private float $rr = 15.5;
## Methods
- public function __construct($inDir)- public function generate($toDir)- private function getFiles($inDir) : \RegexIterator
## Dependencies
- new Finder()- new Render()- new ParserFactory()- new ClassFinder()- new PropertiesFinder()- new MethodsFinder()- new ClassesFinder()- new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($inDir))- new \RecursiveDirectoryIterator($inDir)- new \RegexIterator($files, '/\\.php$/')
