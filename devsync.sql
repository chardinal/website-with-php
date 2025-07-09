-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 09, 2025 at 07:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devsync`
--

-- --------------------------------------------------------

--
-- Table structure for table `captiom`
--

CREATE TABLE `captiom` (
  `id_caption` int(11) NOT NULL,
  `conten` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `captiom`
--

INSERT INTO `captiom` (`id_caption`, `conten`) VALUES
(1, 'Sebagai perusahaan yang juga mengkhususkan diri dalam jasa desain aplikasi mobile, kami memahami pentingnya tampilan yang menarik dan fungsionalitas yang intuitif. Tim desainer kami bekerja sama dengan pengembang untuk menciptakan antarmuka pengguna (UI) yang tidak hanya estetis tetapi juga memberikan pengalaman pengguna (UX) yang luar biasa. Kami berkomitmen untuk menghadirkan solusi desain yang sesuai dengan kebutuhan spesifik klien kami, memastikan setiap aplikasi mobile yang kami kembangkan tidak hanya memenuhi standar industri tetapi juga mencerminkan identitas merek klien. \r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id_contact` int(11) NOT NULL,
  `nama_contact` varchar(64) NOT NULL,
  `email_contact` varchar(225) NOT NULL,
  `pesan` varchar(225) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_services`
--

CREATE TABLE `customer_services` (
  `id_cs` int(1) NOT NULL,
  `no_whatsapp` varchar(13) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_services`
--

INSERT INTO `customer_services` (`id_cs`, `no_whatsapp`, `nama`) VALUES
(1, '6282292972072', 'chardinalllll');

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

