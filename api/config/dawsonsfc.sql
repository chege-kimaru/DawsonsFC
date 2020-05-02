-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2020 at 02:13 AM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dawsonsfc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '3',
  `email` varchar(255) NOT NULL DEFAULT 'admin@gmail.com'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `role`, `email`) VALUES
(3, 'admin', '$2y$10$6IOKRRMEk0a6BTHiC/wtlO.klxZkgW.BxLPfLfOZ2H2.BZnf86ax2', 1, 'admin@gmail.com'),
(4, 'kevin', '$2y$10$4rOby8IeldKtDp3x6aH1TuD5lXsrIFPquf9fgkgRgXrxgvAePFocy', 2, 'kevin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stadium_id` int(11) DEFAULT NULL,
  `coach` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `about` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `name`, `location`, `image`, `stadium_id`, `coach`, `year`, `about`) VALUES
(2, 'Kecha FC', 'Drive', 'api/public/1587392426-kings.png', 7, 'Lincoln', 1999, 'Arsenal was the first club from the South of England to join The Football League, in 1893, and they reached the First Division in 1904. Relegated only once, in 1913, they continue the longest streak in the top division,[3] and have won the second-most top-flight matches in English football history.[4] In the 1930s, Arsenal won five League Championships and two FA Cups, and another FA Cup and two Championships after the war. In 1970–71, they won their first League and FA Cup Double. Between 1989 and 2005, they won five League titles and five FA Cups, including two more Doubles. They completed the 20th century with the highest average league position.[5]'),
(4, 'Dream FC', 'York', 'api/public/1587392382-arsenal.png', 9, 'Krish', 1999, 'Arsenal was the first club from the South of England to join The Football League, in 1893, and they reached the First Division in 1904. Relegated only once, in 1913, they continue the longest streak in the top division,[3] and have won the second-most top-flight matches in English football history.[4] In the 1930s, Arsenal won five League Championships and two FA Cups, and another FA Cup and two Championships after the war. In 1970–71, they won their first League and FA Cup Double. Between 1989 and 2005, they won five League titles and five FA Cups, including two more Doubles. They completed the 20th century with the highest average league position.[5]'),
(5, 'Airtel FC', 'Dragon drive', 'api/public/1587392480-leon.jpg', 8, 'Vallapos', 1990, 'Arsenal was the first club from the South of England to join The Football League, in 1893, and they reached the First Division in 1904. Relegated only once, in 1913, they continue the longest streak in the top division,[3] and have won the second-most top-flight matches in English football history.[4] In the 1930s, Arsenal won five League Championships and two FA Cups, and another FA Cup and two Championships after the war. In 1970–71, they won their first League and FA Cup Double. Between 1989 and 2005, they won five League titles and five FA Cups, including two more Doubles. They completed the 20th century with the highest average league position.[5]'),
(6, 'Colombian Fires', 'Colostra', 'api/public/1587392525-hattievelle.png', 10, 'Kelly Nick', 2005, 'Arsenal was the first club from the South of England to join The Football League, in 1893, and they reached the First Division in 1904. Relegated only once, in 1913, they continue the longest streak in the top division,[3] and have won the second-most top-flight matches in English football history.[4] In the 1930s, Arsenal won five League Championships and two FA Cups, and another FA Cup and two Championships after the war. In 1970–71, they won their first League and FA Cup Double. Between 1989 and 2005, they won five League titles and five FA Cups, including two more Doubles. They completed the 20th century with the highest average league position.[5]'),
(7, 'Brokas', 'Lockey', 'api/public/1587392604-bayern.png', 7, 'Martin N', 2003, 'Arsenal was the first club from the South of England to join The Football League, in 1893, and they reached the First Division in 1904. Relegated only once, in 1913, they continue the longest streak in the top division,[3] and have won the second-most top-flight matches in English football history.[4] In the 1930s, Arsenal won five League Championships and two FA Cups, and another FA Cup and two Championships after the war. In 1970–71, they won their first League and FA Cup Double. Between 1989 and 2005, they won five League titles and five FA Cups, including two more Doubles. They completed the 20th century with the highest average league position.[5]'),
(8, 'Vallon FC', 'Vallap Estate', 'api/public/1587392648-club4.jpg', 5, 'Nickosa Martin', 2009, 'Arsenal was the first club from the South of England to join The Football League, in 1893, and they reached the First Division in 1904. Relegated only once, in 1913, they continue the longest streak in the top division,[3] and have won the second-most top-flight matches in English football history.[4] In the 1930s, Arsenal won five League Championships and two FA Cups, and another FA Cup and two Championships after the war. In 1970–71, they won their first League and FA Cup Double. Between 1989 and 2005, they won five League titles and five FA Cups, including two more Doubles. They completed the 20th century with the highest average league position.[5]'),
(9, 'PaperFC', 'Luthuli', 'api/public/1587392933-eagles.png', 9, 'Kris Eric', 2003, 'Arsenal was the first club from the South of England to join The Football League, in 1893, and they reached the First Division in 1904. Relegated only once, in 1913, they continue the longest streak in the top division,[3] and have won the second-most top-flight matches in English football history.[4] In the 1930s, Arsenal won five League Championships and two FA Cups, and another FA Cup and two Championships after the war. In 1970–71, they won their first League and FA Cup Double. Between 1989 and 2005, they won five League titles and five FA Cups, including two more Doubles. They completed the 20th century with the highest average league position.[5]'),
(10, 'Eightees', 'Nairobi', 'api/public/1587392994-sfc.png', 7, 'Elly Martin', 2003, 'Arsenal was the first club from the South of England to join The Football League, in 1893, and they reached the First Division in 1904. Relegated only once, in 1913, they continue the longest streak in the top division,[3] and have won the second-most top-flight matches in English football history.[4] In the 1930s, Arsenal won five League Championships and two FA Cups, and another FA Cup and two Championships after the war. In 1970–71, they won their first League and FA Cup Double. Between 1989 and 2005, they won five League titles and five FA Cups, including two more Doubles. They completed the 20th century with the highest average league position.[5]'),
(11, 'CET333', 'Nairobi', 'api/public/1587808685-kings.png', 5, 'Dawson', 2019, 'Arsenal was the first club from the South of England to join The Football League, in 1893, and they reached the First Division in 1904. Relegated only once, in 1913, they continue the longest streak in the top division,[3] and have won the second-most top-flight matches in English football history.[4] In the 1930s, Arsenal won five League Championships and two FA Cups, and another FA Cup and two Championships after the war. In 1970–71, they won their first League and FA Cup Double. Between 1989 and 2005, they won five League titles and five FA Cups, including two more Doubles. They completed the 20th century with the highest average league position.[5]');

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `id` int(11) NOT NULL,
  `home_id` int(11) NOT NULL,
  `away_id` int(11) NOT NULL,
  `match_date` datetime NOT NULL,
  `goals_home` int(11) DEFAULT NULL,
  `goals_away` int(11) DEFAULT NULL,
  `match_played` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`id`, `home_id`, `away_id`, `match_date`, `goals_home`, `goals_away`, `match_played`) VALUES
