-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 mai 2021 à 11:53
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `categorie`) VALUES
(1, 'Maillot'),
(2, 'T-shirt'),
(3, 'sweat'),
(7, 'casquette'),
(6, 'chaussette');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(3) NOT NULL AUTO_INCREMENT,
  `id_membre` int(3) DEFAULT NULL,
  `montant` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `id_etat` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_commande`),
  KEY `id_etat` (`id_etat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `montant`, `date_enregistrement`, `id_etat`) VALUES
(1, 1, 46, '2021-05-04 23:17:24', 2),
(2, 1, 46, '2021-05-04 23:19:57', 4),
(3, 1, 92, '2021-05-04 23:46:50', 1);

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

DROP TABLE IF EXISTS `details_commande`;
CREATE TABLE IF NOT EXISTS `details_commande` (
  `nom` text CHARACTER SET latin1 NOT NULL,
  `prenom` text CHARACTER SET latin1 NOT NULL,
  `adresse` text CHARACTER SET latin1 NOT NULL,
  `telephone` int(15) DEFAULT NULL,
  `code_postal` int(5) DEFAULT NULL,
  `id_details_commande` int(3) NOT NULL AUTO_INCREMENT,
  `id_commande` int(3) DEFAULT NULL,
  `id_produit` int(3) DEFAULT NULL,
  `id_taille` int(11) NOT NULL,
  `quantite` int(3) NOT NULL,
  `prix` int(3) NOT NULL,
  PRIMARY KEY (`id_details_commande`),
  KEY `id_commande` (`id_commande`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `details_commande`
--

INSERT INTO `details_commande` (`nom`, `prenom`, `adresse`, `telephone`, `code_postal`, `id_details_commande`, `id_commande`, `id_produit`, `id_taille`, `quantite`, `prix`) VALUES
('madi', 'fakih', '03 rue abram', 783511976, 13015, 5, 1, 8, 0, 1, 46),
('ronald', 'mac', 'rue hamburger', 1234567890, 13000, 6, 2, 10, 0, 1, 46),
('test', 'test', 'rue test', 783511976, 13015, 7, 3, 10, 0, 1, 46),
('test', 'test', 'rue test', 783511976, 13015, 8, 3, 8, 0, 1, 46);

-- --------------------------------------------------------

--
-- Structure de la table `etat_commande`
--

DROP TABLE IF EXISTS `etat_commande`;
CREATE TABLE IF NOT EXISTS `etat_commande` (
  `id_etat` int(11) NOT NULL AUTO_INCREMENT,
  `etat` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_etat`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `etat_commande`
--

INSERT INTO `etat_commande` (`id_etat`, `etat`) VALUES
(1, 'en cours de traitement'),
(2, 'envoyÃ©'),
(3, 'livrÃ©'),
(4, 'probleme livraison');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int(3) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) CHARACTER SET latin1 NOT NULL,
  `mdp` varchar(255) CHARACTER SET latin1 NOT NULL,
  `nom` varchar(20) CHARACTER SET latin1 NOT NULL,
  `prenom` varchar(20) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `civilite` enum('m','f') CHARACTER SET latin1 NOT NULL,
  `ville` varchar(20) CHARACTER SET latin1 NOT NULL,
  `code_postal` int(5) UNSIGNED ZEROFILL NOT NULL,
  `adresse` varchar(50) CHARACTER SET latin1 NOT NULL,
  `statut` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_membre`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `ville`, `code_postal`, `adresse`, `statut`) VALUES
(1, 'fakih13', 'caaecdd0c31a8528cda16d8e70240c38f46c0e17', 'madi', 'fakih', 'madi.bch@gmail.com', 'm', 'Marseille', 13015, '03 rue abram', 1),
(2, 'nabil13', 'f0200a7c32e9dd996faee8476314a44c87421a2c', 'Test', 'Nabil', 'nabil@gmail.com', 'm', 'Marseille', 13010, '03 rue test', 0),
(4, 'test', 'caaecdd0c31a8528cda16d8e70240c38f46c0e17', 'test', 'test', 'test@gmail.com', 'm', 'Marseille', 13015, '03 rue abram', 0);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(3) NOT NULL AUTO_INCREMENT,
  `reference` varchar(20) CHARACTER SET latin1 NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_sous_categorie` int(11) NOT NULL,
  `titre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `photo` varchar(250) CHARACTER SET latin1 NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_categorie` (`id_categorie`),
  KEY `id_sous_categorie` (`id_sous_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `reference`, `id_categorie`, `id_sous_categorie`, `titre`, `description`, `photo`, `prix`) VALUES
(8, ' 1MR2021', 1, 1, 'Maillot Red', 'test test', '/boutique/photo/1MR2021_Maillot Eros 2021 rouge.png', 45.99),
(9, '1TS2021', 2, 2, 'T-shirt', 't-shirt test 01', '/boutique/photo/1TS2021_tshirt mock up Eros Sport 13.png', 20.99),
(10, '1MYBL2021', 1, 2, 'Maillot Bleu', 'test3 test3', '/boutique/photo/1MYBL2021_Maillot Eros 2021 dÃ©grader bleu.png', 45.99),
(11, '1MYB2021', 1, 1, 'Maillot Yellow', 'test 2 test 2', '/boutique/photo/1MYB2021_Maillot Eros 2021 grafik green.png', 45.99),
(14, '1MR2021', 1, 2, 'Maillot Red', 'test test', '/boutique/photo/1MR2021_Maillot Eros 2021 rouge.png', 45.99),
(15, 'TS2021', 2, 2, 'T-shirt Eros red logo', 'Porter le fameux logo EROS Edition revisit&eacute; Red\r\n100% coton\r\nMade in France\r\n', '/boutique/photo/TS2021_logo-eros-rouge_mockup_Front_Flat_White-Fleck-Triblend.png', 25),
(16, 'MXIIIA2021', 1, 2, 'Maillot MXIIIA', 'Le Maillot MXIIIA by Eros Sport', '/boutique/photo/MXIIIA2021_maillot entrainement 2021 no bg.png', 65),
(20, 'TEROS', 2, 1, 'T-shirt  Eros Abeille', 'BZZZZZ', '/boutique/photo/TEROS_bee-705412_1280_mockup_Front_Flat_White.png', 30),
(27, '    1459872', 1, 1, 'maillot 159', 'test ajout maillot', '/boutique/photo/maillot_green.png', 20.99);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

DROP TABLE IF EXISTS `sous_categorie`;
CREATE TABLE IF NOT EXISTS `sous_categorie` (
  `id_sous_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_sous_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id_sous_categorie`, `nom`) VALUES
(1, 'rugby'),
(2, 'football');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `commande-details_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
