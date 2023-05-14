<?php 
namespace Qcode\Finder\Contracts;
interface IFinder 
{
    /**
     * @param PHPParser\Node|PHPParser\Node[] $stmts
     * @return array
     */
    public function search($stmts) : array
}