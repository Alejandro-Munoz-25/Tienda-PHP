<?php

function controllers_autoload($class)
{
    //    include "clases/" . $class . '.php';
    require_once "controllers/" . $class . '.php';
}

spl_autoload_register('controllers_autoload');
