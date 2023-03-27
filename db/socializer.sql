-- Adminer 4.8.1 MySQL 10.4.24-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_content` varchar(255) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment_content`, `comment_date`) VALUES
(5,	16,	2,	'very Nice',	'2022-07-03 15:11:13'),
(6,	16,	1,	'hnji nice aa\r\n',	'2022-07-03 15:11:31'),
(7,	15,	1,	'nothing much',	'2022-07-03 15:14:49'),
(8,	4,	2,	'So cool ',	'2022-07-04 05:16:51'),
(9,	13,	4,	'All gud ',	'2022-07-04 06:08:10'),
(10,	16,	5,	'Ghaint 💥',	'2022-07-04 06:08:21'),
(11,	18,	1,	'nice',	'2022-07-04 06:13:22'),
(12,	19,	2,	'Very nice',	'2022-07-04 06:13:57'),
(13,	19,	1,	'shaabash\r\n',	'2022-07-04 06:14:33'),
(14,	18,	6,	'Nyc.... but not Yours !!🤣🤣🤣🤣🤣🤣🤣🤣',	'2022-07-04 06:35:04'),
(15,	19,	6,	'Mnu vi bula liya kr.... klle klle !!!😒😒😒😒😒😒😒\r\n',	'2022-07-04 06:35:57'),
(16,	17,	6,	'🔥🔥🔥🔥🔥',	'2022-07-04 06:37:06'),
(17,	21,	1,	'nice\r\n',	'2022-07-04 06:41:37'),
(18,	22,	1,	'very nice\r\n',	'2022-07-04 06:42:53'),
(19,	23,	1,	'joker ',	'2022-07-06 03:55:06'),
(20,	24,	10,	'very nice\r\n',	'2022-07-06 05:34:33'),
(21,	24,	1,	'very nice Aroohi',	'2022-07-06 05:35:21');

DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `friend_id` int(11) NOT NULL AUTO_INCREMENT,
  `my_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_active` varchar(3) NOT NULL,
  PRIMARY KEY (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `friends` (`friend_id`, `my_id`, `user_id`, `chat_active`) VALUES
(4,	1,	4,	'YES'),
(5,	1,	5,	'YES'),
(6,	2,	1,	'YES'),
(7,	1,	9,	'YES'),
(9,	1,	6,	'NO'),
(10,	5,	4,	'YES'),
(11,	5,	9,	'NO'),
(12,	1,	10,	'YES');

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `like_count` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `likes` (`like_id`, `post_id`, `user_id`, `like_count`) VALUES
(3,	22,	1,	1),
(4,	22,	2,	1),
(6,	23,	9,	1),
(8,	23,	1,	1),
(9,	23,	5,	1);

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `my_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_content` varchar(255) NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `messages` (`message_id`, `my_id`, `user_id`, `message_content`, `message_date`) VALUES
(1,	1,	4,	'Hey',	'2022-07-05 14:51:37'),
(2,	1,	4,	'How are you?',	'2022-07-05 15:57:09'),
(3,	2,	1,	'Hello',	'2022-07-05 16:44:33'),
(4,	2,	1,	'Hello',	'2022-07-05 16:44:38'),
(8,	1,	5,	'hello',	'2022-07-05 17:14:44'),
(13,	1,	9,	'Hello',	'2022-07-05 18:18:19'),
(14,	1,	2,	'How are you?',	'2022-07-06 02:26:17'),
(15,	9,	1,	'Yo yo',	'2022-07-06 02:59:52'),
(16,	1,	9,	'Ki haal chaal',	'2022-07-06 03:41:41'),
(18,	1,	9,	'1',	'2022-07-06 03:53:32'),
(19,	1,	2,	'heeeeeeeeelllo',	'2022-07-06 04:01:01'),
(20,	1,	2,	'how ',	'2022-07-06 04:02:08'),
(21,	5,	4,	'Halio',	'2022-07-06 04:45:58'),
(22,	5,	4,	'Halio',	'2022-07-06 04:46:05'),
(23,	1,	10,	'hey',	'2022-07-06 05:35:49'),
(24,	10,	1,	'hey',	'2022-07-06 05:36:12');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_content` varchar(255) NOT NULL,
  `upload_image` varchar(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `upload_image`, `post_date`) VALUES
(4,	1,	'Thor is Back',	'post/post_jass_22072081733_thor.jpg',	'2022-07-02 06:17:33'),
(10,	1,	'Spiderman is here to greet!',	'post/post_jass_22073094321_spiderman.jpg',	'2022-07-03 07:43:21'),
(13,	1,	'Hey How Are You????',	'',	'2022-07-03 11:42:06'),
(14,	2,	'Hey what&#039;s Up?',	'',	'2022-07-03 11:59:16'),
(16,	1,	' Nice Wheather,Let&#039;s go out\r\n',	'',	'2022-07-03 12:45:43'),
(17,	1,	'Yaaaaaay! Spidey!',	'post/post_jass_22074065752_spiderman.jpg',	'2022-07-04 04:57:52'),
(18,	4,	'NO',	'post/post_kanika2022_22074081252_maxresdefault.jpg',	'2022-07-04 06:12:52'),
(19,	5,	'NO',	'post/post_yogesh _22074081338_Screenshot_2022-01-13-22-08-53-79_db2300be643d553259cbc11cd691d2a5.png',	'2022-07-04 06:13:38'),
(20,	2,	'Hey check',	'post/post_finnmcwitty_22074082414_IMG-20220704-WA0000.jpg',	'2022-07-04 06:24:14'),
(22,	6,	'NO',	'post/post_pangotra08_22074084236_FB_IMG_1533395511095.jpg',	'2022-07-04 06:42:36'),
(23,	9,	'NO',	'post/post_gorki_22074125728_DFA1B489-ADE7-4599-B838-98C4545BABAC.jpeg',	'2022-07-04 10:57:28'),
(24,	10,	'Hey',	'post/post_aroohi_22076073407_spiderman.jpg',	'2022-07-06 05:34:07');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `country` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `describe_user` text NOT NULL,
  `relationship` text NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_cover` varchar(255) NOT NULL,
  `user_registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` text NOT NULL,
  `posts` text NOT NULL,
  `recovery_account` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`user_id`, `fullname`, `username`, `email`, `password`, `country`, `gender`, `dob`, `describe_user`, `relationship`, `user_image`, `user_cover`, `user_registration_date`, `status`, `posts`, `recovery_account`) VALUES
