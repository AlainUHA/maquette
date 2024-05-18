-- Adminer 4.8.1 MySQL 11.2.2-MariaDB-1:11.2.2+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `acces_mention`;
CREATE TABLE `acces_mention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `mention_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_47635C65FB88E14F` (`utilisateur_id`),
  KEY `IDX_47635C657A4147F0` (`mention_id`),
  KEY `IDX_47635C65D60322AC` (`role_id`),
  CONSTRAINT `FK_47635C657A4147F0` FOREIGN KEY (`mention_id`) REFERENCES `mention` (`id`),
  CONSTRAINT `FK_47635C65D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  CONSTRAINT `FK_47635C65FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `apprentissage_critique`;
CREATE TABLE `apprentissage_critique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bloc_id` int(11) NOT NULL,
  `niveau_id` int(11) NOT NULL,
  `libelle` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A3F4F1F55582E9C0` (`bloc_id`),
  KEY `IDX_A3F4F1F5B3E9C81` (`niveau_id`),
  CONSTRAINT `FK_A3F4F1F55582E9C0` FOREIGN KEY (`bloc_id`) REFERENCES `bloc` (`id`),
  CONSTRAINT `FK_A3F4F1F5B3E9C81` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `apprentissage_critique` (`id`, `bloc_id`, `niveau_id`, `libelle`) VALUES
(1,	1,	1,	'Démarrer le simulateur'),
(2,	1,	2,	'Assister le pilote au décollage'),
(3,	3,	3,	'Accorder des congés'),
(6,	3,	5,	'Faire un putsch chez Peugeot');

DROP TABLE IF EXISTS `bloc`;
CREATE TABLE `bloc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mention_id` int(11) NOT NULL,
  `libelle` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C778955A7A4147F0` (`mention_id`),
  CONSTRAINT `FK_C778955A7A4147F0` FOREIGN KEY (`mention_id`) REFERENCES `mention` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bloc` (`id`, `mention_id`, `libelle`) VALUES
(1,	1,	'un premier bloc pour la mention Physique'),
(2,	3,	'un premier bloc pour la mention 3'),
(3,	1,	'un second bloc');

DROP TABLE IF EXISTS `composante`;
CREATE TABLE `composante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `composante` (`id`, `libelle`) VALUES
(1,	'FST'),
(2,	'FLSH'),
(3,	'FSESJ'),
(4,	'UHABS'),
(5,	'IUTC'),
(6,	'Autre');

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240507193009',	'2024-05-07 19:30:15',	168),
('DoctrineMigrations\\Version20240507193138',	'2024-05-07 19:31:44',	54),
('DoctrineMigrations\\Version20240509165002',	'2024-05-09 16:50:19',	90);

DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `grade` (`id`, `grade`) VALUES
(1,	'Licence'),
(2,	'Licence Pro'),
(3,	'Master');

DROP TABLE IF EXISTS `mention`;
CREATE TABLE `mention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resp_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `composante_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `rncp` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E20259CDF2EFA634` (`resp_id`),
  KEY `IDX_E20259CDFE19A1A8` (`grade_id`),
  KEY `IDX_E20259CDAC12F1AD` (`composante_id`),
  CONSTRAINT `FK_E20259CDAC12F1AD` FOREIGN KEY (`composante_id`) REFERENCES `composante` (`id`),
  CONSTRAINT `FK_E20259CDF2EFA634` FOREIGN KEY (`resp_id`) REFERENCES `utilisateur` (`id`),
  CONSTRAINT `FK_E20259CDFE19A1A8` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mention` (`id`, `resp_id`, `grade_id`, `composante_id`, `titre`, `created_at`, `modified_at`, `rncp`) VALUES
(1,	4,	1,	1,	'Physique',	'2024-05-07 19:56:21',	'2024-05-07 21:29:27',	'24529'),
(2,	1,	3,	2,	'Lettres',	'2024-05-07 20:14:45',	'2024-05-07 20:14:45',	'11111'),
(3,	1,	2,	3,	'Droit',	'2024-05-08 16:09:58',	'2024-05-08 16:09:58',	'22');

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `niveau`;
CREATE TABLE `niveau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bloc_id` int(11) NOT NULL,
  `niveau` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4BDFF36B5582E9C0` (`bloc_id`),
  CONSTRAINT `FK_4BDFF36B5582E9C0` FOREIGN KEY (`bloc_id`) REFERENCES `bloc` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `niveau` (`id`, `bloc_id`, `niveau`, `description`) VALUES
