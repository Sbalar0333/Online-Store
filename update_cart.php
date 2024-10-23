<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['item_id']; 
    $itemFound = false;

    foreach ($_SESSION['cart'] as $key => $cartItem) {
        if ($cartItem['id'] === $itemId) 
        {
            if (isset($_SESSION['cart'][$key]['quantity'])) {
                $_SESSION['cart'][$key]['quantity'] += 1;
            } else {
                $_SESSION['cart'][$key]['quantity'] = 2; 
            }
            $itemFound = true;
            break;
        }
       
    }
    if (!$itemFound) {
      
        $item = array(
            'id' => $_POST['item_id'], 
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'photo' => $_POST['photo'],
            'quantity' => 1 
        );
        array_push($_SESSION['cart'], $item);
    }
    
    echo "Item added successfully";
}

?>