<?php include './parts/head.php' ?>
<title>Cart Page</title><!-- 網頁標題可自行修改-->
<style>
    /* CSS可以自行修改 */
</style>
</head>
<body>

    <?php include './parts/navbar.php' ?>
    <div class="main_screen d-flex justify-content-between">
        <button id="OffcanvasNav" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-caret-right"></i></button>
        <div class="d-flex flex-column w-100">
            <?php include './parts/yun_parts/yun_cart_navbar.php' ?>
            <?php include './parts/yun_parts/yun_cart_list.php' ?> <!-- 路徑可自行修改-->
        </div>
    </div>

    <script>
        //可自行修改JS//
    </script>
    <?php include './parts/foot.php' ?>