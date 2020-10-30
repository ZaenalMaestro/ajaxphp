<?php
require 'koneksi.php';

$id = $_GET['id'];

$result = mysqli_query($con, "SELECT * FROM identitas WHERE id=$id");
$data = mysqli_fetch_assoc($result);

echo json_encode($data);