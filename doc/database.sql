-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2015 at 10:01 
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `net_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `banklinks`
--

CREATE TABLE IF NOT EXISTS `banklinks` (
  `banklink` varchar(128) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(160) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `token` varchar(50) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `confirm_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` bigint(20) unsigned NOT NULL,
  `origin_account` bigint(20) NOT NULL,
  `destination_account` bigint(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(255) NOT NULL DEFAULT '""',
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `origin_account`, `destination_account`, `date`, `description`, `amount`) VALUES
  (1, 73647364, 3837823982, '2015-11-25 12:07:57', '"Katse1"', '50.00'),
  (2, 3837823982, 6373627236, '2015-11-25 12:07:57', '"Katse2"', '10.00'),
  (3, 3837823982, 73647364, '2015-11-25 12:07:57', '"Katse3"', '3.00'),
  (4, 3837823982, 73647364, '2015-11-25 12:07:57', '"Katse3"', '3.00');

--
-- Triggers `transaction`
--
DELIMITER $$
CREATE TRIGGER `update_amount_on_payment` AFTER INSERT ON `transaction`
FOR EACH ROW BEGIN
  UPDATE users SET amount = amount - NEW.amount WHERE account_number = NEW.origin_account;
  UPDATE users SET amount = amount + NEW.amount WHERE account_number = NEW.destination_account;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) unsigned NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `owner_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `account_number` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `owner_name`, `password`, `account_number`, `amount`) VALUES
  (1, 'demo', 'Demo', 'demo', 73647364, '4003.00'),
  (2, 'epood1', 'epood', 'epood', 6373627236, '100.00'),
  (3, 'klient1', 'klient1', 'klient1', 3837823982, '29997.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banklinks`
--
ALTER TABLE `banklinks`
ADD PRIMARY KEY (`banklink`),
ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
ADD PRIMARY KEY (`token`),
ADD KEY `tokens_user_id` (`user_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
ADD UNIQUE KEY `transaction_id` (`transaction_id`),
ADD KEY `origin_account` (`origin_account`),
ADD KEY `destination_account` (`destination_account`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`user_id`),
ADD UNIQUE KEY `user_id` (`user_id`),
ADD UNIQUE KEY `account_number` (`account_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
MODIFY `transaction_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `banklinks`
--
ALTER TABLE `banklinks`
ADD CONSTRAINT `banklinks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`origin_account`) REFERENCES `users` (`account_number`),
ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`destination_account`) REFERENCES `users` (`account_number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
