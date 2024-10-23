<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href='./css/index.css'>
</head>
<body>

  
<section class="hero">
        <div class="hero-content">
            <h2>Committed to Success</h2>
            <h1>We Care About Your <span class="highlight">Health</span></h1>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <a href="#" class="cta-button">Learn More</a>
        </div>
        <div class="hero-image">
            <img src="./wp8569533-dark-ghost-wallpapers.jpg" alt="Doctor Image">
        </div>
    </section>
    <script src="./common.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>


