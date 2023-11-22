-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22. Nov, 2023 16:52 PM
-- Tjener-versjon: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobbsystem`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `arbeidsgiver`
--

CREATE TABLE `arbeidsgiver` (
  `ArbeidsgiverID` int(11) NOT NULL,
  `BrukerID` int(11) DEFAULT NULL,
  `FirmaNavn` varchar(255) DEFAULT NULL,
  `LederNavn` varchar(255) DEFAULT NULL,
  `Epost` varchar(255) DEFAULT NULL,
  `Tlf` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `arbeidsgiver`
--

INSERT INTO `arbeidsgiver` (`ArbeidsgiverID`, `BrukerID`, `FirmaNavn`, `LederNavn`, `Epost`, `Tlf`) VALUES
(1, 2, 'Firma A', 'Leder A', 'lederA@example.com', '1112223333'),
(2, 3, 'Firma B', 'Leder B', 'lederB@example.com', '4445556666');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `arbeidstaker`
--

CREATE TABLE `arbeidstaker` (
  `ArbeidstakerID` int(11) NOT NULL,
  `BrukerID` int(11) DEFAULT NULL,
  `Navn` varchar(255) DEFAULT NULL,
  `Epost` varchar(255) DEFAULT NULL,
  `Fodselsdato` date DEFAULT NULL,
  `Tlf` varchar(10) DEFAULT NULL,
  `CV` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `arbeidstaker`
--

INSERT INTO `arbeidstaker` (`ArbeidstakerID`, `BrukerID`, `Navn`, `Epost`, `Fodselsdato`, `Tlf`, `CV`) VALUES
(1, 1, 'Arbeidstaker Navn 1', 'arbeidstaker1@example.com', '1001-01-01', '1234567890', 0x4172626569647374616b65722043562031),
(2, 4, 'Arbeidstaker Navn 2', 'arbeidstaker2@example.com', '1001-01-01', '9876543210', 0x4172626569647374616b65722043562032);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `bruker`
--

CREATE TABLE `bruker` (
  `BrukerID` int(11) NOT NULL,
  `Brukernavn` varchar(255) DEFAULT NULL,
  `Passord` varchar(255) DEFAULT NULL,
  `Rolle` varchar(255) DEFAULT NULL,
  `Regdato` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `bruker`
--

INSERT INTO `bruker` (`BrukerID`, `Brukernavn`, `Passord`, `Rolle`, `Regdato`) VALUES
(1, 'user1', 'password1', 'Arbeidstaker', '2000-01-25 01:59:59'),
(2, 'user2', 'password2', 'Arbeidsgiver', '1950-02-25 02:59:59'),
(3, 'user3', 'password3', 'Arbeidsgiver', '2012-03-25 05:59:59'),
(4, 'user4', 'password4', 'Arbeidstaker', '1000-04-25 08:59:59');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `jobbannonse`
--

CREATE TABLE `jobbannonse` (
  `JobbannonseID` int(11) NOT NULL,
  `ArbeidsgiverID` int(11) DEFAULT NULL,
  `Beskrivelse` varchar(255) DEFAULT NULL,
  `KravTekst` tinyint(1) DEFAULT NULL,
  `KravCV` tinyint(1) DEFAULT NULL,
  `KravDoc` tinyint(1) DEFAULT NULL,
  `Tidsfrist` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `jobbannonse`
--

INSERT INTO `jobbannonse` (`JobbannonseID`, `ArbeidsgiverID`, `Beskrivelse`, `KravTekst`, `KravCV`, `KravDoc`, `Tidsfrist`) VALUES
(1, 1, 'Jobb Annonse 1', 1, 0, 1, '2023-12-01 12:00:00'),
(2, 2, 'Jobb Annonse 2', 0, 1, 0, '2023-12-15 18:00:00');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `profil`
--

CREATE TABLE `profil` (
  `ProfilID` int(11) NOT NULL,
  `BrukerID` int(11) DEFAULT NULL,
  `Beskrivelse` varchar(255) DEFAULT NULL,
  `Sokbar` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `profil`
--

INSERT INTO `profil` (`ProfilID`, `BrukerID`, `Beskrivelse`, `Sokbar`) VALUES
(1, 1, 'Arbeidstaker Profil', 1),
(2, 2, 'Arbeidsgiver Profil 1', 1),
(3, 3, 'Arbeidsgiver Profil 2', 1),
(4, 4, 'Arbeidstaker Profil 2', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `soknad`
--

CREATE TABLE `soknad` (
  `SoknadID` int(11) NOT NULL,
  `JobbannonseID` int(11) DEFAULT NULL,
  `ArbeidstakerID` int(11) DEFAULT NULL,
  `Soknadtekst` text DEFAULT NULL,
  `Dato` datetime DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `soknad`
--

INSERT INTO `soknad` (`SoknadID`, `JobbannonseID`, `ArbeidstakerID`, `Soknadtekst`, `Dato`, `Status`) VALUES
(1, 1, 1, 'Søknadstekst for jobb 1', '2023-11-18 09:00:00', 'Under vurdering'),
(2, 2, 2, 'Søknadstekst for jobb 2', '2023-11-20 15:30:00', 'Sendt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arbeidsgiver`
--
ALTER TABLE `arbeidsgiver`
  ADD PRIMARY KEY (`ArbeidsgiverID`);

--
-- Indexes for table `arbeidstaker`
--
ALTER TABLE `arbeidstaker`
  ADD PRIMARY KEY (`ArbeidstakerID`);

--
-- Indexes for table `bruker`
--
ALTER TABLE `bruker`
  ADD PRIMARY KEY (`BrukerID`);

--
-- Indexes for table `jobbannonse`
--
ALTER TABLE `jobbannonse`
  ADD PRIMARY KEY (`JobbannonseID`),
  ADD KEY `ArbeidsgiverID` (`ArbeidsgiverID`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`ProfilID`);

--
-- Indexes for table `soknad`
--
ALTER TABLE `soknad`
  ADD PRIMARY KEY (`SoknadID`),
  ADD KEY `ArbeidstakerID` (`ArbeidstakerID`),
  ADD KEY `JobbannonseID` (`JobbannonseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arbeidsgiver`
--
ALTER TABLE `arbeidsgiver`
  MODIFY `ArbeidsgiverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `arbeidstaker`
--
ALTER TABLE `arbeidstaker`
  MODIFY `ArbeidstakerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bruker`
--
ALTER TABLE `bruker`
  MODIFY `BrukerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobbannonse`
--
ALTER TABLE `jobbannonse`
  MODIFY `JobbannonseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `ProfilID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `soknad`
--
ALTER TABLE `soknad`
  MODIFY `SoknadID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `jobbannonse`
--
ALTER TABLE `jobbannonse`
  ADD CONSTRAINT `jobbannonse_ibfk_1` FOREIGN KEY (`ArbeidsgiverID`) REFERENCES `arbeidsgiver` (`ArbeidsgiverID`);

--
-- Begrensninger for tabell `soknad`
--
ALTER TABLE `soknad`
  ADD CONSTRAINT `soknad_ibfk_1` FOREIGN KEY (`ArbeidstakerID`) REFERENCES `arbeidstaker` (`ArbeidstakerID`),
  ADD CONSTRAINT `soknad_ibfk_2` FOREIGN KEY (`JobbannonseID`) REFERENCES `jobbannonse` (`JobbannonseID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
