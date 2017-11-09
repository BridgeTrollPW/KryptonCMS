<?php
namespace Krypton\core;

final class Query
{
    private $table = null;
    public $select = '*';
    public $where = null;
    public $limit = null;
    public $update = null;
    public $insert = null;
    private function __construct()
    {
    }
    public static function T(string $table): Query
    {
        $instance = new self();
        $instance->table = $table;
        return $instance;
    }
    public function select($select = '*'): Query
    {
        $this->select = $select;
        return $this;
    }
    public function where($where): Query
    {
        $this->where = $where;
        return $this;
    }
    public function limit(int $limit): Query
    {
        $this->limit = $limit;
        return $this;
    }
    public function update($update): Query
    {
        $this->update = $update;
        return $this;
    }
    /**
     * $insertions need to be in the following format:
     * array (collum1 => value1,collum2 => value2)
     *
     * @param array $insertions
     * @return \Krypton\core\Query
     */
    public function insert(array $insertions): Query
    {
        $this->insert = $insertions;
        return $this;
    }
    public function __toString(): string
    {
        $sql = '';
        if (isset($this->update)) {
            $sql .= "UPDATE `{$this->table}` SET ";
            if (is_array($this->update)) {
                foreach ($this->update as $column => $value) {
                    $sql .= "{$column} = {$value},";
                }
                $sql = substr($sql, 0, - 1);
            } else {
                $sql .= $this->update;
            }
            $sql .= " WHERE {$this->where}";
        } elseif (isset($this->insert)) {
            $sql .= "INSERT INTO {$this->table} (";
            $tmp_values = '';
            foreach ($this->insert as $column => $value) {
                $sql .= $column . ',';
                $tmp_values .= $value . ',';
            }
            $sql = substr($sql, 0, - 1);
            $tmp_values = substr($tmp_values, 0, - 1);

            $sql .= ") VALUES ($tmp_values)";
        } else {
            $tmp = '';
            if (is_array($this->select)) {
                foreach ($this->select as $selector) {
                    $tmp .= $selector . ',';
                }
                $tmp = substr($tmp, 0, - 1);
                $this->select = $tmp;
            }
            $tmp = '';
            if (is_array($this->where)) {
                foreach ($this->where as $selector => $value) {
                    $tmp .= $selector . '=' . $value . ' AND ';
                }
                $tmp = substr($tmp, 0, - 4);
                $this->where = $tmp;
            }
            $sql .= "SELECT {$this->select} FROM {$this->table} WHERE {$this->where}";
        }
        return $sql;
    }
    public function get(array $stringEscapes = [], string $PDO_FETCH = \PDO::FETCH_ASSOC)
    {
        return Database::getInstance()->query((string)$this, [$stringEscapes])->fetchArray($PDO_FETCH);
    }
}
?>
 ?>
