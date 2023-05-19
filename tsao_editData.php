<?php

require_once './parts/tsao_parts/db.php';

if (isset($_POST['editData'])) {
    $id = $_POST['id'];
    $rname = $_POST['rname'];
    $rintro = $_POST['rintro'];

    $db = new DB();
    $db->editData($id, $rname, $rintro);

    header("Location: official_itinerary.php");
}
