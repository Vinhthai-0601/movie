-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th7 30, 2022 lúc 09:03 AM
-- Phiên bản máy phục vụ: 5.7.31
-- Phiên bản PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `newmovies_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `comment_text` text NOT NULL,
  `comment_user` int(11) DEFAULT NULL,
  `comment_post` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_parent` int(11) DEFAULT NULL,
  `reply_to_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`ID`, `comment_text`, `comment_user`, `comment_post`, `date_created`, `comment_parent`, `reply_to_user`) VALUES
(26, 'This film really good ðŸ‘ŒðŸ‘ŒðŸ‘Œ', 244, 29, '2022-07-29 19:04:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_name` int(11) NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `movie_id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(255) NOT NULL,
  `movie_img` varchar(255) DEFAULT NULL,
  `movie_url` varchar(255) NOT NULL,
  `movie_details` varchar(255) DEFAULT NULL,
  `movie_genre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_name`, `movie_img`, `movie_url`, `movie_details`, `movie_genre`) VALUES
(29, 'Thor Love & Thunder Trailer', 'images/thor-love-and-thunder-poster.jpg', 'video-62e3cca99d24f7.17344679.mp4', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae reprehenderit tempora modi maiores minus nemo odio deserunt soluta similique, tenetur exercitationem quis delectus obcaecati sequi eaque a! Ullam, amet dicta? Lorem, ipsum dolor sit ', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movie_genre`
--

DROP TABLE IF EXISTS `movie_genre`;
CREATE TABLE IF NOT EXISTS `movie_genre` (
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `user_description` varchar(1000) DEFAULT NULL,
  `user_role` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=252 DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `user_name`, `email`, `profile_img`, `hash`, `user_role`) VALUES
(244, 'NKLuyen', 'nkluyen123@gmail.com', 'images/3dc08f1e19cb43b007a0466c7f0f54b1.jpg', '$2y$10$nXU2NtcmwOeNQsEEkA4Yk.YCCUdrvI8s3m8ltDADEpuxaenjBu.ny', 1),
(245, 'Coftbred', 'manafer@gmail.com', '', '$2y$10$4IATz/zhX5rMfHDJ.vQ6tOmCpXSITuR56tOEtxLQzAUVWEhA7hQO.', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
