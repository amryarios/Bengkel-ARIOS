<?php 
include 'koneksi.php';
session_start();
if (empty($_SESSION['email'])) {
	header("location:login.php?pesan=belum_login");
}

$username = $_SESSION['username'];

$query = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username'") or die (mysqli_error($koneksi));
$query2 = mysqli_query($koneksi,"SELECT * FROM transaction_detail t JOIN barang d ON t.barang_id = d.barang_id") or die (mysqli_error($koneksi));
$query3 = mysqli_query($koneksi,"SELECT * FROM transaction t JOIN user u ON t.user_id = u.user_id") or die (mysqli_error($koneksi));
$row = mysqli_fetch_object($query);
//Memanggil file FPDF dari file yang anda download tadi
require('fpdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"LAPORAN PENJUALAN",0,10,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"BENGKEL ARIOS",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Tanggal : ".date("m-D-Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
//Tidak berpengaruh dengan database hanya sebagai keterangan pada tabel nantinya
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(7.5, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(5.5, 0.8, 'Jumlah Barang', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Harga Barang', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Total', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
//Panggil tblcomplaints dari database cms
while($row2 = mysqli_fetch_object($query2)) 
while($row3 = mysqli_fetch_object($query3)){ 
//Queri tabel yang ingin ditampilkan
 $pdf->Cell(1, 0.8, $no, 1, 0, 'C');
 $pdf->Cell(7.5, 0.8, $row2->name , 1, 0,'C');
 $pdf->Cell(5.5, 0.8, $row2->amount , 1, 0,'C');
 $pdf->Cell(4.5, 0.8, $row2->price ,1, 0, 'C');
 $pdf->Cell(7, 0.8, $row3->total_purchase,1, 1, 'C');

 $no++;
}
$pdf->ln(1);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(40.5,0.7,"Tanda Tangan",0,10,'C');

$pdf->ln(1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40.5,0.7,"Bengkel ARIOS",0,10,'C');
//Nama file ketika di print
$pdf->Output("laporan_buku.pdf","I");