<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

class Model
{
    public $table_name;
    public $db = false;

    public function __construct()
    {
        $this->db = new MysqliDb(
            MYSQL_HOST,
            MYSQL_USERNAME,
            MYSQL_PASSWORD,
            MYSQL_DATABASE
        );

        $this->db->rawQuery("SET time_zone = '-3:00'");
    }

    public function isConnected()
    {
        return $this->db;
    }

    public function rawQuery($query, $params = null)
    {
        if (!$this->isConnected()) {
            return false;
        }

        return $this->db->rawQuery($query, $params);
    }

    public function orderBy(...$orderBy)
    {
        if (!$this->isConnected()) {
            return false;
        }

        return $this->db->orderBy(...$orderBy);
    }

    public function list($numRows = null)
    {
        if (!$this->isConnected()) {
            return false;
        }

        return $this->db->get($this->table_name, $numRows);
    }

    public function count()
    {
        if (!$this->isConnected()) {
            return false;
        }

        return $this->db->get($this->table_name, null, 'COUNT(id) AS count');
    }

    public function insert($data = [])
    {
        if (!$this->isConnected()) {
            return false;
        }

        return $this->db->insert($this->table_name, $data);
    }

    public function getCreatedLast7Days()
    {
        if (!$this->isConnected()) {
            return false;
        }

        return $this->db->rawQuery("SELECT (
            SELECT COUNT(id) FROM {$this->table_name} WHERE createdAt > NOW() - INTERVAL 1 DAY AND createdAt <= NOW() - INTERVAL 0 DAY
        ) AS d0, (
            SELECT COUNT(id) FROM {$this->table_name} WHERE createdAt > NOW() - INTERVAL 2 DAY AND createdAt <= NOW() - INTERVAL 1 DAY
        ) AS d1, (
            SELECT COUNT(id) FROM {$this->table_name} WHERE createdAt > NOW() - INTERVAL 3 DAY AND createdAt <= NOW() - INTERVAL 2 DAY
        ) AS d2, (
            SELECT COUNT(id) FROM {$this->table_name} WHERE createdAt > NOW() - INTERVAL 4 DAY AND createdAt <= NOW() - INTERVAL 3 DAY
        ) AS d3, (
            SELECT COUNT(id) FROM {$this->table_name} WHERE createdAt > NOW() - INTERVAL 5 DAY AND createdAt <= NOW() - INTERVAL 4 DAY
        ) AS d4, (
            SELECT COUNT(id) FROM {$this->table_name} WHERE createdAt > NOW() - INTERVAL 6 DAY AND createdAt <= NOW() - INTERVAL 5 DAY
        ) AS d5, (
            SELECT COUNT(id) FROM {$this->table_name} WHERE createdAt > NOW() - INTERVAL 7 DAY AND createdAt <= NOW() - INTERVAL 6 DAY
        ) AS d6");
    }
}
