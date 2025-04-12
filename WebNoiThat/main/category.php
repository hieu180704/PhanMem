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
</head>

<body>
  <?php
  require_once '../layouts/header.php';
  $danhmuc = $_GET['danhmuc'];

  $query = "SELECT * FROM tbl_sanpham WHERE tendanhmuc = '$danhmuc' OR tendanhmuccon = '$danhmuc'";
  $result = mysqli_query($con, $query);
  ?>

  <div class="container">
    <div class="grid">
      <div class="grid-row content">
        <!-- Bảng danh mục bên trái-->
        <div class="grid-column-2">
          <nav class="category">
            <h3 class="category-heading">
              Danh mục
            </h3>

            <ul class="category-list">
              <li class="category-item">
                <a href="index.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="category-item-link">Tất cả sản phẩm</a>
              </li>
            </ul>
          </nav>

          <nav class="category">
            <h3 class="category-heading">
              Nhà cung cấp
            </h3>
            <ul class="category-list">
              <?php
              $ncc = "SELECT * FROM tbl_nhacungcap";
              $tenncc = mysqli_query($con, $ncc);

              while ($row = mysqli_fetch_assoc($tenncc)) {
                echo '
                <li class="category-item">
                  <a href="category_nhacungcap.php?tennhacungcap=' . $row["tennhacungcap"] . '&tentaikhoan=' . $tentaikhoan . '" class="category-item-link">' . $row["tennhacungcap"] . '</a>
                </li>
              ';
              }
              ?>
            </ul>
          </nav>

          <nav class="category">
            <h3 class="category-heading">
              Giá
            </h3>

            <ul class="category-list">
              <li class="category-item">
                <a href="category_giatien.php?gia=1&tentaikhoan=<?php echo $tentaikhoan ?>" class="category-item-link">Dưới 10.000.000<sup>đ</sup></a>
              </li>
              <li class="category-item">
                <a href="category_giatien.php?gia=2&tentaikhoan=<?php echo $tentaikhoan ?>" class="category-item-link">10tr - 20tr</a>
              </li>
              <li class="category-item">
                <a href="category_giatien.php?gia=3&tentaikhoan=<?php echo $tentaikhoan ?>" class="category-item-link">20tr - 30tr</a>
              </li>
              <li class="category-item">
                <a href="category_giatien.php?gia=4&tentaikhoan=<?php echo $tentaikhoan ?>" class="category-item-link">Trên 30.000.000<sup>đ</sup></a>
              </li>
            </ul>
          </nav>
        </div>
        <!-- Phần danh sách sản phẩm -->
        <div class="grid-column-10">
          <!-- Phần lọc sản phẩm -->
          <!-- <div class="home-filter">
            <div class="select-input">
              <span class="select-input-label">Sắp xếp</span>
              <i class="select-input-icon fa-solid fa-caret-down"></i>
              <ul class="select-input-list">
                <li class="select-input-item">
                  <a href="" class="select-input-link">Mới nhất</a>
                </li>
                <li class="select-input-item">
                  <a href="" class="select-input-link">Bán chạy nhất</a>
                </li>
                <li class="select-input-item">
                  <a href="" class="select-input-link">Giá: Tăng dần</a>
                </li>
                <li class="select-input-item">
                  <a href="" class="select-input-link">Giá: Giảm dần</a>
                </li>

              </ul>
            </div>

            <div class="page">
              <span class="page-num">
                <span class="page-current">1</span>/10
              </span>

              <div class="page-change">
                <a href="" class="page-btn page-btn--disabled">
                  <i class="page-btn-icon fa-solid fa-angle-left"></i>
                </a>
                <a href="" class="page-btn">
                  <i class="page-btn-icon fa-solid fa-angle-right"></i>
                </a>
              </div>
            </div>
          </div> -->
          <!-- Phần sản phẩm -->
          <div class="home-product">
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
                      <div class="grid-column-2-4">
                        <a class="product-item" href="detail.php?masanpham=' . $row["masanpham"] . '&tentaikhoan=' . $tentaikhoan . '">
                          <div class="product-img" style="background-image: url(' . $row["anh"] . ');"></div>
                          <h4 class="product-name">' . $row["tensanpham"] . '</h4>
                          <div class="product-price">
                            <span class="product-price-current">' . formatCurrency($giasaukhigiam) . 'đ</span>
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
          <!-- Phần phân trang-->
          <!-- <ul class="pagination home-product-pagination">
            <li class="pagination-item">
              <a href="" class="pagination-item-link">
                <i class="pagination-item-icon fa-solid fa-angle-left"></i>
              </a>
            </li>
            <li class="pagination-item pagination-item--active">
              <a href="" class="pagination-item-link">1</a>
            </li>
            <li class="pagination-item">
              <a href="" class="pagination-item-link">2</a>
            </li>
            <li class="pagination-item">
              <a href="" class="pagination-item-link">3</a>
            </li>
            <li class="pagination-item">
              <a href="" class="pagination-item-link">4</a>
            </li>
            <li class="pagination-item">
              <a href="" class="pagination-item-link">5</a>
            </li>
            <li class="pagination-item">
              <a href="" class="pagination-item-link">...</a>
            </li>
            <li class="pagination-item">
              <a href="" class="pagination-item-link">14</a>
            </li>
            <li class="pagination-item">
              <a href="" class="pagination-item-link">
                <i class="pagination-item-icon fa-solid fa-angle-right"></i>
              </a>
            </li>
          </ul> -->
        </div>
      </div>
    </div>
  </div>
  <?php
  require_once '../layouts/footer.php';
  ?>
</body>

</html>