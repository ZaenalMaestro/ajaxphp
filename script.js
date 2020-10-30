window.onload = tampilBiodata();
// ketika tombol hapus atau edit diklik
document.querySelector('#biodata').addEventListener('click', function (e) {
   if (e.target.className == 'hapus') {
      hapusData(e.target.getAttribute('data-id'));
   } else if (e.target.className == 'edit') {      
      document.querySelector('.popup').classList.toggle('active');
      getDataBerdasarkanId(e.target.getAttribute('data-id'));      
   }
});

// ketika tombol close popup diklik
document.querySelector('.tombol-close').addEventListener('click', function () {
   document.querySelector('.popup').classList.toggle('active');   
});

// ketika tombol tambah data diklik
document.getElementById('btn-tambah-data').addEventListener('click', tambahData);

// ketika tombol edit data diklik
document.querySelector('.edit-data').addEventListener('click', editData);

// fungsi Edit Data
function editData() {
   let id = document.getElementById('id');
   let nama = document.getElementById('edit-nama');
   let alamat = document.getElementById('edit-alamat');
   let params = "id=" + id.value + "&nama=" + nama.value + "&alamat=" + alamat.value;

   let xhr = new XMLHttpRequest;
   xhr.open('POST', 'edit_data.php');
   xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
   xhr.onload = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
         let pesan = xhr.responseText;
         if (pesan == 'berhasil') {            
            alert('Data Berhasil DiUbah !');
            tampilBiodata();
         } else {
            alert('Data Gagal Diubah !');
         }
      }
   }
   xhr.send(params);

}

// mengambil data berdasarkan id dan tampilkan kedalam popup
function getDataBerdasarkanId(id) {
   const xhr = new XMLHttpRequest;
   xhr.open('GET', 'get_data_by_id.php?id=' + id);
   xhr.onload = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
         let data = JSON.parse(xhr.responseText);
         document.getElementById('id').value = data.id;
         document.getElementById('edit-nama').value = data.nama;
         document.getElementById('edit-alamat').value = data.alamat;
      }
   }
   xhr.send();
}
//menampilkan data kedalam tabel
function tampilBiodata() {
   let xhr = new XMLHttpRequest;
   xhr.open('GET', 'get_data.php');
   xhr.onload = function () {
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
   xhr.onload = function () {
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
      xhr.onload = function () {
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