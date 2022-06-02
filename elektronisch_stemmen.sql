-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2022 at 09:20 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elektronisch_stemmen`
--

-- --------------------------------------------------------

--
-- Table structure for table `gebruiker`
--

CREATE TABLE `gebruiker` (
  `GebruikerID` int(11) NOT NULL,
  `Gebruikersnaam` text NOT NULL,
  `Wachtwoord` varchar(32) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Leeftijd` int(2) NOT NULL,
  `Indentiteit` int(9) NOT NULL,
  `Macht` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gebruiker`
--

INSERT INTO `gebruiker` (`GebruikerID`, `Gebruikersnaam`, `Wachtwoord`, `Email`, `Leeftijd`, `Indentiteit`, `Macht`) VALUES
(1, 'Christoph', 'Christoph123', 'christoph.a.s.boersen@gmail.com', 22, 123456789, 'stemgerechtigden'),
(2, 'Win Myat', 'little bird', 'winmyatnandar34@gmail.com', 21, 987654321, 'Minister');

-- --------------------------------------------------------

--
-- Table structure for table `parijenperverkiezingen`
--

CREATE TABLE `parijenperverkiezingen` (
  `partijID` int(11) NOT NULL,
  `PartijNaam` varchar(30) NOT NULL,
  `Afkorting` varchar(6) NOT NULL,
  `Goedkeuren` text NOT NULL,
  `VerkiezingID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parijenperverkiezingen`
--

INSERT INTO `parijenperverkiezingen` (`partijID`, `PartijNaam`, `Afkorting`, `Goedkeuren`, `VerkiezingID`) VALUES
(1, 'Bangtan Boys', 'BTS', 'Ja', 1);

-- --------------------------------------------------------

--
-- Table structure for table `verkiesbaren`
--

CREATE TABLE `verkiesbaren` (
  `VerkiesbareID` int(11) NOT NULL,
  `GebruikerID` int(11) NOT NULL,
  `Naam` text NOT NULL,
  `partijMacht` text NOT NULL,
  `partijID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verkiesbaren`
--

INSERT INTO `verkiesbaren` (`VerkiesbareID`, `GebruikerID`, `Naam`, `partijMacht`, `partijID`) VALUES
(3, 1, 'Christoph', 'admin', 1),
(4, 2, 'Win', 'Verkiesbare', 1);

-- --------------------------------------------------------

--
-- Table structure for table `verkiezingsoorten`
--

CREATE TABLE `verkiezingsoorten` (
  `VerkiezingID` int(11) NOT NULL,
  `Bestuursniveau` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verkiezingsoorten`
--

INSERT INTO `verkiezingsoorten` (`VerkiezingID`, `Bestuursniveau`) VALUES
(1, 'test'),
(3, 'test test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`GebruikerID`);

--
-- Indexes for table `parijenperverkiezingen`
--
ALTER TABLE `parijenperverkiezingen`
  ADD PRIMARY KEY (`partijID`);

--
-- Indexes for table `verkiesbaren`
--
ALTER TABLE `verkiesbaren`
  ADD PRIMARY KEY (`VerkiesbareID`);

--
-- Indexes for table `verkiezingsoorten`
--
ALTER TABLE `verkiezingsoorten`
  ADD PRIMARY KEY (`VerkiezingID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `GebruikerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parijenperverkiezingen`
--
ALTER TABLE `parijenperverkiezingen`
  MODIFY `partijID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `verkiesbaren`
--
ALTER TABLE `verkiesbaren`
  MODIFY `VerkiesbareID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `verkiezingsoorten`
--
ALTER TABLE `verkiezingsoorten`
  MODIFY `VerkiezingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
