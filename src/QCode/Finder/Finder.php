<?php

namespace QCode\Finder;

class Finder extends AbstractFinder
{
    private array $elements = [];

    public function search($stmts, $groupLine = null): array
    {
        $result = [];

        foreach ($this->elements as $element)
        {
            $result[] = $element->search($stmts, null);
        }

        return $result;
    }

    public function addFinder(IFinder $finder): Finder
    {
        $this->elements[] = $finder;

        return $this;
    }
}