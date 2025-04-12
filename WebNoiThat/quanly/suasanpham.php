<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$masanpham = $_GET['masanpham'];
$tensanpham = "";
$anh = "";
$tendanhmuc = "";
$tendanhmuccon = "";
$soluong = "";
$gia = "";
$mausac = "";
$tennhacungcap = "";

$querydanhmuc = "SELECT * FROM tbl_danhmuc";
$querycungcap = "SELECT * FROM tbl_nhacungcap";
$querymagiamgia = "SELECT * FROM tbl_giamgia";
$query_danhmuccon = "SELECT * FROM tbl_danhmuccon";

$resulttdm = mysqli_query($con, $querydanhmuc);
$resultncc = mysqli_query($con, $querycungcap);
$result_magiamgia = mysqli_query($con, $querymagiamgia);
$result_danhmuccon = mysqli_query($con, $query_danhmuccon);

$cbodanhmuc = [];
while ($row = mysqli_fetch_assoc($resulttdm)) {
    $cbodanhmuc[] = $row;
}

$cbodanhmuccon = [];
while ($row = mysqli_fetch_assoc($result_danhmuccon)) {
    $cbodanhmuccon[] = $row;
}

echo "<script>
        var danhmuc = " . json_encode($cbodanhmuc) . ";
        var danhmuccon = " . json_encode($cbodanhmuccon) . ";
      </script>";


$query = "SELECT * FROM tbl_sanpham WHERE masanpham='$masanpham'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tensanpham = $row["tensanpham"];
        $anh = $row["anh"];
        $tendanhmuc = $row["tendanhmuc"];
        $tendanhmuccon = $row["tendanhmuccon"];
        $soluong = $row["soluong"];
        $gia = $row["gia"];
        $mausac = $row["mausac"];
        $tennhacungcap = $row["tennhacungcap"];
        $magiamgia = $row["magiamgia"];
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
                <span>Sửa sản phẩm</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <form method="post">
                    <div class="form-group">

                        <label for="">Mã sản phẩm</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtMaSanPham" value="<?php echo $masanpham ?>">
                        </div>
                        <br>

                        <label for="">Tên sản phẩm</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtTenSanPham" value="<?php echo $tensanpham ?>">
                        </div>
                        <br>

                        <label for="">Ảnh</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtAnh" value="<?php echo $anh ?>">
                        </div>
                        <br>

                        <label for="">Số lượng</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="number" class="form-control" name="txtSoLuong" value="<?php echo $soluong ?>">
                        </div>
                        <br>

                        <label for="">Giá</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="number" class="form-control" name="txtGia" value="<?php echo $gia ?>">
                        </div>
                        <br>

                        <label for="">Màu sắc</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="txtMauSac" value="<?php echo $mausac ?>">
                        </div>
                        <br>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Tên danh mục</label>
                                <select class="form-control" name="cboTenDanhMuc" id="tendanhmuc">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    foreach ($cbodanhmuc as $dm) {
                                        if ($dm['tendanhmuc'] === $tendanhmuc) {
                                            echo '<option value="' . ($dm['tendanhmuc']) . '" selected>' . ($dm['tendanhmuc']) . '</option>';
                                        } else {
                                            echo '<option value="' . ($dm['tendanhmuc']) . '">' . ($dm['tendanhmuc']) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Tên danh mục con</label>
                                <select class="form-control" name="cboTenDanhMucCon" id="tendanhmuccon">
                                    <option value="">Chọn danh mục con</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Nhà cung cấp</label>
                                <select class="form-control" name="cboNhaCungCap">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($resultncc)) {
                                        if ($row["tennhacungcap"] === $tenncc) {
                                            echo '
                                                <option value="' . $row["tennhacungcap"] . '" selected>' . $row["tennhacungcap"] . '</option>
                                            ';
                                        } else {
                                            echo '
                                                <option value="' . $row["tennhacungcap"] . '">' . $row["tennhacungcap"] . '</option>
                                            ';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="">Mã giảm giá</label>
                                <select class="form-control" name="cboMaGiamGia">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result_magiamgia)) {
                                        if ($row["magiamgia"] === $magiamgia) {
                                            echo '
                                                <option value="' . $row["magiamgia"] . '" selected>' . $row["magiamgia"] . ' (' . $row["phantram"] . '%)</option>
                                            ';
                                        } else {
                                            echo '
                                                <option value="' . $row["magiamgia"] . '">' . $row["magiamgia"] . ' (' . $row["phantram"] . '%)</option>
                                            ';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="btnSua" class="btn btn-danger">Sửa</button>
                    <a href="sanpham.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnSua'])) {
    $tensanpham = $_POST['txtTenSanPham'];
    $anh = $_POST['txtAnh'];
    $tendanhmuc = $_POST['cboTenDanhMuc'];
    $tendanhmuccon = $_POST['cboTenDanhMucCon'];
    $soluong = $_POST['txtSoLuong'];
    $gia = $_POST['txtGia'];
    $mausac = $_POST['txtMauSac'];
    $tennhacungcap = $_POST['cboNhaCungCap'];
    $magiamgia = $_POST['cboMaGiamGia'];

    $query = "UPDATE tbl_sanpham SET tensanpham='" . $tensanpham . "', anh='" . $anh . "', tendanhmuc='" . $tendanhmuc . "', tendanhmuccon='" . $tendanhmuccon . "', tensanpham='" . $tensanpham . "', soluong='" . $soluong . "', gia='" . $gia . "', mausac='" . $mausac . "', tennhacungcap='" . $tennhacungcap . "', magiamgia='" . $magiamgia . "' WHERE masanpham='" . $masanpham . "'";
    $result = mysqli_query($con, $query);
    if ($result > 0) {
        echo '
            <script>
                alert("Cập nhật dữ liệu thành công");
                window.location.href = "sanpham.php?tentaikhoan=' . $tentaikhoan . '";
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