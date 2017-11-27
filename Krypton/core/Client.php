<?php
namespace Krypton\core;

require_once 'Krypton.cfg.php';

use ErrorException;

class Client
{
    private static $instance;
    private $groups;
    private function __construct()
    {
    }

    public static function getInstance():Client
    {
        if (!isset(static::$instance)) {
            static::$instance = new self();
            // @IDEA how to login? Set the client id in the session

            if (session_status() !== PHP_SESSION_NONE) {
                if (isset($_SESSION[CLIENT_ID]) && $_SESSION[CLIENT_ID] !== '-1') {
                    //Session is active, we can try and get our user
                    // @IDEA might not be ideally secure
                    $sql = 'SELECT groups FROM '.TABLE_CLIENTS.' WHERE '.TABLEKEY_ID.'=?';
                    $result = Database::getInstance()->query($sql, [$_SESSION[CLIENT_ID]])->fetchArray();
                    static::$instance->groups = $result[TABLEKEY_GROUPS];
                } else {
                    $_SESSION[CLIENT_ID] = '-1';
                    static::$instance->groups = '[-1]';
                }
            } else {
                throw new ErrorException('No session found');
            }

            return static::$instance;
        } else {
            return static::$instance;
        }
    }
    public function access(string $permissions)
    {
        $client_permissions = json_decode($this->groups, true);
        $object_permissions = json_decode($permissions, true);
    }
}
