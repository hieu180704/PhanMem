<?php
include_once('header.php');
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$masanpham = $_GET["masanpham"];

$query = "SELECT * FROM tbl_sanpham WHERE masanpham='$masanpham'"; //Lệnh Truy Vấn Sql
$result = mysqli_query($con, $query); //Thực thi truy vấn
?>
<div class="row">
    <div class="col-md-6">
        <form method="post" autocomplete="off" id="sug-form">
            <div class="form-group">
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php echo "" ?>
    </div>
    <div class="col-md-12" id="table_sanpham">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;"> Mã sản phẩm </th>
                            <th class="text-center" style="width: 10%;"> Tên sản phẩm </th>
                            <th class="text-center" style="width: 10%;"> Ảnh </th>
                            <th class="text-center" style="width: 10%;"> Tên danh mục </th>
                            <th class="text-center" style="width: 10%;"> Tên danh mục con </th>
                            <th class="text-center" style="width: 10%;"> Số lượng </th>
                            <th class="text-center" style="width: 10%;"> Đơn Giá </th>
                            <th class="text-center" style="width: 10%;"> Màu sắc </th>
                            <th class="text-center" style="width: 10%;"> Tên Nhà Cung Cấp </th>
                            <th class="text-center" style="width: 100px;"> Thao Tác </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) { //Vòng lặp lấy dữ liệu từ sql cho vào table
                            echo '
                                <tr>
                                    <td class="text-center" style="width: 10%;">' . $row["masanpham"] . ' </td>
                                    <td class="text-center" style="width: 10%;">' . $row["tensanpham"] . ' </td>
                                    <td class="text-center" style="width: 10%;">
                                        <img src="' . $row["anh"] . '" alt="" class="image_table">
                                    </td>
                                    <td class="text-center" style="width: 10%;"> ' . $row["tendanhmuc"] . ' </td>
                                    <td class="text-center" style="width: 10%;"> ' . $row["tendanhmuccon"] . ' </td>
                                    <td class="text-center" style="width: 10%;"> ' . $row["soluong"] . ' </td>
                                    <td class="text-center" style="width: 10%;"> ' . $row["gia"] . ' </td>
                                    <td class="text-center" style="width: 10%;"> ' . $row["mausac"] . ' </td>
                                    <td class="text-center" style="width: 10%;"> ' . $row["tennhacungcap"] . ' </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="suasanpham.php?masanpham=' . $row["masanpham"] . '&tentaikhoan=' . $tentaikhoan . '" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            <a onclick="return confirm(\'Bạn có muốn xoá không?\');" href="xoasanpham.php?masanpham=' . $row["masanpham"] . '&tentaikhoan=' . $tentaikhoan . '" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
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
<?php include_once('footer.php'); ?>