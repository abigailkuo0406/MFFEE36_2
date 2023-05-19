<?php

session_start();

if (isset($_SESSION['admin'])) {
    include './parts/john_parts/back/list-admin.php';
} else {
    include './parts/john_parts/back/list-noadmin.php';
}
