<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/base.css">
  <link rel="stylesheet" href="../assets/css/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/category.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link rel="stylesheet" href="../assets/css/slider.css">
  <script src="./assets/js/slider.js"></script>
  <link rel="stylesheet" href="../assets/css/homepage.css">
</head>

<body>
  <?php
  require_once '../layouts/header.php';
  ?>

  <div homepage-container style="background-color: #f5f5f5;">
    <div class="grid">
      <div class="grid-row">
        <div class="slideshow-container">
          <div class="mySlides fade" style="display: block">
            <img src="./assets/img/slider-img/slide_3_img.webp" style="width:100%">
          </div>

          <div class="mySlides fade">
            <img src="./assets/img/slider-img/slide_2_img.webp" style="width:100%">
          </div>

          <div class="mySlides fade">
            <img src="./assets/img/slider-img/slide_1_img.webp" style="width:100%">
          </div>

          <a class="prev" onclick="plusSlides(-1)">❮</a>
          <a class="next" onclick="plusSlides(1)">❯</a>
          <div class="dot-container" style="text-align:center">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
          </div>
        </div>
      </div>

      <div class="grid-row homepage-category">
        <div class="grid-column-3-homepage">
          <a class="homepage-category-item" href="#">
            <div class="homepage-category-img" style="background-image: url(./assets/img/homepage-category/categorybanner_1_img.jpg);"></div>
            <h4 class="homepage-category-name">Phòng khách</h4>
            <div class="homepage-category-view">
              Xem ngay
            </div>
          </a>
        </div>

        <div class="grid-column-3-homepage">
          <a class="homepage-category-item" href="#">
            <div class="homepage-category-img" style="background-image: url(./assets/img/homepage-category/categorybanner_2_img.jpg);"></div>
            <h4 class="homepage-category-name">Phòng ngủ</h4>
            <div class="homepage-category-view">
              Xem ngay
            </div>

          </a>
        </div>

        <div class="grid-column-3-homepage">
          <a class="homepage-category-item" href="#">
            <div class="homepage-category-img" style="background-image: url(./assets/img/homepage-category/categorybanner_3_img.jpg);"></div>
            <h4 class="homepage-category-name">Phòng ăn và bếp</h4>
            <div class="homepage-category-view">
              Xem ngay
            </div>

          </a>
        </div>

        <div class="grid-column-3-homepage">
          <a class="homepage-category-item" href="#">
            <div class="homepage-category-img" style="background-image: url(./assets/img/homepage-category/categorybanner_4_img.jpg);"></div>
            <h4 class="homepage-category-name">Phòng làm việc</h4>
            <div class="homepage-category-view">
              Xem ngay
            </div>

          </a>
        </div>

      </div>


      <div class="homepage-product">
        <div class="homepage-product-heading">
          <h2 class="homepage-product-title">Sản phẩm nổi bật</h2>
          <div class="product-more-container">
            <a href="" class=product-more>Xem thêm
              <i class="product-more-icon fa-solid fa-angle-right"></i>
            </a>

          </div>
        </div>

        <div class="grid-row">
          <div class="grid-column-2-4-homepage">
            <a class="product-item" href="#">
              <div class="product-img" style="background-image: url(./assets/img/products/product-2.jpg);"></div>
              <h4 class="homepage-product-name">Sofa hai chỗ DENVER 1m8</h4>
              <div class="homepage-product-price">
                <span class="homepage-product-price-current">14,900,000đ</span>
                <span class="homepage-product-price-old">15,500,000đ</span>
              </div>
              <div class="homepage-product-action">
                <button class="homepage-product-wishlist">
                  <i class="homepage-product-wishlist-icon fa-regular fa-heart"></i>
                </button>
                <button class="homepage-product-cart">
                  Thêm vào giỏ
                </button>
              </div>
              <div class="product-sale">
                <div class="product-sale-percent">-10%</div>
              </div>
            </a>
          </div>
          <div class="grid-column-2-4-homepage">
            <a class="product-item" href="#">
              <div class="product-img" style="background-image: url(./assets/img/products/product-6.jpg);"></div>
              <h4 class="homepage-product-name">Sofa hai chỗ DENVER 1m8</h4>
              <div class="homepage-product-price">
                <span class="homepage-product-price-current">14,900,000đ</span>
                <span class="homepage-product-price-old">15,500,000đ</span>
              </div>
              <div class="homepage-product-action">
                <button class="homepage-product-wishlist">
                  <i class="homepage-product-wishlist-icon fa-regular fa-heart"></i>
                </button>
                <button class="homepage-product-cart">
                  Thêm vào giỏ
                </button>
              </div>
              <div class="product-sale">
                <div class="product-sale-percent">-10%</div>
              </div>
            </a>
          </div>
          <div class="grid-column-2-4-homepage">
            <a class="product-item" href="#">
              <div class="product-img" style="background-image: url(./assets/img/products/product-1.jpg);"></div>
              <h4 class="homepage-product-name">Sofa hai chỗ DENVER 1m8</h4>
              <div class="homepage-product-price">
                <span class="homepage-product-price-current">14,900,000đ</span>
                <span class="homepage-product-price-old">15,500,000đ</span>
              </div>
              <div class="homepage-product-action">
                <button class="homepage-product-wishlist">
                  <i class="homepage-product-wishlist-icon fa-regular fa-heart"></i>
                </button>
                <button class="homepage-product-cart">
                  Thêm vào giỏ
                </button>
              </div>
              <div class="product-sale">
                <div class="product-sale-percent">-10%</div>
              </div>
            </a>
          </div>
          <div class="grid-column-2-4-homepage">
            <a class="product-item" href="#">
              <div class="product-img" style="background-image: url(./assets/img/products/product-4.jpg);"></div>
              <h4 class="homepage-product-name">Sofa hai chỗ DENVER 1m8</h4>
              <div class="homepage-product-price">
                <span class="homepage-product-price-current">14,900,000đ</span>
                <span class="homepage-product-price-old">15,500,000đ</span>
              </div>
              <div class="homepage-product-action">
                <button class="homepage-product-wishlist">
                  <i class="homepage-product-wishlist-icon fa-regular fa-heart"></i>
                </button>
                <button class="homepage-product-cart">
                  Thêm vào giỏ
                </button>
              </div>
              <div class="product-sale">
                <div class="product-sale-percent">-10%</div>
              </div>
            </a>
          </div>
          <div class="grid-column-2-4-homepage">
            <a class="product-item" href="#">
              <div class="product-img" style="background-image: url(./assets/img/products/product-5.jpg);"></div>
              <h4 class="homepage-product-name">Sofa hai chỗ DENVER 1m8</h4>
              <div class="homepage-product-price">
                <span class="homepage-product-price-current">14,900,000đ</span>
                <span class="homepage-product-price-old">15,500,000đ</span>
              </div>
              <div class="homepage-product-action">
                <button class="homepage-product-wishlist">
                  <i class="homepage-product-wishlist-icon fa-regular fa-heart"></i>
                </button>
                <button class="homepage-product-cart">
                  Thêm vào giỏ
                </button>
              </div>
              <div class="product-sale">
                <div class="product-sale-percent">-10%</div>
              </div>
            </a>
          </div>
        </div>
      </div>

      <div class="homepage-product">
        <div class="homepage-product-heading">
          <h2 class="homepage-product-title">Nội thất văn phòng đơn giản và sang trọng</h2>
          <div class="product-more-container">
            <a href="" class=product-more>Xem thêm
              <i class="product-more-icon fa-solid fa-angle-right"></i>
            </a>

          </div>
        </div>

        <div class="grid-row">
          <div class="grid-column-2-4-homepage">
            <a class="product-item" href="#">
              <div class="product-img" style="background-image: url(./assets/img/products/product-2.jpg);"></div>
              <h4 class="homepage-product-name">Sofa hai chỗ DENVER 1m8</h4>
              <div class="homepage-product-price">
                <span class="homepage-product-price-current">14,900,000đ</span>
                <span class="homepage-product-price-old">15,500,000đ</span>
              </div>
              <div class="homepage-product-action">
                <button class="homepage-product-wishlist">
                  <i class="homepage-product-wishlist-icon fa-regular fa-heart"></i>
                </button>
                <button class="homepage-product-cart">
                  Thêm vào giỏ
                </button>
              </div>
              <div class="product-sale">
                <div class="product-sale-percent">-10%</div>
              </div>
            </a>
          </div>
          <div class="grid-column-2-4-homepage">
            <a class="product-item" href="#">
              <div class="product-img" style="background-image: url(./assets/img/products/product-6.jpg);"></div>
              <h4 class="homepage-product-name">Sofa hai chỗ DENVER 1m8</h4>
              <div class="homepage-product-price">
                <span class="homepage-product-price-current">14,900,000đ</span>
                <span class="homepage-product-price-old">15,500,000đ</span>
              </div>
              <div class="homepage-product-action">
                <button class="homepage-product-wishlist">
                  <i class="homepage-product-wishlist-icon fa-regular fa-heart"></i>
                </button>
                <button class="homepage-product-cart">
                  Thêm vào giỏ
                </button>
              </div>
              <div class="product-sale">
                <div class="product-sale-percent">-10%</div>
              </div>
            </a>
          </div>
          <div class="grid-column-2-4-homepage">
            <a class="product-item" href="#">
              <div class="product-img" style="background-image: url(./assets/img/products/product-1.jpg);"></div>
              <h4 class="homepage-product-name">Sofa hai chỗ DENVER 1m8</h4>
              <div class="homepage-product-price">
                <span class="homepage-product-price-current">14,900,000đ</span>
                <span class="homepage-product-price-old">15,500,000đ</span>
              </div>
              <div class="homepage-product-action">
                <button class="homepage-product-wishlist">
                  <i class="homepage-product-wishlist-icon fa-regular fa-heart"></i>
                </button>
                <button class="homepage-product-cart">
                  Thêm vào giỏ
                </button>
              </div>
              <div class="product-sale">
                <div class="product-sale-percent">-10%</div>
              </div>
            </a>
          </div>
          <div class="grid-column-2-4-homepage">
            <a class="product-item" href="#">
              <div class="product-img" style="background-image: url(./assets/img/products/product-4.jpg);"></div>
              <h4 class="homepage-product-name">Sofa hai chỗ DENVER 1m8</h4>
              <div class="homepage-product-price">
                <span class="homepage-product-price-current">14,900,000đ</span>
                <span class="homepage-product-price-old">15,500,000đ</span>
              </div>
              <div class="homepage-product-action">
                <button class="homepage-product-wishlist">
                  <i class="homepage-product-wishlist-icon fa-regular fa-heart"></i>
                </button>
                <button class="homepage-product-cart">
                  Thêm vào giỏ
                </button>
              </div>
              <div class="product-sale">
                <div class="product-sale-percent">-10%</div>
              </div>
            </a>
          </div>
          <div class="grid-column-2-4-homepage">
            <a class="product-item" href="#">
              <div class="product-img" style="background-image: url(./assets/img/products/product-5.jpg);"></div>
              <h4 class="homepage-product-name">Sofa hai chỗ DENVER 1m8</h4>
              <div class="homepage-product-price">
                <span class="homepage-product-price-current">14,900,000đ</span>
                <span class="homepage-product-price-old">15,500,000đ</span>
              </div>
              <div class="homepage-product-action">
                <button class="homepage-product-wishlist">
                  <i class="homepage-product-wishlist-icon fa-regular fa-heart"></i>
                </button>
                <button class="homepage-product-cart">
                  Thêm vào giỏ
                </button>
              </div>
              <div class="product-sale">
                <div class="product-sale-percent">-10%</div>
              </div>
            </a>
          </div>
        </div>
      </div>

      <div class="homepage-sale">
        <div class="grid-row">
          <div class="grid-column-6-homepage">
            <a href="" class="homepage-sale-banner">
              <div class="homepage-sale-banner-img" style="background-image: url(./assets/img/homepage-category/homebanner_1_img.webp);"></div>
            </a>
          </div>
          <div class="grid-column-6-homepage">
            <a href="" class="homepage-sale-banner">
              <div class="homepage-sale-banner-img" style="background-image: url(./assets/img/homepage-category/homebanner_2_img.webp);"></div>
            </a>
          </div>
        </div>
      </div>

      <div class="homepage-article">
        <h2 class="homepage-article-heading">Bài viết mới nhất</h2>
        <div class="grid-row">
          <div class="grid-column-3-homepage">
            <a class="article-item" href="#">
              <div class="article-img" style="background-image: url(./assets/img/blog/blog1.jpg);"></div>
              <h4 class="homepage-article-name">"Less Is More" - Xu Hướng Tối Giản Không Gian Sống</h4>
              <div class="homepage-article-preview">Platon, nhà triết học Hy lạp cổ đại nổi tiếng từng nói:" Cái đẹp của phong cách, của sự hài hòa, của sự duyên</div>
            </a>
          </div>
          <div class="grid-column-3-homepage">
            <a class="article-item" href="#">
              <div class="article-img" style="background-image: url(./assets/img/blog/blog2.jpg);"></div>
              <h4 class="homepage-article-name">bí quyết để giữ căn bếp luôn gọn gàng</h4>
              <div class="homepage-article-preview">Khu vực bếp là không gian quan trọng trong việc cả gia đình tận hưởng bữa ăn sau một ngày dài</div>
            </a>
          </div>
          <div class="grid-column-3-homepage">
            <a class="article-item" href="#">
              <div class="article-img" style="background-image: url(./assets/img/blog/blog3.jpg);"></div>
              <h4 class="homepage-article-name">tips trang trí góc học tập, làm việc đẹp và khoa học</h4>
              <div class="homepage-article-preview">Những góc học tập, làm việc được bài trí một cách khoa học và thông minh, giúp cho công việc</div>
            </a>
          </div>
          <div class="grid-column-3-homepage">
            <a class="article-item" href="#">
              <div class="article-img" style="background-image: url(./assets/img/blog/blog4.jpg);"></div>
              <h4 class="homepage-article-name">Sự khác biệt giữa phong cách thiết kế nội thất vintage và retro</h4>
              <div class="homepage-article-preview">Khi nói đến thiết kế nội thất, hai từ "vintage" và "retro" thường được sử dụng để thay thế cho nhau</div>
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>

  <?php
  require_once '../layouts/footer.php';
  ?>


</body>

</html>