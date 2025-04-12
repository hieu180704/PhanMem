<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm
$query = "SELECT * FROM tbl_giamgia"; //Lệnh Truy Vấn Sql
$result = mysqli_query($con, $query); //Thực thi truy vấn

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
                    <span>Thêm danh mục</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" class="clearfix">
                        <div class="form-group">
                            <label>Mã giảm giá</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtMaGiamGia" placeholder="Mã giảm giá" required>
                            </div>
                            <br>

                            <label>Phần trăm</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtPhanTram" placeholder="%" required>
                            </div>
                            <br>
                        </div>

                        <button type="submit" name="btnThem" class="btn btn-danger">Thêm Mã giảm giá</button>
                        <a href="magiamgia.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnThem'])) {
    $magiamgia = $_POST['txtMaGiamGia'];
    $phantram = $_POST['txtPhanTram'];

    if (kiemTraTrungKhoa("tbl_giamgia", "magiamgia", $magiamgia, $con) === false) {
        return;
    } else {
        $query = "INSERT INTO tbl_giamgia VALUES ('" . $magiamgia . "', '" . $phantram . "');";
        $result = mysqli_query($con, $query);
        if ($result > 0) {
            echo '
            <script>
                alert("Thêm dữ liệu thành công");
                window.location.href = "magiamgia.php?tentaikhoan=' . $tentaikhoan . '";
            </script>
        ';
        } else {
            echo '
            <script>
                alert("Thêm liệu thất bại");
            </script>
        ';
        }
    }
}
?>
<?php include_once('footer.php'); ?>