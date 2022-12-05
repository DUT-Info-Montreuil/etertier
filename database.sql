-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 05 déc. 2022 à 22:27
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `idArticle` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idAuteur` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(32) NOT NULL,
  `texte` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idArticle`),
  UNIQUE KEY `idArticle` (`idArticle`),
  KEY `FK_articles_membres` (`idAuteur`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`idArticle`, `idAuteur`, `nom`, `texte`, `date`) VALUES
(17, 2, 'P3 est le meilleur jeu', 'Le jeu se découpe en 2 phases.\r\n\r\nLa première est la phase au lycée et ville. On va en cours, on passe du temps avec ses amis, on développe les liens sociaux.\r\nDonc une phase de détente où on apprend à connaître la ville, les gens qui l’habitent et où fait nos achats d’équipements et autres objets.\r\n\r\nLa deuxième phase se passe dans le Tartarus, la tour qui apparaît lors de la Dark Hour à la place du lycée ou dans des lieux de la ville où le danger est très élevé.\r\nDurant cette phase c’est du RPG au tour par tour.\r\nDe plus, les personnages ayant été trop souvent dans l’équipe lors de la Dark Hour seront fatigués et ne viendront plus dans le groupe pendant quelques jours.\r\n\r\nPetite particularité de Persona 3 et Persona 3 Fes, on ne contrôle QUE le protagoniste lors des combats.\r\nCe qui donne un aspect très stratégique.\r\nCar il faut avoir une équipe où nos alliés vont toujours être utiles peu importe la situation.\r\nIl faut donc éviter les compétences qui ne fonctionnent que rarement: « Mitsuru utilise Marin Karin » est mon plus grand traumatisme.\r\nEt bien se préparer avant chaque boss, surtout le dernier car bien que ce soit le boss final c’est aussi un boss en 13 phases, c’est long et difficile.', '2022-12-05 22:26:14'),
(19, 3, 'Pourquoi P3 est le pire jeu', 'Jeu répétitif et sans déveloprment', '2022-12-05 22:36:05'),
(20, 2, 'Zelda, série légendaire', 'C\'est en 1986 que le tout premier The Legend of Zelda voit le jour sur NES. Développé par le talentueux Shigeru Miyamoto, le commencement des aventures de Link a marqué les esprits. Techniquement, le jeu était vraiment à la hauteur des standards de l\'époque, avec sa vue de dessus et ses environnements variés. Le héros à la tunique verte explore librement le royaume d\'Hyrule à la recherche des 8 fragments de la Triforce pour vaincre Ganon. Pour cela, vous deviez arpenter des décors tels que des grottes, des plaines et autres extérieurs peuplés de monstres. Le tout sur le thème musical emblématique de la série. Un chef-d’œuvre qui a traversé les époques.', '2022-12-05 22:46:30');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_article`
--

DROP TABLE IF EXISTS `commentaire_article`;
CREATE TABLE IF NOT EXISTS `commentaire_article` (
  `idCommentaire` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idOrigine` bigint(20) UNSIGNED NOT NULL,
  `texte` varchar(2048) NOT NULL,
  `idAuteur` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idCommentaire`),
  UNIQUE KEY `idCommentaire` (`idCommentaire`),
  KEY `FK_commentaire_article_membres` (`idAuteur`),
  KEY `FK_commentaire_article_articles` (`idOrigine`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire_article`
--

