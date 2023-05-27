<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\ClassNameElement;
use QCode\Elements\CommitsElement;
use QCode\Elements\GroupElement;

final class ClassFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Stmt\Class_::class;

    protected function prepareNode($value)
    {
        $value = parent::prepareNode($value);
        $value['content'] = str_replace(array("{", "}", "\n"), "", $value['content']);
        $cmd = "cd " . WORK_DIR . " && \"C:\Program Files\Git\bin\git\" log --pretty=oneline --abbrev-commit " . $this->pathFile;
        $output = [];
        exec($cmd, $output, $code);
        $contentCommit = [];
        for ($i = 0; $i < count($output); $i++) {
            $contentCommit[] = new CommitsElement(['content' => $output[$i]]);
        }
        $value['commits'] = new GroupElement([
            'title' => "Description by commits",
            'content' => $contentCommit,
        ]);
        return new ClassNameElement($value);
    }
}