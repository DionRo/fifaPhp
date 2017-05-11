-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 mei 2017 om 10:47
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_fifa`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_matches`
--

CREATE TABLE `tbl_matches` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id_a` int(10) UNSIGNED NOT NULL,
  `team_id_b` int(10) UNSIGNED NOT NULL,
  `score_team_a` int(10) UNSIGNED DEFAULT '0',
  `score_team_b` int(10) UNSIGNED DEFAULT '0',
  `isPlayed` tinyint(1) DEFAULT '0',
  `start_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_matches`
--

INSERT INTO `tbl_matches` (`id`, `team_id_a`, `team_id_b`, `score_team_a`, `score_team_b`, `isPlayed`, `start_time`) VALUES
(1, 1, 2, 0, 0, 0, NULL),
(2, 1, 9, 0, 0, 0, NULL),
(3, 1, 14, 0, 0, 0, NULL),
(4, 2, 1, 0, 0, 0, NULL),
(5, 2, 9, 0, 0, 0, NULL),
(6, 2, 14, 0, 0, 0, NULL),
(7, 9, 1, 0, 0, 0, NULL),
(8, 9, 2, 0, 0, 0, NULL),
(9, 9, 14, 0, 0, 0, NULL),
(10, 14, 1, 0, 0, 0, NULL),
(11, 14, 2, 0, 0, 0, NULL),
(12, 14, 9, 0, 0, 0, NULL),
(13, 3, 4, 0, 0, 0, NULL),
(14, 3, 10, 0, 0, 0, NULL),
(15, 3, 15, 0, 0, 0, NULL),
(16, 4, 3, 0, 0, 0, NULL),
(17, 4, 10, 0, 0, 0, NULL),
(18, 4, 15, 0, 0, 0, NULL),
(19, 10, 3, 0, 0, 0, NULL),
(20, 10, 4, 0, 0, 0, NULL),
(21, 10, 15, 0, 0, 0, NULL),
(22, 15, 3, 0, 0, 0, NULL),
(23, 15, 4, 0, 0, 0, NULL),
(24, 15, 10, 0, 0, 0, NULL),
(25, 5, 6, 0, 0, 0, NULL),
(26, 5, 12, 0, 0, 0, NULL),
(27, 5, 16, 0, 0, 0, NULL),
(28, 6, 5, 0, 0, 0, NULL),
(29, 6, 12, 0, 0, 0, NULL),
(30, 6, 16, 0, 0, 0, NULL),
(31, 12, 5, 0, 0, 0, NULL),
(32, 12, 6, 0, 0, 0, NULL),
(33, 12, 16, 0, 0, 0, NULL),
(34, 16, 5, 0, 0, 0, NULL),
(35, 16, 6, 0, 0, 0, NULL),
(36, 16, 12, 0, 0, 0, NULL),
(37, 7, 8, 0, 0, 0, NULL),
(38, 7, 13, 0, 0, 0, NULL),
(39, 7, 19, 0, 0, 0, NULL),
(40, 8, 7, 0, 0, 0, NULL),
(41, 8, 13, 0, 0, 0, NULL),
(42, 8, 19, 0, 0, 0, NULL),
(43, 13, 7, 0, 0, 0, NULL),
(44, 13, 8, 0, 0, 0, NULL),
(45, 13, 19, 0, 0, 0, NULL),
(46, 19, 7, 0, 0, 0, NULL),
(47, 19, 8, 0, 0, 0, NULL),
(48, 19, 13, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_players`
--

CREATE TABLE `tbl_players` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `team_id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `goals` int(4) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_players`
--

