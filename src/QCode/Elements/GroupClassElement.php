<?php 
namespace QCode\Elements;

final class GroupClassElement extends Element
{
    protected string $viewName = "Group.md";

    public function render(): string
    {
        $content = parent::render();
        $content = str_replace("{group_name}", "Dependencies", $content);

        return $content;
    }
}