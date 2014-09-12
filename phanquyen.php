<?php
include_once("include/function.php");
dbconnect();

if(isset($_COOKIE["username"])==0){
    header('Location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Administrator</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" href="css/morris-0.4.3.min.css">
    <link rel="stylesheet" href="css/timeline/timeline.css">
    <!-- Custom styles for this template -->
    <!-- <link href="style.css" rel="stylesheet"> -->

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- [if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]
  </head> -->

<body>

<!-- MENU HEADER ================================================================== -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="admin.php">CTEC SYSTEM</a>
    </div>

    <!-- Navigation top static -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">

        <ul class="nav navbar-nav">
            <li class="active"><a href="#">LINK</a>
            </li>
            <li><a href="#">LINK</a>
            </li>
            <li><a href="#">LINK</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right container-fluid">
            <li>
                <form class="navbar-form" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm..." style="border-radius: 30px;">
                    </div>
                </form>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-bell"></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="setting-mess.html">Zack Le&nbsp;&nbsp;&nbsp;<span class="badge pull-right">3</span></a>
                    </li>
                    <li><a href="setting-mess.html">ZuVN&nbsp;&nbsp;&nbsp;<span class="badge pull-right">1</span></a>
                    </li>
                    <li><a href="setting-mess.html">Nhanh&nbsp;&nbsp;&nbsp;<span class="badge pull-right">5</span></a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="setting.html">
                            <span class="glyphicon glyphicon-info-sign"></span>&nbsp;Thông tin cá nhân</a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-cog"></span>&nbsp;Tùy chọn</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="logout.php">
                            <span class="glyphicon glyphicon-off"></span>&nbsp;Đăng xuất</a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
    <!-- /.navbar-collapse -->
</div>
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
            <h1 class="text-center" style="color: #878787;"><?php echo $_COOKIE['username']; ?></h1>
            </p>
        </div>
        <!-- End .col-md-12 .avatar -->
    </div>
    <ul id="menu1" class="nav nav-sidebar">
        <li>
            <a href="admin.php">Trang chủ</a>

        </li>
        <li>
            <a href="#">Quản lý <span class="glyphicon glyphicon-plus pull-right"></span></a>
            <ul class="list-unstyled nav collapse in nav-sidebar">
                <li><a href="phong.php">Phòng</a>
                </li>
                <li><a href="may.php">Máy tính</a>
                </li>
                <li class="active"><a href="phanquyen.php">Phân quyền</a></li>
            </ul>
        </li>
        <li><a href="setting.html">Người dùng</a>
        </li>
    </ul>
</div>
<!-- End .col-md-2 .sidebar-->

<!-- RIGHT MAIN ============================================================ -->

<div class="col-md-10 col-md-offset-2" id="main_primary">

    <div class="row">

        <div class="col-md-12">

            <div class="row">
                <div class="col-md-4">

                    <h1>Quản lý phòng
                        <small>Chi tiết về quản lý người dùng</small>
                    </h1>

                </div>

            </div>


            <div class="alert alert-info fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Chào mừng <?php echo $_COOKIE['username']; ?></strong> đã đến với chức năng quản lý người dùng.
            </div>


            <!-- Button trigger modal -->




        </div>
        <!-- End .col-md-12 -->

    </div>
    <!-- End .row top-->

    <div class="row">
        <div class="col-md-12">
            <h2>Phân quyền người dùng</h2>
            <hr />
            <table class="table table-hover">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Họ Tên</td>
                    <td>Tên đăng nhập</td>
                    <td>Quyền quản lý</td>
                    <td>Chức vụ</td>
                    <td>Sửa</td>
                </tr>
                </thead>

                <tbody  style='height: 600px; overflow: auto;'>
                <?php
                $res = sql_query("select * from users");
                if(mysql_num_rows($res)>0){
                    while($arr = mysql_fetch_assoc($res)){
                        echo("                <tr>
                    <td>".$arr['IDNUM']."</td>
                    <td>".$arr['HOTEN']."</td>
                    <td>".$arr['USERNAME']."</td>
                    <td>".$arr['CLASS']."</td>
                    <td>".$arr['CHUCVU']."</td>
                    <td>
                        <button class=\"btn btn-primary\" data-toggle='modal' data-target='#editx".$arr['IDNUM']."'>Sửa</button>
                        <!-- Begin Edit modal -->
                        <div class='modal fade' id='editx".$arr['IDNUM']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <form action=''>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                            <h4 class='modal-title' id='myModalLabel'>Chỉnh sửa</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <div class='row'>
                                                <div class='col-md-12'>

                                                    <div class='form-group'>
                                                        <label for=''>Số thứ tự</label>
                                                        <input type='text' class='form-control' value='".$arr['IDNUM']."' disabled>
                                                    </div>
                                                    <div class='form-group'>
                                                        <label for=''>Họ tên</label>
                                                        <input id='hoten-".$arr['IDNUM']."' type='text' class='form-control' value='".$arr['HOTEN']."'>
                                                    </div>
                                                    <div class='form-group'>
                                                        <label for=''>Tên đăng nhập:</label>
                                                        <input id='username-".$arr['IDNUM']."' type='text' class='form-control' value='".$arr['USERNAME']."'>
                                                    </div>
                                                    <div class='form-group'>
                                                        <label for=''>Password:</label>
                                                        <input id='password-".$arr['IDNUM']."' type='password' class='form-control' value=''>
                                                    </div>
                                                    <div class='form-group'>
                                                        <label for=''>Quyền quản lý: </label>
                                                        <select name='' id='quyen-".$arr['IDNUM']."' class='selectpicker'>
                                                            <option>Administrator</option>
                                                            <option>Moderator</option>
                                                            <option>Guest</option>
                                                        </select>
                                                    </div>
                                                    <div class='form-group'>
                                                        <label for=''>Chức vụ: </label>
                                                        <select name='' id='chucvu-".$arr['IDNUM']."' class='selectpicker'>
                                                            <option>Trưởng khoa</option>
                                                            <option>Giáo viên</option>
                                                            <option>Sinh viên</option>
                                                        </select>
                                                    </div>


                                                </div>
                                            </div>
                                            <!-- End row -->
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Hủy bỏ</button>
                                            <button type='button' class='btn btn-primary' onclick='updatequyen(".$arr['IDNUM'].")'>Lưu thay đổi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit modal -->
                    </td>
                </tr>");
                    }
                }
                ?>
                </tbody>
            </table>
            <script>
                var updatequyen = function(data){
                    $.ajax({
                        type: "POST",
                        url: "takequyen.php",
                        data: {type:'resetquyen',pass:$("#password-"+data).val(),data:data+"&"+$("#hoten-"+data).val()+"&"+$("#username-"+data).val()+"&"+$("#quyen-"+data).val()+"&"+$("#chucvu-"+data).val()}
                    })
                        .done(function(msg){
                            alert(msg);
                            location.reload();
                        });
                }
            </script>
            <button class="btn btn-primary" data-toggle='modal' data-target='#adduser1'>Thêm người dùng</button>
<!--            <button class="btn btn-danger" data-toggle='modal' data-target='#choose1' style='margin-top: 10px;'>Xóa</button>-->

            <!-- Begin Adduser modal -->
            <div class='modal fade' id='adduser1' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <form action=''>
                            <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                <h4 class='modal-title' id='myModalLabel'>Thêm người dùng</h4>
                            </div>
                            <div class='modal-body'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class='form-group'>
                                            <label for=''>Họ tên</label>
                                            <input id='fhoten' type='text' class='form-control' value=''>
                                        </div>
                                        <div class='form-group'>
                                            <label for=''>Tên đăng nhập:</label>
                                            <input id='fusername' type='text' class='form-control' value=''>
                                        </div>
                                        <div class='form-group'>
                                            <label for=''>Mật khẩu:</label>
                                            <input id='fpassword' type='password' class='form-control' value=''>
                                        </div>
                                        <div class='form-group'>
                                            <label for=''>Quyền quản lý: </label>
                                            <select id='fquyen' class='selectpicker'>
                                                <option>Administrator</option>
                                                <option>Moderator</option>
                                                <option>Guest</option>
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label for=''>Chức vụ: </label>
                                            <select name='' id='fchucvu' class='selectpicker'>
                                                <option>Trưởng khoa</option>
                                                <option>Giáo viên</option>
                                                <option>Sinh viên</option>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                                <!-- End row -->
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-default' data-dismiss='modal'>Hủy bỏ</button>
                                <button type='button' class='btn btn-primary' onclick='adduser()'>Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                var adduser = function(){
                    $.ajax({
                        type: "POST",
                        url: "takequyen.php",
                        data: {type:'adduser',pass:$("#fpassword").val(),data:$("#fhoten").val()+"&"+$("#fusername").val()+"&"+$("#fquyen").val()+"&"+$("#fchucvu").val()}
                    })
                        .done(function(msg){
                            alert(msg);
                            location.reload();
                        });
                }
            </script>
            <!-- End Adduser modal -->
        </div> <!-- End .col-md-12 -->
    </div>
</div>
<!-- End .row tables -->

</div>
<!-- End .col-md-10 -->

</div>

</div>
<!-- End .container-fluid -->
<!-- Bootstrap core JavaScript ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/jquery.metisMenu.js"></script>
<!-- <script src="js/holder.js"></script> -->
<script type="text/javascript">
    $('#menu1').metisMenu();
    $(".alert").alert();
</script>
<script>
    $('.selectpicker').selectpicker({
        style: 'btn-info',
        size: 4
    });

</script>
</body>

</html>
