-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Sep 2022 pada 07.54
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_karyawan`
--

CREATE TABLE `calon_karyawan` (
  `id_calon_kr` int(11) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `jabatan` varchar(20) NOT NULL,
  `foto` varchar(64) DEFAULT NULL,
  `ttl` date DEFAULT NULL,
  `skill` text DEFAULT NULL,
  `pengalaman` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `calon_karyawan`
--

INSERT INTO `calon_karyawan` (`id_calon_kr`, `nip`, `nama`, `jabatan`, `foto`, `ttl`, `skill`, `pengalaman`) VALUES
(1, '00031245', 'fajar dwi agustina', 'super visior', '1662432434-a2fe21da9ce7d1698f5b48cdb506c853.jpg', '1992-07-05', 'office dan photoshop', 'bekerja 2 tahun di PT. Indra Perkasa'),
(2, '009123455', 'dani maulana hidayat', 'senior super visior', '1662432444-a6e7468371ba3b3c3dc212b3ef54cd9c.jpg', '1998-10-20', 'office 2012', 'super visior PT. Anugrah Perkasa'),
(3, '00091235', 'guntur pratama', 'operator forkli', '1662432454-hd-one-piece-wallpaper-whatspaper-13.jpg', '1998-06-30', 'office', 'operator forklip'),
(4, '00074721', 'fadilah humairah', 'operator umum', '1662694956.', '1999-09-22', 'office dan desinger photoshop / corel draw', '1 tahun di PT. Alun Kusuma'),
(8, '00931999', 'samsudin', 'back office', '631b72b0e92e6.jpg', '1995-09-09', 'office', 'bekerja di start up '),
(9, '00924288', 'jeje ahmad', 'office', '631b72f49fa57.jpg', '1975-09-08', '-', 'bekerja selama 10 tahun'),
(10, '00094151', 'gilang', 'operator', '631b732dc74af.jpg', '1998-10-06', '-', '-'),
(11, '00094329', 'ucup dilan', 'office', '631b74ce35a83.jpg', '1997-01-05', 'office', '-'),
(12, '0009312', 'opick hadi kusuma', 'back office', '631b75585904a.jpg', '1999-10-20', '-', '-'),
(13, '0084239', 'kiki', 'office', '1662743973.', '1995-09-08', '-', '-'),
(14, '00031951', 'uje', 'office', '631bfdc39ad32.jpg', '1984-09-30', 'office', 'bekerja lebih 3 tahun'),
(15, '00031941', 'jaja', 'office', '63214c4991c77.png', '1987-10-02', '-', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_spk`
--

