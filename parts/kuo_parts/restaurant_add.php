<?php

require './parts/kuo_parts/restaurant_connect-db.php';

// 取地區資料
$sql_area = "SELECT * FROM area_list WHERE 1";
$areaArray = $pdo->query($sql_area)->fetchAll();

// 取料理類型資料
$sql_class = "SELECT * FROM restaurant_class WHERE 1";
$classArray = $pdo->query($sql_class)->fetchAll();
?>



<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card" style="width: 40rem;">
                <div class="card-body">
                    <h5 class="card-title fs-3">新增餐廳資料</h5>
                    <form name="restaurant_addform" onsubmit="restForm(event)">
                        <div class="mb-3">
                            <label for="name" class="form-label">餐廳名稱</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= isset($_POST['name']) ? htmlentities($_POST['name']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="area" class="form-label" class="form-control">所在縣市</label>
                            <select name="area" id="area" class="form-select" aria-label="Default select example">
                                <option selected>--請選擇--</option>
                                <?php foreach ($areaArray as $i) : ?>
                                    <option value="<?= $i['area_id'] ?>"><?= $i['area_name'] ?></option>
                                <?php endforeach ?>
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="adress" class="form-label">地址</label>
                            <input type="text" class="form-control" id="adress" name="adress" value="<?= isset($_POST['adress']) ? htmlentities($_POST['adress']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="lon" class="form-label">經度</label>
                            <input type="text" class="form-control" id="lon" name="lon">
                        </div>

                        <div class="mb-3">
                            <label for="lat" class="form-label">緯度</label>
                            <input type="text" class="form-control" id="lat" name="lat">
                        </div>

                        <div class="mb-3">
                            <label for="intro" class="form-label">介紹文字</label>
                            <textarea name="intro" id="intro" class="form-control" aria-label="With textarea"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="class" class="form-label">料理類型</label>
                            <select name="class" id="class" class="form-select" aria-label="Default select example">
                                <option selected>--請選擇--</option>

                                <?php foreach ($classArray as $c) : ?>
                                    <option value="<?= $c['rest_class_id'] ?>"><?= $c['rest_class'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="">資料建立時間</label>

                        </div>
                        <button type="submit" class="btn btn-primary">新增</button>

                    </form>
                </div>
            </div>


        </div>
    </div>



</div>
<script>
    const namefield = document.querySelector('#name');

    const infoBar = document.querySelector('#infoBar');
    // const fields = document.querySelectorAll('form');

    function restForm(event) {
        event.preventDefault();
        // for (let f of fields) {

        //     f.style.border = '1px solid #ccc';
        //     f.nextElementSibling.innerHTML = ''
        // }

        // namefield.style.border = '1px solid #CCC';
        // namefield.nextElementSibling.innerHTML = ''

        let ispass = true; // 預設值是通過的

        // TODO: 檢查欄位資料
        // for (let f of fields) {
        //     if (!f.value) {
        //         ispass = false;
        //         f.style.border = '1px solid red';
        //         f.nextElementSibling.innerHTML = '請輸入資料'
        //     }

        // }



        // if (namefield.value.length < 2) {
        //     ispass = false;
        //     namefield.style.border = '1px solid red';
        //     namefield.nextElementSibling.innerHTML = '請輸入至少兩個字'
        // }

        if (ispass) {
            const fd = new FormData(document.form1);
            /*測試code
            // const usp = new URLSearchParams(fd); //轉換為 urlencoded 格式
            // console.log(usp.toString())*/
            fetch('kuo_restaurant_add_api.php', {
                    method: 'POST',
                    body: fd,
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {

                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '新增成功'
                        infoBar.style.display = 'block';

                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '新增失敗'
                        infoBar.style.display = 'block';
                    }
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 2000);

                })
            // .catch(ex => {
            //     console.log(ex);
            //     infoBar.classList.remove('alert-success')
            //     infoBar.classList.add('alert-danger')
            //     infoBar.innerHTML = '新增發生錯誤'
            //     infoBar.style.display = 'block';
            //     setTimeout(() => {
            //         infoBar.style.display = 'none';
            //     }, 2000);
            // })
        } else {
            // 沒通過檢查
        }
    }
</script>