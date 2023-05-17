<?php

namespace QCode\Finder;

class Finder extends AbstractFinder
{
    private array $elements = [];

    public function search($stmts): array
    {
        $result = [];

        foreach ($this->elements as $element)
        {
            $result[] = $element->search($stmts);
        }

        return $result;
    }

    public function addFinder(IFinder $finder): void
    {
        $this->elements[] = $finder;
    }
}