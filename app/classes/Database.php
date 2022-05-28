<?php

namespace App\Classes;

use mysqli;

class Database
{
    protected $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        if (!$this->conn) {
            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            // Check connection
            if ($this->conn->connect_errno) {
                echo "Failed to connect to MySQL: " . $this->conn->connect_error;
                exit();
            }
        }
    }
    function get($sql)
    {
        $result = $this->conn->query($sql);

        $row = $result->fetch_object();
        $data = null;
        if ($result->num_rows != 0) {
            $data = $row;
        }
        $result->free_result();
        return $data;
    }
    function getAll($tabel)
    {
        $sql = 'SELECT * FROM ' . $tabel;
        $result = $this->conn->query($sql);

        $row = $result->fetch_all(MYSQLI_ASSOC);

        // Free result set
        $result->free_result();

        return $row;
    }
    function other_query($query, $type = 1)
    {
        $result = $this->conn->query($query);
        if ($type == 1) {
            $data = $result->fetch_object();
        } else {
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
        return $data;
    }
    function insert($sql)
    {
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }
    function edit($sql)
    {
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }
    function delete($tabel, $field, $data)
    {
        return $this->conn->query("DELETE FROM `$tabel` WHERE `$field` = $data");
    }
   
    function bind_param($sql, $param1, $param2)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $param1, $param2);

        $param1 = $param1;
        $param2 = $param2;

        $stmt->execute();
    }

    function get_last_param($tabel, $param)
    {
        $sql = "SELECT * FROM $tabel ORDER BY $param DESC LIMIT 1";
        $result = $this->conn->query($sql);
        return $result->fetch_array();
    }
}
