<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$manhacungcap = "";
$tennhacungcap = $_GET['tennhacungcap'];
$diachi = "";
$email = "";
$sodienthoai = "";


//$querydanhmuc = "SELECT * FROM tbl_danhmuc";
//$querycungcap = "SELECT * FROM tbl_nhacungcap";
//$resulttdm = mysqli_query($con, $querydanhmuc);
//$resultncc = mysqli_query($con, $querycungcap);


$query = "SELECT * FROM tbl_nhacungcap WHERE tennhacungcap='$tennhacungcap'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $manhacungcap = $row["manhacungcap"];
        $diachi = $row["diachi"];
        $email = $row["email"];
        $sodienthoai = $row["sodienthoai"];
    }
}

?>

<div class="row">
    <div class="col-md-12">
    </div>
</div>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Sửa Nhà Cung Cấp</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <form method="post">
                    <div class="form-group">
                        <label for="">Mã nhà cung cấp</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtMaNhaCungCap" value="<?php echo $manhacungcap ?>" required>
                        </div>
                        <br>

                        <label for="">Tên nhà cung cấp</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtTenNhaCungCap" value="<?php echo $tennhacungcap ?>" disabled>
                        </div>
                        <br>
                        <label for="">Địa chỉ</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtDiaChi" value="<?php echo $diachi ?>" required>
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

                        <label for="">Số điện thoại</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="number" class="form-control" name="txtSoDienThoai" value="<?php echo $sodienthoai ?>">
                        </div>
                        <br>





                        <button type="submit" name="btnSua" class="btn btn-danger">Sửa</button>
                        <a href="nhacungcap.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnSua'])) {
    $manhacungcap = $_POST['txtMaNhaCungCap'];
    $diachi = $_POST['txtDiaChi'];
    $email = $_POST['txtEmail'];
    $sodienthoai = $_POST['txtSoDienThoai'];


    $query = "UPDATE tbl_nhacungcap SET manhacungcap='" . $manhacungcap . "', diachi='" . $diachi . "', email='" . $email . "', sodienthoai='" . $sodienthoai . "' WHERE tennhacungcap='" . $tennhacungcap . "'";
    $result = mysqli_query($con, $query);
    if ($result > 0) {
        echo '
            <script>
                alert("Cập nhật dữ liệu thành công");
                window.location.href = "nhacungcap.php?tentaikhoan=' . $tentaikhoan . '";
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