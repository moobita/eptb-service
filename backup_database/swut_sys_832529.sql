-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2016 at 06:07 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swut_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin', '2', 1457053448),
('Author', '3', 1457053448),
('Management', '4', 1457053448);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Admin', 1, 'สำหรับการดูแลระบบ', NULL, NULL, 1457053447, 1457053447),
('Author', 1, 'สำหรับการเขียนบทความ', NULL, NULL, 1457053447, 1457053447),
('Management', 1, 'สำหรับจัดการข้อมูลผู้ใช้งานและบทความ', NULL, NULL, 1457053447, 1457053447),
('ManageUser', 1, 'สำหรับจัดการข้อมูลผู้ใช้งาน', NULL, NULL, 1457053447, 1457053447);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Admin', 'Management'),
('Management', 'Author'),
('Management', 'ManageUser');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1457005250),
('m130524_201442_init', 1457005257),
('m140506_102106_rbac_init', 1457051827);

-- --------------------------------------------------------

--
-- Table structure for table `ms_institution`
--

CREATE TABLE `ms_institution` (
  `id` int(11) NOT NULL,
  `name_th` varchar(50) NOT NULL,
  `name_en` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ms_institution_type`
--

CREATE TABLE `ms_institution_type` (
  `id` int(11) NOT NULL,
  `name_th` varchar(30) CHARACTER SET utf8 NOT NULL,
  `name_en` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_lecturer`
--

CREATE TABLE `ms_lecturer` (
  `id` int(11) NOT NULL,
  `name_th` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name_en` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_objective`
--

CREATE TABLE `ms_objective` (
  `id` int(11) NOT NULL,
  `name_th` varchar(30) CHARACTER SET utf8 NOT NULL,
  `name_en` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_objective`
--

INSERT INTO `ms_objective` (`id`, `name_th`, `name_en`, `status`, `deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'แนะแนว', 'แนะแนว', 1, 0, '2016-03-07 16:07:50', 1, '2016-03-07 16:07:50', 1),
(2, 'คัดเลือกศึกษาต่อ', 'คัดเลือกศึกษาต่อ', 1, 0, '2016-03-07 16:14:53', 1, '2016-03-07 16:14:53', 1),
(3, 'คัดเลือกพนักงาน', 'คัดเลือกพนักงาน', 1, 0, '2016-03-07 16:19:38', 1, '2016-03-07 16:19:38', 1),
(4, 'วิจัย', 'วิจัย', 1, 0, '2016-03-07 16:20:24', 1, '2016-03-07 16:20:24', 1),
(5, 'ชิงทุน', 'ชิงทุน', 1, 0, '2016-03-07 16:21:05', 1, '2016-03-07 16:21:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_province`
--

CREATE TABLE `ms_province` (
  `id` int(11) NOT NULL,
  `name_th` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name_en` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_test_type`
--

CREATE TABLE `ms_test_type` (
  `id` int(11) NOT NULL,
  `name_th` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name_en` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_test_type`
--

INSERT INTO `ms_test_type` (`id`, `name_th`, `name_en`, `status`, `deleted`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'แบบทดสอบวัดผลสัมฤทธิ์', 'Achievement test', 1, 0, '2016-03-07 16:38:27', 1, '2016-03-07 16:38:27', 1),
(2, 'แบบทดสอบวัดความถนัดทางการเรียน', 'Aptitude test', 1, 0, '2016-03-07 16:38:45', 1, '2016-03-07 16:38:45', 1),
(3, 'แบบทดสอบทางจิตพิสัย', 'Affective test', 1, 0, '2016-03-07 16:39:04', 1, '2016-03-07 16:39:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trn_edu_testing`
--

CREATE TABLE `trn_edu_testing` (
  `id` int(11) NOT NULL,
  `ins_id` int(11) NOT NULL,
  `ins_type_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `edu_lv_testing_id` int(11) NOT NULL,
  `edu_test_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trn_even_log`
--

CREATE TABLE `trn_even_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_ip` varchar(20) NOT NULL,
  `event` varchar(20) NOT NULL,
  `remark` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_th` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_en` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname_th` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname_en` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name_th`, `name_en`, `lastname_th`, `lastname_en`, `mobile`, `tel`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL, '', '', 'tyoQ8hOlW78YXn41SVGgEi5__n0oXhOK', '$2y$13$JV9eKRQizqb7bO4Fx.eDq.TbNeDpL/B0mwDMahp8yvrymZDx617f6', '', 'anurak.jiw@gmail.com', 10, 1456817582, 1456817582),
(2, 'user-a', NULL, NULL, NULL, NULL, '', '', 'N9F82Mp1uX6NzLX4WL_Ah-kZGpBifX92', '$2y$13$fo1IAs5xoDrlqw8dIzFWguTA0N/v0hWyYbrYZ6tckCkaLgMt5h.e.', NULL, 'user-a@hotmail.com', 10, 1457050861, 1457050861),
(3, 'user-b', NULL, NULL, NULL, NULL, '', '', '7ttdSRv7_nsNs8VRBuIEiC_DnsMXLfMW', '$2y$13$tQ1Tq8NdgMEuycU7Vmdm7u13q/CSH4ZYxhtlFNIUvSXdq1141.uPG', NULL, 'user-b@hotmail.com', 10, 1457050895, 1457050895),
(4, 'user-c', NULL, NULL, NULL, NULL, '', '', 'PpRs2HAWEQRkLY4RhYdU7CoFhE3RKZDb', '$2y$13$x7t8RViepZs9CB7wxGZJcOGODacs71tBBa1WN3T4S4VVmGwstskT6', NULL, 'user-c@hotmail.com', 10, 1457050922, 1457050922),
(5, 'user-d', NULL, NULL, NULL, NULL, '', '', 'G-W5J59WTkHdQOaTuFdxWR5D7y-HQ8dw', '$2y$13$dcb7Smm7dGFePIQTSBWUhuL4RCZLdxjFm7cgqYx74bhrqKRXibm7y', NULL, 'user-d@hotmail.com', 10, 1457050961, 1457050961);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `ms_institution`
--
ALTER TABLE `ms_institution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_by_2` (`created_by`),
  ADD KEY `updated_by_2` (`updated_by`);

--
-- Indexes for table `ms_institution_type`
--
ALTER TABLE `ms_institution_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `ms_lecturer`
--
ALTER TABLE `ms_lecturer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_by_2` (`created_by`),
  ADD KEY `updated_by_2` (`updated_by`);

--
-- Indexes for table `ms_objective`
--
ALTER TABLE `ms_objective`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `ms_province`
--
ALTER TABLE `ms_province`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `ms_test_type`
--
ALTER TABLE `ms_test_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_by_2` (`created_by`),
  ADD KEY `updated_by_2` (`updated_by`);

--
-- Indexes for table `trn_edu_testing`
--
ALTER TABLE `trn_edu_testing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_even_log`
--
ALTER TABLE `trn_even_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ms_institution`
--
ALTER TABLE `ms_institution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ms_institution_type`
--
ALTER TABLE `ms_institution_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ms_lecturer`
--
ALTER TABLE `ms_lecturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ms_objective`
--
ALTER TABLE `ms_objective`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ms_province`
--
ALTER TABLE `ms_province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ms_test_type`
--
ALTER TABLE `ms_test_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `trn_edu_testing`
--
ALTER TABLE `trn_edu_testing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trn_even_log`
--
ALTER TABLE `trn_even_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
