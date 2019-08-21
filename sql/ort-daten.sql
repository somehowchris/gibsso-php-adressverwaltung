-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Aug 2019 um 11:40
-- Server-Version: 10.1.33-MariaDB
-- PHP-Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `adressen`
--

--
-- Daten für Tabelle `ort`
--

INSERT INTO `ort` (`oid`, `plz`, `ort`) VALUES
(1, 1000, 'Lausanne'),
(2, 1020, 'Renens'),
(3, 1200, 'Genève'),
(4, 1700, 'Fribourg'),
(5, 1880, 'Bex'),
(6, 2000, 'Neuchatel'),
(7, 2500, 'Biel'),
(8, 2540, 'Grenchen'),
(9, 2544, 'Bettlach'),
(10, 2545, 'Selzach'),
(11, 2543, 'Lengnau'),
(12, 2800, 'Delemont'),
(13, 3000, 'Bern'),
(14, 3250, 'Lyss'),
(15, 3253, 'Schnottwil'),
(16, 3280, 'Murten'),
(17, 3293, 'Dotzigen'),
(18, 3294, 'Büren'),
(19, 3775, 'Lenk'),
(20, 4000, 'Basel'),
(21, 4143, 'Dornach'),
(22, 4500, 'Solothurn'),
(23, 4501, 'Solothurn'),
(24, 4502, 'Solothurn'),
(25, 5000, 'Aarau'),
(26, 5001, 'Aarau'),
(27, 5405, 'Baden'),
(28, 6000, 'Luzern'),
(29, 6900, 'Lugano'),
(30, 7000, 'Chur'),
(31, 7050, 'Arosa'),
(32, 7500, 'St. Moritz'),
(33, 8000, 'Zürich'),
(34, 8001, 'Zürich'),
(35, 8400, 'Winterthur'),
(36, 9000, 'St. Gallen'),
(37, 9100, 'Herisau'),
(38, 9200, 'Gossau'),
(39, 9400, 'Rorschach'),
(40, 9500, 'Wil'),
(41, 79761, 'Waldshut'),
(43, 1950, 'Sion');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
