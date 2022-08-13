-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2022 at 03:44 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tamagotchi_diresto`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_menu` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `stok` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `jenis_menu`, `harga`, `stok`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Spagheti Lamongan', 'Minuman', 30000, 1, 'foto_menu/C7h84WZZ7iTH5JNMRq0sJoivFBTGD8XIk1JhwSni.jpg', '2022-08-13 10:11:58', '2022-08-13 11:46:33', NULL),
(6, 'Burger Selero Padang', 'Makanan', 40000, 0, 'foto_menu/FNxGfxO5pQrD7mx7SJhB42s9Q3gxp5D5TvrprRVA.jpg', '2022-08-13 10:13:52', '2022-08-13 11:46:33', NULL),
(7, 'Boba Brown Sugar', 'Minuman', 40000, 9, 'foto_menu/3BpR4KqHatify7Vb134MBekVZTPnLJWZtIXwDwbg.jpg', '2022-08-13 10:15:12', '2022-08-13 11:46:33', NULL),
(8, 'Lobak', 'Makanan', 3000, 19, 'foto_menu/SmVULViHibFHVGZ5kZCx4KrB0KDPbyzqhRnIvxGB.jpg', '2022-08-13 11:26:04', '2022-08-13 11:30:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `user_id`, `nama`, `alamat`, `telp`, `created_at`, `updated_at`) VALUES
(3, 3, 'Fajar', 'Bogor', '0858', '2022-08-13 11:24:50', '2022-08-13 11:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_meja` varchar(255) NOT NULL,
  `status` enum('Dipakai','Kosong') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `user_id`, `no_meja`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, '01', 'Kosong', '2022-08-11 08:33:50', '2022-08-13 11:27:30'),
(2, 7, '02', 'Kosong', '2022-08-13 10:18:10', '2022-08-13 10:18:10'),
(3, 8, '03', 'Kosong', '2022-08-13 10:18:19', '2022-08-13 10:18:19'),
(4, 10, '05', 'Kosong', '2022-08-13 11:08:21', '2022-08-13 11:08:21'),
(6, 11, '06', 'Kosong', '2022-08-13 11:23:31', '2022-08-13 11:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `total_bayar` double NOT NULL,
  `status` enum('Diproses','Selesai Dibuat','Selesai') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `no_transaksi`, `user_id`, `pelanggan_id`, `total_bayar`, `status`, `created_at`, `updated_at`) VALUES
(17, 'TRS-001', 7, 2, 113000, 'Selesai', '2022-08-13 11:30:26', '2022-08-13 11:35:45'),
(18, 'TRS-002', 2, NULL, 70000, 'Selesai', '2022-08-13 11:34:10', '2022-08-13 11:34:10'),
(19, 'TRS-003', 2, NULL, 230000, 'Selesai', '2022-08-13 11:45:17', '2022-08-13 11:45:17'),
(20, 'TRS-004', 7, 2, 110000, 'Selesai', '2022-08-13 11:46:33', '2022-08-13 11:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id`, `pesanan_id`, `menu_id`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(16, 17, 8, 1, 3000, '2022-08-13 11:30:26', '2022-08-13 11:30:26'),
(17, 17, 5, 1, 30000, '2022-08-13 11:30:26', '2022-08-13 11:30:26'),
(18, 17, 6, 2, 80000, '2022-08-13 11:30:26', '2022-08-13 11:30:26'),
(19, 18, 5, 1, 30000, '2022-08-13 11:34:10', '2022-08-13 11:34:10'),
(20, 18, 6, 1, 40000, '2022-08-13 11:34:10', '2022-08-13 11:34:10'),
(21, 19, 5, 1, 30000, '2022-08-13 11:45:17', '2022-08-13 11:45:17'),
(22, 19, 6, 5, 200000, '2022-08-13 11:45:17', '2022-08-13 11:45:17'),
(23, 20, 5, 1, 30000, '2022-08-13 11:46:33', '2022-08-13 11:46:33'),
(24, 20, 6, 1, 40000, '2022-08-13 11:46:33', '2022-08-13 11:46:33'),
(25, 20, 7, 1, 40000, '2022-08-13 11:46:33', '2022-08-13 11:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '$2y$10$E1PByhfQcghDi/g1iqW5kOT9t2say37hboje1.NtXyLk2OziqJM7S', 1, NULL, NULL),
(2, 'Kasir', 'kasir', '$2y$10$E1PByhfQcghDi/g1iqW5kOT9t2say37hboje1.NtXyLk2OziqJM7S', 2, NULL, NULL),
(3, 'Koki', 'koki', '$2y$10$E1PByhfQcghDi/g1iqW5kOT9t2say37hboje1.NtXyLk2OziqJM7S', 3, NULL, NULL),
(4, 'Pelayan', 'pelayan', '$2y$10$E1PByhfQcghDi/g1iqW5kOT9t2say37hboje1.NtXyLk2OziqJM7S', 4, NULL, NULL),
(5, 'Meja 001', 'meja1', '$2y$10$dITOhM68KpNafPb7B2fouORsX0.aPugefQH0BK8eB7rQuUWgGnSOi', 5, NULL, '2022-08-13 10:17:06'),
(7, 'Meja 002', 'meja2', '$2y$10$KNnv7uq/CUn2YP4ssRpVze5T2BvXk97NVY4nYviyEs36h4CxBJQU2', 5, '2022-08-13 10:17:38', '2022-08-13 10:17:38'),
(8, 'Meja 003', 'meja3', '$2y$10$WLRUA.Lmahm8qoA7Mp/oTeYRpArxUG.YNxMLBjBHOQneibyd3fMb6', 5, '2022-08-13 10:17:54', '2022-08-13 10:17:54'),
(9, 'meja 004', 'meja4', '$2y$10$w89nRwjlhZqWjPqZXP.iieNnZ1LrEwy/OxemTEzdFP9fDpGw0lmfO', 5, '2022-08-13 10:31:26', '2022-08-13 10:31:26'),
(10, 'Meja 005', 'meja5', '$2y$10$7X4sAwuhqJwDMRkQCwRZTuLmb7LNJ8XBkq0K7LcVwnmzPguUhENRG', 5, '2022-08-13 11:06:50', '2022-08-13 11:06:50'),
(11, 'Meja 006', 'meja6', '$2y$10$QfgoRKPbrSN9/zXSzROH7excOchu61klJk6Th4VjkxP5C4l824bUS', 5, '2022-08-13 11:20:50', '2022-08-13 11:20:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `pesanan_detail_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `pesanan_detail_ibfk_3` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
