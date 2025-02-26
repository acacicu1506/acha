<?php 
include '../koneksi.php';
$sql = ' SELECT * FROM transactions ORDER BY id ASC ';
$result = $conn-> query ($sql);


?> 
<?php session_start() ?> 

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS (Bootstrap 5 Styling) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.all.min.js"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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
       <div class="table-responsive">
        <table id = "filmTable" class="table table-striped" >
          <thead>
          <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Email</th>
            <th>Nama FIlm </th>
            <th>Nomor Kursi</th>
            <th>Tanggal Pembayaran</th>
            <th>Jenis Pembayaran</th>
            <th>Harga</th>
            <th>Status</th>
            <!-- Tambahkan kolom lain sesuai kebutuhan -->
        </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if ($result->num_rows > 0) {
            $no = 1; // Inisialisasi nomor urut
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['order_id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['nama_film']}</td>
                        <td>{$row['seat_number']}</td>
                        <td>{$row['transaction_time']}</td>
                        <td>{$row['payment_type']}</td>
                        <td>{$row['amount']}</td>
                        <td>";
        
                // Menampilkan status dengan kondisi yang benar
                if ($row['status'] == 'settlement') {
                    echo 'selesai';
                } elseif ($row['status'] == 'pending') {
                    echo 'menunggu pembayaran';
                } else {
                    echo 'status tidak diketahui';
                }
        
                echo "</td>
                    </tr>";
        
                $no++; // Increment nomor urut dalam loop
            }
        } else {
            echo "<tr><td colspan='9' class='text-center'>Tidak ada data</td></tr>";
        }
        
          
            
         ?>
            
          </tbody>
        </table>

       </div>
       
       
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>
      </div>
    </div>
  </div>
 <!-- DataTables Buttons (Export ke Excel, PDF, dll.) -->
 <script src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
    
 <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.print.min.js"></script>


  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
</body>
<script >
 $(document).ready(function() {
    $('#filmTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="fas fa-copy"></i> Copy',
                className: 'btn btn-secondary'
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'csv',
                text: '<i class="fas fa-file-csv"></i> CSV',
                className: 'btn btn-primary'
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn btn-danger'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Print',
                className: 'btn btn-info'
            }
        ]
    });
});

</script>
</html>