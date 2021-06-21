<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Responsive Navbar</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
			text-decoration: none;
			list-style: none;
			box-sizing: border-box;
		}

		body {
			font-family: monospace;
		}

		nav {
			background: #0082e6;;
			height: 80px;
			width: 100%;
		}

		label.logo {
			color: white;
			font-size: 35px;
			line-height: 80px;
			padding: 0 100px;
			font-weight: bold;
		}

		nav ul {
			float: right;
			margin-right: 20px;
		}

		nav ul li {
			display: inline-block;
			line-height: 80px;
			margin: 0 5px;
		}

		nav ul li a {
			color: white;
			font-size: 17px;
			padding: 7px 13px;
			border-radius: 3px;
			text-transform: uppercase;
		}

		a.active, a:hover {
			background: #1b9bff;
			transition: .5s;
		}

		.checkbtn {
			font-size: 30px;
			color: white;
			float: right;
			line-height: 80px;
			margin-right: 40px;
			cursor: pointer;
			display: none;
		}

		#check {
			display: none;
		}

		@media (max-width: 952px) {
			label.logo {
				font-size: 30px;
				padding-left: 50px;
			}

			nav ul li a {
				font-size: 16px;
			}
		}

		@media (max-width: 952px) {
			label.logo {
				font-size: 30px;
				padding-left: 50px;
			}

			nav ul li a {
				font-size: 16px;
			}
		}

		@media (max-width: 858px) {
			.checkbtn {
				display: block;
			}

			ul {
				position: fixed;
				width: 100%;
				height: 100vh;
				background: #2c3e50;
				top: 80px;
				left: -100%;
				text-align: center;
				transition: all .5s;
			}

			nav ul li {
				display: block;
				margin: 50px 0;
				line-height: 30px;
			}

			nav ul li a {
				font-size: 20px;
			}

			a:hover, a.active {
				background: none;
				color: #0082e6;
			}

			#check:checked ~ ul {
				left: 0;
			}
		}

		section {
			background: blue;
		}

	</style>
</head>
<body>

	<nav>
		<input type="checkbox" id="check">
		<label for="check" class="checkbtn">
			<i class="fa fa-bars"></i>
		</label>
		<label class="logo"><i class="fa fa-edit"></i> Absen</label>
		<ul>
			<li>
				<a href=""><i class="fa fa-home"></i> Home</a>
			</li>
			<li>
				<a href="">Absen</a>
			</li>
			<li>
				<a href="">Laporan</a>
			</li>
			<li>
				<a href="">Logout</a>
			</li>
		</ul>
	</nav>

	<section>
		
	</section>

</body>
</html>