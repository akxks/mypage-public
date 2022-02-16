-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2021 at 06:14 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mypage`
--

-- --------------------------------------------------------

--
-- Table structure for table `bans`
--

CREATE TABLE `bans` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `reason` varchar(222) NOT NULL,
  `unban_date` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `blocked`
--

CREATE TABLE `blocked` (
  `id` int(11) NOT NULL,
  `useridBlocker` int(11) NOT NULL,
  `useridblocked` int(11) NOT NULL,
  `since_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `blockedwords`
--

CREATE TABLE `blockedwords` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `word` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `blogposts`
--

CREATE TABLE `blogposts` (
  `id` int(11) NOT NULL,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `post` varchar(2000) NOT NULL,
  `title` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogposts`
--

INSERT INTO `blogposts` (`id`, `likes`, `dislikes`, `post`, `title`, `create_date`) VALUES
(1, 1, 2, 'test', 'me', '2021-08-15 04:48:00'),
(2, 2, 2, 'test2', 'test1', '2021-08-15 04:50:24'),
(3, 2, 2, 'asdasdasdsaf', 'wefewgertghergwrg', '2021-08-15 05:11:35'),
(4, 5, 5, '5', 'c', '2021-08-15 05:11:48'),
(5, 3, 3, 'ggg', 'gcccc', '2021-08-15 05:11:55'),
(6, 33, 333, 'herhehh', 'reherhrereh', '2021-08-15 05:12:00'),
(7, 22, 2, 'faaa', 'fafafaf', '2021-08-15 05:12:04'),
(8, 2, 2, 'cascsacsa', 'csascacsacsasc', '2021-08-15 05:12:09'),
(9, 2, 2, 'new post!', ';)', '2021-08-15 05:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `post` varchar(2000) NOT NULL,
  `postId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `userid`, `likes`, `dislikes`, `post`, `postId`, `commentId`, `create_date`) VALUES
