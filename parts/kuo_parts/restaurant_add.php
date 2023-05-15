<?php

require './parts/kuo_parts/restaurant_connect-db.php';

?>



<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card" style="width: 40rem;">
                <div class="card-body">
                    <h5 class="card-title">新增餐廳資料</h5>
                    <form name="restaurant_addform" onsubmit="restForm(event)">
                        <div class="mb-3">
                            <label for="name" class="form-label">餐廳名稱</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= isset($_POST['name']) ? htmlentities($_POST['name']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="area" class="form-label">所在縣市</label>
                            <select name="area" id="area">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="adress" class="form-label">地址</label>
                            <input type="text" class="form-control" id="adress" name="adress" value="<?= isset($_POST['adress']) ? htmlentities($_POST['adress']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="">經度</label>
                            <input type="text">
                        </div>

                        <div class="mb-3">
                            <label for="">緯度</label>
                            <input type="text">
                        </div>

                        <div class="mb-3">
                            <label for="">介紹文字</label>
                            <textarea name="" id="" cols="30" rows="10"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>餐廳類型</ㄠ>
                                <label for="option1">
                                    <input type="radio" id="option1" name="options" value="1" checked> Option 1
                                </label>
                                <label for="option2">
                                    <input type="radio" id="option2" name="options" value="2"> Option 2
                                </label>
                                <label for="option3">
                                    <input type="radio" id="option3" name="options" value="3"> Option 3
                                </label>

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
    function restForm(event) {
        event.preventDefault();
        for (let f of fields) {

            f.style.border = '1px solid #ccc';
            f.nextElementSibling.innerHTML = ''
        }

        namefield.style.border = '1px solid #CCC';
        namefield.nextElementSibling.innerHTML = ''

        let ispass = true; // 預設值是通過的

        // TODO: 檢查欄位資料
        for (let f of fields) {
            if (!f.value) {
                ispass = false;
                f.style.border = '1px solid red';
                f.nextElementSibling.innerHTML = '請輸入資料'
            }

        }



        if (namefield.value.length < 2) {
            ispass = false;
            namefield.style.border = '1px solid red';
            namefield.nextElementSibling.innerHTML = '請輸入至少兩個字'
        }

        if (ispass) {
            const fd = new FormData(document.form1);
            /*測試code
            // const usp = new URLSearchParams(fd); //轉換為 urlencoded 格式
            // console.log(usp.toString())*/
            fetch('add-api.php', {
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