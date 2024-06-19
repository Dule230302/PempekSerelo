-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 11:59 AM
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
-- Database: `pempekserelo`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahan` int(11) NOT NULL,
  `nama_bahan` varchar(100) DEFAULT NULL,
  `stok_kg` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bahan`, `nama_bahan`, `stok_kg`, `satuan`) VALUES
(1, 'ikan tenggiri', 2, 'kg'),
(2, 'sagu', 1, ''),
(3, 'bawang putih', 3, ''),
(4, 'cabe', 5, ''),
(5, 'garam', 2, ''),
(6, 'gula', 1, ''),
(7, 'asam jawa', 1, ''),
(8, 'gula merah', 50, ''),
(9, 'kulit ikan', 500, 'ml'),
(10, 'telur', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `namakategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`) VALUES
(10, '  Pempek'),
(11, '  Bawang Goreng'),
(15, 'Paket');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idpembayaran` int(11) NOT NULL,
  `idpenjualan` int(11) NOT NULL,
  `nama` text NOT NULL,
  `tanggaltransfer` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `bukti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`idpembayaran`, `idpenjualan`, `nama`, `tanggaltransfer`, `tanggal`, `bukti`) VALUES
(10, 46, 'Sugeng', '2024-02-03', '2024-02-03 00:00:00', '20240203111952about-1.jpg'),
(11, 50, 'Sugeng', '2024-02-12', '2024-02-12 00:00:00', '20240212125628testimonial-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaranrekening`
--

CREATE TABLE `pembayaranrekening` (
  `idpembayaranrekening` int(11) NOT NULL,
  `namapembayaran` text NOT NULL,
  `norek` text NOT NULL,
  `atasnama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaranrekening`
--

INSERT INTO `pembayaranrekening` (`idpembayaranrekening`, `namapembayaran`, `norek`, `atasnama`) VALUES
(1, ' Transfer Bank BCA', '   2060337821', 'Febby Lailatun Nuzul'),
(2, ' Transfer Bank Mandiri', '1240010307412', 'Febby Lailatun Nuzul');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `idpenjualan` int(11) NOT NULL,
  `notransaksi` text NOT NULL,
  `id` int(11) NOT NULL,
  `tanggalbeli` date NOT NULL,
  `totalbeli` text NOT NULL,
  `alamatpengiriman` text NOT NULL,
  `metodepengiriman` text NOT NULL,
  `totalberat` varchar(255) NOT NULL,
  `kota` text NOT NULL,
  `provinsi` text NOT NULL,
  `ekspedisi` text NOT NULL,
  `layanan` text NOT NULL,
  `ongkir` text NOT NULL,
  `statusbeli` text NOT NULL,
  `resipengiriman` text DEFAULT NULL,
  `waktu` datetime NOT NULL,
  `alasan` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`idpenjualan`, `notransaksi`, `id`, `tanggalbeli`, `totalbeli`, `alamatpengiriman`, `metodepengiriman`, `totalberat`, `kota`, `provinsi`, `ekspedisi`, `layanan`, `ongkir`, `statusbeli`, `resipengiriman`, `waktu`, `alasan`) VALUES
(43, '#INV-20240203104315', 13, '2024-02-03', '10000', 'Jl. Palembang', '', '', '', 'Sumatera Selatan', 'JNE', 'OKE 14,000 3-6', '14000', 'Belum Bayar', '', '2024-02-03 10:43:15', NULL),
(44, '#INV-20240203105725', 13, '2024-02-03', '100000', 'Jl. Palembang', '', '', 'Palembang', 'Sumatera Selatan', 'JNE', 'CTC 10,000 1-2', '10000', 'Belum Bayar', '', '2024-02-03 10:57:25', NULL),
(45, '#INV-20240203105812', 13, '2024-02-03', '200000', 'Jl. Palembang', '', '1', 'Palembang', 'Sumatera Selatan', 'JNE', 'CTC 10,000 1-2', '10000', 'Belum Bayar', '', '2024-02-03 10:58:12', NULL),
(46, '#INV-20240203111939', 13, '2024-02-03', '10000', 'Jl. Palembang', '', '1', 'Palembang', 'Sumatera Selatan', 'JNE', 'CTC 10,000 1-2', '10000', 'Sudah Upload Bukti Pembayaran', '', '2024-02-03 11:19:39', NULL),
(47, '#INV-20240210045417', 13, '2024-02-10', '200000', 'Jl. Palembang', '', '2200', 'Palembang', 'Sumatera Selatan', 'JNE', 'CTC 20,000 1-2', '20000', 'Belum Bayar', '', '2024-02-10 16:54:17', NULL),
(48, '#INV-20240212104637', 13, '2024-02-12', '300000', 'Jl. Palembang', 'Same Day / Instant', '3300', 'Palembang', 'Sumatera Selatan', 'GOSEND SAME DAY / INSTANT', 'Gosend Same Day / Instant', '20000', 'Belum Bayar', '', '2024-02-12 10:46:37', NULL),
(49, '#INV-20240212115346', 13, '2024-02-12', '80000', 'Jl. Palembang', 'Same Day / Instant', '1800', 'Palembang', 'Sumatera Selatan', 'GRABSEND SAME DAY / INSTANT', 'Grabsend Same Day / Instant', '20000', 'Belum Bayar', '', '2024-02-12 11:53:46', NULL),
(50, '#INV-20240212125033', 13, '2024-02-12', '140000', 'Jl. Palembang', 'Same Day / Instant', '2000', 'Palembang', 'Sumatera Selatan', 'GOSEND SAME DAY / INSTANT', 'Gosend Same Day / Instant', '10000', 'Selesai', '', '2024-02-12 12:50:33', NULL),
(61, '#INV-20240612102628', 15, '2024-06-12', '120000', 'Asrama Putri Ayu', 'Instant', '15000', 'Jakarta Timur', 'DKI Jakarta', 'GOJEK', 'Gojek', '0', 'Pesanan Di Kembalikan', NULL, '2024-06-12 22:26:28', 'Pempek sudah basi'),
(62, '#INV-20240613031243', 15, '2024-06-13', '100000', 'Asrama Putri Ayu', 'Instant', '12500', 'Jakarta Timur', 'DKI Jakarta', 'GOJEK', 'Gojek', '0', 'Pesanan Di Batalkan', NULL, '2024-06-13 03:12:43', 'Kenyang');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `fotoprofil` varchar(255) NOT NULL,
  `level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `telepon`, `alamat`, `fotoprofil`, `level`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin', '0812345678', 'Palembang', 'Untitled.png', 'Admin'),
(13, 'Sugeng', 'sugeng@gmail.com', 'sugeng', '08952815929', 'Jl. Palembang', 'Untitled.png', 'Pelanggan'),
(15, 'udin', 'udin@gmail.com', 'udin', '081256816298', 'Asrama Putri Ayu', 'Untitled.png', 'Pelanggan'),
(16, 'Owner', 'pemilik@gmail.com', 'pemilik', '13213', '-', 'Untitled.png', 'Pemilik'),
(17, 'Abdul Malik Aziz', 'abdulmalikaziz507@gmail.com', 'abdul123', '085922130098', 'jl.intisari raya', 'Untitled.png', 'Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `idpenjualandetail` int(11) NOT NULL,
  `idpenjualan` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `nama` text NOT NULL,
  `harga` text NOT NULL,
  `berat` text DEFAULT NULL,
  `subberat` text DEFAULT NULL,
  `subharga` text NOT NULL,
  `jumlah` text NOT NULL,
  `statusulasan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`idpenjualandetail`, `idpenjualan`, `idproduk`, `nama`, `harga`, `berat`, `subberat`, `subharga`, `jumlah`, `statusulasan`) VALUES
