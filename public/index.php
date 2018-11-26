<?php
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
    $is_dir = is_dir("$dir$target/");
    if ($target && !$is_dir) {
        echo "not able to display file <address>$target</address>";
        echo "<a href=../" . dirname($target) . "/>..</a>";
        break;
    }
    if ($target && $is_dir) {
        $dir = "$dir$target/";
        echo "<img src={$prefix}dir.gif width=18> ";
        echo "<a href=../>..</a><br>\n";
    }
    $files = glob("$dir*");
    foreach ($files as $f) {
        $filesize = floor(filesize($f)/1024);
        $icon = $prefix . (is_dir($f) ? 'dir.gif' : 'file.gif');
        if (is_dir($f)) $f .= "/";
        $f = substr($f,strlen($dir));
        echo "<img src=$icon width=18> ";
        echo "<a href=$f title={$filesize}kb>$f</a><br>\n";
    }
}


function dispatch($routes, $uri, $prefix)
{
    foreach ($routes as $r) {
        if (fnmatch("$prefix*$r", $uri)) break;
        $r = false;
    }
    return [$r, substr($uri, strlen($prefix),
        $routes->valid() ? -strlen($r) : strlen($uri))];
}

function seq()
{
    $i = 0;
    while ($a = func_get_arg($i++)) {
        yield $a;
    }
}
