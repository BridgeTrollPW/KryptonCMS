<?php
namespace Krypton;

class Autoloader
{
    public function __construct()
    {
        spl_autoload_register(array(
                $this,
                'load_class'
        ));
    }
    public function load_class($Class)
    {
        $Class = str_replace(__NAMESPACE__ . '\\', '', $Class);
        $Class = str_replace(array(
                '\\',
                '/'
        ), DIRECTORY_SEPARATOR, __DIR__ . DIRECTORY_SEPARATOR . $Class . '.php');
        if (false === ($Class = realpath($Class))) {
            return false;
        } else {
            require_once($Class);
            return true;
        }
    }
}
