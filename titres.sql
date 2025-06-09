-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 09, 2025 at 03:57 AM
-- Server version: 5.7.40
-- PHP Version: 7.4.33

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
(127, ' ', 'مبلغ غير موزع', 'Montant non ventilé', '', 128),
(128, ' ', 'مبلغ العملية غير الموزع', 'Montant de l\'opération non ventilé', 'parent', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
