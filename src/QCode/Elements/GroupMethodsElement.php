<?php 
namespace QCode\Elements;

final class GroupMethodsElement extends Element
{
    protected string $viewName = "Group.md";

    public function render(): string
    {
        $content = parent::render();
        $content = str_replace("{group_name}", "Methods", $content);

        return $content;
    }
}