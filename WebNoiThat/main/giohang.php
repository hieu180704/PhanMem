<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'webnoithat');
if (!$con) {
    echo "Kết nối không thành công " . mysqli_connect_error();
}

$tk = $_GET['tentaikhoan'];

// Khởi tạo giỏ hàng nếu chưa tồn tại
if (!isset($_SESSION['giohang'])) {
    $_SESSION['giohang'] = [];
}

// Cập nhật số lượng giỏ hàng vào session
function updateCartCount()
{
    $_SESSION['cart_count'] = count($_SESSION['giohang']);
}

// Xoá tất cả sản phẩm trong giỏ hàng
if (isset($_GET['delcart']) && ($_GET['delcart'] == 1)) {
    unset($_SESSION['giohang']);
    $_SESSION['giohang'] = [];
    updateCartCount();
}

// Xoá sản phẩm trong giỏ hàng
if (isset($_GET['delid']) && ($_GET['delid'] >= 0)) {
    array_splice($_SESSION['giohang'], $_GET['delid'], 1);
    updateCartCount();
}

function batLoiSoLuong($soluong)
{
    if (strlen($soluong) === 0) {
        return false;
    }
    if (!preg_match('/^[0-9]+$/', $soluong)) {
        return false;
    }
    return true;
}

function chuanHoaDuLieu($soluong)
{
    if (batLoiSoLuong($soluong) === false) {
        echo '
            <script>
                alert("Số lượng sai!");
            </script>
        ';
        return false;
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnThemVaoGioHang'])) {
    $tensanpham = $_POST["txtTenSanPham"];
    $anh = $_POST["txtAnh"];
    $gia = $_POST["txtGia"];
    $mausac = $_POST["txtMauSac"];
    $soluong = $_POST["txtSoLuong"];
    $masanpham = $_POST["txtMaSanPham"];

    if (chuanHoaDuLieu($soluong) === false) {
        exit();
    }

    $query = "SELECT * FROM tbl_sanpham WHERE masanpham='$masanpham'";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        if ((int)$row["soluong"] < 1) {
            echo '
                <script>
                    alert("Mặt hàng này đã hết!");
                </script>
            ';
        } else if ($soluong > (int)$row["soluong"]) {
            echo '
                <script>
                    alert("Số lượng bạn mua đã vượt quá tồn kho!");
                </script>
            ';
        } else {
            $check = 0;
            for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                if ($_SESSION['giohang'][$i][5] == $masanpham) {
                    echo '
                        <script>
                            alert("Sản phẩm này đã có trong giỏ hàng");
                        </script>
                    ';
                    $check = 1;
                    break;
                }
            }

            if ($check === 0) {
                echo '
                    <script>
                        alert("Thêm vào giỏ hàng thành công");
                    </script>
                ';
                $sp = [$tensanpham, $anh, $gia, $mausac, $soluong, $masanpham];
                $_SESSION['giohang'][] = $sp;
                updateCartCount();
            }
        }
    }
}

function chuanHoaTien($number)
{
    return number_format($number, 0, '', '.');
}

