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
if (isset($_POST['add_to_wishlist'])) {
    $Wishlist_id = $_POST['product_id'];
    $Wishlist_name = $_POST['product_name'];
    $Wishlist_price = $_POST['product_price'];
    $Wishlist_image = $_POST['product_img'];
    $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name='$Wishlist_name' AND use_id ='$user_id' ") or die('query failed');
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$Wishlist_name' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_wishlist) > 0) {
        $messege[] = 'wishlist already exist';
    } else if (mysqli_num_rows($select_cart) > 0) {
        $messege[] = 'product had already in cartory';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`( `use_id`, `pid`, `name`, `price`, `image`) VALUES ('$user_id','$Wishlist_id','$Wishlist_name','$Wishlist_price','$Wishlist_image')") or die('query failed');
        $messege[] = 'successfully';
    }
}
if (isset($_POST['add_to_cart'])) {
    $cart_id = $_POST['product_id'];
    $cart_name = $_POST['product_name'];
    $cart_price = $_POST['product_price'];
    $cart_image = $_POST['product_img'];
    $cart_quantity = $_POST['product_quantity'];

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$cart_name' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_cart) > 0) {
        $messege[] = 'product had already in cartory';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`( `use_id`, `pid`, `name`, `price`, `quantity`,`image`) VALUES ('$user_id','$cart_id','$cart_name','$cart_price','  $cart_quantity','$cart_image')") or die('query failed');
        $messege[] = 'successfully';
    }
}
if (isset($_GET['pid'])) {
    $pid_id = $_GET['pid'];
    mysqli_query($conn, "SELECT * FROM `products` Where id='$pid_id' ") or die('query failed ');
    header('location:index.php');
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
    <?php
    if (isset($messege)) {
        foreach ($messege as $messege) {
            echo '<div class="message">
           <span>' . $messege . '</span>
           <i class="click" onclick="this.parentElement.remove()">aa</i>
       </div>';
        }
    }
    ?>

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
    <h3 class="title_selling">Sản phẩm bán chạy</h3>
    <div class="container_wraper">
        <div class="wrapper">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <ul class="carousel">
                <li class="card">
                    <a class="fa-regular fa-heart fav"></a>
                    <div class="img"><img src="image/R.png" alt="img" draggable="false"></div>
                    <h2>Blanche Pearson Blanche Pearson Blanche Pearson Blanche Pearson</h2>
                    <span>120$</span>
                    <button class="buttonn">
                        <span>Add to cart</span>
                        <div class="cart">
                            <svg viewBox="0 0 36 26">
                                <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                            </svg>
                        </div>
                    </button>
                </li>
                <li class="card">
                    <a class="fa-regular fa-heart fav"></a>
                    <div class="img"><img src="image/R.png" alt="img" draggable="false"></div>
                    <h2>Joenas Brauers</h2>
                    <span>120$</span>
                    <button class="buttonn">
                        <span>Add to cart</span>
                        <div class="cart">
                            <svg viewBox="0 0 36 26">
                                <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                            </svg>
                        </div>
                    </button>
                </li>
                <li class="card">
                    <a class="fa-regular fa-heart fav"></a>
                    <div class="img"><img src="image/R.png" alt="img" draggable="false"></div>
                    <h2>Lariach French</h2>
                    <span>120$</span>
                    <button class="buttonn">
                        <span>Add to cart</span>
                        <div class="cart">
                            <svg viewBox="0 0 36 26">
                                <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                            </svg>
                        </div>
                    </button>
                </li>
                <li class="card">
                    <a class="fa-regular fa-heart fav"></a>
                    <div class="img"><img src="image/R.png" alt="img" draggable="false"></div>
                    <h2>James Khosravi</h2>
                    <span>120$</span>
                    <button class="buttonn">
                        <span>Add to cart</span>
                        <div class="cart">
                            <svg viewBox="0 0 36 26">
                                <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                            </svg>
                        </div>
                    </button>
                </li>
                <li class="card">
                    <a class="fa-regular fa-heart fav"></a>
                    <div class="img"><img src="image/R.png" alt="img" draggable="false"></div>
                    <h2>Kristina Zasiadko</h2>
                    <span>120$</span>
                    <button class="buttonn">
                        <span>Add to cart</span>
                        <div class="cart">
                            <svg viewBox="0 0 36 26">
                                <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                            </svg>
                        </div>
                    </button>
                </li>
                <li class="card">
                    <a class="fa-regular fa-heart fav"></a>
                    <div class="img"><img src="image/R.png" alt="img" draggable="false"></div>
                    <h2>Donald Horton</h2>
                    <span>120$</span>
                    <button class="buttonn">
                        <span>Add to cart</span>
                        <div class="cart">
                            <svg viewBox="0 0 36 26">
                                <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                            </svg>
                        </div>
                    </button>
                </li>
            </ul>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
    </div>
    <p class="title_seeall" style="text-align: center;">Xem tất cả sản phẩm <i class="fa-solid fa-arrow-right"></i></p>
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
    <?php  $select_all_typeproduct = mysqli_query($conn, "SELECT * From `products` Where type_product='quần áo'");
    if(mysqli_num_rows($select_all_typeproduct) > 0){
        $html = ''; // Biến chứa dữ liệu HTML
        while($fetch_all_typeproduct = mysqli_fetch_assoc($select_all_typeproduct))
        { ?>
            <li class="card">
                    <a class="fa-regular fa-heart fav"></a>
                    <div class="img"><img src="image/<?=$fetch_all_typeproduct['image']?>" alt="img" draggable="false"></div>
                    <h2><?=$fetch_all_typeproduct['product_detail']?></h2>
                    <p><?=$fetch_all_typeproduct['new_price']?>$</p>
                    <button class="buttonn">
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

            // Insert copies of the first few cards to end of carousel for infinite scrolling
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
            // const autoPlay = () => {
            //     if(window.innerWidth < 800 || !isAutoPlay) return; // Return if window is smaller than 800 or isAutoPlay is false
            //     // Autoplay the carousel after every 2500 ms
            //     timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
            // }
            // autoPlay();


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
</body>

</html>