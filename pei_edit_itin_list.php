<?php
$title = '編輯';
include './parts/pei_parts/connect-db.php';
?>
<?php include './parts/head.php'
?>
<?php #include './parts/navbar.php' 
?>
<?php

/* 設定 id 和指令 */
$itin_id = isset($_GET["itin_id"]) ? (string)$_GET["itin_id"] : '';
$sql = "SELECT * FROM Itinerary WHERE itin_id ='{$itin_id}'";

$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location:itin_list.php');
    exit;
}
?>


<style>
    .form-text {
        color: red;
    }
</style>

<div class="container">
    <div class="row mt-4">
        <div class="col-6 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯資料</h5>
                    <form name=form1 onsubmit="checkForm(event)">
                        <div class="mb-3">
                            <label for="itin_id " class="form-label">行程編號</label>
                            <input type="text" class="form-control" id="itin_id" name="itin_id" data-required="1" value="<?= $row['itin_id'] ?>">
                            <div class=" form-text" style="color:red">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="date " class="form-label">日期</label>
                            <input type="date" class="form-control" id="date" name="date" data-required="1" value="<?= $row['date'] ?>">
                            <div class="form-text" style="color:red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">*名稱</label>
                            <input type="text" class="form-control" id="name" name="name" data-required="1" value="<?= $row['name'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="description">介紹</label>
                            <input type="text" class="form-control" id="description" name="description" value="<?= $row['description'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="public" class="form-label">是否需要公開?</label>
                            <input class="form-check-input" type="radio" name="public" id="public1" value="公開" <?= $row['public'] == "公開" ? 'checked' : '' ?>>
                            <label class="form-check-label" for="public">公開</label>
                            <input class="form-check-input" type="radio" name="public" id="public2" value="不公開" <?= $row['public'] == "不公開" ? 'checked' : '' ?>>
                            <label class="form-check-label" for="public">不公開</label>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="ppl" class="form-label">人數</label>
                            <input type="text" class="form-control" id="ppl" name="ppl" data-required="1" value="<?= $row['ppl'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_id" class="form-label">會員編號</label>
                            <input type="text" class="form-control" id="member_id" name="member_id" data-required="1" value="<?= $row['member_id'] ?>">
                            <div class="form-text" style="color:red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="create_at" class="form-label">建立時間</label>
                            <input type="text" class="form-control" id="create_at" name="create_at" value="<?= $row['create_at'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="alert alert-danger" role="alert" id="infoBar" style="display: none;"></div>
                        <button type="submit" class="btn btn-primary">編輯完成</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include './parts/scripts.php' ?>
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

            fetch('pei_edit-api-itin.php', {
                    method: 'POST',
                    body: fd, //Content-Type 省略,multipart/form-data
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {

                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '新增成功'
                        infoBar.style.display = 'block';
                        setTimeout(() => {
                            location.href = './parts/pei_parts/itin_list.php';
                        }, 2000)

                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '新增失敗'
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
                    infoBar.innerHTML = '新增發生錯誤'
                    infoBar.style.display = 'block';
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 2000)
                })
        } else {
            //沒有通過
        }
    };
    // 時間顯示
    const now = new Date();
    const year = now.getFullYear();
    const month = now.getMonth() + 1;
    const day = now.getDate();
    const hour = now.getHours();
    const minute = now.getMinutes();
    const second = now.getSeconds();
    const formattedTime = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;
    document.getElementById("create_at").value = formattedTime;
</script>
<?php # include './parts/html-foot.php' 
?>