function showGioHang($tk)
{
    if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
        $tongtien = 0;
        for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
            $tt = $_SESSION['giohang'][$i][2] * $_SESSION['giohang'][$i][4];
            $tongtien += $tt;
            echo '
                <tr>
                    <td>' . ($i + 1) . '</td>
                    <td>
                        <div class="cart-info">
                            <img src="' . $_SESSION['giohang'][$i][1] . '" alt="">
                            <div>
                                <p>' . $_SESSION['giohang'][$i][0] . '</p>
                                <small class="dongia">Đơn giá: ' . chuanHoaTien($_SESSION['giohang'][$i][2]) . ' đ</small>
                                <a href="giohang.php?delid=' . $i . '&tentaikhoan=' . $tk . '">Xoá khỏi giỏ hàng</a>
                            </div>
                        </div>
                    </td>
                    <td>' . $_SESSION['giohang'][$i][3] . '</td>
                    <td> ' . $_SESSION['giohang'][$i][4] . '</td>
                    <td>' . chuanHoaTien($tt) . ' đ</td>
                </tr>            
            ';
        }
        echo '
            <div class="total-price">
                <table>
                    <tr>
                        <td style="color: skyblue;">Thông tin đơn hàng</td>
                    </tr>
                    <tr>
                        <td>Tổng tiền phải trả:</td>
                        <td>' . chuanHoaTien($tongtien) . ' đ</td>
                    </tr>
                </table>
            </div>    
        ';
    } else {
        echo '
            <div class="total-price">
                <table>
                    <tr>
                        <td style="color: skyblue;">Thông tin đơn hàng</td>
                    </tr>
                    <tr>
                        <td>Tổng tiền phải trả:</td>
                        <td>0 đ</td>
                    </tr>
                </table>
            </div>    
        ';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/category.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <title>Giỏ hàng của bạn</title>
</head>

<body>
    <?php require_once '../layouts/header.php';

    $query = "SELECT * FROM tbl_thongtintaikhoan where tentaikhoan ='$tentaikhoan'";
    $result = mysqli_query($con, $query);

    $hovaten = "";
    $sodienthoai = "";
    $CCCD = "";
    $diachi = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $hovaten = $row["hovaten"];
        $sodienthoai = $row["sodienthoai"];
        $CCCD = $row["cccd"];
        $diachi = $row["diachi"];
    };

    ?>



    <div class="container">
        <h2>Giỏ hàng của bạn</h2>
        <table>
            <tr>
                <th>Số Thứ Tự</th>
                <th>Sản phẩm</th>
                <th>Màu sắc</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
            <?php showGioHang($tk); ?>
        </table>
    </div>

    <div class="container-2">
        <h1>Nội Thất BAYA</h1>
        <h2>Thông tin giao hàng</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Họ và tên</label>
                <input type="text" id="name" name="name" placeholder="Họ và tên" value="<?php echo $hovaten ?>">
            </div>
            <div class="form-group">
                <label for="CCCD">Căn cước công dân</label>
                <input type="CCCD" id="CCCD" name="CCCD" placeholder="Căn cước công dân" value="<?php echo $CCCD ?>">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" placeholder="Số điện thoại" value="<?php echo $sodienthoai ?>">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <textarea id="address" name="address" placeholder="Địa chỉ"><?php echo $diachi ?></textarea>
                </div>
            </div>
            <h2>Phương thức vận chuyển</h2>
            <div class="payment-method">
                <label>
                    <input type="radio" name="shipment-method" value="Chuyển phát nhanh">
                    Chuyển phát nhanh
                </label>
            </div>
            <div class="payment-method">
                <label>
                    <input type="radio" name="shipment-method" value="Chuyển phát thường">
                    Chuyển phát thường
                </label>
            </div>
            <h2>Phương thức Thanh Toán</h2>
            <div class="payment-method">
                <label>
                    <input type="radio" name="shipment-method" value="Chuyển phát nhanh">
                    Chuyển phát nhanh
                </label>
            </div>
            <div class="payment-method">
                <label>
                    <input type="radio" name="shipment-method" value="Chuyển phát thường">
                    Chuyển phát thường
                </label>
            </div>
            <h2>Phương thức Thanh Toán</h2>
            <div class="payment-method">
                <label for="cod">
                    <input type="radio" id="cod" name="payment-method" value="Thanh toán tiền mặt khi giao hàng (COD)">
                    Thanh toán tiền mặt khi giao hàng (COD)
                </label>
            </div>
            <div class="payment-method">
                <label for="bank-transfer">
                    <input type="radio" id="bank-transfer" name="payment-method" value="Thanh toán chuyển khoản qua ngân hàng">
                    Thanh toán chuyển khoản qua ngân hàng
                </label>
            </div>
            <div class="payment-method">
                <label for="pos">
                    <input type="radio" id="pos" name="payment-method" value="Thanh toán quẹt thẻ khi giao hàng (POS)">
                    Thanh toán quẹt thẻ khi giao hàng (POS)
                </label>
            </div>
            <div class="payment-method">
                <label for="vnpay">
                    <input type="radio" id="vnpay" name="payment-method" value="Thanh toán online qua cổng VNPay (ATM/Visa/MasterCard/JCB/QR Pay trên Internet Banking)">
                    Thanh toán online qua cổng VNPay (ATM/Visa/MasterCard/JCB/QR Pay trên Internet Banking)
                    <div class="icons">
                    </div>
                </label>
            </div>
            <div class="payment-method">
                <label for="momo">
                    <input type="radio" id="momo" name="payment-method" value="Ví MoMo">
                    Ví MoMo
                </label>
            </div>
        </form>
    </div>

    <div class="btn">
        <form method="POST">
            <button type="submit" name="btnThanhToan" class="thanhtoan">Thanh toán</button>
            <a href="giohang.php?tentaikhoan=<?php echo $tk ?>&delcart=1" class="xoagiohang">Xoá giỏ hàng</a>
        </form>
    </div>

    <?php require_once '../layouts/footer.php'; ?>

    <script src="../assets/js/cart.js"></script>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnThanhToan'])) {
    if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
        for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
            $masanpham = $_SESSION['giohang'][$i][5];
            $soluongmua = (int)$_SESSION['giohang'][$i][4];
            $sql_select = "SELECT soluong FROM tbl_sanpham WHERE masanpham = '$masanpham'";
            $result_select = mysqli_query($con, $sql_select);

            while ($row = mysqli_fetch_assoc($result_select)) {
                $soluonghientai = (int)$row["soluong"];
            }

            $soluongmoi = $soluonghientai - $soluongmua;

            $sql_update = "UPDATE tbl_sanpham SET soluong = '$soluongmoi' WHERE masanpham = '$masanpham'";
            $result_update = mysqli_query($con, $sql_update);



            $tensanpham = $_SESSION['giohang'][$i][0];
            $anh = $_SESSION['giohang'][$i][1];
            $gia = $_SESSION['giohang'][$i][2];
            $soluong = $_SESSION['giohang'][$i][4];
            $thoiGianHienTai = date('Y-m-d H:i:s');

            $query = "INSERT INTO tbl_donhang (tensanpham, anh, soluong, dongia, ngaymua, trangthai, tentaikhoan) 
          VALUES ('$tensanpham', '$anh', '$soluong', '$gia', '$thoiGianHienTai', 'Đang giao', '$tentaikhoan')";
            $result = mysqli_query($con, $query);

            if ($result_update === true) {
                echo '
                    <script>
                        alert("Đặt hàng thành công");
                        window.location.href = "giohang.php?tentaikhoan=' . $tentaikhoan . '&delcart=1";
                    </script>    
                ';
            } else {
                echo '
                <script>
                    alert("Cập nhật số lượng thất bại!");
                </script>   
                ';
            }
        }
    }
}
?>