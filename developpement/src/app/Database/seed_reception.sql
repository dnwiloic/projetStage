-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 26 mai 2022 à 07:30
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `seed_reception`
--

-- --------------------------------------------------------

--
-- Structure de la table `employer`
--

DROP TABLE IF EXISTS `employer`;
CREATE TABLE IF NOT EXISTS `employer` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `employer`
--

INSERT INTO `employer` (`id`, `login`, `password`) VALUES
(1, 'loic', '3c91f63f8f292d1827a84b746b4323fa3d049803');

-- --------------------------------------------------------

--
-- Structure de la table `visite`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE IF NOT EXISTS `visiteur` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `CNI` varchar(50) DEFAULT NULL,
  `tel` bigint NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tel` (`tel`),
  UNIQUE KEY `CNI` (`CNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `visite`
--
ALTER TABLE `visite`
  ADD CONSTRAINT `visite_ibfk_1` FOREIGN KEY (`id_employer`) REFERENCES `employer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `visite_ibfk_2` FOREIGN KEY (`id_visiteur`) REFERENCES `visiteur` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
