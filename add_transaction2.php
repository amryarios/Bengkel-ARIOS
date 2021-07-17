<?php 

include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}

$trans_id = $_POST['trans_id'];
$barang = $_POST['barang'];
$amount = $_POST['amount'];

$query = mysqli_query($koneksi,"SELECT * FROM transaction_detail WHERE (trans_id = '$trans_id' AND barang_id = '$barang')") or die (mysqli_error($koneksi));
$cek = mysqli_num_rows($query);
$row = mysqli_fetch_object($query);
if ($cek > 0) {
	$awal = $row->amounts;
	$detail_trans_id = $row->detail_trans_id;
	$awal = $awal + $amount;
	$query2 = mysqli_query($koneksi,"UPDATE transaction_detail SET amounts = '$awal' WHERE detail_trans_id = '$detail_trans_id'") or die (mysqli_error($koneksi));
} else {
	$query2 = mysqli_query($koneksi,"INSERT INTO transaction_detail VALUES ('','$barang','$amount','$trans_id') ") or die (mysqli_error($koneksi));
	$query3 = mysqli_query($koneksi,"UPDATE transaction SET cek = 1 WHERE trans_id = '$trans_id'") or die (mysqli_error($koneksi));
}

header("location:add_transaction.php?id=$trans_id");

?>