-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th7 25, 2022 lúc 06:12 AM
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
-- Cơ sở dữ liệu: `newmovies`
--

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
  `user_role` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `user_name`, `email`, `hash`, `user_role`) VALUES
(244, 'NKLuyen', 'nkluyen123@gmail.com', '$2y$10$nXU2NtcmwOeNQsEEkA4Yk.YCCUdrvI8s3m8ltDADEpuxaenjBu.ny', 1),
(245, 'Coftbred', 'manafer@gmail.com', '$2y$10$4IATz/zhX5rMfHDJ.vQ6tOmCpXSITuR56tOEtxLQzAUVWEhA7hQO.', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_name` varchar(255) NOT NULL,
  `video_img` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) NOT NULL,
  `video_details` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `videos`
--

INSERT INTO `videos` (`id`, `video_name`, `video_img`, `video_url`, `video_details`) VALUES
(14, 'test_0.1', 'https://iforum-sg.c.hihonor.com/latin/latin_data/images/10000/2022/7/21/9d5955ff-d846-4093-b7cd-4657fb6e8d16.jpeg', 'video-62de16ed417fa8.16125577.mp4', NULL),
(13, 'thor', 'https://kenh14cdn.com/203336854389633024/2022/6/30/photo-1-16565496687901731692875.jpg', 'video-62dd0d4781da42.18223354.mp4', NULL),
(12, 'Thor Love & Thunder Trailer', 'https://kenh14cdn.com/203336854389633024/2022/6/30/photo-1-16565496687901731692875.jpg', 'video-62dbc65389f853.45919953.mp4', NULL),
(11, 'thor', 'https://kenh14cdn.com/203336854389633024/2022/6/30/photo-1-16565496687901731692875.jpg', 'video-62dbc597b07eb9.75363675.mp4', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
