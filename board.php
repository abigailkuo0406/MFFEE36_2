<?php include './parts/head.php' ?>
<title>Who Post?</title> <!-- 網頁標題可自行修改-->
<style>
    /* CSS可以自行修改 */
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

    body {
        font-family: 'Roboto', sans-serif;
    }
</style>
</head>

<body>

    <?php include './parts/navbar.php' ?>
    <div class="main_screen d-flex justify-content-between">
        <button id="OffcanvasNav" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-caret-right"></i></button>

        <?php include './parts/niu_parts/index.php' ?><!-- 路徑可自行修改-->
    </div>

    <script>
        //可自行修改JS
    </script>
    <?php include './parts/foot.php' ?>