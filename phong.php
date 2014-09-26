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
                <li class="active"><a href="phong.php">Phòng</a></li>
                <li><a href="may.php">Máy tính</a></li>
                <li><a href="phanquyen.php">Phân quyền</a></li>
            </ul>
        </li>
        <li><a href="setting.html">Người dùng</a></li>
    </ul>
</div><!-- End .col-md-2 .sidebar-->

<!-- RIGHT MAIN ============================================================ -->

<div class="col-md-10 col-md-offset-2" id="main_primary">

<div class="row">

    <div class="col-md-12">

        <div class="row">
            <div class="col-md-4">

                <h1>Quản lý phòng
                    <small>Chi tiết về quản lý phòng</small>
                </h1>

            </div>

        </div>


        <div class="alert alert-info fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Chào mừng <?php echo $_COOKIE['username'] ?></strong> bạn đã đến với chức năng quản lý phòng.
        </div>

        <!-- Button trigger modal -->




    </div><!-- End .col-md-12 -->

</div><!-- End .row top-->

<div class="row">
<div class="col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">
    <span class="glyphicon glyphicon-info-sign"></span> Chi tiết phòng máy
</div>
<div class="panel-body" style="height: 600px; overflow: auto;">

    <table id="table1" class="table table-hover">
        <thead>
        <tr>
            <td>Số thứ tự</td>
            <td>Tên phòng</td>
            <td>Chú thích</td>
            <td>Số máy tính</td>
        </tr>
        </thead>
        <tbody>
        <?php
            $res = sql_query("select * from qlphong ORDER BY autonum");
            $i=1;
            if(mysql_num_rows($res)>0){
                while($arr = mysql_fetch_assoc($res)){
                    echo("
                        <tr>
                            <td id=\"$arr[autonum]\" name=\"$arr[autonum]\">".$i++."</td>
                            <td id=\"$arr[tenphong]\" name=\"$arr[tenphong]\">$arr[tenphong]</td>
                            <td id=\"$arr[tenphong]\" name=\"$arr[tenphong]\">$arr[chuthich]</td>
                            <td id=\"$arr[tenphong]\" name=\"$arr[tenphong]\">$arr[somay]</td>");
                    if($classuser==100){
                        echo("<td><button class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#edit".($i-1)."\">Sửa</button>");
                    }
                            echo("<div class=\"modal fade\" id=\"edit".($i-1)."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                              <div class=\"modal-dialog\">
                                <div class=\"modal-content\">
                                <form action=\"\">
                                  <div class=\"modal-header\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                                    <h4 class=\"modal-title\" id=\"myModalLabel\">Chỉnh sửa</h4>
                                  </div>
                                  <div class=\"modal-body\">
                                  <div class=\"row\">
                                    <div class=\"col-md-12\" id=\"e-$arr[autonum]\" name=\"e-$arr[autonum]\" >

                                      <div class=\"form-group\">
                                        <label for=\"\">Số thứ tự</label>
                                        <input type=\"text\" class=\"form-control\" value=\"".($i-1)."\" disabled>
                                      </div>
                                      <div class=\"form-group\">
                                        <label for=\"\">Tên phòng</label>
                                        <input id=\"e1-$arr[autonum]\" type=\"text\" class=\"form-control\" value=\"".$arr['tenphong']."\">
                                      </div>
                                      <div class=\"form-group\">
                                        <label for=\"\">Chú thích</label>
                                        <input id=\"e2-$arr[autonum]\" type=\"text\" class=\"form-control\" value=\"".$arr['chuthich']."\">
                                      </div>
                                      <div class=\"form-group\">
                                        <label for=\"\">Số máy tính</label>
                                        <input id=\"e3-$arr[autonum]\" type=\"text\" class=\"form-control\" value=\"".$arr['somay']."\">
                                      </div>

                                    </div>
                                  </div><!-- End row -->
                                  </div>
                                  <div class=\"modal-footer\">
                                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Hủy bỏ</button>
                                    <button id=\"b-$arr[autonum]\" onclick=\"updatephong((this).id)\" type=\"button\" class=\"btn btn-primary\" >Lưu thay đổi</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            </td>
                        </tr>");

                }
            }
        ?>
        </tbody>
    </table>

</div>
    <script>
        var updatephong = function(data){
            $idphong = data.substring(2,data.length);
            $tenphong = $("#e1-"+$idphong).val();
            $chuthich = $("#e2-"+$idphong).val();
            $somay = $("#e3-"+$idphong).val();
            $.ajax({
                type: "POST",
                url: "addphong.php",
                data:{type:'updatephong',data:$idphong+";"+$tenphong+";"+$chuthich+";"+$somay}
            }).done(function(msg){
                alert(msg);
                location.reload();
            })
        }
    </script>
<div class="panel-footer">
    <div class="row">
        <div class="col-md-12"><?php
            if($classuser==100){
                echo('            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal1">
                Thêm phòng
            </button>
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal2" style="margin-right: 10px;">
                Xóa phòng
            </button>');
            }
            ?>

        </div>

        <!-- Modal 1-->
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Thêm phòng</h4>
                    </div>
                    <form action="addphong.php" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                    <div class="form-group"><label for="">Tên phòng</label><input name="tenphong" type="text" class="form-control" placeholder="Nhập tên phòng"></div>
                                    <div class="form-group"><label for="">Chú thích</label><input name="chuthich" type="text" class="form-control" placeholder="Nhập chú thích"></div>
                                    <div class="form-group"><label for="">Số lượng máy</label><input name="somay" type="text" class="form-control" placeholder="Nhập số máy trong 1 phòng"></div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                        <button id = "luuthaydoi" type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal 2-->
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Xóa phòng</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo("<div class=\"row\">");
                        $res = sql_query("select * from qlphong");
                        $i=1;
                        if(mysql_num_rows($res)>0){
                            while($arr = mysql_fetch_assoc($res)){
                                echo("<div class=\"col-md-3\">
                                    <div class=\"checkbox\" ><label><input type=\"checkbox\" id=\"id-$arr[autonum]\">Phòng ".$i++." - $arr[tenphong]</label></div>
                                </div>
                                ");
                            }
                        }
                        echo("</div>"); ?>
                        <div class="row">
                            <div class="col-md-12" id="numchecked" style="color: red"><script>
                                    var countChecked = function() {
                                        var n = $( "input:checked" ).length;
                                        $( "#numchecked" ).text( n + " đã được chọn!!!" );
                                    };
                                    $( "input[type=checkbox]" ).on( "click", countChecked );
                                </script></div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                        <button id="xoaphong" name="xoaphong" type="button" class="btn btn-primary">Xóa phòng đã chọn</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    <script>
        var delphong = function(){
            $("input:checked").each(function($key,$element){
//                alert($($element).attr("id"));

                $.ajax({
                    type:"POST",
                    url:"delphong.php",
                    data:{type:"delphong",phongno:$($element).attr("id")}
                })
                    .done(function(msg){
                        //alert("Đã xoá phòng thứ "+$key+1+" được chọn!!!"+msg);
                    });
            });
            alert("Đã xoá!!");
            location.reload();
        };
        $("#xoaphong").click(delphong);
    </script>
</div>
</div>

<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-calendar"></span> Lịch làm việc - Tuần <?php
            echo str_replace("2014","",date("YW"));
            ?>
        </div>
        <div class="panel-body" style="height: 600px; overflow: auto;">

            <div class="panel-group" id="accordion">
                <?php
                    $day = date('w');
                    $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
                    $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
                    $res = sql_query("select * from lichlamviec, qlphong where time >= ".sqlesc($week_start)." and time <= ".sqlesc($week_end)." AND lichlamviec.PHONG = qlphong.autonum ORDER BY TIME ASC");
                    //echo("select * from lichlamviec where time >= ".sqlesc($week_start)." and time <= ".sqlesc($week_end)." ORDER BY TIME ASC");
                    if(mysql_num_rows($res)){
                        $tam = 0;
                        while($arr = mysql_fetch_assoc($res)){
                            $tam +=1;
                            if ($tam == 1) {
                                $view = "in";
                            } else {
                                $view = NULL;
                            }
                            if($arr['BUOI']=='Sáng'){
                                $laber = "success";
                            }else{
                                $laber = "warning";
                            }
                            echo("<div class=\"panel panel-primary\">
                                <div class=\"panel-heading\">
                                    <h4 class=\"panel-title\">
                                        <a data-toggle='collapse' data-parent='#accordion' href='#collapse" . $tam . "'>
                                            <span class=\"label label-".$laber."\">".$arr['BUOI']." - ".$arr['TIME']."</span> <b>".$arr['TIEUDE']." - ".$arr['tenphong']." ".$arr['somay']." Máy</b>
                                        </a>
                                        <span class=\"pull-right\"><input type=\"checkbox\" id=\"pl-".$arr['AUTONUMBER']."\"></span>
                                    </h4>
                                </div>
                                <div id='collapse" . $tam . "' class='panel-collapse collapse ". $view . "'>
                                    <div class=\"panel-body\">
                                        ".$arr['NOIDUNGTHONGBAO']."
                                    </div>
                                </div>
                            </div>");
                        }
                    }
                ?>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12"><?php
                    if($classuser==100){
                        echo('                    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal3">
                        Thêm lịch
                    </button>

                    <button id="xoalich" class="btn btn-primary pull-right" style="margin-right: 10px;">
                        Xóa lịch
                    </button>');
                    }
                    ?>


                    <script>
                        var dellich = function(){
                            $("input:checked").each(function($key,$element){
                                $.ajax({
                                    type:"POST",
                                    url:"delphong.php",
                                    data:{type:"dellich",lichno:$($element).attr("id")}
                                })
                                    .done(function(msg){
                                        alert("Đã xoá!!");
                                        location.reload();
                                    });
                            });
                        };
                        $("#xoalich").click(dellich);
                    </script>
                    <!-- Modal 1-->
                    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Thêm lịch</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group"><label for="">Giáo viên:</label><br><select id="tengiaovien" class="selectpicker">
                                                        <?php
                                                        $res = sql_query("select * from users");
                                                        if(mysql_num_rows($res)>0){
                                                            while($arr = mysql_fetch_assoc($res)){
                                                                echo("<option id=\"u-".$arr['IDNUM']."\">".$arr['USERNAME']."</option>");
                                                            }
                                                        }
                                                        ?></select></div>
                                                <div class="form-group"><label for="">Chọn Phòng: </label><br><select id="chonphong" class="selectpicker" data-live-search="true">
                                                <?php
                                                $res = sql_query("select * from qlphong");
                                                $i=1;
                                                if(mysql_num_rows($res)>0){
                                                    while($arr = mysql_fetch_assoc($res)){
                                                        echo("<option id=\"p-$arr[autonum]\">Phòng ".$i++." - $arr[tenphong]</option>");
                                                    }
                                                }
                                                 ?></select></div>
                                                <div class="form-group"><label for="">Ngày:</label><input id="ngaythanglich" type="text" class="form-control" placeholder="Nhập Ngày dạng yyyy-mm-dd"></div>
                                                <div class="form-group"><label for="">Buổi:</label><br><select id="buoi" class="selectpicker"><option>Sáng</option><option>Chiều</option></select></div>
                                                <div class="form-group"><label for="">Tiêu Đề: </label><input id="tieude" type="text" class="form-control" placeholder="Nhập tiêu đề cho nội dung"><select id="cat" class="selectpicker"><option>Dạy Học</option><option>Bảo Trì</option><option>Sự Cố</option><option>Khác</option></select></div>
                                                <div class="form-group"><label for="">Nội dung:</label><textarea id="noidung" cols="5" rows="5" class="form-control" placeholder="Nhập nội dung vào đây"></textarea></div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                                    <button id="luulich" type="button" class="btn btn-primary">Lưu thay đổi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $("#luulich").click(function(){
                            //alert($("#tengiaovien").val());
                            $.ajax({
                                type: "POST",
                                url: "addphong.php",
                                data: {type:'luulich',data:$("#tengiaovien").children(":selected").attr("id")+';'+$("#chonphong").children(":selected").attr("id")+';'+$("#ngaythanglich").val()+';'+$("#buoi").val()+';'+$("#tieude").val()+';'+$("#noidung").val()+';'+$("#cat").val()}
                            })
                                .done(function(msg){
                                    alert(msg);
                                    location.reload();
                                });

                        });
                    </script>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div> <!-- End .row tables -->

</div><!-- End .col-md-10 -->

<?php
    require_once("include/footer.php");
?>