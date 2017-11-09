<?php
namespace Krypton\apps;

use Krypton\core\Query;
use Krypton\core\Database;

class Core_Errors
{
    public function __construct($errorNumber, $errorMessage, $errorFile, $errorLine)
    {
        $sql = (string)Query::T('errors')->insert(['code'=> '?', 'text' => '?', 'file' => '?', 'line' => (int)$errorLine]);
        Database::getInstance()->query($sql, [$errorNumber,$errorMessage,$errorFile])->exec();
    }
}
