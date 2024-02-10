-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2024 at 05:00 PM
-- Server version: 5.7.31-log
-- PHP Version: 7.3.28

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

CREATE TABLE `attestations` (
  `id_att` int(11) NOT NULL,
  `id_eng` int(11) NOT NULL,
  `causes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `att_total`
--

CREATE TABLE `att_total` (
  `att_id` int(11) NOT NULL,
  `ze_pay` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `mondat` varchar(50) DEFAULT NULL,
  `compte` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(255) NOT NULL,
  `entreprise` int(11) NOT NULL,
  `bank_acc` text NOT NULL,
  `bank` text NOT NULL,
  `bank_user` text NOT NULL,
  `bank_agc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banques`
--

CREATE TABLE `banques` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `abr` varchar(10) NOT NULL,
  `num` varchar(10) NOT NULL,
  `cle` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
(11, 'الصندوق الوطني للتوفير و الاحتياط', 'CNEP', '452', '94');

-- --------------------------------------------------------

--
-- Table structure for table `borderau`
--

CREATE TABLE `borderau` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bord_eng`
--

CREATE TABLE `bord_eng` (
  `id` int(11) NOT NULL,
  `id_bord` int(11) NOT NULL,
  `id_eng` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id_comp` int(1) NOT NULL,
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
  `lang` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id_comp`, `ville`, `ville_fr`, `ministere`, `ministere_fr`, `direction`, `direction_fr`, `order_ville`, `code_ville`, `compte_tresor`, `year`, `pref_eng`, `license`, `lang`) VALUES
(1, 'أولاد جلال', 'Ouled Djellal', 'الأشغال العمومية و المنشآت القاعدية', 'Ministère des Travaux Publics et des Infrastructures de Base', 'الأشغال العمومية', 'Direction des Travaux Publics', '114.051.01', ' ', '307209/79', '2023', 'with_sous', '2024-10-31', '');

-- --------------------------------------------------------

--
-- Table structure for table `cp`
--

CREATE TABLE `cp` (
  `ze_op` int(11) NOT NULL,
  `montant_cp` double NOT NULL,
  `year` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id_deal` int(11) NOT NULL,
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
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `engagements`
--

CREATE TABLE `engagements` (
  `id` int(11) NOT NULL,
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
  `updated_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `nature` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `leve_main`
--

CREATE TABLE `leve_main` (
  `id_main` int(11) NOT NULL,
  `id_eng` int(11) NOT NULL,
  `montant` double NOT NULL,
  `pvs` text NOT NULL,
  `extra` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ods`
--

CREATE TABLE `ods` (
  `id` int(11) NOT NULL,
  `id_eng` int(11) NOT NULL,
  `real_type` varchar(50) DEFAULT NULL,
  `ods_num` int(11) NOT NULL,
  `ods_date` date NOT NULL,
  `cause` text,
  `duree` int(11) DEFAULT NULL,
  `type_ods` text NOT NULL,
  `extra_type` text NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `intitule` text,
  `intitule_ar` text,
  `portefeuille` varchar(255) DEFAULT NULL,
  `programme` varchar(100) DEFAULT NULL,
  `sous_programme` varchar(100) DEFAULT NULL,
  `activite` varchar(50) NOT NULL,
  `sous_action` varchar(100) DEFAULT NULL,
  `annee` varchar(15) NOT NULL,
  `date` date DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `AP_init` double DEFAULT NULL,
  `reevaluation` double DEFAULT NULL,
  `AP_act` double DEFAULT NULL,
  `num_cloture` varchar(20) DEFAULT NULL,
  `date_cloture` date DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(255) NOT NULL,
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
  `num` varchar(100) DEFAULT NULL,
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
  `updated_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `penalite`
--

CREATE TABLE `penalite` (
  `id_pen` int(11) NOT NULL,
  `the_pay` int(11) NOT NULL,
  `html` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `portefeuille`
--

CREATE TABLE `portefeuille` (
  `code` varchar(10) NOT NULL,
  `ministere` text NOT NULL,
  `ministere_fr` text
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

CREATE TABLE `programme` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `designation` text NOT NULL,
  `designation_fr` text,
  `parent` varchar(100) DEFAULT NULL,
  `portefeuille` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

CREATE TABLE `rebriques` (
  `id_reb` int(11) NOT NULL,
  `id_op` int(11) NOT NULL,
  `id_eng` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `sous_titre` int(11) NOT NULL,
  `sous_AP` double NOT NULL,
  `sous_cumul` double NOT NULL,
  `sous_montant_1` double NOT NULL,
  `sous_montant` double NOT NULL,
  `sous_montant_2` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reb_pay`
--

CREATE TABLE `reb_pay` (
  `id` int(11) NOT NULL,
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
  `op` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `safe`
--

CREATE TABLE `safe` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `safe`
--

INSERT INTO `safe` (`id`, `password`) VALUES
(1, 'admin'),
(2, '12345');

-- --------------------------------------------------------

--
-- Table structure for table `titres`
--

CREATE TABLE `titres` (
  `id_titre` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `definition` text NOT NULL,
  `definition_fr` text,
  `type` varchar(25) NOT NULL,
  `father` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `chapitre` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `position`, `service`, `password`, `photo`, `chapitre`) VALUES
(1, 'admin', 'Administrateur', 'Admin', 'Admin', '$2y$10$N34kPOmf7fWr7xNbgCSG2ORVmq7jAtrtsZaj1FNuSzqWiOqBWc7GW', 'uploads/users/1_user_avatar.jpg', NULL),
(2, 'comptable', 'comptable 1', 'Employé', 'Comptabilité', '$2y$10$BX7A9PW5C2ji4Li9Q2GaDemgxPIfr8P3RJTrPAm5HdzeLyT8jkyDK', 'img/user_avatar.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attestations`
--
ALTER TABLE `attestations`
  ADD PRIMARY KEY (`id_att`);

--
-- Indexes for table `att_total`
--
ALTER TABLE `att_total`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banques`
--
ALTER TABLE `banques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borderau`
--
ALTER TABLE `borderau`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bord_eng`
--
ALTER TABLE `bord_eng`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id_comp`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id_deal`);

--
-- Indexes for table `engagements`
--
ALTER TABLE `engagements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leve_main`
--
ALTER TABLE `leve_main`
  ADD PRIMARY KEY (`id_main`);

--
-- Indexes for table `ods`
--
ALTER TABLE `ods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalite`
--
ALTER TABLE `penalite`
  ADD PRIMARY KEY (`id_pen`);

--
-- Indexes for table `portefeuille`
--
ALTER TABLE `portefeuille`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rebriques`
--
ALTER TABLE `rebriques`
  ADD PRIMARY KEY (`id_reb`);

--
-- Indexes for table `reb_pay`
--
ALTER TABLE `reb_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `titres`
--
ALTER TABLE `titres`
  ADD PRIMARY KEY (`id_titre`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attestations`
--
ALTER TABLE `attestations`
  MODIFY `id_att` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `att_total`
--
ALTER TABLE `att_total`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `banques`
--
ALTER TABLE `banques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `borderau`
--
ALTER TABLE `borderau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bord_eng`
--
ALTER TABLE `bord_eng`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id_comp` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id_deal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `engagements`
--
ALTER TABLE `engagements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `leve_main`
--
ALTER TABLE `leve_main`
  MODIFY `id_main` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ods`
--
ALTER TABLE `ods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penalite`
--
ALTER TABLE `penalite`
  MODIFY `id_pen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `programme`
--
ALTER TABLE `programme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- AUTO_INCREMENT for table `rebriques`
--
ALTER TABLE `rebriques`
  MODIFY `id_reb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT for table `reb_pay`
--
ALTER TABLE `reb_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `titres`
--
ALTER TABLE `titres`
  MODIFY `id_titre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