CREATE TABLE `login_admin` (
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_admin`
--

INSERT INTO `login_admin` (`email`, `password`, `nama`) VALUES
('12345@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '12345'),
('ryan@gmail.com', '5090a56c78719e08107bb37aa776f30b25b842234afad59401ecd422ba63db75', 'ryan');

-- --------------------------------------------------------

--
-- Table structure for table `paket_layanan`
--

CREATE TABLE `paket_layanan` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `harga` decimal(15,0) NOT NULL,
  `fitur` text NOT NULL,
  `durasi_pengerjaan` int(50) NOT NULL,
  `jumlah_revisi` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_layanan`
--

INSERT INTO `paket_layanan` (`id_paket`, `nama_paket`, `harga`, `fitur`, `durasi_pengerjaan`, `jumlah_revisi`) VALUES
(1, 'BASIC', 2000000, 'Aplikasi Android / iOS,\r\nUnggah ke Playstore, \r\nUnggah ke AppStore', 3, 1),
(2, 'STANDART', 4000000, 'Aplikasi Android / iOS, \r\nUnggah ke Playstore, \r\nUnggah ke AppStore', 10, 3),
(3, 'ADVANCED', 6000000, 'Aplikasi Android / iOS, \r\nUnggah ke Playstore,\r\nUnggah ke AppStore', 15, 5),
(4, 'MIGHTY', 8000000, 'Aplikasi Android / iOS, \r\nUnggah ke Playstore, \r\nUnggah ke AppStore', 20, 7);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `package` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `features` text NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `confirm` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `nama`, `nik`, `email`, `telepon`, `alamat`, `package`, `tipe`, `features`, `pesan`, `created_at`, `confirm`) VALUES
(45, 'sasdsa', '9999999999', 'aku@gmail.corr', '9999999999', 'ddd', 'advanced', 'kesehatan', '534', '54534', '2024-12-09 06:24:42', 1),
(46, 'rthf', '1234567898743', 'budaou@gmail.com', '765432432', 'vcx', 'advanced', 'e-commerce', 'dgv', 'fsdg', '2024-12-09 06:28:04', 1),
(47, 'bihadf', '965442', 'nias@gmaio', '85643', 'fjhaif', 'advanced', 'pendidikan', 'dhrteh', 'ewrgv', '2024-12-09 06:28:46', 1),
(49, 'errew', '12345432', 'asj@gmail.com', '9876783', 'surabaya', 'standard', 'pendidikan', 'ada', 'ada', '2024-12-15 19:09:07', 1),
(50, 'fsafef', '98745', 'jnd@gmail.com', '9876', 'jsudi', 'mighty', 'sosial', 'rfrrf', 'wdde', '2024-12-15 19:50:49', 1),
(51, 'jiele', '839393993', 'gjod@gmail.com', '383793', 'jikksk', 'basic', 'pendidikan', 'jukks', 'njs', '2024-12-15 20:04:11', NULL),
(52, 'grand', '234567898', 'gran@hjf', '9875', 'nhsasisjh', 'mighty', 'travelling', 'hudiffj', 'ieiih', '2024-12-16 08:13:48', NULL),
(53, 'chardinal', '123243567890', 'chardinal@gmail.com', '81234567231', 'surabaya', 'mighty', 'travelling', 'tidak ada', 'ada', '2025-01-06 08:26:44', NULL),
(54, 'fatah', '3456798', 'hua@gmail.com', '876544', 'fgh', 'advanced', 'travelling', 'hhkjh', 'gcfygud', '2025-01-07 16:14:00', NULL),
(55, 'saya', '1234567', 'saya12@gmail.com', '86389222', 'jakarta', 'standard', 'kesehatan', 'ada', 'ada', '2025-01-08 05:02:26', NULL),
(56, 'saaya', '2345678909', 'ya@gmail.com', '9876543221', 'jvgdhjksl', 'advanced', 'kesehatan', 'ykaf', 'huhijoefo', '2025-01-09 03:03:13', NULL),
(57, 'rapli', '98765434567', 'rapli@gmail.com', '98765673', 'jihaf;haf', 'standard', 'pendidikan', 'ada', 'ada', '2025-01-09 03:35:11', NULL),
(59, 'disda', '987656348342', 'hu@gmail.com', '987654322', 'uytrg', 'standard', 'sosial', 'jufr', 'adda', '2025-02-17 06:42:41', NULL),
(62, 'saaya', '1234567891234567', 'yaRQ@gmail.com', '9876543221', 'jvgdhjksl', 'advanced', 'pendidikan', 'G', 'GWE', '2025-05-22 18:48:36', NULL),
(63, 'saaya', '1234567897654323', 'yaSSSD@gmail.com', '987654322167', 'jvgdhjksl', 'advanced', 'sosial', 'SDSDG', 'SRH', '2025-05-22 18:50:28', NULL),
(64, 'Chardinal', '1234567891011121', 'chardinal01@gmail.com', '898765432112', 'surabaya', 'advanced', 'pendidikan', 'menarik, banyak', 'tidak ada', '2025-05-23 18:28:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `porto`
--

CREATE TABLE `porto` (
  `id_porto` int(11) NOT NULL,
  `kategori` varchar(64) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `porto`
--

INSERT INTO `porto` (`id_porto`, `kategori`, `gambar`) VALUES
(26, 'PENDIDIKAN', '../img/Pendidikan 1.png'),
(27, 'PENDIDIKAN', '../img/Pendidikan 2.png'),
(28, 'KESEHATAN', '../img/Kesehatan 1.png'),
(29, 'KESEHATAN', '../img/Kesehatan 2.png'),
(30, 'E-COMMERCE', '../img/E-commerce 1.png'),
(31, 'E-COMMERCE', '../img/E-commerce 2.png'),
(32, 'SOSIAL', '../img/Sosial 1.png'),
(33, 'SOSIAL', '../img/Sosial 2.png'),
(34, 'TRAVELLING', '../img/Travelling 1.png'),
(35, 'TRAVELLING', '../img/Travelling 2.png'),
(36, 'KESEHATAN', '../img/Kesehatan 3.png'),
(37, 'KESEHATAN', '../img/Kesehatan 4.png'),
(38, 'SOSIAL', '../img/Sosial 3.png'),
(39, 'SOSIAL', '../img/Sosial 4.png'),
(40, 'PENDIDIKAN', '../img/Pendidikan 3.png.jpg'),
(41, 'PENDIDIKAN', '../img/Pendidikan 4.png'),
(42, 'TRAVELLING', '../img/Travelling 3.png'),
(43, 'TRAVELLING', '../img/Travelling 4.png.jpg'),
(44, 'E-COMMERCE', '../img/E-commerce 3.png'),
(46, 'E-COMMERCE', '../img/E-commerce 5.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `captiom`
--
ALTER TABLE `captiom`
  ADD PRIMARY KEY (`id_caption`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `customer_services`
--
ALTER TABLE `customer_services`
  ADD PRIMARY KEY (`id_cs`);

--
-- Indexes for table `login_admin`
--
ALTER TABLE `login_admin`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `paket_layanan`
--
ALTER TABLE `paket_layanan`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD UNIQUE KEY `idx_email` (`email`),
  ADD UNIQUE KEY `idx_nik` (`nik`);

--
-- Indexes for table `porto`
--
ALTER TABLE `porto`
  ADD PRIMARY KEY (`id_porto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `captiom`
--
ALTER TABLE `captiom`
  MODIFY `id_caption` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_services`
--
ALTER TABLE `customer_services`
  MODIFY `id_cs` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `porto`
--
ALTER TABLE `porto`
  MODIFY `id_porto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
