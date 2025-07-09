-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 04 fév. 2023 à 17:43
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lodger`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--

DROP TABLE IF EXISTS `abonnements`;
CREATE TABLE IF NOT EXISTS `abonnements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agence_id` int NOT NULL,
  `offre_abonnement_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_expiration` datetime DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '1',
  `deleted` tinyint NOT NULL DEFAULT '1',
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `abonnements`
--

INSERT INTO `abonnements` (`id`, `reference`, `agence_id`, `offre_abonnement_id`, `user_id`, `date_expiration`, `etat`, `deleted`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AB_2257740496', 1, 1, 5, '2023-03-06 15:10:22', 1, 1, '0', '2023-02-04 15:10:22', '2023-02-04 15:10:22');

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

DROP TABLE IF EXISTS `activites`;
CREATE TABLE IF NOT EXISTS `activites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` int DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_fixe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_cni` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville_id` int NOT NULL,
  `pays_id` int NOT NULL,
  `photo_cni` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localisation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `agences`
--

DROP TABLE IF EXISTS `agences`;
CREATE TABLE IF NOT EXISTS `agences` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gerant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_fixe` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agrement` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `registre_commerce` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_verification` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localisation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays_id` int NOT NULL,
  `etat` tinyint NOT NULL DEFAULT '1',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `abonne` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agences`
--

