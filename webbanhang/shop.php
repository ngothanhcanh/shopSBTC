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
if (isset($_POST['add_to_wishlist'])) {
    $Wishlist_id = $_POST['product_id'];
    $Wishlist_name = $_POST['product_name'];
    $Wishlist_price = $_POST['product_price'];
    $Wishlist_image = $_POST['product_img'];
    $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name='$Wishlist_name' AND use_id ='$user_id' ") or die('query failed');
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$Wishlist_name' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_wishlist) > 0) {
        $messege[] = 'wishlist already exist';
    } else if (mysqli_num_rows($select_cart) > 0) {
        $messege[] = 'product had already in cartory';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`( `use_id`, `pid`, `name`, `price`, `image`) VALUES ('$user_id','$Wishlist_id','$Wishlist_name','$Wishlist_price','$Wishlist_image')") or die('query failed');
        $messege[] = 'successfully';
    }
}
if (isset($_POST['add_to_cart'])) {
    $cart_id = $_POST['product_id'];
    $cart_name = $_POST['product_name'];
    $cart_price = $_POST['product_price'];
    $cart_image = $_POST['product_img'];
    $cart_quantity = $_POST['product_quantity'];

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$cart_name' AND use_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($select_cart) > 0) {
        $messege[] = 'product had already in cartory';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`( `use_id`, `pid`, `name`, `price`, `quantity`,`image`) VALUES ('$user_id','$cart_id','$cart_name','$cart_price','  $cart_quantity','$cart_image')") or die('query failed');
        $messege[] = 'successfully';
    }
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

    <title>home page</title>
</head>

<body>
    <?php include 'header.php';  ?>
    <div class="line5"></div>
    <?php
    if (isset($messege)) {
        foreach ($messege as $messege) {
            echo '<div class="message">
           <span>' . $messege . '</span>
           <i class="click" onclick="this.parentElement.remove()">aa</i>
       </div>';
        }
    }
    ?>
    <div class="main-shop">
    <div class="menu-left">
        <div class="title-menu">
          <i class="fa-solid fa-bars"></i>
            <span>Danh Mục sản Phẩm</span>
        </div>
        <div class="danhmuc-loaihang">
            <ul>
                <li>ao</li>
                <li>quan</li>
                <li>giay</li>
                <li>dep</li>
            </ul>
        </div>
        <div class="menu-mucgia">
            <div class="title-mucgia">
                <span>Chọn mức giá</span>
            </div>
            <div class="danhmuc-gia">
              <ul>
                <li><input type="checkbox" value=""><span>dưới 200</span></li>
                <li><input type="checkbox"><span>dưới 200</span></li>
                <li><input type="checkbox"><span>dưới 200</span></li>
                <li><input type="checkbox"><span>dưới 200</span></li>
              </ul>
            </div>
        </div>
    </div>
    <div class="product-right">
        <div class="tim-kiem-product">
            <input class="timkiem" type="text" name="" placeholder="Tìm kiếm sản phẩm">
            <button class="btntimkiem"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    <div class="content">
        <section class="content-shop">
            <div class="hotline">
                <img src="img/delivery-man.png" alt="">
                <div class="phone">
                <h1>0858 116 654</h1>
                <p>Giao hàng sieu tốc</p>
                </div>
            </div>
            <div class="contaner">
                <div class="title-bread">Sản Phẩm</div>
                <ul class="breadcrumd">
                    <li class="home">
                        <a href="*">
                            <span>Trang chủ</span>
                            <span class="mr_1r">/</span>
                        </a>
                    </li>
                    <li>
                        <strong>
                            <span> Sản phẩm </span>
                        </strong>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="loaisp">aaa</div>
    <div class="popular-brands-content-shop">
        <?php
        $select_product = mysqli_query($conn, "SELECT * FROM `products` ") or die('query failed');
        if (mysqli_num_rows($select_product) > 0) {
            while ($fetch_product = mysqli_fetch_assoc($select_product)) {

        ?>
                <form method="post" class="card-shop">
                    <img src="image/<?php echo $fetch_product['image']; ?>">
                    <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                    <div class="name"><?php echo $fetch_product['name'] ?></div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_product['id'] ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name'] ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price'] ?>">
                    <input type="hidden" name="product_quantity" value="1" min="1">
                    <input type="hidden" name="product_img" value="<?php echo $fetch_product['image'] ?>">
                    <div class="icon">
                        <a href="viewproduct.php?pid=<?php echo $fetch_product['id'] ?>" class="fa-sharp fa-solid fa-eye"></a>
                        <button type="submit" name="add_to_wishlist" class="fa-sharp fa-solid fa-heart"></button>
                        <button type="submit" name="add_to_cart" class="fa-sharp fa-solid fa-cart-shopping"></button>
                    </div>
                </form>
        <?php
            }
        } else {
            echo '<p class="empty"> no products added yet!</p>';
        }
        ?>
    </div>
    <div class="line3"></div>
    <?php include 'footer.php';  ?>
    </div>
    </div>
    <script src="./script2.js"></script>
</body>

</html>