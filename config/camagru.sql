-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 25, 2019 at 12:01 PM
-- Server version: 5.6.43
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_user` int(11) NOT NULL,
  `comment_txt` text NOT NULL,
  `comment_img` int(11) NOT NULL,
  `comment_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_user`, `comment_txt`, `comment_img`, `comment_time`) VALUES
(147, 130, 'Super !', 84, '2019-05-18 10:32:18'),
(148, 130, 'Trop cool !', 85, '2019-05-18 10:32:44'),
(149, 130, 'Ça pete srx', 84, '2019-05-18 10:34:12'),
(151, 130, 'Ça vole bien', 89, '2019-05-18 10:34:37'),
(157, 119, 'Sympa le chat', 88, '2019-05-18 11:01:35'),
(158, 119, 'Meow', 88, '2019-05-18 11:03:01'),
(159, 119, 'Wow', 88, '2019-05-18 11:03:34'),
(160, 119, 'lol', 88, '2019-05-18 11:04:27'),
(168, 119, 'J\'adore', 89, '2019-05-18 11:09:37'),
(169, 119, 'C\'est vrai', 89, '2019-05-18 11:09:59'),
(170, 119, 'Je te jure !', 89, '2019-05-18 11:10:25'),
(171, 119, 'ahah', 89, '2019-05-18 11:10:39'),
(204, 119, 'sisi', 89, '2019-05-18 11:51:52'),
(206, 119, 'Mais pourquoi ?', 88, '2019-05-18 11:53:19'),
(207, 119, 'Je ne sais pas', 88, '2019-05-18 11:54:10'),
(208, 119, ':(', 88, '2019-05-18 11:54:18'),
(211, 130, 'Cool !', 89, '2019-05-18 12:01:54'),
(212, 119, 'Yes je suis d\'accord', 84, '2019-05-20 01:58:44'),
(216, 119, 'C\'est super !', 88, '2019-05-20 02:17:47'),
(218, 119, 'encore mieux', 88, '2019-05-20 02:20:10'),
(220, 119, 'c\'est top', 88, '2019-05-20 02:23:06'),
(221, 119, 'c\'est top !', 88, '2019-05-20 02:31:37'),
(226, 119, 'Wow !', 88, '2019-05-20 02:38:23'),
(227, 130, ':)', 88, '2019-05-20 05:35:58'),
(228, 130, ';)', 88, '2019-05-20 05:42:00'),
(229, 130, ':D', 85, '2019-05-20 05:42:09'),
(231, 130, ':)', 89, '2019-05-20 05:44:49'),
(232, 130, 'Trop bien', 89, '2019-05-20 09:13:29'),
(233, 119, 'Trop trop bien', 89, '2019-05-23 00:51:38'),
(234, 119, 'Cooool', 88, '2019-05-23 00:52:35'),
(235, 119, 'Cool', 88, '2019-05-23 00:52:43'),
(236, 119, 'Yess', 88, '2019-05-23 00:53:05'),
(237, 119, ':)', 89, '2019-05-23 00:53:40'),
(238, 119, ':)', 89, '2019-05-23 00:54:30'),
(239, 130, ';)', 89, '2019-05-23 00:55:03'),
(240, 130, ':D', 89, '2019-05-23 00:55:13'),
(241, 130, 'Hehe', 89, '2019-05-23 00:58:07'),
(242, 130, 'Ahah', 89, '2019-05-23 00:59:31'),
(243, 130, ':)))', 89, '2019-05-23 01:00:34'),
(244, 130, ':p', 89, '2019-05-23 01:00:56'),
(245, 130, 'Yeah', 89, '2019-05-23 01:01:28'),
(246, 130, 'dqdq', 89, '2019-05-23 01:01:45'),
(247, 130, 'Toto', 89, '2019-05-23 01:01:57'),
(248, 130, 'Yep', 89, '2019-05-23 01:02:43'),
(249, 130, 'dqwdwqd', 88, '2019-05-23 01:03:08'),
(250, 130, 'dqwd', 89, '2019-05-23 01:03:25'),
(251, 130, ':D', 89, '2019-05-23 01:04:23'),
(252, 130, 'Hehe', 89, '2019-05-23 01:05:43'),
(253, 130, ':D', 88, '2019-05-23 01:05:50'),
(254, 130, 'Ça pete srx', 85, '2019-05-23 01:06:04'),
(255, 130, 'Oui', 84, '2019-05-23 01:06:12'),
(256, 130, 'C\'est cool les chats', 86, '2019-05-23 01:06:22'),
(257, 130, '^^', 89, '2019-05-23 02:01:44'),
(258, 130, '^^', 89, '2019-05-23 02:02:11'),
(259, 130, ':D', 89, '2019-05-23 02:02:28'),
(260, 130, 'hihi', 89, '2019-05-23 02:02:44'),
(261, 130, ':p', 89, '2019-05-23 02:03:43'),
(262, 130, ':}', 89, '2019-05-23 02:04:14'),
(263, 119, 'Nice pic bro', 89, '2019-05-23 02:10:27'),
(264, 119, 'I love it bro', 89, '2019-05-23 02:10:42'),
(265, 119, 'It\'s brilliant bro', 89, '2019-05-23 02:12:47'),
(266, 119, 'What the fuck bro', 89, '2019-05-23 02:12:58'),
(267, 119, 'Hehe', 89, '2019-05-23 02:14:59'),
(268, 119, '2', 89, '2019-05-23 02:17:17'),
(269, 119, '3', 89, '2019-05-23 02:18:33'),
(270, 119, '4', 89, '2019-05-23 02:18:59'),
(271, 119, '5', 89, '2019-05-23 02:19:31'),
(272, 119, '6', 89, '2019-05-23 02:20:12'),
(273, 119, '7', 89, '2019-05-23 02:20:51'),
(274, 119, '8', 89, '2019-05-23 02:21:26'),
(275, 119, '9', 89, '2019-05-23 02:21:47'),
(276, 119, 'Trop cool !', 89, '2019-05-23 02:23:37'),
(277, 119, 'Wow', 89, '2019-05-23 02:26:14'),
(278, 130, 'Merci l\'ami !', 89, '2019-05-23 02:26:46'),
(279, 119, 'Ca pete !', 89, '2019-05-23 02:30:07'),
(280, 119, ':)', 89, '2019-05-23 02:31:14'),
(281, 119, ':D', 89, '2019-05-23 02:32:20'),
(282, 119, 'haha', 89, '2019-05-23 02:32:46'),
(283, 119, 'hoho', 89, '2019-05-23 02:33:31'),
(284, 119, 'Aieee', 89, '2019-05-23 02:34:23'),
(285, 119, 'Yoooo', 89, '2019-05-23 02:36:34'),
(286, 119, '999', 89, '2019-05-23 02:38:10'),
(287, 119, 'Tesstttt', 89, '2019-05-23 02:38:47'),
(288, 119, 'Testttt 2', 89, '2019-05-23 02:39:27'),
(289, 119, ':D', 85, '2019-05-23 02:39:49'),
(290, 119, ':o', 84, '2019-05-23 02:40:04'),
(291, 119, 'J\'adore', 85, '2019-05-23 02:43:21'),
(292, 119, 'Testttt 3', 89, '2019-05-23 02:44:11'),
(293, 130, 'Tesst 4', 89, '2019-05-23 02:45:16'),
(294, 119, 'Tesstt 5', 89, '2019-05-23 02:45:39'),
(295, 119, 'Tesst 6', 89, '2019-05-23 02:46:29'),
(296, 119, 'Testtt 7', 89, '2019-05-23 02:47:07'),
(297, 119, 'Ohhh', 88, '2019-05-23 02:47:33'),
(298, 119, 'Aieeee', 87, '2019-05-23 02:47:58'),
(299, 119, 'Aieeee 2', 87, '2019-05-23 02:48:13'),
(300, 119, 'J\'avoue', 86, '2019-05-23 02:48:27'),
(301, 119, 'Grave', 85, '2019-05-23 02:48:45'),
(302, 119, 'Ohhh', 85, '2019-05-23 02:49:36'),
(303, 119, 'heeeee', 85, '2019-05-23 02:49:46'),
(304, 119, 'Ddasdasd', 85, '2019-05-23 02:50:01'),
(305, 133, 'plop', 89, '2019-05-23 10:28:45'),
(306, 133, 'plop', 89, '2019-05-23 10:28:50'),
(307, 133, '', 89, '2019-05-23 10:29:09'),
(308, 133, '<script>alert(\'plop\');</script>', 89, '2019-05-23 10:46:43'),
(309, 133, 'plop', 90, '2019-05-23 10:50:26'),
(310, 131, 'Cte tete!', 89, '2019-05-24 08:48:23'),
(311, 131, '<script>alert(\"game over\")</script>', 90, '2019-05-24 08:49:23'),
(312, 131, '<h1>C\'est moi!</h1>', 90, '2019-05-24 08:52:55'),
(313, 131, '<script>alert(\"game over\");</script>', 90, '2019-05-24 08:54:38'),
(314, 131, '<script>alert(\'Injected!\');</script>', 90, '2019-05-24 08:57:40'),
(315, 130, 'Ça pete sa mere !', 91, '2019-05-25 09:15:28'),
(316, 130, '<h1>Cool</h1>', 97, '2019-05-25 10:08:52'),
(317, 130, 'Great', 97, '2019-05-25 10:41:56'),
(318, 130, 'hehe', 97, '2019-05-25 10:42:13'),
(319, 130, 'Wow', 97, '2019-05-25 10:43:51'),
(320, 130, 'lol', 97, '2019-05-25 10:45:55'),
(321, 130, 'ahahg', 97, '2019-05-25 10:46:25'),
(322, 130, ':p', 97, '2019-05-25 10:46:33'),
(323, 130, ':D', 97, '2019-05-25 10:46:43'),
(324, 119, '<h1>lol</h1>', 97, '2019-05-25 10:49:36'),
(325, 119, ':D', 97, '2019-05-25 10:50:33'),
(326, 119, '<script>alert(\"coucou\")</script>', 97, '2019-05-25 10:52:04'),
(327, 132, 'Yes', 97, '2019-05-25 11:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `img_user` int(11) NOT NULL,
  `img_path` text NOT NULL,
  `img_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `img_user`, `img_path`, `img_time`) VALUES
