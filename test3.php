<head>
    <meta charset="utf-8">
</head>

<?php

include_once("include/function.php");

$Cache->set("noidungtest",sql_query("select * from users"));