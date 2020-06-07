-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2020 at 02:46 PM
-- Server version: 10.2.32-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faleacom_tabungansekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `ts_jenis_biaya`
--

CREATE TABLE `ts_jenis_biaya` (
  `idJenisBiaya` int(11) NOT NULL,
  `nama` char(150) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_jenis_biaya`
--

INSERT INTO `ts_jenis_biaya` (`idJenisBiaya`, `nama`, `keterangan`) VALUES
(1, 'Uang Buku', 'Buku Agama');

-- --------------------------------------------------------

--
-- Table structure for table `ts_kelas`
--

CREATE TABLE `ts_kelas` (
  `idKelas` int(11) NOT NULL,
  `namaKelas` char(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_kelas`
--

INSERT INTO `ts_kelas` (`idKelas`, `namaKelas`) VALUES
(1, 'Kelas 1-1'),
(2, 'Kelas 1-2'),
(3, 'Kelas 1-3'),
(4, 'Kelas 1-4'),
(5, 'Kelas 1-5'),
(6, 'Kelas 2-1'),
(7, 'Kelas 2-2'),
(8, 'Kelas 2-3'),
(9, 'Kelas 3-1'),
(10, 'Kelas 3-2'),
(11, 'Kelas 4-1'),
(12, 'Kelas 4-2'),
(13, 'Kelas 5-1'),
(14, 'Kelas 5-2'),
(15, 'Kelas 6'),
(16, 'Kelas 7-1'),
(17, 'Kelas 7-2'),
(18, 'Kelas 7-3'),
(19, 'Kelas 7-4'),
(20, 'Kelas 8-1'),
(21, 'Kelas 8-2'),
(22, 'Kelas 8-3'),
(23, 'Kelas 8-4'),
(24, 'Kelas 9-1'),
(25, 'Kelas 9-2'),
(26, 'Kelas 9-3'),
(27, 'Kelas 9-4');

-- --------------------------------------------------------

--
-- Table structure for table `ts_reverse`
--

CREATE TABLE `ts_reverse` (
  `idReverse` int(11) NOT NULL,
  `nomorTransaksi` char(250) NOT NULL,
  `keterangan` text NOT NULL,
  `statusReverse` char(7) NOT NULL DEFAULT 'pending' COMMENT 'pending, reverse',
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ts_sekolah`
--

CREATE TABLE `ts_sekolah` (
  `idSekolah` int(11) NOT NULL,
  `nama` char(200) NOT NULL,
  `alamat` tinytext NOT NULL,
  `noHP` char(15) NOT NULL,
  `email` char(200) NOT NULL,
  `tglPendiri` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ts_siswa`
--

CREATE TABLE `ts_siswa` (
  `idSiswa` int(11) NOT NULL,
  `nis` char(200) NOT NULL COMMENT 'format tahun.xxxxx (5 angka setelah tahun)',
  `nama` char(100) NOT NULL,
  `alamat` tinytext NOT NULL,
  `noHP` char(15) NOT NULL,
  `email` char(150) NOT NULL,
  `jenisKelamin` char(1) NOT NULL COMMENT 'L atau P',
  `namaIbuKandung` char(100) NOT NULL,
  `namaAyahKandung` char(100) NOT NULL,
  `noHPOrangTua` char(15) NOT NULL,
  `kelas` char(150) NOT NULL COMMENT 'idKelas',
  `tahunAjaran` char(10) NOT NULL,
  `status` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_siswa`
--

INSERT INTO `ts_siswa` (`idSiswa`, `nis`, `nama`, `alamat`, `noHP`, `email`, `jenisKelamin`, `namaIbuKandung`, `namaAyahKandung`, `noHPOrangTua`, `kelas`, `tahunAjaran`, `status`) VALUES
(1, '0099996146', 'ABDI ALVIANSYAH', 'JL. TANJUNG ANOM GANG SKARYO', '081397412503', '', 'L', 'PARTIA WIGIATI', 'NGADIRIN GINTING', '', '9', 'null', 'null'),
(2, '0066828220', 'Abdurrafi Damanik', 'JL.TAMPOK', '', '', 'L', 'Henni May Syarah', 'IRWANSYAH DAMANIK', '', '15', 'null', 'null'),
(3, '3139447608', 'ABRARUZ ZAYDAN', 'Griya Tanjung Asri No E2', '', '', 'L', 'Zulia Rahmah', 'Nofri Zulyadi', '', '2', 'null', 'null'),
(4, '0113568654', 'Achmad Sabrul', 'Jl. Pimpinan', '', '', 'L', 'Marlina', 'Sabaruddin', '', '8', 'null', 'null'),
(5, '0131436956', 'ADIBA ZAFIRAH', 'Jl. HM Puna Sembring Griya II DD 6', '', '', 'P', 'Siti Halimah', 'Endang Rudianto', '', '4', 'null', 'null'),
(6, '3137773267', 'ADINDA NATASYA', 'Dusun III Gg. Amal', '', '', 'P', 'Ida Fitriani', 'Suprapto', '', '4', 'null', 'null'),
(7, '0087444431', 'ADIT AKBAR PRATAMA', 'DUSUN I GG. KELUARGA TJ. SELAMAT', '', '', 'L', 'YULIANA', 'ARI SUSANDI', '', '14', 'null', 'null'),
(8, '3117048481', 'Adit Tian', 'Dusun III', '', '', 'L', 'Fitriawati', 'Boy', '', '6', 'null', 'null'),
(9, '0099556265', 'ADITYA NURSANDI', 'DUSUN V PONDOK 45', '', '', 'L', 'DARIYANI', 'SAMINO', '', '13', 'null', 'null'),
(10, '0093856615', 'ADITYA PRATAMA', 'JL GAPERTA NO 305 B', '', '', 'L', 'JULIANI', 'RIKI NOPIKA', '', '12', 'null', 'null'),
(11, '0128377160', 'Adnan Muhtadin Surbakti', 'Jl. Tampok', '', '', 'L', 'Widyaningsih', 'M.Rusli Surbakti', '', '6', 'null', 'null'),
(12, '0129894591', 'Adrian Wardhana', 'Jl. Tanjung Selamat Gg. Keluarga', '', '', 'L', 'Kusmina Wati', 'Faisal Anwar', '', '7', 'null', 'null'),
(13, '0121168801', 'Afif Raditya Prananda', 'Jl. Flamboyan Raya', '', '', 'L', 'Rizky Aini Ananda MP', 'Dibyo Prasetyo', '', '6', 'null', 'null'),
(14, '0121968677', 'Afifa Keisha Azzahra Siregar', 'Jl. Besar Tanjung Selamat', '', '', 'P', 'Abidah', 'Bachtiar Alamsyah Siregar', '', '8', 'null', 'null'),
(15, '0122884470', 'Afifa Rahmawan Sinaga', 'Jl. Kenanga Raya Gg. Selamat No. 2 Lk I', '', '', 'P', 'Siti Khadijah Nasution', 'Faesal Rahmawan Sinaga', '', '8', 'null', 'null'),
(16, '0081197105', 'AGUNG ALIF PUTRA SUTADI', 'JL.SNAKMA GG.SNAKMAIII', '', '', 'L', 'LENI HERLINA', 'DIDI SUTADI', '', '15', 'null', 'null'),
(17, '3122622460', 'AGUSTIN RAHMADANI', 'Jl. Pendidikan No. 481 Dusun III', '', '', 'P', 'Musinah', 'Anton S Riyadi', '', '3', 'null', 'null'),
(18, '0114065444', 'AHMAD AZZAM RAMADHAN', 'JL. TAMPOK', '081367425452', '', 'L', 'NUR SAHARA', 'MARZUKI', '', '10', 'null', 'null'),
(19, '0112578675', 'Ahmad Daffa Anshari', 'Jl. Tanjung Selamat', '', '', 'L', 'Nila Sari', 'M. Rivansyah', '', '7', 'null', 'null'),
(20, '3128160010', 'AIDIL YUSUF', 'Dusun IV Tanjung Selamat', '', '', 'L', 'Ema Rama Yanti', 'Khairul Nizar', '', '3', 'null', 'null'),
(21, '0093789290', 'AIDIL ZUHRI', 'DUSUN I.A TANJUNG SELAMAT', '', '', 'L', 'JULIANA', 'FRAN HADI', '', '13', 'null', 'null'),
(22, '0093764830', 'AIRA MAYA ARDILA', 'JL. PERJUANGAN GG. REZEKI', '', '', 'P', 'RINA SARI', 'DARMAYANTO', '', '14', 'null', 'null'),
(23, '0082705611', 'Aisah Putri Rambe', 'Flamboyan XII', '085762636186', '', 'P', 'Ritawani', 'Doni Syahputra', '', '15', 'null', 'null'),
(24, '0123703595', 'Aisya Putri', 'Jl. Delima', '', '', 'P', 'Suprapti', 'Azaruddin', '', '7', 'null', 'null'),
(25, '0107288721', 'AJENG KADEK RAYSAFITRI', 'DUSUN I GG. KELUARGA', '', '', 'P', 'PONISIH', 'SUSINO', '', '11', 'null', 'null'),
(26, '0097280406', 'AKBAR', 'JL. DAHLIA RAYA LK VI NO-22', '', '', 'L', 'EVIYULITA MATONDANG', 'ARDIANSYAH', '', '13', 'null', 'null'),
(27, '0128681856', 'Akbar Hamonangan Silalahi', 'Jl. Komp Danamon', '', '', 'L', 'Chairul Misbah.Y', 'Foreman Silalahi', '', '6', 'null', 'null'),
(28, '0117932632', 'AKBAR MAULANA S', 'DUSUN II-A GG. HIDAYAH TANJUNG SELAMAT', '081263431011', '', 'L', 'DEWI MASITA', 'CHAIRUL FAUZI', '', '9', 'null', 'null'),
(29, '0132266941', 'AKHDAN GHIFARI', 'Dusun II A Gg. Hidayah', '', '', 'L', 'Sri Ami', 'Yusmadi', '', '3', 'null', 'null'),
(30, '3134800624', 'AKHTAR AL FRIAN ATHAYA', 'S. Karyo', '', '', 'L', 'Julian Waela', 'Yudi Frianto', '', '1', 'null', 'null'),
(31, '0082503645', 'Al-Fazri', 'JL. TANJUNG SELAMAT', '', '', 'L', 'Yeni Ningsih Astuti', 'YULI SURONO', '', '15', 'null', 'null'),
(32, '0099956769', 'AL HADID UTAMA', 'PSR 2 GBDEWI VIII LK IX-31', '', '', 'L', 'JURIANTA', 'MARLI', '', '13', 'null', 'null'),
(33, '0098560515', 'ALBAR AFTRI RADJASYAH NASUTION', 'JL. PURI ANOM ASRI BLOK D 34', '', '', 'L', 'EMILIA YUNI HARTATI', 'RISJUANSYAH NASUTION', '', '11', 'null', 'null'),
(34, '0136034494', 'ALBAR IBRAHIM NASUTION', 'Perum Minimalis Sembahe Baru', '', '', 'L', 'Anti Juraida Siregar', 'M.Fauzi Nasution', '', '3', 'null', 'null'),
(35, '3138991369', 'ALBY LUTHFI FACHRI', 'Tanjung Anom Dusun III', '', '', 'L', 'Etta Yulianis', 'Ferri Andika', '', '4', 'null', 'null'),
(36, '0099247080', 'ALDI FERDINAN MATANARI', 'PERUM PURI ANOM ASRI BLOK E NO. 39', '', '', 'L', 'NELLI SIHOMBING', 'DIRMAN MATANARI', '', '12', 'null', 'null'),
(37, '3113375542', 'Aldi Pratama Syaputra', 'Jl. Tampok Tanjung Selamat', '', '', 'L', 'Nurma Ningsih', 'Wiyanto', '', '15', 'null', 'null'),
(38, '0097941980', 'Alfa Aunillah Hasibuan', 'JL.PERJUANGAN', '081370701412', '', 'P', 'Rika Agustina', 'Mhd. Ali Hasibuan', '', '15', 'null', 'null'),
(39, '0138851925', 'ALFIANSYA', 'Jl. Tanjung Selamat Gg Perdamaian', '', '', 'L', 'Nurhalimah', 'Syaiful Ginting', '', '1', 'null', 'null'),
(40, '0102660699', 'ALFIN ALAMSYAH', 'JL. PERCOBAAN UJUNG', '081362632707', '', 'L', 'MURNIATI', 'ZULKARNAIN', '', '9', 'null', 'null'),
(41, '0123197583', 'Ali Fauzan Arif', 'Jl. Sei Beras Sekata', '', '', 'L', 'Dewi Yana', 'Kardiyanto', '', '8', 'null', 'null'),
(42, '3138580361', 'ALIEF DZAKY SYAPUTRA', 'Dusun I Tanjung Selamat', '', '', 'L', 'Winda Sari', 'Indra Syahputra', '', '2', 'null', 'null'),
(43, '0115729020', 'ALIF HABIBI RAMADHAN', 'JL. PERUM DANAMON', '082167773425', '', 'L', 'SUSILOWATI', 'SUTADI', '', '9', 'null', 'null'),
(44, '0111758116', 'ALIFAH NAYLA HUSNA', 'JL. AMAL NO 422', '081362223134', '', 'P', 'RUZANNA', 'EDY SUTRISNO', '', '9', 'null', 'null'),
(45, '0102020174', 'ALIFFANSYAH', 'JL. SYUHBRASTA I NO. 11 DSN 6 DESA DELI TUA', '', '', 'L', 'SRI AINUN', 'SUYANTO', '', '9', 'null', 'null'),
(46, '0137222720', 'ALIFIANDRA AL-KHALIFI', 'Jl. Kiwi Gg Pribadi No 25', '', '', 'L', 'Dwi Syahfitri', 'Nur Anwar', '', '1', 'null', 'null'),
(47, '0127406929', 'Alifya Tasya Yunzira', 'Jl. Flamboyan Raya Gg. Bahrum', '', '', 'P', 'Ani Sibuea', 'Meihardi Habibi', '', '7', 'null', 'null'),
(48, '0111144328', 'Alisya Umairoh', 'Jl. Percobaan', '', '', 'P', 'Yulita Lolo Karina Limbong', 'Anwar Eka Saputra', '', '7', 'null', 'null'),
(49, '0127607124', 'ALMYRA LATISHA ZAHRA', 'Jl. MT Haryono', '082168243443', '', 'P', 'YULIA SUENGGAR', 'M ZAIN AL ANSARI', '', '8', 'null', 'null'),
(50, '0117961069', 'ALWAN ARAFI', 'JL. TAMPOK', '081288353701', '', 'L', 'IRMA YANI', 'ZULKIFLI SIREGAR', '', '9', 'null', 'null'),
(51, '0107906332', 'ALYA ZYAZURA', 'JL. KUTAMBELIN', '085361017164', '', 'P', 'SARIPAH NOVIANTI TARIGAN', 'ERICK SUDARMAN', '', '9', 'null', 'null'),
(52, '0091257211', 'AMANDA OKTAFIANI', 'TANJUNG SELAMAT', '', '', 'P', 'SUHARIANI', 'RAMLI', '', '14', 'null', 'null'),
(53, '0125702038', 'Amelia', 'Jl. Flamboyan VIII LK.II', '', '', 'P', 'Siti Aisyah', 'Syafrizal', '', '7', 'null', 'null'),
(54, '0085318022', 'AMELIA SYAHFITRI', 'DUSUN II-B JLN. PERJUANGAN', '', '', 'P', 'ADE MAWARNI', 'SUTARNO', '', '14', 'null', 'null'),
(55, '0112094042', 'AMIRA AZKIA CIBRO', 'JL. PERJUANGAN PONDOK INDAH', '082360440644', '', 'P', 'HALIMAH', 'RAJUDDIN CIBRO', '', '9', 'null', 'null'),
(56, '0133020035', 'ANASTASYA SAFIRA SARDI', 'Asmil Yonarhanud SE II/BS', '', '', 'P', 'Ririn Oktavia', 'Ipandri Sardi', '', '3', 'null', 'null'),
(57, '0115132863', 'ANDHIKA DINATA RABBANI', 'DUSUN II TANJUNG SELAMAT GG. BERSAMA', '082165503878', '', 'L', 'SITI NURBAIDAH', 'ILHAM HARIANTO', '', '9', 'null', 'null'),
(58, '0112381331', 'ANDI PRANATA', 'JL. TAMPOK', '085270538923', '', 'L', 'ARMI', 'SURATMAN', '', '9', 'null', 'null'),
(59, '0096730033', 'ANDIKA PRATAMA', 'DUSUN II-B JLN. PERJUANGAN GG. DAUN', '', '', 'L', 'DESI RAHMA SARI', 'RAHMANSYAH', '', '14', 'null', 'null'),
(60, '3126793139', 'ANDIKA PRATAMA', 'Jl. Pancasila Dusun I', '', '', 'L', 'Siti Yunita', 'Dedi Saputra', '', '1', 'null', 'null'),
(61, '0119177202', 'ANDINI PRATIWI', 'KOMP. PERUMAHAN PURI ANOM ASRI', '', '', 'P', 'FATIMAH', 'MAWAN', '', '10', 'null', 'null'),
(62, '0135699397', 'ANDRI ALIF AKBAR', 'Dusun II-B Tanjung Selamat', '', '', 'L', 'Suinariah', 'Adi Subari', '', '3', 'null', 'null'),
(63, '3137589229', 'ANGGI REVINA PUTRI', 'Dusun III Gg Telkom', '', '', 'P', 'Suherni', 'Sunan', '', '5', 'null', 'null'),
(64, '0135207409', 'ANGGUN TIARA SALSABILA', 'Dusun VI', '', '', 'P', 'Rumsiati', 'Wahyudi', '', '2', 'null', 'null'),
(65, '0126074441', 'ANISA ARIFA', 'JL. PERJUANGAN GRIYA MUTIARA 2', '', '', 'P', 'DEWI SUMIATY', 'ZAINAL ABIDIN', '', '10', 'null', 'null'),
(66, '0093157532', 'ANNISA', 'DUSUN III TANJUNG SELAMAT', '', '', 'P', 'SAHRIANA SURBAKTI', 'ARSANIK', '', '14', 'null', 'null'),
(67, '0105384737', 'ANNISA FADHILAH', 'JL. TANJUNG ANOM', '', '', 'P', 'FITRIANI', 'ZULKARNAEN', '', '11', 'null', 'null'),
(68, '0089375176', 'ANNISA SALSABILA', 'JL. SEMBAHE BARU', '', '', 'P', 'SANTI', 'BUDI KURNIAWAN', '', '11', 'null', 'null'),
(69, '3128727483', 'APRIL NOVIANA', 'Gang S. Karyo', '', '', 'P', 'Riyanti', 'Arya Kesuma', '', '5', 'null', 'null'),
(70, '3137228647', 'AQILA HAMDA AZAHWA', 'Perumahan Puri Anom Asri Blok D F48', '', '', 'P', 'Rolanda Lestari', 'Achmad Hambali', '', '2', 'null', 'null'),
(71, '3139415562', 'AQILAH RAHMA', 'Tanjung Selamat', '', '', 'P', 'Yusmidar', 'Riski Nanda', '', '2', 'null', 'null'),
(72, '0116012559', 'AQILLAH MYCHIKA', 'JL. BESAR TANJUNG ANOM', '082162782286', '', 'P', 'FENNY ARIANI', 'BEDI SUHENDRA', '', '10', 'null', 'null'),
(73, '0094658575', 'ARBAINI LESTARI', 'DUSUN II TANJUNG SELAMAT', '', '', 'P', 'PAIJEM', 'RUSMIN', '', '13', 'null', 'null'),
(74, '0101593138', 'ARBI SYAHPUTRA', 'JL. PERCOBAAN', '', '', 'L', 'SENI WATI SEMBIRING', 'ARSIM SULAIMAN', '', '10', 'null', 'null'),
(75, '0107377175', 'ARIF SYAHPUTRA', 'JL. TANJUNG SELAMAT GG PLAMBOYAN II', '082164998075', '', 'L', 'SARASWATI', 'MUHAMMAD RIZKI', '', '12', 'null', 'null'),
(76, '0098543451', 'Arifah Khairiyah', 'JL. TAMPOK DUSUN V TANJUNG SELAMAT', '', '', 'P', 'SULASTRI', 'PONIMAN', '', '14', 'null', 'null'),
(77, '0125286865', 'ARIKA NAZHIFA SALSABILA', 'Jl. Cinta Karya Gg Pantai No 40', '', '', 'P', 'Delina Yustia', 'Misriadi', '', '2', 'null', 'null'),
(78, '0123995662', 'Arini Hana Maimanah', 'Jl. Perjuangan Gang Ferari', '', '', 'P', 'Suliyah Handayani', 'M. Yunus. S', '', '7', 'null', 'null'),
(79, '0107176126', 'ARIQ WIGUNA PRATAMA', 'JL. PERJUANGAN GG. MUFAKAT', '082367856500', '', 'L', 'DEWI KESUMA', 'GUNADI SARAGIH', '', '11', 'null', 'null'),
(80, '0127143143', 'Ariqah Sabila Harahap', 'Jl. Percobaan Perum Grand Citra Asri', '', '', 'P', 'Gayatri Dinanti', 'Abdullah Syukri Harahap', '', '8', 'null', 'null'),
(81, '3131880124', 'ARKAN SABIQ RABBANI SIREGAR', 'Jl. Pasar I Gg Pondok Serumpun', '', '', 'L', 'Rinanda Elfira', 'Ahmad Zaki Mubarak Siregar', '', '3', 'null', 'null'),
(82, '0107796268', 'ARPA ADILA', 'JL. TAMPOK TANJUNG SELAMAT', '', '', 'L', 'LINDA', 'HERIADI', '', '10', 'null', 'null'),
(83, '0085132926', 'ARYA HAFIZH AL RASYID', 'JL. TANJUNG SELAMAT', '', '', 'L', 'AJENG ANDINI FEBRIANA', 'RASYIONO', '', '15', 'null', 'null'),
(84, '0127674639', 'ASRAAF PRAWARA PUTRA', 'SEI BERAS SEKATA', '0813625600822', '', 'L', 'Widya Ardi Yanthi', 'ANDI SYAHPUTRA', '', '5', 'null', 'null'),
(85, '0122919812', 'Asyifa Nuri Aldy', 'Jl. Komplek Kejaksaan', '', '', 'P', 'Juriah', 'Nursyamsu Aldy', '', '6', 'null', 'null'),
(86, '0127250746', 'Atifah Sari Br Bancin', 'Jl. Tanjung Selamat', '', '', 'P', 'Kayani Brutu', 'Sawantes Bancin', '', '6', 'null', 'null'),
(87, '0089273278', 'ATQIA KHANZA', 'JL.JAMIN GINTING GG.AMAN', '', '', 'P', 'SUYANTI', 'IRWANTO', '', '15', 'null', 'null'),
(88, '3127656039', 'Aufa Fatiya Rahma', 'Jl. Tanjung Selamat Gg. Mesjid', '', '', 'P', 'Siti Nurbaya', 'Een Syahputra', '', '6', 'null', 'null'),
(89, '0123475428', 'Aulia Mirzani', 'Dusun I-A Gg. Selian', '', '', 'P', 'Muna Purwati', 'Muhammad Ridwa', '', '8', 'null', 'null'),
(90, '0084032383', 'AURA SAHPUTRI', 'DSN IV JL. TAMPOK TANJUNG SELAMAT', '', '', 'P', 'LINDA', 'HERIADI', '', '12', 'null', 'null'),
(91, '0135903833', 'AYU ASIFA', 'Dusun I-A Gg. Keluarga', '', '', 'P', 'Sumiarti', 'Syawal', '', '5', 'null', 'null'),
(92, '0082800467', 'AYUDILA ERVIANTI', 'JL. KUTA MBELIN GLUGUR RIMBUN', '', '', 'P', 'SARIPAH NOVIANTI TARIGAN', 'ERICK SUDARMAN', '', '13', 'null', 'null'),
(93, '0092707005', 'AYUNDA WIJAYA', 'JL.JAMIN GINTING Gg.BERSAMA NO.66', '', '', 'P', 'JURIANA', 'VISA WIJAYA', '', '11', 'null', 'null'),
(94, '0117996744', 'AZ.ZAHRA KHUMAIROH', 'DUSUN IV JL. PERPAS TANJUNG SELAMAT', '081263060891', '', 'P', 'NURSAMSIYAH', 'JULHAM', '', '10', 'null', 'null'),
(95, '0085106966', 'Azhar Heriansa', 'JL.PERJUANGAN', '', '', 'L', 'Siti Napsiah', 'SUSIADI', '', '15', 'null', 'null'),
(96, '0082930550', 'AZIIZ AL FACHRY', 'JL.PERJUANGAN', '', '', 'L', 'SULIYAH HANDAYANI', 'M. YUNUS. S', '', '15', 'null', 'null'),
(97, '0136566376', 'AZKA AULIA', 'Tanjung Anom', '', '', 'P', 'Evi Handayani', 'Primahandika', '', '5', 'null', 'null'),
(98, '0093056120', 'AZKA PRAJA', 'Jalan Nusa Indah', '', '', 'L', 'MARDIAH', 'EDY SASMITA', '', '13', 'null', 'null'),
(99, '0087130377', 'AZRIL AL\'AMIN', 'TANJUNG SARI GG.MELATI', '', '', 'L', 'SUTINAH', 'NGATINO', '', '15', 'null', 'null'),
(100, '0077603307', 'Azril Baihaqi', 'JL. TAMPOK', '', '', 'L', 'Khayri Indana', 'BAMBANG SURYADI', '', '15', 'null', 'null'),
(101, '0137054072', 'AZUMYARDI IKSAN NOORSY SINAGA', 'Perum Tanjung Anom Residence Blok D-4', '', '', 'L', 'Minta Ito Meha', 'Junedy Martoni Sinaga', '', '5', 'null', 'null'),
(102, '0116769460', 'Azzam Syauqi Rabbani', 'Telaga Sari', '', '', 'L', 'Nuraini', 'Syafri', '', '6', 'null', 'null'),
(103, '0094024385', 'BAGAS PUTRA SURYA', 'TANJUNG SELAMAT', '', '', 'L', 'SUNARSIH', 'SURYA ABADI', '', '13', 'null', 'null'),
(104, '3136650024', 'BAIHAQI AGATHA', 'Jl. Balai Desa Dusun III', '', '', 'L', 'Arrinny Delyuza', 'Muhammad Agung Prayoga', '', '3', 'null', 'null'),
(105, '0128614071', 'CAISSYA ANANDA BR SEMBIRING', 'Dusun IV Tanjung Anom', '', '', 'P', 'Beby Mustika Devi', 'Heri Rahmanta Sembiring', '', '1', 'null', 'null'),
(106, '0165572011', 'Candi Hariadi', 'Tanjung Anom', '', '', 'L', 'Devi Hamdayani', 'Sugiharto', '', '12', 'null', 'null'),
(107, '0093192177', 'CARISA PUTRI', 'JL. BESAR TANJUNG ANOM', '082274226422', '', 'P', 'HERNIDA SILALAHI', 'BUDI KURNIAWAN', '', '9', 'null', 'null'),
(108, '0105941571', 'CHACHA NABILA', 'DUSUN I-A TANJUNG SELAMAT', '', '', 'P', 'AFRYANITA BR SEMBIRING MILALA', 'ZULKARNAIN', '', '11', 'null', 'null'),
(109, '3136947733', 'CHAIRUL FAJAR RAJAB', 'Gang S. Karyo', '', '', 'L', 'Sri Rahayuni', 'Kaharuddin', '', '2', 'null', 'null'),
(110, '0135741393', 'CHANTYKA AURELYA POHAN', 'Tanjung Selamat Gg Keluarga', '', '', 'P', 'Ernawati', 'Budiman Amri Pohan', '', '5', 'null', 'null'),
(111, '0129915971', 'Charlie Maalik', 'Asrama Yonkav 6-Serbu Medan', '', '', 'L', 'Vivi Suhartini', 'Wiwit Sutikno', '', '8', 'null', 'null'),
(112, '0114481790', 'Chiara Nahira', 'Jl. Perum Griya Mutiara 3 BE55', '', '', 'P', 'Suji Pratiwi', 'Fajar Sidik', '', '7', 'null', 'null'),
(113, '0137884382', 'CIKAL PANGERAN PRIBADI', 'Dusun IB Gg. Arjuna', '', '', 'L', 'Maryuna', 'Eko Pribadi', '', '2', 'null', 'null'),
(114, '0094141978', 'CINTA RIFANA ZAHIRA NST', 'JL. PERCOBAAN', '', '', 'P', 'SUPRIANA', 'AHMAD SUHERI NST', '', '11', 'null', 'null'),
(115, '0124867029', 'CITRA AMELIA', 'Dusun II-B Jl. Perjuangan Gg. Mufakat No. 9-A', '', '', 'P', 'Yus Rina', 'Eri Yanto', '', '4', 'null', 'null'),
(116, '0123400408', 'Clara Nadhifa Dian Nandra', 'Jl. Percobaan', '', '', 'P', 'Suwarningsih', 'Eko Artin Dian Nandra', '', '8', 'null', 'null'),
(117, '3135863096', 'CUT KAYLA AL ZAHRA', 'Dusun I A Tanjung Selamat', '', '', 'P', 'Nasriyati', 'Berama Kumbara', '', '1', 'null', 'null'),
(118, '0076407584', 'Cut Savina Kesyah Billa', 'Glugur Rimbun', '', '', 'P', 'Rusmawati', 'T Hasminansyah', '', '15', 'null', 'null'),
(119, '0136527554', 'DAFFA SHADIQ ALPUTRA', 'Jl. Perjuangan Tanjung Selamat Residence', '', '', 'L', 'Nirmayasari P. Tondang', 'Putra Kusmanto', '', '3', 'null', 'null'),
(120, '0136673315', 'DAFFA SYAHPUTRA', 'Dusun II-A Jl. Percobaan', '', '', 'L', 'Jumiati', 'Mujianto', '', '2', 'null', 'null'),
(121, '0072474074', 'DAMAR SANJAYA', 'DUSUN VI', '', '', 'L', 'LISMAWATI', 'SAHIBUL ANWAR', '', '15', 'null', 'null'),
(122, '0111368434', 'Darvis Virash', 'Rantau', '', '', 'L', 'Maisarah', 'Marzuan', '', '10', 'null', 'null'),
(123, '0137336107', 'DAVA AL RIVKY BARUS', 'Dusun IV Tanjung Selamat', '', '', 'L', 'Nurhalimah', 'Rizki Rhamadana', '', '3', 'null', 'null'),
(124, '3137285930', 'DAVID AL ZIKKRI', 'Jl. Bersama Gg. Jawa No. 22 A', '', '', 'L', 'Aida Fitri Andriani', 'Rahmad Dani', '', '2', 'null', 'null'),
(125, '0106772034', 'DEKA SATRIA RAMADHAN', 'JL. PONDOK INDAH', '', '', 'L', 'NISMAH AR', 'FANDY S.', '', '12', 'null', 'null'),
(126, '0111282418', 'Deswita Andriyati Br Surbakti', 'Jl. Besar Tanjung Selamat Gg. Percobaan', '', '', 'P', 'Umi Hayati', 'Enderi Surbakti', '', '6', 'null', 'null'),
(127, '0111647209', 'Devi Novianti', 'Jl. Puri Anom Asri Blok B No 30', '', '', 'P', 'Hamidah', 'Imam Susilo Hanafi', '', '7', 'null', 'null'),
(128, '0088904485', 'Devin Erlangga', 'Jl. A. Yani', '081257398897', '', 'L', 'Deliana', 'Edi Irwansyah', '', '12', 'null', 'null'),
(129, '0112663809', 'DEVITA HERLIN', 'JL. PLAMBOYAN RAYA GG SETIA BUDI', '', '', 'P', 'SURIYANA', 'HERI GUNAWAN', '', '10', 'null', 'null'),
(130, '0099184887', 'DEWI LESTARI', 'JL. TANJUNG SELAMAT', '', '', 'P', 'TUMINEM', 'SUPRIADI', '', '12', 'null', 'null'),
(131, '0115044573', 'DEWI SARTIKA', 'JL. PENDIDIKAN GG TELKOM', '', '', 'P', 'RISMA', 'BAYU ADITYA', '', '10', 'null', 'null'),
(132, '0116428254', 'Dhea Anastasya', 'JL. Tanjung Selamat Gg. Rezeki', '', '', 'P', 'Rina Sari', 'Darmayanto', '', '7', 'null', 'null'),
(133, '0081004858', 'Dherga Prima Surya Hutagalung', 'Jl.Dr.Mansyur', '', '', 'L', 'Helmina Meilynda Harahap', 'Safi\'in Hutagalung', '', '15', 'null', 'null'),
(134, '0119442070', 'DHIKA RISKI PANGESTU', 'JL. TANJUNG SELAMAT GG. HIDAYAH', '081397641659', '', 'L', 'WELIEM', 'SUPRIADI', '', '10', 'null', 'null'),
(135, '0134220997', 'DIAN PRATAMA', 'Dusun II-B Jl. Perjuangan Gg. Delima', '', '', 'L', 'Mayasari Ayu', 'Putra Ramadani', '', '5', 'null', 'null'),
(136, '0076131075', 'DIANA PUTRI', 'JL. BESAR TANJUNG SELAMAT', '', '', 'P', 'SUSI SAFITRI', 'SARIDI', '', '13', 'null', 'null'),
(137, '0123525802', 'DIKA KESUMA', 'TANJUNG SELAMAT', '', '', 'P', 'KESUMAWATI', 'ISMAIL', '', '8', 'null', 'null'),
(138, '0105482656', 'DIMAS PRAYOGA', 'JL. TANJUNG SELAMAT', '', '', 'L', 'ERPINA', 'SUPRIONO', '', '10', 'null', 'null'),
(139, '0123797868', 'Dimas Putra Ramadani', 'Jl. Tanjung Selamat Gg. Bersama', '', '', 'L', 'Devi Sartika Atmaja', 'M. Ramadani', '', '8', 'null', 'null'),
(140, '0107602693', 'DIMAS RAFANDI', 'JL. TANJUNG ANOM PERUMAHAN DANAMON', '08526142959', '', 'L', 'AMALIA', 'DODI HANDOYO', '', '10', 'null', 'null'),
(141, '0112458679', 'DIMAS SAPUTRA', 'JL. BESAR TANJUNG SELAMAT', '', '', 'L', 'SUSI SAFITRI', 'SARIDI', '', '10', 'null', 'null'),
(142, '0107087906', 'DINDA PUTRI SUTADI', 'JLN.SNAKMA TJ. SELAMAT', '085206956288', '', 'P', 'LENI HERLINA', 'DIDI SUTADI', '', '11', 'null', 'null'),
(143, '0136760342', 'DIVA ZIDNI', 'Jl. Percobaan', '', '', 'L', 'Imelda Br Sebayang', 'Muhammad Ibrahim', '', '1', 'null', 'null'),
(144, '0084117633', 'DIZHWAR FATHIN', 'DESA SUKARAYA DSN PERJUANGAN', '', '', 'L', 'DEWI ANGGRAINI', 'AMANSYAH', '', '14', 'null', 'null'),
(145, '0119432405', 'DWI ANUGRAH RIFAI', 'JL. KOMP. PURI ANOM BLOK E NO. 37', '081375667755', '', 'L', 'PARIDA', 'SUSANTO. Z', '', '12', 'null', 'null'),
(146, '0131074548', 'DWI PERMATA SARI BOANG MANALU', 'Jl. Tampok', '', '', 'P', 'Arsima', 'Kartono Boang Manalu', '', '1', 'null', 'null'),
(147, '0084666637', 'DWI RIZKI SYAPUTRI', 'GRAHA BLOK D-07', '', '', 'P', 'SRI AGUS', 'ARNOVA', '', '15', 'null', 'null'),
(148, '0092728059', 'DWI SALSA', 'JL. TANJUNG SELAMAT GG. DELIMA', '', '', 'P', 'SITI HALIMAH', 'RAHMAT AGUS TARIGAN', '', '14', 'null', 'null'),
(149, '3125826287', 'DYKA PRATAMA', 'Tanjung Selamat', '', '', 'L', 'Winda Novita Sari', 'Tukirin', '', '4', 'null', 'null'),
(150, '0119980979', 'DZIKRI ADITYA', 'JL. PERCOBAAN GG PANTAI', '085833820637', '', 'L', 'RAHMA SURYANI SIAGIAN', 'HERY PRATAMA', '', '10', 'null', 'null'),
(151, '0124604283', 'EFAN NOPENDRI', 'Jl H Abdul Manaf Lubis Gg Rela Lk I No 111', '', '', 'L', 'Irnawilis', 'Yulependi', '', '4', 'null', 'null'),
(152, '0088293485', 'Eka Rahmadini Br Manik', 'GG PINANG', '', '', 'P', 'Ina Agustina', 'ASRI MANIK', '', '15', 'null', 'null'),
(153, '0114187465', 'EKA WAHYUDI', 'JL. TANJUNG SELAMAT', '085362124604', '', 'L', 'ASTUTIK', 'SUTRISNO', '', '10', 'null', 'null'),
(154, '0101211254', 'ELA NATASIA BR SURBAKTI', 'JL. KUTAMBELIN', '', '', 'P', 'SITI HOTNIDA BR HARAHAP', 'SASTRAWAN SURBAKTI', '', '11', 'null', 'null'),
(155, '3122691933', 'ELVIRA CALISTA TAMBUNAN', 'Jl. Flamboyan III No. 100', '', '', 'P', 'MIsnandani Ritonga', 'Rulliary Ortho Pardomuan T', '', '3', 'null', 'null'),
(156, '3135577070', 'EZA YAHYA RAMADHAN', 'Dusun I Tanjung Anom', '', '', 'L', 'Nurhasanah', 'Hendarsyah Taufik', '', '3', 'null', 'null'),
(157, '3124490076', 'Fadhil AlFarezi', 'Jl. Tanjung Anom', '', '', 'L', 'Surya Hamdani', 'Sofyan Syah', '', '7', 'null', 'null'),
(158, '0102320468', 'FADIL RENALDI', 'JL BUNGA RAYA GG MAWAR LK VI', '085277674012', '', 'L', 'WIDIA AYU LESTARI', 'SELAMAT', '', '11', 'null', 'null'),
(159, '0112971016', 'Fadlan Samudera', 'Jl. Besar Tj. Selamat Gg. Habib', '', '', 'L', 'Yunita Sari Lubis', 'Samudrianto', '', '7', 'null', 'null'),
(160, '0083628892', 'FAHRI ARDIANSYAH', 'TANJUNG GG. MEKAR', '', '', 'L', 'NASRIAH', 'SUKARLI', '', '14', 'null', 'null'),
(161, '0102450604', 'FAHRIZAL HUDA', 'JL. TAMPOK', '', '', 'L', 'NURUL HIDAYAH', 'SAFRIZAL', '', '11', 'null', 'null'),
(162, '0119439561', 'FAISYAL AMRI NASUTION', 'JL. TAMPOK', '082364186062', '', 'L', 'ELFIRA', 'ABDUL RAHMAN SYUKUR NASUTION', '', '9', 'null', 'null'),
(163, '3138697861', 'FANESSA CICI KHALISA', 'Jalan HM Puna Sembiring No 61', '', '', 'P', 'Masipah Sari Ginting', 'Eka Nanda Indrawan', '', '3', 'null', 'null'),
(164, '0095218274', 'FARANIDA AZ ZAHRA BR TARIGAN', 'JL P BARIS GG RAMBUTAN', '', '', 'P', 'ARNISA BR GINTING', 'AZIZ TARIGAN', '', '14', 'null', 'null'),
(165, '3132926602', 'FAREL MAKARNA SURBAKTI', 'Tuntungan I', '', '', 'L', 'Wilda Khairani', 'Bebas Surbakti', '', '2', 'null', 'null'),
(166, '0082342772', 'Farhan Jumadi Putra', 'JL.PERJUANGAN GG.DELIMA', '', '', 'L', 'Suprapti', 'AZARUDDIN', '', '15', 'null', 'null'),
(167, '0131483288', 'FARHAN NASYWAN', 'Lingk IV Sido Sari Luar', '', '', 'L', 'Santi Armaya', 'Sukamto', '', '4', 'null', 'null'),
(168, '0124280724', 'Faris Chandra', 'Jl. Saudara No. 7', '', '', 'L', 'Dewi Lisma', 'Rosman', '', '7', 'null', 'null'),
(169, '3123635659', 'FASHA IBRAHIM SANDY', 'Komplek Puri Anom Blok AA No 19', '', '', 'L', 'Amy Fadillah', 'Arisandy Masri', '', '3', 'null', 'null'),
(170, '0118331836', 'FATHIR AL FARUQ', 'JL. DUREN VILLA INDAH ABADI', '08126336321', '', 'L', 'AISYAH', 'MUHAMMAD HASANUDDIN', '', '9', 'null', 'null'),
(171, '0136721341', 'FATHIR YUSHA ZIO SIAHAAN', 'Jl. Sutomo Ujung Gg Yahya No 8', '', '', 'L', 'Lisa Anggraini', 'M. Yusuf Siahaan', '', '1', 'null', 'null'),
(172, '0107509179', 'FATHIYA HANIFAH', 'JL. PERJUANGAN', '081362232237', '', 'P', 'NUR AISAH', 'MAULANA MALIK MUTTAQIN', '', '11', 'null', 'null'),
(173, '0133346749', 'FATIN SHIDQIA', 'Dusun I-A Gg. Serumpun', '', '', 'P', 'Habsyah', 'Agianto', '', '1', 'null', 'null'),
(174, '0118030476', 'Fawwazul Azzam Al-Khatiri', 'Dusun I-A Gg. Selian Tanjung Selamat', '', '', 'L', 'Siti Mariyah Ulfa', 'Parjo', '', '8', 'null', 'null'),
(175, '0129180301', 'Fazar Rizmi Ilhamsyah Nasution', 'Jl. Perumahan Puri Anom Asri Blok D34', '', '', 'L', 'Emilia Yuni Hartati', 'Risjuansyah Nasution', '', '8', 'null', 'null'),
(176, '0123800594', 'Feby Khairunnisa', 'Komplek Puri Anom Asri', '', '', 'P', 'Ardesta Hiasina Surbakti', 'Januri', '', '7', 'null', 'null'),
(177, '0114968679', 'Fickry Arfiansah', 'GLUGUR RIMBUN', '', '', 'L', 'TIURMA BR PASARIBU', 'RISDIYANTO', '', '8', 'null', 'null'),
(178, '0085641946', 'FIKRI AKBAR', 'TANJUNG SELAMAT G. PINANG', '', '', 'L', 'SITI DAHLIA', 'SURATNO', '', '13', 'null', 'null'),
(179, '0111073145', 'FIKRI AL HAZIMY', 'JL. TANJUNG SELAMAT GG. MUSHOLLA', '081376256065', '', 'L', 'INDRA YANI', 'SAMSUL BAHRI', '', '10', 'null', 'null'),
(180, '0137785131', 'FIKRI RAMADHAN', 'Dusun I-A Tanjung Selamat', '', '', 'L', 'Nur Aminah', 'Agus Suherman', '', '4', 'null', 'null'),
(181, '0129825552', 'Fikri Ramadhan Daulay', 'Gg. Paka Kawi', '', '', 'L', 'Imelda', 'Faisal', '', '6', 'null', 'null'),
(182, '0096538974', 'FIQRI ACHSAN ZULKARNAIN', 'JL. PERJUANGAN', '082285291138', '', 'L', 'SOFIA YUNITA HASIBUAN', 'ISKANDAR ZULKARNAIN', '', '12', 'null', 'null'),
(183, '3135116692', 'FITRI CAHYANI', 'Dusun Vi Tanjung Anom', '', '', 'P', 'Devi Hamdayani', 'Sugiharto', '', '3', 'null', 'null'),
(184, '3125726262', 'FITRI RAHAYU', 'Dusun II Gg. Pandawa', '', '', 'P', 'Suyanti', 'Wagimin .', '', '5', 'null', 'null'),
(185, '0089102182', 'FITRIA SARI DEVI', 'JL. NUSA INDAH GG SABAR NO 44 E', '', '', 'P', 'TINA MURNIATY', 'DEDI SURYADI', '', '15', 'null', 'null'),
(186, '0138052400', 'FURQON HABIBI HAMZAH', 'Tanjung Selamat Gg. Taufik', '', '', 'L', 'Linda Wati', 'Samsul Hamzah', '', '5', 'null', 'null'),
(187, '0116139521', 'Gading Adam', 'Jl. tanjung Selamat', '', '', 'L', 'Ula Annisa Siregar', 'Bayu Adam', '', '6', 'null', 'null'),
(188, '0118616559', 'GANDA RIZKY SUKAMTO', 'JL. SEI TUNTUNG NO 39-C', '082363824447', '', 'L', 'WENNY FITRIANI', 'HADY SUYANTO', '', '9', 'null', 'null'),
(189, '0107531773', 'GAZA AQWA AL FARRAZ', 'JL.MELINJO V NO.24 LK VIII MEDAN', '', '', 'L', 'WAN SRI WIDANINGSIH,S.SOS', 'DODY SISWOYO', '', '11', 'null', 'null'),
(190, '0094390502', 'GINA AGUSTINA', 'JL. SEI GLUGUR DSN III T. ANOM', '', '', 'P', 'YUNIATI', 'SARIANTO', '', '13', 'null', 'null'),
(191, '0125852256', 'Gusti Arya Putra', 'Jl. Percobaan', '', '', 'L', 'Rahma Wati', 'Hendra Saputra', '', '6', 'null', 'null'),
(192, '0109392198', 'HABIB ALFIANSYAH', 'JL. PERJUANGAN', '082272170572', '', 'L', 'WAHIDAH SITORUS', 'ABDUL MANAN', '', '11', 'null', 'null'),
(193, '0111904522', 'HABIB ALPARIZHY', 'JL. FLAMBOYAN RAYA GG. MANGGIS', '082165010632', '', 'L', 'CITRA AYU DISTIRA', 'HENDRA IRWANSYAH PUTRA', '', '9', 'null', 'null'),
(194, '0118226941', 'HABIB HABIBIE', 'JL. TANJUNG ANOM', '081375507830', '', 'L', 'MENA PINATA', 'MUKHLIS BUDI UTOYO', '', '10', 'null', 'null'),
(195, '0127368908', 'Hadi Wiranata', 'Dusun I', '', '', 'L', 'Juniar br Hasibuan', 'Wahadi', '', '7', 'null', 'null'),
(196, '0108687527', 'Hadrian Radithya Sembiring', 'Jalan Flamboyan Raya Gg Harahap Komp Nina Flamboyan House No.29 Tj. Selamat', '085262117070', '', 'L', 'Sri Handini', 'Hendra Cipta Sembiring', '', '11', 'null', 'null'),
(197, '3134214882', 'HADWAN HAZIM', 'Asmil Yonarhanudse II/BS', '', '', 'L', 'Wagini', 'Hariyanto', '', '4', 'null', 'null'),
(198, '0096310493', 'HAFIZH FADHLIRRAHMAN AS-SA\'DI', 'JL. BALAI DESA I GG RUKUN', '081362443661', '', 'L', 'NOVITA SARI HARAHAP', 'SURYA EFENDI', '', '12', 'null', 'null'),
(199, '0103538484', 'HAICAL FAHMI', 'JL. BESAR TG. ANOM', '085207900599', '', 'L', 'AFRIANI', 'MUHAMMAD TAUFIQ', '', '11', 'null', 'null'),
(200, '0105961244', 'HAIKAL LESTARI TAUFIK', 'JL. BALAI DESA II', '082366581881', '', 'L', 'SALIMAH FAHMI', 'MAHMUD SUHAIMI TAUFIK', '', '12', 'null', 'null'),
(201, '0131862923', 'HAIKAL MIRZA SYAHMI', 'Jl. Snakma Dusun I', '', '', 'L', 'Isnaini Ramasari', 'Suhendri', '', '3', 'null', 'null'),
(202, '0124732093', 'Haikal Ramadhan', 'Jl. Dusun 3 Tanjung Anom', '', '', 'L', 'Listia Wati', 'Al Amin', '', '6', 'null', 'null'),
(203, '0099170966', 'HAIRUL SUPRIYADI', 'DUSUN II TANJUNG SELAMAT', '', '', 'L', 'SUPARNI', 'JUMANTO', '', '13', 'null', 'null'),
(204, '0108518922', 'Hasbi Ataya Rizqulloh', 'cibangban', '', '', 'L', 'suriya', 'Hasan Darwandi Sumpena', '', '14', 'null', 'null'),
(205, '0092428542', 'HASBI DZAL LUTHFIN', 'JL BUNGA ASOKA GG RAHAYU', '', '', 'L', 'SUNARNI', 'IWAN SETIAWAN', '', '13', 'null', 'null'),
(206, '3139753947', 'HUMAIRA TUNGGA DEWI', 'Griya Harapan Baru Blok A19', '', '', 'P', 'Sri Dewi Artika', 'Agus Supomo', '', '2', 'null', 'null'),
(207, '3137351059', 'IANDA ANDRIAN', 'Dusun I Jl. Pringgan', '', '', 'L', 'Faridah Hanum', 'Andrian', '', '3', 'null', 'null'),
(208, '0076886020', 'IBNU KAMAL', 'JL. PERJUANGAN', '', '', 'L', 'LINA', 'M ZUNAIDI', '', '15', 'null', 'null'),
(209, '0129961084', 'Ibrahim Zaki Ahmad', 'Jl. Amal Gg. Sosial', '', '', 'L', 'Desi Irmayani', 'Sudarmadi', '', '8', 'null', 'null'),
(210, '0128523387', 'Ilham Pranata', 'Jl. Pimpinan Gg. Damai No. 154', '', '', 'L', 'Ismi Siregar', 'Sukimin', '', '7', 'null', 'null'),
(211, '0118780973', 'INDAH SAFITRI', 'JL. PIMPINAN NO. 155 DSN I', '08235708505', '', 'P', 'NURAINUN', 'PONIRUN', '', '9', 'null', 'null'),
(212, '0139443285', 'INDIRA AURELIA', 'Dusun II-B Tanjung Selamat', '', '', 'P', 'Erny Wardany', 'Adi Handoko', '', '4', 'null', 'null'),
(213, '0127501933', 'Ipank Sumarna', 'Jl. Setia Budi', '', '', 'L', 'Mein Suyintha', 'May Sumarna', '', '6', 'null', 'null'),
(214, '0119957450', 'Irfan Efendi', 'Jl. Perumahan Sembahe Baru', '', '', 'L', 'Sriyani', 'Ishan', '', '7', 'null', 'null'),
(215, '0081217262', 'ISLAN', 'JL. PERCOBAAN', '', '', 'P', 'SUMINI', 'BASARUDIN', '', '14', 'null', 'null'),
(216, '0137570130', 'JENNY SYAHFIRA', 'Jl. Pasar I Gg Usman Syarif No 8', '', '', 'P', 'Julaili', 'Supriyanto', '', '2', 'null', 'null'),
(217, '3134218743', 'JIHAN PRATIWI BARUS', 'Jl Nusa Indah Lk IV Medan', '', '', 'P', 'Yulia Fitriani Lubis', 'Elmi Barus', '', '2', 'null', 'null'),
(218, '0107981795', 'KAILA SAHFITRI', 'DUSUN II B GG. MAWAR', '081360182302', '', 'P', 'SITI CHAIRANI', 'SABIKIN', '', '9', 'null', 'null'),
(219, '0135348006', 'KANIA ASYA PUTRI', 'Jl. Balai Desa I Dusun III', '', '', 'P', 'Susilawati', 'Supian', '', '2', 'null', 'null'),
(220, '0118165741', 'KANIS ALDINO', 'JL. PERJUANGAN GG. FAMILI', '081370053342', '', 'L', 'RIKHLAS', 'INWANTRI', '', '9', 'null', 'null'),
(221, '0104113839', 'KARTIKA PUTRI HANDAYANI', 'JL. PERJUANGAN GG.MUFAKAT', '', '', 'P', 'ERMILA', 'TAKRIP', '', '11', 'null', 'null'),
(222, '0127096601', 'Karunia Cinta Juliantara', 'Dusun I-A Tanjung Selamat', '', '', 'P', 'Sritiara Tanjung', 'Julianto', '', '6', 'null', 'null'),
(223, '3134782744', 'KAYRUL AJAM NAINGGOLAN', 'Jl. Flora VI No. 65 Lk XII', '', '', 'L', 'Sri Wahyu Ningsih', 'Yusman Nainggolan', '', '3', 'null', 'null'),
(224, '0093471780', 'Keysa Rizqinta Azzahra', 'Tanjung Selamat', '', '', 'P', 'Suriya', 'Hasan Darwandi Sumpena', '', '15', 'null', 'null'),
(225, '0118607672', 'Khalifah Syafa Inayah', 'Jl. Dusun II-B', '', '', 'P', 'Nanda Vita Kharima', 'Riyan Syah Putra', '', '7', 'null', 'null'),
(226, '3117898672', 'Khalila Sari Daulay', 'Dusun II-A Gg. Hidaya Tj. Selamat', '', '', 'P', 'Rani Dewi Matofani', '', '', '10', 'null', 'null'),
(227, '0112430322', 'Khalisa Yasmine Br Tarigan', 'Jl. Rakyat Dusun I No 326', '', '', 'P', 'Girik Tamariahna Br Bangun', 'Agus Haryono Tarigan', '', '8', 'null', 'null'),
(228, '0127999878', 'Khanaya Sisilya', 'Jl. Tanjung Selamat', '', '', 'P', 'Junira', 'Mugianto', '', '7', 'null', 'null'),
(229, '0106935399', 'KHANZA AMIRA ZAHWA', 'LINGKUNGAN I KEL. LABUHAN DELI', '', '', 'P', 'RINI DEWI WULAN DARI', 'FAHMI AHYAR', '', '12', 'null', 'null'),
(230, '0086771939', 'KHUMAIRA RIZKIA FARADILA', 'JL. PERJUANGAN GG. DAUN', '', '', 'P', 'ASRIANI. M', 'SAIFUL BAHRI', '', '13', 'null', 'null'),
(231, '0134262470', 'KINAYAH SYIFA PUTRI RIENDRA', 'Jl. Mawar Dusun-II', '', '', 'P', 'Rini Ramadhani', 'Indra Wahyudi', '', '2', 'null', 'null'),
(232, '0091470810', 'LAILI FITRIA ARRAHMA', 'JL. PERJUANGAN UJUNG', '', '', 'P', 'SITI FATIMAH', 'M. ZUNAIDI', '', '13', 'null', 'null'),
(233, '0102284809', 'LATIFA RAISYA HUSNA', 'JL. DUREN VILLA INDAH ABADI BLOK A-3', '', '', 'P', 'AISYAH', 'MUHAMMAD HASANUDDIN', '', '12', 'null', 'null'),
(234, '0115809696', 'LAYLA SYAHPUTRI', 'JL. PURI TJ. ANOM', '082369144641', '', 'P', 'SRI LAWATI', 'ISMAIL SYAH', '', '11', 'null', 'null'),
(235, '0114568172', 'Letisyah Salsa Bila', 'Jl. Tanjung Selamat Depan Mesjid Jami\'', '', '', 'P', 'Siti Halimah', 'Rahmat Agus Tarigan', '', '6', 'null', 'null'),
(236, '0096809060', 'LUNA AMALIYAH', 'JL. PERJUANGAN KOMP. MUTIARA III', '', '', 'P', 'NINING SUSANTI', 'HARI RAHYAN SAPUTRA', '', '13', 'null', 'null'),
(237, '0122744937', 'LUTFIAH MAHFUDZAH', 'Perum Bumi Tirta Blok A 20', '', '', 'P', 'Kartini', 'Naswan Efendi', '', '4', 'null', 'null'),
(238, '0084091817', 'LUTHFI MAULANA', 'GG MELATI', '', '', 'L', 'ELFI HUZAIMAH', 'SUDIRMAN', '', '15', 'null', 'null'),
(239, '0095229730', 'LUTHFI RAFAEL', 'JL. PONDOK BAMBU', '085360867125', '', 'L', 'SITI SARAH LUBIS', 'SULAIMAN', '', '11', 'null', 'null'),
(240, '0117159335', 'M ALFATIR', 'JL. PERUM DANAMON', '', '', 'L', 'SUSILOWATI', 'SUTADI', '', '9', 'null', 'null'),
(241, '0101989249', 'M ARIL', 'JL. DELIMA', '082360048588', '', 'L', 'FITRIANI', 'M YUNUS', '', '12', 'null', 'null'),
(242, '3136066268', 'M ARKAN CHIBRO', 'Tanjung Selamat', '', '', 'L', 'Halimah', 'Rajuddin Cibro', '', '3', 'null', 'null'),
(243, '3132137555', 'M ARYA NAUFAL RITONGA', 'Perum Griya Tanjung Asri B. D16', '', '', 'L', 'Suwarni', 'Mhd Arwansyah Ritonga', '', '1', 'null', 'null'),
(244, '3136744114', 'M FACHRIZAL NAINGGOLAN', 'Griya Mutiara III B. C No. 29', '', '', 'L', 'Fatmawati Nasution', 'Rudy Ismanto Nainggolan', '', '3', 'null', 'null'),
(245, '3138606070', 'M FADHIIL HABIBIE', 'Jl Bunga Sedap Malam IX No 21', '', '', 'L', 'Ayu Septika', 'Ahmad Zaki Habibie', '', '2', 'null', 'null'),
(246, '0113248951', 'M Fathan Fajar Samudra', 'Jl. Puri Anom Asri No. 50 C', '', '', 'L', 'Halijah Noor', 'M Sandi', '', '8', 'null', 'null'),
(247, '0112220946', 'M Firza Al Faiz', 'Jl. Sukaraya', '', '', 'L', 'Yusliana', 'Safry', '', '7', 'null', 'null'),
(248, '0107865412', 'M IKHWAN AL-IKRAM', 'PERJUANGAN Gg DELIMA', '', '', 'L', 'MAYA MASITA LUBIS', 'AGUS SISWOYO', '', '11', 'null', 'null'),
(249, '0112944438', 'M NIZAM WIJAYA', 'JL.DUSUN VIII G.BALAK', '', '', 'P', 'YUNA', 'SATRIA MIKI WIJAYA', '', '9', 'null', 'null'),
(250, '0097331616', 'M. HARIANSYAH PRATAMA', 'DUSUN I GANG RINDU', '', '', 'L', 'RAHMA SURYANI SIAGIAN', 'HERY PRATAMA', '', '14', 'null', 'null'),
(251, '0081114822', 'M. KEVIN', 'DUSUN II JL. PERJUANGAN GG. MUPAKAT', '', '', 'L', 'RUSNANI', 'TUMIRIN', '', '14', 'null', 'null'),
(252, '0111609833', 'M. Rehansyah', 'Jl. Perjuangan Gg. Daun', '', '', 'L', 'Desi Rahma Sari', 'Rahmansyah', '', '6', 'null', 'null'),
(253, '0115777198', 'Mahirah As-Shalihah', 'Dusun II-B Jl. Perjuangan No. 177 Tanjung Selamat', '', '', 'P', 'Nur Aisah', 'Maulana Malik Muttaqin', '', '6', 'null', 'null'),
(254, '0104569586', 'MALIKA ANJANI SARAGIH', 'JL. SUKA RAYA', '082365657432', '', 'P', 'VERA DEVI ARYANI', 'EKO WIJARNAKO SARAGIH', '', '10', 'null', 'null'),
(255, '0128345711', 'Maulana Agung Siregar', 'Jl. Tanjung Selamat', '', '', 'L', 'Dian Novita Sari Laia', 'Natal Dermanto Siregar', '', '8', 'null', 'null'),
(256, '0127144230', 'Maulana Qolil', 'Jl. Tanjung Selamat Gg. Mesjid No 10 A', '', '', 'L', 'Aika Sari Dewi', 'Marsidi Arip', '', '8', 'null', 'null'),
(257, '0121781581', 'Mayyadah Rezeki', 'Jl. Tampok Tanjung Selamat', '', '', 'P', 'Khayri Indana', 'Bambang Suryadi', '', '7', 'null', 'null'),
(258, '0085815077', 'MEHDI AZKA AL FATHAN', 'JL. TANJUNG SELAMAT SIMP. PERJUANGAN', '', '', 'L', 'DEVI ARYANI', 'ANDI ABDILLAH', '', '15', 'null', 'null'),
(259, '0124789980', 'Meisyah Putri Sutadi', 'Dusun I-B Jln. Snakma Tj. Selamat', '', '', 'P', 'Leni Herlina', 'Didi Sutadi', '', '8', 'null', 'null'),
(260, '0114578090', 'MHD AGUNG RAMADHAN', 'JL. DISKI', '085270400238', '', 'L', 'SRI HANI', 'WASULAIMAN', '', '9', 'null', 'null'),
(261, '0087128866', 'MHD AKBAR SUBOWO', 'JL.BUNGA RAYA', '', '', 'L', 'NURHAYANI', 'HERU SUTOPO', '', '15', 'null', 'null'),
(262, '0132990803', 'MHD PADLI', 'Dusun III Tanjung Selamat', '', '', 'L', 'Zahrina', 'Julharianto', '', '2', 'null', 'null'),
(263, '0128008870', 'Mhd Rajab Firmansyah', 'Jl. Setia Budi Pasar I Gg. Amito', '', '', 'L', 'Dina Mandasary', 'Nur Imansyah', '', '6', 'null', 'null'),
(264, '0135286240', 'MHD ZIDANE HUTABARAT', 'Jl. Duren Tanjung Anom Komplek VIIIa', '', '', 'L', 'Ninda Asriani', 'Chairul Amri Hutabarat', '', '5', 'null', 'null'),
(265, '0094844120', 'MHD. FRIANSYAH', 'JL. PERJUANGAN', '', '', 'L', 'ITA MARGIATI', 'SUGIYONO', '', '11', 'null', 'null'),
(266, '0095814437', 'MHD. RAIHAN NASUTION', 'JL TAMPOK GG. SENI', '', '', 'L', 'ELFIRA', 'ABDUL RAHMAN SYUKUR NASUTION', '', '11', 'null', 'null'),
(267, '3130473388', 'Mhd. Sharul Ramadhan', 'Jl. Perjuangan Gg. Bunga Matahari 3', '', '', 'L', 'Masliana', 'Samsudin', '', '6', 'null', 'null'),
(268, '0094817079', 'MHD.HARI FIQRI LUBIS', 'JL. TERNAK AYAM', '081397793709', '', 'L', 'SRI AGUSTINA', 'HAMDI SAPARI LUBIS', '', '12', 'null', 'null'),
(269, '0125426318', 'MIA LESTARI', 'Dusun III', '', '', 'P', 'Fitriawati', 'Boy', '', '4', 'null', 'null'),
(270, '0109194627', 'MIFTAHUL ZAHIRA AULIA', 'JL. TANJUNG SELAMAT GG. MESJID', '081264403396', '', 'P', 'ZURAIDA SILALAHI', 'MARWAN', '', '12', 'null', 'null'),
(271, '3132089976', 'MUHAMMAD ACHDAN AL HASAN', 'Jln. Flamboyan XII LK. III', '', '', 'L', 'Sopatun Nusla', 'Hasanuddin', '', '1', 'null', 'null'),
(272, '0118091885', 'Muhammad Aji Alvi Guci', 'Galang', '', '', 'L', 'Haryani Siregar', 'Junaidi', '', '6', 'null', 'null'),
(273, '3138118234', 'MUHAMMAD AL FATIH ZUHRI', 'JL. MELINJO V NO 24 LK VIII MEDAN', '', '', 'L', 'WAN SRI WIDANINGSIH, S.SOS', 'DODY SISWOYO', '', '2', 'null', 'null'),
(274, '0133640913', 'MUHAMMAD AL RAZI', 'Jl. Sei Rokan No 96', '', '', 'L', 'Estua Ekawati', 'Ahmad Alfajrin', '', '1', 'null', 'null'),
(275, '0122689757', 'Muhammad Alfatih Nasution', 'Jl. Perjuangan', '', '', 'L', 'Sri Fauziah', 'Abdi Hamid Nasution', '', '8', 'null', 'null'),
(276, '0134416885', 'MUHAMMAD ALIANDO AQBARKA', 'Dusun II-B Jl. Perjuangan Gg. Famili', '', '', 'L', 'Suherni', 'Bung Swardi', '', '4', 'null', 'null'),
(277, '3124163002', 'Muhammad Alif Ridwan', 'Jl. Besar Tanjung Selamat', '', '', 'L', 'Suyanti', 'Irwanto', '', '8', 'null', 'null'),
(278, '0127971767', 'Muhammad Amyarul Hairi', 'Jl. Perumahan Griya Mutiara 3', '', '', 'L', 'Fatma Sari Dewi', 'Muhammad Ali', '', '8', 'null', 'null'),
(279, '3131208806', 'MUHAMMAD ANDRIAN MAULANA', 'Dusun I A Jln. Percobaan', '', '', 'L', 'Puan Amalia', 'Ilyas', '', '1', 'null', 'null'),
(280, '0135490612', 'MUHAMMAD ARFAN SEJAHTERAH', 'Dusun II-B Jl. Perjuangan', '', '', 'L', 'Supriani', 'Pardianto', '', '5', 'null', 'null'),
(281, '0134725534', 'MUHAMMAD ARKAN ALYAFI', 'Jl Pancing V Lingk III', '', '', 'L', 'Dewi Mustika Ardiyanti Koto', 'M Hamdani', '', '1', 'null', 'null'),
(282, '3131899299', 'MUHAMMAD ASGHAR HUSSAIN SIREGAR', 'Dusun I-A Gg. Silmy No. 5', '', '', 'L', 'Suyanti Syamsuri', 'Mahmud Budiman', '', '4', 'null', 'null'),
(283, '0129660214', 'Muhammad Fahrezy', 'Jl. Rakyat', '', '', 'L', 'Nurhasanah', 'Hendarsyah Taufik', '', '8', 'null', 'null'),
(284, '0095506210', 'MUHAMMAD FAHRI', 'JL. TANJUNG SELAMAT', '', '', 'L', 'FATMA SARI DEWI', 'MUHAMMAD ALI', '', '15', 'null', 'null'),
(285, '0131180137', 'MUHAMMAD FAJAR', 'Dusun I-A Gg. Keluarga', '', '', 'L', 'Afrida Sari', 'Suherman', '', '1', 'null', 'null'),
(286, '0107069901', 'MUHAMMAD FARHAN', 'DUDUN I-A GG. KELUARGA', '085362610185', '', 'L', 'AFRIDA SARI GINTING', 'SUHERMAN', '', '12', 'null', 'null'),
(287, '0136732657', 'MUHAMMAD FARIZ NAUFAL', 'Jl. Karya II No 62', '', '', 'L', 'Yenni Hastini', 'Erwinsyah', '', '4', 'null', 'null'),
(288, '0131044486', 'MUHAMMAD FATHIR SANI', 'Griya Permata 3 Blok CC 23', '', '', 'L', 'Erni Yusnita Siregar', 'Sulaiman', '', '1', 'null', 'null'),
(289, '0086447468', 'MUHAMMAD FAUZAN', 'DUSUN II TANJUNG SELAMAT', '', '', 'L', 'LAILA MAYA SARI', 'M. Yasir Amin', '', '15', 'null', 'null'),
(290, '0121064679', 'MUHAMMAD HAYKAL PRATAMA', 'Jl. Rakyat No. 97 D Dusun I', '', '', 'L', 'Dwi Ismawati', 'Sunarwan', '', '2', 'null', 'null'),
(291, '0124734922', 'Muhammad Ikhsan', 'Dusun II-B Gg. Mawar Tanjung Selamat', '', '', 'L', 'Sri Wahyuni', 'Saprijal', '', '6', 'null', 'null'),
(292, '0124527231', 'Muhammad Ikhwan', 'Dusun II-B Gg. Mawar Tanjung Selamat', '', '', 'L', 'Sri Wahyuni', 'Saprijal', '', '6', 'null', 'null'),
(293, '0135987815', 'MUHAMMAD IQBAL', 'Dusun II-B Jl Perjuangan', '', '', 'L', 'Sumarni', 'Lasimin', '', '1', 'null', 'null'),
(294, '3121471435', 'Muhammad Naufal Zharif', 'Jl. S. Karyo Ujung Dusun III', '', '', 'L', 'Fahmi Mulyasari', 'Rahman Sundiko', '', '8', 'null', 'null'),
(295, '0133455014', 'MUHAMMAD NUKA ATAYA', 'Jl. Gelas Gg. Perabot No. 9', '', '', 'L', 'Nur Halimah', 'Eka Sila', '', '2', 'null', 'null'),
(296, '0095590302', 'MUHAMMAD PUTRA ZAKARIA', 'JL. PERCOBAAN G. PINANG', '', '', 'L', 'SITI HAMIDAH', 'SUSIANTO', '', '13', 'null', 'null'),
(297, '0138078888', 'MUHAMMAD RAFIF PRAYATA', 'Dusun I A Griya Tanjung Selamat Blok A No 8', '', '', 'L', 'Cut Putri Kawistari', 'Kuswadi', '', '3', 'null', 'null'),
(298, '0117283200', 'MUHAMMAD RAFKY RAMBE', 'JL. FLAMBOYAN RAYA', '087869223750', '', 'L', 'SISWENNY', 'JAMI ARIADI RAMBE', '', '7', 'null', 'null'),
(299, '0116872943', 'MUHAMMAD RAIHAN KHAIRY', 'JL. NGUMBAN SURBAKTI', '081376769276', '', 'L', 'IMELDA', 'TRY BASTIAN', '', '10', 'null', 'null'),
(300, '0082380759', 'MUHAMMAD REZA', 'JL. KUTA MBELIN', '', '', 'L', 'AGUSTINA', 'SUPARLIN', '', '11', 'null', 'null'),
(301, '0116274758', 'MUHAMMAD RIDHO TAHER', 'JL. TAMPOK GG SAUDARA NO. 8', '082366364270', '', 'L', 'RUNTUNG SURBAKTI', 'MHD SUKRI', '', '9', 'null', 'null'),
(302, '0133691575', 'MUHAMMAD RIZKI RAMADHAN', 'Tanjung Anom', '', '', 'L', 'Yusnani', 'Muchlis Lubis', '', '2', 'null', 'null'),
(303, '0098585432', 'MUHAMMAD RIZKY', 'TANJUNG SELAMAT', '', '', 'L', 'RAMAYANI', 'BUDI HARDOYO', '', '13', 'null', 'null'),
(304, '0114474278', 'MUHAMMAD WAHYU NASUTION', 'JL. PERJUANGAN GG. DAUN', '085270456295', '', 'L', 'SRI FAUZIAH', 'ABDI HAMID NASUTION', '', '9', 'null', 'null'),
(305, '3136236874', 'MUHAMMAD YASEER ARRAFAT', 'Dusun III Jln. Pendidikan', '', '', 'L', 'Wulandari', 'Rahmad Syahputra', '', '1', 'null', 'null'),
(306, '0096542307', 'MUHATHIR SABIRIN', 'TANJUNG SELAMAT', '', '', 'L', 'JULIANA', 'ARIS DRI AWAN', '', '14', 'null', 'null'),
(307, '0091034627', 'NABILA AMELIA', 'DUSUN I-A GG. KELUARGA TANJUNG SELAMAT', '', '', 'P', 'RISNAIDA LUBIS', 'RUDIANTO NASUTION', '', '14', 'null', 'null'),
(308, '0125164834', 'Nabila Aprilia Anggraini', 'Jl. Tanjung Selamat', '', '', 'P', 'Sri Suliani', 'Supianto', '', '7', 'null', 'null'),
(309, '3138894222', 'NABILA SAFITRI', 'Dusun II Telaga Sari', '', '', 'P', 'Sri Tivani Pohan', 'Surya Wansyah', '', '1', 'null', 'null'),
(310, '0124791449', 'Nabila Syahfika', 'Jl. Perjuangan Gg. Damai No. 145', '', '', 'P', 'Maisyarah', 'Rahmad Riyadi', '', '7', 'null', 'null'),
(311, '0102018790', 'NADIA SALSABILA', 'DUSUN I-A GG. MESJID', '082366388293', '', 'P', 'SRIANA', 'MUHAMMAD NUH', '', '12', 'null', 'null'),
(312, '0098787181', 'NADILA AZZAHRAH', 'KALAMPAIAN', '', '', 'P', 'DARNI', 'JEFRI ARMANSYAH', '', '14', 'null', 'null'),
(313, '0081316473', 'NAFA FADYA', 'TANUNG SELAMAT GG. ARJUNA', '', '', 'P', 'MARYUNA', 'EKO PRIBADI', '', '13', 'null', 'null'),
(314, '0131333777', 'NAFFA LYRA AZZAHRA', 'Jl. Percobaan Gg. Pantai', '', '', 'P', 'Yulida', 'Heri Subagio', '', '4', 'null', 'null'),
(315, '3136454348', 'NAJWA QORI HUMAIRA', 'Jl. Perjuangan Tanjung Selamat', '', '', 'P', 'Sari Cleopatra', 'Jimmy Handoko', '', '4', 'null', 'null'),
(316, '0102934541', 'NAJWA ZHAHIRA HASIBUAN', 'JL. SEI GLUGUR', '081370701412', '', 'P', 'RIKA AGUSTINA', 'MHD. ALI HASIBUAN', '', '11', 'null', 'null'),
(317, '0123739920', 'Naswa Sapphira', 'Jl. Tanjung Selamat', '', '', 'P', 'Helida', 'Yopi Syahputra', '', '7', 'null', 'null'),
(318, '0093779835', 'Naufal Arrauhy Damanik', 'Jl. Tanjung Selamat', '', '', 'L', 'Henny Maysyarah', 'IRWANSYAH DAMANIK', '', '9', 'null', 'null'),
(319, '0125653697', 'Naura Syakila Farhansyah', 'Jl. Tanjung Selamat Gg Rakyat No 97 E', '', '', 'P', 'Fitri Yuslidar Lubis', 'Herdiansyah', '', '7', 'null', 'null'),
(320, '0131511764', 'NAURAH CEMPAKA ARINI', 'Dusun Vi Tanjung Anom', '', '', 'P', 'Erlani Br Sitepu', 'Ariadi', '', '1', 'null', 'null'),
(321, '3135492271', 'NAYLA PUTRI DINARA', 'Dusun I A Gg Keluarga', '', '', 'P', 'Kumala Sari', 'Sahrian', '', '5', 'null', 'null'),
(322, '0088581581', 'NAYSILA ZAHRA', 'DUSUN IV TANJUNG SELAMAT', '', '', 'P', 'LISMAINI TANJUNG', 'Samsul Bahri', '', '15', 'null', 'null'),
(323, '0123467290', 'NAZIHA DARA IRAWAN', 'Jl Makmur Dsn III', '', '', 'P', 'Endang Sarubiani', 'Edi Irawan', '', '1', 'null', 'null'),
(324, '0111242982', 'NAZLA AN-NUR SYIFA', 'JL. BALAI DESA I', '081298747098', '', 'P', 'ETTA YULIANIS', 'FERRI ANDIKA', '', '12', 'null', 'null'),
(325, '0115851116', 'NAZLA CIKITA', 'JL. PERCOBAAN GANG PINANG', '', '', 'P', 'ALMARHUMAH SRI HANDAYANI EFFENDI', 'HERMAN', '', '10', 'null', 'null'),
(326, '0113415831', 'NAZUA SYAKIRA', 'JL. AMAL NO 419', '081360127683', '', 'P', 'SUSANTI', 'SUHERI', '', '10', 'null', 'null'),
(327, '0133076069', 'NAZURA ALANAIYA', 'Dusun I A Gg Keluarga Tanjung Selamat', '', '', 'P', 'Sriati', 'Suriadi', '', '4', 'null', 'null'),
(328, '0112050989', 'NAZWA FEBRYANTI', 'JL. SEI BELUTU I NO. 16 C MEDAN', '', '', 'P', 'SEKAR PUSPITA', 'SYAMSUL HADI', '', '10', 'null', 'null'),
(329, '0097073441', 'NESHYA SALSABILA', 'JL PERCOBAAN NO 23', '', '', 'P', 'SUHENY', 'SARTONO', '', '13', 'null', 'null'),
(330, '0126804101', 'Nirfana Sari Mutiara', 'Jl. Tanjung Selamat', '', '', 'P', 'Rismawati Sagian', 'Satriamiki Wijaya', '', '8', 'null', 'null'),
(331, '0128196998', 'Nizam Sya\'ban', 'Jl. Perjuangan Komp. Griya Mutiara III', '', '', 'L', 'Fatimah', 'Syahbandi', '', '8', 'null', 'null'),
(332, '3135627407', 'NOUVAL BAGAS FIRMANSYAH', 'Perum Griya Harapan Baru 46', '', '', 'L', 'Dina Lestari', 'Timbul Cahyono', '', '4', 'null', 'null'),
(333, '0118151814', 'NOVITA ANGGRAINI', 'JL STARBAN GG FAMILI NO 86', '', '', 'P', 'DINA LESTARI', 'TIMBUL CAHYONO', '', '9', 'null', 'null'),
(334, '0128510945', 'Nur Aini', 'Jl. Tanjung Selamat', '', '', 'P', 'Irmawati', 'Roy Andoni', '', '8', 'null', 'null'),
(335, '0134741781', 'NUR AYU SABRINA', 'Jl. Pimpinan', '', '', 'P', 'Marlina', 'Sabaruddin', '', '3', 'null', 'null'),
(336, '0066078977', 'NURAINA', 'DUSUN II-A GG. TAUFIK', '', '', 'P', 'SRI WAHYUNI', 'ILYAS', '', '15', 'null', 'null'),
(337, '0132853310', 'NURHAFIDA AYUNI', 'Dusun IV Jln. Tampok Tanjung Selamat', '', '', 'P', 'Nurhafni', 'Wahyu Hadianto', '', '2', 'null', 'null'),
(338, '0138448619', 'NURIN EILIYAH PUTERI', 'Dusun I Tanjung Selamat', '', '', 'P', 'Paindah Simamora', 'Darsim', '', '4', 'null', 'null'),
(339, '0119279887', 'NURUL CHICHILYA', 'JL. PIMPINAN UJUNG DUSUN III', '085270520139', '', 'P', 'DEWI KARTINI', 'YUDI PRATAMA KOTO', '', '10', 'null', 'null'),
(340, '0104271992', 'NURUL HAFIZZAH PUTRI', 'DUSUN I-A GG. KELUARGA', '', '', 'P', 'ANITA', 'RIAN WAHYUDI', '', '9', 'null', 'null'),
(341, '0122486490', 'Nurul Khairani', 'Jl. Tanjung Selamat Gg. Perjuangan', '', '', 'P', 'Sri Muliani', 'Eddy Syahputra', '', '6', 'null', 'null'),
(342, '0126739923', 'Ocha Arfani Nabila', 'Jl. Perjuangan Tanjung Selamat Gg. Daun', '', '', 'P', 'Sulastri', 'Oki', '', '6', 'null', 'null'),
(343, '0109089703', 'PINNA OCKTAVIA', 'JL. PERCOBAAN GG. PINANG BARIS', '082360431142', '', 'P', 'IRNAWILIS', 'YUL EFENDI', '', '12', 'null', 'null'),
(344, '0115800427', 'PUTRI SAHARA RITONGA', 'SIMPANG 3 KAMPUNG LALANG', '', '', 'P', 'SITI AISYAH', 'JULKIFLI RITONGA', '', '7', 'null', 'null'),
(345, '3128126602', 'QAILA HUMAIRAH SIREGAR', 'Jl. Glugur Rimbun Gg. Musholla', '', '', 'P', 'Masyitoh Batubara', 'Lengga Payung', '', '1', 'null', 'null'),
(346, '0129313058', 'Qhodri Ahmad Ramadhan', 'Jl. Perjuangan Gg. Guru', '', '', 'L', 'Eva Arnita', 'Syafrizal', '', '6', 'null', 'null'),
(347, '0125880831', 'QUEENSYA WIDDYA VANI', 'Dusun II-B Jl. Perjuangan Gg. D-5', '', '', 'P', 'Gunastasya Dwita Sari', 'Adi', '', '4', 'null', 'null'),
(348, '0132180399', 'QUINZA HANIRA', 'Dusun IV Tanjung Selamat', '', '', 'P', 'Nur Sahara', 'Marzuki', '', '3', 'null', 'null'),
(349, '0095932730', 'RABBY KHAIRIN', 'DUSUN II TANJUNG ANOM', '081262453004', '', 'L', 'SURYANI', 'HERMANTO', '', '11', 'null', 'null'),
(350, '0115576441', 'RADINKA ADELIO SITEPU', 'JL. H.M PUNA SEMBIRING', '', '', 'L', 'LUXIANA HERI SUSIYANTI', 'NEHEMIA SITEPU', '', '10', 'null', 'null'),
(351, '0106209592', 'RAFA EGIGUSTIAN', 'JL DELIMA', '', '', 'L', 'RASIKA', 'MISYANTO', '', '12', 'null', 'null'),
(352, '0103729377', 'RAFA MUHAMMAD ESA', 'JL. REHULINA', '081376805613', '', 'L', 'JULIANA NASUTION', 'ARIS HARIAWAN', '', '12', 'null', 'null'),
(353, '0097489507', 'RAFIANSYAH', 'JL. PERCOBAAN', '', '', 'L', 'FANY', 'ROMIANSYAH', '', '12', 'null', 'null'),
(354, '0133374502', 'RAFIFA AISHA MAHERA', 'Komplek Bintang Merdeka', '', '', 'P', 'Farida Hanum', 'Hary Purnomo', '', '3', 'null', 'null'),
(355, '0098535038', 'RAFIFAH ASILA MARWA', 'JL. PERJUANGAN', '085297340601', '', 'P', 'DESSY HIJRIASARI', 'AFRIZAL JUANDA', '', '14', 'null', 'null'),
(356, '0134066004', 'RAFKA KESUMA', 'Jl. Tampok', '', '', 'L', 'Fina Harianti', 'Muhammad Syafii', '', '5', 'null', 'null'),
(357, '0129892957', 'Rafka Syahputra', 'Jl. Perjuangan', '', '', 'L', 'Aisyah Elsa Irama', 'Dian Pratama', '', '5', 'null', 'null'),
(358, '0112080552', 'RAFLY SUPRAPTO', 'JL. PERUM PONDOK INDAH BLOK HN06', '085373037030', '', 'L', 'LILI DAMAYANTI', 'JAFAR', '', '9', 'null', 'null');
INSERT INTO `ts_siswa` (`idSiswa`, `nis`, `nama`, `alamat`, `noHP`, `email`, `jenisKelamin`, `namaIbuKandung`, `namaAyahKandung`, `noHPOrangTua`, `kelas`, `tahunAjaran`, `status`) VALUES
(359, '0123054300', 'Raihan Bagas Kriskayana', 'Jl. Setia Budi No 61 LkVI', '', '', 'L', 'Gunasty Emilia Sari', 'Juanda Syahrizal', '', '6', 'null', 'null'),
(360, '0113790367', 'RAIYAN AQIILAH', 'JL. BERSAMA - TAMPOK', '085261487982', '', 'L', 'GUSPINA', 'DIDIK ARMADI', '', '10', 'null', 'null'),
(361, '0128683789', 'Rajwa Syafiqah', 'Jl. Perum Griya Mutiara 3', '', '', 'P', 'Imelda', 'Try Bastian', '', '8', 'null', 'null'),
(362, '0134705331', 'RAKA ALKHOIR', 'Dusun IV Gg Tampok Tanjung Selamat', '', '', 'L', 'Dwi Lestari', 'Muhammad Heru Purnomo.AM', '', '4', 'null', 'null'),
(363, '0111902108', 'RAKA ARDIANSYAH', 'JL. SNAKMA GRIYA MUTIARA NO A1', '081370474538', '', 'L', 'SUPRIYATI NINGSIH', 'ANDI IRWANSYAH', '', '10', 'null', 'null'),
(364, '0102165423', 'RAKHA BAYU WIGUNA. G', 'GLUGUR RIMBUN', '', '', 'L', 'YULI CHAIRANI', 'Mhd.Roni Ginting', '', '12', 'null', 'null'),
(365, '0095039182', 'RAMA DEWI', 'JL. PERJUANGAN', '', '', 'P', 'MESNI', 'LISKA ANUWAR', '', '11', 'null', 'null'),
(366, '3134197438', 'RAMDAN ALAMSYAH', 'Jl. S. Karya', '', '', 'L', 'Umi Kalsum', 'Muliadi', '', '2', 'null', 'null'),
(367, '0098042716', 'RANDY SAFRIZA PUTRA', 'DUSUN I-A GG. KELUARGA', '', '', 'L', 'DARIYATI', 'HENGKI HARDEDEK', '', '14', 'null', 'null'),
(368, '0139519368', 'RANGGA PRATAMA', 'Perum Griya Mutiara 3 Blok C No. 38', '', '', 'L', 'Susilawati', 'Hardianto', '', '5', 'null', 'null'),
(369, '0093209278', 'RANGGA PRATAMA', 'TANJUNG SELAMAT', '', '', 'L', 'WAHYUNI', 'HENDRI', '', '14', 'null', 'null'),
(370, '0135477539', 'RARA KHALIFAH BALQIS', 'Jl. Kenanga Raya Gg Bahagia No 3', '', '', 'P', 'Siti Ratih', 'Rahmat Syahputra', '', '1', 'null', 'null'),
(371, '0135878724', 'RAVA DWI FAHRIZA', 'Dusun II-A Tanjung Selamat', '', '', 'L', 'Eviati', 'Wagimin', '', '3', 'null', 'null'),
(372, '0112409381', 'Ray Rinaldy', 'Dusun II A Jl Percobaan', '', '', 'L', 'Kasiani Pratiwi', 'M. Hamdi', '', '7', 'null', 'null'),
(373, '3139229143', 'RAYHAN SYAFII', 'Dusun IV Kutambelin', '', '', 'L', 'Dina Wahyuni', 'Dede Priambada', '', '2', 'null', 'null'),
(374, '0081166123', 'RAZA BINTANG MUDA', 'PURI ANOM SEMBAHE', '', '', 'L', 'WILDA NINGSIH', 'ZAINAL ISKAR', '', '14', 'null', 'null'),
(375, '0112944372', 'RAZYA SYAHPUTRA', 'JL. TANJUNG SELAMAT G. HIDAYAH', '081364621146', '', 'L', 'SULASTRI', 'AGUS HARIANTO', '', '10', 'null', 'null'),
(376, '0105934585', 'RENDI SYAHPUTRA', 'JL. TAMPOK', '', '', 'L', 'MISLAINI', 'SUPARDAN', '', '12', 'null', 'null'),
(377, '0099310703', 'RESZKY', 'DUSUN III JL. PENDIDIKAN TANJUNG ANOM', '', '', 'L', 'HAMSIA', 'RAHMAN', '', '13', 'null', 'null'),
(378, '0112786549', 'REZKI AKBAR TANJUNG', 'JL. PURI ANOM ASRI BLOK BB73', '081376859019', '', 'L', 'YURIKA PRATIWI', 'IRWANSYAH TANJUNG', '', '9', 'null', 'null'),
(379, '0093102655', 'REZKI RAMADHAN', 'JL. PERJUANGAN GG. DAMAI', '085262624939', '', 'L', 'MAISYARAH', 'RAHMAD RIYADI', '', '11', 'null', 'null'),
(380, '0123308488', 'REZKY FAHREZI', 'Dusun IV Jl. Tampok', '', '', 'L', 'Juni Khairani Lubis', 'Saiful Amri', '', '4', 'null', 'null'),
(381, '0098791475', 'REZKY TRISTANSYAH', 'JL. PENDIDIKAN NO. 481', '081265325781', '', 'L', 'MUSINAH', 'ANTON S. RIYADI', '', '14', 'null', 'null'),
(382, '0101933682', 'RIDHO ARRASYID EFFENDI', 'JL. PERJUANGAN GG. DELIMA', '085359475482', '', 'L', 'WASUHELMI', 'ZULHAM EFFENDI', '', '12', 'null', 'null'),
(383, '0123465864', 'Ridho Pratama', 'Jl. Bougenville No. 50 Lk X', '', '', 'L', 'RR.Fitria Akbari', 'Achmad Fadhlan', '', '6', 'null', 'null'),
(384, '0118091116', 'RIEZCHA AL-ARRUM', 'JL. PERCOBAAN', '081265994549', '', 'P', 'ERIDAH', 'YUSRIZAL', '', '10', 'null', 'null'),
(385, '0108186318', 'RIFAN SYAH', 'NO.318', '', '', 'L', 'ERMA YANTI', 'HERMANTO', '', '11', 'null', 'null'),
(386, '0111745657', 'Rifky Aditya Pusuk', 'Jl. Setia Budi Pasar IV Gg. Inpres', '', '', 'L', 'Dewi Simbolon', 'Suniarto Pusuk', '', '7', 'null', 'null'),
(387, '0098341185', 'RIFQI AZRI RABBANI', 'JL. PERJUANGAN', '085262211375', '', 'L', 'NURAINI', 'SYAFRI', '', '12', 'null', 'null'),
(388, '0087405665', 'RIKA SYAHPUTRI BR LUBIS', 'DUSUN VI TANJUNG ANOM', '', '', 'P', 'RISMA SIMBOLON', 'TASNIR LUBIS', '', '15', 'null', 'null'),
(389, '0088934524', 'RINDI INDAH LESTARI SITUMEANG', 'JL LIZADRI PUTRA NO 3 A LK X', '', '', 'P', 'SUSILAWATI', 'HERMANSYAH SITUMEANG', '', '13', 'null', 'null'),
(390, '0086614630', 'RINO PRASETYO HADI', 'JL. M YAKUB NO. 85 MEDAN', '', '', 'L', 'ARIYANI', 'Suprihadi Kustoko', '', '15', 'null', 'null'),
(391, '0113794202', 'RIYAN BASTANTA TARIGAN', 'DUSUN I SEMBAHE BARU', '', '', 'L', 'SERI ULINA', 'EFENDI TARIGAN', '', '6', 'null', 'null'),
(392, '3128947501', 'RIZKI ANANDA DALIMUNTHE', 'Griya Mutiara 2 Blok C1', '', '', 'L', 'Suci Anjani', 'Asrul Aswad', '', '3', 'null', 'null'),
(393, '0118367195', 'Rizkia Dianty Shaila', 'Jl. Kresek No 18X', '', '', 'P', 'Riyanti', 'Eko Susilo', '', '8', 'null', 'null'),
(394, '3122051673', 'RIZKY AFANDI PRATAMA TARIGAN', 'Dusun I-A Tanjung Selamat', '', '', 'L', 'Anjeliani Br Ginting', 'Jasmani Hidayah Tarigan', '', '2', 'null', 'null'),
(395, '0129888420', 'Rizqi Primansyah Putra', 'Jl. Percobaan Gg. Memeng', '', '', 'L', 'Supriati', 'Suharman', '', '8', 'null', 'null'),
(396, '0083502837', 'RYAWILDA DUHITA', 'JL. PERJUANGAN', '', '', 'P', 'ROHMANIAH', 'HANDI YORMAN', '', '15', 'null', 'null'),
(397, '3081153182', 'Sarfia Ramadani Daulay', 'Dusun II-A Gg. Hidaya Tj. Selamat', '', '', 'P', 'Rani Dewi Matofani', '', '', '14', 'null', 'null'),
(398, '0127383879', 'SATRIA BAYHAQI PRATAMA', 'Jl. Flamboyan Raya Lk-II', '', '', 'L', 'Aisah', 'Agus Hanjaya', '', '1', 'null', 'null'),
(399, '0094896268', 'SAYYID SYAMIL BASAYEV HARAHAP', 'Jl. Raya Menteng No. 37', '', '', 'L', 'NURHANIAH NASUTION', 'M AKHIRUDDIN KARIM HARAHAP', '', '13', 'null', 'null'),
(400, '0065909734', 'SELVIA ADINDA', 'JL. TANJUNG ANOM', '', '', 'P', 'ASLINA', 'EDI KURNIAWAN', '', '14', 'null', 'null'),
(401, '3134159156', 'SESILLIA ANGGREINI', 'Sukaraya Gg Keroja', '', '', 'P', 'Ana', 'Adi Sahputra Saragih', '', '5', 'null', 'null'),
(402, '0104428601', 'SHANDY RAMADHAN', 'JL. TANJUNG SELAMAT TAMPOK', '085361007333', '', 'L', 'LISA KUMALA SARI', 'BUDI ARFIAN', '', '11', 'null', 'null'),
(403, '0098500801', 'SILO DWI CAHYO', 'TANJUNG SELAMAT', '', '', 'L', 'RIMA YANTI', 'SUGI HARTO', '', '13', 'null', 'null'),
(404, '0099222645', 'Sintia Oktaviani', 'jalan Hok Salamuddin', '', '', 'P', 'Mei Saputri Nasution', 'Sutrisno', '', '14', 'null', 'null'),
(405, '0128347580', 'SISKA FADILLAH', 'Jl. Percobaan', '', '', 'P', 'Piliyanti', 'Fadli', '', '5', 'null', 'null'),
(406, '0132535396', 'SITI AISYAH KIRANA', 'Dusun I-A Tanjung Selamat', '', '', 'P', 'Siti Dahlia', 'Suratno', '', '1', 'null', 'null'),
(407, '0078113104', 'Spakus Sadewo', 'Desa Klambir', '', '', 'L', 'Yusmaniar', 'Sujarko', '', '15', 'null', 'null'),
(408, '3129824522', 'SUBHAN TIYO LESMANA', 'Griya Mutiara III', '', '', 'L', 'Rika Sugiarti', 'Lesmana', '', '5', 'null', 'null'),
(409, '0105730741', 'SUCI SADARIAH', 'JL. TAMPOK TANJUNG SELAMAT', '085297281921', '', 'P', 'NURMAWATI', 'ZULPIKAR', '', '9', 'null', 'null'),
(410, '0077535314', 'Surya Darmawan.S', 'Dusun IV Jln Tampok Tanjung Selamat', '', '', 'L', 'Nur Hamidah', 'ILHAM', '', '15', 'null', 'null'),
(411, '0111717625', 'SURYA FIRMANSYAH BOANG MANALU', 'JL. TAMPOK TANJUNG SELAMAT', '081282263197', '', 'L', 'ARSIMA', 'KARTONO BOANG MANALU', '', '9', 'null', 'null'),
(412, '3121643205', 'SYAAMIIL AFRAH', 'Jl Sei Blutu Gg Bersama / 87', '', '', 'L', 'Misra Diana', 'Ali Martono', '', '4', 'null', 'null'),
(413, '0126905864', 'Syadila Ariska Putri', 'Jl. Tanjung Selamat Gg. Keluarga', '', '', 'P', 'Sunilawati', 'Syahdi Ramadhan', '', '6', 'null', 'null'),
(414, '0117098189', 'SYAHFITRI RASYA ANINDITHA', 'DUSUN I-B GG. ARJUNA', '081376434564', '', 'P', 'RAHMADANI', 'NURDI', '', '10', 'null', 'null'),
(415, '0112416890', 'Syahira Hamda Arafah', 'Jl. Perumahan Puri Anom Asri', '', '', 'P', 'Rolanda Lestari', 'Ahmad Hambali', '', '6', 'null', 'null'),
(416, '0094430003', 'SYARIF SULAIMAN AR-RASYID LUBIS', 'PERUM PONDOK INDAH TANUNG ANOM', '', '', 'L', 'SURYA DEWI KHAIRANI MARGOLANG', 'DAWUD BUDIMAN LUBIS', '', '13', 'null', 'null'),
(417, '0099275547', 'Syifa Almaira', 'Rantau', '', '', 'P', 'Maisarah', 'Marzuan', '', '14', 'null', 'null'),
(418, '0128666831', 'Syifa Salsabila Sitorus', 'Jl. Perumahan Grand Citra Asri Blok D16', '', '', 'P', 'Dewi Megawati', 'Kamaluddin Sitorus', '', '6', 'null', 'null'),
(419, '3127330496', 'SYUJA RIVAEL. S', 'Tanjung Selamat', '', '', 'L', 'Elva Wahyuni Tarigan', 'Heriyanto. S', '', '2', 'null', 'null'),
(420, '3133425484', 'TAMARA HERLISA', 'Dusun II A Tanjung Selamat', '', '', 'P', 'Elisa Damayanti', 'Hermansyah', '', '1', 'null', 'null'),
(421, '0091395919', 'TANIA NUR AZIZAH RAMBE', 'JL. FLAMBOYAN RAYA GG. BAHRUM', '', '', 'P', 'MAYA SARI DEWI', 'INDRA BAYU', '', '14', 'null', 'null'),
(422, '0077427461', 'TARATA PANI BR SURBAKTI', 'JL. KUTAMBELIN', '', '', 'P', 'SITI HOTNIDA BR HARAHAP', 'SASTRAWAN SURBAKTI', '', '13', 'null', 'null'),
(423, '0116341522', 'TASYA ADILA', 'JL. TANJUNG ANOM', '085767543327', '', 'P', 'KENNI ANDRIANI', 'SAPUTRA', '', '9', 'null', 'null'),
(424, '0107352326', 'TEGAR ASHARI', 'JL. BALAI DESA G. RUKUN', '', '', 'L', 'IRMAWATI', 'ROY ANDONI', '', '10', 'null', 'null'),
(425, '0118217193', 'Tegar Setiawan', 'Jl. Flamboyan Lk. III', '', '', 'L', 'Aisah Br Sinaga', 'Arifin', '', '6', 'null', 'null'),
(426, '0117935445', 'TEGUH IMAN BOANG MANALU', 'DUSUN IV TANJUNG SELAMAT', '085216116708', '', 'L', 'NUR ALIS', 'ADI MURAH BUANG MANALU', '', '9', 'null', 'null'),
(427, '0116781901', 'TENGKU AZILLA NURAISYAH', 'JL. BERSAMA TAMPOK', '', '', 'P', 'HENNY SHINTA DUETA SILALAHI', 'T. M. SATAR', '', '9', 'null', 'null'),
(428, '0128300265', 'Tengku Fahris', 'Jl. Flamboyan-6E Link-VII Medan', '', '', 'L', 'Rosidawati', 'Ahmadi', '', '7', 'null', 'null'),
(429, '0103827598', 'THABITA PUTRI HAMDANI', 'JL. PERCOBAAN', '', '', 'P', 'MEVIKA NADIA WANDANI', 'HAMDAN', '', '11', 'null', 'null'),
(430, '0102089716', 'TIARA EDI SAHRA', 'JL. PERCOBAAN', '082370955094', '', 'P', 'HALIJAH', 'EDI WISMANTO', '', '9', 'null', 'null'),
(431, '0119128049', 'TRIA MARINA BR SURBAKTI', 'JL. PERJUANGAN', '085262624937', '', 'P', 'ISTIANI BR SEMBIRING', 'NASRAN SURBAKTI', '', '10', 'null', 'null'),
(432, '0133158874', 'UKASYAH VINO RAMADHAN', 'Komplek Griya Mutiara II Blok EE 41', '', '', 'L', 'Meilisa Chairani', 'Ridwansyah', '', '3', 'null', 'null'),
(433, '0091858715', 'VICKRY ALGHANIYYU', 'DUSUN II B JL. PERJUANGAN Gg. DAUN', '', '', 'L', 'SOPIAH', 'FERI IRAWAN', '', '14', 'null', 'null'),
(434, '3110186806', 'Vikry Septiansyah', 'Jl. Perjuangan Gg. Daun', '', '', 'L', 'Norita', 'Suriadi', '', '7', 'null', 'null'),
(435, '0106605211', 'VIRZHA AL AVI', 'JL. BESAR TANJUNG SELAMAT GG. SILMI', '082366651988', '', 'P', 'HAFIAH', 'H. NUR ALI', '', '12', 'null', 'null'),
(436, '0111994092', 'VYCI HANIVAH', 'DUSUN II-A JL. PERJOBAAN', '', '', 'P', 'RENI SUNDARI', 'ENDRA PURWADI', '', '10', 'null', 'null'),
(437, '0091074305', 'WADHIAH YASMINE', 'PERUMAHAN PURI ZAHARA NO D10', '', '', 'P', 'ANITA SHANTY', 'WAHYUDI PANCA DHARMA', '', '13', 'null', 'null'),
(438, '3133890792', 'Wahid Wildan', 'Perum Puri Anom Asri Blok B63', '', '', 'L', 'Sariahwati', 'Agus Rizal', '', '5', 'null', 'null'),
(439, '0095431294', 'WAHYU GUNANTA PERANGIN-ANGIN', 'JL.PIMPINAN', '', '', 'L', 'MAHDALENA BR SURBAKTI', 'CHAIRUDDIN PERANGIN-ANGIN', '', '15', 'null', 'null'),
(440, '0094369745', 'Wahyu Suheri', 'TANJUNG SELAMAT', '', '', 'L', 'Siti Supiah', 'RIDUAN', '', '15', 'null', 'null'),
(441, '0137395523', 'WHISNU NUR RAMADHAN', 'Dusun III Jln. Terna', '', '', 'L', 'Siti Aminah', 'Wasbir', '', '1', 'null', 'null'),
(442, '0102818540', 'WIDIYA ARTA BINA', 'JL. SEI GLUGUR DUSUN III', '082368235540', '', 'P', 'TUNINGSIH', 'HARIONO', '', '12', 'null', 'null'),
(443, '0092481507', 'WIDODO ADHA', 'JL. TANJUNG SELAMAT', '085359594055', '', 'L', 'SAMSYA', 'JAMALUDDIN', '', '12', 'null', 'null'),
(444, '0112577078', 'WINA SABRINA', 'JL. TANJUNG SELAMAT', '082273932027', '', 'P', 'ROSMAWATI', 'SANDRO', '', '9', 'null', 'null'),
(445, '0092090512', 'WINDA YULAN SARI', 'DUSUN II-B JL. PERJUANGAN GG. MUFAKAT NO.9-A', '', '', 'P', 'YUS RINA', 'ERI YANTO', '', '13', 'null', 'null'),
(446, '0084507500', 'WIRA PRABASWARA', 'PERUM PURI ZAHARA NO D10', '', '', 'L', 'ANITA SHANTY', 'WAHYUDI PANCA DHARMA', '', '15', 'null', 'null'),
(447, '0096077850', 'WISNU', 'DUSUN I-A GG. KELUARGA', '', '', 'L', 'NURAINI', 'SUKIMIN', '', '13', 'null', 'null'),
(448, '0111189263', 'YASMIN AZZAHRA IKHWAN', 'JL. BALAI DESA GANG SEJAHTERA', '', '', 'P', 'RABIATU \'ADAWIYAH GURU SINGA', 'IKHWAN ABDI SATRIA', '', '9', 'null', 'null'),
(449, '0105910295', 'YUDA PRATAMA', 'JL. PERJUANGAN GG. DAUN', '085261702771', '', 'L', 'YULI ANGGRIANI', 'DARMA WIJAYA', '', '11', 'null', 'null'),
(450, '0106792169', 'YUGA ABDIE PRATAMA', 'JL. PERJUANGAN GG. BUNGA MATAHARI', '085206009401', '', 'L', 'LINDA ZULFIDA SIREGAR', 'NASRUL ABDI', '', '12', 'null', 'null'),
(451, '0136444813', 'YUMNA FARIHA SITEPU', 'Jl. Simalingkar-2', '', '', 'P', 'Luxiana Heri Susiyanti', 'Nehemia Sitepu', '', '4', 'null', 'null'),
(452, '0098178119', 'YUSRIANI BR BARUS', 'P. PURI ANOM BLOK D-03', '', '', 'P', 'YULITA LASE', 'MULIANDARI BARUS', '', '14', 'null', 'null'),
(453, '0128737328', 'Zahira Amelia', 'Dusun I-A Gg. Keluarga Tg. Selamat', '', '', 'P', 'Agustina', 'Mulianto Al Hadi', '', '8', 'null', 'null'),
(454, '0114492141', 'ZAHIRA ASYIFA PUTRI', 'Jl. Balai Desa Sunggal', '', '', 'P', 'Zuraida', 'Junaidi', '', '4', 'null', 'null'),
(455, '0114555827', 'Zahira Febrina Br Barus', 'Jl. Flamboyan Raya Gg. Sejati', '', '', 'P', 'Yulita Lase', 'Muliandari Barus', '', '8', 'null', 'null'),
(456, '0117846709', 'ZAHIRA HAMZAH', 'JL. TANJUNG SELAMAT GG. HIDAYAH', '', '', 'P', 'LINDA WATI', 'SAMSUL HAMZAH', '', '9', 'null', 'null'),
(457, '3131018146', 'ZAHRA HAFIZHAH AZMI', 'Perumahan Puri Anom Asri Blok D No. 92', '', '', 'P', 'Mila Afriani Simatupang', 'Nur Arif Jaya', '', '4', 'null', 'null'),
(458, '0124922108', 'ZALIKA ZANATI BR TARIGAN', 'Jl P Baris Gg Rambutan', '', '', 'P', 'Arnisa Br Ginting', 'Aziz Tarigan', '', '3', 'null', 'null'),
(459, '0121091546', 'Zalmima Laila', 'Jln. Setia Budi gg. Tengah', '', '', 'P', 'Amrina', 'Jaenun', '', '10', 'null', 'null'),
(460, '0124545399', 'ZASKIAH PUTRI', 'Dusun IV Jl. Tampok Tanjung Selamat', '', '', 'P', 'Ngatiah', 'Fahrudin', '', '2', 'null', 'null'),
(461, '0125186733', 'Zeny Almaira', 'Jl. Simpang Poros', '', '', 'P', 'Yeni Octavia', 'Sugiarto', '', '8', 'null', 'null'),
(462, '3133308472', 'ZEVAN AL AKBAR', 'Jln Sunggal', '', '', 'L', 'Syafita Hariyani', 'Iryandi', '', '5', 'null', 'null'),
(463, '0119249519', 'ZHARIF FAJRUL ARKAN', 'JL. PERJUANGAN GANG ANGGREK', '', '', 'L', 'HENNY DRIANA HASIBUAN', 'ACHMAD IRVAN', '', '10', 'null', 'null'),
(464, '0076134749', 'Zidan Didi Ramadhan', 'JL.GLUGUR RIMBUN ', '', '', 'L', 'Yeni Kesuma', 'IKHWANUR RAMADHAN', '', '15', 'null', 'null'),
(465, '0134605303', 'ZIQRI AHNAF', 'Griya Mutiara Blok E 26', '', '', 'L', 'Lina Alisma', 'Ricky Bustami', '', '4', 'null', 'null'),
(466, '0122987252', 'ZIVARA AQILLA', 'RANTAU', '', '', 'P', 'MAISARAH', 'MARZUAN', '', '7', 'null', 'null'),
(467, '0103205999', 'ZYVILLIA GIOVANI', 'JLN. PERJUANGAN', '081361119063', '', 'P', 'SUPRIANI', 'MISWANTO', '', '12', 'null', 'null'),
(468, '0065577281', 'ABDUH RAFFI', 'JL.PERJUANGAN GG BUNTU', '', '', 'L', 'SADIAH', 'RAHMAD', '', '16', 'null', 'null'),
(469, '0076398221', 'Abdul Jaris', 'Jalan Sejati', '085361005628', '', 'L', 'Sukriyah', 'Miswar', '', '16', 'null', 'null'),
(470, '0067716463', 'Abdul Rahim', 'Tanjung Anom', '081370203253', '', 'L', 'Afrida Susanti', 'Dewa', '', '22', 'null', 'null'),
(471, '0074102152', 'ABIZARD AULIA GINTING', 'Jl. Tanjung Selamat', '', '', 'L', 'CICIK', 'CICIK', '', '16', 'null', 'null'),
(472, '0058713391', 'Adam Ardiansyah', 'Dusun VI Tanjung Anom', '', '', 'L', 'Lidia Wati', 'Irwansyah', '', '22', 'null', 'null'),
(473, '0056371429', 'ADELIA RUSLANI', 'JL. FLAMBOYAN XI LK-III', '', '', 'P', 'NURCAHAYA', 'Ruslan Effendi', '', '26', 'null', 'null'),
(474, '0076964190', 'Aditya Pradipta Nainggolan', 'Jl. Mesjid No. 90', '', '', 'L', 'Fatmawati Nasution', 'Rudi Ismanto', '', '18', 'null', 'null'),
(475, '0053256955', 'ADRYAN', 'JL. TANJUNG ANOM GG. PENDIDIKAN', '', '', 'L', 'RINI ARIANI', 'Sahrul', '', '24', 'null', 'null'),
(476, '0068972074', 'Afdansyah', 'Dusun II-A Gang Saudara', '', '', 'L', '-', 'Muhammad Fadlin', '', '20', 'null', 'null'),
(477, '0077379881', 'AFIF ARBI', 'JALAN BUNGA KARDIOL NO. 44', '', '', 'L', 'DIANA EFFENDI, SE', 'SUYONO', '', '19', 'null', 'null'),
(478, '0059954296', 'AHMAD BAYHAQI PUTRA ARIANDI', 'DUSUN VI PURWOJOYO', '', '', 'L', 'SUPARTIK', 'YAN ARIANDI', '', '25', 'null', 'null'),
(479, '0056914384', 'Ahmad Hafiz', 'Dusun I-B JL Besar Tanjung Selamat', '', '', 'L', 'Supri Warni', 'Ngasiman', '', '22', 'null', 'null'),
(480, '0068431261', 'AHMAT ANDIKA', 'JL. TANJUNG SELAMAT', '', '', 'L', 'MURNIATI', 'ZULKARNAIN', '', '22', 'null', 'null'),
(481, '0067726945', 'Ahmat Rizal', 'Dusun IV Tanjung Selamat', '', '', 'L', 'Ema Rama Yanti', 'Khirul Nizar', '', '21', 'null', 'null'),
(482, '0061200695', 'Ahyar Syah Rizal Berutu', 'Dusun IV JL. Tampok Tanjung Selamat', '', '', 'L', '-', 'Muhamri Berutu', '', '20', 'null', 'null'),
(483, '0075047131', 'Aidil Alfiansa', 'Tanjung Anom', '', '', 'L', 'Sumiani', 'Sumardi', '', '19', 'null', 'null'),
(484, '0057657065', 'AJI KURNIAWAN', 'JL. TANJUNG ANOM GG. AMALIYAH', '', '', 'L', 'SUPRIATI', 'Rusli', '', '26', 'null', 'null'),
(485, '3081941367', 'AL-FATHIR ADIYAT', 'TJ. ANOM', '', '', 'L', '-', 'EDI IRAWADI', '', '20', 'null', 'null'),
(486, '0068645471', 'Aldo Sahputra', 'Dusun IV JL. Tampok Tanjung Selamat', '', '', 'L', '-', 'Heri Adi', '', '22', 'null', 'null'),
(487, '0075204993', 'ALFI SAHRIN', 'TANJUNG SELAMAT', '', '', 'L', 'SANIAH DEWI SISANTI', 'SUMITO', '', '16', 'null', 'null'),
(488, '0059092986', 'ALFIKRI ADITYA', 'DUSUN VI TANJUNG ANOM', '', '', 'L', 'SAMIRAH', 'Alamsyah Yazid', '', '25', 'null', 'null'),
(489, '0078402569', 'Alif Permana', 'Jalan Mulia', '', '', 'L', 'Sri Rahayu', 'Safi\'i', '', '16', 'null', 'null'),
(490, '0073264062', 'Alka Tria Saputra', 'Jl. Abdullah Lubis No 5 A', '', '', 'L', 'Tri Purnama Dewi', 'Sumantri Widodo', '', '17', 'null', 'null'),
(491, '0053704197', 'ALVITO ROHIM', 'JL. KUTALIMBARU', '', '', 'L', 'VIOLIN ANITA', 'Susanto', '', '26', 'null', 'null'),
(492, '0077539518', 'Amira Az-Zahra', 'Jl.Pendidikan No. 104', '085262815242', '', 'P', 'Rika Utari', 'M. Amin Pranata', '', '20', 'null', 'null'),
(493, '0065511160', 'ANDI PRATAMA', 'JALAN MULIA SEJATI', '', '', 'L', 'SUWARNI', 'MESNAN', '', '17', 'null', 'null'),
(494, '0057487803', 'ANDIA MUQTI', 'JL. SEJATI', '', '', 'L', 'HAMIDAH', 'Yudi Lesmono', '', '24', 'null', 'null'),
(495, '0049235720', 'ANDIKA SAPUTRA', 'GG. TAUFIQ', '', '', 'L', 'SITI KHAIRANI', 'SADIKIN', '', '21', 'null', 'null'),
(496, '0078579926', 'ANDINI', 'Jl. Flamboyan Raya gg. Musyawarah', '085264532255', '', 'P', 'Santi Maria', 'Aliandi Sahputra', '', '16', 'null', 'null'),
(497, '0038962995', 'ANGGI SUCIYANI', 'TANJUNG ANOM', '', '', 'P', 'SURYATI', 'Syahpuddin Saragih', '', '26', 'null', 'null'),
(498, '0059359091', 'ANISA PEBRIANA BR SURBAKTI', 'JL. DUSUN II-A TANJUNG SELAMAT', '', '', 'P', 'LESTIAWATI BR. TARIGAN', 'Suriono Surbakti', '', '25', 'null', 'null'),
(499, '0064080182', 'Annisa Nurhidayah', 'Tanjung Anom', '', '', 'P', 'Meta Kurnia Rahmadani', 'Edi Winda Wanto', '', '21', 'null', 'null'),
(500, '0073362722', 'ANUGRAH PRATAMA', 'JL. ABADI GG. RUKUN', '', '', 'L', 'WARTI', 'MARWADI', '', '16', 'null', 'null'),
(501, '0073198869', 'ARDO ZUHUMA SEMBIRING', 'TANJUNG ANOM', '', '', 'L', 'EVI JULIANI', 'JULIUS SEMBIRING', '', '20', 'null', 'null'),
(502, '0061915992', 'Argio Fardhan', 'Jl. Kutalimbaru No. 78', '06176582342', '', 'L', 'Suliawati', 'Arianto', '', '21', 'null', 'null'),
(503, '0066734160', 'ARI ANGGARA', 'JL. TANJUNG SELAMAT', '085763274717', '', 'L', 'SUNI ATI', 'SAMSUDIN', '', '16', 'null', 'null'),
(504, '0059275026', 'Arial Firmansyah', 'Dusun I', '', '', 'L', 'Juliani', '', '', '20', 'null', 'null'),
(505, '0062961164', 'Arimbi Al Furqon', 'Jl. Lapangan Golf', '', '', 'P', 'Sri Susianti', 'Jumawar', '', '20', 'null', 'null'),
(506, '0042918386', 'ARIQ SYAHPUTRA', 'JL. PERJUANGAN', '', '', 'L', 'EVI YULITA MATONDANG', 'Ardiansyah', '', '24', 'null', 'null'),
(507, '0053256956', 'ARYA WARDANI', 'JL. TANJUNG ANOM', '', '', 'L', 'SUNAN NINGSIH', 'Mislan', '', '26', 'null', 'null'),
(508, '0065909622', 'ASISAH NURUL ILMI', 'DURIN JANGAK', '', '', 'P', 'INA MARLINA', 'DASA TAAT SINUHAJI', '', '21', 'null', 'null'),
(509, '0043553897', 'ASSYFA ALLAYDA', 'JL. FLAMBOYAN RAYA LINGK. III', '', '', 'P', 'UMI SAKDIAH', 'Muhammad Yusuf', '', '27', 'null', 'null'),
(510, '0058381720', 'AUDREY PUTRI SATRIA', 'JL. BALAI DESA II', '', '', 'P', 'PUJIATI', 'Andri Satria', '', '24', 'null', 'null'),
(511, '0061884139', 'Aura Amelia', 'Tuntungan', '085372401700', '', 'P', 'Mida amanda', 'Supriadi', '', '22', 'null', 'null'),
(512, '0074369606', 'Ayu Diah Suwandi', 'Tanjung Selamat', '', '', 'P', 'Erlina', 'Agus Sudiharmanto', '', '17', 'null', 'null'),
(513, '0067853114', 'Ayu Sri Lestari', 'Dusun II Tanjung Anom', '', '', 'P', '-', 'Mishan', '', '18', 'null', 'null'),
(514, '0079992890', 'AZ-ZAHRA', 'JL. STARBAN GG. GARUDA MEDAN', '', '', 'P', 'YENI NINGSIH ASTUTI', 'YULI SURONO', '', '16', 'null', 'null'),
(515, '0078235686', 'AZAHRA', 'JL.DAHLIA RAYA NO 22', '', '', 'P', 'EVIYULITA MATONDANG', 'ARDIANSYAH', '', '22', 'null', 'null'),
(516, '0067878257', 'AZMI HAWARI', 'JL. TANJUNG SELAMAT', '', '', 'L', 'HABSYAH', 'AGIANTO', '', '22', 'null', 'null'),
(517, '0046467594', 'BAGAS PERDIANSAH', 'JL. PONDOK INDAH', '', '', 'L', 'SUPRIANI', 'Asep Supriatna', '', '24', 'null', 'null'),
(518, '0063912154', 'Bagus Prianto', 'DSN VI Desa Tanjung Anom', '081261486688', '', 'L', 'Devi Hamdayani', 'Sugiharto', '', '20', 'null', 'null'),
(519, '0074727485', 'BARA BAJA ABAYU SENJA', 'JALAN MULIA SEJATI', '', '', 'L', 'SUSANTI', 'EDI NURIADI', '', '19', 'null', 'null'),
(520, '0052343328', 'BAYU JOYARDHI', 'JL. TANJUNG SELAMAT', '', '', 'L', 'RINI HASTUTI', 'SARMAN', '', '25', 'null', 'null'),
(521, '0041676836', 'BELA SAFIRA', 'JL. RAJAWALI NO. 29', '', '', 'P', 'ZAIRAIDA M', 'Muhammad Yusuf', '', '24', 'null', 'null'),
(522, '0053256960', 'Bella Ardila Lubis', 'JL. BESAR TANJUNG ANOM', '', '', 'P', 'Siti Aijah', 'Zainul Bahri Lubis', '', '25', 'null', 'null'),
(523, '0056656622', 'BIMA ABDILLAH', 'JL. TANJUNG SELAMAT', '', '', 'L', 'SUYANTI', 'Bambang Supriadi', '', '26', 'null', 'null'),
(524, '0076548835', 'CAHAYA ANNISA', 'JL.PONDOK BAMBU', '', '', 'P', 'SITI SARAH LUBIS', 'SULAIMAN', '', '17', 'null', 'null'),
(525, '0074039939', 'CAHYA KHASIH APRILIA', 'JALAN MULIA SEJATI', '', '', 'P', 'SUMIRAH', 'RUSMAN', '', '17', 'null', 'null'),
(526, '0051222271', 'CASSIE ALFITRI RAHLI CIBRO', 'JL. PERJUANGAN KOMP. PONDOK INDAH NO. 1A', '', '', 'P', 'HALIMAH', 'Rajuddin Cibro', '', '24', 'null', 'null'),
(527, '0073295168', 'Cathlin Syifa Arriella', 'Jl Sunggal No 109', '', '', 'P', 'Siti Sarah Nauli', 'Surya Darma', '', '17', 'null', 'null'),
(528, '0078925113', 'Chaca Adinda Putri', 'Tanjung Anom', '082364365217', '', 'P', 'Suharni', 'Andi Lopo', '', '17', 'null', 'null'),
(529, '0069846495', 'Charisa Putri Ramadhani', 'Jl. Setia Budi Gg Rukun', '', '', 'P', 'Sri Astuti', 'Rismawan', '', '21', 'null', 'null'),
(530, '0078671097', 'CHESARIA PERMATA DEWI', 'LINGK 01', '', '', 'P', 'RINI DEWI WULANDARI S.Pd.I', 'FAHMI AHYAR S.T', '', '19', 'null', 'null'),
(531, '0084084829', 'CHESYA AMANDA', 'GG. AMAL TJ ANOM', '', '', 'P', 'SUSANTI', 'SUHERI', '', '16', 'null', 'null'),
(532, '0066832598', 'CINDY KONSELLA BR SEMBIRING', 'TANJUNG ANOM', '', '', 'P', 'RUSMIATI BR SARAGIH', 'LASTA SEMBIRING', '', '19', 'null', 'null'),
(533, '0074163760', 'Dahlia Putri Manja', 'Dusun II - B Jln. Perjuangan Tanjung Selamat', '', '', 'P', 'Ngatisah', 'Khairul Anwar Hasibuan', '', '18', 'null', 'null'),
(534, '0078260904', 'Dandi Rukmana Hidayat', 'Jl. Prona ', '085207874411', '', 'L', 'Misriaty', 'B H M Amin, SP', '', '19', 'null', 'null'),
(535, '0053629914', 'Dandi Sasmitra', 'Jl. Mulia Sejati', '', '', 'L', 'Ponisri', 'Suparman', '', '17', 'null', 'null'),
(536, '0054296701', 'DANI ANANDA', 'JL. TANJUNG SELAMAT', '', '', 'L', 'SURIATI', 'MARYANTO', '', '16', 'null', 'null'),
(537, '0076192148', 'DEDE ALFIANSYAH', 'TANJUNG SELAMAT GG KELUARGA', '', '', 'L', 'SUPRIANI', 'OARDIANTO', '', '17', 'null', 'null'),
(538, '0048622374', 'Dede Wahyu Fahrezi', 'Jl. setia budi', '082366647425', '', 'L', 'Inu Swasti Sri', 'Syamsuddin', '', '27', 'null', 'null'),
(539, '0078631739', 'DENIS ARTHA FRIZZI', 'Jl. Kemuning Gg. Buntu', '', '', 'L', 'NURIDA WATININGSIH', 'MUKTAR RUDIN', '', '16', 'null', 'null'),
(540, '0041742785', 'DESY PRIANTI', 'JL. S. KARYA DUSUN VI', '', '', 'P', 'NETTY IRAWATI', 'Suprian', '', '26', 'null', 'null'),
(541, '0058472288', 'Dhanu Ilhamsyah Putra', 'JL.SETIA BUDI PS NO.3', '', '', 'L', 'Elly Surayati', 'Hendri', '', '24', 'null', 'null'),
(542, '0051401023', 'DIAH AYU KINANTI', 'JL. MULIO SEJATI', '', '', 'P', 'KATMI', 'Irwansyah', '', '24', 'null', 'null'),
(543, '0053899330', 'DIAN SYAH', 'JL TANJUNG ANOM DUSUN I GG. MELATI', '', '', 'L', 'PUTRI CENDIKYA', 'Apriandi', '', '24', 'null', 'null'),
(544, '0054163403', 'Dicky Alviansyah', 'Tanjung Anom', '081265532295', '', 'L', 'Winda Hariani', 'Solihin', '', '21', 'null', 'null'),
(545, '0067719185', 'DIMAS ADITYA', 'JL. PERUM PURI ANOM ASRI B 30', '', '', 'L', 'HAMIDAH', 'Imam Susilo Hanafi', '', '25', 'null', 'null'),
(546, '0071043101', 'DIMAS PRAMUDIA RAMADHAN', 'PURWOJOYO', '', '', 'L', 'RATMINAH', 'SUNAR', '', '16', 'null', 'null'),
(547, '0075510324', 'Dina Nova Lianti', 'SUKARAYA', '', '', 'P', 'SITI MAIDONA', 'AHMAD SUWANDI', '', '17', 'null', 'null'),
(548, '0052364661', 'DINA SAHPUTRI', 'JL. KUTALIMBARU PASAR 3', '', '', 'P', 'DESI PRIANTI', 'Suwanto', '', '25', 'null', 'null'),
(549, '0059893829', 'DINDA HANDARANI', 'JL. PLAMBOYAN RAYA GG. SETIA BUDI', '', '', 'P', 'SURIYANA', 'Heri Gunawan', '', '27', 'null', 'null'),
(550, '0052322099', 'DIO AFANTA', 'JL. TANJUNG SELAMAT', '', '', 'L', 'NURIYATI', 'KARDIYANTO', '', '21', 'null', 'null'),
(551, '0079082794', 'Dio Fandi Oksarivi', 'Tanjung Anom', '', '', 'L', 'Mei Neliyawati', 'Nanang Pujiono', '', '18', 'null', 'null'),
(552, '0052078695', 'Dio Kurniawan', 'Tuntungan', '', '', 'L', 'Sri Mawarni', 'Eka Prasetiawan', '', '21', 'null', 'null'),
(553, '0061619363', 'DWI BAYU ARDHANA', 'GTA', '', '', 'L', '-', 'RAHMADDANI', '', '20', 'null', 'null'),
(554, '0073011575', 'Dwi Damayanti', 'Gang Arjuna ', '', '', 'P', 'Yunika Halmis', 'Rahmat Muliono', '', '19', 'null', 'null'),
(555, '0068882081', 'Dwi Nafila Zachra', 'PANJI', '', '', 'P', 'Julhairiah', 'ANJAHAR B MANALU', '', '21', 'null', 'null'),
(556, '0071024604', 'DWI SAPUTRA', 'JL. PERJUANGAN PERUM GRIYA MUTIARA', '', '', 'L', 'VIVI SUHARTINI', 'WIWIT SUTIKNO', '', '18', 'null', 'null'),
(557, '0049925215', 'DWI YANI', 'TANJUNG ANOM GG. AMALIYAH', '', '', 'P', 'JUMIATI', 'Sukimin', '', '25', 'null', 'null'),
(558, '0077323192', 'Dwi Zahara Aulia', 'Jalan Kutalimbaru', '081370474094', '', 'P', 'Lilis Susanti', 'Yus Romi', '', '16', 'null', 'null'),
(559, '0072393396', 'DWIRAN ISMAR JUKI SURBAKTI', 'JL.PERJUANGAN', '', '', 'L', 'ISTIANI BR SEMBIRING', 'NASRAN SURBAKTI', '', '19', 'null', 'null'),
(560, '0077459458', 'DYIKA ARIANDA PUTRA', 'Jl.Perjuangan No.79', '', '', 'L', 'YULIANA PUTRI', 'Syahrial Putra', '', '19', 'null', 'null'),
(561, '0039383129', 'EFA KHAIRUNNISYAH', 'JL. TAMPOK', '', '', 'P', 'KARTIKA SARI', 'Agus Hidayat', '', '26', 'null', 'null'),
(562, '0036278262', 'Egi Dwi Rizky', 'Dusun I Tanjung Anom', '085261598922', '', 'P', 'Sri Rizky', 'Erwan', '', '21', 'null', 'null'),
(563, '0054700142', 'ERICK ADITIA', 'DUSUN VI DESA SEI GLUGUR', '', '', 'L', 'SUKINI', 'Tusin', '', '26', 'null', 'null'),
(564, '0062291543', 'Eva Triyani', 'Tanjung Anom', '', '', 'P', 'Sri Haryani', 'Sutrisman', '', '18', 'null', 'null'),
(565, '0061926803', 'Evita Maharani', 'Tanjung Anom', '082167959267', '', 'P', 'Ruli Oktavia br. Sitepu', 'Eman Sujito', '', '21', 'null', 'null'),
(566, '0053696196', 'Fachry Asyory S', 'Dusun II-A Gang Hidayah Tanjung Selamat', '', '', 'L', 'Dewi Masita', 'Hairul Fauzi', '', '20', 'null', 'null'),
(567, '0068373223', 'FACHRY ROZI SAGALA', 'JL. TANJUNG SELAMAT GG. TAUFIK', '', '', 'L', 'MURIANA BR POHAN', 'JAHIR SAGALA', '', '19', 'null', 'null'),
(568, '0071345936', 'FADZLY IDAFI DAULAY', 'Tanjung Selamat Gg. Pak Kawi', '082363015529', '', 'L', 'Imelda', 'Faisal', '', '18', 'null', 'null'),
(569, '0051287813', 'FAHMI TATA', 'DUSUN I-A GG. KELUARGA TG. SELAMAT', '', '', 'L', 'AGUSTINA', 'MULIANTO AL HADI', '', '19', 'null', 'null'),
(570, '0065098622', 'FAHRI ALDY', 'JL. STELLA RAYA NO 10', '081260099568', '', 'L', 'JURIAH', 'NURSYAMSU ALDY', '', '21', 'null', 'null'),
(571, '0062911886', 'Fajrul Hamdani', 'Taratak Tangah', '', '', 'L', 'Yarnita', 'Erman', '', '18', 'null', 'null'),
(572, '0059885346', 'FANDI MEININO', 'GG. MESJID NO. 23', '', '', 'L', 'SAPARIDAH', 'Rusmardi', '', '24', 'null', 'null'),
(573, '0067442915', 'Farida Nur', 'JL. Pendidikan Dusun III Tanjung Selamat', '', '', 'P', '-', 'Rajali', '', '21', 'null', 'null'),
(574, '0073711936', 'Farisa Nashan', 'Dusun I-A Gang. Mekar Tanjung Selamat', '', '', 'P', 'Farida Hanum', 'M Nasran', '', '17', 'null', 'null'),
(575, '0078568823', 'FARITSYAH MAULANA NASUTION', 'JL. PEMBANGUNAN JL IKAHI-I NO. 6', '', '', 'L', 'DARMAWATI RUSLI', 'ARMANSYAH NASUTION', '', '19', 'null', 'null'),
(576, '0067671824', 'FASHA RAMADHAN SANDY', 'JL. TANJUNG ANOM KOMP. PURI ANOM ASRI BLOK AA 19', '', '', 'L', 'AMY FADILLAH', 'ARISANDY MASRI', '', '20', 'null', 'null'),
(577, '0072114221', 'FATIMAH', 'Tanjung Anom', '', '', 'P', 'Novita Nur Indah Sari', '', '', '18', 'null', 'null'),
(578, '0055016252', 'FATIMATUZZAHRO', 'JL. PERJUANGAN', '', '', 'P', 'LINA', 'M. Zunaidi', '', '24', 'null', 'null'),
(579, '0059369966', 'Fatul Jannah', 'Dusun IV JL.Tampok Desa Tanjung Selamat', '', '', 'P', '-', 'Satria', '', '22', 'null', 'null'),
(580, '0079531197', 'FAUZAH MUTIARA RAZEUQI', 'Jl. Abadi', '', '', 'P', 'KHOLIFAH', 'Muhammad Faisal Reza', '', '19', 'null', 'null'),
(581, '0067359448', 'Fazar Fickri Hamdani', 'Jl. Tunas Mekar ', '08126384387', '', 'L', 'Herlina Elviyanti', 'Nuriadi', '', '23', 'null', 'null'),
(582, '0054045343', 'FEBRI AMMAR FAIZ', 'JL. PERJUANGAN GG. DAUN', '', '', 'L', 'SOPIAH', 'FERI IRAWAN', '', '25', 'null', 'null'),
(583, '0064939297', 'FEBRIYANTO', 'JL. TANJUNG ANOM', '', '', 'L', 'HARIYANI', 'ZAINAL ABIDIN', '', '21', 'null', 'null'),
(584, '0053847562', 'Ferdiyansah Putra Tampubolon', 'JL.Sejati Dusun IV Tuntungan', '', '', 'L', 'Fitri Agustina', 'Supianto Saputra Tampubolon', '', '21', 'null', 'null'),
(585, '0052991628', 'FERDY FRANSTAMA DHELIO', 'JL. PERJUANGAN GG. DAUN', '', '', 'L', 'SULASTRI', 'Oki', '', '26', 'null', 'null'),
(586, '0058687334', 'FITRI DUWI YANTI', 'JL. TANJUNG SELAMAT', '', '', 'P', 'HENI', 'BOIMAN', '', '21', 'null', 'null'),
(587, '0032487605', 'FREDI SUGANDA', 'JL. BESAR TANJUNG ANOM', '', '', 'L', 'RULI OKTAVIA SITEPU', 'Eman Sujito', '', '24', 'null', 'null'),
(588, '0064128491', 'Galih Dwi Andinata', 'Dusun II Sei Gelugur', '', '', 'L', 'Umi Hayati', 'Andi Setiawan', '', '21', 'null', 'null'),
(589, '0043222808', 'GILANG FAJAR KHADAFI', 'JL. PENDIDIKAN', '', '', 'L', 'SULASTRI', 'Hariadi Alfiansyah', '', '25', 'null', 'null'),
(590, '0052567748', 'Gusti Pramana Wijaya', 'Jl.Seto Lr.Sipirok', '', '', 'L', 'Ismawati Siagian', 'Satria Miki Wijaya', '', '23', 'null', 'null'),
(591, '0075575590', 'GUSTIAN FADLI', 'TANJUNG SELAMAT', '', '', 'L', 'SRI YANTI', 'RUDY HARMADY', '', '17', 'null', 'null'),
(592, '0065286680', 'HABIL AL WASY RAHMADAN', 'TANJUNG SELAMAT GG. HIDAYAH', '', '', 'L', 'UMI YUNITA', 'BUDI SURYA HALIM', '', '17', 'null', 'null'),
(593, '0054993270', 'HAIKAL ARIEF DAULAY', 'JL. PANCASILA DUSUN I', '', '', 'L', 'SULASTRI', 'Amaluddin Daulay', '', '27', 'null', 'null'),
(594, '0073048501', 'HANIYAH PANI AISYAH', 'TANJUNG SELAMAT', '', '', 'P', 'KESUMAWATI', 'IPAN IRAWANDI', '', '18', 'null', 'null'),
(595, '0068936935', 'Hanum Salsabila', 'Tuntungan', '087867640144', '', 'P', 'Sri Sanita', 'Purwo Wahono', '', '23', 'null', 'null'),
(596, '0071155519', 'HARDIANSYAH MANURUNG', 'Jl. Tanjung Anom', '081370342509', '', 'L', 'Ernawati', 'Irwansyah Manurung', '', '18', 'null', 'null'),
(597, '0059541452', 'Hariansyah', 'Jl. Mulia Sejati ', '081397231585', '', 'L', 'Siti Aisyah', 'Suhariono', '', '23', 'null', 'null'),
(598, '3038147865', 'Hasanudin Purba', 'JL. SEI GLUGUR RIMBUN', '', '', 'L', 'Elpiana Br Ginting', 'Moris Purba', '', '24', 'null', 'null'),
(599, '0068643402', 'HASBIANSYAH', 'JL. AMAL DUSUN III TANJUNG ANOM', '', '', 'L', 'SURIATIK', 'Edi Irawadi', '', '25', 'null', 'null'),
(600, '0063981401', 'Helmi Fithra Wijaya', 'Tuntungan', '', '', 'L', 'Lismawati', 'Herman', '', '23', 'null', 'null'),
(601, '0053130645', 'HUTRI AGUSTINA BR GINTING', 'JL. TANJUNG SELAMAT GG. KELUARGA NO. 21', '', '', 'P', 'NETTY BR SIPAYUNG', 'BUDIYANTO GINTING', '', '25', 'null', 'null'),
(602, '0073160338', 'IBNU ABAS', 'TANJUNG SELAMAT', '', '', 'L', 'MAWARNI', 'HAMBALI', '', '17', 'null', 'null'),
(603, '0051891051', 'IBNU AZRAH', 'JL PERUM GRIYA KENCANA NO 16 BLOK C', '', '', 'L', 'SURIANI', 'Sunardy', '', '26', 'null', 'null'),
(604, '0064605827', 'ICA ZASKIARANI', 'JALAN SEJATI NO. 21', '', '', 'P', 'PARNILAWATI', 'MULIONO', '', '17', 'null', 'null'),
(605, '0052374241', 'IKA LESTARI', 'JL. TANJUNG ANOM DUSUN III NO. 311', '', '', 'P', 'LISTIA WATI', 'Al Amin', '', '24', 'null', 'null'),
(606, '0072357510', 'Ilham Syah Putra', 'Jalan Lapangan Golf', '082362605519', '', 'L', 'Salamah', 'Ferry Sembiring', '', '19', 'null', 'null'),
(607, '0071803521', 'INDAH AFILIANI', 'JL.PERJUANGAN GG.DELIMA', '', '', 'P', 'SUWARNI', 'HERI SAHPUTRA', '', '19', 'null', 'null'),
(608, '0047760383', 'Indah Rahmi', 'Jl. Kapten M Jamil Lubis No. 103', '085270444431', '', 'P', 'Yusmarni', 'Hafni', '', '20', 'null', 'null'),
(609, '0065599952', 'INDRA SYAHRIAN', 'JL. PONDOK INDAH', '', '', 'L', 'SUPIANI', 'SUJONO', '', '21', 'null', 'null'),
(610, '0069724890', 'Intan Nuraini', 'Jl. Pendidikan Dsn I', '', '', 'P', 'Siti Anisa Fitri', 'Adek Joko Prayetno', '', '20', 'null', 'null'),
(611, '0049505830', 'INTAN NURYANI SUKAMTO', 'JL. SEI TUNTUNG NO 39 C', '', '', 'P', 'WENNY FITRIANI', 'Hady Suyanto', '', '26', 'null', 'null'),
(612, '0065125470', 'Iqbal Leo Pranata Harahap', 'Jl. Mulia Dsn IV', '', '', 'L', 'Wartini', 'M. Effendi Harahap', '', '20', 'null', 'null'),
(613, '0062445969', 'Ira Zaskia', 'Tanjung Anom', '', '', 'P', 'Annisa Manullang', 'Zahari', '', '20', 'null', 'null'),
(614, '0074166680', 'JIHAN FAUZIRIZQI S.', 'Komp. Grand Citra Asri Blok D No. 16', '085276182188', '', 'P', 'Dewi Megawati', 'Kamaluddin Sitorus', '', '16', 'null', 'null'),
(615, '0079020463', 'JOVICKA ARISANDY', 'JL. BESAR TANJUNG SELAMAT', '', '', 'P', 'ALM. RAMAYANI', 'BUDI HARDOYO', '', '18', 'null', 'null'),
(616, '0068806530', 'Junita Ika Wardani', 'Tuntungan', '', '', 'P', 'Suliyem', 'Zainal Abidin', '', '21', 'null', 'null'),
(617, '0069456909', 'JURIA KATA NUR SAIRAH', 'DUSUN III TANJUNG ANOM', '', '', 'P', 'PONISRI', 'GIRAN', '', '16', 'null', 'null'),
(618, '0075402826', 'KHAIDIR', 'TANJUNG SELAMAT', '', '', 'L', 'NURMAWATI', 'ZULPIKAR', '', '16', 'null', 'null'),
(619, '0052766551', 'KHAILA IZATI', 'JL. TAMPOK', '', '', 'P', 'KHAYRI INDANA', 'Bambang Suryadi', '', '24', 'null', 'null'),
(620, '0045761769', 'Khaila Putri', 'Dusun I Pekubuan', '082360842987', '', 'P', 'Yusriadek', 'Junaidi', '', '24', 'null', 'null'),
(621, '0078539471', 'Khairul Ihsan', 'Tanjung Selamat', '', '', 'L', 'Nila Sari', 'M Rivansyah', '', '17', 'null', 'null'),
(622, '0088613746', 'KHALILA AZ-ZAHRA', 'JL. TANJUNG SELAMAT DUSUN II A GG. MUSHOLA', '', '', 'P', 'RATNI', 'DEDI PRAWITO', '', '19', 'null', 'null'),
(623, '0064349984', 'KUMALASARI BIDARI BR SINULINGGA', 'SETIA BUDI', '', '', 'P', 'MARLIANA', 'TERIP SINULINGGA', '', '19', 'null', 'null'),
(624, '0059492344', 'LAVENIA', 'JL. PIMPINAN', '', '', 'P', 'NUR \'AINUN', 'Ponirun', '', '26', 'null', 'null'),
(625, '0046639449', 'LESTARI', 'JL. SEI GLUGUR DUSUN III', '', '', 'P', 'WAGINEM', 'Sucipto', '', '24', 'null', 'null'),
(626, '0043580310', 'LIA RAMADHITA', 'JL. PIMPINAN', '', '', 'P', 'RAISYAH', 'SUHERMAN', '', '25', 'null', 'null'),
(627, '3079736457', 'LIARA BY BETINA BR DEPARI', 'Sembahe Baru', '', '', 'P', 'Sryulina Br Tarigan', '', '', '18', 'null', 'null'),
(628, '0058333085', 'Lidya Fii Sabilillah', 'JL. SNAKMA BLOK B NO 16', '', '', 'P', 'Herlinda Lubis', 'Rahmat Hidayat', '', '26', 'null', 'null'),
(629, '0071759666', 'Lila Puspita', 'Dusun IV Tanjung Selamat', '', '', 'P', 'Astutik', 'Sutrisno', '', '17', 'null', 'null'),
(630, '0074940536', 'LUCKY HAMIDAH AN-NAJWA', 'SUKARAYA', '', '', 'P', 'SURYAWATI', 'MULYANTONO', '', '18', 'null', 'null'),
(631, '0052226121', 'Lukman Abdul Khaliq', 'Jl. Pendidikan Gg.Pelajar', '085372351094', '', 'L', 'Inda Wulandari', 'Widodo', '', '20', 'null', 'null'),
(632, '0065632541', 'Luna Pratiwi', 'Pancur Batu', '', '', 'P', 'Kartika Ningsih', 'Suyitno', '', '16', 'null', 'null'),
(633, '0052201344', 'Lupita Feby Angelika', 'Jl. Flamboyan Raya', '087700949439', '', 'P', 'Riyanti', 'Eko Susilo', '', '25', 'null', 'null'),
(634, '0055876871', 'M ALFAN RIZKY', 'JL. DANAMON DUSUN VI', '', '', 'L', 'NURHAYATI', 'Priadi', '', '25', 'null', 'null'),
(635, '0043553906', 'M. ADIDTYA', 'JL. FLAMBOYAN GG KEMUNING 2Y', '', '', 'L', 'DEWI WAHYUNI', 'Mhd Nasir', '', '24', 'null', 'null'),
(636, '0082197976', 'M. AFFIS AL AKHYAR', 'GG RIDHO', '', '', 'L', 'DEWI SURIANI', 'CHRISNA', '', '18', 'null', 'null'),
(637, '0073832929', 'M. FAJAR RAMADHAN', 'Jl. Besar Tanjung Selamat', '', '', 'L', 'Zanati Apriani', '', '', '18', 'null', 'null'),
(638, '0062084127', 'M. GHAZALI', 'JL. RAKYAT', '081376047548', '', 'L', 'YENI WIJAYA', 'CHAIRIL AKMAL', '', '21', 'null', 'null'),
(639, '0056142227', 'M. RAFFI IRSANDY', 'JL. TANJUNG SELAMAT GG. KELUARGA NO. 28', '', '', 'L', 'DARIYATI', 'HENGKI HARDEDEK', '', '26', 'null', 'null'),
(640, '0067701563', 'M. Rezky Yaditama', 'Dusun I-B Jl. Snakma III No. 2 ', '', '', 'L', 'Kariyani', '', '', '22', 'null', 'null'),
(641, '0059050917', 'M. SYAIFUL IRHAM', 'JL. S. KARYO', '', '', 'L', 'SARI SUGESTI', 'ABDUL ROHMAN', '', '23', 'null', 'null'),
(642, '0064931206', 'M.IMAM MAZID', 'JL.BUNGA SEDAP MALAM', '', '', 'L', 'WARIYEM', 'NGATIRAN RANTO', '', '23', 'null', 'null'),
(643, '0061280662', 'MAGHFIRA TRI ANISA', 'JL. TANJUNG SELAMAT', '82186120001', '', 'P', 'PUTRYANI LESTARI', 'OMA SOMANTRI', '', '22', 'null', 'null'),
(644, '0078696880', 'Maia Nastrovia E', 'Jalan Rangkayo Hitam', '', '', 'P', 'Sri Susanti', 'Syamsul Effendi', '', '17', 'null', 'null'),
(645, '0062017646', 'MALIK AL BUGHORY', 'Jl. Flamboyan Raya Komp. USU No. 10 Medan', '', '', 'L', 'Fenny Marlina', 'Gali Ibrahim', '', '17', 'null', 'null'),
(646, '3045449358', 'MELINDA', 'Dusun B', '', '', 'P', 'ERLINA', '', '', '20', 'null', 'null'),
(647, '0068890489', 'MHD Tengku Rafli Ridwansyah', 'Tanjung Selamat', '', '', 'L', 'Nila Wati', 'MHD Jhoni Ridwan', '', '23', 'null', 'null'),
(648, '0078567235', 'MHD ZAIRI ATTAMIMI', 'Jl. Aluminium No 20 B', '', '', 'L', 'Endang Sulastri', '', '', '18', 'null', 'null'),
(649, '0053355416', 'MHD. RAFLI', 'JL. JATI SEI MENCIRIM', '', '', 'L', 'SUKAESEH', 'Hanan', '', '25', 'null', 'null'),
(650, '0086008961', 'MHD.FADIL AZIZI', 'GG KELUARAGA', '', '', 'L', 'ERNI', 'SAFARUDIN', '', '16', 'null', 'null'),
(651, '0067752189', 'MIFTAH FARID', 'JL. PERUMAHAN PURI ANOM ASRI B30', '', '', 'L', 'HAMIDAH', 'IMAM SUSILO', '', '22', 'null', 'null'),
(652, '0073050686', 'MILANDI SYAHPUTRA', 'Dusun I ', '', '', 'L', 'Nurhayati', '', '', '18', 'null', 'null'),
(653, '0066770315', 'MUAMMAR', 'DUSUN III', '', '', 'L', 'PATIMA', 'MUSTAFA ISMAIL', '', '23', 'null', 'null'),
(654, '0053473596', 'MUHAMMAD ABID HASBILLAH AGIL', 'DUSUN VI PURWOJOYO', '', '', 'L', 'SUMARNI ASTUTI', 'SAMIADI', '', '26', 'null', 'null'),
(655, '0069365978', 'MUHAMMAD ADAM ROSYIID', 'JL. PENDIDIKAN TANJUNG SELAMAT', '', '', 'L', 'NURIANI', 'Sukarno', '', '24', 'null', 'null'),
(656, '3061941171', 'Muhammad Aidil Alinsky', 'Gg. Mawar', '', '', 'L', 'Fitriani', '', '', '20', 'null', 'null'),
(657, '0064872150', 'MUHAMMAD AKBAR AULIA', 'JL. TANJUNG SELAMAT', '', '', 'L', 'SUGIANI', 'SUPRIADI', '', '20', 'null', 'null'),
(658, '0043204378', 'MUHAMMAD ALFI Z BATUBARA', 'JL. PERCOBAAN', '', '', 'L', 'ARTINA BR SEMBIRING', 'ZULKARNAIN BATUBARA', '', '27', 'null', 'null'),
(659, '0079974892', 'MUHAMMAD ALWI RAMADHAN', 'DUSUN IV TANJUNG SELAMAT', '', '', 'L', 'JULIANAH BR LUBIS', 'MUCHLIS', '', '17', 'null', 'null'),
(660, '0057856715', 'MUHAMMAD ARIFIN SYAHPUTRAGA', 'Lizadri Putra No. 2', '', '', 'L', 'ERNAWATI BARUS', 'Sarifudin Ariga', '', '22', 'null', 'null'),
(661, '0057145736', 'MUHAMMAD AZHAR FAHRIKH', 'JL. TUNTUNGAN I GG. SENTOSA 3', '', '', 'L', 'DEWI AGUSTINA', 'Rahmansyah S Ginting', '', '26', 'null', 'null'),
(662, '0071483943', 'Muhammad Edi Suziyanto', 'Gg. Sosial', '', '', 'L', 'Sriani Rezeki', '', '', '20', 'null', 'null'),
(663, '0042432632', 'MUHAMMAD ERZA BUTAR-BUTAR', 'JL. TUNTUNGAN II', '', '', 'L', 'SUJIANI', 'Sukarno M Nur Butar Butar', '', '24', 'null', 'null'),
(664, '0056063233', 'MUHAMMAD FACHRIZA', 'TANJUNG ANOM GG SOSIAL', '', '', 'L', 'ERNA', 'Bariyatno', '', '24', 'null', 'null'),
(665, '0055603564', 'MUHAMMAD FAHRUL REZA', 'DUSUN II- B TANJUNG SELAMAT', '', '', 'L', 'SUNARIAH', 'ADI SUBARI', '', '25', 'null', 'null'),
(666, '0062044063', 'MUHAMMAD HAFIZ', 'TJ. ANOM GG. SOSIAL', '', '', 'L', 'MARDIANA', 'JULIANTO', '', '16', 'null', 'null'),
(667, '0052955849', 'MUHAMMAD JUANDI', 'SENDANG REJO', '', '', 'L', 'SITI FATIMAH', 'A. SAINEN', '', '22', 'null', 'null'),
(668, '0052078688', 'Muhammad Kurnia', 'Tuntungan', '', '', 'L', 'Sugiani', 'Kemino', '', '27', 'null', 'null'),
(669, '0043146107', 'MUHAMMAD NAUFAL FIRMANSYAH', 'JL. TAMPOK', '', '', 'L', 'FITRIANI', 'Usman Syahrial', '', '24', 'null', 'null'),
(670, '0055813796', 'MUHAMMAD RADITYA', 'JL. PERJUANGAN', '81397919025', '', 'L', 'TRI ULAN SARI', 'SUSIANTO', '', '20', 'null', 'null'),
(671, '0076277455', 'Muhammad Raihan Hasibuan', 'STM Gang Syukur No. 24', '', '', 'L', 'Ika Widyastuty', 'Muhammad Nizam Hasibuan', '', '19', 'null', 'null'),
(672, '0057205941', 'MUHAMMAD RAMADHAN', 'JL.PERJUANGAN', '', '', 'L', 'SULIYAH HANDAYANI', 'M.YUNUS S', '', '23', 'null', 'null'),
(673, '3054923990', 'MUHAMMAD REZA FEBRYANSYAH', 'Jalan Rakyat', '', '', 'L', 'Nurlela', '', '', '23', 'null', 'null'),
(674, '0079775665', 'MUHAMMAD SANDI PUTRA', 'Tanjung Selamat', '', '', 'L', 'Musiska', 'Edi Saputra', '', '19', 'null', 'null'),
(675, '0066300182', 'MUHAMMAD SYUHADA AR\'RAYYAN', 'JL. TANJUNG SELAMAT', '', '', 'L', 'ARYANI', 'RAHMAD HIDAYAT', '', '22', 'null', 'null'),
(676, '0059208279', 'Muhammad Taufiq', 'JL. PERCOBAAN UJUNG', '', '', 'L', 'Umi Kalsum Batu Bara', 'Insan Syahputra', '', '26', 'null', 'null'),
(677, '0045580552', 'MUHAMMAD YUSUP', 'JL. PANCASILA NO. 99', '', '', 'L', 'SEMI', 'Herliadi', '', '24', 'null', 'null'),
(678, '0061095531', 'MUHAMMAD ZAKI ABDILLAH', 'JL. DUSUN III', '', '', 'L', 'ZAHRINA', 'JULHARIANTO', '', '25', 'null', 'null'),
(679, '0054941472', 'MUSYAFIQA FAUZHIRA', 'JL. TANJUNG SELAMAT', '', '', 'P', 'ERNILA TANJUNG', 'KHAIRUL ANWAR', '', '25', 'null', 'null'),
(680, '0079200298', 'MUTIA AZAHRA', 'Dusun Pembangunan Sukaraya', '', '', 'P', 'Ratna Wati', '', '', '16', 'null', 'null'),
(681, '0079209312', 'Mutia Ulfa', 'Jalan Karang Taruna', '', '', 'P', 'Farida Hanum', 'Mujio Basuki', '', '17', 'null', 'null'),
(682, '0066779877', 'Mylkhaimah', 'Tanjung Selamat', '', '', 'P', 'Reni Sundari', 'Endra Perwadi', '', '22', 'null', 'null'),
(683, '0068971480', 'Nabila Ashari', 'JL Bunga Raya LK VI Medan', '', '', 'P', 'Nurhayani', 'Heru Sutopo', '', '22', 'null', 'null'),
(684, '0059337414', 'NABILA DIVA ANANDA SISWANDI', 'JL. PERCOBAAN GG. BERKAH NO. 01', '', '', 'P', 'LAILA SYAHFITRI', 'Siswandi', '', '26', 'null', 'null'),
(685, '0076006891', 'Nabila Khairunisah Harahap', 'Sekata No. 21', '', '', 'P', 'Wilda Khairani', 'Akhmad Syarif Harahap', '', '18', 'null', 'null'),
(686, '0071208737', 'NABILAH KHALIFI', 'Baru Pertambangan psr II', '', '', 'P', 'RIKA IRIANI', 'YOKI PURNOMO', '', '17', 'null', 'null'),
(687, '0046977348', 'NADIA RAHMADANI', 'JL. PERJUANGAN', '', '', 'P', 'SITI NAPSIAH', 'SUSIADI', '', '25', 'null', 'null'),
(688, '0074675687', 'Nadin Sartika', 'Jl. Percobaan Gang Pinang Baris Dusun I-A', '', '', 'P', 'Iriyani', 'Suryadi', '', '18', 'null', 'null'),
(689, '0064082318', 'Naila Hendiana', 'Jl. Rakyat', '', '', 'L', 'Nurhasanah', '', '', '20', 'null', 'null'),
(690, '0054407200', 'NAYLA SANDRA', 'GG. SOSIAL DUSUN III', '', '', 'P', 'ZAKIA', 'Gunawan', '', '26', 'null', 'null'),
(691, '0069588076', 'NAZWA ADELIA', 'JL. TANJUNG SELAMAT', '', '', 'P', 'LIANI', 'ISMAIL', '', '22', 'null', 'null'),
(692, '0063522713', 'Nazwa Hawlika', 'Komplek Graha Tanjung Anom', '085361717887', '', 'P', 'Rahmawati', 'Edi Yusuf', '', '20', 'null', 'null'),
(693, '0076682746', 'NAZWA KESZIA RAMADHAN', 'Tanjung Selamat Gang Habib', '', '', 'P', 'Yunita Sari Lubis', 'Samudrianto', '', '19', 'null', 'null'),
(694, '0061894806', 'NAZWA SALSABILA', 'MUARA DILAM', '', '', 'P', 'DARNI', '', '', '22', 'null', 'null'),
(695, '0144598636', 'Nisrina Rizki Adzani', 'PT EXA', '', '', 'P', 'Emita', 'IRFAN YUNEIDI', '', '17', 'null', 'null'),
(696, '0065893769', 'NONA BABY CANTHIKA RAMADHANI', 'JL. LAP. GOLF BLOK MATAHARI K.65', '', '', 'P', 'ASWANA', 'Nazaruddin', '', '24', 'null', 'null'),
(697, '0059671606', 'NOVA ARINI DIANDRA', 'Jl. Pimpinan Tanjung Anom', '', '', 'P', 'Suratmi', 'Amsah', '', '20', 'null', 'null'),
(698, '0077339872', 'NOVA HARDIYANTI', 'Jl. HM Puna Sembiring Dusun II', '', '', 'P', 'Dahyatinoni', '', '', '19', 'null', 'null'),
(699, '0059771316', 'NOVAL HERI PRATAMA', 'JLN. FLAMBOYAN RAYA NO. 4 LINGK. III', '', '', 'L', 'ERMAYANI', 'BUDI ARIADI', '', '20', 'null', 'null'),
(700, '0066140396', 'Novita Sari', 'Tanjung Anom', '', '', 'P', 'Suryani', 'Suratman', '', '17', 'null', 'null'),
(701, '0053259677', 'NUR AURA ANANTA', 'DUSUN III TANJUNG ANOM', '', '', 'P', 'JULIANA', 'SURYANTO', '', '27', 'null', 'null'),
(702, '0053256974', 'NUR INTAN', 'JL. REHULINA', '', '', 'P', 'JULIANA NASUTION', 'Aris Hariawan', '', '26', 'null', 'null'),
(703, '0061556726', 'Nurul Dwi Cahyani', 'Dusun III Tanjung Anom', '082368235578', '', 'P', 'Sofiah', 'Surya Irawan', '', '20', 'null', 'null'),
(704, '0068699985', 'Nurul Faidah', 'Graha Tanjung Anom B 10', '', '', 'P', 'Susanti', 'Supar', '', '16', 'null', 'null'),
(705, '0052739296', 'NURUL HUSNAH', 'JL. TAMPOK', '', '', 'P', 'HALIMAH', 'Bambang Supriono', '', '24', 'null', 'null'),
(706, '0073936487', 'Nushraj Fateh Ali', 'Jl Sembahe Baru', '', '', 'L', 'Eva Yanti', 'Zulfikar Ali', '', '16', 'null', 'null'),
(707, '0073061674', 'OZY DAMAR SAPUTRO', 'SEI GLUGUR', '', '', 'L', 'miranda', 'SUJARNO KTUT SANTOSO', '', '17', 'null', 'null'),
(708, '0042262911', 'PAJAR AKHIR VIGO', 'JL. RAKYAT', '', '', 'L', 'DELIRAWATI', 'Andi Pranata', '', '24', 'null', 'null'),
(709, '0083103639', 'paramitha az-zahra putri', 'Jl. Stella Tengah No. 18', '081262009359', '', 'P', 'susilawati', 'Joni Syafri', '', '17', 'null', 'null'),
(710, '0057406150', 'PASYA AZHARI', 'JL. PERJUANGAN', '', '', 'P', 'FITRI ANI', 'Ijon', '', '25', 'null', 'null'),
(711, '0067915261', 'PATEN AMIRA SIAGIAN', 'Tanjung Selamat', '', '', 'P', 'SITI AMINAH', 'Zainal Arifin Siagian', '', '24', 'null', 'null'),
(712, '0057083564', 'Pitri Patmala', 'Jl. Mulia Sejati ', '08216472757', '', 'P', 'Eka Prastiyawati', 'Budi Yanto', '', '19', 'null', 'null'),
(713, '0072616456', 'PRACI CHAULA', 'JL. PERCOBAAN TANJUNG SELAMAT', '', '', 'P', 'IMELDA BR SEMBIRING', 'MUHAMMAD IBRAHIM', '', '18', 'null', 'null'),
(714, '0058595179', 'PREDI ANDRIYAN SYAHPUTRA NST', 'JL. PERTANEN', '', '', 'L', 'SISKA ANDRIYANI', 'Dedi Syahputra Nasution', '', '26', 'null', 'null'),
(715, '0066472309', 'PUAN NABILA HAMZAH', 'TANJUNG SELAMAT', '', '', 'P', 'LINDA WATI', 'SAMSUL HAMZAH', '', '22', 'null', 'null'),
(716, '0073495888', 'PUTRI FATRISIA BALQIS', 'Jl. Bunga Kardiol No. 53 A', '', '', 'P', 'Yuli Antasari', '', '', '17', 'null', 'null'),
(717, '0062331844', 'Putri Sakila Rahman Br Sembiring', 'Dusun IV Tanjung Selamat', '', '', 'P', 'Suriani Br Selian', 'Abdul Rahman Sembiring', '', '23', 'null', 'null'),
(718, '0073344826', 'Qoidah Sintiya Sari', 'pancur batu', '', '', 'P', 'Jupriana', 'M Darwin', '', '16', 'null', 'null'),
(719, '0061799005', 'QORY ANGGUN FAHREZY SIAHAAN', 'JL. PERCOBAAN', '81396317327', '', 'P', 'YUNI ADHADIATY', 'NURSANI SIAHAAN,SE (ALM)', '', '22', 'null', 'null'),
(720, '0075508881', 'RADHIT AKMAL DAULAY', 'TANJUNG SELAMAT', '', '', 'L', 'SULASTRI', 'AMALUDDIN DAULAY', '', '19', 'null', 'null'),
(721, '0075602516', 'Raditia Wisnu Dinata', 'Jalan Kutalimbaru', '', '', 'L', 'Tini Handayani', 'Suhariono', '', '18', 'null', 'null'),
(722, '0066710209', 'RAFAIL ALWI YORMAN', 'JL. PERJUANGAN', '', '', 'L', 'ROHMANIAH', 'HANDI YORMAN', '', '20', 'null', 'null'),
(723, '0076134422', 'RAFFI RAMANSYA', 'TANJUNG SELAMAT', '', '', 'L', 'TRI NINGSIH', 'SUHARNO', '', '18', 'null', 'null'),
(724, '0060192238', 'RAHMA PRATIWI SUCI', 'JL. PERJUANGAN GG. DAUN', '', '', 'P', 'NURLELA GURUSINGA', 'P. Yuswardi', '', '25', 'null', 'null'),
(725, '0062174396', 'RAHMADINA PUTRI', 'SUKARAYA', '', '', 'P', 'NURIATI', 'PAIDI SP', '', '16', 'null', 'null'),
(726, '0075323057', 'RAHMAT SYAH', 'PURWOJOYO', '', '', 'L', 'LEGIANI', 'AMAS', '', '19', 'null', 'null'),
(727, '0061689260', 'Rahmat Syahputra', 'Tanjung Anom', '', '', 'L', 'Mahmudah', 'Juliardi', '', '23', 'null', 'null'),
(728, '0065165345', 'Raihan Nura Rifin', 'Tanjung Anom', '', '', 'L', 'Marlina Siregar', 'Bahtiar', '', '18', 'null', 'null'),
(729, '0053256977', 'Rangga S. Prayoga', 'DUSUN II-B JL PERJUANGAN', '', '', 'L', 'Supriani', 'Pardianto', '', '24', 'null', 'null');
INSERT INTO `ts_siswa` (`idSiswa`, `nis`, `nama`, `alamat`, `noHP`, `email`, `jenisKelamin`, `namaIbuKandung`, `namaAyahKandung`, `noHPOrangTua`, `kelas`, `tahunAjaran`, `status`) VALUES
(730, '0071369659', 'RASYA TIRA SUBALI', 'Tanjung Selamat', '085262394732', '', 'P', 'Rini Afiatni', 'Endang Subali', '', '16', 'null', 'null'),
(731, '0063288188', 'Rayya Azzahra Ramadhani', 'Pancur Batu', '', '', 'P', 'Yuniarti', 'Hendro Gangga Sumitro', '', '18', 'null', 'null'),
(732, '0074608567', 'Rehan Ardiansyah', 'Jl. Percobaan Gg. Daun', '', '', 'L', 'Norita', 'Suriadi', '', '19', 'null', 'null'),
(733, '0073901020', 'REIZA FEBRY ANDIKA', 'TJ. ANOM', '', '', 'L', '-', 'Anton S. Riyadi', '', '20', 'null', 'null'),
(734, '0047698130', 'RENDI HERMAWAN', 'JL. PERCOBAAN', '', '', 'L', 'INDAH SUSANA SITEPU', 'Herianto', '', '25', 'null', 'null'),
(735, '0046996250', 'Rendi Syahputra', 'DUSUN IV TANJUNG ANOM', '', '', 'L', 'Gustiani Br Sinulingga', 'Ponimin', '', '24', 'null', 'null'),
(736, '0063343140', 'Rendi Tian Pratama', 'Dusun I-A Tanjung Selamat', '', '', 'L', 'Nur Aminah', 'Agus Suherman', '', '23', 'null', 'null'),
(737, '0052681104', 'RENDY ADE ICAH DOLOK SARIBU', 'JL. SEI MUSI NO 69', '', '', 'P', 'YULI MIATI', 'Mulia Dolok Saribu', '', '24', 'null', 'null'),
(738, '0066596087', 'Rendy Kurniawan', 'Tanjung Anom', '', '', 'L', 'Yusriani', 'Maruf Herianto', '', '17', 'null', 'null'),
(739, '0062686420', 'RESTU AGUNG SEMBIRING', 'MESJID', '', '', 'L', 'SURIANI', 'RUDI SEMBIRING', '', '22', 'null', 'null'),
(740, '0061335420', 'Restu Febrian', 'Gg S.Karyo Tanjung Anom', '081378379516', '', 'L', 'Rismalia', 'Rianto', '', '23', 'null', 'null'),
(741, '0066250076', 'Restu Nur Hidayat', 'Jl. Persatuan', '', '', 'L', 'Napsiani', 'Muhayat', '', '18', 'null', 'null'),
(742, '0077277866', 'Reva Golfina', 'Jalan Persatuan', '', '', 'P', 'Jumiyem', 'Ariadi', '', '18', 'null', 'null'),
(743, '0072634060', 'REVA NUR APRILIANI', 'JL KLAMBIR LIMA', '', '', 'P', 'PUJI ASTUTI', 'DONNI SYAHPUTRA', '', '19', 'null', 'null'),
(744, '0054695653', 'REVI PRANDANA', 'DUSUN I PONDOK BATU', '', '', 'L', 'MISWANTI', 'Ramlan', '', '25', 'null', 'null'),
(745, '0045728470', 'REZA DANUWINDRA', 'JL. PERJUANGAN SUKA RAYA GG. RUKUN 22', '', '', 'L', 'DARIYANI', 'Samino', '', '26', 'null', 'null'),
(746, '0076392333', 'Rian Arifal', 'Tuntungan', '', '', 'L', 'Agustiani', 'Ferizal', '', '16', 'null', 'null'),
(747, '0056976265', 'RIESANDHI RUSIEDRA LUBIS', 'JL. PERCOBAAN', '', '', 'L', 'RUBIANA', 'Andhi Yubastian Lubis', '', '24', 'null', 'null'),
(748, '0077870416', 'Rifana Ramadhani', 'Tanjung Selamat JL.Tampok Gang Anyar', '', '', 'P', '-', 'Satria', '', '19', 'null', 'null'),
(749, '0046722933', 'Rifatzry Imtiasya\'in Hutagalung', 'JL. DR SOFIAN NO. 01 USU', '', '', 'L', 'Helmina Meilynda Harahap', 'Safi\'in Hutagalung', '', '26', 'null', 'null'),
(750, '0069191639', 'Rifki Azis', 'Jl. Flamboyan VII', '', '', 'L', 'Santi Asriani', 'Hendra Gunawan', '', '18', 'null', 'null'),
(751, '0057772516', 'RIFKY AKMAL', 'GG.KELUARGA', '', '', 'L', 'ELIANI', 'MUHAMMAD', '', '22', 'null', 'null'),
(752, '0057800036', 'RIKA AMELIA', 'JL. SEJATI', '', '', 'P', 'HERA FITRIANI', 'Syahril', '', '26', 'null', 'null'),
(753, '0072326340', 'RIKHA DESWITA', 'JL. FLAMBOYAN BARU LK II', '', '', 'P', 'EKA YANTI', 'KASIANTO', '', '19', 'null', 'null'),
(754, '0052484528', 'RIKI ABBROOR', 'JL. PIMPINAN', '', '', 'L', 'SOLAT REZEKI BE MANIK', 'RIWAYAT PUTRA', '', '25', 'null', 'null'),
(755, '0066278013', 'Rina Damayanti', 'Dusun IV Desa Tanjung Anom', '', '', 'P', '-', 'Rajiman', '', '22', 'null', 'null'),
(756, '0063446724', 'RINI KARTIKA', 'DUSUN VI PURWOJOYO', '081361256557', '', 'P', 'SUMARNI', 'SUMITRO', '', '23', 'null', 'null'),
(757, '0062480336', 'Risky Pramanda', 'Dusun VI Tanjung Anom', '085277896379', '', 'L', 'Irma', 'Indra Wijaya Kusuma', '', '23', 'null', 'null'),
(758, '0072942337', 'RISKY SANNI', 'TANJUNG SELAMAT DUSUN IV TAMPOK', '', '', 'L', 'NUR SAHARA', 'MARZUKI SEMBIRING', '', '19', 'null', 'null'),
(759, '0043481962', 'RIYAN ARDIYANSAH', 'JL. SEJATI DUSUN IV', '', '', 'L', 'PEBRU RIAWATI', 'Eko Nardi', '', '26', 'null', 'null'),
(760, '0076609030', 'RIYAN PRATAMA SOLIN', 'TANJUNG ANOM', '', '', 'L', 'Masni Br Manalu', 'RAHMAN SOLIN', '', '16', 'null', 'null'),
(761, '0053673738', 'RIZKI ANANDA', 'JL. TANJUNG ANOM GANG ABADI', '', '', 'L', 'NURAINI', 'Suyanto', '', '27', 'null', 'null'),
(762, '0075502167', 'RIZKI RAMADANI', 'JL STB PSR V GG. MELATI', '', '', 'L', 'SUMIATI', 'TUMIADI', '', '16', 'null', 'null'),
(763, '0064249606', 'Robby Wardana', 'Jl. Flamboyan Gg. Manggis', '081376037491', '', 'L', 'Agus Maini Lubis', 'Andra Juniaris', '', '20', 'null', 'null'),
(764, '0075315667', 'Rozan Fatin Alinsky', 'Jl.Kutalimbaru', '', '', 'L', 'Ika Sari Wahyu Nita', 'Sumantri', '', '18', 'null', 'null'),
(765, '0058004866', 'RYAN IRFANDI', 'JL. GLUGUR RIMBUN', '', '', 'L', 'SUYANTI', 'Andi Sanjaya', '', '27', 'null', 'null'),
(766, '0063307334', 'SABDU SULTAN ANGGARA', 'JL. BESAR TANJUNG SELAMAT', '', '', 'L', 'RUMSIATI', 'WAHYUDI', '', '23', 'null', 'null'),
(767, '0068298672', 'SABILAH HASANAH', 'DUSUN VI PURWOJOYO', '', '', 'P', 'SUPARTIK', 'YAN ARIANDI', '', '21', 'null', 'null'),
(768, '0041066845', 'SAFITRI SRI NINTA BR GINTING', 'JL. BLOK A PARIAMA-1', '', '', 'P', 'SUSANTI', 'M Yusuf Ginting', '', '27', 'null', 'null'),
(769, '0068306869', 'SAHRUL RAMADHAN', 'Dusun VI Desa Tanjung Anom', '0831 97609329', '', 'L', 'Sumarni', 'Sugianto', '', '22', 'null', 'null'),
(770, '0071166177', 'Samy Hadi Prayoga', 'Dusun I-A Gang. Mekar Ujung', '', '', 'L', 'Leny Nasution', 'Faisal Hidayat', '', '17', 'null', 'null'),
(771, '0053518238', 'SAPITRI', 'DUSUN IV TANJUNG ANOM', '', '', 'P', 'JURIAH', 'Permono', '', '26', 'null', 'null'),
(772, '0065235784', 'Sarah Aprilia', 'Dusun 1-A Gang Mesjid', '', '', 'P', 'Sriana', 'Muhamaad Nuh', '', '21', 'null', 'null'),
(773, '0042748419', 'SARI MUTIARA', 'TANJUNG ANOM', '', '', 'P', 'RAMINAH', 'Suyatman', '', '27', 'null', 'null'),
(774, '0067865335', 'SASKIA PUTRI', 'JL. BESAR TANJUNG SELAMAT', '', '', 'P', 'SRI RAHAYU', 'HARIS SUPRAPTO', '', '23', 'null', 'null'),
(775, '0052116841', 'Saskia Ramadhani', 'Jl. Flamboyan Raya No.3', '', '', 'P', '-', 'Muhammad Kamil', '', '23', 'null', 'null'),
(776, '0071132794', 'SATRIA WARDHANA', 'JL. PERCOBAAN TANJUNG SELAMAT', '', '', 'L', 'SITI MURIAWATI', 'MUHAMMAD YUSUF', '', '18', 'null', 'null'),
(777, '0076544234', 'Satrio Nandito', 'Tuntungan', '', '', 'L', 'Farina', 'Wisnarto', '', '16', 'null', 'null'),
(778, '0064327208', 'Selly Apriani', 'Tanjung Anom Gang S.Karya', '085359481173', '', 'P', 'Nininng Suriani', 'Herdianto', '', '23', 'null', 'null'),
(779, '0075944376', 'SELPA REDINA', 'TANJUNG ANOM, PERUM PURI ANOM ASRI', '', '', 'P', 'DELINA YUSTINA', 'MASRIADI', '', '18', 'null', 'null'),
(780, '0065571675', 'SENO WIRO HERLAMBANG', 'JL. SETIA BUDI PSR V', '', '', 'L', 'SUMARTINI', 'SURIONO', '', '17', 'null', 'null'),
(781, '0062853968', 'Septania Ramadhani Ginting', 'JL.Cengkeh 0 No. 52 P.Simalingkar', '081361122526', 'sdnegeri068005@yahoo.com', 'P', 'Yuli Chairani', 'Mhd. Roni Ginting', '', '21', 'null', 'null'),
(782, '0069469008', 'Silvia', 'Tanjung Anom', '', '', 'P', 'Tri Hartati', 'Adi Suprianto', '', '16', 'null', 'null'),
(783, '0052685773', 'SILVIKA ZACHRY BR SAGALA', 'JL. MEKAR UJUNG', '', '', 'P', 'MURIANA BR POHAN', 'JAHIR SAGALA', '', '25', 'null', 'null'),
(784, '0042432639', 'SITI FATIMAH', 'DUSUN I-A GG. FAMILI', '', '', 'P', 'RETNO SEPTIANI', 'Abdul Haris', '', '27', 'null', 'null'),
(785, '0071593009', 'Siti Hajijah', 'Pancur Batu', '', '', 'P', 'Hermi', 'Junaidi', '', '19', 'null', 'null'),
(786, '0053493315', 'SITI NUR HALIJAH BR SEMBIRING', 'JL. PERCOBAAN', '', '', 'P', 'MARIATI', 'Agus Salim Sembiring', '', '26', 'null', 'null'),
(787, '0074201620', 'SITI ZAHARA AULIYA', 'SUKARAYA', '', '', 'P', 'SUTINAH', 'SURIYONO', '', '19', 'null', 'null'),
(788, '0059517519', 'SOFI NOVITA', 'P. DANAMON', '', '', 'P', 'RAHMADANI', 'Dedi Nofianto', '', '27', 'null', 'null'),
(789, '0065174768', 'SRI SUCI BALQIS', 'JL.BUNGA WIJAYA KESUMAGA ', '', '', 'P', 'SRI HANI', 'WASULAIMAN', '', '23', 'null', 'null'),
(790, '0031489143', 'SRI WAHYUNI', 'DUSUN I TANJUNG SELAMAT', '', '', 'P', 'SULASTRI', 'PAIMUN', '', '21', 'null', 'null'),
(791, '0047724688', 'SRYRANI', 'JL. PENDIDIKAN', '', '', 'P', 'HAMSIA', 'Rahman', '', '25', 'null', 'null'),
(792, '0061250734', 'SUBUR', 'JALAN MULIA SEJATI', '', '', 'L', 'MULIANI', 'SUGENG', '', '16', 'null', 'null'),
(793, '0049844403', 'SUCI CHAIRANI', 'JL. AMPERA II G. SEDAR NO 14B', '', '', 'P', 'NURAINI', 'Chairuddin', '', '26', 'null', 'null'),
(794, '0077505428', 'Suci Istianty', 'Sukaraya', '', '', 'P', 'Nurima', 'Suherman', '', '19', 'null', 'null'),
(795, '0066166705', 'Sukani Satrio', 'Tuntungan', '', '', 'L', 'Suriatik', 'Suharianto', '', '16', 'null', 'null'),
(796, '0062868202', 'Sultan Fathir Azmi Siregar', 'Jl. Duren Komp. Griya Mutiara 3', '', '', 'L', 'Aisyah Hasmi', '', '', '20', 'null', 'null'),
(797, '0048828558', 'SUPRIYA YUDISTIRA', 'JL. AMAL DUSUN III', '', '', 'L', 'SOFIAH', 'Surya Irawan', '', '27', 'null', 'null'),
(798, '0045763928', 'SURYA RAMADHAN', 'PURI TANJUNG ANOM BLOK BB 03', '', '', 'L', 'SRI LAWATI', 'Ismail Syah', '', '25', 'null', 'null'),
(799, '0074065798', 'SYAHFIRA SALSA ANDIRA', 'JL TANJUNG SELAMAT NO 161', '', '', 'P', 'RAHMADANI', 'NURDI', '', '18', 'null', 'null'),
(800, '0064140578', 'SYAIFUL RADHIT ANGGRIAWAN', 'TJ.SELAMAT NO161', '', '', 'L', 'RAHMADANI', 'NURDI', '', '22', 'null', 'null'),
(801, '0066593479', 'SYARAN GUNAWAN', 'TANJUNG SELAMAT GG. DELIMA', '', '', 'L', 'SITI HALIMAH', 'MUHAMMAD ISKANDAR', '', '17', 'null', 'null'),
(802, '0063547131', 'Syarifah Aisyah Alwiyah', 'Tanjung Anom', '', '', 'P', 'Habibah', 'Said Alwi', '', '22', 'null', 'null'),
(803, '0048061644', 'TAMAM IMTIYAZ PAHLEVY SIAHAAN', 'JL. PERCOBAAN GG. REZEKI NO 3', '', '', 'L', 'YUNI ADHADIATY NINGSIH', 'Nursani', '', '26', 'null', 'null'),
(804, '0048268262', 'Tarmidzi Selian', 'Jln.Flamboyan Sunggal', '', '', 'L', 'Somi', 'Salamuddin', '', '19', 'null', 'null'),
(805, '0072975722', 'Tasya Aulia', 'Jl. Pancasila', '', '', 'P', 'Farida', 'Muliyadi', '', '19', 'null', 'null'),
(806, '0068031847', 'Tasya Salwa Irawan', 'Tanjung Selamat', '', '', 'P', 'Endang Sarubiani', 'Edi Irawan', '', '21', 'null', 'null'),
(807, '0052424881', 'TAUFIK HIDAYAH', 'JL. TAMPOK', '', '', 'L', 'RATNA DEWI', 'Amri', '', '27', 'null', 'null'),
(808, '0055106661', 'TEGUH PRATAMA', 'Tuntungan', '', '', 'L', 'SULASTRI', 'Wawan Rahargo', '', '23', 'null', 'null'),
(809, '0036489083', 'TEGUH PRAYOGA', 'JL. TUNTUNGAN PONDOK BATU', '', '', 'L', 'RUSMALIA', 'Bambang Suhartono', '', '27', 'null', 'null'),
(810, '0078048538', 'TRINANDA SOCE SIANIPAR', 'JL DR T MANSYUR GG SEHAT UJUNG ', '085262081861', '', 'L', 'JUNITA BR SITEPU', 'ANDI SOCE SIANIPAR', '', '17', 'null', 'null'),
(811, '0056411540', 'TRISANDI KURNIAWAN', 'JL. PERJUANGAN GG. FAMILI', '', '', 'L', 'RIKHLAS', 'Inwantri', '', '26', 'null', 'null'),
(812, '0073245178', 'VINA ARYANI PUTRI', 'JL. SUNGGAL', '085362614415', '', 'P', 'DEWI SUSANTI', 'INDRA SYAHPUTRA', '', '21', 'null', 'null'),
(813, '0058439644', 'WAHYU AFRIANSYAH', 'JL. LAP. GOLF NO. 167 DSN II', '', '', 'L', 'AGUSTIANI', 'ZULKARNAIN', '', '25', 'null', 'null'),
(814, '0033634477', 'WAHYU SYAHPUTRA', 'JL. TUNAS MEKAR GG. PERJUANGAN', '', '', 'L', 'ISYANI', 'EFENDY', '', '25', 'null', 'null'),
(815, '0055819798', 'WAHYUNI HAFIZAH', 'TANJUNG SELAMAT GG. PERCOBAAN', '', '', 'P', 'NURASIAH', 'M. Sidik', '', '26', 'null', 'null'),
(816, '0065201121', 'Wibowo Pratama', 'Tanjung Anom', '', '', 'L', 'Saminah', 'Sujatmiko', '', '22', 'null', 'null'),
(817, '0059948203', 'WIDYA WULANDARI', 'setia budi', '', '', 'P', '(tidak diisi)', 'HASAN BASRI', '', '23', 'null', 'null'),
(818, '0042412591', 'WINDY PUTRI UTAMI', 'JL. KUTALIMBARU DUSUN II-A', '', '', 'P', 'WIDI ASTUTI', 'Dedi Warsito', '', '25', 'null', 'null'),
(819, '0066277039', 'Yega Afransyah', 'Tuntungan', '', '', 'L', 'Susilawati', 'Edi Pramono', '', '18', 'null', 'null'),
(820, '0059523129', 'Yoga Saputra', 'Jl. Mulia Sejati ', '085262639365', '', 'L', 'Sumartik', 'Dedy Pebrianto', '', '21', 'null', 'null'),
(821, '0069780098', 'Yogi Irwansah', 'Jalan Mulia Sejati', '', '', 'L', 'Sumartik', 'Dedi Pebrianto', '', '17', 'null', 'null'),
(822, '0072042360', 'YOGIA HAFIZ', 'TANJUNG SELAMAT', '', '', 'L', 'SARI', 'WAGEANTO', '', '18', 'null', 'null'),
(823, '0077543173', 'Zakhqris Trisna Hadi', 'Jalan Persatuan', '', '', 'L', 'Elfira Prawita Sari', 'Soemarwan Hadi', '', '17', 'null', 'null'),
(824, '0058023866', 'ZAKI AZ ZHUHAIR', 'JL. TUNTUNGAN II NO. 80', '', '', 'L', 'NILA ERWATI', 'Edi Prayitno', '', '25', 'null', 'null'),
(825, '0079500676', 'Zicko Winanda', 'Tanjung Anom', '', '', 'L', 'Sri Handayani', 'Indra Kusuma', '', '21', 'null', 'null'),
(826, '0059425529', 'Zidan Kurniawan', 'Dusun II-A Jl Percobaan GG Memeng', '', '', 'L', 'Sumiati', 'Muliadi', '', '22', 'null', 'null'),
(827, '0069126836', 'Zulham Affandi', 'Jalan Pendidikan Tanjung Anom', '', '', 'L', 'Suryani', 'Hermanto', '', '23', 'null', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `ts_tabungan`
--

CREATE TABLE `ts_tabungan` (
  `idTabungan` int(11) NOT NULL,
  `nomorTabungan` char(150) NOT NULL,
  `namaTabungan` char(100) NOT NULL,
  `idSiswa` int(10) NOT NULL COMMENT 'siswa pemilik tabungan',
  `status` char(10) NOT NULL DEFAULT 'aktif' COMMENT 'aktif, nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_tabungan`
--

INSERT INTO `ts_tabungan` (`idTabungan`, `nomorTabungan`, `namaTabungan`, `idSiswa`, `status`) VALUES
(1, '200413-1-790', 'TABUNGAN SEKOLAH', 790, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `ts_transaksi`
--

CREATE TABLE `ts_transaksi` (
  `idTransaksi` int(11) NOT NULL,
  `nomorTransaksi` tinytext NOT NULL,
  `idTabungan` int(10) NOT NULL,
  `nominal` int(10) NOT NULL,
  `action` char(6) NOT NULL COMMENT 'masuk, keluar',
  `jenisBiaya` int(10) NOT NULL COMMENT 'idJenisBiaya dari tabel ts_jenis_biaya',
  `keterangan` tinytext NOT NULL,
  `admin` int(10) NOT NULL COMMENT 'idUser (admin) yang input data',
  `waktuTransaksi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_transaksi`
--

INSERT INTO `ts_transaksi` (`idTransaksi`, `nomorTransaksi`, `idTabungan`, `nominal`, `action`, `jenisBiaya`, `keterangan`, `admin`, `waktuTransaksi`) VALUES
(1, '200413-3-790-1', 1, 20000, 'masuk', 0, 'Tabungan Pertama', 3, '2020-04-13 17:03:40'),
(2, '200413-3-790-2', 1, 2000, 'keluar', 1, 'Biaya Buku', 3, '2020-04-13 17:11:47'),
(3, '200419-3-790-3', 1, 20000, 'masuk', 0, 'Menabung', 3, '2020-04-19 16:45:39'),
(4, '200419-3-790-4', 1, 50000, 'masuk', 0, 'Menabung', 3, '2020-04-19 16:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `ts_user`
--

CREATE TABLE `ts_user` (
  `idUser` int(11) NOT NULL,
  `nama` char(150) NOT NULL,
  `alamat` tinytext NOT NULL,
  `username` char(150) NOT NULL,
  `password` text NOT NULL,
  `noHP` char(15) NOT NULL,
  `email` char(150) NOT NULL,
  `level` char(25) NOT NULL COMMENT 'superadmin, admin',
  `status` char(100) NOT NULL DEFAULT 'aktif' COMMENT 'aktif, nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_user`
--

INSERT INTO `ts_user` (`idUser`, `nama`, `alamat`, `username`, `password`, `noHP`, `email`, `level`, `status`) VALUES
(1, 'Falentino Djoka', 'Jl. Cengkeh 12 No. 1 Perumnas Simalingkar', 'falentinodjoka2801', '487ff2d43f052defb561b1cfc8062a01', '081533306904', 'falentinodjoka2801@gmail.com', 'superadmin', 'aktif'),
(2, 'Budi Super Admin', 'Medan', 'budisuperadmin', '079d2e3edbf4c1c0d9101e8c31ea26b4', '089912121414', 'budi@gmail.com', 'superadmin', 'aktif'),
(3, 'budiadmin', 'Medan', 'budiadmin', '070a7c5c992babd6d570667e1b804b51', '082160640970', 'budisari25@gmail.com', 'admin', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `ts_view`
--

CREATE TABLE `ts_view` (
  `namaView` char(150) NOT NULL,
  `skrip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_view`
--

INSERT INTO `ts_view` (`namaView`, `skrip`) VALUES
('view_siswa', 'select `s`.`idSiswa` AS `idSiswa`,`s`.`nis` AS `nis`,`s`.`nama` AS `nama`,`s`.`alamat` AS `alamat`,`s`.`noHP` AS `noHP`,`s`.`email` AS `email`,`s`.`jenisKelamin` AS `jenisKelamin`,`s`.`namaIbuKandung` AS `namaIbuKandung`,`s`.`namaAyahKandung` AS `namaAyahKandung`,`s`.`noHPOrangTua` AS `noHPOrangTua`,`s`.`kelas` AS `kelas`,`s`.`tahunAjaran` AS `tahunAjaran`,`s`.`status` AS `status`,if(isnull(`k`.`namaKelas`),\'\',`k`.`namaKelas`) AS `namaKelas` from (`tabungansekolah_baru`.`ts_siswa` `s` left join `tabungansekolah_baru`.`ts_kelas` `k` on((`k`.`idKelas` = `s`.`kelas`)))'),
('view_tabungan', 'select `t`.`idTabungan` AS `idTabungan`,`t`.`nomorTabungan` AS `nomorTabungan`,`t`.`namaTabungan` AS `namaTabungan`,`t`.`idSiswa` AS `idSiswa`,`t`.`status` AS `status`,if(isnull(`s`.`nama`),\'\',`s`.`nama`) AS `namaSiswa`,if(isnull(`s`.`kelas`),\'\',`s`.`kelas`) AS `idKelas`,if(isnull(`k`.`namaKelas`),\'\',`k`.`namaKelas`) AS `namaKelas` from ((`tabungansekolah_baru`.`ts_tabungan` `t` left join `tabungansekolah_baru`.`ts_siswa` `s` on((`t`.`idSiswa` = `s`.`idSiswa`))) left join `tabungansekolah_baru`.`ts_kelas` `k` on((`k`.`idKelas` = `s`.`kelas`)))'),
('view_transaksi', 'select `t`.`idTransaksi` AS `idTransaksi`,`t`.`nomorTransaksi` AS `nomorTransaksi`,`t`.`idTabungan` AS `idTabungan`,`t`.`nominal` AS `nominal`,`t`.`action` AS `action`,`t`.`jenisBiaya` AS `jenisBiaya`,if(isnull(`jb`.`nama`),\'\',`jb`.`nama`) AS `namaJenisBiaya`,if(isnull(`jb`.`keterangan`),\'\',`jb`.`keterangan`) AS `keteranganJenisBiaya`,`t`.`keterangan` AS `keterangan`,`t`.`admin` AS `admin`,`t`.`waktuTransaksi` AS `waktuTransaksi`,`vt`.`nomorTabungan` AS `nomorTabungan`,`vt`.`namaTabungan` AS `namaTabungan`,`vt`.`idSiswa` AS `idSiswaPemilikTabungan`,`vt`.`namaSiswa` AS `siswaPemilikTabungan`,`vt`.`idKelas` AS `idKelas`,`u`.`nama` AS `namaAdmin`,if(isnull(`r`.`keterangan`),\'\',`r`.`keterangan`) AS `keteranganReverse`,if(isnull(`r`.`waktu`),\'\',`r`.`waktu`) AS `waktuReverse`,if(isnull(`r`.`statusReverse`),\'\',`r`.`statusReverse`) AS `statusReverse` from ((((`tabungansekolah_baru`.`ts_transaksi` `t` left join `tabungansekolah_baru`.`view_tabungan` `vt` on((`vt`.`idTabungan` = `t`.`idTabungan`))) left join `tabungansekolah_baru`.`ts_user` `u` on((`u`.`idUser` = `t`.`admin`))) left join `tabungansekolah_baru`.`ts_reverse` `r` on((`r`.`nomorTransaksi` = `t`.`nomorTransaksi`))) left join `tabungansekolah_baru`.`ts_jenis_biaya` `jb` on((`jb`.`idJenisBiaya` = `t`.`jenisBiaya`)))');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_siswa`
-- (See below for the actual view)
--
CREATE TABLE `view_siswa` (
`idSiswa` int(11)
,`nis` char(200)
,`nama` char(100)
,`alamat` tinytext
,`noHP` char(15)
,`email` char(150)
,`jenisKelamin` char(1)
,`namaIbuKandung` char(100)
,`namaAyahKandung` char(100)
,`noHPOrangTua` char(15)
,`kelas` char(150)
,`tahunAjaran` char(10)
,`status` char(100)
,`namaKelas` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_tabungan`
-- (See below for the actual view)
--
CREATE TABLE `view_tabungan` (
`idTabungan` int(11)
,`nomorTabungan` char(150)
,`namaTabungan` char(100)
,`idSiswa` int(10)
,`status` char(10)
,`namaSiswa` varchar(100)
,`idKelas` varchar(150)
,`namaKelas` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_transaksi`
-- (See below for the actual view)
--
CREATE TABLE `view_transaksi` (
`idTransaksi` int(11)
,`nomorTransaksi` tinytext
,`idTabungan` int(10)
,`nominal` int(10)
,`action` char(6)
,`jenisBiaya` int(10)
,`namaJenisBiaya` varchar(150)
,`keteranganJenisBiaya` text
,`keterangan` tinytext
,`admin` int(10)
,`waktuTransaksi` datetime
,`nomorTabungan` char(150)
,`namaTabungan` char(100)
,`idSiswaPemilikTabungan` int(10)
,`siswaPemilikTabungan` varchar(100)
,`idKelas` varchar(150)
,`namaAdmin` char(150)
,`keteranganReverse` text
,`waktuReverse` varchar(19)
,`statusReverse` varchar(7)
);

-- --------------------------------------------------------

--
-- Structure for view `view_siswa`
--
DROP TABLE IF EXISTS `view_siswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`faleacom`@`localhost` SQL SECURITY DEFINER VIEW `view_siswa`  AS  select `s`.`idSiswa` AS `idSiswa`,`s`.`nis` AS `nis`,`s`.`nama` AS `nama`,`s`.`alamat` AS `alamat`,`s`.`noHP` AS `noHP`,`s`.`email` AS `email`,`s`.`jenisKelamin` AS `jenisKelamin`,`s`.`namaIbuKandung` AS `namaIbuKandung`,`s`.`namaAyahKandung` AS `namaAyahKandung`,`s`.`noHPOrangTua` AS `noHPOrangTua`,`s`.`kelas` AS `kelas`,`s`.`tahunAjaran` AS `tahunAjaran`,`s`.`status` AS `status`,if(`k`.`namaKelas` is null,'',`k`.`namaKelas`) AS `namaKelas` from (`ts_siswa` `s` left join `ts_kelas` `k` on(`k`.`idKelas` = `s`.`kelas`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_tabungan`
--
DROP TABLE IF EXISTS `view_tabungan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`faleacom`@`localhost` SQL SECURITY DEFINER VIEW `view_tabungan`  AS  select `t`.`idTabungan` AS `idTabungan`,`t`.`nomorTabungan` AS `nomorTabungan`,`t`.`namaTabungan` AS `namaTabungan`,`t`.`idSiswa` AS `idSiswa`,`t`.`status` AS `status`,if(`s`.`nama` is null,'',`s`.`nama`) AS `namaSiswa`,if(`s`.`kelas` is null,'',`s`.`kelas`) AS `idKelas`,if(`k`.`namaKelas` is null,'',`k`.`namaKelas`) AS `namaKelas` from ((`ts_tabungan` `t` left join `ts_siswa` `s` on(`t`.`idSiswa` = `s`.`idSiswa`)) left join `ts_kelas` `k` on(`k`.`idKelas` = `s`.`kelas`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_transaksi`
--
DROP TABLE IF EXISTS `view_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`faleacom`@`localhost` SQL SECURITY DEFINER VIEW `view_transaksi`  AS  select `t`.`idTransaksi` AS `idTransaksi`,`t`.`nomorTransaksi` AS `nomorTransaksi`,`t`.`idTabungan` AS `idTabungan`,`t`.`nominal` AS `nominal`,`t`.`action` AS `action`,`t`.`jenisBiaya` AS `jenisBiaya`,if(`jb`.`nama` is null,'',`jb`.`nama`) AS `namaJenisBiaya`,if(`jb`.`keterangan` is null,'',`jb`.`keterangan`) AS `keteranganJenisBiaya`,`t`.`keterangan` AS `keterangan`,`t`.`admin` AS `admin`,`t`.`waktuTransaksi` AS `waktuTransaksi`,`vt`.`nomorTabungan` AS `nomorTabungan`,`vt`.`namaTabungan` AS `namaTabungan`,`vt`.`idSiswa` AS `idSiswaPemilikTabungan`,`vt`.`namaSiswa` AS `siswaPemilikTabungan`,`vt`.`idKelas` AS `idKelas`,`u`.`nama` AS `namaAdmin`,if(`r`.`keterangan` is null,'',`r`.`keterangan`) AS `keteranganReverse`,if(`r`.`waktu` is null,'',`r`.`waktu`) AS `waktuReverse`,if(`r`.`statusReverse` is null,'',`r`.`statusReverse`) AS `statusReverse` from ((((`ts_transaksi` `t` left join `view_tabungan` `vt` on(`vt`.`idTabungan` = `t`.`idTabungan`)) left join `ts_user` `u` on(`u`.`idUser` = `t`.`admin`)) left join `ts_reverse` `r` on(`r`.`nomorTransaksi` = `t`.`nomorTransaksi`)) left join `ts_jenis_biaya` `jb` on(`jb`.`idJenisBiaya` = `t`.`jenisBiaya`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ts_jenis_biaya`
--
ALTER TABLE `ts_jenis_biaya`
  ADD PRIMARY KEY (`idJenisBiaya`);

--
-- Indexes for table `ts_kelas`
--
ALTER TABLE `ts_kelas`
  ADD PRIMARY KEY (`idKelas`);

--
-- Indexes for table `ts_reverse`
--
ALTER TABLE `ts_reverse`
  ADD PRIMARY KEY (`idReverse`);

--
-- Indexes for table `ts_sekolah`
--
ALTER TABLE `ts_sekolah`
  ADD PRIMARY KEY (`idSekolah`);

--
-- Indexes for table `ts_siswa`
--
ALTER TABLE `ts_siswa`
  ADD PRIMARY KEY (`idSiswa`);

--
-- Indexes for table `ts_tabungan`
--
ALTER TABLE `ts_tabungan`
  ADD PRIMARY KEY (`idTabungan`);

--
-- Indexes for table `ts_transaksi`
--
ALTER TABLE `ts_transaksi`
  ADD PRIMARY KEY (`idTransaksi`);

--
-- Indexes for table `ts_user`
--
ALTER TABLE `ts_user`
  ADD PRIMARY KEY (`idUser`);

--
-- Indexes for table `ts_view`
--
ALTER TABLE `ts_view`
  ADD PRIMARY KEY (`namaView`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ts_jenis_biaya`
--
ALTER TABLE `ts_jenis_biaya`
  MODIFY `idJenisBiaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ts_kelas`
--
ALTER TABLE `ts_kelas`
  MODIFY `idKelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ts_reverse`
--
ALTER TABLE `ts_reverse`
  MODIFY `idReverse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ts_sekolah`
--
ALTER TABLE `ts_sekolah`
  MODIFY `idSekolah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ts_siswa`
--
ALTER TABLE `ts_siswa`
  MODIFY `idSiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=828;

--
-- AUTO_INCREMENT for table `ts_tabungan`
--
ALTER TABLE `ts_tabungan`
  MODIFY `idTabungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ts_transaksi`
--
ALTER TABLE `ts_transaksi`
  MODIFY `idTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ts_user`
--
ALTER TABLE `ts_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
