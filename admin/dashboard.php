<?php 
session_start();
include "../koneksi.php";

// Data untuk Jumlah Pembeli per Tanggal
$query = "SELECT DATE_FORMAT(transaction_time, '%d/%m') AS tanggal, 
                 COUNT(*) AS jumlah_pembeli 
          FROM transactions 
          GROUP BY tanggal 
          ORDER BY tanggal ASC";

$result = $conn->query($query);

$tanggal_pembeli = [];
$jumlah_pembeli = [];

while ($row = $result->fetch_assoc()) {
    $tanggal_pembeli[] = $row['tanggal'];  // Format: 16/08, 17/08, dll.
    $jumlah_pembeli[] = (int)$row['jumlah_pembeli']; // Jumlah pembeli tiket
}

// Konversi ke JSON agar bisa digunakan di JavaScript
$tanggal_pembeli_json = json_encode($tanggal_pembeli);
$jumlah_pembeli_json = json_encode($jumlah_pembeli);
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
    <?php include 'componen/navbar.php' ?> 
      <!--  Header Start -->
     
     
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
        <div class="row">
        <div class="row">
  <!-- Diagram 1: Sales Overview -->
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Sales Overview</h5>
        <div id="chart_pendapatan"></div>
      </div>
    </div>
  </div>

  <!-- Diagram 2: Jumlah Pembelian Tiket -->
  <div class="col-lg-12 mt-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Jumlah Pembelian Tiket</h5>
        <div id="chart_pembeli"></div>
      </div>
    </div>
  </div>
</div>


       
        <div class="py-6 px-6 text-center">
        
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
  <script>
  // Grafik Jumlah Pembelian Tiket dengan Desain Mirip Gambar
  var optionsPembeli = {
    chart: {
      type: 'bar',
      height: 350
    },
    colors: ['#008FFB'], // Warna biru seperti di gambar
    fill: {
      type: 'gradient', // Gunakan efek gradient agar lebih smooth
      gradient: {
        shade: 'light',
        type: 'vertical',
        shadeIntensity: 0.5,
        gradientToColors: ['#00E396'], // Efek biru ke hijau
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 0.6,
        stops: [0, 100]
      }
    },
    plotOptions: {
      bar: {
        columnWidth: '45%',  // Atur lebar batang agar proporsional seperti gambar
        borderRadius: 5, // Tambahkan efek lengkungan di atas batang
      }
    },
    series: [{
      name: 'Jumlah Pembeli',
      data: <?php echo $jumlah_pembeli_json; ?>
    }],
    xaxis: {
      categories: <?php echo $tanggal_pembeli_json; ?>,
      labels: {
        style: {
          fontSize: '12px',
          fontWeight: 'bold'
        }
      }
    },
    yaxis: {
      labels: {
        style: {
          fontSize: '12px',
          fontWeight: 'bold'
        }
      }
    },
    tooltip: {
      theme: 'light',
      y: {
        formatter: function (val) {
          return val + " Pembeli";
        }
      }
    }
  };

  var chartPembeli = new ApexCharts(document.querySelector("#chart_pembeli"), optionsPembeli);
  chartPembeli.render();
</script>



</body>

</html>