<?php
// require './parts/admin-required.php';
$pageName = 'add';
$title = '新增';
require './parts/john_parts/back/part/connect-db.php';

?>
<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>


<div class="container">
    <?php include './parts/john_parts/back/part/html-head.php'
    ?>
    <?php include './parts/john_parts/back/part/navbar.php';
    ?>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form name="form1" onsubmit="checkForm(event)">
                        <div class="mb-3">
                            <label for="email" class="form-label">帳號</label>
                            <input type="email" class="form-control" id="email" name="email" autocomplete="on">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">密碼</label>
                            <input type="text" class="form-control" id="password" name="password">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label">大頭貼</label>
                            <input type="number" class="form-control" id="images" name="images">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_name" class="form-label">名字</label>
                            <input type="text" class="form-control" id="member_name" name="member_name" value="<?= isset($_POST['member_name']) ? htmlentities($_POST['member_name']) : '' ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="member_birth" class="form-label">生日</label>
                            <input type="date" class="form-control" id="member_birth" name="member_birth">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="id_number" class="form-label">身分證字號</label>
                            <input type="text" class="form-control" id="id_number" name="id_number">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">性別</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="gender" value="男" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    男
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="gender" value="女">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    女
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">居住地</label>
                            <input type="text" class="form-control" id="location" name="location">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="height" class="form-label">身高</label>
                            <input type="text" class="form-control" id="height" name="height">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">體重</label>
                            <input type="text" class="form-control" id="weight" name="weight">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="zodiac" class="form-label">星座</label>
                            <select class="form-select" multiple aria-label="multiple select example" name="zodiac">
                                <option value="牡羊座" selected>牡羊座(3/21~4/19)</option>
                                <option value="金牛座">金牛座(4/20~5/20)</option>
                                <option value="雙子座">雙子座(5/21~6/21)</option>
                                <option value="巨蟹座">巨蟹座(6/22~7/22)</option>
                                <option value="獅子座">獅子座(7/23~8/22)</option>
                                <option value="處女座">處女座(8/23~9/23)</option>
                                <option value="天秤座">天秤座(9/24~10/23)</option>
                                <option value="天蠍座">天蠍座(10/24~11/22)</option>
                                <option value="射手座">射手座(11/23~12/21)</option>
                                <option value="魔羯座">魔羯座(12/22~1/20)</option>
                                <option value="水瓶座">水瓶座 (1/21~2/18)</option>
                                <option value="雙魚座">雙魚座(2/18~3/20)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bloodtype" class="form-label">血型</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bloodtype" id="bloodtype" value="A型" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    A型
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bloodtype" id="bloodtype" value="B型">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    B型
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bloodtype" id="bloodtype" value="AB型">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    AB型
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bloodtype" id="bloodtype" value="O型">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    O型
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="smoke" class="form-label">抽菸</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="smoke" id="smoke" value="有" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    有
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="smoke" id="smoke" value="沒有">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    沒有
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alchohol" class="form-label">酒量</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="alchohol" id="alchohol" value="滴酒不沾" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    滴酒不沾
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="alchohol" id="alchohol" value="小酌">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    小酌
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="alchohol" id="alchohol" value="酒豪">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    酒豪
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="education_level" class="form-label">教育程度</label>
                            <select class="form-select" multiple aria-label="multiple select example" name="education_level">
                                <option value="國小" selected>國小</option>
                                <option value="國中">國中</option>
                                <option value="高中">高中</option>
                                <option value="學士">學士</option>
                                <option value="碩士">碩士</option>
                                <option value="博士">博士</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="job" class="form-label">職業</label>
                            <input type="text" class="form-control" id="job" name="job">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="profile" class="form-label">自介</label>
                            <textarea type="text" class="form-control" id="profile" name="profile"></textarea>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">手機</label>
                            <input type="text" class="form-control" id="mobile" name="mobile">
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


<?php # include './parts/scripts.php' 
?>
<script>
    const nameField = document.querySelector('#name');
    const infoBar = document.querySelector('#infoBar');
    // 取得必填欄位
    const fields = document.querySelectorAll('form *[data-required="1"]');

    function checkForm(event) {
        event.preventDefault();

        for (let f of fields) {
            f.style.border = '1px solid #ccc';
            f.nextElementSibling.innerHTML = ''
        }
        // nameField.style.border = '1px solid #CCC';
        // nameField.nextElementSibling.innerHTML = ''

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


        // if (nameField.value.length < 2) {
        //     isPass = false;
        //     nameField.style.border = '1px solid red';
        //     nameField.nextElementSibling.innerHTML = '請輸入至少兩個字'
        // }

        if (isPass) {
            const fd = new FormData(document.form1); // 沒有外觀的表單
            // const usp = new URLSearchParams(fd); // 可以轉換為 urlencoded 格式
            // console.log(usp.toString());

            fetch('add-api-JM.php', {
                    method: 'POST',
                    body: fd, // Content-Type 省略, multipart/form-data
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {

                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '新增成功'
                        infoBar.style.display = 'block';
                        setTimeout(() => {
                            location.href = "./account.php";
                        }, 2000);

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
<?php #include './parts/html-foot.php' 
?>