<?php
include_once('header.php');
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$tendanhmuccon = $_GET['tendanhmuccon'];

if (kiemTraXoaKhoaNgoai("tbl_sanpham", "tendanhmuccon", $tendanhmuccon, $con, $tentaikhoan) === false) {
    return;
} else {
    $query = "DELETE FROM tbl_danhmuccon WHERE tendanhmuccon='" . $tendanhmuccon . "'"; //Lệnh Truy Vấn Sql
    $result = mysqli_query($con, $query); //Thực thi truy vấn

    if ($result > 0) {
        echo '
            <script>
                alert("Xoá dữ liệu thành công");
                window.location.href = "danhmuccon.php?tentaikhoan=' . $tentaikhoan . '";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Xoá dữ liệu thất bại");
            </script>
        ';
    }
}
