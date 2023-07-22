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
//update so luong
if(isset($_POST['update_qty_btn']))
{
    $update_qty_id=$_POST['update_qty_id'];
    $update_value=$_POST['update_qty'];
    $update_qty=mysqli_query($conn,"UPDATE `cart` SET quantity ='$update_value' WHERE id = '$update_qty_id' ") or die('query failed');
    if($update_qty)
    {
        header('location:cart.php');
    }
}
// if (isset($_POST['add_to_cart'])) {
//     $cart_id = $_POST['product_id'];
//     $cart_name = $_POST['product_name'];
//     $cart_price = $_POST['product_price'];
//     $cart_image = $_POST['product_img'];
//     $cart_quantity = 1;

//     $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$cart_name' AND use_id ='$user_id'") or die('query failed');
//     if (mysqli_num_rows($select_cart) > 0) {
//         $messege[] = 'product had already in cartory';
//     } else {
//         mysqli_query($conn, "INSERT INTO `cart`( `use_id`, `pid`, `name`, `price`, `quantity`,`image`) VALUES ('$user_id','$cart_id','$cart_name','$cart_price','  $cart_quantity','$cart_image')") or die('query failed');
//         $messege[] = 'successfully';
//     }
// }
if(isset($_GET['delete']))
{
    $delete_id = $_GET['delete'];
   
     mysqli_query($conn,"DELETE FROM `cart` WHERE id='$delete_id'") or die('query failed');
     header('location:cart.php');
}
if(isset($_GET['delete_all']))
{
   
   
     mysqli_query($conn,"DELETE FROM `cart` WHERE use_id = '$user_id'") or die('query failed');
     header('location:cart.php');
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
    <h1>my cart</h1>
    <p>Lorem ipsum dolor sit amet, consectetuc adipisicing elit, tempr.</p>
    <a href="index.php" >home</a><span>/cart</span>
    </div>
</div>
    
    

    <section class="shop">
        <div class="line2"></div>
        <h1 class="title">products added in cart</h1>
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
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` ") or die('query failed');
            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {

            ?>
                    <div class="box">
                    <div class="icon">
                            <a href="viewproduct.php?pid=<?php echo $fetch_cart['pid'] ?>"  class="fa-sharp fa-solid fa-eye"></a>
                            <a href="cart.php?delete=<?php echo $fetch_cart['id'] ?>" class="fa-sharp fa-solid fa-trash-can" onclick="return confirm('do you want delete all item in cart')" ></a>
                            <button type="submit" name="add_to_cart" class="fa-sharp fa-solid fa-cart-shopping"></button>
                        </div>
                        <img src="image/<?php echo $fetch_cart['image']; ?>">
                        <div class="price">$<?php echo $fetch_cart['price']; ?>/-</div>
                        <div class="name"><?php echo $fetch_cart['name'] ;?></div>
                        <form method="post">
                            <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>">
                            <div class="qty">
                            <input type="number" name="update_qty" min="1" value="<?php echo $fetch_cart['quantity'];?>">
                            <input type="submit"name="update_qty_btn" value="update">
                            </div>
                        </form>
                       <div class="total_amt">
                        Total Amount : <span><?php echo $total_amt=($fetch_cart['price']*$fetch_cart['quantity']) ?></span> 
                       </div>
                </div>
            <?php
            $grand_total+=$total_amt;
                }
            } else {
                echo '<p class="empty"> no products added yet!</p>';
            }
            ?>
        </div>
        <div class="dlt">
        <a href="cart.php?delete_all" class="btn2" onclick="return confirm('do you want delete all item in cartlist')" >delete all</a>
        </div>
        <div class="wishlist_total">
         <p>total amount payable : <span>$<?php echo $grand_total; ?></span></p>
         <a href="shop.php" class="btn" >continue shoping</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total>1)?'':'disabled'?>" >check out</a>
        </div>
    </section>
      
    <div class="line4"></div>
    <?php include 'footer.php';  ?>
    <script src="./script2.js"></script>
</body>

</html>