INSERT INTO `agences` (`id`, `reference`, `name`, `gerant`, `email`, `contact`, `contact_fixe`, `agrement`, `email_verified_at`, `registre_commerce`, `code_verification`, `adresse`, `photo`, `localisation`, `remember_token`, `ville_id`, `pays_id`, `etat`, `deleted`, `created_at`, `updated_at`, `abonne`) VALUES
(1, 'YPic2bdZ', 'LOCAGENCE', 'Botchi', 'locagence@yopmail.com', '18054138564', NULL, '13073', '2023-01-31 17:10:56', NULL, '35458', NULL, '167525333981146.jpg', 'abidjan cocody', 'm9z6Alq4fY', 'Abidjan', 53, 1, 1, '2023-01-31 17:10:56', '2023-02-01 12:10:52', 1),
(2, '6qSJWwN9', 'LOCAGENCE', NULL, 'locagence2@yopmail.com', '831.907.2804', NULL, '65543', '2023-01-31 17:11:46', NULL, '36515', NULL, NULL, NULL, 'RN60gcVw8B', 'Abidjan', 52, 1, 1, '2023-01-31 17:11:46', '2023-01-31 17:11:46', 0),
(3, 'sMXkWWv4', 'LOCAGENCE', NULL, 'locagence3@yopmail.com', '+1-213-801-7278', NULL, '40103', '2023-01-31 17:12:18', NULL, '78805', NULL, NULL, NULL, '6fwsURAAev', 'Abidjan', 52, 1, 1, '2023-01-31 17:12:18', '2023-01-31 17:12:18', 0),
(4, 'AG_7464104574', 'guianou', 'botchi dagou', 'guianou@yopmail.com', '3546578598', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5kcdToLYkQCkUDyAM18kSYRZkveR1f4ZJClmTwUO', 'abidjan', 53, 1, 0, '2023-02-03 15:19:29', '2023-02-04 02:56:27', 0);

-- --------------------------------------------------------

--
-- Structure de la table `appartements`
--

DROP TABLE IF EXISTS `appartements`;
CREATE TABLE IF NOT EXISTS `appartements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_appart` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `proprietaire_id` int NOT NULL,
  `agence_id` int NOT NULL,
  `categorie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nb_chambre` int DEFAULT NULL,
  `montant_loyer` int NOT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `archived` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ville` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rue` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quartier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_immobilier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meuble` int NOT NULL DEFAULT '0',
  `statut` int NOT NULL DEFAULT '0',
  `devise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_commerce` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_appart` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appartements`
--

INSERT INTO `appartements` (`id`, `reference`, `code_appart`, `user_id`, `proprietaire_id`, `agence_id`, `categorie`, `libelle`, `niveau`, `adresse`, `country_id`, `description`, `image`, `nb_chambre`, `montant_loyer`, `etat`, `deleted`, `archived`, `created_at`, `updated_at`, `ville`, `commune`, `rue`, `quartier`, `type_immobilier`, `meuble`, `statut`, `devise`, `type_commerce`, `num_appart`) VALUES
(1, '2248426421', 'AP0000001', 1, 5, 1, '1', '2 pièces', '1er etage', 'abidjan cocody riviera', NULL, 'salle de sejour etc.', '167525294424994.jpg', NULL, 150000, 1, 0, 0, '2023-02-01 12:02:24', '2023-02-01 13:41:30', NULL, NULL, NULL, NULL, 'immeuble', 0, 1, 'Fr (XOF)', NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `appartement_cautions`
--

DROP TABLE IF EXISTS `appartement_cautions`;
CREATE TABLE IF NOT EXISTS `appartement_cautions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `caution_id` int NOT NULL,
  `appartement_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avance_loyers`
--

DROP TABLE IF EXISTS `avance_loyers`;
CREATE TABLE IF NOT EXISTS `avance_loyers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `appartement_id` int NOT NULL,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant` int NOT NULL,
  `devise` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` int DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paid` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avance_loyers`
--

INSERT INTO `avance_loyers` (`id`, `appartement_id`, `reference`, `montant`, `devise`, `periode`, `description`, `etat`, `deleted`, `created_at`, `updated_at`, `paid`) VALUES
(1, 1, NULL, 300000, 'Fr (XOF)', '2', NULL, 1, 0, '2023-02-01 12:02:25', '2023-02-01 13:41:30', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cautions`
--

DROP TABLE IF EXISTS `cautions`;
CREATE TABLE IF NOT EXISTS `cautions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `appartement_id` int NOT NULL,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant` int NOT NULL,
  `devise` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` int DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paid` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cautions`
--

INSERT INTO `cautions` (`id`, `appartement_id`, `reference`, `montant`, `devise`, `periode`, `description`, `etat`, `deleted`, `created_at`, `updated_at`, `paid`) VALUES
(1, 1, NULL, 300000, 'Fr (XOF)', '2', NULL, 1, 0, '2023-02-01 12:02:25', '2023-02-01 13:41:30', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commission_agences`
--

DROP TABLE IF EXISTS `commission_agences`;
CREATE TABLE IF NOT EXISTS `commission_agences` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `appartement_id` int NOT NULL,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant` int NOT NULL,
  `devise` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` int DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agence_id` int DEFAULT NULL,
  `paid` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commission_agences`
--

INSERT INTO `commission_agences` (`id`, `appartement_id`, `reference`, `montant`, `devise`, `periode`, `description`, `etat`, `deleted`, `created_at`, `updated_at`, `agence_id`, `paid`) VALUES
(1, 1, NULL, 150000, 'Fr (XOF)', '1', NULL, 1, 0, '2023-02-01 12:02:25', '2023-02-01 13:41:30', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `agence_id` int NOT NULL,
  `solde` int NOT NULL,
  `etat` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

DROP TABLE IF EXISTS `contrats`;
CREATE TABLE IF NOT EXISTS `contrats` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `agence_id` int NOT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `archived` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrats`
--

INSERT INTO `contrats` (`id`, `reference`, `user_id`, `libelle`, `description`, `agence_id`, `etat`, `archived`, `deleted`, `created_at`, `updated_at`) VALUES
(1, '3307839308', 1, 'bail à usage d\'habitation', 'bail à usage d\'habitation', 1, 1, 0, 0, '2023-02-01 12:20:42', '2023-02-01 12:20:42'),
(2, '4961394039', 1, 'Bail à usage commercial', 'Bail à usage commercial', 1, 1, 0, 0, '2023-02-01 13:33:03', '2023-02-01 13:33:03');

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint DEFAULT NULL,
  `phonecode` int NOT NULL,
  `etat` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `countries`
--

INSERT INTO `countries` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`, `etat`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93, 1),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355, 1),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213, 1),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684, 1),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376, 1),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244, 1),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264, 1),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0, 1),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268, 1),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54, 1),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374, 1),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297, 1),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61, 1),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43, 1),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994, 1),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242, 1),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973, 1),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880, 1),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246, 1),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375, 1),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32, 1),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501, 1),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229, 1),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441, 1),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975, 1),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591, 1),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387, 1),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267, 1),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0, 1),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55, 1),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246, 1),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673, 1),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359, 1),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226, 1),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257, 1),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855, 1),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237, 1),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238, 1),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345, 1),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236, 1),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235, 1),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56, 1),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86, 1),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61, 1),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672, 1),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57, 1),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269, 1),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242, 1),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242, 1),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682, 1),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506, 1),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225, 1),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385, 1),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53, 1),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357, 1),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420, 1),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45, 1),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253, 1),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767, 1),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809, 1),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593, 1),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20, 1),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503, 1),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240, 1),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291, 1),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372, 1),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251, 1),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500, 1),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298, 1),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679, 1),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358, 1),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33, 1),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594, 1),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689, 1),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0, 1),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241, 1),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220, 1),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995, 1),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49, 1),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233, 1),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350, 1),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30, 1),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299, 1),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473, 1),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590, 1),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671, 1),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502, 1),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224, 1),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245, 1),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592, 1),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509, 1),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0, 1),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39, 1),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504, 1),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852, 1),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36, 1),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354, 1),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91, 1),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62, 1),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98, 1),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964, 1),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353, 1),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972, 1),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39, 1),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876, 1),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81, 1),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962, 1),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7, 1),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254, 1),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686, 1),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850, 1),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82, 1),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965, 1),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996, 1),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856, 1),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371, 1),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961, 1),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266, 1),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231, 1),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218, 1),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423, 1),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370, 1),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352, 1),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853, 1),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389, 1),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261, 1),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265, 1),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60, 1),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960, 1),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223, 1),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356, 1),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692, 1),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596, 1),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222, 1),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230, 1),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269, 1),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52, 1),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691, 1),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373, 1),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377, 1),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976, 1),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664, 1),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212, 1),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258, 1),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95, 1),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264, 1),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674, 1),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977, 1),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31, 1),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599, 1),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687, 1),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64, 1),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505, 1),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227, 1),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234, 1),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683, 1),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672, 1),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670, 1),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47, 1),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968, 1),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92, 1),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680, 1),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970, 1),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507, 1),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675, 1),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595, 1),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51, 1),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63, 1),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0, 1),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48, 1),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351, 1),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787, 1),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974, 1),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262, 1),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40, 1),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70, 1),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250, 1),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290, 1),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869, 1),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758, 1),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508, 1),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784, 1),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684, 1),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378, 1),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239, 1),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966, 1),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221, 1),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381, 1),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248, 1),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232, 1),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65, 1),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421, 1),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386, 1),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677, 1),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252, 1),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27, 1),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0, 1),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34, 1),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94, 1),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249, 1),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597, 1),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47, 1),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268, 1),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46, 1),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41, 1),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963, 1),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886, 1),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992, 1),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255, 1),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66, 1),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670, 1),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228, 1),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690, 1),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676, 1),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868, 1),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216, 1),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90, 1),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370, 1),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649, 1),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688, 1),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256, 1),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380, 1),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971, 1),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44, 1),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598, 1),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998, 1),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678, 1),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58, 1),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84, 1),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284, 1),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340, 1),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681, 1),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212, 1),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967, 1),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260, 1),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263, 1);