INSERT INTO `tbl_players` (`id`, `student_id`, `team_id`, `first_name`, `last_name`, `goals`, `created_at`, `deleted_at`) VALUES
(1, 'd123456', 1, 'Lasse', 'Schone', 0, '2017-04-13 09:44:13', NULL),
(2, 'd5435435', 1, 'Davy ', 'Klaassen', 0, '2017-04-13 09:44:13', NULL),
(3, 'd545454', 1, 'Hakim ', 'Ziyech', 0, '2017-04-13 09:45:47', NULL),
(4, 'd666555', 1, 'Kasper', 'Dolberg', 0, '2017-04-13 09:45:47', NULL),
(5, 'd74745', 2, 'Luuk', 'de Jong', 0, '2017-04-13 09:48:23', NULL),
(6, 'd987665', 2, 'Siem', 'de Jong', 0, '2017-04-13 09:48:23', NULL),
(7, 'd11555', 2, 'Jeroen', 'Zoet', 0, '2017-04-13 09:48:23', NULL),
(8, 'd544566', 2, 'Hector', 'Moreno', 0, '2017-04-13 09:48:23', NULL),
(11, 'D223013', 3, 'Lex', 'Krooswijk', 0, '2017-04-21 10:03:58', NULL),
(12, 'D223013', 3, 'Dion', 'Rodie', 0, '2017-04-21 10:04:50', NULL),
(13, 'D223013', 3, 'kutay', 'Yal', 0, '2017-04-21 10:05:14', NULL),
(14, 'D223013', 3, 'Tim', 'Verhijen', 0, '2017-04-21 10:05:46', NULL),
(15, 'D223013', 4, 'Youri', 'van der Sande', 0, '2017-04-21 10:29:36', NULL),
(16, 'D223013', 1, 'Test', 'Rodie', 0, '2017-04-21 11:38:59', NULL),
(17, 'D223013', 1, 'Test2', 'test', 0, '2017-04-21 11:42:03', NULL),
(18, 'D223013', 5, 'Test3', 'Test3', 0, '2017-04-21 11:44:22', NULL),
(19, 'D223013', 1, 'Test4', 'Rodie', 0, '2017-04-21 12:15:27', NULL),
(20, 'D223013', 4, 'Test', 'test10', 0, '2017-05-01 14:40:45', NULL),
(21, 'D223013', 6, 'Lexxieee', 'Elton', 0, '2017-05-01 15:08:26', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_poules`
--

CREATE TABLE `tbl_poules` (
  `id` int(11) NOT NULL,
  `naam` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_poules`
--

INSERT INTO `tbl_poules` (`id`, `naam`, `created_at`, `deleted_at`) VALUES
(1, 'Poule A', '2017-05-02 15:33:47', NULL),
(2, 'Poule B', '2017-05-02 15:33:47', NULL),
(3, 'Poule C', '2017-05-02 15:33:47', NULL),
(4, 'Poule D', '2017-05-02 15:33:47', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_teams`
--

CREATE TABLE `tbl_teams` (
  `id` int(11) UNSIGNED NOT NULL,
  `poule_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `points` int(3) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_teams`
--

INSERT INTO `tbl_teams` (`id`, `poule_id`, `name`, `points`, `created_at`, `deleted_at`) VALUES
(1, 1, 'Ajax', 6, '2017-04-13 09:42:45', NULL),
(2, 1, 'PSV', 6, '2017-04-13 09:42:45', NULL),
(3, 2, 'Test', 3, '2017-04-20 16:05:01', NULL),
(4, 2, 'Real-Madrid', 3, '2017-04-20 16:11:12', NULL),
(5, 3, 'LeXXor', 3, '2017-04-21 08:47:53', NULL),
(6, 3, 'LeXXoRR', 8, '2017-05-01 15:05:37', NULL),
(7, 4, 'Dionnie', 6, '2017-05-01 15:53:39', NULL),
(8, 4, 'Hondjes', 4, '2017-05-03 14:14:24', NULL),
(9, 1, 'Annie', 0, '2017-05-04 15:23:48', NULL),
(10, 2, 'SexyMe', 0, '2017-05-10 14:37:30', NULL),
(12, 3, '2ohinkfjdsafk', 0, '2017-05-10 15:54:25', NULL),
(13, 4, '3fdsiuajkbf', 0, '2017-05-10 15:54:39', NULL),
(14, 1, '4ohinkfjdsafk', 0, '2017-05-10 15:54:39', NULL),
(15, 2, 'kuyhdkwjn', 0, '2017-05-11 10:12:26', NULL),
(16, 3, 'iwmwklsq', 0, '2017-05-11 10:12:26', NULL),
(19, 4, 'knwjdnknd', 0, '2017-05-11 10:13:27', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adminLevel` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `password`, `email`, `adminLevel`, `created_at`, `deleted_at`) VALUES
(2, 'Admin', 'exLrlV0.RIF2Y', 'admin@yahoo.ru', 2, '2017-04-06 13:23:17', NULL),
(3, 'Dion', 'exLrlV0.RIF2Y', 'dionrodie@hotmail.com', 1, '2017-05-01 11:28:21', NULL),
(4, 'Dion', 'exLrlV0.RIF2Y', 'test@yahoo.ru', 1, '2017-05-01 12:22:22', NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tbl_matches`
--
ALTER TABLE `tbl_matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_matches_ibfk_1` (`team_id_a`),
  ADD KEY `tbl_matches_ibfk_2` (`team_id_b`);

--
-- Indexen voor tabel `tbl_players`
--
ALTER TABLE `tbl_players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexen voor tabel `tbl_poules`
--
ALTER TABLE `tbl_poules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naam` (`naam`);

--
-- Indexen voor tabel `tbl_teams`
--
ALTER TABLE `tbl_teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexen voor tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tbl_matches`
--
ALTER TABLE `tbl_matches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT voor een tabel `tbl_players`
--
ALTER TABLE `tbl_players`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT voor een tabel `tbl_poules`
--
ALTER TABLE `tbl_poules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `tbl_teams`
--
ALTER TABLE `tbl_teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT voor een tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `tbl_matches`
--
ALTER TABLE `tbl_matches`
  ADD CONSTRAINT `tbl_matches_ibfk_1` FOREIGN KEY (`team_id_a`) REFERENCES `tbl_teams` (`id`),
  ADD CONSTRAINT `tbl_matches_ibfk_2` FOREIGN KEY (`team_id_b`) REFERENCES `tbl_teams` (`id`);

--
-- Beperkingen voor tabel `tbl_players`
--
ALTER TABLE `tbl_players`
  ADD CONSTRAINT `tbl_players_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `tbl_teams` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
