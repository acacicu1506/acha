<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Film</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Mulish', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            padding: 20px;
            background-color: #e74c3c;
            color: white;
            border-radius: 10px 10px 0 0;
            margin-bottom: 30px;
        }

        form {
            background-color: #fff;
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: 600;
            color: #34495e;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        button {
            background-color: #2ecc71;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #27ae60;
        }

        .list-group-item {
            background-color: #ecf0f1;
            margin-bottom: 5px;
        }

        .btn-danger {
            background-color: #e74c3c;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        #selectedGenres {
            max-height: 150px;
            overflow-y: auto;
            padding-left: 0;
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-footer {
            text-align: center;
            margin-top: 30px;
        }
    </style>

</head>
<body>

    <h1>Input Data Film</h1>

    <form action="proses_input.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="poster">Upload Poster</label>
            <input type="file" id="poster" name="poster" required>
        </div>

        <div class="form-group">
            <label for="nama_film">Nama Film</label>
            <input type="text" id="nama_film" name="nama_film" required>
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <select id="genreSelect">
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
            <button type="button" onclick="addGenre()">Tambah</button>
        </div>

        <ul id="selectedGenres" class="mt-3 list-group"></ul>
        <input type="hidden" id="genreInput" name="genre">

        <div class="form-group">
            <label for="banner">Upload Banner</label>
            <input type="file" id="banner" name="banner" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="menit">Total Menit</label>
            <input type="text" id="menit" name="menit" required>
        </div>

        <div class="form-group">
            <label for="usia">Usia</label>
            <select id="usia" name="usia" required>
                <option value="" disabled selected>Pilih Usia</option>
                <option value="13">13</option>
                <option value="17">17</option>
                <option value="SU">SU</option>
            </select>
        </div>

        <div class="form-group">
            <label for="trailer">Upload Trailer</label>
            <input type="file" id="trailer" name="trailer" accept="video/*">
        </div>

        <div class="form-group">
            <label for="judul">Deskripsi</label>
            <input type="text" id="judul" name="judul" required>
        </div>

        <div class="form-group">
            <label for="dimensi">Berapa Dimensi</label>
            <select id="dimensi" name="dimensi" required>
                <option value="2D">2D</option>
                <option value="3D">3D</option>
            </select>
        </div>

        <div class="form-group">
            <label for="producer">Producer</label>
            <input type="text" id="producer" name="producer" required>
        </div>

        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" id="director" name="director" required>
        </div>

        <div class="form-group">
            <label for="writter">Writer</label>
            <input type="text" id="writter" name="writter" required>
        </div>

        <div class="form-group">
            <label for="cast">Cast</label>
            <input type="text" id="cast" name="cast" required>
        </div>

        <div class="form-group">
            <label for="distributor">Distributor</label>
            <input type="text" id="distributor" name="distributor" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga Per Tiket</label>
            <input type="text" id="harga" name="harga" required>
        </div>

        <div class="form-footer">
            <button type="submit">Simpan</button>
        </div>
    </form>

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
