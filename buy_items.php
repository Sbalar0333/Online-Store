<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'cart.php';
require_once 'header.php';

$product = new Product();
$items = $product->getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  
    
    <link rel="stylesheet" href="./css/buy_items.css">
</head>
<body>
<div class="container">
    <div class="row">
        <?php if (!empty($items)):?>
            <?php foreach ($items as $row): ?>
                <div class="col-md-3 product-card">
                    <div class="card">
                        <img src="product/<?php echo $row['image']; ?>" class="card-img-top product-image" alt="<?php echo $row['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><strong>Price:</strong> <?php echo $row['price']; ?> ₹</p>
                          
                            <button class="btn btn-primary buy-btn" 
                                    data-id="<?php echo $row['item_id']; ?>" 
                                    data-name="<?php echo $row['name']; ?>" 
                                    data-price="<?php echo $row['price']; ?>">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No items available for purchase.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    

jQuery(document).ready(function($) {
    let count = 0;

   
    jQuery('.buy-btn').click(function() {
        let itemId = jQuery(this).data('id');
        let itemName = jQuery(this).data('name');
        let itemPrice = jQuery(this).data('price');
        let itemDescription = jQuery(this).data('description');
        let itemPhoto = jQuery(this).data('photo');

        count++;
        jQuery('.count').text(count);


        $.ajax({
            url: 'update_cart.php',
            type: 'POST',
            data: {
                item_id: itemId, 
                name: itemName,
                price: itemPrice,
                description: itemDescription,
                photo: itemPhoto
            },
            success: function(response) {
                alert('Item added to cart');
            },
            error: function(xhr, status, error) {
                console.error('Error occurred: ' + error);
            }
        });
        
    });
});
</script>

<?php include 'footer.php'; ?>
</body>
</html>
