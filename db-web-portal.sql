-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 02:47 AM
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
-- Database: `db-web-portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `kode`, `unit`) VALUES
(32, '0.01', 'Document Management System'),
(33, '0.02', ' Fraud Detection'),
(34, '0.03', 'Anti Money Laundering'),
(35, '0.04', 'Icom'),
(49, '0.05', 'Data Warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(2556) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `image` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `username`, `password`, `jabatan`, `kode`, `image`, `role_id`) VALUES
(38, 'Husnu Tazkiya ulwah', 'Husnu.tazkiya', '$2y$10$KDfMrSmiSnTDcRGg3zeuJOWhG2Zy7UsnTmTgj/a2jSIbo5.SGekpK', 'Developer', '0.01', 'IMG_6170.JPG', 1),
(44, 'nunu tazkiya', 'nunu123', '$2y$10$jUA8pXpJwxyEkLzP1mT8fuJlpfbHvF1PjVjU7ePlwyLjwWU0Dqwpa', 'Officer 3 Service So', '0.01', 'default.jpg', 2),
(54, 'husnu ', 'husnu.tazkiya', '$2y$10$31qtQr6AsALLAgxShd9kPOEUsatNk9D..M5SriU55aDETwcS9/Q5e', 'Officer 3 Service So', '0.01', 'default.jpg', 2),
(56, 'Dhila Aprilianti', 'dhila.aprilianti', '$2y$10$OiYra8uLRrqtKMa3/KPCq.yajjIv2whCDE3Br/Igl0Ph.xCqoeY4K', 'Quality Assurance', '0.01', 'default.jpg', 2),
(57, 'maulida', 'maulida.riris', '$2y$10$sFiI3NV60olqwkUDu/jIFOp9Ia3T1ns8SGMRm.aWteC8VzIfsDPm2', 'Quality Assurance', '0.03', 'default.jpg', 2),
(58, 'Adhi putra', 'adhi.putra', '$2y$10$fazSoy.7.HexKFAl4xcjVuA7WYMxrWOKNmOL.LbqtvlCOEoIOxNbi', 'Developer', '0.03', 'default.jpg', 2),
(59, 'izza hafidz', 'izza.hafidz', '$2y$10$t.2PqrsoxygN6LOD0IFqR.7hbs0Bfr7tIai1I4mA2fioqHK9g8dNi', 'UI/UX', '0.01', 'default.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `t_buglist`
--

CREATE TABLE `t_buglist` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `modul` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `test_case` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `test_step` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `screenshoot` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qa_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dev_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dev_pic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `severity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_buglist`
--

INSERT INTO `t_buglist` (`id`, `kode`, `tanggal`, `modul`, `test_case`, `test_step`, `screenshoot`, `status`, `qa_note`, `dev_note`, `dev_pic`, `severity`, `pic`) VALUES
(3, '0.01', '2024-06-26 08:02:00.000000', 'pull googlee', '', 'generate sharelink versi 1 di dokumen yang mempunyai versi 1 dan 2 ', '667d3fe92b225.png', 'Ready to test', 'masih belum bisa', 'oke', 'ok', 'Low', 'nunu tazkiya'),
(4, '0.01', '2024-06-26 08:03:00.000000', 'versi dokumen', 'versi dokumen membaca versi yang sedang aktif saja', 'lakukan edit dan submit kembali, maka versi dokumen akan terbaru menjadi versi 2 ', '667d4000c67f9.png', 'Open', 'urgent', '', '', 'Low', 'Adhi'),
(5, '0.01', '2024-06-26 08:03:13.750436', 'Button', 'tidak bisa di klik', 'klik button', '', 'Ready to test', 'test', 'test', 'test', 'Low', 'No pic'),
(6, '0.01', '2024-06-27 09:16:14.004598', 'Testing', 'test', 'Test', '667d2dddf19fb.png', 'ready to test', 'done', 'done', 'done', 'medium', ''),
(7, '0.01', '2024-06-27 09:17:20.939113', 'testing', 'testing', 'testing', '667d2e20e18cb.png', 'ready to test', 'testing', 'testing', 'testing', 'medium', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_ui-ux`
--

CREATE TABLE `t_ui-ux` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `tanggal` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `modul` varchar(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  `test_step` varchar(255) NOT NULL,
  `screenshoot` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `qa_note` text NOT NULL,
  `dev_note` text NOT NULL,
  `severity` varchar(255) NOT NULL,
  `pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 1, 3),
(6, 2, 6),
(8, 2, 7),
(9, 2, 2),
(10, 1, 8),
(11, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(3, 'Menu'),
(6, 'Fitur'),
(9, 'User'),
(11, 'UAT');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(3, 1, 'Role', 'admin/role', 'fas fa-fw fa-gear', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Sub Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(11, 1, 'Add User', 'admin/user', 'fas fa-fw fa-plus-square', 1),
(12, 1, 'Unit', 'admin/unit', 'fas fa-fw fa-sitemap', 1),
(13, 6, 'Dashboard', 'admin', 'fas fa-fw fa-home', 1),
(14, 6, 'Bug list Dev', 'fitur', 'fas fa-fw fa-th-list', 1),
(19, 6, 'Bug List UI/UX', 'fitur/UIbuglist', 'fas fa-fw fa-table', 1),
(21, 11, 'Closed Bug Developer', 'UAT', 'fas fa-fw fa-sticky-note', 1),
(22, 11, 'Closed Bug UI/UX', 'UAT/closedbugUI', 'fas fa-fw fa-sticky-note', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`),
  ADD KEY `kode` (`kode`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode` (`kode`);

--
-- Indexes for table `t_buglist`
--
ALTER TABLE `t_buglist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_ui-ux`
--
ALTER TABLE `t_ui-ux`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `t_buglist`
--
ALTER TABLE `t_buglist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_ui-ux`
--
ALTER TABLE `t_ui-ux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
