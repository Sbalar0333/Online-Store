
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include 'header.php';
include 'User.php';
include 'cart.php';


if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
} else {
    echo "Error: No user ID provided.";
    exit;
}


$queries = new User();
$user = $queries->getProfile($id);

if (!$user) {
    echo "User not found!";
    exit;
}


$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bill Information</title>
  <link rel="stylesheet" href="./css/bill.css">
</head>
<body>
<div class="container sub-container">
    <div class="form-section">
      <h2>Order Form</h2>
      <form action="order_submit.php" method="post">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" disabled>
        </div>
        <div class="form-group">
          <label for="mobile">Mobile Number:</label>
          <input type="text" name="mobile_number" value="<?= htmlspecialchars($user['mobile_number']) ?>" disabled>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" name="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
        </div>
        <div class="form-group">
          <label for="address">Address:</label>
          <textarea id="address" name="address" rows="3" required></textarea>
        </div>
        <div class="form-group">
          <label for="state">State:</label>
          <input id="state" name="state" required>
        </div>
        <div class="form-group">
          <label for="payment_method">Payment Method:</label>
          <input type="radio" name="payment_method" value="credit Card" required> Credit Card
          <input type="radio" name="payment_method" value="debit Card" required> Debit Card
          <input type="radio" name="payment_method" value="UPI" required> UPI
          <input type="radio" name="payment_method" value="net Banking" required> Net Banking
          <input type="radio" name="payment_method" value="cash on Delivery" required> Cash on Delivery
        </div>
        <button type="submit">Place Order</button>
      </form>
    </div>

    <div class="table-section">
      <h2>Order Summary</h2>
      <table>
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $cgst_rate = 9;
          $sgst_rate = 9;
          $gst_rate = $cgst_rate + $sgst_rate;
          $total_price = 0;

          if (empty($cart)) {
              echo "<tr><td colspan='4'>No items in cart.</td></tr>";
          } else {
              foreach ($cart as $item) {
                  $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 0;
                  $unit_price = isset($item['price']) ? (float)$item['price'] : 0.0;
                  $item_total = $quantity * $unit_price;
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($item['name']) . "</td>";
                  echo "<td>" . $quantity . "</td>";
                  echo "<td>" . number_format($unit_price, 2) . "</td>";
                  echo "<td>" . number_format($item_total, 2) . "</td>";
                  echo "</tr>";
                  $total_price += $item_total;
              }
          }

          $cgst = $total_price * ($cgst_rate / 100);
          $sgst = $total_price * ($sgst_rate / 100);
          $total_gst = $cgst + $sgst;
          $total_with_gst = $total_price + $total_gst;

          echo "<tr><td colspan='3'><strong>Total Price (Excluding GST):</strong></td><td><strong>" . number_format($total_price, 2) . "</strong></td></tr>";
          echo "<tr><td colspan='3'>CGST ({$cgst_rate}%):</td><td>" . number_format($cgst, 2) . "</td></tr>";
          echo "<tr><td colspan='3'>SGST ({$sgst_rate}%):</td><td>" . number_format($sgst, 2) . "</td></tr>";
          echo "<tr><td colspan='3'><strong>Total Price (Including GST):</strong></td><td><strong>" . number_format($total_with_gst, 2) . "</strong></td></tr>";
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
<?php
include 'footer.php';
?>
