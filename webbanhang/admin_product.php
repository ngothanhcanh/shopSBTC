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
            //adding products to database
            if (isset($_POST['add_product'])) {
                $product_name = mysqli_real_escape_string($conn, $_POST['name']);
                $oldprice = mysqli_real_escape_string($conn, $_POST['oldprice']);
                $newprice = mysqli_real_escape_string($conn, $_POST['newprice']);
                $product_detail = mysqli_real_escape_string($conn, $_POST['detail']);
                $type = mysqli_real_escape_string($conn, $_POST['type']);
                $image = $_FILES['image']['name'];
                $image_size = $_FILES['image']['size'];
                $image_tmp_name = $_FILES['image']['tmp_name'];
                $image_folder = 'image/'.$image;
                $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$product_name'") or die('query failed');
                if (mysqli_num_rows($select_product_name) > 0) {
                    $messege[] = 'product name already exit';
                    header("Refresh:1;url=admin_product.php");
                } else {
                    $insert_product = mysqli_query($conn, "INSERT INTO `products`( `name`, `old_price`,`new_price`,`product_detail`,`type_product`,`image`)
                    VALUES ('$product_name','$oldprice','$newprice','$product_detail','$type','$image')") or die('query failed');
                if($insert_product)
                {
                    if($image_size>2000000){
                        $messege [] = 'image is to big';
                    }
                    else{
                        move_uploaded_file($image_tmp_name,$image_folder);
                        $messege[] ='upload successfully';
                    }
                }
            }
            }
            if(isset($_GET['delete']))
            {
                $delete_id = $_GET['delete'];
                $selecte_delete_image = mysqli_query($conn,"SELECT image FROM `products` WHERE id ='$delete_id'") or die('query failed');
                $fetch_detele_image = mysqli_fetch_assoc($selecte_delete_image);
                unlink('image/'.$fetch_detele_image['image']);
                 mysqli_query($conn,"DELETE FROM `products` WHERE id='$delete_id'") or die('query failed');
                 mysqli_query($conn,"DELETE FROM `cart` WHERE id='$delete_id'") or die('query failed');
                 mysqli_query($conn,"DELETE FROM `wishlist` WHERE id='$delete_id'") or die('query failed');
                 header('location:admin_product.php');
            }
            if(isset($_POST['update_product']))
            {  
                    $update_id = $_POST['update_id'];
                    $update_name = $_POST['update_name'];
                    $update_oldprice = $_POST['update_oldprice'];
                    $update_oldprice = $_POST['update_newprice'];
                    $update_detail = $_POST['update_detail'];
                    $update_type = $_POST['update_type'];
                   $update_image =$_FILES['update_image']['name'];
                   $update_image_tmp_name=$_FILES['update_image']['tmp_name'];
                   $update_image_folder='image/'.$update_image;
                   $update_query=mysqli_query($conn,"UPDATE `products` SET `id`='$update_id',`name`='$update_name',`old_price`='$update_oldprice',`new_price`='$new_oldprice',`product_detail`='$update_detail',`type_product`='$update_type',`image`='$update_image' WHERE id ='$update_id'") or die('query failed');
                if($update_query)
                {
                    move_uploaded_file($update_image_tmp_name,$update_image_folder);
                    header('location:admin_product.php');
                    
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
    
    <title>admin pannel</title>
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
    <div class="line2"></div>
    <section class="add-products form-contaniner">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="input-field">
                <label >product name</label>
                <input type="text" name="name" require>
            </div>
            <div class="input-field">
                <label >old price</label>
                <input type="text" name="oldprice" require>
            </div>
            <div class="input-field">
                <label >new price</label>
                <input type="text" name="newprice" require>
            </div>
            <div class="input-field">
                <label >product detail</label>
                <textarea name="detail" require></textarea>
            </div>
            <div class="input-field">
                <label >product type</label>
                <input type="text" name="type" require>
            </div>
            <div class="input-field">
                <label >product image</label>
                <input type="file" name="image" accept="image/jpg, image/jpeg , image/png, image/webp" require>
            </div>
            <input type="submit" name="add_product" value="add product" class="btn">
        </form>
    </section>
    <div class="line3"></div>
    <div class="line4"></div>
    <section class="show-products">
        <div class="box-container">
            <?php 
            $select_products=mysqli_query($conn,"SELECT * FROM `products`") or die('query failed');
            if(mysqli_num_rows($select_products)>0){
                while($fetch_products=mysqli_fetch_assoc($select_products)){
                     
            ?>
            <div class="box">
               <img width="200px" height="300px" src="image/<?php echo $fetch_products['image']; ?>">
               <h4><?php echo $fetch_products['name']; ?></h4>
               <p>old_price : $<?php echo $fetch_products['old_price']; ?> </p>
               <p>new_price : $<?php echo $fetch_products['new_price']; ?> </p>
               <details><?php  echo $fetch_products['product_detail'];  ?> </details>
               <a href="admin_product.php?edit=<?php echo $fetch_products['id']; ?>" class="edit" >edit</a>
               <a href="admin_product.php?delete=<?php echo $fetch_products['id']; ?>" class="delete" onclick="
               return confirm('do you want to delete this product');">delete</a>
               
            </div>
            <?php 
                  }
                }else{
                     echo ' <div class="empty">
                     <p>no products added yet!</p>
                 </div>';
                }         
            
            ?>  
        </div>
    </section>
    <div class="line"></div>
    <section class="update-container">
      <?php 
          if(isset($_GET['edit']))
          {
            $edit_id=$_GET['edit'];
            $edit_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id='$edit_id'") or die('query failed');
            if(mysqli_num_rows($edit_query)>0){
             while($fetch_edit=mysqli_fetch_assoc($edit_query)){              
      ?>

      <form method="POST" enctype="multipart/form-data">
          <img  src="image/<?php echo $fetch_edit['image']; ?>">
          <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id'];?>">
          <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?>">
          <input type="number" name="update_oldprice" min="0" value="<?php echo $fetch_edit['old_price']; ?>">
          <input type="number" name="update_newprice" min="0" value="<?php echo $fetch_edit['new_price']; ?>">
          <textarea name="update_detail"><?php echo $fetch_edit['product_detail'] ;?></textarea>
          <input type="text" name="update_type" value="<?php echo $fetch_edit['type_product']; ?>">
          <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png, image/webp"> 
          <input type="submit" name="update_product" value="update" class="edit"> 
          <input type="reset" name="" value="cancle" class="option-btn btn" id="close-form">
      </form>
      <?php 
      
             }
            }
            echo "<script > document.querySelector('.update-container').style.display='block'</script>";
        }
      ?>
    </section>
    <script type="text/javascript" src="./script.js"></script>
</body>
</html>