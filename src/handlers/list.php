<?php

$target = urldecode($target);
$is_dir = is_dir("$dir$target/");

if ($target && !$is_dir) {
    echo "not able to display file <i>$target</i><br>";
    echo "<a href=.>back</a>";
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
