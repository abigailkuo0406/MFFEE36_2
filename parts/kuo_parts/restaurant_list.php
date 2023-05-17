<?php
// 連線資料庫
require './parts/kuo_parts/restaurant_connect-db.php';

// 取地區資料
$sql_area = "SELECT * FROM area_list WHERE 1";
$areaArray = $pdo->query($sql_area)->fetchAll();
?>

<div class="container mt-5">
    <form class="input-group mb-3" method="get">
        <div class="mb-3">
            <label for="search" class="form-label" class="form-control">以縣市搜尋</label>

            <select name="search" id="search" class="form-select" aria-label="Default select example" data-required="2">
                <option selected>--請選擇--</option>
                <?php foreach ($areaArray as $i) : ?>
                    <option value="<?= isset($i['area_name']) ? $i['area_name'] : null ?>"><?= $i['area_name'] ?></option>
                <?php endforeach ?>

            </select>
            <input type="submit" value="搜尋">
        </div>
    </form>


    <?php
    // 每頁要顯示的資料數量
    $perPage = 5;

    // 使用者當前查看的頁面是第幾頁,強制轉int為了不讓人拿字串亂試網址
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // 搜尋後顯示資料
    $search = isset($_GET['search']) ? $_GET['search'] : null;
    // echo $search;
    // exit;
    if ($search) {
        $search_sql = sprintf("SELECT COUNT(1) FROM restaurant_list WHERE rest_area='%s'", $search);
        $total_search_row = $pdo->query($search_sql)->fetch(PDO::FETCH_NUM)[0];
        // echo $total_search_row;
    }


    if ($total_search_row) {
        // 計算總頁數
        $totalPage = ceil($total_search_row / $perPage);
        $rows = [];
        $sql = sprintf("SELECT * FROM restaurant_list WHERE rest_area='%s' LIMIT %s,%s", $search, ($page - 1) * $perPage, $perPage);
        #依照在第幾頁，撈取對應資料，例如第一頁顯示1-10筆資料，第二頁顯示第11-20筆資料

        $rows = $pdo->query($sql)->fetchAll();


        // 如果當前頁碼大於總頁數
        if ($page > $totalPage) {
            header("Location:?page=$totalPage");
        }
    } else {
        #計算總筆數
        $t_sql = "SELECT COUNT(1) FROM restaurant_list";
        $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

        // 計算總頁數
        $totalPage = ceil($totalRows / $perPage);

        $rows = [];

        // 如果資料庫有資料再做資料撈取跟顯示
        if ($totalRows) {

            $sql = sprintf("SELECT * FROM restaurant_list LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
            #依照在第幾頁，撈取對應資料，例如第一頁顯示1-10筆資料，第二頁顯示第11-20筆資料

            $rows = $pdo->query($sql)->fetchAll();

            // 如果當前頁碼大於總頁數
            if ($page > $totalPage) {
                header("Location:?page=$totalPage");
            }
        }
    }
    #限制網址列輸入零或負數頁碼要跳回第一頁
    if ($page < 1) {
        header('Location:?page=1');
        exit;
    }


    ?>

    <!-- 頁面呈現 -->



    <!-- <div class="input-group me-auto my-5">
        <span class="input-group-text">搜尋</span>
        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"> -->
    <!-- 放大鏡icon -->
    <!-- <span class="input-group-text">
            <i class="fa-solid fa-magnifying-glass"></i>
        </span>
    </div> -->




    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">餐廳編號</th>
                    <th scope="col">餐廳名稱</th>
                    <th scope="col">所在縣市</th>
                    <th scope="col">地址</th>
                    <th scope="col">經度</th>
                    <th scope="col">緯度</th>
                    <th scope="col">介紹文字</th>
                    <th scope="col">餐廳類型</th>
                    <th scope="col">創建日期</th>
                    <th scope="col">修改</th>
                    <th scope="col">刪除</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['rest_id'] ?></td>
                        <td><?= $r['rest_name'] ?></td>
                        <td><?= $r['rest_area'] ?></td>
                        <td><?= $r['rest_adress'] ?></td>
                        <td><?= $r['rest_lon'] ?></td>
                        <td><?= $r['rest_lat'] ?></td>
                        <td><?= $r['rest_intro'] ?></td>
                        <td><?= $r['rest_class'] ?></td>
                        <td><?= $r['created_time'] ?></td>

                        <!-- 編輯資料(icon) -->
                        <td>
                            <a href="kuo_restaurant_edit.php?rest_id=<?= $r['rest_id'] ?>">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </td>
                        <!-- 刪除資料(icon)-->
                        <td>
                            <a href="javascript: deleteData(<?= $r['rest_id'] ?>)">
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
            location.href = 'kuo_restaurant_delete_api.php?sid=' + sid;
        }

    }

    function search() {
        // console.log('123')
        let search_area = document.getElementById('rest_area')
        let search_area_value = search_area.value
        console.log(search_area_value)
        <?php



        ?>

    }
</script>