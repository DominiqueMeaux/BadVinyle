-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 03 juin 2020 à 14:32
-- Version du serveur :  5.7.28
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `filrouge`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_address_id` int(11) DEFAULT NULL,
  `address_city` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_postal_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_street` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `IDX_C2F3561DE8B47950` (`type_address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `address`
--

INSERT INTO `address` (`address_id`, `type_address_id`, `address_city`, `address_country`, `address_postal_code`, `address_street`) VALUES
(1, 3, 'Paris', 'France', '75000', '6 rue contrebasse'),
(2, 3, 'Abbeville', 'France', '80000', '18 avenue du Saxophone'),
(3, 3, 'Nice', 'France', '06000', '24 Impasse du chat noir'),
(4, 3, 'Brest', 'France', '29200', '42 rue de l univers'),
(5, 2, 'Toulouse', 'France', '31000', '16  impasse du bas'),
(6, 2, 'Caen', 'France', '14000', '31 rue du savon');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_number` int(11) NOT NULL,
  `cart_create_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BA388B74584665A` (`product_id`),
  KEY `IDX_BA388B7A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_upper_cat` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=403 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_libelle`, `cat_upper_cat`) VALUES
(1, 'Metal', 0),
(2, 'Musique Française', 0),
(3, 'Electro', 0),
(4, 'Folk', 0),
(101, 'Black Metal', 1),
(102, 'Power Metal', 1),
(103, 'Thrash Metal', 1),
(201, 'Bal Musette', 2),
(202, 'Chanson Française', 2),
(203, 'Jazz Manouche', 2),
(301, 'House', 3),
(302, 'Tribe', 3),
(303, 'Expérimentale', 3),
(401, 'Musique Bretonne', 4),
(402, 'Musique Latine', 4);

-- --------------------------------------------------------

--
-- Structure de la table `coef_price`
--

DROP TABLE IF EXISTS `coef_price`;
CREATE TABLE IF NOT EXISTS `coef_price` (
  `coef_id` int(11) NOT NULL AUTO_INCREMENT,
  `coef_price` double NOT NULL,
  PRIMARY KEY (`coef_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `coef_price`
--

INSERT INTO `coef_price` (`coef_id`, `coef_price`) VALUES
(1, 1),
(2, 0.8);

-- --------------------------------------------------------

--
-- Structure de la table `commentary`
--

DROP TABLE IF EXISTS `commentary`;
CREATE TABLE IF NOT EXISTS `commentary` (
  `comm_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `comm_comment` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comm_note` int(11) NOT NULL,
  PRIMARY KEY (`comm_id`),
  KEY `IDX_1CAC12CAA76ED395` (`user_id`),
  KEY `IDX_1CAC12CA4584665A` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_descr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `group`
--

INSERT INTO `group` (`group_id`, `group_name`, `group_descr`) VALUES
(1, 'Summoning', 'Groupe de Black Metal Autrichien. Groupe connu pour prendre son inspiration dans le monde de J R R Tolkien.'),
(2, 'Rhapsody of Fire', 'Groupe de Power Metal Symphonique Italien.'),
(3, 'Slayer', 'Groupe de Thrash Metal Américain originaire de Californie.'),
(4, 'Louis Corchia', 'Joueur D\'accordéon'),
(5, 'Edith Piaf', 'Chanteuse, parolière et compositrice française'),
(6, 'Django Reinhardt', 'Guitariste de Jazz'),
(7, 'Frankie Knuckles', 'Dj et compositeur Américian de musique électronique'),
(8, 'Psylotribe', 'Compositeur de TribeCore'),
(9, 'Throbbling Gristle', 'Groupe de musique Expérimentale et Bruitiste Anglais'),
(10, 'Tri Yann', 'Groupe de folk rock Breton'),
(11, 'Arsenio Rodriguez', 'Musicien Cubain et Compositeur');

-- --------------------------------------------------------

--
-- Structure de la table `label`
--

DROP TABLE IF EXISTS `label`;
CREATE TABLE IF NOT EXISTS `label` (
  `label_siren` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_id` int(11) NOT NULL,
  `lab_libele` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lab_mail` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lab_descr` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`label_siren`),
  KEY `IDX_EA750E8F5B7AF75` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `label`
--

INSERT INTO `label` (`label_siren`, `address_id`, `lab_libele`, `lab_mail`, `lab_descr`) VALUES
('145789632', 2, 'Metal hurlant', 'm.hurlant@daposte.com', 'label spécialisé dans le metal'),
('159483548', 3, 'Ambiani', 'amb.iani@gtmail.com', 'label spécialisé dansl es musique folk de tout horizon'),
('456123789', 4, 'Tonerre de brest', 'toner.de.brest@lapoust.net', 'label spécialisé en musique eletro '),
('976316472', 1, 'Frenchy Touchy', 'fre.ouch@gamel.fr', 'Label spécialisé dans la musique française');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200601141128', '2020-06-01 14:11:45');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_id` int(11) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `order_totalprice` double NOT NULL,
  `order_deliver_date` datetime NOT NULL,
  `order_duty_free` double NOT NULL,
  `order_bill_format` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `IDX_F5299398D7707B45` (`order_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_lib` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`order_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `order_status_lib`) VALUES
(1, 'En préparation'),
(2, 'En attente'),
(3, 'En  cours de livraison'),
(4, 'livré'),
(5, 'Annulé');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_format` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_descr` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`photo_id`, `photo_format`, `photo_descr`) VALUES
(1, 'jpg', 'Vinyl collector Summoning'),
(2, 'jpg', 'Vinyl rare Rhapsody OF Fire - Best of'),
(3, 'jpg', 'Album De Slayer'),
(4, 'jpg', 'Album de Best of de Louis Corchia'),
(5, 'jpg', 'Album de best of de Edith Piaf'),
(6, 'jpg', 'Album de Django Reinhardt'),
(7, 'jpg', 'Album de Frankie Knuckles'),
(8, 'jpg', 'Album Featuring Psylotribe'),
(9, 'jpg', 'Album de Throbbling Gristle'),
(10, 'jpg', 'Album de Tri Yann Ancien'),
(11, 'jpg', 'Album de Arsenio Rodriguez');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `label_siren` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `provider_siren` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prod_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prod_descr` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prod_price` decimal(6,2) NOT NULL,
  `prod_display` tinyint(1) NOT NULL,
  `prod_stock` int(11) NOT NULL,
  PRIMARY KEY (`prod_id`),
  KEY `IDX_4ACC380CFE54D947` (`group_id`),
  KEY `IDX_4ACC380C12469DE2` (`category_id`),
  KEY `IDX_4ACC380C49950C06` (`label_siren`),
  KEY `IDX_4ACC380C7E9E4C8C` (`photo_id`),
  KEY `IDX_4ACC380C82DD0F7C` (`provider_siren`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`prod_id`, `group_id`, `category_id`, `label_siren`, `photo_id`, `provider_siren`, `prod_name`, `prod_descr`, `prod_price`, `prod_display`, `prod_stock`) VALUES
(1, 1, 101, '145789632', 1, '159785863', 'Minas Morgul', 'Album de Black  metal Atmospherique', '25.50', 1, 150),
(2, 2, 102, '145789632', 2, '321654987', 'Legendary Years', 'Power Metal Epic Album retracant la carrière du groupe', '30.00', 1, 20),
(3, 3, 103, '145789632', 3, '159785863', 'Repentless', '', '20.10', 1, 155),
(4, 4, 201, '976316472', 4, '321654987', 'Hit Parade Accordeon', '', '5.50', 1, 5),
(5, 5, 202, '976316472', 5, '159785863', 'The Very Best OF', '', '35.20', 1, 5),
(6, 6, 203, '976316472', 6, '321654987', '24 Classic Jazz Perfomances', '', '45.20', 1, 40),
(7, 7, 301, '456123789', 7, '159785863', 'Your Love Bady Wants to ride', '', '18.90', 1, 25),
(8, 8, 302, '456123789', 8, '321654987', 'The New Challengers', '', '11.60', 1, 8),
(9, 9, 303, '456123789', 9, '159785863', 'Very Friendly', '', '18.99', 1, 21),
(10, 10, 401, '159483548', 10, '321654987', 'Ann Noaded', '', '25.33', 1, 11),
(11, 11, 402, '159483548', 11, '159785863', 'Y Su Conjunto', '', '65.20', 1, 18);

-- --------------------------------------------------------

--
-- Structure de la table `products_order`
--

DROP TABLE IF EXISTS `products_order`;
CREATE TABLE IF NOT EXISTS `products_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_price` double NOT NULL,
  `products_number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_15706D484584665A` (`product_id`),
  KEY `IDX_15706D488D9F6D38` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_promo_id` int(11) DEFAULT NULL,
  `promo_percent` int(11) NOT NULL,
  `promo_libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_active` tinyint(1) NOT NULL,
  `promo_date_fin` datetime NOT NULL,
  PRIMARY KEY (`promo_id`),
  KEY `IDX_EA1B30341D3F5D03` (`type_promo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `promotions`
--

INSERT INTO `promotions` (`promo_id`, `type_promo_id`, `promo_percent`, `promo_libelle`, `promo_active`, `promo_date_fin`) VALUES
(1, 1, 30, 'un noel incroyable', 0, '2020-01-01 00:00:00'),
(2, 2, 15, 'Rentré Super', 0, '2019-10-01 00:00:00'),
(3, 3, 13, 'Diablo Promo', 1, '2020-07-14 00:00:00'),
(4, 4, 30, 'Promo Gourmande', 0, '2020-05-01 00:00:00'),
(5, 5, 25, 'Romantique', 0, '2020-02-20 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `promo_products`
--

DROP TABLE IF EXISTS `promo_products`;
CREATE TABLE IF NOT EXISTS `promo_products` (
  `product_id` int(11) NOT NULL,
  `promo_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`promo_id`),
  KEY `IDX_7B657F624584665A` (`product_id`),
  KEY `IDX_7B657F62D0C07AFF` (`promo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `promo_products`
--

INSERT INTO `promo_products` (`product_id`, `promo_id`) VALUES
(1, 3),
(6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `provider`
--

DROP TABLE IF EXISTS `provider`;
CREATE TABLE IF NOT EXISTS `provider` (
  `prov_siren` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_provider_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `prov_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prov_mail` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prov_phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prov_descr` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`prov_siren`),
  KEY `IDX_92C4739C414A7F3B` (`type_provider_id`),
  KEY `IDX_92C4739CF5B7AF75` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `provider`
--

INSERT INTO `provider` (`prov_siren`, `type_provider_id`, `address_id`, `prov_name`, `prov_mail`, `prov_phone`, `prov_descr`) VALUES
('159785863', 1, 5, 'DétailVin', 'detailtout@vinylism.com', '0322457896', 'Détaillant De vinyl'),
('321654987', 2, 6, 'MassVin', 'massdetout@lapostiere.fr', '0155789631', 'Grossite De vinyl');

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_address`
--

DROP TABLE IF EXISTS `type_address`;
CREATE TABLE IF NOT EXISTS `type_address` (
  `type_address_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_address_libele` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`type_address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_address`
--

INSERT INTO `type_address` (`type_address_id`, `type_address_libele`) VALUES
(1, 'Utilisateur'),
(2, 'Fournisseur'),
(3, 'Label'),
(4, 'Facturation'),
(5, 'Livraison');

-- --------------------------------------------------------

--
-- Structure de la table `type_promo`
--

DROP TABLE IF EXISTS `type_promo`;
CREATE TABLE IF NOT EXISTS `type_promo` (
  `type_promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_promo_libelle` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`type_promo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_promo`
--

INSERT INTO `type_promo` (`type_promo_id`, `type_promo_libelle`) VALUES
(1, 'Promo Noel'),
(2, 'Promo Rentré'),
(3, 'Promo Metal'),
(4, 'Promo Paques'),
(5, 'Saint Valentin');

-- --------------------------------------------------------

--
-- Structure de la table `type_provider`
--

DROP TABLE IF EXISTS `type_provider`;
CREATE TABLE IF NOT EXISTS `type_provider` (
  `type_prov_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_prov_libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`type_prov_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_provider`
--

INSERT INTO `type_provider` (`type_prov_id`, `type_prov_libelle`) VALUES
(1, 'Détaillant'),
(2, 'Grossiste');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_info_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_lastname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_firstname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_birthday` date NOT NULL,
  `user_sexe` tinyint(1) NOT NULL,
  `user_phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_register_date` date NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  KEY `IDX_8D93D649586DFF2` (`user_info_id`),
  KEY `IDX_8D93D6499D419299` (`user_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_adresses`
--

DROP TABLE IF EXISTS `user_adresses`;
CREATE TABLE IF NOT EXISTS `user_adresses` (
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`address_id`),
  KEY `IDX_F94C152A76ED395` (`user_id`),
  KEY `IDX_F94C152F5B7AF75` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `user_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_info_registration_number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `coef_id` int(11) DEFAULT NULL,
  `user_type_libelle` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_type_id`),
  KEY `IDX_F65F1BE080F7849` (`coef_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `coef_id`, `user_type_libelle`) VALUES
(1, 1, 'Client'),
(2, 2, 'Adminstrateur'),
(3, 2, 'Commercial');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_C2F3561DE8B47950` FOREIGN KEY (`type_address_id`) REFERENCES `type_address` (`type_address_id`);

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B74584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`prod_id`),
  ADD CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `commentary`
--
ALTER TABLE `commentary`
  ADD CONSTRAINT `FK_1CAC12CA4584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`prod_id`),
  ADD CONSTRAINT `FK_1CAC12CAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `label`
--
ALTER TABLE `label`
  ADD CONSTRAINT `FK_EA750E8F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398D7707B45` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`order_status_id`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_4ACC380C12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `FK_4ACC380C49950C06` FOREIGN KEY (`label_siren`) REFERENCES `label` (`label_siren`),
  ADD CONSTRAINT `FK_4ACC380C7E9E4C8C` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`photo_id`),
  ADD CONSTRAINT `FK_4ACC380C82DD0F7C` FOREIGN KEY (`provider_siren`) REFERENCES `provider` (`prov_siren`),
  ADD CONSTRAINT `FK_4ACC380CFE54D947` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`);

--
-- Contraintes pour la table `products_order`
--
ALTER TABLE `products_order`
  ADD CONSTRAINT `FK_15706D484584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`prod_id`),
  ADD CONSTRAINT `FK_15706D488D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`);

--
-- Contraintes pour la table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `FK_EA1B30341D3F5D03` FOREIGN KEY (`type_promo_id`) REFERENCES `type_promo` (`type_promo_id`);

--
-- Contraintes pour la table `promo_products`
--
ALTER TABLE `promo_products`
  ADD CONSTRAINT `FK_7B657F624584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`prod_id`),
  ADD CONSTRAINT `FK_7B657F62D0C07AFF` FOREIGN KEY (`promo_id`) REFERENCES `promotions` (`promo_id`);

--
-- Contraintes pour la table `provider`
--
ALTER TABLE `provider`
  ADD CONSTRAINT `FK_92C4739C414A7F3B` FOREIGN KEY (`type_provider_id`) REFERENCES `type_provider` (`type_prov_id`),
  ADD CONSTRAINT `FK_92C4739CF5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

--
-- Contraintes pour la table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `FK_5F37A13BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649586DFF2` FOREIGN KEY (`user_info_id`) REFERENCES `user_info` (`user_info_id`),
  ADD CONSTRAINT `FK_8D93D6499D419299` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`);

--
-- Contraintes pour la table `user_adresses`
--
ALTER TABLE `user_adresses`
  ADD CONSTRAINT `FK_F94C152A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_F94C152F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

--
-- Contraintes pour la table `user_type`
--
ALTER TABLE `user_type`
  ADD CONSTRAINT `FK_F65F1BE080F7849` FOREIGN KEY (`coef_id`) REFERENCES `coef_price` (`coef_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
