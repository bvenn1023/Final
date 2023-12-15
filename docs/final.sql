-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 12:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(48) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` tinyint(5) NOT NULL,
  `height` smallint(6) NOT NULL,
  `weight` smallint(6) NOT NULL,
  `age` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `email`, `password`, `role`, `height`, `weight`, `age`) VALUES
(20, 'jet', 'black', 'jet@racing.com', '$2y$10$9C5IFQv384rOV.tUyBg.kuIN9ij8ySV73VwBSMx.nGDRudoZZr2me', 0, 36, 70, '2012-06-16'),
(21, 'will', 'cuth', 'will@nku.edu', '$2y$10$XlIjXiY3Hvv0NSsYJ8wRRuBFGY5AbPo.QdxoUZVaq53Ch9TZEiCI.', 1, 74, 230, '2003-07-29'),
(22, 'john', 'lennon', 'john@beatles.com', '$2y$10$KgiMuyKR6aXsw6asL2NyjuG2VjgMmmDQyVxDDXu.Jl09DdVjExddm', 0, 68, 140, '1945-05-21'),
(23, 'paul', 'mccartney', 'paul@beatles.com', '$2y$10$Yl9i7rEtAS8wZOTfMSyWAunYJNcUnrNzSvnoRxi3Ujglc.MIweOWS', 0, 60, 140, '1942-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `workouts`
--

CREATE TABLE `workouts` (
  `ID` int(10) UNSIGNED NOT NULL,
  `user_ID` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `cal_burned` smallint(4) NOT NULL,
  `cal_goal` smallint(4) NOT NULL,
  `time_worked` int(24) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workouts`
--

INSERT INTO `workouts` (`ID`, `user_ID`, `name`, `cal_burned`, `cal_goal`, `time_worked`, `date`, `type`) VALUES
(7, 21, 'swimming', 300, 300, 90, '2023-12-13', 'Cardiovascular'),
(8, 22, 'running', 300, 200, 60, '2023-12-16', 'Cardiovascular'),
(9, 22, 'bench press', 500, 350, 120, '2023-12-16', 'Strength Training'),
(10, 22, 'goat yoga', 100, 100, 60, '2023-12-14', 'Flexibility Training');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `workouts`
--
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `workouts`
--
ALTER TABLE `workouts`
  ADD CONSTRAINT `workouts_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
