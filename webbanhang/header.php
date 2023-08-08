<?php
// Thực hiện truy vấn SQL để lấy số lượng sản phẩm trong wishlist và giỏ hàng từ CSDL
include 'connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <!--box icon link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"></script>
    <title>admin header</title>
</head>

<body>
    <header class="header">
        <div class="flex">
            <a href="index.php" class="logo"><img width="70px" height="70px" src="image/sbtclogo.png"></a>
            <nav class="navbar">
                <!-- <a class="activemenu" href="index.php">home</a>
                <a href="about.php">about us</a>
                <a href="shop.php">shop</a>
                <a href="hoadon.php">order</a>
                <a href="lienhe.php">contact</a> -->
                <a href="index.php" class="<?php if($page=="home"){echo 'activemenu';} ?>">Trang Chủ</a>
                <a href="about.php" class="<?php if($page=="about"){echo 'activemenu';} ?>">Về Chúng Tôi</a>
                <a href="shop.php" class="<?php if($page=="shop"){echo 'activemenu';} ?>">Cửa Hàng</a>
                <a href="hoadon.php" class="<?php if($page=="hoadon"){echo 'activemenu';} ?>">Hóa Đơn</a>
                <a href="lienhe.php" class="<?php if($page=="lienhe"){echo 'activemenu';} ?>">Liên Hệ</a>


            </nav>
            <div class="icons">
                <i class="fa-regular fa-user" id="user-btn">&emsp;</i>
                <a href="yeuthichlist.php"  ><i id="heart-btn" class="fa-regular fa-heart">&emsp;</i><sup class="sup1" id="wishlist-count"><?php echo $Wishlisht_rows ?></sup></a>
                <a href="giohang.php" ><i id="card-btn" class="fa-sharp fa-solid fa-cart-shopping">&emsp;</i><sup class="sup2" id="cart-count"><?php echo $cart_rows ?></sup></a>
                <i class="fa-sharp fa-solid fa-bars" id="menu-btn">&emsp;</i>
            </div>
            <div class="user-box">
                <p> username : <span><?php echo $_SESSION['user_name']; ?></span>
                <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <form method="post">
                    <button type="submit" class="logout" name="logout-btn">log out</button>
                </form>
            </div>
        </div>
    </header>

    <style>
        .navbar a.activemenu{
    color: var(--orange);
}
    </style>
    <!-- Active Menu -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.navbar a',function(){
            $(this).addClass('activemenu').siblings().removeClass('activemenu')
        })
    </script> -->
    <!-- Active Menu -->
</body>

</html>