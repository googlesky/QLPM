<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>
<?php
	if (isset($_COOKIE['username'])) {
		echo "<script>alert('Đăng xuất thành công!');</script>";
		setcookie('username', '', time()-36000);
		setcookie('pass', '', time()-36000);
		setcookie('userid', '', time()-36000);
		header("Location: login.php");
	} else {
		header("Location: login.php");
	}
?>
</body>
</html>
<?php
ob_flush();
?>