<?php
include_once('header.php');
include_once('connect.php');
include_once('functions.php');
?>


<div class="row">
    <div class="col-md-6">
    </div>
</div>
<div class="row">
    <a href="taikhoan.php?tentaikhoan=<?php echo $tentaikhoan ?>" style="color:black;">
        <div class="col-md-3">
            <div class="panel panel-box clearfix">
                <div class="panel-icon pull-left bg-secondary1">
                    <i class="glyphicon glyphicon-user"></i>
                </div>
                <div class="panel-value pull-right">
                    <h2 class="margin-top"> <?php echo demSoLuong("tbl_taikhoan", $con); ?> </h2>
                    <p class="text-muted">Tài Khoản</p>
                </div>
            </div>
        </div>
    </a>

    <a href="danhmuc.php?tentaikhoan=<?php echo $tentaikhoan ?>" style="color:black;">
        <div class="col-md-3">
            <div class="panel panel-box clearfix">
                <div class="panel-icon pull-left bg-red">
                    <i class="glyphicon glyphicon-th-large"></i>
                </div>
                <div class="panel-value pull-right">
                    <h2 class="margin-top"> <?php echo demSoLuong("tbl_danhmuc", $con); ?> </h2>
                    <p class="text-muted">Danh Mục</p>
                </div>
            </div>
        </div>
    </a>

    <a href="sanpham.php?tentaikhoan=<?php echo $tentaikhoan ?>" style="color:black;">
        <div class="col-md-3">
            <div class="panel panel-box clearfix">
                <div class="panel-icon pull-left bg-blue2">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                </div>
                <div class="panel-value pull-right">
                    <h2 class="margin-top"> <?php echo demSoLuong("tbl_sanpham", $con); ?> </h2>
                    <p class="text-muted">Sản phẩm</p>
                </div>
            </div>
        </div>
    </a>

    <a href="sanpham.php?tentaikhoan=<?php echo $tentaikhoan ?>" style="color:black;">
        <div class="col-md-3">
            <div class="panel panel-box clearfix">
                <div class="panel-icon pull-left bg-green">
                    <i class="glyphicon glyphicon-usd"></i>
                </div>
                <div class="panel-value pull-right">
                    <h2 class="margin-top"> <?php echo (tinhTong("tbl_sanpham", $con, "soluong")); ?></h2>
                    <p class="text-muted">Tổng số lượng sản phẩm</p>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Các tài khoản user</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Tên tài khoản</th>
                            <th>Mật khẩu</th>
                            <th>Email</th>
                        <tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_taikhoan WHERE loaitaikhoan ='user'";
                        $result = mysqli_query($con, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                                <tr>
                                    <td>' . $row["tentaikhoan"] . '</td>
                                    <td>' . $row["matkhau"] . '</td>
                                    <td>' . $row["email"] . '</td>
                                </tr>
                            ';
                        }
                        ?>
                    <tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Các tài khoản ADMIN</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <!-- <th class="text-center" style="width: 50px;">#</th> -->
                            <th>Tên tài khoản</th>
                            <th>Mật khẩu</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_taikhoan WHERE loaitaikhoan ='admin'";
                        $result = mysqli_query($con, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                                <tr>
                                    <td>' . $row["tentaikhoan"] . '</td>
                                    <td>' . $row["matkhau"] . '</td>
                                    <td>' . $row["email"] . '</td>
                                </tr>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Sản phẩm đã hết hàng!</span>
                </strong>
            </div>
            <div class="panel-body">

                <div class="list-group">
                    <?php
                    $query = "SELECT * FROM tbl_sanpham WHERE soluong < 1";
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                            <a class="list-group-item clearfix" href="sanpham_search.php?tentaikhoan=' . $tentaikhoan . '&masanpham=' . $row["masanpham"] . '">
                                <h4 class="list-group-item-heading">
                                    <img class="img-avatar img-circle" src="' . $row["anh"] . '" alt="">    
                                    <span style="font-size: 10px"> ' . $row["tensanpham"] . ' </span>                                             
                                    <span class="label label-warning pull-right">Đơn giá: ' . formatCurrency($row["gia"]) . ' đ</span>
                                </h4>
                            </a>
                        ';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

</div>