-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2011 at 10:51 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `expences`
--

-- --------------------------------------------------------

--
-- Table structure for table `didi`
--

DROP TABLE IF EXISTS `didi`;
CREATE TABLE IF NOT EXISTS `didi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `didi`
--

INSERT INTO `didi` (`id`, `date`, `count`) VALUES
(1, '2011-01-01 00:00:00', 3),
(2, '2010-12-18 00:00:00', 3),
(3, '2011-01-05 00:00:00', 2),
(4, '2011-01-08 00:00:00', 4),
(5, '2011-01-12 00:00:00', 2),
(6, '2011-01-15 00:00:00', 2),
(7, '2011-01-24 00:00:00', 1),
(8, '2011-01-30 00:00:00', 3),
(9, '2011-02-02 00:00:00', 4),
(10, '2011-02-04 00:00:00', 3),
(11, '2011-02-09 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `cause` varchar(255) NOT NULL DEFAULT '-',
  `place` varchar(255) NOT NULL DEFAULT '-',
  `note` varchar(255) NOT NULL DEFAULT '-',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `date`, `amount`, `cause`, `place`, `note`) VALUES
(1, '2011-01-01 00:00:00', '8.80', 'dinner', 'beriani', '-'),
(2, '2011-01-02 00:00:00', '8.20', 'lunch', 'popeyes', '-'),
(3, '2011-01-02 00:00:00', '20.00', 'mrt', 'novena', '-'),
(4, '2011-01-03 00:00:00', '5.00', 'lunch', 'united square food court', '-'),
(5, '2011-01-04 00:00:00', '5.25', 'lunch', 'mcdonalds', '-'),
(6, '2011-01-04 00:00:00', '12.00', 'dinner', 'bismillah', '-'),
(7, '2011-01-05 00:00:00', '5.00', 'lunch', 'united square food court', '-'),
(8, '2011-01-05 00:00:00', '10.80', 'fairprice', 'shaw plaza', '-'),
(9, '2011-01-02 00:00:00', '-200.00', 'cash', 'citibank', '-'),
(10, '2011-01-06 00:00:00', '4.00', 'lunch', 'united square food court', '-'),
(11, '2011-01-07 00:00:00', '5.00', 'lunch', 'mcdonalds', '-'),
(12, '2011-01-08 00:00:00', '5.80', 'lunch', 'fayedha', '-'),
(13, '2011-01-08 00:00:00', '5.20', 'fairprice', 'shaw plaza', '-'),
(14, '2011-01-07 00:00:00', '39.95', 'shoe', 'bata', '-'),
(15, '2011-01-07 00:00:00', '19.60', 'fairprice', 'shaw plaza', '-'),
(16, '2011-01-09 00:00:00', '10.85', 'fairprice', 'shaw plaza', '-'),
(17, '2011-01-10 00:00:00', '7.50', 'lunch', 'rozzy', 'with sean jani steve ...'),
(18, '2011-01-10 00:00:00', '7.90', 'topaware', 'carrefour', '-'),
(19, '2011-01-10 00:00:00', '8.00', 'food', 'carrefour', '-'),
(20, '2011-01-11 00:00:00', '20.50', 'lunch', 'jack''s place', 'viv reka ryan'),
(21, '2011-01-11 00:00:00', '87.65', '-', 'mustafa', '-'),
(22, '2011-01-11 00:00:00', '-7.50', 'baklava', 'mustafa', 'for office'),
(23, '2011-01-11 00:00:00', '3.40', 'fairprice', 'united square', 'iron biscuits'),
(24, '2011-01-12 00:00:00', '10.00', 'haircut', 'velocity', '-'),
(25, '2011-01-12 00:00:00', '10.00', 'mrt', 'novena', '-'),
(26, '2011-01-13 00:00:00', '10.30', 'lunch', 'texas chicken', '-'),
(31, '2011-01-16 00:00:00', '12.00', 'fairprice', 'shaw plaza', ''),
(30, '2011-01-14 00:00:00', '14.00', 'lunch', 'rozzy', 'with sean'),
(32, '2011-01-17 00:00:00', '5.40', 'lunch', 'Jalan Kayu', 'with sean'),
(33, '2011-01-17 00:00:00', '7.10', 'ColdStorage', 'novena', ''),
(34, '2011-01-18 00:00:00', '3.00', 'lunch', 'united square food court', ''),
(35, '2011-01-18 00:00:00', '21.70', 'shopping', 'carrefour', ''),
(36, '2011-01-18 00:00:00', '20.00', 'mrt', 'novena', ''),
(37, '2011-01-19 00:00:00', '14.50', 'ringworm medicine', 'guardian', '2% rebate'),
(38, '2011-01-19 00:00:00', '8.20', 'microwave cookware', 'coldstorage', ''),
(39, '2011-01-20 00:00:00', '10.00', 'lunch', 'rozzy', 'with sean and francise'),
(40, '2011-01-22 00:00:00', '-300.00', 'citibank', 'novena', ''),
(41, '2011-01-22 00:00:00', '263.30', 'ali nemati', 'ameertech remittance', '200usd=9000Rs'),
(42, '2011-01-21 00:00:00', '3.00', 'lunch', 'novena square', 'with charyl'),
(43, '2011-01-21 00:00:00', '0.00', 'dinner', 'anatoli@fareast plaza', 'with sean, richard & KY, sean treated, richard got icecream ~ 20$'),
(44, '2011-01-22 00:00:00', '9.80', 'fairprice', 'shaw plaza', 'socks, paper'),
(45, '2011-01-21 00:00:00', '16.95', 'fairprice', 'toa payoh', ''),
(46, '2011-01-19 00:00:00', '5.99', 'LED Adjustable Clip On Book Light', 'ebay', 'ezytoys@gmail.com'),
(47, '2011-01-24 00:00:00', '-2.45', 'mrt', 'novena', 'refund'),
(48, '2011-01-24 00:00:00', '6.50', 'lunch', 'rozzy', 'take away'),
(49, '2011-01-24 00:00:00', '8.10', 'fairprice', 'shaw plaza', '4 drinks'),
(50, '2011-01-25 00:00:00', '7.50', 'lunch', 'burgerking', 'whopper'),
(51, '2011-01-26 00:00:00', '1.50', 'ColdStorage', 'novena', 'lemonx7'),
(52, '2011-01-30 00:00:00', '21.20', 'fairprice', 'shaw plaza', ''),
(53, '2011-01-28 00:00:00', '3.50', 'dinner', 'texas chicken', ''),
(54, '2011-01-31 00:00:00', '5.90', 'Guardian', 'united square', 'nail clipper'),
(55, '2011-01-31 00:00:00', '16.80', 'Guardian', 'united square', 'cream'),
(56, '2011-01-31 00:00:00', '3.50', 'Texas Chicken', 'united square', '2xTender + Fries'),
(57, '2011-01-31 00:00:00', '9.00', 'Hush Puppies', 'united square', 'shorts x3'),
(58, '2011-01-31 00:00:00', '1000.00', 'rent', 'public mansion', ''),
(59, '2011-01-31 00:00:00', '10.00', 'egypt kebab', 'Woodlands', 'shawerma kabab x3'),
(60, '2011-01-25 00:00:00', '3.40', 'fairprice', 'shaw plaza', '-'),
(61, '2011-02-01 00:00:00', '4.00', 'lunch', 'novena square', 'nasi lomek'),
(62, '2011-02-01 00:00:00', '30.00', 'visa', 'online', 'amin nazari'),
(63, '2011-02-02 00:00:00', '10.00', 'mrt', 'novena', ''),
(69, '2011-02-02 00:00:00', '26.60', 'fairprice', 'toa payoh', 'cny rush'),
(66, '2011-02-02 00:00:00', '-100.00', 'cash', 'toa payoh', 'cny rush'),
(70, '2011-02-06 00:00:00', '10.00', 'pizzahut', 'funan', 'mixup'),
(71, '2011-02-06 00:00:00', '1.95', 'ColdStorage', 'funan', 'apple juice'),
(72, '2011-02-06 00:00:00', '14.50', 'Guardian', 'marine bay', 'Canesten'),
(73, '2011-02-06 00:00:00', '3.60', 'fairprice', 'City Square', 'yogurt'),
(74, '2011-02-06 00:00:00', '20.00', 'Metrojaya', 'City Square', 'Pants'),
(75, '2011-02-07 00:00:00', '14.25', 'fairprice', 'shaw plaza', ''),
(87, '2011-02-13 00:00:00', '8.20', 'fairprice', 'shaw plaza', '-'),
(77, '2011-02-08 00:00:00', '4.50', 'lunch', 'novena square', ''),
(78, '2011-02-08 00:00:00', '1.85', 'fairprice', 'novena square', 'biscuits'),
(79, '2011-02-09 00:00:00', '3.00', 'lunch', 'novena square', ''),
(80, '2011-02-09 00:00:00', '20.00', 'mrt', 'novena', ''),
(81, '2011-02-10 00:00:00', '7.60', 'Texas Chicken', 'united square', '2pc'),
(82, '2011-02-11 00:00:00', '3.00', 'lunch', 'novena square', ''),
(83, '2011-02-11 00:00:00', '4.55', 'Guardian', 'novena', 'cold medicine'),
(84, '2011-02-12 00:00:00', '-50.00', 'citibank', 'toa payoh', ''),
(85, '2011-02-12 00:00:00', '20.00', 'singtel', '7eleven', ''),
(86, '2011-02-12 00:00:00', '16.40', 'fairprice', 'toa payoh', ''),
(88, '2011-02-14 00:00:00', '49.90', 'post', 'novena', 'visa amin'),
(89, '2011-02-15 00:00:00', '3.00', 'lunch', 'novena square', 'nasi lomek'),
(90, '2011-02-15 00:00:00', '6.70', 'taxi', 'nus', ''),
(91, '2011-02-15 00:00:00', '5.45', 'fairprice', 'toa payoh', ''),
(92, '2011-02-14 00:00:00', '-100.00', 'citibank', 'novena', ''),
(93, '2011-02-18 00:00:00', '6.90', 'mustafa', 'mustafa', ''),
(94, '2011-02-18 00:00:00', '6.30', 'burgerking', 'novena', ''),
(95, '2011-02-18 00:00:00', '3.75', 'ColdStorage', 'united square', ''),
(96, '2011-02-16 00:00:00', '9.85', 'fairprice', 'shaw plaza', ''),
(97, '2011-02-19 00:00:00', '15.30', 'fairprice', 'shaw plaza', ''),
(98, '2011-02-21 00:00:00', '4.00', 'lunch', 'novena square', ''),
(99, '2011-02-24 00:00:00', '2.50', 'nasi lemak', 'novena square', '4 cups of rice only'),
(100, '2011-02-24 00:00:00', '5.15', 'ColdStorage', 'novena', 'john west red sardin'),
(101, '2011-02-24 00:00:00', '-100.00', 'citibank', 'novena', ''),
(102, '2011-02-23 00:00:00', '22.55', 'fairprice', 'novena square', ''),
(103, '2011-02-23 00:00:00', '10.00', 'mrt', 'novena', ''),
(104, '2011-02-23 00:00:00', '-50.00', 'citibank', 'novena', ''),
(105, '2011-02-23 00:00:00', '4.65', 'burgerking', 'novena', ''),
(106, '2011-02-25 00:00:00', '5.50', 'mcdonalds', 'united square', 'McBistro'),
(107, '2011-02-25 00:00:00', '4.95', 'burgerking', 'novena', ''),
(108, '2011-02-26 00:00:00', '-500.00', 'citibank', 'novena', ''),
(109, '2011-02-26 00:00:00', '89.00', 'fragrance hotel', 'balestier', 'maghdasi'),
(110, '2011-02-26 00:00:00', '400.00', 'loan', 'united square', 'maghdasi'),
(111, '2011-02-26 00:00:00', '10.00', 'mrt', 'novena', ''),
(112, '2011-02-26 00:00:00', '4.95', 'burgerking', 'novena', ''),
(113, '2011-02-27 00:00:00', '3.50', 'coffeebean & tea leaf', 'bishan', ''),
(114, '2011-02-27 00:00:00', '14.25', 'fairprice', 'bishan', ''),
(115, '2011-02-27 00:00:00', '10.00', 'mrt', 'bishan', ''),
(116, '2011-02-28 00:00:00', '4.50', 'lunch', 'novena square', ''),
(117, '2011-02-28 00:00:00', '3.50', 'Texas Chicken', 'united square', ''),
(118, '2011-02-28 00:00:00', '4.90', 'ColdStorage', 'united square', 'chocolate'),
(119, '2011-03-03 00:00:00', '54.02', 'pizzahut', 'plaza singapora', 'with amin and ali'),
(120, '2011-03-03 00:00:00', '-118.00', 'debt collection', 'plaza singapora', 'amin nazari'),
(121, '2011-03-03 00:00:00', '20.00', 'starhub transfer fee', 'plaza singapora', 'laura suff'),
(122, '2011-03-03 00:00:00', '-200.00', 'citibank', 'novena', ''),
(123, '2011-03-04 00:00:00', '9.40', 'fairprice', 'shaw plaza', ''),
(124, '2011-03-04 00:00:00', '4.65', 'yogurt', 'united square', ''),
(125, '2011-03-04 00:00:00', '3.05', 'chocolate', 'united square', ''),
(126, '2011-03-03 00:00:00', '4.55', 'burgerking', 'novena', 'breakfast'),
(127, '2011-03-02 00:00:00', '10.80', 'beef beryani', 'rozzy', 'with sean'),
(128, '2011-03-02 00:00:00', '8.00', 'mcdonalds', 'khatib', ''),
(129, '2011-03-02 00:00:00', '-8.00', 'debt', 'khatib', 'amin nazari'),
(130, '2011-03-03 00:00:00', '211.20', 'starhub bill', 'plaza singapora', ''),
(131, '2011-03-01 00:00:00', '10.00', 'mrt', 'novena', 'amin nazari'),
(132, '2011-03-01 00:00:00', '8.60', 'long john silvers', 'novena', 'with francis'),
(133, '2011-03-01 00:00:00', '6.80', 'kfc', 'novena', ''),
(134, '2011-03-01 00:00:00', '6.90', 'Guardian', 'novena', ''),
(135, '2011-03-06 00:00:00', '10.00', 'mrt', 'novena', ''),
(136, '2011-03-06 00:00:00', '6.00', 'kfc', 'novena', ''),
(137, '2011-03-06 00:00:00', '3.70', 'starbucks', 'united square', ''),
(138, '2011-03-06 00:00:00', '10.20', 'fairprice', 'shaw plaza', ''),
(139, '2011-03-08 00:00:00', '16.10', 'popeyes', 'novena square', 'with amin'),
(140, '2011-03-08 00:00:00', '4.90', 'Texas Chicken', 'united square', 'with amin and kuanyen'),
(141, '2011-03-07 00:00:00', '3.15', 'burgerking', 'novena', ''),
(142, '2011-03-07 00:00:00', '9.80', 'roszy tiffin house', 'Goldhill', ''),
(143, '2011-03-07 00:00:00', '3.70', 'starbucks', 'united square', ''),
(144, '2011-03-08 00:00:00', '14.80', 'fairprice', 'novena square', ''),
(145, '2011-03-10 00:00:00', '3.70', 'starbucks', 'united square', ''),
(146, '2011-03-10 00:00:00', '1.00', 'burgerking', 'novena', ''),
(147, '2011-03-10 00:00:00', '4.90', 'Texas Chicken', 'united square', ''),
(148, '2011-03-09 00:00:00', '3.15', 'burgerking', 'novena', ''),
(149, '2011-03-09 00:00:00', '2.70', 'foodcourt', 'Revenue House', ' '),
(150, '2011-03-11 00:00:00', '5.95', 'ColdStorage', 'united square', ''),
(151, '2011-03-11 00:00:00', '3.55', 'mcdonalds', 'united square', ''),
(152, '2011-03-11 00:00:00', '5.40', 'Texas Chicken', 'united square', '');
