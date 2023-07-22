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
    $number = mysqli_real_escape_string($conn, $filter_subject);

    $filter_message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $message = mysqli_real_escape_string($conn, $filter_message);
     
    $select_message = mysqli_query($conn,"SELECT * FROM `message` WHERE email = '$email' AND name ='$name' AND number ='$number' AND message = '$message' ") or die('query failed');
    if($row = mysqli_num_rows($select_message)>0){
      $messege [] ='already message';
    }else{
        $insert_message = mysqli_query($conn,"INSERT INTO `message`(`use_id`, `name`, `email`, `number`, `message`) VALUES ('$user_id','$name','$email','$number','$message')") or die('failed query');
        $messege [] ='send successfully';
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
    <h1>my contract</h1>
    <p>Lorem ipsum dolor sit amet, consectetuc adipisicing elit, tempr.</p>
    <a href="index.php" >home</a><span>/contract</span>
    </div>
</div>
    <div class="line"></div>
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="./img/0.png">
                <div>
                    <h1>Free Shipping Fast</h1>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
            <div class="box">
                <img src="./img/1.png">
                <div>
                    <h1>money back </h1>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
            <div class="box">
                <img src="./img/2.png">
                <div>
                    <h1>Online support 24/7</h1>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line4"></div>
    <div class="form-container">
    <?php 
    if(isset($messege))
   {
       foreach($messege as $messege)
       {
           echo'<div class="message">
           <span>'.$messege.'</span>
           <i class="click" onclick="this.parentElement.remove()">aa</i>
       </div>';
       }
   }
  ?>
        <h1 class="title">leave a message</h1>
        <form method="post">
            <div class="input-field">
                <label>your name</label><br>
                <input type="text" name="name">
            </div>
            <div class="input-field">
                <label>your email</label><br>
                <input type="text" name="email">
            </div>
            <div class="input-field">
                <label>phone number</label><br>
                <input type="number" name="number">
            </div>
            <div class="input-field">
                <label>message</label><br>
                <textarea name="message"></textarea>
            </div>
            <button type="submit" name="submit-btn">send message</button>
        </form>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <div class="address">
        <h1 class="title">our contact</h1>
        <div class="row">
            <div class="box">
                <i></i>
                <div>
                    <h4>address</h4>
                    <p>Binh Thuan</p>
                </div>
            </div>
            <div class="box">
                <i></i>
                <div>
                    <h4>phone number</h4>
                    <p>0858116654</p>
                </div>
            </div>
            <div class="box">
                <i></i>
                <div>
                    <h4>email</h4>
                    <p>ngothanhcanh2001@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line3"></div>
    <?php include 'footer.php';  ?>
    <script src="./script2.js"></script>
</body>

</html>