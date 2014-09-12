<!-- BODY ================================================================== -->
<div class="container-fluid" id="main_content">

    <div class="row">
    <!-- SIDEBAR ================================================================ -->
    <div class="col-md-2 sidebar">

        <div class="row">
            <div class="col-md-12">
                <div class="img-circle" id="avatar">
                    <img alt="My Avatar" src="images/avatar.jpg" class="center-block img-circle img-responsive">
                </div>
                <p>
                <h1 class="text-center" style="color: #878787;"><?php echo $_COOKIE['username'] ?></h1>
                </p>
            </div><!-- End .col-md-12 .avatar -->
        </div>
        <ul id="menu1" class="nav nav-sidebar">
            <li>
                <a href="admin.php">Trang chủ</a>

            </li>
            <li>
                <a href="#">Quản lý <span class="glyphicon glyphicon-plus pull-right"></span></a>
                <ul class="list-unstyled nav collapse in nav-sidebar">
                    <li><a href="phong.php">Phòng</a></li>
                    <li class="active"><a href="#">Máy tính</a></li>
                    <li><a href="phanquyen.php">Phân quyền</a></li>
                </ul>
            </li>
            <li><a href="setting.html">Người dùng</a></li>
        </ul>
    </div><!-- End .col-md-2 .sidebar-->