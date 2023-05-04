-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 04 mai 2023 à 16:22
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

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
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `contenu` varchar(50) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date_modification` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `titre`, `contenu`, `note`, `date_creation`, `id_user`, `date_modification`) VALUES
(1, 'Le monde de cube ou quoi là', 'Ca marche enfin ?', 7, '2023-04-06', 2, '2023-04-23'),
(2, 'En route vers la 97', 'BLABLABLA', 10, '2023-04-05', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(11) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `id_jeux` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `texte` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `titre`, `note`, `date_creation`, `id_jeux`, `id_user`, `texte`) VALUES
(1, 'Jeu trop nul !!!', 2, '2023-04-19', 3, 3, 'Voila alors moi j aime que les ronds alors vraiment ça m a pas plus du tout du tout...'),
(2, 'WOUAAAAHHHHH', 7, '2023-04-24', 3, 2, 'Vraiment pas mal comme jeu vidéo !!'),
(3, 'Jeu intéréssant', 7, '2023-04-21', 1, 2, 'Les images dans le jeu sont incroyables');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES
(1, 'RPG'),
(2, 'Openworld'),
(3, 'Aventure'),
(4, 'Sandbox'),
(5, 'Narratif'),
(6, 'Puzzle'),
(7, 'Action');

-- --------------------------------------------------------

--
-- Structure de la table `estcategories`
--

CREATE TABLE `estcategories` (
  `id_categorie` int(11) DEFAULT NULL,
  `id_jeux` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `estcategories`
--

INSERT INTO `estcategories` (`id_categorie`, `id_jeux`) VALUES
(2, 3),
(4, 3),
(7, 4),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `estsupport`
--

CREATE TABLE `estsupport` (
  `id_support` int(11) DEFAULT NULL,
  `id_jeux` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `estsupport`
--

INSERT INTO `estsupport` (`id_support`, `id_jeux`) VALUES
(1, 1),
(5, 1),
(4, 1),
(5, 2),
(1, 3),
(2, 3),
(5, 3),
(8, 3),
(9, 3);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `chemin` varchar(50) DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL,
  `id_jeux` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id_image`, `chemin`, `id_article`, `id_jeux`) VALUES
