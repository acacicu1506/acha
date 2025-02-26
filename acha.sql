-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Feb 2025 pada 02.40
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acha`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `email`, `name`, `password`, `created_at`) VALUES
(1, 'cytidryu123@gmail.com', 'hafiz', '$2y$10$2cNLQxxBXiRzCOfrXvaZSuqF6otVe/uVdz4592QS.lycEo/76Cj.C', '2025-02-17 04:46:23'),
(2, 'cytidryu123@gmail.com', 'CHA', '$2y$10$T1km94qWutLkIAjDNwyFLusLMOW2.DDlqgrNBSO4xDrDQaDcLVaHe', '2025-02-17 05:06:28'),
(3, 'veenevire@gmail.com', 'bayu', '$2y$10$IixZpdY.INiqI8Ze8zvyluobLSpGF1AefvIACJZa2WytiFmB..XI.', '2025-02-17 05:22:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_mall`
--

CREATE TABLE `akun_mall` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(231) NOT NULL,
  `nama_mall` varchar(231) NOT NULL,
  `nik` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun_mall`
--

INSERT INTO `akun_mall` (`id`, `email`, `password`, `nama_mall`, `nik`) VALUES
(1, 'cytidryu123@gmail.com', '', 'tamini', '11111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `poster` varchar(250) NOT NULL,
  `banner` varchar(231) NOT NULL,
  `trailer` varchar(231) NOT NULL,
  `nama_film` varchar(231) NOT NULL,
  `judul` longtext NOT NULL,
  `total_menit` varchar(231) NOT NULL,
  `usia` varchar(231) NOT NULL,
  `genre` varchar(231) NOT NULL,
  `dimensi` varchar(231) NOT NULL,
  `Producer` varchar(231) NOT NULL,
  `Director` varchar(231) NOT NULL,
  `Writer` varchar(231) NOT NULL,
  `Cast` varchar(231) NOT NULL,
  `Distributor` varchar(231) NOT NULL,
  `harga` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `film`
--

INSERT INTO `film` (`id`, `poster`, `banner`, `trailer`, `nama_film`, `judul`, `total_menit`, `usia`, `genre`, `dimensi`, `Producer`, `Director`, `Writer`, `Cast`, `Distributor`, `harga`) VALUES
(6, 'uploads/poster/ultra.jpg', 'uploads/banner/ultra.jpg', 'uploads/trailer/WIN_20230913_13_12_34_Pro.mp4', 'ultraman', 'fnjafa', '30', 'SU', 'Action,Comedy', '2D', 'kurai', 'kui', 'kulai', 'krei', 'shai', '35000'),
(7, 'uploads/poster/horor.jpg', 'uploads/banner/wan.jpg', 'uploads/trailer/WhatsApp Video 2024-05-23 at 19.27.00_81e1785a.mp4', 'Vito Pemecah Biji', 'ga', '120', '17', 'Adventure', '2D', 'cecep', 'cecep', 'iwan', 'dino', 'ntah', '90000'),
(8, 'uploads/poster/poster_transformers.jpg', 'uploads/banner/banner_transformer.jpg', 'uploads/trailer/WhatsApp Video 2024-05-23 at 19.27.00_81e1785a.mp4', 'Transformer: The Last Knight', 'dimula dari aar nyamper wildan', '90', '13', 'Action', '2D', 'atar', 'vito', 'fajar', 'habib', 'atar', '150000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_film`
--

CREATE TABLE `jadwal_film` (
  `id` int(11) NOT NULL,
  `mall_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `studio` varchar(231) NOT NULL,
  `jam_tayang_1` time NOT NULL,
  `jam_tayang_2` time NOT NULL,
  `jam_tayang_3` time NOT NULL,
  `tanggal_tayang` date NOT NULL,
  `tanggal_akhir_tayang` date NOT NULL,
  `total_menit` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_film`
--

INSERT INTO `jadwal_film` (`id`, `mall_id`, `film_id`, `studio`, `jam_tayang_1`, `jam_tayang_2`, `jam_tayang_3`, `tanggal_tayang`, `tanggal_akhir_tayang`, `total_menit`) VALUES
(1, 1, 6, 'Studio 2', '14:29:00', '14:30:00', '14:30:00', '2025-02-22', '2025-02-27', '30'),
(2, 1, 6, 'Studio 2', '14:29:00', '14:30:00', '14:30:00', '2025-02-22', '2025-02-27', '30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `mall_name` varchar(255) NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `status` enum('available','occupled') NOT NULL,
  `film_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `seats`
--

INSERT INTO `seats` (`id`, `mall_name`, `seat_number`, `status`, `film_name`) VALUES
(20, 'tamini', 'A4', '', 'ultraman'),
(21, 'tamini', 'A5', '', 'ultraman'),
(22, 'tamini', 'A2', '', 'ultraman'),
(23, 'tamini', 'A3', '', 'ultraman'),
(24, 'tamini', 'A1', '', 'ultraman'),
(25, 'tamini', 'B1', '', 'ultraman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `transaction_time` datetime NOT NULL,
  `username` varchar(250) NOT NULL,
  `seat_number` varchar(250) NOT NULL,
  `nama_film` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `status`, `payment_type`, `amount`, `transaction_time`, `username`, `seat_number`, `nama_film`) VALUES
(1, 'TIX-1740211747', 'settlement', 'qris', 70000, '2025-02-22 15:09:15', 'cytidryu123@gmail.com', 'F6,F7', 'ultraman'),
(2, 'TIX-1740216476', 'settlement', 'qris', 70000, '2025-02-22 16:28:00', 'cytidryu123@gmail.com', 'E4,E5', 'ultraman'),
(3, 'TIX-1740363022', 'settlement', 'qris', 70000, '2025-02-24 09:10:25', 'adityamaulana150607@gmail.com', 'A4,A5', 'ultraman'),
(4, 'TIX-1740363185', 'settlement', 'qris', 35000, '2025-02-24 09:13:08', 'yudhyta@gmail.com', 'B6', 'ultraman'),
(5, 'TIX-1740363249', 'settlement', 'qris', 35000, '2025-02-24 09:14:11', 'yudhyta@gmail.com', 'B5', 'ultraman'),
(6, 'TIX-1740363510', 'settlement', 'qris', 35000, '2025-02-24 09:18:33', 'yudhyta@gmail.com', 'A6', 'ultraman'),
(7, 'TIX-1740379740', 'settlement', 'qris', 70000, '2025-02-24 13:49:04', 'adityamaulana150607@gmail.com', 'C4,C5', 'ultraman'),
(8, 'TIX-1740381863', 'settlement', 'qris', 70000, '2025-02-24 14:24:25', 'adityamaulana150607@gmail.com', 'A3,A4', 'ultraman'),
(9, 'TIX-1740460738', 'settlement', 'qris', 70000, '2025-02-25 12:19:01', 'cytidryu123@gmail.com', 'A4,A5', 'ultraman'),
(10, 'TIX-1740461474', 'settlement', 'qris', 70000, '2025-02-25 12:31:18', 'cytidryu123@gmail.com', 'A2,A3', 'ultraman'),
(11, 'TIX-1740463156', 'settlement', 'qris', 70000, '2025-02-25 12:59:23', 'cytidryu123@gmail.com', 'A1,B1', 'ultraman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akun_mall`
--
ALTER TABLE `akun_mall`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_film`
--
ALTER TABLE `jadwal_film`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `akun_mall`
--
ALTER TABLE `akun_mall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jadwal_film`
--
ALTER TABLE `jadwal_film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
