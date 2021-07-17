<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}

$username = $_SESSION['username'];

$id = $_POST['id'];
$full_name = $_POST['full_name'];
$nick_name = $_POST['nick_name'];
$password = $_POST['password'];

if (!empty($_FILES['pas_foto']['name'])) {
	$pas_foto = 'img/PasFoto/'.md5($name).'P.png';
	move_uploaded_file($_FILES['pas_foto']['tmp_name'], $pas_foto);
	$query = mysqli_query($koneksi,"UPDATE user SET full_name = '$full_name', nick_name = '$nick_name', password = '$password', pas_foto = '$pas_foto' WHERE user_id = '$id'") or die (mysqli_error($koneksi));
} else{
	$query = mysqli_query($koneksi,"UPDATE user SET full_name = '$full_name', nick_name = '$nick_name', password = '$password' WHERE user_id = '$id'") or die (mysqli_error($koneksi));
}

header("location:profile.php");
?>