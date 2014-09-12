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

?>

<?php include 'include/header.php'; ?>

<?php include 'include/sidebar.php'; ?>

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
            <div class="col-md-12" >
              <h2>Chọn phòng: </h2>
              <hr />
            </div>
        </div><!-- End .row -->

        <div class="row space">
          <div class="container-fluid">
          <?php
            if (isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
                $pid = $_GET['pid'];
            } else {
                $pid = NULL;
            }
            $q = "SELECT autonum, tenphong, somay FROM qlphong ORDER BY autonum";
            $r = mysql_query($q);
            while ($phong = mysql_fetch_assoc($r)) {
                echo "
                    <div class='col-md-2 space'>
                        <a href='may.php?pid=" . $phong['autonum'] . "' class='btn btn-primary size word_wrap'";
                if ($phong['autonum'] == $pid) {
                    echo " disabled";
                }
                echo ">" . $phong['tenphong'] . " [Số máy]: " . $phong['somay'] . "</a>
                    </div>
                ";
            }
          ?>
            <!-- <div class="col-md-2 space">
              <a href='' class="btn btn-primary size word_wrap" disabled>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</a>
            </div>

            <div class="col-md-2 space">
              <button type="submit" class="btn btn-primary size word_wrap">Lorem ipsum dolor sit amet.</button>
            </div>

            <div class="col-md-2 space">
              <button type="submit" class="btn btn-primary size word_wrap">Lorem ipsum dolor sit amet.</button>
            </div>

            <div class="col-md-2 space">
              <button type="submit" class="btn btn-primary size word_wrap">Lorem ipsum dolor sit amet.</button>
            </div>

            <div class="col-md-2 space">
              <button type="submit" class="btn btn-primary size word_wrap">Lorem ipsum dolor sit amet.</button>
            </div>

            <div class="col-md-2 space">
              <button type="submit" class="btn btn-primary size word_wrap">Lorem ipsum dolor sit amet.</button>
            </div>

            <div class="col-md-2 space">
              <button type="submit" class="btn btn-primary size word_wrap">Lorem ipsum dolor sit amet.</button>
            </div>

            <div class="col-md-2 space">
              <button type="submit" class="btn btn-primary size word_wrap">Lorem ipsum dolor sit amet.</button>
            </div>

            <div class="col-md-2 space">
              <button type="submit" class="btn btn-primary size word_wrap">Lorem ipsum dolor sit amet.</button>
            </div>

            <div class="col-md-2 space">
              <button type="submit" class="btn btn-primary size word_wrap">Lorem ipsum dolor sit amet.</button>
            </div> -->
          </div><!-- End container-fluid -->
        </div><!-- End .row -->

        <div class="row">
            <div class="col-md-12">
            <div class="container-fluid">
            <!--  -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Máy tính</a></li>
                <li><a href="#tab2" data-toggle="tab">Tình trạng</a></li>
                <li><a href="#tab3" data-toggle="tab">Phần mềm</a></li>
            </ul>
            <?php
            //Bắt đầu load dữ liệu theo từng phòng
                if (isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
                    //Nếu có $_GET['pid'] và đúng dữ liệu, lấy biến pid;
                    $pid = $_GET['pid'];
                } else {
                    //Nếu không, $messages
                    $messages = "
                    <div class='alert alert-warning' style='margin-top: 10px;'>
                        <h2 class='text-center'>Vui lòng chọn Phòng</h2>
                    </div>
                    ";
                }
            ?>

            <?php
                if (!empty($messages)) {
                    echo $messages;
                }
            ?>
            
            <div class="tab-content">
                <div id="tab1" class="tab-pane fade in active">
                  <h2 class="text-center">Chi tiết thông tin máy:</h2>
                  <div style="height: 600px; overflow: auto; margin-bottom: 10px;">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <td><b>STT</b></td>
                            <td><b>Tên máy</b></td>
                            <td><b>Chipset</b></td>
                            <td><b>Mainboard</b></td>
                            <td><b>HDD</b></td>
                            <td><b>RAM</b></td>
                            <td><b>Màn hình</b></td>
                            <td><b>Chỉnh sửa</b></td>
                            <td><b>Chọn</b></td>
                          </tr>
                        </thead>
                        <tbody><?php
                        if(isset($pid)==0){
                            $pid=0;
                        }
                        $res = sql_query("select * from maytinh where phong = ".$pid);
                        $i=1;
                        if(mysql_num_rows($res)>0){
                            while($arr = mysql_fetch_assoc($res)){
                                echo("<tr>
                            <td>".$i."</td>
                            <td>".$arr['tenmay']."</td>
                            <td>".$arr['chipset']."</td>
                            <td>".$arr['main']."</td>
                            <td>".$arr['hdd']."</td>
                            <td>".$arr['ram1']."<br>".$arr['ram2']."</td>
                            <td>".$arr['manhinh']."</td>
                            <td>
                                <button type='submit' class='btn btn-primary' data-toggle='modal' data-target='#editx".$arr['autonum']."'>Sửa</button>
                                <!-- Begin Edit modal -->
                                <div class='modal fade' id='editx".$arr['autonum']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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
                                                                <input type='text' class='form-control' value='".$i."' disabled>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for=''>Tên máy</label>
                                                                <input id='tenmay-".$arr['autonum']."' type='text' class='form-control' value='".$arr['tenmay']."'>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for=''>Chipset</label>
                                                                <input id='chip-".$arr['autonum']."' type='text' class='form-control' value='".$arr['chipset']."'>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for=''>Mainboard</label>
                                                                <input id='main-".$arr['autonum']."' type='text' class='form-control' value='".$arr['main']."'>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for=''>HDD</label>
                                                                <input id='hdd-".$arr['autonum']."' type='text' class='form-control' value='".$arr['hdd']."'>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for=''>RAM</label>
                                                                <input id='ram-".$arr['autonum']."' type='text' class='form-control' value='".$arr['ram1'].";".$arr['ram2']."'>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for=''>Màn hình</label>
                                                                <input id='manhinh-".$arr['autonum']."' type='text' class='form-control' value='".$arr['manhinh']."'>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- End row -->
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Hủy bỏ</button>
                                                    <button type='button' class='btn btn-primary' onclick='editmay(".$arr['autonum'].");'>Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit modal -->
                            </td>
                            <td><input id=\"m-".$arr['autonum']."\" type=\"checkbox\"></td>

                          </tr>

                          ");
                                $i++;
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                  </div>
                    <script>
                        var editmay = function(data){
                            $.ajax({
                                type: "POST",
                                url: "addmay.php",
                                data: {type:'editmay',data:data+"&"+$("#tenmay-"+data).val()+"&"+$("#chip-"+data).val()+"&"+$("#main-"+data).val()+"&"+$("#hdd-"+data).val()+"&"+$("#ram-"+data).val()+"&"+$("#manhinh-"+data).val()}
                            })
                                .done(function(msg){
                                    alert(msg);
                                    location.reload();
                                });

                        };
                    </script>
                  <button class="btn btn-primary" style="margin-bottom: 20px; margin-right: 20px" data-toggle="modal" data-target='#modalthemmay'>Thêm máy</button>
                  <?php
                  if($classuser==100){
                      echo('<button onclick="delmay()" class="btn btn-primary" style="margin-bottom: 20px;">Xóa máy</button>');
                  }
                  ?>
                    <script>
                        var delmay = function(){
                            $("input:checked").each(function($key,$element){
                                $.ajax({
                                    type:"POST",
                                    url:"delmay.php",
                                    data:{type:"delmay",data:$($element).attr("id")}
                                })
                                    .done(function(msg){
                                        if(msg!=""){
                                            alert(msg);
                                        }
                                    });
                            });
                            alert('Đã Xoá!!!');
                            location.reload();
                        };
                    </script>
                    <!-- Begin thêm máy modal -->
                    <div class='modal fade' id='modalthemmay' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <form action=''>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title' id='myModalLabel'>Thêm Máy</h4>
                                </div>
                                <div class='modal-body'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label for=''>Tên máy</label>
                                                <input id="themtenmay" type='text' class='form-control' placeholder="Nhập tên máy">
                                            </div>
                                            <div class='form-group'>
                                                <label for=''>Chipset</label>
                                                <input id="themchip" type='text' class='form-control' placeholder="Nhập ChipSet">
                                            </div>
                                            <div class='form-group'>
                                                <label for=''>Mainboard</label>
                                                <input id="themmain" type='text' class='form-control' placeholder="Nhập Mainboard">
                                            </div>
                                            <div class='form-group'>
                                                <label for=''>HDD</label>
                                                <input id="themhdd" type='text' class='form-control' placeholder="Nhập hdd">
                                            </div>
                                            <div class='form-group'>
                                                <label for=''>RAM</label>
                                                <input id="themram" type='text' class='form-control' placeholder="Nhập ram, nếu 2 thanh thì phân cách bằng dấu ;">
                                            </div>
                                            <div class='form-group'>
                                                <label for=''>Màn hình</label>
                                                <input id="themmanhinh" type='text' class='form-control' placeholder="Nhập tên màn hình">
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End row -->
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Hủy bỏ</button>
                                    <button id="themmaytinh" type='button' class='btn btn-primary' onclick="themmay(<?php echo($pid); ?>)">Thêm Máy</button>
                                </div>
                            </form>
                            <script>
                                var themmay = function(data){
                                    $.ajax({
                                        type: "POST",
                                        url: "addmay.php",
                                        data: {type:'themmay',data:data+"&"+$("#themtenmay").val()+"&"+$("#themchip").val()+"&"+$("#themmain").val()+"&"+$("#themhdd").val()+"&"+$("#themram").val()+"&"+$("#themmanhinh").val()}
                                    })
                                        .done(function(msg){
                                            alert(msg);
                                            location.reload();
                                        });

                                };
                            </script>
                        </div>
                    </div>
                </div>
                <!-- End Edit modal -->

                </div><!-- End #table1 -->
                          
                    <div id="tab2" class="tab-pane fade">
                      <h2 class="text-center">Chi tiết tình trạng máy:</h2>
                      <div style="height: 600px; overflow: auto; margin-bottom: 10px;">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <td><b>STT</b></td>
                              <td><b>Tên máy</b></td>
                              <td><b>Tình trạng hiện tại</b></td>
                              <td><b>Ngày hỏng</b></td>
                              <td><b>Ngày sửa xong</b></td>
                              <td><b>Số lần sửa</b></td>
                              <td><b>Báo hỏng</b></td>
<!--                              <td><b>Chỉnh sửa</b></td>-->
<!--                              <td><b>Chọn</b></td>-->
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $res = sql_query("select * from maytinh where phong = ".$pid);
                          $i=1;
                          if(mysql_num_rows($res)>0){
                              while($arr = mysql_fetch_assoc($res)){
                                   $res2 = sql_query("select * from maytinh_tinhtrang where idmay=".$arr['autonum']." ORDER by autonum DESC");
                                   $tinhtrang='Hoạt Động';
                                   $label = 'success';
                                  $ngayhong = 'N/A';
                                  $ngaysua = 'N/A';
                                  $solansua = mysql_num_rows($res2);
                                   if(mysql_num_rows($res2)>0){
                                       $arr2 = mysql_fetch_assoc($res2);

                                       $tinhtrang = $arr2['tinhtrang'];
                                       if($tinhtrang=='Hoạt Động'){
                                            $label = 'success';
                                       }else{
                                            $label = 'danger';
                                       }
                                       if($arr2['ngayhong']!=""){
                                           $ngayhong = $arr2['ngayhong'];
                                       }
                                       if($arr2['ngaysua']!=""){
                                           $ngaysua = $arr2['ngaysua'];
                                       }

                                    }
                                echo("                            <tr>
                              <td>$i</td>
                              <td>".$arr['tenmay']."</td>
                              <td> <span class=\"label label-$label\">$tinhtrang</span> </td>
                              <td>$ngayhong</td>
                              <td>$ngaysua</td>
                              <td>$solansua</td>
                              <td><button type='submit' class='btn btn-danger' data-toggle='modal' data-target='#mdReport".$arr['autonum']."'>Báo hỏng</button></td>

                              <!-- Begin Report modal -->
                                <div class='modal fade' id='mdReport".$arr['autonum']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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
                                                                <input type='text' class='form-control' value='$i' disabled>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for=''>Tên máy</label>
                                                                <input type='text' class='form-control' value='".$arr['tenmay']."' disabled>
                                                            </div>

                                                            <div class='form-group'>
                                                                <label for=''>Tình trạng hiện tại</label>
                                                                <select id=\"select-".$arr['autonum']."\" class=\"selectpicker\"><option>Đã Hỏng</option><option>Hoạt Động</option></select>
                                                            </div>

                                                            <div class='form-group'>
                                                                <label for=''>Ghi Chú</label>
                                                                <input id=\"ghichu-".$arr['autonum']."\" type='text' class='form-control' value='Máy hư'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End row -->
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Hủy bỏ</button>
                                                    <button onclick=\"report(".$arr['autonum'].")\" type='button' class='btn btn-primary'>Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End report modal -->
                            </tr>");$i++;
                              }
                          }
                          ?>
                          <script>
                              var report = function(data){
                                  $.ajax({
                                      type: "POST",
                                      url: "addmay.php",
                                      data: {type:'report',data:data+"&"+$("#select-"+data).val()+"&"+$("#ghichu-"+data).val()}
                                  })
                                      .done(function(msg){
                                          alert(msg);
                                          location.reload();
                                      });

                              };
                          </script>
                          </tbody>
                        </table>
                      </div>

<!--                      <button class="btn btn-primary" style="margin-bottom: 20px; margin-right: 20px">Thêm dòng</button>-->
<!--                      <button class="btn btn-primary" style="margin-bottom: 20px;">Xóa dòng</button>-->

                    </div><!-- End #tab2 -->
                          
                    <div id="tab3" class="tab-pane fade">
                      <h2 class="text-center">Chi tiết phần mềm của máy:</h2>
                      <div style="height: 600px; overflow: auto; margin-bottom: 10px;">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <td><b>STT</b></td>
                              <td><b>Tên máy</b></td>
                              <td><b>PM Văn phòng</b></td>
                              <td><b>PM lập trình</b></td>
                              <td><b>PM đồ họa</b></td>
                              <td><b>PM Antivirus</b></td>
<!--                              <td><b>Sửa</b></td>-->
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $res = sql_query("select * from maytinh_software,maytinh where maytinh.autonum = maytinh_software.idmay and phong=".$pid);
                          $i=1;
                          if(mysql_num_rows($res)){
                              while($arr = mysql_fetch_assoc($res)){
                                  $vanphong="";
                                  $laptrinh="";
                                  $dohoa="";
                                  $baomat="";
                                  $dssw = explode(";",$arr['software']);
                                  foreach($dssw as $val){
                                      $res2 = sql_query("select * from software where autonum=".$val." limit 1");
                                      $arr2 = mysql_fetch_assoc($res2);
                                      if($arr2['NHOM']=='Văn Phòng'){
                                          $vanphong .= $arr2['TENPM']." ".$arr2['VERSION'].",";
                                      }
                                      if($arr2['NHOM']=='Lập Trình'){
                                          $laptrinh .= $arr2['TENPM']." ".$arr2['VERSION'].",";
                                      }
                                      if($arr2['NHOM']=='Đồ Hoạ'){
                                          $dohoa .= $arr2['TENPM']." ".$arr2['VERSION'].",";
                                      }
                                      if($arr2['NHOM']=='Bảo Mật'){
                                          $baomat .= $arr2['TENPM']." ".$arr2['VERSION'].",";
                                      }
                                  }
                                  echo("<tr>
                              <td>$i</td>
                              <td>".$arr['tenmay']."</td>
                              <td>$vanphong</td>
                              <td>$laptrinh</td>
                              <td>$dohoa</td>
                              <td>$baomat</td>

                              <td>

                                <!--<button type=\"submit\" class=\"btn btn-primary\" data-toggle='modal' data-target='#editz".$arr['autonum']."'>Sửa</button>-->
                                <!-- Begin editz1 modal -->
                                <div class='modal fade' id='editz".$arr['autonum']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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
                                                                <input type='text' class='form-control' value='$i' disabled>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for=''>Tên máy</label>
                                                                <input type='text' class='form-control' value='".$arr['tenmay']."'>
                                                            </div>
                                                            ");
                                                              $res2 = sql_query("select * from software");
                                                              if(mysql_num_rows($res2)){
                                                                  while($arr2 = mysql_fetch_assoc($res2)){
                                                                      if(stripos($arr['software'],$arr2['AUTONUM'])=== false){
                                                                          echo("<div class=\"col-md-3\">
                                                                                <div class=\"checkbox\" ><label><input type=\"checkbox\" id=\"sw-".$arr['autonum']."-".$arr2['AUTONUM']."\" >".$arr2['TENPM']."</label></div>
                                                                            </div>");
                                                                      }else{
                                                                          echo("<div class=\"col-md-3\">
                                                                                <div class=\"checkbox\" ><label><input type=\"checkbox\" id=\"sw-".$arr['autonum']."-".$arr2['AUTONUM']."\" checked>".$arr2['TENPM']."</label></div>
                                                                            </div>");
                                                                      }

                                                                  }
                                                              }

                                                        echo("</div>
                                                    </div>
                                                    <!-- End row -->
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Hủy bỏ</button>
                                                    <button type='button' class='btn btn-primary' onclick='updatesoftware(".$arr['autonum'].")'>Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End editz1 modal -->
                              </td>
                            </tr>");$i++;
                              }
                          }
                          ?>
                          <script>
//                              var updatesoftware = function(data){
//                                  $.ajax({
//                                      type: "POST",
//                                      url: "addmay.php",
//                                      data: {type:'updatesoft',data:data+"&"+$("#select-"+data).val()+"&"+$("#ghichu-"+data).val()}
//                                  })
//                                      .done(function(msg){
//                                          alert(msg);
//                                          location.reload();
//                                      });
//
//                              }
                          </script>
                          </tbody>
                        </table>
                      </div>
<!--                      <button class="btn btn-primary" style="margin-bottom: 20px; margin-right: 20px">Thêm dòng</button>-->
<!--                      <button class="btn btn-primary" style="margin-bottom: 20px;">Xóa dòng</button>-->

                    </div><!-- End #tab3 -->

            </div><!-- End .tab-content -->

            </div>

            </div><!-- End col-md-11 -->
        </div><!-- End .row -->

    </div><!-- End .col-md-10 -->
<?php include 'include/footer.php'; ?>