<?php
include 'connection.php';
session_start();
if (isset($_POST['submit-btn'])) {

    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, $filter_password);

    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password ='$password'  ") or die('query failed');

    if (mysqli_num_rows($select_user) > 0) {
        $row = mysqli_fetch_assoc($select_user);
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_pannel.php');
        } else if ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
        } else {
            $messege[] = 'incorrect email or password';
        }
    } else {
        $messege[] = 'incorrect email or password';
        // header("Refresh:1 url=login.php");
    }
}
if (isset($_POST['btnregister'])) {
    if (empty($_POST['rename']) && empty($_POST['reemail']) && empty($_POST['repassword'] && empty($_POST['recpassword']))) {
        $response['message'] = 'Không được để trống';
    } else {
        $filter_name = filter_var($_POST['rename'], FILTER_SANITIZE_STRING);
        $name = mysqli_real_escape_string($conn, $filter_name);

        $filter_email = filter_var($_POST['reemail'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['repassword'], FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($conn, $filter_password);

        $filter_cpassword = filter_var($_POST['recpassword'], FILTER_SANITIZE_STRING);
        $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

        if (mysqli_num_rows($select_user) > 0) {
            $response['message'] = 'Tài khoản đã tồn tại';
        } else if ($password != $cpassword) {
            $response['message'] = 'Mật khẩu không giống nhau';
        } else {
            mysqli_query($conn, "INSERT INTO  `users` (`name`,`email`,`password`) VALUES ('$name','$email','$password')") or die('query failed');
            $response['success'] = 'Đăng ký thành công';
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="backgroundfull"></div>
    <div class="background"></div>
    <div class="container">
        <div class="content">
            <h2 class="logo"><img src="image/sbtclogo.png" style="opacity: 0.9;" alt=""></h2>
            <div class="text-sci">
                <h2>Welcome! <br> <span>To Our New Website</span></h2>
                <div class="social-icons">
                    <a href="https://github.com/ngothanhcanh/shopSBTC"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.facebook.com/ngothanhcanh02/"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.instagram.com/ngothanhcanh2001/"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        <div class="logreg-box">
            <div class="form-box login">
                <form method="POST">
                    <h2>Sign In</h2>
                    <div class="input-box">
                        <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                        <input name="email" type="email" required>
                        <label>Email</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class="fa-solid fa-lock"></i></span>
                        <input name="password" type="password" required>
                        <label>Password</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox">Remember me</label>
                        <a href="#">Forgot password</a>
                    </div>

                    <button name="submit-btn" type="submit" class="btn" value="Login">
                        Sign In
                    </button>
                    <div class="login-register">
                        <p>Don't have account?<a href="#" class="register-link">Sign up</a></p>

                    </div>
                </form>
            </div>

            <div class="form-box register">
                <form>
                    <h2>Sign Up</h2>

                    <div class="input-box">
                        <span class="icon"><i class="fa-solid fa-user"></i></span>
                        <input id="rename" name="rename" type="text" required>
                        <label>name</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                        <input id="reemail" name="reemail" type="email" required>
                        <label>Email</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class="fa-solid fa-lock"></i></span>
                        <input id="repassword" name="repassword" type="password" required>
                        <label>Password</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class="fa-solid fa-lock"></i></span>
                        <input id="recpassword" name="recpassword" type="password" required>
                        <label>Confirm password</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox">I agree rule</label>
                    </div>

                    <button id="submit-register" type="submit" class="btn" value="submit-register">
                        Sign Up
                    </button>
                    <div class="login-register">
                        <p>I have account?<a href="#" class="login-link">Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const lorgrgBox = document.querySelector('.logreg-box');
        const loginLink = document.querySelector('.login-link');
        const registerLink = document.querySelector('.register-link');
        registerLink.addEventListener('click', () => {
            lorgrgBox.classList.add('active');
        })
        loginLink.addEventListener('click', () => {
            lorgrgBox.classList.remove('active');
        })
    </script>
    <script>
        $(document).on('click', '#submit-register', function(event) {
            event.preventDefault();
            var btnregister = $(this).val();
            let rename = $('#rename').val();
            let reemail = $('#reemail').val();
            let repassword = $('#repassword').val();
            let recpassword = $('#recpassword').val();
            var data = {
                btnregister: btnregister,
                rename: rename,
                reemail: reemail,
                repassword: repassword,
                recpassword: recpassword
            }
            $.ajax({
                url: '',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(response) {
                    if (response.message) {
                        swal("Error!", response.message, "error")
                    } else {
                        function reload()
                        {
                            location.reload();
                        }
                        swal("Success!", response.success, "success")
                        setTimeout(reload,3000)
                       
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        })
    </script>
</body>

</html>