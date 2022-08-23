-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 24, 2022 at 08:39 AM
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

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `add_entree_argent`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_entree_argent` (IN `p_date` DATE, IN `p_somme` INT, IN `p_motif` VARCHAR(255) CHARSET utf8)  INSERT INTO mouvement_argent(date,somme,motif,type) VALUES(p_date,p_somme,p_motif,'Entrée')$$

DROP PROCEDURE IF EXISTS `add_sortie_argent`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_sortie_argent` (IN `p_date` DATE, IN `p_somme` INT, IN `p_motif` VARCHAR(255) CHARSET utf8)  INSERT INTO mouvement_argent(date,somme,motif,type) VALUES(p_date,p_somme,p_motif,'Sortie')$$

DROP PROCEDURE IF EXISTS `get_abn_eligible`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_abn_eligible` ()  SELECT * FROM visiteur_abonne WHERE montant_verse=cout_abonnement
AND date_expiration > now()$$

DROP PROCEDURE IF EXISTS `get_entrees_argent`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_entrees_argent` ()  SELECT * from mouvement_argent
WHERE type = 'Entrée'$$

DROP PROCEDURE IF EXISTS `get_sorties_argent`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sorties_argent` ()  SELECT * FROM mouvement_argent
WHERE type="Sortie"$$

DROP PROCEDURE IF EXISTS `get_visites`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_visites` ()  SELECT nom, prenom, login, raison, date, heure_debut, heure_fin FROM v_visite$$

DROP PROCEDURE IF EXISTS `get_visiteurs_abonnes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_visiteurs_abonnes` ()  SELECT id_visiteur,nom, cni, tel ,prenom ,montant_verse, cout_abonnement,date_inscription,date_expiration
,carte_membre_genere from visiteur_abonne$$

DROP PROCEDURE IF EXISTS `get_visiteurs_apprenants`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_visiteurs_apprenants` ()  SELECT * from visiteur_apprenant$$

DROP PROCEDURE IF EXISTS `get_visiteurs_formateurs`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_visiteurs_formateurs` ()  SELECT id_visiteur,nom, cni, tel ,prenom from visiteur_abonne$$

DROP PROCEDURE IF EXISTS `get_v_emprunt`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_v_emprunt` ()  SELECT id ,nom ,prenom, titre,nom_auteur, date_emprunt, date_retour_prevu, date_retour_effectif, feelback FROM v_emprunt$$

DROP PROCEDURE IF EXISTS `get_v_formations`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_v_formations` ()  SELECT id, nom, prix, duree, commentaire, nom_formateur, prenom FROM v_formation$$

