-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 17, 2022 at 03:31 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `TZ`
--

-- --------------------------------------------------------

--
-- Table structure for table `Directory`
--

CREATE TABLE `Directory` (
  `Код` int(10) UNSIGNED NOT NULL,
  `Название` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Directory`
--

INSERT INTO `Directory` (`Код`, `Название`) VALUES
(1, 'Кондиционер'),
(2, 'Гриль-DF.S4'),
(3, 'fridge-SDFG321'),
(4, 'Холодильник-srfg534'),
(5, 'Бутербродница');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Directory`
--
ALTER TABLE `Directory`
  ADD PRIMARY KEY (`Код`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Directory`
--
ALTER TABLE `Directory`
  MODIFY `Код` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
