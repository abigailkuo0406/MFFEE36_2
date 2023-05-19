<?php
require_once 'db.php';
$db = new DB();

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
  <title>Who post?</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

    body {
      font-family: 'Roboto', sans-serif;
    }
  </style>
</head>

<body>
  <h1>Friend Trip 交友網站留言板後台</h1>
  <h1>新增一筆貼文</h1>
  <form action="insert.php" method="post">
    <input type="text" placeholder="誰發的文" name="name">
    <input type="email" placeholder="發文者的email" name="email">
    <input type="text" placeholder="發文在此" name="post">
    <input type="submit" value="Insert" name="insertData">
  </form>

  <h1>刪除一筆貼文</h1>
  <form method="post">
    <input type="text" placeholder="Id" name="id">
    <input type="submit" value="Delete" name="deleteData">
  </form>

  <h1>修改一筆貼文</h1>
  <form action="editData.php" method="post">
    <input type="text" placeholder="Id" name="id">
    <input type="text" placeholder="修改不當貼文內容" name="post">
    <input type="submit" value="Edit" name="editData">
  </form>

  <h1>資料庫內容顯示</h1>
  <?php
  $data = $db->getData();
  foreach ($data as $i) {
    echo $i['id'] . ". " . $i['name'] . " - " . $i['email'] . " - " . $i['post'] . "<br>";
  }
  ?>

</body>

</html>