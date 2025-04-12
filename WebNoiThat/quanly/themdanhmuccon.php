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
                    <span>Thêm danh mục con</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" class="clearfix">
                        <div class="form-group">
                            <label>Tên danh mục con</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtTenDanhMucCon" placeholder="Tên danh mục con" required>
                            </div>
                            <br>

                            <label>Đường dẫn</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtDuongDan" placeholder="Đường dẫn" required>
                            </div>
                            <br>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tên danh mục</label>
                                    <select class="form-control" name="cboDanhMuc">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '
                                                <option value="' . $row["tendanhmuc"] . '">' . $row["tendanhmuc"] . '</option>
                                            ';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btnThem" class="btn btn-danger">Thêm danh mục con</button>
                        <a href="danhmuccon.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnThem'])) {
    $tendanhmuccon = $_POST['txtTenDanhMucCon'];
    $duongdan = $_POST['txtDuongDan'];
    $tendanhmuc = $_POST['cboDanhMuc'];

    if (kiemTraTrungKhoa("tbl_danhmuccon", "tendanhmuccon", $tendanhmuccon, $con) === false) {
        return;
    } else {
        $them = "INSERT INTO tbl_danhmuccon VALUES ('" . $tendanhmuccon . "', '" . $tendanhmuc . "', '" . $duongdan . "');";
        $result = mysqli_query($con, $them);
        if ($result > 0) {
            echo '
                <script>
                    alert("Thêm dữ liệu thành công");
                    window.location.href = "danhmuccon.php?tentaikhoan=' . $tentaikhoan . '";
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