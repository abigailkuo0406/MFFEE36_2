<?php
# MVC
$pageName = 'list';
$title = '列表';

require './parts/john_parts/back/part/connect-db.php';
#require './parts/john_parts/back/part/html-head.php';

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

// search

$queryString = isset($_GET['keyword']) ? strval($_GET['keyword']) : '';

if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
    $sql = "SELECT * FROM `member` WHERE`member_id` LIKE '%{$queryString}%' OR `email`LIKE '%{$queryString}%' OR  `password` LIKE '%{$queryString}%' OR  `images` LIKE '%{$queryString}%'OR  `member_name` LIKE '%{$queryString}%'OR  `id_number` LIKE '%{$queryString}%'OR  `gender` LIKE '%{$queryString}%'OR  `location` LIKE '%{$queryString}%'OR  `height` LIKE '%{$queryString}%'OR  `weight` LIKE '%{$queryString}%'OR  `zodiac` LIKE '%{$queryString}%'OR  `bloodtype` LIKE '%{$queryString}%'OR  `smoke` LIKE '%{$queryString}%'OR  `alchohol` LIKE '%{$queryString}%'OR  `education_level` LIKE '%{$queryString}%'OR  `job` LIKE '%{$queryString}%'OR  `profile` LIKE '%{$queryString}%'OR  `mobile` LIKE '%{$queryString}%'OR  `password` LIKE '%{$queryString}%'";
    $rows = $pdo->query($sql)->fetchAll();
}
?>


<div class="container">
    <div class="row">
        <?php include './parts/john_parts/back/part/navbar.php'; ?>

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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    關鍵字找尋
                </button>
            </ul>
        </nav>

        <!-- Modal Search -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">關鍵字找尋</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="ipt1" placeholder="請輸入關鍵字">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button type="button" id="btn1" class="btn btn-primary">執行</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col"><i class="fa-solid fa-trash"></i></th>
                    <th scope="col">ID</th>
                    <th scope="col">帳號</th>
                    <th scope="col">密碼</th>
                    <th scope="col">大頭貼</th>
                    <th scope="col">姓名</th>
                    <th scope="col">生日</th>
                    <th scope="col">身分證密碼</th>
                    <th scope="col">性別</th>
                    <th scope="col">居住地</th>
                    <th scope="col">身高</th>
                    <th scope="col">體重</th>
                    <th scope="col">星座</th>
                    <th scope="col">血型</th>
                    <th scope="col">抽菸</th>
                    <th scope="col">酒量</th>
                    <th scope="col">教育程度</th>
                    <th scope="col">職業</th>
                    <th scope="col">自介</th>
                    <th scope="col">手機</th>
                    <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><a href="javascript: delete_it(<?= $r['member_id'] ?>)"><i class="fa-solid fa-trash"></i></a></td>
                        <td><?= $r['member_id'] ?></td>
                        <td><?= $r['email'] ?></td>
                        <td><?= $r['password'] ?></td>
                        <td><img src='./parts/john_parts/back/imgs/<?= $r['images'] ?>'></td>
                        <td><?= $r['member_name'] ?></td>
                        <td><?= $r['member_birth'] ?></td>
                        <td><?= $r['id_number'] ?></td>
                        <td><?= $r['gender'] ?></td>
                        <td><?= $r['location'] ?></td>
                        <td><?= $r['height'] ?></td>
                        <td><?= $r['weight'] ?></td>
                        <td><?= $r['zodiac'] ?></td>
                        <td><?= $r['bloodtype'] ?></td>
                        <td><?= $r['smoke'] ?></td>
                        <td><?= $r['alchohol'] ?></td>
                        <td><?= $r['education_level'] ?></td>
                        <td><?= $r['job'] ?></td>
                        <td><?= $r['profile'] ?></td>
                        <td><?= $r['mobile'] ?></td>
                        <td><a href="account_edit.php?member_id=<?= $r['member_id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php #include './parts/john_parts/back/part/scripts.php';
?>

<script>
    // const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput');

    // myModal.addEventListener('shown.bs.modal', () => {
    //     myInput.focus();
    // })

    document.querySelector('li.page-item.active a').removeAttribute('href');

    function delete_it(member_id) {
        if (confirm(`是否要刪除編號為 ${member_id} 的資料?`)) {
            location.href = 'account_delete.php?member_id=' + member_id;
        }

    }
    // search_bar
    const search_button = document.getElementById('btn1');
    search_button.addEventListener('click', () => {
        const queryString = document.getElementById("ipt1").value;
        console.log(queryString);
        location.href = 'account.php?keyword=' + queryString;
    })
</script>

<?php #include './parts/john_parts/back/part//html-foot.php';
?>