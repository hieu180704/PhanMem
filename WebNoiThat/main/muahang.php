<?

session_start();

?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nội Thất MOHO</title>
    <link rel="stylesheet" href="../assets/css/muahang.css">
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
    <link rel="stylesheet" href="../assets/css/homepage.css">

</head>

<body>
    <?php require_once '../layouts/header.php';

    $masanpham = $_GET['masanpham'];

    $query_check = "SELECT * FROM tbl_sanpham WHERE masanpham = '$masanpham'";
    $result_check = mysqli_query($con, $query_check);

    while ($row = mysqli_fetch_assoc($result_check)) {
        $soluong = (int)$row["soluong"];
        $danhmuc = $row["tendanhmuc"];
    }

    if ($soluong < 1) {
        echo '
            <script>
                alert("Sản phẩm này đã hết hàng!");
                window.location.href = "detail.php?masanpham=' . $masanpham . '&tentaikhoan=' . $tentaikhoan . '";
            </script>
        ';
        exit();
    }

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
        <h1>Nội Thất BAYA</h1>
        <div class="breadcrumb">
            <a href="giohang.php?tentaikhoan=<?php echo $tentaikhoan ?>">Quay Lại Giỏ hàng</a> > <span>Thông tin giao hàng</span>
        </div>
        <h2>Thông tin giao hàng</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Họ và tên</label>
                <input type="text" id="name" name="txtHoVaTen" placeholder="Họ và tên" value="<?php echo $hovaten ?>">
            </div>
            <div class="form-group">
                <label for="CCCD">Căn cước công dân</label>
                <input type="CCCD" id="CCCD" name="txtCCCD" placeholder="Căn cước công dân" value="<?php echo $CCCD ?>">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="txtSoDienThoai" placeholder="Số điện thoại" value="<?php echo $sodienthoai ?>">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <textarea id="address" name="txtDiaChi" placeholder="Địa chỉ"><?php echo $diachi ?>"</textarea>
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
            <div class="button-container">
                <button type="submit" name="btnHoanTat">Hoàn tất đơn hàng</button>
            </div>
        </form>
    </div>
    <?php require_once '../layouts/footer.php'; ?>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnHoanTat'])) {
    if (!($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['shipment-method']))) {
        echo '
            <script>
                alert("Chưa chọn phương thức vận chuyển");
            </script>    
        ';
        exit();
    }
    if (!($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['payment-method']))) {
        echo '
            <script>
                alert("Chưa chọn phương thức thanh toán");
            </script>    
        ';
        exit();
    }

    $sql_select = "SELECT soluong FROM tbl_sanpham WHERE masanpham = '$masanpham'";

    $result_select = mysqli_query($con, $sql_select);

    while ($row = mysqli_fetch_assoc($result_select)) {
        $soluonghientai = (int)$row["soluong"];
    }

    $soluongmoi = $soluonghientai - 1;

    $sql_update = "UPDATE tbl_sanpham SET soluong = '$soluongmoi' WHERE masanpham = '$masanpham'";
    $result_update = mysqli_query($con, $sql_update);

    if ($result_update === true) {
        echo '
            <script>
                alert("Đặt hàng thành công");
                window.location.href = "index.php?tentaikhoan=' . $tentaikhoan . '"
            </script>    
        ';
    } else {
        echo '
        <script>
            alert("Cập nhật số lượng thất bại!");
        </script>   
        ';
    }

    $query = "SELECT * FROM tbl_sanpham WHERE masanpham ='$masanpham'";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $tensanpham = $row["tensanpham"];
        $anh = $row["anh"];
        $gia = $row["gia"];
    }

    $thoiGianHienTai = date('Y-m-d H:i:s');

    $query = "INSERT INTO tbl_donhang (tensanpham, anh, soluong, dongia, ngaymua, trangthai, tentaikhoan) VALUES ('$tensanpham', '$anh', '1', '$gia', '$thoiGianHienTai', 'Đang giao', '$tentaikhoan')";
    $result = mysqli_query($con, $query);
}
?>