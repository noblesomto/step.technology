-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2022 at 03:32 AM
-- Server version: 10.3.34-MariaDB-log-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stepflnp_step`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `member_category` varchar(50) NOT NULL,
  `reg_number` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered` date NOT NULL,
  `email_confirmation` varchar(255) NOT NULL,
  `membership_status` varchar(30) NOT NULL,
  `reason` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `title`, `first_name`, `surname`, `organization_name`, `gender`, `phone_number`, `member_category`, `reg_number`, `image`, `email`, `password`, `registered`, `email_confirmation`, `membership_status`, `reason`) VALUES
(1, 'Mr', 'Kelechi ', 'Azodo', '', 'male', '09034436457', 'Young Professional', '', '', 'kelechiazodo@outlook.com', 'f80878c232a0156bc945e0b2b623700f', '2020-11-11', 'pending', 'not member', ''),
(2, 'Engr', 'Ekene', 'Okwunma', '', 'male', '07069083117', 'Corporate Professional', '', 'img_20201102_152932_401.5fac63f8b7b2f0.37276297.jpg', 'ekeneokwunma@gmail.com', '82f9496553436708160f54df47d37a5e', '2020-11-11', 'confirmed', 'not member', ''),
(3, 'Mr ', 'Kelechi ', 'Azodo ', '', 'male', '09034436457', 'Young Professional', '', '', 'kellexnuel@gmail.com', 'c79dcdbfe62bb4ca4970c4c2f766c73f', '2020-11-12', 'confirmed', 'not member', ''),
(4, 'Kelechi ', 'Azodo ', 'Azodo ', '', 'male', '09074563280', 'Young Professional', '', '', 'kelechi2202@gmail.com', 'c1e458fbb4e130ad4c5e135053c528a9', '2020-11-12', 'pending', 'not member', ''),
(5, 'Senior Control Room Operator/Supervisor ', 'Finecountry Davidson ', 'David Sele ', '', 'male', '+2349053955650', 'Corporate Professional', '', '20200908_181146.5fe1e42a7bf783.79420536.jpg', 'finecountryd@yahoo.co.uk', '3cefdfba042384f5b422e78f73325dc9', '2020-12-22', 'confirmed', 'not member', ''),
(6, 'Senior Control Room Operator/Supervisor ', 'Finecountry Davidson ', 'David Sele ', '', 'male', '+2349053955650', 'Corporate Professional', '', '', 'finecountry.david@erotonep.com', '3cefdfba042384f5b422e78f73325dc9', '2020-12-22', 'pending', 'not member', ''),
(7, 'sgh', 'dfeghyh', 'trehyt', '', 'male', '08161823978', 'Undergraduate', '', 'imageonline-co-split-image (1).5fe30609f0c6a6.78545007.jpg', 'johnboscoogu6@gmail.com', 'c8ffe9a587b126f152ed3d89a146b445', '2020-12-23', 'confirmed', 'not member', ''),
(8, 'Mr.', 'Mustapha', 'Dewu', '', 'male', '08032370801', 'Corporate Professional', '', '', 'muhddewum@yahoo.com', '909943a971652161a9b0f91bce34f1cf', '2020-12-29', 'pending', 'not member', ''),
(9, 'Mr', 'Peter', 'Mokayi', '', 'male', '08152377683', 'Young Professional', '', 'img-20210204-wa0000.601c305e0af0e0.99196901.jpg', 'mokayi.peter@yahoo.com', '56b54a2b3d9301fce4531710b2a03851', '2021-02-04', 'confirmed', 'payment approved', ''),
(10, 'Mr', 'Chinedu', 'Onyewuchi', '', 'male', '+2348037101368', 'Corporate Professional', '', '', 'geovincci@yahoo.com', '02e30f4df1ed2e84e9daed689a163031', '2021-02-22', 'confirmed', 'not member', ''),
(13, '', '', '', 'APPLIED ENGINEERING TECHNOLOGY INITIATIVE', 'male', '08138209752', 'Corporate Organisation', '', 'aeti logo.60c8b919743674.54162668.jpg', 'christian.uchenna@aetinigeria.com', '6887893d36ca5498580827d12f5068bd', '2021-06-15', 'confirmed', 'not member', ''),
(12, 'Mr', 'Anthony ', 'Onyedili', '', 'male', '+19514644571', 'Corporate Professional', '', '', 'onyediliobiora@yahoo.com', '1b06c46499ed94a33867fc5a838c2d9c', '2021-05-02', 'confirmed', 'not member', ''),
(14, 'MR', 'Chimezie Bright', 'Ntianya', '', 'male', '09052233396', 'Young Professional', '', '', 'chimeziebright4@yahoo.com', '2b02e737a415bb35f1772b7a2001e09d', '2021-07-27', 'confirmed', 'not member', ''),
(15, 'Mr', 'Nwabueze', 'ugwuegbulem', '', 'male', '+2349130175552', 'Young Professional', '', 'img_20210724_084333.610329b8097ed6.34878645.jpg', 'ugwuegbulemnwabueze@gmail.com', 'd1abdd4830065f192eafa3a36f52aa4b', '2021-07-29', 'confirmed', 'not member', ''),
(16, '', '', '', 'Sterling oil and gas, exploration and control, Nigeria Limited', 'male', '09056545269', 'Corporate Organisation', '', 'img_20190910_155117_357 (1).6102872d4359e0.45123565.jpg', 'brik1985@yahoo.com', 'fbdeb1b15c01448afc73567b8f4c01a3', '2021-07-29', 'confirmed', 'not member', ''),
(17, 'Mr.', 'Azuhka', 'Osanebi', '', 'male', '08023573757; 0805652', 'Corporate Professional', '', '', 'osanebiazuh@gmail.com', '451ed50b0b50ddd70703bc8c4d1b447f', '2021-07-30', 'confirmed', 'not member', ''),
(18, 'Mr', 'Ikenna ', 'Anosike ', '', 'male', '07038589302', 'Corporate Professional', '', '', 'ikennaanosike@outlook.com', '210856b1fe7c31c25d9c54e6e392db97', '2021-09-04', 'pending', 'not member', ''),
(19, 'Mr', 'Ikenna ', 'Anosike ', '', 'male', '07038589302', 'Corporate Professional', '', 'my passport.613358a4414653.27971620.jpg', 'ikenna_anosike@yahoo.com', '210856b1fe7c31c25d9c54e6e392db97', '2021-09-04', 'confirmed', 'not member', ''),
(20, 'Mr. ', 'BUHARI', 'SAMAILA', '', 'male', '07067847629', 'Young Professional', '', 'inbound2156386680109158170.613362f00b3853.80249893.jpg', 'kawara002@gmail.com', '915db25dbd7d938182f2b2dbba2c375a', '2021-09-04', 'confirmed', 'not member', ''),
(21, 'Sir', 'Muhammad Zayyad', 'Kabir', '', 'male', '08064747036', 'Young Professional', '', '', 'sirzayyad@gmail.comll', '9c8e311ca9bea66c8ca4a80c9b196162', '2021-09-04', 'pending', 'not member', ''),
(22, 'Mr', 'Kayode', 'David', '', 'male', '0809473896', 'Corporate Professional', '', '', 'bunkay28@gmail.com', 'a2fdfce51cb7a64c53607a89a1d4c080', '2021-09-04', 'confirmed', 'not member', ''),
(23, 'Mr', 'Adrian', 'Ohwofosirai', '', 'male', '08064370754', 'Young Professional', '', '', 'adrian4ist2007@gmail.com', '4d6d2f911fbf03651bdb59363c045f0a', '2021-09-04', 'confirmed', 'not member', ''),
(24, 'Mr', 'Muritala', 'Rasaq', '', 'male', '08030896652', 'Young Professional', '', 'img_20210823_100015_867.6133bdd5de1c79.17477792.jpg', 'matelectricalengineering@gmail.com', 'd0384a3ab191abf4f1308295705c1fff', '2021-09-04', 'confirmed', 'not member', ''),
(25, 'Engr ', 'Wisdom', 'Eshiet', '', 'male', '08030652990', 'Young Professional', '', '', 'whitech@gmail.com', 'c98ea9bec09aff08781c3a6263b39206', '2021-09-04', 'pending', 'not member', ''),
(26, 'Engr', 'Wisdom', 'Eshiet', '', 'male', '08030652990', 'Young Professional', '', 'download.6133c6bd7801e0.25029289.png', 'whitech4200@gmail.com', 'c98ea9bec09aff08781c3a6263b39206', '2021-09-04', 'confirmed', 'not member', ''),
(27, 'Mr.', 'Garba', 'Bate', 'Federal University Dutse, Nigeria', 'male', '+2347030474158', 'Young Professional', '', 'optimized-20190706_053846.6135ba6a5a9745.82119992.jpg', 'bategarba@yahoo.com', '4b2f3af99264ada65595eb59ca6f9fa6', '2021-09-04', 'confirmed', 'not member', ''),
(28, 'Engr. ', 'LoveGod', 'Eke', '', 'male', '08035490443', 'Corporate Professional', '', '20210904_161706.6133d977b7bb01.54601828.jpg', 'ekelg2002@gmail.com', '3fb7037175073cf6b79e06022cc42a34', '2021-09-04', 'confirmed', 'not member', ''),
(29, 'Mr', 'Abdulrashid', 'Isah', '', 'male', '07063321795', 'Young Professional', '', 'aaaaaaa.6133edd8c30cf9.85084808.jpg', 'isahabdulrashid@yahoo.com', 'cea3fdf22c0d9ddd3df6064481bbde8f', '2021-09-04', 'confirmed', 'not member', ''),
(30, 'Mr', 'SUNDAY ADAH', 'ALOME', '', 'male', '08036448284, 0802912', 'Corporate Professional', '', '', 'sundayalome28@gmail.com', '337ff570dfb5cdf7f6ff0dca0e4f2c32', '2021-09-05', 'confirmed', 'not member', ''),
(31, 'Dr', 'Mohammed Falalu ', 'Hamza', '', 'male', '08034523894', 'Young Professional', '', '', 'mfhamza.chm@buk.edu.ng', 'ed77f104c685fb5569d51cd69bc12c37', '2021-09-05', 'confirmed', 'not member', ''),
(32, 'Mr', 'Abubakar ', 'Musa Ahmad ', '', 'male', '08065523356', 'Young Professional', '', '1574937112621.6134caf52cf8e3.99758057.jpg', 'abumusaahmad@gmail.com', '4eb8d15c409a6549ae3035b294ecb25b', '2021-09-05', 'confirmed', 'not member', ''),
(33, 'MR', 'OGAH S', 'LINUS', '', 'male', '08081877503', 'Corporate Professional', '', 'dk bc new 2.6134d8f0118d89.24956164.jpg', 'contactdibced@gmail.com', '6d48012238e67b239a253205ac4a49d9', '2021-09-05', 'confirmed', 'not member', ''),
(34, 'Mr', 'Ayodeji', 'Baruwa', '', 'male', '08038501089', 'Corporate Professional', '', '', 'baruwa.ayodeji2@yahoo.com', '4501e63436f2c9ad0ba18314fada735d', '2021-09-05', 'pending', 'not member', ''),
(35, 'Mr', 'Micheal', 'Fajobi', '', 'male', '09155501726', 'Young Professional', '', 'inbound6453043623546930682.6134dce01ee175.41045938.jpg', 'fajobi40@gmail.com', 'aebc6c8282f2d822ae7be4565500f12d', '2021-09-05', 'confirmed', 'not member', ''),
(36, 'Mr', 'Abdulazeez', 'Ibrahim', '', 'male', '08161770959', 'Young Professional', '', 'img_20210831_180456~3.6134f3a0e1d325.61823666.jpg', 'ibrahimabdulazeez01@outlook.com', '5b3ee2a0a94b59572bd971606500fe97', '2021-09-05', 'confirmed', 'not member', ''),
(37, 'Engr', 'Victor', 'Okon', '', 'male', '08037999152', 'Corporate Professional', '', '', 'engrvik@gmail.com', 'ff6bb4532b54c8999539f905065ed720', '2021-09-05', 'confirmed', 'not member', ''),
(38, 'Mr.', 'Essential', 'Umana', '', 'male', '+2348039301808', 'Young Professional', '', '', 'essentialu7@gmail.com', '8b2256c4361fae8bdf6295d7ec3bbaab', '2021-09-05', 'confirmed', 'not member', ''),
(39, 'Engr', 'Abubakar', 'Hamzat', '', 'male', '08036841520', 'Corporate Professional', '', 'inbound2753038115305506556.6156cc795288f0.20262855.jpg', 'abubakarhamzat5@gmail.com', '2f490430fd529f5d2e3be090e0eb00fb', '2021-09-05', 'confirmed', 'not member', ''),
(40, 'Engr', 'Nyeche', 'Woke', '', 'male', '08035372177', 'Young Professional', '', '', 'mackihetz@gmail.com', '7a359cb434be858edbe80f37f4e19c02', '2021-09-06', 'confirmed', 'not member', ''),
(41, 'Mr', 'Bisan ', 'Yabuwat', '', 'male', '2348184695801', 'Young Professional', '', '', 'bbknest@yahoo.com', 'aa85e45da94cb0d78853c50ba636a15a', '2021-09-06', 'confirmed', 'not member', ''),
(42, 'Mr', 'Abdullateef', 'Ayodele', '', 'male', '08035869587', 'Young Professional', '', 'pa 003.6156ba73443e39.08224259.jpg', 'ayabdul20@gmail.com', 'c152c4aa1d3a42a8452055b76f4fbc2f', '2021-10-01', 'confirmed', 'not member', ''),
(43, 'Mr', 'Lucky', 'Damisah', '', 'male', '08037395867', 'Young Professional', '', 'img_20210531_115738.615711f3222bd7.10398068.jpg', 'luckydamisah@yahoo.com', '70ea3f65e280cfad63ff9d9df24780f2', '2021-10-01', 'confirmed', 'not member', ''),
(44, 'Mr', 'Salisu', 'Bashir', '', 'male', '08060635879', 'Young Professional', '', 'img_20210926_140928_3_1632661813617.61571ad04cb889.03125447.jpg', 'bsalisu2016@gmail.com', '8b3f55a9c3e4635e1183428dde365fac', '2021-10-01', 'confirmed', 'not member', ''),
(45, 'Engr', 'Hassan', 'Yahya', '', 'male', '+2347035709953', 'Corporate Professional', '', '', 'assaya@yahoo.com', 'bf46357b1b1e9450a373a28b5deef462', '2021-10-01', 'confirmed', 'not member', ''),
(46, 'Energy energy engineering', 'Mohammed Adamu', 'Idris', '', 'male', '+2348060557722', 'Corporate Professional', '', '', 'mohammedadamuidris@gmail.com', '66afa8c86ac3d0256e214634bc910b07', '2021-10-01', 'pending', 'not member', ''),
(47, 'Dr', 'Obinna', 'Adumanya', '', 'male', '08037730442', 'Young Professional', '', '', 'oadumanya@gmail.com', 'd0b19e4665a81f092eebb4bccc3cef54', '2021-10-01', 'confirmed', 'not member', ''),
(48, 'Engineer', 'Jacob', 'Bassey', '', 'male', '08035847070', 'Corporate Professional', '', '', 'jacurrba@yahoo.com', 'cb2cb3363fe25f9041df09155ac18696', '2021-10-01', 'confirmed', 'not member', ''),
(49, 'Mr', 'Levy', 'Andy Lassan', '', 'male', '07030360465', 'Undergraduate', '', 'img_20200604_180104_6.61575e1ee1eb44.09726944.jpg', 'lexxyconelioth@gmail.com', 'fec38bd74b46e401cf0bb0a552a85545', '2021-10-01', 'confirmed', 'not member', ''),
(50, 'Professor', 'Salisu', 'Muhammad Lawan', '', 'male', '08067783577', 'Corporate Professional', '', '16331586968893747103061214390427.6158064e78e8a9.73633574.jpg', 'salisumuhdlawan@gmail.com', '3b2721485630c13a2dc5e7f405db2344', '2021-10-02', 'confirmed', 'not member', ''),
(51, 'Tgst', 'Abdullahi', 'Yahaya Bamalli', '', 'male', '08036376110', 'Corporate Professional', '', '', 'ayahayabamalli@gmail.com', '759876f991a3ff14de0b03371e9e2865', '2021-10-02', 'confirmed', 'not member', ''),
(52, 'Dr', 'Okoyege', 'Lotanna', 'Okoye Lotanna', 'male', '08037447851', 'Young Professional', '', '', 'worldlotas@yahoo.com', '7d78e1af5823c9173fddac26f9fe0b99', '2021-10-02', 'pending', 'not member', ''),
(53, 'Mr', 'Oyeniyi ', 'Ojo ', '', 'male', '08058304872 ', 'Young Professional', '', '', 'ojoyeniyi@gmail.com', '6fdbff5bab92043d2acb64e8aedb5921', '2021-10-03', 'pending', 'not member', ''),
(54, 'Mr.', 'Aliyu', 'Shuaibu Abdul', '', 'male', '08066518829', 'Young Professional', '', 'passport photo.615951a8871508.76394376.jpg', 'aliyushuaibu69@gmail.com', 'c1e145fccf23f172a092b40d7fbb6d98', '2021-10-03', 'confirmed', 'not member', ''),
(55, 'Mr', 'Ntongha', 'Egwu', '', 'male', '08064013400', 'Young Professional', '', '', 'juliusdavegeol@yahoo.com', 'ba3ffe74f9ef946a2a11cfdef6af53ca', '2021-10-31', 'confirmed', 'not member', ''),
(56, 'Engr', 'Somtochukwu', 'Ifejika', '', 'male', '07031525786', 'Young Professional', '', '', 'noblesomto1@gmail.com', 'b16f4cca74765668e34ee05a66f22e7b', '2021-11-15', 'confirmed', 'not member', ''),
(57, 'Me', 'Kingsley', 'Emelogu ', '', 'male', '08030930382', 'Young Professional', '', '', 'emelogukingsley1@gmail.com', '15da5ac09ba0e509a48eab6843459757', '2021-11-27', 'confirmed', 'not member', ''),
(58, 'Engr.', 'Victor', 'Olaniyan', '', 'male', '+2348060336753', 'Young Professional', '', '', 'selvic198@gmail.com', '4e22fa66b8ba286171cab87e2dd91861', '2022-01-17', 'confirmed', 'not member', ''),
(59, 'Engr', 'Peter ', 'Uvietesivwi', '', 'male', '+2348032280601', 'Young Professional', '', 'passport.62431b044aafc7.44615158.jpeg', 'peterbanqwet@msn.com', 'aa190a66fdc6e26c6ff12255ab8878ae', '2022-03-29', 'confirmed', 'not member', ''),
(60, 'Sanitarian', 'Abdullahi', 'Muhammad Lawal', '', 'male', '+2347063072484', 'Young Professional', '', 'img_20200513_123156_706.624439a88f2c61.36981059.jpg', 'abdullahimuhammedlawal1990@gmail.com', '7e9d590a7f7332506f70b5b651b8f0cd', '2022-03-30', 'confirmed', 'not member', ''),
(61, 'Mr.', 'Adeyemi', 'Asaleye ', '', 'male', '08027189340', 'Young Professional', '', 'fb_img_1609605920319.62571e8d447f01.65074602.jpg', 'ashaym2000@yahoo.co.uk', 'c24d7f7445de5157a9fecac9cf1a455e', '2022-04-13', 'confirmed', 'not member', ''),
(62, 'Mrs', 'DAMILOLA', 'ASALEYE', '', 'female', '08034284936', 'Young Professional', '', '', 'queenasaleye@gmail.com', 'c24d7f7445de5157a9fecac9cf1a455e', '2022-04-13', 'pending', 'not member', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
