-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2017 at 01:04 PM
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
(198, 2, 9, 1, 0, 1, 0, NULL),
(199, 2, 14, 1, 0, 1, 0, NULL),
(201, 9, 2, 1, 0, 1, 0, NULL),
(202, 9, 14, 1, 0, 1, 0, NULL),
(204, 14, 2, 1, 0, 1, 0, NULL),
(205, 14, 9, 1, 0, 1, 0, NULL),
(206, 3, 4, 1, 0, 1, 0, NULL),
(207, 3, 10, 1, 0, 1, 0, NULL),
(208, 3, 15, 1, 0, 1, 0, NULL),
(209, 4, 3, 1, 0, 1, 0, NULL),
(210, 4, 10, 1, 0, 1, 0, NULL),
(211, 4, 15, 1, 0, 1, 0, NULL),
(212, 10, 3, 1, 0, 1, 0, NULL),
(213, 10, 4, 1, 0, 1, 0, NULL),
(214, 10, 15, 1, 0, 1, 0, NULL),
(215, 15, 3, 1, 0, 1, 0, NULL),
(216, 15, 4, 1, 0, 1, 0, NULL),
(217, 15, 10, 1, 0, 1, 0, NULL),
(218, 5, 6, 1, 0, 1, 0, NULL),
(219, 5, 12, 1, 0, 1, 0, NULL),
(220, 5, 16, 1, 0, 1, 0, NULL),
(221, 6, 5, 1, 0, 1, 0, NULL),
(222, 6, 12, 1, 0, 1, 0, NULL),
(223, 6, 16, 1, 0, 1, 0, NULL),
(224, 12, 5, 1, 0, 1, 0, NULL),
(225, 12, 6, 1, 0, 1, 0, NULL),
(226, 12, 16, 1, 0, 1, 0, NULL),
(227, 16, 5, 1, 0, 1, 0, NULL),
(228, 16, 6, 1, 0, 1, 0, NULL),
(229, 16, 12, 1, 0, 1, 0, NULL),
(230, 7, 8, 1, 0, 1, 0, NULL),
(231, 7, 13, 1, 0, 1, 0, NULL),
(232, 7, 19, 1, 0, 1, 0, NULL),
(233, 8, 7, 1, 0, 1, 0, NULL),
(234, 8, 13, 1, 0, 1, 0, NULL),
(235, 8, 19, 1, 0, 1, 0, NULL),
(236, 13, 7, 1, 0, 1, 0, NULL),
(237, 13, 8, 1, 0, 1, 0, NULL),
(238, 13, 19, 1, 0, 1, 0, NULL),
(239, 19, 7, 1, 0, 1, 0, NULL),
(240, 19, 8, 1, 0, 1, 0, NULL),
(241, 19, 13, 1, 0, 1, 0, NULL),
(243, 3, 4, 0, 0, 0, 1, NULL),
(244, 6, 5, 0, 0, 0, 1, NULL),
(245, 7, 8, 0, 0, 0, 1, NULL);

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
(22, 'd119999', NULL, 'Lex', 'Lex', 0, '2017-05-17 14:29:56', NULL);

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_teams`
--

INSERT INTO `tbl_teams` (`id`, `poule_id`, `name`, `points`, `created_at`, `deleted_at`) VALUES
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
(4, 'Dion', 'exLrlV0.RIF2Y', 'test@yahoo.ru', 1, '2017-05-01 12:22:22', NULL);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `tbl_players`
--
ALTER TABLE `tbl_players`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbl_poules`
--
ALTER TABLE `tbl_poules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_teams`
--
ALTER TABLE `tbl_teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
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
