<?php
$title = '編輯';
include './parts/pei_parts/connect-db.php';
?>
<?php include './parts/head.php'
?>

<?php include './parts/navbar.php'
?>

<?php

/* 沒拿到 get 就顯示錯誤 */
if (empty($_GET['id'])) {
    die('刪除失敗');
}
/* 設定 id 和指令 */
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM attractions WHERE id ={$id}";



$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location:list.php');
    exit;
}


$sql_type = "SELECT `type_name` FROM `attractions＿type` WHERE 1";
$typeArray = $pdo->query($sql_type)->fetchAll();

$typeID = empty($row['typ_id']) ? null : $row['typ_id'];

$sql_typeid = sprintf("SELECT `type_name` FROM `attractions＿type` WHERE `type_id`='%s'", $typeID);

$typeName = $pdo->query($sql_typeid)->fetch(PDO::FETCH_NUM)[0];



?>
<style>
    .form-text {
        color: red;
    }
</style>

<div class="container">
    <?php #include './parts/pei_parts/pei_navbar.php' 
    ?>
    <div class="row mt-4">
        <div class="col-6 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯資料</h5>
                    <form name=form1 onsubmit="checkForm(event)">
                        <!-- 此為隱藏欄位，用戶看不到的-->
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <div class="mb-3">
                            <label for="name " class="form-label">*景點名稱</label>
                            <input type="text" class="form-control" id="name" name="name" data-require="1" value="<?= htmlentities($row['name']) ?>">
                            <div class="form-text" style="color:red"></div>
                        </div>
                        <!-- 在下拉式選單中顯示資料 -->
                        <div class="mb-3">
                            <label for="type_name" class="form-label">景點類別</label>
                            <select name="type_name" id="type_name" class="form-control">
                                <option selected><?= $typeName ?></option>
                                <?php foreach ($typeArray as $i) : ?>
                                    <option value="<?= $i['type_name'] ?>"><?= $i['type_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">城市</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?= $row['city'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="description">介紹</label><textarea class="form-control" id="description" name="description" value=""><?= $row['description'] ?></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="open_time" class="form-label">開放時間</label>
                            <input type="text" class="form-control" id="open_time" name="open_time" data-required="1" value="<?= $row['open_time'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">地址</label>
                            <textarea class="form-control" id="address" name="address" value=""><?= htmlentities($row['address']) ?></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="tel" class="form-label">電話</label>
                            <input type="text" class="form-control" id="tel" name="tel" data-required="1" value="<?= $row['tel'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="alert alert-danger" role="alert" id="infoBar" style="display: none;"></div>
                        <button type="submit" class="btn btn-primary">編輯</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include './parts/scripts.php'
?>
<script>
    const nameField = document.querySelector('#name');
    const infoBar = document.querySelector('#infoBar');

    //取得必填欄位
    const fields = document.querySelectorAll('form *[data-required="1"]');


    function checkForm(event) {
        event.preventDefault(); //不要用傳統方式送出去

        let isPass = true; // 預設值是通過的

        // TODO:檢查欄位資料
        for (let f of fields) {
            if (!f.value) {
                isPass = false;
                f.style.border = '1px solid red';
                f.nextElementSibling.innerHTML = '請填入資料';
            }
        }

        if (nameField.value.length < 2) {
            isPass = false;
            nameField.style.border = '1px solid red';
            nameField.nextElementSibling.innerHTML = '請輸入至少兩個字';
        }

        if (isPass) {
            // 有通過就執行
            const fd = new FormData(document.form1); //沒有外觀的form的物件

            fetch('./pei_edit-api-view.php', {
                    method: 'POST',
                    body: fd, //Content-Type 省略,multipart/form-data
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '編輯成功'
                        infoBar.style.display = 'block';
                        setTimeout(() => {
                            goback();
                        }, 2000)


                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '編輯沒有編輯'
                        infoBar.style.display = 'block';
                    }
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 2000)
                })
                .catch(ex => {
                    console.log(ex)
                    infoBar.classList.remove('alert-success')
                    infoBar.classList.add('alert-danger')
                    infoBar.innerHTML = '編輯發生錯誤'
                    infoBar.style.display = 'block';
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 2000)
                })
        }
    }

    function goback() {
        window.location = './pei_view_custom_itinerary.php'
    }
</script>
<?php include './parts/foot.php'
?>