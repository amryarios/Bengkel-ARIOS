<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}
$username = $_SESSION['username'];

$id = $_POST['id'];
$role = $_POST['role'];

$query = mysqli_query($koneksi,"UPDATE user SET role_id = '$role' WHERE user_id = '$id'") or die (mysqli_error($koneksi));

header("location:user.php");
?>