DROP PROCEDURE IF EXISTS `get_v_inscription`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_v_inscription` ()  SELECT id, nomA, prenomA, nomF,montant_paye, cout_total,date_inscription, date_debut, date_fin, commentaire FROM v_inscription$$

DELIMITER ;

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
(1, 15000, 15000, '2022-06-09', '2023-06-09', 1),
(45, 10000, 15000, '2022-06-06', '2023-06-06', 1),
(46, 10000, 15000, '2022-06-22', '2023-06-22', 1),
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `id_visiteur`, `login`, `password`) VALUES
(1, 1, 'seed', '21602161fea158a8f0a817031d0ecc1d3727347c'),
(2, 45, '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `emprunt`
--

INSERT INTO `emprunt` (`id`, `id_ouvrage`, `id_abonne`, `date_emprunt`, `date_retour_prevu`, `date_retour_effectif`, `feelback`) VALUES
(8, 1, 1, '2022-06-09', '2022-07-09', '0000-00-00', '');

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
-- Table structure for table `mouvement_argent`
--

DROP TABLE IF EXISTS `mouvement_argent`;
CREATE TABLE IF NOT EXISTS `mouvement_argent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `somme` int NOT NULL,
  `motif` varchar(50) NOT NULL,
  `type` enum('Entrée','Sortie') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mouvement_argent`
--

INSERT INTO `mouvement_argent` (`id`, `date`, `somme`, `motif`, `type`) VALUES
(1, '2022-08-09', 15000, 'abonnement', 'Entrée'),
(2, '2022-08-09', 2000, 'Eau potable', 'Sortie'),
(3, '2022-08-10', 15000, 'abonnement', 'Entrée'),
(5, '2022-08-10', 10000, 'transport pour courses', 'Sortie');

-- --------------------------------------------------------

--
-- Table structure for table `ouvrage`
--

DROP TABLE IF EXISTS `ouvrage`;
CREATE TABLE IF NOT EXISTS `ouvrage` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) NOT NULL,
  `nom_auteur` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `edition` varchar(10) NOT NULL,
  `nombre_de_page` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titre` (`titre`,`nom_auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ouvrage`
--

INSERT INTO `ouvrage` (`id`, `titre`, `nom_auteur`, `edition`, `nombre_de_page`) VALUES
(1, 'cdshjsc', 'dsdkjn', 'jdcsj', 45),
(2, 'Sous la cendre le feu', 'Eveline', '2002', 245),
(3, 'Les secrets', 'Eker', '2001', 200);

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `visite`
--

INSERT INTO `visite` (`id`, `id_visiteur`, `id_employer`, `date`, `heure_debut`, `heure_fin`, `raison`) VALUES
(1, 1, 1, '2022-05-26', '13:15:39', '00:00:00', 'travail'),
(40, 1, 1, '2022-05-27', '21:57:00', '22:58:00', 'recuperation de coli'),
(41, 1, 1, '2022-05-27', '22:25:00', '22:28:00', 'dd'),
(42, 45, 1, '2022-06-02', '17:36:00', '19:36:00', 'visite Nr Dnjomou'),
(43, 47, 1, '2022-06-07', '12:15:00', '15:25:00', 'vv'),
(44, 45, 1, '2022-06-15', '11:57:00', '13:59:00', 'rien'),
(45, 46, 1, '2022-06-17', '17:58:00', NULL, '');

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

-- --------------------------------------------------------

--
-- Stand-in structure for view `visiteur_abonne`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `visiteur_abonne`;
CREATE TABLE IF NOT EXISTS `visiteur_abonne` (
`id` int unsigned
,`nom` varchar(25)
,`prenom` varchar(25)
,`cni` varchar(50)
,`tel` bigint
,`id_visiteur` int unsigned
,`montant_verse` int unsigned
,`cout_abonnement` int unsigned
,`date_inscription` date
,`date_expiration` date
,`carte_membre_genere` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `visiteur_apprenant`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `visiteur_apprenant`;
CREATE TABLE IF NOT EXISTS `visiteur_apprenant` (
`id` int unsigned
,`nom` varchar(25)
,`prenom` varchar(25)
,`cni` varchar(50)
,`tel` bigint
,`matricule` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `visiteur_formateur`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `visiteur_formateur`;
CREATE TABLE IF NOT EXISTS `visiteur_formateur` (
`id` int unsigned
,`nom` varchar(25)
,`prenom` varchar(25)
,`cni` varchar(50)
,`tel` bigint
,`id_visiteur` int unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_emprunt`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `v_emprunt`;
CREATE TABLE IF NOT EXISTS `v_emprunt` (
`id` int unsigned
,`id_ouvrage` int unsigned
,`id_abonne` int unsigned
,`date_emprunt` date
,`date_retour_prevu` date
,`date_retour_effectif` date
,`feelback` varchar(50)
,`titre` varchar(25)
,`nom_auteur` varchar(25)
,`edition` varchar(10)
,`nombre_de_page` int
,`nom` varchar(25)
,`prenom` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_formation`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `v_formation`;
CREATE TABLE IF NOT EXISTS `v_formation` (
`id` int unsigned
,`nom` varchar(25)
,`prix` int unsigned
,`duree` int unsigned
,`commentaire` text
,`id_formateur` int unsigned
,`nom_formateur` varchar(25)
,`prenom` varchar(25)
,`cni` varchar(50)
,`tel` bigint
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_inscription`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `v_inscription`;
CREATE TABLE IF NOT EXISTS `v_inscription` (
`id` int unsigned
,`id_apprenant` int unsigned
,`id_formation` int unsigned
,`montant_paye` int unsigned
,`cout_total` int unsigned
,`date_inscription` date
,`date_debut` date
,`date_fin` date
,`commentaire` text
,`nomA` varchar(25)
,`prenomA` varchar(25)
,`nomF` varchar(25)
,`prixF` int unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_visite`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `v_visite`;
CREATE TABLE IF NOT EXISTS `v_visite` (
`nom` varchar(25)
,`prenom` varchar(25)
,`cni` varchar(50)
,`tel` bigint
,`login` varchar(30)
,`id` int unsigned
,`id_visiteur` int unsigned
,`id_employer` int unsigned
,`date` date
,`heure_debut` time
,`heure_fin` time
,`raison` text
);

-- --------------------------------------------------------

--
-- Structure for view `visiteur_abonne`
--
DROP TABLE IF EXISTS `visiteur_abonne`;

DROP VIEW IF EXISTS `visiteur_abonne`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `visiteur_abonne`  AS SELECT `visiteur`.`id` AS `id`, `visiteur`.`nom` AS `nom`, `visiteur`.`prenom` AS `prenom`, `visiteur`.`cni` AS `cni`, `visiteur`.`tel` AS `tel`, `abonne`.`id_visiteur` AS `id_visiteur`, `abonne`.`montant_verse` AS `montant_verse`, `abonne`.`cout_abonnement` AS `cout_abonnement`, `abonne`.`date_inscription` AS `date_inscription`, `abonne`.`date_expiration` AS `date_expiration`, `abonne`.`carte_membre_genere` AS `carte_membre_genere` FROM (`visiteur` join `abonne`) WHERE (`visiteur`.`id` = `abonne`.`id_visiteur`) ;

-- --------------------------------------------------------

--
-- Structure for view `visiteur_apprenant`
--
DROP TABLE IF EXISTS `visiteur_apprenant`;

DROP VIEW IF EXISTS `visiteur_apprenant`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `visiteur_apprenant`  AS SELECT `visiteur`.`id` AS `id`, `visiteur`.`nom` AS `nom`, `visiteur`.`prenom` AS `prenom`, `visiteur`.`cni` AS `cni`, `visiteur`.`tel` AS `tel`, `apprenant`.`matricule` AS `matricule` FROM (`visiteur` join `apprenant`) WHERE (`visiteur`.`id` = `apprenant`.`id_visiteur`) ;

-- --------------------------------------------------------

--
-- Structure for view `visiteur_formateur`
--
DROP TABLE IF EXISTS `visiteur_formateur`;

DROP VIEW IF EXISTS `visiteur_formateur`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `visiteur_formateur`  AS SELECT `visiteur`.`id` AS `id`, `visiteur`.`nom` AS `nom`, `visiteur`.`prenom` AS `prenom`, `visiteur`.`cni` AS `cni`, `visiteur`.`tel` AS `tel`, `formateur`.`id_visiteur` AS `id_visiteur` FROM (`visiteur` join `formateur`) WHERE (`visiteur`.`id` = `formateur`.`id_visiteur`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_emprunt`
--
DROP TABLE IF EXISTS `v_emprunt`;

DROP VIEW IF EXISTS `v_emprunt`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_emprunt`  AS SELECT `emprunt`.`id` AS `id`, `emprunt`.`id_ouvrage` AS `id_ouvrage`, `emprunt`.`id_abonne` AS `id_abonne`, `emprunt`.`date_emprunt` AS `date_emprunt`, `emprunt`.`date_retour_prevu` AS `date_retour_prevu`, `emprunt`.`date_retour_effectif` AS `date_retour_effectif`, `emprunt`.`feelback` AS `feelback`, `ouvrage`.`titre` AS `titre`, `ouvrage`.`nom_auteur` AS `nom_auteur`, `ouvrage`.`edition` AS `edition`, `ouvrage`.`nombre_de_page` AS `nombre_de_page`, `visiteur`.`nom` AS `nom`, `visiteur`.`prenom` AS `prenom` FROM ((`emprunt` join `ouvrage`) join `visiteur`) WHERE ((`emprunt`.`id_ouvrage` = `ouvrage`.`id`) AND (`emprunt`.`id_abonne` = `visiteur`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_formation`
--
DROP TABLE IF EXISTS `v_formation`;

DROP VIEW IF EXISTS `v_formation`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_formation`  AS SELECT `formation`.`id` AS `id`, `formation`.`nom` AS `nom`, `formation`.`prix` AS `prix`, `formation`.`duree` AS `duree`, `formation`.`commentaire` AS `commentaire`, `formation`.`id_formateur` AS `id_formateur`, `visiteur`.`nom` AS `nom_formateur`, `visiteur`.`prenom` AS `prenom`, `visiteur`.`cni` AS `cni`, `visiteur`.`tel` AS `tel` FROM (`visiteur` join `formation`) WHERE (`visiteur`.`id` = `formation`.`id_formateur`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_inscription`
--
DROP TABLE IF EXISTS `v_inscription`;

DROP VIEW IF EXISTS `v_inscription`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_inscription`  AS SELECT `inscription`.`id` AS `id`, `inscription`.`id_apprenant` AS `id_apprenant`, `inscription`.`id_formation` AS `id_formation`, `inscription`.`montant_paye` AS `montant_paye`, `inscription`.`cout_total` AS `cout_total`, `inscription`.`date_inscription` AS `date_inscription`, `inscription`.`date_debut` AS `date_debut`, `inscription`.`date_fin` AS `date_fin`, `inscription`.`commentaire` AS `commentaire`, `visiteur`.`nom` AS `nomA`, `visiteur`.`prenom` AS `prenomA`, `formation`.`nom` AS `nomF`, `formation`.`prix` AS `prixF` FROM ((`inscription` join `visiteur`) join `formation`) WHERE ((`visiteur`.`id` = `inscription`.`id_apprenant`) AND (`inscription`.`id_formation` = `formation`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_visite`
--
DROP TABLE IF EXISTS `v_visite`;

DROP VIEW IF EXISTS `v_visite`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_visite`  AS SELECT `visiteur`.`nom` AS `nom`, `visiteur`.`prenom` AS `prenom`, `visiteur`.`cni` AS `cni`, `visiteur`.`tel` AS `tel`, `employer`.`login` AS `login`, `visite`.`id` AS `id`, `visite`.`id_visiteur` AS `id_visiteur`, `visite`.`id_employer` AS `id_employer`, `visite`.`date` AS `date`, `visite`.`heure_debut` AS `heure_debut`, `visite`.`heure_fin` AS `heure_fin`, `visite`.`raison` AS `raison` FROM ((`visiteur` join `employer`) join `visite`) WHERE ((`visiteur`.`id` = `visite`.`id_visiteur`) AND (`visite`.`id_employer` = `employer`.`id`)) ;

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
