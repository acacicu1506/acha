<?php
require 'koneksi.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$orderId = $_POST['order_id'];
$transactionStatus = $_POST['transaction_status'];
$paymentType = $_POST['payment_type'];
$grossAmount = $_POST['gross_amount'];
$transactionTime = $_POST['transaction_time'];
$username = $_POST['username'];
$seatNumbers = $_POST['seat_number'];
$email = $_POST['username'];
$nama_film = $_POST['film_name'];

// Simpan transaksi (tanpa memecah seat_number)
$query1 = "INSERT INTO transactions (order_id, status, payment_type, amount, transaction_time, username, seat_number, nama_film)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt1 = $conn->prepare($query1);
$stmt1->bind_param("sssissss", $orderId, $transactionStatus, $paymentType, $grossAmount, $transactionTime, $username, $seatNumbers, $nama_film);

if (!$stmt1->execute()) {
    echo json_encode(["status" => "error", "message" => "Gagal menyimpan transaksi"]);
    exit;
}

// Update status kursi (gunakan IN (...) untuk banyak kursi sekaligus)
$seatNumbersArray = explode(",", $seatNumbers);
$placeholders = implode(",", array_fill(0, count($seatNumbersArray), '?'));
$query2 = "UPDATE seats SET status = 'occupied' WHERE seat_number IN ($placeholders)";
$stmt2 = $conn->prepare($query2);
$stmt2->bind_param(str_repeat("s", count($seatNumbersArray)), ...$seatNumbersArray);
$stmt2->execute();

// Generate barcode
function generateBarcode($token)
 {
    $qrCode = new QrCode($token);
    $writer = new PngWriter();
    $result= $writer->write($qrCode);
    $directory = 'barcodes/';
if (!is_dir($directory)) mkdir($directory, 0777, true);
$filePath = $directory . $token . '.png';
$result->saveToFile($filePath);
return $filePath;
 }
$barcodePath = generateBarcode($orderId);

// Fungsi untuk mengirim email dengan barcode
function sendEmailWithBarcode($email, $username, $seatNumbers, $orderId, $transactionTime, $paymentType, $grossAmount, $barcodePath, $nama_film) 
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'cytidryu123@gmail.com';
        $mail->Password = 'etnu upyj thqg jmez';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('cytidryu123@gmail.com', 'tiket hafiz');
        $mail->addAddress($username);
        $mail->AddEmbeddedImage($barcodePath, 'barcode');

        $mail->isHTML(true);
        $mail->Subject = 'E-Ticket tiket hafiz Anda';
        $mail->Body = "
        <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4; text-align: center;'>
            <div style='max-width: 680px; background: white; margin: auto; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
                <h2 style='color: #FF5733;'>🎟 tiket hafiz</h2>
                <hr>
                <p><strong>Nama Film:</strong> $nama_film</p>
                <p><strong>Nomor Kursi:</strong> $seatNumbers</p>
                <p><strong>Order ID:</strong> $orderId</p>
                <p><strong>Waktu Transaksi:</strong> $transactionTime</p>
                <p><strong>Metode Pembayaran:</strong> $paymentType</p>
                <p><strong>Total Bayar:</strong> Rp " . number_format($grossAmount, 0, ',', '.') . "</p>
                <p>Scan barcode ini untuk masuk:</p>
                <img src='cid:barcode' style='width:200px; margin: 10px 0;'>
                <p style='font-size: 12px; color: gray;'>Harap tunjukkan e-ticket ini saat masuk ke bioskop.</p>
                <p style='font-size: 12px; color: gray;'>Terima kasih telah menggunakan tiket hafiz! 🎬🍿</p>
            </div>
        </div>";
        $mail->send();
    return true;
    }catch(Exception $e){
      return false;  
    }
}
sendEmailWithBarcode($email, $username, $seatNumbers, $orderId, $transactionTime, $paymentType, $grossAmount, $barcodePath, $nama_film);
echo json_encode([
    "status" => "success",
    "mesagge" => "Transaksi berhasil dan email telah terkirim"
]);