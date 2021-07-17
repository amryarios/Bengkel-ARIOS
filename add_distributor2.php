<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}
$username = $_SESSION['username'];

$name = $_POST['name'];

if (!empty($_FILES['name'])) {
	$query = mysqli_query($koneksi,"INSERT INTO distributor VALUES ('','$name','$sop') ") or die (mysqli_error($koneksi));
}
else{
	$query = mysqli_query($koneksi,"INSERT INTO distributor VALUES ('','$name','') ") or die (mysqli_error($koneksi));
}
header("location:distributor.php");
?>