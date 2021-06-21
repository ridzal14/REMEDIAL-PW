<?php

include '../../../koneksi/koneksi.php';

$request = 3;

if(isset($_GET['request'])){
	$request = $_GET['request'];
}

if($request == 1){

	$sql = "SELECT * FROM kelas JOIN guru ON kelas.nip_wali_kelas = guru.nip ORDER BY nama_kelas";
	$employeeData = mysqli_query($koneksi,$sql);

	$response = array();
	
	$no = 1;
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"nomer" => $no++,
			"id" => $row['id'],
			"nama_kelas" => $row['nama_kelas'],
			"nama" => $row['nama'],
			"nip_wali_kelas" => $row['nip_wali_kelas']
			);
	}

	echo json_encode($response);
	exit;
}

if($request == 2){

	$data = json_decode(file_get_contents("php://input"));

	$nama_kelas = $data->nama_kelas;
	$nip_wali_kelas = $data->nip_wali_kelas;
	
	$koneksi->query("INSERT INTO kelas VALUES ('','$nama_kelas','$nip_wali_kelas')");
	$id_kelas = $koneksi->insert_id;

	$data_guru = $koneksi->query("SELECT * FROM guru WHERE nip = '$nip_wali_kelas' ");
	$ambil = $data_guru->fetch_assoc();
	$nama_guru = $ambil['nama'];

	$password = $nip_wali_kelas;
	$password = password_hash($password, PASSWORD_DEFAULT);

	date_default_timezone_set("Asia/Jakarta");
	$skrng = date("Y-m-d H:i:s");

	$users = "INSERT INTO users (id, name, username, password, role, active, id_kelas, created_at, updated_at) VALUES ('', '$nama_guru', '$nip_wali_kelas', '$password', 2, 1, '$id_kelas', '$skrng','$skrng')";

	if(mysqli_query($koneksi,$users)){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}

if ($request == 3) {

	$id = $_GET['id'];

	$users = $koneksi->query("DELETE FROM users WHERE id_kelas = $id");

	$sql = $koneksi->query("DELETE FROM kelas WHERE id = $id");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
}

if ($request == 4) {

	$id = $_GET["id"];
	$sql = $koneksi->query("SELECT * FROM kelas WHERE id = $id");

	$data = array();

	while ($ambil = $sql->fetch_assoc()) {
	    $data[] = array(
	        'id' => $ambil['id'],
	        'nama_kelas' => $ambil['nama_kelas'],
			'nip_wali_kelas' => $ambil['nip_wali_kelas']
	    );
	}

	echo json_encode($data);
	exit;
}

if ($request == 5) {
	$data = json_decode(file_get_contents("php://input"));

	$id = $data->id;
	$nama_kelas = $data->nama_kelas;
	$nip_wali_kelas = $data->nip_wali_kelas;

	$sq = $koneksi->query("UPDATE kelas SET nama_kelas = '$nama_kelas', nip_wali_kelas = '$nip_wali_kelas'  WHERE id = $id");

	$data_guru = $koneksi->query("SELECT * FROM guru WHERE nip = '$nip_wali_kelas' ");
	$ambil_data = $data_guru->fetch_assoc();
	$nama_guru = $ambil_data['nama'];

	$password = $nip_wali_kelas;
	$password = password_hash($password, PASSWORD_DEFAULT);

	date_default_timezone_set("Asia/Jakarta");
	$skrng = date("Y-m-d H:i:s");

	$sql = $koneksi->query("UPDATE users SET name = '$nama_guru', username = '$nip_wali_kelas', password = '$password', created_at = '$skrng' WHERE id_kelas = $id ");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
}