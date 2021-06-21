<!DOCTYPE html>
<html>
<head>
	<title>CSS Table Responsive</title>
	<style type="text/css">
		body {
			margin: 0;
			padding: 20px;
			font-family: sans-serif;
		}

		* {
			box-sizing: border-box;
		}

		.table {
			width: 100%;
			border-collapse: collapse;
		}

		.table td, .table th {
			padding: 12px 15px;
			border: 1px solid #ddd;
			text-align: center;
			font-size: 16px;
		}

		.table th {
			background-color: darkblue;
			color: #ffffff;
		}

		.table tbody tr:nth-child(even) {
			background-color: #f5f5f5;
		}

		@media(max-width: 500px) {
			.table thead {
				display: none;
			}

			.table, .table tbody, .table tr, .table td {
				display: block;
				width: 100%;
			}

			.table tr {
				margin-bottom: 15px;
			}
		}
	</style>
</head>
<body>

<table class="table">
	<thead>
		<th>No.</th>
		<th>Name</th>
		<th>Age</th>
		<th>Aksi</th>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Mohammad Ilham Teguhriyadi</td>
			<td>20</td>
			<td>
				<a href="">
					Edit
				</a>
				<a href="">
					Hapus
				</a>
			</td>
		</tr>
	</tbody>
</table>

</body>
</html>