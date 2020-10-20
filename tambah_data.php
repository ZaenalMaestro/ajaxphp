<?php
require 'koneksi.php';

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
mysqli_query($con, "INSERT INTO identitas (nama, alamat) VALUES ('$nama', '$alamat')");
if (mysqli_affected_rows($con) == 1) {
   echo 'berhasil';
}else{
   echo 'gagal';
}