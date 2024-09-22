
-- SQL Script for Coffee Shop Database

CREATE DATABASE IF NOT EXISTS coffee_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE coffee_shop;

-- Creating 'users' table
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creating 'products' table
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creating 'cart' table
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'in_cart',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data for 'users' table
INSERT INTO `users` (`username`, `password`, `email`) VALUES 
('shehan', '$2y$10$QQEp/Eos434GJhAwBhmAfOUQN35Jkg8QnKOGKtM.n4DVVXubIs7j6', 'shehan@gmail.com'),
('Rashmika', '$2y$10$h6t7mFWIsoXh0.aot2TdjuijaWmzwGjBwg.7TxNqaL9ZFZpU5JyAa', 'rashmika@gmail.com'),
('pamodya', '$2y$10$CY2FCMtJYxiJWqYw5T7h7uqZ3Bf3FFOAyC/3BwWy.HVLw7dJMoXZm', 'pamo@gmail.com');

-- Sample data for 'products' table
INSERT INTO `products` (`name`, `description`, `price`, `image`) VALUES 
('Espresso', 'A concentrated shot of pure coffee, offering a deep and intense flavor experience.', 520.00, 'img/espresso.png'),
('Latte', 'A popular coffee drink made with espresso and steamed milk.', 750.00, 'img/latte.jpg'),
('Cappuccino', 'A perfect balance of espresso, steamed milk, and a thick layer of frothy milk foam.', 650.00, 'img/Cappuccino.jpg'),
('Americano', 'A classic coffee made by diluting a shot of espresso with hot water.', 570.00, 'img/Americano Coffee.jpg'),
('Flat White', 'A velvety blend of espresso and steamed milk.', 680.00, 'img/flat white.jpg'),
('Cortado', 'An equal blend of espresso and warm milk.', 600.00, 'img/Cortado Coffee.jpg'),
('Cold Brew', 'Coffee brewed slowly with cold water.', 350.00, 'img/Iced Coffee.jpg'),
('Iced Coffee', 'Freshly brewed coffee served over ice.', 500.00, 'img/Cold Brew.jpg');

-- Sample data for 'cart' table
INSERT INTO `cart` (`user_id`, `product_id`, `quantity`, `status`) VALUES 
(1, 2, 1, 'in_cart'),
(1, 2, 1, 'in_cart'),
(1, 1, 1, 'in_cart');