(1,	1,	1,	'Piloter en simulateur'),
(2,	1,	2,	'co-piloter'),
(3,	3,	1,	'Manager une petite équipe'),
(4,	3,	2,	'Manager une équipe moyenne'),
(5,	3,	3,	'Manager une grande entreprise');

DROP TABLE IF EXISTS `niveau_parcours`;
CREATE TABLE `niveau_parcours` (
  `niveau_id` int(11) NOT NULL,
  `parcours_id` int(11) NOT NULL,
  PRIMARY KEY (`niveau_id`,`parcours_id`),
  KEY `IDX_20B71E50B3E9C81` (`niveau_id`),
  KEY `IDX_20B71E506E38C0DB` (`parcours_id`),
  CONSTRAINT `FK_20B71E506E38C0DB` FOREIGN KEY (`parcours_id`) REFERENCES `parcours` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_20B71E50B3E9C81` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `niveau_parcours` (`niveau_id`, `parcours_id`) VALUES
(1,	1),
(1,	2),
(1,	3),
(2,	1),
(2,	2),
(2,	3),
(3,	1),
(4,	1);

DROP TABLE IF EXISTS `parcours`;
CREATE TABLE `parcours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mention_id` int(11) NOT NULL,
  `resp_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `referent` varchar(50) DEFAULT NULL,
  `min_stage` int(11) DEFAULT NULL,
  `max_stage` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `modified_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_99B1DEE37A4147F0` (`mention_id`),
  KEY `IDX_99B1DEE3F2EFA634` (`resp_id`),
  CONSTRAINT `FK_99B1DEE37A4147F0` FOREIGN KEY (`mention_id`) REFERENCES `mention` (`id`),
  CONSTRAINT `FK_99B1DEE3F2EFA634` FOREIGN KEY (`resp_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `parcours` (`id`, `mention_id`, `resp_id`, `titre`, `referent`, `min_stage`, `max_stage`, `created_at`, `modified_at`) VALUES
(1,	1,	1,	'Physique',	'toto',	1,	3,	'2024-05-07 21:42:04',	'2024-05-07 22:14:29'),
(2,	1,	1,	'Chimie',	'titi',	100,	200,	'2024-05-07 21:42:36',	'2024-05-07 21:42:36'),
(3,	1,	1,	'ESR',	'euh',	280,	600,	'2024-05-08 16:06:47',	'2024-05-08 16:06:47'),
(4,	3,	1,	'droit des socités',	'pas moi',	1,	1,	'2024-05-08 16:10:19',	'2024-05-08 16:10:19');

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `composante_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_MAIL` (`mail`),
  KEY `IDX_1D1C63B3AC12F1AD` (`composante_id`),
  CONSTRAINT `FK_1D1C63B3AC12F1AD` FOREIGN KEY (`composante_id`) REFERENCES `composante` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `utilisateur` (`id`, `prenom`, `nom`, `mail`, `roles`, `password`, `composante_id`) VALUES
(1,	'Alain',	'Bolli',	'alain.bolli@uha.fr',	'[\"ROLE_USER\", \"ROLE_ADMIN\"]',	'$2y$13$yY6RzzykZ/k/uJIGNgJkW.AMB5PuVt/.9Psd/QQ6B5gSgCPy5/6D6',	1),
(4,	'Carmelo',	'Pirri',	'carmelo.pirri@uha.fr',	'[]',	'$2y$13$4z87PWtFn8AgD0/vvFwHCOlkklqoFHVlX9lM1tolSaAMdzEu6Fcma',	1),
(7,	'toto',	'tata',	'toto@uha.fr',	'[]',	'$2y$13$QIXruASyKYrNbiI/WzakvO7grdkcb3UZiR0mYtO6Vqlec2VVb6Z2W',	1),
(8,	'azerty',	'azerty',	'azerty@uha.fr',	'[]',	'$2y$13$nSsob91cPQol1hQIDsHkFep/BKVxBfB2h8QaXFT0y3./.unN20qPG',	1);

-- 2024-05-18 09:40:57
