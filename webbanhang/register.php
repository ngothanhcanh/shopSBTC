<?php
    include 'connection.php';
    
    if (isset($_POST['submit-btn'])) { 
        if(empty($_POST['name']) && empty($_POST['email']) && empty($_POST['password'] && empty($_POST['cpassword'])) )
        {
            $messege[] ='do not empty input ';
        }else{
            $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $name = mysqli_real_escape_string($conn, $filter_name);

            $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $email = mysqli_real_escape_string($conn, $filter_email);

            $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $password = mysqli_real_escape_string($conn, $filter_password);

            $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
            $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

            $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

            if (mysqli_num_rows($select_user) > 0) {
                $messege[] = 'user already exit';
            } else {
                if ($password != $cpassword) {
                    $messege[] = 'wrong password';
                } else {
                    mysqli_query($conn, "INSERT INTO  `users` (`name`,`email`,`password`) VALUES ('$name','$email','$password')") or die('query failed');
                    $messege[] = 'registered successfully';
                    header('location:login.php');
                }
            }   
        }  
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--box icon link-->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" tyle="text/css" href="style.css">
    <title>Register page</title>
</head>
<body>
    <section class="form-contaniner">
    <?php 
    if(isset($messege))
    {
        foreach($messege as $messege)
        {
            echo'<div class="message">
            <span>'.$messege.'</span>
            <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
        </div>';
        }
    }
    ?>
        <form method="post" >
            <h1>register now</h1>
            <input type="text" name="name" placeholder="enter your name" require>
            <input type="text" name="email" placeholder="enter your email" require>
            <input type="password" name="password" placeholder="enter your password" require>
            <input type="password" name="cpassword" placeholder="confirm your password" require>
            <input type="submit" name="submit-btn" value="register now" class="btn">
            <p>already have an account ? <a href="login.php">login now</a></p>
        </form>
    </section>
</body>
</html>