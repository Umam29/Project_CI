-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Bulan Mei 2020 pada 08.26
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rebcons_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL DEFAULT 'default.jpg',
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbluser`
--

INSERT INTO `tbluser` (`id`, `name`, `user_name`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Tukang Test', 'testing', 'default.jpg', '$2y$10$Yoia4QMRwvPFeUxCqBJGLu8GO7ER56YNkzu2/5cSIlW5CT9S7bmja', 2, 1, 1578716827),
(3, 'Umam', 'admin', 'IMG_0101_B3_E7.jpg', '$2y$10$qKfu95Fh4M3wiEdO8uc2neiIm9jf1OElA0G3G2hIOfgg9RBLFb3TW', 1, 1, 1578743224),
(4, 'victoooor', 'victor', 'default.jpg', '$2y$10$4eViygFobwEa0OOe/YpVv.9RNh4Lmpfjj0lKWnLAyffn/fZX4Y15O', 2, 1, 1579696954),
(6, 'Qomarul', 'qomar', 'default.jpg', '$2y$10$bXlTs4RDx8RVTqKEwz08EuNyMre/How204Q8gRlNUL1FpdIqxDPgG', 5, 0, 1587203486),
(7, 'Umam', 'umam', 'default.jpg', '$2y$10$FEqG4yCR5MCg55MsweAGWOA7a7lzOKsd/JF7QtCFYYeyXEak/7fmW', 2, 1, 1589713869),
(8, 'kasir', 'kasir', 'default.jpg', '$2y$10$93GW1TYqOq/w3mAkWl6SOeEJJFKnSkpG9AyekntlGj6kLCyhSrW9C', 5, 1, 1589720541);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbluseraccessmenu`
--

CREATE TABLE `tbluseraccessmenu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbluseraccessmenu`
--

INSERT INTO `tbluseraccessmenu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(7, 1, 3),
(8, 1, 11),
(9, 1, 13),
(10, 2, 11),
(11, 2, 13),
(12, 1, 15),
(13, 5, 2),
(14, 1, 16),
(15, 1, 17),
(16, 6, 2),
(17, 1, 18),
(18, 2, 1),
(19, 2, 15),
(20, 2, 16),
(21, 2, 17),
(22, 5, 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblusermenu`
--

CREATE TABLE `tblusermenu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblusermenu`
--

INSERT INTO `tblusermenu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Profile'),
(3, 'Menu'),
(11, 'Transaction'),
(13, 'Master'),
(15, 'User'),
(16, 'Cashier'),
(17, 'Product');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbluserrole`
--

