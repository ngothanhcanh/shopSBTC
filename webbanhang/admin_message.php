<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
}
if (isset($_POST['logout-btn'])) {
    session_destroy();
    header('location:login.php');
}
if (isset($_GET['delete'])) {
    $message_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id = '$message_id'") or die('query failed');
    header('location:admin_message.php');
} else {
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
    <title>admin_message</title>
</head>

<body>
    <?php include 'admin_header.php' ?>
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
    <div class="line4"></div>
    <section class="message-container">
        <h1 class="title">unread message</h1>
        <div class="box-container">

            <?php
            $select_message = mysqli_query($conn, "SELECT * FROM `message` ") or die('query failed');
            if (mysqli_num_rows($select_message) > 0) {
                while ($fetch_message = mysqli_fetch_assoc($select_message)) {
            ?>
                    <div class="box">
                        <p> user id: <span><?php echo $fetch_message['id']; ?></span>
                        <p> name: <?php echo $fetch_message['name']; ?> </p>
                        <p> email:<?php echo $fetch_message['email']; ?> </p>
                        <p> Message: <?php echo $fetch_message['message']; ?></p>
                        <a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>;" class="delete" onclick="return confirm('delete this message');">delete</a>
                    </div>

            <?php

                }
            } else {
                echo '<div class="empty">
            <p>no products added yet!</p>
          </div>';
            }
            ?>
        </div>
        </div>
    </section>
    <div class="line"></div>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>