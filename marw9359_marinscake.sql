-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 14, 2022 at 09:22 PM
-- Server version: 10.2.44-MariaDB-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marw9359_marinscake`
--

-- --------------------------------------------------------

--
-- Table structure for table `daerah_kirim`
--

CREATE TABLE `daerah_kirim` (
  `id_daerah` int(11) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daerah_kirim`
--

INSERT INTO `daerah_kirim` (`id_daerah`, `nama_kota`, `ongkir`) VALUES
(1, 'Ngasem, Kab. Kediri', 1),
(2, 'Pesantren, Kota Kediri', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_modal`
--

CREATE TABLE `detail_modal` (
  `id_detail_modal` int(11) NOT NULL,
  `id_modal` int(11) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_modal`
--

INSERT INTO `detail_modal` (`id_detail_modal`, `id_modal`, `nama_bahan`, `jumlah`, `harga_satuan`, `total_harga`) VALUES
(4, 1, 'Tepung Segitiga Biru', 10, 20000, 200000),
(8, 5, 'Tepung terigu 5kg', 2, 1, 2),
(9, 5, 'Telur', 5, 2, 10),
(10, 6, 'Telur', 100, 1, 100),
(11, 6, 'Solar', 15, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `detail_preorder`
--

CREATE TABLE `detail_preorder` (
  `id_detail_preorder` int(11) NOT NULL,
  `id_preorder` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_preorder`
--

INSERT INTO `detail_preorder` (`id_detail_preorder`, `id_preorder`, `id_produk`, `nama_produk`, `jumlah`, `total`) VALUES
(1, 1, 1, 'Roti Ulang Tahun 2 Tingkat', 1, 250000),
(2, 2, 2, 'Roti Croffle', 4, 32000),
(3, 3, 1, 'Roti Ulang Tahun 2 Tingkat', 1, 250000),
(4, 4, 1, 'Roti Ulang Tahun 2 Tingkat', 1, 250000),
(5, 5, 1, 'Roti Ulang Tahun 2 Tingkat', 1, 250000),
(6, 6, 1, 'Roti Ulang Tahun 2 Tingkat', 1, 250000),
(7, 7, 2, 'Roti Croffle', 4, 32000),
(8, 8, 2, 'Roti Croffle', 1, 1),
(9, 9, 1, 'Roti Ulang Tahun 2 Tingkat', 1, 1),
(10, 10, 3, 'Roti Buaya', 5, 5),
(11, 11, 1, 'Roti Ulang Tahun 2 Tingkat', 1, 1),
(12, 12, 4, 'roti donat', 5, 5),
(13, 13, 4, 'roti donat', 5, 5),
(14, 14, 5, 'Roti Donat Kacang', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_produk`, `nama_produk`, `jumlah`, `total`) VALUES
(1, 1, 2, 'Roti Croffle', 1, 8000),
(2, 2, 2, 'Roti Croffle', 1, 8000),
(3, 3, 2, 'Roti Croffle', 1, 8000),
(4, 4, 2, 'Roti Croffle', 2, 16000),
(5, 5, 2, 'Roti Croffle', 15, 15),
(6, 6, 2, 'Roti Croffle', 5, 5),
(7, 6, 3, 'Roti Buaya', 5, 5),
(8, 7, 3, 'Roti Buaya', 15, 15),
(9, 8, 5, 'Roti Donat Kacang', 10, 10);

--
-- Triggers `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `pembelian` BEFORE INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
	UPDATE produk SET stok = stok-NEW.jumlah
    WHERE id_produk = NEW.id_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gaji_karyawan`
--

CREATE TABLE `gaji_karyawan` (
  `id_gaji` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `uang_gaji` int(11) NOT NULL,
  `bulan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gaji_karyawan`
--

INSERT INTO `gaji_karyawan` (`id_gaji`, `id_karyawan`, `uang_gaji`, `bulan`) VALUES
(1, 1, 1000000, '2022-05'),
(3, 1, 1000000, '2022-06'),
(5, 1, 1, '2022-07'),
(6, 2, 2000000, '2022-07');

-- --------------------------------------------------------

--
-- Table structure for table `gambar_produk`
--

CREATE TABLE `gambar_produk` (
  `id_gambar_produk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gambar_produk`
--

INSERT INTO `gambar_produk` (`id_gambar_produk`, `id_produk`, `gambar`) VALUES
(1, 1, 'e1be0724dd9ea7958a09e32872279c98.png'),
(2, 2, '1e655484135b9073e111054607cce3dd.png'),
(3, 3, 'ef6c53e1ae55ed8c6a9518633a4f9b95.png'),
(4, 4, 'de6139a21bca5b43efc62f47cfd85ff6.png'),
(5, 5, '222dac7d60b2da68af72bdfeaa8133e4.png');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_produk`
--

INSERT INTO `jenis_produk` (`id_jenis`, `nama_jenis`, `status`) VALUES
(1, 'Roti Ulang Tahun', 1),
(2, 'Roti Kering', 1),
(3, 'roti basah', 1),
(4, 'roti aja', 1);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `gaji` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `jenis_kelamin`, `posisi`, `no_hp`, `gaji`, `status`, `created_at`) VALUES
(1, 'Ego Duta Taruna Madya Horison', 'Laki-Laki', 'Manager', '085812601646', 1, 1, '2022-06-10'),
(2, 'Daris Tino Pangstu', 'Perempuan', 'Kasir', '082228088427', 2000000, 1, '2022-06-10'),
(3, 'GELAR AYUNINGRUM MALDINI', 'Perempuan', 'Kasir', '085744387612', 1000000, 1, '2022-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `midtrans`
--

CREATE TABLE `midtrans` (
  `id_midtrans` varchar(20) NOT NULL,
  `id_preorder` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `metode` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `midtrans`
--

INSERT INTO `midtrans` (`id_midtrans`, `id_preorder`, `total_bayar`, `metode`, `waktu`, `status`, `url`) VALUES
('12-89776', 12, 6, 'gopay', '2022-07-05 19:53:34', 200, ''),
('14-62083', 14, 6, 'gopay', '2022-07-14 11:58:11', 200, ''),
('2-45734', 2, 40000, 'bank_transfer', '2022-06-10 14:23:22', 202, 'https://app.midtrans.com/snap/v1/transactions/8fe15e29-50a8-4a34-82d6-6a18508563ec/pdf'),
('6-43198', 6, 262000, 'gopay', '2022-06-11 22:37:21', 202, ''),
('8-87259', 8, 2, 'gopay', '2022-06-28 18:46:46', 200, '');

-- --------------------------------------------------------

--
-- Table structure for table `modal`
--

CREATE TABLE `modal` (
  `id_modal` int(11) NOT NULL,
  `total_modal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_edit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modal`
--

INSERT INTO `modal` (`id_modal`, `total_modal`, `tanggal`, `tanggal_edit`) VALUES
(1, 200000, '2022-06-10', '2022-06-10'),
(5, 12, '2022-07-05', '0000-00-00'),
(6, 115, '2022-07-14', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_preorder` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `id_daerah` int(50) NOT NULL,
  `alamat` text NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_preorder`, `nama`, `email`, `no_hp`, `id_daerah`, `alamat`, `catatan`) VALUES
(1, 1, 'Ego', '', '085812601646', 1, 'Jl. Pahlawan No. 24C', ''),
(2, 2, 'Jose C', 'egooduta2@gmail.com', '085812601646', 1, 'Jl. Serayu no. 76', 'Titipkan ke satpam'),
(3, 3, 'Ego Duta', '', '085812601646', 2, 'Jl. Pesantren VII', ''),
(4, 4, 'Ego Duta', '', '085812601646', 2, 'Jl. Pesantren VII', ''),
(5, 5, 'Ego Duta', 'egoduta@gmail.com', '085812601646', 2, 'Jl. Pesantren VII', 'Mohon ditambahkan \"HBD Ibu\" pada roti ulang tahun'),
(6, 6, 'Daris Tino', 'dtp970188@gmail.com', '082228088427', 2, 'Jl. Pesantren VII', 'Mohon tambahkan ucapan selamat ulang tahun'),
(7, 7, 'Jaka Mahardika', 'mahardika45@gmail.com', '081837233432', 1, 'Ds. Magedang RT 3 RW 1 ', ''),
(8, 8, 'a', 'egooduta2@gmail.com', '123', 1, 'jl a', 'asd'),
(9, 9, 'Ego', '', '085812601646', 1, 'Jl. Dandang gendis no 12-15', ''),
(10, 10, 'ego', 'egooduta@gmail.com', '085812601646', 1, 'Jl. Dandanggendis no 12-15', 'dikirim pagi'),
(11, 11, 'Duta', '', '085812601646', 1, 'Jl. Dandanggendis no 12-15', ''),
(12, 12, 'Ego Duta', 'egooduta2@gmail.com', '085812601646', 1, 'jl.dandanggendis no12-15', 'sebelum jam 12 siang'),
(13, 13, 'dita cantik', 'ditaaazizah08@gmail.com', '081328538419', 2, 'jl banjaran', 'sebelum jam 6'),
(14, 14, 'Ego', 'egooduta2@gmail.com', '123', 1, 'Jl. Letjen suprapto no 12', '');

-- --------------------------------------------------------

--
-- Table structure for table `preorder`
--

CREATE TABLE `preorder` (
  `id_preorder` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `metode` varchar(55) NOT NULL,
  `tanggal_pesan` varchar(255) NOT NULL,
  `tanggal_dikirim` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `preorder`
--

INSERT INTO `preorder` (`id_preorder`, `jumlah`, `metode`, `tanggal_pesan`, `tanggal_dikirim`, `status`) VALUES
(1, 250000, 'Offline', '2022-06-10 14:18:13', '2022-06-14', 'Selesai'),
(2, 40000, 'Online', '2022-06-10 14:23:14', '2022-06-15', 'Selesai'),
(3, 250000, 'Offline', '2022-06-10 21:24:51', '2022-06-20', 'Menunggu Pengiriman'),
(4, 250000, 'Offline', '2022-06-10 21:32:05', '2022-06-20', 'Menunggu Pengiriman'),
(5, 262000, 'Online', '2022-06-11 15:12:34', '2022-06-20', 'Selesai'),
(6, 262000, 'Online', '2022-06-11 22:35:32', '2022-06-20', 'Selesai'),
(7, 42000, 'Online', '2022-06-14 02:45:48', '2022-06-17', 'Menunggu Pembayaran'),
(8, 2, 'Online', '2022-06-28 18:46:18', '2022-07-05', 'Menunggu Pengiriman'),
(9, 1, 'Offline', '2022-07-05 19:34:40', '2022-07-15', 'Menunggu Pengiriman'),
(10, 6, 'Online', '2022-07-05 19:36:48', '2022-07-09', 'Menunggu Pembayaran'),
(11, 1, 'Offline', '2022-07-05 19:48:46', '2022-07-15', 'Selesai'),
(12, 6, 'Online', '2022-07-05 19:52:15', '2022-07-15', 'Selesai'),
(13, 6, 'Online', '2022-07-06 19:15:38', '2022-07-11', 'Transaksi Gagal'),
(14, 6, 'Online', '2022-07-14 11:57:12', '2022-07-21', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `status_produk` tinyint(1) NOT NULL,
  `stok` int(11) NOT NULL,
  `min_order` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_jenis`, `nama_produk`, `harga`, `status_produk`, `stok`, `min_order`, `deskripsi`, `created_at`) VALUES
(1, 1, 'Roti Ulang Tahun 2 Tingkat', 1, 1, 0, 1, 'Roti untuk ulang tahun, bebas memilih tema yang diinginkan dengan menghubungi admin untuk berkonsultasi', '2022-06-10'),
(2, 2, 'Roti Croffle', 1, 0, 0, 3, 'Roti yang memiliki berbagai lapisan dimana di setiap lapisan terdapat cream coklat yang manis dan enak', '2022-06-10'),
(3, 2, 'Roti Buaya', 1, 1, 0, 5, 'Roti Berbentuk buaya dengan isian coklat', '2022-07-05'),
(4, 2, 'roti donat', 1, 1, 20, 5, 'Roti dengan toping cream serta mesis coklat', '2022-07-05'),
(5, 2, 'Roti Donat Kacang', 1, 1, 0, 5, 'Roti dengan taburan kacang ', '2022-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id_slider`, `gambar`, `status`) VALUES
(1, 'slider-11.png', 1),
(5, '1.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `total_belanja` int(11) NOT NULL,
  `metode` varchar(255) NOT NULL,
  `pembayaran` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `total_belanja`, `metode`, `pembayaran`, `status`, `tanggal`) VALUES
(1, 8000, 'Offline', 'Tunai', 'Selesai', '2022-06-10 14:17:28'),
(2, 8000, 'Offline', 'Tunai', 'Selesai', '2022-06-10 19:51:19'),
(3, 8000, 'Offline', 'Tunai', 'Selesai', '2022-06-10 20:19:16'),
(4, 16000, 'Offline', 'Tunai', 'Selesai', '2022-06-10 20:32:29'),
(5, 15, 'Offline', 'Tunai', 'Selesai', '2022-06-28 19:16:12'),
(6, 10, 'Offline', 'Tunai', 'Selesai', '2022-07-05 19:33:19'),
(7, 15, 'Offline', 'Tunai', 'Selesai', '2022-07-05 19:46:09'),
(8, 10, 'Offline', 'Tunai', 'Selesai', '2022-07-14 12:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `role`) VALUES
(5, 'Admin', 'admin@gmail.com', '$2y$10$rcqQnQQDFptW5cEXoCDzf.kTOOjYlVydCRSuR0tNYdKOEc4X.s21O', 77),
(8, 'kasir', 'kasir@gmail.com', '$2y$10$IcbPBezEzCo0qaARmylJS.ACNuz39Tjp.1cj5bCpf6pgadpQuF/2y', 24),
(10, 'admin2', 'admin2@gmail.com', '$2y$10$mjLsfE.PRE3tZ2TH1ID3U.iL6xmDIaezDbxlPxl0ZZ3RrRnRd0yY2', 77);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daerah_kirim`
--
ALTER TABLE `daerah_kirim`
  ADD PRIMARY KEY (`id_daerah`);

--
-- Indexes for table `detail_modal`
--
ALTER TABLE `detail_modal`
  ADD PRIMARY KEY (`id_detail_modal`),
  ADD KEY `idModal` (`id_modal`);

--
-- Indexes for table `detail_preorder`
--
ALTER TABLE `detail_preorder`
  ADD PRIMARY KEY (`id_detail_preorder`),
  ADD KEY `preorder` (`id_preorder`),
  ADD KEY `idProduk` (`id_produk`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `detail` (`id_transaksi`),
  ADD KEY `idProduk` (`id_produk`);

--
-- Indexes for table `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  ADD PRIMARY KEY (`id_gaji`),
  ADD KEY `gaji` (`id_karyawan`);

--
-- Indexes for table `gambar_produk`
--
ALTER TABLE `gambar_produk`
  ADD PRIMARY KEY (`id_gambar_produk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `midtrans`
--
ALTER TABLE `midtrans`
  ADD PRIMARY KEY (`id_midtrans`),
  ADD KEY `midtrans_ibfk_1` (`id_preorder`);

--
-- Indexes for table `modal`
--
ALTER TABLE `modal`
  ADD PRIMARY KEY (`id_modal`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `idPreorder` (`id_preorder`);

--
-- Indexes for table `preorder`
--
ALTER TABLE `preorder`
  ADD PRIMARY KEY (`id_preorder`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `jenis` (`id_jenis`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daerah_kirim`
--
ALTER TABLE `daerah_kirim`
  MODIFY `id_daerah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_modal`
--
ALTER TABLE `detail_modal`
  MODIFY `id_detail_modal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_preorder`
--
ALTER TABLE `detail_preorder`
  MODIFY `id_detail_preorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gambar_produk`
--
ALTER TABLE `gambar_produk`
  MODIFY `id_gambar_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `modal`
--
ALTER TABLE `modal`
  MODIFY `id_modal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `preorder`
--
ALTER TABLE `preorder`
  MODIFY `id_preorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_modal`
--
ALTER TABLE `detail_modal`
  ADD CONSTRAINT `modalToDetail` FOREIGN KEY (`id_modal`) REFERENCES `modal` (`id_modal`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_preorder`
--
ALTER TABLE `detail_preorder`
  ADD CONSTRAINT `preorderToDetail` FOREIGN KEY (`id_preorder`) REFERENCES `preorder` (`id_preorder`) ON UPDATE CASCADE,
  ADD CONSTRAINT `produkToDetail` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `produkToDetailT` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksiToDetailT` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON UPDATE CASCADE;

--
-- Constraints for table `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  ADD CONSTRAINT `karyawanToGaji` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE;

--
-- Constraints for table `gambar_produk`
--
ALTER TABLE `gambar_produk`
  ADD CONSTRAINT `produkToGambar` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE CASCADE;

--
-- Constraints for table `midtrans`
--
ALTER TABLE `midtrans`
  ADD CONSTRAINT `preorderToMidtrans` FOREIGN KEY (`id_preorder`) REFERENCES `preorder` (`id_preorder`) ON UPDATE CASCADE;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `preorderToPengiriman` FOREIGN KEY (`id_preorder`) REFERENCES `preorder` (`id_preorder`) ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `jenisToProduk` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_produk` (`id_jenis`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
