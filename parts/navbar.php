<!-- 組長公告：公用版型，勿動 -->
<nav class="navbar flex-column bg-cus2 offcanvas offcanvas-start show" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel" aria-modal="true" role="dialog">
    <div class="navbar_content w-100">
        <div id="Logo" class="text-cus1 text-center pm-3">
            <div class="w-100 d-flex justify-content-end pe-3 pt-2">
                <button type="button" class="btn-close d-block" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <a>旅遊交友</a>
        </div>

        <ul class="navbar-nav d-flex align-items-center flex-grow-1">
            <!-- 會員中心 -->
            <li class="nav-item dropdown">


                <!-- <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="false">
                        會員中心<br>
                    </a> -->

                <a class="link_btn" href="account.php" role="button">
                    <span class="material-symbols-outlined nav-icon">account_circle</span>
                    會員中心<a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="false"></a>
                </a>

                <!-- <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a> -->
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">興趣資料庫</a></li>
                    <li><a class="dropdown-item" href="#">性格資料庫</a></li>
                    <li><a class="dropdown-item" href="#">社群資料庫</a></li>
                </ul>
            </li>
            <!-- 交友配對 -->
            <li class="nav-item">
                <a href="matching.php" class="link_btn">
                    <span class="material-symbols-outlined nav-icon">person_search</span>
                    <span class="nav-link">交友配對</span>
                </a>
            </li>


            <!-- 自訂行程 -->
            <!-- <li class="nav-item" 待確認是否須保留>   
                <a href="custom_itinerary.php" class="link_btn">
                    <span class="material-symbols-outlined nav-icon">map</span>
                    <span class="nav-link">自訂行程</span>
                </a>
            </li> -->
            <li class="nav-item dropdown">
                <a class="link_btn" href="custom_itinerary.php" role="button">
                    <span class="material-symbols-outlined nav-icon">map</span>
                    自訂行程<a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="false"></a>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./parts/pei_parts/pei_add.php">景點資料庫</a></li>
                    <li><a class="dropdown-item" href="#">自訂行程資料庫</a></li>
                </ul>
            </li>

            <!-- 餐廳 & 票券 -->
            <li class="nav-item">
                <a href="ticket.php" class="link_btn">
                    <span class="material-symbols-outlined nav-icon">local_activity</span>
                    <span class="nav-link">餐廳 & 票券</span>
                </a>
            </li>

            <!-- 官方行程 -->
            <li class="nav-item">
                <a href="official_itinerary.php" class="link_btn">
                    <span class="material-symbols-outlined nav-icon">travel_explore</span>
                    <span class="nav-link">官方行程</span>
                </a>
            </li>
            <!-- 留言板 -->
            <li class="nav-item">
                <a href="board.php" class="link_btn">
                    <span class="material-symbols-outlined nav-icon">mode_comment</span>
                    <span class="nav-link">留言板</span>
                </a>
            </li>

            <!-- 商品資料庫 -->
            <li class="nav-item">
                <a href="product.php" class="link_btn">
                    <span class="material-symbols-outlined nav-icon">local_mall</span>
                    <span class="nav-link">商品資料庫</span>
                </a>
            </li>
            <!-- 購物資料庫 -->
            <li class="nav-item">
                <a href="cart.php" class="link_btn">
                    <span class="material-symbols-outlined nav-icon">shopping_cart</span>
                    <span class="nav-link">購物資料庫</span>
                </a>
            </li>
        </ul>
    </div>
</nav>