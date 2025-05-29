-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Maj 2025, 11:53
-- Wersja serwera: 10.4.20-MariaDB
-- Wersja PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `szkola_jazdy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `auta`
--

CREATE TABLE `auta` (
  `Nr_Rej` varchar(20) NOT NULL,
  `Przebieg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `egzaminy_probne`
--

CREATE TABLE `egzaminy_probne` (
  `ID_Egzaminu` int(11) NOT NULL,
  `ID_Kursanta` int(11) DEFAULT NULL,
  `ID_Instruktora` int(11) DEFAULT NULL,
  `ID_Auto` varchar(20) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `Wynik` varchar(20) DEFAULT NULL,
  `Typ` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `instruktorzy`
--

CREATE TABLE `instruktorzy` (
  `ID_Instruktora` int(11) NOT NULL,
  `Imie` varchar(50) NOT NULL,
  `Nazwisko` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `instruktorzy`
--

INSERT INTO `instruktorzy` (`ID_Instruktora`, `Imie`, `Nazwisko`) VALUES
(1, 'Jan', 'Kowalski'),
(2, 'Anna', 'Nowak'),
(3, 'Piotr', 'Wiśniewski'),
(4, 'Katarzyna', 'Zielińska'),
(5, 'Marek', 'Jankowski');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jazdy`
--

CREATE TABLE `jazdy` (
  `ID_Jazdy` int(11) NOT NULL,
  `ID_Kursanta` int(11) DEFAULT NULL,
  `ID_Instruktora` int(11) DEFAULT NULL,
  `ID_Auta` varchar(20) DEFAULT NULL,
  `Data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kursanci`
--

CREATE TABLE `kursanci` (
  `ID_Kursanta` int(11) NOT NULL,
  `Imie` varchar(50) NOT NULL,
  `Nazwisko` varchar(50) NOT NULL,
  `ID_Instruktora` int(11) DEFAULT NULL,
  `Kategoria` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kursanci`
--

INSERT INTO `kursanci` (`ID_Kursanta`, `Imie`, `Nazwisko`, `ID_Instruktora`, `Kategoria`) VALUES
(4, 'asdasd', 'sadasd', NULL, NULL),
(5, 'sadas', 'dhgh', NULL, NULL),
(6, 'asdasd', 'sadasd', NULL, NULL),
(7, 'dadada', 'ssss', 3, NULL),
(8, 'arek', 'nowak', 4, NULL),
(9, 'essa', 'skibidi', 1, NULL),
(10, 'mamamaamamam', 'kakakakakaka', NULL, 'C');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekcje_teoretyczne`
--

CREATE TABLE `lekcje_teoretyczne` (
  `ID_Lekcji` int(11) NOT NULL,
  `ID_Instruktora` int(11) DEFAULT NULL,
  `Sala` varchar(20) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `Godzina` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `lekcje_teoretyczne`
--

INSERT INTO `lekcje_teoretyczne` (`ID_Lekcji`, `ID_Instruktora`, `Sala`, `Data`, `Godzina`) VALUES
(1, NULL, 'Sala 101', '2025-04-15', '10:00:00'),
(2, NULL, 'Sala 102', '2025-04-16', '12:00:00'),
(3, NULL, 'Sala 103', '2025-04-17', '14:00:00'),
(4, NULL, 'Sala 104', '2025-04-18', '16:00:00'),
(5, NULL, 'Sala 105', '2025-04-19', '09:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekcje_teoretyczne_dane`
--

CREATE TABLE `lekcje_teoretyczne_dane` (
  `ID_Lekcji` int(11) NOT NULL,
  `ID_Kursanta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `auta`
--
ALTER TABLE `auta`
  ADD PRIMARY KEY (`Nr_Rej`);

--
-- Indeksy dla tabeli `egzaminy_probne`
--
ALTER TABLE `egzaminy_probne`
  ADD PRIMARY KEY (`ID_Egzaminu`),
  ADD KEY `ID_Kursanta` (`ID_Kursanta`),
  ADD KEY `ID_Instruktora` (`ID_Instruktora`),
  ADD KEY `ID_Auto` (`ID_Auto`);

--
-- Indeksy dla tabeli `instruktorzy`
--
ALTER TABLE `instruktorzy`
  ADD PRIMARY KEY (`ID_Instruktora`);

--
-- Indeksy dla tabeli `jazdy`
--
ALTER TABLE `jazdy`
  ADD PRIMARY KEY (`ID_Jazdy`),
  ADD KEY `ID_Kursanta` (`ID_Kursanta`),
  ADD KEY `ID_Instruktora` (`ID_Instruktora`),
  ADD KEY `ID_Auta` (`ID_Auta`);

--
-- Indeksy dla tabeli `kursanci`
--
ALTER TABLE `kursanci`
  ADD PRIMARY KEY (`ID_Kursanta`),
  ADD KEY `fk_instruktor_kursant` (`ID_Instruktora`);

--
-- Indeksy dla tabeli `lekcje_teoretyczne`
--
ALTER TABLE `lekcje_teoretyczne`
  ADD PRIMARY KEY (`ID_Lekcji`),
  ADD KEY `ID_Instruktora` (`ID_Instruktora`);

--
-- Indeksy dla tabeli `lekcje_teoretyczne_dane`
--
ALTER TABLE `lekcje_teoretyczne_dane`
  ADD PRIMARY KEY (`ID_Lekcji`,`ID_Kursanta`),
  ADD KEY `ID_Kursanta` (`ID_Kursanta`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `egzaminy_probne`
--
ALTER TABLE `egzaminy_probne`
  MODIFY `ID_Egzaminu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `instruktorzy`
--
ALTER TABLE `instruktorzy`
  MODIFY `ID_Instruktora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `jazdy`
--
ALTER TABLE `jazdy`
  MODIFY `ID_Jazdy` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `kursanci`
--
ALTER TABLE `kursanci`
  MODIFY `ID_Kursanta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `lekcje_teoretyczne`
--
ALTER TABLE `lekcje_teoretyczne`
  MODIFY `ID_Lekcji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `egzaminy_probne`
--
ALTER TABLE `egzaminy_probne`
  ADD CONSTRAINT `egzaminy_probne_ibfk_1` FOREIGN KEY (`ID_Kursanta`) REFERENCES `kursanci` (`ID_Kursanta`),
  ADD CONSTRAINT `egzaminy_probne_ibfk_2` FOREIGN KEY (`ID_Instruktora`) REFERENCES `instruktorzy` (`ID_Instruktora`),
  ADD CONSTRAINT `egzaminy_probne_ibfk_3` FOREIGN KEY (`ID_Auto`) REFERENCES `auta` (`Nr_Rej`);

--
-- Ograniczenia dla tabeli `jazdy`
--
ALTER TABLE `jazdy`
  ADD CONSTRAINT `jazdy_ibfk_1` FOREIGN KEY (`ID_Kursanta`) REFERENCES `kursanci` (`ID_Kursanta`),
  ADD CONSTRAINT `jazdy_ibfk_2` FOREIGN KEY (`ID_Instruktora`) REFERENCES `instruktorzy` (`ID_Instruktora`),
  ADD CONSTRAINT `jazdy_ibfk_3` FOREIGN KEY (`ID_Auta`) REFERENCES `auta` (`Nr_Rej`);

--
-- Ograniczenia dla tabeli `kursanci`
--
ALTER TABLE `kursanci`
  ADD CONSTRAINT `fk_instruktor_kursant` FOREIGN KEY (`ID_Instruktora`) REFERENCES `instruktorzy` (`ID_Instruktora`);

--
-- Ograniczenia dla tabeli `lekcje_teoretyczne`
--
ALTER TABLE `lekcje_teoretyczne`
  ADD CONSTRAINT `lekcje_teoretyczne_ibfk_1` FOREIGN KEY (`ID_Instruktora`) REFERENCES `instruktorzy` (`ID_Instruktora`);

--
-- Ograniczenia dla tabeli `lekcje_teoretyczne_dane`
--
ALTER TABLE `lekcje_teoretyczne_dane`
  ADD CONSTRAINT `lekcje_teoretyczne_dane_ibfk_1` FOREIGN KEY (`ID_Lekcji`) REFERENCES `lekcje_teoretyczne` (`ID_Lekcji`),
  ADD CONSTRAINT `lekcje_teoretyczne_dane_ibfk_2` FOREIGN KEY (`ID_Kursanta`) REFERENCES `kursanci` (`ID_Kursanta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
