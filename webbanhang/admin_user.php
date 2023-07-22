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
    
        if(isset($_GET['delete']))
        { 
           $user_delete_id=$_GET['delete'];
           mysqli_query($conn,"DELETE FROM `users` WHERE id='$user_delete_id'") or die('query failed');
           header('location:admin_user.php');
        }
        if(isset($_POST['update_user_submit']))  {
           $update_id_user =$_POST['update_id'];
           $update_name_user=$_POST['update_user'];
           $update_email_user=$_POST['update_email'];
           $update_password_user=$_POST['update_passwork'];
           $update_user_type_user=$_POST['update_user_type'];
        $user_update_query= mysqli_query($conn,"UPDATE `users` SET `id`='$update_id_user', `name`='$update_name_user',`email`='$update_email_user',`password`='$update_password_user',`user_type`='$update_user_type_user' WHERE id='$update_id_user'") or die('query failed');
        if($user_update_query)
        {
            $messege[] = 'update successfully';
        }
        else {
            $messege [] ='update failed';
        }
    }else{
           
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
    <div class="line2"></div>
    <section class="update-users form-contaniner">
        <?php 
        if(isset($_GET['edit']))
        {
            $user_edit_id=$_GET['edit']  ;
        $select_users=mysqli_query($conn,"SELECT * FROM `users` WHERE id= '$user_edit_id' ") or die('query failed');
         if(mysqli_num_rows($select_users)>0){
            while($fetch_user_edit=mysqli_fetch_assoc($select_users))
            {
       ?>
        <form method="POST" action="" enctype="multipart/form-data">
               <input type="hidden" name="update_id" value="<?php echo $fetch_user_edit['id'];?>">
            <div class="input-field">
                <label >user name</label>
                <input type="text" name="update_user" value="<?php echo $fetch_user_edit['name'] ?>" >
            </div>
            <div class="input-field">
                <label >email user</label>
                <input type="text" name="update_email" value="<?php echo $fetch_user_edit['email']?> " >
            </div>
            <div class="input-field">
                <label >passwoord</label>
               <input type="text" name="update_passwork" value="<?php echo $fetch_user_edit['password']?>">
            </div>
            <div class="input-field">
                <label >user_type</label>
                <input type="text" name="update_user_type" id=""value="<?php echo $fetch_user_edit['user_type']?>">
            </div>
            <input type="submit" name="update_user_submit" value="update" class="edit">
        </form>

         <?php
           }}
        }else{

        }

         ?>
    </section>
    <div class="line7"></div>
    <section class="form-contaniner">
        <div class="box-container">
    <?php $select_user=mysqli_query($conn,"SELECT *FROM `users`") or die('query failed');
         if(mysqli_num_rows($select_user)>0){
            while($fetch_users=mysqli_fetch_assoc($select_user))
            {   
                ?>
                <div class="box">
                    <h4> <?php echo $fetch_users['name']; ?> </h4>
                    <p><?php echo $fetch_users['email']; ?></p>
                    <p><?php echo $fetch_users['password']; ?></p>
                    <p>user type :<span style="color:<?php if($fetch_users['user_type']=='admin'){echo 'orange';}else{ echo 'blue';} ;?>"><?php echo $fetch_users['user_type']; ?></span></p>
                    <a href="admin_user.php?delete=<?php echo $fetch_users['id']; ?>" class="delete">delete</a>
                    <a href="admin_user.php?edit=<?php echo $fetch_users['id']; ?>" class="edit">edit</a>
                </div>
           <?php      
            }
         }else{

         }
           ?>
           </div>
</section>
    <script type="text/javascript" src="./script.js"></script>
</body>
</html>