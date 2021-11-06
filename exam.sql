-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2021 at 08:14 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `f_id` int(10) NOT NULL AUTO_INCREMENT,
  `f_fname` varchar(500) NOT NULL,
  `f_lname` varchar(100) NOT NULL,
  `f_email` varchar(500) NOT NULL,
  `f_password` varchar(500) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`f_id`, `f_fname`, `f_lname`, `f_email`, `f_password`) VALUES
(1, 'Tony', 'Stark', 'tony@gmail.com', 'tony'),
(2, 'Bucky', 'Barnes', 'bucky@gmail.com', 'bucky');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_test_map`
--

DROP TABLE IF EXISTS `faculty_test_map`;
CREATE TABLE IF NOT EXISTS `faculty_test_map` (
  `f_id` int(11) DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL,
  KEY `f_id` (`f_id`),
  KEY `t_id` (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_test_map`
--

INSERT INTO `faculty_test_map` (`f_id`, `t_id`) VALUES
(1, 78),
(1, 84),
(1, 85),
(1, 86);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `t_id` int(100) DEFAULT NULL,
  `q_id` int(100) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  `a` varchar(255) DEFAULT NULL,
  `b` varchar(255) DEFAULT NULL,
  `c` varchar(255) DEFAULT NULL,
  `d` varchar(255) DEFAULT NULL,
  `answer` varchar(255) NOT NULL,
  `marks` int(100) DEFAULT NULL,
  PRIMARY KEY (`q_id`),
  KEY `q_id` (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`t_id`, `q_id`, `question`, `a`, `b`, `c`, `d`, `answer`, `marks`) VALUES
