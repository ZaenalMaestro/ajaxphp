<?php

require 'koneksi.php';

$keyword = $_GET['keyword'];
$result = mysqli_query($con, "SELECT * FROM identitas WHERE nama LIKE '%$keyword%' OR alamat LIKE '%$keyword%'");

$hasilPencarian = [];
while ($data = mysqli_fetch_assoc($result)) {
   $hasilPencarian[] = $data;
}

echo json_encode($hasilPencarian);