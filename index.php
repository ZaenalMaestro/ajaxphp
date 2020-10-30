<!DOCTYPE html>
<html lang="en">

<head>
   <link rel="stylesheet" href="style.css">
   <title>Biodata</title>
</head>

<body>
   <h1>Biodata</h1>
   <!-- menambahkan data -->
   <form method="post">
      <input type="text" name="nama" id="nama" placeholder="masukkan nama..."><br>
      <input type="text" name="alamat" id="alamat" placeholder="masukkan alamat..."><br>
      <button type="button" id="btn-tambah-data">Tambah Data</button>
   </form>
   <table border="1" cellspacing="0" cellpadding="10">
      <thead>
         <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody id="biodata"></tbody>
   </table>

   <!-- popup -->
   <div class="popup">
      <!-- bayangan -->
      <div class="bayangan"></div>
      <!-- end bayangan-->
      <div class="konten-popup">
         <!-- tombol close -->
         <div class="tombol-close">&times;</div>
         <!-- end tombol close -->

         <!-- form -->
         <form method="post">
            <!-- menampilkan id -->
            <input type="hidden" id="id">
            <!-- bagian input nama -->
            <label for="nama">Nama</label>
            <input type="text" id="edit-nama">
            <!-- end bagian input nama -->

            <!-- input alamat -->
            <label for="alamat">Alamat</label>
            <input type="text" id="edit-alamat">
            <!-- end input alamat -->

            <!-- tombol edit data -->
            <button type="button" class="edit-data">Edit Data</button>
            <!-- end tombol edit data -->
         </form>
         <!-- end form -->
      </div>
   </div>
   <!-- end popup -->

   <!-- script.js -->
   <script src="script.js"></script>
</body>

</html>