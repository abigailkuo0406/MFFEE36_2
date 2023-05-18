<?php
// Yo
if (isset($_POST['editData'])) {

  require_once 'db.php';

  $id = $_POST['id'];
  $name = $_POST['name'];

  $db = new DB();
  $db->editData($id, $name);

  header('Location: index.php');
}
