<?php
function __autoload($className) {
    $filename = __DIR__.'/api/'.$className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}