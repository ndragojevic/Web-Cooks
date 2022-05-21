-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 21, 2022 at 12:39 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_kuvar`
--
CREATE DATABASE IF NOT EXISTS `web_kuvar` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `web_kuvar`;

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

DROP TABLE IF EXISTS `komentari`;
CREATE TABLE IF NOT EXISTS `komentari` (
  `KomId` int(11) NOT NULL AUTO_INCREMENT,
  `Tekst` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '""',
  `KorId` int(11) NOT NULL,
  `ReceptId` int(11) NOT NULL,
  PRIMARY KEY (`KomId`),
  KEY `KorId` (`KorId`),
  KEY `ReceptId` (`ReceptId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `KorId` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(20) NOT NULL,
  `Prezime` varchar(20) NOT NULL,
  `KorisnickoIme` varchar(20) NOT NULL,
  `Lozinka` varchar(1000) NOT NULL,
  `rola` varchar(15) NOT NULL DEFAULT 'user',
  `mejl` varchar(50) NOT NULL,
  PRIMARY KEY (`KorId`),
  UNIQUE KEY `KorisnickoIme` (`KorisnickoIme`),
  UNIQUE KEY `mejl` (`mejl`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnikomiljenirecepti`
--

DROP TABLE IF EXISTS `korisnikomiljenirecepti`;
CREATE TABLE IF NOT EXISTS `korisnikomiljenirecepti` (
  `OmiljeniId` int(11) NOT NULL AUTO_INCREMENT,
  `KorId` int(11) NOT NULL,
  `ReceptId` int(11) NOT NULL,
  PRIMARY KEY (`OmiljeniId`),
  KEY `KorId` (`KorId`),
  KEY `ReceptId` (`ReceptId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `namirnicekorisnik`
--

DROP TABLE IF EXISTS `namirnicekorisnik`;
CREATE TABLE IF NOT EXISTS `namirnicekorisnik` (
  `NamId` int(11) NOT NULL AUTO_INCREMENT,
  `KorId` int(11) NOT NULL,
  `Naziv` varchar(20) NOT NULL,
  `Kolicina` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`NamId`),
  KEY `KorId` (`KorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `namirnicerecept`
--

DROP TABLE IF EXISTS `namirnicerecept`;
CREATE TABLE IF NOT EXISTS `namirnicerecept` (
  `NamId` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(20) NOT NULL,
  `Kolicina` float NOT NULL,
  `ReceptId` int(11) NOT NULL,
  PRIMARY KEY (`NamId`),
  KEY `ReceptId` (`ReceptId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recepti`
--

DROP TABLE IF EXISTS `recepti`;
CREATE TABLE IF NOT EXISTS `recepti` (
  `ReceptId` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(30) NOT NULL,
  `Kategorija` varchar(35) NOT NULL,
  `ZbirOcena` int(11) NOT NULL DEFAULT '0',
  `BrojOcena` int(11) NOT NULL DEFAULT '0',
  `SlikaJela` longblob NOT NULL,
  `Postupak` varchar(1000) NOT NULL,
  `VremeIzrade` float NOT NULL DEFAULT '1',
  `Datum` date NOT NULL,
  `KorId` int(11) NOT NULL,
  `TezinaIzrade` varchar(20) NOT NULL DEFAULT 'lako',
  PRIMARY KEY (`ReceptId`),
  KEY `KorId` (`KorId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`KorId`) REFERENCES `korisnici` (`KorId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentari_ibfk_2` FOREIGN KEY (`ReceptId`) REFERENCES `recepti` (`ReceptId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `korisnikomiljenirecepti`
--
ALTER TABLE `korisnikomiljenirecepti`
  ADD CONSTRAINT `korisnikomiljenirecepti_ibfk_1` FOREIGN KEY (`KorId`) REFERENCES `korisnici` (`KorId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `korisnikomiljenirecepti_ibfk_2` FOREIGN KEY (`ReceptId`) REFERENCES `recepti` (`ReceptId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `namirnicekorisnik`
--
ALTER TABLE `namirnicekorisnik`
  ADD CONSTRAINT `namirnicekorisnik_ibfk_1` FOREIGN KEY (`KorId`) REFERENCES `korisnici` (`KorId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `namirnicerecept`
--
ALTER TABLE `namirnicerecept`
  ADD CONSTRAINT `namirnicerecept_ibfk_1` FOREIGN KEY (`ReceptId`) REFERENCES `recepti` (`ReceptId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recepti`
--
ALTER TABLE `recepti`
  ADD CONSTRAINT `recepti_ibfk_1` FOREIGN KEY (`KorId`) REFERENCES `korisnici` (`KorId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
