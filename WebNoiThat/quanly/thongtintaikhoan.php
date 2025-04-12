<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm
?>

<?php include_once('header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo ""; ?>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <span class="glyphicon glyphicon-edit"></span>
                <span>Chỉnh sửa tài khoản</span>
            </div>
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label for="username" class="control-label">Email</label>
                        <input type="text" class="form-control" name="txtEmail" placeholder="Email">
                    </div>
                    <div class="form-group clearfix">
                        <a href="doimatkhau.php?tentaikhoan=<?php echo $tentaikhoan ?>" title="change password" class="btn btn-danger pull-right">Đổi mật khẩu</a>
                        <a href="../main/dangxuat.php" class="btn btn-primary">Đăng xuất</a>
                        <button type="submit" name="btnCapNhat" class="btn btn-info">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php include_once('footer.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnCapNhat'])) {
    $email = $_POST['txtEmail'];

    $query = "UPDATE tbl_taikhoan SET email='" . $email . "' WHERE tentaikhoan='" . $tentaikhoan . "'";
    $result = mysqli_query($con, $query);

    if ($result > 0) {
        echo '
            <script>
                alert("Cập nhật dữ liệu thành công");
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