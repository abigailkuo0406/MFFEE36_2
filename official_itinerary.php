<?php include './parts/head.php' ?>
<title>Test for Layout</title><!-- 網頁標題可自行修改-->
<style>
    /* CSS可以自行修改 */
</style>
</head>

<body>
    <div style="margin:0 auto; border:2px solid blacker;">
        <form action="">
            <h3 style="text-align:center;">官方行程</h3>
            <label for=""></label>
            <input type="text" placeholder="人數">
            <label for=""></label>
            <input type="text" placeholder="價格">
            <label for=""></label>
            <input type="text" placeholder="旅遊地點">
            <label for=""></label>
            <input type="text" placeholder="旅遊類型">
            <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <?php include './parts/navbar.php' ?>
    <div class="main_screen d-flex justify-content-between">
        <button id="OffcanvasNav" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-caret-right"></i></button>

        <?php include './parts/tsao_parts/index.php' ?> <!-- 路徑可自行修改-->
    </div>

    <script>
        //可自行修改JS
    </script>
    <?php include './parts/foot.php' ?>