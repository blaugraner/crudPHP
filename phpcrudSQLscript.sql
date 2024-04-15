-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2024 at 10:44 AM
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
-- Database: `phpcrud`
--
CREATE DATABASE phpcrud;
USE phpcrud;
-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`) VALUES
(1, 'ja', '$2y$10$TUBn42wFIZo2/TbrrMWo7.mUJJWwkXEEqK.69moHqtDCZJ03CYyhW'),
(2, 'dzeno', '$2y$10$Tnfp2j4AbuJBf4pS5cjw.OpuDt.tD3Bo40r2FlTSpziq5R735Bjx2'),
(3, 'test', '$2y$10$.yKLsf0BQPShuJZw.f1Kv.moMhi31h6wdPVjvP3WK6z7snoQtFCLG'),
(4, 'user', '$2y$10$I10ErwkALHgRIIzcDYHw1uvhJe5eL3tNpC6DLbJhB6YEdJARj8pOa'),
(5, 'admin', '$2y$10$pxFat0c.UT1KJ05xL.5Kmee6jrZUBDv/kq1g8sBkSszcASgQSbSLy'),
(6, 'testing', '$2y$10$rztVlHKj5GymsHOOKNqeXutQN8bOkVNBEeXV22bUuOw0vMCVJvdKu');

-- --------------------------------------------------------

--
-- Table structure for table `termin`
--

CREATE TABLE `termin` (
  `ID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `termin`
--

INSERT INTO `termin` (`ID`, `userID`, `datum`, `vrijeme`, `opis`) VALUES
(5, 1, '2024-02-15', '00:30:00', 'kontrola'),
(16, 1, '2024-02-25', '14:33:00', 'pregled'),
(17, 6, '2024-02-14', '11:22:00', 'Konsultacije'),
(18, 30, '2024-02-23', '21:01:00', 'pregled');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresa` varchar(255) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `ime`, `prezime`, `email`, `adresa`, `telefon`, `createdAt`, `updated_at`) VALUES
(1, 'Tito', 'Broz', 'josip.broz@example.com', 'Mesna ulica 323', '555-66662333', '2024-01-25 16:22:13', '2024-02-17 20:57:57'),
(3, 'Nikola', 'Nikolić', 'nikola.nikolic@gmail.com', '65 Sunčeva ulica', '555-55551', '2024-01-25 16:22:13', '2024-04-14 22:34:41'),
(4, 'Suljo', 'Sulic', 'meho.mehic@gmail.com', 'Putna ulica 312', '09103901930193', '2024-01-30 23:16:41', NULL),
(6, 'Dzenedin ', 'Peco', 'dzenedinpeco@gmail.com', 'Zlatnih ljiljana 131', '81273891273', '2024-01-30 23:19:18', NULL),
(20, 'test', 'stet', 'tkaldzija@gmail.com', 'wewe', '232344', '2024-02-04 11:10:48', '2024-02-04 11:13:28'),
(24, 'asdas', 'asdasd', 'aS@as.com', 'Mesna ulica 323', '81273891273', '2024-02-05 23:36:23', NULL),
(30, 'Meho', 'Unos', 'dzenedinpeco@gmail.com', '65 Sunčeva ulica', '112133', '2024-02-17 20:58:19', NULL),
(31, 'a', 'a', 'dzenedinpeco@gmail.com', 'a', '1', '2024-04-14 22:34:58', NULL);

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `before_user_insert` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
    SET NEW.updated_at = NULL;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_user_update` BEFORE UPDATE ON `user` FOR EACH ROW BEGIN
    SET NEW.updated_at = NOW();
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termin`
--
ALTER TABLE `termin`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `termin`
--
ALTER TABLE `termin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `termin`
--
ALTER TABLE `termin`
  ADD CONSTRAINT `termin_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
