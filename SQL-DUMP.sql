-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 28. Mai, 2021 17:50 PM
-- Tjener-versjon: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kaffebar`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `drikke`
--

DROP TABLE IF EXISTS `drikke`;
CREATE TABLE IF NOT EXISTS `drikke` (
  `Drikke_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Drikke_vare` varchar(30) COLLATE latin1_danish_ci NOT NULL,
  `Drikke_pris` int(11) DEFAULT NULL,
  PRIMARY KEY (`Drikke_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

--
-- Dataark for tabell `drikke`
--

INSERT INTO `drikke` (`Drikke_ID`, `Drikke_vare`, `Drikke_pris`) VALUES
(1, 'Americano', 30),
(2, 'Mocca', 38),
(3, 'Tors Hammer', 44);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `ordre`
--

DROP TABLE IF EXISTS `ordre`;
CREATE TABLE IF NOT EXISTS `ordre` (
  `Ordre_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ordre_tid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Ordre_vare` varchar(30) COLLATE latin1_danish_ci DEFAULT NULL,
  `Ordre_kvantum` int(11) DEFAULT NULL,
  `Ordre_belop` int(11) DEFAULT NULL,
  `Ordre_tillegg` varchar(30) COLLATE latin1_danish_ci DEFAULT NULL,
  PRIMARY KEY (`Ordre_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

--
-- Dataark for tabell `ordre`
--

INSERT INTO `ordre` (`Ordre_ID`, `Ordre_tid`, `Ordre_vare`, `Ordre_kvantum`, `Ordre_belop`, `Ordre_tillegg`) VALUES
(1, '2021-05-26 22:43:40', 'Americano', 2, 60, NULL),
(2, '2021-05-26 22:46:11', 'Mocca', 1, 40, NULL),
(3, '2021-05-26 22:50:13', 'Americano', 1, 34, 'Fløte'),
(4, '2021-05-28 07:37:51', 'dsfds', 2, NULL, NULL),
(5, '2021-05-28 07:38:03', 'dsfds', 2, NULL, NULL),
(6, '2021-05-28 08:05:04', 'uiyuyiyu', 8, NULL, NULL),
(9, '2021-05-28 15:54:20', NULL, NULL, 38, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `tillegg`
--

DROP TABLE IF EXISTS `tillegg`;
CREATE TABLE IF NOT EXISTS `tillegg` (
  `Tillegg_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Tillegg_vare` varchar(30) COLLATE latin1_danish_ci NOT NULL,
  `Tillegg_pris` int(11) DEFAULT NULL,
  PRIMARY KEY (`Tillegg_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci;

--
-- Dataark for tabell `tillegg`
--

INSERT INTO `tillegg` (`Tillegg_ID`, `Tillegg_vare`, `Tillegg_pris`) VALUES
(1, 'Fløte', 4),
(2, 'sukker', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
