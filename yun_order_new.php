<?php

    require './parts/yun_parts/yun_connect-db.php';
    $mid = isset($_GET['mid']) ? intval($_GET['mid']) : 0;
    // require './parts/admin-required.php';
    $pageName = 'add';
    $title = '新增';
    
    ?>
    <?php include './parts/head.php' ?>
    <?php include './parts/navbar.php' ?>


    <?php
        // $change_sql = 
        // "SELECT SUM(Cart.product_num * Products.product_price) AS total
        // FROM Cart
        // INNER JOIN Products ON Cart.product_id = Products.product_id
        // WHERE Cart.member_id = :change_member";
        // $change_stmt = $pdo->prepare($change_sql);
        // $change_stmt->bindParam(':change_member', $change_member);
        // $change_stmt->execute();
        // $total= $change_stmt->fetchColumn();
        $member_id = $mid;
        $new_order_sql = "SELECT Sum_Cart.*, Cart.*, member.*
        FROM Sum_Cart
        LEFT JOIN Cart ON Sum_Cart.member_id = Cart.member_id
        INNER JOIN member ON Sum_Cart.member_id = member.member_id
        WHERE Sum_Cart.member_id = :member_id";
        $new_order_stmt = $pdo->prepare($new_order_sql);
        $new_order_stmt->bindParam(':member_id', $member_id);
        $new_order_stmt->execute();
        $new_order= $new_order_stmt->fetch();
        $new_order_products= $new_order_stmt->fetchAll();
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
                        <h5 class="card-title">訂單下訂</h5>
                        <form name="form1" onsubmit="checkForm(event)">
                            <div class="mb-3">
                                <!--隱藏的 member_id-->
                                <input type="text" class="form-control" id="member_id" name="member_id" value="<?= $new_order['member_id'] ?>"  style="display:none;">
                            </div>
                            <div class="mb-3">
                                <label for="receiver_name" class="form-label">收件者姓名</label>
                                <input type="text" class="form-control" id="receiver_name" name="receiver_name" value="<?= $new_order['member_name'] ?>"  data-required="1">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="receiver_gender" class="form-label">稱謂</label>
                                <select name="receiver_gender" id="receiver_gender" class="form-control" data-required="1">
                                    <option value="先生" <?php echo ($new_order['gender'] === '男') ? 'selected' : ''; ?>>先生</option>
                                    <option value="小姐" <?php echo ($new_order['gender'] === '女') ? 'selected' : ''; ?>>小姐</option>
                                </select>
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="receiver_address" class="form-label">收件地址</label>                            
                                <input type="text" class="form-control" id="receiver_address" name="receiver_address" value="<?= $new_order['location'] ?>" data-required="1">
    
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="receiver_email" class="form-label">聯絡信箱</label>                            
                                <input type="text" class="form-control" id="receiver_email" name="receiver_email" value="<?= $new_order['email'] ?>" data-required="1">
    
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="receiver_tel" class="form-label">聯絡電話</label>                            
                                <input type="text" class="form-control" id="receiver_tel" name="receiver_tel" value="<?= $new_order['mobile'] ?>" data-required="1">
    
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="order_note" class="form-label">訂單備註</label>                            
                                <input type="text" class="form-control" id="order_note" name="order_note" placeholder="請輸入訂單備註..." data-required="1">
    
                                <div class="form-text"></div>
                            </div>
                            
    
                            <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>
    
                            <button type="submit" class="btn btn-primary">結帳</button>
                        </form>
                    </div>
                </div>

                <div class="card" style="width: 18rem;">
  <div class="card-header">
    <a>總價：<span><?= $new_order['sum_price'] ?></span><a/>
  </div>
 
    <ul class="list-group list-group-flush">
    <?php foreach($new_order_products as $r): ?>

        <li class="list-group-item"><?= $r['product_id'] ?></li>

        <?php endforeach; ?>
    </ul>
</div>


            </div>
        </div>
    </div>
    
    
    <script>//
        const nameField = document.querySelector('#receiver_name');
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
                const fd = new FormData(form); // 沒有外觀的表單
           
               
    
                // const usp = new URLSearchParams(fd); // 可以轉換為 urlencoded 格式
                // console.log(usp.toString());
                fetch('./yun_order_add-api.php', {
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
