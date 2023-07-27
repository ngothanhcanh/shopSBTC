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
if (isset($_POST['btnxoa'])) {
    $btnxoa = $_POST['btnxoa'];
    mysqli_query($conn,"DELETE FROM `cart` where pid='$btnxoa' AND use_id='$user_id'");
    // Trả về dữ liệu JSON để xác nhận gửi thành công
    echo json_encode(['success' => true]);
    exit(); // Make sure to exit here to prevent any other output.
}
if (isset($_POST['products'])) {
    $products = $_POST['products'];
    foreach ($products as $product) {
        $pid = $product['productId'];
        $id = $product['cartid'];
        $quantity = $product['quantity'];
        mysqli_query($conn, "UPDATE `cart` SET `quantity`='$quantity' WHERE `id`='$id' AND `use_id`='$user_id' AND `pid`='$pid'");
    }
    // Trả về dữ liệu JSON để xác nhận gửi thành công
    echo json_encode(['success' => true]);
    exit(); // Make sure to exit here to prevent any other output.
}
?>
<style type="text/css">
    <?php
    include 'giohang.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Giỏ hàng</title>
</head>

<body>
    <?php include 'header.php';  ?>

    <main class="container">
        <div class="main-heading">
            <h1 class="heading">
                <ion-icon name="cart-outline"></ion-icon>
                <span>Giỏ hàng</span>
            </h1>
        </div>
        <div class="item-flex-gh">
            <section class="cart_gh">
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
                                                <input type="text" name="" id="id_cart" value="<?= $fetch_cart['id'] ?>" hidden>
                                                <input type="text" name="" id="pid_product" value="<?= $pid ?>" hidden>
                                                <button id="decrement">
                                                    <ion-icon name="remove-outline"></ion-icon>
                                                </button>

                                                <span id="slsp" class="quantity"><?= $fetch_cart['quantity'] ?></span>
                                                <button id="increment">
                                                    <ion-icon name="add-outline"></ion-icon>
                                                </button>

                                            </div>
                                            <div class="price_co">
                                                <span class="price_sp"><?= $fetch_product['new_price'] ?></span> VND
                                            </div>
                                        </div>

                                    </div>
                                    <button id="xoa_sp_cart" class="product-close-btn" value="<?=$pid?>">
                                        <ion-icon name="close-outline"></ion-icon>
                                    </button>

                                </div>
                            </div>
                    <?php }
                    } ?>

                </div>

                <div class="wrapper_co">


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

                <button id="thanhtoan" class="btnn-gh btn-primary">
                    <b>Thanh toán</b><span id="payAmount"></span> VND
                </button>
            </section>

        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Function to update header data
        function updateHeaderData() {
            $.ajax({
                url: 'http://localhost/shop/webbanhang/update_header.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#wishlist-count').text(data.wishlist_count);
                    $('#cart-count').text(data.cart_count);
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            });
        }

        // Update header data every 5 seconds
        setInterval(function() {
            updateHeaderData();
        }, 5000);

        // Call updateHeaderData function when the page loads
        updateHeaderData();
        
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
        // Handle click event on "Thanh toán" button
        $(document).on('click', '#thanhtoan', function() {
            let products = [];
            $('.product-card').each(function() {
                let productId = $(this).find('#pid_product').val();
                let cartid = $(this).find('#id_cart').val();
                let quantity = $(this).find('.quantity').text();
                console.log(productId);
                console.log(cartid);
                console.log(quantity);
                products.push({
                    productId: productId,
                    cartid: cartid,
                    quantity: quantity,
                });
            });

            $.ajax({
                url: window.location.href,
                type: 'POST',
                dataType: 'json',
                data: {
                    products: products,
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = "thanhtoan.php";
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            });
        });
    });
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