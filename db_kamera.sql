-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Jul 2018 pada 06.49
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kamera`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`username`, `password`) VALUES
('admin', '12341234');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bank`
--

CREATE TABLE `tb_bank` (
  `kd_bank` varchar(5) NOT NULL,
  `nm_bank` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bank`
--

INSERT INTO `tb_bank` (`kd_bank`, `nm_bank`) VALUES
('-', '-'),
('B001', 'ANZ'),
('B002', 'BNI'),
('B003', 'BCA'),
('B004', 'BANK MANDIRI'),
('B005', 'BANK RAKYAT INDONESIA'),
('B006', 'CITIBANK'),
('B007', 'UOB'),
('B008', 'BANK DANAMON'),
('B009', 'OCBC NISP'),
('B010', 'BANK NEGARA INDONESIA'),
('B011', 'BANK NEGARA INDONESIA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail`
--

CREATE TABLE `tb_detail` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(15) NOT NULL,
  `kd_produk` varchar(10) NOT NULL,
  `berat` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_berat` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jns_pembayaran`
--

CREATE TABLE `tb_jns_pembayaran` (
  `kd_jns_pembayaran` varchar(5) NOT NULL,
  `nm_jns_pembayaran` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jns_pembayaran`
--

INSERT INTO `tb_jns_pembayaran` (`kd_jns_pembayaran`, `nm_jns_pembayaran`) VALUES
('BT', 'BANK TRANSFER'),
('COD', 'CASH ON DELIVERY');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jns_pengembalian`
--

CREATE TABLE `tb_jns_pengembalian` (
  `kd_jns_pengembalian` varchar(6) NOT NULL,
  `nm_jns_pengembalian` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jns_pengembalian`
--

INSERT INTO `tb_jns_pengembalian` (`kd_jns_pengembalian`, `nm_jns_pengembalian`) VALUES
('RET001', 'REFUND'),
('RET002', 'TUKAR BARANG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kd_kategori` varchar(10) NOT NULL,
  `nm_kategori` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`kd_kategori`, `nm_kategori`, `gambar`) VALUES
('K001', 'CANON', 'CANON.jpg'),
('K002', 'NIKON', 'NIKON.jpg'),
('K003', 'SONY', 'SONY.png'),
('K004', 'FUJIFILM', 'fujifilm.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kurir`
--

CREATE TABLE `tb_kurir` (
  `kd_kurir` varchar(5) NOT NULL,
  `nm_kurir` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kurir`
--

INSERT INTO `tb_kurir` (`kd_kurir`, `nm_kurir`) VALUES
('KUR01', 'JNE'),
('KUR02', 'J&T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `kd_plgn` varchar(10) NOT NULL,
  `waktu` varchar(30) NOT NULL,
  `akses` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_login`
--

INSERT INTO `tb_login` (`id`, `username`, `kd_plgn`, `waktu`, `akses`) VALUES
(1, 'aryo', 'C00000001', '2018-07-29 11:37:51am', 'user'),
(3, 'admin', '', '', 'admin'),
(5, 'admin', '', '', 'admin'),
(7, 'admin', '', '', 'admin'),
(8, 'aryo', 'C00000002', '2018-07-29 11:45:55am', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ongkir`
--

CREATE TABLE `tb_ongkir` (
  `kd_ongkir` varchar(6) NOT NULL,
  `nm_kota` char(15) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `kd_kurir` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_ongkir`
--

INSERT INTO `tb_ongkir` (`kd_ongkir`, `nm_kota`, `ongkir`, `kd_kurir`) VALUES
('ONK001', 'BANDUNG', 11000, 'KUR01'),
('ONK002', 'BANDUNG', 12000, 'KUR02'),
('ONK003', 'JAKARTA', 9000, 'KUR01'),
('ONK004', 'JAKARTA', 8500, 'KUR02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `kd_plgn` varchar(10) NOT NULL,
  `nm_plgn` char(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`kd_plgn`, `nm_plgn`, `alamat`, `no_telp`, `email`) VALUES
('C00000001', 'sadas', 'd2q312', '123', ''),
('C00000002', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `no_transaksi` varchar(15) NOT NULL,
  `kd_jns_pembayaran` varchar(5) NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `tgl_upload` varchar(20) NOT NULL,
  `keterangan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`no_transaksi`, `kd_jns_pembayaran`, `bukti_pembayaran`, `tgl_upload`, `keterangan`) VALUES
('29071800000001', 'BT', '29071800000001.jpg', '29-07-2018', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengembalian_produk`
--

CREATE TABLE `tb_pengembalian_produk` (
  `id` int(11) NOT NULL,
  `no_retur` varchar(6) NOT NULL,
  `tgl_pengajuan_retur` varchar(20) NOT NULL,
  `no_transaksi` varchar(15) NOT NULL,
  `kd_produk` varchar(6) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kd_jns_pengembalian` varchar(6) NOT NULL,
  `alasan` char(30) NOT NULL,
  `keterangan` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengiriman`
--

CREATE TABLE `tb_pengiriman` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(15) NOT NULL,
  `tgl_pengiriman` varchar(20) NOT NULL,
  `kd_kurir` varchar(5) NOT NULL,
  `no_resi` varchar(30) NOT NULL,
  `keterangan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengiriman`
--

INSERT INTO `tb_pengiriman` (`id`, `no_transaksi`, `tgl_pengiriman`, `kd_kurir`, `no_resi`, `keterangan`) VALUES
(1, '29071800000001', '--', 'KUR01', 'RESI0000123', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `kd_produk` varchar(10) NOT NULL,
  `kd_kategori` varchar(10) NOT NULL,
  `nm_produk` varchar(100) NOT NULL,
  `spesifikasi` text NOT NULL,
  `berat` float NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `rak` varchar(25) NOT NULL,
  `diskon` float NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`kd_produk`, `kd_kategori`, `nm_produk`, `spesifikasi`, `berat`, `satuan`, `harga`, `stok`, `rak`, `diskon`, `gambar`, `rating`) VALUES
('P0001', 'K001', 'Canon 1200D', '-', 100, 'PCS', 5400000, 1, 'highlight', 0, 'canon1200d.jpg', 0),
('P00014', 'K004', 'Fujifilm s8600', '.', 100, 'PCS', 3000000, 16, 'highlight', 0, 'fujifilm s8600.jpg', 0),
('P00016', 'K004', 'fujifilm s4800', ' ', 100, 'PCS', 2800000, 18, '', 0, 'fujifilms4800.jpg', 0),
('P0002', 'K001', 'Canon 1300D', '-', 100, 'PCS', 5000000, 20, '', 0, 'canon1300d.jpg', 0),
('P0003', 'K001', 'Canon 600D', '-', 100, 'PCS', 7000000, 20, '', 0, 'canon600d.jpg', 0),
('P0004', 'K001', 'Canon 650D', '-', 100, 'PCS', 7600000, 20, '', 0, 'canon650d.jpg', 0),
('P0005', 'K001', 'Canon 700D', '-', 100, 'PCS', 7999000, 15, 'highlight', 0, 'canon700d.jpg', 0),
('P0006', 'K001', 'Canon 6D', '-', 100, 'PCS', 51000000, 15, 'highlight', 0.25, 'canon6d.jpg', 0),
('P0007', 'K001', 'Canon 60D ', '-', 100, 'PCS', 9500000, 15, 'highlight', 0.1, 'canon60d.jpg', 0),
('P0008', 'K002', 'Nikon D3000', '-', 100, 'PCS', 4500000, 14, 'highlight', 0.25, 'nikond3000.jpg', 0),
('P0009', 'K002', 'Nikon D5000', '-', 100, 'PCS', 6800000, 20, '', 0, 'nikond5000.jpg', 0),
('P0010', 'K002', 'Nikon D5300', '-', 100, 'PCS', 10000000, 20, '', 0, 'nikon5300.jpg', 0),
('P0011', 'K003', 'Sony a230', '-', 100, 'PCS', 4000000, 20, 'highlight', 0, 'sonya230.jpg', 0),
('P0012', 'K003', 'Sony a550', '-', 100, 'PCS', 9000000, 12, 'highlight', 0.1, 'sonya550.jpg', 0),
('P0013', 'K003', 'Sony a3000', '-', 100, 'PCS', 5700000, 20, '', 0.2, 'sonya3000.jpg', 0),
('P0015', 'K004', 'Fujifilm s4600', ' ', 100, 'PCS', 2500000, 20, '', 0, 'fujifilms4600.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `no_transaksi` varchar(25) NOT NULL,
  `tgl_transaksi` varchar(20) NOT NULL,
  `kd_plgn` varchar(10) NOT NULL,
  `nm_pemegang_kartu` char(30) NOT NULL,
  `kd_bank` varchar(5) NOT NULL,
  `no_rek_bank` varchar(30) NOT NULL,
  `total_beli` int(11) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`no_transaksi`, `tgl_transaksi`, `kd_plgn`, `nm_pemegang_kartu`, `kd_bank`, `no_rek_bank`, `total_beli`, `total_berat`, `ongkir`, `total_bayar`) VALUES
('29071800000001', '29-07-2018', 'C00000001', 'dasdsadasdasd', 'B001', '1231', 1, 100, 11000, 5411000),
('29071800000002', '', 'C00000002', '', '-', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ulasan`
--

CREATE TABLE `tb_ulasan` (
  `id` int(11) NOT NULL,
  `kd_plgn` varchar(10) NOT NULL,
  `kd_produk` varchar(10) NOT NULL,
  `tgl_ulasan` varchar(25) NOT NULL,
  `ulasan` varchar(100) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_ulasan`
--

INSERT INTO `tb_ulasan` (`id`, `kd_plgn`, `kd_produk`, `tgl_ulasan`, `ulasan`, `nilai`) VALUES
(1, 'C00000001', 'P0001', '29-07-2018 11:46:02am', 'asdasdasda', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`username`, `password`, `email`) VALUES
('aryo', '12341234', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`kd_bank`);

--
-- Indexes for table `tb_detail`
--
ALTER TABLE `tb_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_transaksi` (`no_transaksi`),
  ADD KEY `kd_motor` (`kd_produk`);

--
-- Indexes for table `tb_jns_pembayaran`
--
ALTER TABLE `tb_jns_pembayaran`
  ADD PRIMARY KEY (`kd_jns_pembayaran`);

--
-- Indexes for table `tb_jns_pengembalian`
--
ALTER TABLE `tb_jns_pengembalian`
  ADD PRIMARY KEY (`kd_jns_pengembalian`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kd_kategori`);

--
-- Indexes for table `tb_kurir`
--
ALTER TABLE `tb_kurir`
  ADD PRIMARY KEY (`kd_kurir`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `kd_plgn` (`kd_plgn`);

--
-- Indexes for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  ADD PRIMARY KEY (`kd_ongkir`),
  ADD KEY `kd_kurir` (`kd_kurir`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`kd_plgn`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `kd_jns_pembayaran` (`kd_jns_pembayaran`);

--
-- Indexes for table `tb_pengembalian_produk`
--
ALTER TABLE `tb_pengembalian_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kd_jns_pengembalian` (`kd_jns_pengembalian`),
  ADD KEY `no_transaksi` (`no_transaksi`);

--
-- Indexes for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_transaksi` (`no_transaksi`),
  ADD KEY `kd_kurir` (`kd_kurir`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`kd_produk`),
  ADD KEY `kd_merek` (`kd_kategori`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `kd_bank` (`kd_bank`),
  ADD KEY `kd_plgn` (`kd_plgn`);

--
-- Indexes for table `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kd_produk` (`kd_produk`),
  ADD KEY `kd_plgn` (`kd_plgn`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail`
--
ALTER TABLE `tb_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_pengembalian_produk`
--
ALTER TABLE `tb_pengembalian_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`kd_kategori`) REFERENCES `tb_kategori` (`kd_kategori`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
