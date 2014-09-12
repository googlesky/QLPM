<?php
include_once("include/function.php");
dbconnect();

//$res = sql_query("select * from qlphong");
//while($arr = mysql_fetch_assoc($res)){
//    for($i=1;$i<=$arr['somay'];$i++){
//        sql_query("INSERT INTO `qlpm`.`maytinh` (`autonum`, `tenmay`, `chipset`, `main`, `hdd`, `ram1`, `ram2`, `ram3`, `ram4`, `manhinh`, `phong`) VALUES (NULL, 'Máy $i', 'Core i5 3337U', 'ASUS P8H61-MX', 'Seagate 500GB', 'Kingston 4GB', 'Kingston 4GB', NULL, NULL, 'ASUS PQ321Q',".sqlesc($arr['autonum'])." )");
//        echo("INSERT INTO `qlpm`.`maytinh` (`autonum`, `tenmay`, `chipset`, `main`, `hdd`, `ram1`, `ram2`, `ram3`, `ram4`, `manhinh`, `phong`) VALUES (NULL, 'Máy $i', 'Core i5 3337U', 'ASUS P8H61-MX', 'Seagate 500GB', 'Kingston 4GB', 'Kingston 4GB', NULL, NULL, 'ASUS PQ321Q',".sqlesc($arr['autonum'])." )\n");
//    }
//}
//
//$res = sql_query("select * from maytinh");
//while($arr = mysql_fetch_assoc($res)){
//    sql_query("INSERT INTO `qlpm`.`maytinh_software` (`idmay`, `hdh`, `software`) VALUES (".sqlesc($arr['autonum']).", '1', '2;3;4;5;6;7;8;9;10;12;13;14;15;16;17;18')");
//}


?>