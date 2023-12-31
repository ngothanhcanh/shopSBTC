<?php $page='about';
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
    include 'main.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>shop</title>
</head>

<body>
    <?php include 'header.php';  ?>

    <div class="containerrr">
          <div class="carddd">
            <div class="contenttt">
              <div class="img"><img src="image/duongthang.webp"></div>
              <div class="cardContent">
                <h3>Duong Thang<br><span>Web(Front-End) & App Developer</span></h3>
              </div>
            </div>
            <ul class="sci">
              <li style="--i:1">
                <a href="https://www.facebook.com/profile.php?id=100023169051128"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a>
              </li>
              <li style="--i:2">
                <a href="#"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
              </li>
              <li style="--i:3">
                <a href="#"><i class="fa-brands fa-github" aria-hidden="true"></i></a>
              </li>
          </ul>
          </div>
          <div class="carddd">
            <div class="contenttt">
              <div class="img"><img src="image/vanthuan.jpg"></div>
              <div class="cardContent">
                <h3>Le Van Thuan<br><span>Grafic Designer & Tester</span></h3>
              </div>
            </div>
            <ul class="sci">
              <li style="--i:1">
                <a href="https://www.facebook.com/thuan.levan.1257"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a>
              </li>
              <li style="--i:2">
                <a href="#"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
              </li>
              <li style="--i:3">
                <a href="#"><i class="fa-brands fa-github" aria-hidden="true"></i></a>
              </li>
          </ul>
          </div>
          <div class="carddd">
            <div class="contenttt">
              <div class="img"><img src="image/thanhcanh.jpg"></div>
              <div class="cardContent">
                <h3>Ngo Thanh Canh<br><span>WEB Developer (Back-End)</span></h3>
              </div>
            </div>
            <ul class="sci">
              <li style="--i:1">
                <a href="https://www.facebook.com/ngothanhcanh02"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a>
              </li>
              <li style="--i:2">
                <a href="https://www.instagram.com/ngothanhcanh2001/"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
              </li>
              <li style="--i:3">
                <a href="https://github.com/ngothanhcanh"><i class="fa-brands fa-github" aria-hidden="true"></i></a>
              </li>
          </ul>
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
    <style>
         :root {
  --color-one: #990033;
  --color-two: #161623;
  --color-negro: #020202;
  --color-blanco: #ffffff;
  --color-sombra: #000000;
}

@keyframes colorful {
  0% {
    filter: hue-rotate(0deg);
  }
  100% {
    filter: hue-rotate(360deg);
  }
}

*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
  list-style: none;
  outline: none;
  appearance: none;
  border-style: none;

  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

h1, h2, h3, span, p {
  font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
}

html, body {
  width: 100%;
  height: 100%;
  background: var(--color-two);
  position: relative;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;

}

body::-webkit-scrollbar {
  background: var(--color-negro);
  width: 10px;
}

body::-webkit-scrollbar-track {
  background: var(--color-negro);
}

body::-webkit-scrollbar-thumb {
  background: var(--color-blanco);
  border-radius: 1px;
}

body::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(#f00, #f0f);
  clip-path: circle(30% at right 70%);
}

body::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(#2196f3, #e91e63);
  clip-path: circle(20% at 10% 10%);
}

.containerrr {
  position: relative;
  z-index: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  padding: 1em;
}

.carddd {
  position: relative;
  width: 300px;
  height: 400px;
  margin: 1em;
  background: rgba(255, 255, 255, 0.05);
  box-shadow: 0 15px 35px rgba(0, 0, 0, .2);
  border-radius: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  backdrop-filter: blur(40px);
  border: solid 2px transparent;
  background-clip: padding-box;
  box-shadow: 0px 10px 10px rgba(46, 54, 68, 0.03);
}

.carddd .contenttt {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  opacity: 0.5;
  transition: 0.5s;
}

.carddd .contenttt .img {
  position: relative;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  overflow: hidden;
  border: 10px solid rgba(0, 0, 0, .25);
}

.carddd .contenttt .img img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.carddd .contenttt .cardContent h3 {
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 2px;
  font-weight: 500;
  font-size: 18px;
  text-align: center;
  margin: 20px 0 10px;
  line-height: 1.1em;
}

.carddd.contenttt .cardContent h3 span {
  font-size: 12px;
  font-weight: 300;
  text-transform: initial;
}

.carddd .sci {
  position: absolute;
  bottom: 50px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.carddd .sci li {
  margin: 0 10px;
  transform: translateY(40px);
  opacity: 0;
  transition: 0.5s;
}

.carddd .sci li a {
  font-size: 24px;
}

.carddd:hover .contenttt {
  opacity: 1;
  transform: translateY(-20px);
}

.carddd:hover .sci li {
  transform: translateY(0px);
  opacity: 1;
}
    </style>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.navbar a',function(){
            $(this).addClass('activemenu').siblings().removeClass('activemenu')
        })
    </script>
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
    <script src="./script2.js"></script>
</body>

</html>