<?php


if (isset($_POST['insertData'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];

  require_once 'db.php';
  $db = new DB();

  $db->insertData($name, $email);

  header('Location: index.php');
}
