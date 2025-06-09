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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
