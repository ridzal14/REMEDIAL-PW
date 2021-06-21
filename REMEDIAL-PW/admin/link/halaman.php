<?php
	
	if (isset($_GET['halaman'])) {
		$hal = $_GET['halaman'];
	} else {
		$hal = "home";
	}

	switch ($hal) {
		case 'home':
			include 'halaman/home.php';
			break;
		
		case 'kelas':
			include 'halaman/kelas/kelas.php';
			break;

		case 'guru':
			include 'halaman/guru/guru.php';
			break;

		case 'siswa':
			include 'halaman/siswa/siswa.php';
			break;

		case 'users':
			include 'halaman/users/users.php';
			break;

		case 'logout':
			include 'halaman/logout.php';
			break;

		default:
			echo "404 Not Found";
			break;
	}

?>