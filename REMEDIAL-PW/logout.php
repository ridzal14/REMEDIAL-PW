<?php
	session_start();

	if (!isset($_SESSION['login_user'])) {
		echo "<script>alert('Login Dahulu');</script>";
		echo "<script>window.location.replace('login.php');</script>";
	}

	unset($_SESSION['login_user']);

	echo "<script>alert('Berhasil Logout');</script>";
	echo "<script>window.location.replace('login.php');</script>";
?>