-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 20. 11 2020 kl. 09:46:39
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogsite`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `decoration` varchar(50) NOT NULL,
  `text` varchar(500) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `blogs_has_categories`
--

CREATE TABLE `blogs_has_categories` (
  `id` int(11) NOT NULL,
  `blogId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Adventure'),
(2, 'Art'),
(3, 'Baby'),
(4, 'Beauty'),
(5, 'Business'),
(6, 'Craft'),
(7, 'Decorating'),
(8, 'Design'),
(9, 'DIY'),
(10, 'Education'),
(11, 'Entertainment'),
(12, 'Fashion'),
(13, 'Film'),
(14, 'Fitness'),
(15, 'Food'),
(16, 'Gaming'),
(17, 'Health'),
(18, 'Home decor'),
(19, 'Humor'),
(20, 'Lifestyle'),
(21, 'Makeup'),
(22, 'Marketing'),
(23, 'Men’s fashion'),
(24, 'Mom'),
(25, 'Money saving'),
(26, 'Music'),
(27, 'Outdoor'),
(28, 'Parenting'),
(29, 'Personal finance'),
(30, 'Pet'),
(31, 'Photography'),
(32, 'Political'),
(33, 'Relationships'),
(34, 'Self-help'),
(35, 'Sewing'),
(36, 'Sports'),
(37, 'Tech'),
(38, 'Travel'),
(39, 'Wedding');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `email`) VALUES
(1, 'nool', 'nool', 'asd');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`,`user_id`),
  ADD KEY `username` (`user_id`);

--
-- Indeks for tabel `blogs_has_categories`
--
ALTER TABLE `blogs_has_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogId` (`blogId`,`categoryId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indeks for tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks for tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Tilføj AUTO_INCREMENT i tabel `blogs_has_categories`
--
ALTER TABLE `blogs_has_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Tilføj AUTO_INCREMENT i tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Tilføj AUTO_INCREMENT i tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tilføj AUTO_INCREMENT i tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrænsninger for tabel `blogs_has_categories`
--
ALTER TABLE `blogs_has_categories`
  ADD CONSTRAINT `blogs_has_categories_ibfk_1` FOREIGN KEY (`blogId`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blogs_has_categories_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`);

--
-- Begrænsninger for tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
