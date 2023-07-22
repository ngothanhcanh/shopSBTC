
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
     <!--box icon link-->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" tyle="text/css" href="style.css">
    <title>admin header</title>
</head>
<body>
    <header class="header">
     <div class="flex">
        <a href="admin_pannel.php" class="logo"><img src="img/logo.png"></a>
        <nav class="navbar">
            <a href="admin_pannel.php">home</a>
            <a href="admin_product.php">product</a>
            <a href="admin_order.php">oders</a>
            <a href="admin_user.php">users</a>
            <a href="admin_message.php">message</a>
        </nav>
        <div class="icons">
            <i class="fa-sharp fa-solid fa-user" id="user-btn"> &emsp;</i>
            <i class="fa-sharp fa-solid fa-bars" id="menu-btn" >&emsp;</i>
        
        </div>
        <div class="user-box">
            <p> username : <span><?php echo $_SESSION['admin_name']; ?></span>
            <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <form method="post">
                <button type="submit" class="logout" name="logout-btn">log out</button>
            </form>
        </div>
     </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>admin dashboard</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
        </div>
    </div>
    <div class="line"></div>
</body>
</html>