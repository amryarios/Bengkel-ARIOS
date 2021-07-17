<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}

$username = $_SESSION['username'];

$query = mysqli_query($koneksi,"SELECT * FROM user u") or die (mysqli_error($koneksi));
$row = mysqli_fetch_object($query);
$query2 = mysqli_query($koneksi,"SELECT * FROM role r JOIN user u ON r.role_id = u.role_id") or die (mysqli_error($koneksi));

?>

<!DOCTYPE html>
<html>
<head>
	<title> User </title>
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
		User
		<a href="add_user.php">
	  		<button class="button-right" style="vertical-align:middle; padding: 5px; width: auto;">
				<span>Tambah User</span>
			</button>
	  	</a>
	</h3>

	<div style="margin-left: 50px; margin-right: 50px;">
		<table class="table">
		<thead class="thead-dark">
	    	<tr align="center">
	      		<th>No</th>
	      		<th>Nama Lengkap</th>
	      		<th>Nama Panggilan</th>
	      		<th>Jenis Kelamin</th>
	      		<th>E-mail</th>
	      		<th>Username</th>
			    <th>Bagian</th>
	  			<th>Action</th>
	    	</tr>
	  	</thead>
	<?php
	$i = 1;
	while($row2 = mysqli_fetch_object($query2)) { 
  	?>
  		<tr align="center">
  			<td> <?= $i ?> </td>
  			<td><?= $row2->full_name ?></td>
  			<td><?= $row2->nick_name ?></td>
  			<td><?= $row2->jenis_kelamin ?></td>
  			<td><?= $row2->email ?></td>
  			<td><?= $row2->username ?></td>
  			<td><?php if ($row2->role_id == 1) { ?>
  				Owner
  			<?php } elseif ($row2->role_id == 2) { ?>
  				Montir
  			<?php } ?>
  			</td>
  			<td>
  				<a href="edit_user.php?id=<?= $row2->user_id ?>">
  					<button class="button-right my-0" style="vertical-align:middle; width: 75px; font-size: 16px;">
	  					<span>Ubah</span>
	  				</button>
  				</a>
  				<a href="delete_user.php?id=<?= $row2->user_id ?>">
  					<button class="button-right my-0" style="vertical-align:middle; width: 80px; font-size: 16px;">
	  					<span>Hapus</span>
	  				</button>
  				</a>
  			</td>
  		</tr>
  	<?php $i++; } ?>
  	</table>
	</div>
</body>
</html>