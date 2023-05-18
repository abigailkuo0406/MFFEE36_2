<?php
require_once 'db.php';
$db = new DB();

// 刪除官方行程資料
if (isset($_POST['deleteData'])) {
    $id = $_POST['id'];
    $db->deleteData($id);
}
?>


<body>
    <div class="container">
        <h1>官方行程 - 曹祐嘉負責</h1>
        <h1>請輸入官方行程名稱及介紹</h1>
        <form action="insert.php" method="post">
            <input type="text" placeholder="請輸入官方行程名稱" name="rname">
            <input type="text" placeholder="請輸入官方行程介紹" name="rintro">
            <input type="submit" value="按下輸入到資料庫" name="insertData">
        </form>

        <h1>刪除官方行程資料</h1>
        <form method="post">
            <input type="text" placeholder="請輸入要刪除官方行程的編號" name="id">
            <input type="submit" value="請刪除這筆官方行程的資料" name="deleteData">
        </form>

        <h1>編輯官方行程資料</h1>
        <form action="editData.php" method="post">
            <input type="text" placeholder="請輸入要修改的官方行程編號" name="id">
            <input type="text" placeholder="請輸入新的官方行程名稱" name="rname">
            <input type="text" placeholder="請輸入修改後的官方行程介紹" name="rintro">
            <input type="submit" value="按下輸入到資料庫" name="editData">
        </form>

        <h1>官方行程資料顯示在此</h1>
        <?php
        $data = $db->getData();
        foreach ($data as $i) {
            echo $i['id'] . ". " . "官方行程名稱: " . $i['rname'] . "<br>";
            echo "&nbsp&nbsp&nbsp&nbsp" . $i['rname'] . "行程介紹: " . $i['rintro'] . "<br>";
        }
        ?>
    </div>