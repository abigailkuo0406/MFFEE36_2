<?php

require_once 'db.php';

if (isset($_POST['instertData'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];

  $db = new DB();
  $db->insertData($name, $email);
}
