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
  <link rel="stylesheet" href="../assets/css/detail.css">
  <link rel="stylesheet" href="../assets/css/homepage.css">
</head>

<body>
  <?php
  require_once '../layouts/header.php';

  $masanpham = $_GET['masanpham'];

  $query = "SELECT * FROM tbl_sanpham WHERE masanpham='$masanpham'";
  $result = mysqli_query($con, $query);

  $tendanhmuc = "";
  $soluong = 0;

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
      masanpham = "' . $masanpham . '";  
  ';
  $result_magiamgia = mysqli_query($con, $query_magiamgia);
  while ($row = mysqli_fetch_assoc($result_magiamgia)) {
    $phantram = $row["phantram"];
  }

  while ($row = mysqli_fetch_assoc($result)) {
    $tendanhmuc = $row["tendanhmuc"];
    $tensanpham = $row["tensanpham"];
    $soluong = (int)$row["soluong"];
    $gia = $row["gia"];
    $anh = $row["anh"];
    $mausac = $row["mausac"];
  }

  $giasaukhigiam = $gia * (1 - ($phantram / 100));
  ?>

  <div class="detail-product">
    <div class="grid">
      <!-- Chi tiết sản phẩm -->
      <div class="grid-row content">
        <div class="grid-column-6">
          <div class="detail-product-img" style="background-image: url(<?php echo $anh ?>);"></div>
        </div>
        <div class="grid-column-6">
          <div class="detail-product-checkin">
            <div class="breadcrumb">
              <ul class="breadcrumb-list">
                <li class="breadcrumb-item">
                  <a href="index.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="breadcrumb-item-link">Trang chủ</a><span class="breadcrumb-separate">/</span>
                </li>

                <li class="breadcrumb-item">
                  <a href="category.php?danhmuc=<?php echo $tendanhmuc ?>&tentaikhoan=<?php echo $tentaikhoan ?>" class="breadcrumb-item-link"><?php echo $tendanhmuc ?></a><span class="breadcrumb-separate">/</span>
                </li>

                <li class="breadcrumb-item">
                  <span><?php echo $tensanpham ?></span>
                </li>
              </ul>
            </div>
            <h3 class="detail-product-heading"><?php echo $tensanpham ?></h3>
            <div class="detail-product-state">
              <span class="detail-product-state-heading">Tình trạng:</span>
              <?php
              if ($soluong > 0) {
                echo ' <span class="detail-product-state-stock">Còn hàng</span>';
              } else {
                echo ' <span class="detail-product-state-stock">Hết hàng</span>';
              }

              ?>
            </div>
            <div class="detail-product-price">
              <?php

              ?>
              <span class="detail-product-price-heading">Giá: </span>
              <span class="detail-product-price-current"><?php echo formatCurrency($giasaukhigiam) . " đ" ?></span>
              <span class="detail-product-price-old"><?php echo formatCurrency($gia) . " đ" ?></span>
              <div class="detail-product-sale">
                <div class="detail-product-sale-percent">-<?php echo $phantram ?> %</div>
              </div>
            </div>


            <div class="detail-product-color-radio">
              <span class="detail-product-color-radio-heading">
                Màu sắc:
              </span>
              <?php //Code sql hiển thị màu sắc
              $query_mausac = "SELECT * FROM tbl_sanpham WHERE tensanpham = '$tensanpham'";
              $result_mausac = mysqli_query($con, $query_mausac);

              while ($row = mysqli_fetch_assoc($result_mausac)) {
                echo '
                  <input type="radio" class="detail-product-color-input" value="blue" name="rdoColor" id="blue" checked>
                  <label class="detail-product-color-input-label" for="blue">' . $row["mausac"] . '</label>
                ';
              }
              ?>
            </div>

            <div class="detail-product-quantity">
              <span class="detail-product-quantity-heading">
                Số lượng:
              </span>
              <button class="detail-product-quantity-button" id="minus-btn">
                <i class="detail-product-quantity-icon fa-solid fa-minus"></i>
              </button>
              <input type="text " class="detail-product-quantity-input" value="1" min="1" id="quantity-input">
              <button class="detail-product-quantity-button" id="plus-btn">
                <i class="detail-product-quantity-icon fa-solid fa-plus"></i>
              </button>
            </div>

            <form method="POST" class="detail-product-action">
              <button formaction="wishlist.php?tentaikhoan=<?php echo $tentaikhoan ?>" type="submit" name="btnThemVaoYeuThich" class="detail-product-wishlist">
                <i class="detail-product-icon fa-regular fa-heart"></i>
                <input type="hidden" name="txtTenSanPham" value="<?php echo $tensanpham ?>">
                <input type="hidden" name="txtAnh" value="<?php echo $anh ?>">
                <input type="hidden" name="txtGia_YT" value="<?php echo $gia ?>">
                <input type="hidden" name="txtGiaSauKhiDuocGiam" value="<?php echo $giasaukhigiam ?>">
                <input type="hidden" name="txtMauSac" value="<?php echo $mausac ?>">
                <input type="hidden" name="txtMaSanPham" value="<?php echo $masanpham ?>">
                Yêu thích
              </button>
              <button formaction="giohang.php?tentaikhoan=<?php echo $tentaikhoan ?>" type="submit" name="btnThemVaoGioHang" class="detail-product-cart">
                <i class="detail-product-icon fa-solid fa-cart-shopping"></i>
                Thêm vào giỏ hàng
                <input type="hidden" name="txtTenSanPham" value="<?php echo $tensanpham ?>">
                <input type="hidden" name="txtAnh" value="<?php echo $anh ?>">
                <input type="hidden" name="txtGia" value="<?php echo $giasaukhigiam ?>">
                <input type="hidden" name="txtMauSac" value="<?php echo $mausac ?>">
                <input type="hidden" name="txtSoLuong" value="" id="hidden-input">
                <input type="hidden" name="txtMaSanPham" value="<?php echo $masanpham ?>">
              </button>
              <button formaction="muahang.php?tentaikhoan=<?php echo $tentaikhoan ?>&masanpham=<?php echo $masanpham ?>" class="detail-product-buy">
                <div class="detail-product-buy-label">Mua ngay</div>
              </button>
            </form>
          </div>
        </div>
      </div>
      <!-- Sản phẩm tương tự -->
      <div class="homepage-product" style="padding-top: 30px; padding-bottom: 30px">
        <div class="homepage-product-heading">
          <h2 class="homepage-product-title">Sản phẩm tương tự</h2>
          <div class="product-more-container">
            <a href="" class=product-more>Xem thêm
              <i class="product-more-icon fa-solid fa-angle-right"></i>
            </a>

          </div>
        </div>

        <div class="grid-row">
          <?php
          $query = "SELECT * FROM tbl_sanpham WHERE tendanhmuc = '$tendanhmuc'";
          $result = mysqli_query($con, $query);

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
                    <span class="homepage-product-price-old">' . formatCurrency($row["gia"]) . 'đ</span>
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
              </div>';
            }
          }
          ?>
        </div>
      </div>

    </div>
  </div>

  <?php
  require_once '../layouts/footer.php';
  ?>

  <script src="../assets/js/detail.js"></script>
</body>

</html>