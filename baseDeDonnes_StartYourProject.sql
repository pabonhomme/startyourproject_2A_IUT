-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : jeu. 01 avr. 2021 à 13:08
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `startyourproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `estmembre`
--

DROP TABLE IF EXISTS `estmembre`;
CREATE TABLE IF NOT EXISTS `estmembre` (
  `idProjet` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  KEY `idProjet` (`idProjet`) USING BTREE,
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `estmembre`
--

INSERT INTO `estmembre` (`idProjet`, `email`, `role`) VALUES
(79, 'meriem@gmail.com', 'chefProjet'),
(80, 'meriem@gmail.com', 'chefProjet'),
(82, 'meriem@gmail.com', 'chefProjet'),
(83, 'meriem@gmail.com', 'chefProjet'),
(84, 'polo.clash@gmail.com', 'chefProjet'),
(84, 'meriem@gmail.com', 'utilisateur'),
(84, 'noe.chevassus@orange.fr', 'utilisateur'),
(84, 'theo.nicolas63@gmail.com', 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `idProjet` int(200) NOT NULL AUTO_INCREMENT,
  `nomProjet` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `budget` float NOT NULL,
  `date` date NOT NULL,
  `estTermine` tinyint(1) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`idProjet`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`idProjet`, `nomProjet`, `description`, `budget`, `date`, `estTermine`, `email`) VALUES
(79, 'Projet 1', 'test2', 0, '2021-03-19', 0, 'meriem@gmail.com'),
(80, 'projet 2', 'test3', 0, '2021-03-19', 1, 'meriem@gmail.com'),
(82, 'projet 3', 'description', 3000, '2021-03-19', 0, 'meriem@gmail.com'),
(83, 'projet 4', 'test test', 0, '2021-03-19', 0, 'meriem@gmail.com'),
(84, 'projet 5', 'On a un super projet commun', 500, '2021-03-21', 0, 'polo.clash@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `idTache` int(200) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `idProjet` int(200) NOT NULL,
  `nomTache` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `cout` int(200) NOT NULL,
  `dateDebut` date NOT NULL,
  `duree` int(11) NOT NULL,
  PRIMARY KEY (`idTache`),
  KEY `idProjet` (`idProjet`),
  KEY `login` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`idTache`, `email`, `idProjet`, `nomTache`, `description`, `cout`, `dateDebut`, `duree`) VALUES
(49, 'meriem@gmail.com', 79, 'faire à manger', 'wow', 15, '2021-03-21', 2),
(50, 'meriem@gmail.com', 79, 'oui', 'gogogg', 3, '2021-03-20', 5),
(51, 'meriem@gmail.com', 83, 'sprint', 'gogogg', 15, '2021-03-24', 5),
(52, 'meriem@gmail.com', 79, 'ouioui', 'ah ban', 3, '2021-03-20', 20),
(53, 'polo.clash@gmail.com', 84, 'Faire le ramadan', 'C\'est long', 100, '2021-03-17', 1),
(54, 'polo.clash@gmail.com', 84, 'Apprendre git', 'ça va être dur...', 900, '2021-03-15', 2),
(55, 'polo.clash@gmail.com', 84, 'Devenir musclé', 'Le chemin va être long..', 2, '2021-03-16', 4),
(56, 'meriem@gmail.com', 84, 'faire du sport', 'waouuw', 15, '2021-03-16', 25),
(57, 'meriem@gmail.com', 79, 'oui', 'ah ban', 15, '2021-03-22', 5),
(58, 'meriem@gmail.com', 79, 'oui', 'gogogg', 15, '2021-03-17', 20),
(59, 'meriem@gmail.com', 79, 'test action', 'ça va être dur...', 15, '2021-03-16', 5),
(60, 'meriem@gmail.com', 79, 'test action 2', 'ah ban', 15, '2021-03-15', 5),
(61, 'meriem@gmail.com', 79, 'faire à manger', 'gogogg', 15, '2021-03-15', 5),
(62, 'meriem@gmail.com', 79, 'test nouveau', 'test tes tes', 15, '2021-03-23', 2),
(63, 'meriem@gmail.com', 79, 'test ajout tache', 'miam', 15, '2021-03-22', 2),
(64, 'meriem@gmail.com', 79, 'test ajout tache 2', 'C\'est long', 3, '2021-03-16', 4),
(65, 'meriem@gmail.com', 84, 'courir', 'ah ban', 15, '2021-03-16', 20),
(66, 'meriem@gmail.com', 82, 'Faire à manger', 'nous avons faim', 50, '2021-03-31', 2),
(67, 'meriem@gmail.com', 82, 'tondre la pelouse', 'il faut le faire', 500, '2021-03-29', 5),
(68, 'meriem@gmail.com', 82, 'Acheter des courses ', 'J\'ai envie de chocolat', 70, '2021-04-02', 10);

-- --------------------------------------------------------

--
-- Structure de la table `travaille`
--

DROP TABLE IF EXISTS `travaille`;
CREATE TABLE IF NOT EXISTS `travaille` (
  `emailMembre` varchar(200) NOT NULL,
  `idTache` int(200) NOT NULL,
  KEY `emailMembre` (`emailMembre`,`idTache`),
  KEY `idtache_fk` (`idTache`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `travaille`
--

INSERT INTO `travaille` (`emailMembre`, `idTache`) VALUES
('meriem@gmail.com', 50),
('meriem@gmail.com', 51),
('meriem@gmail.com', 52),
('meriem@gmail.com', 53),
('meriem@gmail.com', 58),
('meriem@gmail.com', 63),
('meriem@gmail.com', 64),
('meriem@gmail.com', 66),
('meriem@gmail.com', 67),
('meriem@gmail.com', 68),
('noe.chevassus@orange.fr', 54),
('theo.nicolas63@gmail.com', 55),
('theo.nicolas63@gmail.com', 56),
('theo.nicolas63@gmail.com', 65);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `email` varchar(200) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `motdepasse` varchar(200) NOT NULL,
  `estRempli` tinyint(1) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email`, `nom`, `prenom`, `motdepasse`, `estRempli`) VALUES
