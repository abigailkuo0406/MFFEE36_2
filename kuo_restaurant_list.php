<?php include './parts/head.php' ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<title>餐廳管理</title><!-- 網頁標題可自行修改-->
<style>
    table>thead>tr>th:nth-child(1) {
        width: 5%;
    }
    table>thead>tr>th:nth-child(2) {
        width: 8%;
    }
    table>thead>tr>th:nth-child(3) {
        width: 4%;
    }
    table>thead>tr>th:nth-child(4) {
        width: 8%;
    }
    table>thead>tr>th:nth-child(7) {
        width: 40%;
    }

</style>
</head>

<body>

    <?php include './parts/navbar.php' ?>
    <div class="main_screen d-flex justify-content-between">
        <button id="OffcanvasNav" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-caret-right"></i></button>

        <?php include './parts/kuo_parts/restaurant_list.php' ?> <!-- 路徑可自行修改-->
    </div>

    <script>

    </script>
    <?php include './parts/foot.php' ?>