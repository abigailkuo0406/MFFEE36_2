<?php
#MVC
$pageName = 'list';
$title = '列表';
require './parts/pei_parts/connect-db.php';

$perPage = 10; # 每頁最多幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; # 用戶要看第幾頁


//計算總筆數
$t_sql = "SELECT COUNT(1) FROM `attractions`";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; //總筆數
$totalPages = ceil($totalRows / $page); //總頁數
$row = [];

if ($totalRows) {
    if ($page > $totalPages) {
        header("Location:?page= ?page=$totalpages");
        exit;
    }
    $sql = sprintf("SELECT * FROM attractions ORDER BY id DESC LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}
?>

<div class="container mt-4">
    <!-- 篩選bar -->
    <form action="" method="$_POST" accept-charset="utf-8">
        <div class="col-sm-3">
            <label class="visually-hidden">城市</label>
            <select class="form-select" id="city" name="city">
                <option selected>-------------選擇-------------</option>
                <option value="1">台北市</option>
                <option value="2">新北市</option>
                <option value="3">基隆市</option>
            </select>
        </div>
    </form>
    <div class="row">
        <nav aria-label="Page navigation example">
            <!-- 分頁(pagination)，顯示的頁碼 -->
            <ul class="pagination mt-3">
                <!-- 雙箭頭 -->
                <li class="page-item <?= $i == $page ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=1">
                        <i class="fa-solid fa-angles-left"></i>
                    </a>
                </li>
                <!-- 單箭頭 -->
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                </li>
                <!-- 計算當前頁數前後5頁 -->
                <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                    if ($i >= 1 and $i <= $totalPages) :
                ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                <?php endif;
                endfor; ?>
                <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </li>
                <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $totalPages ?>">
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">景點</th>
                    <th scope="col">類型</th>
                    <th scope="col">城市</th>
                    <th scope="col">介紹</th>
                    <th scope="col">開放時間</th>
                    <th scope="col">地址</th>
                    <th scope="col">電話</th>
                    <th scope="col"><i class="fa-regular fa-trash-can"></i></th>
                    <th scope="col"><i class="fa-regular fa-pen-to-square"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['id'] ?></td>
                        <td><?= $r['name'] ?></td>
                        <td><?= $r['typ_id'] ?></td>
                        <td><?= $r['city'] ?></td>
                        <td><?= $r['description'] ?></td>
                        <td><?= $r['open_time'] ?></td>
                        <td><?= $r['address'] ?></td>
                        <td><?= $r['tel'] ?></td>
                        <td><a href="javascript:delete_it(<?= $r['id'] ?>)">
                                <i class="fa-regular fa-trash-can"></i></a></td>
                        <td><a href="/pei_edit-view.php?id=<?= $r['id'] ?>">
                                <i class="fa-regular fa-pen-to-square"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    document.querySelector('li.page-item.active a').removeAttribute('href');

    function delete_it(id) {
        if (confirm(`是否要刪除編號為${id}的資料？`)) {
            location.href = 'pei_delete.php?id=' + id;
        }
    }
</script>