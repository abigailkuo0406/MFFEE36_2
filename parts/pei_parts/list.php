<?php
#MVC
$pageName = 'list';
// $title = '列表';
require './parts/pei_parts/connect-db.php';

$perPage = 10; # 每頁最多幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; # 用戶要看第幾頁
$search = isset($_GET['search']) ? $_GET['search'] : null;


//計算總筆數
$t_sql = "SELECT COUNT(1) FROM `attractions`";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; //總筆數
#$totalPages = ceil($totalRows / $perPage); //總頁數
#$rows = [];

if ($totalRows) {
    if ($page > $totalPages) {
        header("Location:?page=$totalpages");
        exit;
    }
    $sql = sprintf("SELECT * FROM attractions ORDER BY id LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}

//  搜尋欄
$search = isset($_GET['search']) ? $_GET['search'] : null;
if ($search) {
    $search_type = 'id';
    $t_sql = "SELECT COUNT(1) FROM `attractions` WHERE `id`=$search";
    $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
    if ($totalRows == 0) {
        $t_sql = "SELECT COUNT(1) FROM `attractions` WHERE `name` = '$search'";
        $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
        $search_type = 'name_v';
    }
    $totalPages = ceil($totalRows / $perPage); //總頁數
    $rows = [];
    if ($totalRows) {
        if ($page > $totalPages) {
            header("Location:?page=$totalpages");
            exit;
        }
        if ($search_type == 'id') {
            $sql = sprintf("SELECT COUNT(1) FROM `attractions` WHERE `id`='$search'ORDER BY id DESC LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
        } else if ($search_type == 'name_v') {
            $sql = sprintf("SELECT * FROM `attractions` WHERE `name` = '$search' ORDER BY id DESC  LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
        }
        $rows = $pdo->query($sql)->fetchAll();
    }
} else {
    $t_sql = "SELECT COUNT(1) FROM `attractions`";
    $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; //總筆數
    $totalPages = ceil($totalRows / $perPage); //總頁數
    $rows = [];
}
?>


<div class="container mt-4">
    <form class="input-group mb-3" method="$_GET">
        <input name="search" type="text" class="form-control" placeholder="搜尋內容" value="<?= isset($_GET['search']) ? $_GET['search'] : null ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    <!-- 篩選bar -->
    <div class="row">
        <nav aria-label="Page navigation example">
            <!-- 分頁(pagination)，顯示的頁碼 -->
            <ul class="pagination mt-3">
                <!-- 雙箭頭 -->
                <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=1">
                        <i class="fa-solid fa-angles-left"></i>
                    </a>
                </li>
                <!-- 單箭頭 -->
                <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
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
                        <!-- 垃圾桶＆編輯icon -->
                        <td><a href="javascript:delete_it(<?= $r['id'] ?>)">
                                <i class="fa-regular fa-trash-can"></i></a></td>
                        <td><a href="pei_edit-view.php?id=<?= $r['id'] ?>">
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