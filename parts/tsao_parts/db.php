<?php

class DB
{
    private $dbHost = "localhost";
    private $dbName = "friendtrip";
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

    public function insertData($rname, $rintro)
    {
        $sql = "INSERT INTO route (rname,rintro) VALUES (:rname,:rintro)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":rname" => $rname, ":rintro" => $rintro]);
        echo "官方行程名稱、官方行程介紹成功輸入資料庫";
    }

    public function getData()
    {
        $sql = "SELECT * FROM route";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function deleteData($id)
    {
        $sql = "DELETE FROM route WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $id]);
    }

    public function editData($id, $rname, $rintro)
    {
        $sql = "UPDATE route SET rname=:rname,rintro=:rintro WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $id, ":rname" => $rname, ":rintro" => $rintro]);
    }
}
