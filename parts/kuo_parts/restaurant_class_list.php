<?php
// 連線資料庫
require './parts/kuo_parts/restaurant_connect-db.php';


// 每頁要顯示的資料數量
$perPage = 10;

// 使用者當前查看的頁面是第幾頁,強制轉int為了不讓人拿字串亂試網址
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;



#計算總筆數
$t_sql = "SELECT COUNT(1) FROM restaurant_class";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

// 計算總頁數
$totalPage = ceil($totalRows / $perPage);

$rows = [];

// 如果資料庫有資料再做資料撈取跟顯示
if ($totalRows) {

    $sql = sprintf("SELECT * FROM restaurant_class LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
    #依照在第幾頁，撈取對應資料，例如第一頁顯示1-10筆資料，第二頁顯示第11-20筆資料

    $rows = $pdo->query($sql)->fetchAll();

    // 如果當前頁碼大於總頁數
    if ($page > $totalPage) {
        header("Location:?page=$totalPage");
    }
}

#限制網址列輸入零或負數頁碼要跳回第一頁
if ($page < 1) {
    header('Location:?page=1');
    exit;
}


?>

<!-- 頁面呈現 -->

<div class="container mt-5" style="width:85%">
    <div class="row mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-1">類型編號</th>
                    <th class="col-10">類型名稱</th>
                    <th class="col"></th>
                    <th class="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['rest_class_id'] ?></td>
                        <td><?= $r['rest_class'] ?></td>


                        <!-- 編輯資料(icon) -->
                        <td>
                            <a href="kuo_restaurant_class_edit.php?rest_class_id=<?= $r['rest_class_id'] ?>">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </td>
                        <!-- 刪除資料(icon)-->
                        <td>
                            <a href="javascript: deleteData(<?= $r['rest_class_id'] ?>)">
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
</div>
<script>
    // 滑鼠移到當前頁的頁碼無法有超連結效果
    document.querySelector('li.page-item.active a').removeAttribute('href'); //有問題


    function deleteData(sid) {
        if (confirm(`確認刪除編號${sid}的資料`)) {
            location.href = 'kuo_restaurant_class_delete_api.php?sid=' + sid;
        }

    }
</script>