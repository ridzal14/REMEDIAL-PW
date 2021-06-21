<main>
    <div class="recent">
        <div class="projects">
            <div class="card" style="background-color: white;">
               <div class="card-header">
                <h3><i class="fa fa-plus"></i> Tambah Data Guru</h3>
            </div>
            <div class="card-body">
                <label> NIP </label>
                <input type="text" class="form-control" id="nip">
                <br><br>
				<label> Nama </label>
				<input type="text" class="form-control" id="nama">
				<br><br>
				<label> Jenis Kelamin </label>
				<select class="form-control" id="jenis_kelamin">
					<option value="">- Pilih -</option>
					<option value="Laki - Laki">Laki - Laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
				<br><br>
				<label> No. HP </label>
				<input type="text" class="form-control" id="no_hp">
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
					<h3><i class="fa fa-users"></i> Data Guru</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table width="100%" id="data">
							<thead>
								<tr>
									<td>No.</td>
									<td>NIP</td>
									<td>Nama</td>
									<td>Jenis Kelamin</td>
									<td>No. HP</td>
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

<script>
	load();

	function load() {
		let xhttp = new XMLHttpRequest();
		xhttp.open("GET", "http://localhost/rijal/admin/halaman/guru/ajax.php?request=1", true);

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
						let nip = NewRow.insertCell(1); 
						let nama = NewRow.insertCell(2); 
						let jenis_kelamin = NewRow.insertCell(3);
                        let no_hp = NewRow.insertCell(4);
						let aksi_cell = NewRow.insertCell(5);

						nomer.innerHTML = val['nomer'];
						nip.innerHTML = val['nip']; 
						nama.innerHTML = val['nama']; 
						jenis_kelamin.innerHTML = val['jenis_kelamin']; 
                        no_hp.innerHTML = val['no_hp'];
						aksi_cell.innerHTML = '<button class="btn-warning" onclick="edit('+ val['nip'] +')" id="btn_edit">Edit</button> &bull; <button class="btn-danger" onclick="hapus('+ val['nip'] +')">Hapus</button>'; 

					}
				} 

			}
		};

		xhttp.send();


	}

	function insert() {

        let nip = document.getElementById("nip").value;
        let nama = document.getElementById("nama").value;
        let jenis_kelamin = document.getElementById("jenis_kelamin").value;
        let no_hp = document.getElementById("no_hp").value;
        let alamat = document.getElementById("alamat").value;

		if(nip != '' && nama !='' && jenis_kelamin != '' && no_hp != '' && alamat != '' ){

			let data = { nip : nip, nama : nama, jenis_kelamin : jenis_kelamin, no_hp : no_hp, alamat : alamat };
			let xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/rijal/admin/halaman/guru/ajax.php?request=2", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Insert successfully.");

						load();

                        document.getElementById("nip").value = "";
						document.getElementById("nama").value = "";
						document.getElementById("jenis_kelamin").value = "";
						document.getElementById("no_hp").value = "";
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

	function edit(nip) {
		let nama = document.getElementById("nama");
		let jenis_kelamin = document.getElementById("jenis_kelamin");
		let no_hp = document.getElementById("no_hp");
        let alamat = document.getElementById("alamat");
		let btn = document.getElementById('btn');
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		btn.hidden = true;
		btn_update.hidden = false;

		let xhttp = new XMLHttpRequest();
		xhttp.open("GET", "http://localhost/rijal/admin/halaman/guru/ajax.php?request=4&nip="+nip, true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						nama.value = val['nama']; 
						jenis_kelamin.value = val['jenis_kelamin']; 
						no_hp.value = val['no_hp'];
                        alamat.value = val['alamat'];
						document.getElementById("nip").value = val['nip'];

					}
				} 

			}
		};

		xhttp.send();
	}

	function hapus(nip) {
		let xhttp = new XMLHttpRequest();
		let konfirmasi = confirm("Yakin ? Mau di Hapus ?");

		if (konfirmasi) {
			xhttp.open("GET", "http://localhost/rijal/admin/halaman/guru/ajax.php?request=3&nip="+nip, true);

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

        let nip = document.getElementById("nip").value;
        let nama = document.getElementById("nama").value;
        let jenis_kelamin = document.getElementById("jenis_kelamin").value;
        let no_hp = document.getElementById("no_hp").value;
        let alamat = document.getElementById("alamat").value;
        let btn = document.getElementById("btn");
        let btn_update = document.getElementById("btn_update");

		if(nip != '' && nama !='' && jenis_kelamin != '' && no_hp != '' && alamat != ''){

			let data = { nip : nip, nama : nama, jenis_kelamin : jenis_kelamin, no_hp : no_hp, alamat : alamat };
			let xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/rijal/admin/halaman/guru/ajax.php?request=5", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Update successfully.");

						load();

                        document.getElementById("nip").value = "";
                        document.getElementById("nama").value = "";
                        document.getElementById("jenis_kelamin").value = "";
                        document.getElementById("no_hp").value = "";
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