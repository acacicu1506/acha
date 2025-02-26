
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
    $name = $_POST['nik'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    // Simpan password di session
    $_SESSION['password'] = $password;
    // Generate OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;
    $_SESSION['nik'] = $name;
    $_SESSION['id'] = $id;
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
      $mail->setFrom('cytidryu123@gmail.com', 'acha');
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
        $name = $_SESSION['nik'];
        $email = $_SESSION['email'];
        $id = $_SESSION['id'];
        $password = password_hash($_SESSION['password'], PASSWORD_DEFAULT); // Hash password
        // Koneksi ke database dan insert data pengguna
        $conn = new mysqli("localhost", "root", "", "acha");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Use prepared statement
        $stmt = $conn->prepare("UPDATE akun_mall SET nik = ?, email = ?, password
= ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $password, $id);
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
        echo "OTP salah atau kadaluarsa.";
    }
}
?>

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
    <h2 class="mb-4">Akun Mall</h2>
    
    <div class="table-responsive">
        <?php
        include '../koneksi.php'; // File koneksi database

        // Query untuk mengambil semua data dari tabel 'akun_mall'
        $query = mysqli_query($conn, "SELECT * FROM akun_mall");
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Nama Mall</th>
                    <th>NIK</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['password']; ?></td>
                        <td><?php echo $data['nama_mall']; ?></td>
                        <td><?php echo $data['nik']; ?></td>
                        
                        <td>
                                                <button class="btn btn-warning btn-edit"
                                                    data-id="<?php echo $data['id']; ?>"
                                                    data-nama="<?php echo $data['nama_mall']; ?>"
                                                    data-nik="<?php echo $data['nik']; ?>"
                                                    data-email="<?php echo $data['email']; ?>"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalTambahJadwal">
                                                    Edit
                                                </button>
                          </td>
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
     <!--modal buat edit akun mall-->

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
var myModal = new
bootstrap.Modal(document.getElementById('modalTambahJadwal'));
myModal.show();
}
});
<?php endif; ?>
// // Menampilkan SweetAlert setelah pendaftaran berhasil
<?php if (isset($registration_success) && $registration_success): ?>
Swal.fire({
title: 'Pendaftaran Berhasil!',
text: 'Anda telah berhasil Mengupdate.',
icon: 'success',
confirmButtonText: 'OK'
}).then(() => {
// Mengarahkan pengguna ke register.php setelah menekan OK
window.location.href = 'akun_mall.php'; // Ganti dengan path yang sesuai
});
<?php endif; ?>
</script>
  <script>
$('.btn-edit').click(function() {
var id = $(this).data('id');
var nama = $(this).data('nama');
var nik = $(this).data('nik');
var email = $(this).data('email');
$('#edit-id').val(id);
$('#edit-nama').val(nama);
$('#edit-nik').val(nik);
$('#edit-email').val(email);
});
</script>
<div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-labelledby="modalTambahJadwalLabel" aria-hidden="true" style="color: black;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahJadwalLabel">Edit Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="akun_mall.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Mall</label>
                        <input type="text" class="form-control" name="name" id="edit-nama"
                            value="<?php echo isset($_SESSION['nama_mall']) ? htmlspecialchars($_SESSION['nama_mall']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="id" id="edit-id"
                            value="<?php echo isset($_SESSION['id']) ? htmlspecialchars($_SESSION['id']) :
                                        ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" name="nik" id="edit-nik"
                            value="<?php echo isset($_SESSION['nik']) ? htmlspecialchars($_SESSION['nik'])
                                        : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="edit-email" value="<?php echo isset($_SESSION['email']) ?
                                                                                                            htmlspecialchars($_SESSION['email']) : ''; ?>" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password"
                            required>
                    </div>
                    <button type="submit" name="send_otp" class="btn btn-primary">Kirim
                        OTP</button>
                </form>
                <?php if (isset($_SESSION['otp'])): ?>
                    <form action="akun_mall.php" method="POST">
                        <div class="mb-3">
                            <label for="otp" class="form-label">Masukan OTP</label>
                            <input type="text" class="form-control" name="otp" required>
                        </div>
                        <button type="submit" name="verify_otp" class="btn btn-success">Verifikasi OTP</button>
                    </form>
                <?php endif; ?>
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
          var myModal = new bootstrap.Modal(document.getElementById('modalTambahJadwal'));
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