<?php $page='shop';
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
if (isset($_POST['lovevalue'])) {
    $Wishlist_id = $_POST['lovevalue'];
    $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE pid='$Wishlist_id' AND use_id ='$user_id' ") or die('query failed');
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE pid='$Wishlist_id' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_wishlist) > 0) {
        $response['messagea'] = 'Sản phẩm đã có trong danh sách thích';
    } else if (mysqli_num_rows($select_cart) > 0) {
        $response['messagea'] = 'Sản phẩm đã có trong giỏ hàng';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`( `use_id`, `pid`) VALUES ('$user_id','$Wishlist_id')") or die('query failed');
       
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
if (isset($_POST['pid'])) {
    $cart_id = $_POST['pid'];
    $cart_quantity = 1;
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE pid='$cart_id' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_cart) > 0) {
        $responsee['message'] = 'Sản phẩm đã có trong giỏ hàng';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`( `use_id`, `pid`,`quantity`) VALUES ('$user_id','$cart_id','$cart_quantity')") or die('query failed');
       
    }
    header('Content-Type: application/json');
    echo json_encode($responsee);
    exit();
}
$select_sp = mysqli_query($conn, "SELECT * FROM products");
$select_users = mysqli_query($conn, "SELECT * FROM users");
$select_rating = mysqli_query($conn, "SELECT rating FROM message");
?>
<style type="text/css">
    <?php
    include 'shop.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>shop</title>
</head>

