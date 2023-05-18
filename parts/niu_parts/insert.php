<?php
require_once 'db.php';

if (isset($_POST['insertData'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $post = $_POST['post'];

  $db = new DB();
  $db->insertData($name, $email, $post);

  header('Location: index.php');
}
