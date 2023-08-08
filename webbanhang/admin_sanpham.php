<?php $page='adminsanpham';
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
                $method = mysqli_real_escape_string($conn, $_POST['method']);
                $image = $_FILES['image']['name'];
                $image_size = $_FILES['image']['size'];
                $image_tmp_name = $_FILES['image']['tmp_name'];
                $image_extension = pathinfo($image, PATHINFO_EXTENSION);
                $image_tg=time(). '.' .$image_extension;
                $image_folder = 'image/'.$image_tg;
                $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$product_name'") or die('query failed');
                if (mysqli_num_rows($select_product_name) > 0) {
                    $messege[] = 'product name already exit';
                    header("Refresh:1;url=admin_sanpham.php");
                } else {
                    if(mysqli_num_rows($select_menu=mysqli_query($conn,"SELECT type_product FROM `menu_product` Where type_product='$type' "))>0)
                    {
                        $insert_product = mysqli_query($conn, "INSERT INTO `products`( `name`, `old_price`,`new_price`,`product_detail`,`type_product`,`method`,`image`)
                       VALUES ('$product_name','$oldprice','$newprice','$product_detail','$type','$method','$image_tg')") or die('query failed');
                    }else{
                        $insert_menu = mysqli_query($conn, "INSERT IGNORE INTO `menu_product`(`type_product`) VALUES ('$type')");
                    $insert_product = mysqli_query($conn, "INSERT INTO `products`( `name`, `old_price`,`new_price`,`product_detail`,`type_product`,`method`,`image`)
                    VALUES ('$product_name','$oldprice','$newprice','$product_detail','$type','$method','$image_tg')") or die('query failed');
                    }
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
            {    $delete_id = $_GET['delete'];
                $selecte_delete_image = mysqli_query($conn,"SELECT image FROM `products` WHERE id ='$delete_id'") or die('query failed');
                $fetch_detele_image = mysqli_fetch_assoc($selecte_delete_image);
                unlink('image/'.$fetch_detele_image['image']);
                 mysqli_query($conn,"DELETE FROM `products` WHERE id='$delete_id'") or die('query failed');
                 mysqli_query($conn,"DELETE FROM `cart` WHERE id='$delete_id'") or die('query failed');
                 mysqli_query($conn,"DELETE FROM `wishlist` WHERE id='$delete_id'") or die('query failed');
                 header('location:admin_sanpham.php');
            }
           
?>
<style type="text/css">
    <?php
    include 'admin_sanpham.css';
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
    <div class="main-checkout">
        <section class="checkout">

            <div class="payment-form">


                <p>Thêm sản phẩm</p>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="cardholder-name">
                        <label for="cardholder-name" class="label-default">Tên sản phẩm</label>
                        <input type="text" name="name" id="cardholder-name" class="input-default" required>
                    </div>
                    <div class="cardholder-name">
                        <label for="cardholder-name" class="label-default">Giá củ</label>
                        <input type="number" name="oldprice" id="cardholder-name" class="input-default" required>
                    </div>
                    <div class="cardholder-name">
                        <label for="cardholder-name" class="label-default">Giá mới</label>
                        <input type="number" name="newprice" id="cardholder-name" class="input-default" required>
                    </div>
                    <div class="cardholder-name">
                        <label for="cardholder-name" class="label-default">Mô tả sản phẩm</label>
                        <textarea type="text" name="detail" id="cardholder-name" class="input-default"></textarea>
                    </div>
                    <div class="cardholder-name">
                        <label for="cardholder-name" class="label-default">Loại hàng</label>
                        <input type="text" name="type" id="cardholder-name" class="input-default" required>
                    </div>
                    <div class="cardholder-name">
                        <label for="cardholder-name" class="label-default">Thuộc tính sản phẩm</label>
                        <input type="text" name="method" id="cardholder-name" class="input-default" >
                    </div>
                    <div class="cardholder-name">
                        <label for="cardholder-name" class="label-default">Hình sản phẩm</label>
                        <input type="file" name="image" id="cardholder-name" class="input-default" required>
                    </div>



                    <!-- <div class="input-flex">
                            <div class="expire-date">
                                <label for="expire-date" class="label-default">Expiration date</label>
                            
                                <div class="input-flex">
                                    <input type="number" name="day" id="expire-date" placeholder="31" min="1" max="31" class="input-default">
                                    /
                                    <input type="number" name="month" id="expire-date" placeholder="12" min="1" max="12" class="input-default">
                                </div>
                            </div>

                            <div class="ccv">
                                <label for="ccv" class="label-default">CCV</label>
                                <input type="number" name="ccv" id="ccv" class="input-default">
                            </div>
                            
                        </div> -->
                <button name="add_product"  class="btnn btn-primary" value="add product">
                <span id="payAmount">Thêm sản phẩm</span>
                </button>
                </form>
            </div>

           
        </section>
    </div>

    <p class="title-fake-hd">Danh sách sản phẩm</p>
    <div class="container-form-hoadon">

        <table class="form-hoadon">

            <tr>
                <th class="first-child-hd">Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Chi tiết sản phẩm</th>
                <th>Giá cũ</th>
                <th>Giá mới</th>
                <th class="last-child-hd">Thao tác</th>
            </tr>
            <?php 
            $select_products=mysqli_query($conn,"SELECT * FROM `products`") or die('query failed');
            if(mysqli_num_rows($select_products)>0){
                while($fetch_products=mysqli_fetch_assoc($select_products)){
                     
            ?>
            <tr class="info-hd">
                <td class="first-child-hd"><img src="image/<?php echo $fetch_products['image']; ?>" alt=""></td>
                <td class="date-hd"><?php echo $fetch_products['name']; ?></td>
                <td class="ten-hd-user"><?= $fetch_products['product_detail'];  ?></td>
                <td class="diachi-hd"><?= number_format($fetch_products['old_price'])  ?></td>
                <td><?= number_format($fetch_products['new_price']) ?></td>
                <td class="last-child-hd">
                <div class="thaotac">
                    <a href="admin_editproduct.php?edit=<?php echo $fetch_products['id']; ?>"><i class="fa-solid fa-pen"></i></a>
                <a href="admin_sanpham.php?delete=<?php echo $fetch_products['id']; ?>" onclick="
               return confirm('do you want to delete this product');"><i class="fa-solid fa-trash"></i></a></div>
                </td>
            </tr>
            <?php 
                  }
                }else{
                     echo ' <div class="empty">
                     <p>no products added yet!</p>
                 </div>';
                }         
            
            ?>  

        </table>
    </div>

    <script type="text/javascript" src="./script.js"></script>
</body>

</html>