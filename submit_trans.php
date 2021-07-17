<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}
$username = $_SESSION['username'];

$id = $_GET['id'];
$total = $_GET['sub_total'];

$query2 = mysqli_query($koneksi,"UPDATE transaction SET total_purchase = '$total' WHERE trans_id = '$id'") or die (mysqli_error($koneksi));

header("location:transaction.php");
?>