CREATE TABLE `tbluserrole` (
  `id` int(11) NOT NULL,
  `role_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbluserrole`
--

INSERT INTO `tbluserrole` (`id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Supervisor'),
(5, 'Cashier');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblusersubmenu`
--

CREATE TABLE `tblusersubmenu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblusersubmenu`
--

INSERT INTO `tblusersubmenu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'profile', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'profile/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(6, 1, 'Role', 'admin/role', 'fas fa-user-tie', 1),
(7, 11, 'Purchasing', 'transaction', 'fas fa-shopping-cart', 0),
(9, 2, 'Change Password', 'profile/changepassword', 'fas fa-key', 1),
(10, 13, 'Stuff Category', 'master', 'fas fa-th-list', 1),
(11, 13, 'Unit', 'master/unit', 'fas fa-balance-scale', 1),
(12, 11, 'Storage Stuff', 'transaction/stuff', 'fas fa-boxes', 1),
(14, 11, 'Stock In', 'transaction/historystockin', 'fas fa-shopping-cart', 1),
(15, 15, 'User Management', 'user', 'fas fa-users', 1),
(16, 16, 'Sale', 'cashier', 'fas fa-cash-register', 1),
(18, 17, 'Product', 'product', 'fas fa-utensils', 1),
(19, 17, 'Product Category', 'product/productCategory', 'fas fa-th-list', 1),
(20, 16, 'History', 'cashier/history', 'fas fa-history', 1),
(21, 1, 'Report', 'admin/showReport', 'far fa-file-alt', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `category`) VALUES
(1, 'Sembako'),
(4, 'Bumbu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(17,2) NOT NULL,
  `product_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `product_category_id`, `name`, `price`, `product_code`) VALUES
(2, 3, 'Ice Tea', '5000.00', 'P002'),
(3, 1, 'Fried Rice', '15000.00', 'P001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_product_category`
--

CREATE TABLE `tbl_product_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_product_category`
--

INSERT INTO `tbl_product_category` (`id`, `name`) VALUES
(1, 'Food'),
(3, 'Baverage');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_recipe`
--

CREATE TABLE `tbl_recipe` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stuff_id` int(11) NOT NULL,
  `measure` decimal(17,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_recipe`
--

INSERT INTO `tbl_recipe` (`id`, `product_id`, `stuff_id`, `measure`) VALUES
(2, 3, 2, '0.15'),
(3, 3, 4, '0.01'),
(4, 2, 5, '1.00'),
(5, 2, 6, '0.25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sale`
--

CREATE TABLE `tbl_sale` (
  `id` int(11) NOT NULL,
  `struck_no` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `total` decimal(17,2) NOT NULL,
  `payfee` decimal(17,2) NOT NULL,
  `cashier` int(11) NOT NULL,
  `change` decimal(17,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_sale`
--

INSERT INTO `tbl_sale` (`id`, `struck_no`, `date`, `total`, `payfee`, `cashier`, `change`) VALUES
(5, '160520000001', '2020-05-16 13:17:00', '15000.00', '20000.00', 0, '5000.00'),
(6, '170520000001', '2020-05-17 17:42:16', '20000.00', '20000.00', 0, '0.00'),
(7, '170520000002', '2020-05-17 17:42:49', '0.00', '20000.00', 0, '0.00'),
(8, '290520000001', '2020-05-29 13:17:11', '30000.00', '50000.00', 0, '20000.00'),
(9, '290520000002', '2020-05-29 13:18:24', '15000.00', '20000.00', 0, '5000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sale_detail`
--

CREATE TABLE `tbl_sale_detail` (
  `id` int(11) NOT NULL,
  `struck_no` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(17,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(17,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_sale_detail`
--

INSERT INTO `tbl_sale_detail` (`id`, `struck_no`, `product_id`, `product_name`, `price`, `qty`, `total`) VALUES
(1, '160520000001', 3, 'Fried Rice', '15000.00', 1, '15000.00'),
(2, '170520000001', 3, 'Fried Rice', '15000.00', 1, '15000.00'),
(3, '170520000001', 2, 'Ice Tea', '5000.00', 1, '5000.00'),
(4, '290520000001', 3, 'Fried Rice', '15000.00', 2, '30000.00'),
(5, '290520000002', 3, 'Fried Rice', '15000.00', 1, '15000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `id` int(11) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`id`, `nama_satuan`, `satuan`) VALUES
(1, 'Kilogram', 'Kg'),
(2, 'Gram', 'gr'),
(3, 'Pieces', 'Pcs'),
(4, 'Botol', 'Btl'),
(6, 'Lembar', 'lmbr');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_trx_beli`
--

CREATE TABLE `tbl_trx_beli` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(17,2) NOT NULL,
  `harga_total` decimal(17,2) NOT NULL,
  `tgl_beli` date NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `stuff_code` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_trx_beli`
--

INSERT INTO `tbl_trx_beli` (`id`, `nama_barang`, `deskripsi`, `jumlah`, `harga_satuan`, `harga_total`, `tgl_beli`, `id_satuan`, `stuff_code`, `category_id`) VALUES
(5, 'Beras', 'Beras Putih', 5, '11000.00', '55000.00', '2020-03-20', 1, 'B001', 1),
(6, 'Bawang', 'Bawang Putih', 2, '7500.00', '15000.00', '2020-03-19', 1, 'B002', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_trx_beli_temp`
--

CREATE TABLE `tbl_trx_beli_temp` (
  `id_temp` int(11) NOT NULL,
  `nama_barang_temp` varchar(255) NOT NULL,
  `deskripsi_temp` varchar(255) NOT NULL,
  `jumlah_temp` int(11) NOT NULL,
  `harga_satuan_temp` decimal(17,2) NOT NULL,
  `harga_total_temp` decimal(17,2) NOT NULL,
  `tgl_beli_temp` date NOT NULL,
  `id_satuan_temp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_trx_purchase`
--

CREATE TABLE `tbl_trx_purchase` (
  `id` int(11) NOT NULL,
  `stuff_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `qty` decimal(17,2) NOT NULL,
  `total_price` decimal(17,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_trx_purchase`
--

INSERT INTO `tbl_trx_purchase` (`id`, `stuff_id`, `description`, `qty`, `total_price`, `date`) VALUES
(3, 2, 'Tambah', '5.00', '62500.00', '2020-03-31'),
(4, 3, 'Lagi', '1.00', '10000.00', '2020-03-31'),
(8, 3, 'Tambah', '5.50', '55000.00', '2020-04-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_trx_stuff`
--

CREATE TABLE `tbl_trx_stuff` (
  `id` int(11) NOT NULL,
  `stuff_code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `stock` decimal(17,2) NOT NULL,
  `price` decimal(17,2) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_trx_stuff`
--

INSERT INTO `tbl_trx_stuff` (`id`, `stuff_code`, `name`, `stock`, `price`, `unit_id`, `category_id`) VALUES
(2, 'S001', 'Beras', '13.80', '12500.00', 1, 1),
(4, 'S002', 'Bawang Merah', '5.42', '5000.00', 1, 4),
(5, 'S003', 'Teh', '0.50', '2000.00', 3, 1),
(6, 'S004', 'Es Batu', '2.50', '5000.00', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbluseraccessmenu`
--
ALTER TABLE `tbluseraccessmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblusermenu`
--
ALTER TABLE `tblusermenu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbluserrole`
--
ALTER TABLE `tbluserrole`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblusersubmenu`
--
ALTER TABLE `tblusersubmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_recipe`
--
ALTER TABLE `tbl_recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_sale_detail`
--
ALTER TABLE `tbl_sale_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_trx_beli`
--
ALTER TABLE `tbl_trx_beli`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_trx_beli_temp`
--
ALTER TABLE `tbl_trx_beli_temp`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indeks untuk tabel `tbl_trx_purchase`
--
ALTER TABLE `tbl_trx_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_trx_stuff`
--
ALTER TABLE `tbl_trx_stuff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stuff_code_indeks` (`stuff_code`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbluseraccessmenu`
--
ALTER TABLE `tbluseraccessmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tblusermenu`
--
ALTER TABLE `tblusermenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbluserrole`
--
ALTER TABLE `tbluserrole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tblusersubmenu`
--
ALTER TABLE `tblusersubmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_recipe`
--
ALTER TABLE `tbl_recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_sale_detail`
--
ALTER TABLE `tbl_sale_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_trx_beli`
--
ALTER TABLE `tbl_trx_beli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_trx_beli_temp`
--
ALTER TABLE `tbl_trx_beli_temp`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tbl_trx_purchase`
--
ALTER TABLE `tbl_trx_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_trx_stuff`
--
ALTER TABLE `tbl_trx_stuff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
