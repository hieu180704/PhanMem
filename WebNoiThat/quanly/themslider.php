<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm
$query = "SELECT * FROM tbl_slider"; //Lệnh Truy Vấn Sql
$result = mysqli_query($con, $query); //Thực thi truy vấn
?>

<div class="row">
    <div class="col-md-12">
        <!-- <?php echo ($msg); ?> -->
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Thêm Slider</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" class="clearfix">
                        <div class="form-group">
                            <label>Mã slider</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtMaSlider" placeholder="Mã Slider" required>
                            </div>
                            <br>

                            <label>Ảnh</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtAnh" placeholder="Đường dẫn ảnh" required>
                            </div>
                            <br>
                        </div>

                        <button type="submit" name="btnThem" class="btn btn-danger">Thêm Slide</button>
                        <a href="slider.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnThem'])) {
    $maslider = $_POST['txtMaSlider'];
    $anh = $_POST['txtAnh'];

    if (kiemTraTrungKhoa("tbl_slider", "maslider", $maslider, $con) === false) {
        return;
    } else {
        $query = "INSERT INTO tbl_slider VALUES ('" . $maslider . "', '" . $anh . "');";
        $result = mysqli_query($con, $query);
        if ($result > 0) {
            echo '
            <script>
                alert("Thêm dữ liệu thành công");
                window.location.href = "slider.php?tentaikhoan=' . $tentaikhoan . '";
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