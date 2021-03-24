-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 24 mars 2021 à 11:15
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
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(3) NOT NULL AUTO_INCREMENT,
  `id_membre` int(3) DEFAULT NULL,
  `montant` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `etat` enum('en cours de traitement','envoyé','livré') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_commande`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `montant`, `date_enregistrement`, `etat`) VALUES
(1, 1, 46, '2021-03-24 02:17:05', 'en cours de traitement'),
(2, 1, 0, '2021-03-24 02:23:47', 'en cours de traitement'),
(3, 1, 0, '2021-03-24 02:24:15', 'en cours de traitement'),
(4, 1, 46, '2021-03-24 02:24:37', 'en cours de traitement'),
(5, 1, 25, '2021-03-24 02:28:46', 'en cours de traitement');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

DROP TABLE IF EXISTS `details_commande`;
CREATE TABLE IF NOT EXISTS `details_commande` (
  `id_details_commande` int(3) NOT NULL AUTO_INCREMENT,
  `id_commande` int(3) DEFAULT NULL,
  `id_produit` int(3) DEFAULT NULL,
  `quantite` int(3) NOT NULL,
  `prix` int(3) NOT NULL,
  PRIMARY KEY (`id_details_commande`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `details_commande`
--

INSERT INTO `details_commande` (`id_details_commande`, `id_commande`, `id_produit`, `quantite`, `prix`) VALUES
(1, 1, 14, 1, 46),
(2, 4, 14, 1, 46),
(3, 5, 15, 1, 25);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int(3) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) CHARACTER SET latin1 NOT NULL,
  `mdp` varchar(32) CHARACTER SET latin1 NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `ville`, `code_postal`, `adresse`, `statut`) VALUES
(1, 'fakih13', 'fakih13003', 'madi', 'fakih', 'madi.bch@gmail.com', 'm', 'Marseille', 13015, '03 rue abram', 1),
(2, 'nabil13', 'nabil13010', 'Test', 'Nabil', 'nabil@gmail.com', 'm', 'Marseille', 13010, '03 rue test', 0),
(3, 'test', 'test', 'test', 'test', 'test@hotmail.com', 'm', 'Marseille', 13001, '03 boulevard test', 0);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(3) NOT NULL AUTO_INCREMENT,
  `reference` varchar(20) CHARACTER SET latin1 NOT NULL,
  `categorie` varchar(20) CHARACTER SET latin1 NOT NULL,
  `titre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `couleur` varchar(20) CHARACTER SET latin1 NOT NULL,
  `taille` varchar(5) CHARACTER SET latin1 NOT NULL,
  `public` enum('m','f','mixte') CHARACTER SET latin1 NOT NULL,
  `photo` varchar(250) CHARACTER SET latin1 NOT NULL,
  `prix` float NOT NULL,
  `stock` int(3) NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `reference`, `categorie`, `titre`, `description`, `couleur`, `taille`, `public`, `photo`, `prix`, `stock`) VALUES
(8, '1MR2021', 'Maillot', 'Maillot Red', 'test test', 'rouge', 'S', 'm', '/boutique/photo/1MR2021_Maillot Eros 2021 rouge.png', 45.99, 100),
(9, '1TS2021', 'T-shirt', 'T-shirt', 't-shirt test 01', 'Blanc', 'S', 'm', '/boutique/photo/1TS2021_tshirt mock up Eros Sport 13.png', 20.99, 100),
(10, '1MYBL2021', 'Maillot', 'Maillot Bleu', 'test3 test3', 'blue', 'S', 'f', '/boutique/photo/1MYBL2021_Maillot Eros 2021 dÃ©grader bleu.png', 45.99, 200),
(11, '1MYB2021', 'Maillot', 'Maillot Yellow', 'test 2 test 2', 'yellow', 'S', 'm', '/boutique/photo/1MYB2021_Maillot Eros 2021 grafik green.png', 45.99, 300),
(14, '1MR2021', 'Maillot', 'Maillot Red', 'test test', 'rouge', 'M', 'm', '/boutique/photo/1MR2021_Maillot Eros 2021 rouge.png', 45.99, 100),
(15, 'TS2021', 'T-shirt', 'T-shirt Eros red logo', 'Porter le fameux logo EROS Edition revisit&eacute; Red\r\n100% coton\r\nMade in France\r\n', 'blanc', 'S', 'f', '/boutique/photo/TS2021_logo-eros-rouge_mockup_Front_Flat_White-Fleck-Triblend.png', 25, 100),
(16, 'MXIIIA2021', 'Maillot', 'Maillot MXIIIA', 'Le Maillot MXIIIA by Eros Sport', 'bleu', 'S', 'm', '/boutique/photo/MXIIIA2021_maillot entrainement 2021 no bg.png', 65, 200);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