-- --------------------------------------------------------

--
-- Structure de la table `devises`
--

DROP TABLE IF EXISTS `devises`;
CREATE TABLE IF NOT EXISTS `devises` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taux_change` double(8,2) DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '1',
  `deleted` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

DROP TABLE IF EXISTS `factures`;
CREATE TABLE IF NOT EXISTS `factures` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `location_id` int NOT NULL,
  `fichier` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `agence_id` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `locataire_id` int DEFAULT NULL,
  `date_echeance` datetime DEFAULT NULL,
  `next_date_echeance` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`id`, `reference`, `periode`, `user_id`, `location_id`, `fichier`, `status`, `agence_id`, `description`, `etat`, `deleted`, `created_at`, `updated_at`, `locataire_id`, `date_echeance`, `next_date_echeance`) VALUES
(1, 'FAC-1618112182', 'January 2023-February 2023', 1, 1, NULL, 1, 1, NULL, 1, 0, '2023-02-01 20:10:33', '2023-02-01 20:44:27', 6, '2023-02-17 00:00:00', '2023-03-19 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fichier_contrats`
--

DROP TABLE IF EXISTS `fichier_contrats`;
CREATE TABLE IF NOT EXISTS `fichier_contrats` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `locataire_id` int NOT NULL,
  `agence_id` int NOT NULL,
  `location_id` int NOT NULL,
  `contrat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0',
  `archived` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `facture_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `historique_locations`
--

