-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2021 at 08:48 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminsystems_realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_propery`
--

CREATE TABLE `agent_propery` (
  `agent_property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `state_id`) VALUES
(1, 'Mexicali', 1),
(2, 'Tijuana', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_phone` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country`) VALUES
(1, 'Mexico'),
(2, 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inq_id` int(11) NOT NULL,
  `inq_email` varchar(255) NOT NULL,
  `inq_phone` varchar(255) NOT NULL,
  `property_id` int(11) NOT NULL,
  `inq_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message_email` varchar(255) NOT NULL,
  `message_phone` varchar(255) NOT NULL,
  `message_name` varchar(255) NOT NULL,
  `message_text` text NOT NULL,
  `message_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message_email`, `message_phone`, `message_name`, `message_text`, `message_date`) VALUES
(1, 'jgomez@novaadmin.com', '6862598978', 'Jose Luis', 'Este es un mensaje de bienvenida', '2021-11-10 02:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tipo` int(11) NOT NULL,
  `vor` varchar(2) NOT NULL,
  `street` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `recamaras` int(11) NOT NULL,
  `bathrooms` float NOT NULL,
  `terreno` float NOT NULL,
  `construccion` float NOT NULL,
  `cocina` int(11) NOT NULL,
  `cochera` int(11) NOT NULL,
  `patio` int(1) NOT NULL,
  `alberca` int(1) NOT NULL,
  `precio` double NOT NULL,
  `precio_interno` double NOT NULL,
  `moneda` varchar(15) NOT NULL,
  `imagen_principal` varchar(255) NOT NULL,
  `publicado` int(1) NOT NULL DEFAULT 1,
  `date_created` datetime DEFAULT NULL,
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `name`, `tipo`, `vor`, `street`, `number`, `section`, `country_id`, `state_id`, `city_id`, `description`, `recamaras`, `bathrooms`, `terreno`, `construccion`, `cocina`, `cochera`, `patio`, `alberca`, `precio`, `precio_interno`, `moneda`, `imagen_principal`, `publicado`, `date_created`, `date_update`) VALUES
(10, 'Casa de playa en Rosarito', 1, 'v', 'Del Sol', '3356', 'Villafontana', 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 4, 2, 1020, 352, 1, 1, 1, 1, 2000000, 1800000, 'MXN', 'uploads/property/750646206pexels-alex-1732414.jpg', 1, '2021-10-05 12:02:50', '2021-10-06 23:46:59'),
(11, 'Casa en San Marcos', 1, 'r', 'Hamburgo', '1922', 'Villafontana', 1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2, 2, 1000, 289, 1, 1, 1, 0, 800000, 600000, 'MXN', 'uploads/property/398375265download.jpg', 1, '2021-10-05 12:07:10', '2021-10-06 23:46:59'),
(12, 'Departamento en Calle Novena', 2, 'r', 'Hamburgo', '451', 'Del Mar', 1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 3, 2, 180, 110, 1, 1, 1, 0, 8000, 7000, 'MXN', 'uploads/property/398375265download.jpg', 1, '2021-10-05 14:56:07', '2021-10-06 23:46:59'),
(13, 'Casa en Playas', 1, 't', 'Leon', '712', 'Campestre', 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 3, 2, 585, 236, 1, 1, 1, 0, 5000000, 420000, 'MXN', 'uploads/property/1489809654suburban-house-royalty-free-image-1584972559.jpg', 1, '2021-10-05 14:58:17', '2021-10-06 23:46:59'),
(14, 'Casa en San Pedro', 1, 'v', 'Hamburgo', '75', 'Campestre', 1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 5, 3, 5000, 398, 1, 1, 1, 1, 1000000, 800000, 'USD', 'uploads/property/134816543057d7daff-e586-4a1b-83b3-8d5bf0f8e070.jpg', 1, '2021-10-05 15:45:26', '2021-10-06 23:46:59'),
(15, 'Terreno', 4, 'v', 'De la lluvia', '751', 'San Marcos', 1, 1, 2, '', 0, 0, 1000, 0, 0, 0, 0, 0, 5000000, 4500000, 'MXN', 'uploads/property/554356278backgroundoption1.jpg', 1, '2021-11-08 14:42:55', '2021-11-08 22:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `property_category`
--

CREATE TABLE `property_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_category`
--

INSERT INTO `property_category` (`cat_id`, `cat_name`) VALUES
(1, 'Casa'),
(2, 'Departamento'),
(3, 'Local comercial'),
(4, 'Terreno');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `image_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`image_id`, `property_id`, `image_url`) VALUES
(1, 1, '../../uploads/property/2021-10-04838054325pexels-pixabay-271816.jpg'),
(2, 5, '../../uploads/property/2021-10-041086703255pexels-pixabay-271816.jpg'),
(3, 5, '../../uploads/property/2021-10-042044224699pexels-pixabay-276554.jpg'),
(4, 5, '../../uploads/property/2021-10-041568121892pexels-alex-1732414.jpg'),
(5, 4, '../../uploads/property/2021-10-041001594625pexels-pixabay-271816.jpg'),
(6, 4, '../../uploads/property/2021-10-041117380575pexels-pixabay-276554.jpg'),
(7, 4, '../../uploads/property/2021-10-042087750387pexels-alex-1732414.jpg'),
(8, 4, '../../uploads/property/2021-10-0449292644350078-psychedelic-colorful-turtle-Windows_7.jpg'),
(9, 4, '../../uploads/property/2021-10-0444028759cyberpunk-city-rt-1360x768.jpg'),
(10, 4, '../../uploads/property/2021-10-041938008181pixel-art-andlt-aestheticandgt-town-city-waneella-hd-wallpaper-preview.jpg'),
(11, 9, '../../uploads/property/2021-10-041011531650pexels-pixabay-271816.jpg'),
(12, 9, '../../uploads/property/2021-10-04866617702pexels-pixabay-276554.jpg'),
(13, 9, '../../uploads/property/2021-10-04580370426pexels-alex-1732414.jpg'),
(14, 10, '../../uploads/property/2021-10-05622684694pexels-pixabay-271816.jpg'),
(15, 10, '../../uploads/property/2021-10-05602780938pexels-pixabay-276554.jpg'),
(16, 10, '../../uploads/property/2021-10-051781682779pexels-alex-1732414.jpg'),
(17, 11, '../../uploads/property/2021-10-05113419176House_Calls_Brooklyn_Zames_Williams_living_room_2_Matthew_Williams.jpg'),
(18, 11, '../../uploads/property/2021-10-05197346757957d7daff-e586-4a1b-83b3-8d5bf0f8e070.jpg'),
(19, 12, '../../uploads/property/2021-10-0533278234557d7daff-e586-4a1b-83b3-8d5bf0f8e070.jpg'),
(20, 12, '../../uploads/property/2021-10-051378569831House_Calls_Brooklyn_Zames_Williams_living_room_2_Matthew_Williams.jpg'),
(21, 13, '../../uploads/property/2021-10-051652329859Duplex-House-Design-Living-Room-1024x683.jpg'),
(22, 13, '../../uploads/property/2021-10-051664308951House_Calls_Brooklyn_Zames_Williams_living_room_2_Matthew_Williams.jpg'),
(23, 13, '../../uploads/property/2021-10-051052946161download (1).jpg'),
(24, 14, '../../uploads/property/2021-10-05488989128download (2).jpg'),
(25, 14, '../../uploads/property/2021-10-051554264119download (1).jpg'),
(26, 15, '../../uploads/property/2021-11-082141695633alseide.jpg'),
(27, 15, '../../uploads/property/2021-11-08793497579backgroundoption1.jpg'),
(28, 15, '../../uploads/property/2021-11-08129245144250843160_417672936481595_2460804586907574464_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `prospects`
--

CREATE TABLE `prospects` (
  `prospect_id` int(11) NOT NULL,
  `prospect_name` varchar(255) NOT NULL,
  `prospect_email` varchar(255) NOT NULL,
  `prospect_phone` varchar(255) NOT NULL,
  `prospect_inquiry` varchar(255) NOT NULL,
  `property_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`, `country_id`) VALUES
(1, 'Baja California', 1),
(2, 'California', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `user_level` varchar(1) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '0 Cant add users or add machines or lines\r\n\r\n1 Can add machines lines\r\n\r\n2 Can add users machines and lines\r\n',
  `user_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A administration-views everything\r\n\r\nS support-views only their issues issue type\r\n\r\nO operations-views only their plants/area issues',
  `user_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_firstname`, `user_lastname`, `user_number`, `user_phone`, `user_level`, `user_type`, `user_image`) VALUES
