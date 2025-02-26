<?php
include 'koneksi.php'; // Menghubungkan ke database

$tanggal_hari_ini = date('Y-m-d');

$sql = "SELECT f.id, f.nama_film, f.poster, f.usia, MIN(j.tanggal_tayang) AS tanggal_tayang
        FROM film f
        INNER JOIN jadwal_film j ON f.id = j.film_id
        WHERE j.tanggal_tayang > ? 
        GROUP BY f.id, f.nama_film, f.poster, f.usia
        ORDER BY tanggal_tayang ASC";

$stmt = $conn->prepare($sql);

// Cek apakah query berhasil dipersiapkan
if (!$stmt) {
    die("Query gagal: " . $conn->error);
}

$stmt->bind_param("s", $tanggal_hari_ini);
$stmt->execute();
$result = $stmt->get_result();
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
    <style>.product__item {
    position: relative;
    overflow: hidden;
    transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out;
    border-radius: 10px;
}

.product__item:hover {
    transform: translateY(-8px) rotate(1deg);
    box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.4);
}

.product__item__pic {
    position: relative;
    overflow: hidden;
    transition: transform 0.4s ease-in-out, filter 0.4s ease-in-out;
}

.product__item:hover .product__item__pic {
    transform: scale(1.15) rotate(-1deg);
    filter: brightness(1.1);
}

/* Efek cahaya mengkilap */
.product__item__pic::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.1));
    transform: skewX(-20deg);
    transition: left 0.6s ease-in-out;
}

.product__item:hover .product__item__pic::after {
    left: 100%;
}
.hero__items {
    position: relative;
    overflow: hidden;
    transform: translateY(50px);
    opacity: 0;
    animation: fadeInUp 0.8s ease-out forwards;
    transition: transform 0.3s ease-in-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hover Effect */
.hero__items:hover {
    transform: scale(1.05);
}

/* Text Animation */
.hero__text {
    opacity: 0;
    transform: translateY(20px);
    animation: textFadeIn 1s ease-out forwards 0.5s;
}

@keyframes textFadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.hero__slider .owl-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    opacity: 0; /* Awalnya disembunyikan */
    transition: opacity 0.3s ease-in-out;
}

.hero__slider:hover .owl-nav {
    opacity: 1; /* Muncul saat hover */
}

.hero__slider .owl-nav button {
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    font-size: 24px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.3s ease-in-out;
}

.hero__slider .owl-nav button:hover {
    background: rgba(0, 0, 0, 0.8);
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
    <!-- Hero Section End -->
    
    <!-- Hero Section Begin -->
    <section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="trending__product">
                   
                    <div class="row">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="<?php echo $row['poster']; ?>">
                                        <div class="ep">18 / 18</div>
                                        <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                        <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                    </div>
                                    <div class="product__item__text">
                                       
                                        <h5><a href="film.php?id=<?php echo $row['id']; ?>"><?php echo $row['nama_film'] ?></a></h5>
                                        <!-- Tombol Detail Film -->
                                        <a href="film.php?id=<?php echo $row['id']; ?>" class="primary-btn">Detail Film</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile ?>
                    </div>
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