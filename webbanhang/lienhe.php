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
if(isset($_POST['firstName']))
{
    $firstName=$_POST['firstName'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $rating=$_POST['rating']*10;
    $message=$_POST['message'];
    if($rating>=10 && $rating<=100 && $phone>=1000000000 && $phone<=9999999999)
    {
        mysqli_query($conn,"INSERT INTO `message`( `use_id`, `name`, `email`, `number`, `message`, `rating`) VALUES ('$user_id','$firstName','$email','$phone','$message','$rating')");
    }
    echo json_encode(['success' => true]);
    exit();
}
?>
<style type="text/css">
    <?php
    include 'lienhe.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>shop</title>
</head>

<body>
    <?php include 'header.php';  ?>

    <main>
        <div class="title">Liên hệ với chúng tôi</div>
        <div class="title-info">Hãy để lại lời nhắn!</div>

        <form action="" method="" class="form">
            <div class="input-group">
                <input type="text" name="first_name" id="first-name" placeholder="Name">
                <label for="first-name">Họ và tên</label>
            </div>

            <div class="input-group">
                <input type="email" name="last_name" id="e-mail" placeholder="Email">
                <label for="last-name">Email</label>
            </div>

            <div class="input-group">
                <input type="number" name="e-mail" id="phone" min="1000000000" max="9999999999"  placeholder="Số điện thoại">
                <label for="e-mail">Số điện thoại</label>
            </div>

            <div class="input-group">
                <input type="number" name="last_number" id="rating" min='1' max='10' placeholder="Đánh giá">
                <label for="last-name">Đánh giá shop (1->10 điểm)</label>
            </div>

            <div class="textarea-group">
                <textarea name="message" id="message" rows="5" placeholder="Message"></textarea>
                <label for="message">Lời nhắn</label>
            </div>

            <div class="button-div">
                <button id="sendmessage" type="submit">Gửi</button>
            </div>
        </form>
    </main>

    <footer>
        <a href="#" target="_blank"><img class="social-media-img" src="image/social_media/facebook.svg" alt="Facebook"></a>
        <a href="#" target="_blank"><img class="social-media-img" src="image/social_media/github.svg" alt="GitHub"></a>
        <a href="#" target="_blank"><img class="social-media-img" src="image/social_media/instagram.svg" alt="Instagram"></a>

        <a href="#"><img class="codecell-img" src="image/sbtclogo.png" alt="TSEC CodeCell"></a>

        <a href="#" target="_blank"><img class="social-media-img" src="image/social_media/linkedin.svg" alt="LinkedIn"></a>
        <a href="#" target="_blank"><img class="social-media-img" src="image/social_media/twitter.svg" alt="Twitter"></a>
        <a href="#" target="_blank"><img class="social-media-img" src="image/social_media/youtube.svg" alt="YouTube"></a>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
         $(document).ready(function() {
        $(document).on('click','#sendmessage',function() {
            // Lấy giá trị từ các trường input
            let firstName = $('#first-name').val();
            let phone = $('#phone').val();
            let email = $('#e-mail').val();
            let rating = $('#rating').val();
            let message = $('#message').val();
            var data = {
                firstName:firstName,
                phone:phone,
                email:email,
                rating:rating,
                message:message
            }
            $.ajax({
                url: '',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(response) {
                    console.log(data);
                     
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        });
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
    });
    </script>
    <script>
        const dropdown = document.querySelector(".dropdown");
        const account = document.querySelector(".account");

        account.addEventListener(
            "click",
            (event) => {
                dropdown.classList.toggle("hide");
                event.stopPropagation();
            }
        );

        window.addEventListener(
            "click",
            () => {
                dropdown.classList.add("hide");
            }
        );
    </script>

    <script src="./script2.js"></script>
</body>

</html>