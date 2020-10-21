<?php

require 'koneksi.php';
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM identitas WHERE id=$id");
if (mysqli_affected_rows($con) == 1) {
   echo 'berhasil';
}else{
   echo 'gagal';
}