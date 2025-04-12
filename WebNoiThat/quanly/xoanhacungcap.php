<?php
include_once('header.php');
include 'connect.php';  //Thêm file connect
include 'functions.php'; //File Hàm

$tennhacungcap = $_GET['tennhacungcap'];

if (kiemTraXoaKhoaNgoai("tbl_sanpham", "tennhacungcap", $tennhacungcap, $con, $tentaikhoan)) {
    $query = "DELETE FROM tbl_nhacungcap WHERE tennhacungcap ='" . $tennhacungcap . "'"; //Lệnh Truy Vấn Sql
    $result = mysqli_query($con, $query); //Thực thi truy vấn

    if ($result > 0) {
        echo '
        <script>
            alert("Xoá dữ liệu thành công");
            window.location.href = "nhacungcap.php?tentaikhoan=' . $tentaikhoan . '";
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
