-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2022 at 11:18 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs005`
--
CREATE DATABASE IF NOT EXISTS `cs005` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cs005`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersFirstName` varchar(128) NOT NULL,
  `usersMiddleName` varchar(50) NOT NULL,
  `usersLastName` varchar(128) NOT NULL,
  `usersSuffix` varchar(10) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(20) NOT NULL,
  `usersPassword` varchar(128) NOT NULL,
  `usersPwdDate` date NOT NULL,
  `usersOtp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersFirstName`, `usersMiddleName`, `usersLastName`, `usersSuffix`, `usersEmail`, `usersUid`, `usersPassword`, `usersPwdDate`, `usersOtp`) VALUES
(61, 'Hannah Andrea', '', 'Austin', '', 'andrea.austin@gmail.com', 'andrea', '$2y$10$q3Qh0nDeiONu6zMIYfpHX.m4IMFs.gxFqIidGt4nKqmIhrIQTi5.q', '2022-03-05', 0),
(67, 'Rosalyn', '', 'Quenca', '', 'rose@gmail.com', 'Rosal_08', '$2y$10$sYtmTDyTKLvHmFKPrAMEiu5veLfb.WpfxVLMWBWkbqNXTCXYARYNm', '2022-03-06', 0),
(69, 'Bobby', '', 'Reyes', '', 'bobby.reyes00@gmail.com', 'bobby001', '$2y$10$BeSBgSfFELliqCabvx2fzONYwHV5ovMCKqKd8R9n.fVzMiTnPG5BO', '2022-03-07', 0),
(70, 'Caroline', '', 'Dizon', '', 'caroli.dizon003@gmail.com', 'caroline_67', '$2y$10$J9eU6DVjww58Rk.ibl5p7OWIRa8IPetDtkOqp9U9WBhAvLh/0SUEu', '2022-03-08', 0),
(76, 'Nathaniel', 'Doe', 'Doyle', 'Sr', 'keep.webpage@gmail.com', 'nathaniel_08', '$2y$10$AjCUZKhEivSTSO0JDDpGUuZdvls1CoYoe1y/U5pASvGGLvhliTfZC', '2022-07-06', 0),
(84, 'test', 'test', 'test', 'test', 'test@gmail.com', 'test_08', '$2y$10$uznusDso7CmBiQmcJbnS8eGBCcAn6CBVm2xHDQYnJ9M1yFD.mYN8C', '2022-06-01', 0),
(85, 'Daniel Joshua ', 'Corpuz ', 'Guzman', 'Jr', 'cdjoshua@gmail.com', 'Djoshcorpuz28', '$2y$10$CZhkoii3HjXrbYVBQJyFaOy2yk8W2SgyzyZeARlXN5VzTbUm6iYPq', '2022-07-08', 0);

--
-- Triggers `users`
--
DROP TRIGGER IF EXISTS `trigger_new_child`;
DELIMITER $$
CREATE TRIGGER `trigger_new_child` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO user_history (pwdUserId, pwdPassword, pwdUpdateDt) 
SELECT usersId, usersPassword, usersPwdDate 
FROM users WHERE usersId = (SELECT MAX(usersId) FROM users)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger_new_child_education`;
DELIMITER $$
CREATE TRIGGER `trigger_new_child_education` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO users_education(userid, degree, year, location, description) 
SELECT usersId, 'Degree Name/Major', 0000, 'Institution Name and Location', 'Description & Additional Details'
FROM users WHERE usersId = (SELECT MAX(usersId) FROM users)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger_new_child_experience`;
DELIMITER $$
CREATE TRIGGER `trigger_new_child_experience` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO users_experience(userid, job, location, startDate, endDate, description) 
SELECT usersId, 'Job Title and Position', 'Company Name & Location', 0000-00-00, 0000-00-00, 'Description & Additional Details'
FROM users WHERE usersId = (SELECT MAX(usersId) FROM users)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger_new_child_info`;
DELIMITER $$
CREATE TRIGGER `trigger_new_child_info` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO users_info(userid) 
SELECT usersId
FROM users WHERE usersId = (SELECT MAX(usersId) FROM users)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger_new_child_message`;
DELIMITER $$
CREATE TRIGGER `trigger_new_child_message` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO users_message(userid) 
SELECT usersId
FROM users WHERE usersId = (SELECT MAX(usersId) FROM users)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger_new_child_service`;
DELIMITER $$
CREATE TRIGGER `trigger_new_child_service` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO users_service(userid, service, description) 
SELECT usersId, 'Service', 'short description about your service'
FROM users WHERE usersId = (SELECT MAX(usersId) FROM users)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger_new_child_share`;
DELIMITER $$
CREATE TRIGGER `trigger_new_child_share` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO users_share(userid, permission) 
SELECT usersId, 0
FROM users WHERE usersId = (SELECT MAX(usersId) FROM users)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger_new_child_skill`;
DELIMITER $$
CREATE TRIGGER `trigger_new_child_skill` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO users_skill(userid, skill, percentage) 
SELECT usersId, 'Skill', '100'
FROM users WHERE usersId = (SELECT MAX(usersId) FROM users)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger_new_child_work`;
DELIMITER $$
CREATE TRIGGER `trigger_new_child_work` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO users_work(userid) 
SELECT usersId
FROM users WHERE usersId = (SELECT MAX(usersId) FROM users)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users_education`
--

