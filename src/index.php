<?php

require_once '../vendor/autoload.php';
spl_autoload_register(function ($class) {
    include "$class.php";
});
use QCode\DocumentGenerator;

$dg = new DocumentGenerator("C:/Web/www/qcode/src/QCode");
$dg->generate("C:/Web/www/qcode/public");