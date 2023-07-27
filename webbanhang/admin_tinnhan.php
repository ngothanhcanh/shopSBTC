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
    header('location:admin_tinnhan.php');
} else {
}
?>

<style type="text/css">
    <?php
    include 'admin_tinnhan.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--box icon link-->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


    <title>Manager message</title>
</head>

<body>
    <?php include 'admin_header.php' ?>
    <p class="title-fake-hd">Lời nhắn của người dùng</p>
    <div class="container-form-hoadon">

        <table class="form-hoadon">

            <tr>
                <th class="first-child-hd">Tên</th>
                <th>Email</th>
                <th>Lời nhắn</th>
                <th>Điểm đánh giá</th>
                <th class="last-child-hd">Thao tác</th>
            </tr>

            <?php
            $select_message = mysqli_query($conn, "SELECT * FROM `message` ") or die('query failed');
            if (mysqli_num_rows($select_message) > 0) {
                while ($fetch_message = mysqli_fetch_assoc($select_message)) {
            ?>
                    <tr class="info-hd">
                        <td class="first-child-hd"><?php echo $fetch_message['name']; ?></td>
                        <td class="date-hd"><?php echo $fetch_message['email']; ?></td>
                        <td class="ten-hd-user"><?php echo $fetch_message['message']; ?></td>
                        <td class="ten-hd-user"><?= $fetch_message['rating']/10; ?></td>
                        <td class="last-child-hd">
                            <div class="thaotac"><a href="admin_tinnhan.php?delete=<?php echo $fetch_message['id']; ?>;" class="delete" onclick="return confirm('delete this message');"><i class="fa-solid fa-trash"></i></a></div>
                        </td>
                    </tr>

            <?php

                }
            } else {
                echo '<div class="empty">
<p>no products added yet!</p>
</div>';
            }
            ?>

        </table>
    </div>

    <script type="text/javascript" src="./script.js"></script>
</body>

</html>