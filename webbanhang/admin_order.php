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
    
        if(isset($_GET['delete']))
        { 
           $order_id=$_GET['delete'];
           mysqli_query($conn,"DELETE FROM `order` WHERE id='$order_id'") or die('query failed');
           $messege[] ='user removed successfully';
           header('location:admin_order.php');
        }
        // update payment status
        if(isset($_POST['update_order']))
        {
            $oderid=$_POST['order_id'];
            $update_payment=$_POST['update_payment'];
            mysqli_query($conn,"UPDATE `order` SET payment_status='$update_payment' WHERE id='$oderid'") or die('query failed');
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
    
    <title>admin user</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
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
    <section class="order-container">
        <h1 class="title">order</h1>
        <div class="box-container">
    <?php $select_orders=mysqli_query($conn,"SELECT *FROM `order`") or die('query failed');
         if(mysqli_num_rows($select_orders)>0){
            while($fetch_orders=mysqli_fetch_assoc($select_orders))
            {   
                ?>
                <div class="box">
                    <p>user name: <span><?php echo $fetch_orders['name']; ?></span> </p>
                    <p>user id: <span><?php echo $fetch_orders['use_id']; ?></span> </p>
                    <p>placed on: <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                    <p>number: <span><?php echo $fetch_orders['number']; ?></span> </p>
                    <p>email: <span><?php echo $fetch_orders['email']; ?></span> </p>
                    <p>total price: <span><?php echo $fetch_orders['total_price']; ?></span> </p>
                    <p>method: <span><?php echo $fetch_orders['method']; ?></span> </p>
                    <p>adress: <span><?php echo $fetch_orders['adress']; ?></span> </p>
                    <p>total product: <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                    <form method="post">
                        <input type="hidden" name="order_id" value="<?php echo$fetch_orders['id']; ?>">
                        <select name="update_payment" >
                            <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
                            <option value="pending">Pending</option>
                            <option value="complete">complete</option>
                        </select>
                        <input type="submit" name="update_order" value="update payment" class="btn">
                        <a href="admin_order.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete">delete</a>
                    </form>
                </div>
                
           <?php      
            }
         }else{
               echo '<div class="empty"><p>no order placed yet!</p></div>';
         }
           ?>
           </div>
</section>
    <script type="text/javascript" src="./script.js"></script>
</body>
</html>