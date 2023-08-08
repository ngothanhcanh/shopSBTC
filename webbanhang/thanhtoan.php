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
if (isset($_POST['products'])) {
    $select_infor_user = mysqli_query($conn, "SELECT * FROM users WHERE id ='$user_id'");
    $fetch_user = mysqli_fetch_assoc($select_infor_user);
    $products = $_POST['products'];
    $hoten = $_POST['hoten'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $tongtien = $_POST['payAmount'];
    $numberString = str_replace('.', '', $tongtien);
    $number = intval($numberString);
    $place_on = date('d-M-Y');
    $method = 'thanh toán khi nhận hàng';
    $email = $fetch_user['email'];

    mysqli_query($conn, "INSERT INTO `order`(`use_id`, `name`, `number`, `email`, `method`, `adress`, `total_price`, `placed_on`) VALUES ('$user_id','$hoten','$sdt','$email','$method','$diachi','$number','$place_on')");
    $order_id = mysqli_insert_id($conn);

    if ($order_id) {
        foreach ($products as $product) {
            $pid = $product['productId'];
            $quantity = $product['quantity'];
            $price = $product['price'];
            mysqli_query($conn, "INSERT INTO `orderdetail`(`id_order`, `id_product`, `quantity`, `price`) VALUES ('$order_id','$pid','$quantity','$price')");
        }
        mysqli_query($conn,"DELETE FROM `cart` WHERE use_id='$user_id'");
        // Trả về dữ liệu JSON để xác nhận gửi thành công
        echo json_encode(['success' => true]);
        exit();
    } else {
        // Trả về dữ liệu JSON với thông báo lỗi nếu có
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi ghi đơn hàng vào CSDL']);
        exit();
    }
}
if (isset($_POST['btnxoa'])) {
    $btnxoa = $_POST['btnxoa'];
    mysqli_query($conn,"DELETE FROM `cart` where pid='$btnxoa' AND use_id='$user_id'");
    // Trả về dữ liệu JSON để xác nhận gửi thành công
    echo json_encode(['success' => true]);
    exit(); // Make sure to exit here to prevent any other output.
}
$page='thanhtoan';
?>
<style type="text/css">
    <?php
    include 'thanhtoan.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Thanh toán</title>
</head>

<body>
    <?php include 'header.php';  ?>

    <main class="container">
        <h1 class="heading">
            <ion-icon name="cart-outline"></ion-icon>
            <span>Giỏ hàng</span>
        </h1>

        <div class="item-flex">

            <section class="checkout">
                <h2 class="section-heading">Chi tiết thanh toán</h2>
                <div class="payment-form">

                    <div class="payment-method">

                        <button class="method selected">
                            <span class="material-symbols-outlined">payments</span>
                            <span>Thanh toán khi nhận hàng</span>
                            <ion-icon class="checkmark fill" name="checkmark-circle"></ion-icon>
                        </button>

                        <button class="method">
                            <ion-icon name="logo-paypal"></ion-icon>
                            <span>Paypal</span>
                            <ion-icon class="checkmark" name="checkmark-circle-outline"></ion-icon>
                        </button>
                    </div>
                    <p>Thông tin nhận hàng</p>
                    <form action="#">
                        <div class="cardholder-name">
                            <label for="cardholder-name" class="label-default">Họ tên</label>
                            <input type="text" name="cardholder-name" id="cardholder-name" class="input-default">
                        </div>
                        <div class="cardholder-name">
                            <label for="cardholder-name" class="label-default">Địa chỉ</label>
                            <input type="text" name="cardholder-name" id="cardholder-diachi" class="input-default">
                        </div>

                        <div class="card-number">
                            <label for="card-number" class="label-default">Số điện thoại</label>
                            <input type="number" name="card-number" id="card-number" class="input-default">
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
                    </form>
                </div>

                <button id="thanhtoanhoadon" class="btnn btn-primary">
                    <b>Thanh toán</b><span id="payAmount"></span> VND
                </button>
            </section>

            <section class="cart_co">
                <div class="cart-item-box">
                    <h2 class="section-heading">Sản phẩm của bạn</h2>
                    <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE use_id='$user_id'");
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $pid = $fetch_cart['pid'];
                            $select_product = mysqli_query($conn, "SELECT * FROM products WHERE id='$pid'");
                            $fetch_product = mysqli_fetch_assoc($select_product);
                    ?>
                            <div class="product-card">
                                <div class="card_co">
                                    <div class="img-box">
                                        <img src="image/<?= $fetch_product['image'] ?>" alt="" class="product-img" width="80px">
                                    </div>
                                    <div class="detail">
                                        <h4 class="product-name"><?= $fetch_product['name'] ?></h4>
                                        <div class="wrapper_co">
                                            <div class="product-qty">
                                                <input type="hidden" name="" id="pid_product" value="<?= $pid ?>">
                                                <button id="decrement">
                                                    <ion-icon name="remove-outline"></ion-icon>
                                                </button>

                                                <span id="slsp" class="quantity"><?= $fetch_cart['quantity'] ?></span>
                                                <button id="increment">
                                                    <ion-icon name="add-outline"></ion-icon>
                                                </button>
                                                </button>
                                            </div>
                                            <div class="price_co">
                                                <span id="giasp" class="price_sp"><?= $fetch_product['new_price'] ?></span> VND
                                            </div>
                                        </div>
                                    </div>
                                    <button id="xoa_sp_cart" class="product-close-btn" value="<?=$pid?>">
                                        <ion-icon name="close-outline"></ion-icon>
                                    </button>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>

                <div class="wrapper_co">
                    <div class="discount-token">
                        <label for="discount-token" class="label-default">Mã giảm giá</label>
                        <div class="wrapper-flex">
                            <input type="text" name="discount-token" id="discount-token" class="input-default">

                            <button class="btnn btn-outline">Áp dụng</button>
                        </div>
                    </div>

                    <div class="amount">
                        <div class="subtotal">
                            <span>Tổng tiền sản phẩm</span>
                            <div class="main_sub"> <span id="subtotal"></span> <span>VND</span></div>
                        </div>
                        <div class="shipping">
                            <span>Phí ship</span><span>
                                <div class="main_sub"><span id="shipping"> 0.00</span> <span>VND</span> </div>
                        </div>
                        <div class="total">
                            <span>Tổng tiền</span>
                            <div class="main_sub "> <span id="total"> </span> <span>VND</span> </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '#thanhtoanhoadon', function() {
            let products = [];
            var payAmount = document.getElementById("payAmount").textContent;
            var hoten = document.getElementById("cardholder-name").value;
            var diachi = document.getElementById("cardholder-diachi").value;
            var sdt = document.getElementById("card-number").value;
            $('.product-card').each(function() {
                let productId = $(this).find('input[type="hidden"]').val();
                let quantity = $(this).find('.quantity').text();
                let price = $(this).find('.price_sp').text();
                products.push({
                    productId: productId,
                    quantity: quantity,
                    price: price
                });
            });
           
              
            $.ajax({
                url: window.location.href,
                type: 'POST',
                dataType: 'json',
                data: {
                    products: products,
                    hoten: hoten,
                    diachi: diachi,
                    sdt: sdt,
                    payAmount: payAmount
                },
                success: function(respone) {
                    function reload(){
                        location.reload();
                    }
                    if (respone.success) {
                        swal("Success!", 'Thanh toán thành công', "success");
                       setInterval(reload,4000);
                    }

                },
                error: function(xhr, status, error) {

                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            });
        });
        $(document).on('click', '#xoa_sp_cart', function() {
             var btnxoa=$(this).val();
            var data = {btnxoa:btnxoa}
            $.ajax({
                url: window.location.href,
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(response) {
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            });
        });
    </script>
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
        window.addEventListener('DOMContentLoaded', () => {
            totalCalc();
        });

        const payAmountBtn = document.querySelector('#payAmount');
        const decrementBtn = document.querySelectorAll('#decrement');
        const quantityElem = document.querySelectorAll('.quantity');
        const incrementBtn = document.querySelectorAll('#increment');
        const priceElem = document.querySelectorAll('.price_sp');

        const subtotalElem = document.querySelector('#subtotal');
        const taxElem = document.querySelector('#shipping');
        const totalElm = document.querySelector('#total');
        const closeBtns = document.querySelectorAll('.product-close-btn');

        const totalCalc = function() {
            const shipping = 25000;
            let subtotal = 0;
            let totalTax = 0;
            let total = 0;

            const quantityElem = document.querySelectorAll('.quantity');
            const priceElem = document.querySelectorAll('.price_sp');

            for (let i = 0; i < quantityElem.length; i++) {
                subtotal += Number(quantityElem[i].textContent) * Number(priceElem[i].textContent);
            }

            const subtotalElem = document.querySelector('#subtotal');
            subtotalElem.textContent = formatNumberWithCommas(subtotal);

            // Kiểm tra giỏ hàng trống và chỉ đặt phí vận chuyển là 0 khi giỏ hàng trống
            totalTax = quantityElem.length > 0 ? shipping : 0;

            const taxElem = document.querySelector('#shipping');
            taxElem.textContent = formatNumberWithCommas(totalTax);

            total = subtotal + totalTax;

            const totalElm = document.querySelector('#total');
            totalElm.textContent = formatNumberWithCommas(total);

            const payAmountBtn = document.querySelector('#payAmount');
            payAmountBtn.textContent = formatNumberWithCommas(total);
        };


        function handleProductClose(event) {
            const productCard = event.target.closest('.product-card');
            if (productCard) {
                productCard.remove();
                totalCalc();
            }
        }
        for (let i = 0; i < incrementBtn.length; i++) {
            incrementBtn[i].addEventListener('click', function() {
                let increment = Number(this.previousElementSibling.textContent);

                increment++;

                this.previousElementSibling.textContent = increment;

                totalCalc();

            });
            decrementBtn[i].addEventListener('click', function() {
                let decrement = Number(this.nextElementSibling.textContent);

                decrement <= 1 ? 1 : decrement--;

                this.nextElementSibling.textContent = decrement;

                totalCalc();
            });

        }
        closeBtns.forEach(btn => {
            btn.addEventListener('click', handleProductClose);
        });

        function formatNumberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>

    <script src="./script2.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://unpkg.com/ionicon@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>