<?php
include_once("include/function.php");
dbconnect();

if(isset($_COOKIE["username"])==0){
    header('Location: login.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_POST['type']=='resetquyen'){
        //echo($_POST['data']);
        $data = explode("&",$_POST['data']);
        $id = $data[0];
        $ten = $data[1];
        $user = $data[2];
        $quyen = $data[3];
        if($quyen=='Administrator'){
            $class = 100;
        }
        if($quyen=='Moderator'){
            $class = 90;
        }
        if($quyen=='Guest'){
            $class = 1;
        }
        $chucvu = $data[4];
        if($_POST['pass']!=''){
            $pass = md5($user.$_POST['pass'].$user);
            sql_query("UPDATE `users` SET HOTEN = ".sqlesc($ten).", USERNAME = ".sqlesc($user).", CHUCVU = ".sqlesc($chucvu).",CLASS = ".sqlesc($class).",PASSWORD= ".sqlesc($pass)." WHERE (`IDNUM`='$id')") or die('Lỗi SQL');
            //header('Location: logout.php');
        }else{
            sql_query("UPDATE `users` SET HOTEN = ".sqlesc($ten).", USERNAME = ".sqlesc($user).", CHUCVU = ".sqlesc($chucvu).",CLASS = ".sqlesc($class)." WHERE (`IDNUM`='$id')") or die('Lỗi SQL');
        }
        echo('Đã làm!!!');
    }
    if($_POST['type']=='adduser'){
        //echo($_POST['data']);
        $data = explode("&",$_POST['data']);
        $ten = $data[0];
        $user = $data[1];
        $quyen = $data[2];
        $class = 1;
        if($quyen=='Administrator'){
            $class = 100;
        }
        if($quyen=='Moderator'){
            $class = 90;
        }
        if($quyen=='Guest'){
            $class = 1;
        }
        $chucvu = $data[3];
        $pass = md5($user.$_POST['pass'].$user);
        sql_query("INSERT INTO `users` (`IDNUM`, `USERNAME`, `HOTEN`, `CHUCVU`, `PASSWORD`, `CLASS`, `EMAIL`, `NGAYSINH`, `KHOA`, `SDT`, `INFO`, `AVATAR`, `LAST_IP`) VALUES (NULL, ".sqlesc($user).", ".sqlesc($ten).", ".sqlesc($chucvu).", ".sqlesc($pass).", ".sqlesc($class).", NULL, NULL, NULL, NULL, NULL, NULL, NULL)") or die('Lỗi SQL');
//        echo("INSERT INTO `users` (`IDNUM`, `USERNAME`, `HOTEN`, `CHUCVU`, `PASSWORD`, `CLASS`, `EMAIL`, `NGAYSINH`, `KHOA`, `SDT`, `INFO`, `AVATAR`, `LAST_IP`) VALUES (NULL, ".sqlesc($user).", ".sqlesc($ten).", ".sqlesc($chucvu).", ".sqlesc($pass).", ".sqlesc($class).", NULL, NULL, NULL, NULL, NULL, NULL, NULL)");
        echo('Đã làm!!!');
    }
}
?>