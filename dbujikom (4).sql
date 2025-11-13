-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 13, 2025 at 05:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbujikom`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `scheduled_at` datetime DEFAULT NULL,
  `waktu` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `title`, `description`, `photo_path`, `scheduled_at`, `waktu`, `lokasi`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Pelepasan & Wisuda Siswa Kelas XII SMKN 4 BOGOR', 'Kegiatan perpisahan dan penyerahan penghargaan bagi siswa kelas XII yang telah menyelesaikan masa belajar.', NULL, '2026-05-05 00:00:00', '07.00 – 14.00 WIB', 'Gedung Graha Pancakarsa, Bogor', 'Aktif', '2025-10-24 06:43:36', '2025-10-24 06:48:18'),
(7, 'Ujian Kompetensi Keahlian (UKK)', 'Ujian praktik kejuruan bagi siswa kelas XII sebagai syarat kelulusan dan pengukuran kompetensi kerja.', NULL, '2025-11-17 00:00:00', '7.00 – 15.00 WIB', 'Bengkel dan Laboratorium Jurusan', 'Aktif', '2025-10-24 06:59:19', '2025-11-05 22:44:38'),
(8, 'Rapat Persiapan Ujian Akhir Semester', 'Rapat ini diadakan untuk membahas teknis pelaksanaan UTS semester ganjil, termasuk jadwal ujian, pengawas, serta pembagian ruang. Semua guru mata pelajaran diharapkan hadir untuk memastikan kegiatan berjalan lancar dan tertib.', NULL, '2025-11-01 00:00:00', '08.00-12.00 WIB', 'Ruang guru', 'Aktif', '2025-11-05 23:01:11', '2025-11-11 10:35:58'),
(9, 'Pelatihan Kewirausahaan', 'Workshop untuk siswa kelas XII mengenai pengembangan usaha kreatif dan pemasaran digital.', NULL, '2025-11-14 00:00:00', '08.00-12.00 WIB', 'Aula SMKN 4 Bogor', 'Aktif', '2025-11-05 23:02:25', '2025-11-05 23:07:18'),
(10, 'Lomba Kebersihan Kelas', 'Lomba kebersihan kelas diadakan untuk menciptakan lingkungan belajar yang nyaman dan sehat. Penilaian dilakukan setiap hari selama seminggu, dan hasilnya akan diumumkan pada kegiatan Class Meeting.', NULL, '2025-11-18 00:00:00', '07.00 – 10.00 WIB', 'Seluruh Kelas', 'Nonaktif', '2025-11-05 23:03:55', '2025-11-11 10:38:38'),
(11, 'Class Meeting Semester Ganjil', 'Serangkaian lomba antar kelas setelah ujian akhir semester.', NULL, '2025-12-15 00:00:00', '7.00 – 15.00 WIB', 'Lapangan SMKN 4 Bogor', 'Aktif', '2025-11-05 23:05:38', '2025-11-05 23:05:38'),
(12, 'Upacara Hari Guru Nasional', 'Upacara peringatan Hari Guru dengan penampilan dari perwakilan siswa.', NULL, '2025-11-25 00:00:00', '07.00-09.00 WIB', 'Lapangan SMKN 4 Bogor', 'Nonaktif', '2025-11-05 23:06:48', '2025-11-05 23:06:48'),
(14, 'Pelaksanaan Ujian Tengah Semester (UTS) Ganjil 2025', 'UTS semester ganjil akan berlangsung pada tanggal 4 hingga 9 November 2025. Siswa diharapkan hadir tepat waktu dan mematuhi tata tertib ujian yang berlaku. Pengawas ujian wajib memeriksa kelengkapan berkas sebelum ujian dimulai.', NULL, '2025-11-04 00:00:00', '07.30 – 12.00 WIB', 'Ruang Kelas Masing-Masing', 'Aktif', '2025-11-11 10:37:12', '2025-11-11 10:37:12'),
(15, 'Workshop Kewirausahaan Siswa', 'Workshop ini bertujuan menumbuhkan jiwa wirausaha di kalangan siswa kelas XII dengan menghadirkan narasumber dari pelaku bisnis lokal. Materi mencakup cara memulai usaha, strategi pemasaran, dan manajemen keuangan dasar.', NULL, '2025-11-16 00:00:00', '09.00 – 12.00 WIB', 'Aula SMKN 4 Bogor', 'Nonaktif', '2025-11-11 10:38:08', '2025-11-11 10:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `download_logs`
--

CREATE TABLE `download_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `foto_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `download_logs`
--

INSERT INTO `download_logs` (`id`, `user_id`, `foto_id`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 14, 21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-26 03:47:04', '2025-10-26 03:47:04'),
(2, 14, 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-26 04:09:00', '2025-10-26 04:09:00'),
(3, 13, 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-05 21:37:10', '2025-11-05 21:37:10'),
(4, 15, 36, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-11-06 00:11:27', '2025-11-06 00:11:27'),
(5, 16, 18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-10 19:50:03', '2025-11-10 19:50:03'),
(6, 15, 86, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/17.5 Mobile/15A5370a Safari/602.1', '2025-11-11 10:41:54', '2025-11-11 10:41:54'),
(7, 17, 88, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-12 03:02:55', '2025-11-12 03:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL DEFAULT 'Aktif',
  `likes_count` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `dislikes_count` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `petugas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `judul`, `deskripsi`, `path`, `kategori_id`, `status`, `likes_count`, `dislikes_count`, `petugas_id`, `created_at`, `updated_at`) VALUES
