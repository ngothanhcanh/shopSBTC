<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
}
if (isset($_POST['logout-btn'])) {
    session_destroy();
    header('location:login.php');
}
if (isset($_POST['add_to_wishlist'])) {
    $Wishlist_id = $_POST['product_id'];
    $Wishlist_name = $_POST['product_name'];
    $Wishlist_price = $_POST['product_price'];
    $Wishlist_image = $_POST['product_img'];
    $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name='$Wishlist_name' AND use_id ='$user_id' ") or die('query failed');
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$Wishlist_name' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_wishlist) > 0) {
        $messege[] = 'wishlist already exist';
    } else if (mysqli_num_rows($select_cart) > 0) {
        $messege[] = 'product had already in cartory';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`( `use_id`, `pid`, `name`, `price`, `image`) VALUES ('$user_id','$Wishlist_id','$Wishlist_name','$Wishlist_price','$Wishlist_image')") or die('query failed');
        $messege[] = 'successfully';
    }
}
if (isset($_POST['add_to_cart'])) {
    $cart_id = $_POST['product_id'];
    $cart_name = $_POST['product_name'];
    $cart_price = $_POST['product_price'];
    $cart_image = $_POST['product_img'];
    $cart_quantity = $_POST['product_quantity'];

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$cart_name' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_cart) > 0) {
        $messege[] = 'product had already in cartory';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`( `use_id`, `pid`, `name`, `price`, `quantity`,`image`) VALUES ('$user_id','$cart_id','$cart_name','$cart_price','  $cart_quantity','$cart_image')") or die('query failed');
        $messege[] = 'successfully';
    }
}
?>
<style type="text/css">
    <?php
    include 'main.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>home page</title>
</head>

<body>
    <?php include 'header.php';  ?>

    <div class="line4"></div>
    <div class="line4"></div>
    <section class="view_page">
        <?php
        if (isset($messege)) {
            foreach ($messege as $messege) {
                echo '<div class="message">
           <span>' . $messege . '</span>
           <i class="click" onclick="this.parentElement.remove()">aa</i>
       </div>';
            }
        }
        ?>

        <?php
        if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];
            $select_pid = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$pid'") or die('query failed');
            if (mysqli_num_rows($select_pid) > 0) {
                while ($fetch_product = mysqli_fetch_assoc($select_pid)) {
        ?>
                    <form method="post">
                         <img src="image/<?php echo $fetch_product['image']; ?>">
                        <div class="detail">
                            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                            <div class="name"><?php echo $fetch_product['name']; ?></div>
                            <div class="detail"><?php echo $fetch_product['product_detail']; ?></div>
                            <input type="hidden" name="product_id" value="<?php echo $fetch_product['id'] ?>">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name'] ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price'] ?>">
                            <input type="hidden" name="product_img" value="<?php echo $fetch_product['image'] ?>">
                            <div class="icon">
                                <button type="submit" name="add_to_wishlist" class="fa-sharp fa-solid fa-heart"></button>
                                <input type="number" name="product_quantity" value="1" min="1" class="quantity">
                                <button type="submit" name="add_to_cart" class="fa-sharp fa-solid fa-cart-shopping"></button>
                            </div>
                        </div>

                    </form>
        <?php
                }
            }
        }
        ?>
    </section>

    <div class="line4"></div>
    <?php include 'footer.php';  ?>
    <script src="./script2.js"></script>
</body>

</html>