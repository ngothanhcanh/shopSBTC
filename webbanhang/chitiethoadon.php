<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
}
if (isset($_POST['logout-btn'])) {
    session_destroy();
    header('location:login.php');
}
?>
<style type="text/css">
    <?php
    include 'chitiethoadon.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Thanh toán</title>
</head>

<body>
    <?php include 'header.php';  ?>

    <div class="page-container">
        Page
        <span class="page"></span>
        of
        <span class="pages"></span>
      </div>
      
      <div class="logo-container">
        <img
          style="width: 50px"
          src="image/sbtclogo.png"
        >
        <p>SBTC cảm ơn bạn đã mua hàng !</p>
      </div>
      
      <table class="invoice-info-container">
      <?php 
      $idoder=$_GET['id'];
      $select_hoadon=mysqli_query($conn,"SELECT * FROM `order` WHERE id='$idoder'");
      $fetch_hoadon = mysqli_fetch_assoc($select_hoadon);
           ?>
        <tr>
          <td rowspan="2" class="client-name">
            <?=$fetch_hoadon['name'] ?>
          </td>
          <td>
            Địa chỉ
          </td>
        </tr>
        <tr>
          <td>
          <?=$fetch_hoadon['adress'] ?>
          </td>
        </tr>
        <tr>
          <td>
            Ngày lập hóa đơn: <strong> <?=$fetch_hoadon['placed_on'] ?></strong>
          </td>
          <td>
           
          </td>
        </tr>
        <tr>
          <td>
            Số hóa đơn: <strong><?=101+$idoder ?></strong>
          </td>
          <td>
            duongthangpt3011@gmail.com
          </td>
        </tr>
    
      </table>
      
      
      <table class="line-items-container">
        <thead>
          <tr>
            <th class="heading-quantity">Số lượng</th>
            <th class="heading-quantity">Hình Ảnh</th>
            <th class="heading-description">Thông tin sản phẩm</th>
            <th class="heading-price">Giá</th>
            <th class="heading-subtotal">Tổng cộng</th>
          </tr>
        </thead>
        <tbody>
        
          <?php 
            $idoder=$_GET['id'];
            $totalsum=0;
          $select_order_detail=mysqli_query($conn,"SELECT * FROM `orderdetail` Where id_order='$idoder'");
          if(mysqli_num_rows($select_order_detail))
          { 
            while($fetch_order_detail=mysqli_fetch_assoc($select_order_detail))
            { $pid=$fetch_order_detail['id_product'];
              $select_product=mysqli_query($conn,"SELECT * FROM `products` WHERE id='$pid'");
              $fetcch_product = mysqli_fetch_assoc($select_product);
               $total=$fetch_order_detail['price']*$fetch_order_detail['quantity'];
              $totalsum +=$total;
              ?>
          <tr>
            <td><?=$fetch_order_detail['quantity'] ?></td>
            <td class="img_cthd"><img src="image/6213932.jpg" style="height:35px" alt=""></td>
            <td><?= $fetcch_product['product_detail'] ?></td>
            <td class="right-hd"><?=$fetch_order_detail['price'] ?> VND</td>
            <td class="bold"><?=$total ?> VND</td>
          </tr>
          <?php 
          }
        }
          ?>
        </tbody>
      </table>
      
      
      <table class="line-items-container has-bottom-border">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <th>Tổng tiền</th>
          </tr>
        </thead>
        <tbody>
          <tr>
           <td></td>
          <td></td>
            <td class="large total"><?=$totalsum ?></td>
          </tr>
        </tbody>
      </table>
      
      <div class="footer">
        <div class="footer-info">
          <span>sbtc@gmail.com</span> |
          <span>555 444 6666</span> |
          <span>dthang@gmail.com</span>
        </div>
        <div class="footer-thanks">
          <img src="https://github.com/anvilco/html-pdf-invoice-template/raw/main/img/heart.png" alt="heart">
          <span>Thank you!</span>
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Hàm thực hiện cập nhật lại dữ liệu trong header.php
        function updateHeaderData() {
            $.ajax({
                url: 'http://localhost/shop/webbanhang/update_header.php', // File PHP xử lý yêu cầu Ajax để lấy dữ liệu mới
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Cập nhật dữ liệu mới vào các phần tử trong header.php
                    $('#wishlist-count').text(data.wishlist_count);
                    $('#cart-count').text(data.cart_count);
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            });
        }

        // Cập nhật lại dữ liệu sau khoảng thời gian 5 giây
        setInterval(function() {
            updateHeaderData();
        }, 1000);

        // Gọi hàm cập nhật dữ liệu khi trang được load
        updateHeaderData();
    </script>
    <script src="./script2.js"></script>


</body>

</html>