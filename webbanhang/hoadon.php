<?php $page='hoadon';
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
    include 'hoadon.css';
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
<style>
    header {
    background: #455993;
    }
   </style>
    <?php include 'header.php';  ?>
    <p class="title-fake-hd">Danh sách hóa đơn của bạn</p>
   <div class="container-form-hoadon">
    
    <table class="form-hoadon">
        
        <tr>
            <th class="first-child-hd">Mã hóa đơn</th>
            <th>Ngày lập hóa đơn</th>
            <th>Tên</th>
            <th>Địa chỉ</th>
            <th>Tiền hóa đơn</th>
            <th>Trạng thái</th>
            <th class="last-child-hd">Thao tác</th>
        </tr>
        <?php $select_hoadon=mysqli_query($conn,"SELECT * FROM `order` WHERE use_id='$user_id';");
        if(mysqli_num_rows($select_hoadon)>0)
        { $stt=0;
            while($fetch_hoadon=mysqli_fetch_assoc($select_hoadon))
            {

           ?>
        <tr class="info-hd">
            <td class="first-child-hd"><?=++$stt ?></td>
            <td><?=$fetch_hoadon['placed_on'] ?></td>
            <td><?=$fetch_hoadon['name'] ?></td>
            <td><?=$fetch_hoadon['adress'] ?></td>
            <td><?=$fetch_hoadon['total_price'] ?></td>
            <td><?=$fetch_hoadon['payment_status'] ?></td>
            <td class="last-child-hd"><div class="thaotac"><a href="chitiethoadon.php?id=<?=$fetch_hoadon['id']?>"><i class="fa-regular fa-eye"></i></a></div></td>
        </tr>
        <?php 
         }
        }
        ?>
    </table>
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