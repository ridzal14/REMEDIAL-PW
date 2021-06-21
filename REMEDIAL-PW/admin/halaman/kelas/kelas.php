<main>
    <div class="recent">
        <div class="projects">
            <div class="card" style="background-color: white;">
               <div class="card-header">
                <h3><i class="fa fa-plus"></i> Tambah Data Kelas</h3>
            </div>
            <div class="card-body">
				<input type="hidden" id="id">
                <label> Nama Kelas </label>
                <input type="text" class="form-control" id="nama_kelas">
                <br><br>
				<label> Wali Kelas </label>
				<select id="nip_wali_kelas" class="form-control">
					<option value="">- Pilih -</option>
				</select>
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
					<h3><i class="fa fa-bars"></i> Data Kelas</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table width="100%" id="data">
							<thead>
								<tr>
									<td>No.</td>
									<td>Nama Kelas</td>
									<td>Wali Kelas</td>
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
		xhttp.open("GET", "http://localhost/rijal/admin/halaman/kelas/ajax.php?request=1", true);

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
						let nama_kelas = NewRow.insertCell(1);
						let nama = NewRow.insertCell(2);
						let aksi_cell = NewRow.insertCell(3);

						nomer.innerHTML = val['nomer'];
						nama_kelas.innerHTML = val['nama_kelas'];
						nama.innerHTML = val['nama'];
						aksi_cell.innerHTML = '<button class="btn-warning" onclick="edit('+ val['id'] +')" id="btn_edit">Edit</button> &bull; <button class="btn-danger" onclick="hapus('+ val['id'] +')">Hapus</button>'; 

					}
				} 

			}
		};

		xhttp.send();


	}

	function tampil_wali_kelas() {
        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                let response = JSON.parse(this.responseText);

                response.forEach(function(element) {
                    document.getElementById("nip_wali_kelas").innerHTML += "<option value="+element.nip+">"+element.nama+"</option>";
                });
            }
        };
        xhttp.open("GET", "http://localhost/rijal/admin/halaman/guru/ajax.php?request=6", true);
        xhttp.send();

    }

	tampil_wali_kelas();

	function insert() {

		let nama_kelas = document.getElementById("nama_kelas").value;
		let nip_wali_kelas = document.getElementById("nip_wali_kelas").value;

		if(nama_kelas != '' && nip_wali_kelas !=''){

			let data = { nama_kelas : nama_kelas, nip_wali_kelas : nip_wali_kelas };
			let xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/rijal/admin/halaman/kelas/ajax.php?request=2", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Insert successfully.");

						load();

						document.getElementById("nama_kelas").value = "";
						document.getElementById("nip_wali_kelas").value = "";
					}
				}
			};

			xhttp.setRequestHeader("Content-Type", "application/json");

			xhttp.send(JSON.stringify(data));
		} else {
			alert('Data Tidak Boleh Kosong');
		}

	}

	function edit(id) {
		let nama_kelas = document.getElementById("nama_kelas");
		let nip_wali_kelas = document.getElementById("nip_wali_kelas");
		let btn = document.getElementById('btn');
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		btn.hidden = true;
		btn_update.hidden = false;

		let xhttp = new XMLHttpRequest();
		xhttp.open("GET", "http://localhost/rijal/admin/halaman/kelas/ajax.php?request=4&id="+id, true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						nama_kelas.value = val['nama_kelas']; 
						nip_wali_kelas.value = val['nip_wali_kelas'];
						document.getElementById("id").value = val['id'];

					}
				} 

			}
		};

		xhttp.send();
	}

	function hapus(id) {
		let xhttp = new XMLHttpRequest();
		let konfirmasi = confirm("Yakin ? Mau di Hapus ?");

		if (konfirmasi) {
			xhttp.open("GET", "http://localhost/rijal/admin/halaman/kelas/ajax.php?request=3&id="+id, true);

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

		let id = document.getElementById('id').value;
		let nama_kelas = document.getElementById('nama_kelas').value;
		let nip_wali_kelas = document.getElementById("nip_wali_kelas").value;
		let btn = document.getElementById("btn");
		let btn_update = document.getElementById("btn_update");


		if(nama_kelas != '' && nip_wali_kelas !=''){

			let data = { id : id, nama_kelas : nama_kelas, nip_wali_kelas : nip_wali_kelas };
			let xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/rijal/admin/halaman/kelas/ajax.php?request=5", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Update successfully.");

						load();

						document.getElementById("id").value = "";
						document.getElementById("nama_kelas").value = "";
						document.getElementById("nip_wali_kelas").value = "";
					}
				}
			};

			xhttp.setRequestHeader("Content-Type", "application/json");

			xhttp.send(JSON.stringify(data));
		}
	}
</script>