-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 02 feb 2020 om 19:12
-- Serverversie: 10.4.6-MariaDB
-- PHP-versie: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gradedyet_db`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `class`
--

CREATE TABLE `class` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `TestAmount` int(11) NOT NULL,
  `ExaminedAmount` int(11) NOT NULL,
  `Group` varchar(60) NOT NULL,
  `TeacherId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `school`
--

CREATE TABLE `school` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `City` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `school`
--

INSERT INTO `school` (`Id`, `Name`, `City`) VALUES
(1, 'Hogeschool InHolland', 'Haarlem');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `teacher`
--

CREATE TABLE `teacher` (
  `Id` int(11) NOT NULL,
  `Name` int(11) NOT NULL,
  `Prefix` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) NOT NULL,
  `SchoolId` int(11) NOT NULL,
  `Email` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `teacherlogin`
--

CREATE TABLE `teacherlogin` (
  `Id` int(11) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `teacherresetkeys`
--

CREATE TABLE `teacherresetkeys` (
  `Id` int(11) NOT NULL,
  `Resetkey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verifyteacheraccountkeys`
--

CREATE TABLE `verifyteacheraccountkeys` (
  `Id` int(11) NOT NULL,
  `VerifyKey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `teacherlogin`
--
ALTER TABLE `teacherlogin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `teacherresetkeys`
--
ALTER TABLE `teacherresetkeys`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `verifyteacheraccountkeys`
--
ALTER TABLE `verifyteacheraccountkeys`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `class`
--
ALTER TABLE `class`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `school`
--
ALTER TABLE `school`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `teacher`
--
ALTER TABLE `teacher`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `teacherlogin`
--
ALTER TABLE `teacherlogin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `teacherresetkeys`
--
ALTER TABLE `teacherresetkeys`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `verifyteacheraccountkeys`
--
ALTER TABLE `verifyteacheraccountkeys`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
