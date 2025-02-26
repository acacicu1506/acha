<?php session_start() ?> 
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="assets/images/logos/dark-logo.svg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <?php include "componen/sidebar.php"; ?>

        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
    <?php include 'componen/navbar.php' ?> 
      <!--  Header Start -->
      
      
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="container-fluid">
          <h2 class="mb-4">Akun Admin</h2>
          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">Tambah jadwal Admin</button>
          <div class="table-responsive">


            <table class="table table-striped">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama Mall</th>
                  <th>Poster</th>
                  <th>Nama Film</th>
                  <th>Total Menit</th>
                  <th>Tanggal Tayang</th>
                  <th>Tanggal Akhir Tayang</th>
                  <th>Jam Tayang 1</th>
                  <th>Jam Tayang 2</th>
                  <th>Jam Tayang 3</th>
                  <th>Studio</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include '../koneksi.php'; // Menghubungkan ke database
                // Query untuk mengambil data film, nama mall, dan poster
                $sql = "SELECT
jadwal_film.id, 
akun_mall.nama_mall, 
film.nama_film, 
film.poster, 
jadwal_film.total_menit, 
jadwal_film.tanggal_tayang, 
jadwal_film.tanggal_akhir_tayang ,
jadwal_film.jam_tayang_1, 
jadwal_film.jam_tayang_2, 
jadwal_film.jam_tayang_3,
jadwal_film.studio
FROM jadwal_film 
JOIN akun_mall ON jadwal_film.mall_id = akun_mall.id
JOIN film ON jadwal_film.film_id = film.id
ORDER BY akun_mall.nama_mall ASC, jadwal_film.id ASC";
                $result = $conn->query($sql);
                // Array untuk menyimpan data film berdasarkan mall
                $filmsByMall = [];
                // Memasukkan data film ke dalam array berdasarkan mall
                while ($row = $result->fetch_assoc()) {
                  $filmsByMall[$row['nama_mall']][] = $row;
                }
                ?>
                INI DI TBODY NYA UNTUK AKUN MALL
                <?php
                $no = 1;
                foreach ($filmsByMall as $mallName => $films) {
                  foreach ($films as $film) {
                    // Debugging: Menampilkan data film
                    // Konversi tanggal ke format DateTime
                    $expired_date = new DateTime($film['tanggal_akhir_tayang']);
                    $current_date = new DateTime();
                    // Debugging: Menampilkan tanggal akhir tayang & tanggal sekarang
                    // Cek apakah sudah kadaluarsa
                    $is_expired = $expired_date < $current_date;
                    echo "<tr " . ($is_expired ? "style='background-color: red 
!important;'" : "") . ">
<td " . ($is_expired ? "style='background-color: red 
!important;'" : "") . " >{$no}</td>
<td " . ($is_expired ? "style='background-color: red 
!important;'" : "") . " >{$film['nama_mall']}</td>
<td " . ($is_expired ? "style='background-color: red 
!important;'" : "") . " ><img src='../{$film['poster']}' alt='Poster' 
width='100'></td>
<td " . ($is_expired ? "style='background-color: red 
!important;'" : "") . " >{$film['nama_film']}</td>
<td " . ($is_expired ? "style='background-color: red 
!important;'" : "") . " >{$film['total_menit']}</td>
<td " . ($is_expired ? "style='background-color: red 
!important;'" : "") . " >{$film['tanggal_tayang']}</td>
<td " . ($is_expired ? "style='background-color: red 
!important;'" : "") . " >{$film['tanggal_akhir_tayang']}</td>
<td " . ($is_expired ? "style='background-color: red 
!important;'" : "") . " >{$film['jam_tayang_1']}</td>
<td " . ($is_expired ? "style='background-color: red 
!important;'" : "") . " >{$film['jam_tayang_2']}</td>
<td " . ($is_expired ? "style='background-color: red 
!important;'" : "") . " >{$film['jam_tayang_3']}</td>
<td " . ($is_expired ? "style='background-color: red 
!important;'" : "") . " >{$film['studio']}</td>
</tr>";
                    $no++;
                  }
                }
                ?>
              </tbody>
            </table>


            <!-- Modal Tambah Akun -->
            <div class="modal fade" id="modalTambahJadwal" tabindex="-1" arialabelledby="modalTambahJadwalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahJadwalLabel">Tambah Jadwal
                      Film</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="formTambahJadwal">
                      <!-- Nama Mall -->
                      <div class="mb-3">
                        <label for="namaMall" class="form-label">Nama Mall</label>
                        <select class="form-select" id="namaMall" name="namaMall"
                          required>
                          <option value="">Pilih Mall</option>
                        </select>
                      </div>
                      <!-- Nama Film -->
                      <div class="mb-3">
                        <label for="namaFilm" class="form-label">Nama Film</label>
                        <select class="form-select" id="namaFilm" name="namaFilm"
                          required>
                          <option value="">Pilih Film</option>
                        </select>
                      </div>
                      <!-- Poster -->
                      <div class="mb-3">
                        <label for="posterFilm" class="form-label">Poster</label>
                        <img id="posterFilm" src="" alt="Poster Film" class="imgthumbnail" style="display: none; max-height: 200px;">
                      </div>
                      <!-- Total Menit -->
                      <div class="mb-3">
                        <label for="totalMenit" class="form-label">Total Menit</label>
                        <input type="text" class="form-control" id="totalMenit"
                          name="totalMenit" readonly>
                      </div>
                      <!-- Tanggal Tayang -->
                      <div class="mb-3">
                        <label for="tanggalTayang" class="form-label">Tanggal
                          Tayang</label>
                        <input type="date" class="form-control" id="tanggalTayang"
                          name="tanggalTayang" required>
                      </div>
                      <!-- Tanggal Akhir Tayang -->
                      <div class="mb-3">
                        <label for="tanggalAkhirTayang" class="form-label">Tanggal Akhir
                          Tayang</label>
                        <input type="date" class="form-control" id="tanggalAkhirTayang"
                          name="tanggalAkhirTayang" required>
                      </div>
                      <!-- Jam Tayang 1 -->
                      <div class="mb-3">
                        <label for="jamTayang1" class="form-label">Jam Tayang 1</label>
                        <input type="time" class="form-control" id="jamTayang1"
                          name="jamTayang1" required>
                      </div>
                      <!-- Jam Tayang 2 -->
                      <div class="mb-3">
                        <label for="jamTayang2" class="form-label">Jam Tayang 2</label>
                        <input type="time" class="form-control" id="jamTayang2"
                          name="jamTayang2">
                      </div>
                      <!-- Jam Tayang 3 -->
                      <div class="mb-3">
                        <label for="jamTayang3" class="form-label">Jam Tayang 3</label>
                        <input type="time" class="form-control" id="jamTayang3"
                          name="jamTayang3">
                      </div>
                      <!-- Pilih Studio -->
                      <div class="mb-3">
                        <label for="studio" class="form-label">Pilih Studio</label>
                        <select class="form-select" id="studio" name="studio" required>
                          <option value="">Pilih Studio</option>
                          <option value="Studio 1">Studio 1</option>
                          <option value="Studio 2">Studio 2</option>
                          <option value="Studio 3">Studio 3</option>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary"
                        id="submitBtn">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
              <script>
            $(document).ready(function () {
            // Fetch mall data
            $.ajax({
            url: 'api.php?endpoint=mall',
            method: 'GET',
            success: function (data) {
            data.forEach(function (mall) {
            $('#namaMall').append(`<option
              value="${mall.id}">${mall.nama_mall}</option>`);
            });
            },
            });
            // Fetch film data
            $.ajax({
            url: 'api.php?endpoint=film',
            method: 'GET',
            success: function (data) {
            data.forEach(function (film) {
            $('#namaFilm').append(`<option
              value="${film.id}">${film.nama_film}</option>`);
            });
            },
            });
            // Handle film selection
            $('#namaFilm').change(function () {
            const filmId = $(this).val();
            if (filmId) {
            $.ajax({
            url: `api.php?endpoint=film_detail&id=${filmId}`,
            method: 'GET',
            success: function (film) {
            $('#posterFilm').attr('src', `../${film.poster}`).show();
            $('#totalMenit').val(film.total_menit);
            },
            error: function () {
            $('#posterFilm').hide().attr('src', '');
            $('#totalMenit').val('');
            },
            });
            } else {
            $('#posterFilm').hide().attr('src', '');
            $('#totalMenit').val('');
            }
            });
            // Handle form submission
            $('#formTambahJadwal').submit(function (e) {
            e.preventDefault();
            // Get form data
            const formData = $(this).serialize();
            // Send data to server
            $.ajax({
            url: 'api.php?endpoint=tambah_jadwal',
            method: 'POST',
            data: formData,
            success: function (response) {
            if (response.success) {
            // Show SweetAlert2 on success
            Swal.fire({
            title: 'Berhasil!',
            text: 'Jadwal Film berhasil disimpan!',
            icon: 'success',
            confirmButtonText: 'OK',
            }).then((result) => {
            if (result.isConfirmed) {
            // Redirect to jadwal.php
            window.location.href = 'jadwal_film.php';
            }
            });
            } else {
            // Show SweetAlert2 on failure
            Swal.fire({
            title: 'Gagal!',
            text: 'Gagal menyimpan jadwal film.',
            icon: 'error',
            confirmButtonText: 'OK',
            });
            }
            },
            error: function () {
            Swal.fire({
            title: 'Terjadi kesalahan!',
            text: 'Tidak dapat menyimpan jadwal film.',
            icon: 'error',
            confirmButtonText: 'OK',
            });
            },
            });
            });
            });
            </script>
            <script src="assets/libs/jquery/dist/jquery.min.js"></script>
            <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <script src="assets/js/sidebarmenu.js"></script>
            <script src="assets/js/app.min.js"></script>
            <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
            <script src="assets/libs/simplebar/dist/simplebar.js"></script>
            <script src="assets/js/dashboard.js"></script>
</body>

</html>