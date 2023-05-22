# abstract class AbstractFinder implements IFinder
## Properties
- protected string $nodeName = "";- private NodeFinder $finder;- protected string $element;
## Methods
- public function __construct()- public function getFinder() : NodeFinder- public function search($stmts) : array- protected function prepareNode(string $value)- public function prepareNodes(array $nodes) : array
## Dependencies
- new NodeFinder()- new Standard()
