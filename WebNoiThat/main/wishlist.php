<?php

session_start();

$tentaikhoan = $_GET["tentaikhoan"];

if (!isset($_SESSION['yeuthich'])) {
  $_SESSION['yeuthich'] = [];
}

function wishListCartCount()
{
  $_SESSION['wishlist_count'] = count($_SESSION['yeuthich']);
}

//Xoá tất cả sản phẩm trong yêu thích
if (isset($_GET['delyeuthich']) && ($_GET['delyeuthich'] == 1)) {
  unset($_SESSION['yeuthich']);
  wishListCartCount();
}

//Xoá sản phẩm trong yêu thích
if (isset($_GET['delid']) && ($_GET['delid'] >= 0)) {
  array_splice($_SESSION['yeuthich'], $_GET['delid'], 1);
  wishListCartCount();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnThemVaoYeuThich'])) {
  $tensanpham = $_POST["txtTenSanPham"];
  $anh = $_POST["txtAnh"];
  $gia = $_POST["txtGia_YT"];
  $giasaukhiduocgiam = $_POST["txtGiaSauKhiDuocGiam"];
  $mausac = $_POST["txtMauSac"];
  $masanpham = $_POST["txtMaSanPham"];

  $check = 0; //Kiểm tra sp có trùng không

  for ($i = 0; $i < sizeof($_SESSION['yeuthich']); $i++) {
    if ($_SESSION['yeuthich'][$i][5] == $masanpham) {
      $check = 1;
      break;
    }
  }

  //Nếu không trùng sp trong giỏ hàng thì mới thêm
  if ($check === 0) {
    //Thêm sp vào giỏ hàng
    $sp = [$tensanpham, $anh, $gia, $mausac, $giasaukhiduocgiam, $masanpham];
    $_SESSION['yeuthich'][] = $sp;
    wishListCartCount();
  }

  // var_dump($_SESSION['giohang']);


}

function showYeuThich($tk, $con)
{
  if (isset($_SESSION['yeuthich']) && (is_array($_SESSION['yeuthich']))) {
    for ($i = 0; $i < sizeof($_SESSION['yeuthich']); $i++) {
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
            masanpham = "' . $_SESSION['yeuthich'][$i][5] . '";  
        ';
      $result_magiamgia = mysqli_query($con, $query_magiamgia);

      while ($giamgia = mysqli_fetch_assoc($result_magiamgia)) {
        echo '
              <div class="grid-column-2-4-homepage">
                <a class="product-item" href="detail.php?masanpham=' . $_SESSION['yeuthich'][$i][5] . '&tentaikhoan=' . $tk . '">
                  <div class="product-img" style="background-image: url(' . $_SESSION['yeuthich'][$i][1] . ');"></div>
                  <h4 class="wishlist-product-name">' . $_SESSION['yeuthich'][$i][0] . '</h4>
                  <div class="wishlist-product-price">
                    <span class="wishlist-product-price-current">' . formatCurrency($_SESSION['yeuthich'][$i][4]) . ' đ</span>
                    <span class="wishlist-product-price-old">' . formatCurrency($_SESSION['yeuthich'][$i][2]) . 'đ</span>
                  </div>
                </a>

                <form method="POST" class="wishlist-product-action">
                  <button formaction="giohang.php?tentaikhoan=' . $tk . '" type="submit" name="btnThemVaoGioHang" class="wishlist-product-cart">
                    <input type="hidden" name="txtTenSanPham" value="' . $_SESSION['yeuthich'][$i][0] . '">
                    <input type="hidden" name="txtAnh" value="' . $_SESSION['yeuthich'][$i][1] . '">
                    <input type="hidden" name="txtGia" value="' . $_SESSION['yeuthich'][$i][2] . '">
                    <input type="hidden" name="txtMauSac" value="' . $_SESSION['yeuthich'][$i][3] . '">
                    <input type="hidden" name="txtMaSanPham" value="' . $_SESSION['yeuthich'][$i][5] . '">
                    Thêm vào giỏ</button>
                  <a href = "wishlist.php?delid=' . $i . '&tentaikhoan=' . $tk . '" class="wishlist-product-delete">
                    Xóa sản phẩm
                  </a>
                </form>
                
                <div class="product-sale">
                  <div class="product-sale-percent">-' . $giamgia['phantram'] . '%</div>
                </div>
              </div>      
          ';
      }
    }
  }
}

?>



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
  <link rel="stylesheet" href="../assets/css/wishlist.css">
</head>

<body>
  <?php
  require_once '../layouts/header.php';
  ?>

  <div class="wishlist-container" style="background-color: #f5f5f5;">
    <div class="grid">
      <div class="wishlist-product">
        <div class="wishlist-product-heading">
          <h2 class="wishlist-product-title">Danh sách sản phẩm yêu thích</h2>
        </div>

        <div class="grid-row">
          <?php
          showYeuThich($tentaikhoan, $con);
          ?>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once '../layouts/footer.php';
  ?>
</body>

</html>