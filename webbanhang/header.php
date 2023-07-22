<?php include 'connection.php'  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
     <!--box icon link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>admin header</title>
</head>
<body>
    <header class="header">
     <div class="flex">
        <a href="admin_pannel.php" class="logo"><img width="70px" height="70px" src="image/sbtclogo.png"></a>
        <nav class="navbar">
            <a class="activemenu" href="index.php">home</a>
            <a href="about.php">about us</a>
            <a href="shop.php">shop</a>
            <a href="order.php">order</a>
            <a href="contract.php">contract</a>
        
        </nav>
        <div class="icons">
        <i class="fa-regular fa-user" id="user-btn">&emsp;</i>
            <?php $select_wishlist=mysqli_query($conn,"SELECT * FROM `wishlist` WHERE use_id='$user_id'") or die('query failed');
             $Wishlisht_rows = mysqli_num_rows($select_wishlist);
            ?>
            <a href="wishlist.php" ><i id="heart-btn" class="fa-regular fa-heart">&emsp;</i><sup class="sup1"><?php echo $Wishlisht_rows ?></sup></a>
            <?php $select_cart=mysqli_query($conn,"SELECT * FROM `cart` WHERE use_id='$user_id'") or die('query failed');
             $cart_rows = mysqli_num_rows($select_cart);
            ?>
            <a href="cart.php"><i id="card-btn" class="fa-sharp fa-solid fa-cart-shopping" >&emsp;</i><sup class="sup2"><?php echo $cart_rows ?></sup></a>
            <i class="fa-sharp fa-solid fa-bars" id="menu-btn" >&emsp;</i>
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