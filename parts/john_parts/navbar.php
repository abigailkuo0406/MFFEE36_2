<!-- <?php
        // if (!isset($pageName)) {
        //     $pageName = '';
        // }
        ?> -->
<!-- <?php
        // if (!isset($pageName)) :
        // $pageName = ''; 
        ?>
<?php
// endif; 
?> -->
<style>
    nav.navbar .nav-link.active {
        background-color: blue;
        border-radius: 10px;
        color: white;
        font-weight: 800;
    }
</style>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index_.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'list' ? 'active' : ' ' ?> " href="list.php">列表</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'add' ? 'active' : ' ' ?>" href="add.php">新增</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>