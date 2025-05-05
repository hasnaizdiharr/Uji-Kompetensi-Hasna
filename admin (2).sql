-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 02:37 AM
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
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ID` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `Nama`, `Password`) VALUES
(1, 'Admin123', 'valdodaya'),
(2, 'HRDvaldo', 'valdosumberdaya');

-- --------------------------------------------------------

--
-- Table structure for table `data_karyawan`
--

CREATE TABLE `data_karyawan` (
  `ID` int(11) NOT NULL,
  `NIK` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Alamat` varchar(200) NOT NULL,
  `No_Rek` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_karyawan`
--

INSERT INTO `data_karyawan` (`ID`, `NIK`, `Nama`, `Alamat`, `No_Rek`) VALUES
(1, 12234556, 'Mandala Hivi', 'Jalan sukaraya nomor 2 ', 86389278),
(2, 12265748, 'Juna Kafa Atmaja', 'Jalan Margahayu nomor 87', 789207357),
(3, 12209783, 'Idzane Maliq', 'Jalan imam bonjol nomor 5', 197837405),
(4, 12245893, 'Ragas Lakeswara', 'Jalan sukatani nomor 92', 863712567),
(5, 12356479, 'Rumi Andaru', 'Jalan Sumiaji nomor 45 ', 334675829),
(6, 12357689, 'Baskara Pramudya', 'Jalan Senopati nomor 210', 566723904),
(7, 12355697, 'Andi Umar Pambarani', 'Jalan Dewi Sartika nomor 45', 789364796),
(8, 12234567, 'Aaron Werner', 'Jalan Kamboja nomor 5', 896378027),
(9, 11223345, 'Adiba Izdihar', 'Jalan Jendral Sudirman', 864729374),
(10, 12233445, 'Abbey Cano Behzad', 'Jalan Jendral Gatot Subroto', 853682974),
(11, 12334455, 'Caily Daniella Elfreda', 'Jalan Ahmad yani nomor 90', 921037468),
(12, 12345566, 'Chavash Fadie Eason ', 'Jalan Antapani Nomor 2', 572384963),
(13, 12345667, 'Areesha Edna Gamila', 'Jalan Margahayu nomor 96', 138749865);

-- --------------------------------------------------------

--
-- Table structure for table `kualitas_karyawan`
--

CREATE TABLE `kualitas_karyawan` (
  `ID` int(11) NOT NULL,
  `NIK` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Divisi` varchar(100) NOT NULL,
  `Kehadiran` varchar(20) NOT NULL,
  `Tanggung_Jawab` int(10) NOT NULL,
  `Kerjasama_Tim` int(10) NOT NULL,
  `Ketepatan_Waktu` int(10) NOT NULL,
  `Karakter` int(10) NOT NULL,
  `kualitas` varchar(255) NOT NULL,
  `waktu_input` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kualitas_karyawan`
--

INSERT INTO `kualitas_karyawan` (`ID`, `NIK`, `Nama`, `Divisi`, `Kehadiran`, `Tanggung_Jawab`, `Kerjasama_Tim`, `Ketepatan_Waktu`, `Karakter`, `kualitas`, `waktu_input`) VALUES
(1, 12234556, 'Mandala Hivi', '', '90', 60, 55, 90, 75, 'Kurang Baik', '2025-04-16 13:28:20'),
(2, 12265748, 'Juna Kafa Atmaja', '', '90', 85, 90, 85, 90, 'Baik', '2025-04-16 13:28:52'),
(3, 12209783, 'Idzane Maliq', '', '90', 55, 45, 30, 80, 'Tidak Baik', '2025-04-16 13:29:20'),
(4, 12245893, 'Ragas Lakeswara', '', '89', 90, 90, 90, 90, 'Baik', '2025-04-16 13:29:55'),
(5, 12356479, 'Rumi Andaru', '', '98', 98, 98, 98, 100, 'Sangat Baik', '2025-04-16 13:30:55'),
(6, 12357689, 'Baskara Pramudya', '', '90', 60, 75, 80, 85, 'Cukup Baik', '2025-04-17 08:25:05'),
(7, 12355697, 'Andi Umar Pambarani', '', '75', 80, 85, 79, 90, 'Cukup Baik', '2025-04-17 08:25:49'),
(9, 11223345, 'Adiba Izdihar', '', '90', 95, 80, 85, 90, 'Baik', '2025-04-25 08:46:39'),
(10, 12334455, 'Caily Daniella Elfreda', '', '80', 85, 90, 69, 90, 'Cukup Baik', '2025-04-25 10:01:19'),
(11, 12233445, 'Abbey Cano Behzad', '', '80', 70, 80, 70, 98, 'Cukup Baik', '2025-04-25 10:11:39'),
(12, 12345566, 'Chavash Fadie Eason ', '', '90', 95, 85, 90, 98, 'Sangat Baik', '2025-04-25 10:18:25'),
(13, 12345667, 'Areesha Edna Gamila', '', '95', 70, 75, 78, 90, 'Cukup Baik', '2025-04-25 10:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_register`
--