INSERT INTO `commentaire_article` (`idCommentaire`, `idOrigine`, `texte`, `idAuteur`, `date`) VALUES
(8, 17, 'Chuis un génie', 2, '2022-12-05 22:26:38'),
(9, 17, 'pavé cézar', 3, '2022-12-05 22:27:43'),
(10, 19, 'Dans tas face eulalie', 3, '2022-12-05 22:36:24'),
(11, 19, 'Pourquoi Onur est le pire rédacteur', 2, '2022-12-05 22:39:42'),
(12, 20, 'Mais tas tellement raison !!!', 8, '2022-12-05 23:01:45'),
(13, 19, 'A méditer', 8, '2022-12-05 23:03:16'),
(14, 17, 'Fransement za vo pa col of', 9, '2022-12-05 23:09:54');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_liste`
--

DROP TABLE IF EXISTS `commentaire_liste`;
CREATE TABLE IF NOT EXISTS `commentaire_liste` (
  `idCommentaire` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idOrigine` bigint(20) UNSIGNED NOT NULL,
  `texte` varchar(2048) NOT NULL,
  `idAuteur` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  UNIQUE KEY `idCommentaire` (`idCommentaire`),
  KEY `FK_commentaire_liste_membres` (`idAuteur`),
  KEY `FK_commentaire_liste_listes` (`idOrigine`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire_liste`
--

INSERT INTO `commentaire_liste` (`idCommentaire`, `idOrigine`, `texte`, `idAuteur`, `date`) VALUES
(3, 11, ';) ', 3, '2022-12-05 22:38:03'),
(4, 11, 'ya que dla haine', 8, '2022-12-05 23:02:48'),
(5, 15, 'P***** de jeu sérieux', 8, '2022-12-05 23:05:31');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `idGenre` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomGenre` varchar(32) NOT NULL,
  PRIMARY KEY (`idGenre`),
  UNIQUE KEY `idGenre` (`idGenre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`idGenre`, `nomGenre`) VALUES
(1, 'Beat them all'),
(2, 'Enigmes'),
(3, 'Action'),
(4, 'Aventure'),
(5, 'RPG'),
(7, 'FPS'),
(8, 'TPS');

-- --------------------------------------------------------

--
-- Structure de la table `genres_de_jeux`
--

DROP TABLE IF EXISTS `genres_de_jeux`;
CREATE TABLE IF NOT EXISTS `genres_de_jeux` (
  `idJeu` bigint(20) UNSIGNED NOT NULL,
  `idGenre` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idJeu`,`idGenre`),
  KEY `FK_genres_de_jeux_genres` (`idGenre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genres_de_jeux`
--

INSERT INTO `genres_de_jeux` (`idJeu`, `idGenre`) VALUES
(2, 1),
(3, 2),
(49, 2),
(2, 3),
(28, 3),
(46, 3),
(3, 4),
(27, 4),
(45, 4),
(27, 5),
(45, 5),
(48, 5),
(46, 7),
(48, 7),
(28, 8);

-- --------------------------------------------------------

--
-- Structure de la table `jeudansliste`
--

DROP TABLE IF EXISTS `jeudansliste`;
CREATE TABLE IF NOT EXISTS `jeudansliste` (
  `idListe` bigint(20) UNSIGNED NOT NULL,
  `idJeu` bigint(20) UNSIGNED NOT NULL,
  `classement` int(11) NOT NULL,
  PRIMARY KEY (`idListe`,`idJeu`),
  KEY `FK_jeuDansListe_jeux` (`idJeu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `jeudansliste`
--

INSERT INTO `jeudansliste` (`idListe`, `idJeu`, `classement`) VALUES
(10, 27, 2),
(10, 45, 1),
(10, 48, 3),
(11, 2, 2),
(11, 3, 5),
(11, 28, 3),
(11, 45, 7),
(11, 46, 1),
(11, 48, 4),
(11, 49, 6),
(14, 2, 4),
(14, 27, 2),
(14, 28, 3),
(14, 45, 1),
(15, 27, 1),
(15, 45, 2),
(16, 28, 2),
(16, 46, 1),
(17, 3, 1),
(17, 28, 2),
(17, 48, 3),
(17, 49, 4);

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `idJeu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomJeu` varchar(200) NOT NULL,
  `dateSortie` date NOT NULL,
  `description` text NOT NULL,
  `image` varchar(128) NOT NULL,
  PRIMARY KEY (`idJeu`),
  UNIQUE KEY `idJeu` (`idJeu`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`idJeu`, `nomJeu`, `dateSortie`, `description`, `image`) VALUES
(2, 'Metal Gear Rising: Revengeance', '2013-02-22', 'Jeux beat them all développé par Platinium Games, de la série des Metal Gear.', 'mgrr.jpg'),
(3, 'The Legend of Zelda: Ocarina of Time', '1998-12-11', 'Le premier jeu 3d de la série des Legend of Zelda.', 'tlozoot.png'),
(27, 'Persona 5', '2017-04-04', 'Persona 5 est un RPG développé par Atlus, dans lequel le joueur doit se battre à l\'aide de Personae et explorer des \"Palais\".', 'p5.png'),
(28, 'Splatoon 3', '2022-09-09', 'Splatoon 3 est le troisième jeu de la série Splatoon, développé par Nintendo. Dans ce jeu de tir à la troisième personne, vous incarnez un Inkling ou un Octaling, un personnage humanoïde capable de se transformer en céphalopode pour nager dans l\'encre.', 'sploon3.png'),
(45, 'Shin Megami Tensei: Persona 3', '2008-02-29', 'Shin Megami Tensei: Persona 3 est un jeu vidéo de rôle développé et édité au Japon et aux États-Unis par Atlus.', 'smt_p3.png'),
(46, 'Call of Duty: Black Ops III', '2015-11-06', 'Call of Duty: Black Ops III est un jeu vidéo de tir à la première personne développé par le studio Treyarch édité par Activision', '260px-BlackOpsIII.png'),
(47, 'Diablo', '1997-01-01', 'Diablo est une série de jeux vidéo d\'action et de rôle de type hack \'n\' slash développée et publiée par Blizzard Entertainment. Développé par Blizzard ', '260px-Diablo_Logo.jpg'),
(48, 'Code Name: S.T.E.A.M.', '2015-05-01', 'Code Name: S.T.E.A.M. est un jeu vidéo de stratégie au tour par tour intégrant des éléments du jeu de tir à la troisième personne développé par Intelligent Systems et publié par Nintendo', '260px-Code_Name_STEAM_Logo.png'),
(49, 'Professeur Layton et l\'étrange village', '2007-02-15', 'Professeur Layton et l\'Étrange Village est un jeu vidéo d\'aventure en pointer-et-cliquer proposant des phases de jeu de réflexion à travers la résolution de 135 énigmes.', 'Professeur_Layton_Logo.png');

-- --------------------------------------------------------

--
-- Structure de la table `like_articles`
--

DROP TABLE IF EXISTS `like_articles`;
CREATE TABLE IF NOT EXISTS `like_articles` (
  `likeDislike` tinyint(1) NOT NULL,
  `idOrigine` bigint(20) UNSIGNED NOT NULL,
  `idMembres` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idOrigine`,`idMembres`),
  KEY `FK_like_articles_membres` (`idMembres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `like_articles`
--

INSERT INTO `like_articles` (`likeDislike`, `idOrigine`, `idMembres`) VALUES
(1, 17, 2),
(0, 17, 3),
(0, 19, 2),
(1, 19, 3),
(1, 20, 2),
(1, 20, 8);

-- --------------------------------------------------------

--
-- Structure de la table `like_com_articles`
--

DROP TABLE IF EXISTS `like_com_articles`;
CREATE TABLE IF NOT EXISTS `like_com_articles` (
  `likeDislike` tinyint(1) NOT NULL,
  `idComOrigine` bigint(20) UNSIGNED NOT NULL,
  `idMembres` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idComOrigine`,`idMembres`),
  KEY `FK_like_com_articles_membres` (`idMembres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `like_com_articles`
--

INSERT INTO `like_com_articles` (`likeDislike`, `idComOrigine`, `idMembres`) VALUES
(1, 8, 2),
(0, 8, 3),
(1, 9, 3),
(0, 10, 2),
(1, 10, 3),
(1, 11, 2),
(1, 11, 8),
(1, 12, 8),
(1, 13, 8),
(1, 14, 9);

-- --------------------------------------------------------

--
-- Structure de la table `like_com_listes`
--

DROP TABLE IF EXISTS `like_com_listes`;
CREATE TABLE IF NOT EXISTS `like_com_listes` (
  `likeDislike` tinyint(1) NOT NULL,
  `idComOrigine` bigint(20) UNSIGNED NOT NULL,
  `idMembres` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idComOrigine`,`idMembres`),
  KEY `FK_like_com_listes_membres` (`idMembres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `like_com_listes`
--

INSERT INTO `like_com_listes` (`likeDislike`, `idComOrigine`, `idMembres`) VALUES
(0, 3, 2),
(1, 3, 3),
(0, 3, 8),
(1, 4, 8),
(1, 5, 8);

-- --------------------------------------------------------

--
-- Structure de la table `like_listes`
--

DROP TABLE IF EXISTS `like_listes`;
CREATE TABLE IF NOT EXISTS `like_listes` (
  `likeDislike` tinyint(1) NOT NULL,
  `idOrigine` bigint(20) UNSIGNED NOT NULL,
  `idMembres` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`idOrigine`,`idMembres`),
  KEY `FK_like_listes_membres` (`idMembres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `like_listes`
--

INSERT INTO `like_listes` (`likeDislike`, `idOrigine`, `idMembres`) VALUES
(1, 10, 2),
(0, 11, 2),
(1, 11, 3),
(0, 11, 8),
(1, 14, 8),
(1, 15, 8),
(1, 16, 9),
(1, 17, 10);

-- --------------------------------------------------------

--
-- Structure de la table `listes`
--

DROP TABLE IF EXISTS `listes`;
CREATE TABLE IF NOT EXISTS `listes` (
  `idListe` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `auteur` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(50) NOT NULL,
  `dateCreation` datetime DEFAULT NULL,
  `public` tinyint(1) NOT NULL,
  PRIMARY KEY (`idListe`),
  UNIQUE KEY `idListe` (`idListe`),
  KEY `FK_listes_membres` (`auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `listes`
--

INSERT INTO `listes` (`idListe`, `auteur`, `titre`, `dateCreation`, `public`) VALUES
(10, 2, 'Meilleurs RPGs', '2022-12-05 22:24:17', 1),
(11, 3, 'Persona 3', '2022-12-05 22:37:38', 1),
(12, 2, 'Nouvelle liste', NULL, 0),
(13, 3, 'Nouvelle liste', NULL, 0),
(14, 8, 'mes jeux préférés', '2022-12-05 23:04:33', 1),
(15, 8, 'classement des persona', '2022-12-05 23:05:00', 1),
(16, 9, 'ces tros bien', '2022-12-05 23:08:44', 1),
(17, 10, 'mes jeux préférés', '2022-12-05 23:15:02', 1);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `redacteur` tinyint(1) NOT NULL DEFAULT '0',
  `bio` text,
  `photoprofil` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `login`, `password`, `redacteur`, `bio`, `photoprofil`) VALUES
(1, 'Axel', '$2y$10$wdKEcZ2h00dYTqrJ5LscyuKxL.03ZcIgxpYg5i8RrbFn65PvW/w1C', 0, 'Je suis Axel', '0.png'),
(2, 'Eulalie', '$2y$10$UKkFcPs3YrFDlj7p3k8maevyY0jDbR/.7t1fD88Mg3fpShLspHUAO', 1, 'JE SUIS LA MEILLEURE REDACTRICEE DE CE SITE', '0.png'),
(3, 'onur', '$2y$10$BriWZUopJkvRM/lhF.dOg.2vSCQ3V0GQzdZaE1.F3N2BLKwS8S78.', 1, 'Que elle parle l\'autre Eulamoche là', '3'),
(4, 'Antoine', '$2y$10$KhwdXtgWjaJHzMH/eySXFeh072OuurnDpcEJpsCyBceBxGnpvaZPm', 0, NULL, '0.png'),
(5, 'jean-pierre', '$2y$10$TOdbdE22mKQ.vpQlZX6VD.WmcoX/IgSl0I3wZEoprfS8SjGRKonHq', 0, 'comment je valide?', '0.png'),
(6, 'abc', '$2y$10$5uzsJFWzXvuyNB2kTc1fvuzmY8va8CJI93rJVh.1txu0KJqGU/mrK', 0, NULL, '0.png'),
(7, 'CreationListeTest', '$2y$10$j7PqWpXQG/XEb4kX9XC9HOY2dO1i8Oz2jQBLLzfR5ZKcJIRHYIlwm', 0, NULL, '0.png'),
(8, 'BlackReaper', '$2y$10$vffeM0flwKnQu5oi911yyetonJPJh/2ByIxOe3ZhrbRGXpfbpoTHG', 0, NULL, '0.png'),
(9, 'TitouanDu54', '$2y$10$ySenHbOBPsI44fPa2df4oOZq3Ld7HePFyI1eRpWp1btU7WXtKvPNS', 0, 'Bonjour zmappelle titouan jai 12 an et jadore cod ', '9'),
(10, 'Baxel', '$2y$10$uHZzWWH2q3of962swo7R.ujv1WAKuCjD4fau4HK0Zvaoef1PyHYBK', 0, NULL, '0.png');

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `note` tinyint(4) NOT NULL,
  `membre` bigint(20) UNSIGNED NOT NULL,
  `jeu` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`membre`,`jeu`),
  KEY `FK_notes_jeux` (`jeu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`note`, `membre`, `jeu`) VALUES
(18, 1, 2),
(20, 1, 3),
(19, 2, 2),
(18, 2, 3),
(17, 2, 27),
(19, 2, 45),
(16, 2, 46),
(18, 2, 49),
(12, 3, 2),
(0, 3, 45),
(14, 3, 48),
(17, 4, 2),
(11, 4, 3),
(15, 8, 2),
(20, 8, 27),
(17, 8, 28),
(18, 8, 45),
(20, 9, 46),
(11, 10, 46);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_articles_membres` FOREIGN KEY (`idAuteur`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `commentaire_article`
--
ALTER TABLE `commentaire_article`
  ADD CONSTRAINT `FK_commentaire_article_articles` FOREIGN KEY (`idOrigine`) REFERENCES `articles` (`idArticle`),
  ADD CONSTRAINT `FK_commentaire_article_membres` FOREIGN KEY (`idAuteur`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `commentaire_liste`
--
ALTER TABLE `commentaire_liste`
  ADD CONSTRAINT `FK_commentaire_liste_listes` FOREIGN KEY (`idOrigine`) REFERENCES `listes` (`idListe`),
  ADD CONSTRAINT `FK_commentaire_liste_membres` FOREIGN KEY (`idAuteur`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `genres_de_jeux`
--
ALTER TABLE `genres_de_jeux`
  ADD CONSTRAINT `FK_genres_de_jeux_genres` FOREIGN KEY (`idGenre`) REFERENCES `genres` (`idGenre`),
  ADD CONSTRAINT `FK_genres_de_jeux_jeux` FOREIGN KEY (`idJeu`) REFERENCES `jeux` (`idJeu`);

--
-- Contraintes pour la table `jeudansliste`
--
ALTER TABLE `jeudansliste`
  ADD CONSTRAINT `FK_jeuDansListe_jeux` FOREIGN KEY (`idJeu`) REFERENCES `jeux` (`idJeu`),
  ADD CONSTRAINT `FK_jeuDansListe_listes` FOREIGN KEY (`idListe`) REFERENCES `listes` (`idListe`);

--
-- Contraintes pour la table `like_articles`
--
ALTER TABLE `like_articles`
  ADD CONSTRAINT `FK_like_articles_articles` FOREIGN KEY (`idOrigine`) REFERENCES `articles` (`idArticle`),
  ADD CONSTRAINT `FK_like_articles_membres` FOREIGN KEY (`idMembres`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `like_com_articles`
--
ALTER TABLE `like_com_articles`
  ADD CONSTRAINT `FK_like_com_articles_commentaire_article` FOREIGN KEY (`idComOrigine`) REFERENCES `commentaire_article` (`idCommentaire`),
  ADD CONSTRAINT `FK_like_com_articles_membres` FOREIGN KEY (`idMembres`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `like_com_listes`
--
ALTER TABLE `like_com_listes`
  ADD CONSTRAINT `FK_like_com_listes_commentaire_liste` FOREIGN KEY (`idComOrigine`) REFERENCES `commentaire_liste` (`idCommentaire`),
  ADD CONSTRAINT `FK_like_com_listes_membres` FOREIGN KEY (`idMembres`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `like_listes`
--
ALTER TABLE `like_listes`
  ADD CONSTRAINT `FK_like_listes_listes` FOREIGN KEY (`idOrigine`) REFERENCES `listes` (`idListe`),
  ADD CONSTRAINT `FK_like_listes_membres` FOREIGN KEY (`idMembres`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `listes`
--
ALTER TABLE `listes`
  ADD CONSTRAINT `FK_listes_membres` FOREIGN KEY (`auteur`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `FK_notes_jeux` FOREIGN KEY (`jeu`) REFERENCES `jeux` (`idJeu`),
  ADD CONSTRAINT `FK_notes_membres` FOREIGN KEY (`membre`) REFERENCES `membres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
