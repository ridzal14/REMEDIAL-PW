<main>
    <div class="recent">
        <div class="projects">
            <div class="card" style="background-color: white;">
               <div class="card-header">
                <h3><i class="fa fa-plus"></i> Tambah Data Users</h3>
            </div>
            <div class="card-body">
				<input type="hidden" id="id">
                <label> Name </label>
                <input type="text" class="form-control" id="name">
                <br><br>
				<label> Username </label>
				<input type="text" class="form-control" id="username">
				<br><br>
				<label> Password </label>
				<input type="password" class="form-control" id="password">
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
					<h3><i class="fa fa-users"></i> Data Users</h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table width="100%" id="data">
							<thead>
								<tr>
									<td>No.</td>
									<td>Name</td>
									<td>Username</td>
									<td>Tanggal Buat</td>
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
		xhttp.open("GET", "http://localhost/rijal/admin/halaman/users/ajax.php?request=1", true);

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
						let name = NewRow.insertCell(1); 
						let username = NewRow.insertCell(2);
                        let created_at = NewRow.insertCell(3);
						let aksi_cell = NewRow.insertCell(4);
						let sesi = "<?= $_SESSION['data_login']['name'] ?>";

						nomer.innerHTML = val['nomer'];
						name.innerHTML = val['name']; 
						username.innerHTML = val['username']; 

						if (created_at == "") {
							created_at.innerHTML = "NULL";
						} else {
							created_at.innerHTML = val['created_at'];
						}

						if (val['name'] == sesi) {
							aksi_cell.innerHTML = '<button class="btn-warning" onclick="edit('+ val['id'] +')" id="btn_edit"> Edit</button>';
						} else {
							aksi_cell.innerHTML = '<button class="btn-warning" onclick="edit('+ val['id'] +')" id="btn_edit">Edit</button> &bull; <button class="btn-danger" onclick="hapus('+ val['id'] +')">Hapus</button>';
						} 

					}
				} 

			}
		};

		xhttp.send();


	}

	function insert() {

        let name = document.getElementById("name").value;
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;

		if(name != '' && username !='' && password != ''){

			let data = { name : name, username : username, password : password };
			let xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/rijal/admin/halaman/users/ajax.php?request=2", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Insert successfully.");

						load();

                        document.getElementById("name").value = "";
						document.getElementById("username").value = "";
                        document.getElementById("password").value = "";
					}
				}
			};

			xhttp.setRequestHeader("Content-Type", "application/json");

			xhttp.send(JSON.stringify(data));
		}

	}

	function edit(id) {
		let name = document.getElementById("name");
        let username = document.getElementById("username");
		let password = document.getElementById("password");
		let btn = document.getElementById('btn');
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		btn.hidden = true;
		btn_update.hidden = false;

		let xhttp = new XMLHttpRequest();
		xhttp.open("GET", "http://localhost/rijal/admin/halaman/users/ajax.php?request=4&id="+id, true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						name.value = val['name'];
                        username.value = val['username']; 
						password.value = val['password'];
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
			xhttp.open("GET", "http://localhost/rijal/admin/halaman/users/ajax.php?request=3&id="+id, true);

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

        let id = document.getElementById("id").value;
        let name = document.getElementById("name").value;
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;
        let btn = document.getElementById("btn");
        let btn_update = document.getElementById("btn_update");

		if(name != '' && username !='' && password != ''){

			let data = { id : id, name : name, username : username, password : password };
			let xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/rijal/admin/halaman/users/ajax.php?request=5", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Update successfully.");

						load();

                        document.getElementById("id").value = "";
                        document.getElementById("name").value = "";
                        document.getElementById("username").value = "";
                        document.getElementById("password").value = "";

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