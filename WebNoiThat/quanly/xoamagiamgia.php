<?php
include_once('header.php');
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$magiamgia = $_GET['magiamgia'];

if (kiemTraXoaKhoaNgoai("tbl_sanpham", "magiamgia", $magiamgia, $con, $tentaikhoan) === false) {
    return;
} else {
    $query = "DELETE FROM tbl_giamgia WHERE magiamgia='" . $magiamgia . "'"; //Lệnh Truy Vấn Sql
    $result = mysqli_query($con, $query); //Thực thi truy vấn

    if ($result > 0) {
        echo '
            <script>
                alert("Xoá dữ liệu thành công");
                window.location.href = "magiamgia.php?tentaikhoan=' . $tentaikhoan . '";
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
