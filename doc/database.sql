-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Loomise aeg: Nov 25, 2015 kell 05:27 PL
-- Serveri versioon: 5.6.26
-- PHP versioon: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Andmebaas: `net_bank`
--

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` bigint(20) unsigned NOT NULL,
  `origin_account` bigint(20) NOT NULL,
  `destination_account` bigint(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(255) NOT NULL DEFAULT '""',
  `amount` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Andmete tõmmistamine tabelile `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `origin_account`, `destination_account`, `date`, `description`, `amount`) VALUES
(1, 73647364, 3837823982, '2015-11-25 12:07:57', '"Katse1"', 50),
(2, 3837823982, 6373627236, '2015-11-25 12:07:57', '"Katse2"', 10),
(3, 3837823982, 73647364, '2015-11-25 12:07:57', '"Katse3"', 3);

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) unsigned NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `owner_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `account_number` bigint(20) NOT NULL,
  `amount` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Andmete tõmmistamine tabelile `users`
--

INSERT INTO `users` (`user_id`, `username`, `owner_name`, `password`, `account_number`, `amount`) VALUES
(1, 'demo', 'Demo', 'demo', 73647364, 4000),
(2, 'epood1', 'epood', 'epood', 6373627236, 100),
(3, 'klient1', 'klient1', 'klient1', 3837823982, 30000);

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `transaction`
--
ALTER TABLE `transaction`
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `origin_account` (`origin_account`),
  ADD KEY `destination_account` (`destination_account`);

--
-- Indeksid tabelile `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `account_number` (`account_number`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT tabelile `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Tõmmistatud tabelite piirangud
--

--
-- Piirangud tabelile `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`origin_account`) REFERENCES `users` (`account_number`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`destination_account`) REFERENCES `users` (`account_number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
