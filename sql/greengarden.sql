-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 14 déc. 2023 à 16:16
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
-- Base de données : `greengarden`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_d_adresse`
--

CREATE TABLE `t_d_adresse` (
  `Id_Adresse` int(11) NOT NULL,
  `Ligne1_Adresse` varchar(50) NOT NULL,
  `Ligne2_Adresse` varchar(50) DEFAULT NULL,
  `Ligne3_Adresse` varchar(50) DEFAULT NULL,
  `CP_Adresse` varchar(50) NOT NULL,
  `Ville_Adresse` varchar(150) NOT NULL,
  `Id_Client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_adresse`
--

INSERT INTO `t_d_adresse` (`Id_Adresse`, `Ligne1_Adresse`, `Ligne2_Adresse`, `Ligne3_Adresse`, `CP_Adresse`, `Ville_Adresse`, `Id_Client`) VALUES
(1, 'ZAC de Conches', NULL, NULL, '27190', 'Conches en Ouche', 2),
(2, '26 rue Aristide Briand', NULL, NULL, '27000', 'Evreux', 3),
(3, '102 bis rue Chartraine', NULL, NULL, '27000', 'Evreux', 4),
(4, '112 bis rue Chartraine', NULL, NULL, '27000', 'Evreux', 4);

-- --------------------------------------------------------

--
-- Structure de la table `t_d_adressecommande`
--

CREATE TABLE `t_d_adressecommande` (
  `Id_Commande` int(11) NOT NULL,
  `Id_Adresse` int(11) NOT NULL,
  `Id_Type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_adressecommande`
--

INSERT INTO `t_d_adressecommande` (`Id_Commande`, `Id_Adresse`, `Id_Type`) VALUES
(1, 1, 1),
(1, 1, 2),
(2, 1, 1),
(2, 1, 2),
(3, 2, 1),
(3, 2, 2),
(4, 3, 1),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_d_categorie`
--

