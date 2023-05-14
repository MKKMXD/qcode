<?php 

namespace QCode\Finder;

use Qcode\Finder\Contracts\IFinder;

final class ClassesFinder implements IFinder
{
    public function search($stmts): array
    {
        return [];
    }
}