(1, 2, 4, '2020-04-10 09:00:00', 5, 1, 1),
(3, 4, 2, '2020-04-18 09:22:00', 0, 0, 0),
(4, 2, 8, '2020-04-11 09:00:00', 3, 2, 1),
(5, 7, 10, '2020-05-06 09:00:00', 0, 0, 0),
(6, 5, 2, '2020-05-07 09:00:00', 0, 0, 0),
(7, 4, 8, '2020-05-08 09:00:00', 0, 0, 0),
(8, 9, 7, '2020-05-08 09:00:00', 0, 0, 0),
(9, 5, 9, '2020-05-09 09:00:00', 0, 0, 0),
(10, 5, 4, '2020-05-10 14:00:00', 0, 0, 0),
(11, 6, 4, '2020-05-12 09:00:00', 0, 0, 0),
(12, 10, 7, '2020-04-12 15:00:00', 2, 4, 1),
(13, 4, 8, '2020-04-13 09:00:00', 4, 3, 1),
(14, 6, 8, '2020-04-14 09:00:00', 2, 2, 1),
(15, 7, 5, '2020-04-16 09:00:00', 1, 1, 1),
(16, 10, 9, '2020-04-17 12:00:00', 0, 0, 1),
(17, 2, 7, '2020-04-18 09:00:00', 6, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `player_number` int(11) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `club_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `dob`, `image`, `player_number`, `position`, `club_id`) VALUES
(1, 'Kevin Kimaru', '1999-02-02', 'api/public/1587392147-player1.jpg', 3, 'Center Forward', 4),
(2, 'Peris Wangari', '1978-09-09', 'api/public/1587392164-player2.jpg', 5, 'Striker', 4),
(3, 'Roberto Carlos', '1999-03-02', 'api/public/1587392198-player4.jpg', 4, 'Left Forward', 4),
(4, 'Vegas Arturo', '1990-05-02', 'api/public/1587392237-player9.jpg', 6, 'Right Center-Forward', 4);

-- --------------------------------------------------------

--
-- Table structure for table `stadiums`
--

CREATE TABLE `stadiums` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stadiums`
--

INSERT INTO `stadiums` (`id`, `name`, `location`, `image`) VALUES
(5, 'Brokas', 'Kessops', 'api/public/1587392683-stadium1.jpg'),
(7, 'Kranes', 'Kranes', 'api/public/1587392713-stadium2.jpg'),
(8, 'Vacays', 'Vacays', 'api/public/1587392735-stadium3.jpg'),
(9, 'Burgun', 'Burgun', 'api/public/1587392759-stadium4.jpg'),
(10, 'Ellis', 'Ellis', 'api/public/1587392785-stadium5.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stadium_id` (`stadium_id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `home_id` (`home_id`),
  ADD KEY `away_id` (`away_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `stadiums`
--
ALTER TABLE `stadiums`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stadiums`
--
ALTER TABLE `stadiums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `clubs_ibfk_1` FOREIGN KEY (`stadium_id`) REFERENCES `stadiums` (`id`);

--
-- Constraints for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD CONSTRAINT `fixtures_ibfk_1` FOREIGN KEY (`home_id`) REFERENCES `clubs` (`id`),
  ADD CONSTRAINT `fixtures_ibfk_2` FOREIGN KEY (`away_id`) REFERENCES `clubs` (`id`);

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
