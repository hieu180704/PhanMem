<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$cart_count = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
$wishlist_count = isset($_SESSION['wishlist_count']) ? $_SESSION['wishlist_count'] : 0;
?>


<?php
include '../quanly/connect.php';  //Thêm file connect
include '../quanly/functions.php'; //File Hàm


$tentaikhoan = $_GET['tentaikhoan'];

$query_danhmuc = "SELECT * FROM tbl_danhmuc";
$result_danhmuc = mysqli_query($con, $query_danhmuc);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnTimKiem'])) {
  $timkiem = $_POST["txtTimKiem"];

  header('location:category_timkiem.php?timkiem=' . $timkiem . '&tentaikhoan=' . $tentaikhoan . '');
  exit();
}

$query_soluong_donhang = "
SELECT COUNT(*) AS so_dong
FROM tbl_donhang
WHERE tentaikhoan = '$tentaikhoan'
;";

$result_soluong_donhang = mysqli_query($con, $query_soluong_donhang);
while ($row = mysqli_fetch_assoc($result_soluong_donhang)) {
  $soluongdonhang = $row["so_dong"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/base.css">
  <link rel="stylesheet" href="/assets/css/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="/assets/css/category.css">
  <link rel="stylesheet" href="/assets/css/footer.css">
</head>

<body>
  <header class="header">
    <!-- Header with Search -->
    <div class="grid">
      <div class="header-with-search">
        <div class="header__logo">
          <a href="index.php?tentaikhoan=<?php echo $tentaikhoan ?>"><img src="../assets/img/logo.png" alt="" class="logo-img"></a>

        </div>

        <form class="header__search" method="POST">
          <input type="text" class="search-input" name="txtTimKiem" placeholder="Tìm kiếm sản phẩm...">
          <button type="submit" class="search-btn" name="btnTimKiem">
            <i class="search-icon fa-solid fa-magnifying-glass"></i>
          </button>
        </form>

        <div class="header__features">
          <div class="user">
            <i class="feature-icon fa-solid fa-user"></i>
            <a class="user-login" href="profile.php?tentaikhoan=<?php echo $tentaikhoan ?>"> <?php echo $tentaikhoan ?> </a>
            <a class="user-login" href="dangxuat.php">Đăng xuất </a>
          </div>
          <a class="cart" href="giohang.php?tentaikhoan=<?php echo $tentaikhoan ?>">
            <i class="feature-icon fa-solid fa-cart-shopping"></i>
            <span class="count-holder">
              <span class="count"><?php echo $cart_count ?></span>
            </span>
          </a>
          <a class="wishlist" href="wishlist.php?tentaikhoan=<?php echo $tentaikhoan ?>">
            <i class="feature-icon fa-solid fa-heart"></i>
            <span class="count-holder">
              <span class="count"><?php echo $wishlist_count ?></span>
            </span>
          </a>
          <a class="order" href="donhang.php?tentaikhoan=<?php echo $tentaikhoan ?>">
            <i class=" feature-icon fa-solid fa-box"></i>
            <span class="count-holder">
              <span class="count"><?php echo $soluongdonhang ?></span>
            </span>
          </a>
        </div>
      </div>

      <div class="header-category">
        <?php
        if (mysqli_num_rows($result_danhmuc) > 0) {
          while ($row = mysqli_fetch_assoc($result_danhmuc)) {
            $danhmuccon = 'SELECT * FROM tbl_danhmuccon WHERE tendanhmuc = "' . $row["tendanhmuc"] . '" ';
            $result_danhmuccon = mysqli_query($con, $danhmuccon);
            $child = false;

            echo '<div class="dropdown">';
            echo '<a class="dropbtn" href="category.php?danhmuc=' . $row["tendanhmuc"] . '&tentaikhoan=' . $tentaikhoan . '">' . $row["tendanhmuc"] . '</a>';
            echo '<div class="dropdown-content">';

            if (mysqli_num_rows($result_danhmuccon) > 0) {
              $child = true;
              while ($row_danhmuccon = mysqli_fetch_assoc($result_danhmuccon)) {
                echo '<a href="category.php?danhmuc=' . $row_danhmuccon["tendanhmuccon"] . '&tentaikhoan=' . $tentaikhoan . '">' . $row_danhmuccon["tendanhmuccon"] . '</a>';
              }
            }

            echo '</div>';
            echo '</div>';
          }
        }
        ?>
      </div>
    </div>
  </header>

</body>

</html>