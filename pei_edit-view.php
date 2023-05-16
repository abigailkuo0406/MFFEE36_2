<?php
$title = '編輯';
include './parts/pei_parts/connect-db.php';
?>
<?php include './parts/head.php'
?>

<?php #include './parts/navbar.php' 
?>

<?php
/* 沒拿到 get 就顯示錯誤 */
if (empty($_GET['id'])) {
    die('刪除失敗');
}
/* 設定 id 和指令 */
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM attractions WHERE id ={$id}";

$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location:list.php');
    exit;
}
?>
<style>
    .form-text {
        color: red;
    }
</style>

<div class="container">
    <?php #include './parts/pei_parts/pei_navbar.php' 
    ?>
    <div class="row mt-4">
        <div class="col-6 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯資料</h5>
                    <form name=form1 onsubmit="checkForm(event)">
                        <!-- 此為隱藏欄位，用戶看不到的-->
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <div class="mb-3">
                            <label for="name " class="form-label">*景點名稱</label>
                            <input type="text" class="form-control" id="name" name="name" data-require="1" value="<?= htmlentities($row['name']) ?>">
                            <div class="form-text" style="color:red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="typ_id" class="form-label">景點類別</label>
                            <input type="text" class="form-control" id="typ_id" name="typ_id" value="<?= $row['typ_id'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <!-- <label for="typ_id" class="form-label">景點類別</label>
                        <div class="input-group mb-3">
                            <select class="form-select" id="typ_id">
                                <option selected>----選擇-----</option>
                                <option value="1">1:單車漫遊</option>
                                <option value="2">2:戶外踏青</option>
                                <option value="3">3:夜市商圈</option>
                                <option value="4">4:藍色水岸</option>
                                <option value="5">5:歷史文化</option>
                                <option value="6">6:步道之旅</option>
                            </select>
                        </div> -->

                        <div class="mb-3">
                            <label for="city" class="form-label">城市</label>
                            <!-- <select class="form-select" id="typ_id" name="typ_id" data-required="1">
                                <option selected>----選擇-----</option>
                                <option value="1">台北市</option>
                                <option value="2">新北市</option>
                                <option value="3">基隆市</option>
                            </select> -->
                            <input type="text" class="form-control" id="city" name="city" value="<?= $row['city'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">介紹</label><textarea class="form-control" id="description" name="description" value="<?= $row['description'] ?>"></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="open_time" class="form-label">開放時間</label>
                            <input type="text" class="form-control" id="open_time" name="open_time" data-required="1" value="<?= $row['open_time'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">地址</label>
                            <textarea class="form-control" id="address" name="address" value="<?= $row['address'] ?>"></textarea>
                            <div class=" form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="tel" class="form-label">電話</label>
                            <input type="text" class="form-control" id="tel" name="tel" data-required="1" value="<?= $row['tel'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
                        </div>
                        <div class="alert alert-danger" role="alert" id="infoBar" style="display: none;"></div>
                        <button type="submit" class="btn btn-primary">編輯</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include './parts/scripts.php'
?>
<script>
    const nameField = document.querySelector('#name');
    const infoBar = document.querySelector('#infoBar');

    //取得必填欄位
    const fields = document.querySelectorAll('form *[data-required="1"]');


    function checkForm(event) {
        event.preventDefault(); //不要用傳統方式送出去

        // for (let f of fields) {
        //     // 出錯時標示出外觀的樣式
        //     f.style.border = '1px solid #CCC';
        //     f.nextElementSibling.innerHTML = '';
        // }
        // nameField.style.border = '1px solid #CCC';
        // nameField.nextElementSibling.innerHTML = '';

        let isPass = true; // 預設值是通過的

        // TODO:檢查欄位資料
        for (let f of fields) {
            if (!f.value) {
                isPass = false;
                f.style.border = '1px solid red';
                f.nextElementSibling.innerHTML = '請填入資料';
            }
        }

        if (nameField.value.length < 2) {
            isPass = false;
            nameField.style.border = '1px solid red';
            nameField.nextElementSibling.innerHTML = '請輸入至少兩個字';
        }

        if (isPass) {
            // 有通過就執行
            const fd = new FormData(document.form1); //沒有外觀的form的物件

            // const usp = new URLSearchParams(fd); //可以轉換為urlencoded格式
            // console.log(usp.toString());

            fetch('./pei_edit-api-view.php', {
                    method: 'POST',
                    body: fd, //Content-Type 省略,multipart/form-data
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '編輯成功'
                        infoBar.style.display = 'block';
                        setTimeout(() => {
                            location.href = '/parts/pei_parts/list.php';
                        }, 2000)


                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '編輯沒有編輯'
                        infoBar.style.display = 'block';
                    }
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 2000)
                })
                .catch(ex => {
                    console.log(ex)
                    infoBar.classList.remove('alert-success')
                    infoBar.classList.add('alert-danger')
                    infoBar.innerHTML = '編輯發生錯誤'
                    infoBar.style.display = 'block';
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 2000)
                })
        }
    }
</script>
<?php include './parts/foot.php'
?>