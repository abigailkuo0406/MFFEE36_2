<?php

class DB
{
  private $dbHost = "localhost";
  private $dbName = "mid-term";
  private $dbUser = "root";
  private $dbPassword = "root";
  private $conn;

  public function __construct()
  {
    try {
      $dsn = "mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName;
      $this->conn = new PDO($dsn, $this->dbUser, $this->dbPassword);
    } catch (PDOException $e) {
      die("DB Connection failed: " . $e->getMessage());
    }
  }

  public function insertData($name, $email, $post)
  {
    $sql = "INSERT INTO whopost (name,email,post) VALUES (:name,:email,:post)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['name' => $name, 'email' => $email, 'post' => $post]);
    echo "data inserted";
  }

  public function getData()
  {
    $sql = "SELECT * FROM whopost";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function deleteData($id)
  {
    $sql = "DELETE FROM whopost WHERE id=:id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    echo $stmt->rowCount() . " rows were affected.";
  }

  public function editData($id, $name)
  {
    $sql = "UPDATE whopost SET name = :name WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':id' => $id, ':name' => $name]);
  }
}
