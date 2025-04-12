<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$id = $_GET['id'];
$matkhau = "";
$email = "";
$loaitaikhoan = "";


$query = "SELECT * FROM tbl_taikhoan WHERE tentaikhoan='$id'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $matkhau = $row["matkhau"];
        $email = $row["email"];
        $loaitaikhoan = $row["loaitaikhoan"];
    }
}

?>

<div class="row">
    <div class="col-md-12">
        <!-- <?php echo "display_msg();" ?> -->
    </div>
</div>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Sửa Tài Khoản</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <form method="post">
                    <div class="form-group">
                        <label for="">Tên tài khoản</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtTenTaiKhoan" value="<?php echo $id ?>" disabled>
                        </div>
                        <br>

                        <label for="">Mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtMatKhau" value="<?php echo $matkhau ?>" required>
                        </div>
                        <br>

                        <label for="">Email</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtEmail" value="<?php echo $email ?>" required>
                        </div>
                        <br>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Loại tài khoản</label>
                                <select class="form-control" name="cboLoaiTaiKhoan">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="btnSua" class="btn btn-danger">Sửa</button>
                    <a href="taikhoan.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnSua'])) {
    $matkhau = $_POST['txtMatKhau'];
    $email = $_POST['txtEmail'];
    $loaitaikhoan = $_POST['cboLoaiTaiKhoan'];

    $query = "UPDATE tbl_taikhoan SET matkhau='" . $matkhau . "', email='" . $email . "', loaitaikhoan='" . $loaitaikhoan . "' WHERE tentaikhoan='" . $tentaikhoan . "'";
    $result = mysqli_query($con, $query);
    if ($result > 0) {
        echo '
            <script>
                alert("Cập nhật dữ liệu thành công");
                window.location.href = "taikhoan.php?tentaikhoan=' . $tentaikhoan . '";
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