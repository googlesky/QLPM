<?php
ob_start();
include_once("include/function.php");
dbconnect();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username1"];
    $password = $_POST["password1"];

    $res = sql_query("Select *
                      FROM users
                      where username = '".$username."'
                      limit 1");
    if(mysql_num_rows($res)>0){
        $arr = mysql_fetch_assoc($res);
        if(strcmp(md5($username.$password.$username) , $arr['PASSWORD'])==0){
            mysql_query("INSERT INTO log_ip (idnum,ip,ngay) values ('$arr[IDNUM]',".sqlesc(getIp()).",".sqlesc(date("Y-m-d H:i:s")).")");
            setcookie('username',$username,time()+36000);
            setcookie('pass',md5($username.$password.$username),time()+36000);
            setcookie('userid',$arr['idnum'],time()+36000);
            header('Location: admin.php');
        }else{
            $thongbao = "Sai Password!!!";

        }
    }else{
        $thongbao = "Không tìm thấy username nào!!!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN!!!</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/messi.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="bg-blur"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form class="form" action="login.php" method="post">
                <div class="form-group">
                    <h2>Vui lòng đăng nhập</h2>
                    <input type="text" name ="username1" id="username1" value="<?php if(isset($thongbao)) echo $username; ?>" placeholder="Nhập tên đăng nhập" class="form-control" required autofocus>
                    <input type="password" name="password1" id="password1" placeholder="Nhập mật khẩu" class="form-control" required>
<!--                    <p name="thongbao" style="color: red, align-content: center">--><?php //if(isset($thongbao)) echo $thongbao; ?><!--</p>-->
                        <?php if(isset($thongbao)) echo '<div class="alert alert-warning">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong> '.$thongbao.'.
                    </div>'?>
                    <div class="checkbox">
                        <input type="checkbox">Nhớ mật khẩu
                    </div>
                    <button class="btn btn-lg btn-success btn-block" type="submit">Đăng nhập</button>
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
ob_flush();
?>