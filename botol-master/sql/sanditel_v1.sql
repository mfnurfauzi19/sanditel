-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Nov 2024 pada 13.26
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
  `status` tinyint(1) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `assets`
--

INSERT INTO `assets` (`id`, `nama_asset`, `merk_kode`, `qty`, `ok`, `status`, `barcode`, `kategori`, `updated_at`) VALUES
(122, 'Komputer Lenovo ThinkCentre', 'LENOVO_KOMPUTER', 1, '1', 0, 'LENOVO_KOMPUTER_1243190574', 'Komputer', '2024-11-13 06:08:06'),
(123, 'Power Supply Corsair', 'CORSAIR_PS', 1, '1', 1, 'CORSAIR_PS_4810370649', 'Power Supply', '2024-11-12 22:15:41'),
(124, 'Walkie Talkie Motorola', 'MOTO_WT', 1, '1', 1, 'MOTO_WT_6886103523', 'Walkie Talkie', '2024-11-13 04:21:09'),
(125, 'Switch Management Cisco', 'CISCO_SW', 1, '1', 1, 'CISCO_SW_9983133039', 'Switch Management', '2024-11-13 04:37:51'),
(126, 'Router L3 MikroTik', 'MIKROTIK_RL3', 1, '1', 0, 'MIKROTIK_RL3_6543808820', 'Router L3', '2024-11-13 10:36:02'),
(127, 'Power Supply EVGA', 'EVGA_PS', 1, '1', 1, '', 'Power Supply', '2024-11-13 03:55:09'),
(128, 'Server HP ProLiant', 'HP_SERVER', 1, '1', 0, '', 'Server', '2024-11-13 03:55:09'),
(129, 'Rack APC', 'APC_RACK', 1, '1', 1, '', 'Rack', '2024-11-13 03:55:09'),
(130, 'Crimping Tool', 'TOOL_CRIMP', 1, '1', 1, '', 'Tools Networking', '2024-11-13 03:55:09'),
(131, 'Antena Yagi', 'YAGI_ANT', 1, '1', 0, '', 'Antena', '2024-11-13 03:55:09'),
(132, 'Laptop HP Pavilion', 'HP_LAPTOP', 1, '1', 1, '', 'Laptop', '2024-11-13 03:55:09'),
(133, 'Komputer ASUS VivoPC', 'ASUS_KOMPUTER', 1, '1', 0, '', 'Komputer', '2024-11-13 03:55:09'),
(134, 'Power Supply Thermaltake', 'THERMAL_PS', 1, '1', 1, '', 'Power Supply', '2024-11-13 03:55:09'),
(135, 'Walkie Talkie Baofeng', 'BAOFENG_WT', 1, '1', 1, '', 'Walkie Talkie', '2024-11-13 03:55:09'),
(136, 'Switch Management Aruba', 'ARUBA_SW', 1, '1', 0, '', 'Switch Management', '2024-11-13 03:55:09'),
(137, 'Router L3 Ubiquiti', 'UBI_RL3', 1, '1', 1, '', 'Router L3', '2024-11-13 03:55:09'),
(138, 'Power Supply Antec', 'ANTEC_PS', 1, '1', 0, '', 'Power Supply', '2024-11-13 03:55:09'),
(139, 'Server Dell PowerEdge', 'DELL_SERVER', 1, '1', 1, '', 'Server', '2024-11-13 03:55:09'),
(140, 'Rack Rittal', 'RITTAL_RACK', 1, '1', 0, '', 'Rack', '2024-11-13 03:55:09'),
(141, 'Laptop Lenovo ThinkPad', 'LENOVO', 1, NULL, 1, NULL, 'Laptop', '2024-11-13 03:55:09'),
(142, 'Acer Nitro 5', 'ACER', 1, NULL, 1, NULL, 'Laptop', '2024-11-13 04:01:23'),
(143, 'Laptop HP Pavilion', 'HP', 1, NULL, 1, NULL, 'Laptop', '2024-11-13 09:51:24');

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
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok`, `satuan_id`, `jenis_id`, `harga`) VALUES
('B000003', 'lakban', 707, 1, 1, NULL),
('B000004', 'Buku', 290, 1, 1, NULL),
('B000005', 'Kabel', 440, 3, 1, 500),
('B000006', 'konektor', 50, 1, 1, NULL),
('B000007', 'Jam', 0, 1, 1, NULL);

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
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `user_id`, `id_customer`, `nama_penerima`, `alamat`, `tanggal_keluar`) VALUES
('T-BK-24111300001', 1, 1, 'Kevin', 'Jaringan', '2024-11-13'),
('T-BK-24111300002', 1, 1, 'Kevin', 'Jaringan', '2024-11-13'),
('T-BK-24111300003', 1, 1, 'Kevin', 'Jaringan', '2024-11-13'),
('T-BK-24111300004', 1, 1, 'Kevin', 'Jaringan', '2024-11-13'),
('T-BK-24111300005', 1, 2, 'Advin', 'CCTV', '2024-11-13'),
('T-BK-24111300006', 1, 2, 'Advin', 'CCTV', '2024-11-13'),
('T-BK-24111300007', 1, 2, 'Advin', 'CCTV', '2024-11-13'),
('T-BK-24111300008', 1, 1, 'Kevin', 'Jaringan', '2024-11-13'),
('T-BK-24111300009', 1, 2, 'Advin', 'CCTV', '2024-11-13');

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
-- Dumping data untuk tabel `barang_keluar_dtl`
--

INSERT INTO `barang_keluar_dtl` (`id_detail`, `id_barang_keluar`, `barang_id`, `harga`, `jumlah_keluar`, `total_nominal_dtl`) VALUES
(1, 'T-BK-24111300001', 'B000004', 2500, 20, 50000),
(2, 'T-BK-24111300002', 'B000004', 0, 20, 0),
(3, 'T-BK-24111300003', 'B000003', 0, 1, 0),
(4, 'T-BK-24111300004', 'B000003', 0, 2, 0),
(5, 'T-BK-24111300005', 'B000003', 0, 200, 0),
(6, 'T-BK-24111300006', 'B000004', 0, 60, 0),
(7, 'T-BK-24111300007', 'B000003', 0, 20, 0),
(8, 'T-BK-24111300007', 'B000005', 0, 50, 0),
(9, 'T-BK-24111300008', 'B000004', 0, 90, 0),
(10, 'T-BK-24111300008', 'B000005', 0, 60, 0),
(11, 'T-BK-24111300009', 'B000004', 0, 20, 0),
(12, 'T-BK-24111300009', 'B000003', 0, 90, 0);

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
('T-BM-24100700002', 6, 1, 'B000003', 1000, '2024-10-07', NULL),
('T-BM-24111300001', 6, 1, 'B000003', 20, '2024-11-14', NULL),
('T-BM-24111300002', 6, 1, 'B000004', 500, '2024-11-14', NULL),
('T-BM-24111300003', 5, 1, 'B000005', 500, '2024-11-13', NULL),
('T-BM-24111300004', 5, 5, 'B000006', 50, '2024-11-13', NULL),
('T-BM-24111300005', 5, 1, 'B000005', 50, '0000-00-00', NULL);

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

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id`, `fullname`, `address`, `phone`, `total_utang`, `last_utang_paid`, `created_at`) VALUES
(1, 'Kevin', 'Jaringan', '0893482940923', 49990, '2024-11-13 15:47:33', '2024-11-13 14:44:08'),
(2, 'Advin', 'CCTV', '082912094', 0, '2024-11-13 16:14:50', '2024-11-13 15:32:06');

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
  `assets_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `jumlah_pinjam` varchar(255) NOT NULL,
  `sisa_stok` int(11) DEFAULT NULL,
  `status_pengembalian` tinyint(1) DEFAULT '0',
  `peminjam` varchar(255) NOT NULL,
  `departemen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `assets_id`, `user_id`, `tanggal_pinjam`, `tanggal_kembali`, `jumlah_pinjam`, `sisa_stok`, `status_pengembalian`, `peminjam`, `departemen`) VALUES