<body>
    <?php include 'header.php';  ?>

    <div class="container_shop">
        <div class="nav_left">
            <!-- Loại sản phẩm -->
            <div class="container_category">
                <p id="title_category"> Loại sản phẩm</p>
                <div class="wrapper_shop">
                    <input id="btnBox" type="checkbox" readonly />
                    <ul>
                        <div class="checkbox-wrapper-42">
                            <input id="cbx-1" class="ipcbx checksp" type="checkbox" value="1' OR '1'='1" />
                            <label class="cbx" for="cbx-1"></label>
                            <label class="lbl" for="cbx-1">Tất cả</label>
                        </div>
                        <?php $select_menu = mysqli_query($conn, "SELECT type_product From menu_product");
                        if (mysqli_num_rows($select_menu) > 0) {
                            $i = 1;
                            while ($fetch_menu = mysqli_fetch_assoc($select_menu)) {
                                $i++;
                        ?>
                                <div class="checkbox-wrapper-42">
                                    <input id="cbx-<?= $i ?>" class="ipcbx checksp" type="checkbox" value="<?= $fetch_menu['type_product'] ?>" />
                                    <label class="cbx" for="cbx-<?= $i ?>"></label>
                                    <label class="lbl" for="cbx-<?= $i ?>"><?= $fetch_menu['type_product'] ?></label>
                                </div>
                        <?php

                            }
                        }
                        ?>
                    </ul>
                    <label class="btn-area" for="btnBox"><span class="btn1">Xem thêm <i class="fa-solid fa-angle-down"></i> </span> <span class="btn2">Thu gọn <i class="fa-solid fa-chevron-up"></i></span></label>
                </div>
            </div>
            <!--End Loại sản phẩm -->
            <!-- Giá -->
            <div class="container_price">
                <p id="title_category">Giá</p>
                <div class="wrapper_shop">
                    <input id="btnBox" type="checkbox" readonly />
                    <ul>
                        <div class="checkbox-wrapper-42">
                            <input id="cbx-price1" class="ipcbx" type="checkbox" value="price1" />
                            <label class="cbx" for="cbx-price1"></label>
                            <label class="lbl" for="cbx-price1">Cao đến thấp</label>
                        </div>


                        <div class="checkbox-wrapper-42">
                            <input id="cbx-price2" class="ipcbx" type="checkbox" value="price2" />
                            <label class="cbx" for="cbx-price2"></label>
                            <label class="lbl" for="cbx-price2">Thấp đến cao</label>
                        </div>


                    </ul>
                </div>
            </div>
            <!-- End Giá -->
        </div>

        <div class="main_shop">
            <div class="main_search">
                <input class="search_btn" type="text" id="searchInput" placeholder="Search">
                <i id="clickbtn" class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="main_link">
                <span>Trang chủ</span>
                <i class="fa-solid fa-chevron-right"></i>
                <span>Sản phẩm</span>
            </div>

            <div class="container_card_shop">
                <div class="card_shop_first">
                    <div class="main_img_card_shop">
                    <iframe src="https://www.youtube.com/embed/yZ2TVg0Mdfw?autoplay=1&amp;controls=0&amp;start=0&amp;showinfo=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="allowfullscreen" style="border: none; background-color: transparent;"></iframe>
                          <!--
                            <source src="image/rickroll.mp4" type="video/mp4">
                        </video> -->
                    </div>
                </div>
                <div class="card_top_second">
                    <div class="card_top_second_child_top">
                        <div class="child_second_child_top_1">
                            <div class="title_top_1_row1">
                                <div class="container_row1_1">
                                    <span class="material-symbols-outlined">inventory_2</span>
                                    <h5>Sản phẩm: </h5>
                                    <p><?= mysqli_num_rows($select_sp) ?></p>
                                </div>
                                <div class="container_row1_1">
                                    <span class="material-symbols-outlined">groups</span>
                                    <h5>Người theo dõi: </h5>
                                    <p><?= mysqli_num_rows($select_users) ?></p>
                                </div>
                                <div class="container_row1_1">
                                    <span class="material-symbols-outlined">person_add</span>
                                    <h5>Đang theo dõi: </h5>
                                    <p><?= mysqli_num_rows($select_users) ?></p>
                                </div>
                            </div>
                            <div class="title_top_1_row2">
                                <div class="container_row1_2">
                                    <span class="material-symbols-outlined">star</span>
                                    <h5>Đánh giá: </h5>
                                    <?php if (mysqli_num_rows($select_rating) > 0) {
                                        $count = 0;
                                        while ($fetch_rating = mysqli_fetch_assoc($select_rating)) {
                                            $count += $fetch_rating['rating'];
                                        }
                                        $rating1=number_format((($count/10)/mysqli_num_rows($select_rating))*0.5,1);
                                      ?>
                                        <p id="point"><?=$rating1 ?></p>
                                      <?php 
                                      
                                    } 
                                    ?>
                                  
                                    <p id="qtt_point">(<?=mysqli_num_rows($select_rating) ?> lượt đánh giá)</p>
                                </div>
                                <div class="container_row1_2">
                                    <span class="material-symbols-outlined">sms</span>
                                    <h5>Trò chuyện: </h5>
                                    <p id="point"><i class="fa-solid fa-wrench"></i></p>
                                </div>
                                <div class="container_row1_2">
                                    <span class="material-symbols-outlined">build</span>
                                    <h5>Ngày Thành lập:</h5>
                                    <p id="point">18/7/2023</p>
                                </div>
                            </div>
                        </div>
                        <div class="child_second_child_top_2">
                            <p class="title_child_top_2">Bán chạy nhất của năm</p>
                            <i class="fa-solid fa-trophy"></i>
                        </div>
                        <div class="child_second_child_top_3">
                            <p class="title_child_top_2">Uy tín nhất của năm</p>
                            <i class="fa-solid fa-medal"></i>
                        </div>
                    </div>
                    <div class="card_top_second_child_down">
                        <div class="main_contact"><i class="fa-brands fa-github"></i>
                            <h5>SBTC.TEAM</h5>
                        </div>
                        <div class="main_contact"><i class="fa-brands fa-instagram"></i></i>
                            <h5>SBTC.TEAM</h5>
                        </div>
                        <div class="main_contact"><i class="fa-brands fa-facebook"></i></i>
                            <h5>SBTC.TEAM</h5>
                        </div>
                        <div class="main_contact"><i class="fa-regular fa-envelope"></i></i>
                            <h5>SBTC.TEAM</h5>
                        </div>
                        <div class="main_contact"><i class="fa-brands fa-twitter"></i></i>
                            <h5>SBTC.TEAM</h5>
                        </div>
                        <div class="main_contact end_ct"><i class="fa-solid fa-phone"></i></i>
                            <h5>0123456789</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container_shop_main">
                <div class="tab_box">

                    <div class="linee"></div>
                </div>
                <div class="content_box">
                    <div id="contenta" class="content_shop active_product">
                        <?php $select_all_typeproduct = mysqli_query($conn, "SELECT * From `products`");
                        if (mysqli_num_rows($select_all_typeproduct) > 0) {
                            while ($fetch_all_typeproduct = mysqli_fetch_assoc($select_all_typeproduct)) { ?>
                                <li class="card">
                                    <a class="fa-regular fa-heart fav" id="love2" data-value="<?= $fetch_all_typeproduct['id'] ?>"></a>
                                    <div class="img_shop">
                                        <a href="detailproduct.php?pid=<?=$fetch_all_typeproduct['id']?>"><img src="image/<?= $fetch_all_typeproduct['image'] ?>" alt="img" draggable="false"></a>
                                    </div>

                                    <div class="bottom_card_shop">
                                        <div class="bottom_top_card_shop">
                                            <h2><?= $fetch_all_typeproduct['name'] ?> </h2>
                                            <p><?= number_format($fetch_all_typeproduct['new_price']) ?> VND</p>
                                        </div>
                                        <div class="main_button_shop">
                                            <div class="main_desc_shop">
                                                <h4><?= $fetch_all_typeproduct['product_detail'] ?></h4>
                                            </div>
                                            <button id="btnnsp" class="button_shop" value="<?= $fetch_all_typeproduct['id'] ?>">
                                                <span><i class="fa-solid fa-cart-plus"></i></span>
                                                <div class="cart">
                                                    <svg viewBox="0 0 36 26">
                                                        <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                                        <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Hàm thực hiện cập nhật lại dữ liệu trong header.php
        function updateHeaderData() {
            $.ajax({
                url: 'http://localhost/shop/webbanhang/update_header.php',
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
        setInterval(function() {
            updateHeaderData();
        }, 1000);

        // Gọi hàm cập nhật dữ liệu khi trang được load
        updateHeaderData();
    </script>
    <script>
        // Xử lý sự kiện khi click vào nút có id="btn-menus"
        $(document).on('click', '.checksp', function() {
            var btnval = $(this).val();
            // Tạo object data để gửi qua Ajax request
            var data = {
                buttonValue: btnval
            };
            $.ajax({
                url: 'http://localhost/shop/webbanhang/productshop.php',
                type: 'POST',
                dataType: 'html',
                data: data,
                success: function(response) {
                    console.log(data);
                    console.log(response); // Xem dữ liệu phản hồi
                    $('#contenta').empty();
                    $('#contenta').html(response);
                    document.querySelectorAll('.button_shop').forEach(button => button.addEventListener('click', e => {
                        if (!button.classList.contains('loading')) {
                            button.classList.add('loading');
                            setTimeout(() => button.classList.remove('loading'), 3700);
                        }
                        e.preventDefault();
                    }));
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        });
        $(document).on('click', '#cbx-price1', function() {
            var btnval = $(this).val();
            // Tạo object data để gửi qua Ajax request
            var data = {
                buttonValue1: btnval
            };
            $.ajax({
                url: 'http://localhost/shop/webbanhang/productshop.php',
                type: 'POST',
                dataType: 'html',
                data: data,
                success: function(response) {
                    console.log(data);
                    console.log(response); // Xem dữ liệu phản hồi
                    $('#contenta').empty();
                    $('#contenta').html(response);
                    document.querySelectorAll('.button_shop').forEach(button => button.addEventListener('click', e => {
                        if (!button.classList.contains('loading')) {
                            button.classList.add('loading');
                            setTimeout(() => button.classList.remove('loading'), 3700);
                        }
                        e.preventDefault();
                    }));
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        });
        $(document).on('click', '#cbx-price2', function() {
            var btnval = $(this).val();
            // Tạo object data để gửi qua Ajax request
            var data = {
                buttonValue2: btnval
            };
            $.ajax({
                url: 'http://localhost/shop/webbanhang/productshop.php',
                type: 'POST',
                dataType: 'html',
                data: data,
                success: function(response) {
                    console.log(data);
                    console.log(response); // Xem dữ liệu phản hồi
                    $('#contenta').empty();
                    $('#contenta').html(response);
                    document.querySelectorAll('.button_shop').forEach(button => button.addEventListener('click', e => {
                        if (!button.classList.contains('loading')) {
                            button.classList.add('loading');
                            setTimeout(() => button.classList.remove('loading'), 3700);
                        }
                        e.preventDefault();
                    }));
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        });
    </script>
     <script>
        $(document).on('click', '#clickbtn', function() {
            var inputValue = $('#searchInput').val();
            // Tạo object data để gửi qua Ajax request
            var data = {
                inputValue: inputValue
            };
            $.ajax({
                url: 'http://localhost/shop/webbanhang/productshop.php',
                type: 'POST',
                dataType: 'html',
                data: data,
                success: function(response) {
                    $('#contenta').empty();
                    $('#contenta').html(response);
                    document.querySelectorAll('.button_shop').forEach(button => button.addEventListener('click', e => {
                        if (!button.classList.contains('loading')) {
                            button.classList.add('loading');
                            setTimeout(() => button.classList.remove('loading'), 3700);
                        }
                        e.preventDefault();
                    }));
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        });
        </script>
    <script>
        $(document).on('click', '#btnnsp', function() {
            var btnval = $(this).val();
            // Tạo object data để gửi qua Ajax request
            
            var data = {
                pid: btnval
            };
            $.ajax({
                url: '',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(responsee) {
                    if(responsee)
                   {
                    swal("Error!", responsee.message, "error")
                   }
                    // setTimeout(reloadPage, 4000);

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        });
        $(document).on('click', '#love2', function() {
            var lovevalue = $(this).data('value');
            // Tạo object data để gửi qua Ajax request
            var data = {
                lovevalue: lovevalue
            };
            $.ajax({
                url: '',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(response) {
                    if(response)
                   {
                    swal("Error!", response.messagea, "error")
                   }
                },
                error: function(xhr, status, error) {
                    console.log(data);
                    console.log(xhr.responseText);
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        });
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