<?php include './parts/head.php' ?>
    <title>Test for Layout</title>
    <style>

    </style>
</head>
<body>

<?php include './parts/navbar.php' ?>
<div class="main_screen d-flex justify-content-between">
<button id="OffcanvasNav" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-caret-right"></i></button>
<?php include './parts/tsao_parts/tsao_list.php' ?>
</div>

<?php include './parts/foot.php' ?>