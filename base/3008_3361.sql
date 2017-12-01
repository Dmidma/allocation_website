-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 02 Avril 2017 à 10:06
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `3008_3361`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `reservation_id` int(10) unsigned NOT NULL,
  `id` varchar(20) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `country` varchar(45) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`reservation_id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=greek;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`reservation_id`, `id`, `name`, `surname`, `email`, `country`, `phone`) VALUES
(199600, '12651287', 'sarra', 'sarras', 'sarra@sarra.com', 'tunisie', '12365489');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `reservation_id` int(10) unsigned NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `breakfast` tinyint(1) NOT NULL,
  PRIMARY KEY (`reservation_id`),
  UNIQUE KEY `reservation_id_UNIQUE` (`reservation_id`),
  KEY `fk_reservations_rooms1_idx` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=greek;

--
-- Contenu de la table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `room_id`, `check_in`, `check_out`, `total`, `price`, `breakfast`) VALUES
(199600, 103, '2017-04-20', '2017-04-22', 2, '80', 0);

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int(10) unsigned NOT NULL,
  `floor` tinyint(4) NOT NULL,
  `room_type` varchar(10) NOT NULL,
  `room_view` varchar(3) NOT NULL,
  `room_price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=greek;

--
-- Contenu de la table `rooms`
--

INSERT INTO `rooms` (`room_id`, `floor`, `room_type`, `room_view`, `room_price`) VALUES
(101, 1, 'double', 'oui', '25'),
(102, 1, 'double', 'oui', '25'),
(103, 1, 'quadruple', 'non', '40'),
(201, 2, 'triple', 'non', '30'),
(202, 2, 'triple', 'oui', '40'),
(203, 2, 'quadruple', 'oui', '40');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=greek;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservations__clients` FOREIGN KEY (`reservation_id`) REFERENCES `clients` (`reservation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservations_rooms1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
