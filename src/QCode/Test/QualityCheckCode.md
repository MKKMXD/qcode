# final class QualityCheckCode
## Properties
- private NodeFinder $nodeFinder;- private Standard $prettyPrinter;- private Parser $parser;- private string $inDir;
## Methods
- public function __construct()
## Dependencies
- new ParserFactory()- new PrettyPrinter\Standard()- new NodeFinder()- new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->inDir))- new \RecursiveDirectoryIterator($this->inDir)- new \RegexIterator($files, '/\\.php$/')
