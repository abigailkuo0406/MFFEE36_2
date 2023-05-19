<?php
#MVC
// $pageName = 'list';

require './parts/pei_parts/connect-db.php';

$perPage = 10; # 每頁最多幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; # 用戶要看第幾頁
#抓搜尋欄位的value
$search = isset($_GET['search_city']) ? $_GET['search_city'] : null;

#判斷有沒有抓到縣市的值
if ($search) {
    $t_sql = sprintf("SELECT COUNT(1) FROM `attractions` where city='%s'", $search);
    $sql = sprintf("SELECT * FROM attractions where city= '%s' ORDER BY id LIMIT %s,%s", $search, ($page - 1) * $perPage, $perPage);
} else {
    $t_sql = "SELECT COUNT(1) FROM `attractions`";
    $sql = sprintf("SELECT * FROM attractions ORDER BY id LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
}

//計算總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; //總筆數
$totalPages = ceil($totalRows / $perPage); //總頁數
$rows = [];


if ($totalRows) {
    if ($page > $totalPages) {
        header("Location:?page=$totalpages");
        exit;
    }
    $rows = $pdo->query($sql)->fetchAll();
}

?>
<!-- 搜尋縣市欄 -->
<div class="container mt-4">
    <form class="row row-cols-lg-auto g-3 align-items-center" method=" GET" action="">
        <div class="col-12">
            <label class="visually-hidden" for="city1">選擇城市：</label>
            <select name="search_city" id="city1" class="form-select">
                <option selected value="">---請選擇城市---</option>
                <option value="台北市">台北市</option>
                <option value="新北市">新北市</option>
                <option value="基隆市">基隆市</option>
            </select>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-outline-primary" id="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <div class="row row-cols-lg-auto g-3 align-items-center4">
            <p class="font-monospace fw-normal">共有：<?php echo $totalRows ?> 筆</p>
        </div>
    </form>
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
    <!-- 列表的呈現表格各個名稱 ,table-striped -->
    <div class="row">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="align-middle text-center">
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
                    <tr class="text-start">
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