-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 23 avr. 2024 à 11:05
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site_rencontre`
--

-- --------------------------------------------------------

--
-- Structure de la table `confession`
--

CREATE TABLE `confession` (
  `id_confession` int(11) NOT NULL,
  `religion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `confession`
--

INSERT INTO `confession` (`id_confession`, `religion`) VALUES
(1, 'Juive'),
(2, 'Musulmane'),
(3, 'Chrétienne'),
(4, 'Boudhiste'),
(5, 'Agnostique'),
(6, 'Athée');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id_message` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date_message` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_crush` int(11) NOT NULL,
  `statut` enum('vu','non_vu') NOT NULL DEFAULT 'non_vu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id_message`, `message`, `date_message`, `id_user`, `id_crush`, `statut`) VALUES
(62, 'Salut bg ', '2024-03-05', 42, 37, 'vu'),
(63, 'test', '2024-03-05', 42, 37, 'vu'),
(64, 'bichette', '2024-03-05', 37, 42, 'vu'),
(65, 'rer', '2024-03-05', 42, 37, 'vu'),
(66, 'test', '2024-03-05', 42, 37, 'vu'),
(67, 'pi', '2024-03-05', 42, 37, 'vu'),
(68, 'tel', '2024-03-05', 42, 37, 'vu'),
(69, 'test', '2024-03-05', 42, 37, 'vu'),
(70, 'chut', '2024-03-05', 42, 37, 'vu'),
(71, 'Je suis au boulot laisse moi trkl ', '2024-03-05', 37, 42, 'vu'),
(72, 'coucou', '2024-04-15', 46, 37, 'vu'),
(73, 'bonjour', '2024-04-18', 37, 46, 'vu');

-- --------------------------------------------------------

--
-- Structure de la table `crush`
--

