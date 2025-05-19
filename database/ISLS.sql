-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 13, 2024 at 03:46 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21485750_prototype2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_hasil_audit`
--

CREATE TABLE `dokumen_hasil_audit` (
  `id_berkas_hasil_audit` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `gambar_path` varchar(255) NOT NULL,
  `id_audit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_karyawan`
--

CREATE TABLE `dokumen_karyawan` (
  `id_berkas_karyawan` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `gambar_path` varchar(255) NOT NULL,
  `idkaryawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen_karyawan`
--

INSERT INTO `dokumen_karyawan` (`id_berkas_karyawan`, `nama_berkas`, `pdf_path`, `nama_gambar`, `gambar_path`, `idkaryawan`) VALUES
(7, 'Sertifikat B Jepang (17).pdf', '../lihat_detail/dokumen_karyawan/Sertifikat B Jepang (17).pdf', '', '', 2),
(8, '', '', '(Drakorasia.co) TFTO Eps - 14 720p.mkv_snapshot_00.25.45_[2023.12.06_17.48.02].jpg', '../lihat_detail/gambar_karyawan/(Drakorasia.co) TFTO Eps - 14 720p.mkv_snapshot_00.25.45_[2023.12.06_17.48.02].jpg', 2),
(9, '', '', '222222.PNG', '../lihat_detail/gambar_karyawan/222222.PNG', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_legal`
--

