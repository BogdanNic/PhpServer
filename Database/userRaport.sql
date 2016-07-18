
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2016 at 10:00 AM
-- Server version: 10.0.20-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u328936720_bog`
--

-- --------------------------------------------------------

--
-- Table structure for table `userRaport`
--

CREATE TABLE IF NOT EXISTS `userRaport` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Password_hash` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `api_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=125 ;

--
-- Dumping data for table `userRaport`
--

INSERT INTO `userRaport` (`ID`, `Username`, `Name`, `Email`, `Password_hash`, `created_at`, `api_key`, `status`) VALUES
(40, 'bog', 'bog', 'b@gdan.com', '$2a$10$7bde247460a117672d469O8X.f38LzM1.6TscXy5pBVgjJTgWkkyC', '2014-07-05 19:47:10', '0381bf51b21cf0e83536f9c662a0a371', 1),
(51, 'marco2', 'marco2', 'marco@yahoo.com', '$2a$10$1dfd2d4a1b5b8f1cf8eb3udW99lNhHyInSnyeqrluHjB2ZlA3KdXu', '2014-12-12 16:49:49', '144a1a7a0edf10f5fc2d64daeebfdd1a', 1),
(55, 'vaduva mirela', 'vaduva mirela', 'vaduvamirela76@yahoo.com', '$2a$10$e75005829ff132f3e4e38OAXZX7azxBG4L3SMPXyIATuRtiZ0TaY.', '2014-12-22 17:33:27', '4243f2070d356b98f43567251ca520b3', 1),
(56, 'cornel', 'cornel ', 'cocosimanu@yahoo.com', '$2a$10$fcca1c0cb1ab02343adc9u1wOsspsVcr.8VZM8l5NaDtCaj140Yqm', '2015-01-04 18:20:32', '44bb26f68591e16eb73c72d3a328cb43', 1),
(98, 'catalin', 'catalan  nic', 'catalinnicolae10@yahoo.com', '$2a$10$d3daadc7bee44a0ade46dO7ETfimobbUBN3AMEXOF22BrdPYjRIz6', '2015-06-30 11:55:45', 'b588e3cd6464edcce4465612e32e793d', 1),
(124, 'radu12', 'raducu', 'radu@yahoo.com', '$2a$10$7823298bef25b210219a5uKmKwi9ffgamf/FaTrg/hMp1DASvlBwW', '2016-07-08 10:34:02', 'e17e2ada8b8a664cec6829e20de37406', 1),
(86, 'nicBog', 'nic bog', 'nicBig@jj.com', '$2a$10$072b250425c84fcf7aa70urZQYkFTnKUlRPGFcMR7.O6gFZ1YsA8W', '2015-03-19 13:20:04', '0d2b9779dc1bf8b78093f6ed25a1727d', 1),
(87, 'b1', 'bog Nic', 'bog@nic2.com', '$2a$10$a6b360af0abab165a9ec7uo2LwWXwhigeJYv7VMQGyiYPdB3tFFGu', '2015-05-15 10:17:25', '39026cfdef23c4423245ad5237f8d905', 1),
(119, 'testApp', 'testApp', 'testApp@yahoo.com', '$2a$10$18ac757bb07b3d4736f21Og9mpZO7MKAdQZmVR9/S8AHkt5gmk1RG', '2016-07-07 18:53:57', '59b9cdd58cbdb6aaee888d00961db2e7', 1),
(54, 'MarcoVaduva', 'Marco Vaduva', 'marko_vaduva@yahoo.com', '$2a$10$15ffd3f72f78e522d0b85uWZBhv8ptTYWtbgTBWhyV0RiisDt.QbK', '2015-08-11 17:10:47', '1f456b83c952b924cb2c70624e019eb2', 1),
(109, 'călinelli', 'Călin Gera', 'ebonoyu@yahoo.com ', '$2a$10$a80f3a1bf3dfb200fdda8O1IrSz1UT0FWKb6mpJCtVlMNHqc10bv2', '2015-08-25 16:49:58', 'b04ea5fa5f01097e3ad27d30046ea1f1', 1),
(110, 'bogbox', 'Bogdan', 'bogdan_nic100@yahoo.com', '$2a$10$1e8be90fa2088fee840c7uhFCixy.B0TjVBn8ZvMtvtbWZSAtapuy', '2015-09-03 13:45:54', 'cb61702483c9355db5741746e882c1b6', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
