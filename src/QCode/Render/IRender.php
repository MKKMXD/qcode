<?php 

namespace QCode\Render;

interface IRender
{
    public function render(array $list): Render;
}