(84, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce0419a287b4.png', '2019-05-18 10:32:11'),
(85, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce041b47aa34.png', '2019-05-18 10:32:37'),
(86, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce041ed28084.png', '2019-05-18 10:33:34'),
(87, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce041f09cbdf.png', '2019-05-18 10:33:37'),
(88, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce041f337f8e.png', '2019-05-18 10:33:40'),
(89, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce041f6c43a9.png', '2019-05-18 10:33:45'),
(90, 133, '/camagru/sources/gallery/user-133/montage-user-133-5ce6dd42cf131.png', '2019-05-23 10:50:05'),
(91, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce96a10e0c7f.png', '2019-05-25 09:15:14'),
(93, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce96ac90685c.png', '2019-05-25 09:18:25'),
(94, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce96b2a36806.png', '2019-05-25 09:19:54'),
(95, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce96b3c50d92.png', '2019-05-25 09:20:14'),
(96, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce96b4e82a10.png', '2019-05-25 09:20:31'),
(97, 130, '/camagru/sources/gallery/user-130/montage-user-130-5ce96b869df71.png', '2019-05-25 09:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `like_user` int(11) NOT NULL,
  `like_img` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `like_user`, `like_img`) VALUES
(135, 119, 88),
(138, 130, 84),
(144, 130, 88),
(145, 130, 85),
(149, 130, 87),
(155, 130, 86),
(164, 133, 90),
(165, 131, 89),
(166, 130, 91),
(167, 132, 97);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_pwd` varchar(9999) NOT NULL,
  `user_valid` tinyint(1) DEFAULT '0',
  `user_valid_key` varchar(32) DEFAULT NULL,
  `reset_password_key` varchar(32) DEFAULT NULL,
  `comment_sub` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_pwd`, `user_valid`, `user_valid_key`, `reset_password_key`, `comment_sub`) VALUES
(72, 'toto123', 'toto123@email.fr', 'e69da91758a993638a93e1278d72b0bbd704e6b15fd3a2e06c3eb27d233b2b46e83610565df3a8ee74b8c675dd68ce4a325a88fe8417783997e5d5306b6af9e9', 0, NULL, NULL, 1),
(119, 'toto1234', 'toto1234@email.fr', '723c1c48ab6e71ebb0288f34755c5172cf01d895c8a91953ac7194abec7261f0b71f4a8a623efc7ba94032f48f1fee2ec441a0de4491a918995e9418aecae118', 0, '58d4d1e7b1e97b258c9ed0b37e02d087', NULL, 0),
(130, 'lucas', 'lucas.cordenod@live.fr', 'fa866917533c836615e23d2a83456ca198f93a0b80479fefa2d149f390a8f6bfaf6d0f7a333359553de25eb353f235f7f8dcb5411992cb4899817dccb9f2ab61', 1, 'afda332245e2af431fb7b672a68b659d', NULL, 1),
(131, 'raph', 'raphael.allemand@live.fr', '457c82e14bc645525b4b63c78340d6eae6a85b4ebec75af524b76d79f7f4beb0840dfd01484c173ea9b7cc4dd65fe3697d8e05ff721191f4a45f35740d9a911f', 1, '577bcc914f9e55d5e4e4f82f9f00e7d4', NULL, 1),
(132, 'coco', 'coco@alalal.fr', 'd9c0122b6df53ad055274fb8e39683789c4109046ce1644caca3da77ae1841477d6e2416aad9b764b478175e23150c4d3d3e468fad9e7f4d520ae24fd2e653ed', 0, 'dd8eb9f23fbd362da0e3f4e70b878c16', NULL, 1),
(133, 'jwalle', 'punktumg@gmail.com', 'deccc2956cb2d84118fc4a33c9d85c7e3d5a4d6e438d4f9d4095186e4f46d844b5d5d4c1fdacf04a58720921d1e544f5c12baf834b4a172c85d27b07ef0b615e', 1, '6512bd43d9caa6e02c990b0a82652dca', NULL, 0),
(134, 'keks', 'keks@totooto.fr', 'e69da91758a993638a93e1278d72b0bbd704e6b15fd3a2e06c3eb27d233b2b46e83610565df3a8ee74b8c675dd68ce4a325a88fe8417783997e5d5306b6af9e9', 0, '49182f81e6a13cf5eaa496d51fea6406', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
