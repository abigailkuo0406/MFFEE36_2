<?php include './parts/head.php' ?>
<title>Order Page</title><!-- 網頁標題可自行修改-->
<style>
    table>thead>tr>th:nth-child(1) {
        width: 2%;
    }
    table>thead>tr>th:nth-child(2) {
        width: 2%;
    }
    table>thead>tr>th:nth-child(3),table>thead>tr>th:nth-child(4) {
        width: 5%;
    }
    table>thead>tr>th:nth-child(15),table>thead>tr>th:nth-child(16),table>thead>tr>th:nth-child(17) {
        width: 5%;
    }
   
</style>
</head>
<body>

    <?php include './parts/navbar.php' ?>
    <div class="main_screen d-flex justify-content-between">
        <button id="OffcanvasNav" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-caret-right"></i></button>
        <div class="d-flex flex-column w-100 mt-5">
            <?php include './parts/yun_parts/yun_order_list.php' ?> <!-- 路徑可自行修改-->
        </div>
    </div>

    <script>
        //可自行修改JS//
    </script>
    <?php include './parts/foot.php' ?>