(1, 'images/jaquette/minecraft.webp', 1, 3),
(2, 'images/jaquette/road96.webp', 2, 1),
(3, 'images/jaquette/Portal.webp', NULL, 2),
(4, 'images/jaquette/kotor.webp', NULL, 6),
(5, 'images/jaquette/halo2.webp', NULL, 5),
(6, 'images/jaquette/gtav.webp', NULL, 4),
(100, 'images/profile_picture/pp_default.svg', NULL, NULL),
(101, 'images/profile_picture/mushroom_mario.webp', NULL, NULL),
(102, 'images/profile_picture/poulpe.png', NULL, NULL),
(103, 'images/profile_picture/mario_star.webp', NULL, NULL),
(104, 'images/profile_picture/creeper.jpg', NULL, NULL),
(105, 'images/profile_picture/wheatley.jpg', NULL, NULL),
(106, 'images/profile_picture/canard.jpg', NULL, NULL),
(107, 'images/profile_picture/laican.png', NULL, NULL),
(200, 'images/road96/1.jpg', 2, 1),
(201, 'images/road96/2.jpg', 2, 1),
(202, 'images/road96/3.jpg', 2, 1),
(203, 'images/road96/4.jpg', 2, 1),
(204, 'images/minecraft/1.jpg', 1, 3),
(205, 'images/minecraft/2.jpg', 1, 3),
(206, 'images/minecraft/3.jpg', 1, 3),
(207, 'images/minecraft/4.jpg', 1, 3),
(208, 'images/portal/1.jpg', NULL, 2),
(209, 'images/portal/2.jpg', NULL, 2),
(210, 'images/portal/3.jpg', NULL, 2),
(211, 'images/portal/4.jpg', NULL, 2),
(212, 'images/gtaV/1.jpg', NULL, 4),
(213, 'images/gtaV/2.jpg', NULL, 4),
(214, 'images/gtaV/3.jpg', NULL, 4),
(215, 'images/gtaV/4.jpg', NULL, 4),
(216, 'images/halo/1.jpg', NULL, 5),
(217, 'images/halo/2.jpg', NULL, 5),
(218, 'images/halo/3.jpg', NULL, 5),
(219, 'images/halo/4.jpg', NULL, 5),
(220, 'images/kotor/1.jpg', NULL, 6),
(221, 'images/kotor/2.jpg', NULL, 6),
(222, 'images/kotor/3.jpg', NULL, 6),
(223, 'images/kotor/4.jpg', NULL, 6);

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
  `id_jeux` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `synopsis` text,
  `id_article` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id_jeux`, `nom`, `prix`, `date_sortie`, `synopsis`, `id_article`) VALUES
(1, 'Road 96', 19.96, '2021-08-16', 'Road 96 est un jeu d aventure développé par DigixArt. S inspirant de films de Tarantino, des frères Coen et de films de roadtrip, le titre propose une aventure influencée par les choix du joueur. Basé sur un système procédural, le jeu est influencé par les décisions et modifie les trajets et le pays d arrivée.', 2),
(2, 'Portal', 9.75, '2007-10-10', 'Jeu de portail', NULL),
(3, 'Minecraft', 29.99, '2011-11-18', 'Jeu bac à sable indépendant et pixelisé dont le monde infini est généré aléatoirement, Minecraft permet au joueur de récolter divers matériaux, d élever des animaux et de modifier le terrain selon ses choix, en solo ou en multi (via des serveurs). Il doit également survivre en se procurant de la nourriture et en se protégeant des monstres qui apparaissent la nuit et dans des donjons. Il peut également monter de niveau afin d acheter des enchantements.', 1),
(4, 'GTA V', 29.98, '2013-09-17', 'Jeu de bac a sable', NULL),
(5, 'Halo', 39.99, '2001-11-15', 'Jeu d aventure', NULL),
(6, 'KOTOR', 8.19, '2003-07-15', 'Aventure RPG jeux d aventure ', NULL),
(7, 'BANANAPOCALYPSE', 46.99, '2023-01-10', 'Jeu de banane', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `support`
--

CREATE TABLE `support` (
  `id_support` int(11) NOT NULL,
  `nom_support` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `support`
--

INSERT INTO `support` (`id_support`, `nom_support`) VALUES
(1, 'Xbox one'),
(2, 'Xbox 360'),
(3, 'Playstation 1'),
(4, 'Nintendo Switch'),
(5, 'Ordinateur'),
(6, 'Playstation 2'),
(7, 'Playstation 3'),
(8, 'Playstation 4'),
(9, 'Playstation 5');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `mdp` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse_mail` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `date_creation_compte` date DEFAULT NULL,
  `date_connexion` date DEFAULT NULL,
  `rôle` varchar(50) DEFAULT NULL,
  `id_image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `login`, `mdp`, `nom`, `prenom`, `adresse_mail`, `date_naissance`, `date_creation_compte`, `date_connexion`, `rôle`, `id_image`) VALUES
(1, 'laican', 'mdp', 'Vailland', 'Damien', 'damien.vailland@etudiant.univ-rennes1.fr', '2003-09-01', '2023-04-05', '2023-05-04', 'administrateur', 100),
(2, 'mornee', 'mdp', 'THEAULT', 'Morgane', 'morgane.theault@etudiant.univ-rennes1.fr', '2003-05-14', '2023-04-05', '2023-05-04', 'redacteur', 106),
(3, 'hyppo', 'mdp', 'Tribut', 'Hippolyte', 'hippolyte.tribut@etudiant.univ-rennes1.fr', '2003-12-18', '2023-04-05', '2023-04-15', 'membre', 100);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `fk_id_user_article` (`id_user`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `fk_idujeux` (`id_jeux`),
  ADD KEY `fk_id_user_avis` (`id_user`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `estcategories`
--
ALTER TABLE `estcategories`
  ADD KEY `fk_id_jeux_estcategories` (`id_categorie`),
  ADD KEY `fk_id_jeu_estcategories` (`id_jeux`);

--
-- Index pour la table `estsupport`
--
ALTER TABLE `estsupport`
  ADD KEY `id_jeux` (`id_jeux`),
  ADD KEY `id_support` (`id_support`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `fk_id_article_image` (`id_article`),
  ADD KEY `fk_id_jeu` (`id_jeux`);

--
-- Index pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`id_jeux`),
  ADD KEY `fk_id_article` (`id_article`);

--
-- Index pour la table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id_support`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `fk_id_image` (`id_image`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT pour la table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `id_jeux` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_id_user_article` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `fk_id_jeux_avis` FOREIGN KEY (`id_jeux`) REFERENCES `jeux` (`id_jeux`),
  ADD CONSTRAINT `fk_id_user_avis` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `estcategories`
--
ALTER TABLE `estcategories`
  ADD CONSTRAINT `fk_id_jeux_estcat` FOREIGN KEY (`id_jeux`) REFERENCES `jeux` (`id_jeux`),
  ADD CONSTRAINT `fk_id_jeux_estcategories` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`);

--
-- Contraintes pour la table `estsupport`
--
ALTER TABLE `estsupport`
  ADD CONSTRAINT `estsupport_ibfk_2` FOREIGN KEY (`id_support`) REFERENCES `support` (`id_support`),
  ADD CONSTRAINT `fk_id_jeux_estsuuport` FOREIGN KEY (`id_jeux`) REFERENCES `jeux` (`id_jeux`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_id_jeux_images` FOREIGN KEY (`id_jeux`) REFERENCES `jeux` (`id_jeux`),
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`);

--
-- Contraintes pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `fk_id_article_jeux` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_id_image` FOREIGN KEY (`id_image`) REFERENCES `images` (`id_image`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
