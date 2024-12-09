-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2024 at 07:16 PM
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
-- Database: `si_kesehatan`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `poli_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `no_antrian` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `poli` varchar(50) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('scheduled','completed','canceled') DEFAULT 'scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `konten`, `gambar`, `link`, `tanggal`) VALUES
(3, 'gfhfgh', 'gas gas gas', 'berita22.jpg', 'https://github.com/Reasonly40/Projek-Biomedis-Sistem-Informasi-Kesehatan/deployments', '2024-12-09 00:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `spesialis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `spesialis`) VALUES
(1, 'Dr. Jasmine Cooper', 'Spesialis Anak'),
(2, 'Dr. David Brown', 'Spesialis Bedah Ortopedi'),
(3, 'Dr. Linda Davis', 'Spesialis Dermatologi'),
(4, 'Dr. Sarah Williams', 'Spesialis THT'),
(5, 'Dr. Michael Lee', 'Spesialis Penyakit Dalam'),
(6, 'Dr. Jennifer Clark', 'Spesialis Ginekologi');

-- --------------------------------------------------------

--
-- Table structure for table `dokterinfo`
--

CREATE TABLE `dokterinfo` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `spesialis` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `profil` text NOT NULL,
  `jadwal` text NOT NULL,
  `kontak_email` varchar(255) NOT NULL,
  `kontak_telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dokterinfo`
--

