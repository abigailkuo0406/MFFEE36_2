<?php
#MVC
// $pageName = 'list';
// $title = '列表';
require './parts/pei_parts/connect-db.php';

$perPage = 10; # 每頁最多幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; # 用戶要看第幾頁


//計算總筆數
$t_sql = "SELECT COUNT(1) FROM `Itinerary`";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; //總筆數
$totalPages = ceil($totalRows / $perPage); //總頁數
$rows = [];

if ($totalRows) {
    if ($page > $totalPages) {
        header("Location:?page=$totalpages");
        exit;
    }
    $sql = sprintf("SELECT * FROM `Itinerary` ORDER BY itin_id DESC LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}
?>

<div class="container mt-4 ">
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
                <?php for ($i = $page - 2; $i <= $page + 2; $i++) :
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
                    <th scope="col">行程編號</th>
                    <th scope="col">日期</th>
                    <th scope="col">名稱</th>
                    <th scope="col">公開</th>
                    <th scope="col">人數</th>
                    <th scope="col">會員編號</th>
                    <th scope="col">建立時間</th>
                    <th scope="col"><i class="fa-regular fa-trash-can"></i></th>
                    <th scope="col"><i class="fa-regular fa-pen-to-square"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['itin_id'] ?></td>
                        <td><?= $r['date'] ?></td>
                        <td><?= $r['name'] ?></td>
                        <td><?= $r['public'] ?></td>
                        <td><?= $r['ppl'] ?></td>
                        <td><?= $r['member_id'] ?></td>
                        <td><?= $r['create_at'] ?></td>
                        <td>
                            <a href="javascript:delete_it('<?= $r['itin_id'] ?>')">
                                <i class="fa-regular fa-trash-can"></i></a>
                        </td>
                        <td>
                            <a href="pei_edit_itin_list.php?itin_id=<?= $r['itin_id'] ?>">
                                <i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    document.querySelector('li.page-item.active a').removeAttribute('href');

    function delete_it(itin_id) {
        console.log('test');
        if (confirm(`是否要刪除編號為${itin_id}的資料？`)) {
            location.href = 'pei_itin_delete.php?itin_id=' +
                itin_id;
        }
    }
</script>