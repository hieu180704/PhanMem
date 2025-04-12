<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$madonhang = $_GET['madonhang'];

$query = "SELECT * FROM tbl_donhang WHERE madonhang='$madonhang'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tensanpham = $row["tensanpham"];
        $anh = $row["anh"];
        $soluong = $row["soluong"];
        $dongia = $row["dongia"];
        $ngaymua = $row["ngaymua"];
        $trangthai = $row["trangthai"];
    }
}

?>

<div class="row">
    <div class="col-md-12">
    </div>
</div>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Sửa đơn hàng</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <form method="post">
                    <div class="form-group">
                        <label for="">Mã đơn hàng</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtMaDonHang" value="<?php echo $madonhang ?>" disabled>
                        </div>
                        <br>

                        <label for="">Tên sản phẩm</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtTenSanPham" value="<?php echo $tensanpham ?>" disabled required>
                        </div>
                        <br>

                        <label for="">Ảnh</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtAnh" value="<?php echo $anh ?>" disabled required>
                        </div>
                        <br>

                        <label for="">Số lượng</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="number" class="form-control" name="txtSoLuong" value="<?php echo $soluong ?>" required>
                        </div>
                        <br>

                        <label for="">Đơn Giá</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="number" class="form-control" name="txtGia" value="<?php echo $dongia ?>" required>
                        </div>
                        <br>

                        <label for="">Ngày Mua</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="date" class="form-control" name="dtpNgayMua" value="<?php echo $ngaymua ?>" required>
                        </div>
                        <br>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Trạng Thái</label>
                                <select class="form-control" name="cboTrangThai">
                                    <option value="Đang giao">Đang giao</option>
                                    <option value="Đã nhận hàng">Đã nhận hàng</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="btnSua" class="btn btn-danger">Sửa</button>
                    <a href="donhang.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnSua'])) {
    $soluong = $_POST["txtSoLuong"];
    $dongia = $_POST["txtGia"];
    $ngaymua = $_POST["dtpNgayMua"];
    $trangthai = $_POST["cboTrangThai"];

    $query = "UPDATE tbl_donhang SET soluong='" . $soluong . "', dongia='" . $dongia . "', ngaymua='" . $ngaymua . "', trangthai='" . $trangthai . "' WHERE madonhang='" . $madonhang . "'";
    $result = mysqli_query($con, $query);
    if ($result > 0) {
        echo '
            <script>
                alert("Cập nhật dữ liệu thành công");
                window.location.href = "donhang.php?tentaikhoan=' . $tentaikhoan . '";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Cập nhật dữ liệu thất bại");
            </script>
        ';
    }
}

?>

<?php include_once('footer.php'); ?>