-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2016 at 09:57 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockz`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
  `code` varchar(4) NOT NULL DEFAULT '',
  `name` varchar(32) DEFAULT NULL,
  `category` varchar(1) DEFAULT NULL,
  `value` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`code`, `name`, `category`, `value`) VALUES
('APPL', 'Apple', 'A', 100),
('BOND', 'Bonds', 'B', 66),
('BP', 'Believable Products', 'C', 100),
('COFF', 'Coffee', 'C', 100),
('DHS', 'Donut Hole Syndicate', 'C', 100),
('DSC', 'Deathstar Construction', 'C', 100),
('EBD', 'Environmental Bio Diversity', 'C', 100),
('FBN', 'Fly-by-Night Business Network', 'C', 100),
('GMC', 'General Motors', 'A', 100),
('GOLD', 'Gold', 'B', 110),
('GOOG', 'Google', 'A', 100),
('GRAN', 'Grain', 'B', 113),
('HD', 'Harley Davidson', 'A', 100),
('IBM', 'IBM', 'A', 100),
('IND', 'Industrial', 'B', 39),
('IXP', 'Inter-planetary Exploration Project', 'C', 100),
('MLM', 'Moonlight madness', 'C', 100),
('MSFT', 'Microsoft', 'A', 100),
('OIL', 'Oil', 'B', 52),
('PONZ', 'Ponzi Schemes R Us', 'C', 100),
('RUN', 'Rich Uncle', 'C', 100),
('SFA', 'Star Fleet Academy', 'C', 100),
('SMV', 'Smoke & Mirrors Ventures', 'C', 100),
('SSO', 'Sleezy Snake Oil Sales', 'C', 100),
('TECH', 'Technology', 'B', 37),
('TEL', 'Telus', 'A', 100);

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE IF NOT EXISTS `certificates` (
  `token` varchar(8) NOT NULL,
  `stock` varchar(4) NOT NULL,
  `agent` varchar(4) NOT NULL,
  `player` varchar(64) NOT NULL,
  `amount` int(11) NOT NULL,
  `datetime` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`token`, `stock`, `agent`, `player`, `amount`, `datetime`) VALUES
('0', 'GOLD', 'g01', 'Jim', 10, ''),
('17b5c', 'GOLD', 'g01', 'Jim', 10, ''),
('1cff5', 'GOLD', 'g01', 'Jim', 10, ''),
('37f5c', 'GOLD', 'g01', 'Jim', 10, ''),
('83651', 'GOLD', 'g01', 'Jim', 10, ''),
('96cab', 'GOLD', 'g01', 'Jim', 10, ''),
('ABCD1234', 'GOLD', '', 'Mickey', 100, '2016.02.29-09:01:00'),
('d16d4', 'GOLD', 'g01', 'Jim', 1000, '');

-- --------------------------------------------------------

--
-- Table structure for table `movement`
--

CREATE TABLE IF NOT EXISTS `movement` (
  `seq` int(11) NOT NULL,
  `datetime` varchar(19) DEFAULT NULL,
  `code` varchar(4) DEFAULT NULL,
  `action` varchar(4) DEFAULT NULL,
  `amount` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movement`
--

INSERT INTO `movement` (`seq`, `datetime`, `code`, `action`, `amount`) VALUES
(1, '2016.02.01-09:01:00', 'BOND', 'down', 5),
(2, '2016.02.01-09:01:02', 'IND', 'div', 5),
(3, '2016.02.01-09:01:04', 'OIL', 'down', 10),
(4, '2016.02.01-09:01:06', 'GOLD', 'div', 5),
(5, '2016.02.01-09:01:08', 'BOND', 'up', 20),
(6, '2016.02.01-09:01:10', 'GOLD', 'div', 5),
(7, '2016.02.01-09:01:12', 'GOLD', 'down', 20),
(8, '2016.02.01-09:01:14', 'IND', 'div', 10),
(9, '2016.02.01-09:01:16', 'OIL', 'up', 20),
(10, '2016.02.01-09:01:18', 'BOND', 'down', 5),
(11, '2016.02.01-09:01:20', 'BOND', 'up', 5),
(12, '2016.02.01-09:01:22', 'BOND', 'div', 20),
(13, '2016.02.01-09:01:24', 'BOND', 'div', 20),
(14, '2016.02.01-09:01:26', 'GOLD', 'div', 20),
(15, '2016.02.01-09:01:28', 'IND', 'up', 20),
(16, '2016.02.01-09:01:30', 'OIL', 'down', 20),
(17, '2016.02.01-09:01:32', 'GRAN', 'down', 20),
(18, '2016.02.01-09:01:34', 'BOND', 'up', 5),
(19, '2016.02.01-09:01:36', 'GOLD', 'down', 20),
(20, '2016.02.01-09:01:38', 'GOLD', 'down', 20),
(21, '2016.02.01-09:01:40', 'TECH', 'down', 20),
(22, '2016.02.01-09:01:42', 'TECH', 'up', 5),
(23, '2016.02.01-09:01:44', 'OIL', 'up', 20),
(24, '2016.02.01-09:01:46', 'BOND', 'up', 5),
(25, '2016.02.01-09:01:48', 'GOLD', 'div', 10),
(26, '2016.02.01-09:01:50', 'GOLD', 'down', 5),
(27, '2016.02.01-09:01:52', 'GOLD', 'up', 20),
(28, '2016.02.01-09:01:54', 'IND', 'down', 10),
(29, '2016.02.01-09:01:56', 'GOLD', 'div', 20);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `seq` int(11) NOT NULL,
  `agent` varchar(4) NOT NULL,
  `player` varchar(32) NOT NULL,
  `cash` int(11) NOT NULL,
  `round` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`seq`, `agent`, `player`, `cash`, `round`) VALUES