DROP TABLE IF EXISTS `historique_locations`;
CREATE TABLE IF NOT EXISTS `historique_locations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locataire_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appartement_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agence_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_location` datetime DEFAULT NULL,
  `date_resiliation` datetime DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contrat_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `incidents`
--

DROP TABLE IF EXISTS `incidents`;
CREATE TABLE IF NOT EXISTS `incidents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sujet` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appartement_id` int NOT NULL,
  `user_id` int NOT NULL,
  `agence_id` int NOT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `read_at` datetime DEFAULT NULL,
  `locataire_id` int DEFAULT NULL,
  `archived` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `incidents`
--

INSERT INTO `incidents` (`id`, `reference`, `sujet`, `description`, `status`, `appartement_id`, `user_id`, `agence_id`, `etat`, `deleted`, `created_at`, `updated_at`, `read_at`, `locataire_id`, `archived`) VALUES
(1, 'INC000001', 'plomberie', 'tuyaux casse', '0', 1, 1, 1, 1, 0, '2023-02-01 21:01:59', '2023-02-01 00:00:00', NULL, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `appartement_id` int NOT NULL,
  `contrat_id` int NOT NULL,
  `agence_id` int NOT NULL,
  `date_location` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `locataire_id` int DEFAULT NULL,
  `archived` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `locations`
--

INSERT INTO `locations` (`id`, `reference`, `user_id`, `appartement_id`, `contrat_id`, `agence_id`, `date_location`, `description`, `etat`, `deleted`, `created_at`, `updated_at`, `locataire_id`, `archived`) VALUES
(1, '1371471969', 1, 1, 1, 1, '2023-01-18', NULL, 1, 0, '2023-02-01 13:41:30', '2023-02-01 13:41:30', 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(76, '2014_10_12_000000_create_users_table', 2),
(77, '2014_10_12_100000_create_password_resets_table', 2),
(78, '2019_08_19_000000_create_failed_jobs_table', 2),
(79, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(80, '2022_08_30_124506_create_admins_table', 2),
(81, '2022_08_30_131250_create_offre_abonnements_table', 2),
(82, '2022_08_30_131919_create_appartements_table', 2),
(83, '2022_08_30_140959_create_abonnements_table', 2),
(84, '2022_08_30_141930_create_locations_table', 2),
(85, '2022_08_30_142854_create_paiement_loyers_table', 2),
(86, '2022_08_30_144214_create_factures_table', 2),
(87, '2022_08_30_144705_create_incidents_table', 2),
(88, '2022_08_30_145008_create_reparations_table', 2),
(89, '2022_08_30_145209_create_contrats_table', 2),
(90, '2022_08_30_145527_create_resiliations_table', 2),
(91, '2022_08_30_152225_create_suggestions_table', 2),
(92, '2022_08_30_153524_create_activites_table', 2),
(93, '2022_08_30_153641_create_notifications_table', 2),
(94, '2022_08_30_153902_create_cautions_table', 2),
(95, '2022_08_30_155736_create_moyen_paiements_table', 2),
(96, '2022_09_01_233050_create_devises_table', 2),
(27, '2022_09_27_131647_create_soldes_table', 1),
(97, '2022_09_01_233931_create_prelevements_table', 2),
(98, '2022_09_15_173742_create_agences_table', 2),
(99, '2022_09_16_120943_create_appartement_cautions_table', 2),
(100, '2022_09_16_123339_create_avance_loyers_table', 2),
(101, '2022_09_16_123834_create_commission_agences_table', 2),
(102, '2022_10_05_140343_create_historique_locations_table', 2),
(103, '2022_10_11_165607_create_fichier_contrats_table', 2),
(104, '2023_01_27_164321_create_paiement_abonnements_table', 2),
(105, '2023_01_31_151424_add_field_to_appartement_table', 2),
(106, '2023_01_31_152023_add_field_to_agences_table', 2),
(107, '2023_01_31_152537_add_field_to_commission_agences_table', 2),
(108, '2023_01_31_153725_add_field_to_factures_table', 2),
(109, '2023_01_31_154227_add_field_to_fichier_contrats_table', 2),
(110, '2023_01_31_154546_add_field_to_historique_locations_table', 2),
(111, '2023_01_31_154839_add_field_to_incidents_table', 2),
(112, '2023_01_31_155034_add_field_to_locations_table', 2),
(113, '2023_01_31_155440_add_field_to_moyen_paiements_table', 2),
(114, '2023_01_31_155956_add_field_to_notifications_table', 2),
(115, '2023_01_31_161407_add_field_to_paiement_loyers_table', 2),
(116, '2023_01_31_162805_create_comptes_table', 2),
(117, '2023_01_31_163333_create_operations_table', 2),
(118, '2023_01_31_163701_add_field_to_reparations_table', 2),
(119, '2023_01_31_165852_add_role_field_to_users_table', 3),
(120, '2023_02_01_120629_create_note_appartements_table', 4),
(121, '2023_02_03_140103_create_sessions_table', 4);

-- --------------------------------------------------------

--
-- Structure de la table `moyen_paiements`
--

DROP TABLE IF EXISTS `moyen_paiements`;
CREATE TABLE IF NOT EXISTS `moyen_paiements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `type_user` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `compte` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_paiement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_expiration` int DEFAULT NULL,
  `defaut` int DEFAULT NULL,
  `cvc` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mois_expiration_carte` int DEFAULT NULL,
  `paiement_auto` int DEFAULT NULL,
  `agence_id` int NOT NULL,
  `locataire_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `moyen_paiements`
--

INSERT INTO `moyen_paiements` (`id`, `reference`, `user_id`, `type_user`, `description`, `compte`, `type_paiement`, `date_expiration`, `defaut`, `cvc`, `status`, `etat`, `deleted`, `created_at`, `updated_at`, `mois_expiration_carte`, `paiement_auto`, `agence_id`, `locataire_id`) VALUES
(1, 'MPLOCAGENCE4680133', 2, 1, '', '22509383747465', '2', 2024, 0, 107, NULL, 1, 0, '2023-02-01 20:52:16', '2023-02-01 20:52:16', 12, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `note_appartements`
--

DROP TABLE IF EXISTS `note_appartements`;
CREATE TABLE IF NOT EXISTS `note_appartements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` int DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agence_id` int NOT NULL,
  `locataire_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offre_abonnements`
