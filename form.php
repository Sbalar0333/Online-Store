<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'User.php';
require_once 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();
    
    $photo = "";
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $target_dir = "upload/";
        $file_name = basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . uniqid() . "_" . $file_name;
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        $photo = $target_file;
    }
    
    $user->register($_POST['name'], $_POST['email'], $_POST['password'], $_POST['mobile_number'], $_POST['gender'], $_POST['city_name'], $_POST['pin_code'], $_POST['user_type'], $photo);
    echo "<div class='alert alert-success'>Registration successful!</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Form</title>
    <link rel="stylesheet" href='./css/form.css'>
</head>
<body>
<div class="form-container">
    <form id="registrationForm" action="./form.php" method="post" enctype="multipart/form-data">
        <h2>Registration Form</h2>
        <table>
            <tr>
                <td><label for="name">Name</label></td>
                <td><input type="text" id="name" name="name" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" id="password" name="password" required></td>
            </tr>
            <tr>
                <td><label for="Conforme_Password">Conforme Password</label></td>
                <td><input type="password" id="Conforme_Password" name="Conforme_Password" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="passwordError" style="color: red; display: none;">Passwords do not match!</div>
                </td>
            </tr>
            <tr>
                <td><label for="mobile_number">Mobile Number</label></td>
                <td><input type="tel" id="mobile_number" name="mobile_number" required></td>
            </tr>
            <tr>
                <td><label>Gender</label></td>
                <td>
                    <input type="radio" id="male" name="gender" value="male" required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="female" required>
                    <label for="female">Female</label>
                    <input type="radio" id="other" name="gender" value="other" required>
                    <label for="other">Other</label>
                </td>
            </tr>
            <tr>
                <td><label for="city_name">City Name</label></td>
                <td><input type="text" id="city_name" name="city_name" required></td>
            </tr>
            <tr>
                <td><label for="pin_code">PIN Code</label></td>
                <td><input type="text" id="pin_code" name="pin_code" required></td>
            </tr>
            <tr>
                <td><label for="user_type">User Type</label></td>
                <td>
                    <select id="user_type" name="user_type" required>
                        <option value="placeholder" hidden>Select</option>
                        <option value="Seller">Seller</option>
                        <option value="Customer">Customer</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="photo">Passport size Photo</label></td>
                <td><input type="file" id="photo" name="photo" accept="image/*" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Submit">
                </td>
            </tr>
        </table>
    </form>
</div>

<script>

document.getElementById('registrationForm').addEventListener('submit', function(e) {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('Conforme_Password').value;
    var passwordError = document.getElementById('passwordError');

    if (password !== confirmPassword) {
        e.preventDefault();  // Prevent the form from submitting
        passwordError.style.display = 'block';  // Show the error message
    } else {
        passwordError.style.display = 'none';  // Hide the error message
    }
});
</script>

<?php include 'footer.php'; ?>
</body>
</html>
