<?php
include '../quanly/connect.php';  //Thêm file connect
include '../quanly/functions.php'; //File Hàm

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Đăng Nhập</title>
</head>

<body>
    <div class="wrapper">
        <?php
        session_start();

        if (isset($_POST["btnDangNhap"])) {
            $tentaikhoan = $_POST["txtTenTaiKhoan"];
            $matkhau = $_POST["txtMatKhau"];
            $query = "SELECT * FROM tbl_taikhoan WHERE tentaikhoan = '$tentaikhoan' AND matkhau = '$matkhau'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $query = "SELECT * FROM tbl_taikhoan WHERE tentaikhoan = '$tentaikhoan' AND matkhau = '$matkhau' AND loaitaikhoan = 'user'";
                $check = mysqli_query($con, $query);
                if (mysqli_num_rows($check) > 0) {
                    $_SESSION["txtTenTaiKhoan"] = $tentaikhoan;
                    header("Location:index.php?tentaikhoan=$tentaikhoan");
                    die();
                } else {
                    $_SESSION["txtTenTaiKhoan"] = $tentaikhoan;
                    header("Location:../quanly/thongke.php?tentaikhoan=$tentaikhoan");
                    die();
                }
            } else {
                echo "<div class='alert alert-danger'>Sai tên tài khoản hoặc mật khẩu</div>";
            }
        }

        ?>
        <form method="POST">
            <h1>Quân</h1>
            <h1>Tiên</h1>
            <div class="inputbox">
                <input type="text" placeholder="Tài khoản" name="txtTenTaiKhoan">
                <i class='bx bxs-user'></i>
            </div>

            <div class="inputbox">
                <input type="password" placeholder="Mật khẩu" name="txtMatKhau">
                <i class='bx bxs-lock'></i>
            </div>

            <!-- <div class="remember-forgot">
                <label><input type="checkbox">remember me</label>
                <a href="forget.php">Quên mật khẩu</a>
            </div> -->

            <button type="submit" class="btn" name="btnDangNhap">Đăng nhập</button>

            <div class="register">
                <p>Chưa có tài khoản? <a href="dangky.php">Đăng ký</a></p>
            </div>
        </form>
    </div>
</body>

</html>