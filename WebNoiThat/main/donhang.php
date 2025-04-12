<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/category.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/donhang.css">
</head>

<body>

    <?php require_once '../layouts/header.php';

    $query = "SELECT * FROM tbl_donhang WHERE tentaikhoan = '$tentaikhoan'";
    $result = mysqli_query($con, $query);


    ?>

    <div class="container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo '
                <h1>Danh sách đơn hàng đã mua</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Tổng tiền</th>
                            <th>Ngày mua</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>            
            ';
        } else {
            echo '
                <h1>Đơn hàng của bạn hiện đang trống</h1>
                <table class="table table-bordered">
                    <tbody>   
            ';
        }
        ?>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
                        <tr>
                            <td>DH' . $row["madonhang"] . '</td>
                            <td>' . $row["tensanpham"] . '</td>
                            <td>
                                <img class="image-order" src="' . $row["anh"] . '" alt="Ảnh mô tả">
                            </td>
                            <td>' . $row["soluong"] . '</td>
                            <td>' . formatCurrency($row["dongia"]) . ' đ</td>
                            <td>' . formatCurrency($row["dongia"] * $row["soluong"]) . ' đ</td>
                            <td>' . $row["ngaymua"] . '</td>
                            <td>' . $row["trangthai"] . '</td>
                        </tr>                    
                    ';
        }

        ?>
        </tbody>
        </table>
    </div>

    <?php require_once '../layouts/footer.php'; ?>
</body>

</html>