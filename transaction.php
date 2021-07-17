<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}

$username = $_SESSION['username'];

$query = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username'") or die (mysqli_error($koneksi));
$query2 = mysqli_query($koneksi,"SELECT * FROM transaction t JOIN user u ON t.user_id = u.user_id") or die (mysqli_error($koneksi));
$row = mysqli_fetch_object($query);

?>

<!DOCTYPE html>
<html>
<head>
	<title> Transaksi </title>
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
						<h5 class="font-weight-bold active">Transaksi</h5>
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
		Transaksi
		<br>
		<?php if ($row->role_id != 1 || $row->role_id != 2): ?>
			<a href="add_data.php?id=<?= $row->user_id ?>">
		  		<button class="button-right" style="vertical-align:middle; padding: 5px; width: auto;">
					<span>Tambah Transaksi</span>
				</button>
		  	</a>
		<?php endif ?>
		<!-- <?php if ($row->role_id != 1 || $row->role_id != 2): ?>
			<a href="laporan.php?id=<?= $row->user_id ?>">
		  		<button class="button-right" style="vertical-align:middle; padding: 5px; width: auto;">
					<span>Cetak</span>
				</button>
		  	</a>
		<?php endif ?> -->
		<?php if ($row->role_id != 1 || $row->role_id != 2): ?>
			<a href="delete_transaction.php?id=<?= $row->user_id ?>">
		  		<button class="button-right" style="vertical-align:middle; padding: 5px; width: auto;">
					<span>Hapus Semua</span>
				</button>
		  	</a>
		<?php endif ?>
	</h3>

	<div class="container" style="margin-right: auto;">
		<table class="table">
			<thead class="thead-dark">
		    	<tr align="center">
		      		<th>No</th>
		      		<th>Nomor Transaksi</th>
				    <th>Total Pembelian</th>
				    <th>Dilayani</th>
		  			<th>Action</th>
		    	</tr>
		  	</thead>
			<?php
			$i = 1;
			$sub_total = 0;
			while($row2 = mysqli_fetch_object($query2)) { 
		  	?>
	  		<tr align="center">
	  			<td> <?= $i ?> </td>
	  			<td><?= $row2->trans_id ?></td>
	  			<td>
					<?php 
						$total = $row2->total_purchase;
						echo "$total";
						$sub_total = $sub_total + $total;
					?>	
				</td>
	  			<td><?= $row2->nick_name ?></td>
	  			<td>
	  				<a href="transaction_detail.php?id=<?= $row2->trans_id ?>">
	  					<button class="button-right my-0" style="vertical-align:middle; width: 80px; font-size: 16px;">
		  					<span>Detail</span>
		  				</button>
	  				</a>
	  			</td>
	  		</tr>
  			<?php $i++; } ?>
  		</table>
		  <h4 class="mt-4" align="right" style="margin-right: 150px;">Total : Rp.<?= $sub_total ?></h4>
	</div>
</body>
</html>