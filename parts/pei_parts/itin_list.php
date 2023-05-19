<?php
#MVC
// $pageName = 'list';
// $title = '列表';
require './parts/pei_parts/connect-db.php';

$perPage = 10; # 每頁最多幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; # 用戶要看第幾頁
#抓搜尋欄位的value
$search = isset($_GET['search']) ? $_GET['search'] : null;
$rows = [];

if ($search) {
    $t_sql = sprintf("SELECT COUNT(1) FROM `Itinerary` where member_id='%s'", $search);
    $sql = sprintf("SELECT i.*,i.member_id,m.member_name FROM `Itinerary` i  JOIN `member` m ON i.member_id = m.member_id and i.member_id = '%s' LIMIT %s,%s", $search, ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
} else {

    $t_sql = "SELECT COUNT(1) FROM `Itinerary`";
    $sql = sprintf("SELECT i.*,i.member_id,m.member_name FROM `Itinerary` i  JOIN `member` m ON i.member_id = m.member_id LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}

//計算總筆數
// $t_sql = "SELECT COUNT(1) FROM `Itinerary`";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; //總筆數
$totalPages = ceil($totalRows / $perPage); //總頁數

if ($totalRows) {
    if ($page > $totalPages) {
        header("Location:?page=$totalpages");
        exit;
    }
    //會員資料從會員那張表去做join
    // $sql = sprintf("SELECT i.*,i.member_id,m.member_name FROM `Itinerary` i LEFT JOIN `member` m ON i.member_id = m.member_id LIMIT %s,%s", ($page - 1) * $perPage, $perPage);

}
?>

<div class="container mt-4 ">
    <form class="input-group row row-cols-lg-auto g-3 align-items-center" method="GET">
        <div class="col-12">
            <input name="search" type="text" class="form-control" placeholder="輸入會員編號" value="<?= isset($_GET['search']) ? ($_GET['search']) : null ?>" aria-label="Recipient's username" aria-describedby="submit1">
        </div>
        <div class="col-12">
            <button class="btn btn-outline-secondary" type="submit" id="submit1"><i class="fa-solid fa-magnifying-glass"></i></button>
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
            <div class="row row-cols-lg-auto g-3 align-items-center4">
                <p class="font-monospace fw-normal">共有：<?php echo $totalRows ?> 筆</p>
            </div>
        </nav>
    </div>
    <div class="row">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">行程編號</th>
                    <th scope="col">日期</th>
                    <th scope="col">名稱</th>
                    <th scope="col">說明</th>
                    <th scope="col">公開</th>
                    <th scope="col">會員編號</th>
                    <th scope="col">會員姓名</th>
                    <th scope="col">人數</th>
                    <th scope="col">建立時間</th>
                    <th scope="col"><i class="fa-regular fa-trash-can"></i></th>
                    <th scope="col"><i class="fa-regular fa-pen-to-square"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr class="text-center">
                        <td><?= $r['itin_id'] ?></td>
                        <td><?= $r['date'] ?></td>
                        <td><?= $r['name'] ?></td>
                        <td><?= $r['description'] ?></td>
                        <td><?= $r['public'] ?></td>
                        <td><?= $r['member_id'] ?></td>
                        <td><?= $r['member_name'] ?></td>
                        <td><?= $r['ppl'] ?></td>
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