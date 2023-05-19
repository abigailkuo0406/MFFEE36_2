<?php

require './parts/kuo_parts/restaurant_connect-db.php';

$sid = isset($_GET['rest_class_id']) ? intval($_GET['rest_class_id']) : 0;
$sql_solo = "SELECT * FROM restaurant_class WHERE rest_class_id={$sid}";

$r = $pdo->query($sql_solo)->fetch();
if (empty($r)) {
    header('Locatione: kuo_restaurant_class_list.php');
    exit;
};

?>

<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>

<div class="container mt-5">

    <div class="row">
        <div class="col-6">
            <div class="card" style="width: 40rem;">
                <div class="card-body">
                    <h5 class="card-title fs-3">編輯餐廳類型資料</h5>
                    <form name="restaurant_addform" onsubmit="restForm(event)">
                        <!-- 此為隱藏欄位，用戶看不到 -->
                        <input type="hidden" name="rest_class_id" id="rest_class_id" value="<?= $r['rest_class_id'] ?>">
                        <div class="mb-3">
                            <label for="rest_class" class="form-label">類型名稱</label>
                            <input type="text" class="form-control" id="rest_class" name="rest_class" value="<?= htmlentities($r['rest_class']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>

                        <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>

                        <button type="submit" class="btn btn-primary">編輯完成</button>

                    </form>
                </div>
            </div>


        </div>
    </div>



</div>
<script>
    const infoBar = document.querySelector('#infoBar');

    const fields = document.querySelectorAll('form *[data-required="1"]');
    const selects = document.querySelectorAll('form *[data-required="2"]');

    function restForm(event) {
        event.preventDefault();
        for (let f of fields) {

            f.style.border = '1px solid #ccc';
            f.nextElementSibling.innerHTML = ''
        }
        for (let s of selects) {

            s.style.border = '1px solid #ccc';
            s.nextElementSibling.innerHTML = ''
        }

        let ispass = true; // 預設值是通過的

        // TODO: 檢查欄位資料
        for (let f of fields) {
            if (!f.value) {
                ispass = false;
                f.style.border = '1px solid red';
                f.nextElementSibling.innerHTML = '請輸入資料'
            }

        }

        for (let s of selects) {
            if (s.value == '--請選擇--') {
                ispass = false;
                s.style.border = '1px solid red';
                s.nextElementSibling.innerHTML = '請選擇欄位'
            }

        }


        if (ispass) {
            const fd = new FormData(document.restaurant_addform);

            fetch('kuo_restaurant_class_edit_api.php', {
                    method: 'POST',
                    body: fd,
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {

                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '編輯成功'
                        infoBar.style.display = 'block';
                        setTimeout(() => {
                            goback();
                        }, 2000);

                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '資料未更改'
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
                    infoBar.innerHTML = '資料格式有誤'
                    infoBar.style.display = 'block';
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 2000);
                })
        } else {
            // 沒通過檢查
        }
    }

    function goback() {
        let previousPageUrl = document.referrer;
        location.href = previousPageUrl;
    }
</script>