CREATE TABLE `user_register` (
  `NIK` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(35) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Divisi` varchar(100) NOT NULL,
  `profilee` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_register`
--

INSERT INTO `user_register` (`NIK`, `Username`, `Password`, `Email`, `Divisi`, `profilee`) VALUES
(11223345, 'Adiba Izdihar', 'adiba', 'adibaaiz@gmail.com', 'Recruitment', 'IMG_680ae6320604e9.47513098.jpg'),
(12209783, 'Idzane Maliq', 'maliq', 'Idzane_Maliq@gmail.com', 'Recruitment', 'IMG_67ff1a4f1ccbb0.65470348.jpg'),
(12233445, 'Abbey Cano Behzad', 'abbey', 'Beycanozad@gmail.com', 'Recruitment', 'IMG_680af13c2b0dc3.62883248.jpg'),
(12234556, 'Mandala Hivi', 'Andala', 'andalahivi@gmail.com', 'Recruitment', 'IMG_67fe02bc203929.21349209.jpg'),
(12245893, 'Ragas Lakeswara', 'ragass', 'ragaslakes@gmail.com', 'Recruitment', 'IMG_67fe01439fa170.46828491.jpg'),
(12265748, 'Juna Kafa Atmaja', 'juna', 'kafatamaja', 'Recruitment', 'IMG_67fe033e899bc4.14457556.jpg'),
(12334455, 'Caily Daniella Elfreda', 'danieela', 'Cailydaniella@gmail.com', 'Recruitment', 'IMG_680af81ded6fe1.86175337.jpg'),
(12345566, 'Chavash Fadie', 'fadiee', 'chavashfadiea03@gmail.com', 'Recruitment', 'IMG_680b00884ecde7.08525841.jpg'),
(12345667, 'Areesha Edna Gamila', 'edna', 'areednagamila@gmail.com', 'Recruitment', 'IMG_680b0b787829f7.06488429.jpg'),
(12355697, 'Andi Umar Pambarani', 'andiumar', 'pambaraniumar', 'Recruitment', 'IMG_68005846efa893.05041360.jpg'),
(12356479, 'Rumi Andaru', 'rumi', 'andarumi@gmail.com', 'Recruitment', 'IMG_67fdfa07f0a340.14118680.jpg'),
(12357689, 'Baskara Pramudya', 'baskara', 'baskarapramudyaa_@gmail.com', 'Recruitment', 'IMG_680057c4bbd577.40878501.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `data_karyawan`
--
ALTER TABLE `data_karyawan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kualitas_karyawan`
--
ALTER TABLE `kualitas_karyawan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`NIK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_karyawan`
--
ALTER TABLE `data_karyawan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kualitas_karyawan`
--
ALTER TABLE `kualitas_karyawan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `NIK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123456779;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
