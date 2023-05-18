<?php

if (isset($_POST['insertData'])) {

    // get user input data
    $rname = $_POST['rname'];
    $rintro = $_POST['rintro'];

    // connect to database
    require_once './parts/tsao_parts/db.php';

    // use insertData function to insert data to route table
    $db = new DB();
    $db->insertData($rname, $rintro);

    header("Location: official_itinerary.php");
}