(3, 141, 0, '2024-11-27', '2024-12-06', '1', NULL, 0, 'Vinz', 'BKD'),
(5, 126, 0, '2024-11-16', '2024-11-23', '1', NULL, 0, 'Ahmad', 'BIRO ORGANISASI');

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
(28, '2024-10-11', '1', '11', '11', 11, '111', 2, 10);

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
(5, 'PT BIT', '085314522528', 'Jl. Sukarno Hatta, Bandung'),
(6, 'PT Delca', '082121678861', 'Jl. Jendral Sudirman, Garut');

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
(4, 'user', 'user', 'puta@gmail.com', '012839817248912', 'gudang', '$2y$10$iPmXwSu0G6GUwqMfEOiYz.53Vo8ProVYukiywRRMdASxXn/jRiG9C', 1730433727, 'user.png', 1),
(5, 'Fahmi', 'gudang1', 'Fahmi@fahmi.com', '0989275852', 'gudang', '$2y$10$qlH5CtT/zMEVaci9QWlYAevhkShYjJwqqelfq3UtpnyZMxyRrzpoy', 1731498257, 'user.png', 1);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_peminjaman_assets` (`assets_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT untuk tabel `barang_keluar_dtl`
--
ALTER TABLE `barang_keluar_dtl`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `FK_peminjaman_assets` FOREIGN KEY (`assets_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
