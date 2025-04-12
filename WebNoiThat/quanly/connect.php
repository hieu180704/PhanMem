<?php
//Khởi tạo các hằng số để kết nối database
define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'webnoithat');

$con = mysqli_connect(dbhost, dbuser, dbpass, dbname);
if (!$con) {
    echo "Kết nối không thành công " . mysqli_connect_error();
}
