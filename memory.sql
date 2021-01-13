-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2021 at 10:29 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memory`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `grille` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `time`, `grille`, `datetime`, `id_utilisateur`, `score`) VALUES
(68, '00:00:12', 3, '2021-01-12 03:34:41', 6, 12),
(69, '00:00:13', 3, '2021-01-12 03:42:45', 6, 12),
(70, '00:00:19', 4, '2021-01-12 03:43:37', 6, 16),
(71, '00:00:14', 5, '2021-01-13 07:37:54', 6, 14),
(72, '00:00:08', 3, '2021-01-13 07:42:46', 6, 10),
(73, '00:00:09', 3, '2021-01-13 08:11:33', 6, 10),
(74, '00:00:10', 3, '2021-01-13 08:19:07', 6, 10),
(75, '00:00:20', 3, '2021-01-13 08:34:56', 6, 18),
(76, '00:01:11', 12, '2021-01-13 08:46:07', 6, 90),
(77, '00:02:06', 12, '2021-01-14 09:50:25', 10, 80),
(79, '00:00:34', 12, '2021-01-14 09:50:25', 11, 28),
(80, '00:00:54', 12, '2021-01-10 09:53:23', 12, 87),
(81, '00:00:09', 3, '2021-01-13 09:28:16', 6, 10),
(82, '00:00:08', 3, '2021-01-13 09:40:29', 6, 10),
(83, '00:00:06', 3, '2021-01-13 10:26:44', 38, 8);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `avatar`) VALUES
(5, 'lauriem', '$2y$10$auF84HfbhCPGhiWq5auk6uPTQoHYNoI/0MCUDJjXJeRQE/qKE6Pq.', '1'),
(6, 'moulinl', '$2y$10$ISLPmQmSucaLNDzFIs.hd.zSrWXrGN1DZG047GEPY3CF0r/LnzE3S', '4'),
(9, 'laurie', '$2y$10$EgqIysNHFxpFzh7PcVOAh.gOXJu0YzZeHOe2SkgAqNRPi3Oc5jA7y', '2'),
(10, 'Alicia', '$2y$10$daO/E3uOkWk06.w6dpYGyuyrdYd4YzBxNS3vvczc6sLQvmttGZh7.', '2'),
(11, 'chay', '$2y$10$IZ/aD2HNbC1wYAsBn1TUn.bNW1P71XAhGpM1rC4El6lnFSHvUfRKe', '4'),
(12, 'peter', '$2y$10$bg9rTNvdy8VZMo6xSFrhz.6oi.KU6Fda45I6reWLUNijTBlhGZffu', '1'),
(14, 'may', '$2y$10$larxKsEQ9tBQ0J7YkyTyWu64jqYdLi9mxvvR7j7CrAWu118o4wvBm', '1'),
(15, 'ali', '$2y$10$4tSSxYv7cUl.ErUtmNArmuKd71thf8kE3ZMbnPOP6rI5hbhNAV1hu', '1'),
(16, 'alice', '$2y$10$ZCqTs9...qtPIWLHPvsR0.jEjROUhkCXjxOvSCYrk98Pz5XJ38n5m', '1'),
(27, 'rubb', '$2y$10$BX2JCeepPYZN5jxppHjpYu2nGm92AQaSwBLjN3r3FjrHKcMuc.V16', '3'),
(38, 'Remyreal', '$2y$10$0C6aUWCXW.hQ0v.5yZbLB.YqInDCqA03uljVlBPPaPlr/tTpe4bgq', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
