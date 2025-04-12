<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$tendanhmuccon = $_GET['tendanhmuccon'];
$tendanhmuc = "";
$duongdan = "";

$querydanhmuc = "SELECT * FROM tbl_danhmuc";
$resulttdm = mysqli_query($con, $querydanhmuc);


$query = "SELECT * FROM tbl_danhmuccon WHERE tendanhmuccon='$tendanhmuccon'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tendanhmuc = $row["tendanhmuc"];
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
                <span>Sửa danh mục con</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <form method="post">
                    <div class="form-group">
                        <label for="">Tên Danh Mục Con</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtTenDanhMucCon" value="<?php echo $tendanhmuccon ?>" disabled>
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
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Tên danh mục</label>
                                <select class="form-control" name="cboTenDanhMuc">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($resulttdm)) {
                                        if ($row["tendanhmuc"] === $tendanhmuc) {
                                            echo '
                                                <option value="' . $row["tendanhmuc"] . '" selected>' . $row["tendanhmuc"] . '</option>
                                            ';
                                        } else {
                                            echo '
                                                <option value="' . $row["tendanhmuc"] . '" >' . $row["tendanhmuc"] . '</option>
                                            ';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="btnSua" class="btn btn-danger">Sửa</button>
                    <a href="danhmuccon.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnSua'])) {
    $tendanhmuc = $_POST['cboTenDanhMuc'];
    $duongdan = $_POST['txtDuongDan'];

    $query = "UPDATE tbl_danhmuccon SET tendanhmuc='" . $tendanhmuc . "', duongdan='" . $duongdan . "' WHERE tendanhmuccon='" . $tendanhmuccon . "'";
    $result = mysqli_query($con, $query);
    if ($result > 0) {
        echo '
            <script>
                alert("Cập nhật dữ liệu thành công");
                window.location.href = "danhmuccon.php?tentaikhoan=' . $tentaikhoan . '";
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