<?php
// 連線資料庫
require './parts/kuo_parts/restaurant_connect-db.php';

// 每頁要顯示的資料數量
$perPage = 10;

// 使用者當前查看的頁面是第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

#限制網址列輸入零或負數頁碼要跳回第一頁
if ($page < 1) {
    header('Location:?page=1');
    exit;
}

#計算總筆數
$t_sql = "SELECT COUNT(1) FROM restaurant_list";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

// 計算總頁數
$totalPage = ceil($totalRows / $perPage);

$rows = [];

// 如果資料庫有資料再做資料撈取跟顯示
if ($totalRows) {

    $sql = sprintf("SELECT R.`reserve_id`,M.`member_name`,L.`rest_name`,L.`rest_area`,L.`rest_adress`,L.`rest_class`,R.`reserve_time`,R.`reserve_date`,R.`reserve_people`FROM reserve AS R JOIN member AS M ON R.`member_id` = M.`member_id` JOIN restaurant_list AS L ON R.`rest_id` = L.`rest_id` LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
    #依照在第幾頁，撈取對應資料，例如第一頁顯示1-10筆資料，第二頁顯示第11-20筆資料

    $rows = $pdo->query($sql)->fetchAll();

    // echo print_r($rows);


    // 如果當前頁碼大於總頁數
    if ($page > $totalPage) {
        header("Location:?page=$totalPage");
    }
}

// 取地區資料
$sql_area = "SELECT * FROM area_list WHERE 1";
$areaArray = $pdo->query($sql_area)->fetchAll();

?>


<div class="container">


    <!-- <div class="input-group me-auto my-5">
        <span class="input-group-text">搜尋</span>
        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"> -->
    <!-- 放大鏡icon -->
    <!-- <span class="input-group-text">
            <i class="fa-solid fa-magnifying-glass"></i>
        </span>
    </div> -->

    <div class="mb-3">
        <label for="rest_area" class="form-label" class="form-control">以縣市搜尋</label>

        <select name="rest_area" id="rest_area" class="form-select" aria-label="Default select example" data-required="2">
            <option selected>--請選擇--</option>
            <?php foreach ($areaArray as $i) : ?>
                <option value="<?= $i['area_name'] ?>"><?= $i['area_name'] ?></option>
            <?php endforeach ?>

        </select>
        <!-- 放大鏡按鈕 -->
        <button type="button" class="btn btn-primary mt-3 ms-3" onclick="search()"><i class="fa-solid fa-magnifying-glass"></i></button>
        <div class="form-text"></div>
    </div>


    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">訂位編號</th>
                    <th scope="col">會員名稱</th>
                    <th scope="col">訂位餐廳</th>
                    <th scope="col">地區</th>
                    <th scope="col">餐廳地址</th>
                    <th scope="col">餐廳類型</th>
                    <th scope="col">訂位日期</th>
                    <th scope="col">訂位時間</th>
                    <th scope="col">訂位人數</th>
                    <th scope="col">修改</th>
                    <th scope="col">刪除</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['reserve_id'] ?></td>
                        <td><?= $r['member_name'] ?></td>
                        <td><?= $r['rest_name'] ?></td>
                        <td><?= $r['rest_area'] ?></td>
                        <td><?= $r['rest_adress'] ?></td>
                        <td><?= $r['rest_class'] ?></td>
                        <td><?= $r['reserve_date'] ?></td>
                        <td><?= $r['reserve_time'] ?></td>
                        <td><?= $r['reserve_people'] ?></td>

                        <!-- 編輯資料(icon) -->
                        <td>
                            <a href="kuo_reserve_edit.php?reserve_id=<?= $r['reserve_id'] ?>">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </td>
                        <!-- 刪除資料(icon)-->
                        <td>
                            <a href="javascript: deleteData(<?= $r['reserve_id'] ?>)">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!-- 最前頁 -->
                <li class="page-item <?= 1 == $page ? 'disable' : '' ?>"><a class="page-link" href="?page=1">最前頁</a></li>
                <!-- 回上頁 -->
                <li class="page-item <?= 1 == $page ? 'disable' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">上一頁</a>
                </li>

                <?php for ($i = $page - 5; $i <= $page + 5; $i++) : ?>
                    <?php if ($i >= 1 and $i <= $totalPage) : ?>
                        <!-- 當前頁 -->
                        <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif ?>
                <?php endfor ?>

                <!-- 下一頁 -->
                <li class="page-item <?= $totalPage == $page ? 'disable' : '' ?>"><a class="page-link" href="?page=<?= $page + 1 ?>">下一頁</a></li>

                <!-- 最後頁 -->
                <li class="page-item <?= $totalPage == $page ? 'disable' : '' ?>"><a class="page-link" href="?page=<?= $totalPage ?>">最後頁</a></li>
            </ul>
        </nav>
    </div>

</div>
<script>
    // 滑鼠移到當前頁的頁碼無法有超連結效果
    document.querySelector('li.page-item.active a').removeAttribute('href'); //有問題


    function deleteData(sid) {
        if (confirm(`確認刪除編號${sid}的資料`)) {
            location.href = 'kuo_reserve_delete_api.php?sid=' + sid;
        }

    }

    // 搜尋欄(未完成)
    function search() {
        // console.log('123')
        let search_area = document.getElementById('rest_area')
        let search_area_value = search_area.value
        console.log(search_area_value)
        <?php



        ?>

    }
</script>