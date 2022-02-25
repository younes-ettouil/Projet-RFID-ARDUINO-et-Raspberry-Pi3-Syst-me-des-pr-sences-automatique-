-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 19 fév. 2022 à 11:19
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_rfid`
--

-- --------------------------------------------------------

--
-- Structure de la table `login_user`
--

CREATE TABLE `login_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `login_user`
--

INSERT INTO `login_user` (`id`, `name`, `user_name`, `password`) VALUES
(1, 'Admin', 'Admin@lsi.ma', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `nomModule` varchar(50) NOT NULL,
  `idSemestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id`, `nomModule`, `idSemestre`) VALUES
(1, 'C++', 1),
(2, 'Tec', 1),
(3, 'Mathématique pour l\'ingérnieur', 1),
(4, 'Base de donnée', 1),
(5, 'Réseaux', 1),
(6, 'Architecture des ordinateur && Linux', 1),
(7, 'Java && Mobile', 2),
(8, 'Statistique', 2),
(9, 'Management && comptabilité', 2),
(10, 'FrameWorks && Dev Web', 2),
(11, 'UML', 2),
(12, 'Théorie des graphes', 2);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `idSemestre` int(11) NOT NULL,
  `rfid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id`, `Nom`, `Prenom`, `Role`, `idSemestre`, `rfid_id`) VALUES
(37, 'Zili', 'Hassan', 'enseignant', 5, 9),
(38, 'Aachak', 'Lotfi', 'enseignant', 4, 10),
(39, 'Ghadi', 'Abderahim', 'enseignant', 4, 11),
(40, 'ETTOUIL', 'Younes', 'etudiant', 4, 12),
(41, 'Tlemzi', 'Fatima', 'etudiant', 4, 13),
(42, 'Salmi', 'Ali', 'etudiant', 2, 14),
(43, 'Lazrek', 'Imane', 'etudiant', 4, 15);

-- --------------------------------------------------------

--
-- Structure de la table `presence`
--

CREATE TABLE `presence` (
  `id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `idPersonne` int(11) NOT NULL,
  `idModule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `rfid`
--

CREATE TABLE `rfid` (
  `id` int(11) NOT NULL,
  `rfid` varchar(50) NOT NULL,
  `bookedUp` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rfid`
--

INSERT INTO `rfid` (`id`, `rfid`, `bookedUp`) VALUES
(9, '44 B6 A 85', 1),
(10, '5 1 6C 63', 1),
(11, 'HA 7 0A 61', 1),
(12, 'HA 7 0B 78', 1),
(13, '16 FF 1F 9E', 1),
(14, 'HA 7 0A 60', 1),
(15, '4 6F 38 42', 1),
(16, 'AB CD EF GH', 1);

-- --------------------------------------------------------

--
-- Structure de la table `semestre`
--

CREATE TABLE `semestre` (
  `id` int(11) NOT NULL,
  `nomSemestre` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `semestre`
--

INSERT INTO `semestre` (`id`, `nomSemestre`) VALUES
(1, 'S1'),
(2, 'S2'),
(3, 'S3'),
(4, 'S4'),
(5, 'S5'),
(6, 'S6');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSemestre` (`idSemestre`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSemestre` (`idSemestre`),
  ADD KEY `rfid_id` (`rfid_id`),
  ADD KEY `rfid_id_2` (`rfid_id`);

--
-- Index pour la table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPersonne` (`idPersonne`),
  ADD KEY `idModule` (`idModule`);

--
-- Index pour la table `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `presence`
--
ALTER TABLE `presence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `semestre`
--
ALTER TABLE `semestre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_2` FOREIGN KEY (`idSemestre`) REFERENCES `semestre` (`id`);

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `personne_ibfk_1` FOREIGN KEY (`idSemestre`) REFERENCES `semestre` (`id`),
  ADD CONSTRAINT `personne_ibfk_2` FOREIGN KEY (`rfid_id`) REFERENCES `rfid` (`id`);

--
-- Contraintes pour la table `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `presence_ibfk_1` FOREIGN KEY (`idModule`) REFERENCES `module` (`id`),
  ADD CONSTRAINT `presence_ibfk_2` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
