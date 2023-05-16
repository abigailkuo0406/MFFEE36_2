<?php
$title = '編輯';
require './parts/yun_parts/yun_connect-db.php';
$pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
$sql = "SELECT * FROM Products WHERE product_id={$pid}";

$r = $pdo->query($sql)->fetch();
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
                    <h5 class="card-title">編輯資料</h5>

                    <form name="form1" onsubmit="checkForm(event)">
                        <!-- <input type="hidden"> 的意思為隱藏的輸入，可將輸入者看不到的資料一併傳給 db 做資料處理 -->
                        <input type="hidden" name="product_id" value="<?= $r['product_id'] ?>">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">商品名稱</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" data-required="1" value="<?= htmlentities($r['product_name']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">價格</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" data-required="1" value="<?= htmlentities($r['product_price']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_brief" class="form-label">簡述</label>
                            <input type="text" class="form-control" id="product_brief" name="product_brief" data-required="1" value="<?= htmlentities($r['product_brief']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_category" class="form-label">分類</label>   
                            <!--$r['product_category']-->        
                            <select name="product_category" id="product_category" class="form-control" data-required="1">
                                <option value="品牌周邊" <?php echo ($r['product_category'] === '品牌周邊') ? 'selected' : ''; ?>>品牌周邊</option>
                                <option value="旅行" <?php echo ($r['product_category'] === '旅行') ? 'selected' : ''; ?>>旅行</option>
                                <option value="禮物" <?php echo ($r['product_category'] === '禮物') ? 'selected' : ''; ?>>禮物</option>
                                <option value="超值票券" <?php echo ($r['product_category'] === '超值票券') ? 'selected' : ''; ?>>超值票券</option>
                                <option value="外出小點" <?php echo ($r['product_category'] === '外出小點') ? 'selected' : ''; ?>>外出小點</option>
                            </select>

                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_launch" class="form-label">上架時間</label>
                            <input type="datetime-local" class="form-control" id="product_launch" name="product_launch"  value="<?= $r['product_launch'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_discon" class="form-label">下架時間</label>
                            <input type="datetime-local" class="form-control" id="product_discon" name="product_discon"  value="<?= $r['product_discon'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_main_img" class="form-label">商品主圖</label>
                            <!--隱藏的 input 傳送檔名到資料庫-->
                            <input value="<?= htmlentities($r['product_main_img']) ?>" type="text" class="form-control" id="product_main_img" name="product_main_img" style="display: none;">
                            <div id="avatar_div" class="input-group mb-3">
                            <input type="file" class="form-control" id="avatar" name="avatar">
                            </div>
                            <img src="<?php
                    $imageUrl = $r['product_main_img'];
                    $imageContent = @file_get_contents("./imgs/".$imageUrl);
                    if($imageContent == true){
                      echo "./imgs/".$imageUrl;
                    } else if($imageContent == false) {
                      echo "https://digitalfinger.id/wp-content/uploads/2019/12/no-image-available-icon-6.png";
                    }
               
                     ?>" alt="" id="avatar_img" class="w-50">
                            <div class="form-text"></div>
                        </div>
                      

                           





                        <div class="mb-3">
                            <label for="product_description" class="form-label">商品描述</label>
                            <textarea class="form-control" id="product_description" name="product_description" data-required="1"  value="<?= htmlentities($r['product_description']) ?>"></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_post" class="form-label">商品網址</label>
                            <input type="text" class="form-control" id="product_post" name="product_post" data-required="1"  value="<?= htmlentities($r['product_post']) ?>">
                            <div class="form-text"></div>
                        </div>
                        

                        <div id="infoBar" class="alert alert-danger" role="alert" style="display:none"></div>
                        <button type="submit" class="btn btn-primary">編輯</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

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

        
    // nameField 指輸入 name 的 <input>，infoBar 指跑出成功和失敗編輯的 Bar，fields 指所有擁有 form *[data-required="1"] 的 <form> 內的必填元素 
    const nameField = document.querySelector('#product_name'); 
    const infoBar = document.querySelector('#infoBar');
    // 取得必填欄位，與 CSS 選擇器一樣：for*[data-required="1"] 的意思為 <form> 的子元素中，擁有屬性 data-required="1" 的全部元素
    const fields = document.querySelectorAll('form *[data-required="1"]');

    function checkForm(event) {
        event.preventDefault();

        for(let f of fields){

            // 提交表單後，將所有必輸入的邊框顏色變回灰色，把下方的錯誤訊息全部清空
            // 如果改成 f.nextElementSibling.innerHTML = 'haha'，提交後每個 input 下都會跑出紅色錯誤訊息  haha
            f.style.border = '1px solid #ccc';
            f.nextElementSibling.innerHTML = ' ';
        }

        // 可以不用特別設 (因為 name 也已經是必輸入的)
        nameField.style.border = '1px solid #CCC';
        nameField.nextElementSibling.innerHTML = ' '

        let isPass = true; // 預設值是通過的

        if (nameField.value.length < 2) {
            isPass = false;
            nameField.style.border = '1px solid red';
            nameField.nextElementSibling.innerHTML = '請輸入至少兩個字'
        }

        if (isPass) {
            const fd = new FormData(document.form1);
            console.log(fd);
            fetch('yun_product_edit-api.php', {
                    method: 'POST',
                    body: fd,
                }).then(r => r.json())
                .then(obj => {
                    if(obj.success) {
                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '編輯成功'
                        infoBar.style.display = 'block';

                        setTimeout(()=>{
                            goBack();
                        }, 2000);

                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '資料沒有編輯'
                        infoBar.style.display = 'block';
                    }
                    setTimeout(()=>{
                        infoBar.style.display = 'none';
                    }, 2000);
                })
                .catch(ex => {
                    console.log("Catch Error");
                    console.log(ex);
                    infoBar.classList.remove('alert-success')
                    infoBar.classList.add('alert-danger')
                    infoBar.innerHTML = '編輯發生錯誤'
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
            var previousPageURL = document.referrer;
            window.location.href = previousPageURL;

            
        } else {
        window.location.href = './yun_product.php';
    }


    }
</script>
<?php include './parts/foot.php' ?>