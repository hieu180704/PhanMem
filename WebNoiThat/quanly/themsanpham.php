<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$nhacungcap = "SELECT * FROM tbl_nhacungcap";
$resultncc = mysqli_query($con, $nhacungcap);

$query_magiamgia = "SELECT * FROM tbl_giamgia";
$result_magiamgia = mysqli_query($con, $query_magiamgia);

$query = "SELECT * FROM tbl_danhmuc";
$result = mysqli_query($con, $query);

$danhmuc = [];
while ($row = mysqli_fetch_assoc($result)) {
    $danhmuc[] = $row;
}

// Truy vấn tên danh mục con
$query_con = "SELECT * FROM tbl_danhmuccon";
$result_con = mysqli_query($con, $query_con);
$danhmuccon = [];
while ($row_con = mysqli_fetch_assoc($result_con)) {
    $danhmuccon[] = $row_con;
}

// Xuất dữ liệu JSON cho JavaScript
echo "<script>
        var danhmuc = " . json_encode($danhmuc) . ";
        var danhmuccon = " . json_encode($danhmuccon) . ";
      </script>";

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
                    <span>Thêm sản phẩm</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" class="clearfix">
                        <div class="form-group">
                            <label>Mã sản phẩm</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtMaSanPham" placeholder="Mã sản phẩm">
                            </div>
                            <br>

                            <label>Tên Sản Phẩm</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-plus-sign"></i>
                                </span>
                                <input type="text" class="form-control" name="txtTenSanPham" placeholder="Tên sản phẩm">
                            </div>
                            <br>

                            <label>Ảnh</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtAnh" placeholder="Đường dẫn file ảnh">
                            </div>
                            <br>

                            <label>Số lượng</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="number" class="form-control" name="txtSoLuong" placeholder="Số lượng">
                            </div>
                            <br>

                            <label>Giá</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-euro"></i>
                                </span>
                                <input type="number" class="form-control" name="txtGia" placeholder="Giá">
                            </div>
                            <br>

                            <label>Màu sắc</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="txtMauSac" placeholder="Màu sắc">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tên danh mục</label>
                                    <select class="form-control" name="cboDanhMuc" id="tendanhmuc">
                                        <option value="">Chọn danh mục</option>
                                        <?php
                                        foreach ($danhmuc as $dm) {
                                            echo '<option value="' . ($dm['tendanhmuc']) . '">' . ($dm['tendanhmuc']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Tên danh mục con</label>
                                    <select class="form-control" name="cboDanhMucCon" id="tendanhmuccon">
                                        <option value="">Không danh mục con</option>
                                    </select>
                                </div>

                                <div class=" col-md-6">
                                    <label>Nhà cung cấp</label>
                                    <select class="form-control" name="cboNhaCungCap">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($resultncc)) {
                                            echo '
                                                <option value="' . $row["tennhacungcap"] . '">' . $row["tennhacungcap"] . '</option>
                                            ';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Mã giảm giá</label>
                                    <select class="form-control" name="cboMaGiamGia">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result_magiamgia)) {
                                            echo '
                                                <option value="' . $row["magiamgia"] . '">' . $row["magiamgia"] . ' (' . $row["phantram"] . '%)</option>
                                            ';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btnThem" class="btn btn-danger">Thêm sản phẩm</button>
                        <a href="sanpham.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Quay Lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnThem'])) {
    $masanpham = $_POST['txtMaSanPham'];
    $tensanpham = $_POST['txtTenSanPham'];
    $anh = $_POST['txtAnh'];
    $tendanhmuc = $_POST['cboDanhMuc'];
    $tendanhmuccon = $_POST['cboDanhMucCon'];
    $soluong = $_POST['txtSoLuong'];
    $gia = $_POST['txtGia'];
    $mausac = $_POST['txtMauSac'];
    $tennhacungcap = $_POST['cboNhaCungCap'];
    $magiamgia = $_POST['cboMaGiamGia'];

    if (kiemTraTrungKhoa("tbl_sanpham", "masanpham", $masanpham, $con) === false) {
        return;
    } else {
        $them = "INSERT INTO tbl_sanpham VALUES ('" . $masanpham . "', '" . $tensanpham . "', '" . $anh . "', '" . $tendanhmuc . "', '" . $tendanhmuccon . "' , '" . $soluong . "', '" . $gia . "', '" . $mausac . "', '" . $magiamgia . "', '" . $tennhacungcap . "');";
        $result = mysqli_query($con, $them);
        if ($result > 0) {
            echo '
                <script>
                    alert("Thêm dữ liệu thành công");
                    window.location.href = "sanpham.php?tentaikhoan=' . $tentaikhoan . '";
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