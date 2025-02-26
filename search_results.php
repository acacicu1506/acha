<?php
session_start();
include "koneksi.php"; // Pastikan file koneksi.php sudah benar

// Ambil query pencarian dari parameter GET 
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Persiapkan query pencarian menggunakan prepared statement untuk menghindari SQL injection
$sql = "SELECT * FROM film WHERE nama_film LIKE ? OR genre LIKE ?";
$stmt = mysqli_prepare($conn, $sql);

// Menambahkan tanda '%' untuk pencarian wildcard
$search_term = "%" . $query . "%";

// Mengingat parameter ke prepared statement
mysqli_stmt_bind_param($stmt, "ss", $search_term, $search_term);

// Menjalankan query 
mysqli_stmt_execute($stmt);

// Mendapatkan hasil dari query
$result = mysqli_stmt_get_result($stmt);
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
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<>
    <!-- Header Section Begin -->
    <?php include "component/navbar.php"; ?>
    <!-- Header End -->

    <!-- Search Result Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="section-title">
                <h4>Search Result for: <?php echo htmlspecialchars($query); ?></h4>
            </div>
            <div class="row">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <a href="film.php?id=<?php echo $row['id']; ?>">
                                    <div class="product__item__pic set-bg" data-setbg="<?php echo $row['poster']; ?>">
                                    </div>
                                </a>
                                <div class="product__item__text">
                                    <ul>
                                        <li><?php echo $row['dimensi']; ?></li>
                                        <li><?php echo $row['genre']; ?></li>
                                    </ul>
                                    <h5>
                                        <a href="film.php?id=<?php echo $row['id']; ?>"><?php echo $row['nama_film']; ?></a>
                                    </h5>
                                    <a href="film.php?id=<?php echo $row['id']; ?>" class="primary-btn">Detail Film</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No result found for "<?php echo htmlspecialchars($query); ?>"</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- Search Result Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="page-up">
            <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer__logo">
                        <a href="index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer__nav">
                        <ul>
                            <li class="active"><a href="./index.html">Homepage</a></li>
                            <li><a href="./categories.html">Categories</a></li>
                            <li><a href="./blog.html">Our Blog</a></li>
                            <li><a href="#">Contacts</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script> All rights reserved | This template
                        is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                            target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>

                </div>
            </div>
        </div>
    </footer>
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form method="GET" action="search_results.php">
                <input type="text" name="query" placeholder="search for films..."
                value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>
    <!-- Footer Section End -->

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