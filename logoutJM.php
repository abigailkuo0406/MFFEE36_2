<?php

session_start();

unset($_SESSION['admin']);

header('Location: index_.php');
