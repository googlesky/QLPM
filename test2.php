<?php
/**
 * Created by PhpStorm.
 * User: Hieu
 * Date: 15/09/14
 * Time: 16:30
 */

include_once("include/function.php");

$user = $Cache->get("noidungtest");

var_dump($user);

if(mysql_num_rows($user)>0){
    while($row = mysql_fetch_assoc($user)){
        var_dump($row);
    }
}