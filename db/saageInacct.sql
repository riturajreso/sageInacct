-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2021 at 02:46 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.2.28-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saageInacct`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cid` int(10) NOT NULL,
  `cname` varchar(250) NOT NULL,
  `cdetails` text NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cid`, `cname`, `cdetails`, `isActive`) VALUES
(1, 'PHP', 'Web Development', 1),
(2, 'JAVA', '', 1),
(3, 'C', '', 1),
(4, 'Python', '', 1),
(5, 'AngularJs', '', 1),
(6, 'ReactJs\r\n', '', 1),
(7, 'AWS', '', 1),
(8, 'Azure', '', 1),
(9, 'GCP', '', 1),
(10, 'Docker', '', 1),
(11, 'Jenkins', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_registration`
--

CREATE TABLE `course_registration` (
  `crse_stu_mapping_id` int(10) NOT NULL,
  `stud_id` int(10) NOT NULL,
  `cousre_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_registration`
--

INSERT INTO `course_registration` (`crse_stu_mapping_id`, `stud_id`, `cousre_id`) VALUES
(0, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `stu_id` int(11) NOT NULL,
  `stu_name` varchar(250) NOT NULL,
  `stu_Lname` varchar(250) NOT NULL,
  `stu_phn` int(10) NOT NULL,
  `stu_dob` date NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`stu_id`, `stu_name`, `stu_Lname`, `stu_phn`, `stu_dob`, `isActive`) VALUES
(1, 'Ritu', 'Raj', 2147483647, '1996-04-10', 1),
(2, 'Aladdin', 'Long', 2147483647, '1967-04-06', 1),
(3, 'Audra', 'Holden', 2147483647, '1985-05-03', 1),
(4, 'Jeremy', 'Santiago', 2147483647, '1987-01-09', 1),
(5, 'Lisandra', 'Fowler', 77880066, '1997-12-06', 1),
(6, 'Eugenia', 'Gonzalez', 2147483647, '2005-04-13', 1),
(7, 'Debra', 'Castro', 2147483647, '1979-06-19', 1),
(8, 'Jameson', 'Cervantes', 2147483647, '2011-06-16', 1),
(9, 'Dominic', 'Henderson', 2147483647, '1983-12-25', 1),
(10, 'Raya', 'Lewis', 2147483647, '1969-02-13', 1),
(11, 'Kevin', 'Petersen', 2147483647, '2011-12-15', 1),
(12, 'Carly', 'Chan', 2147483647, '2006-10-15', 1),
(13, 'Mark', 'Hunter', 1677435766, '2018-09-19', 1),
(14, 'Ulysses', 'Mason', 2147483647, '1967-02-22', 1),
(15, 'Georgia', 'Tillman', 2147483647, '1974-11-24', 1),
(16, 'Karen', 'Walton', 1117205457, '2017-05-21', 1),
(17, 'Lucian', 'Bullock', 2147483647, '1983-10-08', 1),
(18, 'Hollee', 'Velez', 2147483647, '1971-09-29', 1),
(19, 'Paloma', 'Wilkins', 1361482792, '2002-09-19', 1),
(20, 'Yuri', 'Davenport', 2147483647, '2002-12-16', 1),
(21, 'Patrick', 'Lamb', 2147483647, '2019-08-17', 1),
(22, 'Aiko', 'Huff', 2147483647, '1986-11-18', 1),
(23, 'Molly', 'Singleton', 2147483647, '1980-08-31', 1),
(24, 'Charlotte', 'Hughes', 2128145343, '1991-09-26', 1),
(25, 'Diana', 'Copeland', 2147483647, '1969-07-20', 1),
(26, 'Kasimir', 'Roach', 2147483647, '1986-01-08', 1),
(27, 'Jenna', 'Flowers', 2147483647, '1967-12-15', 1),
(28, 'Molly', 'Day', 433358101, '2003-06-01', 1),
(29, 'Ashton', 'Marsh', 563719462, '1976-04-11', 1),
(30, 'Carson', 'Velasquez', 2147483647, '1991-06-07', 1),
(31, 'George', 'Mclaughlin', 2147483647, '1991-03-29', 1),
(32, 'Celeste', 'Holt', 2147483647, '1970-06-23', 1),
(33, 'Louis', 'Mathews', 2147483647, '1969-03-09', 1),
(34, 'Barbara', 'Hughes', 2147483647, '1985-10-09', 1),
(35, 'Judith', 'May', 2147483647, '1992-06-04', 1),
(36, 'Erich', 'Rivas', 2147483647, '1992-06-18', 1),
(37, 'Ulla', 'Morris', 2147483647, '2006-07-06', 1),
(38, 'Blossom', 'Garza', 2147483647, '2001-08-16', 1),
(39, 'Keaton', 'Kane', 2147483647, '1991-01-19', 1),
(40, 'Jakeem', 'Padilla', 2147483647, '2014-11-02', 1),
(41, 'Brenna', 'Drake', 1062087372, '1999-03-12', 1),
(42, 'Keely', 'Valentine', 2147483647, '1991-08-31', 1),
(43, 'Shannon', 'Farmer', 1773421169, '1986-07-22', 1),
(44, 'Pamela', 'Mcdonald', 2147483647, '1996-12-17', 1),
(45, 'Luke', 'Carney', 2147483647, '2016-09-06', 1),
(46, 'Ross', 'Gardner', 2147483647, '1977-05-12', 1),
(47, 'Penelope', 'Haley', 2147483647, '1977-07-22', 1),
(48, 'Hammett', 'Burnett', 2147483647, '1983-09-04', 1),
(49, 'Isadora', 'Morrow', 149905204, '1991-05-24', 1),
(50, 'Quamar', 'Patterson', 731970538, '1973-02-13', 1),
(51, 'Maxine', 'Ross', 2147483647, '1993-06-29', 1),
(52, 'Rafael', 'Salinas', 2147483647, '1989-09-07', 1),
(53, 'Alyssa', 'Hickman', 2147483647, '2010-12-27', 1),
(54, 'Henry', 'Kerr', 2147483647, '2012-01-23', 1),
(55, 'Leonard', 'Ray', 2147483647, '2021-05-13', 1),
(56, 'Colorado', 'Mccarthy', 2147483647, '2009-04-08', 1),
(57, 'Thomas', 'Pope', 2147483647, '1971-01-20', 1),
(58, 'Judah', 'Russell', 369615635, '2012-01-25', 1),
(59, 'Dieter', 'Hill', 2147483647, '2006-07-26', 1),
(60, 'Tyler', 'Beach', 2147483647, '1973-05-12', 1),
(61, 'Meghan', 'Weiss', 770597108, '1968-06-07', 1),
(62, 'Nomlanga', 'Mccullough', 2147483647, '1973-04-26', 1),
(63, 'Fredericka', 'Faulkner', 2147483647, '2004-10-25', 1),
(64, 'Cain', 'Medina', 2147483647, '1969-10-26', 1),
(65, 'Chadwick', 'Bentley', 2147483647, '2016-10-29', 1),
(66, 'Jin', 'Harrington', 665919626, '1980-03-01', 1),
(67, 'Chastity', 'Gardner', 2147483647, '2006-11-11', 1),
(68, 'Debra', 'Sears', 2147483647, '1978-04-29', 1),
(69, 'Walter', 'Hester', 1968469977, '1989-02-26', 1),
(70, 'Orla', 'Atkinson', 2147483647, '2016-06-04', 1),
(71, 'Maile', 'Rush', 70975301, '1997-10-10', 1),
(72, 'Galvin', 'Jensen', 2147483647, '2014-09-22', 1),
(73, 'Dante', 'Stuart', 2147483647, '1988-01-23', 1),
(74, 'Cally', 'Hutchinson', 2147483647, '2004-04-21', 1),
(75, 'Mechelle', 'Peters', 2147483647, '1992-03-14', 1),
(76, 'Steven', 'Rowland', 339534303, '1973-11-29', 1),
(77, 'Rogan', 'Bennett', 1680679432, '2007-04-19', 1),
(78, 'Henry', 'Vasquez', 2147483647, '1987-12-13', 1),
(79, 'Quyn', 'Whitehead', 2147483647, '1967-03-20', 1),
(80, 'Xanthus', 'Brown', 2147483647, '2003-01-14', 1),
(81, 'Igor', 'Dejesus', 2147483647, '1989-06-20', 1),
(82, 'Patrick', 'Clements', 2147483647, '1982-03-08', 1),
(83, 'Keegan', 'Davis', 2147483647, '2016-11-03', 1),
(84, 'Logan', 'Harrell', 2147483647, '1995-10-25', 1),
(85, 'Malcolm', 'Harmon', 2147483647, '2007-09-17', 1),
(86, 'Perry', 'Norris', 2147483647, '2020-09-20', 1),
(87, 'Nigel', 'Hendricks', 597662249, '1986-07-05', 1),
(88, 'Marny', 'Price', 2147483647, '2015-09-03', 1),
(89, 'Richard', 'Lawrence', 1576930900, '2020-10-11', 1),
(90, 'Leonard', 'Kelly', 2147483647, '2005-04-10', 1),
(91, 'Cain', 'Holden', 748815057, '1975-01-31', 1),
(92, 'Kieran', 'Nicholson', 224142002, '2007-09-26', 1),
(93, 'Christian', 'Romero', 2147483647, '1999-03-09', 1),
(94, 'Darrel', 'Lloyd', 1556665728, '1978-04-30', 1),
(95, 'Jayme', 'Watts', 2147483647, '1970-09-23', 1),
(96, 'Ira', 'Hughes', 617113797, '2007-03-13', 1),
(97, 'Jerome', 'Barlow', 2147483647, '2009-07-23', 1),
(98, 'Acton', 'Matthews', 2147483647, '2004-07-05', 1),
(99, 'Denton', 'Holden', 2147483647, '1977-04-11', 1),
(100, 'Emerald', 'Reeves', 2147483647, '1977-11-11', 1),
(101, 'Pandora', 'Haney', 2147483647, '1979-01-09', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`stu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