DROP TABLE IF EXISTS `users_education`;
CREATE TABLE `users_education` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `degree` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `year` year(4) NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_education`
--

INSERT INTO `users_education` (`id`, `userid`, `degree`, `description`, `year`, `location`) VALUES
(16, 61, 'B.S. in Integrated Science and Technology', 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 2019, 'T.I.P'),
(17, 61, 'Bachelor of Science Computer Science', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia', 2015, 'T.I.P'),
(25, 67, 'Degree Name/Major', 'Description & Additional Details', 0000, 'Institution Name and Location'),
(27, 69, 'Degree Name/Major', 'Description & Additional Details', 0000, 'Institution Name and Location'),
(28, 70, 'Degree Name/Major', 'Description & Additional Details', 0000, 'Institution Name and Location'),
(38, 76, 'Bachelor of Science in Illustration and Design', 'Member, Student Design Association Received the Charles L. Barstow Scholarship for Artistic Excellence', 2013, 'Sacramento City College'),
(54, 84, 'Degree Name/Major', 'Description & Additional Details', 0000, 'Institution Name and Location'),
(56, 85, 'Bachelor of Science in Illustration and Design', 'Member, Student Design Association Received the Charles L. Barstow Scholarship for Artistic Excellence', 2013, 'Sacramento City College');

-- --------------------------------------------------------

--
-- Table structure for table `users_experience`
--

DROP TABLE IF EXISTS `users_experience`;
CREATE TABLE `users_experience` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `job` varchar(250) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_experience`
--

