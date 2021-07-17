<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "bengkelariosdb";

$koneksi = mysqli_connect($host, $user, $pass, $database);

if ($koneksi->connect_error) {
	exit();
	die('maaf koneksi gagal : ' . $koneksi->error);
}