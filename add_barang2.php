<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}
$username = $_SESSION['username'];

$name = $_POST['name'];
$desc = $_POST['desc'];
$amount = $_POST['amount'];
$price = $_POST['price'];
$distributor = $_POST['distributor'];

$query = mysqli_query($koneksi,"INSERT INTO barang VALUES ('','$name','$amount','$price','$desc','$distributor') ") or die (mysqli_error($koneksi));

header("location:catalog.php");
?>