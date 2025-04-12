<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$magiamgia = $_GET['magiamgia'];
$phantram = "";

$query = "SELECT * FROM tbl_giamgia WHERE magiamgia='$magiamgia'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $phantram = $row["phantram"];
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
                <span>Sửa mã giảm giá</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <form method="post">
                    <div class="form-group">
                        <label for="">Mã giảm giá</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtMaGiamGia" value="<?php echo $magiamgia ?>" disabled>
                        </div>
                        <br>

                        <label for="">Phần Trăm</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtPhanTram" value="<?php echo $phantram ?>" required>
                        </div>
                        <br>
                    </div>
                    <button type="submit" name="btnSua" class="btn btn-danger">Sửa</button>
                    <a href="magiamgia.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnSua'])) {
    $phantram = $_POST['txtPhanTram'];

    $query = "UPDATE tbl_giamgia SET phantram='" . $phantram . "' WHERE magiamgia='" . $magiamgia . "'";
    $result = mysqli_query($con, $query);
    if ($result > 0) {
        echo '
            <script>
                alert("Cập nhật dữ liệu thành công");
                window.location.href = "magiamgia.php?tentaikhoan=' . $tentaikhoan . '";
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