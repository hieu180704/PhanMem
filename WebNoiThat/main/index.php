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
  <script src="../assets/js/slider.js"></script>
  <link rel="stylesheet" href="../assets/css/homepage.css">
</head>

<body>

  <?php
  session_start();
  if (!isset($_SESSION["txtTenTaiKhoan"])) {
    header('location:dangnhap.php');
  }
  ?>

  <?php require_once '../layouts/header.php';

  $query = "SELECT * FROM tbl_sanpham";
  $result = mysqli_query($con, $query);

  $slider = "SELECT * FROM tbl_slider";
  $result_slider = mysqli_query($con, $slider);



  ?>

  <div homepage-container style="background-color: #f5f5f5;">
    <div class="grid">
      <div class="grid-row">
        <div class="slideshow-container">


          <?php
          $index = 1;
          $dem = 0;
          while ($row = mysqli_fetch_assoc($result_slider)) {
            if ($index === 1) {
              echo '
                <div class="mySlides fade" style="display: block">
                  <img src="' . $row["anh"] . '" style="width:100%">
                </div>              
              ';
              $index = -1;
            } else if ($dem < 2) {
              echo '
                <div class="mySlides fade">
                  <img src="' . $row["anh"] . '" style="width:100%">
                </div>
              ';
              $dem++;
            }
          }
          ?>

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
          <a class="homepage-category-item" href="category.php?danhmuc=Bàn&tentaikhoan=<?php echo $tentaikhoan ?>">
            <div class="homepage-category-img" style="background-image: url(../assets/img/homepage-category/categorybanner_1_img.jpg);"></div>
            <h4 class="homepage-category-name">Phòng khách</h4>
            <div class="homepage-category-view">
              Xem ngay
            </div>
          </a>
        </div>

        <div class="grid-column-3-homepage">
          <a class="homepage-category-item" href="category.php?danhmuc=Giường&tentaikhoan=<?php echo $tentaikhoan ?>">
            <div class="homepage-category-img" style="background-image: url(../assets/img/homepage-category/categorybanner_2_img.jpg);"></div>
            <h4 class="homepage-category-name">Phòng ngủ</h4>
            <div class="homepage-category-view">
              Xem ngay
            </div>

          </a>
        </div>

        <div class="grid-column-3-homepage">
          <a class="homepage-category-item" href="category.php?danhmuc=Bếp&tentaikhoan=<?php echo $tentaikhoan ?>">
            <div class="homepage-category-img" style="background-image: url(../assets/img/homepage-category/categorybanner_3_img.jpg);"></div>
            <h4 class="homepage-category-name">Phòng ăn và bếp</h4>
            <div class="homepage-category-view">
              Xem ngay
            </div>

          </a>
        </div>

        <div class="grid-column-3-homepage">
          <a class="homepage-category-item" href="category.php?danhmuc=Ghế&tentaikhoan=<?php echo $tentaikhoan ?>">
            <div class="homepage-category-img" style="background-image: url(../assets/img/homepage-category/categorybanner_4_img.jpg);"></div>
            <h4 class="homepage-category-name">Phòng làm việc</h4>
            <div class="homepage-category-view">
              Xem ngay
            </div>

          </a>
        </div>

      </div>


      <div class="homepage-product">
        <div class="homepage-product-heading">
          <h2 class="homepage-product-title">Tất cả sản phẩm</h2>
          <div class="product-more-container">
            <a href="" class=product-more>Xem thêm
              <i class="product-more-icon fa-solid fa-angle-right"></i>
            </a>

          </div>
        </div>

        <div class="grid-row">
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            $query_magiamgia = '
            SELECT 
                tbl_giamgia.phantram 
            FROM 
                tbl_sanpham
            INNER JOIN 
                tbl_giamgia 
            ON 
                tbl_sanpham.magiamgia = tbl_giamgia.magiamgia
            WHERE
                masanpham = "' . $row["masanpham"] . '";  
            ';
            $result_magiamgia = mysqli_query($con, $query_magiamgia);

            while ($giamgia = mysqli_fetch_assoc($result_magiamgia)) {
              $giasaukhigiam = $row["gia"] * (1 - ($giamgia["phantram"] / 100));
              echo '
                  <div class="grid-column-2-4-homepage">
                    <a class="product-item" href="detail.php?masanpham=' . $row["masanpham"] . '&tentaikhoan=' . $tentaikhoan . '">
                      <div class="product-img" style="background-image: url(' . $row["anh"] . ');"></div>
                      <h4 class="homepage-product-name">' . $row["tensanpham"] . '</h4>
                      <div class="homepage-product-price">
                        <span class="homepage-product-price-current">' . formatCurrency($giasaukhigiam) . 'đ</span>
                        <span class="product-price-old">' . formatCurrency($row["gia"]) . 'đ</span>
                      </div>
                    </a>

                    <form method="POST" class="product-action">
                      <button formaction="wishlist.php?tentaikhoan=' . $tentaikhoan . '" type="submit" name="btnThemVaoYeuThich" name="btnYeuThich" class="product-wishlist">
                        <i class="product-wishlist-icon fa-regular fa-heart"></i>
                        <input type="hidden" name="txtTenSanPham" value="' . $row["tensanpham"] . '">
                        <input type="hidden" name="txtAnh" value="' . $row["anh"] . '">
                        <input type="hidden" name="txtGia_YT" value="' . $row["gia"] . '">
                        <input type="hidden" name="txtGiaSauKhiDuocGiam" value="' . $giasaukhigiam . '">
                        <input type="hidden" name="txtMauSac" value="' . $row["mausac"] . '">
                        <input type="hidden" name="txtMaSanPham" value="' . $row["masanpham"] . '"> 
                      </button>
                      <button formaction="giohang.php?tentaikhoan=' . $tentaikhoan . '" type="submit" name="btnThemVaoGioHang" class="product-cart">
                        <input type="hidden" name="txtTenSanPham" value="' . $row["tensanpham"] . '">
                        <input type="hidden" name="txtAnh" value="' . $row["anh"] . '">
                        <input type="hidden" name="txtGia" value="' . $giasaukhigiam . '">
                        <input type="hidden" name="txtSoLuong" value="1">
                        <input type="hidden" name="txtMauSac" value="' . $row["mausac"] . '">
                        <input type="hidden" name="txtMaSanPham" value="' . $row["masanpham"] . '">                        
                        Thêm vào giỏ
                      </button>
                    </form>       
                        
                    <div class="product-sale">
                      <div class="product-sale-percent">-' . $giamgia["phantram"] . '%</div>
                    </div>                     

                  </div>    
              ';
            }
          }
          ?>
        </div>
      </div>

      <div class="homepage-sale">
        <div class="grid-row">
          <div class="grid-column-6-homepage">
            <a href="" class="homepage-sale-banner">
              <div class="homepage-sale-banner-img" style="background-image: url(../assets/img/homepage-category/homebanner_1_img.webp);"></div>
            </a>
          </div>
          <div class="grid-column-6-homepage">
            <a href="" class="homepage-sale-banner">
              <div class="homepage-sale-banner-img" style="background-image: url(../assets/img/homepage-category/homebanner_2_img.webp);"></div>
            </a>
          </div>
        </div>
      </div>

      <div class="homepage-article">
        <h2 class="homepage-article-heading">Bài viết mới nhất</h2>
        <div class="grid-row">
          <div class="grid-column-3-homepage">
            <a class="article-item" href="#">
              <div class="article-img" style="background-image: url(../assets/img/blog/blog1.jpg);"></div>
              <h4 class="homepage-article-name">"Less Is More" - Xu Hướng Tối Giản Không Gian Sống</h4>
              <div class="homepage-article-preview">Platon, nhà triết học Hy lạp cổ đại nổi tiếng từng nói:" Cái đẹp của phong cách, của sự hài hòa, của sự duyên</div>
            </a>
          </div>
          <div class="grid-column-3-homepage">
            <a class="article-item" href="#">
              <div class="article-img" style="background-image: url(../assets/img/blog/blog2.jpg);"></div>
              <h4 class="homepage-article-name">bí quyết để giữ căn bếp luôn gọn gàng</h4>
              <div class="homepage-article-preview">Khu vực bếp là không gian quan trọng trong việc cả gia đình tận hưởng bữa ăn sau một ngày dài</div>
            </a>
          </div>
          <div class="grid-column-3-homepage">
            <a class="article-item" href="#">
              <div class="article-img" style="background-image: url(../assets/img/blog/blog3.jpg);"></div>
              <h4 class="homepage-article-name">tips trang trí góc học tập, làm việc đẹp và khoa học</h4>
              <div class="homepage-article-preview">Những góc học tập, làm việc được bài trí một cách khoa học và thông minh, giúp cho công việc</div>
            </a>
          </div>
          <div class="grid-column-3-homepage">
            <a class="article-item" href="#">
              <div class="article-img" style="background-image: url(../assets/img/blog/blog4.jpg);"></div>
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