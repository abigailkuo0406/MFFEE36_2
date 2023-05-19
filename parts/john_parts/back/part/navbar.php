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

    #intro {
        background-image: url("./imgs/logo/logo.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        width: 100%;
        height: 85vh;


    }
</style>
<div class="container">
    <div class="navbar navbar-expand-lg bg-body-tertiary mb-5">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse  d-flex justify-content-end" id="navbarSupportedContent">

                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['admin'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link"><?= $_SESSION['admin']['name'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logoutJM.php">登出</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="loginJM.php">登入</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">註冊</a>
                        </li>
                    <?php endif; ?>

                </ul>
                <!-- </div> -->
            </div>
        </div>
    </div>