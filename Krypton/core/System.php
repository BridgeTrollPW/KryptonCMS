<?php
namespace Krypton\core;

class System
{
    public static function getDefaultPage(): int
    {
        $sql = 'SELECT ? FROM ?';
        return (int)Database::getInstance()->query($sql, [SYS_DEFAULTPAGE,TABLE_SYSTEM])->fetchSingleColumn();
    }
}
