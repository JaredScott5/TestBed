USE dbtest;

/* Build tables */

DROP TABLE IF EXISTS orderDetails;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS users;

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
  `department` text NOT NULL,
  price DOUBLE NOT NULL,
  image VARCHAR(2083) NULL,
  description VARCHAR(2083) NULL,
  dateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (item_id),
  UNIQUE KEY itemName (itemName)
) AUTO_INCREMENT=1 ;

CREATE TABLE orderDetails (
  orderNumber INTEGER NOT NULL,
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

/* Insert test values */

INSERT INTO `items` (`item_id`, `itemName`, `department`, `price`, `image`, `description`, `dateAdded`) VALUES
(1, 'Overwatch', 'Video_Game', 39.99, 'img/overwatch_logo.jpg', 'FPS PC video game.', '2017-01-24 01:05:23'),
(2, 'Bastion', 'Video_Game', 29.99, 'img/bastion_logo.png', 'Top down PC video game.', '2017-01-24 01:05:23'),
(3, 'Dark Souls 3', 'Video_Game', 39.99, 'img/smallds3.jpg', 'Dark Souls 3 on PS4, Xbox One, and PC', '2017-01-24 01:05:23'),
(4, 'Fire Emblem: Awakening', 'Video_Game', 39.99, 'img/tiny.jpg', 'Tactical and Turn-based JRPG', '2017-01-24 01:05:23'),
(5, 'animeDVD', 'Movies/TV', 5, 'img/tiny.jpg', 'this is to be filed under ''Movies/TV'' genre', '2017-01-25 00:50:40'),
(6, 'Adventure Time: Season 7', 'Movies/TV', 49.99, 'img/overwatch_logo.jpg', 'to be filed under ''Movies/TV'' genre', '2017-01-25 00:51:32'),
(7, 'Traitor: A Star Wars Tale', 'Books', 8.99, 'img/tiny.jpg', 'to be filed under ''Books''', '2017-01-25 00:52:09'),
(8, 'My First (raspberri)Pi', 'Books', 27.99, 'img/smallds3.jpg', 'to be filed under ''Books''', '2017-01-25 00:52:49');


/* Test queries */
