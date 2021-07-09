-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2021 at 09:03 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-healthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(10) NOT NULL,
  `adminname` varchar(25) NOT NULL,
  `loginid` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  `usertype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `adminname`, `loginid`, `password`, `status`, `usertype`) VALUES
(10, 'Ankit Mishra', 'ankit@gmail.com', 'ankit123', 'Active', ''),
(11, 'Subham Mishra', 'subham', '123456789', 'Active', ''),
(13, 'narayan Mishra', 'manish@gmail.com', '123456789', 'Active', '');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentid` int(10) NOT NULL,
  `appointmenttype` varchar(25) NOT NULL,
  `patientid` int(10) NOT NULL,
  `roomid` int(10) NOT NULL,
  `departmentid` int(10) NOT NULL,
  `appointmentdate` date NOT NULL,
  `appointmenttime` time NOT NULL,
  `doctorid` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `app_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentid`, `appointmenttype`, `patientid`, `roomid`, `departmentid`, `appointmentdate`, `appointmenttime`, `doctorid`, `status`, `app_reason`) VALUES
(139, '', 75, 0, 11, '2021-07-03', '13:16:00', 35, 'Approved', 'mnmnmn'),
(140, '', 81, 0, 11, '2021-07-03', '20:21:00', 35, 'Approved', 'mnmnmn'),
(141, '', 81, 0, 11, '2021-07-04', '09:56:00', 35, 'Approved', 'mmaaa'),
(142, '', 82, 0, 11, '2021-07-04', '10:35:00', 35, 'Approved', 'mnmnmn');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billingid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `billingdate` date NOT NULL,
  `billingtime` time NOT NULL,
  `discount` float(10,2) NOT NULL,
  `taxamount` float(10,2) NOT NULL,
  `discountreason` text NOT NULL,
  `discharge_time` time NOT NULL,
  `discharge_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billingid`, `patientid`, `appointmentid`, `billingdate`, `billingtime`, `discount`, `taxamount`, `discountreason`, `discharge_time`, `discharge_date`) VALUES
(46, 75, 139, '2021-07-03', '09:47:54', 100.00, 0.00, 'mnmnn , ', '10:01:18', '2021-07-03'),
(47, 81, 140, '2021-07-03', '16:54:07', 0.00, 0.00, '', '00:00:00', '0000-00-00'),
(48, 81, 141, '2021-07-04', '06:27:38', 0.00, 0.00, 'manish , ', '10:51:23', '2021-07-04'),
(49, 82, 142, '2021-07-04', '10:35:57', 35.00, 0.00, '565656586565 , ', '07:08:34', '2021-07-04');

-- --------------------------------------------------------

--
-- Table structure for table `billing_records`
--

