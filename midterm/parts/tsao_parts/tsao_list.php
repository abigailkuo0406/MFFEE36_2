<?php
$pageName = 'list';
$title = '列表';
include './parts/connect-db.php';


$perPage = 20; #每頁最多幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; #用戶要看第幾頁，強制轉int為了不讓人拿字串亂試網址

if($page < 1) {
    header('location: ? page = 1'); //在瀏覽器檢視網頁狀態302是指轉向
    exit; // 結束所有code，因為已經要轉跳了，瀏覽器執行下面所有的程式碼是沒有意義的
}

$t_sql = "SELECT COUNT(1) FROM address_book"; // COUNT(1) 得到一筆資料
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; # 總筆數 #fetch(PDO::FETCH_NUM)[0] 第一欄
$totalPages = ceil($totalRows / $perPage); # 總頁數

if($totalRows){ // 如果有資料沒空白
  //$totalPages = ceil($totalRows / $perPage); # 
  if ($page > $totalPages) { //如果頁碼大於總頁碼，則跳到最大頁碼
    header("Location: ?page=$totalPages");
    exit;
  }

  $sql = sprintf("SELECT * FROM address_book ORDER BY sid DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );
  $rows = $pdo->query($sql)->fetchAll();
}

$row = []; # 如果資料庫空白沒有資料，$row會沒有資料之後的PHP無法取用，故設一個空資料給$row


?>



<div class="container">
<?php include 'tsao_navbar.php' ?>
    <div class="row">
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=1">
        <i class="fa-solid fa-angles-left"></i>
      </a>
    </li>
    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?= $page - 1 ?>">
        <i class="fa-solid fa-angle-left"></i>
      </a>
    </li>
    <?php for($i=$page-5; $i<=$page+5; $i++): 
      if ($i >= 1 and $i <= $totalPages) :  # 讓小於1以及大於總頁數的頁碼不顯示出來
    ?>
        <!--當頁碼$i等於當前頁面時，加上BS屬性 active 讓當前頁碼反白-->
        <li class="page-item <?= $i==$page ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
        </li>
    <?php endif;
    endfor; ?>
    <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
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
    <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
      <th scope="col">#</th>
      <th scope="col">姓名</th>
      <th scope="col">手機</th>
      <th scope="col">email</th>
      <th scope="col">生日</th>
      <th scope="col">地址</th>
      <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($rows as $r): ?>
                <tr>
                    <td>
                      <!--點選快速連到delete.php頁面執行刪除後快速返回此list.php頁面-->
                      <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                        <i class="fa-solid fa-trash-can"></i>
                      </a>
                    </td>
                    <td><?= $r['sid'] ?></td>
                    <td><?= $r['name'] ?></td>
                    <td><?= $r['mobile'] ?></td>
                    <td><?= $r['email'] ?></td>
                    <td><?= $r['birthday'] ?></td>
                    <td><?= htmlentities($r['address']) ?></td>
                    <td>
                    <a href="edit.php?sid=<?= $r['sid'] ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                    </td>
                </tr>
                <?php endforeach; ?>
  </tbody>
</table>
    </div>
</div>



<script>
  document.querySelector('li.page-item.active a').removeAttribute('href'); //用JS寫法將當前頁碼標籤移除連結

    function delete_it(sid) {
      if(confirm(`是否要刪除編號為 ${sid} 的資料?`)){
        location.href = 'delete.php?sid=' + sid;
      }
    }

</script>
