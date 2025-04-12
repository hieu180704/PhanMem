<?php include_once('header.php'); ?>

<?php
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm
$query = "SELECT * FROM tbl_nhacungcap"; //Lệnh Truy Vấn Sql
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

                <a href="nhacungcap.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Load bảng</a>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h1>Danh sách các nhà cung cấp</h1>
    </div>
    <div class="col-md-12" id="table_nhacungcap">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-right">
                    <a href="themnhacungcap.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn btn-primary">Thêm mới</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 30px;">STT</th>
                            <th class="text-center" style="width: 15%;"> Mã nhà cung cấp </th>
                            <th class="text-center" style="width: 15%;"> Tên nhà cung cấp </th>
                            <th class="text-center" style="width: 15%;"> Địa chỉ</th>
                            <th class="text-center" style="width: 20%;"> Email </th>
                            <th class="text-center" style="width: 15%;"> Số điện thoại </th>
                            <th class="text-center" style="width: 50px;"> Thao tác </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) { //Vòng lặp lấy dữ liệu từ sql cho vào table
                            echo '
                                    <tr>
                                        <td class="text-center" style="width: 30px;">' . sothutu_id() . '</td>
                                        <td class="text-center" style="width: 15%;">' . $row["manhacungcap"] . ' </td>
                                        <td class="text-center" style="width: 15%;">' . $row["tennhacungcap"] . ' </td>
                                        <td class="text-center" style="width: 15%;"> ' . $row["diachi"] . ' </td>
                                        <td class="text-center" style="width: 20%;"> ' . $row["email"] . ' </td>
                                        <td class="text-center" style="width: 15%;"> ' . $row["sodienthoai"] . ' </td>
                                       
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="suanhacungcap.php?tennhacungcap=' . $row["tennhacungcap"] . '&tentaikhoan=' . $tentaikhoan . '" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </a>
                                                <a onclick="return confirm(\'Bạn có muốn xoá không?\');" href="xoanhacungcap.php?tennhacungcap=' . $row["tennhacungcap"] . '&tentaikhoan=' . $tentaikhoan . '" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
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
    $query = "SELECT * FROM tbl_nhacungcap WHERE CONCAT(manhacungcap, tennhacungcap, diachi, email, sodienthoai) LIKE N'%" . $timkiem . "%'";
    // $query = "SELECT * FROM tbl_sanpham WHERE tensanpham LIKE N'%" . $timkiem . "%'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        echo '
            <script>
                var table = document.getElementById("table_nhacungcap");
                table.style.display = "none";
            </script>
        ';

        echo '
            <div class="col-md-12" id="table_nhacungcap">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="pull-right">
                            <a href="themnhacungcap.php?tentaikhoan=' . $tentaikhoan . '" class="btn btn-primary">Thêm mới</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 15%;"> Mã nhà cung cấp </th>
                                    <th class="text-center" style="width: 15%;"> Tên nhà cung cấp </th>
                                    <th class="text-center" style="width: 15%;"> Địa chỉ </th>
                                    <th class="text-center" style="width: 20%;"> Email</th>
                                    <th class="text-center" style="width: 15%;"> Số điện thoại</th>
                                    <th class="text-center" style="width: 50px;"> Thao Tác </th>
                                </tr>
                            </thead>
                            <tbody>                
        ';
        while ($row = mysqli_fetch_assoc($result)) { //Vòng lặp lấy dữ liệu từ sql cho vào table
            echo '
                    <tr>
                        <td class="text-center" style="width: 15%;">' . $row["manhacungcap"] . ' </td>
                        <td class="text-center" style="width: 15%;">' . $row["tennhacungcap"] . ' </td>
                        
                        <td class="text-center" style="width: 15%;"> ' . $row["diachi"] . ' </td>
                        <td class="text-center" style="width: 20%;"> ' . $row["email"] . ' </td>
                        <td class="text-center" style="width: 15%;"> ' . $row["sodienthoai"] . ' </td>
                        
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="suanhacungcap.php?tennhacungcap=' . $row["tennhacungcap"] . '&tentaikhoan=' . $tentaikhoan . '" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a onclick="return confirm(\'Bạn có muốn xoá không?\');" href="xoanhacungcap.php?tennhacungcap=' . $row["tennhacungcap"] . '&tentaikhoan=' . $tentaikhoan . '" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
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