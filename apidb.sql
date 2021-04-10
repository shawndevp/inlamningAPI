-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 10 apr 2021 kl 17:54
-- Serverversion: 10.4.17-MariaDB
-- PHP-version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `apidb`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `cart`
--

CREATE TABLE `cart` (
  `productId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `orderdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `cart`
--

INSERT INTO `cart` (`productId`, `userId`, `token`, `quantity`, `orderdate`) VALUES
(9, 5, 'a0954dd306044cc485fb718868f70099', 1, '2021-04-09');

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` text NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`) VALUES
(9, 'shawn', 'hej', '100', 'kalle'),
(12, 'korv', 'storkorv', '200', 'kött'),
(30, 'korv', 'storkorv', '200', 'köttaaa'),
(31, 'korv', 'storkorv', '200', 'köttaaaar');

-- --------------------------------------------------------

--
-- Tabellstruktur `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `token` text NOT NULL,
  `login_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `session`
--

INSERT INTO `session` (`id`, `userId`, `token`, `login_time`) VALUES
(79, 7, 'e112af7fda7b53c6f1ebdfc48148f10c', 1616748681),
(80, 7, '175216efabe8db768a8e42ed24cdd72d', 1616748979),
(81, 7, '45e19f7fed4eac7a451a47739e348853', 1616763477),
(82, 7, '06508004167c36cce660a149cd02f114', 1617005322),
(83, 7, 'fb13af3b07850e902fad4ce316c96a26', 1617967416),
(84, 5, 'a0954dd306044cc485fb718868f70099', 1617969534),
(85, 5, 'df995a4128740314011878262dc0046f', 1617973309),
(86, 7, 'ab9bfa03aea9dfb73579a10819056265', 1617976950),
(87, 5, 'ae2dbd3b4b7539c3cb119b398c7f5b55', 1618066974);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(5, 'stefan', 'hej123', 'email@email.se'),
(6, 'kalle', '123', 'email@email.com'),
(7, 'shawn', 'test', 'email@.se'),
(8, 'shaa', 'tete', 'email@.com'),
(9, 'test', 'test', 'test');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`productId`,`userId`),
  ADD KEY `FKusersId` (`userId`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT för tabell `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FKproductsId` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FKusersId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
