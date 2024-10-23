<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/footer.css"> 
    <link href="https://kit.fontawesome.com/a076d05399.js"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">    
</head>
<body>
<footer class="bg-dark text-white mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-3">
                <h5>About Us</h5>
                <p>MyWebsite is a platform where we provide exceptional services to our customers.</p>
            </div>
            <div class="col-md-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Home</a></li>
                    <li><a href="#" class="text-white">About</a></li>
                    <li><a href="#" class="text-white">Services</a></li>
                    <li><a href="#" class="text-white">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Follow Us</h5>
                <a href="#" class="text-white mr-2"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="text-white mr-2"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="text-white mr-2"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="text-white mr-2"><i class="fa-brands fa-linkedin"></i></a>
            </div>
            <div class="col-md-3">
                <h5>Newsletter</h5>
                <form action="subscribe.php" method="POST">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
    <div class="text-center py-3">
        <p>&copy; 2024 MyWebsite. All Rights Reserved.</p>
    </div>
</footer>
<!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>