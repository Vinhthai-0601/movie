-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th7 26, 2022 lúc 02:54 PM
-- Phiên bản máy phục vụ: 5.7.36
-- Phiên bản PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `loginsu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `comment_text` text NOT NULL,
  `comment_user` int(11) NOT NULL,
  `comment_post` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_parent` int(11) DEFAULT NULL,
  `reply_to_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`ID`, `comment_text`, `comment_user`, `comment_post`, `date_created`, `comment_parent`, `reply_to_user`) VALUES
(80, 'Hell', 14, 2, '2021-07-04 16:37:28', NULL, NULL),
(81, 'THE FASTEST CAR OF THE WORLD !!!', 14, 3, '2021-07-05 13:46:00', NULL, NULL),
(42, 'Hell', 4, 2, '2021-06-30 23:50:54', NULL, NULL),
(39, 'Helll no', 4, 2, '2021-06-30 23:33:54', NULL, NULL),
(59, 'ThÃ¡i', 14, 2, '2021-07-03 19:21:14', NULL, NULL),
(60, 'Post 2\n', 14, 2, '2021-07-03 19:30:22', NULL, NULL),
(61, 'Wow', 14, 2, '2021-07-03 19:31:58', NULL, NULL),
(82, 'NhÆ° PhÃ¹', 14, 3, '2021-07-06 00:04:46', NULL, NULL),
(24, 'What a nice car !!!', 1, 3, '2021-06-29 18:20:28', NULL, NULL),
(76, 'YOLO', 14, 2, '2021-07-04 15:33:17', 61, 14),
(83, 'Hi', 14, 3, '2021-07-08 03:32:10', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
