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

        $all_order_sql = "SELECT Sum_Cart.*, Cart.*, member.*
        FROM Sum_Cart
        LEFT JOIN Cart ON Sum_Cart.member_id = Cart.member_id
        INNER JOIN member ON Sum_Cart.member_id = member.member_id
        WHERE Sum_Cart.member_id = :member_id";

        $all_order_stmt = $pdo->prepare($all_order_sql);
        $all_order_stmt->bindParam(':member_id', $member_id);
        $all_order_stmt->execute();
        $all_order_products= $all_order_stmt->fetchAll();

        $quantity_totals = array();
        foreach ($all_order_products as $order_product) {
            $product_id = $order_product['product_id'];
            $product_num = $order_product['product_num'];
            if (isset($quantity_totals[$product_id])) {
                # 如果已存在該 product_id 的數量，則進行累加
                $quantity_totals[$product_id] += $product_num;
            } else {
                # 如果該 product_id 尚未存在，則設定初始值
            $quantity_totals[$product_id] = $product_num;
            }
        }
    ?>
    <style>
    form .mb-3 .form-text {
        color: red;
    }
    </style>
    
    
    <div class="container-fuild">
        <div class="row d-flex justify-content-center m-5">
            <div class="col-4">
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
                            <div class="mb-3">
                                <label for="ad" class="form-label">是否接收最新商品訊息？</label>                            
                                
                            
                                <input type="radio" id="ad_yes" name="ad" value="1" checked><label for="ad_yes">是</label>
                                <input type="radio" id="ad_no" name="ad" value="0"><label for="ad_no">否</label>
                                <div class="form-text"></div>

                            </div>

                            <!--隱藏資料-->
                            <input type="text" class="form-control" id="order_total" name="order_total" value="<?= $new_order['sum_price'] ?>" style="display:none">
    
                            <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>
                            
    
                            <button type="submit" class="btn btn-primary">結帳</button>
                            <button type="button" class="btn btn-primary" onclick="goBack()">取消</button>
                        </form>
                    </div>
                </div>
                </div>
                <div class="col-2">
                    <div class="card" style="width: 18rem;">
                        <ul class="list-group list-group-flush">
                            <?php foreach($quantity_totals as $key => $value): ?>
                            <?php
                                $cart_card_sql="SELECT `product_name`,`product_price`,`product_main_img` FROM `Products` WHERE `product_id`=:key;";
                                $cart_card_stmt = $pdo->prepare($cart_card_sql);
                                $cart_card_stmt->bindParam(':key', $key);
                                $cart_card_stmt->execute();
                                $card_order= $cart_card_stmt->fetch();
                            ?>
                            <li class="list-group-item"><img src="<?php
                            $imageUrl = $card_order['product_main_img'];
                            $imageContent = @file_get_contents("./imgs/".$imageUrl);
                            if($imageContent == true){
                            echo "./imgs/".$imageUrl;
                            } else if($imageContent == false) {
                            echo "https://digitalfinger.id/wp-content/uploads/2019/12/no-image-available-icon-6.png";
                            }
                            ?>" style="width: 150px;"><h6 class="catch_product_name"><?= $card_order['product_name']?></h6><a>數量: <a class="catch_product_num"><?=$value?></a></a><a> | </a><>單價: <?=$card_order['product_price']?></a><a class="catch_product_id" style="display:none;"><?= $key ?></a><a class="catch_member_id" style="display:none;"><?= $member_id ?></a></li>
                            
                            <?php endforeach; ?>
                        </ul>
                        <div class="card-footer">
                            <a>總價：<span><?= $new_order['sum_price'] ?></span><a/>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    
    
    <script>
        const memberid = document.querySelector('#member_id').value;
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
    

    
    
            if (nameField.value.length < 2) {
                isPass = false;
                nameField.style.border = '1px solid red';
                nameField.nextElementSibling.innerHTML = '請輸入至少兩個字'
            }
    
            if (isPass) {
                
           
/* ============================= */
                var p_data = {
                id: [],
                num: []
                };
                var idElements = document.getElementsByClassName("catch_product_id");
                var numElements = document.getElementsByClassName("catch_product_num");
                
                for (let i = 0; i < idElements.length; i++) {
                p_data.id.push(idElements[i].textContent);
                }

                for (let i = 0; i < numElements.length; i++) {
                p_data.num.push(numElements[i].textContent);
                }
                
                const form = document.querySelector('form[name="form1"]');
                const fd = new FormData(form); // 沒有外觀的表單
                var jsonData = JSON.stringify(p_data);
                fd.append('jsonData', jsonData);
                
/* ============================= */







                fetch('./yun_order_add-api.php', {
                        method: 'POST',
                        body: fd, //Content-Type 省略,multipart/form-data
                    }).then(r => r.json())
                    .then(obj => {
                        if(obj.success) {
    
                            infoBar.classList.remove('alert-danger')
                            infoBar.classList.add('alert-success')
                            infoBar.innerHTML = '新增成功'
                            infoBar.style.display = 'block';


                            //回去刪除購物車資料 start
                            setTimeout(()=>{
                                
                                location.href = './yun_cart_new_order_delete.php?mid=' + memberid;
                            }, 2000);

                            //回去刪除購物車資料 end
                            
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
            var previousPageURL = document.referrer;
            window.location.href = previousPageURL;

            
        } else {
        window.location.href = './yun_cart.php';
    }

    }        

    </script>
    <?php include './parts/foot.php' ?>
