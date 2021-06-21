<?php
	session_start();
	include 'koneksi/koneksi.php';
	
	$data = json_decode(file_get_contents("php://input"));

	$username = $data->username;
	$password = $data->password;

	$sql = $koneksi->query("SELECT * FROM users WHERE username = '$username'");

	if (mysqli_num_rows($sql)  === 1) {
		$array = mysqli_fetch_assoc($sql);

		if ($array['role'] == 2) {
			if (password_verify($password, $array['password'])) {
				$_SESSION['login_user'] = true;
            	$_SESSION['data_login_user'] = $array;
				$_SESSION['username'] = $array['username'];
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	} else {
		echo 0;
	}

?>