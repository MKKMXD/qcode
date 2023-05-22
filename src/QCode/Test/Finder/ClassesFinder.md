# final class ClassesFinder extends AbstractFinder
## Properties
- protected string $nodeName = \PhpParser\Node\Expr\New_::class;- protected string $element = \QCode\Elements\GroupClassElement::class;
## Methods
- protected function prepareNode(string $value)- public function prepareNodes(array $nodes) : array
## Dependencies
- new ClassDependencyElement([$value])- new GroupClassElement($nodes)
