-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 06, 2022 at 12:29 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seed_reception`
--

-- --------------------------------------------------------

--
-- Table structure for table `abonne`
--

DROP TABLE IF EXISTS `abonne`;
CREATE TABLE IF NOT EXISTS `abonne` (
  `id_visiteur` int UNSIGNED NOT NULL,
  `montant_verse` int UNSIGNED NOT NULL,
  `cout_abonnement` int UNSIGNED NOT NULL DEFAULT '15000',
  `date_inscription` date NOT NULL,
  `date_expiration` date NOT NULL,
  `carte_membre_genere` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_visiteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `abonne`
--

INSERT INTO `abonne` (`id_visiteur`, `montant_verse`, `cout_abonnement`, `date_inscription`, `date_expiration`, `carte_membre_genere`) VALUES
(1, 5000, 0, '2022-06-06', '0000-00-00', 0),
(45, 10000, 15000, '2022-06-06', '2023-06-06', 1),
(47, 10000, 0, '2022-06-06', '2023-06-06', 0),
(50, 4000, 10000, '2022-06-04', '2023-06-04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `apprenant`
--

DROP TABLE IF EXISTS `apprenant`;
CREATE TABLE IF NOT EXISTS `apprenant` (
  `id_visiteur` int UNSIGNED NOT NULL,
  `matricule` varchar(20) NOT NULL,
  PRIMARY KEY (`id_visiteur`),
  UNIQUE KEY `id_visiteur` (`id_visiteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `apprenant`
--

INSERT INTO `apprenant` (`id_visiteur`, `matricule`) VALUES
(1, 'SEED-2022-001'),
(45, 'mat-45'),
(46, 'mat-46');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

DROP TABLE IF EXISTS `employer`;
CREATE TABLE IF NOT EXISTS `employer` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_visiteur` int UNSIGNED NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `id_visiteur` (`id_visiteur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `id_visiteur`, `login`, `password`) VALUES
(1, 1, 'seed', '5a7c4d004bb7aaa3c17264f9a1d035668b17d8ae');

-- --------------------------------------------------------

--
-- Table structure for table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_ouvrage` int UNSIGNED NOT NULL,
  `id_abonne` int UNSIGNED NOT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour_prevu` date NOT NULL,
  `date_retour_effectif` date NOT NULL,
  `feelback` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_abonne` (`id_abonne`),
  KEY `id_ouvrage` (`id_ouvrage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formateur`
--

DROP TABLE IF EXISTS `formateur`;
CREATE TABLE IF NOT EXISTS `formateur` (
  `id_visiteur` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_visiteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `formateur`
--

INSERT INTO `formateur` (`id_visiteur`) VALUES
(1),
(45),
(47);

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int UNSIGNED NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prix` int UNSIGNED NOT NULL,
  `duree` int UNSIGNED NOT NULL,
  `commentaire` text NOT NULL,
  `id_formateur` int UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_formateur` (`id_formateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `formation`
--

INSERT INTO `formation` (`id`, `nom`, `prix`, `duree`, `commentaire`, `id_formateur`) VALUES
(0, 'php', 55000, 8, '\r\n                    ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_apprenant` int UNSIGNED NOT NULL,
  `id_formation` int UNSIGNED NOT NULL,
  `montant_paye` int UNSIGNED NOT NULL,
  `cout_total` int UNSIGNED NOT NULL COMMENT 'represente le cout de la formation + les fraies d''inscription',
  `date_inscription` date NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_apprenant` (`id_apprenant`,`id_formation`),
  KEY `id_formation` (`id_formation`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inscription`
--

INSERT INTO `inscription` (`id`, `id_apprenant`, `id_formation`, `montant_paye`, `cout_total`, `date_inscription`, `date_debut`, `date_fin`, `commentaire`) VALUES
(1, 1, 0, 50000, 60000, '2022-06-03', '2022-06-07', '2022-08-02', ''),
(6, 45, 0, 20000, 0, '2022-06-04', '2022-06-05', '2022-07-31', '');

-- --------------------------------------------------------

--
-- Table structure for table `ouvrage`
--

DROP TABLE IF EXISTS `ouvrage`;
CREATE TABLE IF NOT EXISTS `ouvrage` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) NOT NULL,
  `non_auteur` varchar(25) NOT NULL,
  `edition` varchar(10) NOT NULL,
  `nombre_de_page` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titre` (`titre`,`non_auteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visite`
--

DROP TABLE IF EXISTS `visite`;
CREATE TABLE IF NOT EXISTS `visite` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_visiteur` int UNSIGNED NOT NULL,
  `id_employer` int UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time DEFAULT NULL,
  `raison` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_employer` (`id_employer`),
  KEY `id_visiteur` (`id_visiteur`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `visite`
--

INSERT INTO `visite` (`id`, `id_visiteur`, `id_employer`, `date`, `heure_debut`, `heure_fin`, `raison`) VALUES
(1, 1, 1, '2022-05-26', '13:15:39', '00:00:00', 'travail'),
(40, 1, 1, '2022-05-27', '21:57:00', '22:58:00', 'recuperation de coli'),
(41, 1, 1, '2022-05-27', '22:25:00', '22:28:00', 'dd'),
(42, 45, 1, '2022-06-02', '17:36:00', '19:36:00', 'visite Nr Dnjomou'),
(43, 47, 1, '2022-06-07', '12:15:00', '15:25:00', 'vv');

-- --------------------------------------------------------

--
-- Table structure for table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE IF NOT EXISTS `visiteur` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `cni` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tel` bigint NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tel` (`tel`),
  UNIQUE KEY `CNI` (`cni`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `cni`, `tel`) VALUES
(1, 'Dnjomou', 'loic', 'weedwererfer', 651027093),
(45, 'Moouta', 'jean', 'hsveri', 78555658447),
(46, 'Moou', 'jean', 'hsvericcoc', 7855565844744),
(47, 'Kakeu', 'Curtis', 'fereruf68546', 21688564),
(50, 'noula', 'manou', '48ff9jhefr56', 554886877);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `abonne`
--
ALTER TABLE `abonne`
  ADD CONSTRAINT `abonne_ibfk_1` FOREIGN KEY (`id_visiteur`) REFERENCES `visiteur` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `apprenant`
--
ALTER TABLE `apprenant`
  ADD CONSTRAINT `apprenant_ibfk_1` FOREIGN KEY (`id_visiteur`) REFERENCES `visiteur` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `employer`
--
ALTER TABLE `employer`
  ADD CONSTRAINT `employer_ibfk_1` FOREIGN KEY (`id_visiteur`) REFERENCES `visiteur` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`id_abonne`) REFERENCES `abonne` (`id_visiteur`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `emprunt_ibfk_2` FOREIGN KEY (`id_ouvrage`) REFERENCES `ouvrage` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `formateur`
--
ALTER TABLE `formateur`
  ADD CONSTRAINT `formateur_ibfk_1` FOREIGN KEY (`id_visiteur`) REFERENCES `visiteur` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `formation_ibfk_1` FOREIGN KEY (`id_formateur`) REFERENCES `formateur` (`id_visiteur`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`id_apprenant`) REFERENCES `apprenant` (`id_visiteur`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `visite`
--
ALTER TABLE `visite`
  ADD CONSTRAINT `visite_ibfk_1` FOREIGN KEY (`id_employer`) REFERENCES `employer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `visite_ibfk_2` FOREIGN KEY (`id_visiteur`) REFERENCES `visiteur` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
