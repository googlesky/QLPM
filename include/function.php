<?php
//if(!defined('IN_TRACKER'))
//    die('Hacking attempt!');
require_once("globalfunction.php");

function dbconnect(){
    $db = array(
        "root" => "root",
        "password" => "",
        "host" => "localhost",
        "db" => "qlpm",
    );

    if(!mysql_pconnect($db["host"],$db["root"],$db["password"])){
        switch (mysql_errno()) {
            case 1040:
            case 2002:
                die("<html><head><meta http-equiv=refresh content=\"10 $_SERVER[REQUEST_URI]\"><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head><body><table border=0 width=100% height=100%><tr><td><h3 align=center>" . $lang_functions['std_server_load_very_high'] . "</h3></td></tr></table></body></html>");
            default:
                die("[" . mysql_errno() . "] dbconn: mysql_connect: " . mysql_error());
        }
    }
    sql_query("SET NAMES UTF8");
    sql_query("SET collation_connection = 'utf8_general_ci'");
    mysql_select_db($db["db"]) or die('dbconn: mysql_select_db: ' + mysql_error());
}

function login($check,$username,$password){
        setcookie('username',$username,time()+36000);
        setcookie('pass',$password,time()+36000);
        $res = sql_query("select * from users where USERNAME=".$username);
        if(mysql_num_rows($res)==1){
            $arr = mysql_fetch_assoc($res);
            setcookie('userid',$arr['idnum'],time()+36000);
        }
}

function curuser(){
    $res = sql_query("Select *
                      FROM users
                      where username = '".$_COOKIE['username']."'
                      limit 1");
    if(mysql_num_rows($res)>0){
        $arr = mysql_fetch_assoc($res);
        if (isset($arr['IDNUM'])) {
            return $arr['IDNUM'];
        }
    }
}
//
//function getIp() {
//    $ip = $_SERVER['REMOTE_ADDR'];
//    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
//        $ip = $_SERVER['HTTP_CLIENT_IP'];
//    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//    }
//    return $ip;
//}
function replace(){
    $find = array(";",",",".","=","-");
    $replace = ("Tôi yêu, Việt. Nam");
    $onlyreplace = str_replace($find, "" , $replace );
    echo $onlyreplace;
}
?>