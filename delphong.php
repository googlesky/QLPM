<?php
include_once("include/function.php");
dbconnect();

if(isset($_COOKIE["username"])==0){
    header('Location: login.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if($_POST['type']=="delphong"){
        $str = $_POST['phongno'];
        $arr = explode("-",$str);
        sql_query("delete from qlphong where autonum = ".$arr[1]) or die("Lỗi SQL!!!");
    }
    if($_POST['type']=="dellich"){
        $str = $_POST['lichno'];
        $arr = explode("-",$str);
        sql_query("delete from lichlamviec where AUTONUMBER = ".$arr[1]) or die("Lỗi SQL!!!");
        //echo("Đã xoá lịch!!!");
    }
    //header('Location: phong.php');
}else{
    die("Không nhận được request!!!");
}
?>