--

DROP TABLE IF EXISTS `offre_abonnements`;
CREATE TABLE IF NOT EXISTS `offre_abonnements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` int NOT NULL DEFAULT '0',
  `periode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'jour',
  `duree` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_jours` int NOT NULL DEFAULT '0',
  `devise` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `reduction` float DEFAULT '0',
  `net_apres_reduction` float DEFAULT '0',
  `etat` tinyint NOT NULL DEFAULT '1',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `offre_abonnements`
--

INSERT INTO `offre_abonnements` (`id`, `reference`, `libelle`, `montant`, `periode`, `duree`, `nb_jours`, `devise`, `description`, `reduction`, `net_apres_reduction`, `etat`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'AB_23020200031', 'ESSAI', 0, 'JOUR', 'JOURS', 30, 'CFA', 'Essai gratuit de 30 jours\n<br>Accès à toutes les fonctionnalités<br>\ntrafic illimité<br>\ninterruption après 30 jours<br>\nRéabonnement en premium<br> possible', 0, 0, 1, 0, '2023-02-02 00:04:27', '2023-02-02 00:04:27'),
(2, 'AB_23020200032', 'FORFAIT MENSUEL', 30000, 'MENSUEL', 'MOIS', 30, 'CFA', 'Accès à toutes les fonctionnalités<br>\ntrafic illimité<br>\ninterruption après 30<br>\nChanger de forfait vers l\'abonnement annuel<br>\nAdresse Emails pro offerts<br>\nAccès à la réplication de la base de données à la demande\n', 5000, 25000, 1, 0, '2023-02-02 00:04:27', '2023-02-02 00:04:27'),
(3, 'AB_23020200033', 'FORFAIT ANNUEL', 360000, 'ANNUEL', 'ANNEE', 365, 'CFA', 'Accès à toutes les fonctionnalités<br>\ntrafic illimité\ninterruption après 30<br>\nRéabonnement en premium<br> possible\nprélèvement annuel<br>Accès à la réplication de la base de données à la demande<br>Adresse Emails pro offerts', 110000, 250000, 1, 0, '2023-02-02 00:13:10', '2023-02-02 00:13:10');

-- --------------------------------------------------------

--
-- Structure de la table `operations`
--

