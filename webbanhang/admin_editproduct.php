<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_name'];
if (!isset($admin_id)) {
    header('location:login.php');
}
if (isset($_POST['logout-btn'])) {
    session_destroy();
    header('location:login.php');
}
if (isset($_POST['update_product'])) {
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_oldprice = $_POST['update_oldprice'];
    $update_newprice = $_POST['update_newprice'];
    $update_detail = $_POST['update_detail'];
    $update_type = $_POST['update_type'];
    $update_method = $_POST['update_method'];
    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $image_extension = pathinfo($update_image, PATHINFO_EXTENSION);
    $image_tg=time(). '.' .$image_extension;
    $update_image_folder = 'image/'.$image_tg;
    $update_query = mysqli_query($conn, "UPDATE `products` SET `id`='$update_id',`name`='$update_name',`old_price`='$update_oldprice',`new_price`='$update_newprice',`product_detail`='$update_detail',`type_product`='$update_type',`method`='$update_method',`image`='$image_tg' WHERE id ='$update_id'") or die('query failed');
    if ($update_query) {
        move_uploaded_file($update_image_tmp_name, $update_image_folder);
        header('location:admin_sanpham.php');
    }
}
if(isset($_POST['cancel']))
{
    header('location:admin_sanpham.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="main-checkout">
        <section class="checkout">

            <div class="payment-form">
                <p>Chỉnh sửa sản phẩm</p>
                <?php
                if (isset($_GET['edit'])) {
                    $edit_id = $_GET['edit'];
                    $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id='$edit_id'") or die('query failed');
                    if (mysqli_num_rows($edit_query) > 0) {
                        while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
                ?>
                            <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id'];?>">
                                <div class="cardholder-name">
                                    <label for="cardholder-name" class="label-default">Tên sản phẩm</label>
                                    <input type="text" name="update_name" id="cardholder-name" class="input-default" value="<?php echo $fetch_edit['name']; ?>">
                                </div>
                                <div class="cardholder-name">
                                    <label for="cardholder-name" class="label-default">Giá củ</label>
                                    <input type="number" name="update_oldprice" id="cardholder-name" class="input-default" value="<?php echo $fetch_edit['old_price']; ?>">
                                </div>
                                <div class="cardholder-name">
                                    <label for="cardholder-name" class="label-default">Giá mới</label>
                                    <input type="number" name="update_newprice" id="cardholder-name" class="input-default" value="<?php echo $fetch_edit['new_price']; ?>">
                                </div>
                                <div class="cardholder-name">
                                    <label for="cardholder-name" class="label-default">Mô tả sản phẩm</label>
                                    <textarea type="text" name="update_detail" id="cardholder-name" class="input-default"><?php echo $fetch_edit['product_detail'] ;?></textarea>
                                </div>
                                <div class="cardholder-name">
                                    <label for="cardholder-name" class="label-default">Loại hàng</label>
                                    <input type="text" name="update_type" id="cardholder-name" class="input-default"  value="<?php echo $fetch_edit['type_product']; ?>">
                                </div>
                                <div class="cardholder-name">
                                    <label for="cardholder-name" class="label-default">Thuộc tính sản phẩm</label>
                                    <input type="text" name="update_method" id="cardholder-name" class="input-default" value="<?php echo $fetch_edit['method']; ?>">
                                </div>
                                <div class="cardholder-name">
                                    <label for="cardholder-name" class="label-default">Hình sản phẩm</label>
                                    <input type="file" name="update_image" id="cardholder-name" class="input-default" accept="image/jpg, image/jpeg, image/png, image/webp">
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
                                <button class="btnn btn-primary" name="update_product" value="update">
                                    <span id="payAmount">Cập nhật</span>
                                </button>
                                <button class="btnn btn-secondary" name="cancel">
                                    <span id="payAmount">Hủy</span>
                                </button>
                            </form>
                <?php

                        }
                    }
                }
                ?>
            </div>


        </section>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Varela+Round&display=swap');

        :root {
            --onyx: hsl(0, 0%, 25%);
            --azure: hsl(219, 77%, 60%);
            --white: hsl(0, 0%, 100%);
            --platinum: hsl(0, 0%, 91%);
            --gainsboro: hsl(0, 0%, 90%);
            --red-salsa: hsl(0, 77%, 60%);
            --dim-gray: hsl(0, 0%, 39%);
            --davys-gray: hsl(0, 0%, 30%);
            --spanish-gray: hsl(0, 0%, 62%);
            --quick-silver: hsl(0, 0%, 64%);

            --fs-28: 28px;
            --fs-24: 24px;
            --fs-18: 18px;
            --fs-15: 15px;
            --fs-14: 14px;

            --fw-5: 500;
            --fw-6: 600;
            --fw-7: 700;

            --px: 60px;
            --radius: 5px;
        }

        body {}

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-family: 'Varela Round', sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            border: none;
            background: none;
            font: inherit;
            cursor: pointer;
        }

        ion-icon,
        span {
            display: inline-block;
        }

        label,
        img {
            display: block;
        }

        input {
            font: inherit;
            width: 100%;
            border: none;
        }

        input:focus {
            outline: 2px solid var(--azure);
        }

        input::-webkit-inner-spin-button,
        input::-webkit-outer-spin-button {
            appearance: none;
            -webkit-appearance: none;
            margin: 0;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: hsl(0, 0%, 80%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: hsl(0, 0%, 80%);
        }



        /* main container */
        .container {
            margin-top: 60px;
            max-width: 1440px;
            min-height: 100vh;
            margin: auto;
            display: flex;
            flex-direction: column;
        }

        .heading {
            font-size: var(--fs-28);
            font-weight: var(--fw-6);
            color: var(--onyx);
            margin-top: 80px;
            margin-left: 60px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .heading ion-icon {
            font-size: 40px;
        }

        .item-flex {
            display: flex;
            flex-grow: 1;
        }

        .main-checkout {
            border-bottom: 1px solid var(--gainsboro);
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .checkout {
            font-family: 'Varela Round', sans-serif;
            margin-top: 70px;
            width: 70%;
            padding: 40px var(--px);
            background-color: var(--white);

        }

        .section-heading {
            font-family: 'Varela Round', sans-serif;
            color: var(--onyx);
            margin-bottom: 30px;
            font-size: var(--fs-24);
            font-weight: var(--fw-5);
        }

        .payment-form {
            margin-bottom: 40px;
            font-family: 'Varela Round', sans-serif;
        }

        textarea.input-default {
            font-weight: var(--fw-5);
            color: var(--davys-gray);
            font-size: var(--fs-18);
            border: none;
            padding-left: 10px;
            padding-top: 5px;
            padding-right: 10px;
            padding-bottom: 5px;
            width: 100%;
            height: 200px
                /* Thụt lề trái 10px */
        }

        textarea.input-default:focus {
            outline: 2px solid var(--azure);
        }

        input.input-default[type="file"] {
            font-size: 13px;
            color: var(--davys-gray);
            font-family: 'Varela Round', sans-serif;
        }

        .payment-form p {
            font-family: 'Varela Round', sans-serif;
        }

        .payment-method {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 40px;
        }

        .payment-method .method {
            border: 1px solid var(--quick-silver);
            border-radius: var(--radius);
            width: 50%;
            display: flex;
            align-items: center;
            padding: 15px 30px;
            gap: 20px;
            cursor: pointer;
        }

        .payment-method .selected {
            border-color: var(--azure);
        }

        .payment-method .method ion-icon {
            font-size: 20px;
        }

        .payment-method .method .checkmark {
            margin-left: auto;
            color: var(--quick-silver);
        }

        .payment-method .method .fill {
            color: var(--azure);
        }

        .label-default {
            padding-left: 10px;
            margin-bottom: 5px;
            font-size: var(--fs-14);
            color: var(--spanish-gray);
        }

        .input-default {
            background: var(--platinum);
            border-radius: var(--radius);
            color: var(--davys-gray);
        }

        .payment-form input {
            padding: 10px 15px;
            font-size: var(--fs-18);
            font-weight: var(--fw-5);
        }

        .cardholder-name,
        .card-number {
            margin-bottom: 20px;
            font-family: 'Varela Round', sans-serif;
        }

        .card-number input,
        .cvv input {
            letter-spacing: 3px;
        }

        .input-flex {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .input-flex .expire-date,
        .input-flex .cvv {
            width: 50%;
        }

        .expire-date .input-flex {
            color: var(--spanish-gray);
            gap: 13px;
        }

        .expire-date .input-flex input {
            text-align: center;
        }

        .btnn {
            border-radius: var(--radius);
            white-space: nowrap;
        }

        .btnn:active {
            transform: scale(0.99);
        }

        .btnn:focus {
            color: white;
            background: var(--azure);
            outline: 2px solid var(--azure);
            outline-offset: 2px;
        }

        .btn-primary {
            background-color: var(--azure);
            font-weight: var(--fw-5);
            color: var(--white);
            padding: 13px 15px;
            margin-right: 20px;

        }

        .btn-secondary {
            background-color: var(--red-salsa);
            font-weight: var(--fw-5);
            color: var(--white);
            padding: 13px 35px;
            margin-right: 40px;
        }

        .btn-primary b {
            margin-right: 10px;
        }

        .cart_co {
            width: 40%;
            display: flex;
            justify-content: flex-end;
            flex-direction: column;
        }

        .cart-item-box {
            padding: 40px var(--px);
            margin-bottom: auto;
        }

        .product-card:not(:last-child) {
            margin-bottom: 20px;
        }

        .product-card .card_co {
            position: relative;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .card_co .product-img {
            border-radius: var(--radius);
        }

        .card_co .detail .product-name {
            font-weight: var(--fw-6);
            font-size: var(--fs-15);
            color: var(--dim-gray);
            margin-bottom: 10px;
        }

        .card_co .detail .wrapper_co {
            display: flex;
            gap: 20px;
        }

        .product-qty {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-qty button {
            background: var(--platinum);
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-qty button:active,
        .product-close-btn:active ion-icon {
            transform: scale(0.95);
        }

        .product-qty button ion-icon {
            --ionicon-stroke-width: 60px;
            font-size: 10px;
        }

        .product-close-btn {
            position: absolute;
            top: 0;
            right: 0;
        }

        .product-close-btn ion-icon {
            font-size: 25px;
            color: var(--quick-silver);
        }

        .product-close-btn:hover ion-icon {
            color: var(--red-salsa);
        }

        .discount-token {
            padding: 48px var(--px);
            border-top: 1px solid var(--gainsboro);
            border-bottom: 1px solid var(--gainsboro);
        }

        .wrapper-flex {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .wrapper-flex input {
            padding: 12px 15px;
            font-weight: var(--fw-6);
            letter-spacing: 2px;
        }

        .btn-outline {
            padding: 10px 25px;
            border: 1px solid var(--azure);
            color: var(--azure);
        }

        .btn-outline:hover {
            background: var(--azure);
            color: var(--white);
        }

        .amount {
            padding: 40px var(--px);
        }

        .amount>div {
            display: flex;
            justify-content: space-between;
        }

        .amount>div:not(:last-child) {
            margin-bottom: 10px;
        }

        .amount .total {
            font-size: var(--fs-18);
            font-weight: var(--fw-7);
            color: var(--onyx);
        }

        .payment-form p {
            font-size: 25px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #404040;
        }

        #payAmount {
            font-family: 'Varela Round', sans-serif;
        }

        /*End main container */

        p {
            font-family: 'Varela Round', sans-serif;
            color: var(--color-text);
        }

        .container-form-hoadon {

            display: flex;
            justify-content: center;
            align-items: center;


        }

        table {
            border-collapse: collapse;
            width: 100%;
            width: 1100px;
            border-collapse: separate;
            border-spacing: 0 0.5em;
        }

        th {
            text-align: left;
            font-family: 'Varela Round', sans-serif;

        }

        td {
            color: #005c99;
            padding-top: 20px;
            padding-bottom: 20px;
            font-family: 'Varela Round', sans-serif;
        }

        td {

            background-color: #e6f7ff;
            /* Màu xanh nhạt cho các ô dữ liệu */
        }

        .form-hoadon {}

        .fa-pen {
            color: #3598fe;
            margin-right: 10px;
        }

        .fa-trash {
            color: #ff6600;
        }

        .first-child-hd {
            display: flex;
            justify-content: center;
            border-radius: 10px 0px 0px 10px;
        }

        .first-child-hd img {
            width: 50px;
        }

        .last-child-hd {
            border-radius: 0px 10px 10px 0px;
            text-align: center;

        }

        .title-fake-hd {
            margin-left: 220px;
            font-weight: bold;
            font-size: 25px;
            margin-top: 90px;
            margin-bottom: 20px;
        }

        .diachi-hd {
            padding-right: 30px;
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ten-hd-user {
            padding-right: 30px;
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .date-hd {
            max-width: 150px;
            padding-right: 20px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</body>

</html>