<?php $page='adminpannel';
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_name'];
if(!isset($admin_id))
{
    header('location:login.php');
}
if(isset($_POST['logout-btn']))
{
    session_destroy();
    header('location:login.php');
}

?>
<style type="text/css">
    <?php
    include 'style.css';
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
    <link rel="stylesheet" tyle="text/css" href="style.css">
    <title>admin pannel</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
   
    <section class="dashboardd">
        <div class="box-containerr">
            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pendings = mysqli_query($conn,"SELECT * FROM `order` WHERE payment_status = 'Đợi Duyệt'") or die('query failed');
                while($fetch_pending = mysqli_fetch_assoc($select_pendings))
                {
                    $total_pendings +=  $fetch_pending['total_price'];
                }
                 ?>
                 <h3> <?= number_format($total_pendings) ?> VND</h3>
                 <p>Tổng tiền đang chờ</p>
            </div>
            <div class="box">
                <?php
                $total_completes = 0;
                $select_completes = mysqli_query($conn,"SELECT * FROM `order` WHERE payment_status = 'Đã Giao'") or die('query failed');
                while($fetch_completes = mysqli_fetch_assoc($select_completes))
                {
                    $total_completes +=  $fetch_completes['total_price'];
                }
                 ?>
                 <h3><?=number_format($total_completes) ?> VND</h3>
                 <p>Tổng tiền hoàn thành</p>
            </div>
            <div class="box">
                <?php
                $select_orders = mysqli_query($conn,"SELECT * FROM `order`") or die('query failed');
                $number_of_orders = mysqli_num_rows($select_orders);
               
                 ?>
                 <h3> <?php echo $number_of_orders; ?></h3>
                 <p>Tổng Đơn</p>
            </div>
            <div class="box">
                <?php
                $select_products = mysqli_query($conn,"SELECT * FROM `products`") or die('query failed');
                $number_of_products = mysqli_num_rows($select_products);
               
                 ?>
                 <h3> <?php echo $number_of_products; ?></h3>
                 <p>Tổng Sản Phẩm Đã Thêm</p>
            </div>
            <div class="box">
                <?php
                $select_users = mysqli_query($conn,"SELECT * FROM `users` WHERE user_type='user'") or die('query failed');
                $number_of_users = mysqli_num_rows($select_users);
               
                 ?>
                 <h3> <?php echo $number_of_users; ?></h3>
                 <p>Tổng Người dùng</p>
            </div>
            <div class="box">
                <?php
                $select_admins = mysqli_query($conn,"SELECT * FROM `users` WHERE user_type='admin'") or die('query failed');
                $number_of_admin = mysqli_num_rows($select_admins);
               
                 ?>
                 <h3> <?php echo $number_of_admin; ?></h3>
                 <p>Tổng Người Quản Lý</p>
            </div>
            <div class="box">
                <?php
                $select_users = mysqli_query($conn,"SELECT * FROM `users` ") or die('query failed');
                $number_of_users = mysqli_num_rows($select_users);
               
                 ?>
                 <h3> <?php echo $number_of_users; ?></h3>
                 <p>Tổng Thành Viên</p>
            </div>
            <div class="box">
                <?php
                $select_message = mysqli_query($conn,"SELECT * FROM `message` ") or die('query failed');
                $number_of_message = mysqli_num_rows($select_message);
               
                 ?>
                 <h3> <?php echo $number_of_message; ?></h3>
                 <p>Tổng Tin Nhắn</p>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>