<?php
include 'connection.php';
include  './PHPMailer/index.php';
session_start();
if (isset($_POST['btnforgot'])) {
    $mail = new Mailer();
    $filter_name = filter_var($_POST['newEmail'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_name);
    $code = substr(rand(0, 9999999), 0, 6);
    $title = "Quên mật khẩu";
    $content = "Mã xác nhận của bạn là: <span style='color:green'>" . $code . "</span>";
    if (!empty($email)) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email'")) > 0) {
                $_SESSION['email'] = $email;
                $_SESSION['OTP'] = $code;
                $updatemk = mysqli_query($conn, "UPDATE `users` SET `OTP`='$code' WHERE email = '$email'");
                $mail->sendMail($title, $content, $email);
                echo 'ok';
            }  else {
           echo 'Email của bản không tồn tại';
           exit();
        }
    } else {
       echo 'Hãy điền email để lấy mật khẩu';
       exit();
    }
    exit();
}

if (isset($_POST['submitbtn'])) {

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
            $response['success']='ok';
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        } else if ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            $response['success1']='ok';
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        } else {
            $response['message'] = 'incorrect email or password';
        }
    } else {
        $response['message'] = 'incorrect email or password';
        
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
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
    <img id="loading-gif" src="image/R.gif" alt="Loading..."> 
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
                <form>
                    <h2>Đăng Nhập</h2>
                    <div class="input-box">
                        <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                        <input id="emaillogin" name="email" type="email" required>
                        <label>Email</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class="fa-solid fa-lock"></i></span>
                        <input id="passwordlogin" name="password" type="password" required>
                        <label>Password</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox">Ghi Nhớ</label>
                        <a href="#" class="forgot-link">Quên Mật Khẩu</a>
                    </div>
                    <button name="submit-btn" id="submit-btn" type="submit" class="btn" value="Login">
                        Đăng Nhập
                    </button>
                    <div class="login-register">
                        <p>Bạn không có Tài Khoản?<a href="#" class="register-link">Đăng Ký</a></p>

                    </div>
                </form>
            </div>

            <div class="form-box register">
                <form>
                    <h2>Đăng Ký</h2>

                    <div class="input-box">
                        <span class="icon"><i class="fa-solid fa-user"></i></span>
                        <input id="rename" name="rename" type="text" required>
                        <label>Tên</label>
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
                        <label>Nhập lại password</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox">Đồng ý với mọi điều khoản</label>
                    </div>

                    <button id="submit-register" type="submit" class="btn" value="submit-register">
                        Đăng Ký
                    </button>
                    <div class="login-register">
                        <p>Bạn đã có tài khoản?<a href="#" class="login-link">Đăng Nhập</a></p>
                    </div>
                </form>
            </div>

            <div class="form-box forgotpassword">
                <form>
                    <h2>Quên Mật Khẩu</h2>

                    <div class="input-box">
                        <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                        <input id="newemail" name="newemail" type="email" required>
                        <label>Email</label>
                    </div>

                    <button id="submit-forgotpassword" type="submit" class="btn" value="submit-forgotpassword">
                        Gửi
                    </button>
                    <div class="login-register">
                        <p>Bạn không có Tài Khoản?<a href="#" class="login-links">Đăng Nhập</a></p>
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
        const forgotLink = document.querySelector('.forgot-link');
        const loginLinks = document.querySelector('.login-links');
        registerLink.addEventListener('click', () => {
            lorgrgBox.classList.add('active');
        })
        loginLink.addEventListener('click', () => {
            lorgrgBox.classList.remove('active');
        })
        forgotLink.addEventListener('click', () => {
            lorgrgBox.classList.add('activee');
        });
        loginLinks.addEventListener('click', () => {
            lorgrgBox.classList.remove('activee');
        })
    </script>
    <script>
        $(document).on('click','#submit-btn',function(){
            event.preventDefault();
            var submitbtn=$(this).val();
            var email = $('#emaillogin').val();
            var password = $('#passwordlogin').val();
           var data = {
            submitbtn:submitbtn,
            email:email,
            password:password
           }
           $.ajax({
                url: '',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(response) {
                    console.log(data);
                    if (response.message) {
                        swal("Error!", response.message, "error")
                    } else if(response.success1) {
                        window.location.href='index.php';
                    }else if(response.success) {
                        window.location.href='admin_pannel.php';
                    }
                },
                error: function(xhr, status, error) {
                    console.log(data);
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        });
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
                        function reload() {
                            location.reload();
                        }
                        swal("Success!", response.success, "success")
                        setTimeout(reload, 3000)
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Xem dữ liệu phản hồi từ server khi có lỗi
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            })
        });
        $(document).on('click', '#submit-forgotpassword', function(event) {
            event.preventDefault();
            var btnforgot = $(this).val();
            var newEmail = $('#newemail').val();
            var data = {
                btnforgot: btnforgot,
                newEmail: newEmail
            }
            $.ajax({
                url: '',
                type: 'POST',
                dataType: 'html',
                data: data,
                success: function(response) {
                    if (response==="Email của bản không tồn tại" || response==='Hãy điền email để lấy mật khẩu') {
                        // Chuyển hướng sau khi gửi email thành công
                        swal("Error!", response, "error");
                    } else {
                        $('#loading-gif').css('z-index', '2');
                        window.location.href = 'doimk.php';
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText)
                    
                }
            });
        });
    </script>
</body>

</html>