DROP TABLE IF EXISTS `operations`;
CREATE TABLE IF NOT EXISTS `operations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `agence_id` int NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date_operation` datetime DEFAULT NULL,
  `type_operation` int NOT NULL,
  `montant` int NOT NULL DEFAULT '0',
  `remarque` text COLLATE utf8mb4_unicode_ci,
  `etat` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement_abonnements`
--

DROP TABLE IF EXISTS `paiement_abonnements`;
CREATE TABLE IF NOT EXISTS `paiement_abonnements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `agence_id` int NOT NULL,
  `abonnement_id` int NOT NULL,
  `montant_paiement` double(8,2) NOT NULL DEFAULT '0.00',
  `mode_paiement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_payment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entTransaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extTransaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement_loyers`
--

DROP TABLE IF EXISTS `paiement_loyers`;
CREATE TABLE IF NOT EXISTS `paiement_loyers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facture_id` int NOT NULL,
  `user_id` int NOT NULL,
  `appartement_id` int NOT NULL,
  `agence_id` int NOT NULL,
  `montant` float NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `passerelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_paiement` datetime NOT NULL,
  `status_transaction` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devise` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `moyen_paiement_id` int DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ref_paiement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locataire_id` int NOT NULL,
  `location_id` int NOT NULL,
  `mode_paiement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiement_loyers`
--

INSERT INTO `paiement_loyers` (`id`, `reference`, `facture_id`, `user_id`, `appartement_id`, `agence_id`, `montant`, `status`, `description`, `passerelle`, `date_paiement`, `status_transaction`, `devise`, `moyen_paiement_id`, `etat`, `deleted`, `created_at`, `updated_at`, `ref_paiement`, `locataire_id`, `location_id`, `mode_paiement`) VALUES
(1, 'QUIT-1327362590', 1, 1, 1, 1, 100000, 1, 'Paiement loyer du mois de January 2023 à February 2023', 'NEANT', '2023-02-01 00:00:00', 'success', 'Fr (XOF)', NULL, 1, 0, '2023-02-01 20:44:27', '2023-02-01 20:44:27', NULL, 6, 1, 'ESPECES');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prelevements`
--

DROP TABLE IF EXISTS `prelevements`;
CREATE TABLE IF NOT EXISTS `prelevements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agence_id` int NOT NULL DEFAULT '0',
  `montant` int DEFAULT NULL,
  `devise` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `moyen_paiement_id` int DEFAULT NULL,
  `abonnement_id` int DEFAULT NULL,
  `passerelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_transaction` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_prelevement` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `etat` tinyint NOT NULL DEFAULT '1',
  `deleted` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reparations`
--

DROP TABLE IF EXISTS `reparations`;
CREATE TABLE IF NOT EXISTS `reparations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incident_id` int NOT NULL,
  `user_id` int NOT NULL,
  `agence_id` int NOT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `read_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `resiliations`
--

DROP TABLE IF EXISTS `resiliations`;
CREATE TABLE IF NOT EXISTS `resiliations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `motif` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `agence_id` int NOT NULL,
  `etat` tinyint NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_activity` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`, `created_at`, `updated_at`) VALUES
('l7saI8NCJlmU7HYSl9xE4tMBrTOSot0umUklKptg', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 Edg/109.0.1518.70', NULL, '2023-02-04 02:56:27', '2023-02-04 02:56:27', '2023-02-04 02:56:27'),
('RVmWUmT7Mxce9p3se4QahiwNyM00gks5EtBZ9He1', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 Edg/109.0.1518.70', NULL, '2023-02-04 02:47:55', '2023-02-04 02:47:55', '2023-02-04 02:47:55'),
('AZEEAZOg8QQ1t60It0qRj1d6VpLWOwHZT87Ux10F', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 Edg/109.0.1518.70', NULL, '2023-02-03 15:19:29', '2023-02-03 15:19:29', '2023-02-03 15:19:29');

-- --------------------------------------------------------

--
-- Structure de la table `soldes`
--

DROP TABLE IF EXISTS `soldes`;
CREATE TABLE IF NOT EXISTS `soldes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agence_id` int NOT NULL,
  `solde` double(8,2) NOT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0',
  `etat` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `suggestions`
--

DROP TABLE IF EXISTS `suggestions`;
CREATE TABLE IF NOT EXISTS `suggestions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sujet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `agence_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locataire_id` int DEFAULT NULL,
  `date_naissance` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_user` int NOT NULL,
  `role` int DEFAULT NULL,
  `contact` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_fixe` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_cni` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexe` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int DEFAULT NULL,
  `code_verification` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_cni` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_agrement` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localisation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registre_commerce` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` tinyint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `agence_id` int NOT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `email_verified_at`, `password`, `reference`, `locataire_id`, `date_naissance`, `type_user`, `role`, `contact`, `contact_fixe`, `photo`, `num_cni`, `adresse`, `sexe`, `ville`, `country_id`, `code_verification`, `photo_cni`, `num_agrement`, `localisation`, `registre_commerce`, `etat`, `status`, `agence_id`, `deleted`, `description`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Warren', 'O\'Connell', 'christ45@example.net', '2023-01-31 17:12:18', '$2y$10$t3574.PvML4rInU8XYryiejeD21rfjkgMb8QcO9/agym9s4mNTwti', 'SGSfbTij', NULL, '2023-02-01', 2, 3, '14089048666', '', '167518603158162.jpg', 'CI18736649950', NULL, 'M', 'Abidjan', 53, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0, NULL, 'L3FUGC6RI7kNpIbb05rURD1PV58Pby3h2w3q4Fmsmb4LNBsPeWHNNHS56qHt', '2023-01-31 17:12:18', '2023-02-01 12:08:11'),
