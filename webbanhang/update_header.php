<?php
// Thực hiện truy vấn SQL để lấy số lượng sản phẩm trong wishlist và giỏ hàng từ CSDL
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
$select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE use_id='$user_id'") or die('query failed');
$wishlist_count = mysqli_num_rows($select_wishlist);

$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE use_id='$user_id'") or die('query failed');
$cart_count = mysqli_num_rows($select_cart);

// Trả về dữ liệu dưới dạng JSON
echo json_encode(array('wishlist_count' => $wishlist_count, 'cart_count' => $cart_count));

?>