<?php 

namespace QCode\Finder;

interface IFinder
{
    /**
     * @param PHPParser\Node|PHPParser\Node[] $stmts
     * @return array
     */
    public function search($stmts, $groupLine = null): array;

    public function collectNodes(array $elements, array $findDepedencies = []): array;
}