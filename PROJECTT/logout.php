<?php
require 'auth.php';

if (isLoggedIn()) {
    logout();
    header('Location: index.php');
    exit;
} else {
    header('Location: index.php');
    exit;
}