(52, 43, 32, 'Pempek Kapal Selam', '10000', '', '', '10000', '1', ''),
(53, 44, 31, 'Paket 30 Pcs', '100000', '', '', '100000', '1', ''),
(54, 45, 31, 'Paket 30 Pcs', '100000', '', '', '200000', '2', ''),
(55, 46, 32, 'Pempek Kapal Selam', '10000', '', '', '10000', '1', ''),
(56, 47, 31, 'Paket 30 Pcs', '100000', '', '', '200000', '2', ''),
(57, 48, 31, 'Paket 30 Pcs', '100000', '', '', '300000', '3', ''),
(58, 49, 29, 'Paket 10 Pcs', '40000', '', '', '80000', '2', ''),
(59, 50, 30, 'Paket 20 Pcs', '70000', '', '', '140000', '2', ''),
(60, 51, 32, 'Pempek Kapal Selam', '10000', '', '', '10000', '1', ''),
(61, 52, 32, 'Pempek Kapal Selam', '10000', '', '', '10000', '1', ''),
(62, 53, 32, 'Pempek Kapal Selam', '10000', '', '', '10000', '1', ''),
(63, 54, 32, 'Pempek Kapal Selam', '10000', '', '', '20000', '2', ''),
(66, 61, 3, 'Pempek Lenjer', '4000', NULL, NULL, '120000', '30', NULL),
(67, 62, 3, 'Pempek Lenjer', '4000', NULL, NULL, '100000', '25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `namaproduk` text NOT NULL,
  `hargaproduk` text NOT NULL,
  `beratproduk` text NOT NULL,
  `fotoproduk` text NOT NULL,
  `deskripsiproduk` text NOT NULL,
  `tgl_produksi` date DEFAULT NULL,
  `tgl_expired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `namaproduk`, `hargaproduk`, `beratproduk`, `fotoproduk`, `deskripsiproduk`, `tgl_produksi`, `tgl_expired`) VALUES
(3, 10, 'Pempek Lenjer', '4000', '500', '640691448f9d2.jpg', '<p>Deskripsi Produk :<br />\r\nKandungan Bahan: Ikan Giling, tepung tapioka, tepung terigu, garam, gula, bawang putih, Telur, air<br />\r\nVarian / Rasa: Pempek Lenjer</p>\r\n\r\n<p>&quot;Selamat datang dalam pengalaman kuliner yang autentik dengan Pempek Lenjer kami! Dibuat dengan bahan-bahan berkualitas tinggi dan resep tradisional, setiap pempek lenjer kami menghadirkan cita rasa Palembang yang khas. Diracik dengan teliti untuk mencapai tekstur yang kenyal namun lembut, setiap gigitan menghadirkan kelezatan yang memikat. Cocok dinikmati sebagai hidangan utama atau camilan istimewa, Pempek Lenjer kami pasti akan memuaskan selera Anda. Pesan sekarang dan nikmati kelezatan sejati dari tanah air!&quot;</p>\r\n\r\n<p>Sudah termasuk kuah cuko.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2024-06-12', '2024-06-15'),
(4, 10, 'Pempek Kulit', '4000', '500', '40ff5973-31a7-407f-be12-b3d3af335023.webp', '<p>Deskripsi Produk :<br />\r\nKandungan Bahan: Kulit Ikan, Ikan Giling, tepung tapioka, tepung terigu, garam, gula, bawang putih, Telur, air<br />\r\nVarian / Rasa: Pempek Kulit</p>\r\n\r\n<p>&quot;Jelajahi kelezatan unik Palembang dengan pempek kulit kami! Dibuat dengan cinta menggunakan bahan-bahan terbaik dan resep turun-temurun, setiap pempek kulit kami menawarkan kombinasi yang sempurna antara kenyal dan gurih. Sempurna untuk dinikmati kapan saja, di mana saja. Pesan sekarang dan buat momen makan Anda lebih menarik!&quot;</p>\r\n\r\n<p>Sudah termasuk kuah cuko.</p>\r\n', '2024-06-04', '2024-06-11'),
(22, 10, 'Pempek Telur Kecil', '4000', '500', 'Cara Membuat Pempek Palembang Isi Telur.jpg', '<p>Deskripsi Produk :<br />\r\nKandungan Bahan: Ikan Giling, tepung tapioka, tepung terigu, garam, gula, bawang putih, Telur, air<br />\r\nVarian / Rasa: PempekTelur Kecil</p>\r\n\r\n<p>&quot;Nikmati kelezatan yang disukai banyak orang dengan pempek telur kecil kami! Dibuat dengan telur pilihan dan campuran bumbu khas, setiap gigitan pempek telur kecil kami menghadirkan cita rasa yang lezat dan memuaskan. Cocok untuk camilan di siang atau malam hari, acara keluarga, atau bahkan sebagai hidangan pembuka yang istimewa. Pesan sekarang dan nikmati kelezatan yang tak tertandingi!&quot;</p>\r\n\r\n<p>Sudah termasuk kuah cuko.</p>\r\n', '2024-06-20', '2024-06-27'),
(26, 11, 'Bawang Goreng 100 Gram', '18000', '100', 'no_brand_bawang_goreng_kemasan_toples_bawang_renyah_-_bawang_goreng_murni_bagor_-_taburan_nasi_full02_rltvmmtc.jpg', '<p>Deskripsi Produk :<br />\r\nKandungan Bahan: Bawang Merah, tepung tapioka,&nbsp;garam<br />\r\nVarian / Rasa: Original<br />\r\nBerat Bersih: 100 Gram</p>\r\n\r\n<p>&quot;Tambahkan sentuhan renyah dan aroma harum pada hidangan Anda dengan bawang goreng berkualitas tinggi kami! Dikemas dalam kemasan 100 gram, bawang goreng kami dibuat dari bawang pilihan yang dipotong tipis dan digoreng hingga sempurna. Cocok sebagai taburan untuk mie, nasi goreng, atau sup, atau gunakan sebagai topping untuk salad dan hidangan lainnya. Dapatkan sekarang untuk menyempurnakan rasa hidangan Anda!&quot;</p>\r\n', '2024-06-11', '2024-06-13'),
(27, 11, 'Bawang Goreng 200 Gram', '40000', '200', 'dac932808555059654e92ddf95869de5.jpg', '<p>Deskripsi Produk :<br />\r\nKandungan Bahan: Bawang Merah, tepung tapioka,&nbsp;garam<br />\r\nVarian / Rasa: Original<br />\r\nBerat Bersih: 200 Gram</p>\r\n\r\n<p>&quot;Nikmati kelezatan renyah dan kaya aroma dengan bawang goreng 200 gram kami! Diproses dengan teliti dari bawang pilihan, bawang goreng kami menambahkan sentuhan lezat pada hidangan favorit Anda. Ideal sebagai taburan untuk mie, nasi goreng, atau sup, atau gunakan sebagai topping untuk salad dan hidangan lainnya. Dapatkan sekarang dan tambahkan kelezatan ekstra pada masakan Anda!&quot;</p>\r\n', '2024-06-13', '2024-06-20'),
(28, 15, 'Paket Isi 5 Pcs', '20000', '800', 'pempek_mertua_by_ibu_dewi_paket_pempek_ikan_tenggiri_-_campur_isi_12pcs_-adaan-_kulit-_lenjer-_isi_telur-_full01_lqa3hxy3.jpg', '<p>Deskripsi Produk :<br />\r\nKandungan Bahan: Ikan Giling, Kulit Ikan, tepung tapioka, tepung terigu, garam, gula, bawang putih, Telur, air<br />\r\nVarian / Rasa: Pempek Lenjer, Kulit, Dan Telur kecil</p>\r\n\r\n<p>&quot;Nikmati pengalaman makan yang autentik dengan Paket Pempek isi 5 Lenjer, Kulit, dan Telur Kecil kami! Setiap paket berisi lima lenjer pempek lezat, dilengkapi dengan kulit pempek yang kenyal dan telur kecil yang gurih. Dibuat dengan bahan-bahan berkualitas tinggi dan resep tradisional, setiap gigitan membawa Anda ke Palembang yang kaya cita rasa. Cocok untuk disajikan di acara keluarga, pesta, atau sebagai camilan istimewa di rumah. Pesan sekarang dan nikmati kelezatan sejati dari tanah air!&quot;</p>\r\n\r\n<p>Sudah termasuk kuah cuko.</p>\r\n', '2024-06-11', '2024-06-14'),
(29, 15, 'Paket 10 Pcs', '40000', '900', 'pempek_mertua_by_ibu_dewi_paket_pempek_ikan_tenggiri_-_campur_isi_12pcs_-adaan-_kulit-_lenjer-_isi_telur-_full01_lqa3hxy3.jpg', '<p>Deskripsi Produk :<br />\r\nKandungan Bahan: Ikan Giling, Kulit Ikan, tepung tapioka, tepung terigu, garam, gula, bawang putih, Telur, air<br />\r\nVarian / Rasa: Pempek Lenjer, Kulit, Dan Telur kecil</p>\r\n\r\n<p>&quot;Kreasikan pengalaman kuliner Anda dengan Paket Pempek isi 10 Lenjer, Kulit, dan Telur Kecil kami! Dalam setiap paket, Anda akan menemukan sepuluh lenjer pempek yang lezat, lengkap dengan kulit pempek yang kenyal dan telur kecil yang gurih. Diracik dengan teliti menggunakan bahan-bahan berkualitas terbaik dan resep turun-temurun, setiap hidangan memberikan sentuhan autentik Palembang yang tak tertandingi. Cocok untuk segala kesempatan, mulai dari acara keluarga hingga pesta bersama teman-teman. Pesan sekarang dan hadirkan kelezatan istimewa di meja makan Anda!&quot;</p>\r\n\r\n<p>Sudah termasuk kuah cuko.</p>\r\n', '2024-06-21', '2024-06-26'),
(30, 15, 'Paket 20 Pcs', '70000', '1000', 'pempek_mertua_by_ibu_dewi_paket_pempek_ikan_tenggiri_-_campur_isi_12pcs_-adaan-_kulit-_lenjer-_isi_telur-_full01_lqa3hxy3.jpg', '<p>Deskripsi Produk :<br />\r\nKandungan Bahan: Ikan Giling, Kulit Ikan, tepung tapioka, tepung terigu, garam, gula, bawang putih, Telur, air<br />\r\nVarian / Rasa: Pempek Lenjer, Kulit, Dan Telur kecil</p>\r\n\r\n<p>&quot;Kreasikan pengalaman kuliner Anda dengan Paket Pempek isi 20 Lenjer, Kulit, dan Telur Kecil kami! Dalam setiap paket, Anda akan menemukan sepuluh lenjer pempek yang lezat, lengkap dengan kulit pempek yang kenyal dan telur kecil yang gurih. Diracik dengan teliti menggunakan bahan-bahan berkualitas terbaik dan resep turun-temurun, setiap hidangan memberikan sentuhan autentik Palembang yang tak tertandingi. Cocok untuk segala kesempatan, mulai dari acara keluarga hingga pesta bersama teman-teman. Pesan sekarang dan hadirkan kelezatan istimewa di meja makan Anda!&quot;</p>\r\n\r\n<p>Sudah termasuk kuah cuko.</p>\r\n', '2024-06-14', '2024-06-24'),
(31, 15, 'Paket 30 Pcs', '100000', '1100', 'pempek_mertua_by_ibu_dewi_paket_pempek_ikan_tenggiri_-_campur_isi_12pcs_-adaan-_kulit-_lenjer-_isi_telur-_full01_lqa3hxy3.jpg', '<p>Deskripsi Produk :<br />\r\nKandungan Bahan: Ikan Giling, Kulit Ikan, tepung tapioka, tepung terigu, garam, gula, bawang putih, Telur, air<br />\r\nVarian / Rasa: Pempek Lenjer, Kulit, Dan Telur kecil</p>\r\n\r\n<p>&quot;Kreasikan pengalaman kuliner Anda dengan Paket Pempek isi 30 Lenjer, Kulit, dan Telur Kecil kami! Dalam setiap paket, Anda akan menemukan sepuluh lenjer pempek yang lezat, lengkap dengan kulit pempek yang kenyal dan telur kecil yang gurih. Diracik dengan teliti menggunakan bahan-bahan berkualitas terbaik dan resep turun-temurun, setiap hidangan memberikan sentuhan autentik Palembang yang tak tertandingi. Cocok untuk segala kesempatan, mulai dari acara keluarga hingga pesta bersama teman-teman. Pesan sekarang dan hadirkan kelezatan istimewa di meja makan Anda!&quot;</p>\r\n\r\n<p>Sudah termasuk kuah cuko.</p>\r\n', '2024-06-15', '2024-06-21'),
(32, 10, 'Pempek Kapal Selam', '10000', '1000', '39366e74-5cb2-410e-8916-214b50daf177.jpg', '<p>Deskripsi Produk :<br />\r\nKandungan Bahan: Ikan Giling,&nbsp;tepung tapioka, tepung terigu, garam, gula, bawang putih, Telur, air<br />\r\nVarian / Rasa: Pempek Kapal Selam</p>\r\n\r\n<p>&quot;Kenikmatan sejati Palembang hadir dalam setiap gigitan Pempek Kapal Selam kami! Dibuat dengan cinta dan keterampilan, pempek kapal selam kami adalah kombinasi yang sempurna antara lembaran pempek yang kenyal dan isi telur puyuh yang gurih. Setiap gigitan memenuhi lidah Anda dengan cita rasa yang kaya dan pengalaman kuliner yang memuaskan. Cocok untuk disajikan sebagai hidangan utama yang istimewa atau camilan yang menggugah selera. Pesan sekarang dan nikmati petualangan rasa yang tak terlupakan dengan pempek kapal selam kami!&quot;</p>\r\n\r\n<p>Sudah termasuk kuah cuko.</p>\r\n', '2024-06-14', '2024-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `idstok` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggalstok` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`idstok`, `idproduk`, `stok`, `tanggalstok`) VALUES
(4, 3, 10, '2024-06-13'),
(5, 4, 10, '2024-06-13'),
(6, 22, 15, '2024-06-13'),
(7, 26, 10, '2024-06-13'),
(8, 27, 5, '2024-06-13'),
(9, 28, 5, '2024-06-13'),
(10, 29, 5, '2024-06-13'),
(11, 30, 5, '2024-06-13'),
(12, 31, 5, '2024-06-13'),
(13, 32, 10, '2024-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `idsupplier` int(11) NOT NULL,
  `namasupplier` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `namabahan` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`idsupplier`, `namasupplier`, `alamat`, `telepon`, `namabahan`, `harga`) VALUES
