<?php

require_once '../vendor/autoload.php';
spl_autoload_register(function ($class) {
    include "$class.php";
});
use QCode\DocumentGenerator;
define("WORK_DIR", "C:/OSPanel/domains/Qcode/src/QCode");
$dg = new DocumentGenerator("C:/OSPanel/domains/Qcode/src/QCode");
$dg->generate("C:/OSPanel/domains/Qcode/src/QCode/Test");