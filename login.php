

<?php
session_start();
require_once 'Database.php'; 
require_once 'header.php';

$db = new Database();
$conn = $db->conn; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the login query
    $query = "SELECT * FROM registration WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the result as an associative array

        // Store user details in session
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_type'] = $row['user_type'];

        // Redirect or display success message
        echo "<script>alert('Login successful as " . $row['user_type'] . "');</script>";
        header("Location: index.php"); // Redirect to home page
        exit();
    } else {
        // Handle invalid credentials
        echo "<script>alert('Invalid E-mail and Password!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>
<div class="box">
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <table>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="text" id="email" name="email" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" id="password" name="password" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Login"></td>
                </tr>
            </table>
        </form>
        <div class="register">
            Don't have an account? <a id="register" href="./form.php">Register</a>
        </div>
    </div>
</div>

<script src="./common.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>










