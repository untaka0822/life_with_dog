-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017 年 5 月 05 日 07:13
-- サーバのバージョン： 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `life_with_dog`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `areas`
--

CREATE TABLE `areas` (
  `area_id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `areas`
--

INSERT INTO `areas` (`area_id`, `area_name`, `created`) VALUES
(1, '北海道', '0000-00-00 00:00:00'),
(2, '青森', '0000-00-00 00:00:00'),
(3, '岩手', '0000-00-00 00:00:00'),
(4, '宮城', '0000-00-00 00:00:00'),
(5, '秋田', '0000-00-00 00:00:00'),
(6, '山形', '0000-00-00 00:00:00'),
(7, '福島', '0000-00-00 00:00:00'),
(8, '東京', '0000-00-00 00:00:00'),
(9, '茨城', '0000-00-00 00:00:00'),
(10, '神奈川', '0000-00-00 00:00:00'),
(11, '栃木', '0000-00-00 00:00:00'),
(12, '千葉', '0000-00-00 00:00:00'),
(13, '群馬', '0000-00-00 00:00:00'),
(14, '山梨', '0000-00-00 00:00:00'),
(15, '埼玉', '0000-00-00 00:00:00'),
(16, '新潟', '0000-00-00 00:00:00'),
(17, '長野', '0000-00-00 00:00:00'),
(18, '富山', '0000-00-00 00:00:00'),
(19, '石川', '0000-00-00 00:00:00'),
(20, '福井', '0000-00-00 00:00:00'),
(21, '静岡', '0000-00-00 00:00:00'),
(22, '岐阜', '0000-00-00 00:00:00'),
(23, '愛知', '0000-00-00 00:00:00'),
(24, '三重', '0000-00-00 00:00:00'),
(25, '滋賀', '0000-00-00 00:00:00'),
(26, '京都', '0000-00-00 00:00:00'),
(27, '大阪', '0000-00-00 00:00:00'),
(28, '奈良', '0000-00-00 00:00:00'),
(29, '和歌山', '0000-00-00 00:00:00'),
(30, '兵庫', '0000-00-00 00:00:00'),
(31, '鳥取', '0000-00-00 00:00:00'),
(32, '島根', '0000-00-00 00:00:00'),
(33, '岡山', '0000-00-00 00:00:00'),
(34, '広島', '0000-00-00 00:00:00'),
(35, '山口', '0000-00-00 00:00:00'),
(36, '香川', '0000-00-00 00:00:00'),
(37, '愛媛', '0000-00-00 00:00:00'),
(38, '徳島', '0000-00-00 00:00:00'),
(39, '高知', '0000-00-00 00:00:00'),
(40, '福岡', '0000-00-00 00:00:00'),
(41, '佐賀', '0000-00-00 00:00:00'),
(42, '長崎', '0000-00-00 00:00:00'),
(43, '熊本', '0000-00-00 00:00:00'),
(44, '大分', '0000-00-00 00:00:00'),
(45, '宮崎', '0000-00-00 00:00:00'),
(46, '鹿児島', '0000-00-00 00:00:00'),
(47, '沖縄', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `dogs`
--

CREATE TABLE `dogs` (
  `dog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `dog_gender` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size_id` int(11) NOT NULL,
  `fleas` int(11) DEFAULT NULL,
  `vaccin` int(11) DEFAULT NULL,
  `spay_cast` int(11) DEFAULT NULL,
  `character` text,
  `dog_picture_path` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `dogs_size`
--

CREATE TABLE `dogs_size` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `dogs_size`
--

INSERT INTO `dogs_size` (`size_id`, `size_name`, `created`) VALUES
(1, '小型犬', '0000-00-00 00:00:00'),
(2, '中型犬', '0000-00-00 00:00:00'),
(3, '大型犬', '0000-00-00 00:00:00'),
(4, '特大犬', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `follows`
--

CREATE TABLE `follows` (
  `follow_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `following_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `flag` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` int(11) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `postal_code` varchar(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `area_detail` varchar(255) NOT NULL,
  `area_detail2` varchar(255) NOT NULL,
  `picture_path` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `dogs`
--
ALTER TABLE `dogs`
  ADD PRIMARY KEY (`dog_id`);

--
-- Indexes for table `dogs_size`
--
ALTER TABLE `dogs_size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `dogs`
--
ALTER TABLE `dogs`
  MODIFY `dog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `dogs_size`
--
ALTER TABLE `dogs_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
