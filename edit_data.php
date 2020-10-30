<?php

require 'koneksi.php';
$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

mysqli_query($con, "UPDATE identitas SET nama='$nama', alamat='$alamat' WHERE id=$id");
if (mysqli_affected_rows($con) == 1) {
   echo 'berhasil';
}else{
   echo 'gagal';
}