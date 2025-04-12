<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm
//$query = "SELECT * FROM tbl_danhmuc"; //Lệnh Truy Vấn Sql
//$result = mysqli_query($con, $query); //Thực thi truy vấn
//$nhacungcap = "SELECT * FROM tbl_nhacungcap";
//$resultncc = mysqli_query($con, $nhacungcap);
?>

<div class="row">
    <div class="col-md-12">
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Thêm nhà cung cấp</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" class="clearfix">
                        <div class="form-group">
                            <label>Mã nhà cung cấp</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtMaNhaCungCap" placeholder="Mã nhà cung cấp" required>
                            </div>
                            <br>

                            <label>Tên nhà cung cấp</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtTenNhaCungCap" placeholder="Tên nhà cung cấp" required>
                            </div>
                            <br>

                            <label>Địa chỉ</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtDiaChi" placeholder="Địa chỉ" required>
                            </div>
                            <br>

                            <label>Email</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-euro"></i>
                                </span>
                                <input type="text" class="form-control" name="txtEmail" placeholder="Email" required>
                            </div>
                            <br>

                            <label>Số điện thoại</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="number" class="form-control" name="txtSoDienThoai" placeholder="Số điện thoại" required>
                            </div>
                        </div>



                        <button type="submit" name="btnThem" class="btn btn-danger">Thêm nhà cung cấp</button>
                        <a href="nhacungcap.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnThem'])) {
    $manhacungcap = $_POST['txtMaNhaCungCap'];
    $tennhacungcap = $_POST['txtTenNhaCungCap'];
    $diachi = $_POST['txtDiaChi'];
    $email = $_POST['txtEmail'];
    $sodienthoai = $_POST['txtSoDienThoai'];

    if (kiemTraTrungKhoa("tbl_nhacungcap", "tennhacungcap", $tennhacungcap, $con) === false) {
        return;
    } else {
        $them = "INSERT INTO tbl_nhacungcap VALUES ('" . $manhacungcap . "', '" . $tennhacungcap . "', '" . $diachi . "', '" . $email . "', '" . $sodienthoai . "');";
        $result = mysqli_query($con, $them);
        if ($result > 0) {
            echo '
                <script>
                    alert("Thêm dữ liệu thành công");
                    window.location.href = "nhacungcap.php?tentaikhoan=' . $tentaikhoan . '";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Thêm dữ liệu thất bại");
                </script>
            ';
        }
    }
}
?>
<?php include_once('footer.php'); ?>