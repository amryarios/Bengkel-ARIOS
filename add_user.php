<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}

$username = $_SESSION['username'];

$query = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username'") or die (mysqli_error($koneksi));
$row = mysqli_fetch_object($query);

?>

<!DOCTYPE html>
<html>
<head>
	<title> Tambah User </title>
	<link rel="shortcut icon" href="img/ui/Icon.png">
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div class="px-5">
		<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
			<a class="navbar-brand" href="home.php">
				<h3 class="font-weight-bold" style="color: #9597B5;">
					<img class="mx-auto rounded-circle" src="img/ui/Icon.png" width="50px" height="50px">
					 Bengkel ARIOS
				</h3>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-item nav-link active mx-4" href="catalog.php">
						<h5 class="font-weight-bold awal">Stok Barang</h5>
					</a>
					<?php if ($row->role_id == 1) {?>
					<a class="nav-item nav-link mr-4" href="distributor.php">
						<h5 class="font-weight-bold awal">Distributor</h5>
					</a>
					<a class="nav-item nav-link mr-4" href="user.php">
						<h5 class="font-weight-bold active">User</h5>
					</a>
					<?php } ?>
					<a class="nav-item nav-link mr-4" href="transaction.php">
						<h5 class="font-weight-bold awal">Transaction</h5>
					</a>
					<a class="nav-item nav-link" href="profile.php" style="color: #9597B5;">
						<img class="mx-auto rounded-circle" src="<?= $row->pas_foto ?>" width="40px" height="40px">
					</a>
					<a href="profile.php" class="nav-item nav-link">
						<h5 class="font-weight-bold awal">Hi, <?= $_SESSION['username'] ?></h5>		
					</a>
					<a class="nav-item nav-link" href="logout.php" style="size: 10px;">
						<h5 class="font-weight-bold awal">Keluar</h5>
					</a>
				</div>
			</div>
			</nav>
	</div>

	<h3 class="text-bold judul">
		<a href="user.php">
	  		<button class="button-left" style="vertical-align:middle; padding: 5px; width: auto;">
				<span>Batal</span>
			</button>
	  	</a>
		Tambah User
	</h3>

	<div class="container" style="margin-right: auto;">
		<form method="POST" action="add_user2.php" enctype="multipart/form-data">
		 	<div class="form-group row">
		    	<label class="col-sm-2 col-form-label">Nama Lengkap</label>
		    	<div class="col-sm-4">
		      		<input type="text" name="full_name" class="form-control" required>
		    	</div>

		    	<label class="col-sm-2 col-form-label"><center>Nama Panggilan</center></label>
		    	<div class="col-sm-4">
		      		<input type="text" name="nick_name" class="form-control" required>
		    	</div>
		  	</div>
		  	<div class="form-group row">
		    	<label class="col-sm-2 col-form-label">E-mail</label>
		    	<div class="col-sm-4">
		      		<input type="text" name="email" class="form-control" required>
		    	</div>

		    	<label class="col-sm-2 col-form-label"><center>Username</center></label>
		    	<div class="col-sm-4">
		      		<input type="text" name="username" class="form-control" required>
		    	</div>
		  	</div>
		  	<div class="form-group row">
		  		<label class="col-sm-2 col-form-label">Pas Foto</label>
		    	<div class="col-sm-2">
		      		<input type="file" name="pas_foto" accept="image/*">
		    	</div>

		    	<label class="col-sm-2 col-form-label"><center>Jenis Kelamin</center></label>
		    	<div class="col-sm-2">
		      		<select class="custom-select" name="jk" required>
			        	<option selected disabled>Select</option>
			        	<option value="L">Laki-Laki</option>
			        	<option value="P">Perempuan</option>
			        </select>
		    	</div>

				<label class="col-sm-2 col-form-label"><center>Bagian</center></label>
		    	<div class="col-sm-2">
		      		<select class="custom-select" name="role" required>
			        	<option selected disabled>Pilih</option>
			        	<option value="2">Montir Barang</option>
			        	<option value="3">Montir</option>
			        </select>
		    	</div>
		  	</div>
		  	<div class="form-group row">
		    	<label class="col-sm-2 col-form-label">Password</label>
		    	<div class="col-sm-10">
		      		<input type="password" name="password" class="form-control" required>
		    	</div>
		  	</div>
		  	<center>
			  	<button type="submit" class="button-right" style="vertical-align:middle">
					<span>Tambah</span>
				</button>
		  	</center>
		</form>
	</div>
</body>
</html>