CREATE TABLE `dokumen_legal` (
  `id_berkas` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `gambar_path` varchar(255) NOT NULL,
  `id_legal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen_legal`
--

INSERT INTO `dokumen_legal` (`id_berkas`, `nama_berkas`, `pdf_path`, `nama_gambar`, `gambar_path`, `id_legal`) VALUES
(14, '', '', 'WhatsApp Image 2023-11-10 at 13.33.30.jpeg', '../lihat_detail/gambar-gambar_legal/WhatsApp Image 2023-11-10 at 13.33.30.jpeg', 24),
(20, '', '', 'IMG_5006.JPG', '../lihat_detail/gambar-gambar_legal/IMG_5006.JPG', 24),
(45, 'PROTOTYPE SISTEM MHG.pdf', '../lihat_detail/dokumen/PROTOTYPE SISTEM MHG.pdf', '', '', 24),
(46, 'Surat_Permintaan_Barang (4).pdf', '../lihat_detail/dokumen/Surat_Permintaan_Barang (4).pdf', '', '', 24);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_legal_infrastruktur`
--

CREATE TABLE `dokumen_legal_infrastruktur` (
  `id_berkas_infrastruktur` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `gambar_path` varchar(255) NOT NULL,
  `id_legalinfrastruktur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen_legal_infrastruktur`
--

INSERT INTO `dokumen_legal_infrastruktur` (`id_berkas_infrastruktur`, `nama_berkas`, `pdf_path`, `nama_gambar`, `gambar_path`, `id_legalinfrastruktur`) VALUES
(47, '', '', 'IMG_20211010_184306.jpg', '../lihat_detail/gambar_legal_infrastruktur/IMG_20211010_184306.jpg', 6),
(48, 'Surat_Permintaan_Barang.pdf', '../lihat_detail/dokumen_infrastruktur/Surat_Permintaan_Barang.pdf', '', '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_legal_people`
--

CREATE TABLE `dokumen_legal_people` (
  `id_berkas_people` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `gambar_path` varchar(255) NOT NULL,
  `id_legalpeople` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen_legal_people`
--

INSERT INTO `dokumen_legal_people` (`id_berkas_people`, `nama_berkas`, `pdf_path`, `nama_gambar`, `gambar_path`, `id_legalpeople`) VALUES
(6, 'Sertifikat B Jepang (17).pdf', '../lihat_detail/dokumen_people/Sertifikat B Jepang (17).pdf', '', '', 1),
(9, '', '', 'WhatsApp Image 2021-09-18 at 12.27.41 (1).jpeg', '../lihat_detail/gambar-gambar_people/WhatsApp Image 2021-09-18 at 12.27.41 (1).jpeg', 1),
(13, 'Export Data Legal Operasional (1).pdf', '../lihat_detail/dokumen_people/Export Data Legal Operasional (1).pdf', '', '', 8),
(14, '', '', 'photo_6321113793312178518_w.jpg', '../lihat_detail/gambar-gambar_people/photo_6321113793312178518_w.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_lokasi_barang`
--

CREATE TABLE `dokumen_lokasi_barang` (
  `id_lok_barang` int(11) NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `gambar_path` varchar(255) NOT NULL,
  `idbarang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen_lokasi_barang`
--

INSERT INTO `dokumen_lokasi_barang` (`id_lok_barang`, `nama_gambar`, `gambar_path`, `idbarang`) VALUES
(1, 'IMG_20211010_170005.jpg', '../lihat_detail/lokasi_barang_stok/IMG_20211010_170005.jpg', 84),
(4, 'IMG_20211010_170005.jpg', '../lihat_detail/lokasi_barang_stok/IMG_20211010_170005.jpg', 98),
(6, 'IMG_20211010_170005.jpg', '../lihat_detail/lokasi_barang_stok/IMG_20211010_170005.jpg', 117);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_supplier`
--

CREATE TABLE `dokumen_supplier` (
  `id_berkas_supplier` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `gambar_path` varchar(255) NOT NULL,
  `idsupplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen_supplier`
--

INSERT INTO `dokumen_supplier` (`id_berkas_supplier`, `nama_berkas`, `pdf_path`, `nama_gambar`, `gambar_path`, `idsupplier`) VALUES
(7, 'Surat_Permintaan_Barang.pdf', '../lihat_detail/dokumen_supplier/Surat_Permintaan_Barang.pdf', '', '', 14),
(8, '', '', 'IMG_20211010_184306.jpg', '../lihat_detail/gambar_supplier/IMG_20211010_184306.jpg', 14),
(12, 'Kanji book.pdf', '../lihat_detail/dokumen_supplier/Kanji book.pdf', '', '', 20),
(13, '', '', 'Poster-Langkah-Terapkan-3-R-Ilustrasi-Krem-3-page-0001.jpg', '../lihat_detail/gambar_supplier/Poster-Langkah-Terapkan-3-R-Ilustrasi-Krem-3-page-0001.jpg', 20);

-- --------------------------------------------------------

--
-- Table structure for table `email_notifikasi`
--

CREATE TABLE `email_notifikasi` (
  `id_email` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_notifikasi`
--

INSERT INTO `email_notifikasi` (`id_email`, `email`) VALUES
(10, 'syafiqqu10@gmail.com'),
(14, 'salwaannafi36@gmail.com'),
(16, 'mspasyazakaria@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_audit`
--

CREATE TABLE `hasil_audit` (
  `id_audit` int(11) NOT NULL,
  `jenis_audit` varchar(255) NOT NULL,
  `tanggal_audit` date NOT NULL,
  `badan_audit` varchar(255) NOT NULL,
  `dokumentasi` varchar(255) NOT NULL,
  `hasil_audit` double NOT NULL,
  `temuan_audit` text NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `user_edit_hasil_audit` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `idkaryawan` int(11) NOT NULL,
  `namakaryawan` varchar(100) NOT NULL,
  `foto_karyawan` varchar(255) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `alamat_karyawan` varchar(255) NOT NULL,
  `no_telepon_karyawan` varchar(50) NOT NULL,
  `no_ktp` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `keterangan_karyawan` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_edit_karyawan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`idkaryawan`, `namakaryawan`, `foto_karyawan`, `nik`, `divisi`, `alamat_karyawan`, `no_telepon_karyawan`, `no_ktp`, `status`, `keterangan_karyawan`, `updated_at`, `user_edit_karyawan`) VALUES
(10, 'SUJINO', 'IMG-20221220-WA0009-removebg-preview-removebg-preview.png', '4009', 'SECURITY', 'SUKABUMI', '085860633048', '3202260903830001', 'TETAP', '-', '2024-01-24 06:43:52', 'legal'),
(11, 'ISKANDAR MUHAMAD', 'IMG-20221220-WA0001-removebg-preview-removebg-preview.png', '4004', 'SECURITY', 'KP.BABAKAN RT 2 / RW 1  BANJAR WARU CIAWI BOGOR JAWA BARAT KODE POS 0', '082210789908', '3201240811860001', 'TETAP', '-', '2024-01-24 06:46:39', 'legal'),
(12, 'SYARIF HIDAYATULLAH', 'IMG-20221220-WA0002-removebg-preview-removebg-preview.png', '4007', 'SECURITY', 'KP.TANGKIL RT 1 / RW 5  KATULAMPA BOGOR TIMUR KOTA BOGOR JAWA BARAT KODE POS 16710', '085695371597', '3271021501800020', 'TETAP', '-', '2024-01-24 06:48:55', 'legal'),
(13, 'ASEP HENDRA', 'IMG-20221220-WA0003-removebg-preview-removebg-preview.png', '4002', 'SECURITY', 'KP NARINGGUL CIASIN RT 003  RW 010, DS. BENDUNGAN, KEC. CIAWI KAB. BOGOR  16720', '087874127495', '3205151610810002', 'TETAP', '-', '2024-01-24 06:51:06', 'legal'),
(14, 'AZIZ', 'IMG-20221220-WA0004-removebg-preview-removebg-preview.png', '4003', 'SECURITY', 'BOJONG ENYOD JL. ARTZIMAR III RT 1 / RW 3  TEGAL GUNDIL KOTA BOGOR UTARA KOTA BOGOR JAWA BARAT KODE POS 16152', '081211252505', '3271050205770008', 'TETAP', '-', '2024-01-24 06:52:34', 'legal'),
(15, 'ENDANG', 'IMG-20221220-WA0005-removebg-preview-removebg-preview.png', '4008', 'SECURITY', 'KP.CICADAS RT 1 / RW 6  CICADAS GUNUNG PUTRI BOGOR JAWA BARAT KODE POS 16964', '081316167252', '3201022004730015', 'TETAP', '-', '2024-01-24 06:54:43', 'legal'),
(16, 'ADE ABDUL RAHMAN', 'IMG-20221220-WA0006-removebg-preview-removebg-preview(1).png', '4044', 'SECURITY', 'KP.CICADAS RT 4 / RW 6  CICADAS GUNUNG PUTRI BOGOR JAWA BARAT KODE POS 16964', '085888148124', '3201320402880003', 'TETAP', '-', '2024-01-24 06:59:26', 'legal'),
(17, 'ISMAIL', 'IMG-20221220-WA0007-removebg-preview-removebg-preview.png', '4005', 'SECURITY', 'BOJONG ENYOD JL. ARTZIMAR III RT 1 / RW 3  TEGAL GUNDIL KOTA BOGOR UTARA KOTA BOGOR JAWA BARAT KODE POS 16152', '082110925740', '3271052209750007', 'TETAP', '-', '2024-01-24 07:00:53', 'legal'),
(18, 'LIFAN RAHANG METAN', 'IMG-20221220-WA0008-removebg-preview-removebg-preview.png', '4006', 'SECURITY', 'KP.MEKAR RT 2 / RW 8  PANDAN SARI CIAWI BOGOR JAWA BARAT KODE POS 16720', '081284004809', '3201241608800011', 'TETAP', '-', '2024-01-24 07:02:31', 'legal'),
(19, 'YAYAN SOFIAN', 'IMG_20210818_153847-removebg-preview.png', '1003', 'KEPALA OPERASIONAL', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '0895346489676', '3201240810760001', 'TETAP', '-', '2024-01-24 07:47:54', 'legal'),
(20, 'SUTARJO', 'IMG_20210818_153847-removebg-preview.png', '1002', 'ADMINISTRASI', 'KP. BAMBON RT. 003 RW. 007 RAGAJAYA BOJONG GEDE 16320', '081298721606', '3201131004750006', 'TETAP', '-', '2024-01-24 08:00:00', 'legal'),
(21, 'AGUS MULYANA', 'IMG_20210818_153847-removebg-preview.png', '1005', 'PRODUKSI', 'KP. SESEUPAN RT. 003 RW. 006 DESA BENDUNGAN KEC. CIAWI KABUPATEN BOGOR', '089606059392', '3201240508750007', 'TETAP', '-', '2024-01-24 07:50:04', 'legal'),
(22, 'SUPRIADI', 'IMG_20210818_153847-removebg-preview.png', '1006', 'MAINTENANCE', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '088224955569', '3201240809820004', 'TETAP', '-', '2024-01-24 07:57:31', 'legal'),
(23, 'DEDEN SUHERMAN', 'IMG_20210818_153847-removebg-preview.png', '1009', 'CLEANING SERVICE', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '085894940934', '3201240408820007', 'TETAP', '-', '2024-01-25 06:49:39', 'legal'),
(24, 'SURYANA', 'IMG_20210818_153847-removebg-preview.png', '1014', 'DRIVER', 'KP NARINGGUL CIASIN RT 003/RW 010, DESA. BENDUNGAN, KEC. CIAWI KAB. BOGOR  16720', '0895349050776', '3201241210830008', 'TETAP', '-', '2024-01-25 06:25:52', 'legal'),
(25, 'SUDARMA', 'IMG_20210818_153847-removebg-preview.png', '1013', 'MAINTENANCE', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '083819492795', '3201241408790004', 'TETAP', '-', '2024-01-25 06:27:00', 'legal'),
(26, 'SANUDIN', 'IMG_20210818_153847-removebg-preview.png', '1004', 'PRODUKSI', 'JLN PARUNG BANTENG. GG. PEMUDA, RT: 001/ 001, KEL.  KATULAMPA, KEC.  KOTA BOGOR TIMUR, KOTA BOGOR 16144', '081315650135', '3271021910730005', 'TETAP', '-', '2024-01-25 06:28:06', 'legal'),
(27, 'AGUS JUHARA', 'IMG_20210818_153847-removebg-preview.png', '1018', 'PRODUKSI', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '0895386130606', '3201241608820002', 'TETAP', '-', '2024-01-25 06:29:08', 'legal'),
(28, 'APIPUDIN', 'IMG_20210818_153847-removebg-preview.png', '1017', 'PRODUKSI', 'KP NARINGGUL CIASIN RT 003/RW 010, DESA. BENDUNGAN, KEC. CIAWI KAB. BOGOR  16720', '083895766744', '3201242006750004', 'TETAP', '-', '2024-01-25 06:35:00', 'legal'),
(29, 'BAMBANG DWI WIDODO', 'IMG_20210818_153847-removebg-preview.png', '1026', 'FINANCE', 'KP. CIBEDUG RT 03 RW 02, DS. CIBEDUG, KEC. CIAWI,  KABUPATEN BOGOR 16720', '08567160802', '3201242311760001', 'TETAP', '-', '2024-01-25 06:31:59', 'legal'),
(30, 'SUGIANTO', 'IMG_20210818_153847-removebg-preview.png', '1019', 'PRODUKSI', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '08988570662', '3201242710830001', 'TETAP', '-', '2024-01-25 06:33:13', 'legal'),
(31, 'MUHAMMAD SODIK', 'IMG_20210818_153847-removebg-preview.png', '1020', 'PRODUKSI', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '089627889170', '3201242712810002', 'TETAP', '-', '2024-01-25 06:34:34', 'legal'),
(32, 'ITA WALUYA', 'IMG_20210818_153847-removebg-preview.png', '1022', 'LOGISTIK', 'KP NARINGGUL CIASIN RT 003/RW 010, DESA. BENDUNGAN, KEC. CIAWI KAB. BOGOR  16720', '085772582760', '3201246506820001', 'TETAP', '-', '2024-01-25 06:36:11', 'legal'),
(33, 'ENDI', 'IMG_20210818_153847-removebg-preview.png', '1024', 'PRODUKSI', 'KP. SESEUPAN RT. 003 RW. 009 DESA BENDUNGAN KEC. CIAWI KABUPATEN BOGOR', '087891726061', '3201240103820001', 'KONTRAK', '-', '2024-01-25 06:44:32', 'legal'),
(34, 'ADE FIRMANSYAH', 'IMG_20210818_153847-removebg-preview.png', '1008', 'PRODUKSI', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '0895343530209', '3201240109810001', 'TETAP', '-', '2024-01-25 06:40:02', 'legal'),
(35, 'ANGGA IRAWAN', 'IMG_20210818_153847-removebg-preview.png', '1025', 'GA', 'BABAKAN INDAH RT. 002 RW. 003 DESA HARJASARI KOTA BOGOR KECAMATAN BOGOR SELATAN 16138', '083150909069', '3271011109900004', 'TETAP', '-', '2024-01-25 06:51:16', 'legal'),
(36, 'DENI SUMARNA', 'IMG_20210818_153847-removebg-preview.png', '1010', 'GA', 'KP NARINGGUL CIASIN RT 003/RW 010, DESA. BENDUNGAN, KEC. CIAWI KAB. BOGOR  16720', '0895342492097', '3201240402850006', 'TETAP', '-', '2024-01-25 06:42:40', 'legal'),
(37, 'M YUSUP IBRAHIM', 'IMG_20210818_153847-removebg-preview.png', '1028', 'PRODUKSI', 'KP. BABAKAN RT. 004 RW. 008 DESA BANJARWARU KEC. CIAWI KABUPATEN BOGOR', '0895321438282', '3201240403860007', 'KONTRAK', '-', '2024-01-25 06:44:04', 'legal'),
(38, 'SAEPUDIN', 'IMG_20210818_153847-removebg-preview.png', '1023', 'PRODUKSI', 'KP. SESEUPAN RT. 003 RW. 009 DESA BENDUNGAN KEC. CIAWI KABUPATEN BOGOR', '085882467923', '3201240504840003', 'KONTRAK', '-', '2024-01-25 06:45:49', 'legal'),
(39, 'HUSIN', 'IMG_20210818_153847-removebg-preview.png', '1011', 'PRODUKSI', 'KP NARINGGUL CIASIN RT 003/RW 010, DESA. BENDUNGAN, KEC. CIAWI KAB. BOGOR  16720', '089636255961', '3201240701790003', 'TETAP', '-', '2024-01-25 06:47:13', 'legal'),
(40, 'RUSMA', '', '1027', 'PRODUKSI', 'KP. CIAWI GIRANG RT.001 RW.003 KEC. CIAWI KAB. BOGOR', '083819293668', '3201241103820004', 'KONTRAK', '-', '2024-01-25 06:48:06', 'legal'),
(41, 'MUKSIN', '', '1021', 'CLEANING SERVICE', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '0895322477130', '3209011108900001', 'TETAP', '-', '2024-01-25 06:49:23', 'legal'),
(42, 'SOLEHUDIN', '', '1029', 'PRODUKSI', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '083808979041', '3201240707970003', 'KONTRAK', '-', '2024-01-25 06:52:24', 'legal'),
(43, 'AHMAD IKBAL', '', '4017', 'PRODUKSI', 'KP. RAWASINGA RT. 007 RW.002 KLAPANUNGGAL KAB. BOGOR 16820', '081284126704', '3201321206840006', 'KONTRAK', '-', '2024-01-25 06:53:19', 'legal'),
(44, 'AMAK', '', '4020', 'PRODUKSI', 'KP. JAWA RT. 001 RW.002 DESA SUKAMAJU KEC. MEGAMENDUNG KABUPATEN BOGOR', '085776633975', '3201261701910003', 'KONTRAK', '-', '2024-01-25 06:54:02', 'legal'),
(45, 'ROBBY KRISNA WIJAYA', '', '4023', 'PRODUKSI', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '08889292353', '3271023110980005', 'KONTRAK', '-', '2024-01-25 06:55:01', 'legal'),
(46, 'M ZARKASIH', '', '4045', 'PRODUKSI', 'KP. BABAKAN RT. 004 RW. 008 DESA BANJARWARU KEC. CIAWI KABUPATEN BOGOR', '-', '3201242312940003', 'KONTRAK', '-', '2024-01-25 06:55:41', 'legal'),
(47, 'ANDI', '', '4026', 'PRODUKSI', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '-', '3201241507790009', 'KONTRAK', '-', '2024-01-25 06:56:22', 'legal'),
(48, 'SUKIRAN', '', '4046', 'PRODUKSI', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '-', '3201241703890002', 'KONTRAK', '-', '2024-01-25 06:56:52', 'legal'),
(49, 'RINALDIYANSAH', '', '4021', 'PRODUKSI', 'KP. SUKAMAJU, DESA. BENDUNGAN RT 001 RW 005, KEC. CIAWI, KAB. BOGOR, 16720', '-', '3201243003010004', 'KONTRAK', '-', '2024-01-25 06:57:33', 'legal'),
(50, 'JENAL ARIFIN', '', '4043', 'PRODUKSI', 'KP. CIRANGRANG RT.003 RW.002 DESA CILEMBER KEC. CISARUA KABUPATEN BOGOR', '0895377150030', '3201252506000003', 'KONTRAK', '-', '2024-01-25 06:58:29', 'legal'),
(51, 'JAKARIA SAPUTRA SETIADI', '', '4029', 'CLEANING SERVICE', 'KP. LEBAK GUDANG RT.004 RW.011 DESA BENDUNGAN KEC. CIAWI KABUPATEN BOGOR', '08960256012', '3201240201010001', 'KONTRAK', '-', '2024-01-25 06:59:23', 'legal'),
(52, 'HALID YUNUS', '', '4049', 'CLEANING SERVICE', 'KP NARINGGUL CIASIN RT 003/RW 010, DESA. BENDUNGAN, KEC. CIAWI KAB. BOGOR  16720', '-', '3201240701770002', 'KONTRAK', '-', '2024-01-25 07:00:02', 'legal'),
(53, 'M SAHRUL S', '', '4050', 'PRODUKSI', 'KP. PASIR ANGIN GADOG RT.004 RW.001 DESA PASIR ANGIN KEC. MEGAMENDUNG KAB. BOGOR', '-', '3201261910010006', 'KONTRAK', '-', '2024-01-25 07:00:44', 'legal'),
(54, 'MUHAMAD KAMALUDIN', '', '4051', 'PRODUKSI', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '-', '3201241004030003', 'KONTRAK', '-', '2024-01-25 07:01:37', 'legal'),
(55, 'INDRA GUNAWAN', '', '4063', 'PRODUKSI', 'KP. JAWA RT. 001 RW.002 DESA SUKAMAJU KEC. MEGAMENDUNG KABUPATEN BOGOR', '-', '3201240308880002', 'KONTRAK', '-', '2024-01-25 07:02:17', 'legal'),
(56, 'MAULANA', '', '-', 'PRODUKSI', 'KP MEKAR DESA PANDANSARI RT 02/RW 08 KEC. CIAWI KAB. BOGOR 16720', '083811459091', '3201242406990001', 'KONTRAK', '-', '2024-01-25 07:03:46', 'legal');

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(255) NOT NULL,
  `dokumentasi` varchar(255) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `units` varchar(255) NOT NULL,
  `keperluan` varchar(50) NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `keterangank` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `kode_transaksi` varchar(15) NOT NULL,
  `waktu_terakhir_aksi_keluar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_edit_keluar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `namabarang`, `dokumentasi`, `tanggal_keluar`, `jumlah`, `units`, `keperluan`, `penerima`, `keterangank`, `status`, `kode_transaksi`, `waktu_terakhir_aksi_keluar`, `user_edit_keluar`) VALUES
(1, 117, 'ROMPI APD', 'WhatsApp Image 2023-08-10 at 10.08.38.jpeg', '2024-01-04', 10, 'PCS', 'EXTERNAL', 'h3 office', '-', 'REJECTED', 'BK_202401/0001', '2024-01-04 14:45:21', NULL),
(2, 117, 'ROMPI APD', 'WhatsApp Image 2023-08-10 at 10.08.38.jpeg', '2024-01-04', 15, 'PCS', 'EXTERNAL', 'h3 office', '-', 'ACCEPTED', 'BK_202401/0002', '2024-01-04 14:45:21', NULL),
(3, 118, 'HELM SAFETY', '', '2024-01-04', 120, 'PCS', 'INTERNAL', 'h3 office', '-', 'ACCEPTED', 'BK_202401/0003', '2024-01-04 14:45:21', NULL),
(4, 118, 'HELM SAFETY', '', '2024-01-04', 2, 'PCS', 'EXTERNAL', 'h3 office', '-', 'ACCEPTED', 'BK_202401/0004', '2024-01-04 16:25:24', NULL),
(5, 117, 'SARUNG TANGAN SAFETY', 'WhatsApp Image 2023-08-10 at 10.08.38.jpeg', '2024-01-04', 1, 'PCS', 'EXTERNAL', 'pak jajat, h3 office', '-', 'IN PROGRESS', 'BK_202401/0005', '2024-01-12 03:40:38', 'super admin'),
(6, 118, 'HELM SAFETY', '', '2024-01-04', 2, 'PCS', 'EXTERNAL', 'h3 office', '-', 'IN PROGRESS', 'BK_202401/0006', '2024-01-04 16:11:34', NULL),
(7, 117, 'HELM SAFETY', 'WhatsApp Image 2023-08-10 at 10.08.38.jpeg', '2024-01-04', 13, 'PCS', 'EXTERNAL', 'htg', '-', 'IN PROGRESS', 'BK_202401/0007', '2024-01-06 04:54:38', 'super admin'),
(8, 117, 'ROMPI APD', 'WhatsApp Image 2023-08-10 at 10.08.38.jpeg', '2024-01-05', 2, 'PCS', 'INTERNAL', 'operasional', '-', 'ACCEPTED', 'BK_202401/0008', '2024-01-05 03:47:07', NULL),
(9, 118, 'HELM SAFETY', '', '2024-01-05', 1, 'PCS', 'INTERNAL', 'operasional', '-', 'ACCEPTED', 'BK_202401/0009', '2024-01-05 03:47:08', NULL),
(10, 118, 'HELM SAFETY', '', '2024-01-05', 1, 'PCS', 'INTERNAL', 'operasional', '-', 'ACCEPTED', 'BK_202401/0010', '2024-01-05 03:47:08', NULL),
(11, 120, 'SARUNG TANGAN SAFETY', '', '2024-01-06', 2, 'PCS', 'INTERNAL', 'operasional', '-', 'ACCEPTED', 'BK_202401/0011', '2024-01-06 04:55:04', 'super admin'),
(15, 117, 'ROMPI APD', 'WhatsApp Image 2023-08-10 at 10.08.38.jpeg', '2024-01-13', 12, 'PCS', 'INTERNAL', 'operasional', '-', 'ACCEPTED', 'BK_202401/0012', '2024-01-13 04:24:06', 'super admin'),
(16, 118, 'HELM SAFETY', '', '2024-01-13', 1, 'PCS', 'EXTERNAL', 'h3 office', '-', 'IN PROGRESS', 'BK_202401/0016', '2024-01-13 04:24:40', 'super admin'),
(17, 121, 'SARUNG TANGAN', 'WhatsApp Image 2024-01-23 at 14.39.27.jpeg', '2024-02-01', 960, 'PCS', 'INTERNAL', 'karyawan mhg', '-', 'ACCEPTED', 'BK_202401/0017', '2024-01-31 03:00:34', 'logistik'),
(18, 123, 'SEAL CAP', 'WhatsApp Image 2024-01-23 at 14.39.28(1).jpeg', '2024-01-31', 454067, 'PCS', 'INTERNAL', 'karyawan mhg', '-', 'ACCEPTED', 'BK_202401/0017', '2024-01-31 03:02:57', 'logistik');

-- --------------------------------------------------------

--
-- Table structure for table `legal`
--

CREATE TABLE `legal` (
  `id_legal` int(11) NOT NULL,
  `dokumentasi` varchar(99) NOT NULL,
  `jenis_sertifikasi` varchar(255) NOT NULL,
  `no_sertifikat` varchar(255) NOT NULL,
  `mengeluarkan` varchar(50) NOT NULL,
  `mulai_berlaku` date NOT NULL,
  `akhir_berlaku` varchar(12) NOT NULL,
  `masa_berlaku` varchar(25) NOT NULL,
  `masa_habis` varchar(25) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_edit_operasional` varchar(255) DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `legal`
--

INSERT INTO `legal` (`id_legal`, `dokumentasi`, `jenis_sertifikasi`, `no_sertifikat`, `mengeluarkan`, `mulai_berlaku`, `akhir_berlaku`, `masa_berlaku`, `masa_habis`, `keterangan`, `updated_at`, `user_edit_operasional`, `nama_file`, `pdf_path`) VALUES
(33, 'WhatsApp Image 2024-01-16 at 10.10.04(1).jpeg', 'INSTALASI PENYALUR PETIR ELECTROSTATIC', '23706/TK.04.03.04/PK-WIL.I.BGR', 'DISNAKERTRANS', '2023-11-28', '2024-11-28', '1 TAHUN', '2024-11-28T02:09', '-', '2024-02-09 07:24:55', 'legal', '', ''),
(34, 'WhatsApp Image 2024-01-16 at 10.18.06.jpeg', 'INSTALASI PENYALUR PETIR KONVENSIONAL', '23683/TK.04.03.04/PK-WIL.I.BGR', 'DISNAKERTRANS', '2023-11-28', '0024-11-28', '1 TAHUN', '2024-11-28T02:02', '-', '2024-02-09 07:25:09', 'legal', '', ''),
(35, 'WhatsApp Image 2024-01-16 at 10.22.55.jpeg', 'INSTALASI PENYALUR PETIR GROUNDING', '23705/TK.04.03.04/PK-WIL.I.BGR', 'DISNAKERTRANS', '2023-11-28', '2024-11-28', '1 TAHUN', '2024-11-28T02:02', '-', '2024-02-09 07:25:25', 'legal', '', ''),
(36, 'WhatsApp Image 2024-01-16 at 10.30.17.jpeg', 'INSTALASI LISTRIK', '23704/TK.04.03.04/PK-WIL.I.BGR', 'DISNAKERTRANS', '2023-11-28', '2024-11-28', '1 TAHUN', '2024-11-28T02:02', '-', '2024-02-09 07:24:40', 'legal', '', ''),
(37, 'WhatsApp Image 2024-01-16 at 10.33.24.jpeg', 'INSTALASI GENSET ', '24704/TK.04.03.04/PK-WIL.I.BGR', 'DISNAKERTRANS', '2023-11-28', '2024-11-28', '1 TAHUN', '2024-11-28T02:02', '-', '2024-02-09 07:25:48', 'legal', '', ''),
(38, 'WhatsApp Image 2024-01-16 at 10.38.14.jpeg', 'INSTALASI HYDRANT SYSTEM', '22574/TK.04.03.04/PK-WIL.I.BGR', 'DISNAKERTRANS', '2023-11-28', '2024-11-28', '1 TAHUN', '2024-11-28T02:02', '-', '2024-02-09 07:26:02', 'legal', '', ''),
(40, 'WhatsApp Image 2024-01-18 at 15.07.02.jpeg', 'INSTALASI LPG ', '7971/TK.04.03.02/PK-WIL.I.BGR', 'DISNAKERTRANS', '2023-05-08', '2024-05-08', '1 TAHUN', '2024-05-08T02:00', '-', '2024-02-09 07:26:29', 'legal', '', ''),
(41, 'WhatsApp Image 2024-01-18 at 15.11.37.jpeg', 'INSTALASI WATER RECIEVER TANK (BEJANA TEKAN)', '5763/TK.04.03.02/PK-WIL.I.BGR', 'DISNAKERTRANS', '2023-03-10', '2024-03-10', '1 TAHUN', '2024-03-10 02:00:00', '-', '2024-01-18 08:14:06', 'legal', '', ''),
(42, 'WhatsApp Image 2024-01-18 at 15.15.59.jpeg', 'INSTALASI AIR RECIEVER TANK (BEJANA TEKAN)', '5764/TK.04.03.02/PK-WIL.I.BGR', 'DISNAKERTRANS', '2023-03-10', '2024-03-10', '1 TAHUN', '2024-03-10T02:00', '-', '2024-02-09 07:26:50', 'legal', '', ''),
(43, 'WhatsApp Image 2024-01-18 at 15.19.39.jpeg', 'WAJIB LAPOR KETENAGAKERJAAN', '202307120001', 'DISNAKERTRANS', '2023-07-12', '2024-07-12', '1 TAHUN', '2024-07-12 01:00:00', '-', '2024-01-18 08:22:03', 'legal', '', ''),
(44, 'PLO__page-0002.jpg', 'PLO ', '419/55-340/PLO/DMT/2020', 'DIREKTORAT JENDRAL MINYAK DAN GAS BUMI ', '2020-09-23', '2024-06-17', '4 TAHUN', '2024-06-17T00:00', 'TERHUBUNG DENGAN SERTIFIKAT COI SERTCO', '2024-01-24 06:21:07', 'legal', 'PLO_.pdf', 'lihat_detail/dokumen_legal_operasional/PLO_.pdf'),
(45, 'IZIN USAHA MIGAS1_page-0001.jpg', 'IZIN USAHA MIGAS', '05.SD.06.24.02.170', 'MENTERI ENERGI SDM', '2019-03-01', '2024-02-29', '5 TAHUN', '2024-02-29T00:00', 'TERHUBUNG DENGAN SERTIFIKAT COI SERTCO, PLO', '2024-01-24 06:21:27', 'legal', 'IZIN USAHA MIGAS1.pdf', 'lihat_detail/dokumen_legal_operasional/IZIN USAHA MIGAS1.pdf'),
(46, 'COI_page-0001.jpg', 'COI', '-', 'PT SERCO', '2020-06-30', '2023-06-17', '3 TAHUN', '2023-06-17 00:00:00', '-', '2024-01-18 09:37:05', 'legal', '', ''),
(47, 'Timbangan Digital_page-0001.jpg', 'SERTIFIKAT KALIBRASI ( TIMBANGAN DIGITAL )', '500.2.3.15/636.1/SKHPDISPERDAGIN/2023', 'METROLOGI', '2023-05-30', '2024-05-30', '1 TAHUN', '2024-03-05T00:00', '-', '2024-01-24 06:22:41', 'legal', 'Timbangan Digital_compressed.pdf', 'lihat_detail/dokumen_legal_operasional/Timbangan Digital_compressed.pdf'),
(48, 'KALIBRASI TANKI_2_page-0001.jpg', 'SERTIFIKAT KALIBRASI TANKI TIMBUN', '510.64/0765/SKHP/DISPERDAGIN/V/2022', 'METROLOGI', '2022-05-25', '2032-04-01', '10 TAHUN', '2032-04-01T00:00', '-', '2024-01-24 06:23:09', 'legal', 'KALIBRASI TANKI.pdf', 'lihat_detail/dokumen_legal_operasional/KALIBRASI TANKI.pdf'),
(49, 'Kontrak PT Mitra Harun Gasindo 028_2_page-0001.jpg', 'BIPATRIT PT PERTAMINA', '028/CT32000/2020-S3', 'PT PERTAMINA', '2020-05-29', '2030-05-28', '10 TAHUN', '2030-05-28 00:00:00', '-', '2024-01-20 03:21:26', 'legal', '', ''),
(50, 'UPL UKL.jpg', 'WAJIB UPL-UKL', '02/SDP/MHG/VII/2023', 'DINAS LINGKUNGAN HIDUP (DLH)', '2023-01-01', '2024-06-01', '1 TAHUN', '2024-06-01 00:00:00', '-', '2024-01-20 03:32:02', 'legal', '', ''),
(56, 'CCI_000021.jpg', 'SKDU', '503/15/II/2022', 'DESA PANDANSARI', '2023-02-21', '2024-02-21', '1 TAHUN', '2024-02-21T00:00', '-', '2024-01-22 03:14:03', 'legal', '', ''),
(57, 'SERTIFIKAT LAIK OPERASI_page-0001.jpg', 'SLO', '02.05.001102.811.10', 'KONSUIL', '2010-03-31', '2025-03-31', '15 TAHUN', '2025-03-31 00:00:00', '-', '2024-01-23 06:20:52', 'legal', 'SERTIFIKAT LAIK OPERASI.pdf', 'lihat_detail/dokumen_legal_operasional/SERTIFIKAT LAIK OPERASI.pdf'),
(59, 'WhatsApp Image 2024-01-24 at 13.14.05.jpeg', 'P2K3', '566.758/PK-WIL.I/K3/2020', 'DISNAKERTRANS', '2020-02-22', 'Tidak Ada', '-', 'Tidak Ada', '-', '2024-01-24 06:19:39', 'legal', 'P2K3.pdf', 'lihat_detail/dokumen_legal_operasional/P2K3.pdf'),
(60, 'CCI_000022.jpg', 'IZIN GENSET', '671/2435-EKTL.CABDIN.II/II/2020', 'CABANG ESDM II BOGOR', '2020-02-25', 'Tidak Ada', '-', 'Tidak Ada', '-', '2024-01-24 06:36:35', 'legal', 'CCF_000550.pdf', 'lihat_detail/dokumen_legal_operasional/CCF_000550.pdf'),
(61, 'WhatsApp Image 2024-02-09 at 14.11.21.jpeg', 'RLA', '-', 'INTESCO GLOBAL INTERNUSA', '2020-07-20', '2024-07-20', '5 TAHUN', '2025-07-20T00:00', 'TERHUBUNG DENGAN SEERTIFIKAT COI SERTCO', '2024-02-09 07:41:11', 'legal', 'CamScanner 07-12-2023 17.03.pdf', 'lihat_detail/dokumen_legal_operasional/CamScanner 07-12-2023 17.03.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `legal_infrastruktur`
--

CREATE TABLE `legal_infrastruktur` (
  `id_legalinfrastruktur` int(11) NOT NULL,
  `dokumentasi` varchar(255) NOT NULL,
  `jenis_sertifikasi` varchar(255) NOT NULL,
  `no_sertifikat` varchar(255) NOT NULL,
  `mengeluarkan` varchar(255) NOT NULL,
  `tanggal_dikeluarkan` date NOT NULL,
  `masa_berlaku` varchar(12) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_edit_infrastruktur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `legal_infrastruktur`
--

INSERT INTO `legal_infrastruktur` (`id_legalinfrastruktur`, `dokumentasi`, `jenis_sertifikasi`, `no_sertifikat`, `mengeluarkan`, `tanggal_dikeluarkan`, `masa_berlaku`, `keterangan`, `nama_file`, `pdf_path`, `updated_at`, `user_edit_infrastruktur`) VALUES
(14, 'ippt 2021_2_page-0001.jpg', 'IPPT ( IJIN PERUNTUKAN PENGGUNAAN TANAH)', '591.2/002/00592/DPMPTSP/2021', 'DPMPTSP KAB. BOGOR', '2021-11-28', 'Tidak Ada', '-', 'ippt 2021.pdf', 'lihat_detail/dokumen_infrastruktur/ippt 2021.pdf', '2024-01-23 06:11:02', 'legal'),
(18, 'IMB_page-0001.jpg', 'IMB (IJIN MENDIRIKAN BANGUNAN)', '541/003.2.1/0007/BPT/2010', 'BPT', '2010-01-07', 'Tidak Ada', '-', 'IMB.pdf', 'lihat_detail/dokumen_infrastruktur/IMB.pdf', '2024-01-23 06:34:58', 'legal'),
(19, 'IPPT JALAN MASUK_page-0001.jpg', 'IPPT JALAN MASUK', '591.2/002/0339/BPT/2009', 'BPT', '2009-09-02', 'Tidak Ada', '-', 'IPPT JALAN MASUK.pdf', 'lihat_detail/dokumen_infrastruktur/IPPT JALAN MASUK.pdf', '2024-01-23 06:47:16', 'legal'),
(20, 'PEIL BANJIR SUKET SUMUR IMBUHAN_2_page-0001.jpg', 'PEIL BANJIR', '610/3946-ISDA-PUPR', 'DINAS TATA RUANG (PUPR)', '2022-11-05', 'Tidak Ada', '-', 'PEIL BANJIR SUKET SUMUR IMBUHAN.pdf', 'lihat_detail/dokumen_infrastruktur/PEIL BANJIR SUKET SUMUR IMBUHAN.pdf', '2024-01-30 03:08:13', 'legal'),
(21, 'SITE PLAN DAN LAYOUT TANKI_2_page-0001.jpg', 'SITE PLAN', '-', 'DINAS TATA RUANG (PUPR)', '2009-12-30', 'Tidak Ada', '-', 'SITE PLAN.pdf', 'lihat_detail/dokumen_infrastruktur/SITE PLAN.pdf', '2024-01-30 03:47:11', 'legal'),
(22, 'PENGESAHAN SITE PLAN_page-0001.jpg', 'PENGESAHAN SITE PLAN', '591.3/229/KPTS/SP/HUK/2009', 'BUPATI BOGOR', '2009-12-30', 'Tidak Ada', '-', 'PENGESAHAN SITE PLAN.pdf', 'lihat_detail/dokumen_infrastruktur/PENGESAHAN SITE PLAN.pdf', '2024-02-01 04:03:26', 'legal'),
(23, 'Pengesahan Site Plan 2022_2_page-0001.jpg', 'PENGESAHAN SITE PLAN REV-1', '591.3/184/KPTS/SP-DPUPR/2022', 'DINAS TATA RUANG (PUPR)', '2022-09-14', '2040-01-02', '-', 'Pengesahan Site Plan 2022_compressed.pdf', 'lihat_detail/dokumen_infrastruktur/Pengesahan Site Plan 2022_compressed.pdf', '2024-02-10 03:45:46', 'legal');

-- --------------------------------------------------------

--
-- Table structure for table `legal_people`
--

CREATE TABLE `legal_people` (
  `id_legalpeople` int(11) NOT NULL,
  `dokumentasi` varchar(255) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_sertifikat` varchar(255) NOT NULL,
  `nomor_sertifikat` varchar(50) NOT NULL,
  `instansi_mengeluarkan` varchar(255) NOT NULL,
  `tanggal_mengeluarkan` date NOT NULL,
  `masa_habis` varchar(12) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_edit_people` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `legal_people`
--

INSERT INTO `legal_people` (`id_legalpeople`, `dokumentasi`, `nama_lengkap`, `jenis_sertifikat`, `nomor_sertifikat`, `instansi_mengeluarkan`, `tanggal_mengeluarkan`, `masa_habis`, `keterangan`, `nama_file`, `pdf_path`, `updated_at`, `user_edit_people`) VALUES
(14, '12.PNG', 'SUPRIADI & SUDARMA', 'GENSET', '-', 'DISNAKERTRANS PROV DKI JAKARTA', '2012-05-01', 'Tidak Ada', '-', 'serifikat operator genset.pdf', 'lihat_detail/dokumen_people/serifikat operator genset.pdf', '2024-02-01 06:40:43', 'legal'),
(15, '13.PNG', 'YAYAN SOFIAN', 'PENGELOLAAN B3 & LB3', '-', 'DLH', '2016-06-20', 'Tidak Ada', '-', 'piagam plthn2018_0001_2.pdf', 'lihat_detail/dokumen_people/piagam plthn2018_0001_2.pdf', '2024-02-01 06:47:22', 'legal'),
(16, 'naskah-dinas-655424_02082023_Mitra Harun Gasindo_page-0001.jpg', 'LUKMAN NURHAKIM', 'KEPALA TEKNIK', '489.K/MG.06.08/KT.O.BE/DMT/2023', 'DIREKTUR TEKNIK DAN LINGKUNGAN MIGAS', '2023-08-02', 'Tidak Ada', '-', 'naskah-dinas-655424_02082023_Mitra Harun Gasindo_page-0001.pdf', 'lihat_detail/dokumen_people/naskah-dinas-655424_02082023_Mitra Harun Gasindo_page-0001.pdf', '2024-02-09 09:20:33', 'legal'),
(17, '12.PNG', 'YAYAN SOFIAN', 'CALON AK3 UMUM', '700/5856/PENGAWASAN', 'DISNAKERTRANS PROV JAWA BARAT', '2018-09-26', 'Tidak Ada', '-', 'Calon K3.pdf', 'lihat_detail/dokumen_people/Calon K3.pdf', '2024-02-09 09:26:07', 'legal');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `lasttime_password_change` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `username`, `password`, `role`, `lasttime_password_change`, `updated_at`, `last_login`, `email`) VALUES
(1, 'super admin', '$2y$10$yrDaR29sJX1BRcBuzUvTwe2VyZ5t.3Y9Jld.uNv6HfOZjfJsdRno6', 'admin', '2024-02-13 03:10:01', '2024-02-13 03:10:01', '2024-02-13 10:10:01', 'mspasyazakaria@gmail.com'),
(2, 'visitor', '$2y$10$KhEiXj4cxFSaDyX8VqxJ3OS4NKdFsJ59kgiU8nd/fet9YlU9C/m56', 'visitor', '2024-02-11 11:26:20', '2024-02-11 11:26:20', '2024-02-11 18:26:20', 'syafiqqu10@gmail.com'),
(3, 'logistik', '$2y$10$I7bzhc6KTrB6tuffJaA8D.hpmEJdxLY6VC.Ls6FHzy.KsxXn430uW', 'logistik', '2024-02-13 02:49:31', '2024-02-13 02:49:31', '2024-02-13 09:49:31', ''),
(4, 'legal', '$2y$10$I7bzhc6KTrB6tuffJaA8D.hpmEJdxLY6VC.Ls6FHzy.KsxXn430uW', 'legal', '2024-02-13 03:45:46', '2024-02-13 03:45:46', '2024-02-13 10:45:46', ''),
(5, 'supply', '$2y$10$I7bzhc6KTrB6tuffJaA8D.hpmEJdxLY6VC.Ls6FHzy.KsxXn430uW', 'supply', '2024-01-12 07:45:57', '2024-01-12 07:45:57', '2024-01-12 07:45:57', ''),
(6, 'keuangan', '$2y$10$I7bzhc6KTrB6tuffJaA8D.hpmEJdxLY6VC.Ls6FHzy.KsxXn430uW', 'keuangan', '2024-01-13 04:22:14', '2024-01-13 04:22:14', '2024-01-13 04:22:14', ''),
(7, 'management', '$2y$10$yuWjglZBsOeLeTFD5bTHd.R3L2UsOXVCuH9ncnPjGzgl2NcS6SNQW', 'management', '2024-02-09 03:58:15', '2024-02-09 03:58:15', '2024-02-09 03:58:15', ''),
(8, 'ketua operasional', '$2y$10$I7bzhc6KTrB6tuffJaA8D.hpmEJdxLY6VC.Ls6FHzy.KsxXn430uW', 'ketua_operasional', '2024-01-13 04:39:42', '2024-01-13 04:39:42', '2024-01-13 04:39:42', ''),
(9, 'owner', '$2y$10$I7bzhc6KTrB6tuffJaA8D.hpmEJdxLY6VC.Ls6FHzy.KsxXn430uW', 'owner', '2024-01-12 06:57:39', '2024-01-12 06:57:39', '2024-01-12 06:57:39', '');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal_penerimaan` date NOT NULL DEFAULT current_timestamp(),
  `idsupplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `unit_masuk` varchar(255) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `faktur` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `kode_transaksi_masuk` varchar(15) NOT NULL,
  `waktu_terakhir_aksi_masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_edit_masuk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal_penerimaan`, `idsupplier`, `nama_supplier`, `nama_barang`, `jumlah`, `unit_masuk`, `harga_satuan`, `total_harga`, `faktur`, `keterangan`, `kode_transaksi_masuk`, `waktu_terakhir_aksi_masuk`, `user_edit_masuk`) VALUES
(14, 123, '2024-01-31', 33, 'PT. MITRA SUKSES MEDITERANIA', 'SEAL CAP', 504000, 'PCS', 0, 0, '-', '-', 'BM_202401/0001', '2024-01-31 03:21:37', 'logistik');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id_order` int(11) NOT NULL,
  `tanggal_buat` date NOT NULL,
  `tanggal_permintaan` date NOT NULL,
  `item_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `satuan_bentuk` varchar(50) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `nama_supplier_order` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_request` varchar(100) NOT NULL,
  `kode_transaksi_request` varchar(15) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_edit_order` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id_order`, `tanggal_buat`, `tanggal_permintaan`, `item_barang`, `qty`, `satuan_bentuk`, `harga_satuan`, `ppn`, `diskon`, `total_harga`, `idsupplier`, `nama_supplier_order`, `keterangan`, `status_request`, `kode_transaksi_request`, `updated_at`, `user_edit_order`) VALUES
(23, '2024-02-13', '2024-02-14', 'RUBBER SEAL', 100000, 'pcs', 0, 0, 0, 0, 31, 'PT. MANDALA LOGAM UTAMA', '-', 'IN PROGRESS', 'RO_202402/0001', '2024-02-13 02:55:18', 'logistik'),
(24, '2024-02-12', '2024-02-14', 'SARUNG TANGAN', 18000, 'pcs', 0, 0, 0, 0, 32, 'PT. SOFIAN JAYA SEJAHTERA', '-', 'IN PROGRESS', 'RO_202402/0024', '2024-02-13 02:57:07', 'logistik');

-- --------------------------------------------------------

--
-- Table structure for table `persetujuan_keluar`
--

CREATE TABLE `persetujuan_keluar` (
  `id_persetujuan` int(11) NOT NULL,
  `id_keluar` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aksi` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `persetujuan_keluar`
--

INSERT INTO `persetujuan_keluar` (`id_persetujuan`, `id_keluar`, `id_user`, `aksi`) VALUES
(21, 1, 8, 'reject'),
(22, 1, 8, 'reject'),
(23, 1, 9, 'reject'),
(24, 1, 9, 'reject'),
(25, 1, 7, 'reject'),
(39, 2, 7, 'approve'),
(40, 3, 7, 'reject'),
(41, 2, 8, 'approve'),
(42, 3, 8, 'approve'),
(43, 2, 9, 'approve'),
(44, 3, 9, 'approve'),
(45, 4, 8, 'approve'),
(46, 4, 7, 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `persetujuan_request`
--

CREATE TABLE `persetujuan_request` (
  `id_persetujuan_request` int(11) NOT NULL,
  `idorder` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aksi` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `dokumentasi` varchar(255) NOT NULL,
  `jmlhstok` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `update_stok` date NOT NULL,
  `lokasi_penyimpanan` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `idkaryawan` int(11) NOT NULL,
  `namakaryawan` varchar(50) NOT NULL,
  `terakhir_aksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_edit_barang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`idbarang`, `namabarang`, `dokumentasi`, `jmlhstok`, `unit`, `update_stok`, `lokasi_penyimpanan`, `keterangan`, `idkaryawan`, `namakaryawan`, `terakhir_aksi`, `user_edit_barang`) VALUES
(121, 'SARUNG TANGAN', 'WhatsApp Image 2024-01-23 at 14.39.27.jpeg', 600, 'PCS', '2024-01-01', 'GUDANG MHG', '-', 32, 'ITA WALUYA', '2024-01-31 03:00:34', 'logistik'),
(122, 'RUBBER SEAL', 'WhatsApp Image 2024-01-23 at 14.39.28.jpeg', 97000, 'PCS', '2024-01-01', 'GUDANG MHG', '-', 32, 'ITA WALUYA', '2024-01-31 03:13:57', 'logistik'),
(123, 'SEAL CAP', 'WhatsApp Image 2024-01-23 at 14.39.28(1).jpeg', 584640, 'PCS', '2024-01-01', 'GUDANG MHG', '-', 32, 'ITA WALUYA', '2024-01-31 03:21:37', 'logistik');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `idsupplier` int(11) NOT NULL,
  `dokumentasi` varchar(255) NOT NULL,
  `namasupplier` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `jenis_produk` text NOT NULL,
  `nama_pic` varchar(50) NOT NULL,
  `b3_nonb3` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_edit_supplier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`idsupplier`, `dokumentasi`, `namasupplier`, `alamat`, `no_telepon`, `jenis_produk`, `nama_pic`, `b3_nonb3`, `keterangan`, `updated_at`, `user_edit_supplier`) VALUES
(31, 'WhatsApp Image 2024-01-23 at 14.39.28.jpeg', 'PT. MANDALA LOGAM UTAMA', 'GARUT JAWA BARAT', '-', 'RUBBER SEAL', 'ITA WALUYA', 'NON B3', '-', '2024-01-23 07:46:15', 'logistik'),
(32, 'WhatsApp Image 2024-01-23 at 14.39.27.jpeg', 'PT. SOFIAN JAYA SEJAHTERA', 'JL BERINGIN 03 PANDANSARI', '-', 'SARUNG TANGAN', 'ITA WALUYA', 'NON B3', '-', '2024-01-23 07:47:51', 'logistik'),
(33, 'WhatsApp Image 2024-01-23 at 14.39.28(1).jpeg', 'PT. MITRA SUKSES MEDITERANIA', 'JAKARTA', '-', 'SHIELD CAP', 'ITA WALUYA', 'NON B3', '-', '2024-01-23 07:55:30', 'logistik'),
(34, 'WhatsApp Image 2024-01-31 at 10.11.10.jpeg', 'CV. KARYA SEKAWAN', 'BANDUNG', '02188359903', 'RUBBER SEAL', 'ITA WALUYA', 'NON B3', '-', '2024-01-31 03:12:55', 'logistik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen_hasil_audit`
--
ALTER TABLE `dokumen_hasil_audit`
  ADD PRIMARY KEY (`id_berkas_hasil_audit`);

--
-- Indexes for table `dokumen_karyawan`
--
ALTER TABLE `dokumen_karyawan`
  ADD PRIMARY KEY (`id_berkas_karyawan`);

--
-- Indexes for table `dokumen_legal`
--
ALTER TABLE `dokumen_legal`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `dokumen_legal_infrastruktur`
--
ALTER TABLE `dokumen_legal_infrastruktur`
  ADD PRIMARY KEY (`id_berkas_infrastruktur`);

--
-- Indexes for table `dokumen_legal_people`
--
ALTER TABLE `dokumen_legal_people`
  ADD PRIMARY KEY (`id_berkas_people`);

--
-- Indexes for table `dokumen_lokasi_barang`
--
ALTER TABLE `dokumen_lokasi_barang`
  ADD PRIMARY KEY (`id_lok_barang`);

--
-- Indexes for table `dokumen_supplier`
--
ALTER TABLE `dokumen_supplier`
  ADD PRIMARY KEY (`id_berkas_supplier`);

--
-- Indexes for table `email_notifikasi`
--
ALTER TABLE `email_notifikasi`
  ADD PRIMARY KEY (`id_email`);

--
-- Indexes for table `hasil_audit`
--
ALTER TABLE `hasil_audit`
  ADD PRIMARY KEY (`id_audit`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`idkaryawan`);

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `legal`
--
ALTER TABLE `legal`
  ADD PRIMARY KEY (`id_legal`);

--
-- Indexes for table `legal_infrastruktur`
--
ALTER TABLE `legal_infrastruktur`
  ADD PRIMARY KEY (`id_legalinfrastruktur`);

--
-- Indexes for table `legal_people`
--
ALTER TABLE `legal_people`
  ADD PRIMARY KEY (`id_legalpeople`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `persetujuan_keluar`
--
ALTER TABLE `persetujuan_keluar`
  ADD PRIMARY KEY (`id_persetujuan`),
  ADD KEY `id_keluar` (`id_keluar`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `persetujuan_request`
--
ALTER TABLE `persetujuan_request`
  ADD PRIMARY KEY (`id_persetujuan_request`),
  ADD KEY `idorder` (`idorder`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idsupplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen_hasil_audit`
--
ALTER TABLE `dokumen_hasil_audit`
  MODIFY `id_berkas_hasil_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dokumen_karyawan`
--
ALTER TABLE `dokumen_karyawan`
  MODIFY `id_berkas_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dokumen_legal`
--
ALTER TABLE `dokumen_legal`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `dokumen_legal_infrastruktur`
--
ALTER TABLE `dokumen_legal_infrastruktur`
  MODIFY `id_berkas_infrastruktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `dokumen_legal_people`
--
ALTER TABLE `dokumen_legal_people`
  MODIFY `id_berkas_people` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dokumen_lokasi_barang`
--
ALTER TABLE `dokumen_lokasi_barang`
  MODIFY `id_lok_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dokumen_supplier`
--
ALTER TABLE `dokumen_supplier`
  MODIFY `id_berkas_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `email_notifikasi`
--
ALTER TABLE `email_notifikasi`
  MODIFY `id_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hasil_audit`
--
ALTER TABLE `hasil_audit`
  MODIFY `id_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `idkaryawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `legal`
--
ALTER TABLE `legal`
  MODIFY `id_legal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `legal_infrastruktur`
--
ALTER TABLE `legal_infrastruktur`
  MODIFY `id_legalinfrastruktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `legal_people`
--
ALTER TABLE `legal_people`
  MODIFY `id_legalpeople` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `persetujuan_keluar`
--
ALTER TABLE `persetujuan_keluar`
  MODIFY `id_persetujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `persetujuan_request`
--
ALTER TABLE `persetujuan_request`
  MODIFY `id_persetujuan_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idsupplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `persetujuan_keluar`
--
ALTER TABLE `persetujuan_keluar`
  ADD CONSTRAINT `persetujuan_keluar_ibfk_1` FOREIGN KEY (`id_keluar`) REFERENCES `keluar` (`idkeluar`),
  ADD CONSTRAINT `persetujuan_keluar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `login` (`iduser`);

--
-- Constraints for table `persetujuan_request`
--
ALTER TABLE `persetujuan_request`
  ADD CONSTRAINT `persetujuan_request_ibfk_1` FOREIGN KEY (`idorder`) REFERENCES `permintaan` (`id_order`),
  ADD CONSTRAINT `persetujuan_request_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `login` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
