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
if(isset($_POST['submit-btn']))
{   
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);

    $filter_subject = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $subject = mysqli_real_escape_string($conn, $filter_subject);

    $filter_message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $message = mysqli_real_escape_string($conn, $filter_message);
     
    $select_message = mysqli_query($conn,"SELECT * FROM `message` WHERE email = '$email' AND name ='$name' AND number ='$subject' AND message = '$message' ") or die('query failed');
    if($row = mysqli_num_rows($select_message)>0){

    
    if(empty($_POST['name']) && empty($_POST['email']) &&empty($_POST['subject']) && empty($_POST['message']) )
    {
        $messege [] = 'emty form';
        
    }else{

        $insert_message = mysqli_query($conn,"INSERT INTO `message`(`use_id`, `name`, `email`, `number`, `message`) VALUES ('$user_id','$name','$email','$number','$message')") or die('failed query');
        $messege [] ='send successfully';
    }
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

    <title>shop</title>
</head>

<body>
    <?php include 'header.php';  ?>
   
<div class="banner">
    <div class="detail">
    <h1>my order</h1>
    <p>Lorem ipsum dolor sit amet, consectetuc adipisicing elit, tempr.</p>
    <a href="index.php" >home</a><span>/order</span>
    </div>
</div>
    <div class="line"></div>
    <div class="order-section"> 
        <div class="box-container">
            <?php $select_order=mysqli_query($conn,"SELECT * FROM `order` WHERE use_id = '$user_id' ") or die('query failed');
            if(mysqli_num_rows($select_order)>0){
                while($fetch_orders=mysqli_fetch_assoc($select_order))
                {   
                    ?>
                    <div class="box">
                        <p>placed on: <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                        <p>user name: <span><?php echo $fetch_orders['name']; ?></span> </p>
                        <p>number: <span><?php echo $fetch_orders['number']; ?></span> </p>
                        <p>email: <span><?php echo $fetch_orders['email']; ?></span> </p>
                        <p>adress: <span><?php echo $fetch_orders['adress']; ?></span> </p>
                        <p>user id: <span><?php echo $fetch_orders['use_id']; ?></span> </p>
                        <p>payment method: <span><?php echo $fetch_orders['method']; ?></span> </p>
                        <p>your order: <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                        <p>total price: <span><?php echo $fetch_orders['total_price']; ?></span> </p>
                        <p>payment status: <span><?php echo $fetch_orders['payment_status']; ?></span> </p>
                    </div>
                    
               <?php      
                }
             }else{
                   echo '<div class="empty"><p>no order placed yet!</p></div>';
             }
               ?>
        </div>
    </div>
    <div class="line3"></div>
    <?php include 'footer.php';  ?>
    <script src="./script2.js"></script>
</body>

</html>