<?php

function autoload($class)
{
    $file = str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) {
        include_once($file);

        return true;
    } else {
        return false;
    }
}
spl_autoload_register('autoload');