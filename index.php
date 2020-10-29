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
            <!-- bagian input nama -->
            <label for="nama">Nama</label>
            <input type="text" id="nama">
            <!-- end bagian input nama -->

            <!-- input alamat -->
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat">
            <!-- end input alamat -->

            <!-- tombol edit data -->
            <button type="button">Edit Data</button>
            <!-- end tombol edit data -->
         </form>
         <!-- end form -->
      </div>
   </div>
   <!-- end popup -->

   <script>
      window.onload = tampilBiodata();
      // ketika tombol hapus atau edit diklik
      document.querySelector('#biodata').addEventListener('click', function(e) {
         if (e.target.className == 'hapus') {
            hapusData(e.target.getAttribute('data-id'));
         } else if (e.target.className == 'edit') {
            e.classList.toggle('active');
         }

      });
      // ketika tombol tambah data diklik
      document.getElementById('btn-tambah-data').addEventListener('click', tambahData);
      //menampilkan data kedalam tabel
      function tampilBiodata() {
         let xhr = new XMLHttpRequest;
         xhr.open('GET', 'get_data.php');
         xhr.onload = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
               let biodata = JSON.parse(xhr.responseText);
               console.log(biodata);

               let tabel = '';
               let nomor = 1;

               for (index in biodata) {
                  tabel += '<tr>' +
                     '<td>' + nomor + '</td>' +
                     '<td>' + biodata[index]['nama'] + '</td>' +
                     '<td>' + biodata[index]['alamat'] + '</td>' +
                     '<td><button typen="button" class="hapus" data-id="' + biodata[index]['id'] + '">Hapus</button>' +
                     '<button typen="button" class="edit" data-id="' + biodata[index]['id'] + '">Edit</button></td<button>' +
                     '</tr>';
                  nomor++;
               }
               document.getElementById('biodata').innerHTML = tabel;
            }
         }
         xhr.send();
      }

      // menambahkan data
      function tambahData() {
         let nama = document.getElementById('nama');
         let alamat = document.getElementById('alamat');
         let params = "nama=" + nama.value + "&alamat=" + alamat.value;

         let xhr = new XMLHttpRequest;
         xhr.open('POST', 'tambah_data.php');
         xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
         xhr.onload = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
               let pesan = xhr.responseText;
               if (pesan == 'berhasil') {
                  alert('Data Berhasil Ditambahkan !');
                  tampilBiodata();
                  nama.value = '';
                  alamat.value = '';
               } else {
                  alert('Data Gagal Ditambahkan !');
               }

            }
         }
         xhr.send(params);
      }

      // hapus data
      function hapusData(id) {
         if (confirm('yakin hapus data ?') == true) {
            let xhr = new XMLHttpRequest;
            xhr.open('GET', 'hapus_data.php?id=' + id);
            xhr.onload = function() {
               if (xhr.readyState == 4 && xhr.status == 200) {
                  let pesan = xhr.responseText;
                  if (pesan == 'berhasil') {
                     tampilBiodata();
                     alert('Data berhasil dihapus !');
                  } else {
                     alert('Data gagal dihapus !');
                  }
               }
            }
            xhr.send();
         }
      }
   </script>
</body>

</html>