(2, 'Chance Hackett II', NULL, 'magdalen29@example.com', '2023-01-31 17:12:18', '$2y$10$jnvad3AxP6Yx5f8to4.AFe2C3pc7sznqIQ7T1as21wGbB74jaAQci', 'nVtkVzlz', NULL, NULL, 1, 0, '(727) 355-5618', NULL, NULL, NULL, NULL, NULL, 'Abidjan', 52, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0, NULL, 'Pbn5ELwRyV', '2023-01-31 17:12:18', '2023-01-31 17:12:18'),
(3, 'Reyes Wintheiser', NULL, 'tremaine.gibson@example.net', '2023-01-31 17:14:57', '$2y$10$m0X4NT4X6i.5RJQt2IOeQugDgM.M7z6GgEgcNga5UhXslz36szE9K', 'beToUOwr', 1, NULL, 1, 0, '1-435-339-0491', NULL, NULL, NULL, NULL, NULL, 'Abidjan', 52, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0, NULL, 'XF8Fx9papsXV8OmcI23HohAVlUOa4gf9JNSDNZCN', '2023-01-31 17:14:57', '2023-01-31 17:14:57'),
(4, 'Humberto Beier', NULL, 'marquardt.jordane@example.com', '2023-01-31 17:14:57', '$2y$10$yJRNTt/KaDli8W2pWUtF0uRAyoe72FrHzesYhNr5GQVbWl2ogPpzy', '4ceHalNy', 1, NULL, 1, 0, '856.816.3014', NULL, NULL, NULL, NULL, NULL, 'Abidjan', 52, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0, NULL, 'gXp4wbet73WsvoEi0HsQ15EoH4HmsbaotjsMocT8', '2023-01-31 17:14:57', '2023-01-31 17:14:57'),
(5, 'botchi', 'dagou', 'dagou@yopmail.com', NULL, NULL, '5239947478', NULL, NULL, 0, NULL, '2250506141244', NULL, NULL, NULL, 'cocody bonoumin', NULL, 'abidjan', 53, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0, NULL, NULL, '2023-01-31 17:43:46', '2023-01-31 17:43:46'),
(6, 'atse', 'brice', 'brice@yopmail.com', NULL, NULL, '6544875210', NULL, NULL, 1, NULL, '8274748484', '9304049900', '167525889092870.jpg', '167525889011594.png', 'treichville', NULL, 'abidjan cocody', 53, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0, NULL, NULL, '2023-02-01 13:41:30', '2023-02-01 13:41:30'),
(7, 'botchi', 'dagou', 'botchipatrick@gmail.com', '2023-02-04 02:57:19', NULL, 'US_8882540006', NULL, NULL, 2, 3, '848458754', NULL, NULL, NULL, NULL, NULL, 'abidjan', NULL, 'LO-81426', NULL, NULL, NULL, NULL, 1, 0, 4, 0, NULL, 'l7saI8NCJlmU7HYSl9xE4tMBrTOSot0umUklKptg', '2023-02-03 15:19:29', '2023-02-04 02:57:19');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
