<?php
require_once 'db.php';
$db = new DB();
// Hi
// Delete Data
if (isset($_POST['deleteData'])) {
  $id = $_POST['id'];
  $db->deleteData($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Details</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

    body {
      font-family: 'Roboto', sans-serif;
    }
  </style>
</head>

<body>

  <h1>Insert</h1>
  <form action="insert.php" method="post">
    <input type="text" placeholder="Name" name="name">
    <input type="text" placeholder="Email" name="email">
    <input type="submit" value="Insert" name="insertData">
  </form>

  <h1>Delete</h1>
  <form method="post">
    <input type="text" placeholder="Id" name="id">
    <input type="submit" value="Delete" name="deleteData">
  </form>

  <h1>Edit</h1>
  <form action="editData.php" method="post">
    <input type="text" placeholder="Id" name="id">
    <input type="text" placeholder="Name" name="name">
    <input type="submit" value="Edit" name="editData">
  </form>

  <h1>Data</h1>
  <?php
  $data = $db->getData();
  foreach ($data as $i) {
    echo $i['id'] . '. ' . $i['name'] . ' - ' . $i['email'] . '<br>';
  }
  ?>
</body>

</html>