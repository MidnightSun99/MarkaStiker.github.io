-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 09:21 AM
-- Server version: 10.3.15-MariaDB
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
-- Database: `db_markastiker`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `username` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nama` varchar(72) NOT NULL,
  `alamat` varchar(160) NOT NULL,
  `notelp` varchar(12) NOT NULL,
  `level` enum('Pemilik','Konsumen') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`username`, `password`, `nama`, `alamat`, `notelp`, `level`) VALUES
('Eksan', '81dc9bdb52d04dc20036dbd8313ed055', 'eksan ps', 'Bendosari, Sukoharjo', '082226595418', 'Pemilik'),
('Priyo', '81dc9bdb52d04dc20036dbd8313ed055', 'Eksan Priyo', 'Dk.Tengklik Rt03/07, Manisharjo, Bendosari', '081234567890', 'Konsumen'),
('Steverogers', 'e10adc3949ba59abbe56e057f20f883e', 'Steve Rogers', 'Wonogiri', '021365987', 'Konsumen');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ongkir`
--

CREATE TABLE `tb_ongkir` (
  `id` int(12) NOT NULL,
  `tujuan` varchar(72) NOT NULL,
  `ongkir` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ongkir`
--

INSERT INTO `tb_ongkir` (`id`, `tujuan`, `ongkir`) VALUES
(1, 'Aceh Barat', 0),
(2, 'Aceh Barat Daya', 0),
(3, 'Aceh Besar', 0),
(4, 'Aceh Jaya', 0),
(5, 'Aceh Selatan', 0),
(6, 'Aceh Singkil', 0),
(7, 'Aceh Tamiang', 0),
(8, 'Aceh Tengah', 0),
(9, 'Aceh Tenggara', 0),
(10, 'Aceh Timur', 0),
(11, 'Aceh Utara', 0),
(12, 'Agam', 0),
(13, 'Alor', 0),
(14, 'Ambon', 0),
(15, 'Asahan', 0),
(16, 'Asmat', 0),
(17, 'Badung', 0),
(18, 'Balangan', 0),
(19, 'Balikpapan', 0),
(20, 'Banda Aceh', 0),
(21, 'Bandar Lampung', 0),
(22, 'Bandung', 0),
(23, 'Bandung', 0),
(24, 'Bandung Barat', 0),
(25, 'Banggai', 0),
(26, 'Banggai Kepulauan', 0),
(27, 'Bangka', 0),
(28, 'Bangka Barat', 0),
(29, 'Bangka Selatan', 0),
(30, 'Bangka Tengah', 0),
(31, 'Bangkalan', 0),
(32, 'Bangli', 0),
(33, 'Banjar', 0),
(34, 'Banjar', 0),
(35, 'Banjarbaru', 0),
(36, 'Banjarmasin', 0),
(37, 'Banjarnegara', 0),
(38, 'Bantaeng', 0),
(39, 'Bantul', 0),
(40, 'Banyuasin', 0),
(41, 'Banyumas', 0),
(42, 'Banyuwangi', 0),
(43, 'Barito Kuala', 0),
(44, 'Barito Selatan', 0),
(45, 'Barito Timur', 0),
(46, 'Barito Utara', 0),
(47, 'Barru', 0),
(48, 'Batam', 0),
(49, 'Batang', 0),
(50, 'Batang Hari', 0),
(51, 'Batu', 0),
(52, 'Batu Bara', 0),
(53, 'Bau-Bau', 0),
(54, 'Bekasi', 0),
(55, 'Bekasi', 0),
(56, 'Belitung', 0),
(57, 'Belitung Timur', 0),
(58, 'Belu', 0),
(59, 'Bener Meriah', 0),
(60, 'Bengkalis', 0),
(61, 'Bengkayang', 0),
(62, 'Bengkulu', 0),
(63, 'Bengkulu Selatan', 0),
(64, 'Bengkulu Tengah', 0),
(65, 'Bengkulu Utara', 0),
(66, 'Berau', 0),
(67, 'Biak Numfor', 0),
(68, 'Bima', 0),
(69, 'Bima', 0),
(70, 'Binjai', 0),
(71, 'Bintan', 0),
(72, 'Bireuen', 0),
(73, 'Bitung', 0),
(74, 'Blitar', 0),
(75, 'Blitar', 0),
(76, 'Blora', 0),
(77, 'Boalemo', 0),
(78, 'Bogor', 0),
(79, 'Bogor', 0),
(80, 'Bojonegoro', 0),
(81, 'Bolaang Mongondow (Bolmong)', 0),
(82, 'Bolaang Mongondow Selatan', 0),
(83, 'Bolaang Mongondow Timur', 0),
(84, 'Bolaang Mongondow Utara', 0),
(85, 'Bombana', 0),
(86, 'Bondowoso', 0),
(87, 'Bone', 0),
(88, 'Bone Bolango', 0),
(89, 'Bontang', 0),
(90, 'Boven Digoel', 0),
(91, 'Boyolali', 0),
(92, 'Brebes', 0),
(93, 'Bukittinggi', 0),
(94, 'Buleleng', 0),
(95, 'Bulukumba', 0),
(96, 'Bulungan (Bulongan)', 0),
(97, 'Bungo', 0),
(98, 'Buol', 0),
(99, 'Buru', 0),
(100, 'Buru Selatan', 0),
(101, 'Buton', 0),
(102, 'Buton Utara', 0),
(103, 'Ciamis', 0),
(104, 'Cianjur', 0),
(105, 'Cilacap', 0),
(106, 'Cilegon', 0),
(107, 'Cimahi', 0),
(108, 'Cirebon', 0),
(109, 'Cirebon', 0),
(110, 'Dairi', 0),
(111, 'Deiyai (Deliyai)', 0),
(112, 'Deli Serdang', 0),
(113, 'Demak', 0),
(114, 'Denpasar', 0),
(115, 'Depok', 0),
(116, 'Dharmasraya', 0),
(117, 'Dogiyai', 0),
(118, 'Dompu', 0),
(119, 'Donggala', 0),
(120, 'Dumai', 0),
(121, 'Empat Lawang', 0),
(122, 'Ende', 0),
(123, 'Enrekang', 0),
(124, 'Fakfak', 0),
(125, 'Flores Timur', 0),
(126, 'Garut', 0),
(127, 'Gayo Lues', 0),
(128, 'Gianyar', 0),
(129, 'Gorontalo', 0),
(130, 'Gorontalo', 0),
(131, 'Gorontalo Utara', 0),
(132, 'Gowa', 0),
(133, 'Gresik', 0),
(134, 'Grobogan', 0),
(135, 'Gunung Kidul', 0),
(136, 'Gunung Mas', 0),
(137, 'Gunungsitoli', 0),
(138, 'Halmahera Barat', 0),
(139, 'Halmahera Selatan', 0),
(140, 'Halmahera Tengah', 0),
(141, 'Halmahera Timur', 0),
(142, 'Halmahera Utara', 0),
(143, 'Hulu Sungai Selatan', 0),
(144, 'Hulu Sungai Tengah', 0),
(145, 'Hulu Sungai Utara', 0),
(146, 'Humbang Hasundutan', 0),
(147, 'Indragiri Hilir', 0),
(148, 'Indragiri Hulu', 0),
(149, 'Indramayu', 0),
(150, 'Intan Jaya', 0),
(151, 'Jakarta Barat', 0),
(152, 'Jakarta Pusat', 0),
(153, 'Jakarta Selatan', 0),
(154, 'Jakarta Timur', 0),
(155, 'Jakarta Utara', 0),
(156, 'Jambi', 0),
(157, 'Jayapura', 0),
(158, 'Jayapura', 0),
(159, 'Jayawijaya', 0),
(160, 'Jember', 0),
(161, 'Jembrana', 0),
(162, 'Jeneponto', 0),
(163, 'Jepara', 0),
(164, 'Jombang', 0),
(165, 'Kaimana', 0),
(166, 'Kampar', 0),
(167, 'Kapuas', 0),
(168, 'Kapuas Hulu', 0),
(169, 'Karanganyar', 0),
(170, 'Karangasem', 0),
(171, 'Karawang', 0),
(172, 'Karimun', 0),
(173, 'Karo', 0),
(174, 'Katingan', 0),
(175, 'Kaur', 0),
(176, 'Kayong Utara', 0),
(177, 'Kebumen', 0),
(178, 'Kediri', 0),
(179, 'Kediri', 0),
(180, 'Keerom', 0),
(181, 'Kendal', 0),
(182, 'Kendari', 0),
(183, 'Kepahiang', 0),
(184, 'Kepulauan Anambas', 0),
(185, 'Kepulauan Aru', 0),
(186, 'Kepulauan Mentawai', 0),
(187, 'Kepulauan Meranti', 0),
(188, 'Kepulauan Sangihe', 0),
(189, 'Kepulauan Seribu', 0),
(190, 'Kepulauan Siau Tagulandang Biaro (Sitaro)', 0),
(191, 'Kepulauan Sula', 0),
(192, 'Kepulauan Talaud', 0),
(193, 'Kepulauan Yapen (Yapen Waropen)', 0),
(194, 'Kerinci', 0),
(195, 'Ketapang', 0),
(196, 'Klaten', 0),
(197, 'Klungkung', 0),
(198, 'Kolaka', 0),
(199, 'Kolaka Utara', 0),
(200, 'Konawe', 0),
(201, 'Konawe Selatan', 0),
(202, 'Konawe Utara', 0),
(203, 'Kotabaru', 0),
(204, 'Kotamobagu', 0),
(205, 'Kotawaringin Barat', 0),
(206, 'Kotawaringin Timur', 0),
(207, 'Kuantan Singingi', 0),
(208, 'Kubu Raya', 0),
(209, 'Kudus', 0),
(210, 'Kulon Progo', 0),
(211, 'Kuningan', 0),
(212, 'Kupang', 0),
(213, 'Kupang', 0),
(214, 'Kutai Barat', 0),
(215, 'Kutai Kartanegara', 0),
(216, 'Kutai Timur', 0),
(217, 'Labuhan Batu', 0),
(218, 'Labuhan Batu Selatan', 0),
(219, 'Labuhan Batu Utara', 0),
(220, 'Lahat', 0),
(221, 'Lamandau', 0),
(222, 'Lamongan', 0),
(223, 'Lampung Barat', 0),
(224, 'Lampung Selatan', 0),
(225, 'Lampung Tengah', 0),
(226, 'Lampung Timur', 0),
(227, 'Lampung Utara', 0),
(228, 'Landak', 0),
(229, 'Langkat', 0),
(230, 'Langsa', 0),
(231, 'Lanny Jaya', 0),
(232, 'Lebak', 0),
(233, 'Lebong', 0),
(234, 'Lembata', 0),
(235, 'Lhokseumawe', 0),
(236, 'Lima Puluh Koto/Kota', 0),
(237, 'Lingga', 0),
(238, 'Lombok Barat', 0),
(239, 'Lombok Tengah', 0),
(240, 'Lombok Timur', 0),
(241, 'Lombok Utara', 0),
(242, 'Lubuk Linggau', 0),
(243, 'Lumajang', 0),
(244, 'Luwu', 0),
(245, 'Luwu Timur', 0),
(246, 'Luwu Utara', 0),
(247, 'Madiun', 0),
(248, 'Madiun', 0),
(249, 'Magelang', 0),
(250, 'Magelang', 0),
(251, 'Magetan', 0),
(252, 'Majalengka', 0),
(253, 'Majene', 0),
(254, 'Makassar', 0),
(255, 'Malang', 0),
(256, 'Malang', 0),
(257, 'Malinau', 0),
(258, 'Maluku Barat Daya', 0),
(259, 'Maluku Tengah', 0),
(260, 'Maluku Tenggara', 0),
(261, 'Maluku Tenggara Barat', 0),
(262, 'Mamasa', 0),
(263, 'Mamberamo Raya', 0),
(264, 'Mamberamo Tengah', 0),
(265, 'Mamuju', 0),
(266, 'Mamuju Utara', 0),
(267, 'Manado', 0),
(268, 'Mandailing Natal', 0),
(269, 'Manggarai', 0),
(270, 'Manggarai Barat', 0),
(271, 'Manggarai Timur', 0),
(272, 'Manokwari', 0),
(273, 'Manokwari Selatan', 0),
(274, 'Mappi', 0),
(275, 'Maros', 0),
(276, 'Mataram', 0),
(277, 'Maybrat', 0),
(278, 'Medan', 0),
(279, 'Melawi', 0),
(280, 'Merangin', 0),
(281, 'Merauke', 0),
(282, 'Mesuji', 0),
(283, 'Metro', 0),
(284, 'Mimika', 0),
(285, 'Minahasa', 0),
(286, 'Minahasa Selatan', 0),
(287, 'Minahasa Tenggara', 0),
(288, 'Minahasa Utara', 0),
(289, 'Mojokerto', 0),
(290, 'Mojokerto', 0),
(291, 'Morowali', 0),
(292, 'Muara Enim', 0),
(293, 'Muaro Jambi', 0),
(294, 'Muko Muko', 0),
(295, 'Muna', 0),
(296, 'Murung Raya', 0),
(297, 'Musi Banyuasin', 0),
(298, 'Musi Rawas', 0),
(299, 'Nabire', 0),
(300, 'Nagan Raya', 0),
(301, 'Nagekeo', 0),
(302, 'Natuna', 0),
(303, 'Nduga', 0),
(304, 'Ngada', 0),
(305, 'Nganjuk', 0),
(306, 'Ngawi', 0),
(307, 'Nias', 0),
(308, 'Nias Barat', 0),
(309, 'Nias Selatan', 0),
(310, 'Nias Utara', 0),
(311, 'Nunukan', 0),
(312, 'Ogan Ilir', 0),
(313, 'Ogan Komering Ilir', 0),
(314, 'Ogan Komering Ulu', 0),
(315, 'Ogan Komering Ulu Selatan', 0),
(316, 'Ogan Komering Ulu Timur', 0),
(317, 'Pacitan', 0),
(318, 'Padang', 0),
(319, 'Padang Lawas', 0),
(320, 'Padang Lawas Utara', 0),
(321, 'Padang Panjang', 0),
(322, 'Padang Pariaman', 0),
(323, 'Padang Sidempuan', 0),
(324, 'Pagar Alam', 0),
(325, 'Pakpak Bharat', 0),
(326, 'Palangka Raya', 0),
(327, 'Palembang', 0),
(328, 'Palopo', 0),
(329, 'Palu', 0),
(330, 'Pamekasan', 0),
(331, 'Pandeglang', 0),
(332, 'Pangandaran', 0),
(333, 'Pangkajene Kepulauan', 0),
(334, 'Pangkal Pinang', 0),
(335, 'Paniai', 0),
(336, 'Parepare', 0),
(337, 'Pariaman', 0),
(338, 'Parigi Moutong', 0),
(339, 'Pasaman', 0),
(340, 'Pasaman Barat', 0),
(341, 'Paser', 0),
(342, 'Pasuruan', 0),
(343, 'Pasuruan', 0),
(344, 'Pati', 0),
(345, 'Payakumbuh', 0),
(346, 'Pegunungan Arfak', 0),
(347, 'Pegunungan Bintang', 0),
(348, 'Pekalongan', 0),
(349, 'Pekalongan', 0),
(350, 'Pekanbaru', 0),
(351, 'Pelalawan', 0),
(352, 'Pemalang', 0),
(353, 'Pematang Siantar', 0),
(354, 'Penajam Paser Utara', 0),
(355, 'Pesawaran', 0),
(356, 'Pesisir Barat', 0),
(357, 'Pesisir Selatan', 0),
(358, 'Pidie', 0),
(359, 'Pidie Jaya', 0),
(360, 'Pinrang', 0),
(361, 'Pohuwato', 0),
(362, 'Polewali Mandar', 0),
(363, 'Ponorogo', 0),
(364, 'Pontianak', 0),
(365, 'Pontianak', 0),
(366, 'Poso', 0),
(367, 'Prabumulih', 0),
(368, 'Pringsewu', 0),
(369, 'Probolinggo', 0),
(370, 'Probolinggo', 0),
(371, 'Pulang Pisau', 0),
(372, 'Pulau Morotai', 0),
(373, 'Puncak', 0),
(374, 'Puncak Jaya', 0),
(375, 'Purbalingga', 0),
(376, 'Purwakarta', 0),
(377, 'Purworejo', 0),
(378, 'Raja Ampat', 0),
(379, 'Rejang Lebong', 0),
(380, 'Rembang', 0),
(381, 'Rokan Hilir', 0),
(382, 'Rokan Hulu', 0),
(383, 'Rote Ndao', 0),
(384, 'Sabang', 0),
(385, 'Sabu Raijua', 0),
(386, 'Salatiga', 0),
(387, 'Samarinda', 0),
(388, 'Sambas', 0),
(389, 'Samosir', 0),
(390, 'Sampang', 0),
(391, 'Sanggau', 0),
(392, 'Sarmi', 0),
(393, 'Sarolangun', 0),
(394, 'Sawah Lunto', 0),
(395, 'Sekadau', 0),
(396, 'Selayar (Kepulauan Selayar)', 0),
(397, 'Seluma', 0),
(398, 'Semarang', 0),
(399, 'Semarang', 0),
(400, 'Seram Bagian Barat', 0),
(401, 'Seram Bagian Timur', 0),
(402, 'Serang', 0),
(403, 'Serang', 0),
(404, 'Serdang Bedagai', 0),
(405, 'Seruyan', 0),
(406, 'Siak', 0),
(407, 'Sibolga', 0),
(408, 'Sidenreng Rappang/Rapang', 0),
(409, 'Sidoarjo', 0),
(410, 'Sigi', 0),
(411, 'Sijunjung (Sawah Lunto Sijunjung)', 0),
(412, 'Sikka', 0),
(413, 'Simalungun', 0),
(414, 'Simeulue', 0),
(415, 'Singkawang', 0),
(416, 'Sinjai', 0),
(417, 'Sintang', 0),
(418, 'Situbondo', 0),
(419, 'Sleman', 0),
(420, 'Solok', 0),
(421, 'Solok', 0),
(422, 'Solok Selatan', 0),
(423, 'Soppeng', 0),
(424, 'Sorong', 0),
(425, 'Sorong', 0),
(426, 'Sorong Selatan', 0),
(427, 'Sragen', 0),
(428, 'Subang', 0),
(429, 'Subulussalam', 0),
(430, 'Sukabumi', 0),
(431, 'Sukabumi', 0),
(432, 'Sukamara', 0),
(433, 'Sukoharjo', 0),
(434, 'Sumba Barat', 0),
(435, 'Sumba Barat Daya', 0),
(436, 'Sumba Tengah', 0),
(437, 'Sumba Timur', 0),
(438, 'Sumbawa', 0),
(439, 'Sumbawa Barat', 0),
(440, 'Sumedang', 0),
(441, 'Sumenep', 0),
(442, 'Sungaipenuh', 0),
(443, 'Supiori', 0),
(444, 'Surabaya', 0),
(445, 'Surakarta (Solo)', 0),
(446, 'Tabalong', 0),
(447, 'Tabanan', 0),
(448, 'Takalar', 0),
(449, 'Tambrauw', 0),
(450, 'Tana Tidung', 0),
(451, 'Tana Toraja', 0),
(452, 'Tanah Bumbu', 0),
(453, 'Tanah Datar', 0),
(454, 'Tanah Laut', 0),
(455, 'Tangerang', 0),
(456, 'Tangerang', 0),
(457, 'Tangerang Selatan', 0),
(458, 'Tanggamus', 0),
(459, 'Tanjung Balai', 0),
(460, 'Tanjung Jabung Barat', 0),
(461, 'Tanjung Jabung Timur', 0),
(462, 'Tanjung Pinang', 0),
(463, 'Tapanuli Selatan', 0),
(464, 'Tapanuli Tengah', 0),
(465, 'Tapanuli Utara', 0),
(466, 'Tapin', 0),
(467, 'Tarakan', 0),
(468, 'Tasikmalaya', 0),
(469, 'Tasikmalaya', 0),
(470, 'Tebing Tinggi', 0),
(471, 'Tebo', 0),
(472, 'Tegal', 0),
(473, 'Tegal', 0),
(474, 'Teluk Bintuni', 0),
(475, 'Teluk Wondama', 0),
(476, 'Temanggung', 0),
(477, 'Ternate', 0),
(478, 'Tidore Kepulauan', 0),
(479, 'Timor Tengah Selatan', 0),
(480, 'Timor Tengah Utara', 0),
(481, 'Toba Samosir', 0),
(482, 'Tojo Una-Una', 0),
(483, 'Toli-Toli', 0),
(484, 'Tolikara', 0),
(485, 'Tomohon', 0),
(486, 'Toraja Utara', 0),
(487, 'Trenggalek', 0),
(488, 'Tual', 0),
(489, 'Tuban', 0),
(490, 'Tulang Bawang', 0),
(491, 'Tulang Bawang Barat', 0),
(492, 'Tulungagung', 0),
(493, 'Wajo', 0),
(494, 'Wakatobi', 0),
(495, 'Waropen', 0),
(496, 'Way Kanan', 0),
(497, 'Wonogiri', 0),
(498, 'Wonosobo', 0),
(499, 'Yahukimo', 0),
(500, 'Yalimo', 0),
(501, 'Yogyakarta', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `idproduk` varchar(7) NOT NULL,
  `nama` varchar(72) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(12) NOT NULL,
  `satuan` varchar(72) NOT NULL,
  `plusdesain` int(12) DEFAULT NULL,
  `pluscutpersegi` int(12) DEFAULT NULL,
  `pluscutlingkaran` int(12) DEFAULT NULL,
  `pluscutdetail` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`idproduk`, `nama`, `keterangan`, `harga`, `satuan`, `plusdesain`, `pluscutpersegi`, `pluscutlingkaran`, `pluscutdetail`) VALUES
('PRD0001', 'Polaroid 6 x 9 cm', 'Bahan 260gsm + Laminasi Glossy/Doff', 15000, '25 Pict', 2000, 0, 0, 0),
('PRD0002', 'Polaroid 7 x 10 cm', 'Bahan 260gsm + Laminasi Glossy/Doff', 13000, '18 Pict', NULL, NULL, NULL, NULL),
('PRD0003', 'Square Polaroid 7 x 7 cm', 'Bahan 260gsm + Laminasi Glossy/Doff', 13000, '24 Pict', NULL, NULL, NULL, NULL),
('PRD0004', 'Strip Polaroid 7 x 15 cm', 'Bahan 260gsm + Laminasi Glossy/Doff', 13000, '36 Pict', NULL, NULL, NULL, NULL),
('PRD0005', 'Stiker HVS', 'Stiker HVS', 9000, 'A3', 6000, 3000, 4000, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `idtransaksi` varchar(14) NOT NULL,
  `username` varchar(15) NOT NULL,
  `tglorder` varchar(10) NOT NULL,
  `tgltempo` varchar(10) NOT NULL,
  `namapenerima` varchar(72) NOT NULL,
  `alamatpenerima` text NOT NULL,
  `kotapenerima` varchar(72) NOT NULL,
  `notelppenerima` varchar(18) NOT NULL,
  `emailpenerima` varchar(72) NOT NULL,
  `totalbelanja` int(14) NOT NULL,
  `ongkir` int(12) NOT NULL,
  `total` int(15) NOT NULL,
  `status` enum('Pesanan Masuk','Konfirmasi Pesanan','Konfirmasi Bayar','Diproses','Pesanan Selesai','Dibatalkan') NOT NULL,
  `keterangan` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`idtransaksi`, `username`, `tglorder`, `tgltempo`, `namapenerima`, `alamatpenerima`, `kotapenerima`, `notelppenerima`, `emailpenerima`, `totalbelanja`, `ongkir`, `total`, `status`, `keterangan`) VALUES
('04082023182634', 'Priyo', '04-08-2023', '07-08-2023', 'Eksan', 'Dk.Tengklik Rt03/07, Manisharjo, Bendosari', 'Sibolga', '05', 'eksanpriyos10074@gmail.com', 14000, 52000, 66000, 'Pesanan Selesai', 'WE'),
('04082023201529', 'Priyo', '04-08-2023', '07-08-2023', 'Eksan', 'Dk.REnak Rt03/07, Manisharjo, mataram', 'Ketapang', '05878', 'eksanpriyos10074@gmail.com', 45000, 53000, 98000, 'Pesanan Selesai', 'ER'),
('04082023203737', 'Priyo', '04-08-2023', '07-08-2023', 'Eksan', 'New york', 'Aceh Tamiang', '0287912', 'eksanpriyos10074@gmail.com', 30000, 63000, 93000, 'Konfirmasi Pesanan', 'ERT'),
('06082023154509', 'Steverogers', '06-08-2023', '09-08-2023', 'Steve Rogers', 'Dk.Joho Rt03/07, Gayam, Sukoharjo, 57536', 'Sukoharjo', '08796384756', 'SteveRogers10074@gmail.com', 26000, 6000, 32000, 'Pesanan Selesai', 'CEPAT'),
('07082023004243', 'Steverogers', '07-08-2023', '10-08-2023', 'Eksan', 'Dk.Tengklik Rt03/07, Manisharjo, Bendosari', 'Wonogiri', '021365478', 'eksanpriyos10074@gmail.com', 27000, 6000, 33000, 'Konfirmasi Pesanan', 'ERTR'),
('250720231717', 'Priyo', '25-07-2023', '', 'Priyo', 'Cemani', '', '08769845612', 'Steve@gma.ocm', 30000, 9000, 39000, 'Konfirmasi Pesanan', 'RF'),
('250720231928', 'Priyo', '25-07-2023', '', 'Marta', 'Solo', '', '1234567', 'marta@hayo.com', 30000, 9000, 39000, 'Konfirmasi Pesanan', 'FF'),
('260720231945', 'Priyo', '26-07-2023', '28-07-2023', 'Eksan', 'Dk.Tengklik Rt03/07, Manisharjo, Bendosari', '', '08786951', 'eksanpriyos10074@gmail.com', 40000, 12000, 52000, 'Pesanan Selesai', 'RR'),
('260720231955', 'Priyo', '26-07-2023', '', 'Eksan', 'Papua', '', '028', 'eksanpriyos10074@gmail.com', 63000, 25000, 88000, 'Dibatalkan', 'JAUH');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksidetail`
--

CREATE TABLE `tb_transaksidetail` (
  `idtransaksidetail` int(20) NOT NULL,
  `username` varchar(15) NOT NULL,
  `idtransaksi` varchar(14) NOT NULL,
  `idproduk` varchar(7) NOT NULL,
  `qty` int(8) NOT NULL,
  `harga` int(12) NOT NULL,
  `plusdesain` int(12) NOT NULL,
  `pluscutpersegi` int(12) NOT NULL,
  `pluscutlingkaran` int(12) NOT NULL,
  `pluscutdetail` int(12) NOT NULL,
  `subtotal` int(13) NOT NULL,
  `keteranganorder` text NOT NULL,
  `status` enum('Keranjang Belanja','Transaksi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksidetail`
--

INSERT INTO `tb_transaksidetail` (`idtransaksidetail`, `username`, `idtransaksi`, `idproduk`, `qty`, `harga`, `plusdesain`, `pluscutpersegi`, `pluscutlingkaran`, `pluscutdetail`, `subtotal`, `keteranganorder`, `status`) VALUES
(13, 'Priyo', '04082023182634', 'PRD0005', 1, 9000, 5000, 0, 0, 0, 14000, 'WE', 'Transaksi'),
(14, 'Priyo', '04082023201529', 'PRD0001', 3, 15000, 0, 0, 0, 0, 45000, 'ER', 'Transaksi'),
(15, 'Priyo', '04082023203737', 'PRD0001', 2, 15000, 0, 0, 0, 0, 30000, 'er', 'Transaksi'),
(18, 'Steverogers', '06082023154509', 'PRD0003', 2, 13000, 0, 0, 0, 0, 26000, 'CEPAT', 'Transaksi'),
(19, 'Steverogers', '07082023004243', 'PRD0005', 3, 9000, 0, 0, 0, 0, 27000, '2', 'Transaksi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksitracking`
--

CREATE TABLE `tb_transaksitracking` (
  `idtransaksitracking` int(18) NOT NULL,
  `idtransaksi` varchar(14) NOT NULL,
  `tgl` varchar(10) NOT NULL,
  `status` enum('Pesanan Masuk','Konfirmasi Pesanan','Konfirmasi Bayar','Diproses','Pesanan Selesai','Dibatalkan') NOT NULL,
  `username` varchar(15) NOT NULL,
  `notif` enum('T','Y') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksitracking`
--

INSERT INTO `tb_transaksitracking` (`idtransaksitracking`, `idtransaksi`, `tgl`, `status`, `username`, `notif`) VALUES
(1, '04082023180735', '04-08-2023', 'Pesanan Masuk', 'Eksan', 'T'),
(2, '04082023180735', '04-08-2023', 'Konfirmasi Pesanan', 'Priyo', 'T'),
(3, '', '04-08-2023', 'Konfirmasi Bayar', 'Eksan', 'T'),
(4, '', '04-08-2023', 'Diproses', 'Eksan', 'T'),
(5, '04082023182634', '04-08-2023', 'Pesanan Masuk', 'Eksan', 'T'),
(6, '04082023182634', '04-08-2023', 'Konfirmasi Pesanan', 'Priyo', 'T'),
(7, '', '04-08-2023', 'Konfirmasi Bayar', 'Eksan', 'T'),
(8, '', '04-08-2023', 'Diproses', 'Eksan', 'T'),
(9, '04082023182634', '04-08-2023', 'Pesanan Selesai', 'Priyo', 'T'),
(10, '04082023201529', '04-08-2023', 'Pesanan Masuk', 'Eksan', 'T'),
(11, '04082023201529', '04-08-2023', 'Konfirmasi Pesanan', 'Priyo', 'T'),
(12, '', '04-08-2023', 'Konfirmasi Bayar', 'Eksan', 'T'),
(13, '', '04-08-2023', 'Diproses', 'Eksan', 'T'),
(14, '04082023201529', '04-08-2023', 'Pesanan Selesai', 'Priyo', 'T'),
(15, '04082023203737', '04-08-2023', 'Pesanan Masuk', 'Eksan', 'T'),
(16, '04082023203737', '04-08-2023', 'Konfirmasi Pesanan', 'Priyo', 'T'),
(17, '260720231955', '06-08-2023', 'Konfirmasi Pesanan', 'Priyo', 'T'),
(18, '06082023154509', '06-08-2023', 'Pesanan Masuk', 'Eksan', 'T'),
(19, '06082023154509', '06-08-2023', 'Konfirmasi Pesanan', 'Steverogers', 'T'),
(20, '260720231955', '06-08-2023', 'Dibatalkan', 'Priyo', 'T'),
(21, '', '06-08-2023', 'Konfirmasi Bayar', 'Eksan', 'T'),
(22, '', '06-08-2023', 'Diproses', 'Eksan', 'T'),
(23, '07082023004243', '07-08-2023', 'Pesanan Masuk', 'Eksan', 'T'),
(24, '250720231928', '07-08-2023', 'Konfirmasi Pesanan', 'Priyo', 'T'),
(25, '06082023154509', '07-08-2023', 'Pesanan Selesai', 'Steverogers', 'T'),
(26, '250720231717', '07-08-2023', 'Konfirmasi Pesanan', 'Priyo', 'T'),
(27, '07082023004243', '07-08-2023', 'Konfirmasi Pesanan', 'Steverogers', 'T');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`idproduk`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`idtransaksi`);

--
-- Indexes for table `tb_transaksidetail`
--
ALTER TABLE `tb_transaksidetail`
  ADD PRIMARY KEY (`idtransaksidetail`),
  ADD KEY `id_produk` (`idproduk`),
  ADD KEY `id_transaksi` (`idtransaksi`);

--
-- Indexes for table `tb_transaksitracking`
--
ALTER TABLE `tb_transaksitracking`
  ADD PRIMARY KEY (`idtransaksitracking`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT for table `tb_transaksidetail`
--
ALTER TABLE `tb_transaksidetail`
  MODIFY `idtransaksidetail` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_transaksitracking`
--
ALTER TABLE `tb_transaksitracking`
  MODIFY `idtransaksitracking` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_transaksidetail`
--
ALTER TABLE `tb_transaksidetail`
  ADD CONSTRAINT `tb_transaksidetail_ibfk_1` FOREIGN KEY (`idproduk`) REFERENCES `tb_produk` (`idproduk`),
  ADD CONSTRAINT `tb_transaksidetail_ibfk_2` FOREIGN KEY (`idtransaksi`) REFERENCES `tb_transaksi` (`idtransaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