('meriem@gmail.com', 'hansali', 'meriem', '$2y$10$kkOvXx2szoztbLxgbotqY.b79I1auUuL7HF9Bp2JBXmx1L.yKlwg2', 1),
('mimi@gmail.com', 'Hansali', 'Meriem', '$2y$10$kkOvXx2szoztbLxgbotqY.b79I1auUuL7HF9Bp2JBXmx1L.yKlwg2', 1),
('noe.chevassus@orange.fr', 'Chevassus', 'Noé', '$2y$10$3SYettufuG5cPoEJPEu6L.PqVSXovWbBpvlEVobX8OmxgTZk1LLKW', 1),
('polo.clash@gmail.com', 'Bonhomme', 'Paul', '$2y$10$yVRrtZFA5nQsAzzXWDUT/.Z0tyKD2Fzsy84LAxhb77c9elo77HTem', 1),
('theo.nicolas63@gmail.com', 'Nicolas', 'Théo', '$2y$10$gAkz3Dcy9B58Bgn887IdO.Lb3nDKhhpSCUkMD.8v5BA7A9yLHZ2.O', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `estmembre`
--
ALTER TABLE `estmembre`
  ADD CONSTRAINT `email_FKEY` FOREIGN KEY (`email`) REFERENCES `utilisateur` (`email`),
  ADD CONSTRAINT `idProjet_FKEY` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`idProjet`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`email`) REFERENCES `utilisateur` (`email`);

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `fk` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`idProjet`),
  ADD CONSTRAINT `fk_login` FOREIGN KEY (`email`) REFERENCES `utilisateur` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
