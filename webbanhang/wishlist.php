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

if (isset($_POST['add_to_cart'])) {
    $cart_pid = $_POST['product_pid'];
    $cart_name = $_POST['product_name'];
    $cart_price = $_POST['product_price'];
    $cart_image = $_POST['product_img'];
    $cart_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$cart_name' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_cart) > 0) {
        $messege[] = 'product had already in cartory';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`( `use_id`, `pid`, `name`, `price`, `quantity`,`image`) VALUES ('$user_id','$cart_pid','$cart_name','$cart_price','  $cart_quantity','$cart_image')") or die('query failed');
        $messege[] = 'successfully';
    }
}
if(isset($_GET['delete']))
{
    $delete_id = $_GET['delete'];
   
     mysqli_query($conn,"DELETE FROM `wishlist` WHERE id='$delete_id'") or die('query failed');
     header('location:wishlist.php');
}
if(isset($_GET['delete_all']))
{
   
   
     mysqli_query($conn,"DELETE FROM `wishlist` WHERE use_id = '$user_id'") or die('query failed');
     header('location:wishlist.php');
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

    <title>shop</title>
</head>

<body>
    <?php include 'header.php';  ?>
<div class="banner">
    <div class="detail">
    <h1>my wishlist</h1>
    <p>Lorem ipsum dolor sit amet, consectetuc adipisicing elit, tempr.</p>
    <a href="index.php" >home</a><span>/wishlist</span>
    </div>
</div>
    
    

    <section class="shop">
        <div class="line2"></div>
        <h1 class="title">products added in wishlist</h1>
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

        
         <div class="box-container">
            <?php
            $grand_total=0;
            $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` ") or die('query failed');
            if (mysqli_num_rows($select_wishlist) > 0) {
                while ($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)) {

            ?>
                    <form method="post" class="box">
                        <img src="image/<?php echo $fetch_wishlist['image']; ?>">
                        <div class="price">$<?php echo $fetch_wishlist['price']; ?>/-</div>
                        <div class="name"><?php echo $fetch_wishlist['name'] ?></div>
                        <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['id'] ?>">
                        <input type="hidden" name="product_pid" value="<?php echo $fetch_wishlist['pid'] ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name'] ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price'] ?>">
                       
                        <input type="hidden" name="product_img" value="<?php echo $fetch_wishlist['image'] ?>">
                        <div class="icon">
                            <a href="viewproduct.php?pid=<?php echo $fetch_wishlist['pid'] ?>"  class="fa-sharp fa-solid fa-eye"></a>
                            <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id'] ?>" class="fa-sharp fa-solid fa-trash-can" onclick="return confirm('do you want delete all item in wishlist')" ></a>
                            <button type="submit" name="add_to_cart" class="fa-sharp fa-solid fa-cart-shopping"></button>
                        </div>
                    </form>
            <?php
            $grand_total+=$fetch_wishlist['price'];
                }
            } else {
                echo '<p class="empty"> no products added yet!</p>';
            }
            ?>
        </div>
        <div class="wishlist_total">
         <p>total amount payable : <span>$<?php echo $grand_total; ?></span></p>
         <a href="shop.php" class="btn" >continue shoping</a>
         <a href="wishlist.php?delete_all" class="btn <?php echo ($grand_total)?'':'disabled'?>" onclick="return confirm('do you want delete all item in wishlist')" >delete all</a>
        </div>
    </section>
      
    <div class="line4"></div>
    <?php include 'footer.php';  ?>
    <script src="./script2.js"></script>
</body>

</html>