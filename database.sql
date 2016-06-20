USE dbtest;

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS users;
  
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
  
DROP TABLE IF EXISTS orders;

CREATE TABLE orders (
  orderNumber INTEGER NOT NULL AUTO_INCREMENT,
  user_id int(5) NOT NULL,
  orderDate DATETIME NOT NULL,
  shippedDate DATETIME NULL,
  status VARCHAR(15) NOT NULL,
  comments TEXT NULL,
  FOREIGN KEY (user_id)
    REFERENCES users (user_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
  PRIMARY KEY (orderNumber)
) AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS items;

CREATE TABLE items (
  item_id INT(5) NOT NULL AUTO_INCREMENT,
  itemName VARCHAR(255) NOT NULL,
  price DOUBLE NOT NULL,
  image VARCHAR(2083) NULL,
  description VARCHAR(2083) NULL,
  PRIMARY KEY (item_id),
  UNIQUE KEY itemName (itemName)
) AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS orderDetails;

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

INSERT INTO users VALUES (1, 'JeremyCrook', 'jac13b@my.fsu.edu', 'secretpassword');
INSERT INTO items VALUES (1, 'Overwatch', 39.99, 'http://example.com/images/Overwatch', 'FPS PC video game.');
INSERT INTO items VALUES (2, 'Bastion', 39.99, 'http://example.com/images/Bastion', 'Top down PC video game.');
INSERT INTO orders VALUES (1, 1, '2016-05-23T14:25:10', '2016-05-28T12:00:10', 'On Time', NULL);
INSERT INTO orderDetails VALUES (1, 1, 2);
INSERT INTO orderDetails VALUES (1, 2, 1);

SET FOREIGN_KEY_CHECKS=1;

SELECT orderDetails.orderNumber, SUM(items.price*orderDetails.quantityOrdered) FROM items JOIN orderDetails USING (item_id) GROUP BY orderNumber;