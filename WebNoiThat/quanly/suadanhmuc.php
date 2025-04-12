<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$tendanhmuc = $_GET['tendanhmuc'];
$duongdan = "";

$query = "SELECT * FROM tbl_danhmuc WHERE tendanhmuc='$tendanhmuc'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $duongdan = $row["duongdan"];
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
                <span>Sửa danh mục</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <form method="post">
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtTenDanhMuc" value="<?php echo $tendanhmuc ?>" disabled>
                        </div>
                        <br>

                        <label for="">Đường Dẫn</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtDuongDan" value="<?php echo $duongdan ?>" required>
                        </div>
                        <br>
                    </div>
                    <button type="submit" name="btnSua" class="btn btn-danger">Sửa</button>
                    <a href="danhmuc.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnSua'])) {
    $duongdan = $_POST['txtDuongDan'];

    $query = "UPDATE tbl_danhmuc SET duongdan='" . $duongdan . "' WHERE tendanhmuc='" . $tendanhmuc . "'";
    $result = mysqli_query($con, $query);
    if ($result > 0) {
        echo '
            <script>
                alert("Cập nhật dữ liệu thành công");
                window.location.href = "danhmuc.php?tentaikhoan=' . $tentaikhoan . '";
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