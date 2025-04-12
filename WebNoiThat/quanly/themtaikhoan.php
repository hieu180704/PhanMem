<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm
$query = ""; //Lệnh Truy Vấn Sql
$result; //Thực thi truy vấn

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
                    <span>Thêm tài khoản</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" class="clearfix">
                        <div class="form-group">
                            <label>Tên tài khoản</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtTenTaiKhoan" placeholder="Tên tài khoản" required>
                            </div>
                            <br>

                            <label>Mật Khẩu</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtMatKhau" placeholder="Mật Khẩu" required>
                            </div>
                            <br>

                            <label>Email</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtEmail" placeholder="Email" required>
                            </div>
                            <br>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Loại tài khoản</label>
                                    <select class="form-control" name="cboLoaiTaiKhoan">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btnThem" class="btn btn-danger">Thêm tài khoản</button>
                        <a href="taikhoan.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnThem'])) {
    $tentaikhoan = $_POST['txtTenTaiKhoan'];
    $matkhau = $_POST['txtMatKhau'];
    $email = $_POST['txtEmail'];
    $loaitaikhoan = $_POST['cboLoaiTaiKhoan'];

    if (kiemTraTrungKhoa("tbl_taikhoan", "tentaikhoan", $tentaikhoan, $con) === false) {
        return;
    } else {
        $query = "INSERT INTO tbl_taikhoan VALUES ('" . $tentaikhoan . "', '" . $matkhau . "', '" . $email . "', '" . $loaitaikhoan . "');";
        $result = mysqli_query($con, $query);
        if ($result > 0) {
            echo "Thêm thành công";
        } else {
            echo "Thêm thất bại";
        }
    }
}
?>
<?php include_once('footer.php'); ?>