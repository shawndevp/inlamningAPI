#### Installation

DROP DATABASE IF EXISTS apidb; CREATE DATABASE apidb;

DROP TABLE IF EXISTS cart; DROP TABLE IF EXISTS sessions; DROP TABLE IF EXISTS products; DROP TABLE IF EXISTS users;

CREATE TABLE `cart` (
  `productId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `orderdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` text NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `token` text NOT NULL,
  `login_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE `cart`
  ADD PRIMARY KEY (`productId`,`userId`),
  ADD KEY `FKusersId` (`userId`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;


ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;



ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `cart`
  ADD CONSTRAINT `FKproductsId` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FKusersId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;


#### How to use

- Begin by installing the database with the SQL code above. 
- Register and login to recieve your token.
- Updating products can be done whenever without thinking about the token. The token that is valid is only needed to get all products from the database. 
- To be able to add, delete or update products from the cart. You will need a valid token.
- The tokens expiring time is on 1 hour (60 minutes). It can be prolonged while you are active on the site. Otherwise You will need to make a new token when not being active on the site for atleast 60 minutes. 


#### Usage of endpoints

Register User: 
http://localhost/inlamningAPI/v1/users/createUser.php?username=(username)&password=(password)&email=(email)


Login user:
http://localhost/inlamningAPI/v1/users/login.php?username=(username)&password=(password)


Create products:
http://localhost/inlamningAPI/v1/products/addProducts.php