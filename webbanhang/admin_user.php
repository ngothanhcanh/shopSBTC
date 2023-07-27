<?php
            include 'connection.php';
            session_start();
            $admin_id = $_SESSION['admin_name'];
            if (!isset($admin_id)) {
                header('location:login.php');
            }
            if (isset($_POST['logout-btn'])) {
                session_destroy();
                header('location:login.php');
            }
            if (isset($_POST['payment_status'])) {
                $oderid = $_POST['order_id'];
                $update_payment = $_POST['payment_status'];
                mysqli_query($conn, "UPDATE `users` SET user_type='$update_payment' WHERE id='$oderid'") or die('query failed');
            }
            if(isset($_GET['delete']))
            { 
               $user_delete_id=$_GET['delete'];
               mysqli_query($conn,"DELETE FROM `users` WHERE id='$user_delete_id'") or die('query failed');
               header('location:admin_user.php');
            }
            ?>
            <style type="text/css">
    <?php
    include 'admin_user.css';
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
   
    
    <title>Manager order</title>
</head>
<body>
    <?php include 'admin_header.php' ?>
            <p class="title-fake-hd">Quản lý người dùng</p>
   <div class="container-form-hoadon">
    
    <table class="form-hoadon">
        
        <tr>
            <th class="first-child-hd">Tên</th>
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Loại người dùng</th>
            <th class="last-child-hd">Thao tác</th>
        </tr>
        <?php 
  $select_user=mysqli_query($conn,"SELECT *FROM `users`") or die('query failed');
         if(mysqli_num_rows($select_user)>0){
            while($fetch_users=mysqli_fetch_assoc($select_user))
            {   
      ?>
        <tr class="info-hd">
            <td class="first-child-hd"><?php echo $fetch_users['name']; ?></td>
            <td class="date-hd"><?php echo $fetch_users['email']; ?></td>
            <td class="ten-hd-user"><?php echo $fetch_users['password']; ?></td>
            <td class="diachi-hd"><select name="update_payment" class="update_payment" data-order-id="<?= $fetch_users['id']; ?>" style="color:<?php if($fetch_users['user_type']=='admin'){echo 'orange';}else{ echo 'blue';} ;?>">
                                <option disabled selected><?php echo $fetch_users['user_type']; ?></option>
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select></td>
            <td class="last-child-hd"><div class="thaotac"><a href="admin_user.php?delete=<?= $fetch_users['id']; ?>"><i class="fa-solid fa-trash"></i></a></div></td>
        </tr>
        <?php      
            }
         }
     ?>
       
        
      
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Xử lý sự kiện khi giá trị được chọn thay đổi
            $('.update_payment').change(function() {
                // Lấy giá trị được chọn
                var selectedValue = $(this).val();
                var orderId = $(this).data('order-id');
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: {
                        order_id: orderId,
                        payment_status: selectedValue
                    },
                    success: function(response) {
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript" src="./script.js"></script>
</body>
</html>