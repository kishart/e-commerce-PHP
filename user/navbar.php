
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/navbar.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

</head>
<body>
    <header>
       <div class="nav">
            <div class="nav-left">
                <h2><span class="material-symbols-outlined">
shopping_bag_speed
</span>
e-commerce</h2>

            </div>
            <div class="nav-center">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="/e-commerce-PHP/user/shop.php">Shop</a></li>
                    <li><a href="/e-commerce-PHP/user/about.php">About</a></li>
                    <li><a href="/e-commerce-PHP/user/contact.php">Contact</a></li>
                </ul>
                
            </div>
            <div class="nav-right">
   <?php if (isset($_SESSION['username'])): ?>
                    <div class="account-menu">
                        <span style="font-size: 40px; cursor: pointer;" class="material-symbols-outlined">
                            account_circle
                        </span>
                        <div class="dropdown">
                            <a href="/e-commerce-PHP/user/profile.php">Profile</a>
                            <a href="/e-commerce-PHP/logout.php">Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/e-commerce-PHP/login.php">
                        <span style="font-size: 40px;" class="material-symbols-outlined">account_circle</span>
                    </a>
                <?php endif; ?>

            </div>
       </div>
    </header>
</body>
</html>