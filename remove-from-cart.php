<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST['id'])) {
    $id = $_POST['id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}
?>