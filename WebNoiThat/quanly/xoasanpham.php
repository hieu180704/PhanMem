<?php
include_once('header.php');
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$masanpham = $_GET['masanpham'];

$query = "DELETE FROM tbl_sanpham WHERE masanpham='" . $masanpham . "'"; //Lệnh Truy Vấn Sql
$result = mysqli_query($con, $query); //Thực thi truy vấn

if ($result > 0) {
    echo '
        <script>
            alert("Xoá dữ liệu thành công");
            window.location.href = "sanpham.php?tentaikhoan=' . $tentaikhoan . '";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Xoá dữ liệu thất bại");
        </script>
    ';
}
