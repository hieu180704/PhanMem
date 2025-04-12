<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <form action="">
            <h1>Quên mật khẩu</h1>
            <div class="inputbox">
                <input type="text" placeholder="Email" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="inputbox">
                <input type="text" placeholder="Mật Khẩu Mới" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="inputbox">
                <input type="text" placeholder="Xác Nhận Mật Khẩu" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="remember-forgot">
                <a href="dangnhap.php">Quay lại trang Đăng nhập</a>
            </div>

            <button type="submit" class="btn">Xác nhận</button>

            <div class="register">
                <p>Chưa có tài khoản? <a href="dangky.php">Đăng ký</a></p>
            </div>
        </form>
    </div>   
</body>
</html>