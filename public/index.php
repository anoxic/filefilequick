<?php
require "../src/functions.php";

$dir = getenv('FILE_DIR');
$prefix = getenv('PREFIX');
$uri = $_SERVER['REQUEST_URI'];

list($route, $target) = dispatch(seq('/c','/d'), $uri, $prefix);

switch ($route) {
case "/d":
case "/c":
    echo "$route to be implemented";
    break;
default:
    require "../src/handlers/list.php";
}
