<?php
$title = '編輯';
require './parts/yun_parts/yun_connect-db.php';
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$sql = "SELECT * FROM Cart WHERE cart_id={$cid}";

$r = $pdo->query($sql)->fetch();
?>
<?php include './parts/head.php' ?>
<?php include './parts/navbar.php' ?>

<?php
$p_sql = "SELECT * FROM Products ORDER BY product_id DESC";
$p_rows = $pdo->query($p_sql)->fetchAll();
$m_sql = "SELECT * FROM member ORDER BY member_id ASC";
$m_rows = $pdo->query($m_sql)->fetchAll();

$ori_product_id = $r['product_id'];
$price_sql = "SELECT Cart.*, Products.product_id, Products.product_price
FROM Cart
INNER JOIN Products
ON Cart.product_id=Products.product_id
WHERE Cart.product_id = :ori_product_id";
$stmt = $pdo->prepare($price_sql);
$stmt->bindParam(':ori_product_id', $ori_product_id);
$stmt->execute();
$sum_price= $stmt->fetch();

## $sum_price['product_price'] 為原本商品價格
#print_r($sum_price);
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
                    <h5 class="card-title">編輯資料</h5>

                    <form name="form1" onsubmit="checkForm(event)">
                        <input type="text" class="form-control" id="cart_id" name="cart_id" value="<?= $r['cart_id'] ?>" style="display:none;" >
                        <div class="mb-3">
                            <label for="member_id" class="form-label">會員 ID</label>
                            <input type="text" class="form-control" id="member_id" name="member_id" data-required="1" value="<?= $r['member_id'] ?>" disabled>
                            <input type="text" class="form-control" id="member_id" name="member_id" data-required="1" value="<?= $r['member_id'] ?>" style="display:none">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="ori_sum_show" class="form-label">原本金額</label>
                            <input type="text" class="form-control" id="ori_sum_show" name="ori_sum_show" value="<?= $r['product_num']*$sum_price['product_price'] ?>" disabled>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_id" class="form-label">產品 ID</label>
                            <select name="product_id" id="product_id" class="form-control" data-required="1">
                            <?php foreach($p_rows as $rs): ?>
                                <option value="<?= $rs['product_id'] ?>" <?php echo ($rs['product_id'] === $r['product_id']) ? 'selected' : ''; ?>><?= $rs['product_name']." - $".$rs['product_price'] ?></option>
                            <?php endforeach; ?>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_num" class="form-label">購買數量</label>
                            <input type="text" class="form-control" id="product_num" name="product_num" value="<?= $r['product_num'] ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                    
                        
                        <!--隱藏資料傳遞-->
                        <!-- <input type="text" class="form-control" id="new_price" name="new_price" value="<?= $new_price ?>" style="display:block;"> -->


                        <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>

                        <button type="submit" class="btn btn-primary">修改</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

        
    // nameField 指輸入 name 的 <input>，infoBar 指跑出成功和失敗編輯的 Bar，fields 指所有擁有 form *[data-required="1"] 的 <form> 內的必填元素 
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



        let isPass = true; // 預設值是通過的

      

        if (isPass) {
            const fd = new FormData(document.form1);
            console.log(fd);
            fetch('./yun_cart_edit-api.php', {
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