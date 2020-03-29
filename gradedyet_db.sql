-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 mrt 2020 om 11:59
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

--
-- Gegevens worden geëxporteerd voor tabel `class`
--

INSERT INTO `class` (`Id`, `Name`, `TestAmount`, `ExaminedAmount`, `Group`, `TeacherId`) VALUES
(1, 'test', 30, 0, 'INF2SB', 4),
(6, 'PHP1', 40, 23, 'INF1SA', 4);

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
  `Name` varchar(50) NOT NULL,
  `Prefix` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) NOT NULL,
  `SchoolId` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `teacher`
--

INSERT INTO `teacher` (`Id`, `Name`, `Prefix`, `LastName`, `SchoolId`, `Email`) VALUES
(1, 'Thijs', '', 'Otter', 1, 'thijs.otter@inholland.nl'),
(2, 'Stef', '', 'Robbe', 1, '627468@student.inholland.nl'),
(3, 'kaas', 'van', 'tol', 1, 'thijs@vnatol.com'),
(4, 'Stef', '', 'Robbe', 1, 'stef.robbe@gmail.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `teacherlogin`
--

CREATE TABLE `teacherlogin` (
  `Id` int(11) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `teacherlogin`
--

INSERT INTO `teacherlogin` (`Id`, `Password`) VALUES
(1, '24c0dfb06aac9dfa3b735f13eded2981fd5badd93f46a25f0cdd26a4a31e215b6e72a814c0ab00ea892b309d0a845314018b1883433f4a4d7637a4edc17062f6'),
(2, '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2'),
(3, '4308b17894bdea21d6cf8014b50590a0ec3fe70b33eaa9ae2879a546c3f48c160a6ad4dadf38914ae786e972937c3346020c90ae7da32add7ef98139d0731155'),
(4, '5ea0640503fb88b713cb9cfb71b7e9a2caf532c5ac5e1ce69a3f9dcff64155d8c68a375516d477164dc7991562026393d729ad8791546aa708d79791c9f33c2e');

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
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `class`
--
ALTER TABLE `class`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `school`
--
ALTER TABLE `school`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `teacher`
--
ALTER TABLE `teacher`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `teacherlogin`
--
ALTER TABLE `teacherlogin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
