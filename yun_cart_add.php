<?php
// require './parts/admin-required.php';
$pageName = 'add';
$title = '新增';
require './parts/yun_parts/yun_connect-db.php';

?>
<?php include './parts/head.php' ?>
<?php include './parts/navbar.php' ?>
<style>
form .mb-3 .form-text {
    color: red;
}
</style>


<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form name="form1" onsubmit="checkForm(event)">
                        <div class="mb-3">
                            <label for="member_id" class="form-label">會員 ID</label>
                            <input type="text" class="form-control" id="member_id" name="member_id" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_id" class="form-label">產品 ID</label>
                            <input type="text" class="form-control" id="product_id" name="product_id">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_num" class="form-label">購買數量</label>
                            <input type="text" class="form-control" id="product_num" name="product_num">
                            <div class="form-text"></div>
                        </div>
                        

                        <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>

                        <button type="submit" class="btn btn-primary">新增</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const infoBar = document.querySelector('#infoBar');
    // 取得必填欄位
    const fields = document.querySelectorAll('form *[data-required="1"]');

    function checkForm(event) {
        event.preventDefault();

        for(let f of fields){
            f.style.border = '1px solid #ccc';
            f.nextElementSibling.innerHTML = ''
        }


        let isPass = true; // 預設值是通過的


        if (isPass) {

            const form = document.querySelector('form[name="form1"]');
            // console.log(document.form1);
            const fd = new FormData(form); // 沒有外觀的表單
           

            // const usp = new URLSearchParams(fd); // 可以轉換為 urlencoded 格式
            // console.log(usp.toString());
            fetch('./yun_cart_add-api.php', {
                    method: 'POST',
                    body: fd, //Content-Type 省略,multipart/form-data
                }).then(r => r.json())
                .then(obj => {
                    console.log("這是obj: ");
                    console.log(obj);
                    if(obj.success) {

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
                    setTimeout(()=>{
                        infoBar.style.display = 'none';
                    }, 2000);
                })
                .catch(ex => {
                    // console.log(ex);
                    infoBar.classList.remove('alert-success')
                    infoBar.classList.add('alert-danger')
                    infoBar.innerHTML = '新增發生錯誤'
                    infoBar.style.display = 'block';
                    setTimeout(()=>{
                        infoBar.style.display = 'none';
                    }, 2000);
                })

        } else {
            // 沒通過檢查
        }


    }
</script>
<?php include './parts/foot.php' ?>