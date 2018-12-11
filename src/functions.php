<?php

function seq()
{
    $i = 0;
    while ($a = func_get_arg($i++)) {
        yield $a;
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

function url($u)
{
    return str_replace('%2F','/',urlencode($u));
}
