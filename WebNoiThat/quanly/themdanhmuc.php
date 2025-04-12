<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm
$query = "SELECT * FROM tbl_danhmuc"; //Lệnh Truy Vấn Sql
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
                            <label>Tên Danh Mục</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtTenDanhMuc" placeholder="Tên danh mục" required>
                            </div>
                            <br>

                            <label>Đường Dẫn</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtDuongDan" placeholder="Đường Dẫn" required>
                            </div>
                            <br>
                        </div>

                        <button type="submit" name="btnThem" class="btn btn-danger">Thêm Danh Mục</button>
                        <a href="danhmuc.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnThem'])) {
    $tendanhmuc = $_POST['txtTenDanhMuc'];
    $duongdan = $_POST['txtDuongDan'];

    if (kiemTraTrungKhoa("tbl_danhmuc", "tendanhmuc", $tendanhmuc, $con) === false) {
        return;
    } else {
        $query = "INSERT INTO tbl_danhmuc VALUES ('" . $tendanhmuc . "', '" . $duongdan . "');";
        $result = mysqli_query($con, $query);
        if ($result > 0) {
            echo '
            <script>
                alert("Thêm dữ liệu thành công");
                window.location.href = "danhmuc.php?tentaikhoan=' . $tentaikhoan . '";
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