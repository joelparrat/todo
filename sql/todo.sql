-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 11 Janvier 2019 à 00:12
-- Version du serveur :  5.7.24-0ubuntu0.18.04.1
-- Version de PHP :  7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `todo`
--

-- --------------------------------------------------------

--
-- Structure de la table `act`
--

CREATE TABLE `act` (
  `clf` int(11) NOT NULL,
  `lst` int(11) NOT NULL,
  `txt` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `act`
--

INSERT INTO `act` (`clf`, `lst`, `txt`) VALUES
(1, 1, 'revendre licence windows'),
(3, 10, 'preparer expose todo');

-- --------------------------------------------------------

--
-- Structure de la table `jnt`
--

CREATE TABLE `jnt` (
  `nom` int(11) NOT NULL,
  `lst` int(11) NOT NULL,
  `drt` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jnt`
--

INSERT INTO `jnt` (`nom`, `lst`, `drt`) VALUES
(1, 1, 0),
(1, 2, 1),
(2, 1, 1),
(2, 2, 0),
(2, 10, 0);

-- --------------------------------------------------------

--
-- Structure de la table `lst`
--

CREATE TABLE `lst` (
  `clf` int(11) NOT NULL,
  `lst` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lst`
--

INSERT INTO `lst` (`clf`, `lst`) VALUES
(1, 'logiciel'),
(2, 'courses'),
(10, 'rendez-vous');

-- --------------------------------------------------------

--
-- Structure de la table `usr`
--

CREATE TABLE `usr` (
  `clf` int(11) NOT NULL,
  `lgn` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pwd` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `exs` int(1) NOT NULL DEFAULT '0',
  `drt` int(1) NOT NULL DEFAULT '0',
  `prn` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nom` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `usr`
--

INSERT INTO `usr` (`clf`, `lgn`, `pwd`, `exs`, `drt`, `prn`, `nom`) VALUES
(1, 'jojo', '12345678', 1, 0, 'joel', 'parrat'),
(2, 'coco42', '12345678', 1, 0, 'corinne', 'coupier');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `act`
--
ALTER TABLE `act`
  ADD PRIMARY KEY (`clf`),
  ADD KEY `lst` (`lst`);

--
-- Index pour la table `jnt`
--
ALTER TABLE `jnt`
  ADD PRIMARY KEY (`nom`,`lst`),
  ADD KEY `nom` (`nom`),
  ADD KEY `lst` (`lst`);

--
-- Index pour la table `lst`
--
ALTER TABLE `lst`
  ADD PRIMARY KEY (`clf`);

--
-- Index pour la table `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`clf`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `act`
--
ALTER TABLE `act`
  MODIFY `clf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `lst`
--
ALTER TABLE `lst`
  MODIFY `clf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `usr`
--
ALTER TABLE `usr`
  MODIFY `clf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `act`
--
ALTER TABLE `act`
  ADD CONSTRAINT `FK_ACT_LST` FOREIGN KEY (`lst`) REFERENCES `lst` (`clf`);

--
-- Contraintes pour la table `jnt`
--
ALTER TABLE `jnt`
  ADD CONSTRAINT `FK_JNT_LST` FOREIGN KEY (`lst`) REFERENCES `lst` (`clf`),
  ADD CONSTRAINT `FK_JNT_USR` FOREIGN KEY (`nom`) REFERENCES `usr` (`clf`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