CREATE TABLE `t_d_categorie` (
  `Id_Categorie` int(11) NOT NULL,
  `Libelle` varchar(50) NOT NULL,
  `Id_Categorie_Parent` int(11) DEFAULT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_categorie`
--

INSERT INTO `t_d_categorie` (`Id_Categorie`, `Libelle`, `Id_Categorie_Parent`, `img`) VALUES
(1, 'Outillage Jardin', NULL, 'https://static.aujardin.info/cache/th/adb/outils-jardinage-600x450.webp'),
(2, 'Bêche', 1, 'https://media.adeo.com/marketplace/LMFR/87469775/3518541.jpeg'),
(3, 'Pioche', 1, 'https://xforst.com/wp-content/uploads/2021/09/12s-1024x683.jpg'),
(4, 'Rateau', 1, 'https://www.outils-wolf.fr/sites/default/files/styles/big_square_accessoire/public/outils/images/outils-wolf-rateau-multistar-drm30-4.jpg?itok=zq7EPziA'),
(5, 'Pelle', 1, 'https://jardinage.lemonde.fr/images/dossiers/historique/beche-115352.jpg'),
(6, 'Plant', NULL, 'https://cdn.shopify.com/s/files/1/0489/5922/6015/files/1_3_480x480.jpg?v=1640864075'),
(7, 'Légume', 6, 'https://actinutrition.fr/wp-content/uploads/2020/01/legume-hiver-1000.webp'),
(8, 'Fruit', 6, 'https://medias.toutelanutrition.com/ressource/144/blog/2020/aout/17/fruits.jpg'),
(9, 'Fleur', 6, 'https://verdurable.fr/wp-content/uploads/2020/04/pensee-MAJ-1024x576.jpg'),
(10, 'Pot', NULL, 'https://i.notretemps.com/1400x787/smart/2021/04/15/jardin-ou-trouver-de-jolis-pots-pour-mes-fleurs.jpg'),
(11, 'Luminaire Solaire', NULL, 'https://www.objetsolaire.com/media/vignette/70162'),
(12, 'Tuyau d\'arrosage', NULL, 'https://media.adeo.com/media/1029481/media.jpeg?precrop=6376,4782,x438,y0&height=465&quality=75');

-- --------------------------------------------------------

--
-- Structure de la table `t_d_client`
--

CREATE TABLE `t_d_client` (
  `Id_Client` int(11) NOT NULL,
  `Nom_Societe_Client` varchar(150) DEFAULT NULL,
  `Nom_Client` varchar(150) DEFAULT NULL,
  `Prenom_Client` varchar(150) DEFAULT NULL,
  `Mail_Client` varchar(150) DEFAULT NULL,
  `Tel_Client` varchar(50) DEFAULT NULL,
  `Id_Commercial` int(11) NOT NULL,
  `Id_Type_Client` int(11) NOT NULL,
  `DelaiPaiement_Client` int(11) NOT NULL,
  `Num_Client` varchar(45) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_client`
--

INSERT INTO `t_d_client` (`Id_Client`, `Nom_Societe_Client`, `Nom_Client`, `Prenom_Client`, `Mail_Client`, `Tel_Client`, `Id_Commercial`, `Id_Type_Client`, `DelaiPaiement_Client`, `Num_Client`, `id_user`) VALUES
(2, 'Gamm Vert', NULL, NULL, 'conches@gammvert.fr', NULL, 1, 2, 30, 'CLI0000001', NULL),
(3, NULL, 'Truc', 'Muche', 'trucmuche@yahoo.fr', '0123456789', 1, 1, 0, 'CLI0000002', NULL),
(4, NULL, 'Gonzales', 'Roberto', 'robertogonzales@gmail.com.fr', '0987654321', 2, 1, 0, 'CLI0000003', NULL),
(6, 'test', 'test', 'test', 'pinkiepieh911@gmail.com', '000000000', 1, 1, 0, 'CLI0000004', 15);

--
-- Déclencheurs `t_d_client`
--
DELIMITER $$
CREATE TRIGGER `tr_generate_num_client` BEFORE INSERT ON `t_d_client` FOR EACH ROW BEGIN
    DECLARE prefix CHAR(3) DEFAULT 'CLI';
    DECLARE num INT;

    SELECT COUNT(*) INTO num FROM t_d_client;
    SET num = num + 1;

    SET NEW.num_client = CONCAT(prefix, LPAD(num, 7, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_d_commande`
--

CREATE TABLE `t_d_commande` (
  `Id_Commande` int(11) NOT NULL,
  `Num_Commande` varchar(50) NOT NULL,
  `Date_Commande` datetime NOT NULL,
  `Id_Statut` int(11) NOT NULL,
  `Id_Client` int(11) NOT NULL,
  `Id_TypePaiement` int(11) NOT NULL,
  `Remise_Commande` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_commande`
--

INSERT INTO `t_d_commande` (`Id_Commande`, `Num_Commande`, `Date_Commande`, `Id_Statut`, `Id_Client`, `Id_TypePaiement`, `Remise_Commande`) VALUES
(1, 'CMD0000001', '2022-02-01 14:09:08', 2, 2, 2, 0.00),
(2, 'CMD0000002', '2022-02-03 07:09:35', 6, 2, 2, 10.00),
(3, 'CMD0000003', '2023-04-01 12:10:08', 5, 3, 1, 0.00),
(4, 'CMD0000004', '2023-05-03 21:24:28', 4, 4, 2, 0.00);

--
-- Déclencheurs `t_d_commande`
--
DELIMITER $$
CREATE TRIGGER `tr_generate_num_commande` BEFORE INSERT ON `t_d_commande` FOR EACH ROW BEGIN
    DECLARE prefix CHAR(3) DEFAULT 'CMD';
    DECLARE num INT;

    SELECT COUNT(*) INTO num FROM t_d_commande;
    SET num = num + 1;

    SET NEW.num_commande = CONCAT(prefix, LPAD(num, 7, '0'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_insert_facture` AFTER INSERT ON `t_d_commande` FOR EACH ROW BEGIN
    INSERT INTO t_d_facture (id_commande)
    VALUES (NEW.id_commande);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_d_commercial`
--

CREATE TABLE `t_d_commercial` (
  `Id_Commercial` int(11) NOT NULL,
  `Nom_Commercial` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_commercial`
--

INSERT INTO `t_d_commercial` (`Id_Commercial`, `Nom_Commercial`) VALUES
(1, 'Jean Ventout'),
(2, 'Monique Rabais');

-- --------------------------------------------------------

--
-- Structure de la table `t_d_expedition`
--

CREATE TABLE `t_d_expedition` (
  `Id_Expedition` int(11) NOT NULL,
  `Date_Expedition` datetime DEFAULT NULL,
  `NumBL` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_expedition`
--

INSERT INTO `t_d_expedition` (`Id_Expedition`, `Date_Expedition`, `NumBL`) VALUES
(1, '2022-02-07 14:14:39', 'EXP0000001'),
(2, '2023-04-01 14:15:03', 'EXP0000002'),
(3, '2023-05-06 08:15:24', 'EXP0000003'),
(4, '2023-05-09 08:30:58', 'EXP0000004'),
(5, NULL, 'EXP0000005');

--
-- Déclencheurs `t_d_expedition`
--
DELIMITER $$
CREATE TRIGGER `tr_expedition_generate_numBL` BEFORE INSERT ON `t_d_expedition` FOR EACH ROW BEGIN
    DECLARE prefix CHAR(3) DEFAULT 'EXP';
    DECLARE num INT;

    SELECT COUNT(*) INTO num FROM t_d_expedition;
    SET num = num + 1;

    SET NEW.numBL = CONCAT(prefix, LPAD(num, 7, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_d_facture`
--

CREATE TABLE `t_d_facture` (
  `Id_Facture` int(11) NOT NULL,
  `NumFacture` varchar(150) NOT NULL,
  `Date_Facture` datetime NOT NULL,
  `Id_Commande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_facture`
--

INSERT INTO `t_d_facture` (`Id_Facture`, `NumFacture`, `Date_Facture`, `Id_Commande`) VALUES
(1, 'FAC0000001', '0000-00-00 00:00:00', 1),
(2, 'FAC0000002', '2022-02-07 14:14:39', 2),
(3, 'FAC0000003', '2023-04-01 14:15:03', 3),
(4, 'FAC0000004', '2023-05-06 08:15:24', 4);

--
-- Déclencheurs `t_d_facture`
--
DELIMITER $$
CREATE TRIGGER `tr_facture_generate_numfacture` BEFORE INSERT ON `t_d_facture` FOR EACH ROW BEGIN
    DECLARE prefix CHAR(3) DEFAULT 'FAC';
    DECLARE num INT;

    SELECT COUNT(*) INTO num FROM t_d_facture;
    SET num = num + 1;

    SET NEW.numFacture = CONCAT(prefix, LPAD(num, 7, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_d_fournisseur`
--

CREATE TABLE `t_d_fournisseur` (
  `Id_Fournisseur` int(11) NOT NULL,
  `Nom_Fournisseur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_fournisseur`
--

INSERT INTO `t_d_fournisseur` (`Id_Fournisseur`, `Nom_Fournisseur`) VALUES
(1, 'Pierre'),
(2, 'Paul'),
(3, 'Jacques');

-- --------------------------------------------------------

--
-- Structure de la table `t_d_lignecommande`
--

CREATE TABLE `t_d_lignecommande` (
  `Id_Commande` int(11) NOT NULL,
  `Id_Produit` int(11) NOT NULL,
  `Id_Expedition` int(11) UNSIGNED NOT NULL,
  `Quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_lignecommande`
--

INSERT INTO `t_d_lignecommande` (`Id_Commande`, `Id_Produit`, `Id_Expedition`, `Quantite`) VALUES
(1, 1, 5, 1),
(2, 1, 1, 1),
(2, 2, 1, 1),
(3, 4, 2, 3),
(4, 5, 3, 10),
(4, 6, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_d_produit`
--

CREATE TABLE `t_d_produit` (
  `Id_Produit` int(11) NOT NULL,
  `Taux_TVA` decimal(15,2) NOT NULL,
  `Nom_Long` varchar(250) NOT NULL,
  `Nom_court` varchar(50) NOT NULL,
  `Ref_fournisseur` varchar(250) NOT NULL,
  `Photo` varchar(250) DEFAULT NULL,
  `Prix_Achat` decimal(15,2) NOT NULL,
  `Id_Fournisseur` int(11) NOT NULL,
  `Id_Categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_produit`
--

INSERT INTO `t_d_produit` (`Id_Produit`, `Taux_TVA`, `Nom_Long`, `Nom_court`, `Ref_fournisseur`, `Photo`, `Prix_Achat`, `Id_Fournisseur`, `Id_Categorie`) VALUES
(1, 5.50, 'Bêche pour quelqu\'un qui serait assez grand, genre', 'Bêche pour grand', 'BZFR1589', 'https://media.adeo.com/marketplace/LMFR/87469775/3518541.jpeg', 14.90, 1, 2),
(2, 5.50, 'Bêche pour quelqu\'un qui serait assez petit, genre lorem ok okzer ze', 'Bêche pour petit', 'BZFR1592', 'https://media.adeo.com/marketplace/LMFR/87469775/3518541.jpeg', 9.90, 1, 2),
(3, 5.50, 'Le plant d\'aubergine qui déchire sa grand Mère', 'Plant Aubergine', 'JAFR1589', 'https://actinutrition.fr/wp-content/uploads/2020/01/legume-hiver-1000.webp', 1.90, 2, 7),
(4, 5.50, 'Le plant de fraises qui déchire sa grand Mère', 'Plant Fraises', 'JAFR26895', 'https://medias.toutelanutrition.com/ressource/144/blog/2020/aout/17/fruits.jpg', 1.90, 2, 8),
(5, 19.60, 'Le set de 10 lampes qui permet d\'éclairer ton allée', 'Set de 10 lampes', 'LAM0001', 'https://www.objetsolaire.com/media/vignette/70162', 49.90, 3, 11),
(6, 19.60, 'Le tuyau d\'arrosage dexception qui s\'allonge', 'Tuyai 20m', 'TUY0001', 'https://media.adeo.com/media/1029481/media.jpeg?precrop=6376,4782,x438,y0&height=465&quality=75', 24.90, 3, 12);

-- --------------------------------------------------------

--
-- Structure de la table `t_d_statut_commande`
--

CREATE TABLE `t_d_statut_commande` (
  `Id_Statut` int(11) NOT NULL,
  `Libelle_Statut` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_statut_commande`
--

INSERT INTO `t_d_statut_commande` (`Id_Statut`, `Libelle_Statut`) VALUES
(1, 'Saisie'),
(2, 'Annulée'),
(3, 'En préparation'),
(4, 'Expédiée'),
(5, 'Facturée'),
(6, 'Soldée');

-- --------------------------------------------------------

--
-- Structure de la table `t_d_type_adresse`
--

CREATE TABLE `t_d_type_adresse` (
  `Id_Type` int(11) NOT NULL,
  `Libelle_Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_type_adresse`
--

INSERT INTO `t_d_type_adresse` (`Id_Type`, `Libelle_Type`) VALUES
(1, 'Livraison'),
(2, 'Facturation');

-- --------------------------------------------------------

--
-- Structure de la table `t_d_type_client`
--

CREATE TABLE `t_d_type_client` (
  `Id_Type_Client` int(11) NOT NULL,
  `Libelle_Type_Client` varchar(50) NOT NULL,
  `Taux_Penalite_Retard` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_type_client`
--

INSERT INTO `t_d_type_client` (`Id_Type_Client`, `Libelle_Type_Client`, `Taux_Penalite_Retard`) VALUES
(1, 'Particulier', 15.00),
(2, 'Professionnel', 10.00);

-- --------------------------------------------------------

--
-- Structure de la table `t_d_type_paiement`
--

CREATE TABLE `t_d_type_paiement` (
  `Id_TypePaiement` int(11) NOT NULL,
  `Libelle_TypePaiement` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_type_paiement`
--

INSERT INTO `t_d_type_paiement` (`Id_TypePaiement`, `Libelle_TypePaiement`) VALUES
(1, 'Carte Bancaire'),
(2, 'Chèque'),
(3, 'Espèces'),
(4, 'Virement');

-- --------------------------------------------------------

--
-- Structure de la table `t_d_user`
--

CREATE TABLE `t_d_user` (
  `Id_User` int(11) NOT NULL,
  `Id_UserType` int(11) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_user`
--

INSERT INTO `t_d_user` (`Id_User`, `Id_UserType`, `Login`, `Password`) VALUES
(6, 1, 'TATA', '$2y$10$Lcdm/IjztRlWqkiNkpSDbOdnzf6.y.Odfof/GI0/oEwotuJCKxMkW'),
(7, 1, 'TETE', '$2y$10$.WB8ClgVFG1TgxpvyqOHNOfE8YdVASuEQjHsfERkOSROn8COeDpFO'),
(8, 1, 'TITI', '$2y$10$LW3LfMM2aWbPNqsCdVdaVOpjEmGkI6WCDz6u1CQM4dETUQzq85fnW'),
(9, 1, 'TOTO', '$2y$10$o8GM7KPUrZspf7Nesw993.G4NijnlSQp69kVb5X756y1Y0VPibMt6'),
(10, 1, 'TUTU', '$2y$10$WNEpjJHt8EqMMu1hJ7e.Q.a9VschQ/4IUx07Wuci7FhgmNr4eMWqW'),
(11, 1, 'TYTY', '$2y$10$B.QXItF9zFL2mtqG2bJ.vOa3xTCAhmdMDiSUb8iSpY4eyXOY/2sJO'),
(15, 2, 'test', '$2y$10$CaIraoNINqFPRKB.UV.kJep9lAbZqitypvokv57BZThcCdvWMaJ3y');

-- --------------------------------------------------------

--
-- Structure de la table `t_d_usertype`
--

CREATE TABLE `t_d_usertype` (
  `Id_UserType` int(11) NOT NULL,
  `Libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_d_usertype`
--

INSERT INTO `t_d_usertype` (`Id_UserType`, `Libelle`) VALUES
(1, 'Client'),
(2, 'Admin'),
(3, 'Commercial');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_d_adresse`
--
ALTER TABLE `t_d_adresse`
  ADD PRIMARY KEY (`Id_Adresse`),
  ADD KEY `Id_Client` (`Id_Client`);

--
-- Index pour la table `t_d_adressecommande`
--
ALTER TABLE `t_d_adressecommande`
  ADD PRIMARY KEY (`Id_Commande`,`Id_Adresse`,`Id_Type`),
  ADD KEY `Id_Adresse` (`Id_Adresse`),
  ADD KEY `Id_Type` (`Id_Type`);

--
-- Index pour la table `t_d_categorie`
--
ALTER TABLE `t_d_categorie`
  ADD PRIMARY KEY (`Id_Categorie`),
  ADD KEY `Id_Categorie_Parent` (`Id_Categorie_Parent`);

--
-- Index pour la table `t_d_client`
--
ALTER TABLE `t_d_client`
  ADD PRIMARY KEY (`Id_Client`),
  ADD KEY `Id_Commercial` (`Id_Commercial`),
  ADD KEY `Id_Type_Client` (`Id_Type_Client`);

--
-- Index pour la table `t_d_commande`
--
ALTER TABLE `t_d_commande`
  ADD PRIMARY KEY (`Id_Commande`),
  ADD KEY `Id_Statut` (`Id_Statut`),
  ADD KEY `Id_TypePaiement` (`Id_TypePaiement`),
  ADD KEY `Id_Client` (`Id_Client`);

--
-- Index pour la table `t_d_commercial`
--
ALTER TABLE `t_d_commercial`
  ADD PRIMARY KEY (`Id_Commercial`);

--
-- Index pour la table `t_d_expedition`
--
ALTER TABLE `t_d_expedition`
  ADD PRIMARY KEY (`Id_Expedition`);

--
-- Index pour la table `t_d_facture`
--
ALTER TABLE `t_d_facture`
  ADD PRIMARY KEY (`Id_Facture`),
  ADD UNIQUE KEY `Id_Commande` (`Id_Commande`);

--
-- Index pour la table `t_d_fournisseur`
--
ALTER TABLE `t_d_fournisseur`
  ADD PRIMARY KEY (`Id_Fournisseur`);

--
-- Index pour la table `t_d_lignecommande`
--
ALTER TABLE `t_d_lignecommande`
  ADD PRIMARY KEY (`Id_Commande`,`Id_Produit`,`Id_Expedition`),
  ADD KEY `Id_Produit` (`Id_Produit`),
  ADD KEY `t_d_lignecommande_ibfk_3` (`Id_Expedition`);

--
-- Index pour la table `t_d_produit`
--
ALTER TABLE `t_d_produit`
  ADD PRIMARY KEY (`Id_Produit`),
  ADD KEY `Id_Fournisseur` (`Id_Fournisseur`),
  ADD KEY `Id_Categorie` (`Id_Categorie`);

--
-- Index pour la table `t_d_statut_commande`
--
ALTER TABLE `t_d_statut_commande`
  ADD PRIMARY KEY (`Id_Statut`);

--
-- Index pour la table `t_d_type_adresse`
--
ALTER TABLE `t_d_type_adresse`
  ADD PRIMARY KEY (`Id_Type`);

--
-- Index pour la table `t_d_type_client`
--
ALTER TABLE `t_d_type_client`
  ADD PRIMARY KEY (`Id_Type_Client`);

--
-- Index pour la table `t_d_type_paiement`
--
ALTER TABLE `t_d_type_paiement`
  ADD PRIMARY KEY (`Id_TypePaiement`);

--
-- Index pour la table `t_d_user`
--
ALTER TABLE `t_d_user`
  ADD PRIMARY KEY (`Id_User`),
  ADD KEY `t_d_user_ibfk_1` (`Id_UserType`);

--
-- Index pour la table `t_d_usertype`
--
ALTER TABLE `t_d_usertype`
  ADD PRIMARY KEY (`Id_UserType`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_d_adresse`
--
ALTER TABLE `t_d_adresse`
  MODIFY `Id_Adresse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_d_categorie`
--
ALTER TABLE `t_d_categorie`
  MODIFY `Id_Categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `t_d_client`
--
ALTER TABLE `t_d_client`
  MODIFY `Id_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `t_d_commande`
--
ALTER TABLE `t_d_commande`
  MODIFY `Id_Commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_d_commercial`
--
ALTER TABLE `t_d_commercial`
  MODIFY `Id_Commercial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_d_expedition`
--
ALTER TABLE `t_d_expedition`
  MODIFY `Id_Expedition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_d_facture`
--
ALTER TABLE `t_d_facture`
  MODIFY `Id_Facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_d_fournisseur`
--
ALTER TABLE `t_d_fournisseur`
  MODIFY `Id_Fournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_d_produit`
--
ALTER TABLE `t_d_produit`
  MODIFY `Id_Produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `t_d_statut_commande`
--
ALTER TABLE `t_d_statut_commande`
  MODIFY `Id_Statut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `t_d_type_adresse`
--
ALTER TABLE `t_d_type_adresse`
  MODIFY `Id_Type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_d_user`
--
ALTER TABLE `t_d_user`
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `t_d_usertype`
--
ALTER TABLE `t_d_usertype`
  MODIFY `Id_UserType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
