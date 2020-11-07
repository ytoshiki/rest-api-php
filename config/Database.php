<?php 
  class Database{
    // DB Params
    private $host = 'localhost';
    private $dbname = 'restphp';
    private $uname = 'root';
    private $pass = 'y7d4RFWY';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try {
        $this->conn = new PDO('mysql:host='. $this->host . ';dbname=' . $this->dbname,
        $this->uname, $this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOExemption $e) {
        echo 'Conncection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }