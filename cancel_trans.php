<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}
$username = $_SESSION['username'];

$id = $_GET['id'];

$query2 = mysqli_query($koneksi,"DELETE FROM transaction_detail WHERE trans_id = $id ") or die (mysqli_error($koneksi));
$query = mysqli_query($koneksi,"DELETE FROM transaction WHERE trans_id = $id ") or die (mysqli_error($koneksi));

header("location:transaction.php");
?>