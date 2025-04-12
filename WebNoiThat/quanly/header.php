<?php

$tentaikhoan = $_GET['tentaikhoan'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/quanly.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
  <title>Document</title>
</head>

<body>
  <header id="header">
    <div class="logo pull-left">Quản Lý</div>
    <div class="header-content">
      <div class="header-date pull-left">
        <strong><?php echo date("F j, Y"); ?></strong>
      </div>
      <div class="pull-right clearfix">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="thongtintaikhoan.php?tentaikhoan=<?php echo $tentaikhoan ?>" data-toggle="dropdown" class="toggle" aria-expanded="false">
              <span> <?php echo $tentaikhoan ?></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </header>
  <div class="sidebar">
    <?php include_once('menu.php'); ?>
  </div>

  <div class="page">
    <div class="container-fluid">