(2, 'A', 'Halo', '123456', 'Ikan Mati', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `idulasan` int(11) NOT NULL,
  `idpenjualan` int(11) NOT NULL,
  `idproduk` text NOT NULL,
  `idpengguna` text NOT NULL,
  `bintang` text NOT NULL,
  `ulasan` text NOT NULL,
  `tampilannama` text NOT NULL,
  `foto` text NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`idulasan`, `idpenjualan`, `idproduk`, `idpengguna`, `bintang`, `ulasan`, `tampilannama`, `foto`, `waktu`) VALUES
(4, 41, '4', '13', '5', 'gg', 'Tampilkan Nama', 'no-img.png', '2024-01-10 16:47:31'),
(5, 42, '32', '15', '5', 'mantap geys', 'Anonim', 'pngtree-cartoon-color-simple-male-avatar-png-image_1934459.jpg', '2024-01-31 15:34:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idpembayaran`),
  ADD KEY `idbeli` (`idpenjualan`);

--
-- Indexes for table `pembayaranrekening`
--
ALTER TABLE `pembayaranrekening`
  ADD PRIMARY KEY (`idpembayaranrekening`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`idpenjualan`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idpenjualandetail`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `id_kategori` (`idkategori`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`idstok`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idsupplier`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`idulasan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `idpembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pembayaranrekening`
--
ALTER TABLE `pembayaranrekening`
  MODIFY `idpembayaranrekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `idpenjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `idpenjualandetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idsupplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `idulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`idpenjualan`) REFERENCES `pemesanan` (`idpenjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