CREATE TABLE `hasil_spk` (
  `id_spk` int(11) NOT NULL,
  `id_calon_kr` int(11) DEFAULT NULL,
  `hasil_spk` float(10,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil_spk`
--

INSERT INTO `hasil_spk` (`id_spk`, `id_calon_kr`, `hasil_spk`) VALUES
(10, 1, 20.20000076),
(11, 2, 18.20000076),
(12, 3, 21.00000000),
(13, 4, 18.14999962),
(14, 8, 20.20000076),
(15, 9, 20.95000076),
(16, 10, 18.35000038),
(17, 11, 18.20000076),
(18, 12, 17.35000038),
(19, 13, 21.00000000),
(20, 14, 19.20000076),
(21, 15, 19.00000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_tpa`
--

CREATE TABLE `hasil_tpa` (
  `id_test` int(11) NOT NULL,
  `id_calon_kr` int(11) DEFAULT NULL,
  `Absensi` int(11) DEFAULT NULL,
  `Target` int(11) DEFAULT NULL,
  `Sop` int(11) DEFAULT NULL,
  `Kerajinan` int(11) DEFAULT NULL,
  `Attituted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil_tpa`
--

INSERT INTO `hasil_tpa` (`id_test`, `id_calon_kr`, `Absensi`, `Target`, `Sop`, `Kerajinan`, `Attituted`) VALUES
(14, 1, 5, 5, 4, 5, 5),
(15, 2, 4, 4, 5, 5, 4),
(16, 3, 5, 3, 5, 3, 5),
(17, 4, 4, 3, 4, 4, 5),
(19, 8, 5, 4, 4, 3, 4),
(20, 9, 5, 5, 4, 4, 5),
(21, 10, 4, 4, 3, 4, 5),
(28, 11, 5, 4, 4, 5, 4),
(29, 12, 4, 3, 3, 4, 5),
(31, 13, 5, 5, 5, 5, 5),
(32, 14, 4, 5, 5, 5, 4),
(33, 15, 5, 5, 5, 5, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hrd`
--

CREATE TABLE `hrd` (
  `nip` varchar(16) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `nama_lengkap` varchar(64) DEFAULT NULL,
  `ttl` date DEFAULT NULL,
  `foto` varchar(64) DEFAULT NULL,
  `akses` enum('hrd','audit','direktur') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hrd`
--

INSERT INTO `hrd` (`nip`, `email`, `username`, `password`, `nama_lengkap`, `ttl`, `foto`, `akses`) VALUES
('91124', 'falcoefebrian@gmail.com', 'falcon', 'd41d8cd98f00b204e9800998ecf8427e', 'falco febirian', '1974-08-09', '632165fdbb2da.jpg', 'direktur'),
('91240', 'tongam@admin.com', 'tongam', '81dc9bdb52d04dc20036dbd8313ed055', 'Tongam Silitonga', '1999-05-16', '631ba8a5c2549.jpg', ''),
('98002', 'galihpurnama091@yahoo.com', 'galih', '81dc9bdb52d04dc20036dbd8313ed055', 'galih purnama', '1982-04-04', '632167b3096f0.jpg', 'hrd'),
('99024', 'ridhoganteng@gmail.com', 'ridho', 'd41d8cd98f00b204e9800998ecf8427e', 'ridho nur rohman', '1976-09-01', '63215edcb78b2.jpg', 'audit'),
('99102', 'redaameailaputri102@gmail.com', 'amelia', '81dc9bdb52d04dc20036dbd8313ed055', 'reda amelia putri', '1992-10-09', '6321668da1b07.jpg', 'audit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kriteria` varchar(32) DEFAULT NULL,
  `bobot` int(1) DEFAULT NULL,
  `type` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `bobot`, `type`) VALUES
(1, 'Absensi', 4, 'Benefit'),
(3, 'Target', 5, 'Benefit'),
(4, 'Sop', 4, 'Benefit'),
(6, 'Kerajinan', 5, 'Cost'),
(17, 'Attituted', 5, 'Benefit');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `calon_karyawan`
--
ALTER TABLE `calon_karyawan`
  ADD PRIMARY KEY (`id_calon_kr`);

--
-- Indeks untuk tabel `hasil_spk`
--
ALTER TABLE `hasil_spk`
  ADD PRIMARY KEY (`id_spk`),
  ADD KEY `hasil_spk_ibfk_1` (`id_calon_kr`);

--
-- Indeks untuk tabel `hasil_tpa`
--
ALTER TABLE `hasil_tpa`
  ADD PRIMARY KEY (`id_test`);

--
-- Indeks untuk tabel `hrd`
--
ALTER TABLE `hrd`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `calon_karyawan`
--
ALTER TABLE `calon_karyawan`
  MODIFY `id_calon_kr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `hasil_spk`
--
ALTER TABLE `hasil_spk`
  MODIFY `id_spk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `hasil_tpa`
--
ALTER TABLE `hasil_tpa`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil_spk`
--
ALTER TABLE `hasil_spk`
  ADD CONSTRAINT `hasil_spk_ibfk_1` FOREIGN KEY (`id_calon_kr`) REFERENCES `calon_karyawan` (`id_calon_kr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
