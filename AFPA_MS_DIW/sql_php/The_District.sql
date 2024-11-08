-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 12 sep. 2024 à 14:06
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
-- Base de données : `The_District`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(2) NOT NULL,
  `libelle` varchar(128) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `active` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `image`, `active`) VALUES
(4, 'Pizza', 'pizza_cat.jpg', 'Yes'),
(5, 'Burger', 'burger_cat.jpg', 'Yes'),
(9, 'Wraps', 'wrap_cat.jpg', 'No'),
(10, 'Pasta', 'pasta_cat.jpg', 'No'),
(11, 'Sandwich', 'sandwich_cat.jpg', 'No'),
(12, 'Asian_Food', 'asian_food_cat.jpg', 'Yes'),
(13, 'Salade', 'salade_cat.jpg', 'Yes'),
(14, 'Veggie', 'veggie_cat.jpg', 'Yes'),
(84, 'test', '1726044525670545766.jpg', 'Yes'),
(85, 'image', '17260445791320492752.jpg', 'Yes');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telephone` varchar(128) NOT NULL,
  `adresse` varchar(256) NOT NULL,
  `pass` varchar(258) NOT NULL,
  `dateinscription` date NOT NULL DEFAULT current_timestamp(),
  `uuid` uuid NOT NULL DEFAULT uuid(),
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `resetcode` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `pass`, `dateinscription`, `uuid`, `active`, `resetcode`, `admin`) VALUES
(1, 'smith', 'john', 'test@test.com', '0707070707', '7 rue des test 80000 amiens', '$2y$10$MiuSgTTn3u5xbyjytPtAXerQ83eBkhKXCUggCrroYoKfQM56JjqDe', '2024-09-12', 'd152c76e-70d8-11ef-8e51-8d3f9323f76f', 1, 35286304, 0),
(2, 'Smith', 'jogn', 'time@tardis.fr', '0787562623', '7 rue des test 80000 amiens', '$2y$10$4YnxFhGXNV9G2O8Y13Zmveio51IWVfqkrc9Z2i2qYar5TlujDYMri', '2024-09-12', '217aeab3-70d9-11ef-8e51-8d3f9323f76f', 1, 0, 0),
(3, 'dada', 'dada', 'dada@dada.fr', '0707070707', '7 rue des test 80000 amiens', '$2y$10$V6Wb5xszUUA1bTqYZKld0.Oy5bert5kvzIM20cU50ucZ7GRLfhNAS', '2024-09-12', '4d527811-70d9-11ef-8e51-8d3f9323f76f', 1, 0, 0),
(4, 'dada', 'dada', 'dada@dadada.fr', '0785568962', '498 rue du test, 80450 amiens', '$2y$10$06JYz1ICntVpZYAddMTxHO5HQVOAkwwwUWM/m4.Q6PHwnokoi//Fq', '2024-09-12', '4601a92b-70da-11ef-8e51-8d3f9323f76f', 1, 0, 0),
(6, 'admin', 'admin', 'admin@admin.fr', '0707070707', '7 rue des test 80000 amiens', '$2y$10$PZ0YnRsvBAsAfz145RZpGOl6vioFMOGR2epaC2Jjz4vBHZj/T0z3K', '2024-09-12', '496f8b69-70dd-11ef-8e51-8d3f9323f76f', 1, 0, 0),
(7, 'Smith-test', 'test', 'jhon@test.com', '06 48 78 12 65', '5659 Rue Du Test 44865 Terre', '$2y$10$2AiymcPeIO/BJmaDGttmCeyyJsCMvNgxszjoXw1dc.lC1051yup.a', '2024-09-12', 'f561c15b-70eb-11ef-8e51-8d3f9323f76f', 1, 0, 0),
(8, 'nom-test', 'prénom-test', 'email@testtest4.com', '07 87 56 26 23', '125 rue du tour, 75000  Paris', '$2y$10$xdjVGnRwBSH/BV9NU0mOGO.WL59qUxXR6.gitiXyNBGT0CbFbqgRG', '2024-09-12', '73b39216-70ec-11ef-8e51-8d3f9323f76f', 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(2) NOT NULL,
  `id_plat` varchar(7) DEFAULT NULL,
  `quantite` varchar(8) DEFAULT NULL,
  `total` varchar(5) DEFAULT NULL,
  `date_commande` varchar(19) DEFAULT NULL,
  `etat` varchar(21) DEFAULT NULL,
  `nom_client` varchar(16) DEFAULT NULL,
  `telephone_client` varchar(16) DEFAULT NULL,
  `email_client` varchar(18) DEFAULT NULL,
  `adresse_client` varchar(21) DEFAULT NULL,
  `uuid` uuid NOT NULL DEFAULT uuid()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `id_plat`, `quantite`, `total`, `date_commande`, `etat`, `nom_client`, `telephone_client`, `email_client`, `adresse_client`, `uuid`) VALUES
(2, ' 4', '4', '16.00', '2020-11-30 03:52:43', 'Livrée', 'Kelly Dillard', '7896547800', 'kelly@gmail.com', '308 Post Avenue', '6ee69e8f-701c-11ef-94b7-309c232eb309'),
(3, ' 5', '2', '20.00', '2020-11-30 04:07:17', 'Livrée', 'Thomas Gilchrist', '7410001450', 'thom@gmail.com', '1277 Sunburst Drive', '6ee69f2d-701c-11ef-94b7-309c232eb309'),
(4, ' 5', '1', '10.00', '2021-05-04 01:35:34', 'Livrée', 'Martha Woods', '78540001200', 'marthagmail.com', '478 Avenue Street', '6ee69f54-701c-11ef-94b7-309c232eb309'),
(6, ' 9', '1', '7.00', '2021-07-20 06:10:37', 'Livrée', 'Charlie', '7458965550', 'charlie@gmail.com', '3140 Bartlett Avenue', '6ee69f6f-701c-11ef-94b7-309c232eb309'),
(7, ' 10', '2', '8.00', '2021-07-20 06:40:21', 'En cours de livraison', 'Claudia Hedley', '7451114400', 'hedley@gmail.com', '1119 Kinney Street', '6ee69f86-701c-11ef-94b7-309c232eb309'),
(8, ' 14 ', '1', '6.00', '2021-07-20 06:40:57', 'En préparation', 'Vernon Vargas', '7414744440', 'venno@gmail.com', '1234 Hazelwood Avenue', '6ee69f9e-701c-11ef-94b7-309c232eb309'),
(9, ' 9', '4', '20.00', '2021-07-20 07:06:06', 'Annulée', 'Carlos Grayson', '7401456980', 'carlos@gmail.com', '2969 Hartland Avenue', '6ee69fb5-701c-11ef-94b7-309c232eb309'),
(10, ' 16', ' 4', '12.00', '2021-07-20 07:11:06', 'Livrée', 'Jonathan Caudill', '7410256996', 'jonathan@gmail.com', '1959 Limer Street', '6ee69fc9-701c-11ef-94b7-309c232eb309');

-- --------------------------------------------------------

--
-- Structure de la table `plat`
--

CREATE TABLE `plat` (
  `id` int(2) NOT NULL,
  `libelle` varchar(55) DEFAULT NULL,
  `description` varchar(236) DEFAULT NULL,
  `prix` text DEFAULT NULL,
  `image` varchar(25) DEFAULT NULL,
  `id_categorie` varchar(12) DEFAULT NULL,
  `active` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `plat`
--

INSERT INTO `plat` (`id`, `libelle`, `description`, `prix`, `image`, `id_categorie`, `active`) VALUES
(4, 'District Burger', 'Burger composé d’un bun’s du boulanger, deux steaks de 80g (origine française), de deux tranches poitrine de porc fumée, de deux tranches cheddar affiné, salade et oignons confits. .', '8.00', 'hamburger.jpg', '5', 'Yes'),
(5, 'Pizza Bianca', 'Une pizza fine et croustillante garnie de crème mascarpone légèrement citronnée et de tranches de saumon fumé, le tout relevé de baies roses et de basilic frais.', '14.00', 'pizza-salmon.png', '4', 'Yes'),
(9, 'Buffalo Chicken Wrap', 'Du bon filet de poulet mariné dans notre spécialité sucrée & épicée, enveloppé dans une tortilla blanche douce faite maison.', '5.00', 'buffalo-chicken.webp', '9', 'Yes'),
(10, 'Cheeseburger', 'Burger composé d’un bun’s du boulanger, de salade, oignons rouges, pickles, oignon confit, tomate, d’un steak d’origine Française, d’une tranche de cheddar affiné, et de notre sauce maison.', '8.00', 'cheesburger.jpg', '5', 'Yes'),
(12, 'Spaghetti aux légumes', 'Un plat de spaghetti au pesto de basilic et légumes poêlés, très parfumé et rapide', '10.00', 'spaghetti-legumes.jpg', '10', 'Yes'),
(13, 'Salade César', 'Une délicieuse salade Caesar (César) composée de filets de poulet grillés, de feuilles croquantes de salade romaine, de croutons à l\'ail, de tomates cerise et surtout de sa fameuse sauce Caesar. Le tout agrémenté de copeaux de parmesan.', '7.00', 'cesar_salad.jpg', '13', 'Yes'),
(14, 'Pizza Margherita', 'Une authentique pizza margarita, un classique de la cuisine italienne! Une pâte faite maison, une sauce tomate fraîche, de la mozzarella Fior di latte, du basilic, origan, ail, sucre, sel & poivre...', '14.00', 'pizza-margherita.jpg', '4', 'Yes'),
(15, 'Courgettes farcies au quinoa et duxelles de champignons', 'Voici une recette équilibrée à base de courgettes, quinoa et champignons, 100% vegan et sans gluten!', '8.00', 'courgettes_farcies.jpg', '14', 'Yes'),
(16, 'Lasagnes', 'Découvrez notre recette des lasagnes, l\'une des spécialités italiennes que tout le monde aime avec sa viande hachée et gratinée à l\'emmental. Et bien sûr, une inoubliable béchamel à la noix de muscade.\n\n', '12.00', 'lasagnes_viande.jpg\n', '10', 'Yes'),
(17, 'Tagliatelles au saumon', 'Découvrez notre recette délicieuse de tagliatelles au saumon frais et à la crème qui qui vous assure un véritable régal!  \n\n', '12.00', 'tagliatelles_saumon.webp\n', '10', 'Yes');

-- --------------------------------------------------------

--
-- Structure de la table `TestDel`
--

CREATE TABLE `TestDel` (
  `ID` int(11) NOT NULL,
  `Name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `TestDel`
