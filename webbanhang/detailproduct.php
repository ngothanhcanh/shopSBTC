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
if (isset($_POST['btn'])) {
    $cart_id = $_POST['btn'];
    $cart_quantity = 1;
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE pid='$cart_id' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_cart) > 0) {
        $response['messagea'] = 'Sản phẩm đã có trong giỏ hàng';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`( `use_id`, `pid`,`quantity`) VALUES ('$user_id','$cart_id','$cart_quantity')") or die('query failed');

    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
if (isset($_POST['btnnow'])) {
    $cart_id = $_POST['btnnow'];
    $cart_quantity = 1;
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE pid='$cart_id' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_cart) > 0) {
        $response['messagea'] = 'Sản phẩm đã có trong giỏ hàng';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`( `use_id`, `pid`,`quantity`) VALUES ('$user_id','$cart_id','$cart_quantity')") or die('query failed');
        $response['messagea'] = 'Sản phẩm đã có trong giỏ hàng';
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

?>
<style type="text/css">
    <?php
    include 'detailproduct.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Detail product</title>
</head>

<body>
    <style>
        .header {
            background-color: black;
        }
    </style>
    <?php include 'header.php';  ?>
    <?php if(isset($_GET['pid'])){
        $pid=$_GET['pid'];
        $selet_product_id = mysqli_query($conn,"SELECT * FROM products WHERE id='$pid'");
        if(mysqli_num_rows($selet_product_id)>0){
            while($fetch_pid=mysqli_fetch_assoc($selet_product_id))
            {
            ?>
       
    <div class="container_detail_product">
        <div class="container_image_product">
            <div class="main_link">
                <span>Trang chủ</span>
                <i class="fa-solid fa-chevron-right"></i>
                <span>Sản phẩm</span>
                <i class="fa-solid fa-chevron-right"></i>
                <span class="select_product">Áo</span>
            </div>
            <div class="main_image_detail_product">
                <img src="image/<?=$fetch_pid['image']?>" alt="">
            </div>
        </div>
        <div class="container_info_detail_product">
            <div class="main_title_detail_product_top">
                <div class="title_detail_product"><?=$fetch_pid['name'] ?></div>
                <div class="main_desc_shop">
                    <h4><?=$fetch_pid['product_detail'] ?></h4>
                </div>
                <div class="main_rating">
                    <div class="rating_fb_detail" style="--rating:90"></div>
                    <p>(<?=$fetch_pid['id']*10?>)</p>
                </div>
            </div>
            <div class="main_price_detail">
                <div class="main_price_detail_product"><?=$fetch_pid['new_price']?></div>
                <p>Có thể thanh toán trả góp trong 6 tháng</p>
            </div>
            <div class="main_quantity">
                <div class="counter">
                    <span class="down" onClick='decreaseCount(event, this)'>-</span>
                    <input type="number" value="1" inputmode="numeric" readonly>
                    <span class="up" onClick='increaseCount(event, this)'>+</span>
                </div>
            </div>
            <div class="main_manipulate">
                <button id="btnspnow" class="button_buy_now"><span>Buy Now</span></button>
                <button id="btnnsp" class="button_shop" value="<?= $fetch_pid['id'] ?>">
                    <span>Add to Cart</span>
                    <div class="cart">
                        <svg viewBox="0 0 36 26">
                            <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                            <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                        </svg>
                    </div>
                </button>
            </div>
            <div class="main_incentives">
                <div class="main_incentives_1">
                    <div class="incentives_1">
                        <span class="material-symbols-outlined">local_shipping</span>
                        <h5>Miễn phí vận chuyển</h5>
                    </div>
                    <p>Miễn phí vận chuyển cho lần đầu mua hàng</p>
                </div>
                <div class="main_incentives_2">
                    <div class="incentives_2">
                        <span class="material-symbols-outlined">assignment_return</span>
                        <h5>Cho phép trả hàng</h5>
                    </div>
                    <p>Cho phép hoàn hàng trong 30 ngày</p>
                </div>
            </div>
        </div>
    </div>
    <?php      }
}
} ?>
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
    <script>
    $(document).on('click','#btnnsp',function(){
        var btn = $(this).val();
        var data = {btn:btn};
        $.ajax({
            url:'',
            type:'POST',
            dataType:'json',
            data:data,
            success:function(response) {
                if(response)
                   {
                    swal("Error!", response.messagea, "error")
                   }
            },
            error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
        });
    });
    $(document).on('click','#btnspnow',function(){
        var btnnow = $(this).val();
        var data = {btnnow:btnnow};
        $.ajax({
            url:'',
            type:'POST',
            dataType:'json',
            data:data,
            success:function(response) {
                if(response)
                   {
                   window.location.href = "cart.php";
                   }
            },
            error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
        });
    });
    </script>
    <script type="text/javascript">
        function increaseCount(a, b) {
            var input = b.previousElementSibling;
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            input.value = value;
        }

        function decreaseCount(a, b) {
            var input = b.nextElementSibling;
            var value = parseInt(input.value, 10);
            if (value > 1) {
                value = isNaN(value) ? 0 : value;
                value--;
                input.value = value;
            }
        }
    </script>
    <script>
        document.querySelectorAll('.button_shop').forEach(button => button.addEventListener('click', e => {
            if (!button.classList.contains('loading')) {

                button.classList.add('loading');

                setTimeout(() => button.classList.remove('loading'), 3700);

            }
            e.preventDefault();
        }));
    </script>


    <script src="./script2.js"></script>

</body>

</html>