
<?php
// Menyertakan autoloader Composer
require '../vendor/autoload.php'; // Pastikan pathnya sesuai dengan struktur project Anda
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
// Inisialisasi variabel untuk menyimpan input
$name = '';
$email = '';
$password = '';
if (isset($_POST['send_otp'])) {
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
// Simpan password di session
$_SESSION['password'] = $password;
// Generate OTP
$otp = rand(100000, 999999);
$_SESSION['otp'] = $otp;
$_SESSION['email'] = $email;
$_SESSION['name'] = $name;
$_SESSION['otp_sent_time'] = time(); // Store the time OTP was sent
// Kirim email OTP
$mail = new PHPMailer(true);
try {
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'cytidryu123@gmail.com';
$mail->Password = 'etnu upyj thqg jmez'; // Gunakan App Password jika 2FA aktif
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Untuk port 465
$mail->Port = 465; // Port untuk SSL
$mail->setFrom('cytidryu123@gmail.com', 'tiket hafiz');
$mail->addAddress($email);
$mail->isHTML(true);
$mail->Subject = 'OTP Verifikasi Akun';
$mail->Body = "Hai $name, <br> Berikut adalah kode OTP Anda:
<b>$otp</b>.<br>Kode ini berlaku selama 15 menit.";
$mail->send();
$otp_sent = true; // Set flag untuk menampilkan SweetAlert
} catch (Exception $e) {
echo "Gagal mengirim email: {$mail->ErrorInfo}";
}
}
if (isset($_POST['verify_otp'])) {
$otp_input = $_POST['otp'];
// Check if OTP is valid and not expired (15 minutes)
if ($otp_input == $_SESSION['otp'] && (time() - $_SESSION['otp_sent_time'] <
900)) {
// OTP valid, simpan data pengguna ke database
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$password = password_hash($_SESSION['password'], PASSWORD_DEFAULT); // Hash password
// Koneksi ke database dan insert data pengguna
$conn = new mysqli("localhost", "root", "", "acha");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// Use prepared statement
$stmt = $conn->prepare("INSERT INTO admin (name, email, password) VALUES
(?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);
if ($stmt->execute()) {
$registration_success = true; // Set flag untuk menampilkan SweetAlert
// Hapus session setelah verifikasi
unset($_SESSION['otp']);
unset($_SESSION['otp_sent_time']);
unset($_SESSION['password']); // Hapus password dari session
} else {
echo "Error: " . $stmt->error;
}
} else {
echo "OTP salah ataukadaluarsa.";
}
}
?>




<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>cinema hafiz</title>
  <link rel="shortcut icon" type="image/png" href="" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <img src="" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-moderniveblock sidebartoggler cursor-pointer" id="sidebarCollapse">
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
    <?php include 'componen/navbar.php' ?> 
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

// Query untuk mengambil semua data dari tabel 'admin'
$query = mysqli_query($conn, "SELECT * FROM admin");
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>email</th>
            <th>Password</th>
            <!-- Tambahkan kolom lain sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        <?php while($data = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['email']; ?></td>

                <td><?php echo $data['password']; ?></td>
                <td></td>
                <!-- Tambahkan kolom lain sesuai data -->
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
    </div>
    <div class="d-flex justify-content-between">
        <p>Showing 1 to 1 of 1 entries</p>
        <nav>
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>

<!-- Modal Tambah Akun -->
<div class="modal fade" id="tambahAkunModal" tabindex="-1" role="dialog" aria-labelledby="tambahAkunModalLabel" aria-hidden="true" style="color: black;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAkunModalLabel" style="color: black;">Tambah Akun Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
    <form action="admin.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label" style="color: black;">Nama</label>
            <input type="text" class="form-control" name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label" style="color: black">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
        </div>
        <div class="mb-4">
            <label for="password" class="form-label" style="color: black">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
       <div class="modal-footer">
       <button type="submit" name="send_otp" class="btn btn-primary">Kirim OTP</button>
       </div>
    </form>

    <?php if (isset($_SESSION['otp'])): ?>
    <form action="admin.php" method="POST">
        <div class="mb-3">
            <label for="otp" class="form-label">Masukkan OTP</label>
            <input type="text" class="form-control" name="otp" required>
        </div>
        <button type="submit" name="verify_otp" class="btn btn-success">Verifikasi OTP</button>
    </form>
    <?php endif; ?>
</div>
        </div>
    </div>
</div>
       
       
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Menampilkan SweetAlert setelah mengirim OTP
    <?php if (isset($otp_sent) && $otp_sent): ?>
      Swal.fire({
        title: 'OTP Terkirim!',
        text: 'Kode OTP telah dikirim ke email Anda.',
        icon: 'success',
        confirmButtonText: 'OK'
        
      }).then((result) => {
            if (result.isConfirmed) {
                var myModal = new bootstrap.Modal(document.getElementById('tambahAkunModal'));
                myModal.show();
            }
        });
    <?php endif; ?>

    // // Menampilkan SweetAlert setelah pendaftaran berhasil
    <?php if (isset($registration_success) && $registration_success): ?>
    Swal.fire({
      title: 'Pendaftaran Berhasil!',
      text: 'Anda telah berhasil mendaftar. Silakan masuk.',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then(() => {
      // Mengarahkan pengguna ke register.php setelah menekan OK
      window.location.href = 'admin.php'; // Ganti dengan path yang sesuai
    });
  <?php endif; ?>
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