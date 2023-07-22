<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>veggen - home page</title>
</head>

<body>
 
    <section class="popular-brands">
        <h2>Sản phẩm bán chạy</h2>
        <div class="control">
             <!-- <button class="left">&#10094;</button>
             <button class="right">&#10094;</button> -->
            <i class="fa-sharp fa-solid fa-chevron-left left"></i>
            <i class="fa-sharp fa-solid fa-chevron-right right"></i>
        </div>
        <div class="popular-brands-content">
            <?php
            $select_product = mysqli_query($conn, "SELECT * FROM `products` ") or die('query failed');
            if (mysqli_num_rows($select_product) > 0) {
                while ($fetch_product = mysqli_fetch_assoc($select_product)) {

            ?>
                    <form method="post" class="card">
                        <img src="image/<?php echo $fetch_product['image']; ?>">
                        <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                        <div class="name"><?php echo $fetch_product['name']; ?></div>
                        <input type="hidden" name="product_id" value="<?php echo $fetch_product['id'] ;?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name'] ;?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                        <input type="hidden" name="product_quantity" value="1" min="1">
                        <input type="hidden" name="product_img" value="<?php echo $fetch_product['image'] ;?>">
                        <div class="icon">
                            <a href="viewproduct.php?pid=<?php echo $fetch_product['id']; ?>"  class="fa-sharp fa-solid fa-eye pid"></a>
                            <button type="submit" name="add_to_wishlist" class="fa-sharp fa-solid fa-heart"></button>
                            <button type="submit" name="add_to_cart" class="fa-sharp fa-solid fa-cart-shopping"></button>
                        </div>
                    </form>
            <?php
                }
              }else{

                }
              
            ?>
        </div>
    </section>
   <script>
const sliderContainer = document.querySelector('.popular-brands-content');
const prevBtn = document.querySelector('.left');
const nextBtn = document.querySelector('.right');
const sliderItems = document.querySelectorAll('.card');
let currentIndex = 0;

// Move the slider to the next item
function slideNext() {
  currentIndex++;
  if (currentIndex >= sliderItems.length) {
    currentIndex = 0;
  }
  sliderContainer.scrollTo({
    left: sliderItems[currentIndex].offsetLeft - sliderContainer.offsetLeft,
    behavior: 'smooth'
  });
}

// Move the slider to the previous item
function slidePrev() {
  currentIndex--;
  if (currentIndex < 0) {
    currentIndex = sliderItems.length - 1;
  }
  sliderContainer.scrollTo({
    left: sliderItems[currentIndex].offsetLeft - sliderContainer.offsetLeft,
    behavior: 'smooth'
  });
}

// Add event listeners for the buttons
nextBtn.addEventListener('click', slideNext);
prevBtn.addEventListener('click', slidePrev);

   </script>

	<script src="script2.js"></script>
</body>

</html>