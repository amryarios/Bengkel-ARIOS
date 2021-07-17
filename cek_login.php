<?php 
	include 'koneksi.php';
	session_start();

	$email = $_POST['email'];
	$query = mysqli_query($koneksi,"SELECT * FROM user WHERE (email = '$email' OR username = '$email')") or die (mysqli_error($query));
	$isi = mysqli_fetch_object($query);

	$password = md5($_POST['password']);

	$data = mysqli_query($koneksi,"SELECT * FROM user WHERE (email = '$email' OR username = '$email') AND password = '$password'") or die (mysqli_error($query));
	$row = mysqli_fetch_object($data);

	$cek = mysqli_num_rows($data);

	if ($cek > 0) {
		$username = $row->username;
		$email = $row->email;
		$user_id = $row->user_id;
		$_SESSION['email'] = $email;
		$_SESSION['username'] = $username;
		$_SESSION['user_id'] = $user_id;
		$_SESSION['status'] = "login";
		header("location:catalog.php");
	}
	else{
		header("location:login.php?pesan=gagal");
	}

 ?>