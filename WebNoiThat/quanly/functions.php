<?php
function sothutu_id()
{
    static $count = 1;
    return $count++;
}

function kiemTraTenDangNhap($tendangnhap)
{
    // Kiểm tra độ dài: từ 6 đến 20 ký tự
    if (strlen($tendangnhap) < 6 || strlen($tendangnhap) > 20) {
        return false;
    }

    // Kiểm tra ký tự hợp lệ trong tên đăng nhập :Tên đăng nhập chỉ được chứa chữ cái, số và dấu gạch dưới.
    if (!preg_match('/^[a-zA-Z0-9]+$/', $tendangnhap)) {
        return false;
    }

    return true;
}

function kiemTraEmail($email)
{
    //Kiểm tra độ dài: email phải lớn hơn 1 kí tự
    if (strlen($email) < 1) {
        return false;
    }

    // Kiểm tra ký tự hợp lệ trong email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    return true;
}


function kiemTraMatKhau($matkhau)
{
    // Kiểm tra độ dài: từ 6 đến 20 ký tự
    if (strlen($matkhau) < 6 || strlen($matkhau) > 20) {
        return false;
    }

    // Kiểm tra ký tự hợp lệ trong tên đăng nhập :Tên đăng nhập chỉ được chứa chữ cái, số 
    if (!preg_match('/^[a-zA-Z0-9]+$/', $matkhau)) {
        return false;
    }

    return true;
}

function kiemTraCCCD($cccd)
{
    // Kiểm tra độ dài số căn cước công dân: Số căn cước công dân phải có 9 hoặc 12 ký tự.
    if (strlen($cccd) !== 9 && strlen($cccd) !== 12) {
        return false;
    }

    // Kiểm tra các ký tự trong số căn cước công dân: Số căn cước công dân chỉ được chứa các ký tự số.
    if (!preg_match('/^[0-9]+$/', $cccd)) {
        return false;
    }

    return true;
}

function kiemTraSoDienThoai($sodienthoai)
{
    // Kiểm tra độ dài sodienthoai: Số điện thoại phải có 10 ký tự
    if (strlen($sodienthoai) !== 10) {
        return false;
    }

    // Kiểm tra các ký tự trong số điện thoại: Số điện thoại chỉ được chứa các ký tự số.
    if (!preg_match('/^[0-9]+$/', $sodienthoai)) {
        return false;
    }

    return true;
}

function kiemTraHoVaTen($hovaten)
{
    // Loại bỏ các khoảng trắng đầu và cuối chuỗi
    $hovaten = trim($hovaten);

    // Kiểm tra độ dài họ và tên: Họ và tên không được để trống.
    if (strlen($hovaten) === 0) {
        return false;
    }

    // Kiểm tra họ và tên có chứa ký tự đặc biệt không phải chữ cái: Họ và tên chỉ được chứa các ký tự chữ cái và khoảng trắng.
    if (!preg_match('/^[a-zA-Z\s]+$/', $hovaten)) {
        return false;
    }
    return true;
}


function kiemTraTrungKhoa($tenbang, $tenkhoa, $txtsosanh, $connect)
{
    $query_kiemtra = "SELECT * FROM $tenbang WHERE $tenkhoa='$txtsosanh'";
    $result_kiemtra = mysqli_query($connect, $query_kiemtra);

    if (mysqli_num_rows($result_kiemtra) > 0) {
        echo '
            <script>
                alert("Lỗi: ' . $txtsosanh . ' đã tồn tại");
            </script>
        ';
        return false;
    } else {
        return true;
    }
}

function kiemTraXoaKhoaNgoai($bangchuakhoangoai, $khoangoai, $txtsosanh, $connect, $tentaikhoan)
{
    $query_kiemtra = "SELECT * FROM $bangchuakhoangoai WHERE $khoangoai = '$txtsosanh'";
    $result_kiemtra = mysqli_query($connect, $query_kiemtra);

    if (mysqli_num_rows($result_kiemtra) > 0) {
        echo '
            <script>
                alert("Lỗi: ' . $txtsosanh . ' là khoá ngoại và đang tồn tại ở bảng khác");
                window.location.href = "thongke.php?tentaikhoan=' . $tentaikhoan . '";
            </script>
        ';
        return false;
    } else {
        return true;
    }
}

function formatCurrency($number)
{
    return number_format($number, 0, '', '.');
}

function demSoLuong($tenbang, $connect)
{
    $query = "SELECT COUNT(*) AS total_rows FROM $tenbang;";
    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        return (int)$row["total_rows"];
    }
}

function tinhTong($tenbang, $connect, $tencot)
{
    $query = "SELECT SUM($tencot) AS total_quantity FROM $tenbang;";
    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        return (int)$row["total_quantity"];
    }
}
