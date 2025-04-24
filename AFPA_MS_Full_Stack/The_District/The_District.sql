-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 13 nov. 2024 à 15:21
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
  `active` varchar(6) DEFAULT NULL,
  `SuperActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `image`, `active`, `SuperActive`) VALUES
(4, 'Pizza', 'pizza_cat.jpg', 'Yes', 1),
(5, 'Burger', 'burger_cat.jpg', 'Yes', 1),
(9, 'Wraps', 'wrap_cat.jpg', 'Yes', 1),
(10, 'Pasta', 'pasta_cat.jpg', 'Yes', 1),
(11, 'Sandwich', 'sandwich_cat.jpg', 'Yes', 1),
(12, 'Asian Food', 'asian_food_cat.jpg', 'Yes', 1),
(13, 'Salade', 'salade_cat.jpg', 'Yes', 1),
(14, 'Veggie', 'veggie_cat.jpg', 'Yes', 1);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom_client` varchar(258) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telephone` varchar(128) NOT NULL,
  `adresse` varchar(256) NOT NULL,
  `pass` varchar(258) NOT NULL,
  `dateinscription` date NOT NULL DEFAULT current_timestamp(),
  `uuid` uuid NOT NULL DEFAULT uuid(),
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `resetcode` int(11) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom_client`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `pass`, `dateinscription`, `uuid`, `active`, `resetcode`, `admin`) VALUES
(1, '', 'smith', 'john', 'test@test.com', '0707070707', '7 rue des test 80000 amiens', '$2y$10$k6jqbLEyffSlbiC7v6d5FOXuyMuyjEKrhu3fmFnQsCbio.Iu5IQe2', '2024-09-12', 'd152c76e-70d8-11ef-8e51-8d3f9323f76f', 1, 0, 0),
(2, '', 'Smith', 'jogn', 'time@tardis.fr', '0787562623', '7 rue des test 80000 amiens', '$2y$10$4YnxFhGXNV9G2O8Y13Zmveio51IWVfqkrc9Z2i2qYar5TlujDYMri', '2024-09-12', '217aeab3-70d9-11ef-8e51-8d3f9323f76f', 1, 0, 0),
(3, '', 'dada', 'dada', 'dada@dada.fr', '0707070707', '7 rue des test 80000 amiens', '$2y$10$V6Wb5xszUUA1bTqYZKld0.Oy5bert5kvzIM20cU50ucZ7GRLfhNAS', '2024-09-12', '4d527811-70d9-11ef-8e51-8d3f9323f76f', 1, 0, 0),
(4, '', 'dada', 'dada', 'dada@dadada.fr', '0785568962', '498 rue du test, 80450 amiens', '$2y$10$06JYz1ICntVpZYAddMTxHO5HQVOAkwwwUWM/m4.Q6PHwnokoi//Fq', '2024-09-12', '4601a92b-70da-11ef-8e51-8d3f9323f76f', 1, 0, 0),
(7, '', 'Smith-test', 'test', 'jhon@test.com', '06 48 78 12 65', '5659 Rue Du Test 44865 Terre', '$2y$10$2AiymcPeIO/BJmaDGttmCeyyJsCMvNgxszjoXw1dc.lC1051yup.a', '2024-09-12', 'f561c15b-70eb-11ef-8e51-8d3f9323f76f', 1, 0, 0),
(8, '', 'nom-test', 'prénom-test', 'email@testtest4.com', '07 87 56 26 23', '125 rue du tour, 75000  Paris', '$2y$10$xdjVGnRwBSH/BV9NU0mOGO.WL59qUxXR6.gitiXyNBGT0CbFbqgRG', '2024-09-12', '73b39216-70ec-11ef-8e51-8d3f9323f76f', 1, 0, 0),
(9, '', 'user', 'test', 'testuser@user.com', '0707070707', '7 rue des test 80000 amiens', '$2y$10$c357EK9gID5QMmhni4XjIu0t9zJmTEr2kNATk3OOI5wA/2nJ6XVoa', '2024-09-16', 'd16fd948-73fa-11ef-8e4b-8d3e911ee009', 1, 0, 0),
(10, 'Test prénom Test nom', 'test nom', 'test prénom', 'test@emailnewtest.fr', '0707070707', '7 rue des test 80000 amiens', '$2y$10$UfV804A9JQtGmI/fRWi.Ke0yFrdtKSpLge33K2vgugSrXy14vRdfC', '2024-09-16', 'af6b2b7b-7406-11ef-8e4b-8d3e911ee009', 1, 0, 0),
(11, 'Test Test', 'test', 'test', 'testuser123@gmail.com', '0707070707', '7 rue du test 80000 amiens ', '$2y$10$HScU42wauT6Lq3FWbpGXVOSk.7zHzUsAQ4d9.OEXDiFwXoEUqFlo.', '2024-10-09', '64f14fa2-862d-11ef-891b-c7d8e5f31179', 1, 0, 0),
(12, 'Testrename Testname', 'testname', 'testrename', 'test@test4545.com', '0707070707', '7 Rue du test 80000 Amiens', '$2y$10$monL7M1gthQth4fV0a6Yg.WFLz2qqxRfru0P4qalvYsjPCcCGp6dO', '2024-10-29', '6b3993a7-95ea-11ef-8965-c8dcf537345e', 1, 0, 0),
(13, 'Testname Testname', 'testname', 'testname', 'test486441684@gmail.com', '0707070707', '7 rue du test 80000 amiens', '$2y$10$gdwFXG05IjAZaCaSYaXrnOhN92gZMzCt9Nqi/trySnfgMT2qzRWeq', '2024-10-29', '53a9b61e-95f0-11ef-8965-c8dcf537345e', 1, 0, 0),
(14, 'Te Te', 'te', 'te', 'te4484@gmail.com', '0707070707', '7 rue du test 80000 amiens', '$2y$10$5kbbVfoikl0i1X33dz3OCeESZOjtvOdRhcguQtXUNhvdcDo.XJgc6', '2024-10-29', 'f445cb77-95f0-11ef-8965-c8dcf537345e', 1, 0, 0),
(15, 'Test Testname', 'testname', 'test', 'testuser124843@gmail.com', '0707070707', '7 rue du test 80000 amiens ', '$2y$10$V9kFSosN9vtAx8f6Egt/E.fi18qVaJHPtf.aAov.mZsUNHcRd7QIu', '2024-10-29', '1b11f20d-95f1-11ef-8965-c8dcf537345e', 1, 0, 0),
(16, 'Da Te', 'te', 'da', 'testuser1da23@gmail.com', '0707070707', '7 rue du test 80000 amiens', '$2y$10$pf34d5XVNUdX/WfDL9rdV./hhSI9na.S3l8UYeuIU8sfTFimiqxIK', '2024-10-29', '71b884c7-95f1-11ef-8965-c8dcf537345e', 1, 0, 0),
(22, 'Admin Admin', 'Admin', 'admin', 'admin@admin.fr', '0707070707', '7 rue du test 80000 amiens', '$2y$10$NQhyjTu58myAt59/aXxSUOdt0QeudyK3t6dMx2eUJgUkKg0SEjiOi', '2024-10-31', '007a32d6-978d-11ef-8918-c7d8e5f0064b', 1, 0, 1),
(23, 'Test Te', 'te', 'test', 'testuser12ddd3@gmail.com', '0707070707', '7 rue du test 80000 amiens', '$2y$10$SL6DmasJNLjghq.VjemEo.qNlxKWgq/4Sw97F3Jgu0QyWYn5QtxF2', '2024-10-31', 'e9014c04-9793-11ef-8918-c7d8e5f0064b', 1, 0, 0);

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
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `uuid` uuid NOT NULL DEFAULT uuid()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `id_plat`, `quantite`, `total`, `date_commande`, `etat`, `nom_client`, `telephone_client`, `email_client`, `adresse_client`, `active`, `uuid`) VALUES
(2, ' 4', '4', '16.00', '2020-11-30 03:52:43', 'En cours de livraison', 'Kelly Dillard', '7896547800', 'kelly@gmail.com', '308 Post Avenue', 1, '6ee69e8f-701c-11ef-94b7-309c232eb309'),
(3, ' 5', '2', '20.00', '2020-11-30 04:07:17', 'Annulée', 'Thomas Gilchrist', '7410001450', 'thom@gmail.com', '1277 Sunburst Drive', 1, '6ee69f2d-701c-11ef-94b7-309c232eb309'),
(4, ' 5', '1', '10.00', '2021-05-04 01:35:34', 'Livrée', 'Martha Woods', '78540001200', 'marthagmail.com', '478 Avenue Street', 1, '6ee69f54-701c-11ef-94b7-309c232eb309'),
(6, ' 9', '1', '7.00', '2021-07-20 06:10:37', 'Livrée', 'Charlie', '7458965550', 'charlie@gmail.com', '3140 Bartlett Avenue', 1, '6ee69f6f-701c-11ef-94b7-309c232eb309'),
(7, ' 10', '2', '8.00', '2021-07-20 06:40:21', 'En cours de livraison', 'Claudia Hedley', '7451114400', 'hedley@gmail.com', '1119 Kinney Street', 1, '6ee69f86-701c-11ef-94b7-309c232eb309'),
(8, ' 14 ', '1', '6.00', '2021-07-20 06:40:57', 'En cours de livraison', 'Vernon Vargas', '7414744440', 'venno@gmail.com', '1234 Hazelwood Avenue', 1, '6ee69f9e-701c-11ef-94b7-309c232eb309'),
(9, ' 9', '4', '20.00', '2021-07-20 07:06:06', 'En cours de livraison', 'Carlos Grayson', '7401456980', 'carlos@gmail.com', '2969 Hartland Avenue', 1, '6ee69fb5-701c-11ef-94b7-309c232eb309'),
(10, ' 16', ' 4', '12.00', '2021-07-20 07:11:06', 'Annulée', 'Jonathan Caudill', '7410256996', 'jonathan@gmail.com', '1959 Limer Street', 1, '6ee69fc9-701c-11ef-94b7-309c232eb309');

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
(16, 'Lasagnes', 'Découvrez notre recette des lasagnes, l\'une des spécialités italiennes que tout le monde aime avec sa viande hachée et gratinée à l\'emmental. Et bien sûr, une inoubliable béchamel à la noix de muscade.\n\n', '12.00', 'lasagnes_viande.jpg\n', '10', 'Yes'),
(17, 'Tagliatelles au saumon', 'Découvrez notre recette délicieuse de tagliatelles au saumon frais et à la crème qui qui vous assure un véritable régal!  \n\n', '12.00', 'tagliatelles_saumon.webp\n', '10', 'Yes');

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `plat`
--
ALTER TABLE `plat`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
