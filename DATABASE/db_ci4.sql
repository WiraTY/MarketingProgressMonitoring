-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2023 pada 06.42
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ci4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-07-14-072956', 'App\\Database\\Migrations\\CreateKaryawanTable', 'default', 'App', 1689320235, 1),
(2, '2023-07-14-073710', 'App\\Database\\Migrations\\TableKaryawan', 'default', 'App', 1689320235, 1),
(3, '2023-07-17-081158', 'App\\Database\\Migrations\\TbKirimEmail', 'default', 'App', 1689581535, 2),
(4, '2023-07-17-082430', 'App\\Database\\Migrations\\TbKirimEmail', 'default', 'App', 1689582291, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_group`
--

CREATE TABLE `tb_group` (
  `id_group` int(100) NOT NULL,
  `nama_group` varchar(50) NOT NULL,
  `deskripsi_group` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_group`
--

INSERT INTO `tb_group` (`id_group`, `nama_group`, `deskripsi_group`) VALUES
(1, 'ECP Padang 2023', 'ECP Padang 2023'),
(2, 'EMP Malang 2023', 'EMP Malang 2023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kirim_email`
--

CREATE TABLE `tb_kirim_email` (
  `id_kirim_email` int(11) NOT NULL,
  `tgl_kirim_email` date DEFAULT NULL,
  `id_member` int(11) DEFAULT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `negara_perusahaan` varchar(255) DEFAULT NULL,
  `status_terkirim` enum('Terkirim','Gagal') CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `progress` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_member`
--

CREATE TABLE `tb_member` (
  `id_member` int(11) NOT NULL,
  `nama_member` varchar(50) NOT NULL,
  `id_group` int(11) NOT NULL,
  `alamat_member` text NOT NULL,
  `email_member` varchar(50) NOT NULL,
  `telp_member` varchar(15) NOT NULL,
  `password_member` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_member`
--

INSERT INTO `tb_member` (`id_member`, `nama_member`, `id_group`, `alamat_member`, `email_member`, `telp_member`, `password_member`) VALUES
(1, 'PT Capt Spice Indonesia', 1, 'Jl. Adam Malik no 174B LUBUK SIKAPING, Sawah panjang, Aia Manggih, Lubuk Sikaping, Kabupaten Pasaman, Sumatera Barat 26314', '081267660325', '081267660325', '081267660325'),
(2, 'Difa Snack', 1, 'Koto Tinggi, Padang Alai, Kec. V Koto Timur, Kab. Padang Pariaman', '081374021850', '081374021850', '081374021850'),
(3, 'CV Surya Agro Nusantara', 1, 'Simpang Empat, Desa/Kelurahan Lingkuang Aua, Kec. Pasaman, Kab. Pasaman Barat, Provinsi Sumatera Barat.', '085326743384', '085326743384', '085326743384'),
(4, 'Fiara Sulam', 1, 'Lundang, Panampuang, Ampek Angkek, Kab Agam', '081321825818', '081321825818', '081321825818'),
(5, 'PT Andalas Sumatera Maju', 1, 'Bukittinggi', '085278313561', '085278313561', '085278313561'),
(6, 'Lestari Kreatif', 1, 'Perumahan primavera indah no.16 Rt001/004 pulai anak air. Mandiangin koto selayan. Bukittinggi 26125', '085361111003', '085361111003', '085361111003'),
(7, 'Kerta Indo Agro', 1, 'Guguak Bulek, Kecamatan Mandiangin Koto Selayan, 26128, Bukittinggi Sumatera Barat, Indonesia', '085263162983', '085263162983', '085263162983'),
(8, 'PT GADIH MINANG ANUGERAH', 1, 'Perumahan Taman Firdaus, Jalan Anthurium No. A1 Rt 002 Rw 001 Payolansek Payakumbuh Barat, Kota Payakumbuh', '085265682314', '085265682314', '085265682314'),
(9, 'Rendang Sulaiman', 1, 'Jl imam bonjol no 10, Napar, Payakumbuh', '081394787474', '081394787474', '081394787474'),
(10, 'PT Mak Yus Internasional', 1, 'Jl. Veteran No 39 Kel. Parak Betung, Kec. Payakumbuh Barat, Kota Payakumbuh, Sumatera Barat', '085264846144', '085264846144', '085264846144'),
(11, 'Dapur mutiara', 1, 'Komplek Taman Mutiara Blok F No. 2 Ngalau Payakumbuh', '081270541220', '081270541220', '081270541220'),
(12, 'MR Cake & Bakery', 1, 'Payakumbuh', '085263004848', '085263004848', '085263004848'),
(13, 'CV PESSEL NATURAL RESOUR', 1, 'Jl Berok Jembatan Lama No 15 RT 1 Rw 4 Siteba Padang Sumatera Barat', '082386242912', '082386242912', '082386242912'),
(14, 'PT Altajaru Bumi Andalas', 1, 'Jl. Lintas Sumatera KM 10, Guguak Sarai, Kec. IX Koto Sungai Lasi, Kabupaten Solok, Sumatera Barat, Indonesia. Kode Pos 27388', '082264644444', '082264644444', '082264644444'),
(15, 'PT Desain Kreatif Indonesia', 1, 'Dusun Kemiri Desa Sikalang Kec. talawi, Kota Sawahlunto, Sumatera Barat', '085228918895', '085228918895', '085228918895'),
(16, 'Rendang Uni Lili', 1, 'Durian Tarung, Nagari Lubuk Gadang, Kec.Sangir,Kabupaten Solok Selatan, Provinsi Sumatera Barat', '082390834334', '082390834334', '082390834334'),
(17, 'AROMA BUMI SUMATERA', 1, 'pinti kayu ketek, Desa/Kelurahan Pakan Rabaa Timur, Kec. Koto Parik Gadang Diateh, Kab. Solok Selatan, Provinsi Sumatera Barat', '082169666548', '082169666548', '082169666548'),
(18, 'Bukik Gompong Sejahtera', 1, 'Jorong bukik gompong, Nagari Koto Gadang Guguak Kecamatan Gunung Talang Kab. Solok', '0811669870', '0811669870', '0811669870'),
(19, 'Martinature', 1, 'Bukittinggi', '081363156767', '081363156767', '081363156767'),
(20, 'CV Siti Nurbaya Catering', 1, 'Jl. Damar I No. 6, Olo, Padang Barat', '085266096507', '085266096507', '085266096507'),
(21, 'CV SUKSES JAYA MAKMUR ', 1, 'Jl AR Hakim no 45 ABC Padang 25212', '081363324007', '081363324007', '081363324007'),
(22, 'Randang KoLaku ', 1, 'Jl. Kubu Dalam Rt.005/Rw.002, Kel. Kubu Dalam Parak Karakah, Kec. Padang Timur, Kota Padang, Provinsi Sumatera Barat. 25126', '081250033333', '081250033333', '081250033333'),
(23, 'CV Kusuma Karya Sejahtera', 1, 'Green mutiara E3, bandar buat, padang', '081317643195', '081317643195', '081317643195'),
(24, 'CV Nusa Cipta Karya', 1, 'Jl.kimia no.1f, kampung olo, nanggalo', '08116639995', '08116639995', '08116639995'),
(25, 'CV Golden Catering', 1, 'jl. punggai II, siteba', '085374354074', '085374354074', '085374354074'),
(26, 'CV Faghaz Mitra Mandiri', 1, 'Kompleks Jondul 2 B21 Parupuk Tabing Kota Padang', '081374854673', '081374854673', '081374854673'),
(27, 'PT Meraki Adiwarna', 1, 'Depan Stasiun TVRI By Pass JL perdana Rt.01 Rw.06 Kel Aie Pacah Kec.Koto tangah', '085285858523', '085285858523', '085285858523'),
(28, 'PT Cakrawala Komoditas Indonesia ', 1, 'Jl. Ambacang no 10 Kel. Koto baru kota Padang ', '081266502502', '081266502502', '081266502502'),
(29, 'Bonang Bersaudara', 1, 'Komplek PGRI 1 No. F13 Surau Gadang Nanggalo Kota Padang ', '082331283333', '082331283333', '082331283333'),
(30, 'Parakno Farm', 1, 'Jl. Parupuk III No.1 Parupuk Tabing, Koto Tangah, Padang, Sumatera Barat', '085363615087', '085363615087', '085363615087');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_profil`
--

CREATE TABLE `tb_profil` (
  `id_profil` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_group`
--
ALTER TABLE `tb_group`
  ADD PRIMARY KEY (`id_group`);

--
-- Indeks untuk tabel `tb_kirim_email`
--
ALTER TABLE `tb_kirim_email`
  ADD PRIMARY KEY (`id_kirim_email`),
  ADD KEY `tb_kirim_email_id_member_foreign` (`id_member`);

--
-- Indeks untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `tb_profil`
--
ALTER TABLE `tb_profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_group`
--
ALTER TABLE `tb_group`
  MODIFY `id_group` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_kirim_email`
--
ALTER TABLE `tb_kirim_email`
  MODIFY `id_kirim_email` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_profil`
--
ALTER TABLE `tb_profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_kirim_email`
--
ALTER TABLE `tb_kirim_email`
  ADD CONSTRAINT `tb_kirim_email_id_member_foreign` FOREIGN KEY (`id_member`) REFERENCES `tb_member` (`id_member`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