INSERT INTO `users_experience` (`id`, `userid`, `job`, `startDate`, `endDate`, `description`, `location`) VALUES
(11, 61, 'SOFTWARE ENGINEER', '0000-00-00', '0000-00-00', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 'Googel'),
(21, 67, 'Job Title and Position', '0000-00-00', '0000-00-00', 'Description & Additional Details', 'Dates Employed'),
(23, 69, 'Job Title and Position', '0000-00-00', '0000-00-00', 'Description & Additional Details', 'Dates Employed'),
(24, 70, 'Job Title and Position', '0000-00-00', '0000-00-00', 'Description & Additional Details', 'Company Name & Location'),
(25, 61, 'SOFTWARE ENGINEER', '0000-00-00', '0000-00-00', 'This is a &lt;strong&gt;example&lt;/strong&gt; if inserting html content in a form. 丸ケ舵井キトメラ第教今 丸ケ舵井キトメラ第教今 丸ケ舵井キトメラ第教今 丸ケ舵井キトメラ第教今.', ''),
(33, 76, 'Illustrator', '2017-05-01', '2020-06-20', 'Developed over 1,000 insightful illustrations for medical manuals.\nBuilt relationships with 10+ stakeholders at clients like Merck, Medtronic, and Siemens to plan and execute on high-volume projects.\nReceived the internal Creative Juices award in 2018 and 2019.', '17 Pork Chops, Inc., Sacramento, CA'),
(38, 76, 'Game Designer', '2014-07-03', '2016-09-12', 'Worked with engineers on developing and maintaining scenario building functionality that redefined design boundaries.\nAuthored and reviewed design documentation.', 'Q2 BFG, Los Angeles, CA'),
(42, 76, 'Graphic Designer', '2016-12-16', '2017-02-20', 'Illustrated a 10-page educational comic book for The American Lung Association.\nDeveloped 250+ graphic design projects, including catalogues and brochures.\nContributed ideas that slashed client costs by 17% in 14 months.', 'D.P. Rice Agency, Sacramento, CA'),
(43, 84, 'Job Title and Position', '0000-00-00', '0000-00-00', 'Description & Additional Details', 'Company Name & Location'),
(44, 76, 'Art Teacher', '2013-08-07', '2014-01-22', 'Taught art classes.\nCovered multiple techniques.', 'University of Southern California, School of Cinematic Arts'),
(46, 85, 'Illustrator', '2017-05-01', '2020-06-20', 'Developed over 1,000 insightful illustrations for medical manuals.\nBuilt relationships with 10+ stakeholders at clients like Merck, Medtronic, and Siemens to plan and execute on high-volume projects.\nReceived the internal Creative Juices award in 2018 and 2019.', '17 Pork Chops, Inc., Sacramento, CA');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

DROP TABLE IF EXISTS `users_info`;
CREATE TABLE `users_info` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `degree` varchar(250) NOT NULL,
  `experience` int(11) NOT NULL,
  `website` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `freelance` varchar(250) NOT NULL,
  `profession` varchar(250) NOT NULL,
  `description1` varchar(350) NOT NULL,
  `description2` varchar(550) NOT NULL,
  `img_home` longblob NOT NULL,
  `img_about` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`id`, `userid`, `age`, `phone`, `city`, `degree`, `experience`, `website`, `email`, `freelance`, `profession`, `description1`, `description2`, `img_home`, `img_about`) VALUES
