-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Nov 2024 pada 13.23
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `botol`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `nama_asset` varchar(255) NOT NULL,
  `merk_kode` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `ok` varchar(50) DEFAULT NULL,
  `rusak` varchar(50) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `assets`
--

INSERT INTO `assets` (`id`, `nama_asset`, `merk_kode`, `qty`, `ok`, `rusak`, `barcode`) VALUES
(1, 'Asset', 'Merk', 20, '10', '10', 'Merk_1867127387'),
(2, 'Asset C', 'Merk C', 0, '0', '0', 'Merk C_2585711621'),
(3, 'Asset D', 'Merk D', 15, '7', '8', 'Merk D_2985140178'),
(4, 'Asset G', 'Merk G', 5, '2', '3', 'Merk G_3945040357'),
(5, 'Asset H', 'Merk H', 16, '6', '6', 'Merk H_2731774431'),
(6, 'Asset I', 'Merk I', 0, '0', '0', NULL),
(7, 'Asset J', 'Merk J', 18, '9', '9', 'Merk J_4166935097'),
(8, 'Asset K', 'Merk K', 29, '14', '15', 'Merk K_8859618695'),
(9, 'Asset L', 'Merk L', 0, '0', '0', NULL),
(10, 'Asset M', 'Merk M', 16, '8', '8', NULL),
(11, 'Asset N', 'Merk N', 28, '14', '14', NULL),
(12, 'Asset O', 'Merk O', 4, '2', '2', NULL),
(13, 'Asset P', 'Merk P', 19, '9', '10', NULL),
(14, 'Asset Q', 'Merk Q', 0, '0', '0', NULL),
(15, 'Asset R', 'Merk R', 32, '16', '16', NULL),
(16, 'Asset S', 'Merk S', 9, '4', '5', NULL),
(17, 'Asset T', 'Merk T', 0, '0', '0', NULL),
(18, 'Asset V', 'Merk V', 7, '3', '4', NULL),
(19, 'Asset W', 'Merk W', 0, '0', '0', NULL),
(20, 'Asset X', 'Merk X', 13, '6', '7', NULL),
(21, 'Asset Y', 'Merk Y', 11, '5', '6', NULL),
(22, 'Asset Z', 'Merk Z', 0, '0', '0', NULL),
(23, 'Asset AA', 'Merk AA', 2, '1', '1', NULL),
(24, 'Asset AB', 'Merk AB', 0, '0', '0', NULL),
(25, 'Asset AC', 'Merk AC', 24, '12', '12', NULL),
(26, 'Asset AD', 'Merk AD', 1, '0', '1', NULL),
(27, 'Asset AE', 'Merk AE', 17, '8', '9', NULL),
(28, 'Asset AF', 'Merk AF', 0, '0', '0', NULL),
(29, 'Asset AG', 'Merk AG', 30, '15', '15', NULL),
(30, 'Asset AH', 'Merk AH', 15, '7', '8', NULL),
(31, 'Asset AI', 'Merk AI', 0, '0', '0', NULL),
(32, 'Asset AJ', 'Merk AJ', 35, '17', '18', NULL),
(33, 'Asset AK', 'Merk AK', 5, '2', '3', NULL),
(34, 'Asset AL', 'Merk AL', 12, '6', '6', NULL),
(35, 'Asset AM', 'Merk AM', 0, '0', '0', NULL),
(36, 'Asset AN', 'Merk AN', 18, '9', '9', NULL),
(37, 'Asset AO', 'Merk AO', 28, '14', '14', NULL),
(38, 'Asset AP', 'Merk AP', 0, '0', '0', NULL),
(39, 'Asset AQ', 'Merk AQ', 11, '8', '8', NULL),
(40, 'Asset AR', 'Merk AR', 28, '14', '14', NULL),
(41, 'Asset AS', 'Merk AS', 4, '2', '2', NULL),
(42, 'Asset AT', 'Merk AT', 19, '9', '10', NULL),
(43, 'Asset AU', 'Merk AU', 8, '4', '4', NULL),
(44, 'Asset AV', 'Merk AV', 32, '16', '16', NULL),
(45, 'Asset AW', 'Merk AW', 9, '4', '5', NULL),
(46, 'Asset AX', 'Merk AX', 23, '11', '12', NULL),
(47, 'Asset AY', 'Merk AY', 3, '1', '2', NULL),
(48, 'Asset AZ', 'Merk AZ', 0, '0', '0', NULL),
(49, 'HO', 'advan', 10, '2', '8', NULL),
(50, 'G', 'Mug', 2, '1', '1', NULL),
(51, 'GUM', 'buble', 10, '5', '5', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(7) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stok` double NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok`, `satuan_id`, `jenis_id`, `harga`) VALUES
('B000003', 'lakban', 1000, 1, 1, 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_penerima` char(50) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `total_nominal` int(11) NOT NULL,
  `diskon` double(11,0) DEFAULT '0',
  `grand_total` int(11) NOT NULL,
  `payment` enum('kontrabon','transfer','cash') NOT NULL,
  `paid_amount` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar_copy1`
--

CREATE TABLE `barang_keluar_copy1` (
  `id_barang_keluar` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `nama_penerima` char(50) NOT NULL,
  `alamat` text NOT NULL,
  `jumlah_keluar` double NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `total_nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Trigger `barang_keluar_copy1`
--
DELIMITER $$
CREATE TRIGGER `update_stok_keluar_copy1` BEFORE INSERT ON `barang_keluar_copy1` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` - NEW.jumlah_keluar WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar_dtl`
--

CREATE TABLE `barang_keluar_dtl` (
  `id_detail` int(11) NOT NULL,
  `id_barang_keluar` char(16) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah_keluar` double NOT NULL,
  `total_nominal_dtl` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Trigger `barang_keluar_dtl`
--
DELIMITER $$
CREATE TRIGGER `delete_stok_keluar` AFTER DELETE ON `barang_keluar_dtl` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + OLD.jumlah_keluar WHERE `barang`.`id_barang` = OLD.barang_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_keluar` BEFORE INSERT ON `barang_keluar_dtl` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` - NEW.jumlah_keluar WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` char(16) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `jumlah_masuk` double NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `bukti_pengajuan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `supplier_id`, `user_id`, `barang_id`, `jumlah_masuk`, `tanggal_masuk`, `bukti_pengajuan`) VALUES
('T-BM-24100700002', 6, 1, 'B000003', 1000, '2024-10-07', NULL);

--
-- Trigger `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_masuk` BEFORE INSERT ON `barang_masuk` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + NEW.jumlah_masuk WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `total_utang` bigint(20) NOT NULL,
  `last_utang_paid` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Alat'),
(2, 'Makanan'),
(3, 'Minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `assets_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `jumlah_pinjam` varchar(255) NOT NULL,
  `sisa_stok` int(11) DEFAULT NULL,
  `status_pengembalian` tinyint(1) DEFAULT '0',
  `peminjam` varchar(255) NOT NULL,
  `departemen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_barang`
--

CREATE TABLE `pengajuan_barang` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `no_pengajuan` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merk_kode` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `approved` tinyint(1) DEFAULT '0',
  `approved_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengajuan_barang`
--

INSERT INTO `pengajuan_barang` (`id`, `tanggal`, `no_pengajuan`, `nama_barang`, `merk_kode`, `qty`, `jenis`, `approved`, `approved_qty`) VALUES
(14, '2024-10-12', '5555', 'Baut', 'KUAT', 10, 'box', 2, 9),
(15, '2024-10-11', '6666', 'AP', 'UNIFI', 55, '66', 0, NULL),
(16, '2024-10-11', '123123', 'Laptop', 'HP', 11, '11', 2, 10),
(18, '2024-10-11', '10', 'HP', 'ADVAN', 1, '14', 0, NULL),
(27, '2024-10-09', '1234', 'buku baca', 'sidudu', 11, 'pcs', 2, 12),
(28, '2024-10-11', '1', '11', '11', 11, '111', 2, 10),
(30, '2024-10-01', 'PGN001', 'Barang A', 'MA123', 10, 'Jenis A', 2, 1),
(31, '2024-10-02', 'PGN002', 'Barang B', 'MB234', 20, 'Jenis B', 0, NULL),
(32, '2024-10-03', 'PGN003', 'Barang C', 'MC345', 30, 'Jenis C', 2, 29),
(33, '2024-10-04', 'PGN004', 'Barang D', 'MD456', 15, 'Jenis D', 0, NULL),
(34, '2024-10-05', 'PGN005', 'Barang E', 'ME567', 25, 'Jenis E', 2, 1),
(35, '2024-10-06', 'PGN006', 'Barang F', 'MF678', 5, 'Jenis F', 0, NULL),
(36, '2024-10-07', 'PGN007', 'Barang G', 'MG789', 50, 'Jenis G', 1, NULL),
(37, '2024-10-08', 'PGN008', 'Barang H', 'MH890', 12, 'Jenis H', 1, NULL),
(38, '2024-10-09', 'PGN009', 'Barang I', 'MI901', 8, 'Jenis I', 1, NULL),
(39, '2024-10-10', 'PGN010', 'Barang J', 'MJ012', 22, 'Jenis J', 1, NULL),
(40, '2024-10-11', 'PGN011', 'Barang K', 'MK123', 18, 'Jenis K', 1, NULL),
(41, '2024-10-12', 'PGN012', 'Barang L', 'ML234', 9, 'Jenis L', 1, NULL),
(42, '2024-10-13', 'PGN013', 'Barang M', 'MM345', 14, 'Jenis M', 1, NULL),
(43, '2024-10-14', 'PGN014', 'Barang N', 'MN456', 19, 'Jenis N', 1, NULL),
(44, '2024-10-15', 'PGN015', 'Barang O', 'MO567', 7, 'Jenis O', 2, 4),
(45, '2024-10-16', 'PGN016', 'Barang P', 'MP678', 11, 'Jenis P', 1, NULL),
(46, '2024-10-17', 'PGN017', 'Barang Q', 'MQ789', 17, 'Jenis Q', 1, NULL),
(47, '2024-10-18', 'PGN018', 'Barang R', 'MR890', 13, 'Jenis R', 1, NULL),
(48, '2024-10-19', 'PGN019', 'Barang S', 'MS901', 16, 'Jenis S', 1, NULL),
(49, '2024-10-20', 'PGN020', 'Barang T', 'MT012', 21, 'Jenis T', 1, NULL),
(50, '2024-10-21', 'PGN021', 'Barang U', 'MU123', 23, 'Jenis U', 1, NULL),
(51, '2024-10-22', 'PGN022', 'Barang V', 'MV234', 24, 'Jenis V', 1, NULL),
(52, '2024-10-23', 'PGN023', 'Barang W', 'MW345', 26, 'Jenis W', 1, NULL),
(53, '2024-10-24', 'PGN024', 'Barang X', 'MX456', 27, 'Jenis X', 1, NULL),
(54, '2024-10-25', 'PGN025', 'Barang Y', 'MY567', 28, 'Jenis Y', 1, NULL),
(55, '2024-10-26', 'PGN026', 'Barang Z', 'MZ678', 29, 'Jenis Z', 1, NULL),
(56, '2024-10-27', 'PGN027', 'Barang AA', 'MA789', 30, 'Jenis AA', 1, NULL),
(57, '2024-10-28', 'PGN028', 'Barang AB', 'MB890', 31, 'Jenis AB', 1, NULL),
(58, '2024-10-29', 'PGN029', 'Barang AC', 'MC901', 32, 'Jenis AC', 1, NULL),
(59, '2024-10-30', 'PGN030', 'Barang AD', 'MD012', 33, 'Jenis AD', 1, NULL),
(60, '2024-10-31', 'PGN031', 'Barang AE', 'ME123', 34, 'Jenis AE', 1, NULL),
(61, '2024-11-01', 'PGN032', 'Barang AF', 'MF234', 35, 'Jenis AF', 1, NULL),
(62, '2024-11-02', 'PGN033', 'Barang AG', 'MG345', 36, 'Jenis AG', 1, NULL),
(63, '2024-11-03', 'PGN034', 'Barang AH', 'MH456', 37, 'Jenis AH', 1, NULL),
(64, '2024-11-04', 'PGN035', 'Barang AI', 'MI567', 38, 'Jenis AI', 1, NULL),
(65, '2024-11-05', 'PGN036', 'Barang AJ', 'MJ678', 39, 'Jenis AJ', 1, NULL),
(66, '2024-11-06', 'PGN037', 'Barang AK', 'MK789', 40, 'Jenis AK', 1, NULL),
(67, '2024-11-07', 'PGN038', 'Barang AL', 'ML890', 41, 'Jenis AL', 1, NULL),
(68, '2024-11-08', 'PGN039', 'Barang AM', 'MM901', 42, 'Jenis AM', 1, NULL),
(69, '2024-11-09', 'PGN040', 'Barang AN', 'MN012', 43, 'Jenis AN', 1, NULL),
(70, '2024-11-10', 'PGN041', 'Barang AO', 'MO123', 44, 'Jenis AO', 1, NULL),
(71, '2024-11-11', 'PGN042', 'Barang AP', 'MP234', 45, 'Jenis AP', 1, NULL),
(72, '2024-11-12', 'PGN043', 'Barang AQ', 'MQ345', 46, 'Jenis AQ', 1, NULL),
(73, '2024-11-13', 'PGN044', 'Barang AR', 'MR456', 47, 'Jenis AR', 1, NULL),
(74, '2024-11-14', 'PGN045', 'Barang AS', 'MS567', 48, 'Jenis AS', 1, NULL),
(75, '2024-11-15', 'PGN046', 'Barang AT', 'MT678', 49, 'Jenis AT', 1, NULL),
(76, '2024-11-16', 'PGN047', 'Barang AU', 'MU789', 50, 'Jenis AU', 1, NULL),
(77, '2024-11-17', 'PGN048', 'Barang AV', 'MV890', 51, 'Jenis AV', 1, NULL),
(78, '2024-11-18', 'PGN049', 'Barang AW', 'MW901', 52, 'Jenis AW', 1, NULL),
(79, '2024-11-19', 'PGN050', 'Barang AX', 'MX012', 53, 'Jenis AX', 1, NULL),
(80, '2024-10-11', '19082', 'Helm', 'bogo', 12, '1', 2, 10),
(81, '2024-10-19', '1111', 'Dekstop CHarger', 'ICOM', 10, 'pcs', 2, 5),
(82, '2024-10-17', '1234', 'HP', 'ADvan', 10, 'pcs', 1, NULL),
(83, '2024-10-17', '111', 'Jam', 'ROLEX', 10, 'pcs', 1, NULL),
(86, '2024-10-19', '0', 'a', 'a', 2, 'a', 2, 1),
(87, '2024-10-16', '12312', '2', 'aa', 12, 'pcs', 2, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Pcs'),
(2, 'Botol'),
(3, 'Bungkus'),
(4, 'Porsi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telp`, `alamat`) VALUES
(5, 'PT Adi Makmur Santosa', '085314522528', 'Jl. Sukarno Hatta, Bandung'),
(6, 'PT Multi Bintang', '082121678861', 'Jl. Jendral Sudirman, Garut');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `role` enum('gudang','admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `foto` text NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `no_telp`, `role`, `password`, `created_at`, `foto`, `is_active`) VALUES
(1, 'Adminisitrator', 'admin', 'admin@admin.com', '025123456789', 'admin', '$2y$10$Mh4022E8uLMx3KaXme7ofuiIZvGqAqmTsuu/NsjD8cFgRlpZR3FBa', 1568689561, 'd5f22535b639d55be7d099a7315e1f7f.png', 1),
(3, 'user1', 'user1', 'user1@gmail.com', '123123', 'gudang', '$2y$10$0xXxFq1RGBjni37F5vy0IOyvZytCLVkZhOX2i7.5t8KAzX/R7noXu', 1728533676, 'user.png', 1),
(4, 'user', 'user', 'puta@gmail.com', '012839817248912', 'gudang', '$2y$10$iPmXwSu0G6GUwqMfEOiYz.53Vo8ProVYukiywRRMdASxXn/jRiG9C', 1730433727, 'user.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`) USING BTREE,
  ADD KEY `satuan_id` (`satuan_id`) USING BTREE,
  ADD KEY `kategori_id` (`jenis_id`) USING BTREE;

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`) USING BTREE,
  ADD KEY `id_user` (`user_id`) USING BTREE,
  ADD KEY `id_customer` (`id_customer`);

--
-- Indeks untuk tabel `barang_keluar_copy1`
--
ALTER TABLE `barang_keluar_copy1`
  ADD PRIMARY KEY (`id_barang_keluar`) USING BTREE,
  ADD KEY `id_user` (`user_id`) USING BTREE,
  ADD KEY `barang_id` (`barang_id`) USING BTREE;

--
-- Indeks untuk tabel `barang_keluar_dtl`
--
ALTER TABLE `barang_keluar_dtl`
  ADD PRIMARY KEY (`id_detail`) USING BTREE,
  ADD KEY `barang_keluar_dtl_ibfk_1` (`id_barang_keluar`) USING BTREE;

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`) USING BTREE,
  ADD KEY `id_user` (`user_id`) USING BTREE,
  ADD KEY `supplier_id` (`supplier_id`) USING BTREE,
  ADD KEY `barang_id` (`barang_id`) USING BTREE;

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`) USING BTREE;

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengajuan_barang`
--
ALTER TABLE `pengajuan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`) USING BTREE;

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `barang_keluar_dtl`
--
ALTER TABLE `barang_keluar_dtl`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_barang`
--
ALTER TABLE `pengajuan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_keluar_copy1`
--
ALTER TABLE `barang_keluar_copy1`
  ADD CONSTRAINT `barang_keluar_copy1_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_copy1_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_keluar_dtl`
--
ALTER TABLE `barang_keluar_dtl`
  ADD CONSTRAINT `barang_keluar_dtl_ibfk_1` FOREIGN KEY (`id_barang_keluar`) REFERENCES `barang_keluar` (`id_barang_keluar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
