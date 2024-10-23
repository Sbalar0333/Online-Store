<?php
// class Database {
//     private $servername = "localhost";
//     private $username = "root";
//     private $password = "";
//     private $dbname = "m_e_data";
//     public $conn;

//     public function __construct() {
//         $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
//         if ($this->conn->connect_error) {
//             die("Connection failed: " . $this->conn->connect_error);
//         }
//     }

//     public function executeQuery($sql, $types = "", $params = []) {
//         $stmt = $this->conn->prepare($sql);
//         if (!empty($types) && !empty($params)) {
//             $stmt->bind_param($types, ...$params);
//         }
//         $stmt->execute();
//         return $stmt;
//     }

//     public function __destruct() {
//         $this->conn->close();
//     }
// }




class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "m_e_data";
    public $conn;
    private $connection;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function executeQuery($sql, $types = "", $params = []) {
        $stmt = $this->conn->prepare($sql);
        if (!empty($types) && !empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt;
    }

    public function close() {
        if ($this->conn) {
            $this->conn->close();
            $this->conn = null; 
        }
    }

    public function __destruct() {
        $this->close(); // Use the close method
    }
   
    
}






?>


