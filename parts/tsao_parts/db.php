<?php

class DB
{

    private $dbHost='localhost';
    private $dbUser='root';
    private $dbPassword='root';
    private $dbName='tsao_itinerary';
    private $conn;


    public function __construct()
    {
        try {
            $dsn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
            $this->conn = new PDO($dsn, $this->dbUser, $this->dbPassword);
        } catch (PDOException $e) {
            die('DB Connection failed: ' . $e->getMessage());
        }
    }

    public function insertData($name, $email)
    {
        $sql = 'INSERT INTO official_itinerary (name, email) VALUE (:name, :email)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email]);
        echo 'data inserted';
    }

}