(1,	'jass jandir',	'jass',	'jass@gmail.com',	'b0f8b3e58f093359fe1af416b5ea8ed6',	'India',	'Male',	'1999-08-17',	'Hey! It&#039;s Jass',	'Unmarried',	'users/profile_jass_22072055110_spiderman.jpg',	'cover/cover_jass_22072060233_thor.jpg',	'2022-07-01 04:51:47',	'verified',	'yes',	'finnmcwitty@gamil.com'),
(2,	'finn mcwitty',	'finnmcwitty',	'finnmcwitty@gmail.com',	'8cfa2282b17de0a598c010f5f0109e7d',	'India',	'Male',	'1999-08-17',	'Hey! Socializer',	'...',	'users/profile_finnmcwitty_22072102109_ironman.jpg',	'cover/default_cover.jpg',	'2022-07-01 04:55:00',	'verified',	'yes',	'...'),
(4,	'Kanika Rajput',	'kanika2022',	'samairarajput264@gmail.com',	'b0deec6b2aeb827eb3c8bce1f869fc15',	'India',	'Female',	'2021-05-15',	'Hey! Socializer',	'...',	'users/profile_kanika2022_22074081614_Snapchat-1138835674.jpg',	'cover/default_cover.jpg',	'2022-07-04 06:00:51',	'verified',	'yes',	'...'),
(5,	'Yogesh ',	'yogesh ',	'yogeshjassi201@gmail.com',	'b5022e5d6344355373e9db5e346ada95',	'India',	'Male',	'2022-07-04',	'Hey! Socializer',	'...',	'users/profile_yogesh _22074081242_IMG_20210714_113306_315.jpg',	'cover/default_cover.jpg',	'2022-07-04 06:06:56',	'verified',	'yes',	'...'),
(6,	'Rakshit Pangotra',	'pangotra08',	'racshitp@gmail.com',	'93701988a86ea26c986684a93411280f',	'India',	'Male',	'1999-12-01',	'Hey! Socializer',	'...',	'users/profile_pangotra08_22074084219_IMG_20201008_205403 - Copy.jpg',	'cover/default_cover.jpg',	'2022-07-04 06:33:39',	'verified',	'yes',	'...'),
(7,	'Vani khanna ',	'vanikhanna',	'khannavaani1977@gmail.com',	'896e06850a93106ca571e5f76e1883d7',	'India',	'Female',	'2022-07-01',	'Hey! Socializer',	'...',	'users/user.png',	'cover/default_cover.jpg',	'2022-07-04 06:40:43',	'verified',	'no',	'...'),
(8,	'Varun',	'varun',	'varun@gmail.com',	'25d55ad283aa400af464c76d713c07ad',	'India',	'Male',	'2013-05-07',	'Hey! Socializer',	'...',	'users/user.png',	'cover/default_cover.jpg',	'2022-07-04 07:07:10',	'verified',	'no',	'...'),
(9,	'Gorki',	'gorki',	'gorkijaxy@gmail.com',	'25d55ad283aa400af464c76d713c07ad',	'India',	'Male',	'2022-09-09',	'Hey! Socializer',	'...',	'users/user.png',	'cover/default_cover.jpg',	'2022-07-04 10:55:29',	'verified',	'yes',	'...'),
(10,	'Aroohi Kaur',	'aroohi',	'aroohi@gmail.com',	'8cfa2282b17de0a598c010f5f0109e7d',	'USA',	'Female',	'2022-01-25',	'Hey! Socializer',	'...',	'users/user.png',	'cover/default_cover.jpg',	'2022-07-06 05:33:01',	'verified',	'yes',	'...');

-- 2022-07-10 16:12:14