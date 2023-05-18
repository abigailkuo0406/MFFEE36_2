<?php
// 連線資料庫
require './parts/kuo_parts/restaurant_connect-db.php';
?>

<div class="container mt-3" style="width:100%">
    <form class="input-group my-3" method="GET" style="width:15%;">
        <input name="search" type="text" class="form-control" placeholder="輸入會員ID" value="<?= isset($_GET['search']) ? htmlentities($_GET['search']) : null ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    <label style="font-size:20px;font-weight:800" class="mb-2"><?= isset($_GET['search']) && $_GET['search'] != '' ? '搜尋結果：' : '' ?></label>
    <?php

    // 每頁要顯示的資料數量
    $perPage = 10;

    // 使用者當前查看的頁面是第幾頁
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // 搜尋後顯示資料
    $search = isset($_GET['search']) ? $_GET['search'] : null; //取得會員ID搜尋結果


    $total_search_row = [];

    if ($search && $search != '') {
        // echo 'A';
        $search_sql = sprintf("SELECT COUNT(1) FROM reserve WHERE member_ID='%s'", $search);
        $total_search_row = $pdo->query($search_sql)->fetch(PDO::FETCH_NUM)[0];
    } elseif (isset($search) && $search == '') {
        echo "<script language='JavaScript'>alert('請輸入會員編號');</script>";
    }


    if ($total_search_row) {
        // echo 'Aa';
        echo '<div  class="mb-3" style="font-size:20px;font-weight:800">共有 <a style="color:red">' . $total_search_row . '</a> 筆資料</div>';


        $sql = sprintf("SELECT R.`reserve_id`,
        M.`member_id`,
        M.`member_name`, 
        L.`rest_name`, L.`rest_area`, 
        L.`rest_adress`, 
        L.`rest_class`, 
        R.`reserve_time`, 
        R.`reserve_date`, 
        R.`reserve_people`, 
        R.`created_time` 
        FROM reserve AS R 
        JOIN member AS M 
        ON R.`member_id` = M.`member_id` and R.`member_id`='%s' 
        JOIN restaurant_list AS L 
        ON R.`rest_id` = L.`rest_id`", $search);


        $rows = $pdo->query($sql)->fetchAll();

        // 計算總頁數
        $totalPage = ceil($total_search_row / $perPage);
        // 如果當前頁碼大於總頁數
        if ($page > $totalPage) {
            header("Location:?page=$totalPage");
        }
    } else {
        // echo 'Ab';
        if ($total_search_row == 0 && $search != null) {
            echo "<script language='JavaScript'>alert('未找到資料');</script>";
        }
        if ($search != null) {
            echo '<div  class="mb-3" style="font-size:20px;font-weight:800">共有 <a style="color:red">' . 0 . '</a> 筆資料</div>';
        }

        #計算總筆數
        $t_sql = "SELECT COUNT(1) FROM reserve";
        $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

        // 計算總頁數
        $totalPage = ceil($totalRows / $perPage);

        $rows = [];

        // 如果資料庫有資料再做資料撈取跟顯示
        if ($totalRows) {

            $sql = sprintf("SELECT R.`reserve_id`,
            M.`member_id`,
            M.`member_name`,
            L.`rest_name`,
            L.`rest_area`,
            L.`rest_adress`,
            L.`rest_class`,
            R.`reserve_time`,
            R.`reserve_date`,
            R.`reserve_people`,
            R.`created_time`
            FROM reserve AS R 
            JOIN member AS M 
            ON R.`member_id` = M.`member_id` 
            JOIN restaurant_list AS L 
            ON R.`rest_id` = L.`rest_id` 
            LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
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



    // 取地區資料
    $sql_area = "SELECT * FROM area_list WHERE 1";
    $areaArray = $pdo->query($sql_area)->fetchAll();


    ?>




    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col">訂位編號</th>
                    <th class="col">會員ID</th>
                    <th class="col">會員名稱</th>
                    <th class="col">訂位餐廳</th>
                    <th class="col">地區</th>
                    <th class="col">餐廳地址</th>
                    <th class="col">餐廳類型</th>
                    <th class="col">訂位日期</th>
                    <th class="col">訂位時間</th>
                    <th class="col">訂位人數</th>
                    <th class="col">訂位建立時間</th>
                    <th class="col">修改</th>
                    <th class="col">刪除</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['reserve_id'] ?></td>
                        <td><?= $r['member_id'] ?></td>
                        <td><?= $r['member_name'] ?></td>
                        <td><?= $r['rest_name'] ?></td>
                        <td><?= $r['rest_area'] ?></td>
                        <td><?= $r['rest_adress'] ?></td>
                        <td><?= $r['rest_class'] ?></td>
                        <td><?= $r['reserve_date'] ?></td>
                        <td><?= $r['reserve_time'] ?></td>
                        <td><?= $r['reserve_people'] ?></td>
                        <td><?= $r['created_time'] ?></td>

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
                <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>"><a class="page-link" href="?page=1">最前頁</a></li>
                <!-- 回上頁 -->
                <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">上一頁</a>
                </li>

                <?php for ($i = $page - 5; $i <= $page + 5; $i++) : ?>
                    <?php if ($i >= 1 and $i <= $totalPage) : ?>
                        <!-- 當前頁 -->
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif ?>
                <?php endfor ?>

                <!-- 下一頁 -->
                <li class="page-item <?= $totalPage == $page ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page + 1 ?>">下一頁</a></li>

                <!-- 最後頁 -->
                <li class="page-item <?= $totalPage == $page ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $totalPage ?>">最後頁</a></li>
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
</script>