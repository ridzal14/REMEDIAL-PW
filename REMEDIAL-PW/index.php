<?php
session_start();

include 'koneksi/koneksi.php';

date_default_timezone_set("Asia/Jakarta");

if (!isset($_SESSION['login_user'])) {
	echo "<script>alert('Login Dahulu');</script>";
	echo "<script>window.location.replace('login.php');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Landing Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/desain.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

	<?php include 'layout/menu.php'; ?>

	<section>
		Selamat Datang Rijal <br><br><hr><br>
		Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dignissimos velit veritatis cupiditate facere blanditiis corporis laboriosam. Vero molestias atque nobis ut reiciendis ipsa harum distinctio, velit id reprehenderit mollitia commodi!
	</section>

</body>
</html>