(78, 42, 'Which of the following option leads to the portability and security of Java?', 'Bytecode is executed by JVM', 'The applet makes the Java code secure and portable', 'Use of exception handling', 'Dynamic binding between objects', 'b', 1),
(78, 43, 'Which of the following is not a Java features?', 'Dynamic', 'Architecture Neutral', 'Use of pointers', 'Object-oriented', 'd', 5),
(78, 44, 'The u0021 article referred to as a', 'Unicode escape sequence', 'Octal escape', 'Hexadecimal', 'Line feed', 'c', 3),
(78, 45, 'What is Java?', 'Java', 'Python', 'HTML', 'CSS', 'a', 2),
(84, 52, 'Which of the following browser supports HTML5 in its latest version?', ' Mozilla Firefox', 'Opera', 'Both of the above', 'None of the above', 'a', 10),
(84, 53, 'Which of the following is correct about custom attributes in HTML5?', 'A custom data attribute starts with data- and would be named based on your requirement.', 'You would be able to get the values of these attributes using JavaScript APIs or CSS in similar way as you get for standard attributes.', ' Both of the above.', 'None of the above.', 'a', 10),
(84, 54, 'Which of the following input control represents a date and time (year, month, day, hour, minute, second, fractions of a second) encoded according to ISO 8601 with no time zone information in Web Form 2.0?', 'datetime', 'datetime-local', 'date', ' month', 'b', 10),
(84, 55, ' Which of the following is true about Session Storage in HTML5?', ' HTML5 introduces the sessionStorage attribute which would be used by the sites to add data to the session storage.', 'It will be accessible to any page from the same site opened in that window i.e. session.', 'As soon as you close the window, session would be lost.', ' All of the above.', 'd', 10),
(84, 56, 'Which value of Socket.readyState atribute of WebSocket indicates that the connection has not yet been established?', '0', '1', '2', '3', 'a', 10),
(85, 57, 'Which operator is right-associative', '*', '=', '+', '%', 'b', 2),
(85, 58, 'Which code is used to open a file for binary writing?', '\'w\'', ' \'wb\'', '\'r+\'', '\'a\'', 'b', 2),
(86, 59, 'ques1', 'answer1', 'answer2', 'answer3', 'answer4', 'a', 1),
(86, 60, 'ques2', 'option1', 'option2', 'option3', 'option4', 'a', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `s_id` int(100) NOT NULL AUTO_INCREMENT,
  `s_fname` varchar(500) NOT NULL,
  `s_lname` varchar(500) NOT NULL,
  `s_gender` varchar(10) NOT NULL,
  `s_phone` int(10) NOT NULL,
  `s_dob` date NOT NULL,
  `s_email` varchar(500) NOT NULL,
  `s_password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `s_fname`, `s_lname`, `s_gender`, `s_phone`, `s_dob`, `s_email`, `s_password`) VALUES
(1, 'Arpita', 'Kar', 'Female', 2147483647, '2021-10-06', 'arpita@gmail.com', '$2y$10$UIGUGo1TzPIFXpRDiArDeuSdHzHg94xh7cIbMKXILn.nyDPO0vAgS'),
(2, 'Sadiya', 'Shaikh', 'Female', 1234567891, '2021-10-30', 'sadiya@gmail.com', '$2y$10$arl.w4pJo3SL1xnICgWvluuWFHPvTmvMdbK5c1jO/.iLwwoyQOsyy'),
(3, 'Sprash', 'Bindro', 'Male', 2147483647, '2021-10-03', 'sparsh@gmail.com', '$2y$10$gye.OxVVWR5GlvbUA1Edwe.bftE.64t.Zp/TMIuyx6DJKJSDkQmc.');

-- --------------------------------------------------------

--
-- Table structure for table `student_answer`
--

DROP TABLE IF EXISTS `student_answer`;
CREATE TABLE IF NOT EXISTS `student_answer` (
  `t_id` int(100) DEFAULT NULL,
  `q_id` int(100) DEFAULT NULL,
  `answer` varchar(255) NOT NULL,
  `sans` varchar(255) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  KEY `fk_t_id` (`t_id`),
  KEY `fk_q_id` (`q_id`),
  KEY `fk_s_id` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_answer`
--

INSERT INTO `student_answer` (`t_id`, `q_id`, `answer`, `sans`, `s_id`) VALUES
(78, 42, 'b', 'b', 1),
(78, 43, 'd', 'd', 1),
(78, 44, 'c', 'c', 1),
(78, 45, 'a', 'b', 1),
(84, 52, 'a', 'a', 1),
(84, 53, 'a', 'a', 1),
(84, 54, 'b', 'b', 1),
(84, 55, 'd', 'd', 1),
(84, 56, 'a', 'a', 1),
(85, 57, 'b', 'b', 1),
(85, 58, 'b', 'b', 1),
(86, 60, 'd', 'a', 1),
(86, 59, 'a', 'a', 1),
(85, 58, 'b', 'b', 1),
(85, 57, 'b', 'a', 1),
(78, 42, 'b', 'a', 1),
(78, 43, 'd', 'b', 1),
(78, 44, 'c', 'c', 1),
(78, 45, 'a', 'a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_test_map`
--

DROP TABLE IF EXISTS `student_test_map`;
CREATE TABLE IF NOT EXISTS `student_test_map` (
  `s_id` int(100) DEFAULT NULL,
  `t_id` int(100) DEFAULT NULL,
  `seat_no` varchar(100) DEFAULT NULL,
  `attendence` varchar(50) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `marks_scored` int(100) DEFAULT NULL,
  `pass_fail` varchar(100) DEFAULT NULL,
  `wrong_answer` int(100) DEFAULT NULL,
  `right_answer` int(100) DEFAULT NULL,
  `percentage` float DEFAULT NULL,
  KEY `s_id` (`s_id`),
  KEY `t_id` (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_test_map`
--

INSERT INTO `student_test_map` (`s_id`, `t_id`, `seat_no`, `attendence`, `date`, `time`, `marks_scored`, `pass_fail`, `wrong_answer`, `right_answer`, `percentage`) VALUES
(1, 78, '12344', 'Yes', '2021-Nov-Sun', '01:22:16', 14, 'Pass', 3, 5, 127.27),
(1, 85, NULL, 'Yes', '2021-Nov-Sun', '01:31:20', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `t_id` int(100) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` int(255) NOT NULL,
  `total_marks` int(100) NOT NULL,
  `total_ques` int(100) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`t_id`, `t_name`, `date`, `time`, `total_marks`, `total_ques`) VALUES
(78, 'Java', '2021-10-29', 1, 11, 4),
(84, 'HTML', '2021-10-31', 2, 50, 5),
(85, 'Python', '2021-10-29', 1, 4, 3),
(86, 'Test1', '2021-11-07', 3, 3, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculty_test_map`
--
ALTER TABLE `faculty_test_map`
  ADD CONSTRAINT `f_id` FOREIGN KEY (`f_id`) REFERENCES `faculty` (`f_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_id` FOREIGN KEY (`t_id`) REFERENCES `test` (`t_id`) ON DELETE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `q_id` FOREIGN KEY (`t_id`) REFERENCES `test` (`t_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `test` (`t_id`);

--
-- Constraints for table `student_answer`
--
ALTER TABLE `student_answer`
  ADD CONSTRAINT `fk_q_id` FOREIGN KEY (`q_id`) REFERENCES `question` (`q_id`),
  ADD CONSTRAINT `fk_s_id` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`),
  ADD CONSTRAINT `fk_t_id` FOREIGN KEY (`t_id`) REFERENCES `test` (`t_id`);

--
-- Constraints for table `student_test_map`
--
ALTER TABLE `student_test_map`
  ADD CONSTRAINT `student_test_map_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_test_map_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `test` (`t_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
