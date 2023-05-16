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
                            <label for="product_name" class="form-label">商品名稱</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">價格</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_brief" class="form-label">簡述</label>
                            <input type="text" class="form-control" id="product_brief" name="product_brief" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_category" class="form-label">分類</label>                            
                            <select name="product_category" id="product_category" class="form-control" data-required="1">
                                <option value="品牌周邊">品牌周邊</option>
                                <option value="旅行">旅行</option>
                                <option value="禮物">禮物</option>
                                <option value="超值票券">超值票券</option>
                                <option value="外出小點">外出小點</option>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_launch" class="form-label">上架時間</label>
                            <input type="datetime-local" class="form-control" id="product_launch" name="product_launch">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_discon" class="form-label">下架時間</label>
                            <input type="datetime-local" class="form-control" id="product_discon" name="product_discon">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_main_img" class="form-label">商品主圖</label>
                            <!--隱藏的 input 傳送檔名到資料庫-->
                            <input type="text" class="form-control" id="product_main_img" name="product_main_img" style="display: none;">
                            <div id="avatar_div" class="input-group mb-3">
                            <input type="file" class="form-control" id="avatar" name="avatar">
                            </div>
                            <img src="" alt="" id="avatar_img" class="w-50">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_description" class="form-label">商品描述</label>
                            <textarea class="form-control" id="product_description" name="product_description" data-required="1"></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_post" class="form-label">商品網址</label>
                            <input type="text" class="form-control" id="product_post" name="product_post" data-required="1">
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
    //<button onclick="selectFile()">上傳圖片</button>  
    //<form name="form_avatar" style="display: none">
    //<input type="file" name="avatar" id="avatar" accept="image/jpeg/png">
    //</form>
    //<img src="" alt="" id="avatar_img">

//     <div class="input-group mb-3" onclick="selectFile()">
//      <input type="file" class="form-control" id="avatar" name="avatar">
//     </div>
//<img src="" alt="" id="avatar_img">

    const inp_avatar = document.querySelector('#avatar');
    const div_avatar = document.querySelector('#avatar_div');
    inp_avatar.addEventListener('change', function(event){
    const fd_avatar = new FormData(document.form1);
    console.log("上傳檔案名稱：" + inp_avatar.files[0].name);
            fetch('./yun_upload-img.php', {
                method: 'POST',
                body: fd_avatar
            }).then(r=>r.json())
            .then(obj=>{
                if(obj.filename){
                    document.querySelector('#avatar_img').src = './imgs/'+obj.filename;
                }
                console.log("傳輸檔名到input中："+obj.filename);
                //obj.filename 為圖檔名
                const product_img = document.querySelector('#product_main_img');
                product_img.value = obj.filename;
            })
            .catch(ex=>{
                console.log(ex);
            })
        });

        // function selectFile(){
        //     inp_avatar.click(); // 模擬點擊
        // }




    const nameField = document.querySelector('#product_name');
    const infoBar = document.querySelector('#infoBar');
    // 取得必填欄位
    const fields = document.querySelectorAll('form *[data-required="1"]');

    function checkForm(event) {
        event.preventDefault();

        for(let f of fields){
            f.style.border = '1px solid #ccc';
            f.nextElementSibling.innerHTML = ''
        }
        nameField.style.border = '1px solid #CCC';
        nameField.nextElementSibling.innerHTML = ''

        let isPass = true; // 預設值是通過的

        // TODO: 檢查欄位資料

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


        if (nameField.value.length < 2) {
            isPass = false;
            nameField.style.border = '1px solid red';
            nameField.nextElementSibling.innerHTML = '請輸入至少兩個字'
        }

        if (isPass) {

            const form = document.querySelector('form[name="form1"]');
            // console.log(document.form1);
            const fd = new FormData(form); // 沒有外觀的表單
            console.log(fd.get('name'));
            console.log(fd.get('product_price'));
           

            // const usp = new URLSearchParams(fd); // 可以轉換為 urlencoded 格式
            // console.log(usp.toString());
            fetch('./yun_product_add-api.php', {
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

                        setTimeout(()=>{
                            goBack();
                        }, 2000);

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
    function goBack() {
        if (document.referrer) {
            history.back();
        } else {
        window.location.href = './yun_product.php';
    }
}
</script>
<?php include './parts/foot.php' ?>