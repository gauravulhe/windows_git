-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2017 at 01:29 PM
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
-- Table structure for table `module_workorder_maintenance_projects`
--

CREATE TABLE `module_workorder_maintenance_projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_no` varchar(10) NOT NULL DEFAULT '000000',
  `order_title` varchar(255) NOT NULL,
  `assign_by` varchar(255) NOT NULL,
  `assign_by_user_id` int(11) NOT NULL,
  `bill_to` varchar(255) NOT NULL,
  `association_name` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `other_details` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `project_image1` varchar(255) NOT NULL,
  `project_image2` varchar(255) NOT NULL,
  `project_description` longtext NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `billing_type` varchar(255) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_date` varchar(255) NOT NULL,
  `emp_start` varchar(255) NOT NULL,
  `emp_end` varchar(255) NOT NULL,
  `emp_not_billed` varchar(255) NOT NULL,
  `emp_hours` varchar(255) NOT NULL,
  `emp_rate` varchar(255) NOT NULL,
  `cont_name` varchar(255) NOT NULL,
  `cont_date` varchar(255) NOT NULL,
  `cont_start` varchar(255) NOT NULL,
  `cont_end` varchar(255) NOT NULL,
  `cont_not_billed` varchar(255) NOT NULL,
  `cont_hours` varchar(255) NOT NULL,
  `cont_rate` varchar(255) NOT NULL,
  `progress_note` varchar(255) NOT NULL,
  `completion_date` varchar(255) NOT NULL,
  `total_hours` varchar(255) NOT NULL DEFAULT '0',
  `total_hours_cost_total` varchar(255) NOT NULL DEFAULT '0',
  `mat_vendors` varchar(255) NOT NULL,
  `mat_desc` varchar(255) NOT NULL,
  `mat_cost` varchar(255) NOT NULL,
  `bid_total` varchar(255) NOT NULL,
  `change_order_desc` varchar(255) NOT NULL,
  `change_order_cost` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_status` varchar(255) NOT NULL DEFAULT 'assigned'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `module_workorder_maintenance_projects`
--
ALTER TABLE `module_workorder_maintenance_projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `module_workorder_maintenance_projects`
--
ALTER TABLE `module_workorder_maintenance_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