(1, '', 'Donald', 3000, 0),
(2, '', 'George', 2000, 0),
(3, '', 'Henry', 2500, 0),
(4, '', 'Mickey', 1000, 0),
(5, 'g01', 'Jim', -116000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` varchar(16) NOT NULL,
  `value` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `value`) VALUES
('next_event', '0'),
('potd', 'tuesday'),
('round', '1'),
('startcash', '5000'),
('state', '0');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `code` varchar(4) NOT NULL DEFAULT '',
  `name` varchar(10) DEFAULT NULL,
  `category` varchar(1) DEFAULT NULL,
  `value` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`code`, `name`, `category`, `value`) VALUES
('BOND', 'Bonds', 'B', 66),
('GOLD', 'Gold', 'B', 110),
('GRAN', 'Grain', 'B', 113),
('IND', 'Industrial', 'B', 39),
('OIL', 'Oil', 'B', 52),
('TECH', 'Tech', 'B', 37);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `seq` int(11) NOT NULL,
  `datetime` varchar(19) DEFAULT NULL,
  `agent` varchar(4) NOT NULL,
  `player` varchar(6) DEFAULT NULL,
  `stock` varchar(4) DEFAULT NULL,
  `trans` varchar(4) DEFAULT NULL,
  `quantity` int(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`seq`, `datetime`, `agent`, `player`, `stock`, `trans`, `quantity`) VALUES
(1, '2016.02.01-09:01:00', '', 'Donald', 'BOND', 'buy', 100),
(2, '2016.02.01-09:01:05', '', 'Donald', 'TECH', 'sell', 1000),
(3, '2016.02.01-09:01:10', '', 'Henry', 'TECH', 'sell', 1000),
(4, '2016.02.01-09:01:15', '', 'Donald', 'IND', 'sell', 1000),
(5, '2016.02.01-09:01:20', '', 'George', 'GOLD', 'sell', 100),
(6, '2016.02.01-09:01:25', '', 'George', 'OIL', 'buy', 500),
(7, '2016.02.01-09:01:30', '', 'Henry', 'GOLD', 'sell', 100),
(8, '2016.02.01-09:01:35', '', 'Henry', 'GOLD', 'buy', 1000),
(9, '2016.02.01-09:01:40', '', 'Donald', 'TECH', 'buy', 100),
(10, '2016.02.01-09:01:45', '', 'Donald', 'OIL', 'sell', 100),
(11, '2016.02.01-09:01:50', '', 'Donald', 'TECH', 'sell', 100),
(12, '2016.02.01-09:01:55', '', 'George', 'OIL', 'buy', 100),
(13, '2016.02.01-09:01:60', '', 'George', 'IND', 'buy', 100),
(14, '0', 'g01', 'Jim', 'GOLD', 'buy', 10),
(15, '2016-04-05T22:17:30', 'g01', 'Jim', 'GOLD', 'buy', 10),
(16, '2016-04-05T22:19:02', 'g01', 'Jim', 'GOLD', 'buy', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `code` varchar(4) NOT NULL,
  `name` varchar(64) NOT NULL,
  `role` varchar(8) NOT NULL,
  `password` varchar(128) NOT NULL,
  `last_round` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`code`, `name`, `role`, `password`, `last_round`) VALUES
('g01', 'jjj', 'agent', 'ac433a91fb5dee15c8df1ad7d39f8f73', 1),
('jlp', 'James', 'boss', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `movement`
--
ALTER TABLE `movement`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movement`
--
ALTER TABLE `movement`
  MODIFY `seq` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `seq` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `seq` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