(13, 44, 0, 0, 'Lookes nice ! ', 242, -1, '2021-07-26 16:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `type` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `type`, `create_date`) VALUES
(1, 'asdadsad', 'asdasd@aasdas', 'asd', 'Suggestion', '2021-08-09 21:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `useridFriend` int(11) NOT NULL,
  `friendstate` varchar(22) DEFAULT NULL,
  `since_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `userid`, `useridFriend`, `friendstate`, `since_date`) VALUES
(89, 7, 29, 'Friends', '2021-05-08 15:45:57'),
(96, 12, 7, 'Friends', '2021-05-08 16:57:43'),
(97, 7, 12, 'Friends', '2021-05-08 16:57:43'),
(108, 33, 12, 'Friends', '2021-05-14 14:11:21'),
(109, 12, 33, 'Friends', '2021-05-14 14:11:21'),
(112, 12, 31, 'Friends', '2021-05-19 09:04:51'),
(113, 31, 12, 'Friends', '2021-05-19 09:04:51'),
(118, 12, 35, 'Friends', '2021-05-19 09:35:43'),
(119, 35, 12, 'Friends', '2021-05-19 09:35:43'),
(178, 12, 44, 'Friends', '2021-07-11 19:11:54'),
(179, 44, 12, 'Friends', '2021-07-11 19:11:54'),
(188, 19, 55, 'Friends', '2021-10-20 22:49:01'),
(189, 55, 19, 'Friends', '2021-10-20 22:49:01'),
(190, 10, 57, 'Friends', '2021-10-29 10:57:45'),
(191, 57, 10, 'Friends', '2021-10-29 10:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `hideposts`
--

CREATE TABLE `hideposts` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interactions`
--

CREATE TABLE `interactions` (
  `id` int(11) NOT NULL,
  `postid` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interactions`
--

INSERT INTO `interactions` (`id`, `postid`, `userid`, `type`, `comment`, `create_date`) VALUES
(3080, 223, 7, 'Like', '', '2021-07-11 18:46:23'),
(3219, 204, 44, 'Like', '', '2021-07-24 03:52:14'),
(3221, 142, 44, 'Like', '', '2021-07-25 00:03:13'),
(3222, 130, 44, 'Like', '', '2021-07-25 00:08:59'),
(3899, 205, 44, 'Like', '', '2021-07-26 16:21:44'),
(3900, 203, 44, 'Like', '', '2021-07-26 16:21:48'),
(3902, 242, 44, 'Like', '', '2021-07-26 16:22:08'),
(3912, 223, 44, 'Like', '', '2021-07-26 19:10:39'),
(3913, 202, 44, 'Like', '', '2021-07-26 19:11:14'),
(3914, 201, 44, 'Like', '', '2021-07-26 19:11:21'),
(3920, 248, 44, 'Like', '', '2021-07-26 21:53:07'),
(3953, 134, 44, 'Like', '', '2021-07-30 21:34:05'),
(3954, 131, 44, 'Like', '', '2021-07-30 21:34:13'),
(3955, 120, 44, 'Like', '', '2021-07-30 21:34:20'),
(3956, 119, 44, 'Like', '', '2021-07-30 21:34:22'),
(3957, 52, 44, 'Like', '', '2021-07-30 21:34:29'),
(3958, 224, 44, 'Like', '', '2021-07-30 22:22:09'),
(4002, 155, 57, 'Like', '', '2021-10-29 11:06:19'),
(4293, 408, 57, 'Like', '', '2021-10-29 12:03:32'),
(4324, 407, 57, 'Dislike', '', '2021-10-29 12:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE `invites` (
  `id` int(11) NOT NULL,
  `codemaker` int(11) NOT NULL,
  `codeuser` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `used` tinyint(1) DEFAULT NULL,
  `use_date` datetime DEFAULT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`id`, `codemaker`, `codeuser`, `code`, `used`, `use_date`, `create_date`) VALUES
(127, 36, 0, 'TUOW2', 0, '2021-05-24 04:31:18', '2021-05-24 04:31:18'),
(173, 39, 0, '335GT', 0, '2021-06-01 22:06:38', '2021-06-01 22:06:38'),
(190, 10, 0, 'S2F79', 0, '2021-06-10 14:13:35', '2021-06-10 14:13:35'),
(191, 10, 0, 'UDVUF', 0, '2021-06-10 14:13:36', '2021-06-10 14:13:36'),
(192, 10, 57, 'MDQGT', 1, '2021-10-29 10:57:45', '2021-06-10 14:13:37'),
(193, 10, 0, '5LHC0', 0, '2021-06-10 14:13:38', '2021-06-10 14:13:38'),
(194, 10, 0, '7DDVJ', 0, '2021-06-10 14:13:38', '2021-06-10 14:13:38'),
(275, 19, 0, 'UJW8W', 0, '2021-09-20 02:58:51', '2021-09-20 02:58:51'),
(276, 19, 55, 'EAV3F', 1, '2021-10-20 22:49:01', '2021-09-20 02:58:52'),
(277, 57, 0, 'QBRTP', 0, '2021-10-29 11:53:19', '2021-10-29 11:53:19'),
(278, 57, 0, 'E7K31', 0, '2021-10-29 11:53:21', '2021-10-29 11:53:21'),
(279, 57, 0, '8W7CV', 0, '2021-10-29 11:53:21', '2021-10-29 11:53:21'),
(280, 57, 0, 'FJ1SI', 0, '2021-10-29 11:53:22', '2021-10-29 11:53:22'),
(281, 57, 0, 'V2QEW', 0, '2021-10-29 11:53:22', '2021-10-29 11:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `type` varchar(24) NOT NULL,
  `post` varchar(2000) NOT NULL,
  `read` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `userid`, `type`, `post`, `read`, `create_date`) VALUES
(4, 7, 'Friends', 'Adrian Koszpek accepted your friend request!', 1, '2021-06-04 06:56:17'),
(26, 42, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 1, '2021-06-09 16:52:52'),
(30, 43, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 1, '2021-06-15 12:02:02'),
(40, 44, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 1, '2021-06-18 23:17:22'),
(43, 45, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 0, '2021-06-24 11:59:27'),
(46, 46, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 0, '2021-06-25 14:23:30'),
(48, 47, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 0, '2021-06-26 22:15:15'),
(50, 48, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 0, '2021-07-03 03:20:08'),
(52, 49, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 0, '2021-07-03 03:23:17'),
(54, 50, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 0, '2021-07-03 03:26:18'),
(59, 12, 'Friends', 'Andrea ❤️ Nemeth accepted your friend request!', 0, '2021-07-11 19:11:54'),
(61, 51, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 0, '2021-07-13 20:40:35'),
(63, 52, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 0, '2021-07-13 20:43:29'),
(65, 53, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 0, '2021-07-13 20:45:04'),
(67, 54, 'Invited', ' You have joined mypage with Adrian, Koszpek\'s invite!', 0, '2021-07-13 20:46:50'),
(95, 44, 'Mentions', 'adrian has mentioned you in their post ', 0, '2021-07-28 15:06:31'),
(96, 44, 'Mentions', 'adrian has mentioned you in their post ', 0, '2021-07-28 15:13:12'),
(97, 44, 'Mentions', 'adrian has mentioned you in their post ', 0, '2021-07-28 15:42:56'),
(105, 19, 'Inviter', ' has joined MyPage with your invite!', 0, '2021-10-20 22:49:01'),
(106, 55, 'Invited', ' You have joined mypage with \'s invite!', 0, '2021-10-20 22:49:01'),
(107, 10, 'Inviter', 'Adrian has joined MyPage with your invite!', 0, '2021-10-29 10:57:45'),
(108, 57, 'Invited', ' You have joined mypage with sofia\'s invite!', 1, '2021-10-29 10:57:45'),
(109, 57, 'Reported', 'You successfully reported aron ', 1, '2021-10-29 11:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `pinposts`
--

CREATE TABLE `pinposts` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `imgurl` varchar(333) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `comments` int(11) DEFAULT NULL,
  `shares` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `post` varchar(500) NOT NULL,
  `state` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `location` varchar(35) DEFAULT NULL,
  `isShare` tinyint(1) DEFAULT NULL,
  `sharePostId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `type`, `imgurl`, `userid`, `likes`, `comments`, `shares`, `dislikes`, `post`, `state`, `create_date`, `location`, `isShare`, `sharePostId`) VALUES
(9, 1, ' ', 3, 1, 0, 0, 0, 'Fuckkkkkk', 'Public', '2021-04-14 12:04:34', NULL, NULL, NULL),
(24, 1, ' ', 2, 2, 0, 0, 0, 'Welcome Charles my friend!!', 'Public', '2021-04-16 14:10:30', NULL, NULL, NULL),
(26, 1, ' ', 5, 0, 0, 0, 0, 'My name is shush\r\n', 'Public', '2021-04-16 14:11:30', NULL, NULL, NULL),
(32, 1, ' ', 5, 0, 0, 0, 0, 'Look at flight man so inspirational\r\n', 'Public', '2021-04-16 14:19:41', NULL, NULL, NULL),
(33, 1, ' ', 6, 0, 0, 0, 0, 'Heelllllloooooo', 'Public', '2021-04-16 14:23:44', NULL, NULL, NULL),
(34, 1, ' ', 6, 0, 1, 0, 0, 'Kumar is a rat', 'Public', '2021-04-16 14:26:17', NULL, NULL, NULL),
(54, 1, ' ', 12, 2, 0, 0, 0, 'hello', 'Public', '2021-05-04 14:21:22', NULL, NULL, NULL),
(56, 1, ' ', 12, 1, 0, 0, 0, 'my friend my friend', 'Public', '2021-05-05 11:46:52', NULL, NULL, NULL),
(58, 1, ' ', 12, 0, 0, 0, 0, 'haha fr', 'Public', '2021-05-05 11:47:24', NULL, NULL, NULL),
(59, 1, ' ', 12, 2, 1, 2, 0, 'why she so annoying bruh like wtf no one wants to be silent', 'Public', '2021-05-05 11:48:09', NULL, NULL, NULL),
(60, 1, ' ', 12, 1, 1, 1, 1, 'my friend I\'m so bored, why doesn\'t she just let people talk like whaa', 'Public', '2021-05-05 12:02:57', NULL, NULL, NULL),
(97, 1, ' ', 31, 0, 0, 0, 1, 'It’s meant to be kozpek', 'Public', '2021-05-14 11:37:31', '', NULL, NULL),
(98, 1, ' ', 31, 1, 0, 0, 0, 'I mean koszpek ', 'Public', '2021-05-14 11:38:08', '', NULL, NULL),
(99, 1, ' ', 31, 1, 1, 0, 0, 'Make me verified bich ', 'Public', '2021-05-14 11:38:23', '', NULL, NULL),
(100, 1, ' ', 31, 1, 0, 0, 0, 'My guy I know you can see this', 'Public', '2021-05-14 11:39:33', '', NULL, NULL),
(101, 1, ' ', 32, 0, 0, 0, 0, 'Bonjour', 'Public', '2021-05-14 11:40:09', '', NULL, NULL),
(102, 1, ' ', 32, 1, 0, 0, 0, 'Hi', 'Public', '2021-05-14 11:40:37', '', NULL, NULL),
(103, 1, ' ', 31, 1, 0, 0, 0, 'Heyyyy', 'Public', '2021-05-14 11:41:57', 'Adrians mums room🤤', NULL, NULL),
(104, 1, ' ', 31, 2, 0, 0, 0, 'Sandu “juice” is gay', 'Public', '2021-05-14 11:43:30', '', NULL, NULL),
(105, 1, ' ', 12, 3, 1, 0, 0, 'hello', 'Public', '2021-05-14 14:11:41', '', NULL, NULL),
(106, 1, ' ', 33, 3, 0, 0, 0, 'Sup! doing history work right now #grind #hard :D', 'Public', '2021-05-14 14:12:29', '', NULL, NULL),
(120, 0, 'user-content/uploads/B3AD6417-A63F-4FB5-BC67-B2B7C01F9188.jpeg', 12, 3, 2, 0, 1, '', 'Public', '2021-05-27 10:33:23', '', NULL, NULL),
(121, 1, ' ', 38, 2, 0, 0, 0, 'Hey guys :)', 'Public', '2021-05-28 11:42:12', '', NULL, NULL),
(128, 1, ' ', 39, 0, 0, 0, 0, 'Hello everyone, nice to meet you :)', 'Public', '2021-06-01 22:01:48', '', NULL, NULL),
(133, 1, ' ', 7, 1, 1, 0, 0, 'Im just chillin\'', 'Public', '2021-06-04 01:29:37', '', NULL, NULL),
(145, 3, 'user-content/uploads/trim.16A606F5-0DF2-4B3C-B16D-F7EF9F42C54D.MOV', 35, 1, 0, 0, 0, '', 'Public', '2021-06-09 13:05:30', '', NULL, NULL),
(151, 3, 'user-content/uploads/trim.9E96AE2F-C879-4CCF-80E3-E9625F0472E2.MOV', 35, 1, 0, 0, 0, '', 'Public', '2021-06-09 13:09:56', '', NULL, NULL),
(155, 3, 'user-content/uploads/trim.16A606F5-0DF2-4B3C-B16D-F7EF9F42C54D.MOV', 12, 5, 1, 1, 0, '', 'Public', '2021-06-09 13:05:30', '', NULL, NULL),
(162, 0, 'user-content/uploads/3C34633F-ADB8-49BF-92F3-302D6A14EB82.png', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 10:33:21', '', NULL, NULL),
(163, 0, 'user-content/uploads/B3E23655-07EA-4853-BF0C-695750518E68.png', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 10:34:04', '', NULL, NULL),
(164, 0, 'user-content/uploads/FDD0AFDF-1B31-447A-AE20-5E1B2360CE20.png', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 10:34:17', '', NULL, NULL),
(165, 3, 'user-content/uploads/trim.C6E6FBA3-C9A7-4F95-AD08-F18CEB0971F5.MOV', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 10:35:11', '', NULL, NULL),
(166, 0, 'user-content/uploads/68C72305-B7AC-4EC3-86F5-230150D45004.png', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 10:36:15', '', NULL, NULL),
(167, 0, 'user-content/uploads/6FAB2891-BBCB-47FD-B0E0-2B37CAE80F92.jpeg', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 10:36:32', '', NULL, NULL),
(168, 0, 'user-content/uploads/EF9207FD-B82A-4DAF-B069-8517BF1A5EE8.png', 35, 1, 0, 0, 0, '', 'Public', '2021-06-10 10:38:41', '', NULL, NULL),
(169, 0, 'user-content/uploads/F2D2EFCB-26D2-4555-9856-8DD9F20F24E5.png', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 11:18:30', '', NULL, NULL),
(170, 0, 'user-content/uploads/12A2C4DE-4D9C-43D7-B743-50CC23BD1FEB.png', 35, 1, 0, 0, 0, '', 'Public', '2021-06-10 11:18:38', '', NULL, NULL),
(171, 0, 'user-content/uploads/50293FEC-BE6E-4C3D-B450-E6C16D829134.jpeg', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 11:19:15', '', NULL, NULL),
(172, 3, 'user-content/uploads/trim.E208C0FE-EA2E-4AFA-A7A4-303428A3C920.MOV', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 11:20:30', '', NULL, NULL),
(173, 0, 'user-content/uploads/F9754CDA-A91C-4374-868D-62B05BD04130.jpeg', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 11:21:01', '', NULL, NULL),
(174, 0, 'user-content/uploads/3C001943-8C51-405E-8E58-04AADDB1FD4C.png', 35, 1, 0, 0, 0, '', 'Public', '2021-06-10 11:21:33', '', NULL, NULL),
(175, 1, ' ', 10, 0, 0, 0, 0, 'Hi', 'Public', '2021-06-10 14:13:28', '', NULL, NULL),
(176, 0, 'user-content/uploads/2C80F2C4-68D2-41EB-9D15-7F3E7A2DF91E.png', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 14:15:46', '', NULL, NULL),
(177, 3, 'user-content/uploads/trim.274CE12C-45EC-4111-945F-6AB1561589F7.MOV', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 14:16:26', '', NULL, NULL),
(178, 0, 'user-content/uploads/AAED405C-36A8-40B4-8F5D-DC53D522DA56.png', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 14:16:59', '', NULL, NULL),
(179, 0, 'user-content/uploads/84AADC49-4E18-4C88-BB24-AA31A40EE2B1.jpeg', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 14:17:30', '', NULL, NULL),
(180, 3, 'user-content/uploads/trim.F4F7AC56-14A5-4CE4-B762-9818DAABDB90.MOV', 35, 0, 0, 0, 0, '', 'Public', '2021-06-10 14:19:17', '', NULL, NULL),
(181, 3, 'user-content/uploads/trim.75894598-259F-41E6-B9A6-C12D32D0F156.MOV', 35, 0, 1, 0, 0, '', 'Public', '2021-06-10 14:19:38', '', NULL, NULL),
(182, 0, 'user-content/uploads/A27A8980-F0D3-40CC-8FCB-14B15548121B.png', 35, 1, 1, 0, 0, '', 'Public', '2021-06-10 14:20:16', '', NULL, NULL),
(200, 1, ' ', 43, 1, 0, 0, 0, 'Bonjour', 'Public', '2021-06-15 12:02:25', '', 0, 0),
(204, 0, 'user-content/uploads/EA42F40B-D7DB-4E06-A77C-394BF9159C9A.jpeg', 44, 3, 2, 0, 0, '', 'Public', '2021-06-18 23:22:19', '', 0, 0),
(207, 3, 'user-content/uploads/da42d26dce56b749a4869b0e176201e6.mp4', 45, 0, 0, 0, 2, '', 'Public', '2021-06-24 12:00:46', '', 0, 0),
(242, 1, ' ', 44, 2, 14, 5, 0, 'I just want to see that if I were to write a lot of text how would that really look on people’s phones due to the size being 19 pixels ', 'Public', '2021-07-25 00:13:03', '', 0, 0),
(266, 1, ' ', -2, 0, 0, 0, 0, '', 'Public', '2021-07-28 14:12:14', '', 0, 0),
(405, 1, ' ', 10, 0, 0, 0, 0, 'hey', 'Public', '2021-09-14 09:24:14', '', 0, 0),
(406, 1, ' ', 57, 0, 0, 0, 0, 'wow', 'Public', '2021-10-29 11:07:39', '', 1, 155),
(407, 1, ' ', 57, 1, 0, 0, 1, 'test', 'Public', '2021-10-29 11:08:28', '', 0, 0),
(408, 1, ' ', 57, 56, 0, 0, 21, 'test 2', 'Public', '2021-10-29 11:08:35', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `reportType` tinyint(1) NOT NULL,
  `reporter` int(11) NOT NULL,
  `reported` int(11) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `reportType`, `reporter`, `reported`, `reason`, `create_date`) VALUES
(33, 0, 57, 12, 'hateful', '2021-10-29 11:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `useridRequester` int(11) NOT NULL,
  `useridRequested` int(11) NOT NULL,
  `request_date` datetime NOT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `request_state` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `useridRequester`, `useridRequested`, `request_date`, `type`, `request_state`) VALUES
(122, 12, 29, '2021-06-08 14:38:38', 0, 'Waiting');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `userid` int(11) NOT NULL,
  `safetynsfw` tinyint(1) NOT NULL DEFAULT 0,
  `privacy` tinyint(1) NOT NULL DEFAULT 0,
  `disablerelationships` tinyint(1) NOT NULL DEFAULT 0,
  `featurestime` tinyint(1) NOT NULL DEFAULT 0,
  `likedposts` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`userid`, `safetynsfw`, `privacy`, `disablerelationships`, `featurestime`, `likedposts`) VALUES
(42, 0, 0, 0, 0, 0),
(43, 0, 0, 0, 0, 0),
(44, 0, 0, 0, 0, 0),
(45, 0, 0, 0, 0, 0),
(46, 0, 0, 0, 0, 0),
(47, 0, 0, 0, 0, 0),
(48, 0, 0, 0, 0, 0),
(49, 0, 0, 0, 0, 0),
(50, 0, 0, 0, 0, 0),
(51, 0, 0, 0, 0, 0),
(52, 0, 0, 0, 0, 0),
(53, 0, 0, 0, 0, 0),
(54, 0, 0, 0, 0, 0),
(55, 0, 0, 0, 0, 0),
(57, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shared`
--

CREATE TABLE `shared` (
  `id` int(11) NOT NULL,
  `postid` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `comments` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `sharedcomment` varchar(500) DEFAULT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bio` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `private` tinyint(1) NOT NULL,
  `registration` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL,
  `birthday` datetime DEFAULT NULL,
  `location` varchar(85) DEFAULT NULL,
  `pfpurl` varchar(333) DEFAULT NULL,
  `coverurl` varchar(111) DEFAULT NULL,
  `feedtype` tinyint(1) DEFAULT NULL,
  `profileViews` int(11) DEFAULT NULL,
  `language` varchar(5) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `relationshipId` int(11) DEFAULT NULL,
  `song` varchar(50) DEFAULT NULL,
  `emojistyle` varchar(20) DEFAULT NULL,
  `accountToken` varchar(360) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `hideAccount` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `bio`, `password`, `score`, `verified`, `private`, `registration`, `create_date`, `birthday`, `location`, `pfpurl`, `coverurl`, `feedtype`, `profileViews`, `language`, `admin`, `relationshipId`, `song`, `emojistyle`, `accountToken`, `username`, `hideAccount`) VALUES
(3, 'Lewis', 'Budd', 'lewis@outlook.com', 'No bio', '$2y$10$LMckfjVEHPG7bYA0cVkmLukrWXLdUqqbOTNHcMNsVKbVkGOxtH5/m', 3, 1, 0, 1, '2021-04-14 00:00:00', '2021-05-12 02:24:14', NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, NULL, 'en', NULL, NULL, NULL, NULL, 'c1def129b47a1fcbf777d28640fcfec8789e8584a9fc3369eeaf235e82fb351916d88f18fe1577a5f9c8a26d697be68177dff0d468092636249d85e4695010927a7659d5bdb47e343bbbf0121d93ad8fd43748bf26096f1c3d84f964232998287649fa833fd612aa18ba921b6bcb4d13b369d097ec502cbd4fcf1ad6de3cef73e28067b7d50a89e4799e136553872f42c941b2606ad2fb793736700a39361354ecbf69357ecf48479e729e0529bec2169ad3878e', 'lewisbudd', 0),
(6, 'Ewan', 'Austin-Valentine', 'ewanaustinvalentine@gmail.com', 'No bio', '$2y$10$T5zzH6K64i.W5BaaKr9Spe6nMdUGRfVXh/BYU/r8P2rx/GdH9DRMO', 4, 0, 0, 1, '2021-04-16 00:00:00', NULL, NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, 4, 'en', NULL, NULL, NULL, NULL, '3f20deb3ce15c651d5676c308ce3b034f1d72338cb17f47f2dd48f08e340e8baeb2c96c70a5f2a06d5e1bda88621d19f60e989d7b5a762840e6a83178f4787b747bede28bc4acae25533fec664a1c8076b8942061b602fd222fd5a9bfd02c661a05cf4c08a6a5c6140da9773aa4a84b958ca53afe760d16fdc357e335ba2313bb1955e3f9170af7e22a9b2b00a676678a3b2fe1abf867e9a1b9c7cca0cb167844ce7a9379f1f8683f5c08ebcea741096b51f3efe', 'ewan', 0),
(7, 'Alex', 'Miskolczi', 'tsunami468@gmail.com', 'No bio', '$2y$10$FQmxMcImIR732IdPr3sgI./FAomxz7yiPYHYhtpzO0rjYhvsAmIM6', 21, 0, 1, 0, '2021-04-18 00:00:00', NULL, NULL, 'user-content/profile/20210313_160001.jpg', 'image/cover.jpeg', 1, NULL, 'en', NULL, NULL, NULL, NULL, '0815430a590dc8a18110de263d0271a58c6267c47c5bd4c15ac1407b9d99dbbccdc9020a0d37644659e57c688c9dc794cc2757311e382d6dfdb04770bc59946e058bee0eb0ba8bf292349f58048dc3e3c270304ad7e33726c97078a7b4d48582094325eed9e0de92c4445dde29ae9a48855f29a57bc84c2090076924fdde04e26abc83ad6a65e4d5d1936a864b25752ae3d22cb2e403756312d33f7f14135aa9207b8405fd05e63d75d702d8e2a8c67f250f11c1', 'alex', 0),
(10, 'Sofia', 'Tori', 'sofiatori03@gmail.com', 'No bio', '$2y$10$mWgl6M1LSi6WvNblfapKiuJ49aOZ6L3GkNUqqdAwlV6kGwTtkykwW', 7, 0, 0, 0, '2021-05-04 00:00:00', NULL, NULL, 'user-content/profile/O9cDVYG__400x400.jpg', 'image/cover.jpeg', 1, 24, 'en', NULL, NULL, NULL, NULL, 'b610b1a83e6df2b3872837c44cf4b625cf8821347d82c1960274b7f1bd15241357655751511d44265e26332f1f185e818ffa2fbf6aa78e3dc55b9ccc2695b2bb86ea0dc17b5f1bfbe8e5b5c1444559f177ef8f27dfc41bb9521407f7c789d1dde35f5aa5fa6764dc5466663d14fb325346133f6d886ff4c5a350fb1ad1f7c4dc92d4e008605140999bfdf2db1f5f60fd022348f0853595034b23f3db176b899c6411a402d2e1f1ae57f32dee3e17aae92ce5b3c2', 'sofia', 0),
(12, 'Aron', 'Kumar', 'aron@aron', 'My bio is so cool :) ', '$2y$10$mWgl6M1LSi6WvNblfapKiuJ49aOZ6L3GkNUqqdAwlV6kGwTtkykwW', 32, 1, 0, 0, '2021-04-14 00:00:00', '2004-06-20 09:15:05', 'Northampton', 'user-content/profile/aron.jpg', 'image/cover.jpeg', 1, 25, 'en', NULL, -1, NULL, NULL, '084cfab69401826eafb1832cd462af10cb940fe863bb86c9b2b247ad1a148b44d11df569465ff82d7cdc10a0eaf990b6ff73f804b6325d2e695ce0021118e32d8fad6c4fe338ae81a8580d99bf18af24036cc53f8aba758c8be309781d490e10acea6ef3aa2e299818965d719684b9715c4cdbaf01c4e7fded996cd18c46269fdd844cbd85e800e3462676c1dd8a3d0f7a630bca529f3e3729d25ddd59439ca5ff496315873cc1425a31e6e547152a1f9ca966c9', 'aron', 0),
(31, 'Ricards', 'Bistrovs', 'Richard.bistrovs@gmail.com', 'No bio', '$2y$10$mWgl6M1LSi6WvNblfapKiuJ49aOZ6L3GkNUqqdAwlV6kGwTtkykwW', 21, 0, 0, 1, '2021-05-14 00:00:00', NULL, NULL, 'user-content/profile/ric.jpg', 'image/cover.jpeg', 0, NULL, 'en', 0, NULL, NULL, NULL, 'e7099176d285aaa406ef749d69e7acbb1d98230a054163c2b57f7e48f938ba82035528d74f43a887857a8c60298cb11b5db4048e8ca44ec69530fa2ff66e567b2440c543b42dcd651ae75435072d5613b27f08cf5b94448d7152166688f8dba05d2736da6869d17bdc959e21e87bd8a065c97d3458e29c1620104a4df35efad67767d39f0f15e0a6b516cef02268caf9700afc3312187bc45aa6a1f26da4f8cee7d2ce97b7c5b39439d940ea70acb47fb55e781d', 'ricards', 0),
(32, 'Sandu ', 'Dover', '123@gmail.com', 'No bio', '$2y$10$zZq3pfrvefBxRsw6yi4JWeNRlfONLS/1ZDW7WQm07mGzRwDkSKy8C', 5, 0, 0, 1, '2021-05-14 00:00:00', NULL, NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, NULL, 'en', 0, NULL, NULL, NULL, 'c499b45d8a949c9fef319f90b3918b5a4cd58d67dc7a801d8520e861403b9d9318598039f992a0d05b61fe09a32881e5396adc24c295d0e3d41fd914518c8251266c32b2397e937085f74cb3aead86ca852529d7375e1979d639e0163173f3aa7cccb984ae1f011aa37bd7598867e267589d86e3f2cd1c29f0f0074ec75b0a2de8ec1274ca0ced7aa6c6e6b388f611baf2e74fa1c48d693e19eef65b0d7d30109bc26219c8f75d9b811e26e239cf7b41464e0c6f', 'sandu', 0),
(33, 'Leena', 'Mansouri', 'abs-15lema@abbeyfielschool.org.uk', 'No bio', '$2y$10$qvach5m9SJ2Dg/M/b/D2nuIbEqp1jduaDTtOsJCg.Qlev9MlmlFdu', 3, 0, 0, 1, '2021-05-14 00:00:00', NULL, NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, NULL, 'en', 0, NULL, NULL, NULL, 'c6dd75225a46b60e9209a95ab887f46c475a4d693d77c589f75041f43da9434c4b5d04f0e039cabce278eb70685b6b6613c4b166d36a6dd3eda6d86f25f1ed74761d2208af6f8bb1e7a7293761a411b086d4a423c1a9dc5f1bd91ba99b1e2e4dcbff40998ebbb293270a22d73d25f80d6147da237a1cd6e21005cd5920b352c9a91e44637b12405a4ab684216d0281fc0a6b9e20e959b3146e889e816d5460f74b45a3deb70ceeaff528d78fe4544723b96212b3', 'leena', 0),
(34, 'Bbb', 'Bbb', 'bbb@bbb', 'No bio', '$2y$10$wQoFgxhhAZTbmkMebZsj.OU1T.L2hSgYg8RRfTaHsKUQj6m0s.eQG', 0, 0, 0, 1, '2021-05-17 00:00:00', NULL, NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, NULL, 'en', 0, NULL, NULL, NULL, '56740fc868425b837a31304fa6341ef8a4ff7191e3e8d13f3bc953c1235b60035079d875a3e1dfb193cfe5fee394cf67befd60baa26bdfda363bdad08ded075609dfe75b154c4b4847e87a81fddaff32e44dd479a3e01cf162fec0538e92e38a3b6aec3e1b34f813708f8dd4038df97edc136da00578f9b661e447736b3bc29dfa3abfafb71ca88fcb68d97a25e3ebf73fb4dcd0dff9fb34495ea68f505db8920015d65bc9ab0fafa73cc8b15803640adee9c75c', 'bbb', 0),
(35, 'Joe', 'Monk', 'joey@monk', 'No bio', '$2y$10$mWgl6M1LSi6WvNblfapKiuJ49aOZ6L3GkNUqqdAwlV6kGwTtkykwW', 56, 1, 0, 0, '2021-05-19 00:00:00', NULL, NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, NULL, 'en', 0, -1, NULL, NULL, '4e183264d6887af7c1f15bafbfe14535e436721a1fa0edff3d47b3d2dc555d6ee966d1ded0b4d75d3ad5235b98ca0c6328c1767641633dc795e665d9460a4d6d549c88c7d886d42ebb03d4971fd5e66110a1c4d683e48e34144da5472c1af0b08f83d903f4f107e5cc88384eff84ad359bdfc2bf265ee8b87caa1ab0fa52f602681f2c95e615e3027f32a988e97ad5f70e053b38edc2d99e43314bfdc779f019a1cc3c9e4ccace3b28798d35677973a710d960a8', 'joe', 0),
(37, 'Peter', 'Koszpek', 'shadowpeet@gmail.com', 'No bio', '$2y$10$RasW7OjPYmTS54fFWUqggOboRFiPpFakxuSETlKXO4RKaojxkPaG6', 0, 0, 0, 1, '2021-05-24 00:00:00', NULL, NULL, 'user-content/profile/peter.jpg', 'image/cover.jpeg', 1, NULL, 'en', 0, NULL, NULL, NULL, '5e3ecc5659cc15f29ea30db7d989d947bd055eb8b05ec522ea8c191d1e4391b03eb4ee300361249f1f66f0142f7780e87fa8b278a51102af8ed12e14b3de7be94df313421010e4df4873afafd98aa93ca83382cc4ab94c849fdf38d15a19e3aa6ad0720d5ddd0a75a658193788254c81cbbb466abb2db32c7e91585d3796dca68af79280c525c2a9b3eb967157ef14b2692df41c617bd9eb9a9d15a964b1011be9fe25e987864d153a6beeedf834efbe1597e634', 'peter', 0),
(38, 'Dave', 'Kruts 💦', 'deivskrutsofficial@gmail.com', 'No bio', '$2y$10$3UMwTzdezb6mUNcO.Yqld.BXXvFagkrCG9wCe5NckTVxWIIkzYRnG', 3, 0, 0, 1, '2021-05-28 00:00:00', NULL, NULL, 'user-content/profile/Snapchat-766811104.jpg', 'image/cover.jpeg', 1, NULL, 'en', 0, NULL, NULL, NULL, 'd8e1a93747ec7372445fe0193dcaa6101dfc72706eab001758e784184cd77e97a659342ac0560d4dc7f8e4d5f28acfbb06d028b7b13ef397ef55c560e7eef8550360a7d47baca7141b23dba740ffdb1151327b29df4c4f434662655ee6c5bc3ded99e1783db48c9d5a772b5cc8dd0a4364bbb6d2b94b646bf30e80ab7d402aef969cd4e437117009046d1cbf1485e7d371f6c3edb5b20828832f97d19fec4fa5450855575a538db81e036e77f73a47ccfe5a54a0', 'dave', 0),
(39, 'Dominik', 'Koszpek', 'dominikmarine@gmail.com', 'No bio', '$2y$10$iGjgTmWmokOJpVmB18X6qebkzz5.vMB4DFezdjrteb1kYJrX6mqmG', 4, 0, 0, 1, '2021-06-01 00:00:00', NULL, NULL, 'user-content/profile/unknown.png', 'image/cover.jpeg', 1, 2, 'en', 0, NULL, NULL, NULL, 'a1e2581eea4d7ac4be62c1381e40328b03b5f2156198ca6b14cd0f665bbc4c7650129838839b7a706c451cb50bb1d319f672de466a34a5e099959bbb8a341be2411958abbf9a5fbdf370f09c8f142ae2f7d6a7c848b1d5521c963154810c3ea040d3c5c781cbf96e9695677dfef428e88099efd95ba8a515dfcfad247cf63525b24d1f5044c6e594b9d10eab9db72d047115c5757b82ea6357d400e7a39eb6569449b20eee9c062510854b0bf46a3a7f3cc24b9b', 'dominik', 0),
(40, 'Peee', 'Peeeee', 'eppepep@pepepepep', 'No bio', '$2y$10$mWgl6M1LSi6WvNblfapKiuJ49aOZ6L3GkNUqqdAwlV6kGwTtkykwW', 0, 0, 0, 0, '2021-06-01 00:00:00', NULL, NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, NULL, 'en', 0, NULL, NULL, NULL, '3261534f4f366f1e630b5c647737374a93335eaecf6ddda7cffb5e965613089f935c2ec2590c3776123c17b06ec7ebdebf033cf23fb7abb4666b5902bef27bddba8d5a78e5fd055e1a7cfeb97fe0778afa7f551f52271f6ad82d8b5ddc2da67eaf7efd8b6e6f42706d32f344d44b64c1fc0a563c7b259e9709a60ff196d814b3c7a1fe45310a2244ed28e448c868c43fb9f872403d81234b4524cd084086e3648d7b6ff4a3c15979ce2a2e2800871bfda19bc813', 'pee', 0),
(41, 'Fafa', 'Fafa', 'fafa@fafa', 'No bio', '$2y$10$Vl5yMCk9vMkNMFmXJS0yOu9T/1LZ7RJUTXMOdVfb7DL4oqVnsmC7W', 0, 0, 0, 0, '2021-06-01 00:00:00', NULL, NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, NULL, 'en', 0, NULL, NULL, NULL, '324f8b1aa32aae8c3fa95a9feffdfe0d35e3768ca4f39ccaa8971403e13b0381b924ea777a55f7e7268e9d67249b91b19694e01201fdb5d8422e3a15227586e779d2403313a8dee33a23428f6a5a0519f513e867bbf9600cc383d19ff3c2d1a9efef716fabd0d6be95dd54e39df5fae6c9f3d6fe6cc514738f3143e4d120f5ad5b58ae3466999205b7f2cd14afb203fb4ba44c74347d16b8c295fa9094993fd1e55d5dc4350abf1798a8d77e1ed68694ef0e318c', 'fafa', 0),
(42, 'Serious', 'Guy', 'ah@ah', 'No bio', '$2y$10$AJReeWsomLxZ3lOf5j6ouO/bn/ZRBNBX/gNGZcetkX64tOJsVbKEO', 1, 0, 0, 0, '2021-06-09 00:00:00', NULL, NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, NULL, 'en', 0, NULL, NULL, NULL, 'b03ceb19d74768561f6414c914c2e527fed2ed647af56b1ec91db238bec45ba14ff7e6218e7e44a2b4b0e6a22e92294719c044758a2332a511e30c413193910bbc96111a0ed797bf0269a3c25e5919ca99172a4a70835625002afb44e3f4369be6db0ad284e0b32f041fe632a0a6d57d49e6f224ea4bbe900f2935e9700fecf2341c9f62e71254ce1e419fc9f1929280e86e2cd4411d480d4b67569fb6834de72100bccc7554bc409de308a868a0327f5b2edfb1', 'serious', 0),
(43, 'Sandu', 'Sula', 'sandusula12@gmail.com', 'No bio', '$2y$10$mp8TKAHtzL/ZCECMLWeV5.vJtSH3o/nBxBSXcOsq4MHoNPvvdURbm', 2, 0, 0, 0, '2021-06-15 00:00:00', NULL, NULL, 'user-content/profile/CF5BCE60-B3CA-46BB-A454-3D34CD21E210.jpeg', 'image/cover.jpeg', 1, 1, 'en', 0, NULL, NULL, NULL, 'bfce36ddcef4aa4d962ee2cb39da6ec38c64649d2269c7ee08dfa33facdd8010bc167473d22384c6a131bd74baae31a488173e0490000977a33aabdc77747500f349b2c3165b6d9340e516ba84ab507f58cdd14d5a458c32bef638580cf810e6fcb6518e40d77640456be25d8d0c049860341c7f971c9807fe5ef4e0507703f89a9294ad9caf764a334f462728778d6365ba9f87d371898d3c226ca673db55c712194e2dcae8d058d9bfba94e9a1ea69d1a4e08e', 'sandu', 0),
(44, 'Andrea', 'Nemeth', 'andreanemeth1981@icloud.com', 'No bio', '$2y$10$FQmxMcImIR732IdPr3sgI./FAomxz7yiPYHYhtpzO0rjYhvsAmIM6', 29, 0, 0, 0, '2021-06-18 00:00:00', NULL, NULL, 'user-content/profile/F0DE8B70-A49B-45CF-94E2-DDED84C1C209.jpeg', 'image/cover.jpeg', 1, 2, 'en', 0, NULL, NULL, NULL, '6405816f44cb5a9086d74ec6e130df6974a2bd26cf7da843503045e194581fd84996b828832a6593627f62f76463dfd4738b814b545ba98e5ae77de61b3cdf1ee0fedb5d72be6b5bbd967ed20be6a750d5352f78cf377de41eb6a8dd92d4742ed51205d81e73a503b3c22d489c241053656c02f19d69bd9bf76cf0caa66de6e7884ab9e1e2ac8dc80c30b8fd126a3a52310ffe902fd6151e7b77bc88d130a2b13a36d5a7425cf28d1b9d62df0099ab7fd513e61a', 'andrea', 0),
(45, 'Chris', 'Tyler', 'cwtyler999@gmail.com', 'No bio', '$2y$10$94XMiep9.cO1.1Qj8VrfF.x9v4xfCSxLQ/tEki6TBCe4j6s23R7Iq', 2, 0, 0, 0, '2021-06-24 00:00:00', NULL, NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, 1, 'en', 0, NULL, NULL, NULL, '39df92574e37c27919593594f204ce98bb66ecbf36e767256186e50e43407edca0bf7d82be6203489839ea505f61c431cc6049064ebb86bdfbd7e4d290af1072bd46f4df941dd14a077fe3893b978fec34a8aa6f8429ed7f05bf56573a99d06e83e25d7a09e4cf4c9906c6c6bd2077921bead25ad19706613ec5bd90ecc4c680525faf3a7085b17f30e7a99c2429e41bd4e4e8d29699b05f3d102d9e10c44f4c14b11692b12ed2a4197bb5a42f45edd5c1636a41', 'chris', 0),
(55, '', '', 'asd@asd', 'No bio', '$2y$10$264yNYwEPHS9eVliB9POkOecNcANvVffZ9NifRjYMpLbGEsp7UbVm', 0, 0, 0, 1, '2021-10-20 00:00:00', NULL, NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, 2, 'en', 0, NULL, NULL, NULL, 'c9ee180430a2872c593142477af7bbcdf04b031eb045710b053dabd80425c66abec863bc72e24231e2d47d6007b710e876eb2ab4178d1cdd92a0d4dd4e82d018fe12777a2c055fdb8babae3ad304a5e29cd3199bf7d4581eac639116c3cd0bbcba26cdfb7853a8aa6cbc8cc52d879b289fabe489271c7622fd3f9cc04cbde36a1d9b1e3d6b79a720164c893b3b57836253dc4f200a5e9d6c376b03ed3373c75c664d8e8f3b1107641adeb03d0d015eef31704ebe', '', NULL),
(56, '', '', 'asd@asd', 'No bio', '$2y$10$264yNYwEPHS9eVliB9POkOecNcANvVffZ9NifRjYMpLbGEsp7UbVm', 0, 0, 0, 1, '2021-10-20 00:00:00', NULL, NULL, 'image/default.jpeg', 'image/cover.jpeg', 1, 0, 'en', 0, NULL, NULL, NULL, 'c9ee180430a2872c593142477af7bbcdf04b031eb045710b053dabd80425c66abec863bc72e24231e2d47d6007b710e876eb2ab4178d1cdd92a0d4dd4e82d018fe12777a2c055fdb8babae3ad304a5e29cd3199bf7d4581eac639116c3cd0bbcba26cdfb7853a8aa6cbc8cc52d879b289fabe489271c7622fd3f9cc04cbde36a1d9b1e3d6b79a720164c893b3b57836253dc4f200a5e9d6c376b03ed3373c75c664d8e8f3b1107641adeb03d0d015eef31704ebe', 'test', NULL),
(57, 'Adrian', 'Koszpek', 'test@test', 'No bio', '$2y$10$rls1Kdd9l6dLYb0TTgSWMONv0oyWGcmB9nFlrVn7M9GbHJ1POXhHW', 268, 0, 0, 0, '2021-10-29 00:00:00', '0000-00-00 00:00:00', '', 'user-content/profile/d187fd731bfb8f60702b741951200c020c460cc35dbdd1841b2199af62ed1621232fd60c6b14e04123bf4eab9880219c3a853a945ecf0db3542a0a3a1745d7579c487a80c08c8999be45b3161b481e6f8040167d19c6caae709b44ab8262da1374d2b47f09a26dba077e69647bbaa13acf7f1ec91c14e7a3.png', 'image/cover.jpeg', 1, 43, 'en', 0, NULL, '', '', 'f4d843b0cd3be488e998034e9a1e0f333987849913cf5d1bc517e1125c37e812023efbaddc18568a3ff4b8fb5b0b9f5d0222a1fa8136a14b0e66ae9a5b3c3bb3869d642f2d36c88b08fd10b69a6333569850e3e974f1462e620e5e41a61e9607e0d895d3bf3810e2af016f7fbcb4be3e5775b08886f29721f6bc036cc2569d1181b702b97ab847514cce24d8bd4287cbeaf0c8f6e29a27eb1730721e9193802ac6fc287507f2b317408091bc54d8fa2342e3c1ee', 'Adrian', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bans`
--
ALTER TABLE `bans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocked`
--
ALTER TABLE `blocked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blockedwords`
--
ALTER TABLE `blockedwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogposts`
--
ALTER TABLE `blogposts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hideposts`
--
ALTER TABLE `hideposts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interactions`
--
ALTER TABLE `interactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinposts`
--
ALTER TABLE `pinposts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shared`
--
ALTER TABLE `shared`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bans`
--
ALTER TABLE `bans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blocked`
--
ALTER TABLE `blocked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `blockedwords`
--
ALTER TABLE `blockedwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blogposts`
--
ALTER TABLE `blogposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `hideposts`
--
ALTER TABLE `hideposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `interactions`
--
ALTER TABLE `interactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4325;

--
-- AUTO_INCREMENT for table `invites`
--
ALTER TABLE `invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `pinposts`
--
ALTER TABLE `pinposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `shared`
--
ALTER TABLE `shared`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