CREATE TABLE `crush` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_user_cible` int(11) NOT NULL,
  `statut` enum('En Attente','Crush','Recal') NOT NULL DEFAULT 'En Attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `crush`
--

INSERT INTO `crush` (`id`, `id_user`, `id_user_cible`, `statut`) VALUES
(972, 37, 46, 'Crush'),
(973, 46, 40, 'En Attente'),
(974, 46, 52, 'En Attente'),
(975, 46, 45, 'En Attente'),
(976, 46, 48, 'En Attente'),
(977, 46, 36, 'En Attente'),
(978, 46, 37, 'Crush'),
(979, 37, 44, 'Recal'),
(980, 37, 45, 'Recal'),
(981, 37, 45, 'En Attente'),
(982, 37, 40, 'Recal'),
(983, 37, 36, 'Recal'),
(984, 37, 41, 'Recal'),
(985, 37, 48, 'Recal'),
(986, 37, 41, 'En Attente');

-- --------------------------------------------------------

--
-- Structure de la table `typerelation`
--

CREATE TABLE `typerelation` (
  `id_typeRelation` int(11) NOT NULL,
  `intitule` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `typerelation`
--

INSERT INTO `typerelation` (`id_typeRelation`, `intitule`) VALUES
(1, 'Du sérieux'),
(2, 'On verra bien'),
(3, 'Rien de très sérieux'),
(4, 'Discuter'),
(5, ''),
(6, '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `age` varchar(100) NOT NULL,
  `poids` decimal(10,0) NOT NULL,
  `yeux` enum('noir','noisette','vert','bleu') NOT NULL,
  `taille` varchar(100) NOT NULL,
  `cheveux` enum('brun','blond','roux') NOT NULL,
  `origine` varchar(20) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `sex` enum('Homme','Femme') NOT NULL,
  `photo` varchar(250) NOT NULL,
  `id_confession` int(11) DEFAULT NULL,
  `id_intitule` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `email`, `pseudo`, `password`, `nom`, `prenom`, `age`, `poids`, `yeux`, `taille`, `cheveux`, `origine`, `ville`, `sex`, `photo`, `id_confession`, `id_intitule`) VALUES
(36, 'monique@monique.fr', 'MO', '$2y$10$D50MaEme0Rh8DqXR5QtiVuqOk4GIo.EBUvhyCPuY6ngcntZAJLe9.', 'Monique', 'Monique', '56', 70, 'vert', '1m65', 'roux', 'Péruvienne', 'Perpignan', 'Femme', 'valbis.jpg', 5, 3),
(37, 'wassila@wassila.fr', 'Wassila', '$2y$10$frkumqaihooIYjDG6gSCk.lAmZA03YsmMLO8uvvGFi5EC4iiZuDQ2', 'Wassila', 'Wassila', '25', 60, 'vert', '1m62', 'brun', 'Marocaine', 'Tokyo', 'Femme', 'IMG_0482.jpg', 2, 1),
(40, 'Tahira@tahira.fr', 'Biquette', '$2y$10$7zRLmZl9k73MooWizerPsusKHV1nfZrkquWqzyHLW4sDPp9hD.kpu', 't', 't', '30', 60, 'bleu', '1m60', 'brun', 'Paki', 'melun', 'Femme', 'IMG_1488.JPG', 2, 4),
(41, 'Ryane@ryane.fr', 'Ryane', '$2y$10$yyGLXv0UZflKC.nGUXyY2uSOmSDiNxApZwa4Qrmu2i6JJD/f/T8MW', 'R', 'r', '26', 80, 'noisette', '1m80', 'brun', 'Algériz', 'Paris', 'Homme', 'IMG_1507.JPG', 2, 1),
(42, 'Ryan@ryan.fr', 'Ryanee', '$2y$10$hLQ/fPZU3Ms18IXskzxouOGl6tIZ57wBnFHh7S6ETWabUWm3eTEBe', 'R', 'R', '26', 80, 'noisette', '1m80', 'brun', 'Algérien', 'Paris', 'Homme', 'thumbnail_IMG_1508.jpg', 2, 1),
(44, 'Jeremy@jeje.fr', 'Jeremayy', '$2y$10$gn3R9Ve.d7JZoN2A04pznO4Ne1QR6O/YiC4H17X7LPU8HDr12zdB.', 'Jeremy', 'Jeremy', '31', 60, 'bleu', '1m60', 'blond', 'Français', 'Vitry', 'Homme', 'Snapchat-2145623392.jpg', 6, 3),
(45, 'Nawel@mail.fr', 'Nawel', '$2y$10$D1clRfxz94XYW0Skxf4gHOfBeC3JdHb/So9B2ofvUnBsvVH6iIj7W', 'Nawel', 'Nawel', '34', 70, 'noisette', '1m57', 'brun', 'Algérienne', 'Paris', 'Femme', 'Snapchat-832971733.jpg', 2, 2),
(46, 'Alin@badboy.fr', 'Badboy', '$2y$10$Kpkj4cRsOQckXrUHjUoPy.CM9FwcxfSyi2z5bkmFyOuugZdyJH2mm', 'A', 'a', '25', 82, 'noir', '1m73', 'brun', 'Congolais', 'Paris', 'Homme', 'IMG_1512.jpeg', 3, 2),
(48, 'Aimen@aimen.fr', 'Robin des bois', '$2y$10$4Pr0h9Hneud4uS3lTqUMfOhdel1O3URTFeQ7QtfpMAVbhvn85eE3W', 'i', 'i', '34', 90, 'noir', '1m88', 'brun', 'tunisien', 'kremlin', 'Homme', 'boi.png', 2, 2),
(51, 'Kenzi@kenzi.fr', 'Ziken', '$2y$10$O3uWC2f7s./ZKc9sgJKOJuYDhS6kaJRuPZH7xiIXFnfK86lIrjxM6', 'k', 'k', '31', 80, 'noir', '1m75', 'brun', 'A', 'Paris', 'Homme', 'IMG_1804.jpg', 2, 2),
(52, 'Mitra@mitra.fr', 'Artima', '$2y$10$nWyEKrDdQqRtK6xGvoLNC.AVkGZCXSkEUq1PgLXD1F21mW4r0eBSS', 'izadi', 'Mitra', '19', 55, 'noisette', '1m50', 'brun', 'Iranienne', 'Vitry-sur-Seine', 'Femme', '1612259537436.jpeg', 5, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `confession`
--
ALTER TABLE `confession`
  ADD PRIMARY KEY (`id_confession`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `conversation_ibfk_1` (`id_user`),
  ADD KEY `conversation_ibfk_2` (`id_crush`);

--
-- Index pour la table `crush`
--
ALTER TABLE `crush`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `crush_ibfk_2` (`id_user_cible`);

--
-- Index pour la table `typerelation`
--
ALTER TABLE `typerelation`
  ADD PRIMARY KEY (`id_typeRelation`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD KEY `utilisateur_ibfk_1` (`id_confession`),
  ADD KEY `id_intitule` (`id_intitule`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `confession`
--
ALTER TABLE `confession`
  MODIFY `id_confession` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT pour la table `crush`
--
ALTER TABLE `crush`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=987;

--
-- AUTO_INCREMENT pour la table `typerelation`
--
ALTER TABLE `typerelation`
  MODIFY `id_typeRelation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`id_crush`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `crush`
--
ALTER TABLE `crush`
  ADD CONSTRAINT `crush_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `crush_ibfk_2` FOREIGN KEY (`id_user_cible`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`id_confession`) REFERENCES `confession` (`id_confession`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`id_intitule`) REFERENCES `typerelation` (`id_typeRelation`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
