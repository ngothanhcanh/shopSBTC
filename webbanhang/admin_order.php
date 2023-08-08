<?php $page='adminorder';
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
if (isset($_GET['delete'])) {
    $order_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `order` WHERE id='$order_id'") or die('query failed');
    $messege[] = 'user removed successfully';
    header('location:admin_order.php');
}
// update payment status
if (isset($_POST['payment_status'])) {
    $oderid = $_POST['order_id'];
    $update_payment = $_POST['payment_status'];
    mysqli_query($conn, "UPDATE `order` SET payment_status='$update_payment' WHERE id='$oderid'") or die('query failed');
}
?>
<style type="text/css">
    <?php
    include 'admin_order.css';
    include 'style.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--box icon link-->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


    <title>Manager order</title>
</head>

<body>
    <?php include 'admin_header.php' ?>
    <p class="title-fake-hd">Quản lý đặt hàng</p>
    <div class="container-form-hoadon">

        <table class="form-hoadon">

            <tr>
                <th class="first-child-hd">Mã đặt hàng</th>
                <th>Tên khách hàng</th>
                <!-- <th>Sản phẩm</th> -->
                <th>Ngày đặt hàng</th>
                <th>Tiền hàng</th>
                <th>Địa Chỉ</th>
                <th>Trạng thái</th>
                <th>Phương thức thanh toán</th>
                <th class="last-child-hd">Thao tác</th>
            </tr>

            <?php $select_orders = mysqli_query($conn, "SELECT * FROM `order`") or die('query failed');
            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
                    <tr class="info-hd">
                        <td class="first-child-hd"><?php echo $fetch_orders['id']; ?></td>
                        <td class="date-hd"><span><?php echo $fetch_orders['name']; ?></td>
                        <!-- <td class="ten-hd-user">Dương Thắngdfhgdfhdfghfghfghfghgfhghghfghfghfhfghfghfghfhfghfg</td> -->
                        <td class="diachi-hd"><?php echo $fetch_orders['placed_on']; ?><span></td>
                        <td class="diachi-hd"><?= number_format($fetch_orders['total_price'])  ?> VND</td>
                        <td><?php echo $fetch_orders['adress']; ?></td>
                        <td>
                            <select name="update_payment" class="update_payment" data-order-id="<?php echo $fetch_orders['id']; ?>">
                                <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
                                <option value="Đợi Duyệt">Đợi Duyệt</option>
                                <option value="Đang Giao">Đang Giao</option>
                                <option value="Đã Giao">Đã Giao</option>
                            </select>
                        </td>
                        <td>Thanh toán khi nhận hàng</td>
                        <td class="last-child-hd">
                            <div class="thaotac"><i class="fa-solid fa-pen"></i><a href="admin_order.php?delete=<?php echo $fetch_orders['id']; ?>"><i class="fa-solid fa-trash"></i></a></div>
                        </td>
                    </tr>

            <?php
                }
            } else {
                echo '<div class="empty"><p>no order placed yet!</p></div>';
            }
            ?>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Xử lý sự kiện khi giá trị được chọn thay đổi
            $('.update_payment').change(function() {
                // Lấy giá trị được chọn
                var selectedValue = $(this).val();
                var orderId = $(this).data('order-id');
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: {
                        order_id: orderId,
                        payment_status: selectedValue
                    },
                    success: function(response) {
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript" src="./script.js"></script>
    <div class="box"></div>
</body>

</html>