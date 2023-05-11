<?php
$pageName = 'add';
$title = '新增';
include './parts/pei_parts/connect-db.php';

?>
<?php #include './parts/html-head.php' 
?>
<?php #include './parts/navbar.php' 
?>
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
                    <form name="form1" onsubmit="checkForm(event);">
                        <div class="mb-3">
                            <label for="name" class="form-label">* name</label>
                            <input type="text" class="form-control" id="name" name="name" data-required="1">
                            <!-- value="<?php #echo isset($_POST['name']) ? htmlentities($_POST['name']) : '' 
                                        ?>"> -->
                            <!--重新整理後上一個提交的name的value還在，如果之後輸入有其他錯誤要求修改，就可以保留name的名稱-->

                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">address</label>
                            <textarea class="form-control" id="address" name="address" data-required="1"></textarea>
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


<?php include './parts/scripts.php' ?>
<script>
    const nameField = document.querySelector('#name'); // 取 ID 為 name 的 <input>
    const infoBar = document.querySelector('#infoBar'); // 取 ID 為 infoBar 隱藏中彈會跳出是否成功的 <div>
    const fields = document.querySelectorAll('form *[data-required="1"]'); // 除了 birthday 以外的所有欄位

    /* 已拿掉 form 的 GET */
    /* checkForm() 為 <form> 提交後啟動的 function */
    function checkForm(event) {

        event.preventDefault(); //不讓form用傳統方式傳送

        // 檢查前端格式 (檢查格式後端才是最重要的)
        // fields 為儲存所有必填項目的變數
        for (let f of fields) {
            f.style.border = '1px solid #ccc'; // rgb(204, 204, 204)
            f.nextElementSibling.innerHTML = '';
        }
        nameField.style.border = '1px solid #CCC';
        nameField.nextElementSibling.innerHTML = '';
        let isPass = true; // 預設值是通過的

        /*
        // 檢查必填欄位
        for(let f of fields){
            if(! f.value){
                isPass = false;
                f.style.border = '1px solid red';
                f.nextElementSibling.innerHTML = '請填入資料'
            }
        }
        */

        //nameField 為儲存 ID 為 name 的 <input>
        if (nameField.value.length < 2) { //名稱輸入小於兩個字會錯誤
            isPass = false;
            nameField.style.border = '1px solid red';
            nameField.nextElementSibling.innerHTML = '請輸入至少兩個字' // 指的是 <input> 下方的 div.form-text
        }

        if (isPass) {
            const fd = new FormData(document.form1); //也是表單但沒有外觀，為保留表單資料的物件，這樣有 form1 的所有資料
            const usp = new URLSearchParams(fd); //可解析URL，透過搜尋 name 可以抓到其值
            // 不行直接 const usp = new URLSearchParams(document.form1);
            // const usp = new URLSearchParams({a:1, b:'bbb'}); 

            /* FormData 是使用 multipart/form-data 格式，故 URLSearchParams 可以解析*/
            console.log("印出的是 URLSearchParams：" + usp.toString());


            // fetch 為送出一個 request，成功會發回一個 promise 物件
            fetch('add-api.php', {
                    method: 'POST',
                    body: fd,
                    // body 為要傳送的訊息
                    // 使用 body時，Content-Type會省略並設置為 multipart/form-data
                    // fd 是剛剛 FormData 設置的變數

                    /*}).then(r=>r.text())
                    .then(txt=>{
                        console.log(txt);*/
                }).then(r => r.json())
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
                });
        } else {
            // 沒通過檢查
        }


    }
</script>
<?php # include './parts/html-foot.php' 
?>