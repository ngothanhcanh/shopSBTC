
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
        <a href="admin_pannel.php" class="logo"><img width="70px" height="70px" src="image/sbtclogo.png"></a>
        <nav class="navbar">
            <a href="admin_pannel.php">home</a>
            <a href="admin_sanpham.php">product</a>
            <a href="admin_order.php">oders</a>
            <a href="admin_user.php">users</a>
            <a href="admin_tinnhan.php">message</a>
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
            <h1>Trang Quản Lý</h1>
            <p>Để có website uy tính chất lượng liên hệ chúng tôi ngay!<a href="https://www.facebook.com/ngothanhcanh02"><i class="fa-brands fa-facebook"></i></a></p>
        </div>
    </div>
    <div class="line"></div>
</body>
</html>