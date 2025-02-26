<?php include 'koneksi.php';
$id_film  = isset($_GET['id']) ? intval($_GET['id'])  : 0;

$sql = "SELECT * FROM film WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_film);
$stmt->execute();
$result  = $stmt->get_result();

if ($result->num_rows > 0) {
    $film = $result->fetch_assoc();
} else {
    echo "Film tidak ditemukan . ";
    exit;
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
   <style>
    body{
        padding: 20px;
    }
    .movie-info {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
    }
    .movie-info {
        max-width: 100%;
        height: auto;
        margin-bottom: flex-start;
    }
    .movie-details {
       flex: 1;
    }
    .btn-custom{
        background-color: #00695c;
        color: white ;
    margin-bottom: 10px;
    }
    .btn-custom:hover {
        background-color: #004d40;

    }
    @media (max-width: 780px){
        .movie-info{
            flex-direction: column;
            align-items: center;
            text-align: 100%;
        }
        .movie-details{
            max-width: 100px;
        }
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

    <!-- Product Section End -->

<section>

    <div class="container">
        <div class="d-flex align-items-center mb-3">
            <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                <span class="fw-bold"><?php echo $film['usia']; ?>+</span>
            </div>
            <div class="ms-3">
                <h5 class="mb-0"><?php echo $film['nama_film']; ?></h5>
                <p class="text-muted mb-0"> <?php echo $film['genre']; ?></p>
            </div>

        </div>
        <div class="row movie-info">
            <div class="col-md-4 text-center">
                <img class="img-fluid rounded" alt="Poster" src="<?php echo $film['poster']; ?>" />
            </div>
            <div class="col-md-8 movie-details">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-clock me-2"></i>
                    <span><?php echo $film['total_menit']; ?> Minutes</span>
                </div>
                <div class="mb-3">
                    <button class="btn btn-outline-secondary me-2"> <?php echo $film['dimensi']; ?></button>
                </div>
                <div class="mb-3">
                    <button class="btn btn-custom w-100" onclick="window.location.href='jadwal.php?id=<?php echo $film['id']; ?>'">Buy Ticket</button>
                    <button class="btn btn-custom w-100" data-toggle="modal" data-target="#trailerModal"> TRAILER</button>
                    <div>
                        <p><p><strong><?php echo $film['judul']; ?></p>
                        <p><strong>Producer:</strong> <?php echo $film['Producer']; ?></p>
                        <p><strong> Director:</strong> <?php echo $film['Director']; ?></p>
                        <p><strong> writer:</strong> <?php echo $film['Writer']; ?></p>
                        <p><strong>Cast:</strong> <?php echo $film['Cast']; ?>/p>
                        <p><strong> Distributor:</strong> <?php echo $film['Distributor']; ?>/p>


                    </div>
                    <div>

                    </div>  
                    <!-- kodingan modal for trailer -->
                    <div class="modal fade" id="trailerModal" tabindex="-1" aria-labelledby="trailerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trailerModalLabel">Trailer: <?php echo htmlspecialchars($film['nama_film']); ?></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (!empty($film['trailer'])): ?>
                    <video width="100%" controls>
                        <source src="<?php echo htmlspecialchars($film['trailer']); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php else: ?>
                    <p>Trailer tidak tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
                    </section>
                    <!-- Footer Section Begin -->
                    <div>
                    
                    </div>
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