CREATE TABLE `billing_records` (
  `billingservice_id` int(10) NOT NULL,
  `billingid` int(10) NOT NULL,
  `bill_type_id` int(10) NOT NULL COMMENT 'id of service charge or treatment charge',
  `bill_type` varchar(250) NOT NULL,
  `bill_amount` float(10,2) NOT NULL,
  `bill_date` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_records`
--

INSERT INTO `billing_records` (`billingservice_id`, `billingid`, `bill_type_id`, `bill_type`, `bill_amount`, `bill_date`, `status`) VALUES
(218, 46, 35, 'Consultancy Charge', 700.00, '2021-07-03', 'Active'),
(219, 46, 14, 'Treatment', 20000.00, '2021-07-03', 'Active'),
(220, 46, 106, 'Prescription Charge', 90.00, '2021-07-03', 'Active'),
(221, 47, 35, 'Consultancy Charge', 700.00, '2021-07-03', 'Active'),
(222, 47, 0, 'Treatment', 0.00, '2021-07-03', 'Active'),
(223, 47, 14, 'Treatment', 20000.00, '2021-07-03', 'Active'),
(224, 47, 107, 'Prescription Charge', 300.00, '2021-07-03', 'Active'),
(225, 48, 35, 'Consultancy Charge', 700.00, '2021-07-04', 'Active'),
(226, 48, 13, 'Treatment', 450.00, '2021-07-04', 'Active'),
(227, 48, 108, 'Prescription Charge', 200.00, '2021-07-04', 'Active'),
(228, 48, 14, 'Treatment', 20000.00, '2021-07-04', 'Active'),
(229, 49, 35, 'Consultancy Charge', 700.00, '2021-07-04', 'Active'),
(230, 49, 17, 'Treatment', 5653.00, '2021-07-04', 'Active'),
(231, 49, 109, 'Prescription Charge', 450.00, '2021-07-04', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentid` int(10) NOT NULL,
  `departmentname` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentid`, `departmentname`, `description`, `status`) VALUES
(11, 'Physician', 'All type of disease', 'Active'),
(12, 'Pediatricians', 'All kinds of disease', 'Active'),
(13, 'General Medicne1', 'General doctor', 'Active'),
(14, 'ENT Specialist', 'Ear, Nose and Tongue Doctor', 'Active'),
(15, 'Neurologist', 'Related neurons, bones', 'Active'),
(16, 'Surgery', 'Includes plastic surgery, brain and neurology surgery', 'Active'),
(17, 'Pediatrics', 'Pediatrics doctor', 'Active'),
(18, 'Pharmacy', 'Providing patients with medicines prescribed by specialist physicians', 'Active'),
(19, 'Laboratory and Blood bank', 'Includes detailed lab investigations and blood bank are developing considerably as per international standards  ', 'Active'),
(20, 'Physiotherapy', 'Includes services to specialized clinic inpatients who are referred by hospital physicians or primary health care clinics.', 'Active'),
(42, 'physician11', 'aaaaaaaa', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorid` int(10) NOT NULL,
  `doctorname` varchar(50) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `departmentid` int(10) NOT NULL,
  `loginid` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  `education` varchar(25) NOT NULL,
  `experience` float(11,1) NOT NULL,
  `consultancy_charge` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorid`, `doctorname`, `mobileno`, `departmentid`, `loginid`, `password`, `status`, `education`, `experience`, `consultancy_charge`) VALUES
(35, 'Lokesh Kumar Chopra', '9812453678', 11, 'doctor@gmail.com', '123456789', 'Active', 'MBBS,MD,IDCCM', 7.0, 700.00),
(36, 'Sandeep H S', '8966643980', 12, 'doctor1@gmail.com', '123456789', 'Active', 'MBBS,MD', 5.0, 500.00),
(37, 'Shivshankar', '7894561230', 13, 'doctor2@gmail.com', '123456789', 'Active', 'MBBS,DNB(ORTHO)', 9.0, 300.00),
(39, 'Divya', '8756332456', 15, 'doctor4@gmal.com', '123456789', 'Active', 'MBBS,DNB', 5.0, 250.00),
(40, 'Rashmi', '9876543210', 16, 'doctor5@gmal.com', '123456789', 'Active', 'MBBS,MD', 7.0, 150.00),
(41, 'chaitra', '8785674654', 17, 'doctor6@gmal.com', '123456789', 'Active', 'MBBS,DA', 5.0, 100.00),
(42, 'kamala bhat', '9216549870', 18, 'doctor7@gmal.com', '123456789', 'Active', 'MBBS', 4.0, 250.00),
(43, 'Raam', '9008713415', 19, 'doctor8@gmal.com', '123456789', 'Active', 'MBBS', 5.0, 122.00),
(44, 'Sai kiran', '8548874216', 20, 'doctor9@gmal.com', '123456789', 'Active', 'BAMS', 5.0, 50.00),
(45, 'Mahesh', '9985633225', 11, 'maheshkrishna@gmal.com', '123456789', 'Active', 'MBBS', 5.0, 200.00),
(46, 'Rupesh kumar', '889655884', 12, 'rupesh@gmal.com', '123456789', 'Active', 'MBBS', 5.0, 250.00),
(47, 'Parthiv patel', '99855896633', 12, 'parthiv@gmal.com', '77896541230', 'Active', 'MBBS', 7.0, 600.00),
(61, 'vidya', '986555566', 5, 'vidya@gmal.com', '876867888', 'active', 'ufyhfhjkl', 3.0, 3.00);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_timings`
--

CREATE TABLE `doctor_timings` (
  `doctor_timings_id` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `available_day` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_timings`
--

INSERT INTO `doctor_timings` (`doctor_timings_id`, `doctorid`, `start_time`, `end_time`, `available_day`, `status`) VALUES
(17, 35, '09:30:00', '13:00:00', '', 'Active'),
(18, 36, '13:30:00', '17:00:00', '', 'Active'),
(19, 37, '14:00:00', '18:00:00', '', 'Active'),
(20, 38, '17:00:00', '21:00:00', '', 'Active'),
(21, 39, '13:00:00', '19:00:00', '', 'Active'),
(22, 40, '07:00:00', '11:00:00', '', 'Active'),
(23, 41, '13:30:00', '16:30:00', '', 'Active'),
(24, 42, '11:30:00', '14:30:00', '', 'Active'),
(25, 43, '12:30:00', '16:30:00', '', 'Active'),
(26, 44, '21:30:00', '12:30:00', '', 'Active'),
(27, 36, '01:03:00', '13:03:00', '', 'Active'),
(28, 61, '11:11:00', '19:07:00', '', 'Active'),
(29, 35, '11:11:00', '16:44:00', '', 'Active'),
(30, 35, '01:10:00', '16:11:00', '', 'Active'),
(31, 35, '01:02:00', '15:04:00', '2018-03-26', 'Active'),
(32, 35, '23:03:00', '14:05:00', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicineid` int(10) NOT NULL,
  `medicinename` varchar(25) NOT NULL,
  `medicinecost` float(10,2) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineid`, `medicinename`, `medicinecost`, `description`, `status`) VALUES
(1, 'ABC', 20.00, 'test abc', ''),
(3, 'xtz', 25.00, 'test abc', 'Active'),
(4, 'NYX', 50.00, 'test abc', 'Active'),
(5, 'Colpol', 30.00, 'test abc', 'Active'),
(6, 'vvvv', 50.00, 'hnghng', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientid` int(10) NOT NULL,
  `patientname` varchar(50) NOT NULL,
  `admissiondate` date NOT NULL,
  `admissiontime` time NOT NULL,
  `address` varchar(250) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `city` varchar(25) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `loginid` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientid`, `patientname`, `admissiondate`, `admissiontime`, `address`, `mobileno`, `city`, `pincode`, `loginid`, `password`, `bloodgroup`, `gender`, `dob`, `status`) VALUES
(81, 'Narayan mishra', '2021-07-03', '13:55:51', 'Sarai akil', '8299608270', 'Allahabad', '212216', 'manish@123gmail.com', '123456', 'B-', 'MALE', '2021-07-03', 'Active'),
(82, 'manish', '2021-07-04', '10:34:13', 'Sarai akil', '8299608270', 'Allahabad', '212216', 'manish@gmail.com', '123456', 'A-', 'MALE', '2021-07-07', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `paiddate` date NOT NULL,
  `paidtime` time NOT NULL,
  `paidamount` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `cardholder` varchar(50) NOT NULL,
  `cardnumber` int(25) NOT NULL,
  `cvvno` int(5) NOT NULL,
  `expdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentid`, `patientid`, `appointmentid`, `paiddate`, `paidtime`, `paidamount`, `status`, `cardholder`, `cardnumber`, `cvvno`, `expdate`) VALUES
(1, 81, 141, '2021-07-04', '10:22:02', 0.00, 'Active', '', 0, 0, '0000-00-00'),
(2, 82, 142, '2021-07-04', '10:39:15', 0.00, 'Active', '', 0, 0, '0000-00-00'),
(3, 0, 0, '2021-07-04', '07:13:51', 22200.00, 'Active', '', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescriptionid` int(10) NOT NULL,
  `treatment_records_id` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `delivery_type` varchar(10) NOT NULL COMMENT 'Delivered through appointment or online order',
  `delivery_id` int(10) NOT NULL COMMENT 'appointmentid or orderid',
  `prescriptiondate` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `appointmentid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescriptionid`, `treatment_records_id`, `doctorid`, `patientid`, `delivery_type`, `delivery_id`, `prescriptiondate`, `status`, `appointmentid`) VALUES
(15, 0, 35, 7, '', 0, '2015-08-14', 'Active', 0),
(16, 0, 36, 9, '', 0, '2016-01-08', 'Active', 0),
(17, 0, 37, 22, '', 0, '2015-11-14', 'Active', 0),
(18, 0, 38, 23, '', 0, '2016-02-27', 'Active', 0),
(19, 0, 40, 36, '', 0, '2015-12-12', 'Active', 0),
(20, 14, 36, 22, '', 0, '2016-03-11', 'Active', 0),
(21, 44, 36, 22, '', 0, '2016-03-11', 'Active', 0),
(22, 14, 35, 47, '', 0, '2016-03-19', 'Active', 0),
(23, 14, 35, 47, '', 0, '2016-03-19', 'Active', 0),
(24, 13, 35, 47, '', 0, '2016-03-09', 'Active', 0),
(25, 13, 37, 47, '', 0, '2016-03-09', 'Active', 0),
(26, 13, 36, 48, '', 0, '2016-03-25', 'Active', 0),
(27, 13, 35, 48, '', 0, '2016-03-25', 'Active', 0),
(28, 13, 35, 48, '', 0, '2016-03-25', 'Active', 0),
(29, 0, 0, 48, '', 0, '2016-03-27', 'Active', 0),
(30, 0, 0, 48, '', 0, '2016-03-27', 'Active', 0),
(31, 0, 0, 48, '', 0, '2016-03-27', 'Active', 0),
(32, 0, 0, 48, '', 0, '2016-03-27', 'Active', 0),
(33, 0, 37, 48, '', 0, '2016-03-27', 'Active', 0),
(34, 0, 37, 48, '', 0, '2016-03-27', 'Active', 0),
(35, 0, 37, 48, '', 0, '2016-03-27', 'Active', 0),
(36, 14, 35, 43, '', 0, '2018-03-24', 'Pending', 0),
(37, 13, 35, 43, '', 0, '2018-03-26', 'Pending', 0),
(38, 14, 36, 47, '', 0, '2018-03-27', 'Pending', 0),
(39, 14, 37, 9, '', 0, '2018-03-27', 'Pending', 0),
(40, 14, 37, 9, '', 0, '2018-03-27', 'Pending', 0),
(41, 14, 37, 9, '', 0, '2018-03-27', 'Pending', 0),
(42, 13, 37, 9, '', 0, '2018-03-27', 'Active', 0),
(43, 13, 36, 47, '', 0, '2018-03-27', 'Pending', 0),
(44, 0, 35, 22, '', 0, '0000-00-00', 'Active', 0),
(45, 0, 35, 7, '', 0, '0000-00-00', 'Active', 0),
(46, 13, 35, 7, '', 0, '2018-03-28', 'Active', 0),
(47, 0, 35, 41, '', 0, '0000-00-00', 'Active', 0),
(48, 44, 35, 7, '', 0, '2018-03-30', 'Active', 0),
(49, 13, 35, 7, '', 0, '2018-03-30', 'Active', 0),
(50, 13, 35, 7, '', 0, '2018-03-30', 'Active', 0),
(51, 13, 35, 7, '', 0, '2018-03-30', 'Active', 0),
(52, 13, 35, 7, '', 0, '2018-03-30', 'Active', 0),
(53, 13, 35, 7, '', 0, '2018-03-30', 'Active', 0),
(54, 13, 35, 7, '', 0, '2018-03-30', 'Active', 0),
(57, 0, 38, 41, '', 0, '2018-03-31', 'Active', 0),
(58, 19, 37, 56, '', 0, '2018-03-31', 'Active', 0),
(59, 19, 38, 56, '', 0, '2018-03-31', 'Active', 0),
(60, 14, 38, 54, '', 0, '2018-03-31', 'Active', 0),
(61, 0, 35, 7, '', 0, '2018-03-31', 'Active', 0),
(62, 0, 35, 7, '', 0, '0000-00-00', 'Active', 0),
(63, 13, 35, 7, '', 0, '2018-04-03', 'Active', 0),
(64, 13, 35, 48, '', 0, '2018-04-03', 'Active', 0),
(65, 0, 35, 7, '', 0, '0000-00-00', 'Active', 0),
(66, 0, 35, 41, '', 0, '0000-00-00', 'Active', 0),
(67, 0, 35, 41, '', 0, '0000-00-00', 'Active', 0),
(68, 13, 35, 7, '', 0, '2018-04-03', 'Active', 0),
(69, 14, 35, 22, '', 0, '2018-04-03', 'Active', 0),
(70, 44, 35, 7, '', 0, '2018-04-03', 'Active', 0),
(71, 0, 35, 7, '', 0, '2018-04-03', 'Active', 0),
(72, 0, 0, 36, '', 0, '2018-04-03', 'Active', 0),
(73, 0, 0, 48, '', 0, '2018-03-27', 'Active', 0),
(74, 0, 36, 7, '', 0, '2018-04-27', 'Active', 0),
(75, 0, 36, 7, '', 0, '2018-04-12', 'Active', 0),
(76, 13, 35, 7, '', 0, '2018-04-03', 'Active', 0),
(77, 13, 36, 47, '', 0, '2018-04-04', 'Active', 0),
(78, 14, 36, 44, '', 0, '2018-04-04', 'Active', 0),
(79, 14, 35, 44, '', 0, '0000-00-00', 'Active', 0),
(80, 14, 35, 7, '', 0, '2018-04-04', 'Active', 0),
(81, 13, 35, 56, '', 0, '2018-04-06', 'Active', 0),
(82, 0, 35, 7, '', 0, '2018-04-06', 'Active', 0),
(83, 0, 35, 7, '', 0, '2018-04-06', 'Active', 0),
(84, 0, 35, 7, '', 0, '2018-04-13', 'Active', 0),
(85, 0, 35, 52, '', 0, '2018-04-06', 'Active', 0),
(86, 0, 35, 53, '', 0, '2018-04-07', 'Active', 0),
(87, 0, 35, 53, '', 47, '2018-04-10', 'Active', 0),
(88, 0, 35, 52, '', 48, '2018-04-07', 'Active', 0),
(89, 0, 36, 22, '', 49, '2018-04-07', 'Active', 0),
(90, 0, 35, 7, '', 42, '0000-00-00', 'Active', 0),
(91, 0, 35, 22, '', 50, '2018-04-08', 'Active', 0),
(92, 0, 35, 22, '', 51, '2018-04-10', 'Active', 0),
(93, 0, 36, 22, '', 49, '2018-04-10', 'Active', 0),
(94, 0, 35, 22, '', 52, '2018-04-08', 'Active', 0),
(95, 0, 35, 22, '', 53, '2018-04-08', 'Active', 0),
(96, 0, 35, 22, '', 54, '2018-04-08', 'Active', 0),
(97, 0, 35, 22, '', 55, '2018-04-08', 'Active', 0),
(98, 0, 35, 57, '', 0, '0000-00-00', 'Active', 120),
(99, 0, 35, 57, '', 0, '2018-07-12', 'Active', 120),
(100, 0, 35, 7, '', 0, '2021-02-12', 'Active', 125),
(101, 0, 35, 70, '', 0, '2021-02-06', 'Active', 126),
(102, 0, 35, 22, '', 0, '2021-06-09', 'Active', 83),
(103, 0, 35, 72, '', 0, '2021-06-29', 'Active', 134),
(104, 0, 35, 72, '', 0, '2021-07-02', 'Active', 135),
(105, 0, 35, 72, '', 0, '2021-07-02', 'Active', 138),
(106, 0, 35, 75, '', 0, '2021-07-03', 'Active', 139),
(107, 0, 35, 81, '', 0, '2021-07-03', 'Active', 140),
(108, 0, 35, 81, '', 0, '2021-07-04', 'Active', 141),
(109, 0, 35, 82, '', 0, '2021-07-04', 'Active', 142);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_records`
--

CREATE TABLE `prescription_records` (
  `prescription_record_id` int(10) NOT NULL,
  `prescription_id` int(10) NOT NULL,
  `medicine_name` varchar(25) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `unit` int(10) NOT NULL,
  `dosage` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription_records`
--

INSERT INTO `prescription_records` (`prescription_record_id`, `prescription_id`, `medicine_name`, `cost`, `unit`, `dosage`, `status`) VALUES
(157, 106, '5', 30.00, 3, '1-0-1', 'Active'),
(159, 108, '4', 50.00, 4, '0-0-1', 'Active'),
(160, 109, '6', 50.00, 9, '0-1-1', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `treatmentid` int(10) NOT NULL,
  `treatmenttype` varchar(25) NOT NULL,
  `treatment_cost` decimal(10,2) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatmentid`, `treatmenttype`, `treatment_cost`, `note`, `status`) VALUES
(13, 'Treatment for Malaria', '450.00', ' Providing medicine and tonic with injection  ', 'Active'),
(14, 'Treatment for Dengue', '20000.00', ' Providing massage and home made tips', 'Active'),
(15, 'tryrtytyt', '554.00', ' ertrrcyt', 'Active'),
(16, 'rytyt', '55.00', ' eex', 'Active'),
(17, 'jkgjghj', '5653.00', ' hfhfjhg', 'Active'),
(18, 'rhgjh', '54.00', ' hgjgj ', 'Active'),
(19, 'Dengue', '4000.00', 'Dengue treatment', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_records`
--

CREATE TABLE `treatment_records` (
  `treatment_records_id` int(10) NOT NULL,
  `treatmentid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `treatment_description` text NOT NULL,
  `uploads` varchar(100) NOT NULL,
  `treatment_date` date NOT NULL,
  `treatment_time` time NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment_records`
--

INSERT INTO `treatment_records` (`treatment_records_id`, `treatmentid`, `appointmentid`, `patientid`, `doctorid`, `treatment_description`, `uploads`, `treatment_date`, `treatment_time`, `status`) VALUES
(59, 14, 120, 57, 35, 'Treatment given for dengue fever', '29112image011.png', '2018-07-12', '01:00:00', 'Active'),
(66, 14, 138, 72, 35, 'manish mishra', '24390', '2021-07-02', '22:59:00', 'Active'),
(67, 14, 139, 75, 35, 'bbbhjhjhjhjh', '9981', '2021-07-03', '13:18:00', 'Active'),
(68, 0, 140, 81, 35, 'manish mishraa', '17138', '2021-07-03', '20:24:00', 'Active'),
(69, 14, 140, 81, 35, 'narayan misha', '30700', '2021-07-03', '20:26:00', 'Active'),
(70, 13, 141, 81, 35, 'jgjjhhjhjjj kjhkhkjk khkjhj', '3945', '2021-07-04', '09:59:00', 'Active'),
(71, 14, 141, 81, 35, 'manmkjjn  njnsjskjskj current', '8739', '2021-07-04', '10:30:00', 'Active'),
(72, 17, 142, 82, 35, 'mnsjjdshdhsd', '15912', '2021-07-04', '10:36:00', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `adminname` (`adminname`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentid`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billingid`);

--
-- Indexes for table `billing_records`
--
ALTER TABLE `billing_records`
  ADD PRIMARY KEY (`billingservice_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorid`);

--
-- Indexes for table `doctor_timings`
--
ALTER TABLE `doctor_timings`
  ADD PRIMARY KEY (`doctor_timings_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientid`),
  ADD KEY `loginid` (`loginid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescriptionid`);

--
-- Indexes for table `prescription_records`
--
ALTER TABLE `prescription_records`
  ADD PRIMARY KEY (`prescription_record_id`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`treatmentid`);

--
-- Indexes for table `treatment_records`
--
ALTER TABLE `treatment_records`
  ADD PRIMARY KEY (`treatment_records_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billingid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `billing_records`
--
ALTER TABLE `billing_records`
  MODIFY `billingservice_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `doctor_timings`
--
ALTER TABLE `doctor_timings`
  MODIFY `doctor_timings_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescriptionid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `prescription_records`
--
ALTER TABLE `prescription_records`
  MODIFY `prescription_record_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `treatmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `treatment_records`
--
ALTER TABLE `treatment_records`
  MODIFY `treatment_records_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
