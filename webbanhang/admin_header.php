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
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"></script>
    <title>admin header</title>
</head>

<body>
    <header class="header">
        <div class="flex">
            <a href="admin_pannel.php" class="logo"><img width="70px" height="70px" src="image/sbtclogo.png"></a>
            <nav class="navbarr">
                <!-- <a class="activemenu" href="index.php">home</a>
                <a href="about.php">about us</a>
                <a href="shop.php">shop</a>
                <a href="hoadon.php">order</a>
                <a href="lienhe.php">contact</a> -->
                <a href="admin_pannel.php" class="<?php if($page=="adminpannel"){echo 'activemenu';} ?>">Trang Chủ</a>
                <a href="admin_sanpham.php" class="<?php if($page=="adminsanpham"){echo 'activemenu';} ?>">Sản Phẩm</a>
                <a href="admin_order.php" class="<?php if($page=="adminorder"){echo 'activemenu';} ?>">Đơn Hàng</a>
                <a href="admin_user.php" class="<?php if($page=="adminuser"){echo 'activemenu';} ?>">Người Dùng</a>
                <a href="admin_tinnhan.php" class="<?php if($page=="admintinnhan"){echo 'activemenu';} ?>">Lời Nhắn</a>


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