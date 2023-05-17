<?php

class DB
{
  private $dbHost = 'localhost';
  private $dbUser = 'root';
  private $dbPassword = 'root';
  private $dbName = 'mid-term';
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
    $sql = "INSERT INTO $this->dbName. `userdetails` (name,email) VALUES (:name,:email)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':name' => $name, ':email' => $email]);
    echo 'data inserted';
  }

  public function getData()
  {
    $sql = "SELECT * FROM $this->dbName.`userdetails`";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function deleteData($id)
  {
    $sql = "DELETE FROM $this->dbName.`userdetails` WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    echo $stmt->rowCount() . ' rows were affected.';
  }

  public function editData($id, $name)
  {
    $sql = "UPDATE $this->dbName.`userdetails` SET name=:name WHERE id=:id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':name' => $name, ':id' => $id]);
  }
}
