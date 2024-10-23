<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'User.php';
require_once 'header.php';

$user = new User();
$user_id = $_SESSION['user_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $photo = "";
    
  
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $target_dir = "upload/";
        $file_name = basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . uniqid() . "_" . $file_name;
        
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo = $target_file; 
        } else {
            echo "<script>alert('Error uploading the file.');</script>";
        }
    }
    
 
    if (empty($photo)) {
        $userDetails = $user->getProfile($user_id);
        $photo = $userDetails['photo']; 
    }
    

    $user->updateProfile($user_id, $_POST['name'],$_POST['email'], $_POST['mobile_number'], $_POST['gender'],$_POST['city_name'], $_POST['pin_code'], $_POST['user_type'], $photo);
    echo "<script>alert('Profile updated successfully!');</script>";
}


$userDetails = $user->getProfile($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href='./css/profile.css'>
</head>
<body>
<div class="form-container">
    <h2>User Profile</h2>
    <form action="profile.php" method="POST" enctype="multipart/form-data">
        <img src="<?php echo htmlspecialchars($userDetails['photo']); ?>" class="profile-photo" alt="Profile Photo">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="<?php echo htmlspecialchars($userDetails['name']); ?>" readonly></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" value="<?php echo htmlspecialchars($userDetails['email']); ?>" readonly></td>
            </tr>
            <tr>
                <td>Mobile Number:</td>
                <td><input type="text" name="mobile_number" value="<?php echo htmlspecialchars($userDetails['mobile_number']); ?>" readonly></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>
                    <select name="gender" disabled>
                        <option value="male" <?php echo ($userDetails['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo ($userDetails['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                        <option value="other" <?php echo ($userDetails['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>City:</td>
                <td><input type="text" name="city_name" value="<?php echo htmlspecialchars($userDetails['city_name']); ?>" readonly></td>
            </tr>
            <tr>
                <td>PIN Code:</td>
                <td><input type="text" name="pin_code" value="<?php echo htmlspecialchars($userDetails['pin_code']); ?>" readonly></td>
            </tr>
            <tr>
                <td>User Type:</td>
                <td>
                    <select name="user_type" disabled>
                        <option value="Seller" <?php echo ($userDetails['user_type'] == 'Seller') ? 'selected' : ''; ?>>Seller</option>
                        <option value="Customer" <?php echo ($userDetails['user_type'] == 'Customer') ? 'selected' : ''; ?>>Customer</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Profile Photo:</td>
                <td><input type="file" name="photo"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="button" id="edit-btn" value="Edit Profile" onclick="enableEditAll()">
                    <input type="submit" value="Update Profile" style="display:none;" id="update-btn">
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
function enableEditAll() {
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], select');
    inputs.forEach(input => input.readOnly = false);
    document.querySelector('select[name="user_type"]').disabled = false;
    document.querySelector('select[name="gender"]').disabled = false;
    document.getElementById('edit-btn').style.display = 'none';
    document.getElementById('update-btn').style.display = 'block'; 
}
</script>
<?php include 'footer.php'; ?>
</body>
</html>
