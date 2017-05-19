-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2017 at 08:15 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

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
-- Table structure for table `tbl_matches`
--

CREATE TABLE `tbl_matches` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id_a` int(10) UNSIGNED NOT NULL,
  `team_id_b` int(10) UNSIGNED NOT NULL,
  `score_team_a` int(10) UNSIGNED DEFAULT '0',
  `score_team_b` int(10) UNSIGNED DEFAULT '0',
  `isPlayed` tinyint(1) DEFAULT '0',
  `matchType` int(1) NOT NULL DEFAULT '0',
  `start_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_matches`
--

INSERT INTO `tbl_matches` (`id`, `team_id_a`, `team_id_b`, `score_team_a`, `score_team_b`, `isPlayed`, `matchType`, `start_time`) VALUES
(306, 10, 12, 0, 0, 0, 0, NULL),
(307, 10, 21, 0, 0, 0, 0, NULL),
(308, 12, 10, 0, 0, 0, 0, NULL),
(309, 12, 21, 0, 0, 0, 0, NULL),
(310, 21, 10, 0, 0, 0, 0, NULL),
(311, 21, 12, 0, 0, 0, 0, NULL),
(312, 13, 14, 0, 0, 0, 0, NULL),
(313, 13, 22, 0, 0, 0, 0, NULL),
(314, 14, 13, 0, 0, 0, 0, NULL),
(315, 14, 22, 0, 0, 0, 0, NULL),
(316, 22, 13, 0, 0, 0, 0, NULL),
(317, 22, 14, 0, 0, 0, 0, NULL),
(318, 15, 16, 0, 0, 0, 0, NULL),
(319, 15, 23, 0, 0, 0, 0, NULL),
(320, 16, 15, 0, 0, 0, 0, NULL),
(321, 16, 23, 0, 0, 0, 0, NULL),
(322, 23, 15, 0, 0, 0, 0, NULL),
(323, 23, 16, 0, 0, 0, 0, NULL),
(324, 19, 20, 0, 0, 0, 0, NULL),
(325, 20, 19, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_players`
--

CREATE TABLE `tbl_players` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `team_id` int(11) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `goals` int(4) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_players`
--

INSERT INTO `tbl_players` (`id`, `student_id`, `team_id`, `first_name`, `last_name`, `goals`, `created_at`, `deleted_at`) VALUES
(22, 'd119999', NULL, 'Lex', 'Lex', 0, '2017-05-17 14:29:56', NULL),
(23, 'appel', 23, 'Alex', 'Krooswijk', 0, '2017-05-18 11:34:49', NULL),
(24, 'd223013', 10, 'frdg', 'nbnjbvh', 0, '2017-05-18 11:45:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poules`
--

CREATE TABLE `tbl_poules` (
  `id` int(11) NOT NULL,
  `naam` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_poules`
--

INSERT INTO `tbl_poules` (`id`, `naam`, `created_at`, `deleted_at`) VALUES
(1, 'Poule A', '2017-05-02 15:33:47', NULL),
(2, 'Poule B', '2017-05-02 15:33:47', NULL),
(3, 'Poule C', '2017-05-02 15:33:47', NULL),
(4, 'Poule D', '2017-05-02 15:33:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scores`
--

CREATE TABLE `tbl_scores` (
  `player_id` int(11) UNSIGNED NOT NULL,
  `match_id` int(10) UNSIGNED NOT NULL,
  `scored_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teams`
--

CREATE TABLE `tbl_teams` (
  `id` int(11) UNSIGNED NOT NULL,
  `poule_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `points` int(3) DEFAULT '0',
  `totalGoals` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_teams`
--

INSERT INTO `tbl_teams` (`id`, `poule_id`, `name`, `points`, `totalGoals`, `created_at`, `deleted_at`) VALUES
(10, 1, 'SexyMe', 0, 0, '2017-05-10 14:37:30', NULL),
(12, 1, '2ohinkfjdsafk', 0, 0, '2017-05-10 15:54:25', NULL),
(13, 2, '3fdsiuajkbf', 0, 0, '2017-05-10 15:54:39', NULL),
(14, 2, '4ohinkfjdsafk', 0, 0, '2017-05-10 15:54:39', NULL),
(15, 3, 'kuyhdkwjn', 0, 0, '2017-05-11 10:12:26', NULL),
(16, 3, 'iwmwklsq', 0, 0, '2017-05-11 10:12:26', NULL),
(19, 4, 'knwjdnknd', 0, 0, '2017-05-11 10:13:27', NULL),
(20, 4, 'trtuu', 0, 0, '2017-05-17 15:16:34', NULL),
(21, 1, 'ygdausgf', 0, 0, '2017-05-17 15:17:53', NULL),
(22, 2, 'Test', 0, 0, '2017-05-17 15:29:36', NULL),
(23, 3, 'Alex & gang', 0, 0, '2017-05-18 11:34:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
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
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `password`, `email`, `adminLevel`, `created_at`, `deleted_at`) VALUES
(2, 'Admin', 'exLrlV0.RIF2Y', 'admin@yahoo.ru', 2, '2017-04-06 13:23:17', NULL),
(3, 'Dion', 'exLrlV0.RIF2Y', 'dionrodie@hotmail.com', 1, '2017-05-01 11:28:21', NULL),
(4, 'Dion', 'exLrlV0.RIF2Y', 'test@yahoo.ru', 3, '2017-05-01 12:22:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_matches`
--
ALTER TABLE `tbl_matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_matches_ibfk_1` (`team_id_a`),
  ADD KEY `tbl_matches_ibfk_2` (`team_id_b`);

--
-- Indexes for table `tbl_players`
--
ALTER TABLE `tbl_players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `tbl_poules`
--
ALTER TABLE `tbl_poules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naam` (`naam`);

--
-- Indexes for table `tbl_scores`
--
ALTER TABLE `tbl_scores`
  ADD KEY `player_id` (`player_id`),
  ADD KEY `tbl_scores_ibfk_2` (`match_id`);

--
-- Indexes for table `tbl_teams`
--
ALTER TABLE `tbl_teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_matches`
--
ALTER TABLE `tbl_matches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;
--
-- AUTO_INCREMENT for table `tbl_players`
--
ALTER TABLE `tbl_players`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tbl_poules`
--
ALTER TABLE `tbl_poules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_teams`
--
ALTER TABLE `tbl_teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_matches`
--
ALTER TABLE `tbl_matches`
  ADD CONSTRAINT `tbl_matches_ibfk_1` FOREIGN KEY (`team_id_a`) REFERENCES `tbl_teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_matches_ibfk_2` FOREIGN KEY (`team_id_b`) REFERENCES `tbl_teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_players`
--
ALTER TABLE `tbl_players`
  ADD CONSTRAINT `tbl_players_team_id` FOREIGN KEY (`team_id`) REFERENCES `tbl_teams` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_scores`
--
ALTER TABLE `tbl_scores`
  ADD CONSTRAINT `tbl_scores_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `tbl_players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_scores_ibfk_2` FOREIGN KEY (`match_id`) REFERENCES `tbl_matches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
