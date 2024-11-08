-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 26 sep. 2024 à 20:42
-- Version du serveur : 10.11.8-MariaDB-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `BlockNote`
--

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `user` varchar(128) NOT NULL,
  `name` varchar(258) NOT NULL,
  `note` mediumtext NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `user`, `name`, `note`, `time`, `active`) VALUES
(24, 'testadmin', 'test', 'test', '2024-09-26 13:29:41', 1),
(25, 'mickael', 'test', 'test', '2024-09-26 20:42:14', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `unique_id` int(11) NOT NULL,
  `id` uuid NOT NULL DEFAULT uuid(),
  `login` varchar(128) NOT NULL,
  `mdp` varchar(256) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`unique_id`, `id`, `login`, `mdp`, `date`, `active`) VALUES
(1, '6ff11175-7c47-11ef-90fd-fa163e4715c3', 'testadmin', '$2y$10$LDvh8xNA67vUogVfnU2D0OM8l6Bd8NeCWmu9vcH0cnlNE04DvItyK', '2024-09-24 12:50:18', 1),
(7, 'cd2a4a16-7c47-11ef-90fd-fa163e4715c3', 'mickael', '$2y$10$5CG9u6KwGTtKBqKZxSRCIerS1QVdIr3HamFjJWL/Y0zdyj9pXd3sa', '2024-09-26 20:42:09', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`unique_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `unique_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
