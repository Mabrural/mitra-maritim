-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 11:42 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(10) NOT NULL,
  `no_absen` int(10) NOT NULL,
  `id_emp` int(10) NOT NULL,
  `id_lantai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `no_absen`, `id_emp`, `id_lantai`) VALUES
(8, 16, 17, 2),
(9, 4, 14, 2),
(10, 1, 30, 2),
(12, 8, 13, 1),
(13, 9, 16, 1),
(14, 11, 15, 1),
(15, 14, 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `akses_pintu`
--

CREATE TABLE `akses_pintu` (
  `id_akses` int(10) NOT NULL,
  `no_akses` int(10) NOT NULL,
  `id_emp` int(10) NOT NULL,
  `id_lantai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akses_pintu`
--

INSERT INTO `akses_pintu` (`id_akses`, `no_akses`, `id_emp`, `id_lantai`) VALUES
(9, 2, 10, 2),
(10, 1, 8, 1),
(11, 2, 8, 2),
(12, 3, 8, 2),
(13, 4, 30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_brg` varchar(40) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `gambar_barang` varchar(100) NOT NULL,
  `spek` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_brg`, `nama_barang`, `gambar_barang`, `spek`, `deskripsi`) VALUES
('BRG00001', 'Mesin pompa 1', '65b1eab76c9b4.jpg', 'Mitsubishi', '-'),
('BRG00002', 'Mesin Pompa 2', '65b1ead4019a7.jpg', 'Mitsubishi', '-'),
('BRG00003', 'Mesin AE ', '65b1eaee10a9b.jpg', 'Mitsubishi', '-'),
('BRG00004', 'Accu GS p N100', '65b1eb17d0683.jpg', 'GS p N100', '-'),
('BRG00005', 'Accu NS p N120', '65b1eb35d2247.jpg', 'NS p N120', '-'),
('BRG00006', 'Charger Accu Maxtron ', '65b1eb9514851.jpg', 'Maxtron CB 30', '-'),
('BRG00007', 'Fire Extinguisher', '65b1ebbe050fe.jpg', 'Dry Powder 9kg', '-'),
('BRG00008', 'Fire Extinguisher', '65b20422c0929.jpg', 'Chemical 4,6kg', '-'),
('BRG00009', 'Kunci Inggris', '65b720cb95001.jpg', '250mm', '-'),
('BRG00010', 'Kunci Pas nomer 9', '65b72127cb6b0.jpg', 'set unit', '-'),
('BRG00011', 'Kunci Pas nomer 10', '65b7215cc803f.jpg', 'nomer 10', '-'),
('BRG00012', 'Kunci Pas nomer 11', '65b7219b6fe60.jpg', 'set Unit', '-'),
('BRG00013', 'Kunci Pas nomer 12', '65b721c6d964a.jpg', 'set unit', '-'),
('BRG00014', 'Kunci Pas nomer 13', '65b721eae7804.jpg', 'Set Unit', '-'),
('BRG00015', 'Kunci Pas nomer 14', '65b7220a1fde9.jpg', 'Set Unit', '-'),
('BRG00016', 'Kunci Pas nomer 15', '65b7225504cec.jpg', 'Set Unit', '-'),
('BRG00017', 'Kunci Pas nomer 16', '65b7227081b6d.jpg', 'Set unit', '-'),
('BRG00018', 'Kunci Pas nomer 17', '65b7229529d03.jpg', 'Set Unit', '-'),
('BRG00019', 'Kunci Pas nomer 21', '65b722b57dd48.jpg', 'Set Unit', '-'),
('BRG00020', 'Kunci Pas nomer 24', '65b722decf834.jpg', 'Set Unit', '-'),
('BRG00021', 'Kunci Pas nomer 26', '65b722fedb5a7.jpg', 'Set Unit', '-'),
('BRG00022', 'Kunci Pas nomer 30', '65b7231b336c2.jpg', 'Set Unit', '-'),
('BRG00023', 'Kunci Pas nomer 32', '65b7233aaaa1f.jpg', 'Set Unit ', '-'),
('BRG00024', 'Kunci Sox', '65b7237266151.jpg', 'Set Unit', '-'),
('BRG00025', 'Kunci L', '65b7239faa6da.jpg', 'Set Unit', '-'),
('BRG00026', 'Obeng type minus', '65b723d84cf27.jpg', 'type minus', '-'),
('BRG00027', 'Obeng Type plus', '65b72409d1adb.jpg', 'Type plus', '-'),
('BRG00028', 'Tang Type Biasa', '65b724993f30a.jpg', 'Type Biasa', '-'),
('BRG00029', 'Tang type Lancip', '65b724cf46d2f.jpg', 'type Lancip', '-'),
('BRG00030', 'Tang type Potong', '65b724f475aac.jpg', 'type Potong', '-'),
('BRG00031', 'Topeng Las', '65b72983925ea.jpg', '-', '-'),
('BRG00032', 'Kabel Roll 4 Lubang Colokan', '65b729afeabe5.jpg', '4 Lubang Colokan', '-'),
('BRG00033', 'Dudukan Accu ', '65b729d55be4e.jpg', 'Custom Besi', '-'),
('BRG00034', 'Oli drum', '65b72a07df01e.jpg', 'SAE 40 API CF/SF', 'SPC'),
('BRG00035', 'Multi Grid Inventer', '65b72a33dced3.jpg', 'Celesta', 'PSW MT\r\n'),
('BRG00036', 'Cctv', '65b72a6bd8f75.jpg', 'Quintec', '-'),
('BRG00037', 'Lampu Penerangan 18w', '65b72aa6abd69.jpg', 'Double neon 18w', '-'),
('BRG00038', 'Mesin Fire Hydran', '65b72acf7012c.jpg', 'Mesin + Pompa', '-'),
('BRG00039', 'Mesin OWS', '65b72af780b37.jpg', 'Oil Content Of Treaded Water', '-'),
('BRG00040', 'Drum Plastik', '65b72b206912b.jpg', 'ukuran 200 liter', '-'),
('BRG00041', 'Lampu Penerangan TL Phillips 18w', '65b72b617703c.jpg', '1 lampu 2 TL', '-'),
('BRG00042', 'Lifebouy', '65b72babdce37.jpg', '-', '-'),
('BRG00043', 'Tali Tambat ', '65b72bdec9be2.jpg', 'ukuran 6 inch', '-'),
('BRG00044', 'Dinamo', '65b72c118eb48.jpg', '-', '-'),
('BRG00045', 'Tangga Monyet', '65b72c62d87a4.jpg', '-', '-'),
('BRG00046', 'Box Panel', '65b72c94ee8e4.jpg', 'Panel Listrik', '-'),
('BRG00047', 'Hose ', '65b72cc948b23.jpg', '6 inch', '2 meter\r\n'),
('BRG00048', 'Accu Solar Panel ', '65b7480ef1f97.jpg', '6V 225Ah/20hr Leoch DT 106', '-'),
('BRG00049', 'Tangga Almunium', '65b7484e8f34d.jpg', 'Tangga Almunium', '-'),
('BRG00050', 'Lampu Sorot LED', '65b74881ed711.jpg', '50w', 'Visalux \r\n'),
('BRG00051', 'Pompa Grease', '65b748b92dbb7.jpg', 'Pompa Grease', '-'),
('BRG00052', 'Power Supply cctv', '65b748f0cff0a.jpg', '10A(120w)', 'Mata\r\n'),
('BRG00053', 'Charger Accu Iwara', '65b7492433ca9.jpg', 'Iwara', '-'),
('BRG00054', 'Waterjet + tembakan', '65b749884c853.jpg', 'Krissbow', '-'),
('BRG00055', 'Alkon Diesel', '65b749ba00d77.jpg', '2 inch', 'Robin\r\n'),
('BRG00056', 'Lingkis Besar', '65b749fcbfb32.jpg', 'Lingkis Besar', '-'),
('BRG00057', 'Filter Oil OS6039', '65b74b312bbcc.jpg', 'Superior Part', '-'),
('BRG00058', 'Filter Oil OS6065', '65b74b6f1fd5c.jpg', 'Superior Part', '-'),
('BRG00059', 'Fuel Filter FS 6201', '65b74bfe990c7.jpg', 'Superior Part', '-'),
('BRG00060', 'Majun', '65b74c3317f47.jpg', 'Majun', '-'),
('BRG00061', 'Chemical', '65b74d5cab120.jpg', 'part of sopep', '-'),
('BRG00062', 'Kertas Almunium Foil', '65b74d98029d9.jpg', 'Alumunium Foil', '-'),
('BRG00063', 'Grease ', '65b74dc5c7737.jpg', '18kg', 'Unical\r\n'),
('BRG00064', 'Belting', '65b74df4d02e3.jpg', '8450', 'Mitsubishi\r\n'),
('BRG00065', 'Kertas Packing', '65b74e29dbae9.jpg', '1/2 mm', 'Firefly\r\n'),
('BRG00066', 'Mata Gerinda Katana', '65b74e615295a.jpg', 'Katana', '-'),
('BRG00067', 'Mata Gerinda K55', '65b74edded0e1.jpg', 'K55', '-'),
('BRG00068', 'Bag Filter ', '65b74f1001935.jpg', 'Element 400 5micron', 'Micfil\r\n'),
('BRG00069', 'Ultra Fine Filter', '65b74f4e4a9ae.jpg', '0,5 um', 'Micfil\r\n'),
('BRG00070', 'Kabel Roll Colokan mata 3 bulat', '65b74f9d3f202.jpg', 'Colokan mata 3 bulat', '-'),
('BRG00071', 'Plastik Blower', '65b74fcf9ac44.jpg', 'Plastik Blower', '-'),
('BRG00072', 'Blower Portable', '65b74ffcdd0c8.jpg', 'Tayol', '-'),
('BRG00073', 'Stabilizer SVC-500', '65b7504246e55.jpg', 'JES Elektronik', '-'),
('BRG00074', 'Stabilizer SVC-1000', '65b7507c11fc7.jpg', 'Matsunaga Stavol', '-'),
('BRG00075', 'Steker Kaki 3', '65b750b78d14a.jpg', '-', '-'),
('BRG00076', 'Steker Kaki 2', '65b750e72d751.jpg', '-', '-'),
('BRG00077', 'Meja Kantor', '65b751147f818.jpg', '-', '-'),
('BRG00078', 'Besi Siku ', '65b7514392c8a.jpg', '2 Meter', '-'),
('BRG00079', 'Sarung Tangan', '65b7517646a45.jpg', 'Kain', '-'),
('BRG00080', 'Air Accu', '65b751af9296e.jpg', 'Air Accu', '-'),
('BRG00081', 'Cat Hijau', '65b751ded55a6.jpg', 'Sigmarine 48 5L', 'Green 4199 '),
('BRG00082', 'Connection', '65b75216eff99.jpg', '3,5 inch', '-'),
('BRG00083', 'Plang', '65b752512f416.jpg', '3,5 inch', '-'),
('BRG00084', 'Trangking Besar', '65b7528172562.jpg', '-', '-'),
('BRG00085', 'Pipa Trangking', '65b752aa7d560.jpg', '-', '-'),
('BRG00086', 'Segal Rantai', '65b752cfa63fe.jpg', 'M16', '-'),
('BRG00087', 'Reduser 3 camlock 3', '65b752fe4e901.jpg', '-', '-'),
('BRG00088', 'Tali Lifebouy', '65b77d231c0ff.jpg', 'Tali Lifebouy', '-');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_transaksi` varchar(50) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `qty_masuk` int(5) NOT NULL,
  `harga_brg` decimal(10,0) NOT NULL,
  `waranty` varchar(50) DEFAULT NULL,
  `renewal` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `id_vendor` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_satuan` int(10) NOT NULL,
  `id_req_brg` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_of_account`
