<?php 

include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}

$id = $_GET['id'];

$query = mysqli_query($koneksi,"INSERT INTO transaction VALUES ('','','$id','0') ") or die (mysqli_error($koneksi));

$query2 = mysqli_query($koneksi,"SELECT * FROM transaction ORDER BY trans_id DESC LIMIT 1") or die (mysqli_error($koneksi));
$row = mysqli_fetch_object($query2);

header("location:add_transaction.php?id=$row->trans_id");

?>