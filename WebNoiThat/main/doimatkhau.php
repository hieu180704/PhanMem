<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/category.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/slider.css">
    <script src="./assets/js/slider.js"></script>
    <link rel="stylesheet" href="../assets/css/homepage.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>

<body>
    <?php
    require_once '../layouts/header.php';
    ?>

    <div class="profile-container">
        <form class="profile-info-container" method="POST">
            <h2 class="profile-title">Thay Đổi mật khẩu</h2>
            <table class="profile-info">
                <tr>
                    <td class="profile-info-title">Mật Khẩu Cũ</td>
                    <td>
                        <input type="text" name="txtMatKhauCu" class="profile-info-input">
                    </td>
                </tr>
                <tr>
                    <td class="profile-info-title">Mật Khẩu Mới</td>
                    <td>
                        <input type="text" name="txtMatKhauMoi" class="profile-info-input">
                    </td>
                </tr>
                <tr>
                    <td class="profile-info-title">Xác Nhận Mật Khẩu </td>
                    <td>
                        <input type="text" name="txtXacNhanMatKhau" class="profile-info-input">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" name="btnLuu" class=" profile-info-save">Đổi mật khẩu</button>
                        <a href="profile.php?tentaikhoan=<?php echo $tentaikhoan ?>" class="btn">Quay Lại</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    require_once '../layouts/footer.php';
    ?>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnLuu'])) {
    $matkhaucu = $_POST["txtMatKhauCu"];
    $matkhaumoi = $_POST["txtMatKhauMoi"];
    $xacnhanmatkhau = $_POST["txtXacNhanMatKhau"];

    $query = "SELECT * FROM tbl_taikhoan WHERE tentaikhoan='$tentaikhoan'";
    $result = mysqli_query($con, $query);

    $errors = array();

    while ($row = mysqli_fetch_assoc($result)) {
        if ($matkhaucu !== $row["matkhau"]) {
            array_push($errors, "Sai mật khẩu");
        }
        if ($matkhaumoi !== $xacnhanmatkhau) {
            array_push($errors, "Mật khẩu không khớp");
        }
        if (strlen($matkhaumoi) < 6) {
            array_push($errors, "Mật khẩu ít nhất 6 kí tự");
        }
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo '
                    <script>
                        alert("' . "$error" . '");
                    </script>
                ';
                return;
            }
        } else {
            $query_update = "UPDATE tbl_taikhoan SET matkhau='" . $matkhaumoi . "' WHERE tentaikhoan='" . $tentaikhoan . "'";
            $result_update = mysqli_query($con, $query_update);

            if ($result_update > 0) {
                echo '
                    <script>
                        alert("Đổi mật khẩu thành công");
                    </script>
                ';
            } else {
                echo '
                    <script>
                        alert("Đổi mật khẩu thất bại");
                    </script>
                ';
            }
        }
    }
}

?>