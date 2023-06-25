<?php
class Database
{
    private $conn = null;
    private $dbname = "";
    private $username = "";
    private $servername = "";
    private $dbpassword = "";

    public static function instance()
    {
        static $instance = null;

        if($instance === null)
        {
            $instance = new Database();
        }
            
        return $instance;
    }

    public function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->dbpassword, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}