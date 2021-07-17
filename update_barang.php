<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}
$username = $_SESSION['username'];

$id = $_POST['id'];
$name = $_POST['name'];
$desc = $_POST['desc'];
$amount = $_POST['amount'];
$price = $_POST['price'];
$distributor = $_POST['distributor'];

$query = mysqli_query($koneksi,"UPDATE barang SET name = '$name', description = '$desc', amount = '$amount', price = '$price' WHERE barang_id = '$id'") or die (mysqli_error($koneksi));

header("location:catalog.php");
?>