<?php include './parts/head.php' ?>
<title>Test for Layout</title> <!-- 網頁標題可自行修改-->
<style>
    /* table>thead>tr>th:nth-child(1) {
        width: 6%;
    }

    table>thead>tr>th:nth-child(2) {
        width: 8%;
    } */

    table>thead>tr>th:nth-child(6) {
        width: 6%;
    }

    /* table>thead>tr>th:nth-child(4) {
        width: 8%;
    }

    table>thead>tr>th:nth-child(7) {
        width: 40%;
    } */
</style>
</head>

<body>

    <?php include './parts/navbar.php' ?>
    <div class="main_screen d-flex justify-content-between">
        <button id="OffcanvasNav" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-caret-right"></i></button>

        <?php include './parts/john_parts/back/list-admin.php' ?>
        <!-- 路徑可自行修改-->
    </div>

    <script>
        //可自行修改JS
    </script>
    <?php include './parts/foot.php' ?>