--

INSERT INTO `TestDel` (`ID`, `Name`) VALUES
(47, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `mdp` varchar(256) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `uuid` text NOT NULL DEFAULT uuid()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `mdp`, `admin`, `date`, `uuid`) VALUES
(19, 'admin', '$2y$10$d0OOx3ltbTuQNLWtCHh3euGm19C3s2nVJu4Ks.5hFYYNdVQC8jcke', 1, '0000-00-00 00:00:00', 'c6af462d-701b-11ef-94b7-309c232eb309'),
(54, 'dzadzadadza4', '$2y$10$1jSh374ZFuyXR0FteY4KsOF5N7M7fAZDW9vKtCX/1Ey4HLZc8xDmK', 0, '2024-09-10 13:59:07', 'c6af46da-701b-11ef-94b7-309c232eb309'),
(55, 'testuser484', '$2y$10$LFc.MYQBdJqFdym9HWHufOEuuxNMjuNYxYGtZnev46DkIrckPnSAu', 0, '2024-09-11 07:00:23', 'c6af46fb-701b-11ef-94b7-309c232eb309'),
(56, 'testuser464daz6d', '$2y$10$DS.MNfkl3kc7FEmJx/Wf7eF.mvkfB2uxF9K02sZh.w0y4oARV.hK2', 0, '2024-09-11 07:00:32', 'c6af4711-701b-11ef-94b7-309c232eb309'),
(57, 'testUser', '$2y$10$.k79ah8QqNKAgscQDdZdfu8Vvx7Z/Dvwsy0qXDh0ZeZy5f9Q0cT4G', 0, '2024-09-11 07:00:50', 'c6af4727-701b-11ef-94b7-309c232eb309'),
(58, 'user48648646', '$2y$10$8zjgaGq.Cu0VrVK1y05BGOueZTEpMl3zH95w4cMpAz9dFbFeZD9n2', 0, '2024-09-11 07:03:04', 'c6af473b-701b-11ef-94b7-309c232eb309'),
(59, 'useruser5d4az86d4az', '$2y$10$9LLGfnPfh0E1ut5VrPmuHeN2l85xjYD9k9A/J0FTuSB/TFQl84vNW', 0, '2024-09-11 08:58:27', '029faac8-701c-11ef-94b7-309c232eb309'),
(60, 'dzadza858', '$2y$10$wFF0/bseiEOt3AL8d8xCuuK4nyIu8q5xa5cGQuqYcKJlWB.0gNZ8a', 0, '2024-09-11 13:40:36', '6ce1d61e-7043-11ef-94b7-309c232eb309'),
(61, 'dazdazdad4', '$2y$10$SuyRTH14VrZk/wq6lHt..OLQPXSo9KChEb7H/GxY9C7Yq5VsJbbSe', 0, '2024-09-12 07:37:09', 'd18b5d40-70d9-11ef-8e51-8d3f9323f76f');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `plat`
--
ALTER TABLE `plat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `TestDel`
--
ALTER TABLE `TestDel`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `plat`
--
ALTER TABLE `plat`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `TestDel`
--
ALTER TABLE `TestDel`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
