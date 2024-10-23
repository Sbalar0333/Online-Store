
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css"> 
    <link href="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <header class="mainclass">
        <div class="container">  
            <nav class="nav-links">
                <a href="./index.php">Home</a>
                <a href="./buy_items.php">Buy Product</a>
                <a href="./add_product.php" class="add_product" id="add_product">Add Product</a>
                <a href="./profile.php" class="profile" id="profile">Profile</a>
                <a href="./carttable.php" class="fa-solid fa-cart-shopping"></a>
                <span class="count">
                    <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                </span>
            </nav>
            <div class="auth-buttons">
                <a href="login.php" class="sign-in" id="sign-in">Sign in</a>
                <a href="form.php" class="sign-up" id="sign-up">Sign up</a>
                <a onclick="window.location.href='logout.php'" class="sign-out" id="sign-out" style="display:none;">Sign out</a>
            </div>
        </div>
    </header>

    <?php
    if (!empty($_SESSION['user_id']) && isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
        echo "<script>
            document.getElementById('sign-up').style.display = 'none';
            document.getElementById('sign-in').style.display = 'none';
            document.getElementById('sign-out').style.display = 'block';
            document.getElementById('profile').style.display = 'block';
        </script>";

        if ($_SESSION['user_type'] === 'Seller') {
            echo "<script>document.getElementById('add_product').style.display = 'block';</script>";
        } else {
            echo "<script>document.getElementById('add_product').style.display = 'none';</script>";
        }
    } else {
        echo "<script>
            document.getElementById('sign-up').style.display = 'block';
            document.getElementById('sign-in').style.display = 'block';
            document.getElementById('sign-out').style.display = 'none';
            document.getElementById('profile').style.display = 'none';
            document.getElementById('add_product').style.display = 'none'
        </script>";
    }
    ?>



    <script src="./common.js"></script>
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
</body>
</html>
