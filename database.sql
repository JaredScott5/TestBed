-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2017 at 01:17 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(5) NOT NULL AUTO_INCREMENT,
  `itemName` varchar(255) NOT NULL,
  `department` text NOT NULL,
  `price` double NOT NULL,
  `image` varchar(2083) DEFAULT NULL,
  `description` varchar(2083) DEFAULT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `itemName` (`itemName`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `itemName`, `department`, `price`, `image`, `description`, `dateAdded`) VALUES
(1, 'Overwatch', 'Video_Game', 39.99, 'img/overwatch_logo.jpg', 'FPS PC video game.', '2017-01-24 01:05:23'),
(2, 'Bastion', 'Video_Game', 29.99, 'img/bastion_logo.png', 'Top down PC video game.', '2017-01-24 01:05:23'),
(3, 'Dark Souls 3', 'Video_Game', 39.99, 'img/smallds3.jpg', 'Dark Souls 3 on PS4, Xbox One, and PC', '2017-01-24 01:05:23'),
(4, 'Fire Emblem: Awakening', 'Video_Game', 39.99, 'img/tiny.jpg', 'Tactical and Turn-based JRPG', '2017-01-24 01:05:23'),
(5, 'animeDVD', 'Movies/TV', 5, 'img/tiny.jpg', 'this is to be filed under ''Movies/TV'' genre', '2017-01-25 00:50:40'),
(6, 'Adventure Time: Season 7', 'Movies/TV', 49.99, 'img/overwatch_logo.jpg', 'to be filed under ''Movies/TV'' genre', '2017-01-25 00:51:32'),
(7, 'Traitor: A Star Wars Tale', 'Books', 8.99, 'img/tiny.jpg', 'to be filed under ''Books''', '2017-01-25 00:52:09'),
(8, 'My First (raspberri)Pi', 'Books', 27.99, 'img/smallds3.jpg', 'to be filed under ''Books''', '2017-01-25 00:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE IF NOT EXISTS `orderdetails` (
  `orderNumber` int(11) NOT NULL,
  `item_id` int(5) NOT NULL,
  `quantityOrdered` int(11) NOT NULL,
  PRIMARY KEY (`orderNumber`,`item_id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderNumber` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `orderDate` datetime NOT NULL,
  `shippedDate` datetime DEFAULT NULL,
  `total` decimal(65,2) DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `comments` text,
  PRIMARY KEY (`orderNumber`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_flag` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;



/*USE dbtest;

 Build tables 

DROP TABLE IF EXISTS orderDetails;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS items;
  
CREATE TABLE IF NOT EXISTS users (
  user_id int(5) NOT NULL AUTO_INCREMENT,
  username varchar(25) NOT NULL,
  email varchar(35) NOT NULL,
  password varchar(255) NOT NULL,
  admin_flag boolean DEFAULT FALSE,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=INNODB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE orders (
  orderNumber INTEGER NOT NULL AUTO_INCREMENT,
  user_id int(5) NOT NULL,
  orderDate DATETIME NOT NULL,
  shippedDate DATETIME NULL,
  total DECIMAL(65,2) NULL,
  status VARCHAR(15) NOT NULL,
  comments TEXT NULL,
  FOREIGN KEY (user_id)
    REFERENCES users (user_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
  PRIMARY KEY (orderNumber)
) AUTO_INCREMENT=1 ;

CREATE TABLE items (
  item_id INT(5) NOT NULL AUTO_INCREMENT,
  itemName VARCHAR(255) NOT NULL,
  price DOUBLE NOT NULL,
  image VARCHAR(2083) NULL,
  description VARCHAR(2083) NULL,
  dateAdded CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (item_id),
  UNIQUE KEY itemName (itemName)
) AUTO_INCREMENT=1 ;

CREATE TABLE orderDetails (
  orderNumber INTEGER NOT NULL,s
  item_id INT(5) NOT NULL,
  quantityOrdered INTEGER NOT NULL,
  FOREIGN KEY (orderNumber)
    REFERENCES orders (orderNumber)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
  FOREIGN KEY (item_id)
    REFERENCES items (item_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
  PRIMARY KEY (orderNumber, item_id)
);

 Insert test values 

INSERT INTO items VALUES (1, 'Overwatch', 39.99, 'imgs/overwatch_logo.jpg', 'FPS PC video game.');
INSERT INTO items VALUES (2, 'Bastion', 29.99, 'imgs/bastion_logo.png', 'Top down PC video game.');

INSERT INTO orders VALUES(44, 1, '1990-09-19 19:57:06', '1990-09-20 19:57:06', 309.91, 'Delivered', NULL);
INSERT INTO orderDetails VALUES(44, 1, 4);
INSERT INTO orderDetails VALUES(44, 2, 5);
)

 Test queries 

SELECT orderDetails.orderNumber, SUM(items.price*orderDetails.quantityOrdered) FROM items JOIN orderDetails USING (item_id) GROUP BY orderNumber;

SELECT a.user_id, b.orderNumber, c.itemName
FROM orders AS a
JOIN orderDetails AS b USING (orderNumber)
JOIN items AS c USING (item_id);
*/