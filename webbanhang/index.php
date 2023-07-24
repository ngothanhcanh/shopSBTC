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
if (isset($_POST['lovevalue'])) {
    $Wishlist_id = $_POST['lovevalue'];
    $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE pid='$Wishlist_id' AND use_id ='$user_id' ") or die('query failed');
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE pid='$Wishlist_id' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_wishlist) > 0) {
        $response['messagea'] = 'wishlist already exist';
    } else if (mysqli_num_rows($select_cart) > 0) {
        $response['messagea'] = 'product had already in cart';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`( `use_id`, `pid`) VALUES ('$user_id','$Wishlist_id')") or die('query failed');
        $response['messagea'] = 'successfully';
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
if (isset($_POST['pid'])) {
    $cart_id = $_POST['pid'];
    // $cart_name = $_POST['product_name'];
    // $cart_price = $_POST['product_price'];
    // $cart_image = $_POST['product_img'];
    // $cart_quantity = $_POST['product_quantity'];
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE pid='$cart_id' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_cart) > 0) {
        $response['messagea'] = 'product had already in cartory';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`( `use_id`, `pid`) VALUES ('$user_id','$cart_id')") or die('query failed');
        $response['messagea'] = 'successfully';
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}


?>
<style type="text/css">
    <?php
    include 'main.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <title>home page</title>
</head>

