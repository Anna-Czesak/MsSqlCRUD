-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Maj 2021, 23:35
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklep`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `dostepnosc_produkty` (IN `min_dostepnosc` INT(11))  BEGIN SELECT * FROM produkty WHERE dostepnosc < min_dostepnosc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ustaw_cene` (IN `nowa_cena` FLOAT, `id_p` INT(11))  BEGIN
UPDATE produkty SET cena=nowa_cena WHERE id=id_p; END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresy`
--

CREATE TABLE `adresy` (
  `id` int(11) NOT NULL,
  `ulica` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `dom_lokal` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `miasto` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `adresy`
--

INSERT INTO `adresy` (`id`, `ulica`, `dom_lokal`, `miasto`) VALUES
(0, 'Zielona', '13a/6', 'Kraków'),
(1, 'Komorowskiego', '13', 'Kraków'),
(2, 'Powstańców', '44/9', 'Kraków'),
(3, 'Zwyciestwa', '15', 'Kraków');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie_ubran`
--

CREATE TABLE `kategorie_ubran` (
  `id` int(11) NOT NULL,
  `kategoria` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kategorie_ubran`
--

INSERT INTO `kategorie_ubran` (`id`, `kategoria`) VALUES
(0, 'spodnie'),
(1, 'bluzka'),
(2, 'bielizna'),
(3, 'sukienka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id` int(11) NOT NULL,
  `imie` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nr_telefonu` int(11) NOT NULL,
  `mail` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `id_adresu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id`, `imie`, `nazwisko`, `nr_telefonu`, `mail`, `id_adresu`) VALUES
(0, 'Alicja', 'Nowak', 123456789, 'nowak@wp.pl', 0),
(1, 'Jan', 'Kowalski', 321432543, 'kowal@wp.pl', 1),
(2, 'Anna', 'Kusnierz', 987435678, 'ank@onet.pl', 2),
(3, 'Mateusz', 'Fąk', 124907544, 'fak@gmail.com', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nowa_kolekcja_produktów`
--

CREATE TABLE `nowa_kolekcja_produktów` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `cena` float NOT NULL,
  `kolor` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `rozmiar` varchar(5) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `id_kategorii` int(11) NOT NULL,
  `dostepnosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `nowa_kolekcja_produktów`
--

INSERT INTO `nowa_kolekcja_produktów` (`id`, `nazwa`, `cena`, `kolor`, `rozmiar`, `id_kategorii`, `dostepnosc`) VALUES
(1, 'spodnie', 50, 'zielony ', 'M', 0, 2),
(2, 'skarpetki', 12, 'niebieski', 'XS', 2, 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `cena` float NOT NULL,
  `kolor` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `rozmiar` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  `id_kategorii` int(11) NOT NULL,
  `dostepnosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `kolor`, `rozmiar`, `id_kategorii`, `dostepnosc`) VALUES
(0, 'mom jeans', 30, 'niebieski', 'M', 0, 5),
(1, 'sukienka', 60, 'niebieski', 'S', 3, 3),
(2, 'skarpetki', 19, 'różowy', 'S', 2, 8);

--
-- Wyzwalacze `produkty`
--
DELIMITER $$
CREATE TRIGGER `aktualizacja_produktu` AFTER UPDATE ON `produkty` FOR EACH ROW BEGIN INSERT INTO produkty_zmiany(ID, data_zmiany, polecenie, poprzednia_ilosc, nowa_ilosc) VALUES (NEW.ID, CURDATE(),'UPDATE', OLD.dostepnosc, NEW.dostepnosc);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty_zmiany`
--

CREATE TABLE `produkty_zmiany` (
  `ID` int(11) NOT NULL,
  `data_zmiany` date NOT NULL,
  `polecenie` varchar(20) NOT NULL,
  `poprzednia_ilosc` int(11) NOT NULL,
  `nowa_ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty_zmiany`
--

INSERT INTO `produkty_zmiany` (`ID`, `data_zmiany`, `polecenie`, `poprzednia_ilosc`, `nowa_ilosc`) VALUES
(0, '2021-05-19', 'UPDATE', 5, 5),
(1, '2021-05-17', 'UPDATE', 4, 4),
(2, '2021-05-17', 'UPDATE', 7, 6),
(3, '2021-05-18', 'UPDATE', 5, 5),
(4, '2021-05-18', 'UPDATE', 5, 5),
(5, '2021-05-18', 'UPDATE', 5, 5),
(6, '2021-05-18', 'UPDATE', 5, 5),
(7, '2021-05-18', 'UPDATE', 5, 5),
(8, '2021-05-18', 'UPDATE', 5, 5),
(9, '2021-05-19', 'UPDATE', 5, 5),
(10, '2021-05-19', 'UPDATE', 5, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `widok_produkt_cena`
--

CREATE TABLE `widok_produkt_cena` (
  `nazwa` varchar(30) DEFAULT NULL,
  `cena` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `id_klienta`, `id_produktu`, `ilosc`) VALUES
(1, 1, 0, 1),
(4, 2, 0, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adresy`
--
ALTER TABLE `adresy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kategorie_ubran`
--
ALTER TABLE `kategorie_ubran`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adresu` (`id_adresu`);

--
-- Indeksy dla tabeli `nowa_kolekcja_produktów`
--
ALTER TABLE `nowa_kolekcja_produktów`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategorii` (`id_kategorii`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategorii` (`id_kategorii`);

--
-- Indeksy dla tabeli `produkty_zmiany`
--
ALTER TABLE `produkty_zmiany`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klienta` (`id_klienta`),
  ADD KEY `id_produktu` (`id_produktu`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `produkty_zmiany`
--
ALTER TABLE `produkty_zmiany`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `adresy`
--
ALTER TABLE `adresy`
  ADD CONSTRAINT `adresy_ibfk_1` FOREIGN KEY (`id`) REFERENCES `klienci` (`id_adresu`);

--
-- Ograniczenia dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD CONSTRAINT `klienci_ibfk_1` FOREIGN KEY (`id_adresu`) REFERENCES `adresy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `produkty_ibfk_1` FOREIGN KEY (`id_kategorii`) REFERENCES `kategorie_ubran` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`id_klienta`) REFERENCES `klienci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `zamowienia_ibfk_2` FOREIGN KEY (`id_produktu`) REFERENCES `produkty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
