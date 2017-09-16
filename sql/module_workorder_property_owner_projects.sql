-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2017 at 01:26 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `module_workorder_property_owner_projects`
--

CREATE TABLE `module_workorder_property_owner_projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `approval_date` varchar(255) NOT NULL,
  `approval_expire_date` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_phone` varchar(255) NOT NULL,
  `owner_cell` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `project_note` longtext NOT NULL,
  `contractor_name` varchar(255) NOT NULL,
  `contractor_phone` varchar(255) NOT NULL,
  `contractor_cell` varchar(255) NOT NULL,
  `project_description` longtext NOT NULL,
  `other_details` varchar(255) NOT NULL,
  `plans_submitted_date` varchar(255) NOT NULL,
  `deposit_received_amt` varchar(255) NOT NULL,
  `deposit_returned_date` varchar(255) NOT NULL,
  `deposit_not_returned_notes` varchar(255) NOT NULL,
  `project_completed_date` varchar(255) NOT NULL,
  `project_image` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_status` varchar(255) NOT NULL DEFAULT 'project'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `module_workorder_property_owner_projects`
--
ALTER TABLE `module_workorder_property_owner_projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `module_workorder_property_owner_projects`
--
ALTER TABLE `module_workorder_property_owner_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