(10, 61, 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(16, 67, 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(18, 69, 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(19, 70, 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(25, 76, 30, '09191234567', 'New York City', 'Illustration and Design', 6, 'megzgregg.com', 'nathaniel.design@gmail.com', 'Yes', 'Graphic Designer', 'Passionate artist seeking residency at Asheville Museum of Art. As resident artist in Fayetteville, WV, produced a collection of art depicting the 2016 floods, and an award-winning sculpture for the local visitor\'s bureau. Participant in three exhibitions and have held two long-term artist jobs.', 'Art Director with 11 years of experience in Graphic Design and 5+ years of experience in managerial creative positions. Won the 2018 Best Data Visualization Webby Award for HealthFirst.com. Supervised the development of 250+ graphic design projects. Seeking to join The New York Times to spearhead the creation of visually inspiring solutions that satisfy the demands of your readers and amplify the message of your journalism.', '', ''),
(33, 84, 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(34, 85, 30, '09191234567', 'New York City', 'Illustration and Design', 8, 'megzgregg.com', 'nathaniel.design@gmail.com', 'Yes', 'Graphic Designer', 'Passionate artist seeking residency at Asheville Museum of Art. As resident artist in Fayetteville, WV, produced a collection of art depicting the 2016 floods, and an award-winning sculpture for the local visitor\'s bureau. test', 'Art Director with 11 years of experience in Graphic Design and 5+ years of experience in managerial creative positions. Won the 2018 Best Data Visualization Webby Award for HealthFirst.com. Supervised the development of 250+ graphic design projects. Seeking to join The New York Times to spearhead the creation of visually inspiring solutions that satisfy the demands of your readers and amplify the message of your journalism.', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_message`
--

DROP TABLE IF EXISTS `users_message`;
CREATE TABLE `users_message` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `msgr_name` varchar(250) NOT NULL,
  `msgr_email` varchar(250) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_message`
--

INSERT INTO `users_message` (`id`, `userid`, `subject`, `msgr_name`, `msgr_email`, `message`) VALUES
(8, 61, '', '', '', ''),
(14, 67, '', '', '', ''),
(16, 69, '', '', '', ''),
(17, 70, '', '', '', ''),
(23, 76, '', '', '', ''),
(31, 84, '', '', '', ''),
(32, 85, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_service`
--

DROP TABLE IF EXISTS `users_service`;
CREATE TABLE `users_service` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `service` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `service_link` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_service`
--

INSERT INTO `users_service` (`id`, `userid`, `service`, `description`, `service_link`) VALUES
(8, 61, '&quot; or &quot;&quot;=&quot;', '&quot; or &quot;&quot;=&quot;', '&quot; or &quot;&quot;=&quot;'),
(22, 67, 'Service', 'short description about your service', ''),
(24, 69, 'Service', 'short description about your service', ''),
(25, 70, 'Service', 'short description about your service', ''),
(31, 76, 'Service', 'short description about your service', ''),
(39, 84, 'Service', 'short description about your service', ''),
(41, 85, 'T-Shirts &amp; Merchandise', 'Get T-shirts &amp; merchandise for your business or as a unique gift.', 'megzgregg.com');

-- --------------------------------------------------------

--
-- Table structure for table `users_share`
--

DROP TABLE IF EXISTS `users_share`;
CREATE TABLE `users_share` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `token` text NOT NULL,
  `permission` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_share`
--

INSERT INTO `users_share` (`id`, `userid`, `token`, `permission`) VALUES
(2, 61, '815d492aff58cd940f4d9046166131cdbe1db68b', 0),
(3, 67, '56cd1b661685382a205a9914d8e46a96d5acdf74ffab50b185d62efd2c3cadb6', 1),
(4, 67, '', 0),
(5, 69, '13cb185747402cea18349899cd2a012e98453f79', 1),
(6, 70, 'bfc065ff6c1d5c3601b8c03606b16cd02a416d0e', 0),
(12, 76, '', 0),
(20, 84, '', 0),
(21, 85, '881d636ab02165ce0cf199643f7fdfda0ca1a67b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_skill`
--

DROP TABLE IF EXISTS `users_skill`;
CREATE TABLE `users_skill` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `skill` varchar(250) NOT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_skill`
--

INSERT INTO `users_skill` (`id`, `userid`, `skill`, `percentage`) VALUES
(37, 61, 'Skill', 100),
(44, 67, 'Skill', 100),
(46, 69, 'Skill', 100),
(47, 70, 'Skill', 100),
(56, 76, 'MAGAZINE DESIGN', 68),
(57, 76, 'InDesign', 26),
(65, 84, 'Skill', 100),
(66, 76, 'TECHNICAL ILLUSTRATION', 95),
(67, 76, 'ADOBE CREATIVE SUITE', 85),
(68, 76, 'HTML/CSS', 70),
(69, 85, 'INDESIGN', 90),
(70, 85, 'TECHNICAL ILLUSTRATION', 95),
(71, 85, 'ADOBE CREATIVE SUITE', 85);

-- --------------------------------------------------------

--
-- Table structure for table `users_work`
--

DROP TABLE IF EXISTS `users_work`;
CREATE TABLE `users_work` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `project` varchar(250) NOT NULL,
  `category` varchar(50) NOT NULL,
  `client` varchar(250) NOT NULL,
  `project_date` date NOT NULL,
  `project_url` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `img_work` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_work`
--

INSERT INTO `users_work` (`id`, `userid`, `project`, `category`, `client`, `project_date`, `project_url`, `description`, `img_work`) VALUES
(8, 61, '', '', '', '0000-00-00', '', '', ''),
(20, 67, '', '', '', '0000-00-00', '', '', ''),
(22, 69, 'Sample Title', 'Website', 'ABCD Company', '0000-00-00', 'www.thisisasample.com', 'Lorem ipsum dolor sit amet, id esse singulis eos. No ferri appellantur mel, delenit omnesque vix ad. Magna etiam aeque at vel, eligendi facilisis eam eu, nemore veritus tractatos sea te. Pro vivendo appetere in. Mutat persius voluptua te per. In eum appetere vulputate, vel at unum viris.', ''),
(23, 69, 'Project New', 'Mobile App', 'XYZ Company', '0000-00-00', 'www.website.com', 'Lorem ipsum dolor sit amet, id esse singulis eos. No ferri appellantur mel, delenit omnesque vix ad. Magna etiam aeque at vel, eligendi facilisis eam eu, nemore veritus tractatos sea te. Pro vivendo appetere in. Mutat persius voluptua te per. In eum appetere vulputate, vel at unum viris. Lorem ipsum dolor sit amet, id esse singulis eos. No ferri appellantur mel, delenit omnesque vix ad. Magna etiam aeque at vel, eligendi facilisis eam eu, nemore veritus tractatos sea te. Pro vivendo appetere in.', ''),
(24, 70, '', '', '', '0000-00-00', '', '', ''),
(30, 76, 'Illustria', 'Illustration Design', 'ABC Company', '2022-07-05', 'https://www.google.com/', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', ''),
(39, 84, '', '', '', '0000-00-00', '', '', ''),
(40, 76, 'Trends Illustration', 'Illustration Design', 'ABC Company', '0000-00-00', 'https://www.google.com/', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', ''),
(41, 76, 'Game Illustration', 'Game Design', 'ABC Company', '2022-07-19', 'https://www.google.com/', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', ''),
(43, 85, 'Illustria', 'Illustration Design', 'ABC Company', '2022-07-07', 'https://www.google.com/', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', ''),
(44, 85, 'Game Illustration', 'Illustration', 'DEF Company', '2022-04-05', 'https://www.google.com/', 'Lorem ipsum dolor sit amet, mei at aeque scripta praesent, nam id docendi electram. Liber populo perfecto ea mea, ex usu wisi suscipit, ex usu omnium apeirian. Id mel homero aliquip, meis dicta mel ea.', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_history`
--

DROP TABLE IF EXISTS `user_history`;
CREATE TABLE `user_history` (
  `pwdId` int(11) NOT NULL,
  `pwdUserId` int(11) NOT NULL,
  `pwdPassword` varchar(128) NOT NULL,
  `pwdUpdateDt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_history`
--

INSERT INTO `user_history` (`pwdId`, `pwdUserId`, `pwdPassword`, `pwdUpdateDt`) VALUES
(74, 61, '$2y$10$q3Qh0nDeiONu6zMIYfpHX.m4IMFs.gxFqIidGt4nKqmIhrIQTi5.q', '2022-03-05'),
(80, 67, '$2y$10$sYtmTDyTKLvHmFKPrAMEiu5veLfb.WpfxVLMWBWkbqNXTCXYARYNm', '2022-03-06'),
(82, 69, '$2y$10$BeSBgSfFELliqCabvx2fzONYwHV5ovMCKqKd8R9n.fVzMiTnPG5BO', '2022-03-07'),
(83, 70, '$2y$10$J9eU6DVjww58Rk.ibl5p7OWIRa8IPetDtkOqp9U9WBhAvLh/0SUEu', '2022-03-08'),
(90, 76, '$2y$10$AjCUZKhEivSTSO0JDDpGUuZdvls1CoYoe1y/U5pASvGGLvhliTfZC', '2022-07-06'),
(98, 84, '$2y$10$uznusDso7CmBiQmcJbnS8eGBCcAn6CBVm2xHDQYnJ9M1yFD.mYN8C', '2022-07-08'),
(99, 85, '$2y$10$TZiG6RwCPnl19BnVkBBmd.pB21YJXeA0WhbiD7AwjPPadPklr47Pa', '2022-07-08'),
(100, 85, '$2y$10$CZhkoii3HjXrbYVBQJyFaOy2yk8W2SgyzyZeARlXN5VzTbUm6iYPq', '2022-07-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`),
  ADD UNIQUE KEY `username` (`usersUid`),
  ADD UNIQUE KEY `email` (`usersEmail`);

--
-- Indexes for table `users_education`
--
ALTER TABLE `users_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid_education` (`userid`);

--
-- Indexes for table `users_experience`
--
ALTER TABLE `users_experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid_experience` (`userid`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid_info` (`userid`);

--
-- Indexes for table `users_message`
--
ALTER TABLE `users_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid_message` (`userid`);

--
-- Indexes for table `users_service`
--
ALTER TABLE `users_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid_servicec` (`userid`);

--
-- Indexes for table `users_share`
--
ALTER TABLE `users_share`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid_share` (`userid`);

--
-- Indexes for table `users_skill`
--
ALTER TABLE `users_skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid_skill` (`userid`);

--
-- Indexes for table `users_work`
--
ALTER TABLE `users_work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workid_information` (`userid`);

--
-- Indexes for table `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`pwdId`),
  ADD KEY `userid_history_fk` (`pwdUserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `users_education`
--
ALTER TABLE `users_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users_experience`
--
ALTER TABLE `users_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users_message`
--
ALTER TABLE `users_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users_service`
--
ALTER TABLE `users_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users_share`
--
ALTER TABLE `users_share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users_skill`
--
ALTER TABLE `users_skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users_work`
--
ALTER TABLE `users_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user_history`
--
ALTER TABLE `user_history`
  MODIFY `pwdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_education`
--
ALTER TABLE `users_education`
  ADD CONSTRAINT `userid_education` FOREIGN KEY (`userid`) REFERENCES `users` (`usersId`) ON DELETE CASCADE;

--
-- Constraints for table `users_experience`
--
ALTER TABLE `users_experience`
  ADD CONSTRAINT `userid_experience` FOREIGN KEY (`userid`) REFERENCES `users` (`usersId`) ON DELETE CASCADE;

--
-- Constraints for table `users_info`
--
ALTER TABLE `users_info`
  ADD CONSTRAINT `userid_info` FOREIGN KEY (`userid`) REFERENCES `users` (`usersId`) ON DELETE CASCADE;

--
-- Constraints for table `users_message`
--
ALTER TABLE `users_message`
  ADD CONSTRAINT `userid_message` FOREIGN KEY (`userid`) REFERENCES `users` (`usersId`) ON DELETE CASCADE;

--
-- Constraints for table `users_service`
--
ALTER TABLE `users_service`
  ADD CONSTRAINT `userid_servicec` FOREIGN KEY (`userid`) REFERENCES `users` (`usersId`) ON DELETE CASCADE;

--
-- Constraints for table `users_share`
--
ALTER TABLE `users_share`
  ADD CONSTRAINT `userid_share` FOREIGN KEY (`userid`) REFERENCES `users` (`usersId`) ON DELETE CASCADE;

--
-- Constraints for table `users_skill`
--
ALTER TABLE `users_skill`
  ADD CONSTRAINT `userid_skill` FOREIGN KEY (`userid`) REFERENCES `users` (`usersId`) ON DELETE CASCADE;

--
-- Constraints for table `users_work`
--
ALTER TABLE `users_work`
  ADD CONSTRAINT `userid_work` FOREIGN KEY (`userid`) REFERENCES `users` (`usersId`) ON DELETE CASCADE;

--
-- Constraints for table `user_history`
--
ALTER TABLE `user_history`
  ADD CONSTRAINT `userid_history_fk` FOREIGN KEY (`pwdUserId`) REFERENCES `users` (`usersId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
