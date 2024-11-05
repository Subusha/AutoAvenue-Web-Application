-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 15, 2024 at 04:53 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle_sale`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `fuel_type` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `year` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `eng_type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `horsepower` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `seat_count` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image3` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `featured` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `price`, `fuel_type`, `year`, `description`, `eng_type`, `horsepower`, `seat_count`, `color`, `image1`, `image2`, `image3`, `featured`, `user_id`) VALUES
(23, 'shjf', 2123546, 'gasoline', '2022', 'jGvcylURGyvgv', 'V6', '124', '2', 'red', 'uploads/1_1715461307_vehical.png', 'uploads/1_1715461307_interior.jpg', 'uploads/1_1715461307_engine.png', 0, 1),
(25, 'Dulen', 3124, 'electric', '2017', 'fsadwfawd', 'V8', '2000', '3', 'yellow', 'uploads/1_1715767522_vehical.png', 'uploads/1_1715767522_interior.jpg', 'uploads/1_1715767522_engine.jpeg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int NOT NULL,
  `message` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `contact`, `message`) VALUES
(4, 'malith', 'admin@gmail.com', 760528721, 'sertyvubinjihugyttshdfguijou\r\n                '),
(2, 'Malith', 'wenuja@gmail.com', 760528721, 'yooooooooooooooooooooooooooooooooooooooo'),
(6, 'punsara', 'yapapunsara408@gmail.com', 123456789, '\r\n                shjsgslicvbskvbsvs.bjs');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int NOT NULL,
  `message` varchar(5000) NOT NULL,
  `satisfy` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `username`, `email`, `contact`, `message`, `satisfy`) VALUES
(2, 'malith', 'wenuja@gmail.com', 776524356, '\r\n                skefhawilfgwaiefgwirauf', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `rented_details`
--

DROP TABLE IF EXISTS `rented_details`;
CREATE TABLE IF NOT EXISTS `rented_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `vehicalname` varchar(200) NOT NULL,
  `Rent_price` int NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` int NOT NULL,
  `No_of_Days` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rented_details`
--

INSERT INTO `rented_details` (`id`, `username`, `vehicalname`, `Rent_price`, `email`, `contact`, `No_of_Days`, `user_id`) VALUES
(25, 'charithbuddika', 'Audi', 2123546, 'yapapunsara408@gmail.com', 123456789, 3, 7),
(26, 'punsara', 'Lambo', 12000, 'yapapunsara408@gmail.com', 123456789, 5, 7),
(29, 'Shan', 'Audi', 2123546, 'shan@gmail.com', 760528721, 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `rent_cars`
--

DROP TABLE IF EXISTS `rent_cars`;
CREATE TABLE IF NOT EXISTS `rent_cars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` int NOT NULL,
  `seat_count` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `image1` varchar(100) NOT NULL,
  `image2` varchar(100) NOT NULL,
  `fuel_type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rent_cars`
--

INSERT INTO `rent_cars` (`id`, `price`, `seat_count`, `name`, `image1`, `image2`, `fuel_type`, `color`, `user_id`) VALUES
(19, 2123546, 6, 'Audi', 'uploads/1_1715460491_vehical.png', 'uploads/1_1715460491_interior.jpg', 'gasoline', 'red', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `contact`, `role`) VALUES
(1, 'System Admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '0732342349', 0),
(2, 'Malith Jayasekara', 'malith@gmail.com', '25f9e794323b453885f5181f1b624d0b', '0738446457', 1),
(3, 'Pasan Achira', 'pasan@gmail.com', '25f9e794323b453885f5181f1b624d0b', '0742346487', 1),
(4, 'ruwan', 'ruwan@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '0987654321', 1),
(5, 'Subusha', 'subusha@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0760528721', 1),
(6, 'Punsara', 'punsara@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0123456789', 1),
(7, 'punsara', 'yapapunsara408@gmail.com', '202cb962ac59075b964b07152d234b70', '0123456789', 1),
(8, 'Shan', 'shan@gmail.com', '202cb962ac59075b964b07152d234b70', '0760528721', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
