<?php

include '../../../koneksi/koneksi.php';

$request = 3;

if(isset($_GET['request'])){
	$request = $_GET['request'];
}

if($request == 1){

	$sql = "SELECT * FROM users ORDER BY id";
	$employeeData = mysqli_query($koneksi,$sql);

	$response = array();
	
	$no = 1;
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"nomer" => $no++,
			"id" => $row['id'],
			"name" => $row['name'],
            "username" => $row['username'],
            "role" => $row['role'],
			"created_at" => $row['created_at']
			);
	}

	echo json_encode($response);
	exit;
}

if($request == 2){

	$data = json_decode(file_get_contents("php://input"));

    $name = $data->name;
	$username = $data->username;
    $password = $data->password;

    $password = password_hash($password, PASSWORD_DEFAULT);
	
	$sql = "INSERT INTO users (id, name, username, password, role, active) VALUES ('', '$name', '$username', '$password', '1', '1')";
	if(mysqli_query($koneksi,$sql)){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}

if ($request == 3) {

	$id = $_GET['id'];

	$sql = $koneksi->query("DELETE FROM users WHERE id = $id");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
}

if ($request == 4) {

	$id = $_GET["id"];
	$sql = $koneksi->query("SELECT * FROM users WHERE id = $id");

	$data = array();

	while ($ambil = $sql->fetch_assoc()) {
	    $data[] = array(
	        'id' => $ambil['id'],
	        'name' => $ambil['name'],
            'username' => $ambil['username'],
            'password' => $ambil['password']
	    );
	}

	echo json_encode($data);
	exit;
}

if ($request == 5) {
	$data = json_decode(file_get_contents("php://input"));

	$id = $data->id;
	$name = $data->name;
    $username = $data->username;
    $password = $data->password;

	$password = password_hash($password, PASSWORD_DEFAULT);

	$sql = $koneksi->query("UPDATE users SET name = '$name', username = '$username', password = '$password' WHERE id = '$id'");

	if($sql){
	    echo 1; 
	}else{
	    echo 0;
	}

	exit;
}