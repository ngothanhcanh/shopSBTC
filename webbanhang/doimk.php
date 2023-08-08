<?php
include 'connection.php';
session_start();
$email=$_SESSION['email'];
$otp = $_SESSION['OTP'];
if (!isset($otp)) {
    header('location:login.php');
}
if (isset($_POST['btnchange'])) {
    $fiter_password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $newpassword = mysqli_escape_string($conn,$fiter_password);
    $filter_cpassword = filter_var($_POST['cpassword'],FILTER_SANITIZE_STRING);
    $newcpassword = mysqli_escape_string($conn,$filter_cpassword);
    $OPTuser = $_POST['OTPuser'];
    if ($newcpassword != $newpassword) {
        $response['message'] = "mật khẩu không trùng";
    } else {
        if ($otp === $OPTuser) {
            mysqli_query($conn,"UPDATE `users` SET `password`='$newpassword' WHERE email='$email' AND OTP = '$otp'");
            unset($_SESSION['OTP']);
            $response['success']=true;
        } else {
            $response['message'] = "mã otp không trùng";
            exit();
        }
    }
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
                    <h2>Đổi Mật Khẩu</h2>
                     
                    <div class="input-box">
                        <span class="icon"><i class="fa-solid fa-lock"></i></span>
                        <input id="OTP" name="password" type="text" required>
                        <label>OTP</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class="fa-solid fa-lock"></i></span>
                        <input id="password" name="password" type="password" required>
                        <label>Password</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class="fa-solid fa-lock"></i></span>
                        <input id="cpassword" name="password" type="password" required>
                        <label>Nhập lại password</label>
                    </div>
                    <button name="submit-btn" type="submit" class="btn" value="change">
                        Thay Đổi
                    </button>
                </form>
            </div>
            
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click','.btn', function(event) {
            event.preventDefault();
            var btnchange=$(this).val();
            var OTPuser=$('#OTP').val();
            var password = $('#password').val();
            var cpassword =$('#cpassword').val();
            console.log(btnchange);
            console.log(OTPuser);
            console.log(password);
            console.log(cpassword);
            var data = {
                btnchange:btnchange,
                OTPuser:OTPuser,
                password:password,
                cpassword:cpassword,
            }
            $.ajax({
                url:'',
                type:'POST',
                dataType:'json',
                data:data,
                success:function(response){
                    if(response.message)
                    {
                    swal("Error!", response.message, "error")
                    }else{
                       
                        window.location.href="login.php";
                    }
                },
                error:function(xht,status,error)
                {  console.log(data);
                    console.log(error);
                    console.log('Lỗi khi gửi yêu cầu AJAX:', error);
                }
            });
        });

    </script>
</body>

</html>