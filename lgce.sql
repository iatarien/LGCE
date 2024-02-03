-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 03, 2024 at 04:47 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lgce`
--

-- --------------------------------------------------------

--
-- Table structure for table `attestations`
--

DROP TABLE IF EXISTS `attestations`;
CREATE TABLE IF NOT EXISTS `attestations` (
  `id_att` int(11) NOT NULL AUTO_INCREMENT,
  `id_eng` int(11) NOT NULL,
  `causes` text NOT NULL,
  PRIMARY KEY (`id_att`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `att_total`
--

DROP TABLE IF EXISTS `att_total`;
CREATE TABLE IF NOT EXISTS `att_total` (
  `att_id` int(11) NOT NULL AUTO_INCREMENT,
  `ze_pay` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `mondat` varchar(50) DEFAULT NULL,
  `compte` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
CREATE TABLE IF NOT EXISTS `banks` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `entreprise` int(11) NOT NULL,
  `bank_acc` text NOT NULL,
  `bank` text NOT NULL,
  `bank_user` text NOT NULL,
  `bank_agc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `entreprise`, `bank_acc`, `bank`, `bank_user`, `bank_agc`) VALUES
(1, 2, '00300387000157430080', 'بنك الفلاحة و التنمية الريفية', 'EURL EL MADJED', 'اولاد جلال'),
(2, 3, '00500308400208460084', 'بنك التنمية المحلية', 'مؤسسة الأشغال العمومية والبناء - بدري جمال -', 'اولاد جلال'),
(3, 4, '001003870200004595/38', 'البنك الوطني الجزائري', 'مخبر ومكتب الدراسات التقنية للأشغال العمومية - بومعراف شهاب الدين -', 'بسكرة'),
(4, 5, '000500145400225301032', 'بنك التنمية المحلية', 'ETPH AMRANI ISLAM MOUSSA', 'تيزي وزو'),
(5, 6, '00400322401715130120', 'القرض الشعبي الجزائري', 'LTP SUD/EL OUED', 'EL OUED'),
(6, 7, '03200001065070120883', 'بنك الخليج الجزائري', 'SARL LMTPB', 'دالي إبراهيم الجزائر'),
(7, 1, '00400110400101941189', 'القرض الشعبي الجزائري', 'SARL SOTRACV', 'MEDEA'),
(8, 8, '00400117401715140176', 'القرض الشعبي الجزائري', 'الهيئة الوطنية للرقابة التقنية للأشعال العمومية CTTP', 'الجزائر'),
(9, 9, '00400315401715100109', 'القرض الشعبي الجزائري', 'المخبر المركزي للأشغال العمومية الجزائر LCTP', 'المسيلة'),
(10, 6, '00400322401715130120', 'القرض الشعبي الجزائري', 'LTP SUD/EL OUED', 'EL OUED'),
(11, 10, '00400402401740810168', 'القرض الشعبي الجزائري', 'شركة الدراسات التقنية وهران SETOR', 'حي السلام وهران'),
(12, 11, '00400307401748160146', 'القرض الشعبي الجزائري', 'شركة الدراسات وانجاز الأعمال الفنية للشرق -SERO-EST-باتنة', '307باتنة'),
(13, 11, '00400307401748160146', 'القرض الشعبي الجزائري', 'شركة الدراسات وانجاز الأعمال الفنية للشرق -SERO-EST-باتنة', '307باتنة'),
(14, 8, '00400117401715140176', 'القرض الشعبي الجزائري', 'الهيئة الوطنية للرقابة التقنية للأشعال العمومية CTTP', 'الجزائر'),
(15, 9, '00400315401715100109', 'القرض الشعبي الجزائري', 'المخبر المركزي للأشغال العمومية الجزائر LCTP', 'المسيلة'),
(16, 7, '03200001065070120883', 'بنك الخليج الجزائري', 'SARL LMTPB', 'دالي إبراهيم الجزائر'),
(17, 12, '301-005', 'سوسيتي جنرال', 'الفرع الوظيفي لتسيير الحظيرة والعتاد لمديرية الأشغال العمومية للأولاد جلال', 'اولاد جلال'),
(18, 2, '00300387000157430080', 'بنك الفلاحة و التنمية الريفية', 'EURL EL MADJED', 'اولاد جلال');

-- --------------------------------------------------------

--
-- Table structure for table `banques`
--

DROP TABLE IF EXISTS `banques`;
CREATE TABLE IF NOT EXISTS `banques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `abr` varchar(10) NOT NULL,
  `num` varchar(10) NOT NULL,
  `cle` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banques`
--

INSERT INTO `banques` (`id`, `nom`, `abr`, `num`, `cle`) VALUES
(1, 'البنك العربي الجزائري', 'ABC', '121', '20'),
(2, 'مصرف السلام الجزائري', 'BSA', '122', '17'),
(3, 'بنك بــاريس الجزائري', 'BNP', '124', '11'),
(4, 'بنك التنمية المحلية', 'BDL', '125', '08'),
(5, 'سوسيتي جنرال', 'SG', '126', '05'),
(6, 'بنك الخليج الجزائري', 'AGB', '127', '02'),
(7, 'بنك الفلاحة و التنمية الريفية', 'BADR', '131', '87'),
(8, 'بنك الجزائر الخارجي', 'BEA', '132', '84'),
(9, 'البنك الوطني الجزائري', 'BNA', '133', '81'),
(10, 'القرض الشعبي الجزائري', 'CPA', '134', '78'),
(11, 'الصندوق الوطني للتوفير و الاحتياط', 'CNEP', '452', '94'),
(13, 'حساب الخاص', 'الخاص', '3001', '005');

-- --------------------------------------------------------

--
-- Table structure for table `borderau`
--

DROP TABLE IF EXISTS `borderau`;
CREATE TABLE IF NOT EXISTS `borderau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borderau`
--

INSERT INTO `borderau` (`id`, `type`) VALUES
(1, 'pay'),
(2, 'pay'),
(3, 'eng');

-- --------------------------------------------------------

--
-- Table structure for table `bord_eng`
--

DROP TABLE IF EXISTS `bord_eng`;
CREATE TABLE IF NOT EXISTS `bord_eng` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bord` int(11) NOT NULL,
  `id_eng` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bord_eng`
--

INSERT INTO `bord_eng` (`id`, `id_bord`, `id_eng`) VALUES
(1, 3, 25);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id_comp` int(1) NOT NULL AUTO_INCREMENT,
  `ville` varchar(50) NOT NULL,
  `ville_fr` varchar(50) NOT NULL,
  `ministere` varchar(50) NOT NULL,
  `ministere_fr` varchar(100) NOT NULL,
  `direction` varchar(50) NOT NULL,
  `direction_fr` varchar(100) NOT NULL,
  `order_ville` varchar(50) NOT NULL,
  `code_ville` varchar(50) NOT NULL,
  `compte_tresor` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `pref_eng` varchar(10) NOT NULL,
  `license` date DEFAULT NULL,
  `lang` varchar(3) NOT NULL,
  PRIMARY KEY (`id_comp`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id_comp`, `ville`, `ville_fr`, `ministere`, `ministere_fr`, `direction`, `direction_fr`, `order_ville`, `code_ville`, `compte_tresor`, `year`, `pref_eng`, `license`, `lang`) VALUES
(1, 'أولاد جلال', 'Ouled Djellal', 'الأشغال العمومية و المنشآت القاعدية', 'Ministère des Travaux Publics et des Infrastructures de Base', 'الأشغال العمومية', 'Direction des Travaux Publics', '114.051.01', ' ', '307209/79', '2023', 'with_none', '2024-10-31', 'fr');

-- --------------------------------------------------------

--
-- Table structure for table `cp`
--

