<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm
?>

<?php include_once('header.php'); ?>
<div class="login-page">
    <div class="text-center">
        <h3>Đổi mật khẩu</h3>
    </div>
    <form method="post">
        <div class="form-group">
            <label for="oldPassword" class="control-label">Mật khẩu cũ</label>
            <input type="password" class="form-control" name="txtMatKhauCu" placeholder="Mật khẩu cũ">
        </div>
        <div class="form-group">
            <label for="newPassword" class="control-label">Mật khẩu mới</label>
            <input type="password" class="form-control" name="txtMatKhauMoi" placeholder="Mật khẩu mới">
        </div>
        <div class="form-group clearfix">
            <input type="hidden" name="id">
            <button type="submit" name="btnUpdate" class="btn btn-info">Thay đổi</button>
            <a href="thongtintaikhoan.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
        </div>
    </form>
</div>
<?php include_once('footer.php'); ?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnUpdate'])) {
    $matkhaucu = $_POST["txtMatKhauCu"];
    $matkhaumoi = $_POST["txtMatKhauMoi"];
    $errors = array();

    $query = "SELECT * FROM tbl_taikhoan WHERE tentaikhoan='$tentaikhoan'";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($matkhaucu !== $row["matkhau"]) {
            array_push($errors, "Sai mật khẩu");
        }
        if (strlen($matkhaumoi) < 6) {
            array_push($errors, "Mật khẩu ít nhất 6 kí tự");
        }
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo '
                    <script>
                        alert("' . "$error" . '");
                    </script>
                ';
                return;
            }
        } else {
            $query_update = "UPDATE tbl_taikhoan SET matkhau='" . $matkhaumoi . "' WHERE tentaikhoan='" . $tentaikhoan . "'";
            $result_update = mysqli_query($con, $query_update);

            if ($result_update > 0) {
                echo '
                    <script>
                        alert("Đổi mật khẩu thành công");
                    </script>
                ';
            } else {
                echo '
                    <script>
                        alert("Đổi mật khẩu thất bại");
                    </script>
                ';
            }
        }
    }
}

?>