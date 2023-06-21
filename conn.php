<?php

$servername = "localhost";
$dbname = "basdatabase";
$username = "root";
$password = "";

$connection = new DatabaseConn($servername, $dbname, $username, $password);
$connection->connect();
$conn = $connection->getConnection();
class DatabaseConn 
{
    private $servername;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    public function __construct($servername, $dbname, $username, $password) {
        $this->servername = $servername;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",
                $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "connected <br />";
        } catch(PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>