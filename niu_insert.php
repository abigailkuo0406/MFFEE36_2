<?php

if (isset($_POST['insertData'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $post = $_POST['post'];

  require_once './parts/niu_parts/db.php';
  $db = new DB();
  $db->insertData($name, $email, $post);

  header('Location: board.php');
}
