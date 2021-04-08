-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2021 at 04:02 AM
-- Server version: 8.0.23
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DiscForum`
--

-- --------------------------------------------------------

--
-- Table structure for table `ForumComments`
--

CREATE TABLE `ForumComments` (
  `id` int NOT NULL,
  `postedby_id` int NOT NULL,
  `parentpost_id` int NOT NULL,
  `dateposted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(1000) NOT NULL,
  `score` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `ForumPosts`
--

CREATE TABLE `ForumPosts` (
  `id` int NOT NULL,
  `postedby_id` int NOT NULL,
  `dateposted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `board` varchar(50) NOT NULL,
  `score` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB;

--
-- Dumping data for table `ForumPosts`
--

INSERT INTO `ForumPosts` (`id`, `postedby_id`, `dateposted`, `title`, `picture`, `content`, `board`, `score`) VALUES
(2, 2, '2021-04-02 20:52:46', 'My thoughts on Inception\'s ending', 'images\\movie.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus pariatur incidunt iste inventore sequi tempora at ipsa quia deleniti necessitatibus ad enim illo corrupti esse commodi praesentium sunt, tenetur repudiandae.', 'movies', 0),
(3, 3, '2021-04-03 20:54:30', 'What is the purpose of the James Webb Telescope?', 'images\\jwt.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus pariatur incidunt iste inventore sequi tempora at ipsa quia deleniti necessitatibus ad enim illo corrupti esse commodi praesentium sunt, tenetur repudiandae.', 'astronomy', 0),
(4, 2, '2021-04-04 20:56:33', 'The situation at Barcelona', 'images\\fcb.webp', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus pariatur incidunt iste inventore sequi tempora at ipsa quia deleniti necessitatibus ad enim illo corrupti esse commodi praesentium sunt, tenetur repudiandae.', 'football', 0),
(5, 2, '2021-04-08 03:36:18', 'Hello World', 'images/jwt.jpg', 'Hello World', 'programming', 0),
(9, 3, '2021-04-08 03:46:35', 'A test post with no image', '', 'this is a test post', 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ForumUsers`
--

CREATE TABLE `ForumUsers` (
  `id` int NOT NULL,
  `email` varchar(320) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password_hash` varchar(500) NOT NULL,
  `profile_img` varchar(255) NOT NULL DEFAULT 'images/default_pfp.png',
  `created_on` date NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB;

--
-- Dumping data for table `ForumUsers`
--

INSERT INTO `ForumUsers` (`id`, `email`, `username`, `password_hash`, `profile_img`, `created_on`, `is_admin`, `is_enabled`) VALUES
(2, 'hello@world.com', 'seconduser', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'images/default_pfp.png', '2021-04-04', 0, 1),
(3, 'third@user.com', 'thirduser', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'images/default_pfp.png', '2021-04-04', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ForumComments`
--
ALTER TABLE `ForumComments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parentpost_id` (`parentpost_id`),
  ADD KEY `postedby_id` (`postedby_id`);

--
-- Indexes for table `ForumPosts`
--
ALTER TABLE `ForumPosts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ForumPosts_ibfk_1` (`postedby_id`);

--
-- Indexes for table `ForumUsers`
--
ALTER TABLE `ForumUsers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ForumComments`
--
ALTER TABLE `ForumComments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ForumPosts`
--
ALTER TABLE `ForumPosts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ForumUsers`
--
ALTER TABLE `ForumUsers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ForumComments`
--
ALTER TABLE `ForumComments`
  ADD CONSTRAINT `ForumComments_ibfk_1` FOREIGN KEY (`parentpost_id`) REFERENCES `ForumPosts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ForumComments_ibfk_2` FOREIGN KEY (`postedby_id`) REFERENCES `ForumUsers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ForumPosts`
--
ALTER TABLE `ForumPosts`
  ADD CONSTRAINT `ForumPosts_ibfk_1` FOREIGN KEY (`postedby_id`) REFERENCES `ForumUsers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
