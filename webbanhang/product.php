<?php 
include 'connection.php';
if(isset($_POST['buttonValue']))
{
    $btn = $_POST['buttonValue'];
    $select_all_typeproduct = mysqli_query($conn, "SELECT * From `products` WHERE type_product = '$btn'");
    if(mysqli_num_rows($select_all_typeproduct) > 0){
        $html = ''; // Biến chứa dữ liệu HTML
        while($fetch_all_typeproduct = mysqli_fetch_assoc($select_all_typeproduct))
        {
            // Tạo dữ liệu HTML cho từng sản phẩm và thêm vào biến $html
            $html .= '<li class="card">';
            $html .= '<a class="fa-regular fa-heart fav" id="love2" data-value="'. $fetch_all_typeproduct['id'] . '"></a>';
            $html .= '<div class="img"><a href="detailproduct.php?pid='.$fetch_all_typeproduct['id'].'"><img src="image/'. $fetch_all_typeproduct['image'] .'" alt="img" draggable="false"></a></div>';
            $html .= '<h2>' . $fetch_all_typeproduct['product_detail'] . '</h2>';
            $html .= '<p>' . $fetch_all_typeproduct['new_price'] . '$</p>';
            $html .= '<button id="btnnsp" class="buttonn ad-to-card" value="' . $fetch_all_typeproduct['id'] . '">';
            $html .= '<span>Add to cart</span>';
            $html .= '<div class="cart">';
            $html .= '<svg viewBox="0 0 36 26">';
            $html .= '<polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>';
            $html .= '<polyline points="15 13.5 17 15.5 22 10.5"></polyline>';
            $html .= '</svg>';
            $html .= '</div>';
            $html .= '</button>';
            $html .= '</li>';
        }
        // Trả về dữ liệu HTML thông qua phản hồi từ Ajax
        echo $html;
    } else {
        // Trường hợp không có sản phẩm
        echo 'khong co sp';
    }
}
?>

