# abstract class Element
## Properties
- protected array $fields = [];- protected array $values = [];- protected string $viewName = "";- protected Render $render;
## Methods
- public function __construct(array $values)- public function render() : string- protected function prepareElementRender(string $content)- public function setValue(array $values)
## Dependencies
- new Render()
