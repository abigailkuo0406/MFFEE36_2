<?php include './parts/head.php' ?>
<title>Product Page</title><!-- 網頁標題可自行修改-->
<style>
    table>thead>tr>th:nth-child(1) {
        width: 2%;
    }
    table>thead>tr>th:nth-child(2) {
        width: 8%;
    }
    table>thead>tr>th:nth-child(6),table>thead>tr>th:nth-child(7) {
        width: 8%;
    }
   
</style>
</head>
<body>

    <?php include './parts/navbar.php' ?>
    <div class="main_screen d-flex flex-row">
        <button id="OffcanvasNav" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-caret-right"></i></button>
        <div class="d-flex flex-column w-100  mt-5">
            <?php include './parts/yun_parts/yun_product_list.php' ?> <!-- 路徑可自行修改-->
        </div>
    </div>

    <script>
//
    </script>
    <?php include './parts/foot.php' ?>