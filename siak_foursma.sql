-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 04:30 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siak_foursma`
--

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id_foto` varchar(15) NOT NULL,
  `ekst` varchar(5) NOT NULL,
  `nisn` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `identitas_sekolah`
--

CREATE TABLE `identitas_sekolah` (
  `npsn` varchar(10) NOT NULL,
  `nama_sekolah` varchar(500) NOT NULL,
  `nss` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `no_sk_pendirian` varchar(100) NOT NULL,
  `tgl_sk` date NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `kepsek` varchar(300) NOT NULL,
  `nip_kepsek` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas_sekolah`
--

INSERT INTO `identitas_sekolah` (`npsn`, `nama_sekolah`, `nss`, `status`, `no_sk_pendirian`, `tgl_sk`, `alamat_sekolah`, `telp`, `kode_pos`, `email`, `kepsek`, `nip_kepsek`) VALUES
('50100287', 'SMAN 4 Singaraja', '201220101004', 'Negeri', '0342/U/1989', '1989-06-05', 'Jalan Melati, Kelurahan Banjar Jawa, Kecamatan Buleleng', '(0362) 22845', '81113', 'sma4singaraja@gmail.com', 'Dr. Putu Gede Wartawan,S.Pd.M.Pd.', '197002241995031003');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pelanggaran`
--

CREATE TABLE `jenis_pelanggaran` (
  `id_jenis_pelanggaran` int(11) NOT NULL,
  `jenis_pelanggaran` varchar(255) NOT NULL,
  `poin` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_pelanggaran`
--

INSERT INTO `jenis_pelanggaran` (`id_jenis_pelanggaran`, `jenis_pelanggaran`, `poin`) VALUES
(2, 'Terlambat', '3');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'Umum'),
(2, 'Mipa'),
(3, 'IPS'),
(4, 'Bahasa');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL,
  `id_tingkat` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `wali_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `status`, `id_tingkat`, `id_jurusan`, `wali_kelas`) VALUES
(7, 'X 1', '1', 1, 1, '5108055611910002'),
(8, 'X 2', '1', 1, 1, '5108040709970002'),
(9, 'XII Mipa 1', '', 3, 2, '5108041808910004'),
(10, 'XI A', '', 2, 1, '5108067103690004'),
(11, 'X 3', '', 1, 1, '5108062608960003');

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `id_kel` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_kel` varchar(100) NOT NULL,
  `hubungan_kel` varchar(100) NOT NULL,
  `jk_kel` varchar(2) NOT NULL,
  `tempat_lahir_kel` varchar(50) NOT NULL,
  `tanggal_lahir_kel` date NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `penghasilan` varchar(100) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `nisn` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_jenis_pelanggaran` int(11) NOT NULL,
  `ket` text NOT NULL,
  `nisn` varchar(15) NOT NULL,
  `nik_ptk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung_perpus`
--

CREATE TABLE `pengunjung_perpus` (
  `id_kunjungan` int(11) NOT NULL,
  `id_siswa` varchar(20) DEFAULT NULL,
  `id_ptk` varchar(20) DEFAULT NULL,
  `tgl_kunjungan` date NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengunjung_perpus`
--

INSERT INTO `pengunjung_perpus` (`id_kunjungan`, `id_siswa`, `id_ptk`, `tgl_kunjungan`, `jam`) VALUES
(86, '1234567890', NULL, '2024-01-21', '08:59:17'),
(87, NULL, '5108062608960003', '2024-01-21', '10:01:14'),
(88, '1234567890', NULL, '2024-01-22', '12:58:56'),
(89, '1234567890', NULL, '2024-01-23', '20:26:38'),
(90, '1234567890', NULL, '2024-02-05', '21:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `prestasi` varchar(300) NOT NULL,
  `peringkat` varchar(15) NOT NULL,
  `tingkat` varchar(30) NOT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `no_piagam` varchar(100) NOT NULL,
  `tanggal_piagam` date NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `nisn` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ptk`
--

CREATE TABLE `ptk` (
  `nik_ptk` varchar(20) NOT NULL,
  `nik_en` varchar(255) NOT NULL,
  `nama_ptk` varchar(255) NOT NULL,
  `gelar_depan` varchar(50) DEFAULT NULL,
  `gelar_belakang` varchar(50) DEFAULT NULL,
  `jenis_ptk` varchar(1) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `nuptk` varchar(20) DEFAULT NULL,
  `tmp_lahir_ptk` varchar(50) NOT NULL,
  `tgl_lahir_ptk` date DEFAULT NULL,
  `jk_ptk` varchar(2) NOT NULL,
  `agama_ptk` varchar(20) DEFAULT NULL,
  `alamat_ptk` varchar(200) DEFAULT NULL,
  `no_hp_ptk` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `status_pegawai` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ptk`
--

INSERT INTO `ptk` (`nik_ptk`, `nik_en`, `nama_ptk`, `gelar_depan`, `gelar_belakang`, `jenis_ptk`, `nip`, `nuptk`, `tmp_lahir_ptk`, `tgl_lahir_ptk`, `jk_ptk`, `agama_ptk`, `alamat_ptk`, `no_hp_ptk`, `email`, `status_pegawai`, `foto`) VALUES
('5101055207930001', '3e0f5c7917a906a7c2847dc3c44125cf', 'Ni Putu Rina Yulianti', '', 'S.Pd.', '0', '199307122023212001', '1044771672130063', 'Dangintukadaya', '1993-07-12', 'P', 'Hindu', 'Jl. Jogor manik', '081915608229', 'rinayulianti51@gmail.com', 'PPPK', NULL),
('5102045209880001', '9d702b329169d0ab5b53e340ce37ae51', 'Gusti Ayu Nyoman Winda Tri Wijayanti', NULL, 'S.Pd.', '0', NULL, '7244766667230253', 'Samarinda', '1988-09-12', 'P', 'Hindu', 'Jl. Pahlawan Gang 16', '087863044425', 'gexwinsnowet@gmail.com', 'Guru Honor Sekolah', '5102045209880001.jpg'),
('5104015103930004', 'e87d79f4f45934e925ae864031a4b1ce', 'Ni Luh Indrayani', NULL, 'S.Pd.', '0', '199303112023212001', '8643771672230202', 'Denpasar', '1993-03-11', 'P', 'Hindu', 'Banjar Dinas Kanginan', '081915608229', 'indrayani641@gmail.com', 'PPPK', NULL),
('5105010406880002', 'f5e01126dffb842a446409fa638aa339', 'I Ketut Budiasa', NULL, 'S.Pd.', '0', '198806042022211001', '4936766667120002', 'Kelemahan', '1988-06-04', 'L', 'Hindu', 'Kelemahan', '085238110965', 'budiasaarjuna@gmail.com', 'PPPK', NULL),
('5106042104910005', '2f6ebd9cb78d2808c4297c27836a33f8', 'I Komang Warganata Suarjaya', NULL, 'S.Pd.', '0', '199104212022211001', '1753769670130102', 'BANGLI', '1991-04-21', 'L', 'Hindu', 'JL. PULAU MUNA NO. 11', '082236236421', 'baron.ararruna@gmail.com', 'PPPK', NULL),
('5107045905910003', 'ab2001bd012fef59f5584dddb5c31598', 'Ni Luh Asri Mailani', NULL, 'S.Pd.', '0', '199105192022212015', '9851769670230152', 'Bugbug', '1991-05-19', 'P', 'Hindu', 'Banjar Dinas Umejero', '085238289913', 'Asrimailani1991@gmail.com', 'PPPK', NULL),
('5108020609920002', '70bea7014d41da6e7888402ff961eeb2', 'Putu Ariawan', NULL, 'S.Pd.', '0', NULL, '8238770671130143', 'KALOPAKSA', '1992-09-06', 'L', 'Hindu', 'JL. KEMBANG SARI', '081239808838', 'putuari765@gmail.com', 'Guru Honor Sekolah', NULL),
('5108025101820002', '644ef602aba7f4e08cd370a6c78c7435', 'Nyoman Dewi Indriani', NULL, 'S.Pd.', '0', '198201112006042011', '9443760660300022', 'Singaraja', '1982-01-11', 'P', 'Hindu', 'Jalan P. Obi Gang Apel No. 2 Singaraja', '087752386376', 'dewiindrianiinuk01@gmail.com', 'PNS', NULL),
('5108034801860004', '8a2ac877cf4560b358e95e96e214b4b0', 'Komang Ayu Sri Wahyuningsih', NULL, 'S.Pd.', '0', '198601082009022005', '6440764665210102', 'Buleleng', '1986-01-08', 'P', 'Hindu', 'Jln. Amertha', '082359015058', 'youdheaaa@yahoo.com', 'PNS', NULL),
('5108040709970002', '86f05436547f3307e4b1bb0b620f4688', 'IDA BAGUS MAS PERMANA WIBAWA', '', 'S.Pd.', '0', '199709072023211001', '', 'KAYUPUTIH', '1997-09-07', 'L', 'Hindu', 'BANJAR DINAS DESA KAYUPUTIH BANJAR', '081915608229', 'guslilikjunior@gmail.com', 'PPPK', '5108040709970002.jpg'),
('5108041401840003', '2a46900e95ea9f6e6db6036ee1222dbe', 'Putu Paryastana, S.ag', NULL, 'S.Pd.', '0', NULL, '1446762663130192', 'Banjar', '1984-01-14', 'L', 'Budha', 'Banjar Dinas Pengentengan', '081239291686', 'doqsil19871@gmail.com', 'Guru Honor Sekolah', NULL),
('5108041807940004', '3fc609653d869587fcb1d509e8c503c7', 'Gede Prema Ranga Puspayana', NULL, 'S.Pd.', '0', '199407182023211001', '4050772673130013', 'Banjar', '1994-07-18', 'L', 'Hindu', 'Banjar Lebah', '081805670968', 'premaranga.id@gmail.com', 'PPPK', NULL),
('5108041808910004', '5b4cea817600f56261d56637dee33f2a', 'Gede Astawan', NULL, 'S.Pd.', '0', NULL, '3150769670130053', 'BANJAR', '1991-08-18', 'L', 'Budha', 'BANJAR DINAS PEGENTENGAN', '087760043801', 'gede_astawan@yahoo.co.id', 'Honor Daerah TK.I Provinsi', NULL),
('5108042903910001', 'd5b9c8f0b5d1a5c37538594858c059f7', 'I Komang Agoes Gelgel Aryawan', NULL, 'S.Pd.', '0', '199103292020121006', '5661769670130192', 'Singaraja', '1991-03-29', 'L', 'Hindu', 'Banjar Dinas Pegayaman,Temukus,Banjar', '087762622246', 'agoesgelgel@gmail.com', 'PNS', NULL),
('5108050205690005', '00b05328263e01768fd503930f1e68e2', 'I Wayan Swastika', NULL, 'S.Pd.', '0', '196905021998021003', '2834747649200022', 'GIANYAR', '1969-05-02', 'L', 'Hindu', 'BTN Bale Nuansa Indah Blok A/C 10                                   ', '087762572330', 'swastikapuspa4@gmail.com', 'PNS', NULL),
('5108050905670001', '38326b4001c2926ce3d9b314c1c379bd', 'I Wayan Merta', NULL, 'S.Pd.', '0', '196705092000121004', '1841740647200002', 'Karangasem', '1967-05-09', 'L', 'Hindu', 'JL.LAKSMANA BARAT GG.KAMBOJA IX BANJAR DINAS BABAKAN', '081338318008', '4smamerta@gmail.com', 'PNS', NULL),
('5108051901730002', '322b3206ddbce2043f32fa5a1f70b941', 'I Gede Wirawan', NULL, 'S.Pd.', '0', '197301192000121002', '7451751653200002', 'SELAT', '1973-01-19', 'L', 'Hindu', 'Banjar Dinas Gambuh, Desa Selat, Kec. Sukasada, Kab. Buleleng - Bali', '081936362646', 'pak_wirawan@yahoo.com', 'PNS', NULL),
('5108052910640001', '3f9e37aa90b91206314f51b56f8c8718', 'Nyoman Mangku Mariada', NULL, 'S.Pd.', '0', '196410291997021001', '0361742644200013', 'SINGARAJA           ', '1964-10-29', 'L', 'Hindu', 'Jln. Sri Kandi Gg.Durian I/19 Sambangan                   ', '081236464255', 'mangkumariada@yahoo.co.id', 'PNS', NULL),
('5108055611910002', 'c880a747566d3174ccf0b11bdfd0aa10', 'Putu Sri Tony Noperyani', NULL, 'S.Pd.', '0', '199111162023212001', '7448769670230233', 'Kalibukbuk', '1991-11-16', 'P', 'Hindu', 'Jl. Srikandi', '083115649614', 'ketutariindrawan9106@gmail.com', 'PPPK', NULL),
('5108056306740004', '17f2f5b247fe6a85b9da0f4366ff377f', 'Suratni', NULL, 'S.Pd.', '0', '197406232009022003', '6955752655300002', 'BANYUWANGI', '1974-06-23', 'P', 'Hindu', 'PERUM. PANJI ASRI BLOK S/ 11', '085646979123', 'suratnimahadev@gmail.com', 'PNS', NULL),
('5108056912650002', 'b9a37b10c4363fe53a537f61dee9a58f', 'NI MD SRI MARSILAWATI', NULL, 'S.Pd.', '0', '196512291992032009', '7561743646300013', 'TEMUKUS', '1965-12-29', 'P', 'Hindu', 'Jln. Sri Kandi Gg.Bhayangkara, Sambangan (0362) 27034, 081337180149', '081337180149', 'srimarsilawati@yahoo.co.id', 'PNS', NULL),
('5108057112640117', '1aa8eef7a62388a613ada7681216c409', 'Ni Ketut Dani', NULL, 'S.Pd.', '0', '196412311991122003', '7563742642300043', 'Bila', '1964-12-31', 'P', 'Hindu', 'JL.LAKSAMANA BARAT, GANG CEMPAKA I NO.11', '085942916800', 'niketutdani64@gmail.com', 'PNS', NULL),
('5108057112690108', 'e232b0b507683ae28e729bf6172b4bbb', 'Ni Made Nila Arianti', NULL, 'S.Pd.', '0', '196912311997022011', '7563747650300063', 'YANGAPI', '1969-12-31', 'P', 'Hindu', 'BTN Griya Panji Asri, B.14 Singaraja', '081337202425', 'nila_arianti@yahoo.com', 'PNS', NULL),
('5108060312850004', 'cb34ec1bdbf432f0dbc0cf69603c18be', 'I Kadek Bayu Hermawan Suryadi Yasa', NULL, 'S.Pd.', '0', '198512032009021001', '4535763664200003', 'Singaraja', '1985-12-03', 'L', 'Hindu', 'Jln. Gajah Mada No 53', '085237171064', 'bayumd85@gmail.com', 'PNS', NULL),
('5108061103970001', '28c31a8cd5e8039edf722b86dbc48a80', 'Juminten', 'Dr', 'S.Pd.', '0', '12345678909876544', '1234567890', 'Singaraja', '1973-03-13', 'P', 'Hindu', 'tes alamat 2', '098765432123', 'tes@gmail.com', 'PPPK', '5108061103970001.jpg'),
('5108061311780003', '7175ae75b5b4b839bf2a9389135bffde', 'I Putu Ari Widiarsa', NULL, 'S.Pd.', '0', '197811132005011008', '3445756658200013', 'ANTURAN', '1978-11-13', 'L', 'Hindu', 'Banjar Dinas Munduk', '082340601104', 'widiarsaputu@yahoo.co.id', 'PNS', NULL),
('5108061312690002', 'e29a2b9d8b772fe56f0d84e1fff1331f', 'I Gede Siram', NULL, 'S.Pd.', '0', '196912131995121002', '7545747649200013', 'TEGALLANGLANGAN', '1969-12-13', 'L', 'Hindu', 'JALAN BINA PUTRA IX/3', '081916288871', 'gedesiram6@gmail.com', 'PNS', NULL),
('5108061402920006', 'e10b072d91c6070af7d6f84c488c4632', 'Komang Sugiarta', NULL, 'S.Pd.', '0', '199202142023211001', '7546770671130272', 'Banyuning', '1992-02-14', 'L', 'Hindu', 'Jl. Setia Budi Gang Indra Prasta', '085903153855', 'mangarta92@gmail.com', 'PPPK', NULL),
('5108061507770003', '093bfd83b030bbd0836c8c0f452b142f', 'I Gusti Bagus Panji Wiratmaja', NULL, 'S.Pd.', '0', '197707152005011014', '8047755656200003', 'SINGARAJA', '1977-07-15', 'L', 'Hindu', 'Jln. Arjuna No.4L Singaraja', '081338747120', 'panjiwiratmaja27@gmail.com', 'PNS', NULL),
('5108061802640003', '0e62fa0a266136bd36a5c679d01b5687', 'Wayan Wiarsasuta', NULL, 'S.Pd.', '0', '196402181992021003', '8550742644200002', 'BULELENG', '1964-02-18', 'L', 'Hindu', 'Banjar Dinas Dangin Margi Pemaron', '085737200146', 'wiarsasutawayan@gmail.com', 'PNS', NULL),
('5108062007910006', 'f3056719dccca61bb3f78a1fabfefe89', 'Made Dedi Sidarta', NULL, 'S.Pd.', '0', NULL, '8052769670130133', 'Singaraja', '1991-07-20', 'L', 'Hindu', 'Jln. G. Batu Karu No.18', '083117521107', 'sidartadedi8@gmail.com', 'Guru Honor Sekolah', NULL),
('5108062012670001', '23a351eb884f5a758174895f09bdb35f', 'Markus Paundanan, Spak', NULL, 'S.Pd.', '0', NULL, NULL, 'Toraja', '1967-12-20', 'L', 'Kristen', 'Jln. Sawo 24 Singaraja', '085238728896', 'tesemailguru1@gmail.com', 'Guru Honor Sekolah', NULL),
('5108062112530007', 'ca5079773e6953f3eb5a3f80813eb00b', 'Thomas Ketut Marsana', NULL, 'S.Pd.', '0', NULL, NULL, 'Singaraja', '1953-12-21', 'L', 'Kristen', 'Jalan Pulau', '081118512564', 'thomas.ketut@yahoo.com', 'Guru Honor Sekolah', NULL),
('5108062308870002', '613267117dc77b89a9ba69186a088e43', 'I Gusti Bagus Sukma Adi Oka', NULL, 'S.Pd.', '0', NULL, '6155765666130133', 'Singaraja', '1987-08-23', 'L', 'Hindu', 'Jln. Pulau Komodo Gg. Aditya Block B No.10', '081239880906', 'sukmagus9@gmail.com', 'Honor Daerah TK.I Provinsi', NULL),
('5108062608960001', '36aa4258321d59f85e3af5cba3dce9b1', 'Tes PTK', '', 'S.Pd.', '0', '199608262020121001', '1234567899', 'Singaraja', '1997-02-06', 'L', 'Protestan', 'TES ALAMAT 25678192', '098998868765', 'tes2@gmail.com', 'PNS', '5108062608960001.jpg'),
('5108062608960003', '32b6e0af1cda7277c27f9a1bd07a2ade', 'I Made Arya Adinata Dwija Putra', '', 'S.Pd.,M.Kom.', '0', '199608262020121003', '1234567800', 'Singaraja', '1996-08-26', 'L', 'Hindu', 'Jl. P. Jawa, Lingk. Banyuning Utara, Kelurahan Banyuning', '098765432123', 'aryaadinata26@gmail.com', 'PNS', '5108062608960003.jpg'),
('5108062803890002', '9bec00bf2fa429e007b1246e213b875b', 'Nyoman Sudana', NULL, 'S.Pd.', '0', '198903282023211001', '9660767668130112', 'SINGARAJA', '1989-03-28', 'L', 'Hindu', 'Jln Simpang Udayana', '085237929719', 'nyomansudana389@gmail.com', 'PPPK', NULL),
('5108062805910007', '1bbd5ae5698082bc40d5130d1c0ae6e0', 'Kadek Ryan Sumarjaya Giri', NULL, 'S.Pd.', '0', '199105282023211001', '7860769670130052', 'SINGARAJA', '1991-05-28', 'L', 'Hindu', 'PERUMAHAN FAJAR ADI SANGGRAHA, JALAN FAJAR II NO 10', '088219088644', 'ryanbdl@gmail.com', 'PPPK', NULL),
('5108063010760004', '8ecdc2dd5e542fef8672e604e9fd7d9a', 'Mohammad Sahlan', NULL, 'S.Pd.', '0', '197610302014111002', '2362754656200013', 'PAMEKASAN', '1976-10-30', 'L', 'Islam', 'JL MANGGIS GG ARRASYID', '081933059135', 'pergunubuleleng@gmail.com', 'PNS Depag', NULL),
('5108063012630020', 'af39ae7da717405550ad8d5572e4c673', 'I Nengah Kariata', NULL, 'S.Pd.', '0', '196312301990031010', '2562741643300023', 'BULELENG', '1963-12-30', 'L', 'Hindu', 'Jl. Kakatua 18 Singaraja (0362)27417', '081353410101', 'nkariata5@gmail.com', 'PNS', NULL),
('5108063112660032', '4591b835b99c02576f7d5a16f5feb159', 'DRS I WAYAN SOMA', NULL, 'S.Pd.', '0', '196612311990031087', '4563744647200123', 'JEMBRANA', '1966-12-31', 'L', 'Hindu', 'JALAN PULAU MENJANGAN GANG JELANTIK NO.12 SINGARAJA', '082145350425', 'somaw6065@gmail.com', 'PNS', NULL),
('5108064206900006', '614d200344599f2a2ea7a6643c5fc696', 'Ni Made Eti Suryani', NULL, 'S.Pd.', '0', NULL, '3934768669130092', 'Singaraja', '1990-06-02', 'P', 'Hindu', 'Jl. Dewi Sartika Utara No.56 A, Singaraja', '081915608229', 'etisuryaniwijaya@gmail.com', 'Honor Daerah TK.I Provinsi', NULL),
('5108064207670002', '1395e9b9db9460b0bddc24fba69bf0ab', 'Ni Komang Sri Jayawati', NULL, 'S.Pd.', '0', '196707021994122003', '4034745647300023', 'KEMBANGSARI', '1967-07-02', 'P', 'Hindu', 'Jln. Sahadewa No 9x Singaraja', '081338121388', 'srijayawatik@gmail.com', 'PNS', NULL),
('5108064303690004', 'fafa180c5ae9db60521e1a82dc29794c', 'Luh Maharani Merta', NULL, 'S.Pd.', '0', '196903032003122007', '9635747648300002', 'DESA JOANYAR', '1969-03-03', 'P', 'Hindu', 'JL. Pantai Indah II/15 Singaraja RT.08', '081338168670', 'luhmaharani16@gmail.com', 'PNS', NULL),
('5108064605800004', '215f7f7ee16d009e859845a4a243dd72', 'Komang Sri Utami', NULL, 'S.Pd.', '0', '198005062002122007', '0838758659300022', 'SINGARAJA', '1980-05-06', 'P', 'Hindu', 'JALAN GEMPOL GANG KAKATUA NO 7                                                  ', '081805393953', 'komangutami@yahoo.com', 'PNS', NULL),
('5108064708650002', '2820cd0725ed545e68ba0b47dc738494', 'Desak Putu Astini', NULL, 'S.Pd.', '0', '196508071988032025', '9139743644300033', 'Buleleng', '1965-08-07', 'P', 'Hindu', 'Jln. Ngurah Rai No.15 Singaraja', '082147585427', 'desakastini@gmail.com', 'PNS Diperbantukan', NULL),
('5108064905920003', '2c224167f93a4c6cf1ffb8ea2dfcf8a9', 'Putu Ririn Hitayani', NULL, 'S.Pd.', '0', '199205092019032018', '9841770671130042', 'PEMARON', '1992-05-09', 'P', 'Hindu', 'Banjar Dinas Dauh Margi', '085737627177', 'ririn.hitayani@gmail.com', 'PNS', NULL),
('5108064910640004', '625a7a87f12f292c5e7a374a3b2934de', 'Gusti Ayu Made Dasrini', NULL, 'S.Pd.', '0', '196410091990032007', '3341742643300013', 'BANJAR TEGAL', '1964-10-09', 'P', 'Hindu', 'Jln. Srikandi Gg Mangga 9 B', '081916352438', 'adasrini@gmail.com', 'PNS', NULL),
('5108065404650005', 'bec033428d458637ad5139141d032720', 'Ni Ketut Namiasih', NULL, 'S.Pd.', '0', '196504141988032013', '3746743644300022', 'BULELENG', '1965-04-14', 'P', 'Hindu', 'JALAN GEDE WANGSA 10 PEMARON', '0895606205712', 'ketutnamiasih@yahoo.com', 'PNS', NULL),
('5108065409670004', '0933ebca6650a49c80ab0447082b723e', 'Putu Eka Sri Pandreyati', NULL, 'S.Pd.', '0', '196709141990032009', '9246745647300013', 'BULELENG', '1967-09-14', 'P', 'Hindu', 'JL. MAYOR METRA GANG 2 NO 22', '081353765587', 'pandreeka@gmail.com', 'PNS', NULL),
('5108065501920006', '3c488d804831e5918f22bfbf1cfec5ae', 'Putu Eka Srijayanti', NULL, 'S.Pd.', '0', '199201152023212001', '2447770671130042', 'Singaraja', '1992-01-15', 'P', 'Hindu', 'Dusun Kanginan Desa Kekeran', '087760193058', 'putuekasrijayanti@gmail.com', 'PPPK', NULL),
('5108065604680002', '607b5f8fd27d59b0eff2277aec98692c', 'Luh Made Karmini', NULL, 'S.Pd.', '0', '196804161990032007', '9748746647300002', 'Klungkung', '1968-04-16', 'P', 'Hindu', 'JL.PULAU NILA NO.7 SGR', '081236736196', 'karminiluhde93@gmail.com', 'PNS', NULL),
('5108065607820008', 'cbf222379cd6fb9f27934de34df8d2d0', 'Ni Nengah Sudiantari', NULL, 'S.Pd.', '0', '198207162009022001', '3048760662300073', 'Bangli', '1982-07-16', 'P', 'Hindu', 'Jalan Bisma gang Mutiara', '08703037381', 'sudiantarinengah@gmail.com', 'PNS', NULL),
('5108065807970006', 'ffe30b6820c93a4fe931ec1a12314f76', 'Made Dian Liani Larasati', NULL, 'S.Pd.', '0', NULL, '1050775676230123', 'Singaraja', '1997-07-18', 'P', 'Hindu', 'Jalan setia budi 104 singaraja', '081915608229', 'dianlianilarasati@gmail.com', 'Honor Daerah TK.I Provinsi', NULL),
('5108066011860010', '8a15b14a1d2a3a4f77213ba3473cc533', 'Ni Kadek Utarini', NULL, 'S.Pd.', '0', NULL, NULL, 'Singaraja', '1986-11-20', 'P', 'Hindu', 'Jl. Laksamana Gg. Arjuna No.5', '087863145206', 'utarinikadek@gmail.com', 'Guru Honor Sekolah', NULL),
('5108066012630004', 'af61a5ec84cf6d1a1215850c17b3df2a', 'Ni Wayan Adi Wayuni', NULL, 'S.Pd.', '0', '196312201990032006', '6552741642300013', 'DENPASAR', '1963-12-20', 'P', 'Hindu', 'BANJAR PENATARAN GANG 7 NOMOR 3', '082147091157', 'wahyuniadi390@gmail.com', 'PNS', NULL),
('5108066060600001', 'cbda48efe3009b11a9182f8d05a9f708', 'Tes Pegawai', '', 'S.Pd', '1', '199608262020121313', '1234567877', 'Singaraja', '1998-08-26', 'L', 'Hindu', 'tes alamat pegawai', '0987654323415', 'tespegawai@gmail.com', 'PNS', '5108066060600001.jpg'),
('5108066104710007', '704a725f858deeeaba09715f3bb3e5e2', 'Nyoman Kartini', NULL, 'S.Pd.', '0', '197104211997022011', '2753749651300042', 'SINGARAJA', '1971-04-21', 'P', 'Hindu', 'BTN Grya Permai Blok B no.12,', '081238737688', 'komingkartini.kk@gmail.com', 'PNS', NULL),
('5108066207860004', 'c21af144a58740b11ea678f943ba6821', 'Irma Yuliandari', NULL, 'S.Pd.', '0', '198607222009022005', '2054764665300053', 'Singaraja', '1986-07-22', 'P', 'Islam', 'Hassanudin No. 42c', '08123939392', 'youlanda_maniez@yahoo.com', 'PNS', NULL),
('5108066307820009', 'f69c961e0943e77f384ba83033629bab', 'Ni Ketut Juliadnyani', NULL, 'S.Pd.', '0', '198207232009022001', '6055760661300093', 'Pakisan', '1982-07-23', 'P', 'Hindu', 'Perumahan Multi Banyuning Lestari', '087762956375', 'ketutjuli84@gmail.com', 'PNS', NULL),
('5108066307920010', 'ebb890979c3efc5e62ed6ea8241098a0', 'Putu Anita Saraswati', NULL, 'S.Pd.', '0', '199207232023212001', '9055770671130053', 'Pemaron', '1992-07-23', 'P', 'Hindu', 'Dusun Abian-Desa Banjar Tegeha', '081338650851', 'putusaraswati37@guru.sma.belajar.id', 'PPPK', NULL),
('5108066308690011', '4391ff3928b33c126b3bb7818618cb72', 'I Gusti Ayu Made Sumanteri', NULL, 'S.Pd.', '0', '196908232007012023', '5155747648300003', 'Pejaten', '1969-08-23', 'P', 'Hindu', 'Perumahan  Banyuning Indah Blok I No. 19', '087863074927', 'igustiayusumanteri@gmail.com', 'PNS ', NULL),
('5108066312820006', '85d79c8498feb9f13b84ae99801b1395', 'Ketut Sri Rsi Wahyuni', NULL, 'S.Pd.', '0', '198212232010012039', '6555760662300083', 'Singaraja', '1982-12-23', 'P', 'Hindu', 'Jalan Matahari III', '087860102496', 'ketutsriwahyuni82@gmail.com', 'PNS', NULL),
('5108066504980007', 'cad99719229fd0ff593a870d20bbf845', 'KETUT MAS INDRI TRISTANTI', NULL, 'S.Pd.', '0', NULL, NULL, 'SINGARAJA', '1998-04-25', 'P', 'Hindu', 'Banjar Dinas Dauh Margi ', '081915608229', 'indritristanti39@gmail.com', 'Guru Honor Sekolah', NULL),
('5108066612940002', 'a2f8cf8f8043f49549e03cc6ef2c4059', 'Komang Desi Puspa Ariani', NULL, 'S.Pd.', '0', '199412262023212001', '3558772673230163', 'SINGARAJA', '1994-12-26', 'P', 'Hindu', 'JL. LAKSAMANA NO.48', '087762028442', 'komangdesipuspaariani@gmail.com', 'PPPK', NULL),
('5108066707980010', '8f15863f172dcacd47870f00d8cfe3c6', 'Komang Ayu Widi Sari', NULL, 'S.Pd.', '0', NULL, NULL, 'Singaraja', '1998-07-27', 'P', 'Hindu', 'Jalan Sahadewa Singaraja', '081915608229', 'ayuwidisari@gmail.com', 'Guru Honor Sekolah', NULL),
('5108066803880003', 'aec7fd41cba6b5db3e5be63c7be7cf21', 'Komang Trisna Dewi', NULL, 'S.Pd.', '0', '198803282015032009', '0660766667230092', 'Singaraja', '1988-03-28', 'P', 'Kristen', 'Jl. Jendral Sudirman Gang VI No. 5', '082236407174', 'ktrisna283@gmail.com', 'PNS', NULL),
('5108066810800004', '3f126ea43092e8426f9079515f5f0919', 'Kadek Budiartini', NULL, 'S.Pd.', '0', '198010282006042011', '2360758659300013', 'Singaraja', '1980-10-28', 'P', 'Hindu', 'Singaraja', '083115600170', 'budiartinik3@gmail.com', 'PNS', NULL),
('5108066901940004', '07e041aab02e8381849953bc3662437a', 'Santi Marnita', NULL, 'S.Pd.', '0', NULL, '9461772673230152', 'Singaraja', '1994-01-29', 'P', 'Hindu', 'RT XVI JALAK PUTIH VII GRAHA ASRI BLOK 8', '087852573846', 'santi.marnita1994@gmail.com', 'Guru Honor Sekolah', NULL),
('5108066911970006', '54cec11df1d48b35c0ed2f896d7f5e81', 'Ni Nyoman Putri Noviyanthi', NULL, 'S.Pd.', '0', NULL, '7461775676230063', 'Singaraja', '1997-11-29', 'P', 'Hindu', 'perum gran lovina blok A no. 03', '081915608229', 'putrinoviyanthi2911@gmail.com', 'Guru Honor Sekolah', NULL),
('5108067103690004', '412f1c249aea80d03ff428133d5d20b2', 'Titik Hairijah', NULL, 'S.Pd.', '0', '196903312007012025', '8663747648300002', 'BONDOWOSO', '1969-03-31', 'P', 'Hindu', 'JALAN WIBISANA 25 E', '087762157175', 'hairijahtitik@gmail.com', 'PNS', NULL),
('5108067105010001', '9a3953a9cb7b7ad702021201bbbce062', 'Kadek Putri Meita Damayani', NULL, 'S.Pd.', '0', NULL, NULL, 'Singaraja', '2001-05-31', 'P', 'Hindu', 'Banjar Anyar Tembles', '082342920254', 'meitadamayani@gmail.com', 'Guru Honor Sekolah', NULL),
('5108067112660281', '15fe180d616183c03ec064e36a68f96a', 'Kadek Widhiasih', NULL, 'S.Pd.', '0', '196612311997022006', '3563744647300103', 'KLUNGKUNG', '1966-12-31', 'P', 'Hindu', 'BANJAR DINAS DAUH MARGI', '085238298047', 'widhiasihkedak31@gmail.com', 'PNS', NULL),
('5108072804760003', '614432ca1d87b66c55c078872b8a71f7', 'Made Risna Adnyana', NULL, 'S.Pd.', '0', '197604282006041016', '7760754655200002', 'BULELENG', '1976-04-28', 'L', 'Hindu', 'Banjar Dinas Dukuh, Desa Sudaji', '087851252729', 'risnaadnyana91@gmail.com', 'PNS', NULL),
('5108073004740001', '6ded661343f32c414b2e1889cc632a92', 'I Ketut Sugiarta', NULL, 'S.Pd.', '0', '197404302003121006', '4762752654200012', 'SINGARAJA', '1974-04-30', 'L', 'Hindu', 'BTN GRIYA KEROBOKAN PERMAI BLOK E NO. 22', '087762278862', 'sugiartaketut651@gmail.com', 'PNS', NULL),
('5108074308890002', 'a31f6799a6090cbbb7a365506941ef82', 'Gusti Ayu Verna Devyana', NULL, 'S.Pd.', '0', NULL, '3135767668230213', 'Singaraja', '1989-08-03', 'P', 'Hindu', 'Bungkulan', '081338234728', 'ayuade615@gmail.com', 'Honor Daerah TK.I Provinsi', NULL),
('5108075403880003', 'c80ceb7bde12a08dc162091e8296c3c4', 'Kadek Santhini Dewi', NULL, 'S.Pd.', '0', '198803142023212020', '9646766667130152', 'Singaraja', '1988-03-14', 'P', 'Hindu', 'Banjar Sema', '087762774927', 'santhini1488@gmail.com', 'PPPK', NULL),
('5108075409880001', '8dc8b30ab1e4f5e6b53cff4b8a486e48', 'Ni Nyoman Wenny Kusumawati', NULL, 'S.Pd.', '0', '198809142022212001', '3246766667130103', 'Singaraja', '1988-09-14', 'P', 'Hindu', 'Jalan Melati no. 45', '081805512129', 'wennykusumawati88@gmail.com', 'PPPK', NULL),
('5108080706840001', 'a7f6f0e66a4d1454c0137a03ef2bb202', 'I Wayan Bingin Astra', NULL, 'S.Pd.', '0', '198406072019031006', '3939762663130202', 'Bontihing', '1984-06-07', 'L', 'Hindu', 'Jalan Antasura', '082339566212', 'astrabingin84@gmail.com', 'PNS', NULL),
('5108081707890003', 'e97ef72afbbda1eeb9979cf23b1b7416', 'Gede Widiarya', NULL, 'S.Pd.', '0', '198907172022211016', '7049767668130103', 'TAMBLANG', '1989-07-17', 'L', 'Hindu', 'Banjar Dinas Kelod Kauh', '085858634442', 'weedee.arya@gmail.com', 'PPPK', NULL),
('5108086707960002', 'd74c21677b88e1f0f4008005f8c7b18a', 'Ni Nyoman Sartini', NULL, 'S.Pd.', '0', '199607272023212001', '6059774675230153', 'Bontihing', '1996-07-27', 'P', 'Hindu', 'Bontihing', '087763128192', 'komangtini62@gmail.com', 'PPPK', NULL),
('5171044302940001', '843cc264a1e9ad926dd1a2a6fdb59a90', 'Ni Wayan Poppy Handayani', NULL, 'S.Pd.', '0', '199402032023212001', '1535772673130032', 'Denpasar', '1994-02-03', 'P', 'Hindu', 'Br. Dinas Runuh Kubu, Desa Padangbulia, Sukasada', '082147415538', 'niwayanpoppyhandayani@gmail.com', 'PPPK', NULL),
('5171044304810005', '470aeec5a209bf6df2c9ef439a16015b', 'Nyoman Suarriati', NULL, 'S.Pd.', '0', NULL, '0735759661300062', 'SAMBANGAN', '1981-04-03', 'P', 'Hindu', 'JL. VETERAN NO.17 DENPASAR', '087863286335', 'jeroria15274@gmail.com', 'Honor Daerah TK.I Provinsi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `npsn` varchar(10) NOT NULL,
  `NSS` varchar(15) NOT NULL,
  `nama_sekolah` varchar(200) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `telp_sekolah` varchar(20) NOT NULL,
  `email_sekolah` varchar(100) NOT NULL,
  `web_sekolah` varchar(200) NOT NULL,
  `nama_kepsek` varchar(255) NOT NULL,
  `nip_kepsek` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`npsn`, `NSS`, `nama_sekolah`, `jenjang`, `alamat`, `telp_sekolah`, `email_sekolah`, `web_sekolah`, `nama_kepsek`, `nip_kepsek`) VALUES
('50100287', '', 'SMA Negeri 4 Singaraja', '3', 'Jalan Melati, Kelurahan Banjar Jawa, Kecamatan Buleleng, Kabupaten Buleleng', '(0362) 22845', 'sman4singaraja@gmail.com', 'sman4singaraja.sch.id', 'Putu Gede Wartawan,S.Pd.,M.Pd.', '197002241995031003');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(15) NOT NULL,
  `nisn_en` varchar(255) NOT NULL,
  `nis` varchar(10) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jk` varchar(2) DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `alamat_ortu` varchar(200) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `sekolah_asal` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tahun_masuk` year(4) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `status_aktif` varchar(1) NOT NULL,
  `tahun_out` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nisn_en`, `nis`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jk`, `agama`, `alamat`, `no_hp`, `email`, `alamat_ortu`, `nama_ayah`, `nama_ibu`, `sekolah_asal`, `foto`, `tahun_masuk`, `id_kelas`, `status_aktif`, `tahun_out`) VALUES
('1234567890', 'e807f1fcf82d132f9bb018ca6738a19f', '1234', '5108062608960003', 'I Made Arya Adinata Dwija Putra', 'Singaraja', '1996-08-26', 'L', 'Hindu', 'Jl. Pulau Jawa, Lingk. Banyuning Utara', '098765432123', 'aryaadinata26@gmail.com', 'Jl. Pulau Jawa, Lingk. Banyuning Utara', 'Tes Nama Ayah', 'Tes Nama Ibu', 'SMP N 5 Singaraja', '1234567890.jpg', 2023, 7, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun` int(11) NOT NULL,
  `tahun_awal` year(4) NOT NULL,
  `tahun_akhir` year(4) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun`, `tahun_awal`, `tahun_akhir`, `status`) VALUES
(2, 2023, 2024, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tingkat`
--

CREATE TABLE `tingkat` (
  `id_tingkat` int(11) NOT NULL,
  `tingkat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tingkat`
--

INSERT INTO `tingkat` (`id_tingkat`, `tingkat`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `pass`, `level`) VALUES
('0987654321', '$2y$10$7Sx3drvUQ2zKc8Afak1o0ed8Db/4X0PEY1OMkItVbl2f2ilCZyvYC', 1),
('12121212', '$2y$10$N2dxbtkXLYDxOPeawxrwRebMvWZjUx9aECbwqBgeZjDX2CP8aEQeG', 1),
('1234567890', '$2y$10$dIjIPQOWZTLhTFuffLYfV.Sb.dfxDnZJYHSQCGmIRyvwFfpUXl0na', 1),
('foursma', '$2y$10$pqZ2yEzouAQrXiugvNgQ7.i9Sn.dLmeWPpaI2kECBY5Poy7xEgJgq', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `nisn` (`nisn`);

--
-- Indexes for table `identitas_sekolah`
--
ALTER TABLE `identitas_sekolah`
  ADD PRIMARY KEY (`npsn`);

--
-- Indexes for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  ADD PRIMARY KEY (`id_jenis_pelanggaran`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_jurusan` (`id_jurusan`),
  ADD KEY `id_tingkat` (`id_tingkat`),
  ADD KEY `wali_kelas` (`wali_kelas`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`id_kel`),
  ADD KEY `nisn` (`nisn`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `id_jenis_pelanggaran` (`id_jenis_pelanggaran`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `nik_ptk` (`nik_ptk`);

--
-- Indexes for table `pengunjung_perpus`
--
ALTER TABLE `pengunjung_perpus`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD KEY `nisn` (`id_siswa`),
  ADD KEY `id_ptk` (`id_ptk`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `nisn` (`nisn`);

--
-- Indexes for table `ptk`
--
ALTER TABLE `ptk`
  ADD PRIMARY KEY (`nik_ptk`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`npsn`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_tahun` (`tahun_masuk`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun`);

--
-- Indexes for table `tingkat`
--
ALTER TABLE `tingkat`
  ADD PRIMARY KEY (`id_tingkat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `id_jenis_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `id_kel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengunjung_perpus`
--
ALTER TABLE `pengunjung_perpus`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tingkat`
--
ALTER TABLE `tingkat`
  MODIFY `id_tingkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_tingkat`) REFERENCES `tingkat` (`id_tingkat`),
  ADD CONSTRAINT `kelas_ibfk_2` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`),
  ADD CONSTRAINT `kelas_ibfk_3` FOREIGN KEY (`id_tingkat`) REFERENCES `tingkat` (`id_tingkat`),
  ADD CONSTRAINT `kelas_ibfk_4` FOREIGN KEY (`wali_kelas`) REFERENCES `ptk` (`nik_ptk`);

--
-- Constraints for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD CONSTRAINT `keluarga_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`);

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`id_jenis_pelanggaran`) REFERENCES `jenis_pelanggaran` (`id_jenis_pelanggaran`),
  ADD CONSTRAINT `pelanggaran_ibfk_2` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`),
  ADD CONSTRAINT `pelanggaran_ibfk_3` FOREIGN KEY (`nik_ptk`) REFERENCES `ptk` (`nik_ptk`);

--
-- Constraints for table `pengunjung_perpus`
--
ALTER TABLE `pengunjung_perpus`
  ADD CONSTRAINT `pengunjung_perpus_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`nisn`),
  ADD CONSTRAINT `pengunjung_perpus_ibfk_2` FOREIGN KEY (`id_ptk`) REFERENCES `ptk` (`nik_ptk`);

--
-- Constraints for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
