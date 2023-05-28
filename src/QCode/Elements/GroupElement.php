<?php 
namespace QCode\Elements;

final class GroupElement extends Element
{
    protected string $viewName = "Group.md";

    public function render(): string
    {
        $content = parent::render();
        
        if ($this->isEmpty) {
            $content = "";
        }

        return $content;
    }
}