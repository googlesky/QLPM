<?php
include_once("include/function.php");
dbconnect();

if(isset($_COOKIE["username"])==0){
    header('Location: login.php');
}
$rescheck = sql_query("select * from users where USERNAME=".sqlesc($_COOKIE["username"])."");
//echo("select * from users where USERNAME=".sqlesc($_COOKIE["username"])."");
if(mysql_num_rows($rescheck)>0){
    while($arr = mysql_fetch_assoc($rescheck)){
        $classuser = $arr['CLASS'];
    }
}else{
    die('Phát hiện hack!!!');
}

if($classuser<90){
    header('Location: logout.php');
}
require_once("include/header.php");
require_once("include/sidebar.php");
?>

<!-- RIGHT MAIN ============================================================ -->

<div class="col-md-10 col-md-offset-2" id="main_primary">

<div class="row">

    <div class="col-md-12">

        <h1>Trang quản lý
            <small>Thống kê chi tiết</small>
        </h1>
        <div class="alert alert-info fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Chào mừng <?php echo $_COOKIE['username'] ?></strong> bạn đã đến với trang quản lý phòng máy. Dưới đây là thống kê tổng quan toàn bộ thông tin của phòng máy hiện tại.
        </div>

    </div><!-- End .col-md-12 -->

</div><!-- End .row top-->

<div class="row">

    <div class="col-md-3">
        <div class="panel panel-primary">

            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <span class="glyphicon glyphicon-record"></span>
                    </div>
                    <div class="col-md-6 text-right">
                        <h2><?php
                                $res = mysql_query("select * from maytinh");
                                echo(mysql_num_rows($res));
                            ?></h2>
                        <p>máy trên <strong><?php
                                $res = mysql_query("select * from qlphong");
                                echo(mysql_num_rows($res));
                                ?></strong> phòng</p>
                    </div>
                </div>
            </div><!-- End .panel-heading -->

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        Tổng số máy hiện tại
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="may.php">Xem chi tiết
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div><!-- End .panel-footer -->

        </div><!-- End .panel panel-primary -->
    </div><!-- End .col-md-3 -->

    <div class="col-md-3">
        <div class="panel panel-success">

            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <span class="glyphicon glyphicon-download-alt"></span>
                    </div>
                    <div class="col-md-6 text-right">
                        <h2><?php
                            $res = mysql_query("select * from software");
                            echo(mysql_num_rows($res));
                            ?></h2>
                        <p><strong>phần mềm</strong> đã cài</p>
                    </div>
                </div>
            </div><!-- End .panel-heading -->

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        Tổng số phần mềm
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="may.php">Xem chi tiết
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div><!-- End .panel-footer -->

        </div><!-- End .panel panel-success -->
    </div><!-- End .col-md-3 -->

    <div class="col-md-3">
        <div class="panel panel-danger">

            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <span class="glyphicon glyphicon-remove-sign"></span>
                    </div>
                    <div class="col-md-6 text-right">
                        <h2><?php
                            $res = mysql_query("select * from maytinh_tinhtrang where ngaysua IS NULL ");
                            echo(mysql_num_rows($res));
                            ?></h2>
                        <p>máy bị <strong>hỏng</strong></p>
                    </div>
                </div>
            </div><!-- End .panel-heading -->

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        Tổng số máy bị hỏng
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="may.php">Xem chi tiết
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div><!-- End .panel-footer -->

        </div><!-- End .panel panel-danger -->
    </div><!-- End .col-md-3 -->

    <div class="col-md-3">
        <div class="panel panel-warning">

            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <span class="glyphicon glyphicon-wrench"></span>
                    </div>
                    <div class="col-md-6 text-right">
                        <h2><?php
                            $res = mysql_query("select * from vatdung");
                            echo(mysql_num_rows($res));
                            ?></h2>
                        <p><strong>vật dụng</strong> có sẵn</p>
                    </div>
                </div>
            </div><!-- End .panel-heading -->

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        Tổng số vật dụng
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="#">Xem chi tiết
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div><!-- End .panel-footer -->

        </div><!-- End .panel panel-warning -->
    </div><!-- End .col-md-3 -->

</div><!-- End .row panel-->

<div class="row">

    <div class="col-md-8">

        <div class="panel panel-primary" id="lichlamviec">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-calendar"></span> Lịch làm việc
            </div>
            <div class="panel-body">
                <ul class="timeline">
                    <?php
                    //Bắt đầu tìm ký tự trong tiêu đề và nội dung để xác định cat
                    $date_start = date("Y-m-d",mktime(0, 0, 0, date("m")  , 1, date("Y")));
                    $date_end = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("t"), date("Y")));
                    $res = sql_query("select * from lichlamviec,qlphong where TIME >= ".sqlesc($date_start)." and TIME <= ".sqlesc($date_end)." and lichlamviec.phong = qlphong.autonum ORDER BY TIME ASC ");

                    if(mysql_num_rows($res)>0){
                        while($arr = mysql_fetch_assoc($res)){
                            if($arr['CAT']=='Dạy Học'){
                                $cat = 1;
                            }
                            if($arr['CAT']=='Bảo Trì'){
                                $cat = 2;
                            }
                            if($arr['CAT']=='Sự Cố'){
                                $cat = 3;
                            }
                            if($arr['CAT']=='Khác'){
                                $cat = 4;
                            }
                            switch($cat){
                                case 1:
                                    $corlor = "info";
                                    break;
                                case 2:
                                    $corlor = "warning";
                                    break;
                                case 3:
                                    $corlor = "danger";
                                    break;
                                case 4:
                                    $corlor = "success";
                                    break;
                            }
                            switch($cat){
                                case 1:
                                    $icon = "glyphicon glyphicon-bell";
                                    break;
                                case 2:
                                    $icon = "glyphicon glyphicon-wrench";
                                    break;
                                case 3:
                                    $icon = "glyphicon glyphicon-remove-sign";
                                    break;
                                case 4:
                                    $icon = "glyphicon glyphicon-pushpin";
                                    break;
                            }

                            if($arr['BUOI']=='Chiều'){
                                $left = 'class="timeline-inverted"';
                                $pgio = '13:00';
                            }else{
                                $left = '';
                                $pgio = '7:00';
                            }
                            echo('<li '.$left.'>
                                    <div class="timeline-badge '.$corlor.'"><span class="'.$icon.'"></span></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h3 class="timeline-title">'.$arr['TIEUDE'].' - '.$arr['tenphong'].'</h3>
                                            <p>
                                                <small class="text-muted"><i class="fa fa-time"></i> '.$pgio.' '.$arr['TIME'].'</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>
                                                '.$arr['NOIDUNGTHONGBAO'].'
                                            </p>
                                        </div>
                                    </div>
                                </li>');
                        }
                    }

                    ?>
                    <li></li>
                </ul>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <?php

        ?>
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-time"></span> Đăng nhập gần đây
                </div>
                <div class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ul class="list-group table-hover">
                            <?php
                                $res = mysql_query("SELECT * FROM `log_ip` WHERE `IDNUM` =".curuser()." limit 13");
                                if(mysql_num_rows($res)>0){
                                    while($arr = mysql_fetch_assoc($res)){
                                        //print_r($arr);
                                        echo("<li class=\"list-group-item\">$arr[IP] <span class=\"pull-right\">$arr[ngay]</span></li>");
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- End .col-md-4 Right recently IP -->

</div><!-- End .row center chart -->

</div><!-- End .col-md-10 -->

<?
    require_once("include/footer.php");
?>