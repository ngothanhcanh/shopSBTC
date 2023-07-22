<?php
    include 'connection.php';
    session_start();
    if (isset($_POST['submit-btn'])) {

        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($conn, $filter_password);

        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password ='$password'  ") or die('query failed');

        if (mysqli_num_rows($select_user) > 0) {
            $row = mysqli_fetch_assoc($select_user);
                if ($row['user_type'] == 'admin') {
                    $_SESSION['admin_name'] = $row['name'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['id'];
                    header('location:admin_pannel.php');
                } else if ($row['user_type'] == 'user') {
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];
                    header('location:index.php');
                } else {        
                    $messege[] = 'incorrect email or password';
                }
            } else {
                $messege[] = 'incorrect email or password';
                header("Refresh:1 url=login.php");
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
    <title>Login page</title>
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
            <i class="click" onclick="this.parentElement.remove()">aa</i>
        </div>';
        }
    }
    ?>
        <form method="post">
            <h1>Login Now</h1>
            <input type="text" name="email" placeholder="enter your email" require>
            <input type="password" name="password" placeholder="enter your password" require>
            <input type="submit" name="submit-btn" value="Login now" class="btn">
            <p>Have You not yet a account? ? <a href="register.php">register</a></p>
        </form>
    </section>
</body>
</html>