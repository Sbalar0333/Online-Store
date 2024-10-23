<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'header.php';
require_once 'cart.php';
require_once 'User.php';


if (!isset($_SESSION['user_id'])) {
    echo "Error: No user ID provided.";
    exit;
}

$user_id = $_SESSION['user_id'];
$address = $_POST['address'];
$state = $_POST['state'];
$payment_method = $_POST['payment_method'];


if (empty($_SESSION['cart'])) {
    echo "Error: Cart is empty.";
    exit;
}

$cart_data = $_SESSION['cart']; 

$product = new Product();


$product->createOrder($user_id, $address, $state, $payment_method, $cart_data);


unset($_SESSION['cart']);

echo "Order placed successfully!";
require_once 'footer.php';
?>