<body>
    <?php include 'header.php';  ?>
    <!-- home slider -->
    <div class="slider">
        <div class="list">
            <div class="item">
                <img src="img/1.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/2.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/hinh3.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/hinh4.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/5.jpg" alt="">
            </div>
        </div>
        <div class="buttons">
            <button id="prev">
            </button>
            <button id="next"></button>
        </div>
        <ul class="dots">
            <li class="active"></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <!-- Trust -->
    <div class="container_trust">
        <card data-aos="fade-up" data-aos-anchor-placement="center-center" class="card_trust">
            <div class="main_img">
                <image src="image/free-shipping.png"></image>
            </div>
            <h3 class="title_trust">Miễn phí vận chuyển</h3>
        </card>
        <card data-aos="fade-up" data-aos-anchor-placement="center-center" class="card_trust">
            <div class="main_img">
                <image src="image/24-hours-support.png"></image>
            </div>
            <h3 class="title_trust">Hổ trợ 24/7</h3>
        </card>
        <card data-aos="fade-up" data-aos-anchor-placement="center-center" class="card_trust">
            <div class="main_img">
                <image src="image/refund.png"></image>
            </div>
            <h3 class="title_trust">100% hoàn tiền</h3>
        </card>
    </div>

    <!-- Trust -->

    <!-- Sản phẩm bán chạy -->
    <div class="container_sale_top">
        <h3 class="title_selling">Sản phẩm đang giảm giá</h3>
        <img src="image/sales.gif" width="50px" height="50px" alt="">
    </div>
    <div class="container_wraper">
        <div class="wrapper">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <ul class="carousel">
                <?php $select_all_typeproduct = mysqli_query($conn, "SELECT * From `products` WHERE method ='sale'");
                if (mysqli_num_rows($select_all_typeproduct) > 0) {
                    while ($fetch_all_typeproduct = mysqli_fetch_assoc($select_all_typeproduct)) {
                ?>
                        <li class="card">
                            <a class="fa-regular fa-heart fav" id="love1" data-value="<?= $fetch_all_typeproduct['id'] ?>"></a>
                            <div class="img"><img src="image/<?= $fetch_all_typeproduct['image'] ?>" alt="img" draggable="false"></div>
                            <h2><?= $fetch_all_typeproduct['name'] ?></h2>
                            <div class="main_price">
                                <span class="price_sale"><?= $fetch_all_typeproduct['old_price'] ?>$</span>
                                <span class="price_goc"><?= $fetch_all_typeproduct['new_price'] ?>$</span>
                            </div>
                            <button id='btnsale' class="buttonn" value="<?= $fetch_all_typeproduct['id'] ?>">
                                <span>Add to cart</span>
                                <div class="cart">
                                    <svg viewBox="0 0 36 26">
                                        <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                        <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                    </svg>
                                </div>
                            </button>
                        </li>
                <?php }
                } ?>
            </ul>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
    </div>
    <a href="shop.php">
        <p class="title_seeall" style="text-align: center;">Xem tất cả sản phẩm <i class="fa-solid fa-arrow-right"></i></p>
    </a>
    <!-- Sản phẩm bán chạy -->

    <!-- Loại sản phẩm (Tab_Horizontal)  -->

    <div class="container">
        <div class="tab_box">
            <?php $select_menu = mysqli_query($conn, "SELECT type_product From menu_product");
            if (mysqli_num_rows($select_menu) > 0) {
                while ($fetch_menu = mysqli_fetch_assoc($select_menu)) {
            ?>
                    <button id="btn-menus" class="tab_btn active_product" value="<?= $fetch_menu['type_product'] ?>"><?= $fetch_menu['type_product'] ?></button>
            <?php

                }
            }
            ?>
            <div class="linee"></div>
        </div>
        <div class="content_box">
            <div id="contenta" class="content active_product">
                <?php $select_all_typeproduct = mysqli_query($conn, "SELECT * From `products` Where type_product='quần áo'");
                if (mysqli_num_rows($select_all_typeproduct) > 0) {
                    while ($fetch_all_typeproduct = mysqli_fetch_assoc($select_all_typeproduct)) { ?>
                        <li class="card">
                            <a class="fa-regular fa-heart fav" id="love2" data-value="<?= $fetch_all_typeproduct['id'] ?>"></a>
                            <div class="img"><img src="image/<?= $fetch_all_typeproduct['image'] ?>" alt="img" draggable="false"></div>
                            <h2><?= $fetch_all_typeproduct['product_detail'] ?></h2>
                            <p><?= $fetch_all_typeproduct['new_price'] ?>$</p>
                            <button id="btnnsp" class="buttonn" value="<?= $fetch_all_typeproduct['id']?>">
                                <span>Add to cart</span>
                                <div class="cart">
                                    <svg viewBox="0 0 36 26">
                                        <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                        <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                    </svg>
                                </div>
                            </button>
                        </li>

                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    </div>

    <!-- discount -->
    <div data-aos="fade-up" class="container_discount">
        <div class="title_discount">
            <h1 id="see_discount1">Nhận lại 5% tiền mặt</h1>
            <p id="see_discount2">trên sbtc.com</p>
            <p id="see_discount3">Xem ngay</p>
        </div>

        <div class="img_discount">
            <div class="flip-carddd">
                <div class="flip-card-innerrr">
                    <div class="flip-card-fronttt">
                        <p class="heading_826444">SBTCCARD</p>
                        <svg class="logooo" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="36" height="36" viewBox="0 0 48 48">
                            <path fill="#ff9800" d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z"></path>
                            <path fill="#d50000" d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z"></path>
                            <path fill="#ff3d00" d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z"></path>
                        </svg>
                        <svg version="1.1" class="chippp" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 50 50" xml:space="preserve">
                            <image id="image0" width="50" height="50" x="0" y="0" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
              AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAB6VBMVEUAAACNcTiVeUKVeUOY
              fEaafEeUeUSYfEWZfEaykleyklaXe0SWekSZZjOYfEWYe0WXfUWXe0WcgEicfkiXe0SVekSXekSW
              ekKYe0a9nF67m12ZfUWUeEaXfESVekOdgEmVeUWWekSniU+VeUKVeUOrjFKYfEWliE6WeESZe0GS
              e0WYfES7ml2Xe0WXeESUeEOWfEWcf0eWfESXe0SXfEWYekSVeUKXfEWxklawkVaZfEWWekOUekOW
              ekSYfESZe0eXekWYfEWZe0WZe0eVeUSWeETAnmDCoWLJpmbxy4P1zoXwyoLIpWbjvXjivnjgu3bf
              u3beunWvkFWxkle/nmDivXiWekTnwXvkwHrCoWOuj1SXe0TEo2TDo2PlwHratnKZfEbQrWvPrWua
              fUfbt3PJp2agg0v0zYX0zYSfgkvKp2frxX7mwHrlv3rsxn/yzIPgvHfduXWXe0XuyIDzzISsjVO1
              lVm0lFitjVPzzIPqxX7duna0lVncuHTLqGjvyIHeuXXxyYGZfUayk1iyk1e2lln1zYTEomO2llrb
              tnOafkjFpGSbfkfZtXLhvHfkv3nqxH3mwXujhU3KqWizlFilh06khk2fgkqsjlPHpWXJp2erjVOh
              g0yWe0SliE+XekShhEvAn2D///+gx8TWAAAARnRSTlMACVCTtsRl7Pv7+vxkBab7pZv5+ZlL/UnU
              /f3SJCVe+Fx39naA9/75XSMh0/3SSkia+pil/KRj7Pr662JPkrbP7OLQ0JFOijI1MwAAAAFiS0dE
              orDd34wAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0IDx2lsiuJAAACLElEQVRIx2Ng
              GAXkAUYmZhZWPICFmYkRVQcbOwenmzse4MbFzc6DpIGXj8PD04sA8PbhF+CFaxEU8iWkAQT8hEVg
              OkTF/InR4eUVICYO1SIhCRMLDAoKDvFDVhUaEhwUFAjjSUlDdMiEhcOEItzdI6OiYxA6YqODIt3d
              I2DcuDBZsBY5eVTr4xMSYcyk5BRUOXkFsBZFJTQnp6alQxgZmVloUkrKYC0qqmji2WE5EEZuWB6a
              lKoKdi35YQUQRkFYPpFaCouKIYzi6EDitJSUlsGY5RWVRGjJLyxNy4ZxqtIqqvOxaVELQwZFZdkI
              JVU1RSiSalAt6rUwUBdWG1CP6pT6gNqwOrgCdQyHNYR5YQFhDXj8MiK1IAeyN6aORiyBjByVTc0F
              qBoKWpqwRCVSgilOaY2OaUPw29qjOzqLvTAchpos47u6EZyYnngUSRwpuTe6D+6qaFQdOPNLRzOM
              1dzhRZyW+CZouHk3dWLXglFcFIflQhj9YWjJGlZcaKAVSvjyPrRQ0oQVKDAQHlYFYUwIm4gqExGm
              BSkutaVQJeomwViTJqPK6OhCy2Q9sQBk8cY0DxjTJw0lAQWK6cOKfgNhpKK7ZMpUeF3jPa28BCET
              amiEqJKM+X1gxvWXpoUjVIVPnwErw71nmpgiqiQGBjNzbgs3j1nus+fMndc+Cwm0T52/oNR9lsdC
              S24ra7Tq1cbWjpXV3sHRCb1idXZ0sGdltXNxRateRwHRAACYHutzk/2I5QAAACV0RVh0ZGF0ZTpj
              cmVhdGUAMjAyMy0wMi0xM1QwODoxNToyOSswMDowMEUnN7UAAAAldEVYdGRhdGU6bW9kaWZ5ADIw
              MjMtMDItMTNUMDg6MTU6MjkrMDA6MDA0eo8JAAAAKHRFWHRkYXRlOnRpbWVzdGFtcAAyMDIzLTAy
              LTEzVDA4OjE1OjI5KzAwOjAwY2+u1gAAAABJRU5ErkJggg=="></image>
                        </svg>
                        <svg version="1.1" class="contactlessss" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 50 50" xml:space="preserve">
                            <image id="image0" width="50" height="50" x="0" y="0" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAQAAAC0NkA6AAAABGdBTUEAALGPC/xhBQAAACBjSFJN
              AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
              cwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0IEzgIwaKTAAADDklEQVRYw+1XS0iUURQ+f5qPyjQf
              lGRFEEFK76koKGxRbWyVVLSOgsCgwjZBJJYuKogSIoOonUK4q3U0WVBWFPZYiIE6kuArG3VGzK/F
              fPeMM/MLt99/NuHdfPd888/57jn3nvsQWWj/VcMlvMMd5KRTogqx9iCdIjUUmcGR9ImUYowyP3xN
              GQJoRLVaZ2DaZf8kyjEJALhI28ELioyiwC+Rc3QZwRYyO/DH51hQgWm6DMIh10KmD4u9O16K49it
              VoPOAmcGAWWOepXIRScAoJZ2Frro8oN+EyTT6lWkkg6msZfMSR35QTJmjU0g15tIGSJ08ZZMJkJk
              HpNZgSkyXosS13TkJpZ62mPIJvOSzC1bp8vRhhCakEk7G9/o4gmZdbpsTcKu0m63FbnBP9Qrc15z
              bkbemfgNDtEOI8NO5L5O9VYyRYgmJayZ9nPaxZrSjW4+F6Uw9yQqIiIZwhp2huQTf6OIvCZyGM6g
              DJBZbyXifJXr7FZjGXsdxADxI7HUJFB6iWvsIhFpkoiIiGTJfjJfiCuJg2ZEspq9EHGVpYgzKqwJ
              qSAOEwuJQ/pxPvE3cYltJCLdxBLiSKKIE5HxJKcTRNeadxfhDiuYw44zVs1dxKwRk/uCxIiQkxKB
              sSctRVAge9g1E15EHE6yRUaJecRxcWlukdRIbGFOSZCMWQA/iWauIP3slREHXPyliqBcrrD71Amz
              Z+rD1Mt2Yr8TZc/UR4/YtFnbijnHi3UrN9vKQ9rPaJf867ZiaqDB+czeKYmd3pNa6fuI75MiC0uX
              XSR5aEMf7s7a6r/PudVXkjFb/SsrCRfROk0Fx6+H1i9kkTGn/E1vEmt1m089fh+RKdQ5O+xNJPUi
              cUIjO0Dm7HwvErEr0YxeibL1StSh37STafE4I7zcBdRq1DiOkdmlTJVnkQTBTS7X1FYyvfO4piaI
              nKbDCDaT2anLudYXCRFsQBgAcIF2/Okwgvz5+Z4tsw118dzruvIvjhTB+HOuWy8UvovEH6beitBK
              xDyxm9MmISKCWrzB7bSlaqGlsf0FC0gMjzTg6GgAAAAldEVYdGRhdGU6Y3JlYXRlADIwMjMtMDIt
              MTNUMDg6MTk6NTYrMDA6MDCjlq7LAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDIzLTAyLTEzVDA4OjE5
              OjU2KzAwOjAw0ssWdwAAACh0RVh0ZGF0ZTp0aW1lc3RhbXAAMjAyMy0wMi0xM1QwODoxOTo1Nisw
              MDowMIXeN6gAAAAASUVORK5CYII="></image>
                        </svg>
                        <p class="numberrr">9759 2484 5269 6576</p>
                        <p class="valid_thruuu">VALID THRU</p>
                        <p class="date_826444">1 2 / 2 4</p>
                        <p class="nameee">SBTC.COM</p>
                    </div>
                    <div class="flip-card-backkk">
                        <div class="strippp"></div>
                        <div class="mstrippp"></div>
                        <div class="sstrippp">
                            <p class="codeee">***</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- discount -->


    <!--Feed back customers  -->
    <div class="parent_top_fb">
        <p class="title_fake_fb">Đánh giá của khách hàng</p>
        <img src="image/feedback.gif" width="50px" height="50px" alt="">
    </div>
    <div class="parent_container_fb">
        <div data-aos="fade-up" class="contaier_fb">
            <?php
            $count = 0;
            $select_message=mysqli_query($conn,"SELECT * FROM `message` ORDER BY id DESC");
            if(mysqli_num_rows($select_message)>0){
                while($fetch_message=mysqli_fetch_assoc($select_message))
                { 
                    if($count ==3)
                    {
                        break;
                    }
            ?>
            <div class="card_fb" >
                <div class="icon_fb">
                    <img src="image/duongthang.webp" alt="">
                </div>
                <div class="title_fb"><?=$fetch_message['name'] ?></div>
                <p class="description_fb"><?=$fetch_message['message'] ?></p>
                <div class="rating_fb" style="--rating:<?=$fetch_message['rating'] ?>"></div>
            </div>
            <?php
            $count ++;
              }
            }
            ?>
        </div>

    </div>
    


    <!-- Loại sản phẩm (Tab_Horizontal)  -->
    <!-- <-?php include 'homeshop.php';  ?> -->
    <script src="./script2.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Xử lý sự kiện khi click vào div có class "tab_box"
        // Xử lý sự kiện khi click vào các tab
        const tabs = document.querySelectorAll('.tab_btn');
        const all_content = document.querySelectorAll('.content');

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', (e) => {
                tabs.forEach(tab => {
                    tab.classList.remove('active_product')
                });
                tab.classList.add('active_product');

                // Kiểm tra xem index có nằm trong phạm vi hợp lệ của all_content hay không
                if (index >= 0 && index < all_content.length) {
                    all_content.forEach(content => {
                        content.classList.remove('active_product')
                    });
                    all_content[index].classList.add('active_product');
                }
            })
        });

        // Xử lý sự kiện khi click vào nút có id="btn-menus"
        $(document).on('click', '#btn-menus', function() {
            var btnval = $(this).val();
            // Tạo object data để gửi qua Ajax request
            var data = {
                buttonValue: btnval
            };
            $.ajax({
                url: 'http://localhost/shop/webbanhang/product.php',
                type: 'POST',
                dataType: 'html',
                data: data,
                success: function(response) {
                    console.log(data);
                    console.log(response); // Xem dữ liệu phản hồi
                    $('#contenta').empty();
                    $('#contenta').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        });
        $(document).on('click', '#btnsale ,#btnnsp', function() {
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
                success: function(response) {
                    function reloadPage() {
                         alert(response.messagea);
                        location.reload();
                    }
                    setTimeout(reloadPage, 4000);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        });
        $(document).on('click', '#love1 ,#love2', function() {
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
                    alert(response.messagea);
                    location.reload();
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
        AOS.init();
    </script>
    <script>
        // Auto Slick slider
        let slider = document.querySelector('.slider .list');
        let items = document.querySelectorAll('.slider .list .item');
        let next = document.getElementById('next');
        let prev = document.getElementById('prev');
        let dots = document.querySelectorAll('.slider .dots li');

        let lengthItems = items.length - 1;
        let active = 0;
        next.onclick = function() {
            active = active + 1 <= lengthItems ? active + 1 : 0;
            reloadSlider();
        }
        prev.onclick = function() {
            active = active - 1 >= 0 ? active - 1 : lengthItems;
            reloadSlider();
        }
        let refreshInterval = setInterval(() => {
            next.click()
        }, 3000);

        function reloadSlider() {
            slider.style.left = -items[active].offsetLeft + 'px';
            // 
            let last_active_dot = document.querySelector('.slider .dots li.active');
            last_active_dot.classList.remove('active');
            dots[active].classList.add('active');

            clearInterval(refreshInterval);
            refreshInterval = setInterval(() => {
                next.click()
            }, 3000);
        }

        dots.forEach((li, key) => {
            li.addEventListener('click', () => {
                active = key;
                reloadSlider();
            })
        })
        window.onresize = function(event) {
            reloadSlider();
        };
        //End Auto slick slider
    </script>
    <script>
        const wrapper = document.querySelector(".wrapper");
        const carousel = document.querySelector(".carousel");
        const firstCardWidth = carousel.querySelector(".card").offsetWidth;
        const arrowBtns = document.querySelectorAll(".wrapper i");
        const carouselChildrens = [...carousel.children];

        let isDragging = false,
            isAutoPlay = true,
            startX, startScrollLeft, timeoutId;

        // Get the number of cards that can fit in the carousel at once
        let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

        // Insert copies of the last few cards to beginning of carousel for infinite scrolling
        carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
            carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
        });

        // // Insert copies of the first few cards to end of carousel for infinite scrolling
        carouselChildrens.slice(0, cardPerView).forEach(card => {
            carousel.insertAdjacentHTML("beforeend", card.outerHTML);
        });

        // Scroll the carousel at appropriate postition to hide first few duplicate cards on Firefox
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.offsetWidth;
        carousel.classList.remove("no-transition");

        // Add event listeners for the arrow buttons to scroll the carousel left and right
        arrowBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                carousel.scrollLeft += btn.id == "left" ? -firstCardWidth : firstCardWidth;
            });
        });

        const dragStart = (e) => {
            isDragging = true;
            carousel.classList.add("dragging");
            // Records the initial cursor and scroll position of the carousel
            startX = e.pageX;
            startScrollLeft = carousel.scrollLeft;
        }

        const dragging = (e) => {
            if (!isDragging) return; // if isDragging is false return from here
            // Updates the scroll position of the carousel based on the cursor movement
            carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
        }

        const dragStop = () => {
            isDragging = false;
            carousel.classList.remove("dragging");
        }

        const infiniteScroll = () => {
            // If the carousel is at the beginning, scroll to the end
            if (carousel.scrollLeft === 0) {
                carousel.classList.add("no-transition");
                carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
                carousel.classList.remove("no-transition");
            }
            // If the carousel is at the end, scroll to the beginning
            else if (Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
                carousel.classList.add("no-transition");
                carousel.scrollLeft = carousel.offsetWidth;
                carousel.classList.remove("no-transition");
            }

            // Clear existing timeout & start autoplay if mouse is not hovering over carousel
            // clearTimeout(timeoutId);
            // if (!wrapper.matches(":hover")) autoPlay();
        }

        // Auto play if u want
        const autoPlay = () => {
            if (window.innerWidth < 800 || !isAutoPlay) return; // Return if window is smaller than 800 or isAutoPlay is false
            // Autoplay the carousel after every 2500 ms
            timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
        }
        autoPlay();


        carousel.addEventListener("mousedown", dragStart);
        carousel.addEventListener("mousemove", dragging);
        document.addEventListener("mouseup", dragStop);
        carousel.addEventListener("scroll", infiniteScroll);
        wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
        wrapper.addEventListener("mouseleave", autoPlay);
    </script>
    <script>
        document.querySelectorAll('.buttonn').forEach(button => button.addEventListener('click', e => {
            if (!button.classList.contains('loading')) {

                button.classList.add('loading');

                setTimeout(() => button.classList.remove('loading'), 3700);

            }
            e.preventDefault();
        }));
    </script>

    <div class="line3"></div>
    <?php include 'footer.php' ?>
</body>

</html>