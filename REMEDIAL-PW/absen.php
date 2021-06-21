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
        <table class="table">
        <thead>
            <th>No.</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Status</th>
            <th>Tanggal Absen</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </thead>
        <tbody>
                <?php 
                    $no = 0;
                    $id_kelas = $_SESSION['data_login_user']['id_kelas'];
                    $query = $koneksi->query("SELECT * FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id WHERE id_kelas = $id_kelas ");
                ?>
                <?php foreach ($query as $data) : ?>
                    <form method="POST">
                    <input type="hidden" name="nis_siswa" value="<?php echo $data['nis'] ?>">
                    <tr>
                        <td><?php echo ++$no ?>.</td>
                        <td><?php echo $data['nama'] ?></td>
                        <td><?php echo $data['nama_kelas'] ?></td>
                        <td>
                            <select name="absen_status" style="padding: 5px; width: 100%">
                                <option value="">- Pilih -</option>
                                <option value="1">Hadir</option>
                                <option value="2">Sakit</option>
                                <option value="3">Izin</option>
                                <option value="4">Alfa</option>
                            </select>
                        </td>
                        <td>
                            <input type="date" name="absen_date" readonly value="<?php echo date("Y-m-d") ?>" style="padding: 2px; text-align: center;">
                        </td>
                        <td>
                            <input type="text" name="keterangan" placeholder="Masukkan Keterangan" style="padding: 5px;">
                        </td>
                        <td>
                            <button type="submit" name="btn_absen" style="padding: 7px; border-radius: 3px; background-color: blue; color: white; border: none; cursor: pointer;">
                                <i class="fa fa-pencil"></i> Absen
                            </button>
                        </td>
                    </tr>
                    </form>
                <?php endforeach ?>
        </tbody>
    </table>
	</section>

    <?php
        if (isset($_POST['btn_absen'])) {
            $id_user = $_SESSION['data_login_user']['id'];
            $nis_siswa = $_POST['nis_siswa'];
            $absen_date = $_POST['absen_date'];
            $absen_time = date("H:i:s");
            $absen_status = $_POST['absen_status'];
            $keterangan = $_POST['keterangan'];

            if ($keterangan == "") {
                $keterangan = "hadir";
            } else {
                $keterangan = $_POST['keterangan'];
            }

            $sql = $koneksi->query("INSERT INTO absen (id, id_user, nis_siswa, absen_date, absen_time, absen_status, keterangan) VALUES ('','$id_user', '$nis_siswa', '$absen_date', '$absen_time', '$absen_status', '$keterangan') ");

            if ($sql != 0) {
                echo "<script>alert('Berhasil Absen');</script>";
                echo "<script>window.location.replace('absen.php');</script>";
            } else {
                echo "<script>alert('Gagal Absen');</script>";
                echo "<script>window.location.replace('absen.php');</script>";
            }
            
        }
    ?>

</body>
</html>