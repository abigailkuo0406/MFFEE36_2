<?php

if (isset($_POST['insertData'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $post = $_POST['post'];

  require_once 'db.php';
  $db = new DB();
  $db->insertData($name, $email, $post);

  header('Location: index.php');
}
