<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}
$username = $_SESSION['username'];

$full_name = $_POST['full_name'];
$nick_name = $_POST['nick_name'];
$email = $_POST['email'];
$username = $_POST['username'];
$jk = $_POST['jk'];
$role = $_POST['role'];
$password = md5($_POST['password']);

if (!empty($_FILES['pas_foto']['name'])) {
	$pas_foto = 'img/PasFoto/'.md5($name).'P.png';
	move_uploaded_file($_FILES['pas_foto']['tmp_name'], $pas_foto);
}
else{
	if ($jk == "L") {
		$pas_foto = 'img/PasFoto/man.png';
	} else if ($jk == "P") {
		$pas_foto = 'img/PasFoto/woman.png';
	}
}
$query = mysqli_query($koneksi,"INSERT INTO user VALUES ('','$full_name','$nick_name','$jk','$email','$username','$password','$pas_foto','$role') ") or die (mysqli_error($koneksi));
header("location:user.php");
?>