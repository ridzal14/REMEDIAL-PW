<?php

include '../../../koneksi/koneksi.php';

$request = 3;

if(isset($_GET['request'])){
	$request = $_GET['request'];
}

if($request == 1){

	$sql = "SELECT * FROM guru ORDER BY nip";
	$employeeData = mysqli_query($koneksi,$sql);

	$response = array();
	
	$no = 1;
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"nomer" => $no++,
			"nip" => $row['nip'],
			"nama" => $row['nama'],
			"jenis_kelamin" => $row['jenis_kelamin'],
			"no_hp" => $row['no_hp'],
            "alamat" => $row['alamat']
			);
	}

	echo json_encode($response);
	exit;
}

if($request == 2){

	$data = json_decode(file_get_contents("php://input"));

    $nip = $data->nip;
	$nama = $data->nama;
    $jenis_kelamin = $data->jenis_kelamin;
    $no_hp = $data->no_hp;
    $alamat = $data->alamat;
	
	$sql = "INSERT INTO guru VALUES ('$nip', '$nama', '$jenis_kelamin', '$no_hp', '$alamat')";
	if(mysqli_query($koneksi,$sql)){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}

if ($request == 3) {

	$nip = $_GET['nip'];

	$sql = $koneksi->query("DELETE FROM guru WHERE nip = '$nip'");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
}

if ($request == 4) {

	$nip = $_GET["nip"];
	$sql = $koneksi->query("SELECT * FROM guru WHERE nip = '$nip'");

	$data = array();

	while ($ambil = $sql->fetch_assoc()) {
	    $data[] = array(
	        'nip' => $ambil['nip'],
	        'nama' => $ambil['nama'],
	        'jenis_kelamin' => $ambil['jenis_kelamin'],
	        'no_hp' => $ambil['no_hp'],
            'alamat' => $ambil['alamat']
	    );
	}

	echo json_encode($data);
	exit;
}

if ($request == 5) {
	$data = json_decode(file_get_contents("php://input"));

	$nip = $data->nip;
	$nama = $data->nama;
    $jenis_kelamin = $data->jenis_kelamin;
    $no_hp = $data->no_hp;
    $alamat = $data->alamat;

	$sql = $koneksi->query("UPDATE guru SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', no_hp = '$no_hp', alamat = '$alamat' WHERE nip = '$nip'");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
}

if ($request == 6) {

	$sql = "SELECT * FROM guru ORDER BY nip DESC";
	$employeeData = mysqli_query($koneksi,$sql);

	$response = array();
	
	$no = 1;
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"nomer" => $no++,
			"nip" => $row['nip'],
			"nama" => $row['nama'],
			"jenis_kelamin" => $row['jenis_kelamin'],
			"no_hp" => $row['no_hp'],
            "alamat" => $row['alamat']
			);
	}

	echo json_encode($response);
	exit;

}