<?php
include 'header.php';
include 'Database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$db = new Database();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="container cart-container">
        <h2>Your Cart</h2>
        <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table table-bordered cart-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Cancel to cart</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo "<script>console.log(" . json_encode($_SESSION['cart']) . ");</script>";
                foreach ($_SESSION['cart'] as $index => $cartItem) {
                    $productId = $cartItem['id'];
                    $sql = "SELECT * FROM items WHERE item_id = ?";
                    $stmt = $db->conn->prepare($sql); 
                    $stmt->bind_param("i", $productId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $product = $result->fetch_assoc();

                    if ($product) {
                        echo '
                        <tr data-index="' . $index . '">
                            <td><img src="product/' . $product['image'] . '" class="product-image" alt="' . $product['name'] . '"></td>
                            <td>' . $product['name'] . '</td>
                            <td>' . $product['description'] . '</td>
                            <td>₹' . $product['price'] . '</td>
                            <td>
                                <div class="quantity-controls">
                                    <button class="btn btn-outline-secondary minus-btn">-</button>
                                    <span class="quantity">' . (isset($cartItem['quantity']) ? $cartItem['quantity'] : 1) . '</span>
                                    <button class="btn btn-outline-secondary plus-btn">+</button>
                                </div>
                            </td>
                            <td><button class="btn btn-danger delete-btn">Delete</button></td>
                        </tr>';
                    }

                    $stmt->close();
                }
                ?>
            </tbody>
        </table>
        <button onclick="window.location.href='bill.php';" type="submit" class="btn btn-success">Buy <i class="fa-solid fa-truck"></i></button>
        <?php else: ?>
        <div class="empty-cart">
            <p>Your cart is empty.</p>
        </div>
        <?php endif; ?>
    </div>

    <script>
       jQuery(document).ready(function($) {
        $('.plus-btn').click(function() {
            let $quantitySpan = $(this).siblings('.quantity');
            let quantity = parseInt($quantitySpan.text());
            $quantitySpan.text(quantity + 1);

            let index = $(this).closest('tr').data('index');
            $.ajax({
                url: './update_cart_quantity.php',
                type: 'POST',
                data: {
                    index: index,
                    quantity: quantity + 1
                },
                success: function(response) {
                    console.log('Quantity updated');
                }
            });
        });

        $('.minus-btn').click(function() {
            let $quantitySpan = $(this).siblings('.quantity');
            let quantity = parseInt($quantitySpan.text());
            if (quantity > 1) {
                $quantitySpan.text(quantity - 1);
                let index = $(this).closest('tr').data('index');
                $.ajax({
                    url: './update_cart_quantity.php',
                    type: 'POST',
                    data: {
                        index: index,
                        quantity: quantity - 1
                    },
                    success: function(response) {
                        console.log('Quantity updated');
                    }
                });
            }
        });

        $('.delete-btn').click(function() {
            let index = $(this).closest('tr').data('index');
            $.ajax({
                url: './delete_from_cart.php',
                type: 'POST',
                data: { index: index },
                success: function(response) {
                    location.reload();
                }
            });
        });
    });
    </script>

</body>
</html>

<?php include 'footer.php'; ?>