(21, 'jgomez', '$2y$10$Tk2QRPsVheQX4bXtASMCJ.GBwPu8QWE8WIyhlIx4SDxCqL50.CyfW', 'jgomez@martechmedical.com', 'Jose Luis', 'Gomez Cecena', '1', '686-279-4314 ', '2', 'a', 'uploads/users/149507994profile.jpg'),
(172, 'Flor', '$2y$10$4Y5DVIj/xN40euz1xWGkFuMDCS1l.DxlCYdv8UQMSGXAjCXzYyq7.', 'flor@email.com', 'Flor Andrea', 'Saenz', '1', '686-512-1212 ', '0', 'v', 'uploads/users/251226547perm.png'),
(173, 'julian', '$2y$10$bijV7rvTWYcARDpk8rjX5ewu2ET6fAZcaZtiN7gNcXvi7iFtb1RQ6', 'jmoreno@adminsystems.mx', 'Julian', 'Moreno', '1', '686-992-1512 ', '2', 's', 'uploads/default/noimage.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_propery`
--
ALTER TABLE `agent_propery`
  ADD PRIMARY KEY (`agent_property_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`inq_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_category`
--
ALTER TABLE `property_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `prospects`
--
ALTER TABLE `prospects`
  ADD PRIMARY KEY (`prospect_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_propery`
--
ALTER TABLE `agent_propery`
  MODIFY `agent_property_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `property_category`
--
ALTER TABLE `property_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `prospects`
--
ALTER TABLE `prospects`
  MODIFY `prospect_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=174;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
