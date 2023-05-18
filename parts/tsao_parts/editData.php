<?php

require_once 'db.php';

if (isset($_POST['editData'])) {
    $id = $_POST['id'];
    $rname = $_POST['rname'];
    $rintro = $_POST['rintro'];

    $db = new DB();
    $db->editData($id, $rname, $rintro);

    header("Location: index.php");
}
