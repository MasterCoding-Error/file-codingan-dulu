-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Apr 2026 pada 09.50
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dodolan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(225) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `tgl_kadaluarsa` date NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `harga_barang` int(100) NOT NULL,
  `id_supplier` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `tgl_kadaluarsa`, `kode_barang`, `harga_barang`, `id_supplier`) VALUES
(2, 'Spidol', '2025-09-01', 'SP001', 12000, 3),
(3, 'Meja', '2025-09-01', 'MJ001', 15000, 1),
(6, 'Pulpen', '2025-09-03', 'PL001', 15000, 1),
(7, 'Kursi', '2025-09-03', 'KR001', 15000, 3),
(8, 'Papan Tulis Besar', '2025-10-07', 'PP0011', 40000, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(225) NOT NULL,
  `jumlah_barang` int(100) NOT NULL,
  `id_barang` int(225) NOT NULL,
  `id_transaksi` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `jumlah_barang`, `id_barang`, `id_transaksi`) VALUES
(15, 2, 2, 9),
(36, 10, 2, 2),
(37, 5, 3, 2),
(38, 5, 8, 2),
(40, 5, 8, 2),
(41, 5, 3, 5),
(42, 10, 3, 6),
(43, 5, 8, 7),
(44, 5, 8, 7),
(45, 5, 8, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(225) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `role` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `alamat`, `jk`, `tgl_lahir`, `role`, `username`, `password`) VALUES
(1, 'Laras', 'malang selatan', 'Perempuan', '2025-08-06', 'admin', 'admin', 'admin'),
(2, 'Ahmad', 'Malang', 'Perempuan', '2025-08-20', 'karyawan', 'karyawan', 'karyawan'),
(4, 'adminlawas', 'Malang', 'Laki-laki', '2025-10-07', 'karyawan', 'baca', 'baca');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_stok`
--

CREATE TABLE `riwayat_stok` (
  `id_riwayat` int(225) NOT NULL,
  `jumlah_barang` int(100) NOT NULL,
  `id_barang` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat_stok`
--

INSERT INTO `riwayat_stok` (`id_riwayat`, `jumlah_barang`, `id_barang`) VALUES
(6, 20, 3),
(7, 20, 8),
(8, 20, 8),
(11, 10, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id_stok` int(225) NOT NULL,
  `stok` int(100) DEFAULT NULL,
  `id_barang` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok_barang`
--

INSERT INTO `stok_barang` (`id_stok`, `stok`, `id_barang`) VALUES
(2, 0, 2),
(3, 0, 3),
(5, 0, 6),
(6, 0, 7),
(7, 15, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(225) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`) VALUES
(1, 'Ahmad'),
(3, 'Yoga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(225) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_belanja` int(50) NOT NULL,
  `bayar` int(50) NOT NULL,
  `id_pegawai` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_transaksi`, `total_belanja`, `bayar`, `id_pegawai`) VALUES
(2, '2025-11-13 00:16:23', 595000, 600000, 1),
(5, '2025-11-11 04:20:22', 0, 80000, 2),
(6, '2025-11-11 05:15:59', 0, 200000, 1),
(7, '2025-11-11 05:27:47', 0, 500000, 1),
(8, '2025-11-11 05:29:03', 0, 300000, 1),
(9, '2025-10-14 03:42:41', 0, 0, 2),
(11, '2025-11-03 00:47:31', 0, 0, 1),
(12, '2025-11-11 05:32:13', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `riwayat_stok`
--
ALTER TABLE `riwayat_stok`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `riwayat_stok`
--
ALTER TABLE `riwayat_stok`
  MODIFY `id_riwayat` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id_stok` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
