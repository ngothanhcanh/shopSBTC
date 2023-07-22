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

    <div class="banner1">
        <div class="detail">
            <h1>about me</h1>
            <p></p>
            <a href="index.php">home</a><span>/me</span>
        </div>
    </div>
    <div class="aboutme-fluid">
        <div class="aboutme-slider">
            <div class="aboutme-item">
                <img src="img/aboutme.png">
                <div class="aboutme-caption">
                    <span></span>
                    <h1>Ngô Thanh Cảnh</h1>
                    <p>done website code fullstack about learn and write on 13 day. website write on html css javascrip php</p>
                    <div class="social-link">
                     <a href="https://www.facebook.com/ngothanhcanh02"><i class="fa-brands fa-facebook"></i></a>   
                      <a href="https://twitter.com/Canhngo2001"><i class="fa-brands fa-twitter"></i></a>  
                       <a href="https://www.instagram.com/ngothanhcanh2001/?hl=en"><i class="fa-brands fa-instagram"></i></a> 
                        <i class="fa-brands fa-github"></i>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.navbar a',function(){
            $(this).addClass('activemenu').siblings().removeClass('activemenu')
        })
    </script>
    <?php include 'footer.php';  ?>
    <script src="./script2.js"></script>
</body>

</html>