--

CREATE TABLE `cart_of_account` (
  `kode_coa` int(10) NOT NULL,
  `name_account` varchar(60) NOT NULL,
  `account_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_of_account`
--

INSERT INTO `cart_of_account` (`kode_coa`, `name_account`, `account_type`) VALUES
(1000, ' ASET', 'ASET'),
(1100, ' Aset Lancar ', 'Aset Lancar'),
(1110, ' Kas dan Setara Kas ', 'Kas & Bank'),
(1111, ' Kas ', 'Kas'),
(1112, ' Bank ', 'Bank'),
(1120, ' Piutang Usaha', 'Piutang Usaha'),
(1121, ' Anugerah Prima Samudera, PT ', 'Piutang Usaha'),
(1122, ' Ciwi Real Estate, PT ', 'Piutang Usaha'),
(1123, ' Ciwi Sempurna Beton, PT ', 'Piutang Usaha'),
(1124, ' Eka Prima Nusa, PT ', 'Piutang Usaha'),
(1125, ' Ghatala Multi Karya, PT ', 'Piutang Usaha'),
(1126, ' LA Engineering, PT ', 'Piutang Usaha'),
(1127, ' Seascape Surveys Indonesia, PT  ', 'Piutang Usaha'),
(1128, ' United Shipping Indonesia, PT  ', 'Piutang Usaha'),
(1130, ' Piutang Non Usaha ', 'Piutang Non Usaha'),
(1140, ' Piutang Pemegang Saham ', 'Piutang Pemegang Saham'),
(1141, ' Sanjeev ', 'Piutang Pemegang Saham'),
(1150, ' Piutang Related Party ', 'Piutang Related Party'),
(1151, ' Mitra Utama Energi, PT  ', 'Piutang Related Party'),
(1152, ' Mitra Maritm Mandiri, PT ', 'Piutang Related Party'),
(1160, ' Pajak Dibayar Dimuka ', 'Pajak Dibayar Dimuka'),
(1170, ' Biaya Dibayar Dimuka ', 'Aktiva Lancar Lainnya'),
(1200, ' Aset Tidak Lancar ', 'Aset Tidak Lancar'),
(1210, ' Aset Tetap ', 'Aset Tetap'),
(1211, ' Aset Tetap - Harga Perolehan ', 'Aset Tetap'),
(1212, ' Aset Tetap - Akumulasi Penyusutan ', 'Aset Tetap-Akumulasi Penyusutan'),
(1220, ' Investasi ', 'Aktiva Lancar Lainnya'),
(2000, ' KEWAJIBAN ', 'KEWAJIBAN'),
(2100, ' Hutang Lancar ', 'Hutang Lancar'),
(2110, ' Hutang Usaha ', 'Hutang Usaha'),
(2111, ' Ganani Indonesia Petroleum Energy, PT  ', 'Hutang Usaha'),
(2112, ' Merah Putih Petro Gas, PT ', 'Hutang Usaha'),
(2113, ' Divos, PT ', 'Hutang Usaha'),
(2130, ' Hutang Non Usaha ', 'Hutang Non Usaha'),
(2131, ' United Shipping Indonesia, PT  ', 'Hutang Non Usaha'),
(2132, ' Kilau Permata Indonesia, PT ', 'Hutang Non Usaha'),
(2133, ' Sanjeev - MUE  ', 'Hutang Non Usaha'),
(2134, ' Michael - MUE ', 'Hutang Non Usaha'),
(2135, ' Mitra Maritim Mandiri, PT  ', 'Hutang Non Usaha'),
(2136, ' Sadikun ', 'Hutang Non Usaha'),
(2137, ' James ', 'Hutang Non Usaha'),
(2138, ' Michael  ', 'Hutang Non Usaha'),
(2139, ' Regina ', 'Hutang Non Usaha'),
(2140, ' Hutang Bank ', 'Hutang Bank'),
(2150, ' Hutang Pajak ', 'Hutang Pajak'),
(2170, ' Biaya Yang Masih Harus Dibayar ', 'Biaya Yang Masih Harus Dibayar'),
(2200, ' Hutang Jangka Panjang ', 'Hutang Jangka Panjang'),
(2210, ' Hutang Pembiayaan ', 'Hutang Jangka Panjang'),
(3000, ' EKUITAS ', 'EKUITAS'),
(3100, ' Modal ', 'EKUITAS'),
(3200, ' Laba Ditahan ', 'Laba Ditahan'),
(4200, ' PENDAPATAN USAHA LAIN LAIN ', 'Pendapatan'),
(4210, ' Pendapatan Usaha Lain Lain ', 'Pendapatan'),
(5000, ' BEBAN POKOK PENJUALAN ', 'Harga Pokok Penjualan'),
(5110, ' Harga Pokok - HSD ', 'Harga Pokok Penjualan'),
(5200, ' BEBAN LANGSUNG ', 'Harga Pokok Penjualan'),
(5210, ' Beban Penjualan - Pengiriman ', 'Harga Pokok Penjualan'),
(5211, ' Beban Penjualan - Lainnya ', 'Harga Pokok Penjualan'),
(5212, ' Beban Pembelian - Sandar ', 'Harga Pokok Penjualan'),
(5213, ' Beban Pembelian - Pengiriman ', 'Harga Pokok Penjualan'),
(5214, ' Beban Pembelian - Lainnya ', 'Harga Pokok Penjualan'),
(5300, ' BIAYA PENJUALAN ', 'Harga Pokok Penjualan'),
(5310, ' Biaya Komisi  ', 'Harga Pokok Penjualan'),
(5311, ' Biaya Entertainment  ', 'Harga Pokok Penjualan'),
(5312, ' Biaya Survey ', 'Harga Pokok Penjualan'),
(5313, ' Biaya Kordinasi ', 'Harga Pokok Penjualan'),
(6000, ' BIAYA UMUM ', 'Beban'),
(6100, ' BIAYA GAJI DAN TUNJANGAN ADMIN ', 'Beban'),
(6110, ' Biaya Umum - Gaji Karywan ', 'Beban'),
(6111, ' Biaya Umum - PPh Pasal 21 Karyawan ', 'Beban'),
(6112, ' Biaya Umum - THR  ', 'Beban'),
(6113, ' Biaya Umum - Bonus ', 'Beban'),
(6114, ' Biaya Umum - Pesangon Karyawan ', 'Beban'),
(6115, ' Biaya Umum - BPJS Ketenagakerjaan ', 'Beban'),
(6116, ' Biaya Umum - BPJS Kesehatan ', 'Beban'),
(6200, ' BIAYA TRANSPORTASI &amp; DINAS ', 'Beban'),
(6210, ' Biaya Umum - BBM ', 'Beban'),
(6211, ' Biaya Umum - Transport &amp; Akomodasi ', 'Beban'),
(6213, ' Biaya Umum - Tol &amp; Parkir ', 'Beban'),
(6300, ' BIAYA KEPERLUAN GEDUNG ', 'Beban'),
(6310, ' Biaya Umum - Listrik ', 'Beban'),
(6311, ' Biaya Umum -  Air  ', 'Beban'),
(6312, ' Biaya Umum - Telepon &amp; Internet ', 'Beban'),
(6313, ' Biaya Umum - Kebersihan &amp; Keamanan ', 'Beban'),
(6400, ' BIAYA PERAWATAN ', 'Beban'),
(6410, ' Biaya Umum - Perawatan Bangunan ', 'Beban'),
(6411, ' Biaya Umum - Perawatan Kendaraan ', 'Beban'),
(6412, ' Biaya Umum - Perawatan Peralatan Kantor ', 'Beban'),
(6413, ' Biaya Umum - Perawatan Komputer &amp; Software ', 'Beban'),
(6414, ' Biaya Umum - Perawatan Mesin ', 'Beban'),
(6500, ' BIAYA KONSULTAN DAN PERIJINAN ', 'Beban'),
(6510, ' Biaya Umum - Konsultan ', 'Beban'),
(6511, ' Biaya Umum - Audit ', 'Harga Pokok Penjualan'),
(6512, ' Biaya Umum - Legalisasi Dan Perijinan ', 'Beban'),
(6600, ' BIAYA ASURANSI ', 'Beban'),
(6610, ' Biaya Umum - Asuransi Property ', 'Beban'),
(6611, ' Biaya Umum - Asuransi Aset Tetap ', 'Beban'),
(6612, ' Biaya Umum - Asuransi Lainnya ', 'Beban'),
(6700, ' BIAYA PENYUSUTAN ', 'Beban'),
(6710, ' Biaya Umum - Penyusutan Kendaraan ', 'Beban'),
(6711, ' Biaya Umum - Penyusutan Peralatan Kantor ', 'Beban'),
(6712, ' Biaya Umum - Penyusutan Komputer ', 'Beban'),
(6713, ' Biaya Umum - Penyusutan Bangunan ', 'Beban'),
(6714, ' Biaya Umum - Penyusutan Mesin ', 'Beban'),
(6800, ' BIAYA KEPERLUAN KANTOR ', 'Beban'),
(6810, ' Biaya Umum - Alat Tulis Kantor ', 'Harga Pokok Penjualan'),
(6811, ' Biaya Umum - Kurir dan Pos ', 'Beban'),
(6900, ' BIAYA UMUM DAN LAINNYA ', 'Beban'),
(6910, ' Biaya Umum - Perekrutan ', 'Beban'),
(6911, ' Biaya Umum - Training ', 'Beban'),
(6912, ' Biaya Umum - Sumbangan &amp; Iuran ', 'Beban'),
(6913, ' Biaya Umum - Lain Lain ', 'Beban'),
(7000, ' BIAYA DAN PENDAPATAN LAIN DILUAR USAHA ', 'Beban Lainnya'),
(7100, ' BIAYA FINANCE ', 'Beban Lainnya'),
(7110, ' Biaya Finance - Bank &amp; Pinjaman ', 'Beban Lainnya'),
(7111, ' Biaya Finance - Administrasi Bank ', 'Beban Lainnya'),
(7112, ' Biaya Finance - Bunga Pinjaman Bank ', 'Beban Lainnya'),
(7113, ' Biaya Finance - Bunga Leasing ', 'Beban Lainnya'),
(7114, ' Biaya Finance - Bunga Pinjaman Lainnya ', 'Beban Lainnya'),
(7115, ' Biaya Finance - Pajak Pendapatan Bunga ', 'Beban Lainnya'),
(7116, ' Biaya Finance - Selisih Nilai Kurs ', 'Beban Lainnya'),
(7117, ' Biaya Finance - Finance Lainnya ', 'Beban Lainnya'),
(7130, ' Biaya Lain - Kerugian Investasi ', 'Beban Lainnya'),
(7131, ' Biaya Lain - Kerugian Piutang ', 'Beban Lainnya'),
(7132, ' Biaya Lain - Kerugian Penjualan Aset ', 'Beban Lainnya'),
(7200, ' BIAYA PAJAK ', 'Beban Lainnya'),
(7211, ' Biaya Pajak - PBB ', 'Beban'),
(7212, ' Biaya Pajak - Kendaraan ', 'Beban Lainnya'),
(7213, ' Biaya Pajak - Denda Pajak ', 'Beban Lainnya'),
(7300, ' BIAYA LAIN LAIN ', 'Beban Lainnya'),
(7400, ' PENDAPATAN LAIN LAIN DILUAR USAHA ', 'Pendapatan Lainnya'),
(7410, ' Pendapatan Lain - Bunga &amp; Bank ', 'Pendapatan Lainnya'),
(7411, ' Pendapatan Lain - Bunga Bank ', 'Pendapatan Lainnya'),
(7412, ' Pendapatan Lain - Bunga Deposito ', 'Pendapatan Lainnya'),
(7420, ' Pendapatan Lain - Keuntungan Penjualan Aset ', 'Pendapatan Lainnya'),
(7421, ' Pendapatan Lain - Lainnya ', 'Pendapatan Lainnya'),
(7500, ' PPH 15 FINAL ', 'Beban Lainnya'),
(7510, ' Biaya Pajak - PPh Final Pasal 15 ', 'Beban Lainnya'),
(1111001, ' Kas idr ', ' Kas  '),
(1112001, ' Bank Mandiri - Batam 1090500006663 ', ' Bank '),
(1112002, ' Bank Mandiri - Batam 1090040001331 ', 'Bank'),
(1160001, ' Pajak Dibayar Dimuka - PPn ', 'Pajak Dibayar Dimuka'),
(1160002, ' Pajak Dibayar Dimuka - PPh 22 ', 'Pajak Dibayar Dimuka'),
(1160003, ' Pajak Dibayar Dimuka - PPh 23 ', 'Pajak Dibayar Dimuka'),
(1160004, ' Pajak Dibayar Dimuka - PPh 25 ', 'Pajak Dibayar Dimuka'),
(1211001, ' HPP - Kapal ', 'Aset Tetap'),
(1211002, ' HPP - Perlengkapan &amp; Perawatan Kapal ', 'Aset Tetap'),
(1211003, ' HPP - Peralatan Kantor ', 'Aset Tetap'),
(1211004, ' HPP - Kendaraan ', 'Aset Tetap'),
(1212001, ' Peny. - Kapal ', 'Akumulasi Penyusutan'),
(1212002, ' Peny. - Perlengkapan &amp; Perawatan Kapal ', 'Akumulasi Penyusutan'),
(1212003, ' Peny. - Peralatan Kantor ', 'Akumulasi Penyusutan'),
(1212004, ' Peny. - Kendaraan ', 'Akumulasi Penyusutan'),
(1220001, ' Investasi - Pelabuhan Tanjung Balai ', 'Aktiva Lancar Lainnya'),
(2140001, ' Hutang Bank - Mandiri ', 'Hutang Lancar Lainnya'),
(2150001, ' Hutang Pajak - PPn ', 'Hutang Lancar Lainnya'),
(2150002, ' Hutang Pajak - PPh 15 ', 'Hutang Lancar Lainnya'),
(2150003, ' Hutang Pajak - PPh 21 ', 'Hutang Lancar Lainnya'),
(2150004, ' Hutang Pajak - PPh 22 ', 'Hutang Lancar Lainnya'),
(2150005, ' Hutang Pajak - PPh 23 ', 'Hutang Lancar Lainnya'),
(2150006, ' Hutang Pajak - PPh 29 ', 'Hutang Lancar Lainnya'),
(2170001, ' Biaya Yang Masih Harus Dibayar - Gaji ', 'Biaya Yang Masih Harus Dibayar'),
(3100001, ' Modal Sanjev ', 'EKUITAS'),
(3100002, ' Modal Yaya ', 'EKUITAS'),
(3200001, ' Laba Sebelumnya ', 'Laba Ditahan'),
(3200002, ' Laba Berjalan ', 'Laba Ditahan');

-- --------------------------------------------------------

--
-- Table structure for table `ijazah`
--

CREATE TABLE `ijazah` (
  `id_ijazah` int(10) NOT NULL,
  `no_ijazah` varchar(40) NOT NULL,
  `tgl_penitipan` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status_ijazah` varchar(50) NOT NULL,
  `scan_ijazah` varchar(200) NOT NULL,
  `id_emp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ijazah`
--

INSERT INTO `ijazah` (`id_ijazah`, `no_ijazah`, `tgl_penitipan`, `tgl_kembali`, `status_ijazah`, `scan_ijazah`, `id_emp`) VALUES
(60, 'M-SMK/1100023', '2024-01-02', '0000-00-00', 'Sedang dititipkan', '65aa48284ecd6.pdf', 30);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(10) NOT NULL,
  `no_invoice` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `no_invoice`) VALUES
(23, 'NO. 002/PO/MMM/I/2024'),
(24, 'NO. 003/PO/MMM/I/2024'),
(26, 'NO. 004/PO/MMM/I/2024'),
(31, 'NO. 005/PO/MMM/I/2024'),
(32, 'NO. 006/PO/MMM/I/2024'),
(33, 'NO. 007/PO/MMM/I/2024');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id_jurnal` int(10) NOT NULL,
  `tgl_jurnal` date DEFAULT NULL,
  `ket_jurnal` text NOT NULL,
  `debit` decimal(10,0) DEFAULT NULL,
  `kredit` decimal(10,0) DEFAULT NULL,
  `no_jurnal` varchar(50) NOT NULL,
  `kode_coa` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id_jurnal`, `tgl_jurnal`, `ket_jurnal`, `debit`, `kredit`, `no_jurnal`, `kode_coa`) VALUES
(20, '2024-02-07', 'tes', 1000000, 0, '003/GPP/2024', 1112),
(22, '2024-02-07', '-', 1500000, 0, '003/GPP/2024', 1000),
(23, '2024-02-07', '', 100000, 0, '003/GPP/2024', 6310),
(24, '2024-02-07', '-', 1000000, 0, '001/GPP', 1120),
(25, '2024-02-07', 'beli monitor lantai 2', 0, 850000, '001/GPP', 1000),
(26, '2024-02-07', 'wifi', 495000, 0, '001/GPP', 6913),
(27, '2024-02-07', 'listrik kantor', 500000, 0, '001/GPP', 6310);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_emp` int(10) NOT NULL,
  `nama_emp` varchar(40) NOT NULL,
  `jabatan` varchar(40) NOT NULL,
  `divisi` varchar(40) NOT NULL,
  `status` varchar(30) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(30) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `status_pernikahan` varchar(30) DEFAULT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_emp`, `nama_emp`, `jabatan`, `divisi`, `status`, `gambar`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `no_hp`, `email`, `status_pernikahan`, `nik`, `npwp`) VALUES
(5, 'Andre Yogi', 'Staff Operasional', 'Office', 'Aktif', '65a4f45ead15a.png', NULL, NULL, NULL, '', '', '', NULL, ''),
(8, 'Raden Sulaiman Sanjeev', 'Direktur Utama', 'BSD', 'Aktif', '65a4f45ead15a.png', '1985-01-01', 'Laki-laki', '-', '0', 'sanjeev@bumi-laut.com', 'Sudah Menikah', '1312', '1321'),
(9, 'Regina', 'Direktur Keuangan', 'BSD', 'Aktif', '65a4f45ead15a.png', NULL, NULL, NULL, '', '', '', NULL, ''),
(10, 'James Taju', 'Direktur HRD', 'HRM', 'Aktif', '65a4f45ead15a.png', '1980-01-01', 'Laki-laki', '-', '1231231', 'btm@gmail.xom', 'Sudah Menikah', '123', '123'),
(11, 'Bambang Wahyudi', 'Direktur Operasional', 'Manager', 'Aktif', '65a4f45ead15a.png', '0000-00-00', 'Laki-laki', '-', '0', 'btm@gmail.xom', 'Sudah Menikah', '132', '132'),
(12, 'Michael Kawilarang', 'Kepala Cabang', 'Manager', 'Aktif', '65a8b1dbd087d.png', '0000-00-00', 'Laki-laki', '-', '0', 'batam@gmail.com', 'Sudah Menikah', '123', '123'),
(13, 'Gahral', 'Kepala Operasional', 'Shipping', 'Aktif', '65a4f45ead15a.png', NULL, NULL, NULL, '', '', '', NULL, ''),
(14, 'Elis', 'Kepala Finance', 'Finance', 'Aktif', '65a4f45ead15a.png', '0000-00-00', 'Laki-laki', '-', '0', 'btm@gmail.xom', 'Belum Menikah', '123', '1321'),
(15, 'Rika', 'Staff Shipping', 'Shipping', 'Aktif', '65a4f45ead15a.png', NULL, NULL, NULL, '', '', '', NULL, ''),
(16, 'Krisno', 'Staff Shipping', 'Shipping', 'Aktif', '65a4f45ead15a.png', NULL, NULL, NULL, '', '', '', NULL, ''),
(17, 'Niken', 'Staff Finance', 'Finance', 'Aktif', '65a4f45ead15a.png', NULL, NULL, NULL, '', '', '', NULL, ''),
(18, 'Robby T. Hamisi ', 'Staff Operasional', 'Operasional', 'Aktif', '65a4f45ead15a.png', '1980-08-08', 'Laki-laki', 'Nongsa', '082285686292', 'robby.t@gmail.com', 'Sudah Menikah', '2171012205180001', '082222050215000'),
(19, 'Alex Untu', 'Staff Operasional', 'Operasional', 'Aktif', '65a8a7a4c616b.png', '0000-00-00', 'Laki-laki', 'Bengkong Kolam Swadaya', '081100001212', 'alex@gmail.com', 'Belum Menikah', '2171012122030001', '927824938215000'),
(30, 'Muhammad Mabrur Al Mutaqi', 'Staff IT', 'IT Dept', 'Aktif', '65a8cc3d11e59.png', '2002-05-21', 'Laki-laki', 'Cipta Asri blok Herba no.120', '082178192938', 'mabruralmutaqi@gmail.com', 'Belum Menikah', '2171012105020001', '95.461.480.6-225.000');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_cuti`
--

CREATE TABLE `kategori_cuti` (
  `id_kategori_cuti` int(10) NOT NULL,
  `kategori_cuti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_cuti`
--

INSERT INTO `kategori_cuti` (`id_kategori_cuti`, `kategori_cuti`) VALUES
(4, 'Annual Leave'),
(5, 'Sick Leave'),
(6, 'Unpaid Leave');

-- --------------------------------------------------------

--
-- Table structure for table `kontrak_kerja`
--

CREATE TABLE `kontrak_kerja` (
  `id_kontrak` int(10) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `gaji_pokok` int(10) NOT NULL,
  `tunjangan` int(10) NOT NULL,
  `status_kontrak` varchar(40) NOT NULL,
  `id_emp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontrak_kerja`
--

INSERT INTO `kontrak_kerja` (`id_kontrak`, `tgl_mulai`, `tgl_akhir`, `gaji_pokok`, `tunjangan`, `status_kontrak`, `id_emp`) VALUES
(27, '2025-04-04', '0000-00-00', 6000000, 0, 'Permanent', 30),
(28, '2025-04-25', '0000-00-00', 6000000, 500000, 'Permanent', 17);

-- --------------------------------------------------------

--
-- Table structure for table `lantai`
--

CREATE TABLE `lantai` (
  `id_lantai` int(10) NOT NULL,
  `nama_lantai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lantai`
--

INSERT INTO `lantai` (`id_lantai`, `nama_lantai`) VALUES
(1, 'Lantai 1'),
(2, 'Lantai 2'),
(3, 'Lantai 3');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_barang`
--

CREATE TABLE `lokasi_barang` (
  `id_lokasi` int(10) NOT NULL,
  `nama_lokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi_barang`
--

INSERT INTO `lokasi_barang` (`id_lokasi`, `nama_lokasi`) VALUES
(1, 'OB Mitra Utama 03'),
(2, 'OB Selaras 01'),
(3, 'OB Garuda'),
(4, 'TB Tiga Permata'),
(8, 'Office');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_room`
--

CREATE TABLE `lokasi_room` (
  `id_room` int(10) NOT NULL,
  `room_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi_room`
--

INSERT INTO `lokasi_room` (`id_room`, `room_name`) VALUES
(1, 'Engine Room'),
(2, 'Store Room'),
(3, 'Main Deck'),
(4, 'Cabin Crew'),
(5, 'Office Lt. 1'),
(6, 'Office Lt. 2'),
(7, 'Office Lt. 3');

-- --------------------------------------------------------

--
-- Table structure for table `manage_cuti`
--

CREATE TABLE `manage_cuti` (
  `id_manage_cuti` int(10) NOT NULL,
  `id_kategori_cuti` int(10) NOT NULL,
  `kuota_cuti` int(5) NOT NULL,
  `id_emp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_cuti`
--

INSERT INTO `manage_cuti` (`id_manage_cuti`, `id_kategori_cuti`, `kuota_cuti`, `id_emp`) VALUES
(28, 4, 9, 30),
(29, 6, 3, 30),
(30, 5, 6, 30),
(32, 4, 8, 19),
(33, 5, 6, 19),
(34, 6, 3, 19);

-- --------------------------------------------------------

--
-- Table structure for table `no_jurnal`
--

CREATE TABLE `no_jurnal` (
  `no_jurnal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `no_jurnal`
--

INSERT INTO `no_jurnal` (`no_jurnal`) VALUES
('001/GPP'),
('003/GPP/2024');

-- --------------------------------------------------------

--
-- Table structure for table `po_barang`
--

CREATE TABLE `po_barang` (
  `id_po` int(10) NOT NULL,
  `id_req_brg` int(10) NOT NULL,
  `tgl_po` date DEFAULT NULL,
  `qty_po` int(5) DEFAULT NULL,
  `harga_po` int(10) DEFAULT NULL,
  `ket_po` text DEFAULT NULL,
  `acc3` varchar(40) DEFAULT NULL,
  `acc4` varchar(40) DEFAULT NULL,
  `acc5` varchar(40) DEFAULT NULL,
  `id_vendor` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_invoice` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_barang`
--

INSERT INTO `po_barang` (`id_po`, `id_req_brg`, `tgl_po`, `qty_po`, `harga_po`, `ket_po`, `acc3`, `acc4`, `acc5`, `id_vendor`, `id_user`, `id_invoice`) VALUES
(48, 70, '2024-02-02', 1, 5000000, '4 cilinder', 'James Taju', 'Regina', 'Raden Sulaiman Sanjeev', 2, 27, 23),
(49, 71, '2024-02-02', 1, 15000, '-', 'James Taju', 'Regina', 'Raden Sulaiman Sanjeev', 1, 27, 24),
(50, 72, '2024-02-02', 1, 150000, '-', 'James Taju', 'Regina', 'Raden Sulaiman Sanjeev', 1, 27, 24),
(51, 74, '2024-02-02', 1, 300000, 'untuk bersih bersih kapal', 'James Taju', 'Regina', 'Raden Sulaiman Sanjeev', 1, 27, 24),
(52, 73, '2024-02-02', 1, 120000, '-', 'James Taju', 'Regina', 'Raden Sulaiman Sanjeev', 2, 27, 26),
(53, 75, '2024-02-02', 1, 500000, '1', 'James Taju', 'Regina', 'Raden Sulaiman Sanjeev', 3, 27, 31),
(83, 76, '2024-02-05', 1, 300000, 'aki kapal', 'James Taju', 'Regina', 'Raden Sulaiman Sanjeev', 1, 27, 32),
(84, 77, '2024-02-06', 1, 1500000, '-', '', '', '', 1, 27, 33);

-- --------------------------------------------------------

--
-- Table structure for table `qrcode`
--

CREATE TABLE `qrcode` (
  `id_qr` int(10) NOT NULL,
  `id_emp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qrcode`
--

INSERT INTO `qrcode` (`id_qr`, `id_emp`) VALUES
(10, 8);

-- --------------------------------------------------------

--
-- Table structure for table `req_barang`
--

CREATE TABLE `req_barang` (
  `id_req_brg` int(10) NOT NULL,
  `kode_pengajuan` varchar(100) NOT NULL,
  `kode_brg` varchar(40) NOT NULL,
  `qty_req` int(5) NOT NULL,
  `tgl_req_brg` date NOT NULL,
  `alasan` text DEFAULT NULL,
  `status_req` varchar(50) NOT NULL,
  `acc1` varchar(50) DEFAULT NULL,
  `acc2` varchar(50) DEFAULT NULL,
  `acc3` varchar(50) DEFAULT NULL,
  `id_lokasi` int(10) NOT NULL,
  `id_room` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_satuan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `req_barang`
--

INSERT INTO `req_barang` (`id_req_brg`, `kode_pengajuan`, `kode_brg`, `qty_req`, `tgl_req_brg`, `alasan`, `status_req`, `acc1`, `acc2`, `acc3`, `id_lokasi`, `id_room`, `id_user`, `id_satuan`) VALUES
(70, 'REQ-24020200021-18827', 'BRG00001', 1, '2024-02-02', 'urgent\r\n', 'Selesai', 'Gahral', 'Michael Kawilarang', 'Bambang Wahyudi', 1, 1, 28, 1),
(71, 'REQ-24020200022-74496', 'BRG00004', 1, '2024-02-02', 'aki lama sudah soak\r\n', 'Selesai', 'Gahral', 'Michael Kawilarang', 'Bambang Wahyudi', 4, 1, 28, 1),
(72, 'REQ-24020200023-72480', 'BRG00009', 1, '2024-02-02', 'untuk tools', 'Selesai', 'Gahral', 'Michael Kawilarang', 'Bambang Wahyudi', 4, 1, 28, 3),
(73, 'REQ-24020200024-47696', 'BRG00050', 1, '2024-02-02', 'untuk penerangan', 'Selesai', 'Gahral', 'Michael Kawilarang', 'Bambang Wahyudi', 1, 3, 28, 1),
(74, 'REQ-24020200025-97786', 'BRG00072', 1, '2024-02-02', '', 'Selesai', 'Gahral', 'Michael Kawilarang', 'Bambang Wahyudi', 1, 2, 28, 1),
(75, 'REQ-24020200026-97908', 'BRG00008', 1, '2024-02-02', '-', 'Selesai', 'Gahral', 'Michael Kawilarang', 'Bambang Wahyudi', 1, 2, 29, 1),
(76, 'REQ-24020500027-93897', 'BRG00004', 1, '2024-02-05', 'sudah waktunya ganti aki', 'Selesai', 'Gahral', 'Michael Kawilarang', 'Bambang Wahyudi', 2, 1, 28, 1),
(77, 'REQ-24020600028-82431', 'BRG00082', 1, '2024-02-06', '-', 'Menunggu Persetujuan Dir. HRD', 'Gahral', 'Michael Kawilarang', 'Bambang Wahyudi', 1, 1, 28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `req_cuti`
--

CREATE TABLE `req_cuti` (
  `id_req_cuti` int(10) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `jml_hari` int(5) NOT NULL,
  `tipe_cuti` varchar(30) DEFAULT NULL,
  `alasan` text NOT NULL,
  `status_cuti` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_emp` int(10) NOT NULL,
  `id_kategori_cuti` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `req_cuti`
--

INSERT INTO `req_cuti` (`id_req_cuti`, `tgl_mulai`, `tgl_akhir`, `jml_hari`, `tipe_cuti`, `alasan`, `status_cuti`, `created_at`, `updated_at`, `id_emp`, `id_kategori_cuti`) VALUES
(22, '2024-01-25', '2024-01-25', 1, 'Full Day', 'perpanjang STNK', 'Sudah diapprove', '2024-01-23 14:39:37', '2024-01-23 14:54:18', 30, 4),
(23, '2024-01-25', '2024-01-26', 2, 'Full Day', 'Pulang Kampung', 'Sudah diapprove', '2024-01-23 14:56:52', '2024-01-23 15:03:19', 30, 4),
(30, '2024-01-24', '2024-01-24', 1, 'Full Day', 'Ngurus ATM', 'Sudah diapprove', '2024-01-23 17:47:40', '2024-01-23 17:48:41', 19, 4);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(10) NOT NULL,
  `nama_satuan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Unit'),
(2, 'Pack'),
(3, 'Pcs'),
(4, 'Liter'),
(5, 'Lusin'),
(6, 'Box'),
(7, 'Galon'),
(8, 'Botol'),
(9, 'Set'),
(10, 'Roll'),
(11, 'Kg'),
(12, 'Drum');

-- --------------------------------------------------------

--
-- Table structure for table `storage_barang`
--

CREATE TABLE `storage_barang` (
  `id_storage` int(10) NOT NULL,
  `tgl_input` date NOT NULL,
  `qty_brg` int(5) NOT NULL,
  `kondisi_brg` text NOT NULL,
  `ket_kondisi` text DEFAULT NULL,
  `kode_brg` varchar(40) NOT NULL,
  `id_lokasi` int(10) NOT NULL,
  `id_satuan` int(10) NOT NULL,
  `id_room` int(10) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storage_barang`
--

INSERT INTO `storage_barang` (`id_storage`, `tgl_input`, `qty_brg`, `kondisi_brg`, `ket_kondisi`, `kode_brg`, `id_lokasi`, `id_satuan`, `id_room`, `id_user`) VALUES
(3, '2024-01-29', 1, 'Baik', '-', 'BRG00001', 1, 1, 1, 13),
(4, '2024-01-29', 1, 'Baik', '-', 'BRG00002', 1, 1, 1, 27),
(5, '2024-01-29', 1, 'Baik', '-', 'BRG00003', 1, 1, 1, 27),
(6, '2024-01-29', 4, 'Baik', '-', 'BRG00004', 1, 1, 1, 27),
(7, '2024-01-29', 2, 'Baik', '-', 'BRG00005', 1, 1, 1, 27),
(8, '2024-01-29', 2, 'Baik', '-', 'BRG00006', 1, 1, 1, 27),
(9, '2024-01-29', 3, 'Baik', '-', 'BRG00007', 1, 1, 1, 27),
(10, '2024-01-29', 1, 'Baik', '-', 'BRG00008', 1, 1, 1, 27),
(11, '2024-01-29', 1, 'Baik', '-', 'BRG00009', 1, 3, 1, 27),
(12, '2024-01-29', 2, 'Baik', '-', 'BRG00009', 1, 1, 1, 27),
(13, '2024-01-29', 1, 'Baik', '-', 'BRG00011', 1, 1, 1, 27),
(14, '2024-01-29', 1, 'Baik', '-', 'BRG00012', 1, 1, 1, 27),
(15, '2024-01-29', 1, 'Baik', '-', 'BRG00013', 1, 1, 1, 27),
(16, '2024-01-29', 1, 'Baik', '-', 'BRG00014', 1, 3, 1, 27),
(17, '2024-01-29', 1, 'Baik', '-', 'BRG00015', 1, 2, 1, 27),
(18, '2024-01-29', 2, 'Baik', '-', 'BRG00016', 1, 3, 1, 27),
(19, '2024-01-29', 1, 'Baik', '-', 'BRG00017', 1, 3, 1, 27),
(20, '2024-01-29', 1, 'Baik', '-', 'BRG00018', 1, 2, 1, 27),
(21, '2024-01-29', 1, 'Baik', '-', 'BRG00019', 1, 2, 1, 27),
(22, '2024-01-29', 3, 'Baik', '-', 'BRG00020', 1, 2, 1, 27),
(23, '2024-01-29', 1, 'Baik', '-', 'BRG00021', 1, 2, 1, 27),
(24, '2024-01-29', 1, 'Baik', '-', 'BRG00022', 1, 3, 1, 27),
(25, '2024-01-29', 2, 'Baik', '-', 'BRG00023', 1, 2, 1, 27),
(26, '2024-01-29', 1, 'Kurang Lengkap', '-', 'BRG00024', 1, 9, 1, 27),
(27, '2024-01-29', 1, 'Baik', '-', 'BRG00025', 1, 9, 1, 27),
(28, '2024-01-29', 3, 'Baik', '-', 'BRG00026', 1, 3, 1, 27),
(29, '2024-01-29', 1, 'Baik', '-', 'BRG00027', 1, 3, 1, 27),
(30, '2024-01-29', 1, 'Baik', '-', 'BRG00028', 1, 3, 1, 27),
(31, '2024-01-29', 1, 'Baik', '-', 'BRG00029', 1, 3, 1, 27),
(32, '2024-01-29', 1, 'Baik', '-', 'BRG00030', 1, 3, 1, 27),
(33, '2024-01-29', 1, 'Baik', '-', 'BRG00031', 1, 3, 1, 27),
(34, '2024-01-29', 1, 'Rusak', '-', 'BRG00032', 1, 10, 1, 27),
(35, '2024-01-29', 2, 'Baik', '-', 'BRG00033', 1, 3, 1, 27),
(36, '2024-01-29', 1, 'Kurang Lengkap', 'Drum Kosong', 'BRG00034', 1, 12, 1, 27),
(37, '2024-01-29', 1, 'Perlu Perbaikan', 'Simpanan Daya Tidak Mencukupi', 'BRG00035', 1, 1, 1, 27),
(38, '2024-01-29', 1, 'Baik', '-', 'BRG00036', 1, 1, 1, 27),
(39, '2024-01-29', 2, 'Perlu Perbaikan', '3 Neon Baik 1 Mati', 'BRG00037', 1, 1, 1, 27),
(40, '2024-01-29', 1, 'Baik', '-', 'BRG00038', 1, 1, 1, 27),
(41, '2024-01-29', 1, 'Baik', '-', 'BRG00039', 1, 1, 1, 27),
(42, '2024-01-29', 1, 'Baik', 'tersimpan', 'BRG00040', 1, 12, 1, 27),
(43, '2024-01-29', 2, 'Perlu Perbaikan', '3 TL good 1 TL rusak', 'BRG00041', 1, 1, 1, 27),
(44, '2024-01-29', 1, 'Rusak', 'tersimpan', 'BRG00042', 1, 1, 1, 27),
(45, '2024-01-29', 1, 'Baik', 'tersimpan', 'BRG00043', 1, 1, 1, 27),
(46, '0000-00-00', 2, 'Rusak', 'tersimpan', 'BRG00044', 1, 1, 1, 27),
(47, '2024-01-29', 1, 'Baik', 'tersimpan', 'BRG00045', 1, 1, 1, 27),
(48, '2024-01-29', 2, 'Rusak', 'Tersimpan', 'BRG00046', 1, 1, 1, 27),
(49, '2024-01-29', 1, 'Baik', '-', 'BRG00047', 1, 1, 1, 27),
(50, '2024-01-29', 24, 'Baik', '-', 'BRG00048', 1, 1, 2, 27),
(51, '2024-01-29', 1, 'Baik', '-', 'BRG00049', 1, 1, 2, 27),
(52, '2024-01-29', 4, 'Rusak', 'Disposal', 'BRG00050', 1, 1, 2, 27),
(53, '2024-01-29', 1, 'Baik', '-', 'BRG00051', 1, 1, 2, 27),
(54, '2024-01-29', 1, 'Hilang', '-', 'BRG00052', 1, 1, 2, 27),
(55, '2024-01-29', 1, 'Rusak', '-', 'BRG00053', 1, 1, 2, 27),
(56, '2024-01-29', 1, 'Baik', '-', 'BRG00054', 1, 1, 2, 27),
(57, '2024-01-29', 1, 'Rusak', '-', 'BRG00055', 1, 1, 2, 27),
(58, '2024-01-29', 1, 'Baik', '-', 'BRG00056', 1, 1, 2, 27),
(59, '2024-01-29', 9, 'Rusak', 'Disposal', 'BRG00041', 1, 1, 2, 27),
(60, '2024-01-29', 5, 'Baik', 'Stock', 'BRG00057', 1, 3, 2, 27),
(61, '2024-01-29', 5, 'Baik', 'Stock', 'BRG00058', 1, 3, 2, 27),
(62, '2024-01-29', 2, 'Baik', 'Stock', 'BRG00059', 1, 1, 2, 27),
(63, '2024-01-29', 1, 'Kurang Lengkap', 'Sisa Setengah', 'BRG00060', 1, 2, 2, 27),
(64, '2024-01-29', 1, 'Kurang Lengkap', 'Stok Habis', 'BRG00061', 1, 4, 2, 27),
(65, '2024-01-29', 1, 'Baik', 'Stock', 'BRG00062', 1, 10, 2, 27),
(66, '2024-01-29', 2, 'Baik', 'Stock', 'BRG00063', 1, 1, 2, 27),
(67, '2024-01-29', 3, 'Baik', '-', 'BRG00064', 1, 1, 2, 27),
(68, '2024-01-29', 1, 'Baik', 'Stok Kurang lebih 1 meter', 'BRG00065', 1, 10, 2, 27),
(69, '2024-01-29', 1, 'Baik', 'Stock', 'BRG00066', 1, 3, 2, 27),
(70, '2024-01-29', 1, 'Baik', 'Stock', 'BRG00067', 1, 3, 2, 27),
(71, '2024-01-29', 2, 'Baik', 'Stock', 'BRG00068', 1, 1, 2, 27),
(72, '2024-01-29', 4, 'Baik', '', 'BRG00069', 1, 1, 2, 27),
(73, '2024-01-29', 1, 'Baik', '-', 'BRG00070', 1, 1, 2, 27),
(74, '2024-01-29', 1, 'Baik', '-', 'BRG00071', 1, 10, 2, 27),
(75, '2024-01-29', 1, 'Baik', '-', 'BRG00072', 1, 1, 2, 27),
(76, '2024-01-29', 1, 'Rusak', '-', 'BRG00073', 1, 1, 2, 27),
(77, '2024-01-29', 1, 'Rusak', '-', 'BRG00074', 1, 1, 2, 27),
(78, '2024-01-29', 1, 'Baik', '-', 'BRG00075', 1, 1, 2, 27),
(79, '2024-01-29', 1, 'Baik', '-', 'BRG00076', 1, 1, 2, 27),
(80, '2024-01-29', 1, 'Rusak', 'Disposal', 'BRG00077', 1, 1, 2, 27),
(81, '2024-01-29', 2, 'Baik', '-', 'BRG00078', 1, 1, 2, 27),
(82, '2024-01-29', 2, 'Baik', '-', 'BRG00079', 1, 3, 2, 27),
(83, '2024-01-29', 2, 'Kurang Lengkap', 'sisa masing-masing 3/4', 'BRG00080', 1, 8, 2, 27),
(84, '2024-01-29', 4, 'Baik', 'Stock', 'BRG00081', 1, 2, 2, 27),
(85, '2024-01-29', 1, 'Baik', '-', 'BRG00082', 1, 1, 2, 27),
(86, '2024-01-29', 1, 'Baik', '-', 'BRG00083', 1, 1, 2, 27),
(87, '2024-01-29', 1, 'Baik', '-', 'BRG00084', 1, 1, 2, 27),
(88, '2024-01-29', 4, 'Baik', '-', 'BRG00085', 1, 2, 2, 27),
(89, '2024-01-29', 9, 'Baik', '-', 'BRG00086', 1, 1, 2, 27),
(90, '2024-01-29', 1, 'Baik', '-', 'BRG00087', 1, 1, 2, 27),
(92, '2024-01-29', 1, 'Rusak', 'Not Good', 'BRG00088', 1, 1, 2, 27);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(200) NOT NULL,
  `id_emp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `id_emp`) VALUES
(11, 'admin', '$2y$10$IgW4FLMwe9euVk0Ne9.ks.8ZhYCvheo7j1at4NiMIW38uOXYUM8pi', 'Kepala Cabang', 12),
(12, 'admin2', '$2y$10$HGD9twPbqY2jRuhsR6NMA.qUNiqShFNa8AFS8hy2LjDvFqdvGGM3e', 'Direktur Operasional', 11),
(13, 'admin3', '$2y$10$Q3IQI9/N96Pkm12hhwZrRe152Y937dQmRcqeZZSshp0mpz2Mh7IjO', 'Purchasing', 19),
(14, 'elis', '$2y$10$D4rpUxPZMdYYV5EBPAbWleveaycPXW5m/bsLGyhUWTF34uSzL1BJ2', 'Kepala Finance', 14),
(15, 'hrd', '$2y$10$rfSEEc5RaRZ/YjmxEF9G8uDTXi8w04f8PnuI/3Br7pXPWD9PKOhN2', 'Direktur HRD', 10),
(21, 'sanjeev', '$2y$10$dqD5eyXMYFl5dmq.1s103OeZOPTBNN4gHGqbu/D5neofhrjWRKxBO', 'Direktur Utama', 8),
(27, 'alex', '$2y$10$AIPkK9rwsTtwIpWxWxQyl.B4q1KZkeHJuzk9htMLmXM3k7hgRuyzW', 'Purchasing', 19),
(28, 'robi', '$2y$10$pi39ljqjbeI7Xgu6up8uie2wOUT6Gv7dwqsQXgvI60DotWKCmSvQC', 'Crew Armada', 18),
(29, 'krisno', '$2y$10$wdmPEof2zbHxxFyJWXAZZOZOigLJucxD/Vy5oALS.0y5ZJkvzVNhC', 'Crew Armada', 16),
(30, 'niken', '$2y$10$97K4MbdoDy98yZbu5BbtIOkSn4iT.PuudgLeGDIGb/USt79lGL6K2', 'Staff Finance', 17),
(31, 'mabrur', '$2y$10$zxwFH.e4ooAM3CgI8Wzi8Ot0AIZhzcnKMHNPSIprWt.gbQiArYqki', 'Staff IT', 30),
(33, 'dirkeu', '$2y$10$ieRoa0fn5uVaLatoFYBeUuwI0H1l./YWLxnB.1WNvFbTZyPApFUl6', 'Direktur Keuangan', 9),
(34, 'gahral', '$2y$10$htRb4rT9Pd08BIcc9/JnpeMPtqmVxkXU2Agz4JkQX0xFMj29ZBCtG', 'Kepala Operasional', 13);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int(10) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `no_telp_vendor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `no_telp_vendor`) VALUES
(1, 'PT Karimun Marine Suplarindo', NULL),
(2, 'PT Evercode Internasional', NULL),
(3, 'PT Securindo Jaya Pratama', '077812431570');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `id_emp` (`id_emp`),
  ADD KEY `id_lantai` (`id_lantai`);

--
-- Indexes for table `akses_pintu`
--
ALTER TABLE `akses_pintu`
  ADD PRIMARY KEY (`id_akses`),
  ADD KEY `id_emp` (`id_emp`),
  ADD KEY `id_lantai` (`id_lantai`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_brg`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `id_transaksi` (`id_transaksi`),
  ADD UNIQUE KEY `id_transaksi_2` (`id_transaksi`),
  ADD KEY `id_vendor` (`id_vendor`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `id_req_brg` (`id_req_brg`);

--
-- Indexes for table `cart_of_account`
--
ALTER TABLE `cart_of_account`
  ADD PRIMARY KEY (`kode_coa`);

--
-- Indexes for table `ijazah`
--
ALTER TABLE `ijazah`
  ADD PRIMARY KEY (`id_ijazah`),
  ADD KEY `id_emp` (`id_emp`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `no_jurnal` (`no_jurnal`),
  ADD KEY `kode_coa` (`kode_coa`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_emp`);

--
-- Indexes for table `kategori_cuti`
--
ALTER TABLE `kategori_cuti`
  ADD PRIMARY KEY (`id_kategori_cuti`);

--
-- Indexes for table `kontrak_kerja`
--
ALTER TABLE `kontrak_kerja`
  ADD PRIMARY KEY (`id_kontrak`),
  ADD KEY `id_emp` (`id_emp`);

--
-- Indexes for table `lantai`
--
ALTER TABLE `lantai`
  ADD PRIMARY KEY (`id_lantai`);

--
-- Indexes for table `lokasi_barang`
--
ALTER TABLE `lokasi_barang`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `lokasi_room`
--
ALTER TABLE `lokasi_room`
  ADD PRIMARY KEY (`id_room`);

--
-- Indexes for table `manage_cuti`
--
ALTER TABLE `manage_cuti`
  ADD PRIMARY KEY (`id_manage_cuti`),
  ADD KEY `id_kategori_cuti` (`id_kategori_cuti`),
  ADD KEY `id_emp` (`id_emp`);

--
-- Indexes for table `no_jurnal`
--
ALTER TABLE `no_jurnal`
  ADD PRIMARY KEY (`no_jurnal`);

--
-- Indexes for table `po_barang`
--
ALTER TABLE `po_barang`
  ADD PRIMARY KEY (`id_po`),
  ADD KEY `id_req_brg` (`id_req_brg`),
  ADD KEY `id_vendor` (`id_vendor`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_invoice` (`id_invoice`);

--
-- Indexes for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD PRIMARY KEY (`id_qr`),
  ADD KEY `id_emp` (`id_emp`);

--
-- Indexes for table `req_barang`
--
ALTER TABLE `req_barang`
  ADD PRIMARY KEY (`id_req_brg`),
  ADD KEY `kode_brg` (`kode_brg`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_satuan` (`id_satuan`);

--
-- Indexes for table `req_cuti`
--
ALTER TABLE `req_cuti`
  ADD PRIMARY KEY (`id_req_cuti`),
  ADD KEY `id_emp` (`id_emp`),
  ADD KEY `id_kategori_cuti` (`id_kategori_cuti`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `storage_barang`
--
ALTER TABLE `storage_barang`
  ADD PRIMARY KEY (`id_storage`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kode_brg` (`kode_brg`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_emp` (`id_emp`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `akses_pintu`
--
ALTER TABLE `akses_pintu`
  MODIFY `id_akses` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ijazah`
--
ALTER TABLE `ijazah`
  MODIFY `id_ijazah` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_jurnal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_emp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `kategori_cuti`
--
ALTER TABLE `kategori_cuti`
  MODIFY `id_kategori_cuti` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kontrak_kerja`
--
ALTER TABLE `kontrak_kerja`
  MODIFY `id_kontrak` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `lantai`
--
ALTER TABLE `lantai`
  MODIFY `id_lantai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lokasi_barang`
--
ALTER TABLE `lokasi_barang`
  MODIFY `id_lokasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lokasi_room`
--
ALTER TABLE `lokasi_room`
  MODIFY `id_room` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `manage_cuti`
--
ALTER TABLE `manage_cuti`
  MODIFY `id_manage_cuti` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `po_barang`
--
ALTER TABLE `po_barang`
  MODIFY `id_po` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `qrcode`
--
ALTER TABLE `qrcode`
  MODIFY `id_qr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `req_barang`
--
ALTER TABLE `req_barang`
  MODIFY `id_req_brg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `req_cuti`
--
ALTER TABLE `req_cuti`
  MODIFY `id_req_cuti` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `storage_barang`
--
ALTER TABLE `storage_barang`
  MODIFY `id_storage` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id_vendor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`id_emp`) REFERENCES `karyawan` (`id_emp`),
  ADD CONSTRAINT `absen_ibfk_2` FOREIGN KEY (`id_lantai`) REFERENCES `lantai` (`id_lantai`);

--
-- Constraints for table `akses_pintu`
--
ALTER TABLE `akses_pintu`
  ADD CONSTRAINT `akses_pintu_ibfk_1` FOREIGN KEY (`id_emp`) REFERENCES `karyawan` (`id_emp`),
  ADD CONSTRAINT `akses_pintu_ibfk_2` FOREIGN KEY (`id_lantai`) REFERENCES `lantai` (`id_lantai`);

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_vendor`) REFERENCES `vendor` (`id_vendor`),
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`),
  ADD CONSTRAINT `barang_masuk_ibfk_4` FOREIGN KEY (`id_req_brg`) REFERENCES `req_barang` (`id_req_brg`);

--
-- Constraints for table `ijazah`
--
ALTER TABLE `ijazah`
  ADD CONSTRAINT `ijazah_ibfk_1` FOREIGN KEY (`id_emp`) REFERENCES `karyawan` (`id_emp`);

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`no_jurnal`) REFERENCES `no_jurnal` (`no_jurnal`),
  ADD CONSTRAINT `jurnal_ibfk_2` FOREIGN KEY (`kode_coa`) REFERENCES `cart_of_account` (`kode_coa`);

--
-- Constraints for table `kontrak_kerja`
--
ALTER TABLE `kontrak_kerja`
  ADD CONSTRAINT `kontrak_kerja_ibfk_1` FOREIGN KEY (`id_emp`) REFERENCES `karyawan` (`id_emp`);

--
-- Constraints for table `manage_cuti`
--
ALTER TABLE `manage_cuti`
  ADD CONSTRAINT `manage_cuti_ibfk_1` FOREIGN KEY (`id_kategori_cuti`) REFERENCES `kategori_cuti` (`id_kategori_cuti`),
  ADD CONSTRAINT `manage_cuti_ibfk_2` FOREIGN KEY (`id_emp`) REFERENCES `karyawan` (`id_emp`);

--
-- Constraints for table `po_barang`
--
ALTER TABLE `po_barang`
  ADD CONSTRAINT `po_barang_ibfk_1` FOREIGN KEY (`id_req_brg`) REFERENCES `req_barang` (`id_req_brg`),
  ADD CONSTRAINT `po_barang_ibfk_2` FOREIGN KEY (`id_vendor`) REFERENCES `vendor` (`id_vendor`),
  ADD CONSTRAINT `po_barang_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `po_barang_ibfk_4` FOREIGN KEY (`id_invoice`) REFERENCES `invoice` (`id_invoice`);

--
-- Constraints for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD CONSTRAINT `qrcode_ibfk_1` FOREIGN KEY (`id_emp`) REFERENCES `karyawan` (`id_emp`);

--
-- Constraints for table `req_barang`
--
ALTER TABLE `req_barang`
  ADD CONSTRAINT `req_barang_ibfk_1` FOREIGN KEY (`kode_brg`) REFERENCES `barang` (`kode_brg`),
  ADD CONSTRAINT `req_barang_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi_barang` (`id_lokasi`),
  ADD CONSTRAINT `req_barang_ibfk_3` FOREIGN KEY (`id_room`) REFERENCES `lokasi_room` (`id_room`),
  ADD CONSTRAINT `req_barang_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `req_barang_ibfk_5` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`);

--
-- Constraints for table `req_cuti`
--
ALTER TABLE `req_cuti`
  ADD CONSTRAINT `req_cuti_ibfk_1` FOREIGN KEY (`id_emp`) REFERENCES `karyawan` (`id_emp`),
  ADD CONSTRAINT `req_cuti_ibfk_2` FOREIGN KEY (`id_kategori_cuti`) REFERENCES `kategori_cuti` (`id_kategori_cuti`);

--
-- Constraints for table `storage_barang`
--
ALTER TABLE `storage_barang`
  ADD CONSTRAINT `storage_barang_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi_barang` (`id_lokasi`),
  ADD CONSTRAINT `storage_barang_ibfk_2` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`),
  ADD CONSTRAINT `storage_barang_ibfk_4` FOREIGN KEY (`id_room`) REFERENCES `lokasi_room` (`id_room`),
  ADD CONSTRAINT `storage_barang_ibfk_5` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `storage_barang_ibfk_6` FOREIGN KEY (`kode_brg`) REFERENCES `barang` (`kode_brg`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_emp`) REFERENCES `karyawan` (`id_emp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
