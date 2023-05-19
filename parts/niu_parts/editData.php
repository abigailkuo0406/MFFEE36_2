<?php
require_once 'db.php';

if (isset($_POST['editData'])) {
  $id = $_POST['id'];
  $post = $_POST['post'];

  $db = new DB();
  $db->editData($id, $post);

  header('Location: index.php');
}
