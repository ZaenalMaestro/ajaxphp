<?php
require 'koneksi.php';

$result = mysqli_query($con, "SELECT * FROM identitas");

while ($data = mysqli_fetch_assoc($result)) {
   $daftarBiodata[] = $data;
}

echo json_encode($daftarBiodata);