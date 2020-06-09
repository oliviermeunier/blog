-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 30 avr. 2020 à 13:48
-- Version du serveur :  10.3.10-MariaDB-log
-- Version de PHP : 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `createdAt`) VALUES
(1, 'Catégorie 1', '2020-03-24 00:00:00'),
(2, 'Catégorie 2', '2020-03-24 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `nickname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `nickname`, `content`, `createdAt`, `postId`) VALUES
(4, 'jytrj', 'tjryuj', '2020-04-03 15:38:12', 1),
(5, 'regreg', 'erg', '2020-04-03 15:42:28', 1),
(6, 'rthr', 'thrth', '2020-04-27 15:37:40', 1);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `categoryId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `createdAt`, `categoryId`, `userId`, `image`) VALUES
(1, 'Face à la pandémie, les Jeux olympiques d’été de Tokyo reportés à 2021 ', '    Le conseil scientifique, qui conseille le président de la République, doit donner aujourd’hui son avis sur « la durée » et « l’étendue » nécessaires du confinement.\r\n    Dès ce mardi, les sorties pour prendre l’air ou courir devront se faire seul, et se limiter à un rayon d’un kilomètre de chez soi, durer une heure maximum, une fois par jour. Les marchés ouverts seront fermés, sauf dérogation.\r\n    \r\nSelon le dernier bilan, 860 personnes sont mortes du Covid-19 en milieu hospitalier en France depuis le début de l’épidémie, donc cinq médecins, et 2 082 patients étaient lundi soir en réanimation, a annoncé le ministre de la santé, Olivier Véran. Vingt résidents d’un Ehpad de Cornimont (Vosges) sont notamment morts « en lien possible avec le Covid-19 », selon les autorités régionales.', '2020-03-11 00:00:00', 1, 1, 'switzerland.jpg'),
(2, 'Crise du coronavirus en Espagne : « Près de 4 000 soignants ont été contaminés »', 'Correspondante du Monde à Madrid, Sandrine Morel estime, dans un tchat avec les internautes, que « les pénuries de matériels dont souffre le système de santé espagnol sont très inquiétantes ».\r\nPascal : Quel est le profil des personnes décédées en Espagne ?\r\n\r\nEn Espagne, les décès concernent des personnes particulièrement âgées, davantage encore que dans d’autres pays : plus de 65 % ont plus de 80 ans (contre environ 50 % en Italie), 87 % ont plus de 70 ans, 95 % ont plus de 60 ans.\r\nLire aussi Pandémie due au coronavirus : l’Italie et l’Espagne sont les pays d’Europe les plus touchés\r\nBen : Certains chiffres montrent que la situation est pire que celle de l’Italie au même stade épidémique. Où sont les principaux foyers de contamination en Espagne ?\r\n\r\nEffectivement, la courbe de propagation est encore plus raide, cependant les mesures de confinement ayant été prises à un stade moins avancé de l’épidémie, l’Espagne espère aplatir la courbe dans les prochains jours. Les principaux foyers sont Madrid, le Pays basque, la Navarre et la Catalogne.', '2020-03-03 00:00:00', 2, 1, 'trees.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Alfred', 'Dupont', 'admin@admin.com', '$2a$07$0I1TWq2z1e6WhPQo7TqxIuVUFcQfgpKmNH6n2cpbfwd50NwtO9WT2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postId` (`postId`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `authorId` (`userId`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
