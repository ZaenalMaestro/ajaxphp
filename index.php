<!DOCTYPE html>
<html lang="en">

<head>

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
   <a href="#" class="tes" data-id="1">Tes</a>
   <a href="#" class="tes" data-id="2">Tes</a>
   <a href="#" class="tes" data-id="3">Tes</a>

   <script>
      window.onload = tampilBiodata();
      // ketika tombol hapus diklik
      document.querySelector('#biodata').addEventListener('click', hapusData);
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
                     '<td><a href="#" class="hapus" data-id="' + biodata[index]['id'] + '">Hapus</a></td>' +
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
      function hapusData(e) {
         if (e.target.className == 'hapus') {
            let id = e.target.getAttribute('data-id');
            console.log(id);

         }
      }
   </script>
</body>

</html>