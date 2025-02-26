
<?php session_start() ?> 

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
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
        <?php include "componen/sidebar.php";?> 
       
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
    <?php include "componen/navbar.php";?> 
      <!--  Header Start -->
     
       
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="container-fluid">
    <h2 class="mb-4">Akun Admin</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahAkunModal">Tambah Akun</button>
    <div class="table-responsive">
    <?php 
include '../koneksi.php'; // File koneksi database

// Query untuk mengambil semua data dari tabel 'film'
$query = mysqli_query($conn, "SELECT * FROM film");
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>NO</th>
            <th>Poster</th>
            <th>Nama Film</th>
            <th>Deskripsi</th>
            <th>Genre</th>
            <th>Total Menit</th>
            <th>Usia</th>
            <th>Dimensi</th>
            <th>Producer</th>
            <th>Director</th>
            <th>Writter</th>
            <th>Cast</th>
            <th>Distributor</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        while($data = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><img src="../<?php echo $data['poster']; ?>" width="100"></td>
                <td><?php echo $data['nama_film']; ?></td>
                <td><?php echo $data['judul']; ?></td>
                <td><?php echo $data['total_menit']; ?></td>
                <td><?php echo $data['usia']; ?> Menit</td>
                <td><?php echo $data['genre']; ?>+</td>
                <td><?php echo $data['dimensi']; ?></td>
                <td><?php echo $data['Producer']; ?></td>
                <td><?php echo $data['Director']; ?></td>
                <td><?php echo $data['Writer']; ?></td>
                <td><?php echo $data['Cast']; ?></td>
                <td><?php echo $data['Distributor']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!--tambah film-->
<div class="modal fade" id="tambahAkunModal" tabindex="-1" role="dialog" aria-labelledby="tambahAkunModalLabel" aria-hidden="true" style="color: black;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="tambahAkunModalLabel">Tambah Akun Admin</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container py-4">
                <form action="../proses_input.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="poster" class="form-label">Upload Poster</label>
                        <input type="file" id="poster" name="poster" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="nama_film" class="form-label">Nama Film</label>
                        <input type="text" id="nama_film" name="nama_film" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="genre" class="form-label">Genre</label>
                        <select id="genreSelect" class="form-control">
                            <option value="" disabled selected>Pilih Genre</option>
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Animation">Animation</option>
                            <option value="Biography">Biography</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Crime">Crime</option>
                            <option value="Disaster">Disaster</option>
                            <option value="Documentary">Documentary</option>
                            <option value="Drama">Drama</option>
                            <option value="Epic">Epic</option>
                            <option value="Erotic">Erotic</option>
                            <option value="Eksperimental">Eksperimental</option>
                            <option value="Family">Family</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Film-Noir">Film-Noir</option>
                            <option value="History">History</option>
                            <option value="Horror">Horror</option>
                            <option value="Martial Arts">Martial Arts</option>
                            <option value="Music">Music</option>
                            <option value="Musical">Musical</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Political">Political</option>
                            <option value="Psychological">Psychological</option>
                            <option value="Romance">Romance</option>
                            <option value="Sci-Fi">Sci-Fi</option>
                            <option value="Sport">Sport</option>
                            <option value="Superhero">Superhero</option>
                            <option value="Survival">Survival</option>
                            <option value="Thriller">Thriller</option>
                            <option value="War">War</option>
                            <option value="Western">Western</option>
                        </select>
                        <button type="button" class="btn btn-outline-secondary mt-2" onclick="addGenre()">Tambah</button>
                    </div>

                    <ul id="selectedGenres" class="mt-3 list-group mb-3"></ul>
                    <input type="hidden" id="genreInput" name="genre">

                    <div class="form-group mb-3">
                        <label for="banner" class="form-label">Upload Banner</label>
                        <input type="file" id="banner" name="banner" accept="image/*" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="menit" class="form-label">Total Menit</label>
                        <input type="text" id="menit" name="menit" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="usia" class="form-label">Usia</label>
                        <select id="usia" name="usia" required class="form-control">
                            <option value="" disabled selected>Pilih Usia</option>
                            <option value="13">13</option>
                            <option value="17">17</option>
                            <option value="SU">SU</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="trailer" class="form-label">Upload Trailer</label>
                        <input type="file" id="trailer" name="trailer" accept="video/*" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="judul" class="form-label">Deskripsi</label>
                        <input type="text" id="judul" name="judul" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="dimensi" class="form-label">Dimensi</label>
                        <select id="dimensi" name="dimensi" required class="form-control">
                            <option value="2D">2D</option>
                            <option value="3D">3D</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="producer" class="form-label">Producer</label>
                        <input type="text" id="producer" name="producer" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="director" class="form-label">Director</label>
                        <input type="text" id="director" name="director" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="writter" class="form-label">Writer</label>
                        <input type="text" id="writter" name="writter" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="cast" class="form-label">Cast</label>
                        <input type="text" id="cast" name="cast" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="distributor" class="form-label">Distributor</label>
                        <input type="text" id="distributor" name="distributor" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="harga" class="form-label">Harga Per Tiket</label>
                        <input type="text" id="harga" name="harga" required class="form-control">
                    </div>

                    <div class="form-footer text-center">
                        <button type="submit" class="btn btn-primary px-4 py-2">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        const selectedGenres = new Set();

        function addGenre() {
            const genreSelect = document.getElementById('genreSelect');
            const selectedValue = genreSelect.value;

            if (selectedValue && !selectedGenres.has(selectedValue)) {
                selectedGenres.add(selectedValue);

                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.textContent = selectedValue;

                const removeBtn = document.createElement('button');
                removeBtn.className = 'btn btn-sm btn-danger';
                removeBtn.textContent = 'Hapus';
                removeBtn.onclick = () => {
                    selectedGenres.delete(selectedValue);
                    listItem.remove();
                    updateHiddenInput();
                };

                listItem.appendChild(removeBtn);
                document.getElementById('selectedGenres').appendChild(listItem);

                updateHiddenInput();
            }

            genreSelect.value = '';
        }

        function updateHiddenInput() {
            document.getElementById('genreInput').value = Array.from(selectedGenres).join(',');
        }
    </script>

       
       
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
</body>

</html>