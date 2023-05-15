<?php
# MVC
$pageName = 'list';
$title = '列表';
require './parts/connect-db.php';

$perPage = 10; #每頁最多幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; #用戶要看第幾頁

if ($page < 1) {
    header('Location:?page=1');
    exit;
}

$t_sql = 'SELECT COUNT(1) FROM `member`';
// $t_row = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM);
// echo json_encode($t_row);
// exit;
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; # 總筆數

// echo "$totalRows, $totalPages";
// exit();
$rows = [];
if ($totalRows) {
    $totalPages = ceil($totalRows / $perPage); // 總頁數
    if ($page > $totalPages) {
        header("Location:?page=$totalPages");
        exit;
    }
    $sql = sprintf("SELECT * FROM `member` LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}
?>
<?php include './parts/html-head.php'; ?>
<?php include './parts/navbar.php'; ?>

<div class="container">
    <div class="row">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=1"><i class="fa-solid fa-angles-left"></i></a>
                </li>

                <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-chevron-left"></i></a>
                </li>

                <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                    if ($i >= 1 and $i <= $totalPages) :
                ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                <?php endif;
                endfor; ?>
                <li class="page-item  <?= $totalPages == $page ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-chevron-right"></i></a>
                </li>
                <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $totalPages ?>"><i class="fa-solid fa-angles-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col"><i class="fa-solid fa-trash"></i></th>
                    <th scope="col">#</th>
                    <th scope="col">姓名</th>
                    <th scope="col">email</th>
                    <th scope="col">手機</th>
                    <th scope="col">生日</th>
                    <th scope="col">地址</th>
                    <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><a href="#"><i class="fa-solid fa-trash"></i></a></td>
                        <td><?= $r['member_name'] ?></td>
                        <td><?= $r['email'] ?></td>
                        <td><?= $r['password'] ?></td>
                        <td><?= $r['images'] ?></td>
                        <td><?= $r['member_birth'] ?></td>
                        <td><?= $r['location'] ?></td>
                        <td><a href="#"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include './parts/scripts.php'; ?>

<script>
    document.querySelector('li.page-item.active a').removeAttribute('href');
</script>

<?php include './parts/html-foot.php'; ?>