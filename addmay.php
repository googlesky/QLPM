<?php
include_once("include/function.php");
dbconnect();

if(isset($_COOKIE["username"])==0){
    header('Location: login.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_POST['type']=='editmay'){
        $data = explode("&",$_POST['data']);
        $ram = explode(";",$data[5]);
        sql_query("UPDATE `qlpm`.`maytinh` SET `tenmay`='$data[1]', `chipset`='$data[2]', `main`='$data[3]', `hdd`='$data[4]', `ram1`='$ram[0]', `ram2`='$ram[1]', `manhinh`='$data[6]' WHERE `autonum`=$data[0]");
        //echo("UPDATE `qlpm`.`maytinh` SET `tenmay`='$data[1]', `chipset`='$data[2]', `main`='$data[3]', `hdd`='$data[4]', `ram1`='$ram[0]', `ram2`='$ram[1]', `manhinh`='$data[6]' WHERE `autonum`=$data[0]");
        echo("Đã Update!!!");
    }
    if($_POST['type']=='themmay'){
        $data = explode("&",$_POST['data']);
        $ram = explode(";",$data[5]);
        if(isset($ram[1])){
            sql_query("INSERT INTO `maytinh` (`autonum`, `tenmay`, `chipset`, `main`, `hdd`, `ram1`, `ram2`, `ram3`, `ram4`, `manhinh`, `phong`) VALUES (NULL , '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$ram[0]', '$ram[1]', NULL, NULL, '$data[6]', $data[0] )");
        }else{
            sql_query("INSERT INTO `maytinh` (`autonum`, `tenmay`, `chipset`, `main`, `hdd`, `ram1`, `ram2`, `ram3`, `ram4`, `manhinh`, `phong`) VALUES (NULL , '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$ram[0]', NULL, NULL, NULL, '$data[6]', $data[0] )");
        }

        //echo("INSERT INTO `maytinh` (`autonum`, `tenmay`, `chipset`, `main`, `hdd`, `ram1`, `ram2`, `ram3`, `ram4`, `manhinh`, `phong`) VALUES (NULL , '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$ram[0]', '$ram[1]', NULL, NULL, '$data[6]', $data[0] )");
        echo("Đã Thêm Máy!!!");

        //echo($_POST['data']);
    }
    if($_POST['type']=='report'){
        $data = explode("&",$_POST['data']);
        if($data[1]=='Đã Hỏng'){
            sql_query("INSERT INTO `maytinh_tinhtrang` (`autonum`, `idmay`, `tinhtrang`, `ngayhong`, `ngaysua`, `ghichu`) VALUES (NULL, ".sqlesc($data[0]).", 'Đã Hỏng', ".sqlesc(date("Y-m-d")).", NULL, ".sqlesc($data[2]).")") or die("Lỗi SQL!!!");
        }else{
            //$res = sql_query("select * from maytinh_tinhtrang where idmay =".sqlesc($data[0])." and `ngaysua`= NULL");
            if($data[1]=='Hoạt Động'){
                sql_query("UPDATE `maytinh_tinhtrang` SET `tinhtrang`='Hoạt Động', `ngaysua`=".sqlesc(date("Y-m-d"))." WHERE idmay =".sqlesc($data[0])."") or die("Lỗi SQL!!!");
            }
        }
        echo("Đã report!!!");
    }
}
?>