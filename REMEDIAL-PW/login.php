<html>
	<head>
		<title>Login Your Account</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="css/menu.css"/>
		<link rel="stylesheet" href="css/main.css"/>
		<link rel="stylesheet" href="css/font.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
    <body>
	    <div class="background"></div>
	    <div class="backdrop"></div>
        <div class="login-form-container" id="login-form">
            <div class="login-form-content">
                <div class="login-form-header">
                    <h3>Login ke akun Anda</h3>
                </div>
                <form action="#" class="login-form">
                    <div class="input-container">
                        <i class="fa fa-envelope"></i>
                        <input type="text" id="username" class="input" name="username" placeholder="Username">
                    </div>
                    <div class="input-container">
                        <i class="fa fa-lock"></i>
                        <input type="password"  id="password" class="input" name="password" placeholder="Password"/>
                    </div>
                    <input type="button" value="Login" class="button" onclick="login()" style="text-align: center;">
                </form>
            </div>
        </div>

        <script>

        function login() {

        let username = document.getElementById('username').value;
        let password = document.getElementById('password').value;

            if(username != '' && password !=''){

                let data = { username : username, password : password};
                let xhttp = new XMLHttpRequest();

                xhttp.open("POST", "proses_login.php", true);


                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        let response = this.responseText;
                        if(response == 1){
                            alert("Berhasil Login");

                            window.location.replace('index.php');

                    } else {
                        alert("Gagal Login");

                        document.getElementById("username").value = "";
                        document.getElementById("password").value = "";
                    }
                }
            }

            xhttp.setRequestHeader("Content-Type", "application/json");
            xhttp.send(JSON.stringify(data));
            } else {
                alert("Data Tidak Boleh Kosong");
            }
        }

        </script>
</body>
</html>