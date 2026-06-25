 -- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 06 déc. 2025 à 12:40
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `cin` varchar(8) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `groupe` varchar(5) NOT NULL,
  `moyenne` float NOT NULL,
  `anne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matier`
--

CREATE TABLE `matier` (
  `idm` int(8) NOT NULL,
  `nomM` text NOT NULL,
  `moy` float NOT NULL,
  `cin` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE `matieres` (
  `nomMat` varchar(100) NOT NULL,
  `coeff` float NOT NULL,
  `type` (1) NOT NULL,
  `anne` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`nomMat`, `coeff`, `type`, `anne`) VALUES
('Algèbre 1', 1.5, 'p', 1),
('Algorithmique et structure de données', 2, 'p', 1),
('Analyse 1', 1.5, 'p', 1),
('Anglais 1', 1, 's', 1),
('Atelier programmation 1', 2, 'p', 1),
('Logique formelle', 1.5, 'p', 1),
('Système d exploitation 1', 1.5, 'p', 1),
('Systèmes logiques et architecture des ordinateurs', 2, 'p', 1),
('Techniques de communication 1', 1, 's', 1),
('Technologies multimédias', 1.5, 'p', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`cin`);

--
-- Index pour la table `matier`
--
ALTER TABLE `matier`
  ADD PRIMARY KEY (`idm`),
  ADD KEY `cin` (`cin`);

--
-- Index pour la table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`nomMat`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `matier`
--
ALTER TABLE `matier`
  MODIFY `idm` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `matier`
--
ALTER TABLE `matier`
  ADD CONSTRAINT `r1` FOREIGN KEY (`cin`) REFERENCES `etudiant` (`cin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
