<?php
include 'koneksi.php'; // Menghubungkan ke database

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil username dari URL
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Query untuk mengambil data transaksi berdasarkan username
$sql_transactions = "SELECT * FROM transactions WHERE username = ?";
$stmt = $conn->prepare($sql_transactions);
$stmt->bind_param("s", $username); // Pastikan tipe parameter sesuai dengan jenis data (string untuk username)
$stmt->execute();
$result_transactions = $stmt->get_result();

// Query untuk mengambil 10 film teratas berdasarkan jumlah transaksi berdasarkan nama_film
$sql_top_films = "
    SELECT f.id, f.nama_film, f.poster, f.usia, COUNT(t.id) AS jumlah_transaksi
    FROM film f
    LEFT JOIN transactions t ON f.nama_film = t.nama_film
    GROUP BY f.id, f.nama_film, f.poster, f.usia
    ORDER BY jumlah_transaksi DESC
    LIMIT 10
";
$result_top_films = $conn->query($sql_top_films);

if (!$result_top_films) {
    // Jika query gagal, tampilkan error
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anime | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        /* Your CSS styles here */
        .status-btn {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}

.selesai {
    background-color: green;
}

.pending {
    background-color: red;
}

.lainnya {
    background-color: gray;
}

        body {
    font-family: 'Mulish', sans-serif;
}

h2 {
    font-family: 'Oswald', sans-serif;
    font-weight: 700;
    color: #ff6600;
    text-transform: uppercase;
    text-align: center;
    margin-bottom: 20px;
}

/* Tabel Styling */
.table-responsive {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
}

th {
    background: #ff6600;
    color: white;
    text-align: center;
    padding: 10px;
}

td {
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

tr:hover {
    background: #f4f4f4;
    transition: 0.3s ease-in-out;
}

/* Harga dengan warna yang lebih mencolok */
td:nth-child(8) {
    font-weight: bold;
    color: #ff6600;
}

/* Status Pembayaran */
td:nth-child(9) {
    font-weight: bold;
    text-transform: capitalize;
}

td:nth-child(9):contains("Selesai") {
    color: green;
}

td:nth-child(9):contains("Menunggu Pembayaran") {
    color: red;
}

    </style>
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <?php include "component/navbar.php" ?>
    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Riwayat Transaksi</h2>
                    <div class="table table-responsive">
                        <table id="transactionTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Transaksi</th>
                                    <th>Email</th>
                                    <th>Nama Film</th>
                                    <th>Nomer Kursi</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Jenis Pembayaran</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
    $no = 1; // Nomor urut untuk tabel
    while ($row = $result_transactions->fetch_assoc()) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row['order_id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['nama_film']}</td>
                <td>{$row['seat_number']}</td>
                <td>{$row['transaction_time']}</td>
                <td>{$row['payment_type']}</td>
                <td>Rp.{$row['amount']}</td> 
                <td>";
        // Menggunakan button dengan warna berbeda berdasarkan status
        if ($row['status'] == 'settlement') {
            echo '<span class="status-btn selesai">Selesai</span>';
        } elseif ($row['status'] == 'pending') {
            echo '<span class="status-btn pending">Menunggu Pembayaran</span>';
        } else {
            echo '<span class="status-btn lainnya">' . $row['status'] . '</span>';
        }
        echo "</td>
            </tr>";
        $no++;
    }
    ?>
</tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>10 Film Teratas</h2>
                    <div class="row">
                        <?php
                        if ($result_top_films->num_rows > 0) {
                            while ($row = $result_top_films->fetch_assoc()) {
                                echo "<div class='col-lg-3 col-md-4 col-sm-6'>
                                        <div class='product__item'>
                                            <div class='product__item__pic' style='background-image: url({$row['poster']});'>
                                                <div class='ep'>{$row['usia']}+</div>
                                            </div>
                                            <div class='product__item__text'>
                                                <h5>{$row['nama_film']}</h5>
                                                <span>{$row['jumlah_transaksi']} Transaksi</span>
                                            </div>
                                        </div>
                                    </div>";
                            }
                        } else {
                            echo "Tidak ada data yang ditemukan.";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="page-up">
            <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer__nav">
                        <ul>
                            <li class="active"><a href="./index.php">home</a></li>
                            <li><a href="./blog.php">upcoming</a></li>
                            <li><a href="./categories.php">genre</a></li>
                            <li><a href="#">Contacts</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/player.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>