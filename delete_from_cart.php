<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST['index'];


    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]); 
        
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        echo "Product removed successfully";
    } else {
        echo "Item not found in the cart";
    }
}
?>
