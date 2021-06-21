<?php

include '../../../koneksi/koneksi.php';

$request = 3;

if(isset($_GET['request'])){
	$request = $_GET['request'];
}

if($request == 1){

	$sql = "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id ORDER BY nis";
	$employeeData = mysqli_query($koneksi,$sql);

	$response = array();
	
	$no = 1;
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"nomer" => $no++,
			"nis" => $row['nis'],
			"nama" => $row['nama'],
            "nama_kelas" => $row['nama_kelas'],
            "no_telp" => $row['no_telp'],
			"jenis_kelamin" => $row['jenis_kelamin'],
            "alamat" => $row['alamat']
			);
	}

	echo json_encode($response);
	exit;
}

if($request == 2){

	$data = json_decode(file_get_contents("php://input"));

    $nis = $data->nis;
	$nama = $data->nama;
    $id_kelas = $data->id_kelas;
    $no_telp = $data->no_telp;
    $jenis_kelamin = $data->jenis_kelamin;
    $alamat = $data->alamat;
	
	$sql = "INSERT INTO siswa VALUES ('$nis', '$nama', '$id_kelas', '$no_telp', '$jenis_kelamin', '$alamat')";
	if(mysqli_query($koneksi,$sql)){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}

if ($request == 3) {

	$nis = $_GET['nis'];

	$sql = $koneksi->query("DELETE FROM siswa WHERE nis = '$nis'");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
}

if ($request == 4) {

	$nis = $_GET["nis"];
	$sql = $koneksi->query("SELECT * FROM siswa WHERE nis = '$nis'");

	$data = array();

	while ($ambil = $sql->fetch_assoc()) {
	    $data[] = array(
	        'nis' => $ambil['nis'],
	        'nama' => $ambil['nama'],
            'id_kelas' => $ambil['id_kelas'],
            'no_telp' => $ambil['no_telp'],
	        'jenis_kelamin' => $ambil['jenis_kelamin'],
            'alamat' => $ambil['alamat']
	    );
	}

	echo json_encode($data);
	exit;
}

if ($request == 5) {
	$data = json_decode(file_get_contents("php://input"));

	$nis = $data->nis;
	$nama = $data->nama;
    $id_kelas = $data->id_kelas;
    $no_telp = $data->no_telp;
    $jenis_kelamin = $data->jenis_kelamin;
    $alamat = $data->alamat;

	$sql = $koneksi->query("UPDATE siswa SET nama = '$nama', id_kelas = '$id_kelas', no_telp = '$no_telp', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat' WHERE nis = '$nis'");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
}