USE dbtest;

/* Build tables */

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

INSERT INTO items VALUES (1, 'Overwatch', 39.99, 'http://example.com/images/Overwatch', 'FPS PC video game.');
INSERT INTO items VALUES (2, 'Bastion', 29.99, 'http://example.com/images/Bastion', 'Top down PC video game.');

/* Test queries */

SELECT orderDetails.orderNumber, SUM(items.price*orderDetails.quantityOrdered) FROM items JOIN orderDetails USING (item_id) GROUP BY orderNumber;

SELECT a.user_id, b.orderNumber, c.itemName
FROM orders AS a
JOIN orderDetails AS b USING (orderNumber)
JOIN items AS c USING (item_id);