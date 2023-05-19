<?php include './parts/head.php' ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<title>新增餐廳類型</title><!-- 網頁標題可自行修改-->
<style>
    /* CSS可以自行修改 */
    .row {
        display: flex;
        justify-content: center;
        margin-top: 60px;
    }
</style>
</head>

<body>

    <?php include './parts/navbar.php' ?>
    <div class="main_screen d-flex justify-content-between">
        <button id="OffcanvasNav" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-caret-right"></i></button>

        <?php include './parts/kuo_parts/restaurant_class_add.php' ?> <!-- 路徑可自行修改-->
    </div>

    <script>
        //可自行修改JS
    </script>
    <?php include './parts/foot.php' ?>