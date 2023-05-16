<?php
require_once 'db.php';
$db = new DB();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data</title>
</head>
<body>
    <form action="insert.php" method='post'>
        <input type="text" placeholder='Name' name='name'>
        <input type="text" placeholder='Email' name='email'>

        <input type="submit" value='Insert' name='insertData'>
    </form>
</body>
</html>