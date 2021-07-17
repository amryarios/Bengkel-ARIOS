<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}

$username = $_SESSION['username'];

$query = mysqli_query($koneksi,"SELECT * FROM role r JOIN user u ON r.role_id = u.role_id WHERE u.username = '$username'") or die (mysqli_error($koneksi));
$row = mysqli_fetch_object($query);

?>

<!DOCTYPE html>
<html>
<head>
	<title> Profile </title>
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
						<h5 class="font-weight-bold awal">User</h5>
					</a>
					<?php } ?>
					<a class="nav-item nav-link mr-4" href="transaction.php">
						<h5 class="font-weight-bold awal">Transaction</h5>
					</a>
					<a class="nav-item nav-link" href="profile.php" style="color: #9597B5;">
						<img class="mx-auto rounded-circle" src="<?= $row->pas_foto ?>" width="40px" height="40px">
					</a>
					<a href="profile.php" class="nav-item nav-link">
						<h5 class="font-weight-bold active">Hi, <?= $_SESSION['username'] ?></h5>		
					</a>
					<a class="nav-item nav-link" href="logout.php" style="size: 10px;">
						<h5 class="font-weight-bold awal">Keluar</h5>
					</a>
				</div>
			</div>
			</nav>
	</div>

	<h3 class="text-bold judul">
		Profile
		<a href="edit_profile.php?id=<?= $row->user_id ?>">
	  		<button class="button-right" style="vertical-align:middle; padding: 5px; width: auto;">
				<span>Ubah Profile</span>
			</button>
	  	</a>
	</h3>
	<center>
		<img class="rounded-circle" src="<?= $row->pas_foto ?>" width="180px">
	</center>
	<div class="container" style="margin-right: auto; margin-top: 30px;">
		<form>
		 	<div class="form-group row">
		    	<label class="col-sm-2 col-form-label">Nama Lengkap</label>
		    	<div class="col-sm-4">
		      		<input type="text" class="form-control" value="<?= $row->full_name ?>" readonly>
		    	</div>

		    	<label class="col-sm-2 col-form-label"><center>Nama Panggilan</center></label>
		    	<div class="col-sm-4">
		      		<input type="text" class="form-control" value="<?= $row->nick_name ?>" readonly>
		    	</div>
		  	</div>
		  	<div class="form-group row">
		    	<label class="col-sm-2 col-form-label">E-mail</label>
		    	<div class="col-sm-4">
		      		<input type="text" class="form-control" value="<?= $row->email ?>" readonly>
		    	</div>

		    	<label class="col-sm-2 col-form-label"><center>Username</center></label>
		    	<div class="col-sm-4">
		      		<input type="text" class="form-control" value="<?= $row->username ?>" readonly>
		    	</div>
		  	</div>
		  	<div class="form-group row">
		    	<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
		    	<div class="col-sm-4">
		      		<input type="text" class="form-control" value="<?= $row->jenis_kelamin ?>" readonly>
		    	</div>

				<label class="col-sm-2 col-form-label"><center>Bagian</center></label>
		    	<div class="col-sm-4">
		      		<input type="text" class="form-control" value="<?= $row->role_details ?>" readonly>
		    	</div>
		  	</div>
		</form>
	</div>
</body>
</html>