<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}

$id = $_GET['id'];
$username = $_SESSION['username'];

$query = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username'") or die (mysqli_error($koneksi));
$row = mysqli_fetch_object($query);
$query2 = mysqli_query($koneksi,"SELECT * FROM barang") or die (mysqli_error($koneksi));
$query3 = mysqli_query($koneksi,"SELECT * FROM transaction WHERE trans_id = '$id'") or die (mysqli_error($koneksi));
$row3 = mysqli_fetch_object($query3);
$check = $row3->cek;
?>

<!DOCTYPE html>
<html>
<head>
	<title> Tambah Barang </title>
	<link rel="shortcut icon" href="img/ui/Icon.png">
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<script type="text/javascript" src="style/jquery-3.5.0.min.js"></script>
	<script type="text/javascript" src="style/bootstrap.js"></script>
	<script>
    if (<?= $check ?> == 1) {
    	$(document).ready(function(){
	        $("#myModal").modal('show');
	    });
    }
	</script>
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
		<a href="cancel_trans.php?id=<?= $id ?>">
	  		<button class="button-left" style="vertical-align:middle; padding: 5px; width: auto;">
				<span>Batal</span>
			</button>
	  	</a>
		Tambah Transaksi
	</h3>

	<div class="container" style="margin-right: auto;">
		<form method="POST" action="add_transaction2.php">
			<input type="hidden" name="trans_id" value="<?= $id ?>">
		  	<div class="form-group row">
		    	<label class="col-sm-2 col-form-label">Barang</label>
		    	<div class="col-sm-6">
			      	<select class="custom-select" name="barang" required>
			        	<option selected disabled>Select</option>
			        	<?php while($row2 = mysqli_fetch_object($query2)) { ?>
			        	<option value="<?= $row2->barang_id ?>"><?= $row2->name ?></option>
			        	<?php } ?>
			        </select>
		    	</div>

		    	<label class="col-sm-2 col-form-label">Jumlah Barang</label>
		    	<div class="col-sm-2">
		      		<input type="number" name="amount" class="form-control" required>
		    	</div>
		  	</div>
		  	<center>
			  	<button type="submit" class="button-right" style="vertical-align:middle" data-toggle = "modal" data-target = "#myModal">
					<span>Tambah</span>
				</button>
		  	</center>
		</form>
	</div>
	<!-- Modal -->
	<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
	   aria-labelledby = "myModalLabel" aria-hidden = "true">
	   
	   <div class = "modal-dialog">
	      <div class = "modal-content">
	         
	         <div class = "modal-header">
	            <h4 class = "modal-title" id = "myModalLabel">
	               Tambah Transaksi
	            </h4>

	            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
	                  &times;
	            </button>
	         </div>
	         
	         <div class = "modal-body">
	            Apakah ada lagi yang ingin dibeli?
	         </div>
	         
	         <div class = "modal-footer">
	            <button type = "button" class = "btn btn-primary" data-dismiss = "modal">
	               Ya
	            </button>
	            
	            <a href="keranjang.php?id=<?= $id ?>">
	            	<button type = "button" class = "btn btn-danger" >
		               Tidak
		            </button>
	            </a>
	         </div>
	         
	      </div><!-- /.modal-content -->
	   </div><!-- /.modal-dialog -->
	  
	</div><!-- /.modal -->
</body>
</html>