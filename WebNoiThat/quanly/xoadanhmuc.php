<?php
include_once('header.php');
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$tendanhmuc = $_GET['tendanhmuc'];


try {
    $query = "DELETE FROM tbl_danhmuc WHERE tendanhmuc='" . $tendanhmuc . "'"; //Lệnh Truy Vấn Sql
    $result = mysqli_query($con, $query); //Thực thi truy vấn
    if ($result > 0) {
        echo '
                <script>
                    alert("Xoá dữ liệu thành công");
                    window.location.href = "danhmuc.php?tentaikhoan=' . $tentaikhoan . '";
                </script>
            ';
    } else {
        echo '
                <script>
                    alert("Xoá dữ liệu thất bại");
                </script>
            ';
    }
} catch (Exception $e) {
    echo '
        <script>
            alert("Dữ liệu này đang là khoá ngoại của bảng khác nên không thể xoá");
            window.location.href = "danhmuc.php?tentaikhoan=' . $tentaikhoan . '";
        </script>
    ';
}
