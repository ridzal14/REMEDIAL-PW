<main>
    <div class="recent">
        <div class="projects">
            <div class="card" style="background-color: white;">
               <div class="card-header">
                <h3><i class="fa fa-plus"></i> Tambah Data Siswa</h3>
            </div>
            <div class="card-body">
                <label> NIS </label>
                <input type="text" class="form-control" id="nis">
                <br><br>
				<label> Nama </label>
				<input type="text" class="form-control" id="nama">
				<br><br>
				<label> Kelas </label>
				<select class="form-control" id="id_kelas">
					<option value="">- Pilih -</option>
				</select>
				<br><br>
				<label> No. Telepon </label>
				<input type="text" class="form-control" id="no_telp">
				<br><br>
				<label> Jenis Kelamin </label>
				<select class="form-control" id="jenis_kelamin">
					<option value="">- Pilih -</option>
					<option value="Laki - Laki">Laki - Laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
				<br><br>
				<label> Alamat </label>
				<textarea class="form-control" id="alamat" rows="4"></textarea>
				<br><br>
                <button class="btn-primary" id="btn" onclick="insert()">
                    <i class="fa fa-plus"></i> Tambah
                </button>
                <button class="btn-primary" id="btn_update" onclick="update()" hidden>
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>
	<br><hr>

	<div class="recent">
		<div class="projects">
			<div class="card">
				<div class="card-header">
					<h3><i class="fa fa-users"></i> Data Siswa</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table width="100%" id="data">
							<thead>
								<tr>
									<td>No.</td>
									<td>NIS</td>
									<td>Nama</td>
									<td>Kelas</td>
									<td>Jenis Kelamin</td>
									<td>Aksi</td>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<hr>

<script>
	load();

	function load() {
		let xhttp = new XMLHttpRequest();
		xhttp.open("GET", "http://localhost/rijal/admin/halaman/siswa/ajax.php?request=1", true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);
				let empTable = document.getElementById("data").getElementsByTagName("tbody")[0];

				empTable.innerHTML = "";

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						let NewRow = empTable.insertRow(-1); 
						let nomer = NewRow.insertCell(0);
						let nis = NewRow.insertCell(1); 
						let nama = NewRow.insertCell(2);
                        let nama_kelas = NewRow.insertCell(3); 
						let jenis_kelamin = NewRow.insertCell(4);
						let aksi_cell = NewRow.insertCell(5);

						nomer.innerHTML = val['nomer'];
						nis.innerHTML = val['nis']; 
						nama.innerHTML = val['nama']; 
                        nama_kelas.innerHTML = val['nama_kelas'];
						jenis_kelamin.innerHTML = val['jenis_kelamin']; 
                        no_telp.innerHTML = val['no_telp'];
						aksi_cell.innerHTML = '<button class="btn-warning" onclick="edit('+ val['nis'] +')" id="btn_edit">Edit</button> &bull; <button class="btn-danger" onclick="hapus('+ val['nis'] +')">Hapus</button>'; 

					}
				} 

			}
		};

		xhttp.send();


	}

	function insert() {

        let nis = document.getElementById("nis").value;
        let nama = document.getElementById("nama").value;
        let id_kelas = document.getElementById("id_kelas").value;
        let no_telp = document.getElementById("no_telp").value;
        let jenis_kelamin = document.getElementById("jenis_kelamin").value;
        let alamat = document.getElementById("alamat").value;

		if(nis != '' && nama !='' && id_kelas != '' && no_telp != '' && jenis_kelamin != '' && alamat != ''){

			let data = { nis : nis, nama : nama, id_kelas : id_kelas, no_telp : no_telp, jenis_kelamin : jenis_kelamin , alamat : alamat };
			let xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/rijal/admin/halaman/siswa/ajax.php?request=2", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Insert successfully.");

						load();

                        document.getElementById("nis").value = "";
						document.getElementById("nama").value = "";
                        document.getElementById("id_kelas").value = "";
						document.getElementById("no_telp").value = "";
						document.getElementById("jenis_kelamin").value = "";
                        document.getElementById("alamat").value = "";
					}
				}
			};

			xhttp.setRequestHeader("Content-Type", "application/json");

			xhttp.send(JSON.stringify(data));
		} else {
			alert('Data Tidak Boleh Kosong');
		}

	}

    function tampil_kelas() {
        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                let response = JSON.parse(this.responseText);

                response.forEach(function(element) {
                    document.getElementById("id_kelas").innerHTML += "<option value="+element.id+">"+element.nama_kelas+"</option>";
                });
            }
        };
        xhttp.open("GET", "http://localhost/rijal/admin/halaman/kelas/ajax.php?request=1", true);
        xhttp.send();

    }

	tampil_kelas();

	function edit(nis) {
		let nama = document.getElementById("nama");
        let id_kelas = document.getElementById("id_kelas");
		let jenis_kelamin = document.getElementById("jenis_kelamin");
		let no_telp = document.getElementById("no_telp");
        let alamat = document.getElementById("alamat");
		let btn = document.getElementById('btn');
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		btn.hidden = true;
		btn_update.hidden = false;

		let xhttp = new XMLHttpRequest();
		xhttp.open("GET", "http://localhost/rijal/admin/halaman/siswa/ajax.php?request=4&nis="+nis, true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						nama.value = val['nama'];
                        id_kelas.value = val['id_kelas']; 
						jenis_kelamin.value = val['jenis_kelamin']; 
						no_telp.value = val['no_telp'];
                        alamat.value = val['alamat'];
						document.getElementById("nis").value = val['nis'];

					}
				} 

			}
		};

		xhttp.send();
	}

	function hapus(nis) {
		let xhttp = new XMLHttpRequest();
		let konfirmasi = confirm("Yakin ? Mau di Hapus ?");

		if (konfirmasi) {
			xhttp.open("GET", "http://localhost/rijal/admin/halaman/siswa/ajax.php?request=3&nis="+nis, true);

			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Delete successfully.");

						load();
					}

				}
			};

			xhttp.send();
		}
	}

	function update() {

        let nis = document.getElementById("nis").value;
        let nama = document.getElementById("nama").value;
        let id_kelas = document.getElementById("id_kelas").value;
        let jenis_kelamin = document.getElementById("jenis_kelamin").value;
        let no_telp = document.getElementById("no_telp").value;
        let alamat = document.getElementById("alamat").value;
        let btn = document.getElementById("btn");
        let btn_update = document.getElementById("btn_update");

		if(nis != '' && nama !='' && id_kelas != '' && jenis_kelamin != '' && no_telp != '' && alamat != ''){

			let data = { nis : nis, nama : nama, id_kelas : id_kelas, jenis_kelamin : jenis_kelamin, no_telp : no_telp, alamat : alamat };
			let xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/rijal/admin/halaman/siswa/ajax.php?request=5", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Update successfully.");

						load();

                        document.getElementById("nis").value = "";
                        document.getElementById("nama").value = "";
                        document.getElementById("id_kelas").value = "";
                        document.getElementById("jenis_kelamin").value = "";
                        document.getElementById("no_telp").value = "";
                        document.getElementById("alamat").value = "";

                        btn.hidden = false;
                        btn_update.hidden = true;
					}
				}
			};

			xhttp.setRequestHeader("Content-Type", "application/json");

			xhttp.send(JSON.stringify(data));
		}
	}
</script>