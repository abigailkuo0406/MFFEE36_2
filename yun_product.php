<?php include './parts/head.php' ?>
<title>Product Page</title><!-- 網頁標題可自行修改-->
<style>
    /* CSS可以自行修改 */
</style>
</head>
<body>

    <?php include './parts/navbar.php' ?>
    <div class="main_screen d-flex flex-row">
        <button id="OffcanvasNav" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-caret-right"></i></button>
        <div class="d-flex flex-column w-100">
            <?php include './parts/yun_parts/yun_product_list.php' ?> <!-- 路徑可自行修改-->
        </div>
    </div>

    <script>
//
    </script>
    <?php include './parts/foot.php' ?>