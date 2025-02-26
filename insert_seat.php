<?php 
require "koneksi.php";

// Aktifkan debugging error di PHP (Opsional, jika di localhost)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Pastikan semua input tersedia
$seat_numbers = explode(",", $_POST['seat_number'] ?? ""); 
$mall_name = $_POST['mall_name'] ?? null;
$film_name = $_POST['film_name'] ?? null;

// Cek apakah data input kosong
if (empty($seat_numbers) || empty($mall_name) || empty($film_name)) {
    echo json_encode(["error" => "Data tidak lengkap", "seat_numbers" => $seat_numbers, "mall_name" => $mall_name, "film_name" => $film_name]);
    exit;
}

$success = true;
$errors = []; // Untuk menyimpan pesan error

foreach ($seat_numbers as $seat_number) {
    // Cek apakah kursi sudah dipesan
    $stmtCheck = $conn->prepare("SELECT id FROM seats WHERE seat_number = ? AND mall_name = ? AND film_name = ?");
    $stmtCheck->bind_param("sss", $seat_number, $mall_name, $film_name);
    
    if (!$stmtCheck->execute()) {
        $errors[] = "Query gagal saat mengecek kursi: " . $stmtCheck->error;
        $success = false;
        break;
    }
    
    $resultCheck = $stmtCheck->get_result();
    
    if ($resultCheck->num_rows > 0) { 
        $errors[] = "Kursi $seat_number sudah dipesan.";
        $success = false;
        break;
    }

    // Masukkan kursi ke database
    $stmtInsert = $conn->prepare("INSERT INTO seats (seat_number, mall_name, film_name, status) VALUES (?, ?, ?, 'occupied')");
    $stmtInsert->bind_param("sss", $seat_number, $mall_name, $film_name);

    if (!$stmtInsert->execute()) {
        $errors[] = "Query gagal saat memasukkan kursi: " . $stmtInsert->error;
        $success = false;
        break;
    }
}   

// Log kesalahan jika ada
if (!$success) {
    error_log("Gagal memasukkan kursi: " . implode("; ", $errors));
}

// Beri respon JSON
echo json_encode([
    "success" => $success,
    "errors" => $errors
]);
?>