INSERT INTO `dokterinfo` (`id`, `nama`, `spesialis`, `gambar`, `profil`, `jadwal`, `kontak_email`, `kontak_telepon`) VALUES
(1, 'Dr tes jo', 'Gigi', 'team6.jpg', 'dokter handal', 'Senin|03:04|lantai 5\r\nSelasa|09:04|lantai 9', 'lolonglaw31@gmail.com', '081342811535'),
(3, 'louisa', 'Gigi', 'team5.jpg', 'gigi', 'Senin|10:10|lantai 3', 'louisalolong026@student.unsrat.ac.id', '081342811535'),
(4, 'Dr tes jok', 'Penyakit Dalam', 'team1.jpg', 'hjhj', 'Senin|00:02|lantai 3', 'louisalolong026@student.unsrat.ac.id', '081342811535'),
(5, 'LOUIS', 'Penyakit Dalam', 'team5.jpg', 'jkjkjk', 'Senin|09:00|gedung lantai satu\nSelasa|09:00|gedung lantai dua', 'lolonglaw31@gmail.com', '081342811535'),
(7, 'louisa', 'Kulit', 'team6.jpg', 'Ahli Kulit Terkenal', 'Senin|10:10|lantai 8', 'lolonglaw31@gmail.com', '081342811535');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `Lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id`, `name`, `hari`, `jam`, `Lokasi`) VALUES
(1, 'Dr. David Browner', 'Selasa', '10:00 - 13:00', 'Poli Bedah - Lantai 3'),
(2, 'Dr. David Browner', 'Kamis', '15:00 - 18:00', 'Poli Bedah - Lantai 3'),
(3, 'Dr. David Browner', 'Jumat', '08:30 - 11:30', 'Poli Bedah - Lantai 3'),
(4, 'Dr. Jasmine Cooper', 'Senin', '09:00 - 12:00', 'Poli Anak - Lantai 2'),
(5, 'Dr. Jasmine Cooper', 'Rabu', '13:00 - 16:00', 'Poli Anak - Lantai 2'),
(6, 'Dr. Jasmine Cooper', 'Jumat', '10:00 - 13:00', 'Poli Anak - Lantai 2'),
(7, 'Dr. Jennifer Clark', 'Selasa', '09:30 - 12:30', 'Poli Kandungan - Lantai 4'),
(8, 'Dr. Jennifer Clark', 'Kamis', '14:00 - 17:00', 'Poli Kandungan - Lantai 4'),
(9, 'Dr. Jennifer Clark', 'Minggu', '08:00 - 11:30', 'Poli Kandungan - Lantai 4'),
(10, 'Dr. Linda Davis', 'Senin', '10:00 - 13:00', 'Poli Kulit - Lantai 2'),
(11, 'Dr. Linda Davis', 'Kamis', '14:00 - 17:00', 'Poli Kulit - Lantai 2'),
(12, 'Dr. Linda Davis', 'Sabtu', '09:00 - 11:30', 'Poli Kulit - Lantai 2'),
(13, 'Dr. Michael Lee', 'Senin', '08:00 - 11:00', 'Poli Penyakit Dalam - Lantai 3'),
(14, 'Dr. Michael Lee', 'Rabu', '13:30 - 16:30', 'Poli Penyakit Dalam - Lantai 3'),
(15, 'Dr. Michael Lee', 'Sabtu', '09:00 - 12:00', 'Poli Penyakit Dalam - Lantai 3'),
(16, 'Dr. Sarah Williams', 'Selasa', '09:00 - 12:00', 'Poli THT - Lantai 1'),
(17, 'Dr. Sarah Williams', 'Jumat', '13:00 - 16:00', 'Poli THT - Lantai 1'),
(18, 'Dr. Sarah Williams', 'Minggu', '08:30 - 11:30', 'Poli THT - Lantai 1');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `nama_poli` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `dokter_id` int(11) DEFAULT NULL,
  `spesialis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `description`, `icon`, `gambar`, `dokter_id`, `spesialis`) VALUES
(2, 'Penyakit Dalam', 'hjhjhjhjhj', ' fa-eye', 'berita3.jpg', 4, 'Penyakit Dalam');

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `poli` varchar(50) NOT NULL,
  `dokter` varchar(50) NOT NULL,
  `nomor_antrian` int(11) NOT NULL,
  `waktu_antrian` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `poli`, `dokter`, `nomor_antrian`, `waktu_antrian`) VALUES
(8, 'poli_bedah', 'Dr. David Brown - Spesialis Bedah Ortopedi', 1, '2024-12-04 01:38:46'),
(9, 'poli_bedah', 'Dr. David Brown - Spesialis Bedah Ortopedi', 2, '2024-12-04 01:38:47'),
(10, 'poli_bedah', 'Dr. David Brown - Spesialis Bedah Ortopedi', 3, '2024-12-04 01:38:48'),
(11, 'poli_tht', 'Dr. Sarah Williams - Spesialis THT', 1, '2024-12-04 03:12:31'),
(12, 'poli_tht', 'Dr. Sarah Williams - Spesialis THT', 2, '2024-12-04 03:12:34'),
(13, 'poli_tht', 'Dr. Sarah Williams - Spesialis THT', 3, '2024-12-04 03:12:37'),
(14, 'poli_kulit_dan_kelamin', 'Dr. Linda Davis - Spesialis Dermatologi', 1, '2024-12-04 03:13:35'),
(15, 'poli_kulit_dan_kelamin', 'Dr. Linda Davis - Spesialis Dermatologi', 2, '2024-12-04 03:13:39'),
(16, 'poli_kulit_dan_kelamin', 'Dr. Linda Davis - Spesialis Dermatologi', 3, '2024-12-04 03:13:41'),
(17, 'poli_kulit_dan_kelamin', 'Dr. Linda Davis - Spesialis Dermatologi', 4, '2024-12-04 03:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `poli_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `diagnosis` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `name` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `dokter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `name`, `alamat`, `tanggal_lahir`, `no_telepon`, `diagnosis`, `dokter_id`) VALUES
(9, 'admin@example.com', '0192023a7bbd73250516f069df18b500', 'admin', 'Administrator', 'Jl. Raya No. 1', '1980-01-01', '081234567890', 'Tidak Ada Diagnosis', NULL),
(10, 'user@example.com', '6ad14ba9986e3615423dfca256d04e3f', 'user', 'John Doe', 'Jl. Sejahtera No. 2', '1990-05-15', '082233445566', 'Flu', 2),
(11, 'atta@example.com', 'a4696143de4c48058d1cd51262c4be5e', 'user', 'atta', 'Jl. Merdeka No. 3', '1995-07-20', '083344556677', 'Batuk', 3),
(12, 'durant@example.com', '906458c4c637a2c36a153f6f2ae491f5', 'user', 'Durant', 'Jl. Pahlawan No. 4', '1985-11-25', '084455667788', 'Pneumonia', 4),
(14, 'lolonglaw31@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', 'louisa', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokterinfo`
--
ALTER TABLE `dokterinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasien_id` (`user_id`),
  ADD KEY `poli_id` (`poli_id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dokterinfo`
--
ALTER TABLE `dokterinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `poli`
--
ALTER TABLE `poli`
  ADD CONSTRAINT `poli_ibfk_1` FOREIGN KEY (`dokter_id`) REFERENCES `dokterinfo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
