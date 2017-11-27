<?php
namespace Krypton\core;

require_once 'Database.cfg.php';
final class Database
{
    /**
     * Class instance in static memory
     *
     * @var Database
     */
    private static $instance;
    /**
     * Internal PDO connection to the database
     *
     * @var \PDO
     */
    private $PDOHandle;

    /**
     * Holds the current query that will be send to the database
     *
     * @var string
     */
    private $queryString;

    /**
     * All values that will replace ? or :token in the sql statement
     *
     * @var array
     */
    private $escapeStrings = null;
    /**
     * Disable the constructor, singleton class
     */
    private function __construct()
    {
    }

    /**
     * Static constructor, this class can only be constructed once
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if (! isset(static::$instance)) {
            static::$instance = new self();
            $dsn = 'mysql:dbname=' . database . ';host=' . host . ';port=' . port;
            try {
                static::$instance->PDOHandle = new \PDO($dsn, user, password);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
            return static::$instance;
        } else {
            return static::$instance;
        }
        throw new \ErrorException('Singleton class cannot be instanciated more than once.');
    }
    /**
     *
     * @param string $query
     * @param array $escapeStrings = null
     * @throws \PDOException
     * @return \Krypton\core\Database
     */
    public function query(string $query, array $escapeStrings = null)
    {
        if (isset($escapeStrings) && ! empty($escapeStrings)) {
            $this->escapeStrings = $escapeStrings;
        }

        if ($this->queryString = $this->PDOHandle->prepare($query)) {
            return $this;
        } else {
            throw new \PDOException(print_r($this->dbHND->errorInfo(), true));
            return null;
        }
    }
    /**
     * executes the current query
     *
     * @return string
     */
    public function exec()
    {
        if (isset($this->escapeStrings)) {
            $this->queryString->execute($this->escapeStrings);
        } else {
            $this->queryString->execute();
        }
        return $this->queryString;
    }
    /**
     *
     * @param string $optional
     * @return array
     */
    public function fetchArray($optional = \PDO::FETCH_ASSOC)
    {
        $this->exec();
        return $this->queryString->fetch($optional);
    }
    /**
     *
     * @param string $optional
     * @return array
     */
    public function fetchAll($optional = \PDO::FETCH_ASSOC)
    {
        $this->exec();
        return $this->queryString->fetchAll($optional);
    }
    /**
     *
     * @return array
     */
    public function fetchSingleColumn()
    {
        $this->exec();
        return $this->queryString->fetch(\PDO::FETCH_COLUMN);
    }
}
