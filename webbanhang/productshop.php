<?php
include 'connection.php';
if(isset($_POST['buttonValue']))
{    
    $type=$_POST['buttonValue'];
    $select_prodcut_type=mysqli_query($conn,"SELECT * FROM products WHERE type_product='$type'");
    if(mysqli_num_rows($select_prodcut_type)>0){
        $html='';
        while($fetch_product_type=mysqli_fetch_assoc($select_prodcut_type))
        {
            $html.='<li class="card">';
            $html.='<a class="fa-regular fa-heart fav" id="love2" data-value="'. $fetch_product_type['id'] .'"></a>';
            $html.='<div class="img_shop">';
            $html.='<a href="detailproduct.php?pid='.$fetch_product_type['id'].'"><img src="image/'. $fetch_product_type['image'] .'" alt="img" draggable="false"></a>';
            $html.='</div>';
            $html.='<div class="bottom_card_shop">';
            $html.='<div class="bottom_top_card_shop">';
            $html.='<h2>'.$fetch_product_type['name'].' </h2>';
            $html.='<p>'. $fetch_product_type['new_price'] .' VND</p></div>';
            $html.='<div class="main_button_shop">';
            $html.='<div class="main_desc_shop">';
            $html.='<h4>'. $fetch_product_type['product_detail'].'</h4></div>';
            $html.='<button id="btnnsp" class="button_shop" value="'. $fetch_product_type['id'] .'">';
            $html.='<span><i class="fa-solid fa-cart-plus"></i></span>';
            $html.='<div class="cart">';
            $html.='<svg viewBox="0 0 36 26">';
            $html.='<polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>';
            $html.='<polyline points="15 13.5 17 15.5 22 10.5"></polyline>';
            $html.='</svg> </div></button></div></div></li>';
        }
        echo $html;
    }
   else{
    echo 'Không có sản phẩm';
   }
}else if(isset($_POST['buttonValue1'])){

    $select_prodcut_type=mysqli_query($conn,"SELECT * FROM `products` ORDER BY new_price DESC");
    if(mysqli_num_rows($select_prodcut_type)>0){
        $html='';
        while($fetch_product_type=mysqli_fetch_assoc($select_prodcut_type))
        {
            $html.='<li class="card">';
            $html.='<a class="fa-regular fa-heart fav" id="love2" data-value="'. $fetch_product_type['id'] .'"></a>';
            $html.='<div class="img_shop"> <a href="detailproduct.php?pid='.$fetch_product_type['id'].'"><img src="image/'. $fetch_product_type['image'] .'" alt="img" draggable="false"></a></div>';
            $html.='<div class="bottom_card_shop">';
            $html.='<div class="bottom_top_card_shop">';
            $html.='<h2>'.$fetch_product_type['name'].' </h2>';
            $html.='<p>'. $fetch_product_type['new_price'] .' VND</p></div>';
            $html.='<div class="main_button_shop">';
            $html.='<div class="main_desc_shop">';
            $html.='<h4>'. $fetch_product_type['product_detail'].'</h4></div>';
            $html.='<button id="btnnsp" class="button_shop" value="'. $fetch_product_type['id'] .'">';
            $html.='<span><i class="fa-solid fa-cart-plus"></i></span>';
            $html.='<div class="cart">';
            $html.='<svg viewBox="0 0 36 26">';
            $html.='<polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>';
            $html.='<polyline points="15 13.5 17 15.5 22 10.5"></polyline>';
            $html.='</svg> </div></button></div></div></li>';
        }
        echo $html;
    }
}else if(isset($_POST['buttonValue2'])){

    $select_prodcut_type=mysqli_query($conn,"SELECT * FROM `products` ORDER BY new_price ASC");
    if(mysqli_num_rows($select_prodcut_type)>0){
        $html='';
        while($fetch_product_type=mysqli_fetch_assoc($select_prodcut_type))
        {
            $html.='<li class="card">';
            $html.='<a class="fa-regular fa-heart fav" id="love2" data-value="'. $fetch_product_type['id'] .'"></a>';
            $html.='<div class="img_shop"> <a href="detailproduct.php?pid='.$fetch_product_type['id'].'"><img src="image/'. $fetch_product_type['image'] .'" alt="img" draggable="false"></a></div>';
            $html.='<div class="bottom_card_shop">';
            $html.='<div class="bottom_top_card_shop">';
            $html.='<h2>'.$fetch_product_type['name'].' </h2>';
            $html.='<p>'. $fetch_product_type['new_price'] .' VND</p></div>';
            $html.='<div class="main_button_shop">';
            $html.='<div class="main_desc_shop">';
            $html.='<h4>'. $fetch_product_type['product_detail'].'</h4></div>';
            $html.='<button id="btnnsp" class="button_shop" value="'. $fetch_product_type['id'] .'">';
            $html.='<span><i class="fa-solid fa-cart-plus"></i></span>';
            $html.='<div class="cart">';
            $html.='<svg viewBox="0 0 36 26">';
            $html.='<polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>';
            $html.='<polyline points="15 13.5 17 15.5 22 10.5"></polyline>';
            $html.='</svg> </div></button></div></div></li>';
        }
        echo $html;
    }
}else if(isset($_POST['inputValue'])){
     $input = $_POST['inputValue'];
    $select_prodcut_type=mysqli_query($conn,"SELECT * FROM `products` WHERE name LIKE '%$input%'");
    if(mysqli_num_rows($select_prodcut_type)>0){
        $html='';
        while($fetch_product_type=mysqli_fetch_assoc($select_prodcut_type))
        {
            $html.='<li class="card">';
            $html.='<a class="fa-regular fa-heart fav" id="love2" data-value="'. $fetch_product_type['id'] .'"></a>';
            $html.='<div class="img_shop"> <a href="detailproduct.php?pid='.$fetch_product_type['id'].'"><img src="image/'. $fetch_product_type['image'] .'" alt="img" draggable="false"></a></div>';
            $html.='<div class="bottom_card_shop">';
            $html.='<div class="bottom_top_card_shop">';
            $html.='<h2>'.$fetch_product_type['name'].' </h2>';
            $html.='<p>'. $fetch_product_type['new_price'] .' VND</p></div>';
            $html.='<div class="main_button_shop">';
            $html.='<div class="main_desc_shop">';
            $html.='<h4>'. $fetch_product_type['product_detail'].'</h4></div>';
            $html.='<button id="btnnsp" class="button_shop" value="'. $fetch_product_type['id'] .'">';
            $html.='<span><i class="fa-solid fa-cart-plus"></i></span>';
            $html.='<div class="cart">';
            $html.='<svg viewBox="0 0 36 26">';
            $html.='<polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>';
            $html.='<polyline points="15 13.5 17 15.5 22 10.5"></polyline>';
            $html.='</svg> </div></button></div></div></li>';
        }
        echo $html;
    }
}
?>