<?php
$pageName = 'login';
$title = '登入';
require './parts/john_parts/back/part/connect-db.php';

if (isset($_SESSION['admin'])) {
    header('Location: account.php');
    exit;
}
?>
<?php include './parts/john_parts/back/part/html-head.php' ?>
<?php include './parts/john_parts/back/part/navbar.php' ?>
<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>


<div class="container" style="height: 85vh">
    <div class="row" id="intro">
        <div class="col-12">
            <div class="card w-50 m-auto mt-2">
                <div class="card-body">
                    <h5 class="card-title">登入管理員</h5>
                    <form name="form1" onsubmit="checkForm(event)">
                        <div class="mb-3">
                            <label for="email" class="form-label">帳號</label>
                            <input type="text" class="form-control" id="email" name="email" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">密碼</label>
                            <input type="password" class="form-control" id="password" name="password" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>

                        <button type="submit" class="btn btn-primary ">登入</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php include './parts/scripts.php' ?>
<script>
    const nameField = document.querySelector('#name');
    const infoBar = document.querySelector('#infoBar');
    // 取得必填欄位
    const fields = document.querySelectorAll('form *[data-required="1"]');

    function checkForm(event) {
        event.preventDefault();

        for (let f of fields) {
            f.style.border = '1px solid #ccc';
            f.nextElementSibling.innerHTML = ''
        }


        let isPass = true; // 預設值是通過的

        // TODO: 檢查欄位資料


        // 檢查必填欄位
        for (let f of fields) {
            if (!f.value) {
                isPass = false;
                f.style.border = '1px solid red';
                f.nextElementSibling.innerHTML = '請填入資料'
            }
        }

        if (isPass) {
            const fd = new FormData(document.form1); // 沒有外觀的表單
            fetch('login-api.php', {
                    method: 'POST',
                    body: fd, // Content-Type 省略, multipart/form-data
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {

                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '登入成功'
                        infoBar.style.display = 'block';
                        // location.href = 'index_.php';
                        setTimeout(() => {
                            console.log('tttttttttt')
                            location.href = 'account.php';
                        }, 2000);

                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '帳號或密碼錯誤'
                        infoBar.style.display = 'block';
                    }
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 2000);
                })
                .catch(ex => {
                    console.log(ex);
                    infoBar.classList.remove('alert-success')
                    infoBar.classList.add('alert-danger')
                    infoBar.innerHTML = '新增發生錯誤'
                    infoBar.style.display = 'block';
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 2000);
                })

        } else {
            // 沒通過檢查
        }


    }
</script>
<?php include './parts/john_parts/back/part/html-foot.php' ?>