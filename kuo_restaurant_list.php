<?php include './parts/head.php' ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<title>餐廳管理</title><!-- 網頁標題可自行修改-->
<style>
    /* CSS可以自行修改 */
</style>
</head>

<body>

    <?php include './parts/navbar.php' ?>
    <div class="main_screen d-flex justify-content-between">
        <button id="OffcanvasNav" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-caret-right"></i></button>

        <?php include './parts/kuo_parts/restaurant_list.php' ?> <!-- 路徑可自行修改-->
    </div>

    <script>
        // function deleteData(sid) {
        //     if (confirm(`確認刪除編號${sid}的資料`)) {
        //         location.href = 'restaurant_delete.php?sid=' + sid;
        //     }

        // }
    </script>
    <?php include './parts/foot.php' ?>