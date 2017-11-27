<?php
namespace Krypton;

use Krypton\apps\Core_Errors;

require_once 'Autoloader.php';

new Autoloader();

/*
set_error_handler(function ($errorNumber, $errorMessage, $errorFile, $errorLine) {
    ob_start();
    throw new \ErrorException($errorMessage, 0, $errorNumber, $errorFile, $errorLine);
    new Core_Errors($errorNumber, $errorMessage, $errorFile, $errorLine);
    ob_end_clean();
});

set_exception_handler(function ($exception) {
    ob_start();
    new Core_Errors("", $exception->getMessage(), "", "");
    ob_end_clean();
});
*/