(6, 'upacara bendera', 'Kegiatan upacara bendera setiap hari Senin', 'fotos/1762828621_4x7h10XdN4.jpeg', 8, 'Aktif', 0, 0, 1, '2025-10-19 19:01:59', '2025-11-10 19:37:01'),
(7, 'moontour', 'Aktivitas pramuka di lapangan sekolah', 'fotos/1762828218_yQp7yhM95m.jpg', 4, 'Aktif', 0, 0, 1, '2025-10-19 19:01:59', '2025-11-10 19:30:18'),
(9, 'pentas seni', 'Pentas seni tahunan sekolah', 'fotos/1762827890_3bI9ZKU7wV.JPG', 2, 'Aktif', 0, 0, 1, '2025-10-19 19:01:59', '2025-11-10 19:24:50'),
(10, 'lomba karet', 'Kunjungan ke industri untuk pembelajaran', 'fotos/1762827237_AqqS9GbfnF.JPG', 1, 'Aktif', 0, 0, 1, '2025-10-19 19:01:59', '2025-11-10 19:13:57'),
(16, 'bernyanyi bersama', 'cnbashcgwuy', 'fotos/1762828731_Hkhe6Zh3nu.JPG', 3, 'Aktif', 0, 0, 1, '2025-10-21 00:55:33', '2025-11-10 19:38:51'),
(17, 'futsal', NULL, 'fotos/1762828790_NIJboLb4m6.JPG', 1, 'Aktif', 0, 0, 1, '2025-10-22 06:08:26', '2025-11-10 19:39:50'),
(18, 'p5 membersihkan halaman', NULL, 'fotos/1762828884_jNtM3ZGBj4.JPG', 3, 'Aktif', 0, 0, 1, '2025-10-22 06:09:28', '2025-11-10 19:41:24'),
(19, 'menari', NULL, 'fotos/1762829427_B9lC0qO6M1.JPG', 3, 'Aktif', 0, 0, 13, '2025-10-24 08:11:08', '2025-11-10 19:50:27'),
(22, 'lomba ikat kaki', NULL, 'fotos/1762829789_ZZlET21nWo.JPG', 2, 'Aktif', 0, 0, 14, '2025-10-26 05:04:57', '2025-11-10 19:56:29'),
(23, 'futsal', NULL, 'fotos/1762829841_AcqZmHvDN9.JPG', 2, 'Aktif', 0, 0, 14, '2025-10-26 05:05:40', '2025-11-10 19:57:21'),
(24, 'lomba ikat kaki', NULL, 'fotos/1762830025_DNyMFyO44u.JPG', 2, 'Aktif', 0, 0, 14, '2025-10-26 05:06:11', '2025-11-10 20:00:25'),
(25, 'lomba ikat kaki', NULL, 'fotos/1762829963_ock7zDRUtH.JPG', 2, 'Aktif', 0, 0, 14, '2025-10-26 05:33:15', '2025-11-10 19:59:24'),
(26, 'adu panco', NULL, 'fotos/1762830162_P5KiGT0Hih.JPG', 2, 'Aktif', 0, 0, 14, '2025-10-26 05:34:00', '2025-11-10 20:02:42'),
(27, 'adu panco', NULL, 'fotos/1762830229_l2KWZ1rv0R.JPG', 2, 'Aktif', 0, 0, 14, '2025-10-26 05:34:21', '2025-11-10 20:03:49'),
(28, 'futsal', NULL, 'fotos/1762830286_qZk3dhOPJi.JPG', 2, 'Aktif', 0, 0, 14, '2025-10-26 05:34:44', '2025-11-10 20:04:46'),
(29, 'lomba ikat kaki', NULL, 'fotos/1762830356_jezADSNKER.JPG', 2, 'Aktif', 0, 0, 14, '2025-10-26 05:35:13', '2025-11-10 20:05:56'),
(30, 'lomba ikat kaki', NULL, 'fotos/1762830418_24eW1xq1Vy.JPG', 2, 'Aktif', 0, 0, 14, '2025-10-26 05:37:06', '2025-11-10 20:06:58'),
(31, 'futsal', NULL, 'fotos/1762830480_0XOft6VBWF.JPG', 2, 'Aktif', 0, 0, 14, '2025-10-26 05:37:38', '2025-11-10 20:08:00'),
(32, 'lomba estafet karet', NULL, 'fotos/1762830591_MG170WYAfu.JPG', 1, 'Aktif', 0, 0, 14, '2025-10-26 06:05:09', '2025-11-10 20:09:51'),
(33, 'lomba kelereng', NULL, 'fotos/1762830641_fJkS9xDGSI.JPG', 1, 'Aktif', 0, 0, 14, '2025-10-26 06:05:38', '2025-11-10 20:10:41'),
(34, 'lomba balap karung', NULL, 'fotos/1762830713_z90khut19S.JPG', 1, 'Aktif', 0, 0, 14, '2025-10-26 06:06:30', '2025-11-10 20:11:53'),
(35, 'acara menari', NULL, 'fotos/1762830748_v4RDYxr1eq.JPG', 9, 'Aktif', 0, 0, 14, '2025-10-26 06:08:52', '2025-11-10 20:12:28'),
(36, 'acara menari', NULL, 'fotos/1762830784_Bhbs9xX7ud.JPG', 9, 'Aktif', 0, 0, 14, '2025-10-26 06:10:39', '2025-11-10 20:13:04'),
(37, 'acara menyanyi', NULL, 'fotos/1762830814_7ckVMSKkd3.JPG', 9, 'Aktif', 0, 0, 14, '2025-10-26 06:11:55', '2025-11-10 20:13:34'),
(38, 'acara menari', NULL, 'fotos/1762830850_3GE3ZzKn8x.JPG', 9, 'Aktif', 0, 0, 14, '2025-10-26 06:13:45', '2025-11-10 20:14:10'),
(39, 'acara menari', NULL, 'fotos/1762830885_wjUBzZzuDw.JPG', 9, 'Aktif', 0, 0, 14, '2025-10-26 06:14:43', '2025-11-10 20:14:45'),
(40, 'duet nyanyi davina dan dzakwan', NULL, 'fotos/1762830944_1nRrraM4Wp.JPG', 9, 'Aktif', 0, 0, 1, '2025-11-05 23:36:38', '2025-11-10 20:15:44'),
(41, 'acara menari', NULL, 'fotos/1762831025_buVvkzySrH.JPG', 9, 'Aktif', 0, 0, 1, '2025-11-05 23:37:53', '2025-11-10 20:17:05'),
(42, 'couple fashion show', NULL, 'fotos/1762831079_3OgRsDfyxO.JPG', 9, 'Aktif', 0, 0, 1, '2025-11-05 23:38:58', '2025-11-10 20:17:59'),
(43, 'acara menari', NULL, 'fotos/1762831121_fwbQxW4aGN.JPG', 9, 'Aktif', 0, 0, 1, '2025-11-05 23:40:00', '2025-11-10 20:18:41'),
(44, 'acara menari bali', NULL, 'fotos/1762831172_26yHI4dNFl.JPG', 9, 'Aktif', 0, 0, 1, '2025-11-05 23:40:56', '2025-11-10 20:19:32'),
(45, 'paduan suara smkn 4 bogor', NULL, 'fotos/1762831192_fVnw3wz6WI.JPG', 8, 'Aktif', 0, 0, 1, '2025-11-05 23:45:30', '2025-11-10 20:19:52'),
(46, 'upacara bendera', NULL, 'fotos/1762831211_UV8Nd1BJhf.JPG', 8, 'Aktif', 0, 0, 1, '2025-11-05 23:46:24', '2025-11-10 20:20:11'),
(48, 'upacara', NULL, 'fotos/1762831947_G371QouZaL.JPG', 8, 'Aktif', 0, 0, 16, '2025-11-10 20:32:28', '2025-11-10 20:32:28'),
(49, 'upacara 17 agustus', NULL, 'fotos/1762832328_01DXe1c9IP.JPG', 8, 'Aktif', 0, 0, 16, '2025-11-10 20:38:48', '2025-11-10 20:38:48'),
(50, 'lomba rebut kursi', NULL, 'fotos/1762833201_entotOnURr.JPG', 1, 'Aktif', 0, 0, 16, '2025-11-10 20:53:21', '2025-11-10 20:53:21'),
(51, 'lomba rebut kursi', NULL, 'fotos/1762833249_kguGiCBV7V.JPG', 1, 'Aktif', 0, 0, 16, '2025-11-10 20:54:09', '2025-11-10 20:54:09'),
(52, 'lomba bola tali', NULL, 'fotos/1762833417_1G6SsKNbod.JPG', 1, 'Aktif', 0, 0, 16, '2025-11-10 20:56:57', '2025-11-10 20:56:57'),
(53, 'lomba bola tali', NULL, 'fotos/1762833574_TeisrmwlsZ.JPG', 1, 'Aktif', 0, 0, 16, '2025-11-10 20:59:34', '2025-11-10 20:59:34'),
(54, 'lomba bola tali', NULL, 'fotos/1762833713_keUUeKeWKW.JPG', 1, 'Aktif', 0, 0, 16, '2025-11-10 21:01:53', '2025-11-10 21:01:53'),
(55, 'lomba tarik tambang', NULL, 'fotos/1762833872_vZLHYKuEo2.JPG', 1, 'Aktif', 0, 0, 16, '2025-11-10 21:04:32', '2025-11-10 21:04:32'),
(56, 'lomba tarik tambang', NULL, 'fotos/1762833903_CoHUoqZtSW.JPG', 1, 'Aktif', 0, 0, 16, '2025-11-10 21:05:03', '2025-11-10 21:05:03'),
(57, 'montour', NULL, 'fotos/1762834370_1qna5wjPqe.JPG', 4, 'Aktif', 0, 0, 16, '2025-11-10 21:12:50', '2025-11-12 18:28:32'),
(58, 'random', NULL, 'fotos/1762834522_6eSsEB5nU3.JPG', 4, 'Aktif', 0, 0, 16, '2025-11-10 21:15:22', '2025-11-10 21:15:22'),
(59, 'random', NULL, 'fotos/1762834768_qvxphIn753.JPG', 4, 'Aktif', 0, 0, 16, '2025-11-10 21:19:29', '2025-11-10 21:19:29'),
(60, 'montour', NULL, 'fotos/1762834863_StAo80XZUW.JPG', 4, 'Aktif', 0, 0, 16, '2025-11-10 21:21:03', '2025-11-10 21:21:03'),
(61, 'montour', NULL, 'fotos/1762834999_x8bw099srr.JPG', 4, 'Aktif', 0, 0, 16, '2025-11-10 21:23:19', '2025-11-10 21:23:19'),
(62, 'membersihkan halaman sekolah', NULL, 'fotos/1762874957_BNevyoFcPh.JPG', 3, 'Aktif', 0, 0, 1, '2025-11-11 08:29:17', '2025-11-11 08:29:17'),
(63, 'menaman tanaman', NULL, 'fotos/1762875241_M2rZKYoiBn.JPG', 3, 'Aktif', 0, 0, 1, '2025-11-11 08:34:01', '2025-11-11 08:34:01'),
(64, 'membersihkan halaman sekolah', NULL, 'fotos/1762880013_I5DaN5c0Fj.JPG', 3, 'Aktif', 0, 0, 15, '2025-11-11 09:53:33', '2025-11-11 09:53:33'),
(65, 'membuang sampah', NULL, 'fotos/1762880085_RlK4rWDBg5.JPG', 3, 'Aktif', 0, 0, 15, '2025-11-11 09:54:45', '2025-11-11 09:54:45'),
(66, 'p5 senam sehat', NULL, 'fotos/1762880142_1piHmEUyim.JPG', 3, 'Aktif', 0, 0, 15, '2025-11-11 09:55:42', '2025-11-11 09:55:42'),
(67, 'p5 senam sehat', NULL, 'fotos/1762880356_lduD7iN32x.JPG', 3, 'Aktif', 0, 0, 15, '2025-11-11 09:59:16', '2025-11-11 09:59:16'),
(68, 'p5 senam sehat', NULL, 'fotos/1762880421_lThvT1k2zF.JPG', 3, 'Aktif', 0, 0, 15, '2025-11-11 10:00:21', '2025-11-11 10:00:21'),
(69, 'meraih juara 2 technoupdate x himpact 2025', NULL, 'fotos/1762880799_7afKCrK85j.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:06:39', '2025-11-11 10:06:39'),
(70, 'tim voli putra yang berhasil meraih juara 3 se-bogor raya.', NULL, 'fotos/1762880882_wCawOlCoid.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:08:02', '2025-11-11 10:08:02'),
(71, 'raih juara 3 bogor innovation award 2025 bidang teknologi informasi dan komunikasi', NULL, 'fotos/1762880976_91crS4981j.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:09:36', '2025-11-11 10:09:36'),
(72, 'raih juara 1 the ace 2025 ui/ux competition universitas diponogoro', NULL, 'fotos/1762881050_AAu1MO1ges.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:10:50', '2025-11-11 10:10:50'),
(73, 'raih di kejuaraan pekan olahraga pelajar daerah (popda jabar )', NULL, 'fotos/1762881152_c6JilhMyWR.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:12:32', '2025-11-11 10:12:32'),
(74, 'raih di kejuaraan pekan olahraga pelajar daerah (popda jabar )', NULL, 'fotos/1762881203_vsrZVKNHea.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:13:24', '2025-11-11 10:13:24'),
(75, 'raih di kejuaraan ibing pencak walikota bogor cup', NULL, 'fotos/1762881331_D8XVP6yYKf.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:15:31', '2025-11-11 10:15:31'),
(76, 'raih di kejuaraan ibing pencak walikota bogor cup', NULL, 'fotos/1762881398_IMeeUEW3Us.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:16:38', '2025-11-11 10:16:38'),
(77, 'raih di kejuaraan nasional judo pelajar smp-sma tahun 2025', NULL, 'fotos/1762881462_8FMfypyJnI.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:17:42', '2025-11-11 10:17:42'),
(78, 'pemberian penghargaan kepada murid berprestasi', NULL, 'fotos/1762881535_HOj3ZjnSVl.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:18:55', '2025-11-11 10:18:55'),
(79, 'raih di ui/ux design competition iofest 2025 universitas tarumanegara', NULL, 'fotos/1762881593_cI89UVZxYa.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:19:53', '2025-11-11 10:19:53'),
(80, 'raih di festival pelajar unggulan conference di kemenpora ri', NULL, 'fotos/1762881637_6adz8HV0xx.png', 5, 'Aktif', 0, 0, 15, '2025-11-11 10:20:37', '2025-11-11 10:20:37'),
(81, 'kegiatan demos ekstrakurikuler rohis', NULL, 'fotos/1762881986_c6IVKD7nWa.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:26:26', '2025-11-11 10:26:26'),
(82, 'kegiatan demos ekstrakurikuler rohis', NULL, 'fotos/1762882000_QWJyC5V5EN.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:26:40', '2025-11-11 10:26:40'),
(83, 'kegiatan demos ekstrakurikuler pramuka', NULL, 'fotos/1762882020_x4hlcxFU5E.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:27:00', '2025-11-11 10:27:00'),
(84, 'kegiatan demos ekstrakurikuler pramuka', NULL, 'fotos/1762882036_mRUPH1PQe8.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:27:16', '2025-11-11 10:27:16'),
(85, 'kegiatan demos ekstrakurikuler basket', NULL, 'fotos/1762882053_LyDijTDVsI.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:27:33', '2025-11-11 10:27:33'),
(86, 'kegiatan demos ekstrakurikuler futsal', NULL, 'fotos/1762882069_QLTMG98AeS.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:27:49', '2025-11-11 10:27:49'),
(87, 'kegiatan demos ekstrakurikuler futsal', NULL, 'fotos/1762882094_fi8dmsXrsJ.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:28:14', '2025-11-11 10:28:14'),
(88, 'kegiatan demos ekstrakurikuler pmr', NULL, 'fotos/1762882111_62EkrTkA1N.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:28:32', '2025-11-11 10:28:32'),
(89, 'kegiatan demos ekstrakurikuler pmr', NULL, 'fotos/1762882168_lvUGN7fwkp.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:29:28', '2025-11-11 10:29:28'),
(90, 'kegiatan demos ekstrakurikuler band', NULL, 'fotos/1762882186_9BZFFbtDeV.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:29:46', '2025-11-11 10:29:46'),
(91, 'kegiatan demos ekstrakurikuler band', NULL, 'fotos/1762882200_jlVaDI2XUh.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:30:00', '2025-11-11 10:30:00'),
(92, 'kegiatan demos ekstrakurikuler paduan suara x tari', NULL, 'fotos/1762882229_3YFSuptoyZ.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:30:29', '2025-11-11 10:30:29'),
(93, 'kegiatan demos ekstrakurikuler pencak silat', NULL, 'fotos/1762882248_xbgGDkkDyb.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:30:48', '2025-11-11 10:30:48'),
(94, 'kegiatan demos ekstrakurikuler paskibra', NULL, 'fotos/1762882268_Wy0wFBhalE.png', 10, 'Aktif', 0, 0, 15, '2025-11-11 10:31:08', '2025-11-11 10:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `foto_comments`
--

CREATE TABLE `foto_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foto_comments`
--

INSERT INTO `foto_comments` (`id`, `foto_id`, `user_id`, `author_name`, `content`, `status`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 7, NULL, 'syifa', 'kerennn ih', 'approved', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-21 00:42:09', '2025-10-21 00:42:33'),
(2, 10, NULL, 'nwug', 'mxsbcsG', 'rejected', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-21 01:14:36', '2025-10-21 01:14:50'),
(3, 6, NULL, 'Syifa', 'dbsajdvusa', 'approved', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-21 01:47:03', '2025-10-21 01:47:34'),
(5, 6, NULL, 'Test', 'Test comment', 'pending', '127.0.0.1', 'Test Agent', '2025-10-21 21:09:50', '2025-10-21 21:09:50'),
(6, 16, NULL, 'syaaa', 'alhamdulillallh', 'approved', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-21 21:15:01', '2025-10-21 21:15:29'),
(7, 6, NULL, 'Test User', 'Ini adalah komentar test untuk memastikan sistem berfungsi dengan baik.', 'approved', '127.0.0.1', 'Test Agent', '2025-10-21 21:42:52', '2025-10-21 21:42:52'),
(8, 7, NULL, 'Admin Test', 'Komentar test untuk foto ID 7', 'approved', '127.0.0.1', 'Test Agent', '2025-10-21 21:49:22', '2025-10-21 21:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `foto_likes`
--

CREATE TABLE `foto_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foto_likes`
--

INSERT INTO `foto_likes` (`id`, `foto_id`, `user_id`, `ip_address`, `session_id`, `created_at`, `updated_at`) VALUES
(15, 7, NULL, '127.0.0.1', 'D823PeO22YmU3t8GXVRSQTrz7m6K0XzWvXc7m3Ux', '2025-10-21 20:51:33', '2025-10-21 20:51:33'),
(18, 9, NULL, '127.0.0.1', 'D823PeO22YmU3t8GXVRSQTrz7m6K0XzWvXc7m3Ux', '2025-10-21 20:51:44', '2025-10-21 20:51:44'),
(19, 16, NULL, '127.0.0.1', 'D823PeO22YmU3t8GXVRSQTrz7m6K0XzWvXc7m3Ux', '2025-10-21 21:02:09', '2025-10-21 21:02:09'),
(21, 19, 14, '127.0.0.1', NULL, '2025-10-26 03:48:41', '2025-10-26 03:48:41'),
(22, 17, 14, '127.0.0.1', NULL, '2025-10-26 03:48:48', '2025-10-26 03:48:48'),
(24, 18, 14, '127.0.0.1', NULL, '2025-10-26 03:49:15', '2025-10-26 03:49:15'),
(34, 16, 14, '127.0.0.1', NULL, '2025-10-26 04:08:55', '2025-10-26 04:08:55'),
(35, 7, 14, '127.0.0.1', NULL, '2025-10-26 04:09:22', '2025-10-26 04:09:22'),
(36, 6, 14, '127.0.0.1', NULL, '2025-10-26 04:09:26', '2025-10-26 04:09:26'),
(37, 10, 14, '127.0.0.1', NULL, '2025-10-26 04:10:03', '2025-10-26 04:10:03'),
(38, 26, 14, '127.0.0.1', NULL, '2025-10-26 05:39:07', '2025-10-26 05:39:07'),
(39, 24, 14, '127.0.0.1', NULL, '2025-10-26 05:39:19', '2025-10-26 05:39:19'),
(40, 35, 14, '127.0.0.1', NULL, '2025-10-26 06:09:24', '2025-10-26 06:09:24'),
(41, 37, 14, '127.0.0.1', NULL, '2025-11-05 20:18:04', '2025-11-05 20:18:04'),
(42, 38, 14, '127.0.0.1', NULL, '2025-11-05 20:18:25', '2025-11-05 20:18:25'),
(43, 38, 13, '127.0.0.1', NULL, '2025-11-05 21:34:32', '2025-11-05 21:34:32'),
(44, 35, 13, '127.0.0.1', NULL, '2025-11-05 21:34:37', '2025-11-05 21:34:37'),
(46, 31, 13, '127.0.0.1', NULL, '2025-11-05 21:34:49', '2025-11-05 21:34:49'),
(47, 16, 13, '127.0.0.1', NULL, '2025-11-05 21:35:15', '2025-11-05 21:35:15'),
(48, 44, 15, '127.0.0.1', NULL, '2025-11-06 00:10:54', '2025-11-06 00:10:54'),
(49, 46, 15, '127.0.0.1', NULL, '2025-11-06 00:10:58', '2025-11-06 00:10:58'),
(50, 42, 15, '127.0.0.1', NULL, '2025-11-06 00:11:05', '2025-11-06 00:11:05'),
(51, 43, 15, '127.0.0.1', NULL, '2025-11-06 00:11:08', '2025-11-06 00:11:08'),
(52, 36, 15, '127.0.0.1', NULL, '2025-11-06 00:11:25', '2025-11-06 00:11:25'),
(53, 18, 16, '127.0.0.1', NULL, '2025-11-10 19:49:51', '2025-11-10 19:49:51'),
(55, 78, 15, '127.0.0.1', NULL, '2025-11-11 10:20:55', '2025-11-11 10:20:55'),
(56, 79, 15, '127.0.0.1', NULL, '2025-11-11 10:20:57', '2025-11-11 10:20:57'),
(57, 80, 15, '127.0.0.1', NULL, '2025-11-11 10:20:59', '2025-11-11 10:20:59'),
(58, 76, 15, '127.0.0.1', NULL, '2025-11-11 10:21:01', '2025-11-11 10:21:01'),
(59, 75, 15, '127.0.0.1', NULL, '2025-11-11 10:21:03', '2025-11-11 10:21:03'),
(60, 74, 15, '127.0.0.1', NULL, '2025-11-11 10:21:05', '2025-11-11 10:21:05'),
(61, 83, 15, '127.0.0.1', NULL, '2025-11-11 10:31:42', '2025-11-11 10:31:42'),
(62, 93, 15, '127.0.0.1', NULL, '2025-11-11 10:41:34', '2025-11-11 10:41:34'),
(63, 89, 15, '127.0.0.1', NULL, '2025-11-11 10:41:43', '2025-11-11 10:41:43'),
(64, 82, 15, '127.0.0.1', NULL, '2025-11-11 10:42:02', '2025-11-11 10:42:02'),
(69, 94, 15, '127.0.0.1', NULL, '2025-11-12 02:11:32', '2025-11-12 02:11:32'),
(70, 57, 15, '127.0.0.1', NULL, '2025-11-12 02:11:54', '2025-11-12 02:11:54'),
(71, 57, 14, '127.0.0.1', NULL, '2025-11-12 02:13:59', '2025-11-12 02:13:59'),
(74, 93, 17, '127.0.0.1', NULL, '2025-11-12 03:02:43', '2025-11-12 03:02:43'),
(75, 91, 17, '127.0.0.1', NULL, '2025-11-12 03:02:47', '2025-11-12 03:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE `galery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'kegiatan',
  `uploaded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `description`, `image_path`, `category`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(2, 'Upacara Bendera Senin', 'Upacara bendera rutin setiap hari Senin dengan seluruh siswa dan guru', 'gallery/upacara-senin.jpg', 'kegiatan', NULL, '2025-10-21 22:23:22', '2025-10-21 22:23:22'),
(3, 'Test Gallery', 'Test description', 'test.jpg', 'kegiatan', NULL, '2025-10-21 22:23:59', '2025-10-21 22:23:59'),
(4, 'Upacara Bendera Senin', 'Upacara bendera rutin setiap hari Senin dengan seluruh siswa dan guru', 'gallery/upacara-senin.jpg', 'kegiatan', NULL, '2025-10-21 22:25:14', '2025-10-21 22:25:14'),
(5, 'Juara 1 Lomba Matematika', 'Siswa kami meraih juara 1 dalam lomba matematika tingkat kabupaten', 'gallery/juara-matematika.jpg', 'prestasi', NULL, '2025-10-21 22:25:14', '2025-10-21 22:25:14'),
(6, 'Proyek P5 Lingkungan', 'Proyek Penguatan Profil Pelajar Pancasila tentang pelestarian lingkungan', 'gallery/p5-lingkungan.jpg', 'p5', NULL, '2025-10-21 22:25:14', '2025-10-21 22:25:14'),
(7, 'Kegiatan Olahraga', 'Kegiatan olahraga rutin siswa di lapangan sekolah', 'gallery/olahraga.jpg', 'kegiatan', NULL, '2025-10-21 22:25:14', '2025-10-21 22:25:14'),
(8, 'Juara 2 Basket Putra', 'Tim basket putra meraih juara 2 dalam turnamen antar sekolah', 'gallery/juara-basket.jpg', 'prestasi', NULL, '2025-10-21 22:25:14', '2025-10-21 22:25:14'),
(9, 'P5 Kewirausahaan', 'Proyek P5 tentang kewirausahaan dan ekonomi kreatif', 'gallery/p5-kewirausahaan.jpg', 'p5', NULL, '2025-10-21 22:25:14', '2025-10-21 22:25:14'),
(10, 'Kegiatan Pramuka', 'Kegiatan ekstrakurikuler pramuka setiap hari Jumat', 'gallery/pramuka.jpg', 'kegiatan', NULL, '2025-10-21 22:25:14', '2025-10-21 22:25:14'),
(11, 'Juara 3 Debat Bahasa Inggris', 'Siswa kami meraih juara 3 dalam lomba debat bahasa Inggris', 'gallery/juara-debat.jpg', 'prestasi', NULL, '2025-10-21 22:25:14', '2025-10-21 22:25:14'),
(12, 'P5 Kebhinekaan', 'Proyek P5 tentang kebhinekaan dan toleransi', 'gallery/p5-kebhinekaan.jpg', 'p5', NULL, '2025-10-21 22:25:14', '2025-10-21 22:25:14'),
(13, 'Upacara Bendera Senin', 'Upacara bendera rutin setiap hari Senin di lapangan sekolah', 'gallery/upacara-senin.jpg', 'kegiatan', NULL, '2025-10-21 23:27:17', '2025-10-21 23:27:17'),
(14, 'Kegiatan Olahraga', 'Kegiatan olahraga rutin siswa di lapangan sekolah', 'gallery/olahraga.jpg', 'kegiatan', NULL, '2025-10-21 23:27:17', '2025-10-21 23:27:17'),
(15, 'Kegiatan Pramuka', 'Kegiatan ekstrakurikuler pramuka setiap hari Sabtu', 'gallery/pramuka.jpg', 'kegiatan', NULL, '2025-10-21 23:27:17', '2025-10-21 23:27:17'),
(16, 'Kegiatan Ekstrakurikuler', 'Berbagai kegiatan ekstrakurikuler yang diikuti siswa', 'gallery/ekstrakurikuler.jpg', 'kegiatan', NULL, '2025-10-21 23:27:17', '2025-10-21 23:27:17'),
(17, 'Juara 1 Lomba Matematika', 'Siswa berhasil meraih juara 1 lomba matematika tingkat kabupaten', 'gallery/juara-matematika.jpg', 'prestasi', NULL, '2025-10-21 23:27:17', '2025-10-21 23:27:17'),
(18, 'Juara 2 Basket Putra', 'Tim basket putra meraih juara 2 turnamen antar sekolah', 'gallery/juara-basket.jpg', 'prestasi', NULL, '2025-10-21 23:27:17', '2025-10-21 23:27:17'),
(19, 'Juara 3 Debat Bahasa Inggris', 'Tim debat bahasa Inggris meraih juara 3 tingkat provinsi', 'gallery/juara-debat.jpg', 'prestasi', NULL, '2025-10-21 23:27:17', '2025-10-21 23:27:17'),
(20, 'Prestasi Siswa', 'Berbagai prestasi yang diraih siswa di berbagai bidang', 'gallery/prestasi-siswa.jpg', 'prestasi', NULL, '2025-10-21 23:27:17', '2025-10-21 23:27:17'),
(21, 'Proyek P5 Lingkungan', 'Proyek Penguatan Profil Pelajar Pancasila tentang lingkungan', 'gallery/p5-lingkungan.jpg', 'p5', NULL, '2025-10-21 23:27:17', '2025-10-21 23:27:17'),
(22, 'P5 Kewirausahaan', 'Proyek P5 tentang kewirausahaan dan ekonomi kreatif', 'gallery/p5-kewirausahaan.jpg', 'p5', NULL, '2025-10-21 23:27:17', '2025-10-21 23:27:17'),
(23, 'P5 Kebhinekaan', 'Proyek P5 tentang kebhinekaan dan toleransi', 'gallery/p5-kebhinekaan.jpg', 'p5', NULL, '2025-10-21 23:27:17', '2025-10-21 23:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_comments`
--

CREATE TABLE `gallery_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_downloads`
--

CREATE TABLE `gallery_downloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_items`
--

CREATE TABLE `gallery_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_likes`
--

CREATE TABLE `gallery_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `type` enum('like','dislike') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `konten` longtext NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL DEFAULT 'Aktif',
  `tanggal_posting` date NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id`, `judul`, `deskripsi`, `konten`, `gambar`, `status`, `tanggal_posting`, `admin_id`, `created_at`, `updated_at`) VALUES
(2, 'Penerimaan Peserta Didik Baru (PPDB) 2026', 'Pendaftaran Peserta Didik Baru (PPDB) SMKN 4 Bogor tahun ajaran 2026/2027 akan dibuka mulai 10 Juni 2026. Proses pendaftaran dilakukan secara online melalui website resmi sekolah dengan panduan lengkap yang dapat diakses oleh calon siswa dan orang tua.', 'Pendaftaran Peserta Didik Baru (PPDB) SMKN 4 Bogor tahun ajaran 2026/2027 akan dibuka mulai 10 Juni 2026. Proses pendaftaran dilakukan secara online melalui website resmi sekolah dengan panduan lengkap yang dapat diakses oleh calon siswa dan orang tua.', NULL, 'Aktif', '2025-11-11', 1, '2025-11-10 22:45:53', '2025-11-11 07:27:56'),
(3, 'Kunjungan Industri Jurusan RPL dan TKJ', 'Siswa jurusan Rekayasa Perangkat Lunak dan Teknik Komputer Jaringan akan melaksanakan kunjungan industri ke PT Telkom Indonesia pada tanggal 20 November 2025.', 'Siswa jurusan Rekayasa Perangkat Lunak dan Teknik Komputer Jaringan akan melaksanakan kunjungan industri ke PT Telkom Indonesia pada tanggal 20 November 2025.', NULL, 'Aktif', '2025-11-11', 1, '2025-11-10 22:46:32', '2025-11-10 22:46:32'),
(4, 'Upacara Hari Guru Nasional', 'Upacara peringatan Hari Guru Nasional akan dilaksanakan pada 25 November 2025 di lapangan utama sekolah. Siswa diharapkan mengenakan seragam lengkap dan hadir tepat waktu. Upacara ini menjadi bentuk penghormatan atas dedikasi para guru dalam mencerdaskan generasi bangsa.', 'Upacara peringatan Hari Guru Nasional akan dilaksanakan pada 25 November 2025 di lapangan utama sekolah. Siswa diharapkan mengenakan seragam lengkap dan hadir tepat waktu. Upacara ini menjadi bentuk penghormatan atas dedikasi para guru dalam mencerdaskan generasi bangsa.', NULL, 'Aktif', '2025-11-11', 1, '2025-11-10 22:47:03', '2025-11-11 07:28:39'),
(5, 'Workshop Kewirausahaan', 'SMKN 4 Bogor akan mengadakan workshop kewirausahaan pada tanggal 16 November 2025 di aula sekolah. Workshop ini menghadirkan pembicara dari pelaku usaha kreatif Kota Bogor yang akan berbagi pengalaman tentang membangun bisnis dari nol. Siswa diharapkan mengikuti kegiatan ini untuk menumbuhkan jiwa wirausaha sejak dini.', 'SMKN 4 Bogor akan mengadakan workshop kewirausahaan pada tanggal 16 November 2025 di aula sekolah. Workshop ini menghadirkan pembicara dari pelaku usaha kreatif Kota Bogor yang akan berbagi pengalaman tentang membangun bisnis dari nol. Siswa diharapkan mengikuti kegiatan ini untuk menumbuhkan jiwa wirausaha sejak dini.', NULL, 'Aktif', '2025-11-11', 15, '2025-11-10 22:48:28', '2025-11-11 10:34:43'),
(6, 'Lomba Kebersihan Kelas', 'Dalam rangka meningkatkan kesadaran akan pentingnya kebersihan lingkungan sekolah, SMKN 4 Bogor mengadakan lomba kebersihan dan keindahan kelas mulai 18 November 2025. Setiap kelas akan dinilai berdasarkan kerapian, kebersihan, dan kreativitas dalam mendekorasi ruang belajar.', 'Dalam rangka meningkatkan kesadaran akan pentingnya kebersihan lingkungan sekolah, SMKN 4 Bogor mengadakan lomba kebersihan dan keindahan kelas mulai 18 November 2025. Setiap kelas akan dinilai berdasarkan kerapian, kebersihan, dan kreativitas dalam mendekorasi ruang belajar.', NULL, 'Nonaktif', '2025-11-11', 1, '2025-11-10 22:48:59', '2025-11-11 07:30:29'),
(7, 'Pengumuman Kelulusan Kelas XII', 'Pengumuman kelulusan untuk siswa kelas XII tahun pelajaran 2025/2026 akan diumumkan pada 3 Mei 2026 melalui website resmi sekolah. Siswa diimbau untuk tidak melakukan konvoi di jalan raya dan tetap menjaga nama baik sekolah dengan merayakan kelulusan secara positif.', 'Pengumuman kelulusan untuk siswa kelas XII tahun pelajaran 2025/2026 akan diumumkan pada 3 Mei 2026 melalui website resmi sekolah. Siswa diimbau untuk tidak melakukan konvoi di jalan raya dan tetap menjaga nama baik sekolah dengan merayakan kelulusan secara positif.', NULL, 'Aktif', '2025-11-11', 1, '2025-11-11 10:32:55', '2025-11-11 10:32:55'),
(8, 'Pengumuman Kelulusan Kelas XII', 'Pengumuman kelulusan untuk siswa kelas XII tahun pelajaran 2025/2026 akan diumumkan pada 3 Mei 2026 melalui website resmi sekolah. Siswa diimbau untuk tidak melakukan konvoi di jalan raya dan tetap menjaga nama baik sekolah dengan merayakan kelulusan secara positif.', 'Pengumuman kelulusan untuk siswa kelas XII tahun pelajaran 2025/2026 akan diumumkan pada 3 Mei 2026 melalui website resmi sekolah. Siswa diimbau untuk tidak melakukan konvoi di jalan raya dan tetap menjaga nama baik sekolah dengan merayakan kelulusan secara positif.', NULL, 'Aktif', '2025-11-11', 1, '2025-11-11 10:32:56', '2025-11-11 10:32:56'),
(9, 'Libur Semester Ganjil', 'Libur semester ganjil dimulai dari 21 Desember 2025 hingga 4 Januari 2026. Seluruh siswa diharapkan tetap menjaga kesehatan, memanfaatkan waktu libur dengan kegiatan positif, dan kembali ke sekolah dengan semangat baru pada awal semester genap.', 'Libur semester ganjil dimulai dari 21 Desember 2025 hingga 4 Januari 2026. Seluruh siswa diharapkan tetap menjaga kesehatan, memanfaatkan waktu libur dengan kegiatan positif, dan kembali ke sekolah dengan semangat baru pada awal semester genap.', NULL, 'Aktif', '2025-11-11', 1, '2025-11-11 10:33:22', '2025-11-11 10:33:22'),
(10, 'Pembagian Raport Semester Ganjil', 'Pembagian raport hasil belajar semester ganjil akan dilaksanakan pada 20 Desember 2025. Orang tua atau wali murid diharapkan hadir untuk menerima laporan hasil belajar siswa secara langsung dan berdiskusi dengan wali kelas mengenai perkembangan akademik anak.', 'Pembagian raport hasil belajar semester ganjil akan dilaksanakan pada 20 Desember 2025. Orang tua atau wali murid diharapkan hadir untuk menerima laporan hasil belajar siswa secara langsung dan berdiskusi dengan wali kelas mengenai perkembangan akademik anak.', NULL, 'Aktif', '2025-11-11', 1, '2025-11-11 10:33:55', '2025-11-11 10:33:55'),
(11, 'Class Meeting Semester Ganjil', 'Setelah pelaksanaan ujian semester ganjil, SMKN 4 Bogor akan mengadakan kegiatan Class Meeting pada 12–14 Desember 2025. Kegiatan ini berisi berbagai lomba olahraga, seni, dan keterampilan yang bertujuan mempererat kebersamaan antar siswa sekaligus menjadi ajang hiburan setelah ujian.', 'Setelah pelaksanaan ujian semester ganjil, SMKN 4 Bogor akan mengadakan kegiatan Class Meeting pada 12–14 Desember 2025. Kegiatan ini berisi berbagai lomba olahraga, seni, dan keterampilan yang bertujuan mempererat kebersamaan antar siswa sekaligus menjadi ajang hiburan setelah ujian.', NULL, 'Aktif', '2025-11-11', 1, '2025-11-11 10:34:23', '2025-11-11 10:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'lomba kemerdekaan', 'Kegiatan lomba dalam rangka kemerdekaan RI', 'Aktif', '2025-10-19 18:53:33', '2025-10-19 18:53:33'),
(2, 'classmeet', 'Kegiatan classmeet antar kelas', 'Aktif', '2025-10-19 18:53:33', '2025-10-19 18:53:33'),
(3, 'p5', 'Proyek Penguatan Profil Pelajar Pancasila', 'Aktif', '2025-10-19 18:53:33', '2025-10-19 18:53:33'),
(4, 'montour', 'Kegiatan study tour dan kunjungan', 'Aktif', '2025-10-19 18:53:33', '2025-11-12 18:39:47'),
(5, 'prestasi kejuaraan', 'Pentas seni dan budaya sekolah', 'Aktif', '2025-10-19 18:53:33', '2025-11-11 10:02:58'),
(8, 'upacara', 'Kategori umum lainnya', 'Aktif', '2025-10-19 18:53:33', '2025-11-05 23:45:00'),
(9, 'transforkrab', NULL, 'Aktif', '2025-10-26 06:07:22', '2025-10-26 06:07:22'),
(10, 'ekstrakulikuler', NULL, 'Aktif', '2025-11-11 10:21:44', '2025-11-12 19:21:44'),
(12, 'random', NULL, 'Aktif', '2025-11-12 21:25:40', '2025-11-12 21:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_15_100001_create_gallery_items_table', 1),
(5, '2025_01_15_100002_create_gallery_likes_table', 1),
(6, '2025_01_15_100003_create_gallery_comments_table', 1),
(7, '2025_01_15_100004_create_gallery_downloads_table', 1),
(8, '2025_08_26_000100_create_kategori_table', 1),
(9, '2025_08_26_000110_create_petugas_table', 1),
(10, '2025_08_26_000120_create_posts_table', 1),
(11, '2025_08_26_000130_create_profile_table', 1),
(12, '2025_08_26_000140_create_galery_table', 1),
(13, '2025_08_26_000150_create_foto_table', 1),
(14, '2025_08_28_021320_add_columns_to_kategori_table', 1),
(15, '2025_08_28_021443_add_timestamps_to_kategori_table', 1),
(16, '2025_08_28_023402_recreate_foto_table_for_gallery', 1),
(17, '2025_08_29_000002_add_missing_columns_to_posts', 1),
(18, '2025_08_29_012521_create_informasi_table', 1),
(19, '2025_09_09_020238_add_timestamps_to_petugas_table', 1),
(20, '2025_10_07_120000_add_reactions_to_foto_table', 1),
(21, '2025_10_07_120100_create_foto_comments_table', 1),
(22, '2025_10_07_130000_add_status_to_foto_comments_table', 1),
(23, '2025_10_09_031518_add_username_and_status_to_users_table', 1),
(24, '2025_10_09_034355_create_foto_likes_table', 1),
(25, '2025_10_20_012524_add_ip_session_to_foto_likes_table', 2),
(26, '2024_01_01_000001_create_galleries_table', 3),
(27, '2024_01_24_000000_add_otp_and_active_to_users_table', 4),
(28, '2025_10_24_000000_fix_agendas_table_structure', 5),
(29, '2025_10_26_110558_fix_foto_likes_constraints', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin123', '2025-10-20 19:00:34', '2025-11-12 18:27:03'),
(2, 'petugas1', 'password123', '2025-10-20 19:00:34', '2025-10-20 19:00:34'),
(4, 'operator', 'operator123', '2025-10-20 19:00:34', '2025-10-20 19:00:34'),
(6, 'syifa', 'syifa123', '2025-11-12 01:06:35', '2025-11-12 02:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `isi` text NOT NULL,
  `petugas_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1BVaxDtZ0HIphi3WX4jWJSkBL0soPdleb407pkWq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaVRReFRsNlluOUl4RFVFRUJ4d2ZrYjVzZ1pIc2RPaEVRZDU2S0NuQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo4OiJhZG1pbl9pZCI7aToxO3M6MTQ6ImFkbWluX3VzZXJuYW1lIjtzOjU6ImFkbWluIjt9', 1763008091);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `otp_code`, `otp_expires_at`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@smkn4bogor.sch.id', NULL, '$2y$12$8NLn9HddL7G7TQgiSbxJIekBZZfyQketefUjphBY70dK4C/MjXkXC', NULL, NULL, 0, NULL, '2025-10-22 21:31:50', '2025-10-22 21:31:50'),
(5, 'vidania', 'pipismonyet@gmail.com', NULL, '$2y$12$KuueC5mcvrU/utZF8Nz/P.hhCNOtV6LEXbv0/H6ifwtrhHg4bz/BK', '268103', '2025-10-23 21:17:51', 0, NULL, '2025-10-23 21:07:51', '2025-10-23 21:07:51'),
(6, 'syifamei', 'vydaartlab@gmail.com', NULL, '$2y$12$E5djWdrAA3URJIHCprRIXuq4OXFHakPhjpJxQtsAMLdyXscrjJpyq', '341178', '2025-10-23 21:20:14', 0, NULL, '2025-10-23 21:10:14', '2025-10-23 21:10:14'),
(7, 'vidania', 'cursor.0101.0101@gmail.com', NULL, '$2y$12$yoZO8GGV7Py4eccYZ6ktMerT2qVsWCPVRnt0sCxyjJ1SZhcsWCXe2', '613943', '2025-10-23 21:31:46', 0, NULL, '2025-10-23 21:21:46', '2025-10-23 21:21:46'),
(8, 'Vidania', 'jofulpaint@gmail.com', NULL, '$2y$12$JZ2vYzsY1Yd2MfHefTYjLOpiW3oRQoyKYwNhNmwlJ4hQP0DvLk3V2', '505334', '2025-10-23 21:54:10', 0, NULL, '2025-10-23 21:32:14', '2025-10-23 21:44:10'),
(9, 'Vidania', 'vidaniaalifa@gmail.com', NULL, '$2y$12$R0CvIoVBrTE8JEdTfXNzku5.BCaXqibeYLt0SiSP5u6fcCSrX3Y1S', NULL, NULL, 1, NULL, '2025-10-23 22:25:55', '2025-10-23 22:25:55'),
(10, 'Syaifatul', 'cipameii6@gmail.com', NULL, '$2y$12$oRs81V42PCNvv6Yn5XF5aOpYQoZEXiPitw9y1YMK44mejuql1plRC', NULL, NULL, 1, NULL, '2025-10-23 22:45:55', '2025-10-23 22:45:55'),
(11, 'Alfira', 'ssyifamei@gmail.com', NULL, '$2y$12$H28pD5uxTy/KSQEo9DP95eznZ23Hg0O99UCbJAILRTKHrOME0ofDi', NULL, NULL, 1, NULL, '2025-10-23 23:17:58', '2025-10-23 23:17:58'),
(12, 'Sumarti', 'memeilani1405@gmail.com', NULL, '$2y$12$zhE.vcUxUzrayF4qZ2wCCul7YE3.G5VHn3ztyF2XdR/SqiyDDQkIC', NULL, NULL, 1, NULL, '2025-10-24 04:33:21', '2025-10-24 04:33:21'),
(13, 'Arya', 'dikdik@gmail.com', NULL, '$2y$12$VesbZvbXN9FPjJdWT/UUbu5eiqG8I5tSxiabhVqy6qbrmY/bW3fjO', NULL, NULL, 1, NULL, '2025-10-24 07:26:23', '2025-10-24 07:26:23'),
(14, 'Berlian', 'sxoprint@gmail.com', NULL, '$2y$12$SnHgEG7krggPeADOhMpyfuuBkswhGg7z5ukjAMZBimRNgwHAJVgaO', NULL, NULL, 1, NULL, '2025-10-26 03:46:41', '2025-10-26 03:46:41'),
(15, 'syifamei', 'meiisyifa6@gmail.com', NULL, '$2y$12$YIHXWftD2cJuKbU0oXM7I.ahtHlCaKR.ymBIQT9wqqsVeReF5hT6y', NULL, NULL, 1, NULL, '2025-11-06 00:10:36', '2025-11-06 00:10:36'),
(16, 'alfira', 'alfirasaskia@gmail.com', NULL, '$2y$12$ScJCr4oJp4ifBMNnwuXxeujiz8D2MRD.sFW19eHrDFk3b2ipfvZZK', NULL, NULL, 1, NULL, '2025-11-10 19:49:02', '2025-11-10 19:49:02'),
(17, 'syifa', 'syifameilani@gmail.com', NULL, '$2y$12$P9lMrSPMUgIqUY8uDElm8udjomr5INWHvSUO/wMNkVuENXko3pXQG', NULL, NULL, 1, NULL, '2025-11-12 03:02:16', '2025-11-12 03:02:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `download_logs`
--
ALTER TABLE `download_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `download_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto_comments`
--
ALTER TABLE `foto_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto_comments_foto_id_foreign` (`foto_id`),
  ADD KEY `foto_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `foto_likes`
--
ALTER TABLE `foto_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `foto_likes_foto_id_user_id_unique` (`foto_id`,`user_id`),
  ADD KEY `foto_likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galery_post_id_foreign` (`post_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_uploaded_by_foreign` (`uploaded_by`),
  ADD KEY `galleries_category_created_at_index` (`category`,`created_at`);

--
-- Indexes for table `gallery_comments`
--
ALTER TABLE `gallery_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_comments_gallery_item_id_foreign` (`gallery_item_id`),
  ADD KEY `gallery_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `gallery_downloads`
--
ALTER TABLE `gallery_downloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_downloads_gallery_item_id_foreign` (`gallery_item_id`),
  ADD KEY `gallery_downloads_user_id_foreign` (`user_id`);

--
-- Indexes for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_likes`
--
ALTER TABLE `gallery_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_like` (`gallery_item_id`,`user_id`),
  ADD UNIQUE KEY `unique_ip_like` (`gallery_item_id`,`ip_address`),
  ADD UNIQUE KEY `unique_session_like` (`gallery_item_id`,`session_id`),
  ADD KEY `gallery_likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informasi_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `petugas_username_unique` (`username`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_kategori_id_foreign` (`kategori_id`),
  ADD KEY `posts_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `download_logs`
--
ALTER TABLE `download_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `foto_comments`
--
ALTER TABLE `foto_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `foto_likes`
--
ALTER TABLE `foto_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `galery`
--
ALTER TABLE `galery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `gallery_comments`
--
ALTER TABLE `gallery_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_downloads`
--
ALTER TABLE `gallery_downloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_items`
--
ALTER TABLE `gallery_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_likes`
--
ALTER TABLE `gallery_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `download_logs`
--
ALTER TABLE `download_logs`
  ADD CONSTRAINT `download_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `foto_comments`
--
ALTER TABLE `foto_comments`
  ADD CONSTRAINT `foto_comments_foto_id_foreign` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foto_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `foto_likes`
--
ALTER TABLE `foto_likes`
  ADD CONSTRAINT `foto_likes_foto_id_foreign` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foto_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galery`
--
ALTER TABLE `galery`
  ADD CONSTRAINT `galery_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `gallery_comments`
--
ALTER TABLE `gallery_comments`
  ADD CONSTRAINT `gallery_comments_gallery_item_id_foreign` FOREIGN KEY (`gallery_item_id`) REFERENCES `gallery_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gallery_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gallery_downloads`
--
ALTER TABLE `gallery_downloads`
  ADD CONSTRAINT `gallery_downloads_gallery_item_id_foreign` FOREIGN KEY (`gallery_item_id`) REFERENCES `gallery_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gallery_downloads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gallery_likes`
--
ALTER TABLE `gallery_likes`
  ADD CONSTRAINT `gallery_likes_gallery_item_id_foreign` FOREIGN KEY (`gallery_item_id`) REFERENCES `gallery_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gallery_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `informasi`
--
ALTER TABLE `informasi`
  ADD CONSTRAINT `informasi_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
