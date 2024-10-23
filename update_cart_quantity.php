<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST['index']; // The index of the item in the cart array
    $newQuantity = $_POST['quantity']; // The new quantity

    // Check if the index is valid
    if (isset($_SESSION['cart'][$index])) {
        $_SESSION['cart'][$index]['quantity'] = $newQuantity; // Update the quantity
        echo "Quantity updated successfully";
    } else {
        echo "Item not found in the cart";
    }
}
?>
