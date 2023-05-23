<?php 
namespace QCode\Elements;

final class GroupElement extends Element
{
    protected string $viewName = "GroupUntitle.md";

    public function render(): string
    {
        $content = parent::render();

        return $content;
    }
}