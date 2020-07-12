-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2020 at 12:01 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14284854_uaspm2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `slug_kategori` varchar(255) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `slug_kategori`, `nama_kategori`, `urutan`, `tanggal_update`) VALUES
(11, 'keyboard', 'Keyboard', 4, '2020-07-11 12:45:11'),
(12, 'headset', 'Headset', 1, '2020-07-11 12:44:41'),
(13, 'mouse', 'Mouse', 2, '2020-07-11 12:44:55'),
(14, 'mousepad', 'Mousepad', 3, '2020-07-11 12:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelola_order`
--

CREATE TABLE `tb_kelola_order` (
  `id_kelola_order` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `status_bayar` varchar(20) NOT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `tanggal_bayar` varchar(255) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelola_order`
--

INSERT INTO `tb_kelola_order` (`id_kelola_order`, `id_user`, `id_pelanggan`, `nama_pelanggan`, `email`, `telepon`, `alamat`, `kode_transaksi`, `tanggal_transaksi`, `jumlah_transaksi`, `status_bayar`, `jumlah_bayar`, `tanggal_bayar`, `bukti_bayar`, `tanggal_post`, `tanggal_update`) VALUES
(1, NULL, 5, 'Pamungkas', 'pamungkas@mail.com', '081234567', 'Purwogondo', '12072020GATJWFXO', '2020-07-12 00:00:00', 3750000, 'Belum', NULL, NULL, NULL, '2020-07-12 05:25:29', '2020-07-12 05:25:29'),
(2, NULL, 5, 'Pamungkas', 'pamungkas@mail.com', '081234567', 'Purwogondo', '12072020PSNXTWTZ', '2020-07-12 00:00:00', 3750000, 'Belum', NULL, NULL, NULL, '2020-07-12 05:29:43', '2020-07-12 05:29:43'),
(3, NULL, 5, 'Pamungkas', 'pamungkas@mail.com', '081234567', 'Purwogondo', '12072020VFE3GLZQ', '2020-07-12 00:00:00', 3750000, 'Belum', NULL, NULL, NULL, '2020-07-12 05:32:26', '2020-07-12 05:32:26'),
(4, NULL, 5, 'Pamungkas', 'pamungkas@mail.com', '081234567', 'Purwogondo', '12072020KZX6NCGM', '2020-07-12 00:00:00', 3750000, 'Belum', NULL, NULL, NULL, '2020-07-12 05:40:29', '2020-07-12 05:40:29'),
(5, NULL, 4, 'Amman Fathoni', 'ammanft@gmail.com', '082325269338', 'Pemalang', '12072020XBBPN2AL', '2020-07-12 00:00:00', 2175000, 'Belum', NULL, NULL, NULL, '2020-07-12 11:57:12', '2020-07-12 11:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_pelanggan` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(65) NOT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `id_user`, `status_pelanggan`, `nama_pelanggan`, `email`, `password`, `telepon`, `alamat`, `tanggal_daftar`, `tanggal_update`) VALUES
(1, 0, 'Pending', 'admin23', 'admin@gmail.com', '7e5373000a99e739f131a5d9142b53bc92e09dbc', '08234545678', 'Boja', '2020-05-20 16:57:27', '2020-05-25 05:10:48'),
(2, 0, 'Pending', 'Priyo', 'priyo@mail.com', 'b736cda9ea84ad2cd685acdbaf687b37d374795f', '082147907791', 'mangir', '2020-07-02 03:56:17', '2020-07-02 01:56:17'),
(3, NULL, 'Pending', 'Pelanggan', 'masuk@mail.com', 'b736cda9ea84ad2cd685acdbaf687b37d374795f', '098888', 'mangir', '2020-07-10 14:52:38', '2020-07-10 14:52:38'),
(4, NULL, 'Pending', 'Amman Fathoni', 'ammanft@gmail.com', '926dc5ab868e05f0ed9ea76fafabd3ceb32d09fd', '082325269338', 'Pemalang', '2020-07-10 14:59:33', '2020-07-10 14:59:33'),
(5, NULL, 'Pending', 'Pamungkas', 'pamungkas@mail.com', 'b736cda9ea84ad2cd685acdbaf687b37d374795f', '081234567', 'Purwogondo', '2020-07-12 04:25:53', '2020-07-12 04:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `slug_produk` varchar(255) NOT NULL,
  `keywords` text DEFAULT NULL,
  `ukuran` varchar(255) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan_produk` text NOT NULL,
  `status_produk` varchar(20) NOT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_user`, `id_kategori`, `kode_produk`, `nama_produk`, `slug_produk`, `keywords`, `ukuran`, `warna`, `harga`, `stok`, `gambar`, `keterangan_produk`, `status_produk`, `tanggal_post`, `tanggal_update`) VALUES
(39, 8, 12, 'H001', 'Headset Steelseries Arctis3', 'headset-steelseries-arctis3-h001', 'Headset Steelseries Arctis3', '', 'Hitam', 1430000, 30, 'h1.jpg', '<p>The best headset for everywhere you game.<br />\r\n- Discord certified clear cast noise canceling microphones for clear, natural sounding voice comm on all platforms<br />\r\n- Artis signature soundscape emphasizes critical sounds tibhive you an audio advantage</p>\r\n', 'Publish', '2020-07-11 12:17:28', '2020-07-11 12:17:28'),
(40, 8, 12, 'H002', 'Steelseries Arctis 3 Black with 7.1 Surround - Put', 'steelseries-arctis-3-black-with-71-surround-put-h002', 'Headset Steelseries Arctis 3 Black with 7.1 Surround - Put', '', 'Putih', 1000000, 20, 'h21.jpg', '<p>Features :</p>\r\n\r\n<p>- Arctis perfectly contours to your head while evenly distributing the weight of the headset across the entire Ski Goggle band.</p>\r\n\r\n<p>- The ClearCast microphone uses a proprietary bidirectional design delivering unmatched sound clarity</p>\r\n', 'Publish', '2020-07-11 12:23:54', '2020-07-11 12:27:07'),
(41, 8, 11, 'K001', 'Steelseries Apex M750 (Mechanical RGB with LED)', 'steelseries-apex-m750-mechanical-rgb-with-led-k001', 'Keyboard Steelseries Apex M750 (Mechanical RGB with LED)', '', 'RGB', 2080000, 15, 'k1.jpg', '<p>Bahan Atas: Paduan Aluminium Seri 5000<br />\r\nN-Key Roll Over: 104-Key (Semua)<br />\r\nAnti-Ghosting<br />\r\nIluminasi: RGB per-kunci yang dapat dikontrol secara individual, termasuk pola keyboard keseluruhan, dan efek pengetikan reaktif.<br />\r\nBerat: 1 kg / 2,2 lbs<br />\r\nTinggi: 153</p>\r\n', 'Publish', '2020-07-11 12:26:39', '2020-07-11 12:26:39'),
(42, 8, 11, 'K002', 'Steelseries Apex 7 Fullsize - Mechanical Keyboard ', 'steelseries-apex-7-fullsize-mechanical-keyboard-k002', 'Steelseries Apex 7 Fullsize - Mechanical Keyboard ', '', 'RGB', 2499000, 10, 'k2.jpg', '<p>Top Material : Aircraft Grade Aluminum Alloy Frame<br />\r\nN-Key Roll Over : 104-Key<br />\r\nAnti-Ghosting :100%<br />\r\nIllumination :Dynamic Per Key RGB Illumination<br />\r\nLifetime : 50 Million Keypresses<br />\r\nComopatibility<br />\r\nOS : Windows and Mac OS X. USB port required</p>\r\n', 'Publish', '2020-07-11 12:30:16', '2020-07-11 12:30:16'),
(43, 8, 13, 'M001', 'Logitech G300S Gaming Mouse', 'logitech-g300s-gaming-mouse-m001', 'Logitech G300S Gaming Mouse', '', 'Hitam', 209000, 50, 'm1.png', '<p>Specifications:<br />\r\n- 9 PROGRAMMABLE CONTROLS<br />\r\n- ONBOARD MEMORY PROFILES<br />\r\n- EASY-TO-USE CONFIGURATION SOFTWARE</p>\r\n\r\n<p>TECHNICAL SPECIFICATIONS<br />\r\nTracking<br />\r\nResolution: 250 2,500 dpi<br />\r\nMax. acceleration: &gt;20G*<br />\r\nMax Speed: 60 ips (1.5m/s)</p>\r\n', 'Publish', '2020-07-11 12:33:36', '2020-07-11 12:33:36'),
(44, 8, 13, 'M002', 'Steelseries Rival 600 Gaming Mouse', 'steelseries-rival-600-gaming-mouse-m002', 'Steelseries Rival 600 Gaming Mouse', '', 'RGB', 1175000, 10, 'm2.jpg', '<p>Dikembangkan dengan tiga prinsip dasar kinerja revolusioner, ketahanan yang tidak nyata, dan fleksibilitas yang kuat, Rival 600 memberikan saat para profesional membutuhkannya, dalam pertempuran.<br />\r\n60-Juta Klik Saklar Mekanik.</p>\r\n', 'Publish', '2020-07-11 12:35:43', '2020-07-11 12:35:43'),
(45, 8, 13, 'M003', 'Steelseries Rival 310 Black With TrueMove3 Costom', 'steelseries-rival-310-black-with-truemove3-costom-m003', 'Mouse Steelseries Rival 310 Black With TrueMove3 Costom', '', 'Hitam', 790000, 15, 'm3.jpg', '<p>Pertama di Dunia Benar 1 sampai 1 Esports Sensor<br />\r\nTeknologi sensor TrueSove3 milik SteelSeries memiliki 1 sampai 1 pelacakan untuk latensi ultra-rendah dan akurasi yang tepat.<br />\r\nTombol Split-Trigger Eksklusif<br />\r\nDengan menawarkan switch mekanik 50 juta Klik</p>\r\n', 'Publish', '2020-07-11 12:37:46', '2020-07-11 12:37:46'),
(46, 8, 14, 'MP001', 'Steelseries Qck Prism', 'steelseries-qck-prism-mp001', 'Mousepad Steelseries Qck Prism', '', 'RGB', 980000, 20, 'mp1.jpg', '<p>Deskripsi Produk :<br />\r\n360-degree 12 zone Prism RGB Illumination<br />\r\nDual-Textured Surface<br />\r\nGameSense Lighting Support<br />\r\nPrismSync Support</p>\r\n', 'Publish', '2020-07-11 12:39:11', '2020-07-11 12:39:11'),
(47, 8, 14, 'MP002', 'Steelseries Qck Mini', 'steelseries-qck-mini-mp002', 'Mousepad Steelseries Qck Mini', '', 'Hitam', 170000, 50, 'mp2.jpg', '<p>Perfect Mouse Tracking<br />\r\nTested by the top mouse sensor manufacturer, the high thread count and surface variation optimize tracking accuracy for both optical and laser sensors with minimal friction.<br />\r\nRubber Base</p>\r\n', 'Publish', '2020-07-11 12:40:16', '2020-07-11 12:40:16'),
(48, 8, 11, 'K003', 'Steelseries Apex Pro TKL', 'steelseries-apex-pro-tkl-k003', 'Keyboard Steelseries Apex Pro TKL', '', 'RGB', 2750000, 10, 'k3.jpg', '<p>Type &amp; Name<br />\r\nOmniPoint Adjustable Mechanical Switch (Analog Hall Effect Magnetic Sensor)<br />\r\nActuation Point : 0.4mm to 3.6mm (More info)<br />\r\nForce : 45cN<br />\r\nResponse Time : 0.7ms (More info)<br />\r\nLifetime : 100 Million Keypresses</p>\r\n', 'Publish', '2020-07-11 12:43:46', '2020-07-11 12:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_user`, `id_pelanggan`, `kode_transaksi`, `id_produk`, `harga`, `jumlah`, `total_harga`, `tanggal_transaksi`, `tanggal_update`) VALUES
(1, 0, 1, '20052020H9NAZ3XS', 16, 225000, 1, 225000, '2020-05-20 00:00:00', '2020-05-20 16:53:01'),
(2, 0, 1, '20052020GFBFAZWH', 20, 45000, 1, 45000, '2020-05-20 00:00:00', '2020-05-20 16:57:59'),
(3, 0, 1, '20052020GFBFAZWH', 17, 140000, 2, 280000, '2020-05-20 00:00:00', '2020-05-20 16:57:59'),
(4, 0, 1, '21052020QUXNMAVG', 17, 140000, 2, 280000, '2020-05-21 00:00:00', '2020-05-21 14:35:18'),
(5, 0, 1, '07062020SA51N0YP', 19, 50000, 1, 50000, '2020-06-07 00:00:00', '2020-06-07 13:48:36'),
(6, 0, 1, '07062020SA51N0YP', 17, 140000, 1, 140000, '2020-06-07 00:00:00', '2020-06-07 13:48:36'),
(7, 0, 2, '02072020X2TYLPGH', 30, 450000, 1, 450000, '2020-07-02 00:00:00', '2020-07-02 01:58:07'),
(8, NULL, 5, '12072020KZX6NCGM', 40, 1000000, 1, 1000000, '2020-07-12 00:00:00', '2020-07-12 05:40:29'),
(9, NULL, 5, '12072020KZX6NCGM', 48, 2750000, 1, 2750000, '2020-07-12 00:00:00', '2020-07-12 05:40:29'),
(10, NULL, 4, '12072020XBBPN2AL', 44, 1175000, 1, 1175000, '2020-07-12 00:00:00', '2020-07-12 11:57:12'),
(11, NULL, 4, '12072020XBBPN2AL', 40, 1000000, 1, 1000000, '2020-07-12 00:00:00', '2020-07-12 11:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `akses_level` varchar(20) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `email`, `username`, `password`, `akses_level`, `tanggal_update`) VALUES
(4, 'admin123', 'admin@gmail.com', 'admin123', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Admin', '2020-06-25 11:28:01'),
(9, 'Joomstore', 'admin@joomstore.com', 'joomstore', 'b736cda9ea84ad2cd685acdbaf687b37d374795f', 'Admin', '2020-07-12 11:49:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_kelola_order`
--
ALTER TABLE `tb_kelola_order`
  ADD PRIMARY KEY (`id_kelola_order`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_kelola_order`
--
ALTER TABLE `tb_kelola_order`
  MODIFY `id_kelola_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
