<?php
include_once("include/function.php");
dbconnect();

if(isset($_COOKIE["username"])==0){
    header('Location: login.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_POST['type']=='delmay'){
        $autonum = explode('-',$_POST['data'])[1];
        //echo("delete from maytinh where autonum = ".sqlesc($autonum));
        sql_query("delete from maytinh where autonum = ".sqlesc($autonum)) or die("Không xoá được");
        //echo('Đã Xoá!!!');
    }
}
?>