-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2016 at 09:48 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `southgatedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccomodation`
--

CREATE TABLE `tblaccomodation` (
  `ACCOMID` int(11) NOT NULL,
  `ACCOMODATION` varchar(30) NOT NULL,
  `ACCOMDESC` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblaccomodation`
--

INSERT INTO `tblaccomodation` (`ACCOMID`, `ACCOMODATION`, `ACCOMDESC`) VALUES
(12, 'Standard Room', ''),
(13, 'Big Room', ''),
(15, 'Deluxe', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblamenities`
--

CREATE TABLE `tblamenities` (
  `AMENID` int(11) NOT NULL,
  `AMENNAME` varchar(125) NOT NULL,
  `AMENDECS` varchar(125) NOT NULL,
  `AMENIMAGE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblguest`
--

CREATE TABLE `tblguest` (
  `GUESTID` int(11) NOT NULL,
  `REFNO` int(11) NOT NULL,
  `G_FNAME` varchar(30) NOT NULL,
  `G_LNAME` varchar(30) NOT NULL,
  `G_CITY` varchar(90) NOT NULL,
  `G_ADDRESS` varchar(90) NOT NULL,
  `DBIRTH` date NOT NULL,
  `G_PHONE` varchar(20) NOT NULL,
  `G_NATIONALITY` varchar(30) NOT NULL,
  `G_COMPANY` varchar(90) NOT NULL,
  `G_CADDRESS` varchar(90) NOT NULL,
  `G_TERMS` tinyint(4) NOT NULL,
  `G_UNAME` varchar(255) NOT NULL,
  `G_PASS` varchar(255) NOT NULL,
  `ZIP` int(11) NOT NULL,
  `LOCATION` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblguest`
--

INSERT INTO `tblguest` (`GUESTID`, `REFNO`, `G_FNAME`, `G_LNAME`, `G_CITY`, `G_ADDRESS`, `DBIRTH`, `G_PHONE`, `G_NATIONALITY`, `G_COMPANY`, `G_CADDRESS`, `G_TERMS`, `G_UNAME`, `G_PASS`, `ZIP`, `LOCATION`) VALUES
(75, 0, 'Janry', 'Octavio', 'Kabankalan City', 'Coloso Street', '1989-11-07', '09123586545', 'Filipino', 'Snappy Trends', 'Coloso Street', 1, 'customer', 'b39f008e318efd2bb988d724a161b61c6909677f', 6111, 'guest/photos/hqdefault.jpg'),
(76, 0, 'Junjie', 'Villanueva', '', 'Coloso Street', '2015-10-15', '09123586545', 'Filipino', 'Snappy Trends', 'Coloso Street', 1, 'junjie', '84c73452a1e22cdaa2964e6302f1883e13cc2715', 6111, ''),
(77, 0, 'John ', 'Snart', 'Legazpi City', 'Gogon Legazpi City', '2016-11-15', '09238433324', 'Filipino', '', '', 1, 'user3', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 4500, 'guest/photos/arkreactor.jpg'),
(78, 0, 'Dominic', 'Ochoa', 'Legazpi City', 'Legazpi City', '2016-11-02', '09323232323', 'Filipino', '', '', 1, 'emmalegson@gmail.com', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 4500, 'guest/photos/c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `SUMMARYID` int(11) NOT NULL,
  `TRANSDATE` datetime NOT NULL,
  `CONFIRMATIONCODE` varchar(30) NOT NULL,
  `PQTY` int(11) NOT NULL,
  `GUESTID` int(11) NOT NULL,
  `SPRICE` double NOT NULL,
  `INSTALLMENT_PRICE` double(10,2) NOT NULL,
  `MSGVIEW` tinyint(1) NOT NULL,
  `STATUS` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`SUMMARYID`, `TRANSDATE`, `CONFIRMATIONCODE`, `PQTY`, `GUESTID`, `SPRICE`, `INSTALLMENT_PRICE`, `MSGVIEW`, `STATUS`) VALUES
(1, '2016-02-17 10:28:20', 'jmrtfpit', 2, 75, 1975, 0.00, 1, 'Checkedout'),
(2, '2016-02-17 02:54:11', '865znauy', 2, 75, 2175, 0.00, 0, 'Checkedout'),
(3, '2016-02-17 04:11:07', 'wttpna26', 1, 75, 725, 0.00, 0, 'Checkedout'),
(4, '2016-02-22 09:07:51', 'ipqib4pw', 1, 76, 615, 0.00, 1, 'Checkedout'),
(5, '2016-02-22 09:33:00', 'd6ktnesr', 2, 76, 1720, 0.00, 1, 'Checkedout'),
(6, '2016-02-22 09:38:33', 'k0vyxcvc', 2, 76, 1340, 0.00, 1, 'Cancelled'),
(7, '2016-11-02 11:37:39', 'fk8rrwv8', 1, 77, 615, 0.00, 0, 'Cancelled'),
(8, '2016-11-04 03:42:59', 'pt2t44cx', 1, 78, 615, 0.00, 1, 'Cancelled'),
(9, '2016-11-07 10:48:48', 'jrjhwa8a', 1, 78, 615, 0.00, 1, 'Cancelled'),
(10, '2016-11-07 11:48:02', 'y0p2ewff', 1, 78, 725, 0.00, 1, 'Cancelled'),
(11, '2016-11-08 08:23:41', 'cunv0g2x', 1, 78, 725, 0.00, 1, 'Cancelled'),
(12, '2016-11-08 08:36:32', 'cg82ti0p', 1, 78, 725, 0.00, 1, 'Cancelled'),
(13, '2016-11-09 01:49:25', 'qnr6pa33', 1, 78, 555, 0.00, 1, 'Cancelled'),
(14, '2016-11-08 02:12:56', 'quyxx6kw', 1, 78, 725, 0.00, 1, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment_image`
--

CREATE TABLE `tblpayment_image` (
  `id` int(10) NOT NULL,
  `imgid` int(10) NOT NULL,
  `CONFIRMATIONCODE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpayment_image`
--

INSERT INTO `tblpayment_image` (`id`, `imgid`, `CONFIRMATIONCODE`) VALUES
(1, 7, 'cg82ti0p'),
(2, 7, 'qnr6pa33'),
(3, 9, 'quyxx6kw');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment_type`
--

CREATE TABLE `tblpayment_type` (
  `CONFIRMATIONCODE` text NOT NULL,
  `ptype` int(2) NOT NULL COMMENT '1=pay total amount 2=installment',
  `pay_status` int(2) NOT NULL COMMENT '1=paid 2=not completely paid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpayment_type`
--

INSERT INTO `tblpayment_type` (`CONFIRMATIONCODE`, `ptype`, `pay_status`) VALUES
('cg82ti0p', 1, 2),
('jmrtfpit', 1, 1),
('ipqib4pw', 1, 1),
('qnr6pa33', 1, 2),
('quyxx6kw', 1, 2),
('d6ktnesr', 1, 1),
('wttpna26', 1, 1),
('865znauy', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblreservation`
--

CREATE TABLE `tblreservation` (
  `RESERVEID` int(11) NOT NULL,
  `CONFIRMATIONCODE` varchar(50) NOT NULL,
  `TRANSDATE` date NOT NULL,
  `ROOMID` int(11) NOT NULL,
  `ARRIVAL` datetime NOT NULL,
  `DEPARTURE` datetime NOT NULL,
  `RPRICE` double NOT NULL,
  `RINSTALLMENT` double(10,2) NOT NULL,
  `GUESTID` int(11) NOT NULL,
  `PRORPOSE` varchar(30) NOT NULL,
  `STATUS` varchar(11) NOT NULL,
  `BOOKDATE` datetime NOT NULL,
  `REMARKS` text NOT NULL,
  `USERID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblreservation`
--

INSERT INTO `tblreservation` (`RESERVEID`, `CONFIRMATIONCODE`, `TRANSDATE`, `ROOMID`, `ARRIVAL`, `DEPARTURE`, `RPRICE`, `RINSTALLMENT`, `GUESTID`, `PRORPOSE`, `STATUS`, `BOOKDATE`, `REMARKS`, `USERID`) VALUES
(1, 'jmrtfpit', '2016-02-17', 16, '2016-02-16 00:00:00', '2016-02-17 00:00:00', 725, 0.00, 75, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0),
(2, 'jmrtfpit', '2016-02-17', 15, '2016-02-16 00:00:00', '2016-02-17 00:00:00', 1250, 0.00, 75, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0),
(3, '865znauy', '2016-02-17', 16, '2016-02-17 00:00:00', '2016-02-19 00:00:00', 1450, 0.00, 75, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0),
(4, '865znauy', '2016-02-17', 12, '2016-02-17 00:00:00', '2016-02-18 00:00:00', 725, 0.00, 75, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0),
(5, 'wttpna26', '2016-02-17', 16, '2016-02-17 00:00:00', '2016-02-17 00:00:00', 725, 0.00, 75, 'Travel', 'Checkedout', '0000-00-00 00:00:00', '', 0),
(6, 'ipqib4pw', '2016-02-22', 11, '2016-02-22 00:00:00', '2016-02-22 00:00:00', 615, 0.00, 76, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0),
(7, 'd6ktnesr', '2016-02-22', 22, '2016-02-22 00:00:00', '2016-02-23 00:00:00', 995, 0.00, 76, 'Travel', 'Checkedout', '0000-00-00 00:00:00', '', 0),
(8, 'd6ktnesr', '2016-02-22', 16, '2016-02-22 00:00:00', '2016-02-23 00:00:00', 725, 0.00, 76, 'Travel', 'Checkedout', '0000-00-00 00:00:00', '', 0),
(9, 'k0vyxcvc', '2016-02-22', 11, '2016-02-22 00:00:00', '2016-02-23 00:00:00', 615, 0.00, 76, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0),
(10, 'k0vyxcvc', '2016-02-22', 12, '2016-02-25 00:00:00', '2016-02-26 00:00:00', 725, 0.00, 76, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0),
(11, 'fk8rrwv8', '2016-11-02', 11, '2016-11-02 00:00:00', '2016-11-02 00:00:00', 615, 0.00, 77, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0),
(12, 'pt2t44cx', '2016-11-04', 11, '2016-11-04 00:00:00', '2016-11-04 00:00:00', 615, 0.00, 78, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0),
(13, 'jrjhwa8a', '2016-11-07', 11, '2016-11-07 00:00:00', '2016-11-07 00:00:00', 615, 0.00, 78, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0),
(14, 'y0p2ewff', '2016-11-07', 16, '2016-11-07 00:00:00', '2016-11-07 00:00:00', 725, 0.00, 78, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0),
(15, 'cunv0g2x', '2016-11-08', 12, '2016-11-08 00:00:00', '2016-11-08 00:00:00', 725, 0.00, 78, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0),
(16, 'cg82ti0p', '2016-11-08', 16, '2016-11-08 00:00:00', '2016-11-09 00:00:00', 725, 0.00, 78, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0),
(17, 'qnr6pa33', '2016-11-09', 18, '2016-11-08 00:00:00', '2016-11-08 00:00:00', 555, 0.00, 78, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0),
(18, 'quyxx6kw', '2016-11-08', 16, '2016-11-08 00:00:00', '2016-11-08 00:00:00', 725, 0.00, 78, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblroom`
--

CREATE TABLE `tblroom` (
  `ROOMID` int(11) NOT NULL,
  `ROOMNUM` int(11) NOT NULL,
  `ACCOMID` int(11) NOT NULL,
  `ROOM` varchar(30) NOT NULL,
  `ROOMDESC` varchar(255) NOT NULL,
  `NUMPERSON` int(11) NOT NULL,
  `PRICE` double NOT NULL,
  `INSTALLMENT_AMOUNT` double(10,2) NOT NULL,
  `ROOMIMAGE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblroom`
--

INSERT INTO `tblroom` (`ROOMID`, `ROOMNUM`, `ACCOMID`, `ROOM`, `ROOMDESC`, `NUMPERSON`, `PRICE`, `INSTALLMENT_AMOUNT`, `ROOMIMAGE`) VALUES
(11, 4, 12, 'Single room', 'Room 306', 1, 615, 0.00, 'rooms/deluxe.png'),
(12, 6, 12, 'Single room', 'Room 212', 2, 725, 0.00, 'rooms/standard.jpg'),
(13, 3, 13, 'Double room', 'Room 213', 2, 445, 0.00, 'rooms/bigroom.jpg'),
(14, 4, 13, 'Double room', 'Room 214', 2, 495, 0.00, 'rooms/standard.jpg'),
(15, 1, 15, 'Family room', 'Room 301', 5, 1250, 0.00, 'rooms/deluxe.png'),
(16, 5, 12, 'Single room', 'Room 220', 1, 725, 0.00, 'rooms/3page-img6.jpg'),
(17, 3, 12, 'Double room', 'Room 221', 2, 835, 0.00, 'rooms/standard.jpg'),
(18, 4, 13, 'Single room', 'Room 304', 1, 555, 0.00, 'rooms/2page-img11.png'),
(19, 3, 13, 'Double room', 'Room 305', 2, 605, 0.00, 'rooms/3page-img7.jpg'),
(20, 3, 12, 'Double room', 'Room 309', 2, 845, 0.00, 'rooms/standard.jpg'),
(21, 3, 13, 'Double room', 'Room 306', 2, 675, 0.00, 'rooms/bigroom.jpg'),
(22, 3, 12, 'Double room', 'Room 310', 2, 995, 0.00, 'rooms/header-bg1.jpg'),
(23, 3, 13, 'Double room', 'Room 307', 2, 895, 0.00, 'rooms/3page-img6.jpg'),
(24, 3, 12, 'Double room', 'Room 311', 2, 1650, 0.00, 'rooms/3page-img3.jpg'),
(25, 3, 13, 'Double room', 'Room 308', 2, 1430, 0.00, 'rooms/3page-img4.jpg'),
(26, 3, 12, 'Double room', 'Room 312', 2, 1350, 0.00, 'rooms/2page-img6.jpg'),
(27, 3, 13, 'Double room', 'Room 321', 2, 1100, 0.00, 'rooms/1page-img1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbluseraccount`
--

CREATE TABLE `tbluseraccount` (
  `USERID` int(11) NOT NULL,
  `UNAME` varchar(30) NOT NULL,
  `USER_NAME` varchar(30) NOT NULL,
  `UPASS` varchar(90) NOT NULL,
  `ROLE` varchar(30) NOT NULL,
  `PHONE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluseraccount`
--

INSERT INTO `tbluseraccount` (`USERID`, `UNAME`, `USER_NAME`, `UPASS`, `ROLE`, `PHONE`) VALUES
(1, 'Anonymous', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 912856478);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_image`
--

CREATE TABLE `tbl_image` (
  `imgid` int(10) NOT NULL,
  `type` text NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_image`
--

INSERT INTO `tbl_image` (`imgid`, `type`, `location`) VALUES
(1, 'image/png', 'img/All_images/2016-11-041.jpg'),
(2, 'image/jpeg', 'img/All_images/2016-11-042.jpg'),
(3, 'image/jpeg', 'img/All_images/2016-11-043.jpg'),
(4, 'image/jpeg', 'img/All_images/2016-11-044.jpg'),
(5, 'image/png', 'img/All_images/2016-11-045.jpg'),
(6, 'image/jpeg', 'img/All_images/2016-11-086.jpg'),
(7, 'image/jpeg', 'img/All_images/2016-11-087.jpg'),
(8, 'image/png', 'img/All_images/2016-11-098.jpg'),
(9, 'image/jpeg', 'img/All_images/2016-11-089.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promos`
--

CREATE TABLE `tbl_promos` (
  `id` int(10) NOT NULL,
  `ROOMID` int(10) NOT NULL,
  `promo_price` float(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `remark` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_promos`
--

INSERT INTO `tbl_promos` (`id`, `ROOMID`, `promo_price`, `start_date`, `end_date`, `remark`) VALUES
(1, 11, 400.00, '2016-11-11', '2016-11-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slide_img`
--

CREATE TABLE `tbl_slide_img` (
  `id` int(10) NOT NULL,
  `imgid` int(10) NOT NULL,
  `status` int(2) NOT NULL COMMENT '1=active 2=inactive',
  `description` text NOT NULL,
  `remark` int(2) NOT NULL COMMENT '1=show 0=hide or remove'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slide_img`
--

INSERT INTO `tbl_slide_img` (`id`, `imgid`, `status`, `description`, `remark`) VALUES
(2, 5, 2, 'Hotel', 1),
(3, 2, 1, 'Welcome to Tanchuling Hotel', 1),
(4, 3, 2, '', 1),
(5, 4, 2, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccomodation`
--
ALTER TABLE `tblaccomodation`
  ADD PRIMARY KEY (`ACCOMID`);

--
-- Indexes for table `tblamenities`
--
ALTER TABLE `tblamenities`
  ADD PRIMARY KEY (`AMENID`);

--
-- Indexes for table `tblguest`
--
ALTER TABLE `tblguest`
  ADD PRIMARY KEY (`GUESTID`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`SUMMARYID`),
  ADD UNIQUE KEY `CONFIRMATIONCODE` (`CONFIRMATIONCODE`),
  ADD KEY `GUESTID` (`GUESTID`);

--
-- Indexes for table `tblpayment_image`
--
ALTER TABLE `tblpayment_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblreservation`
--
ALTER TABLE `tblreservation`
  ADD PRIMARY KEY (`RESERVEID`),
  ADD KEY `ROOMID` (`ROOMID`),
  ADD KEY `GUESTID` (`GUESTID`),
  ADD KEY `CONFIRMATIONCODE` (`CONFIRMATIONCODE`);

--
-- Indexes for table `tblroom`
--
ALTER TABLE `tblroom`
  ADD PRIMARY KEY (`ROOMID`),
  ADD KEY `ACCOMID` (`ACCOMID`);

--
-- Indexes for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  ADD PRIMARY KEY (`USERID`);

--
-- Indexes for table `tbl_image`
--
ALTER TABLE `tbl_image`
  ADD PRIMARY KEY (`imgid`);

--
-- Indexes for table `tbl_promos`
--
ALTER TABLE `tbl_promos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slide_img`
--
ALTER TABLE `tbl_slide_img`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccomodation`
--
ALTER TABLE `tblaccomodation`
  MODIFY `ACCOMID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tblamenities`
--
ALTER TABLE `tblamenities`
  MODIFY `AMENID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblguest`
--
ALTER TABLE `tblguest`
  MODIFY `GUESTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `SUMMARYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tblpayment_image`
--
ALTER TABLE `tblpayment_image`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblreservation`
--
ALTER TABLE `tblreservation`
  MODIFY `RESERVEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tblroom`
--
ALTER TABLE `tblroom`
  MODIFY `ROOMID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_promos`
--
ALTER TABLE `tbl_promos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_slide_img`
--
ALTER TABLE `tbl_slide_img`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblreservation`
--
ALTER TABLE `tblreservation`
  ADD CONSTRAINT `tblreservation_ibfk_1` FOREIGN KEY (`ROOMID`) REFERENCES `tblroom` (`ROOMID`),
  ADD CONSTRAINT `tblreservation_ibfk_2` FOREIGN KEY (`GUESTID`) REFERENCES `tblguest` (`GUESTID`);

--
-- Constraints for table `tblroom`
--
ALTER TABLE `tblroom`
  ADD CONSTRAINT `tblroom_ibfk_1` FOREIGN KEY (`ACCOMID`) REFERENCES `tblaccomodation` (`ACCOMID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
