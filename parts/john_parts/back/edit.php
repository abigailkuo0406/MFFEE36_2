<?php
// require './parts/admin-required.php';
$title = '編輯';
require './parts/john_parts/back/part/connect-db.php';

$member_id = isset($_GET['member_id']) ? intval($_GET['member_id']) : 0;
$sql = "SELECT * FROM `member` WHERE member_id={$member_id}";

$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location: list.php');
    exit;
}




?>
<?php #include './parts/john_parts/back/part/html-head.php' 
?>
<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>


<div class="container">
    <?php include './parts/john_parts/back/part/navbar.php';
    ?>
    <div class="row">
        <div class="col-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">編輯資料</h5>
                    <form name="form1" onsubmit="checkForm(event)">
                        <input type="hidden" name="member_id" value="<?= $member_id ?>">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" data-required="1" value="<?= htmlentities($r['email']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label">images</label>
                            <input type="text" class="form-control" id="images" name="images" value="<?= htmlentities($r['images']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="member_name" name="member_name" value="<?= htmlentities($r['member_name']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_birth" class="form-label">birthday</label>
                            <input type="date" class="form-control" id="member_birth" name="member_birth" value="<?= htmlentities($r['member_birth']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="id_number" class="form-label">id_number</label>
                            <input type="text" class="form-control" id="id_number" name="id_number" value="<?= htmlentities($r['id_number']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">gender</label>
                            <input type="text" class="form-control" id="gender" name="gender" value="<?= htmlentities($r['gender']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">location</label>
                            <input type="text" class="form-control" id="location" name="location" value="<?= htmlentities($r['location']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="height" class="form-label">height</label>
                            <input type="text" class="form-control" id="height" name="height" value="<?= htmlentities($r['height']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">weight</label>
                            <input type="text" class="form-control" id="weight" name="weight" value="<?= htmlentities($r['weight']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="zodiac" class="form-label">zodiac</label>
                            <input type="text" class="form-control" id="zodiac" name="zodiac" value="<?= htmlentities($r['zodiac']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="bloodtype" class="form-label">bloodtype</label>
                            <input type="text" class="form-control" id="bloodtype" name="bloodtype" value="<?= htmlentities($r['weight']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="smoke" class="form-label">smoke</label>
                            <input type="text" class="form-control" id="smoke" name="smoke" value="<?= htmlentities($r['smoke']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="alchohol" class="form-label">alchohol</label>
                            <input type="text" class="form-control" id="alchohol" name="alchohol" value="<?= htmlentities($r['alchohol']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="education_level" class="form-label">education_level</label>
                            <input type="text" class="form-control" id="education_level" name="education_level" value="<?= htmlentities($r['education_level']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="job" class="form-label">job</label>
                            <input type="text" class="form-control" id="job" name="job" value="<?= htmlentities($r['job']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="profile" class="form-label">profile</label>
                            <textarea class="form-control" id="profile" name="profile" data-required="1"><?= $r['profile'] ?></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?= htmlentities($r['mobile']) ?>" data-required="1">
                            <div class="form-text"></div>
                        </div>

                        <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>

                        <button type="submit" class="btn btn-primary">編輯</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php #include './parts/scripts.php' 
?>
<script>
    const nameField = document.querySelector('#member_name');
    const infoBar = document.querySelector('#infoBar');
    // 取得必填欄位
    const fields = document.querySelectorAll('form *[data-required="1"]');

    function checkForm(event) {
        event.preventDefault();

        for (let f of fields) {
            f.style.border = '1px solid #ccc';
            f.nextElementSibling.innerHTML = '';
        }
        nameField.style.border = '1px solid #CCC';
        nameField.nextElementSibling.innerHTML = '';

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
            const fd = new FormData(document.form1); // 沒有外觀的表單
            // const usp = new URLSearchParams(fd); // 可以轉換為 urlencoded 格式
            // console.log(usp.toString());

            fetch('edit-api-JM.php', {
                    method: 'POST',
                    body: fd, // Content-Type 省略, multipart/form-data
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {

                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '編輯成功'
                        infoBar.style.display = 'block';

                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '資料沒有編輯'
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
                    infoBar.innerHTML = '編輯發生錯誤'
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
<?php #include './parts/html-foot.php' 
?>