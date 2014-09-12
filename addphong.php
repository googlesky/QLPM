<?php
include_once("include/function.php");
dbconnect();

if(isset($_COOKIE["username"])==0){
    header('Location: login.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['type'])==0){
        $tenphong = $_POST[tenphong];
        $chuthich = $_POST[chuthich];

        $somay = $_POST[somay];
        $res = sql_query("INSERT INTO `qlphong` (`autonum`, `tenphong`, `chuthich`, `somay`) VALUES (NULL, '$tenphong', '$chuthich', $somay);");

        if(mysql_num_rows($res)>0){
            ?>
            <script>
                alert("Thành Công!!!");
            </script>
        <?php
        }else{
            ?>
            <script>
                alert("0 Thành Công!!!");
            </script>
        <?php
        }

        header('Location: phong.php');
    }else{
        if($_POST['type']=='luulich'){
            $arr = explode(";",$_POST['data']);
            $giaovien = explode("-",$arr[0])[1];
            $phong = explode("-",$arr[1])[1];
            $ngaythanglich = date_create($arr[2]);
            $buoi = $arr[3];
            $tieude = $arr[4];
            $noidung = $arr[5];
            sql_query("INSERT INTO `lichlamviec` (`SENDER`, `TIEUDE`, `NOIDUNGTHONGBAO`, `TIME`, `BUOI`, `PHONG`,`CAT`) VALUES (".sqlesc($giaovien).", ".sqlesc($tieude).", ".sqlesc($noidung).", ".sqlesc(date_format($ngaythanglich, 'Y-m-d')).", ".sqlesc($buoi).", ".sqlesc($phong).", ".sqlesc($arr[6]).")");
            //echo $_POST['data'];
            //echo("INSERT INTO `lichlamviec` (`SENDER`, `TIEUDE`, `NOIDUNGTHONGBAO`, `TIME`, `BUOI`, `PHONG`) VALUES (".sqlesc($giaovien).", ".sqlesc($tieude).", ".sqlesc($noidung).", ".sqlesc(date_format($ngaythanglich, 'Y-m-d')).", ".sqlesc($buoi).", ".sqlesc($phong).")");
            echo("Đã thêm vào!!!");
        }
        if($_POST['type']=='updatephong'){
            $arr = explode(";",$_POST['data']);
            sql_query("UPDATE `qlphong` SET `tenphong`='$arr[1]', `chuthich`='$arr[2]', `somay`='$arr[3]' WHERE `autonum`=$arr[0]");
            echo("Đã Update!!!");
        }
    }
}else{
    die("Không nhận được request!!!");
}
?>