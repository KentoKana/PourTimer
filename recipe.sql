-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2019 at 06:06 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pour_over_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `recipe_id` int(11) NOT NULL,
  `recipe_name` varchar(50) NOT NULL,
  `water_temp` int(11) NOT NULL,
  `bean_amt` int(11) NOT NULL,
  `grind_setting` varchar(40) NOT NULL,
  `total_water_amt` int(11) NOT NULL,
  `pour_points_water_amt` mediumtext,
  `pour_points_time` mediumtext,
  `notes` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`recipe_id`, `recipe_name`, `water_temp`, `bean_amt`, `grind_setting`, `total_water_amt`, `pour_points_water_amt`, `pour_points_time`, `notes`) VALUES
(1, 'test', 10, 10, 'coarse', 10, 'testtest', 'testtesttest', 'this is a test not'),
(2, 'Test2', 93, 20, 'Turkish Coffee (Extra-Fine)', 300, '30, 30', '30, 30', 'Test Note'),
(4, 'Test3', 93, 20, 'Filter (Medium)', 300, '00:00, 00:45', '00:00, 00:45', 'This is a note&#13;&#10;'),
(6, 'yo', 0, 0, '-1', 0, '', 'py', 'yp'),
(8, 'Test recipe name', 93, 20, 'Filter (Medium)', 300, '', '00:00, 00:30', ''),
(10, 'Hello', 0, 0, 'Espresso (Fine)', 30, '50, 300', '00:00, 00:45', ''),
(12, 'Hello', 0, 0, 'French Press (Coarse)', 30, '50, 120, 180, 240, 300', '00:00, 00:45, 01:30, 02:15, 03:00', 'Final Brew time should be around 3:30'),
(21, '4:6', 90, 20, 'Filter (Medium)', 300, '50, 120, 180, 240, 300', '00:00, 00:45, 01:30, 2:15, 3:00', 'Brew time is around 3:30.'),
(22, 'Bows X Arrows', 92, 20, 'Filter (Medium)', 300, '50, 300', '00:00, 00:30', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
