<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil nama file saat ini
$current_page = basename($_SERVER['PHP_SELF']);
?>

    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/plyr.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const searchInput = document.getElementById("searchMovie");
const resultsList = document.getElementById("movieResults");
searchInput.addEventListener("input", function() {
const query = this.value.trim();
resultsList.innerHTML = "";
if (query.length > 0) {
fetch(`get_movies.php?q=${query}`)
.then(response => response.json())
.then(data => {
resultsList.classList.toggle("hidden", data.length === 0);
resultsList.innerHTML = ""; // Hapus hasil lama
data.forEach(movie => {
const li = document.createElement("li");
li.textContent = movie.nama_film;
li.className = "p-2 hover:bg-blue-100 cursor-pointertransition-all duration-200";
// Ketika diklik, redirect ke film.php?id=...
li.onclick = () => {
window.location.href = `film.php?id=${movie.id}`;
};
resultsList.appendChild(li);
});
})

.catch(error => console.error("Error fetching data:", error));
} else {
resultsList.classList.add("hidden");
}
});
// Sembunyikan dropdown kalau klik di luar
document.addEventListener("click", function (e) {
if (!searchInput.contains(e.target) && !resultsList.contains(e.target)) {
resultsList.classList.add("hidden");
}
});
</script>
<style>
/* Style umum untuk dropdown */
.dropdown-menu {
    background-color: #343a40; /* Warna latar belakang dropdown */
    border: none;
    border-radius: 8px;
}

/* Style untuk setiap item dropdown */
.dropdown-menu .dropdown-item {
    color: #000000; /* Warna teks */
    padding: 10px 15px;
    transition: background 0.3s ease-in-out;
}

/* Hover effect untuk item dropdown */
.dropdown-menu .dropdown-item:hover {
    background-color: #495057; /* Warna hover */
    color: #f8f9fa;
}

/* Style khusus untuk tombol Logout */
.dropdown-menu .btn-outline-primary {
    color: #000000;
    border-color: #ff4d4d;
    background-color: #dc3545; /* Warna merah untuk logout */
}

.dropdown-menu .btn-outline-primary:hover {
    background-color: #ff4d4d;
    border-color: #ff1a1a;
}

</style>






<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="./index.php">
                        <img src="img/hero/th.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="<?= ($current_page == 'index.php') ? 'active' : ''; ?>">
                                <a href="./index.php">Home</a>
                            </li>
                            <li class="<?= ($current_page == 'upcoming.php') ? 'active' : ''; ?>">
                                <a href="./upcoming.php">Upcoming</a>
                            </li>
                            <li class="<?= ($current_page == 'theater.php') ? 'active' : ''; ?>">
                                <a href="./theater.php">Theater</a>
                            </li>
                            <li class="<?= ($current_page == 'genre.php') ? 'active' : ''; ?>">
                                <a href="./genre.php">Genre <span class="arrow_carrot-down"></span></a>
                                <ul class="dropdown">
                                <li><a class="dropdown-item" href="genre.php?genre=Action">Action</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Adventure">Adventure</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Animation">Animation</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Biography">Biography</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Comedy">Comedy</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Crime">Crime</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Disaster">Disaster</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Documentary">Documentary</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Drama">Drama</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Epic">Epic</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Erotic">Erotic</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Eksperimental">Eksperimental</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Family">Family</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Fantasy">Fantasy</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Film-Noir">Film-Noir</a></li>
<li><a class="dropdown-item" href="genre.php?genre=History">History</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Horror">Horror</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Martial%20Arts">Martial Arts</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Music">Music</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Musical">Musical</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Mystery">Mystery</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Political">Political</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Psychological">Psychological</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Romance">Romance</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Sci-Fi">Sci-Fi</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Sport">Sport</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Superhero">Superhero</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Survival">Survival</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Thriller">Thriller</a></li>
<li><a class="dropdown-item" href="genre.php?genre=War">War</a></li>
<li><a class="dropdown-item" href="genre.php?genre=Western">Western</a></li>



                                </ul>
                            </li>
                            <li class="<?= ($current_page == 'usia.php') ? 'active' : ''; ?>">
                                <a href="./usia.php">Usia <span class="arrow_carrot-down"></span></a>
                                <ul class="dropdown">
                                <li><a href="usia.php?usia=SU" class="dropdown-item">SU</a></li>
                                    <li><a href="usia.php?usia=13" class="dropdown-item">13</a></li>
                                    <li><a href="usia.php?usia=17" class="dropdown-item">17</a></li>
                                   
                                </ul>
                                
                            </li>

                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="header__right">
                   <div class="d-flex align-items-center">
    <!-- Tombol Search -->
    <a href="#" class="search-switch me-3">
        <span class="icon_search"  id="searchMovie"></span>
        

    </a>

    <?php if (isset($_SESSION['name'])): ?>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle user-dropdown" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user"></i> <?php echo htmlspecialchars($_SESSION['name']); ?>
            </a>

            <ul class="dropdown-menu custom-dropdown" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="riwayat.php?username=<?php echo urlencode($_SESSION['email']); ?>">Riwayat Transaksi</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    <?php else: ?>
        <a href="./login.php" class="btn btn-transparant">
            <i class="fa fa-user"></i> Login
        </a>
    <?php endif; ?>
</div>



                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>