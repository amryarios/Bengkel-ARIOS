<!DOCTYPE html>
<html>
<head>
	<title>Login Bengkel ARIOS</title>
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> -->
	<link rel="shortcut icon" href="img/ui/Icon.png">
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body class="login text">
	<div class="container">
		<div class="row">
			<div class="col-6"></div>
			<div class="col-6 margint">
				<h3 class="text-bold judul">
				<a href="home.php"></a>Bengkel ARIOS</h3>
				<center>
					<?php
					if (isset($_GET['pesan'])) {
						if ($_GET['pesan'] == "gagal") {
							echo "Login gagal! Username dan password salah!";
						}
						else if ($_GET['pesan'] == "logout") {
							echo "Anda telah berhasil logout.";
						}
						else if ($_GET['pesan'] == "belum_login") {
							echo "Anda harus login untuk mengakses halaman selanjutnya!";
						}
					}
					?>
				</center>
				<hr size="5%" noshade width="75%">
				<form method="POST" action="cek_login.php">
				 	<div class="form-group row">
				    	<label class="col-sm-3 col-form-label">Email</label>
				    	<div class="col-sm-9">
				      		<input type="text" name="email" placeholder="Masukkan E-mail atau Username"class="form-control">
				    	</div>
				  	</div>
				  	<div class="form-group row">
				    	<label class="col-sm-3 col-form-label">Password</label>
				    	<div class="col-sm-9">
				      		<input type="password" name="password" placeholder="Masukkan Password" class="form-control">
				    	</div>
				  	</div>
				  	<center>
					  	<button type="submit" class="button-right" style="vertical-align:middle">
							<span>Masuk</span>
						</button>
				  	</center>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>