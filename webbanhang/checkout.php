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
if(isset($_POST['order-btn']))
{
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email= mysqli_real_escape_string($conn,$_POST['email']);
    $number= mysqli_real_escape_string($conn,$_POST['number']);
    $method= mysqli_real_escape_string($conn,$_POST['method']);
    $address= mysqli_real_escape_string($conn,$_POST['flate1'].'-'.$_POST['flate'].'-'.$_POST['city'].'-'.$_POST['state'].'-'.$_POST['country'].' PIN CODE: '.$_POST['pincode']);
    $place_on=date('d-M-Y');
    $cart_total=0;
    $cart_product[]='';
    $cart_query=mysqli_query($conn,"SELECT * FROM `cart` WHERE use_id='$user_id'") or die('query failed');
    if(mysqli_num_rows($cart_query)>0){
       while($cart_item=mysqli_fetch_assoc($cart_query))
       {
        $cart_product[] = $cart_item['name'].' ('.$cart_item['quantity'].')';
        $sub_total = ($cart_item['price']* $cart_item['quantity']);
        $cart_total +=$sub_total;
       }
    }
    $total_products =implode(', ',$cart_product);
    mysqli_query($conn,"INSERT INTO `order` (`use_id`, `name`, `number`, `email`, `method`, `adress`, `total_products`, `total_price`, `placed_on`)
     VALUES ('$user_id','$name','$number','$email','$method','$address','$total_products','$cart_total','$place_on')") or die('query failed');
   mysqli_query($conn,"DELETE FROM `cart` WHERE use_id='$user_id'") or die('query die');
   $messege[] = 'order placed succesfully ';
   header('location:checkout.php');
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
            <h1>my check out</h1>
            <p>Lorem ipsum dolor sit amet, consectetuc adipisicing elit, tempr.</p>
            <a href="index.php">home</a><span>/checkout</span>
        </div>
    </div>
    <div class="line"></div>
    <div class="check-form">
        <h1 class="title">payment process</h1>
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
        <div class="display-order">
            <div class="box-container">
                <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE use_id='$user_id'") or die('query failed');
                $total = 0;
                $grand_total = 0;
                if (mysqli_num_rows($select_cart) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                        $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                        $grand_total = $total += $total_price;

                ?>

                        <div class="box">
                            <img src="image/<?php echo $fetch_cart['image']; ?>">
                            <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity'] ?>)</span>

                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <span class="grand-total">Total Amount Payable: $<?= $grand_total; ?></span>

        </div>
        <form method="post">
            <div class="input-field">
                <label>your name</label>
                <input type="text" name="name" placeholder="enater your name">
            </div>
            <div class="input-field">
                <label>your number</label>
                <input type="text" name="number" placeholder="enater your number">
            </div>
            <div class="input-field">
                <label>your email</label>
                <input type="text" name="email" placeholder="enater your email">
            </div>
            <div class="input-field">
                <label>select payment method</label>
                <select name="method">
                    <option disabled selected>select payment method</option>
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit card">credit card</option>
                    <option value="paytm">pay atm</option>
                    <option value="paypal">paypal</option>
                </select>
            </div>
            <div class="input-field">
                <label>address line 1</label>
                <input type="text" name="flate1" placeholder="e.g  ">
            </div>
            <div class="input-field">
                <label>address line 2</label>
                <input type="text" name="flate" placeholder="e.g street name">
            </div>
            <div class="input-field">
                <label>city</label>
                <input type="text" name="city" placeholder="e.g Phan Thiet ">
            </div>
            <div class="input-field">
                <label> state</label>
                <input type="text" name="state" placeholder="e.g">
            </div>
            <div class="input-field">
                <label> country</label>
                <input type="text" name="country" placeholder="e.g Viet Nam">
            </div>
            <div class="input-field">
                <label> pin code</label>
                <input type="text" name="pincode" placeholder="e.g 7000">
            </div>
            <input type="submit" name="order-btn" class="btn" value="order now">
        </form>
    </div>
    <div class="line3"></div>
    <?php include 'footer.php';  ?>
    <script src="./script2.js"></script>
</body>

</html>