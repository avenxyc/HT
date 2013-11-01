-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2013 at 08:55 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rp`
--

-- --------------------------------------------------------

--
-- Table structure for table `constituents`
--

CREATE TABLE IF NOT EXISTS `constituents` (
  `cname` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`cname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `constituents`
--

INSERT INTO `constituents` (`cname`, `type`) VALUES
('box', 'paper'),
('tray', 'Plasitc');

-- --------------------------------------------------------

--
-- Table structure for table `item_class`
--

CREATE TABLE IF NOT EXISTS `item_class` (
  `class_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_class`
--

INSERT INTO `item_class` (`class_name`) VALUES
('Cereal'),
('Hot cereal'),
('Dips'),
('Canned fruit'),
('Granola bars'),
('Ready to eat dessert'),
('Jam'),
('Coffee'),
('Baking needs'),
('Pickles'),
('Flour'),
('Salad dressing'),
('Condiments'),
('World foods'),
('Oil'),
('Canned meat'),
('Rice'),
('Canned vegetable'),
('Soup'),
('Gravy mix'),
('Crackers'),
('Pasta sauce'),
('Pasta'),
('Confectionery'),
('Cookies'),
('Rice cakes'),
('Drink boxes'),
('Juice and drinks'),
('Seasonal general mer'),
('Pop'),
('Soft drinks'),
('Snacks'),
('Potato chips'),
('Seasonal grocery'),
('Water'),
('Foils &wraps'),
('Food storage'),
('Isotonic'),
('Dry dog food'),
('Cat food');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `upccode` varchar(20) NOT NULL,
  `class` varchar(50) NOT NULL,
  `image` longblob NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `parent_company` varchar(60) DEFAULT NULL,
  `product_name` varchar(60) DEFAULT NULL,
  `weight` decimal(5,1) NOT NULL,
  `total_weight` decimal(10,0) NOT NULL,
  `author` varchar(40) NOT NULL,
  `last_updated` date NOT NULL,
  PRIMARY KEY (`upccode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`upccode`, `class`, `image`, `img_path`, `company_name`, `parent_company`, `product_name`, `weight`, `total_weight`, `author`, `last_updated`) VALUES
('88888', 'Baking needs', '', '', 'Motorola', 'Google', '32', '321.0', '3211', 'aven', '2013-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `prod_const`
--

CREATE TABLE IF NOT EXISTS `prod_const` (
  `part_weight` varchar(255) NOT NULL,
  `cname` varchar(50) NOT NULL DEFAULT '',
  `upccode` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`cname`,`upccode`),
  KEY `upccode` (`upccode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prod_const`
--

INSERT INTO `prod_const` (`part_weight`, `cname`, `upccode`) VALUES
('40', 'box', '88888'),
('30', 'tray', '88888');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `region_name` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`region_name`),
  KEY `region_name` (`region_name`),
  KEY `region_name_2` (`region_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_name`) VALUES
('Cape Breton'),
('Eastern'),
('HRM'),
('Northern'),
('South Shore'),
('Valley'),
('Western');

-- --------------------------------------------------------

--
-- Table structure for table `regions_recyclability`
--

CREATE TABLE IF NOT EXISTS `regions_recyclability` (
  `region_name` varchar(60) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `classification` varchar(30) NOT NULL,
  PRIMARY KEY (`region_name`,`cname`),
  KEY `cname` (`cname`),
  KEY `region_name` (`region_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regions_recyclability`
--

INSERT INTO `regions_recyclability` (`region_name`, `cname`, `classification`) VALUES
('Cape Breton', 'box', 'Blue Bag #2: Recyclables'),
('Cape Breton', 'tray', 'Clear Garbage Bag');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `email` varchar(32) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(16) NOT NULL,
  `last_name` varchar(16) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`email`, `username`, `password`, `first_name`, `last_name`) VALUES
('avenxyc@gmdsl.com', '112574x', 'a8ee477e053e35d1b8b63bb53c5962b6fa7db519', 'Yichuan', 'Xu'),
('avenxyc@gil.com', '120542c', 'a8ee477e053e35d1b8b63bb53c5962b6fa7db519', 'Yichuan', 'Xu'),
('112574x@nga.com', '1234', 'a8ee477e053e35d1b8b63bb53c5962b6fa7db519', 'aven', 'xn'),
('avenxyc@gmail.com', '312026314@qq.com', 'a8ee477e053e35d1b8b63bb53c5962b6fa7db519', 'Yichuan', 'Xu'),
('droid@gmail.com', 'asfdsa', 'avenxyc', 'yichuan', 'aux'),
('', 'aven', 'avenxyc', 'yichuan', 'xu'),
('', 'avenxyc', 'avenxyc', 'avenxyc', 'avenxyc'),
('avenxyc@gmail.com', 'avenzz', 'aven', 'yichuan', 'xu'),
('av@g.com', 'droid', 'a8ee477e053e35d1b8b63bb53c5962b6fa7db519', 'yichuan', 'xu'),
('', 'haha', 'aven123', 'yichuan', 'xu'),
('11@gmail.com', 'Paul', 'a8ee477e053e35d1b8b63bb53c5962b6fa7db519', 'Paul ', 'Arnold'),
('avenxyc@b.com', 'xiaoll', 'a8ee477e053e35d1b8b63bb53c5962b6fa7db519', 'Yichuan', 'Xu'),
('a@b.com', 'xyc', 'a8ee477e053e35d1b8b63bb53c5962b6fa7db519', 'Yichuan', 'Xu'),
('', 'yyy', '3421ecde2a5de6543b48460b867cf323b018bc22', 'aven', 'xu');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prod_const`
--
ALTER TABLE `prod_const`
  ADD CONSTRAINT `prod_const_ibfk_1` FOREIGN KEY (`cname`) REFERENCES `constituents` (`cname`),
  ADD CONSTRAINT `prod_const_ibfk_2` FOREIGN KEY (`upccode`) REFERENCES `products` (`upccode`);

--
-- Constraints for table `regions_recyclability`
--
ALTER TABLE `regions_recyclability`
  ADD CONSTRAINT `regions_recyclability_ibfk_7` FOREIGN KEY (`region_name`) REFERENCES `regions` (`region_name`),
  ADD CONSTRAINT `regions_recyclability_ibfk_8` FOREIGN KEY (`cname`) REFERENCES `constituents` (`cname`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