DROP TABLE IF EXISTS `cp`;
CREATE TABLE IF NOT EXISTS `cp` (
  `ze_op` int(11) NOT NULL,
  `montant_cp` double NOT NULL,
  `year` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

DROP TABLE IF EXISTS `deals`;
CREATE TABLE IF NOT EXISTS `deals` (
  `id_deal` int(11) NOT NULL AUTO_INCREMENT,
  `id_op` int(11) NOT NULL,
  `deal_type` varchar(25) NOT NULL,
  `deal_num` text,
  `deal_date` date DEFAULT NULL,
  `lot` text NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `montant` double NOT NULL,
  `entreprise` int(11) NOT NULL,
  `bank` int(11) NOT NULL,
  `duree` int(11) DEFAULT NULL,
  `taux` int(3) NOT NULL,
  `observations` text,
  `inserted_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_deal`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id_deal`, `id_op`, `deal_type`, `deal_num`, `deal_date`, `lot`, `parent`, `montant`, `entreprise`, `bank`, `duree`, `taux`, `observations`, `inserted_at`, `updated_at`, `user_id`) VALUES
(1, 3, 'عقد', '2241', '2023-10-10', 'الحصة رقم01: انجاز الطريق الاجتنابي لمدينة اولاد جلال من ن ك 00+000الى 09+450 على مسافة 9.45 كلم', 0, 209533823.5, 2, 1, 360, 0, '', '2023-12-10', '0000-00-00', 47),
(2, 4, 'صفقة', '17', '2023-12-27', 'صيانة الطريق البلدي رقم 72 على مستوى الدوسن', 0, 10892070, 3, 2, 60, 0, '', '2024-01-03', '0000-00-00', 47),
(3, 4, 'صفقة', '218', '2023-12-27', 'المراقبة النوعية لأشغال المشروع: صيانة الطريق البلدي رقم 72 على مستوى واد الدوسن', 0, 150000, 4, 3, 60, 0, '', '2024-01-03', '0000-00-00', 47),
(4, 5, 'عقد', '3351', '2023-12-13', 'تزويد ووضع الإشارات الأفقية على الطرق الوطنية على مسافة 83.5 كلم \r\n   - الطريق الوطني رقم 46 بين ن ك 000+194 و ن ك 000+219\r\n   - الطريق الوطني رقم 46 أ بين ن ك 200+56 و ن ك 700+114', 0, 5713134.07, 5, 4, 13, 0, '', '2024-01-03', '2024-01-04', 47),
(5, 5, 'عقد', '3352', '2023-12-13', 'المرقبة النوعية  لأشغال تزويد ووضع الإشارات الأفقية على الطرق الوطنية على مسافة 83.5 كلم \r\n\r\n   - الطريق الوطني رقم 46 بين ن ك 000+194 و ن ك 000+219\r\n\r\n   - الطريق الوطني رقم 46 أ بين ن ك 200+56 و ن ك 700+114', 0, 119238, 6, 5, 13, 0, '', '2024-01-03', '2024-01-07', 47),
(6, 5, 'عقد', '3403', '2023-12-17', 'الإلتزام بمشروع عقد المبرم مع SARL LMTPB الحصة رقم 02: دراسة الخبرة للمنشأ الفني على الطريق الوطني 46 أفي ن ك 97+200', 0, 1487500, 7, 6, 45, 0, '', '2024-01-03', '2024-01-04', 47),
(7, 3, 'عقد', '2242', '2023-10-10', 'الحصة رقم 02: انجاز الطريق الإجتنابي لولاية اولاد جلال من ن ك 09+750 الى ن ك 19+900 على مسافة 10.15 كلم SARL SOTRAVC', 0, 249645673.2, 1, 7, 330, 0, '', '2024-01-04', '2024-01-04', 47),
(8, 3, 'عقد', '2243', '0203-10-10', 'الحصة رقم 02: المتابعة ومطابقة الاشغال والمساعدة التقنية في اطار المشروع : انجاز الطريق الاجتنابي لمدينة اولاد جلال من ن ك 750+09 الى ن ك 900+19 على مسافة 10.15 كلم', 0, 2801260, 8, 8, 330, 0, '', '2024-01-04', '0000-00-00', 47),
(9, 3, 'عقد', '2244', '2023-10-10', 'الحصة رقم02:المراقبة النوعية للأشغال في اطار المشروع: انجاز الطريق الإجتنابي لمدينة اولاد جلال من ن ك750+09 الى ن ك 900+19 على مسافة 10.15 كلم', 0, 1112650, 9, 9, 330, 0, '', '2024-01-04', '0000-00-00', 47),
(10, 3, 'عقد', '2245', '2023-10-10', 'الحصة رقم 01: انجاز الطريق الإجتنابي لمدينة اولاد جلال من ن ك 000+00 الى ن ك 450+09 على مسافة 9.45 كلم', 0, 1142400, 6, 10, 360, 0, '', '2024-01-04', '0000-00-00', 47),
(11, 3, 'عقد', '2246', '2023-10-10', 'المتابعة والمطابقة الاشغال والمساعدة التقنية في اطار المشروع: الحصة رقم01: انجاز الطريق الإجتنابي لمدينة اولاد جلال من ن ك 000+00 الى ن ك 450+09 على مسافة 9.45 كلم', 0, 2856000, 10, 11, 360, 0, '', '2024-01-04', '0000-00-00', 47),
(14, 3, 'عقد', '2248', '2023-10-10', 'الإلتزام بمشروع عقد المتابعة ومطابقة الأشغال والمساعدة التقنية الحصة رقم 03: انجاز منشأ فني على مستوى واد الجدي مع المتعامل المتعاقد  - CTTP -', 0, 3552150, 8, 14, 450, 0, '', '2024-01-04', '0000-00-00', 47),
(13, 3, 'صفقة', '2247', '0023-10-10', 'الحصة رقم03: انجاز منشأفني على مستوى واد الجدي', 0, 374643654, 11, 13, 450, 0, '', '2024-01-04', '0000-00-00', 47),
(15, 3, 'عقد', '2249', '2023-10-10', 'الإلتزام بمشروع عقد مراقبة النوعية الحصة رقم 03: انجاز منشأ فني على مستوى واد الجدي على المتعامل المتعاقد - LCTP -', 0, 2356200, 9, 15, 450, 0, '', '2024-01-04', '0000-00-00', 47),
(16, 5, 'صفقة', '3404', '2023-12-17', 'الإلتزام بمشروع عقد المبرم مع SARL LMTPB الحصة رقم 01: دراسة الخبرة للمنشأ الفني على الطريق الوطني 46 أفي ن ك 80+050', 0, 1487500, 7, 16, 45, 0, '', '2024-01-04', '2024-01-07', 47),
(17, 5, 'عقد', '3405', '2023-10-10', 'كراء العتاد الداخلي لفرع الوظيفي لتسيير الحظيرة والعتاد لمديرية الأشغال العمومية لولاية اولاد جلال', 0, 9816967, 12, 17, 20, 0, '', '2024-01-07', '2024-01-07', 47),
(18, 5, 'عقد', '3406', '2023-10-10', 'كراء العتاد الخارجي من اجل صيانة الطرق الوطنية', 0, 971962.25, 2, 18, 30, 0, '', '2024-01-07', '0000-00-00', 47);

-- --------------------------------------------------------

--
-- Table structure for table `engagements`
--

DROP TABLE IF EXISTS `engagements`;
CREATE TABLE IF NOT EXISTS `engagements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_op` int(11) NOT NULL,
  `numero_fiche` varchar(255) NOT NULL,
  `real_sujet` text,
  `deal` int(11) DEFAULT NULL,
  `montant` double NOT NULL,
  `num_visa` int(11) DEFAULT NULL,
  `date_visa` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `inserted_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `engagements`
--

INSERT INTO `engagements` (`id`, `id_op`, `numero_fiche`, `real_sujet`, `deal`, `montant`, `num_visa`, `date_visa`, `user_id`, `type`, `inserted_at`, `updated_at`) VALUES
(1, 3, '2023/04', 'الإلتزام لمقرر تغيير هيكلة كلفة لعملية انجاز الطريق الإجتنابي لولاية اولاد جلال على مسافة 20 كلم الرقم الثابت 23024015101', 0, 0, 2404, '2023-10-10', 47, 'decision', '2023-12-10', '2024-01-04'),
(2, 3, '2023/01', 'الإلتزام بالحساب لمقرر التفريد لعملية الطريق الإجتنابي لولاية اولاد جلال على مسافة 20كلم', 0, 900000000, 2240, '2023-10-10', 47, 'reevaluation', '2023-12-10', '2024-01-04'),
(10, 3, '2023/03', 'عقد رقم 2242 بتاريخ 2023-10-10 المبرمة مع SARL SOTRACV لانجاز الطريق الاجتنابي لمدينة اولاد جلال على مسافة 20 كلم حصة : الحصة رقم 02: انجاز الطريق الإجتنابي لولاية اولاد جلال من ن ك 09+750 الى ن ك 19+900 على مسافة 10.15 كلم SARL SOTRAVC', 7, 0, 2242, '2023-10-10', 47, 'eng', '2024-01-04', '2024-01-04'),
(4, 4, '2023/01', 'الإلتزام بمشروع عقد مع مؤسسة بدري جمال - صيانة الطريق البلدي رقم 78 على مستوى واد الدوسن', 0, 10892070, 217, '2023-12-27', 47, 'decision', '2024-01-03', '2024-01-03'),
(5, 5, '0', '.', 4, 0, 0, '0000-00-00', 47, 'eng', '2024-01-03', '2024-01-07'),
(6, 5, '2023/03', 'الإلتزام بمشروع عقد الصيانة الدورية المبرم مع مؤسسة LTP SUD مراقبة نوعية  الأشغال   للإشارات الطرق و حذف النقاط السوداء  الطرق الوطنية على مسافة 83.5 كلم \r\n   - الطريق الوطني رقم 46 بين ن ك 000+194 و ن ك 000+219\r\n   - الطريق الوطني رقم 46 أ بين ن ك 200+56 و ن ك 700+114', 5, 119238, 3351, '2023-12-13', 47, 'eng', '2024-01-03', '2024-01-07'),
(7, 4, '2023/02', 'صفقة رقم 218 بتاريخ 2023-12-27 المبرمة مع مخبر ومكتب الدراسات التقنية للأشغال العمومية - بومعراف شهاب الدين - لصيانة الطرق البلدية -شطر-2022- حصة : المراقبة النوعية لأشغال المشروع: صيانة الطريق البلدي رقم 72 على مستوى واد الدوسن', 3, 0, 218, '2023-12-12', 47, 'eng', '2024-01-03', '0000-00-00'),
(8, 4, '2023/03', 'صفقة رقم 17 بتاريخ 2023-12-27 المبرمة مع مؤسسة الأشغال العمومية والبناء - بدري جمال - لصيانة الطرق البلدية -شطر-2022- حصة : صيانة الطريق البلدي رقم 72 على مستوى الدوسن', 2, 0, 217, '2023-12-27', 47, 'eng', '2024-01-03', '0000-00-00'),
(9, 5, '2023/02', 'بمشروع عقد الصيانة الدورية المبرم مع مؤسسة تزويد EGTPH AMRANI ISLAM MOUSSA ووضع الإشارات الأفقية على الطرق الوطنية على مسافة 83.5 كلم \r\n   - الطريق الوطني رقم 46 بين ن ك 000+194 و ن ك 000+219\r\n   - الطريق الوطني رقم 46 أ بين ن ك 200+56 و ن ك 700+114', 4, 5713134.07, 3349, '2023-12-13', 47, 'eng', '2024-01-03', '2024-01-07'),
(11, 3, '2023/02', 'عقد رقم 2241 بتاريخ 2023-10-10 المبرمة مع EURL EL MADJED لانجاز الطريق الاجتنابي لمدينة اولاد جلال على مسافة 20 كلم حصة : الحصة رقم01: انجاز الطريق الاجتنابي لمدينة اولاد جلال من ن ك 00+000الى 09+450 على مسافة 9.45 كلم', 1, 0, 2241, '2023-10-10', 47, 'eng', '2024-01-04', '2024-01-04'),
(12, 3, '2023/02', 'عقد رقم 2241 بتاريخ 2023-10-10 المبرمة مع EURL EL MADJED لانجاز الطريق الاجتنابي لمدينة اولاد جلال على مسافة 20 كلم حصة : الحصة رقم01: انجاز الطريق الاجتنابي لمدينة اولاد جلال من ن ك 00+000الى 09+450 على مسافة 9.45 كلم', 1, 209553823.5, 2241, '2023-10-10', 47, 'eng', '2024-01-04', '2024-01-04'),
(13, 3, '2023/03', 'عقد رقم 2242 بتاريخ 2023-10-10 المبرمة مع SARL SOTRACV لانجاز الطريق الاجتنابي لمدينة اولاد جلال على مسافة 20 كلم حصة : الحصة رقم 02: انجاز الطريق الإجتنابي لولاية اولاد جلال من ن ك 09+750 الى ن ك 19+900 على مسافة 10.15 كلم SARL SOTRAVC', 7, 249645673.2, 2242, '2023-10-10', 47, 'eng', '2024-01-04', '2024-01-04'),
(14, 3, '2023/04', 'عقد رقم 2243 بتاريخ 0203-10-10 المبرمة مع الهيئة الوطنية للرقابة التقنية للأشعال العمومية CTTP لانجاز الطريق الاجتنابي لمدينة اولاد جلال على مسافة 20 كلم حصة : الحصة رقم 02: المتابعة ومطابقة الاشغال والمساعدة التقنية في اطار المشروع : انجاز الطريق الاجتنابي لمدينة اولاد جلال من ن ك 750+09 الى ن ك 900+19 على مسافة 10.15 كلم', 8, 2801260, 2405, '2023-12-17', 47, 'eng', '2024-01-04', '0000-00-00'),
(15, 3, '2023/05', 'عقد رقم 2244 بتاريخ 2023-10-10 المبرمة مع المخبر المركزي للأشغال العمومية الجزائر LCTP لانجاز الطريق الاجتنابي لمدينة اولاد جلال على مسافة 20 كلم حصة : الحصة رقم02:المراقبة النوعية للأشغال في اطار المشروع: انجاز الطريق الإجتنابي لمدينة اولاد جلال من ن ك750+09 الى ن ك 900+19 على مسافة 10.15 كلم', 9, 1112650, 2409, '2023-10-17', 47, 'eng', '2024-01-04', '0000-00-00'),
(16, 3, '2023/06', 'عقد رقم 2245 بتاريخ 2023-10-10 المبرمة مع LTP SUD/EL OUED لانجاز الطريق الاجتنابي لمدينة اولاد جلال على مسافة 20 كلم حصة : الحصة رقم 01: انجاز الطريق الإجتنابي لمدينة اولاد جلال من ن ك 000+00 الى ن ك 450+09 على مسافة 9.45 كلم', 10, 1142400, 2403, '2023-10-17', 47, 'eng', '2024-01-04', '0000-00-00'),
(17, 3, '2023/07', 'عقد رقم 2246 بتاريخ 2023-10-10 المبرمة مع شركة الدراسات التقنية وهران SETOR لانجاز الطريق الاجتنابي لمدينة اولاد جلال على مسافة 20 كلم حصة : المتابعة والمطابقة الاشغال والمساعدة التقنية في اطار المشروع: الحصة رقم01: انجاز الطريق الإجتنابي لمدينة اولاد جلال من ن ك 000+00 الى ن ك 450+09 على مسافة 9.45 كلم', 11, 2856000, 2402, '2023-10-17', 47, 'eng', '2024-01-04', '2024-01-04'),
(18, 3, '2023/08', 'عقد رقم 2247 بتاريخ 2023-10-10 المبرمة مع شركة الدراسات وانجاز الأعمال الفنية للشرق -SERO-EST-باتنة لانجاز الطريق الاجتنابي لمدينة اولاد جلال على مسافة 20 كلم حصة : الحصة رقم 03: انجاز منشأ فني على مستوى واد الجدي', 12, 374643654, 3965, '2023-12-31', 47, 'eng', '2024-01-04', '0000-00-00'),
(19, 3, '2023/10', 'الإلتزام بمشروع صفقة الحصة رقم03: انجاز منشأ فني على مستوى واد الجدي مع المتعامل المتعاقد - SERO OST - باتنة', 13, 374643654, 3965, '2023-12-31', 47, 'eng', '2024-01-04', '2024-01-04'),
(20, 3, '2023/11', 'الإلتزام بمشروع عقد المتابعة ومطابقة الأشغال والمساعدة التقنية الحصة رقم 03: انجاز منشأ فني على مستوى واد الجدي مع المتعامل المتعاقد  - CTTP -', 14, 3552150, 3964, '2023-12-31', 47, 'eng', '2024-01-04', '2024-01-04'),
(21, 3, '2023/12', 'الإلتزام بمشروع عقد مراقبة النوعية الحصة رقم 03: انجاز منشأ فني على مستوى واد الجدي مع المتعامل المتعاقد - LCTP -', 15, 2356200, 3962, '2023-12-31', 47, 'eng', '2024-01-04', '2024-01-04'),
(22, 5, '2023/05', 'الإلتزام بمشروع عقد المبرم مع SARL LMTPB الحصة رقم 02: دراسة الخبرة للمنشأ الفني على الطريق الوطني 46 أفي ن ك 97+200', 6, 1487500, 3403, '2023-12-17', 47, 'eng', '2024-01-04', '2024-01-07'),
(23, 5, '2023/06', 'الإلتزام كراء العتاد الداخلي لفرع الوظيفي لتسيير الحظيرة والعتاد لمديرية الأشغال العمومية لولاية اولاد جلال', 17, 9816967, 22, '2023-12-17', 47, 'eng', '2024-01-07', '2024-01-07'),
(24, 5, '2023/07', 'الإلتزام كراء العتاد الخارجي من اجل صيانة الطرق الوطنية مع المتعامل eurl société el madjed de grandes réalisatoin', 18, 971962.25, 0, '2023-02-01', 47, 'eng', '2024-01-07', '0000-00-00'),
(25, 5, '2023/07', '.', 18, 0, 0, '0000-00-00', 47, 'eng', '2024-01-07', '2024-01-07'),
(26, 5, '2023/04', 'الإلتزام بمشروع عقد المبرم مع SARL LMTPB الحصة رقم 01: دراسة الخبرة للمنشأ الفني على الطريق الوطني 46 أفي ن ك 80+050', 16, 1487500, 3404, '2023-12-17', 47, 'eng', '2024-01-07', '2024-01-07'),
(27, 2, '2023/01', 'التفريد', NULL, 10000000, NULL, NULL, 47, 'decision', '2024-01-13', NULL),
(28, 2, '2023/02', 'gjhgfj', NULL, -123000, NULL, NULL, 47, 'decision', '2024-01-13', NULL),
(29, 5, '05', 'عقد N° 3406 du : 2023-10-10 lot : كراء العتاد الخارجي من اجل صيانة الطرق الوطنية\r\n\r\nEntreprise : EURL EL MADJED', 18, 1200000, NULL, NULL, 47, 'eng', '2024-02-02', '2024-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

DROP TABLE IF EXISTS `entreprises`;
CREATE TABLE IF NOT EXISTS `entreprises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `nature` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`id`, `name`, `nature`) VALUES
(1, 'SARL SOTRACV', 'company'),
(2, 'EURL EL MADJED', 'company'),
(3, 'مؤسسة الأشغال العمومية والبناء - بدري جمال -', 'company'),
(4, 'مخبر ومكتب الدراسات التقنية للأشغال العمومية - بومعراف شهاب الدين -', 'bet'),
(5, 'ETPH AMRANI ISLAM MOUSSA', 'company'),
(6, 'LTP SUD/EL OUED', 'bet'),
(7, 'SARL LMTPB', 'bet'),
(8, 'الهيئة الوطنية للرقابة التقنية للأشعال العمومية CTTP', 'bet'),
(9, 'المخبر المركزي للأشغال العمومية الجزائر LCTP', 'bet'),
(10, 'شركة الدراسات التقنية وهران SETOR', 'bet'),
(11, 'شركة الدراسات وانجاز الأعمال الفنية للشرق -SERO-EST-باتنة', 'company'),
(12, 'الفرع الوظيفي لتسيير الحظيرة والعتاد لمديرية الأشغال العمومية للأولاد جلال', 'company');

-- --------------------------------------------------------

--
-- Table structure for table `leve_main`
--

DROP TABLE IF EXISTS `leve_main`;
CREATE TABLE IF NOT EXISTS `leve_main` (
  `id_main` int(11) NOT NULL AUTO_INCREMENT,
  `id_eng` int(11) NOT NULL,
  `montant` double NOT NULL,
  `pvs` text NOT NULL,
  `extra` text NOT NULL,
  PRIMARY KEY (`id_main`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ods`
--

DROP TABLE IF EXISTS `ods`;
CREATE TABLE IF NOT EXISTS `ods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_eng` int(11) NOT NULL,
  `real_type` varchar(50) DEFAULT NULL,
  `ods_num` int(11) NOT NULL,
  `ods_date` date NOT NULL,
  `cause` text,
  `duree` int(11) DEFAULT NULL,
  `type_ods` text NOT NULL,
  `extra_type` text NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ods`
--

INSERT INTO `ods` (`id`, `id_eng`, `real_type`, `ods_num`, `ods_date`, `cause`, `duree`, `type_ods`, `extra_type`, `user`) VALUES
(2, 8, 'd', 1, '2024-01-03', '', 0, 'إنطلاق الأشغال', 'الأشغال', 48),
(3, 7, 'd', 2, '2024-01-03', '', 0, 'إنطلاق الأشغال', 'الأشغال', 48),
(4, 19, 'd', 3, '2024-01-07', '', 0, 'إنطلاق الأشغال', 'الأشغال', 48),
(5, 21, 'd', 4, '2024-01-07', '', 0, 'إنطلاق الأشغال', 'الأشغال', 48),
(6, 20, 'd', 5, '2024-01-07', '', 0, 'إنطلاق الأشغال', 'الأشغال', 48);

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

DROP TABLE IF EXISTS `operations`;
CREATE TABLE IF NOT EXISTS `operations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) NOT NULL,
  `intitule` text,
  `intitule_ar` text,
  `portefeuille` varchar(255) DEFAULT NULL,
  `programme` varchar(100) DEFAULT NULL,
  `sous_programme` varchar(100) DEFAULT NULL,
  `activite` varchar(50) NOT NULL,
  `annee` varchar(15) NOT NULL,
  `date` date DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `AP_init` double DEFAULT NULL,
  `reevaluation` double DEFAULT NULL,
  `AP_act` double DEFAULT NULL,
  `num_cloture` varchar(20) DEFAULT NULL,
  `date_cloture` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`id`, `numero`, `intitule`, `intitule_ar`, `portefeuille`, `programme`, `sous_programme`, `activite`, `annee`, `date`, `source`, `AP_init`, `reevaluation`, `AP_act`, `num_cloture`, `date_cloture`, `user_id`) VALUES
(1, 'N1.024.090.01.2051.23.01', '', 'انجاز الطريق الإجتنابي لمدينة اولاد جلال على مسافة 20كلم', '024', '090', '300', '2051', '23.01', '2023-09-18', 'PSC', 90000000, 0, 90000000, '', NULL, 47),
(2, 'N1.024.090.01.2051.23.01', '', 'انجاز الطريق الإجتنابي لمدينة اولاد جلال على مسافة 20كلم', '024', '090', '300', '2051', '23.01', '2023-09-18', 'PSC', 459200000, 0, 459200000, '', NULL, 47),
(3, 'N1.024.090.01.2051.000.051.23.001', 'الالتزام بمشروع صفقة الحصة رقم 01 انجاز الطريق الاجتنابي لولاية اولاد جلال من ن ك 00+000 الى ن ك 09+450 على مسافة 9.45 كلم', 'انجاز الطريق الاجتنابي لمدينة اولاد جلال على مسافة 20 كلم', '024', '090', '300', '2051.000', '051.23.001', NULL, 'PSC', 0, 3600000000, 3600000000, '012', '2024-01-25', 47),
(4, '024.090.02.4051.000.051', '', 'صيانة الطرق البلدية -شطر-2022-', '024', '090', '300', '4051', '000.051', '2023-12-26', 'PSD', 298905000, 0, 298905000, '', NULL, 47),
(5, 'N1.024.090.02.2051.000.051.23.002', 'Entretien des routes nationales tranche 2023', 'صيانة الطرق الوطنية - شطر 2023-', '024', '090', '300', '2051.000.051', '23.002', NULL, 'PSC', 48000000, 0, 48000000, NULL, NULL, 47);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `etude_done` double DEFAULT NULL,
  `non_termine_done` double DEFAULT NULL,
  `extra_done` double DEFAULT NULL,
  `avan_done` double NOT NULL,
  `revision_done` double DEFAULT NULL,
  `assurance_done` double DEFAULT NULL,
  `avancement_done` double DEFAULT NULL,
  `sanction_done` double DEFAULT NULL,
  `total_done` double DEFAULT NULL,
  `etude_cut` double DEFAULT NULL,
  `non_termine_cut` double DEFAULT NULL,
  `extra_cut` double DEFAULT NULL,
  `avan_cut` int(11) NOT NULL,
  `revision_cut` double DEFAULT NULL,
  `assurance_cut` double DEFAULT NULL,
  `avancement_cut` double DEFAULT NULL,
  `sanction_cut` double DEFAULT NULL,
  `total_cut` double DEFAULT NULL,
  `old_payments` double DEFAULT NULL,
  `new_payment` double DEFAULT NULL,
  `this_year_cut` double DEFAULT NULL,
  `to_pay` double DEFAULT NULL,
  `num` varchar(100) NOT NULL,
  `date_pay` date NOT NULL,
  `travaux_type` varchar(25) DEFAULT NULL,
  `travaux_num` text,
  `id_eng` int(11) NOT NULL,
  `year` varchar(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fiche_pay` varchar(10) DEFAULT NULL,
  `rebrique` int(30) DEFAULT NULL,
  `visa` date DEFAULT NULL,
  `num_visa` varchar(20) DEFAULT NULL,
  `inserted_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `etude_done`, `non_termine_done`, `extra_done`, `avan_done`, `revision_done`, `assurance_done`, `avancement_done`, `sanction_done`, `total_done`, `etude_cut`, `non_termine_cut`, `extra_cut`, `avan_cut`, `revision_cut`, `assurance_cut`, `avancement_cut`, `sanction_cut`, `total_cut`, `old_payments`, `new_payment`, `this_year_cut`, `to_pay`, `num`, `date_pay`, `travaux_type`, `travaux_num`, `id_eng`, `year`, `user_id`, `fiche_pay`, `rebrique`, `visa`, `num_visa`, `inserted_at`, `updated_at`) VALUES
(11, 26000000, 0, 0, 0, 0, 0, 0, 0, 26000000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 26000000, 0, 26000000, '01', '2024-02-01', 'وضعية الأشغال', '01', 13, '2023', 47, '', 11, '2023-01-03', '3435', '2024-01-07', '0000-00-00'),
(10, 2600000, 0, 0, 0, 0, 0, 0, 0, 2600000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2600000, 0, 2600000, '121454547777', '2024-01-01', 'وضعية الأشغال', '01', 12, '2023', 47, '', 10, '2024-01-01', '3942', '2024-01-04', '0000-00-00'),
(9, 26000000, 0, 0, 0, 0, 0, 0, 0, 26000000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 26000000, 0, 26000000, '101122577777', '2024-01-01', 'وضعية الأشغال', '01', 11, '2023', 47, '', 9, '2023-12-31', '3962', '2024-01-04', '0000-00-00'),
(8, 5000000, 0, 0, 0, 0, 0, 0, 0, 5000000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5000000, 0, 5000000, '02', '2023-12-27', 'وضعية الأشغال', '01', 5, '2023', 47, '', 8, '2024-01-03', '3349', '2024-01-03', '0000-00-00'),
(7, 5000000, 713134.07, 0, 0, 0, 0, 0, 0, 5713134.07, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5713134.07, 0, 5713134.07, '0102120212024231024202', '0000-00-00', 'وضعية الأشغال', '01', 5, '2023', 47, '', 7, '2024-01-02', '01', '2024-01-03', '0000-00-00'),
(12, 26000000, 0, 0, 0, 0, 0, 0, 0, 26000000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 26000000, 0, 26000000, '01', '2023-03-11', 'وضعية الأشغال', '01', 13, '2023', 47, '', 12, '2024-01-01', '0101', '2024-01-08', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `penalite`
--

DROP TABLE IF EXISTS `penalite`;
CREATE TABLE IF NOT EXISTS `penalite` (
  `id_pen` int(11) NOT NULL AUTO_INCREMENT,
  `the_pay` int(11) NOT NULL,
  `html` text NOT NULL,
  PRIMARY KEY (`id_pen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `portefeuille`
--

DROP TABLE IF EXISTS `portefeuille`;
CREATE TABLE IF NOT EXISTS `portefeuille` (
  `code` varchar(10) NOT NULL,
  `ministere` text NOT NULL,
  `ministere_fr` text,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `portefeuille`
--

INSERT INTO `portefeuille` (`code`, `ministere`, `ministere_fr`) VALUES
('003', 'الدفاع الوطني', 'Défense Nationale '),
('005', 'الداخلية و الجماعات المحلية', 'lntérieur, Collectivités Locales et Aménagement du Territoire '),
('011', 'التربية الوطنية', 'Education Nationale'),
('012', 'التعليم العالي و البحث العلمي', 'Enseignement Supérieur et Recherche Scientifique'),
('004', 'الشؤون الخارجية والجالية الوطنية بالخارج', 'Affaires Etrangères et Communauté Nationale à l\' Etianger '),
('006', 'العدل', 'Justice '),
('007', 'المالية', 'Finances '),
('008', 'الطاقة والمناجم', 'Energie et Mines '),
('009', 'المجاهدين وذوي الحقوق', 'Moudjahidine et Ayants Droit '),
('010', 'الشؤون الدينية والاوقاف', 'Affaires Religieuses et des WaKfs'),
('013', 'التعليم والتكوين المهنيين', 'Formation et Enseignement professionnels'),
('014', 'الثقافة والفنون', 'Culture et Arts'),
('015', 'الشباب والرياضة', 'Jeunesse et des sports'),
('016', 'الرقمنة والاحصائيات', 'Numérisation et Statistiques '),
('017', 'البريد والمواصلات السلكية واللاسلكية', 'Poste et Télécommunications'),
('018', 'التضامن الوطني والاسرة وقضايا المرأة', 'Solidarité Nationale , Famille et condition de la femme '),
('019', 'الصناعة', 'Industrie'),
('020', 'الفلاحة التنمية الريفية', 'Agriculture et Développement Rural '),
('021', 'السكن والعمران والمدينة', 'Habitat, Urbanisme de la ville '),
('022', 'التجارة وترقية الصادرات', 'Commerce et Promotion des Exportations '),
('023', 'الاتصال', 'Communication '),
('024', 'الآشغال العمومية و المنشآت القاعدية', 'Travaux publics, Hydraulique et lnfrastrucres de Base '),
('025', 'النقل', 'Transports '),
('026', 'السياحة والصناعة التقليدية', 'Tourisme et Artisanat '),
('027', 'الصحة', 'Santé '),
('028', 'العمل والتشغيل والضمان الاجتماعي', 'Travail de l\'Emploi et de la Sécurité Sociale '),
('029', 'العلاقات مع البرلمان', 'Relations avec le parlement '),
('030', 'الصيد البحري والمنتجات الصيدية', 'Environnement et Energies Renouvelables'),
('032', 'الصناعة الصيدلانية ', 'lndustrie pharmaceutique '),
('033', 'وزارة الاقتصاد المعرفة والمؤسسات الناشئة والمؤسسات الصغرة', 'Economie de la Connaissance , Startups et Micro Entreprises ');

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

DROP TABLE IF EXISTS `programme`;
CREATE TABLE IF NOT EXISTS `programme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `designation` text NOT NULL,
  `designation_fr` text,
  `parent` varchar(100) DEFAULT NULL,
  `portefeuille` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=370 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`id`, `code`, `designation`, `designation_fr`, `parent`, `portefeuille`) VALUES
(1, '044', 'التعليم القاعدي', 'Enseignement de base', '', '011'),
(2, '045', 'التعليم الثانوي', 'Enseignement secondaire', '', '011'),
(3, '046', 'التكوين', 'Formation', '', '011'),
(4, '047', 'الحيات المدرسية و التحويلات الاجتماعية', 'Vie scolaire et transferts sociaux', '', '011'),
(5, '048', 'الإدارة العامة', 'Administration générale ', '', '011'),
(6, '049', 'التعليم و التكوين العاليين', 'Enseignement et formation supérieurs', '', '012'),
(7, '01', 'التربية التحضيرية و الإبتدائية', 'Enseignement préparatoire et primaire', '044', '011'),
(8, '02', 'التعليم المتوسط العادي و المتخصص', 'Enseignement moyen normal et spécifique', '044', '011'),
(9, '03', 'التعليم المتوسط عن بعد', 'Enseignement moyen à distance', '044', '011'),
(10, '04', 'محو الأمية', 'Alphadétisation', '044', '011'),
(11, '01', 'التعليم الثانوي العادي  و المتخصص', 'Enseignement secondaire normal , spécifique et spécialisé', '045', '011'),
(12, '02', 'التعليم الثانوي عن بعد', 'Enseignement secondaire à distance', '045', '011'),
(13, '01', 'الطور الأول و الثاني للتعليم', '1er et 2eme cycles d\' enseignement', '049', '012'),
(14, '009', 'الدفاع الوطني', 'Décfense Nationale ', '', '003'),
(15, '010', 'اللوجستيك و الدعم متعدد الأشكال', 'Logistique et soutien multiforme ', '', '003'),
(16, '039', 'الحماية الاجتماعية', 'protection sociale', '', '009'),
(17, '040', 'الادارة العامة', 'Administration générale ', '', '009'),
(18, '041', 'الشؤون الديني والثقافية الاسلامية', 'Orientation religieuses et culture islamique', '', '010'),
(19, '042', 'التكوين والتعليم القرأني', 'Formation et enseignement coranique', '', '010'),
(20, '043', 'الادارة العامة', 'Administration générale ', '', '010'),
(21, '050', 'البحث العلمي والتطوير التكنولوجي', 'Recherche scientifique et développement technologique', '', '012'),
(22, '051', 'الحياة الطلابية', 'Vie estudiantine', '', '012'),
(23, '052', 'الادارة العامة', 'Administration générale ', '', '012'),
(24, '053', 'التكوين المهني', 'Formation professionnelle', '', '013'),
(25, '054', 'التعليم المهني', 'Enseignement professionnel', '', '013'),
(26, '055', 'الآدارة العامة', 'Administration générale ', '', '013'),
(27, '056', 'الفنون والاداب', 'Arts et Lettres', '', '014'),
(28, '057', 'التراث الثقافي', 'patrimoine culturel', '', '014'),
(29, '058', 'الادارة العامة', 'Administration générale ', '', '014'),
(30, '059', 'الشباب', 'Jeunesse ', '', '015'),
(31, '060', 'الرياضة', 'Sports', '', '015'),
(32, '061', 'الادارة العامة', 'Administration générale ', '', '015'),
(33, '062', 'تطوير الرقمنة', 'Developpement de Numérisation', '', '016'),
(34, '063', 'المنظومة الوطنية للآحصاء', 'Systéme national des statistiques ', '', '016'),
(35, '064', 'الآدارة العامة', 'Programme 3, Administration Générale', '', '016'),
(36, '065', 'تطوير الخدمات البريدية', 'Développement des services postaux', '', '017'),
(37, '066', 'تطوير المواصلات السلكية واللاسلكية', 'Développcmcnt des télécommunications', '', '017'),
(38, '067', 'بناء مجتمع المعلومات الجزائري', 'Edfication de la société algérienne de l\'information ', '', '017'),
(39, '068', 'الادارة العامة', 'Administration Générale ', '', '017'),
(40, '069', 'الآشخاص المعوقين', 'personnes Handicapées ', '', '018'),
(41, '070', 'الاسرة وقضايا المرأة', 'Famille et condition de la femme ', '', '018'),
(42, '071', 'التنمية الاجتماعية والنشاط الآنساني', 'Développement social et Action humanitaire ', '', '018'),
(43, '072', 'الادارة العامة', 'Administration générale ', '', '018'),
(44, '073', 'المنافسة والتطوير الصناعي', 'Compétitivité et Développement lndustriels ', '', '019'),
(45, '074', 'دعم الآستثمار', 'Appui à l\' investissement ', '', '019'),
(46, '075', 'الادارة العامة', 'Administration Générale ', '', '019'),
(47, '076', 'الفلاحة والتنمية الريفية ', 'Agriculture et développement rural ', '', '020'),
(48, '077', 'الغابات', 'Forets ', '', '020'),
(49, '078', 'الادارة العامة', 'Administration Générale ', '', '020'),
(50, '079', 'السكن', 'Logement ', '', '021'),
(51, '080', 'التهيئة والتعمير', 'Urbanisme et aménagement ', '', '021'),
(52, '081', 'المدن والمدن الجديدة', 'villes et villes nouvelles ', '', '021'),
(53, '082', 'التجهيزات العمومية', 'Equipement public ', '', '021'),
(54, '083', 'الادارة العامة', 'Administration générale ', '', '021'),
(55, '084', 'ضبط وترقية المنافسة', 'Régulation et promotion de la Concurrence ', '', '022'),
(56, '085', 'حماية المستهللك', 'protection du consommateur ', '', '022'),
(57, '086', 'تأطير المبادلات التجارية والترقية الصادرات', 'Encadrement des Echanges Commerciaux et promotion des Exportations', '', '022'),
(58, '087', 'الادارة العامة', 'Administration Générale ', '', '022'),
(59, '088', 'الاعلام والاتصال المؤسساتي', 'Médias et Communication institutionnelle ', '', '023'),
(60, '089', 'الادارة العامة', 'Administration Générale ', '', '023'),
(61, '090', 'المنشئات الآساسية للطرق والظرق السيارة', 'lnfrastructures routiéres et autoroutiéres ', '', '024'),
(62, '091', 'المنشئات الآساسية المطارية', 'lnfrastructures aéroportuaires ', '', '024'),
(63, '092', 'المنشئات الآساسية البحرية', 'lnfrasttucturures maritimes ', '', '024'),
(64, '093', 'حشد المواردالمائية والآمن المائي', 'Mobilisation des ressources en eau et de la sécurité hydrique ', '', '024'),
(65, '094', 'التزويد بالمياه الصالحة للشرب والمياه الصناعية', 'Approvisionnemnt en eau potable et industrelle ', '', '024'),
(66, '095', 'الري الفلاحي', 'Hydraulique agricole ', '', '024'),
(67, '096', 'التطهير وحماية البيئة الطبيعية', 'Assainissement et protection du milieu naturel ', '', '024'),
(68, '097', 'الادارة العامة', 'Administration générale ', '', '024'),
(69, '098', 'الحركية واللوجيستية', 'Mobilité et logistique ', '', '025'),
(70, '099', 'البحرية التجارية والموانئ', 'Marine marchande et ports ', '', '025'),
(71, '100', 'الطيران والارصاد الجوية', 'Aéronautique et météorologie ', '', '025'),
(72, '101', 'الادارة العامة', 'Administraion générale ', '', '025'),
(73, '102', 'السياحة', 'Tourisme ', '', '026'),
(74, '103', 'الصناعة التقليدية والحرف', 'Artisanat et métiers ', '', '026'),
(75, '104', 'الادارة العامة', 'Administation générale ', '', '026'),
(76, '105', 'الوقاية والعلاجات ', 'prévention et soins ', '', '027'),
(77, '106', 'التكوين في مجال الصحة', 'formation dans la domaine de la santé ', '', '027'),
(78, '107', 'الادارة العامة', 'Administration générale ', '', '027'),
(79, '108', 'المفتيشة العامة للعمل', 'lnspecrtion Générale du Travail ', '', '028'),
(80, '109', 'تدعيم والتطوير التشغيل', 'Soutien et promtoion de l\'emploi ', '', '028'),
(81, '110', 'نظام الحماية الاجتماعية', 'Systéme de protection sociale ', '', '028'),
(82, '111', 'الادارة العامة', 'Administration générale ', '', '028'),
(83, '112', 'متابعة العمل البرلماني', 'Renforcemcnt des relations entre le Gouvemement et le parlement ', '', '029'),
(84, '113', 'الادارة العامة', 'Administration générale ', '', '029'),
(85, '114', 'البيئة والتنمية المستدامة', 'Environnement et développement durable ', '', '030'),
(86, '115', 'الطاقات المتجددة', 'Energies renouvelables ', '', '030'),
(87, '116', 'الادارة العامة', 'Administration Générale ', '', '030'),
(88, '117', 'الصيد البحري', 'peche maritime ', '', '031'),
(89, '118', 'تربية المانيات', 'Aquaculture ', '', '031'),
(90, '119', 'مراقبة الآنشطة ونوعية منتجات الصيد البحري', 'Contrôle des activités et de la qualité des produits de la peche et de l\'aquaculture ', '', '031'),
(91, '120', 'الادارة العامة', 'Administration générale ', '', '031'),
(92, '121', 'تنمية وتطوير الصناعية الصيدلانية', 'Développement et promtoion de l\' lndustrie pharmaceutique en Algerie ', '', '032'),
(93, '122', 'الادارة العامة', 'Administration Générale ', '', '032'),
(94, '123', 'ترقية اقتصاد المعرفة و المؤسسات الناشئة و المؤسسات المصغرة', 'promoton de l\'économine de la connaissance, des startup et de l\' entreprenariat ', '', '033'),
(95, '124', 'الادارة العامة', 'Administration Générale', '', '033'),
(96, '011', 'الادارة العامة', 'Adminisiration Générale ', '', '003'),
(97, '012', 'النشاط الدبلوماسي والقنصلي', 'Activité diplomatique et consulaire ', '', '004'),
(98, '013', 'الادارة العامة', 'Adminisiration Générale ', '', '004'),
(99, '014', 'حركة الاشخاص والممتلكات', 'Circulation des personnes et des biens ', '', '005'),
(100, '015', 'دعم الجماعات المحلية', 'Soutien aux Collectivités locales ', '', '005'),
(101, '016', 'تهيئة الاقليم', 'Aménagement du territoire ', '', '005'),
(102, '017', 'الامن الوطني', 'Sureté Nationale ', '', '005'),
(103, '018', 'الحماية المدنية', 'Protection civile ', '', '005'),
(104, '019', 'المواصلات السلكية واللاسلكية الوطنية', 'Transimissions Nationales', '', '005'),
(105, '020', 'الادارة العامة', 'Adminisiration Générale ', '', '005'),
(106, '021', 'النشاط القضائي', 'Activité judiciaire ', '', '006'),
(107, '022', 'ادارة السجون', 'Administration pénitentiaire ', '', '006'),
(108, '023', 'قمع الفساد', 'Répression de la corruption ', '', '006'),
(109, '024', 'الادارة عامة', 'Administration générale ', '', '006'),
(110, '025', 'الخزينة والتسيير المحاسبي', 'Trésor et gestion comptable ', '', '007'),
(111, '026', 'الضرائب', 'lmpôts ', '', '007'),
(112, '027', 'الميزانية', 'Budget ', '', '007'),
(113, '028', 'املاك الدولة', 'Domaine national ', '', '007'),
(114, '029', 'الجمارك', 'Douanes ', '', '007'),
(115, '030', 'مفتشية المالية', 'lnspestion des finances ', '', '007'),
(116, '031', 'الادارة عامة', 'Administration générale ', '', '007'),
(117, '700', 'الاعتمادات المالية غير المخصصة', 'Crédits non assignés ', '', '007'),
(118, '032', 'الكهرباء والغاز والطاقات الجديدة', 'Electricité , gaz et énergies nouvelles ', '', '008'),
(119, '033', 'المناجم', 'Mines ', '', '008'),
(120, '034', 'التعويض عن تحلية مياه البحر', 'Compensation au tire du dessalement de l\'eau de mer ', '', '008'),
(121, '036', 'الادارة العامة', 'Administration Générale ', '', '008'),
(122, '037', 'التراث التاريخي والثقافي', 'patrimoine historique et culturel ', '', '009'),
(123, '038', 'المنح', 'pensions', '', '009'),
(124, '01', 'الدبلوماسية و العلاقات الخارجية', 'Diplomatie et relation exlértieures', '012', '004'),
(125, '02', 'الشؤون القنصلية و الجالية الوطنية بالخارج', 'Affaires consulailes et communaté nationale à l\' éuanger', '012', '004'),
(126, '01', 'تسيير الوزارة', 'Gestion du ministère ', '013', '004'),
(127, '02', 'الدعم لاإداري', 'souien administratif ', '013', '004'),
(128, '01', 'الحركة الجمعوية و الحياة السياسية', 'Mouvement associatif et vie politique ', '014', '005'),
(129, '02', 'الدولة و حركة الأشخاص و الممتلكات', 'Etat et circulation des personnes et des biens ', '014', '005'),
(130, '03', 'الهوية و الوثائق المؤمنة', 'ldentité , titres et documents sécurisés ', '014', '005'),
(131, '04', 'رقمنة الخدمة العمومية', 'Numérisation du service public ', '014', '005'),
(132, '01', 'المهام المسندة للجماعات المحلية', 'Missions dévolues aux collectivités locales ', '015', '005'),
(133, '02', 'دعم التنمية الاجتماعية و الاقتصادية للجماعات المحلية', 'Appui au developpement socio- economlque des collectivités locales ', '015', '005'),
(134, '01', 'أدوات و وسائل تهيئة الاقليم', 'lnstrumens de l\' aménagement du territoite ', '016', '005'),
(135, '02', 'تطوير و جاذبية الإقليم', 'Développement et Attractivité du Territore ', '016', '005'),
(136, '01', 'الدعم الإداري و اللوجيستي المركزي و الجهوي', 'Soutien administratif et logistique cential et régional ', '017', '005'),
(137, '02', 'الأمن، النظام العام، الوقاية و التدخل', 'Sécurité , ordre public , prévention et intervemion ', '017', '005'),
(138, '03', 'النشاطات الاجتماعية المهنية', 'Activités socio - professionnelles ', '017', '005'),
(139, '01', 'التدخل', 'intervention', '018', '005'),
(140, '02', 'الوقاية', 'Prevention', '018', '005'),
(141, '03', 'الدعم الإداري و اللوجيستي', 'Soutien administratif et logisitique', '018', '005'),
(142, '01', 'شبكات المواصلات', 'Réseaux des transmissions', '019', '005'),
(143, '02', 'الدعم الإداري و اللوجيستي', 'Soutien administratif et logistique', '019', '005'),
(144, '01', 'الدعم الإداري و اللوجيستي', 'Soutien administratif et logistique', '020', '005'),
(145, '02', 'الأخطار الكبرى', 'Risques majeurs', '020', '005'),
(146, '03', 'الأمن في الطرق', 'Sécurité routière', '020', '005'),
(147, '01', 'النشاط القضائي العادي و الإداري', 'Activité judiciaire ordinaire et adminstratif ', '021', '006'),
(148, '02', 'الدعم الإداري', 'Soutien administratif ', '021', '006'),
(149, '01', 'ظروف الاعتقال', 'Conditions de détention ', '022', '006'),
(150, '02', 'اعادة الادماج الاجتماعي', 'Réinsertion sociale ', '022', '006'),
(151, '03', 'الأمن', 'Sécurité ', '022', '006'),
(152, '04', 'الدعم الاداري', 'Soutien adminstratif ', '022', '006'),
(153, '01', 'الاستراتيجية و الدعم التقني و الاداري', 'Stratégie , Appui technique et administratif ', '023', '006'),
(154, '02', 'الابحاث و التحريات', 'lnvestigations et recherches ', '023', '006'),
(155, '01', 'تسيير الوزارة', 'Gestion du ministère ', '024', '006'),
(156, '02', 'الدعم الاداري', 'Soutien administratif ', '024', '006'),
(157, '01', 'التسيير المالي للدولة', 'Gestion financière de l\' Etat ', '025', '007'),
(158, '02', 'عصرنة الأنظمة المعلوماتية و وسائل الدفع', 'Modernisation des systémes d\'information et instruments de paiement ', '025', '007'),
(159, '03', 'التسيير المحاسبي لعمليات الخزينة', 'Gestion comptable des opérations du trésor ', '025', '007'),
(160, '04', 'تسيير الوسائل و الدعم الإداري', 'Gestion des moyens et soutien administratif ', '025', '007'),
(161, '01', 'الرقابة، التحصيل و الوعاء الضريبي', 'Assiette , recouvrement et Controle fiscal ', '026', '007'),
(162, '02', 'الدعم الإداري', 'Soutien administratif ', '026', '007'),
(163, '01', 'اعداد و متابعة الميزانية', 'Elaboration et suivi du budgel ', '027', '007'),
(164, '02', 'الرقابة على النفقات', 'Contrôle de la dépense ', '027', '007'),
(165, '03', 'الدعم الاداري', 'Soutien administratif ', '027', '007'),
(166, '01', 'تسيير العمليات الخاصة بأملاك الدولة', 'Gestion des Operations domaniales ', '028', '007'),
(167, '02', 'المحافظة و مسح الأراضي', 'Conservation et Cadastre ', '028', '007'),
(168, '03', 'الدعم الإداري', 'Soutien administratif ', '028', '007'),
(169, '01', 'التحصيل الجمركي', 'Recouvrement douanier ', '029', '007'),
(170, '02', 'الرقابة و حماية الاقتصاد الوطني', 'Contrôle et Protection de l\'économie nationale', '029', '007'),
(171, '03', 'الدعم الإداري', 'Soutien administratif ', '029', '007'),
(172, '01', 'الرقابة الادارية للمالية العمومية و رؤؤس الأموال التجارية التابعة للدولة', 'Contrôle administratif des finances publiques et des capitaux', '030', '007'),
(173, '02', 'الدعم الاداري', 'Soutien adminitstratif', '030', '007'),
(174, '01', 'تسيير الوزارة', 'Gestion du ministère ', '031', '007'),
(175, '02', 'الدعم الاداري', 'Soutien administratif ', '031', '007'),
(176, '01', 'الكهربة', 'Electrification ', '032', '008'),
(177, '02', 'التوزيع العمومي للغاز', 'Distribution publique du gaz ', '032', '008'),
(178, '03', 'البرامج الخاصة للكهرباء و الغاز', 'programme spéciaux de l\'électrlcité et du gaz', '032', '008'),
(179, '04', 'الطاقات الجديدة', 'Energies nouvelles ', '032', '008'),
(180, '05', 'دعم الدولة لفوترة الكهرباء', 'Soutien de l\' Etat à la facturation de l\'életricité ', '032', '008'),
(181, '01', 'المناجم و المقالع', 'Mines et carriéres ', '033', '008'),
(182, '02', 'الموارد المنجمية', 'Ressources Minières ', '033', '008'),
(183, '03', 'التطوير المنجمي', 'Développoment minier', '033', '008'),
(184, '04', 'المراقبة و المطابقة', 'Contrôle et conformité ', '033', '008'),
(185, '01', 'التعويض عن تحلية مياه البحر', 'Compensation au tire du dessalement de l\'eau de mer ', '034', '008'),
(186, '01', 'التحكم في الطاقة', 'Maitrise de l\'Energie ', '035', '008'),
(187, '02', 'الطاقات المتجددة الموصولة بالشبكة الكهربائية الوطنية', 'Energies Renouvelables raccordées au réscau électrique national ', '035', '008'),
(188, '01', 'تسيير الوزارة', 'Gestion du ministère ', '036', '008'),
(189, '02', 'الدعم الاداري', 'Soutien administratif ', '036', '008'),
(190, '01', 'حماية الرموز و المأثر التاريخية', 'protection des symboles et des hauts-fait historique', '037', '009'),
(191, '02', 'البحث التاريخي و متابعة النشاطات المتخفية', 'Recherche historique et suivi des activités muséales ', '037', '009'),
(192, '01', 'المعطوبون و الطعون', 'lnvalides et recours', '038', '009'),
(193, '02', 'ذوي الحقوق ', 'Ayants dtoit', '038', '009'),
(194, '01', 'صحة المجاهدين و ذوي الحقوق', 'Santé des Moudjahidine et ayants droit', '039', '009'),
(195, '02', 'الترقية الاجتماعية', 'promotion sociaie', '039', '009'),
(196, '01', 'تسيير الوزارة', 'Gestion du ministère ', '040', '009'),
(197, '02', 'الدعم الاداري', 'Soutien administratif ', '040', '009'),
(198, '01', 'التوجيه الديني', 'Orientation religieusese', '041', '010'),
(199, '02', 'الثقافة الاسلامية', 'Culture islamique', '041', '010'),
(200, '03', 'الاتصال و التعاون', 'Communication et coopération', '041', '010'),
(201, '04', 'أماكن العبادة', 'Lieux de cultes', '041', '010'),
(202, '01', 'التكوين و التقييم و البحث', 'Formation et évaluation et recherche', '042', '010'),
(203, '02', 'التعليم القرآني', 'Enseignement coranique', '042', '010'),
(204, '01', 'تسيير الوزارة', 'Gestion du ministère ', '043', '010'),
(205, '02', 'الدعم الاداري', 'Soutien administratif ', '043', '010'),
(206, '01', 'التكوين قيد الخدمة', 'Formation en cours d\'emploi', '046', '011'),
(207, '02', 'التكوين المتخصص', 'Formation Spécialisée', '046', '011'),
(208, '01', 'الحياة المدرسية', 'Vie scolaire', '047', '011'),
(209, '02', 'التحويلات الاجتماعية', 'Transferts sociaux', '047', '011'),
(210, '01', 'تسيير الوزارة', 'Gestion du ministère ', '048', '011'),
(211, '02', 'الدعم الاداري', 'Soutien administaif', '048', '011'),
(212, '02', 'التكوين في الطور الثالث', 'Formation au 3ème cycle', '049', '012'),
(213, '01', 'الدعم الاداري للبحث و تسيير المالية', 'Soutien administratif à la recherche et gestion des finances', '050', '012'),
(214, '02', 'البحث و التطوير', 'Recherche et développement', '050', '012'),
(215, '03', 'الابتكار التكنولولجي', 'lnnovation technologique', '050', '012'),
(216, '01', 'الخدمات الجامعية', 'Oeuvres nuiversitaircs', '051', '012'),
(217, '02', 'الظروف المعيشية للطلبة', 'Conditions de vie des étudiants', '051', '012'),
(218, '01', 'تسيير الوزارة', 'Gestion du ministère ', '052', '012'),
(219, '02', 'الدعم الاداري', 'Soutien administratif', '052', '012'),
(220, '01', 'التكوين المهني الأولي', 'Formation professionnelle initiale', '053', '013'),
(221, '02', 'التكوين المهني المتواصل و عن بعد', 'Formation professionnelle continue et à distance', '053', '013'),
(222, '03', 'الهندسة البيداغوجية للتكوين المهني', 'lngénierie pédagogique de la formation professionnelle', '053', '013'),
(223, '01', 'التعليم المهني', 'Enseignement professionnel', '054', '013'),
(224, '02', 'الهندسة البيداغوجية للتعليم المهني', 'lngénierie pédagogique de l\'Enseignement prolessionnel', '054', '013'),
(225, '01', 'تسيير الوزارة', 'Gestion du ministère ', '055', '013'),
(226, '02', 'الدعم الاداري', 'Soutien administratif', '055', '013'),
(227, '01', 'الكتاب و المطالعة العمومية', 'Livre et lecture publique', '056', '014'),
(228, '02', 'الابتكار و نشر المنتوج الثقافي و الفني', 'Création et diffusion du produit culturel', '056', '014'),
(229, '01', 'حماية، تثمين و استغلال التراث الثقافي', 'protection , valorisation et exploitation du patrimoine culturel', '057', '014'),
(230, '02', 'ترميم التراث الثقافي', 'Restauration du patrimoine culturel', '057', '014'),
(231, '01', 'تسيير الوزارة', 'Gestion du ministère ', '058', '014'),
(232, '02', 'الدعم الاداري', 'Soutien administratif', '058', '014'),
(233, '01', 'ترقية التنشيط الاجتماعي التعليمي', 'promotion de l\' animation socio-educative', '059', '015'),
(234, '02', 'الشراكة و مؤسسات الشباب', 'partenariat et établissements de jeunes ', '059', '015'),
(235, '03', 'السياحة و تسلية الشباب', 'Tourisme et loisirs de jeunes', '059', '015'),
(236, '01', 'المواهب الشابة رياضي النخبة و المستوى العالي', 'jeunes talents , sports de l\'élite et de haut niveau ', '060', '015'),
(237, '02', 'ترقية الرياضة للجميع في الأوساط التربوية و المتخصصة', 'promotion du sport pour tous et en milieux éducatif et spécialisé', '060', '015'),
(238, '03', 'الحياة النقابية و مؤسسات الرياضة', 'vie associative et établissements sportifs', '060', '015'),
(239, '01', 'تسيير الوزارة', 'Gestion du ministère ', '061', '015'),
(240, '02', 'الدعم الاداري', 'Soutien administratif', '061', '015'),
(241, '01', 'تكنولولجيات الرقمنة', 'Technologie de la Numérisation', '062', '016'),
(242, '02', 'دعم الاقتصاد الرقمي', 'Appui a l\'economie numérique', '062', '016'),
(243, '01', 'تطوير الاحصائيات', 'Développement des statistiques', '063', '016'),
(244, '02', 'تقييس الاحصائيات', 'Normalisation des statistiques', '063', '016'),
(245, '01', 'تسيير الوزارة', 'Gestion du ministère ', '064', '016'),
(246, '02', 'الدعم الاداري', 'Soutien adminstratif							', '064', '016'),
(247, '01', 'تطوير النشاطات البريدية', 'Développement de l\'activité postale', '065', '017'),
(248, '02', 'تطوير الخدمات المالية البريدية', 'Développement des services financiers postaux', '065', '017'),
(249, '01', 'تطوير و تأمين المنشأت القاعدية لتكنولوجيات الاعلام و الاتصال ', 'Développement et la sécurisation des infrastructures des technologies de l\'information et de la communicatio (TTC)', '066', '017'),
(250, '02', 'تطوير الأنشطة المرتبطة بالاتصالات اللاسلكية و التجهيزات الحساسة ', 'Développement des activités liées à la radiocommuncation et des équipements sensibles des telécommunications ', '066', '017'),
(251, '03', 'المواصلات السلكية و اللاسلكية', 'Telecommunication filaire et sans fil', '066', '017'),
(252, '01', 'تطوير و ترقية المحتوى الوطني و الخدمات على الخط و تعميم الاستخدامات', 'Développement et promotion du contenu national , des services en ligne et génétalisation des usages ', '067', '017'),
(253, '02', 'إرساء و ترقية بينة أمنة لاستخدام التكنولوجيات الحديثة', 'Mise en place et la promotion d\' un environnement de confiance pour l\'utilisation des nouvelles technologies ', '067', '017'),
(254, '01', 'تسيير الوزارة', 'Gestion du ministère ', '068', '017'),
(255, '02', 'الدعم الاداري', 'Soutien administratif ', '068', '017'),
(256, '01', 'حماية و ادماج الاشخاص المعوقين', 'protection et insertion des personnes handicapées					', '069', '018'),
(257, '02', 'التربية و التعليم المتخصص للاشخاص المعوقين', 'Education et enseignement spécialisé des personnes handicapées ', '069', '018'),
(258, '01', 'الاسرة', 'Famille ', '070', '018'),
(259, '02', 'قضايا المرأة', 'Condition de la femme ', '070', '018'),
(260, '01', 'التنمية الاجتماعية', 'Développement social ', '071', '018'),
(261, '02', 'الحركة الجمعوية و النشاط الانساني', 'Mouvement associatif et Action humanitaire ', '071', '018'),
(262, '01', 'تسيير الوزارة', 'Gestion du ministère ', '072', '018'),
(263, '02', 'الدعم الاداري', 'Soutien administratif ', '072', '018'),
(264, '01', 'المنافسة الصناعية', 'Compétitivité lndustrielle ', '073', '019'),
(265, '02', 'التطوير الصناعي', 'Développement lndustriel ', '073', '019'),
(266, '01', 'تطوير الاستثمار', 'Promotion de l\'investissement ', '074', '019'),
(267, '02', 'دعم المؤسسات الصغيرة و المتوسطة', 'Appui à la PME ', '074', '019'),
(268, '01', 'تسيير الوزارة', 'Gestion du ministère ', '075', '019'),
(269, '02', 'الدعم الاداري', 'Soutien Administratif ', '075', '019'),
(270, '01', 'تنمية الفلاحة', 'Développement de l\'agriculture ', '076', '020'),
(271, '02', 'الامن و الجودة الصحية للأغذية', 'Sécurité et qualité sanitaires des aliments ', '076', '020'),
(272, '03', 'التنمية الريفية و التسيير المتوازن و المستديم للأقاليم', 'Développement rural et gestion equilibrée et durablale des territoires ', '076', '020'),
(273, '01', 'التسيير و الدعم', 'Gestion et soutien ', '077', '020'),
(274, '02', 'التنمية المستدامة و المحافظة على الأملاك', 'Gestion durable et conservation du patrimoine ', '077', '020'),
(275, '03', 'محاربة التصحر و استصلاح الأراضي ', 'Lutte contre la désertification et la restation des terres ', '077', '020'),
(276, '01', 'تسيير الوزارة', 'Gestion du ministère ', '078', '020'),
(277, '02', 'الدعم الاداري', 'Gestion , intevention et soutien ', '078', '020'),
(278, '01', 'السكن العمومي الإيجاري', 'Logement public locatif ', '079', '021'),
(279, '02', 'إعانات السكن', 'Aides aux logement ', '079', '021'),
(280, '01', 'التعمير', 'Urbanisme ', '080', '021'),
(281, '02', 'تهيئة العقار', 'Aménagement du foncier ', '080', '021'),
(282, '01', 'المدن و المدن الجديدية', 'villes et villes nouvelles ', '081', '021'),
(283, '01', 'التجهيزات العمومية للتربية و التكوين', 'Equipements de l\'éducation et de la formation ', '082', '021'),
(284, '02', 'التجهيزات العمومية للأمن و الصحة', 'Equipements de sécurité et de sante ', '082', '021'),
(285, '03', 'تجهيزات عمومية أخرى', 'Autres équipements ', '082', '021'),
(286, '01', 'تسيير الوزارة', 'Gestion du ministère ', '083', '021'),
(287, '02', 'الدعم الاداري', 'Soutien administratif ', '083', '021'),
(288, '01', 'ضبط السوق', 'Régulation des Marchés ', '084', '022'),
(289, '02', 'تنظيم النشاطات التجارية', 'Organisation des Activités commerciales ', '084', '022'),
(290, '01', 'تحليل و مراقبة الجودة', 'Analyse et contrôle de la qualité ', '085', '022'),
(291, '02', 'رقابة الممارسات التجارية', 'contrôle des pratiques Commerciales ', '085', '022'),
(292, '01', 'المبادلات التجارية', 'Echanges Commerciaux', '086', '022'),
(293, '02', 'ترقية الصادرات خارج المحروقات ', 'promotion des Exportations hors Hydrocarbures ', '086', '022'),
(294, '01', 'تسيير الوزارة', 'Gestion du ministère ', '087', '022'),
(295, '02', 'الدعم الاداري', 'Soutien Admimistratif ', '087', '022'),
(296, '01', 'الاعلام', 'Médias', '088', '023'),
(297, '02', 'الاتصال المؤسساتي', 'Communication lnstititutionnelle ', '088', '023'),
(298, '01', 'تسيير الوزارة', 'Gestion Du ministère ', '089', '023'),
(299, '02', 'الدعم الاداري', 'Soutien Administratif ', '089', '023'),
(300, '01', 'تطوير المنشات الأساسية للطرق', 'Développement des infrastructures routiéres ', '090', '024'),
(301, '02', 'صيانة الطرق', 'Entretien routier ', '090', '024'),
(302, '03', 'تطوير و صيانة الطرق السيارة', 'Développement et entretien des autoroutes ', '090', '024'),
(303, '01', 'تطوير المنشأت الأساسية المطارية', 'Développements des infrastrucres aéroportuaires ', '091', '024'),
(304, '02', 'صيانة المنشات الأساسية المطارية', 'Maintenances des infrastructures aéroporuaires', '091', '024'),
(305, '01', 'تطوير المشأت الأساسية البحرية', 'Développement des infrastructures maritimes ', '092', '024'),
(306, '02', 'صيانة المنشأت الأساسية البحرية و الاشارة', 'Maintenance des infrastructures maritimes et signalisation ', '092', '024'),
(307, '01', 'السدود', 'Barrages ', '093', '024'),
(308, '02', 'تحويلات المياه', 'Transterts des eaux ', '093', '024'),
(309, '03', 'التنقيبات', 'Forages ', '093', '024'),
(310, '04', 'المياه الغير تقليدية', 'Eau non conventionnelle ', '093', '024'),
(311, '01', 'التوصيل بالمياه الصالحة للشرب و المياه الصناعية ', 'Adduction en eau potable et industrielle ', '094', '024'),
(312, '02', 'شبكات التوزيع', 'Réseaux de distribution ', '094', '024'),
(313, '01', 'المساحات المسقية', 'périmetres irrigués ', '095', '024'),
(314, '02', 'الري الصغير و المتوسط', 'petite et moyenne hydraulique ', '095', '024'),
(315, '01', 'شبكات التطهير', 'Réseaux d\'assainissement ', '096', '024'),
(316, '02', 'محطات تصفية مياه الصرف الصحي', 'stations d\'épuration des eaux usées ', '096', '024'),
(317, '03', 'حماية المدن من الفيضانات', 'protection des villes contre les inondations ', '096', '024'),
(318, '01', 'تسيير الوزارة', 'Gestion du ministère ', '097', '024'),
(319, '02', 'الدعم الاداري', 'Soutien administratif ', '097', '024'),
(320, '01', 'النقل عبر الطرق و اللوجيسية', 'Transports routiers et logistique ', '098', '025'),
(321, '02', 'النقل بالسكك الحديدية و النقل الموجه', 'Transports ferroviaires et guidés ', '098', '025'),
(322, '01', 'البحرية التجارية', 'Marine marchande ', '099', '025'),
(323, '02', 'الموانئ', 'ports ', '099', '025'),
(324, '01', 'الطيران', 'Aéronautique ', '100', '025'),
(325, '02', 'الارصاد الجوية', 'Météorologie ', '100', '025'),
(326, '01', 'تسيير الوزارة', 'Gestion du ministère ', '101', '025'),
(327, '02', 'الدعم الاداري', 'Soutien administratif ', '101', '025'),
(328, '01', 'سياسة و ترقية السياحة', 'Politique et promotion de tourisme ', '102', '026'),
(329, '02', 'دعم المشاريع السياحية', 'soutien aux projets touristiques ', '102', '026'),
(330, '01', 'توجيه و تأطير تطوير الصناعة التقليدية و الحرف', 'pilotage et encadrement de développement de l\'artisanat et métiers ', '103', '026'),
(331, '02', 'ترقية و تحسين أداء الفاعلية', 'promotion et amélioration des performances des acteurs ', '103', '026'),
(332, '01', 'تسيير الوزارة', 'Gestion du ministère ', '104', '026'),
(333, '02', 'الدعم الاداري', 'soutien administratif ', '104', '026'),
(334, '01', 'الوقاية و العلاجات', 'prévention et soins ', '105', '027'),
(335, '01', 'التكوين و تعزيز المهارات', 'formation et renforcement des compétences ', '106', '027'),
(336, '01', 'تسيير الوزارة', 'Gestion du ministère ', '107', '027'),
(337, '02', 'الدعم الاداري', 'Soutien administtatif ', '107', '027'),
(338, '01', 'تصميم و تنظيم تشريعات العمل', 'contrôle de l\'application des dispositions législatives et réglementaire du travail ', '108', ' 028'),
(339, '02', 'التسيير الإداري و المالي', 'Gestion administrative et financière ', '108', '028'),
(340, '01', 'الولوج إلى السوق التشغيل', 'Accés au marché de l\'emploi ', '109', '028'),
(341, '02', 'اجهزة التشغيل', 'Dispositif d\'emploi ', '109', '028'),
(342, '01', 'تنفيذ سياسة الضمان الإجتماعي', 'Soutien au système de sécurité sociale', '110', '028'),
(343, '02', 'دعم نظام الضمان الاجتماعي', 'Soutien au système de sécurité sociale', '110', '028'),
(344, '01', 'تسيير الوزارة', 'Soutien administratif ', '111', '028'),
(345, '02', 'الدعم الاداري', 'Gestion ministère ', '111', '028'),
(346, '01', 'تعزيز العلاقات بين الحكومة و البرلمان', 'Suivi du travail parlementaire ', '112', '029'),
(347, '02', 'دراسة النصوص التشريعية و التنظيمية', 'Etude de textes législatifs et reglementaires ', '112', '029'),
(348, '01', 'تسيير الوزارة', 'Gestion du ministère ', '113', '029'),
(349, '02', 'الدعم الاداري', 'Soutien administratif ', '113', '029'),
(350, '01', 'البيئة الحضرية و الصناعية', 'Environnement urbain et industriel ', '114', '030'),
(351, '02', 'التنوع البيولوجي و التغيرات المناخية', 'Biodiversité et changement climatique ', '114', '030'),
(352, '03', 'تربية و توعية بيئية', 'Education et sensibilisation environnementale ', '114', '030'),
(353, '01', 'الطاقات المتجددة الغير موصولة بالشبكات', 'Energies renouvelables non raccordécs au réseau ', '115', '030'),
(354, '01', 'تسيير الوزارة', 'Gestion du ministère ', '116', '030'),
(355, '02', 'الدعم الاداري', 'Soutien Administratif ', '116', '030'),
(356, '01', 'تطوير أنشطة الصيد البحري', 'Développement des activités de la peche ', '117', '031'),
(357, '02', 'تطوير البنـى التحتية و الصناعة المرتبطة بالصيد البحري', 'Développement des infrastructures et de l\'industrie liée à la peche ', '117', '031'),
(358, '01', 'تطوير أنشطة تربية المائيات', 'Développement des activités de l\'aquaculture ', '118', '031'),
(359, '02', 'تطوير البنـى التحتية و الصناعة المرتبطة بتربية المائيات', 'Développement des infrastructures et de l\'industrie liée à l\'aquaculture ', '118', '031'),
(360, '01', 'مراقبة أنشطة الصيد البحري و تربية المائيات', 'Contrôle des activités de la péche et de l\'aquaculture ', '119', '031'),
(361, '02', 'مراقبة صحة الأوساط و نوعية المنتجات للصيد البحري و تربية المائيات', 'Contrôle de la salubrité des milieux et de la qualité des produits de la pêche et de l\'aquacultue ', '119', '031'),
(362, '01', 'تسيير الوزارة', 'Gestion du ministère', '120', '031'),
(363, '02', 'الدعم الاداري', 'Soutien administratif ', '120', '031'),
(364, '01', 'ضبط السوق', 'Régulation du marché ', '121', '032'),
(365, '01', 'تسيير الوزارة', 'Gestion du ministère ', '122', '032'),
(366, '01', 'ترقية لإقتصاد المعرفة و المؤسسات الناشئة', 'promotion de l\'Economie de la connaissance et des Startup ', '123', '033'),
(367, '02', 'ترقية المقاولاتية و الابداع', 'promotion de l\'Entreprenariat et de la créativité ', '123', '033'),
(368, '01', 'تسيير الوزارة', 'Gestion du ministère ', '124', '033'),
(369, '02', 'الدعم الاداري', 'Soutien Administratif ', '124', '033');

-- --------------------------------------------------------

--
-- Table structure for table `rebriques`
--

DROP TABLE IF EXISTS `rebriques`;
CREATE TABLE IF NOT EXISTS `rebriques` (
  `id_reb` int(11) NOT NULL AUTO_INCREMENT,
  `id_op` int(11) NOT NULL,
  `id_eng` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `sous_titre` int(11) NOT NULL,
  `sous_AP` double NOT NULL,
  `sous_cumul` double NOT NULL,
  `sous_montant_1` double NOT NULL,
  `sous_montant` double NOT NULL,
  `sous_montant_2` double NOT NULL,
  PRIMARY KEY (`id_reb`)
) ENGINE=MyISAM AUTO_INCREMENT=318 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rebriques`
--

INSERT INTO `rebriques` (`id_reb`, `id_op`, `id_eng`, `type`, `sous_titre`, `sous_AP`, `sous_cumul`, `sous_montant_1`, `sous_montant`, `sous_montant_2`) VALUES
(145, 3, 13, 'eng', 94, 900000000, 209553823.5, 690446176.5, 249645673.2, 440800503.3),
(146, 3, 14, 'eng', 94, 900000000, 459199496.7, 440800503.3, 2801260, 437999243.3),
(127, 3, 1, 'decision', 127, 0, 0, 0, 0, 0),
(126, 3, 1, 'decision', 94, 668753823.5, 0, 0, 0, 0),
(150, 3, 17, 'eng', 94, 467114000, 464255806.7, 2858193.3, 2856000, 2193.2999999998137),
(41, 4, 4, 'decision', 127, 1094000, 0, 1094000, 0, 1094000),
(40, 4, 4, 'decision', 94, 298905000, 286899726.75, 12006273.25, 10892070, 22898343.25),
(292, 5, 5, 'eng', 94, 0, 0, 0, 0, 0),
(293, 5, 5, 'eng', 123, 0, 0, 0, 0, 0),
(294, 5, 5, 'eng', 126, 0, 0, 0, 0, 0),
(54, 4, 7, 'eng', 94, 298905000, 0, 22898343.25, 0, 22898343.25),
(55, 4, 7, 'eng', 127, 1094000, 0, 1094000, 0, 1094000),
(56, 4, 8, 'eng', 94, 298905000, 0, 22898343.25, 0, 22898343.25),
(57, 4, 8, 'eng', 127, 1094000, 0, 1094000, 0, 1094000),
(140, 3, 10, 'eng', 94, 0, 0, 0, 0, 0),
(141, 3, 10, 'eng', 127, 0, 0, 0, 0, 0),
(148, 3, 16, 'eng', 94, 900000000, 463113406.7, 436886593.3, 1142400, 435744193.3),
(147, 3, 15, 'eng', 94, 900000000, 462000756.7, 437999243.3, 1112650, 436886593.3),
(142, 3, 12, 'eng', 94, 900000000, 0, 900000000, 209553823.5, 690446176.5),
(151, 3, 17, 'eng', 127, 432886000, 0, 432886000, 0, 432886000),
(152, 3, 18, 'eng', 94, 848629000, 467111806.7, 381517193.3, 374643654, 6873539.300000012),
(153, 3, 18, 'eng', 127, 51371000, 0, 51371000, 0, 51371000),
(160, 3, 19, 'eng', 94, 848629000, 467111806.7, 381517193.3, 374643654, 6873539.300000012),
(161, 3, 19, 'eng', 127, 51371000, 0, 51371000, 0, 51371000),
(164, 3, 20, 'eng', 94, 848629000, 841755460.7, 6873539.3, 3552150, 3321389.3),
(165, 3, 20, 'eng', 127, 51371000, 0, 51371000, 0, 51371000),
(168, 3, 21, 'eng', 94, 848629000, 845307610.7, 3321389.3, 2356200, 965189.2999999998),
(169, 3, 21, 'eng', 127, 51371000, 0, 51371000, 0, 51371000),
(307, 5, 22, 'eng', 94, 48000000, 7319872.07, 40680127.9, 1487500, 39192627.9),
(313, 5, 26, 'eng', 94, 48000000, 5832372.07, 42167627.9, 1487500, 40680127.9),
(301, 5, 9, 'eng', 94, 48000000, 5832372.07, 42167627.9, 5713134.07, 36454493.83),
(308, 5, 23, 'eng', 94, 48000000, 8807372.07, 39192627.9, 9816967, 29375660.9),
(309, 5, 24, 'eng', 94, 48000000, 18624339.07, 29375660.9, 971962.25, 28403698.65),
(310, 5, 25, 'eng', 94, 48000000, 18624339.07, 28403698.65, 0, 28403698.65),
(300, 5, 6, 'eng', 94, 48000000, 5713134.07, 42286865.9, 119238, 42167627.9),
(314, 2, 27, 'decision', 84, 10000000, 0, 0, 10000000, 10000000),
(315, 2, 28, 'decision', 84, 9877000, 0, 10000000, -123000, 9877000),
(317, 5, 29, 'eng', 94, 48000000, 19596301.32, 40680127.9, 1200000, 39480127.9);

-- --------------------------------------------------------

--
-- Table structure for table `reb_pay`
--

DROP TABLE IF EXISTS `reb_pay`;
CREATE TABLE IF NOT EXISTS `reb_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etude` double DEFAULT NULL,
  `genie_civil` double DEFAULT NULL,
  `travaux_publics` double DEFAULT NULL,
  `equipements` double DEFAULT NULL,
  `materiel_transport` double DEFAULT NULL,
  `formation` double DEFAULT NULL,
  `travaux_exterieurs` double DEFAULT NULL,
  `publicite` double DEFAULT NULL,
  `fonds` double DEFAULT NULL,
  `env` double DEFAULT NULL,
  `terrain` double DEFAULT NULL,
  `interets` double DEFAULT NULL,
  `douane` double DEFAULT NULL,
  `stock` double DEFAULT NULL,
  `suiv` double DEFAULT NULL,
  `tech` double DEFAULT NULL,
  `labo` double DEFAULT NULL,
  `montant_libre` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `cumul_old` double DEFAULT NULL,
  `cumul_new` double DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `op` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reb_pay`
--

INSERT INTO `reb_pay` (`id`, `etude`, `genie_civil`, `travaux_publics`, `equipements`, `materiel_transport`, `formation`, `travaux_exterieurs`, `publicite`, `fonds`, `env`, `terrain`, `interets`, `douane`, `stock`, `suiv`, `tech`, `labo`, `montant_libre`, `total`, `cumul_old`, `cumul_new`, `updated_at`, `op`) VALUES
(12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 54600000, 80600000, '0000-00-00', 3),
(11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 28600000, 54600000, '0000-00-00', 3),
(10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 26000000, 28600000, '0000-00-00', 3),
(9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 26000000, '0000-00-00', 3),
(8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5713134.07, 10713134.07, '0000-00-00', 5),
(7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5713134.07, '0000-00-00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `safe`
--

DROP TABLE IF EXISTS `safe`;
CREATE TABLE IF NOT EXISTS `safe` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `safe`
--

INSERT INTO `safe` (`id`, `password`) VALUES
(1, 'admin'),
(2, '12345'),
(46, '010203'),
(47, '456789'),
(48, '012345'),
(49, '2023');

-- --------------------------------------------------------

--
-- Table structure for table `titres`
--

DROP TABLE IF EXISTS `titres`;
CREATE TABLE IF NOT EXISTS `titres` (
  `id_titre` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(11) NOT NULL,
  `definition` text NOT NULL,
  `definition_fr` text,
  `type` varchar(25) NOT NULL,
  `father` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_titre`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `titres`
--

INSERT INTO `titres` (`id_titre`, `code`, `definition`, `definition_fr`, `type`, `father`) VALUES
(2, '31000', 'تثبيتات عينية', 'lmmobilisations corporelles ', 'parent', 0),
(86, '31120', 'الارضي المهياة', 'Terrain aménagés ', '', 2),
(84, '31100', 'الاراضي', 'Terrains ', '', 2),
(85, '31110', 'الاراضي الفارغة', 'Terrains nu ', '', 2),
(87, '31130', 'اراضي الابار', 'Terrainde gisement ', '', 2),
(88, '31140', 'الاراضي المبنية', 'Terrain batis ', '', 2),
(89, '31200', 'تهيئة وإعادة تأهيل االاراضي', 'Aménagements et viabilisation de terrains ', '', 2),
(90, '31300', 'الاشغال الغابية', 'Travaux forestiers ', '', 2),
(91, '31400', 'البناء والصيانة', 'Construction et entretien ', '', 2),
(92, '31410', 'المنشات القاعدية', 'lnfrastructures', '', 2),
(93, '31411', 'المنشأت القاعدية البحرية', 'lnfrastructures maritimes', '', 2),
(94, '31412', 'المنشأت القاعدية اللطرقات', 'lnfrastructures routiéres', '', 2),
(95, '31413', 'المنشأت القاعدية اللمطارات', 'lnfrastructures aéroportuaires', '', 2),
(96, '31414', 'المنشأت القاعدية للسكك الحديدية', 'lnfrastructures ferroviaires', '', 2),
(97, '31415', 'المنشأت القاعدية للري', 'lnfrastructures hydrauliques', '', 2),
(98, '31416', 'المنشأت القاعدية الرياضية', 'lnfrastructures sportives', '', 2),
(99, '31417', 'المنشأت القاعدية الطاقوية', 'lnfastructures énergétiques , de télécommunications et des technologies de l\'information et des cmmunications ', '', 2),
(100, '31418', 'المنشأت القاعدية لمعالجة النفايات والمياه المستعملة', 'lnfrastructures de traitement des déchets et eaux usées ', '', 2),
(101, '31419', 'المنشأت الفنية', 'Ouvrages d\'art ', '', 2),
(102, '31420', 'البنايات', 'Batiments', '', 2),
(103, '31430', 'السكنات', 'Logements ', '', 2),
(104, '31440', 'صيانة واعادة تأهيل التراث العقاري التاريخي والديني والثقافي', 'Entretien et réhabilitation du patrimoine immobilier historique, cultuel et culturel ', '', 2),
(105, '31500', 'التركيبات والترتيب وتهيئة البنايات', 'lnstallations , agencements et aménagements des constructions ', '', 2),
(106, '31600', 'التركيبات التقنية والمعدات والادوات الصناعية', 'lnstallations techniques, matériel et outillage industriel ', '', 2),
(107, '31610', 'التركيبات التقنية الخاصة', 'lnstallations techniques et spécifques ', '', 2),
(108, '31620', 'المعدات الادوات الصناعية', 'Matériel et outillage industriel ', '', 2),
(109, '31630', 'معدات والتجهيزات اخرى', 'Autres matériel et équipement ', '', 2),
(110, '31700', 'العتاد العسكري', 'Matériel militaire ', '', 2),
(111, '31800', 'معدات النقل', 'Matériel de transport ', '', 2),
(112, '31810', 'النقل البري', 'Transport routier ', '', 2),
(113, '31811', 'مركبات نقل الاشخاص', 'Véhicules de transport des personnes', '', 2),
(114, '31812', 'مركبات نقل البضائع و المواد والمنتجات والمواد الخطيرة', 'véhicules de transport des marchandises, des matiéres et produits et matiéres dangereuses', '', 2),
(115, '31820', 'النقل البحري ', 'Transport maritime ', '', 2),
(116, '31830', 'النقل الجوي', 'Transport aérien ', '', 2),
(117, '31840', 'النقل الموجة : المترو , التراموي التليفريك', 'Transports guidé : métro, tramway et téléphérique ', '', 2),
(118, '31900', 'تثبيتات عينية اخرى', 'Autres immobilisations corporelles ', '', 2),
(119, '31910', 'أجهزة الاعلام الالي', 'Matériel informatique ', '', 2),
(120, '31920', 'معدات وأثاث المكتب', 'Matétiel et mobilier de bureau ', '', 2),
(121, '31930', 'الاعمال الفنية واللوحات والمجموعات', 'Euvres d\'art, tableaux , et collections ', '', 2),
(3, '32000', 'تثبيتات معنوية', 'lmmobilisations incorporelles ', 'parent', 0),
(123, '32100', 'مصاريف التطوير و الأبحاث و الدراسات', 'Frais de développement de recherches et d\'études', '', 3),
(124, '32200', 'التنازلات و الحقوق و براءات الإختراع و التراخيص و ما يمثلها', 'Concessions, droits, brevets, licences et assimilés ', '', 3),
(125, '32300', 'برمجيات الإعلام الألي و ما يمثلها ', 'Logiciels informatiques et assimilés', '', 3),
(126, '32400', 'تثبيتات معنوية أخرى', 'Autres lmmobilisations incorporelles ', '', 3),
(127, ' ', 'مبلغ غير موزع', 'Montant non distribué', '', 128),
(128, ' ', 'مبلغ العملية غير الموزع', 'Montant de l\'opération non distribué', 'parent', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `chapitre` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `position`, `service`, `password`, `photo`, `chapitre`) VALUES
(1, 'admin', 'Administrateur', 'Admin', 'Admin', '$2y$10$N34kPOmf7fWr7xNbgCSG2ORVmq7jAtrtsZaj1FNuSzqWiOqBWc7GW', 'uploads/users/1_user_avatar.jpg', NULL),
(2, 'SAM', 'Naima', 'Employé', 'Coordination', '$2y$10$aAVjXuxLAFojfYBlhUA3ZOEHh78LTrg6CJPvNclrGFbCjI1L8X.Hm', 'uploads/users/1_user_avatar.jpg', '622,302-089-002'),
(46, 'directeur', 'MECHEHAT ABDELHAKIM', 'Employé', 'Coordination', '$2y$10$SV5UNxNG8WE1fHiaciBGsO5jpNU6L08hpftps88J4RwojuK8kp672', 'img/user_avatar.jpg', ''),
(47, 'amine', 'BOUDERHEM AMINE', 'Employé', 'Comptabilité', '$2y$10$zM7Cpn6OYofXRMgjc839fOOQq6eXsGiv/kLhFyU.pYDOaHP3XyYvO', 'img/user_avatar.jpg', ''),
(48, 'SEER', 'ARDJANI HICHAM', 'Employé', 'ODS', '$2y$10$/9ubCSO9Fm08ll.glZlSl.mMbEw9yzCta9WoTgG4DqBk1X6SNst1a', 'img/user_avatar.jpg', ''),
(49, 'hocine', 'HARZALLAH HOCINE', 'Employé', 'Coordination', '$2y$10$UJ0SRIZEfb1W1cui3kGLrOhldrqnLVQcN5uH2PO4o70PZZb1bbwI6', 'img/user_avatar.jpg', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
