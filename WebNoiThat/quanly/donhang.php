<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm
$query = "SELECT * FROM tbl_donhang"; //Lệnh Truy Vấn Sql
$result = mysqli_query($con, $query); //Thực thi truy vấn
?>
<div class="row">
    <div class="col-md-6">
        <form method="post" autocomplete="off" id="sug-form">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" name="btnTimKiem">Tìm</button>
                    </span>
                    <input type="text" id="sug_input" class="form-control" name="txtTimKiem" placeholder="Nhập thông tin cần tìm kiếm">
                </div>
                <div id="result" class="list-group"></div>

                <a href="donhang.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Load bảng</a>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h1>Quản lý đơn hàng</h1>
    </div>
    <div class="col-md-12" id="table_donhang">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-right">
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">Số thứ tự</th>
                            <th class="text-center" style="width: 10%;"> Mã đơn hàng </th>
                            <th class="text-center" style="width: 10%;"> Tên sản phẩm </th>
                            <th class="text-center" style="width: 10%;"> Ảnh </th>
                            <th class="text-center" style="width: 10%;"> Số lượng </th>
                            <th class="text-center" style="width: 10%;"> Đơn giá </th>
                            <th class="text-center" style="width: 10%;"> Tổng tiền </th>
                            <th class="text-center" style="width: 10%;"> Ngày mua </th>
                            <th class="text-center" style="width: 10%;"> Trạng thái </th>
                            <th class="text-center" style="width: 10%;"> Tên tài khoản </th>
                            <th class="text-center" style="width: 100px;"> Thao Tác </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) { //Vòng lặp lấy dữ liệu từ sql cho vào table
                            echo '
                                    <tr>
                                        <td class="text-center" style="width: 50px;">' . sothutu_id() . '</td>
                                        <td class="text-center" style="width: 10%;">DH' . $row["madonhang"] . ' </td>
                                        <td class="text-center" style="width: 10%;">' . $row["tensanpham"] . ' </td>
                                        <td class="text-center" style="width: 10%;">
                                            <img src="' . $row["anh"] . '" alt="" class="image_table">
                                        </td>
                                        <td class="text-center" style="width: 10%;"> ' . $row["soluong"] . ' </td>
                                        <td class="text-center" style="width: 10%;"> ' . $row["dongia"] . ' </td>
                                        <td class="text-center" style="width: 10%;"> ' . $row["dongia"] * $row["soluong"] . ' </td>
                                        <td class="text-center" style="width: 10%;"> ' . $row["ngaymua"] . ' </td>
                                        <td class="text-center" style="width: 10%;"> ' . $row["trangthai"] . ' </td>
                                        <td class="text-center" style="width: 10%;"> ' . $row["tentaikhoan"] . ' </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="suadonhang.php?madonhang=' . $row["madonhang"] . '&tentaikhoan=' . $tentaikhoan . '" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </a>
                                                <a onclick="return confirm(\'Bạn có muốn xoá không?\');" href="xoadonhang.php?madonhang=' . $row["madonhang"] . '&tentaikhoan=' . $tentaikhoan . '" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnTimKiem'])) {
    $timkiem = $_POST["txtTimKiem"];
    $query = "SELECT * FROM tbl_donhang
     WHERE CONCAT(madonhang, tensanpham, soluong, dongia, ngaymua, trangthai, tentaikhoan) LIKE N'%" . $timkiem . "%'";
    // $query = "SELECT * FROM tbl_sanpham WHERE tensanpham LIKE N'%" . $timkiem . "%'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        echo '
            <script>
                var table = document.getElementById("table_donhang");
                table.style.display = "none";
            </script>
        ';

        echo '
            <div class="col-md-12" id="table_sanpham">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="pull-right">
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">Số thứ tự</th>
                                    <th class="text-center" style="width: 10%;"> Mã đơn hàng </th>
                                    <th class="text-center" style="width: 10%;"> Tên sản phẩm </th>
                                    <th class="text-center" style="width: 10%;"> Ảnh </th>
                                    <th class="text-center" style="width: 10%;"> Số lượng </th>
                                    <th class="text-center" style="width: 10%;"> Đơn giá </th>
                                    <th class="text-center" style="width: 10%;"> Tổng tiền </th>
                                    <th class="text-center" style="width: 10%;"> Ngày mua </th>
                                    <th class="text-center" style="width: 10%;"> Trạng thái </th>
                                    <th class="text-center" style="width: 10%;"> Tên tài khoản </th>
                                    <th class="text-center" style="width: 100px;"> Thao Tác </th>
                                </tr>
                            </thead>
                            <tbody>                
        ';
        while ($row = mysqli_fetch_assoc($result)) { //Vòng lặp lấy dữ liệu từ sql cho vào table
            echo '
                <tr>
                    <td class="text-center" style="width: 50px;">' . sothutu_id() . '</td>
                    <td class="text-center" style="width: 10%;">DH' . $row["madonhang"] . ' </td>
                    <td class="text-center" style="width: 10%;">' . $row["tensanpham"] . ' </td>
                    <td class="text-center" style="width: 10%;">
                        <img src="' . $row["anh"] . '" alt="" class="image_table">
                    </td>
                    <td class="text-center" style="width: 10%;"> ' . $row["soluong"] . ' </td>
                    <td class="text-center" style="width: 10%;"> ' . $row["dongia"] . ' </td>
                    <td class="text-center" style="width: 10%;"> ' . $row["dongia"] * $row["soluong"] . ' </td>
                    <td class="text-center" style="width: 10%;"> ' . $row["ngaymua"] . ' </td>
                    <td class="text-center" style="width: 10%;"> ' . $row["trangthai"] . ' </td>
                    <td class="text-center" style="width: 10%;"> ' . $row["tentaikhoan"] . ' </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="suadonhang.php?madonhang=' . $row["madonhang"] . '&tentaikhoan=' . $tentaikhoan . '" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a onclick="return confirm(\'Bạn có muốn xoá không?\');" href="xoadonhang.php?madonhang=' . $row["madonhang"] . '&tentaikhoan=' . $tentaikhoan . '" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </div>
                    </td>
                </tr>
            ';
        }
        echo '
                </tbody>
            </table>        
        ';
    } else {
        echo '
            <script>
                alert("Không tìm thấy dữ liệu");
            </script>
        ';
    }
}

?>

<?php include_once('footer.php'); ?>