-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2022 at 03:47 PM
-- Server version: 8.0.17
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rnddata`
--

-- --------------------------------------------------------

--
-- Table structure for table `board_candidates`
--

CREATE TABLE `board_candidates` (
  `id` int(11) NOT NULL,
  `board_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `total_candidate` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `board_candidates`
--

INSERT INTO `board_candidates` (`id`, `board_name`, `total_candidate`, `status`, `updated_at`, `deleted_at`, `deleted_by`) VALUES
(1, '2030', 120, 0, '2022-10-01 14:24:03', '2022-10-01 08:24:03', 3),
(2, '2025', 137, 0, '2022-09-04 15:15:51', NULL, NULL),
(3, '2329', 155, 1, '2022-10-01 14:20:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `board_config`
--

CREATE TABLE `board_config` (
  `id` int(11) NOT NULL,
  `test_group_id` int(11) NOT NULL,
  `result` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chest_no` int(11) NOT NULL,
  `secret_key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roll_no` int(11) NOT NULL,
  `course` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `board_no` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_logged_in` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=Yes, 0=No',
  `seat_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `chest_no`, `secret_key`, `roll_no`, `course`, `board_no`, `name`, `email`, `address`, `password`, `phone`, `image`, `created_at`, `updated_at`, `deleted_at`, `is_logged_in`, `seat_no`) VALUES
(1, 0, 'preview', 0, NULL, 'preview', 'preview', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `candidate_exams`
--

CREATE TABLE `candidate_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` int(11) DEFAULT NULL COMMENT 'FK:candidates.id',
  `exam_config_id` int(11) NOT NULL COMMENT 'FK:exam_configs.id',
  `instruction_seen_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1=Seen, 0=Unseen',
  `demo_exam_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1=Completed, 0=Pending',
  `board_id` int(11) DEFAULT NULL COMMENT 'FK:boards.id',
  `exam_date` date DEFAULT NULL COMMENT 'Exam Date',
  `exam_duration` int(11) DEFAULT NULL COMMENT 'Exam Duration by Minutes',
  `start_time` time DEFAULT NULL COMMENT 'Exam Start Time',
  `end_time` time DEFAULT NULL COMMENT 'Exam End Time',
  `running_exam_time` time DEFAULT NULL COMMENT 'Running Exam time',
  `remaining_exam_duration` int(11) DEFAULT NULL COMMENT 'Remaining Exam Duration by Minutes',
  `exam_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Not Running, 1=Running, 2=Finished/Completed, 3=Hold\r\n',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `deleted_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_exam_details`
--

CREATE TABLE `candidate_exam_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sl_no` int(11) NOT NULL,
  `candidate_exam_id` int(11) DEFAULT NULL COMMENT 'FK:candidate_exams.id',
  `candidate_id` int(11) DEFAULT NULL COMMENT 'FK:candidates.id',
  `item_bank_id` int(11) DEFAULT NULL COMMENT 'FK:item_banks.id',
  `sub_item_bank_id` int(11) DEFAULT NULL COMMENT 'FK:item_banks.sub_questions.index',
  `question_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=Main Question, 2=Sub-Questions',
  `item_type` int(11) DEFAULT NULL COMMENT 'comment pending',
  `option_type` int(11) DEFAULT NULL COMMENT 'comment pending',
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `correct_answer_id` int(11) DEFAULT NULL COMMENT 'Options Array index id 0,1,2..',
  `answer_id` int(11) DEFAULT NULL COMMENT 'Options Array index id 0,1,2..',
  `answer_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Correct Answer, 0=In-Correct Answer',
  `running_question_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Yes, 0=No',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Answered',
  `item_status` int(11) NOT NULL DEFAULT '1',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `deleted_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_type`
--

CREATE TABLE `candidate_type` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidate_type`
--

INSERT INTO `candidate_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'HSC', '2022-07-29 17:44:59', '2022-07-29 17:44:59'),
(2, 'Graduate', '2022-07-29 17:45:22', '2022-07-29 17:45:22'),
(3, 'Master', '2022-07-29 17:45:38', '2022-07-29 17:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `exam_configs`
--

CREATE TABLE `exam_configs` (
  `id` int(11) NOT NULL,
  `board_candidate_id` int(11) NOT NULL COMMENT 'PK = board_candidate.id',
  `exam_date` date NOT NULL,
  `exam_start_time` time DEFAULT NULL,
  `exam_end_time` time DEFAULT NULL,
  `exam_duration` int(11) NOT NULL,
  `guest_time_duration` time DEFAULT NULL,
  `test_config_id` int(11) NOT NULL COMMENT 'FK = test_configs.id',
  `assign_to` int(11) DEFAULT NULL COMMENT 'FK = users.id',
  `exam_status` tinyint(4) NOT NULL COMMENT '0=Upcomming, 1=Running, 2=Completed, 3=Cacel, 4=Prestart',
  `preview_status` tinyint(2) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active, 2=Force Stop',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_config_statuses`
--

CREATE TABLE `exam_config_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sl_no` int(11) DEFAULT NULL COMMENT 'serial_no',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_config_statuses`
--

INSERT INTO `exam_config_statuses` (`id`, `sl_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Upcoming', NULL, NULL),
(2, 1, 'Running', NULL, NULL),
(3, 2, 'Completed', NULL, NULL),
(4, 3, 'Cancel', NULL, NULL),
(5, 4, 'Pre-start', NULL, NULL),
(6, 5, 'Stop', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_bank`
--

CREATE TABLE `item_bank` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `item_for` int(11) NOT NULL,
  `level` int(11) NOT NULL COMMENT 'pk = item_level.id',
  `category` int(11) DEFAULT NULL,
  `tag1` int(6) DEFAULT NULL,
  `tag2` int(6) DEFAULT NULL,
  `tag3` int(6) DEFAULT NULL,
  `tag4` int(6) DEFAULT NULL,
  `tag5` int(6) DEFAULT NULL,
  `tag6` int(6) DEFAULT NULL,
  `tag7` int(6) DEFAULT NULL,
  `top_text` text,
  `down_text` text,
  `item_type` int(11) NOT NULL COMMENT '1=Text,2=Image,3=Sound',
  `item` varchar(255) NOT NULL,
  `sub_question_status` varchar(11) DEFAULT NULL,
  `option_type` varchar(11) DEFAULT NULL COMMENT '1=Text,2=Image,3=Sound	',
  `options` text,
  `correct_answer` varchar(255) DEFAULT NULL,
  `sub_question_type` varchar(255) DEFAULT NULL COMMENT '1=Text,2=Image,3=Sound	',
  `sub_question` text,
  `sub_option_type` varchar(255) DEFAULT NULL COMMENT '1=Text,2=Image,3=Sound	',
  `sub_options` text,
  `sub_correct_answer` varchar(255) DEFAULT NULL,
  `item_status` int(11) NOT NULL COMMENT 'FK:item_statuses.id',
  `test_type` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_bank`
--

INSERT INTO `item_bank` (`id`, `name`, `item_for`, `level`, `category`, `tag1`, `tag2`, `tag3`, `tag4`, `tag5`, `tag6`, `tag7`, `top_text`, `down_text`, `item_type`, `item`, `sub_question_status`, `option_type`, `options`, `correct_answer`, `sub_question_type`, `sub_question`, `sub_option_type`, `sub_options`, `sub_correct_answer`, `item_status`, `test_type`, `created_at`) VALUES
(67, 'Demo PM 1', 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_212.jpg', NULL, '2', '5_212.jpg||5_212.jpg||3_212.jpg||3_212.jpg||5_212.jpg||4_212.jpg||4_212.jpg||6_212.jpg', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 03:38:16'),
(68, 'Demo PM 2', 1, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_212.jpg', NULL, '2', '4_212.jpg||4_212.jpg||3_212.jpg||4_212.jpg||6_212.jpg||5_212.jpg||5_212.jpg||6_212.jpg', '8', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 03:47:14'),
(69, 'Demo PM 3', 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_212.jpg', NULL, '2', '6_212.jpg||5_212.jpg||3_212.jpg||4_212.jpg||4_212.jpg||6_212.jpg||4_212.jpg||3_212.jpg', '8', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 05:43:13'),
(70, 'Demo PM 4', 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_212.jpg', NULL, '2', '5_212.jpg||5_212.jpg||6_212.jpg||6_212.jpg||3_212.jpg||6_212.jpg||6_212.jpg||3_212.jpg', '7', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 05:47:17'),
(71, 'Demo PM 5', 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_212.jpg', NULL, '2', '3_212.jpg||6_212.jpg||5_212.jpg||5_212.jpg||5_212.jpg||3_212.jpg||3_212.jpg||4_212.jpg', '6', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 05:49:55'),
(72, 'Demo PM 6', 1, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_212.jpg', NULL, '2', '5_212.jpg||4_212.jpg||5_212.jpg||5_212.jpg||5_212.jpg||4_212.jpg||3_212.jpg||3_212.jpg', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 05:51:34'),
(73, 'Demo PM 7', 1, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_212.jpg', NULL, '2', '6_212.jpg||6_212.jpg||3_212.jpg||5_212.jpg||6_212.jpg||3_212.jpg||5_212.jpg||3_212.jpg', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 05:53:09'),
(74, 'Demo PM 8', 1, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_212.jpg', NULL, '2', '3_212.jpg||3_212.jpg||4_212.jpg||4_212.jpg||3_212.jpg||6_212.jpg||4_212.jpg||6_212.jpg', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 05:55:23'),
(75, 'Demo PM 9', 1, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_212.jpg', NULL, '2', '3_212.jpg||6_212.jpg||4_212.jpg||4_212.jpg||3_212.jpg||6_212.jpg||5_212.jpg||3_212.jpg', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:01:33'),
(76, 'Demo PM 10', 1, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_212.jpg', NULL, '2', '6_212.jpg||4_212.jpg||4_212.jpg||4_212.jpg||3_212.jpg||4_212.jpg||6_212.jpg||6_212.jpg', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:04:09'),
(77, 'Demo PM 11', 1, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_212.jpg', NULL, '2', '6_212.jpg||3_212.jpg||4_212.jpg||5_212.jpg||6_212.jpg||3_212.jpg||4_212.jpg||3_212.jpg', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:06:33'),
(78, 'Demo PM 12', 1, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_212.jpg', NULL, '2', '4_212.jpg||4_212.jpg||4_212.jpg||3_212.jpg||6_212.jpg||6_212.jpg||6_212.jpg||6_212.jpg', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:08:45'),
(79, 'Demo PM 13', 1, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_212.jpg', NULL, '2', '3_212.jpg||4_212.jpg||4_212.jpg||6_212.jpg||3_212.jpg||6_212.jpg||4_212.jpg||4_212.jpg', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:11:37'),
(80, 'Demo PM 14', 1, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_212.jpg', NULL, '2', '5_212.jpg||4_212.jpg||5_212.jpg||3_212.jpg||4_212.jpg||5_212.jpg||5_212.jpg||6_212.jpg', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:13:07'),
(81, 'Demo PM 15', 1, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_212.jpg', NULL, '2', '6_212.jpg||5_212.jpg||6_212.jpg||3_212.jpg||4_212.jpg||5_212.jpg||5_212.jpg||3_212.jpg', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:14:38'),
(82, 'Demo PM 16', 1, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_212.jpg', NULL, '2', '5_212.jpg||4_212.jpg||3_212.jpg||3_212.jpg||5_212.jpg||4_212.jpg||6_212.jpg||6_212.jpg', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:15:57'),
(83, 'Demo PM 17', 1, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_212.jpg', NULL, '2', '4_212.jpg||6_212.jpg||3_212.jpg||5_212.jpg||4_212.jpg||4_212.jpg||5_212.jpg||4_212.jpg', '6', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:17:17'),
(84, 'Demo PM 18', 1, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_212.jpg', NULL, '2', '3_212.jpg||3_212.jpg||6_212.jpg||3_212.jpg||5_212.jpg||4_212.jpg||4_212.jpg||4_212.jpg', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:18:42'),
(85, 'Demo PM 19', 1, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_212.jpg', NULL, '2', '5_212.jpg||4_212.jpg||3_212.jpg||6_212.jpg||5_212.jpg||5_212.jpg||3_212.jpg||5_212.jpg', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:41:01'),
(86, 'Demo PM 20', 1, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_212.jpg', NULL, '2', '3_212.jpg||3_212.jpg||5_212.jpg||4_212.jpg||5_212.jpg||6_212.jpg||5_212.jpg||5_212.jpg', '7', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:43:08'),
(87, 'Demo PM 21', 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_212.jpg', NULL, '2', '3_212.jpg||5_212.jpg||3_212.jpg||5_212.jpg||3_212.jpg||4_212.jpg||3_212.jpg||5_212.jpg', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:45:23'),
(88, 'Demo PM 22', 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_212.jpg', NULL, '2', '5_212.jpg||6_212.jpg||5_212.jpg||3_212.jpg||5_212.jpg||3_212.jpg||4_212.jpg||6_212.jpg', '7', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-19 06:46:38'),
(89, 'pm 1', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture.JPG 2.JPG', NULL, '2', '5_Capture.JPG||6_Capture.JPG 2.JPG||5_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG||4_Capture.JPG||5_Capture.JPG 2.JPG', '8', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:05:08'),
(90, 'pm 2', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_Capture.JPG', NULL, '2', '3_Capture.JPG||4_Capture.JPG 2.JPG||3_Capture.JPG 2.JPG||6_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||6_Capture.JPG 2.JPG||5_Capture.JPG', '7', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:06:28'),
(91, 'pm 3', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture.JPG 2.JPG', NULL, '2', '6_Capture.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||5_Capture.JPG 2.JPG||4_Capture.JPG||3_Capture.JPG 2.JPG', '6', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:07:39'),
(92, 'pm 4', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Capture.JPG 2.JPG', NULL, '2', '6_Capture.JPG||3_Capture.JPG 2.JPG||4_Capture.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG||6_Capture.JPG 2.JPG||6_Capture.JPG||4_Capture.JPG 2.JPG', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:09:20'),
(93, 'pm 5', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture.JPG 2.JPG', NULL, '2', '4_Capture.JPG 2.JPG||5_Capture.JPG||4_Capture.JPG 2.JPG||4_Capture.JPG||5_Capture.JPG 2.JPG||3_Capture.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:10:42'),
(94, 'pm 6', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG', NULL, '2', '3_Capture.JPG 2.JPG||3_Capture.JPG||3_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG||4_Capture.JPG||6_Capture.JPG 2.JPG||5_Capture.JPG', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:12:04'),
(95, 'pm 7', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_Capture.JPG 2.JPG', NULL, '2', '3_Capture.JPG||6_Capture.JPG 2.JPG||3_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG||6_Capture.JPG 2.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:13:14'),
(96, 'pm 8', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG', NULL, '2', '6_Capture.JPG 2.JPG||3_Capture.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG||3_Capture.JPG 2.JPG||5_Capture.JPG||4_Capture.JPG 2.JPG||4_Capture.JPG', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:14:35'),
(97, 'pm 9', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture.JPG 2.JPG', NULL, '2', '5_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG||6_Capture.JPG||5_Capture.JPG 2.JPG||5_Capture.JPG||6_Capture.JPG 2.JPG||3_Capture.JPG', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:16:18'),
(98, 'pm 10', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG', NULL, '2', '4_Capture.JPG 2.JPG||3_Capture.JPG||3_Capture.JPG 2.JPG||4_Capture.JPG||6_Capture.JPG 2.JPG||3_Capture.JPG||5_Capture.JPG 2.JPG||3_Capture.JPG', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:18:10'),
(99, 'pm 11', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture.JPG 2.JPG', NULL, '2', '5_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG||3_Capture.JPG||6_Capture.JPG 2.JPG||6_Capture.JPG||3_Capture.JPG 2.JPG||5_Capture.JPG', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:21:07'),
(100, 'pm 12', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_Capture.JPG 2.JPG', NULL, '2', '3_Capture.JPG||5_Capture.JPG||3_Capture.JPG||6_Capture.JPG 2.JPG||6_Capture.JPG 2.JPG||3_Capture.JPG 2.JPG||6_Capture.JPG||5_Capture.JPG 2.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:22:14'),
(101, 'pm 13', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture.JPG', NULL, '2', '6_Capture.JPG 2.JPG||5_Capture.JPG 2.JPG||3_Capture.JPG 2.JPG||3_Capture.JPG||4_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||3_Capture.JPG 2.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:23:22'),
(102, 'pm 14', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture.JPG', NULL, '2', '4_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG||3_Capture.JPG||5_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:24:56'),
(103, 'pm 15', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Capture.JPG', NULL, '2', '4_Capture.JPG 2.JPG||6_Capture.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG||5_Capture.JPG 2.JPG||3_Capture.JPG||4_Capture.JPG 2.JPG||3_Capture.JPG', '7', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:26:15'),
(104, 'pm 16', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Capture.JPG 2.JPG', NULL, '2', '6_Capture.JPG||3_Capture.JPG 2.JPG||4_Capture.JPG||6_Capture.JPG 2.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG||5_Capture.JPG 2.JPG||5_Capture.JPG', '8', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:28:15'),
(105, 'pm 17', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Capture.JPG', NULL, '2', '3_Capture.JPG||4_Capture.JPG 2.JPG||4_Capture.JPG||3_Capture.JPG 2.JPG||4_Capture.JPG||3_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:29:50'),
(106, 'pm 18', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_Capture.JPG', NULL, '2', '6_Capture.JPG 2.JPG||5_Capture.JPG||4_Capture.JPG||5_Capture.JPG 2.JPG||5_Capture.JPG||4_Capture.JPG 2.JPG||4_Capture.JPG 2.JPG||3_Capture.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:31:23'),
(107, 'pm 19', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG 2.JPG', NULL, '2', '5_Capture.JPG||3_Capture.JPG||3_Capture.JPG||3_Capture.JPG||4_Capture.JPG||3_Capture.JPG 2.JPG||4_Capture.JPG 2.JPG||4_Capture.JPG 2.JPG', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:32:36'),
(108, 'pm 20', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_Capture.JPG', NULL, '2', '6_Capture.JPG 2.JPG||6_Capture.JPG||6_Capture.JPG 2.JPG||6_Capture.JPG||4_Capture.JPG 2.JPG||6_Capture.JPG||6_Capture.JPG 2.JPG||6_Capture.JPG', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:34:03'),
(109, 'pm 21', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Capture.JPG', NULL, '2', '4_Capture.JPG||5_Capture.JPG 2.JPG||4_Capture.JPG||6_Capture.JPG 2.JPG||3_Capture.JPG||4_Capture.JPG 2.JPG||4_Capture.JPG||3_Capture.JPG 2.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:35:11'),
(110, 'pm 22', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture.JPG', NULL, '2', '5_Capture.JPG 2.JPG||3_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||5_Capture.JPG 2.JPG||5_Capture.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:36:21'),
(111, 'pm 23', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG', NULL, '2', '4_Capture.JPG 2.JPG||6_Capture.JPG||5_Capture.JPG 2.JPG||4_Capture.JPG||3_Capture.JPG 2.JPG||6_Capture.JPG||4_Capture.JPG 2.JPG||6_Capture.JPG', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:37:28'),
(112, 'pm 24', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture.JPG 2.JPG', NULL, '2', '6_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG||5_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG||5_Capture.JPG 2.JPG', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:38:39'),
(113, 'pm 25', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG', NULL, '2', '5_Capture.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG||4_Capture.JPG 2.JPG||5_Capture.JPG 2.JPG||4_Capture.JPG||3_Capture.JPG', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:40:03'),
(114, 'pm 26', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG', NULL, '2', '4_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||5_Capture.JPG 2.JPG||5_Capture.JPG||5_Capture.JPG 2.JPG||5_Capture.JPG||6_Capture.JPG 2.JPG', '7', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:41:14'),
(115, 'pm 27', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Capture.JPG 2.JPG', NULL, '2', '3_Capture.JPG 2.JPG||5_Capture.JPG||5_Capture.JPG 2.JPG||3_Capture.JPG||5_Capture.JPG 2.JPG||3_Capture.JPG||5_Capture.JPG 2.JPG||5_Capture.JPG', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:44:19'),
(116, 'pm 28', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG', NULL, '2', '5_Capture.JPG||4_Capture.JPG 2.JPG||5_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||6_Capture.JPG 2.JPG||5_Capture.JPG||4_Capture.JPG 2.JPG', '7', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:45:21'),
(117, 'pm 29', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG 2.JPG', NULL, '2', '6_Capture.JPG 2.JPG||4_Capture.JPG||6_Capture.JPG 2.JPG||5_Capture.JPG||3_Capture.JPG 2.JPG||3_Capture.JPG||3_Capture.JPG 2.JPG||6_Capture.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:46:37'),
(118, 'pm 30', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Capture.JPG 2.JPG', NULL, '2', '3_Capture.JPG||6_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG||3_Capture.JPG||5_Capture.JPG 2.JPG', '7', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:47:49'),
(119, 'pm 31', 2, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_Capture.JPG 2.JPG', NULL, '2', '3_Capture.JPG||4_Capture.JPG 2.JPG||3_Capture.JPG||4_Capture.JPG 2.JPG||4_Capture.JPG||5_Capture.JPG 2.JPG||3_Capture.JPG||5_Capture.JPG 2.JPG', '8', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:55:18'),
(120, 'pm 32', 2, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Capture.JPG', NULL, '2', '4_Capture.JPG||4_Capture.JPG 2.JPG||5_Capture.JPG 2.JPG||3_Capture.JPG||3_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG||6_Capture.JPG', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:56:27'),
(121, 'pm 33', 2, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG 2.JPG', NULL, '2', '4_Capture.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG||3_Capture.JPG 2.JPG||4_Capture.JPG||3_Capture.JPG 2.JPG||6_Capture.JPG||3_Capture.JPG 2.JPG', '6', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:57:31'),
(122, 'pm 34', 2, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG', NULL, '2', '5_Capture.JPG 2.JPG||3_Capture.JPG||3_Capture.JPG 2.JPG||6_Capture.JPG||3_Capture.JPG||4_Capture.JPG||3_Capture.JPG 2.JPG||3_Capture.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 07:58:47'),
(123, 'pm 35', 2, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG', NULL, '2', '6_Capture.JPG||4_Capture.JPG 2.JPG||3_Capture.JPG||3_Capture.JPG 2.JPG||3_Capture.JPG||3_Capture.JPG 2.JPG||3_Capture.JPG||3_Capture.JPG 2.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 08:00:18'),
(124, 'pm 36', 2, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture.JPG', NULL, '2', '4_Capture.JPG 2.JPG||4_Capture.JPG||4_Capture.JPG 2.JPG||5_Capture.JPG||6_Capture.JPG 2.JPG||6_Capture.JPG||4_Capture.JPG 2.JPG||5_Capture.JPG', '7', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 08:01:59'),
(125, 'pm 37', 2, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_Capture.JPG', NULL, '2', '6_Capture.JPG||3_Capture.JPG 2.JPG||5_Capture.JPG 2.JPG||5_Capture.JPG||4_Capture.JPG 2.JPG||3_Capture.JPG||3_Capture.JPG 2.JPG||5_Capture.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 08:03:08'),
(126, 'pm 38', 2, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Capture.JPG 2.JPG', NULL, '2', '5_Capture.JPG 2.JPG||6_Capture.JPG||5_Capture.JPG 2.JPG||5_Capture.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG||6_Capture.JPG 2.JPG||3_Capture.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 08:05:17'),
(127, 'pm 39', 2, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_Capture.JPG', NULL, '2', '4_Capture.JPG||4_Capture.JPG 2.JPG||5_Capture.JPG 2.JPG||5_Capture.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG||3_Capture.JPG 2.JPG||3_Capture.JPG', '6', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 08:06:22'),
(128, 'pm 40', 2, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.JPG 2.JPG', NULL, '2', '6_Capture.JPG||3_Capture.JPG 2.JPG||6_Capture.JPG||3_Capture.JPG 2.JPG||5_Capture.JPG||5_Capture.JPG 2.JPG||6_Capture.JPG||5_Capture.JPG 2.JPG', '6', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 08:07:45'),
(129, 'VIT 1', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'asdasdsdad', NULL, '1', 'asdsdsdsad||asdsdsdsd||asdsdsdsd||asdsdsadsad||asdsadsdsad', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 08:11:44'),
(130, 'VIT 2', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'gfhjfjhgkjhklhjkl', NULL, '1', 'kulgiuyjgliukj||kjyhfgkyjhgjh||reuyjuhjyli||yjrfjyhgg||asdsdsdsad', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 08:14:57'),
(131, 'pm 41', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture 2.PNG', NULL, '2', '5_Capture.PNG||5_Capture 2.PNG||4_Capture 2.PNG||3_Capture 2.PNG||3_Capture.PNG||5_Capture.PNG||5_Capture 2.PNG||6_Capture.PNG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:17:45'),
(132, 'VIT 3', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'asadsfsd', NULL, '1', 'adfad||5552||585852||jjmkjk||5555', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:23:17'),
(133, 'VIT 4', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2,3,3,4,4,5,??', NULL, '1', '6,7||10,11||5,6||8,9||12,13', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:23:39'),
(134, 'pm 42', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Capture.PNG', NULL, '2', '5_Capture.PNG||3_Capture.PNG||5_Capture.PNG||5_Capture.PNG||3_Capture.PNG||5_Capture.PNG||4_Capture.PNG||5_Capture.PNG', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:30:42'),
(135, 'pm 43', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Captureas.PNG', NULL, '2', '5_Captureas.PNG||3_Captureas.PNG||3_Captureas.PNG||5_Captureas.PNG||3_Captureas.PNG||6_Captureas.PNG||4_Captureas.PNG||5_Captureas.PNG', '6', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:45:27'),
(136, 'pm 44', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Capture.PNG', NULL, '2', '6_Capture.PNG||6_Capture.PNG||5_Capture.PNG||4_Capture.PNG||4_Capture.PNG||4_Captureas.PNG||3_Captureas.PNG||3_Captureas.PNG', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:48:15'),
(137, 'VIT 5', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'IIf AXY=CZA, ZBD=?', NULL, '1', 'BRY||BDF||ADF||CDE||SRT', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:49:19'),
(138, 'pm 45', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '3_Captureas.PNG', NULL, '2', '4_Capture.PNG||5_Captureas.PNG||6_Captureas.PNG||6_Captureas.PNG||3_Captureas.PNG||5_Captureas.PNG||4_Captureas.PNG||4_Capture.PNG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:49:39'),
(139, 'pm 46', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Capture.PNG', NULL, '2', '6_Captureas.PNG||5_Captureas.PNG||6_Captureas.PNG||5_Capture.PNG||6_Capture.PNG||6_Capture.PNG||3_Capture.PNG||4_Capture.PNG', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:51:08'),
(140, 'VIT 6', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'What is the last letter of AMNOG?\r\nName of a fruit.aetrjdtyktykyu', NULL, '1', 'sfgdfh||ddgb||dhn||sgdrh||dhg', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:52:20'),
(141, 'pm 47', 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '4_Captureas.PNG', NULL, '2', '3_Captureas.PNG||5_Captureas.PNG||3_Captureas.PNG||3_Captureas.PNG||5_Captureas.PNG||3_Captureas.PNG||5_Captureas.PNG||6_Captureas.PNG', '6', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:52:35'),
(142, 'VIT 7', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'sdGhdjghkfdjjjjjjjjjjjjjjj', NULL, '1', 'ags||hdfhfg||hfghd||fgjhh||dhfj', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:53:32'),
(143, 'pm 48', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Capture.PNG', NULL, '2', '5_Capture.PNG||5_Capture.PNG||4_Capture.PNG||4_Capture.PNG||5_Capture.PNG||4_Capture.PNG||4_Capture.PNG||5_Capture.PNG', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:53:44'),
(144, 'VIT8', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DSGGGGGGGGJFGJGH', NULL, '1', 'DSFGJGHK||JFF||gjghj||,luku||wsrth', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:54:34'),
(145, 'pm 49', 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_Captureas.PNG', NULL, '2', '5_Captureas.PNG||4_Captureas.PNG||4_Captureas.PNG||6_Captureas.PNG||4_Captureas.PNG||4_Captureas.PNG||4_Captureas.PNG||6_Captureas.PNG', '8', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:55:04'),
(146, 'VIT 9', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'SFJGHKTRHER', NULL, '1', 'GHKGD||GKYDF||MSFJH||JKJTY||CGHJTY', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:55:42'),
(147, 'pm 50', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '5_Capture.PNG', NULL, '2', '3_Capture.PNG||5_Capture.PNG||4_Capture.PNG||3_Capture.PNG||4_Capture.PNG||5_Capture.PNG||4_Capture.PNG||6_Capture.PNG', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:56:14'),
(148, 'VIT10', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DZFHSTJUGK', NULL, '1', 'GKGYK||DFJFJ||SRTJTR||KGDT||SRTJRYJ', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:56:33'),
(149, 'VIT 11', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DFNJGHKTUK', NULL, '1', 'JSRJRYJ||TYKSRJ||KDTUKTY||LKDTYKR||TDKDTYJTY', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:57:28'),
(150, 'VIT 12', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DFGSDHSH', NULL, '1', 'FSF||SGDF||FSF||EHG||GFDF', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:57:50'),
(151, 'VIT 13', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'UTDDDDDDDDDD', NULL, '1', 'GUKGY||GKMSRTJ||K,TDJSR||GSRTH||TURSUTR', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:58:31'),
(152, 'VIT 14', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'KGHHDFGSD', NULL, '1', 'GSDG||SDWS||GAESEA||AFAW||ARF', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 11:58:46'),
(153, 'VIT 15', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DTHTFDCFFG', NULL, '1', 'SDFHDFNH||FGMFGM||FGMG||FGMFGM||FGFG', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:02:45'),
(154, 'VIT 16', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'BXBXFBBX', NULL, '1', 'HDFHSD||GHDH||DFSDG||GDGD||AFGED', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:02:50'),
(155, 'VIT 17', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FHDFHDR', NULL, '1', 'HRHRF||SRHH||RHSYHSR||SRH||HDRH', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:03:49'),
(156, 'VIT 18', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'CGJHTRJFYJ', NULL, '1', 'GJFJ||HMFG||GHJTF||FGJF||FJF', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:04:25'),
(157, 'VIT 19', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'GFHDFGJ', NULL, '1', 'BGXFBF||DFBGSX||GSXHF||DGD||GXFGDXH', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:05:17'),
(158, 'VIT 20', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ERHTHTFJSRY', NULL, '1', 'RHTH||FGJTR||TFJTJ||FTJTR||FGJT', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:05:31'),
(159, 'VIT 21', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'HJGHS', NULL, '1', 'JHSRDHS||SGSRJ||GDHSX||GDGJR||FHHSDH', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:06:41'),
(160, 'VIT 22', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FJFGJFJ', NULL, '1', 'GHMFGJ||FGJTJ||FJTRJ||FJTFJ||DTJTJ', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:08:56'),
(161, 'VIT 23', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DShgTJ', NULL, '1', 'FGJ||FGJ||FGJF||FGJ||FTJHT', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:10:02'),
(162, 'VIT 24', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'JTRJRTJHRT', NULL, '1', 'TRHTR||FGJFY||FJ||FYJY||YJY', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:11:03'),
(163, 'VIT 34', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'MGJDFHD', NULL, '1', 'YSRHY||SET||RHSY||TGESYH||JGDJ', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:11:26'),
(164, 'VIT 35', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'KDKJDRZJ', NULL, '1', 'HDZH||HZCGJ||CGJHGC||sggSR||FHDZ', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:12:07'),
(165, 'VIT 25', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'GHJZDTJTJFJTJTFFJJJJJJJJJJJJJJJF', NULL, '1', 'FTJFTJ||FMFY||FJTRF||TFJTRFJ||TFJRTJ', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:12:10'),
(166, 'VIT 36', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'KDGKSKSG', NULL, '1', 'GJZJFJ||ZHGG||JGFJ||DGHDGJ||LDGK', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:13:04'),
(167, 'VIT 26', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ZJDTJTFJEWHWEGW', NULL, '1', 'RHEH||HERJH||HERHE||TRJEJR||FGMFM', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:13:30'),
(168, 'VIT 38', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'BMDJSFJ', NULL, '1', 'HDFHD||HFDA||HFDH||DFHADH||NFZHDH', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:13:47'),
(169, 'VIT 37', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'USGRH', NULL, '1', 'HJGC||ZHH||CGHCGH||ZHFDGH||XFDH', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:14:39'),
(170, 'VIT 27', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ETHFG', NULL, '1', 'FGJF||BH,GR||XFJE||FJF||DYJR', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:15:26'),
(171, 'VIT 38', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'YDSYSNAT', NULL, '1', 'TSAB||TGMZXFTG||ZMFGZD||FXGMN||JSHNZ', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:15:28'),
(172, 'VIT 39', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'JSFGHNZF', NULL, '1', 'GNDSGSD||GSNDG||GBSGSDN||FGBSG||DFHSDN', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:16:07'),
(173, 'VIT 28', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ZHTJERJTJT', NULL, '1', 'FGKFTKJF||FGHFG||FGND||FGJNT||FJTR', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:17:01'),
(174, 'VIT 29', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ERTHTRJRYJ', NULL, '1', 'TRJSTRJ||TFJTRJ||FTJRTJ||RTJRTJ||RTJTRJ', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:18:45'),
(175, 'VIT 30', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'SWRAHJKYRKT', NULL, '1', 'FGJDT||FGJTR||DGJF||CGNFG||GMNFGM', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:21:12'),
(176, 'VIT 40', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DFHKJFJKX', NULL, '1', 'GADNAF||GDSFGNAD||GHSFND||GSDG NSD||JFJZDH', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:21:43'),
(177, 'VIT 41', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FGADGAG', NULL, '1', 'GNASGS||GNFASTAN||FNGSF||NSTRST||FFHNAGS', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:22:21'),
(178, 'VIT 42', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'GBDTAbe', NULL, '1', 'ADHADH||GAFNHAF||GFNFAG||GFNSA||FHNSg', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:23:16'),
(179, 'VIT 43', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'HMXFNTA', NULL, '1', 'GDNA||GDNA||SNGDSG||FBGSAG||HANGASD', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:24:37'),
(180, 'VIT 44', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FGstaetGD', NULL, '1', 'ASRYNATR||NSRAM||MDRYARSYM||NYSEYMSE||DYUMSU', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:25:23'),
(181, 'VIT 70', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'UVKTY', NULL, '1', 'GHC||GH||FGJ||TFJTRFJ||GHK', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:26:03'),
(182, 'VIT 45', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ATAWTBSA', NULL, '1', 'NRTAN||ANSRTA||ANTARSNRA||BFGTAN||RWEABTAW', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:26:45'),
(183, 'VIT 46', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'TBBAWTRBAWT', NULL, '1', 'ANTR||AYNRYA||YRNAY||RNYAY||RTNARYA', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:27:28'),
(184, 'VIT 47', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'JSHSRNRW', NULL, '1', 'NTWETAW||TSNTAWE||TNAWETWNT||EBTNAWTN||RTBWE', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:28:12'),
(185, 'VIT 48', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'SDGHAB', NULL, '1', 'ASRNTA||TNASRT||NARTANR||TNAWRTNAW||TSTNATR', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:28:51'),
(186, 'VIT 71', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'SFBSF', NULL, '1', 'ND||DGNDF||DFNDG||FGJR||GHF', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:28:52'),
(187, 'VIT 49', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Gbyanryrsrt', NULL, '1', 'TNASTR||ASTRNTA||NSTRAWT||ATNWN||THSDTNYA', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:29:35'),
(188, 'VIT 50', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ULSDTUKSJFT', NULL, '1', 'TBRSA||TASBT||BGSADDT||BSTBS||GHAD YSR', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:30:19'),
(189, 'VIT 72', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'SHJT', NULL, '1', 'FH||DFHD||HDF||DFH||DFH', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:30:33'),
(190, 'VIT 51', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'TBASTN', NULL, '1', 'SFHSRH||HSFH||HSFH||DFHDS||GJHDT', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:42:00'),
(191, 'VIT 73', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FXKXFG', NULL, '1', 'CGJDFG||JMFG||FGJFGJ||JFG||FJF', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:42:12'),
(192, 'VIT 51', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DGJHDGH', NULL, '1', 'HSRH||SYSR||SGSY||GSGS||JDHJ', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:42:35'),
(193, 'VIT 52', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FGsgHF', NULL, '1', 'GSH||GS||GSG||GGW||FGHSG', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:43:25'),
(194, 'VIT 74', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FJF', NULL, '1', 'FGF||DFH||GNGDN||DGN||FGN', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:43:27'),
(195, 'VIT 53', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'JSNHTFS', NULL, '1', 'JNDF||HNDF||NGSR||FGNSF||JHZDF', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:44:09'),
(196, 'VIT 54', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DGJDB', NULL, '1', 'TBSTN||TSBT||TBSRBAT||ASTB||FNDSY', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:44:47'),
(197, 'VIT 75', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'HGGH', NULL, '1', 'JHK||d Field||d Field||d Field||d Field', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:44:59'),
(198, 'VIT 55', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'GBtntn', NULL, '1', 'HSDGNH||HSGHS||HSDS||HSSN||ntdfn', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:45:50'),
(199, 'VIT 56', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'GJFYFYUF', NULL, '1', 'GNS||GN||GNSN||FHZFN||HGHGJZD', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:46:36'),
(200, 'VIT 57', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FHDFNHS', NULL, '1', 'NTST||GNFA||GNFTNS||GNSFTS||FGNZDFN', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:47:20'),
(201, 'VIT 76', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ADGH', NULL, '1', 'DSFH||DFH||BDFB||DNDFB||DFB', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:47:42'),
(202, 'VIT 58', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'JHMSDYM', NULL, '1', 'YRMS||YRMDY||MRASYA||MRATM||TFNTYMA', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:48:01'),
(203, 'VIT 59', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'NHZDFYM', NULL, '1', 'YMS||MSRY||NFSM||GNS||NZFT', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:48:36'),
(204, 'VIT 77', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FJTJ', NULL, '1', 'FTJF||ZHER||FJDTJ||TJT||FJTRJ', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:49:01'),
(205, 'VIT 60', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'JHGJFGK', NULL, '1', 'GYCJHVH||HGDT||HGFHDYT||JHFFTHK||HJGUYYU', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:49:25'),
(206, 'VIT 61', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'JGFHF', NULL, '1', 'RSDFHG||JHGID||JKFH||JKFJG||NGJFJ', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:50:16'),
(207, 'VIT 78', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'TDJK', NULL, '1', 'RTS||RTUJ||RTS||RTJ||RTJ', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:50:24'),
(208, 'VIT 62', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'GHSDTNS', NULL, '1', 'TNSDT||TSNTS||NFDY||ZTNDT||GNSTDNS', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:50:58'),
(209, 'VIT 79', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ge Fi', NULL, '1', 'ge Fi||ge Fi||ge Fi||ge Fi||ge Fi', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:51:29'),
(210, 'VIT 63', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'GBZXFTND', NULL, '1', 'TSTN||TNS||TNSDT||TSNDT||FNST', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:51:35'),
(211, 'VIT 64', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'HSDNS', NULL, '1', 'TNSTN||TSNS||TSTRW||TNST||STRNTS', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:52:14'),
(212, 'VIT 80', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DF', NULL, '1', 'DF||DERG||ERGE||ERG||DRA', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:53:00'),
(213, 'VIT 81', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'SVUSU', NULL, '1', 'SDFHSF||DFJKVD||DFBKJB||ERGJ||DGJG', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 12:56:17'),
(214, 'VIT 65', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'MHJDFHF', NULL, '1', 'HFDFH||HSFHSF||SFHS||GSGS||NXFGHZS', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:09:43'),
(215, 'VIT 66', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FGHDR', NULL, '1', 'DGDB||BFVHX||DVA||VDGV||FHGSF', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:10:22'),
(216, 'VIT 82', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'GDFN', NULL, '1', 'VFGN||FG||GVBN||FGN||FG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:10:29'),
(217, 'VIT 67', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'HDHSRH', NULL, '1', 'FHBSFH||XFGSFH||FHSFDH||GBG||XFHSFH', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:11:15'),
(218, 'DGHN', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DFNDN', 1, 'GND', NULL, '1', 'NDFN||CGNFG||FGN||GM||FGMM', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:11:55'),
(219, 'VIT 68', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FHFSDHS', NULL, '1', 'GSFGHS||DGSDS||GBZDSGH||GDSG||GHSRH', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:11:57'),
(220, 'VIT 69', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'BXHSGAS', NULL, '1', 'GSDGSD||SDFHG||GHSFHSF||GHSGHS||VDGHSDGH', '5', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:12:34'),
(221, 'VIT 83', 4, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'STRHTR', NULL, '1', 'RTSJ||RTJH||TRJ||TR||RTJ', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:12:57'),
(222, 'VIT 90', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'HSFHSRH', NULL, '1', 'GSEG||GFHBG||HSHNJ||GDSGS||HSFHS', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:13:53'),
(223, 'VIT 84', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FYUK', NULL, '1', 'DTYK||YUFK||RDT||DTYDK||TYK', '3', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:13:56'),
(224, 'VIT 89', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'HNDHSR', NULL, '1', 'SRGSR||HDRH||DFBG||ZDTHT||SFHAH', '1', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:14:31'),
(225, 'VIT 85', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DTY', NULL, '1', 'SRT||RYJ||TYJ||RSTJ||DTYJ', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:15:00'),
(226, 'VIT 88', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'CGZDDF', NULL, '1', 'GSG||SG||GHSFH||GSFGHSF||DFHADHS', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:15:09'),
(227, 'VIT 87', 4, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'XGJGSDHD', NULL, '1', 'GHADHD||CGJHD||HSDHH||HGD||DHAD YR', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:15:57'),
(228, 'VIT 86', 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FYK', NULL, '1', 'DTYK||DTYK||DZH||ZTJH||DTJN', '4', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-10-01 13:16:17');

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Short Course', '2022-07-29 17:52:34', '2022-07-29 17:52:34'),
(2, 'Long Course', '2022-07-29 17:52:50', '2022-07-29 17:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `item_level`
--

CREATE TABLE `item_level` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_level`
--

INSERT INTO `item_level` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Easy', '2022-07-29 17:44:06', '2022-07-29 17:44:06'),
(2, 'Medium', '2022-07-29 17:44:21', '2022-07-29 17:44:21'),
(3, 'Hard', '2022-07-29 17:44:34', '2022-07-29 17:44:34'),
(4, 'Critical', '2022-08-19 03:33:04', '2022-08-19 03:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `item_statuses`
--

CREATE TABLE `item_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sl_no` int(11) NOT NULL,
  `item_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_statuses`
--

INSERT INTO `item_statuses` (`id`, `sl_no`, `item_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Active', NULL, NULL),
(2, 4, 'In-Active', NULL, NULL),
(3, 3, 'Test', NULL, NULL),
(4, 2, 'No-Answer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_tag1s`
--

CREATE TABLE `item_tag1s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag2s`
--

CREATE TABLE `item_tag2s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag3s`
--

CREATE TABLE `item_tag3s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag4s`
--

CREATE TABLE `item_tag4s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag5s`
--

CREATE TABLE `item_tag5s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag6s`
--

CREATE TABLE `item_tag6s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag7s`
--

CREATE TABLE `item_tag7s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag_maps`
--

CREATE TABLE `item_tag_maps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_tag_maps`
--

INSERT INTO `item_tag_maps` (`id`, `tag`, `name`, `created_at`, `updated_at`) VALUES
(1, 'tag0', 'Course Type', '2022-07-29 17:50:48', '2022-07-29 17:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `memory_bank`
--

CREATE TABLE `memory_bank` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_level` int(11) NOT NULL,
  `item_category` int(11) NOT NULL,
  `top_text` text NOT NULL,
  `down_text` text NOT NULL,
  `background` varchar(255) DEFAULT NULL,
  `sub_questions` text NOT NULL,
  `sub_correct_answer` text NOT NULL,
  `item_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_07_08_185045_entrust_setup_tables', 1),
(4, '2021_10_10_191453_create_psy_images_table', 2),
(5, '2021_10_17_203351_create_notice_table', 3),
(6, '2021_10_17_203738_create_psy_modules_table', 3),
(7, '2022_01_19_142307_create_item_tag1s_table', 3),
(8, '2022_01_19_142606_create_item_tag2s_table', 4),
(9, '2022_01_19_142614_create_item_tag3s_table', 4),
(10, '2022_01_19_142624_create_item_tag4s_table', 4),
(11, '2022_01_19_142632_create_item_tag5s_table', 4),
(12, '2022_01_19_142640_create_item_tag6s_table', 4),
(13, '2022_01_19_142647_create_item_tag7s_table', 4),
(14, '2022_01_20_101532_create_item_tag_maps_table', 5),
(15, '2022_04_14_171836_create_candidates_table', 6),
(18, '2022_04_25_090443_create_candidate_exams_table', 7),
(19, '2022_04_25_104833_create_candidate_exam_details_table', 7),
(20, '2022_08_03_161636_create_exam_config_statuses_table', 8),
(21, '2022_08_06_010904_create_item_statuses_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notice` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `startfrom` date DEFAULT NULL,
  `endsat` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'Display Role Listing', 'See only Listing Of Role', '2020-07-08 13:04:00', '2020-07-08 13:04:00'),
(2, 'role-create', 'Create Role', 'Create New Role', '2020-07-08 13:04:00', '2020-07-08 13:04:00'),
(3, 'role-edit', 'Edit Role', 'Edit Role', '2020-07-08 13:04:01', '2020-07-08 13:04:01'),
(4, 'role-delete', 'Delete Role', 'Delete Role', '2020-07-08 13:04:01', '2020-07-08 13:04:01'),
(5, 'user-create', 'Create New User', 'Create New User', NULL, NULL),
(6, 'user-list', 'Display User Listing', 'See only Listing of User', NULL, NULL),
(7, 'user-edit', 'Edit User', 'Edit User', NULL, NULL),
(8, 'user-delete', 'Delete User', 'Delete User', NULL, NULL),
(9, 'permission-create', 'Create Permission', 'Create New Permission', NULL, NULL),
(10, 'permission-list', 'Display Permission Listing', 'See only Listing Of Permission', NULL, NULL),
(11, 'permission-edit', 'Edit permission', 'Edit permission', NULL, NULL),
(12, 'permission-delete', 'Delete Permission', 'Delete Permission', NULL, NULL),
(13, 'Test av', 'display', 'abc', '2022-04-12 19:37:23', '2022-04-12 19:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(3, 1),
(6, 1),
(9, 1),
(10, 1),
(1, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `psy_images`
--

CREATE TABLE `psy_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `psy_modules`
--

CREATE TABLE `psy_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `startfrom` date DEFAULT NULL,
  `endsat` date DEFAULT NULL,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `psy_modules`
--

INSERT INTO `psy_modules` (`id`, `title`, `file`, `extension`, `details`, `startfrom`, `endsat`, `type`, `order`, `status`, `created_at`, `updated_at`) VALUES
(15, 'Summer Session 2022', 'qfv_San Docus_001.jpg', 'jpg', NULL, NULL, NULL, 'session_calender', NULL, 1, '2022-01-23 13:34:57', '2022-01-23 13:34:57'),
(17, '2', 'AnH_San Docus_0002.jpg', '2', '2', NULL, NULL, 'testing_schedule', 2, 1, '2022-01-23 13:35:50', '2022-03-01 11:52:40'),
(78, 'Session Calendar Psy Dimension 2022', 'Om4_San Docus_0001.jpg', 'jpg', '1', NULL, NULL, 'testing_schedule', 1, 1, '2022-03-01 11:53:10', '2022-03-01 11:53:10'),
(88, '2329', 'yWP_1.jpg', '1', '1', NULL, NULL, 'tat_bl', 1, 1, '2022-03-27 09:47:05', '2022-10-01 06:35:13'),
(89, '2', 'O4Z_2.jpg', '2', '2', NULL, NULL, 'tat_bl', 2, 1, '2022-03-27 09:47:15', '2022-10-01 06:35:25'),
(90, '3', 'Vns_3.jpg', '3', '3', NULL, NULL, 'tat_bl', 3, 1, '2022-03-27 09:47:27', '2022-10-01 06:35:37'),
(91, '4', 'ywR_4.jpg', '4', '4', NULL, NULL, 'tat_bl', 4, 1, '2022-03-27 09:47:36', '2022-10-01 06:35:47'),
(92, '5', '3rp_5.jpg', '5', '5', NULL, NULL, 'tat_bl', 5, 1, '2022-03-27 09:47:47', '2022-10-01 06:36:00'),
(93, '6', '8iq_6.jpg', '6', '6', NULL, NULL, 'tat_bl', 6, 1, '2022-03-27 09:47:57', '2022-10-01 06:36:12'),
(97, '7', 'WHZ_7.jpg', '7', '7', NULL, NULL, 'tat_bl', 7, 1, '2022-08-22 07:38:06', '2022-10-01 06:36:22'),
(98, '8', 'u8U_8.jpg', '8', '8', NULL, NULL, 'tat_bl', 8, 1, '2022-08-22 07:38:15', '2022-10-01 06:36:32');

-- --------------------------------------------------------

--
-- Table structure for table `question_set`
--

CREATE TABLE `question_set` (
  `id` int(11) NOT NULL,
  `item_set_name` varchar(191) NOT NULL,
  `item_set_for` int(11) NOT NULL,
  `total_items` varchar(191) NOT NULL,
  `candidate_type` int(11) NOT NULL,
  `set_level` varchar(255) DEFAULT NULL,
  `set_category` varchar(255) DEFAULT NULL,
  `set_type` varchar(255) NOT NULL,
  `item_level` text NOT NULL,
  `questions_id` text NOT NULL,
  `total_time` varchar(191) DEFAULT NULL,
  `pass_mark` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `set_configuration_type` varchar(3) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_set`
--

INSERT INTO `question_set` (`id`, `item_set_name`, `item_set_for`, `total_items`, `candidate_type`, `set_level`, `set_category`, `set_type`, `item_level`, `questions_id`, `total_time`, `pass_mark`, `set_configuration_type`, `updated_at`) VALUES
(1, 'PM Set 1', 1, '3', 1, NULL, NULL, 'original', '1||1~~2||1~~3||1', '1||2', NULL, NULL, '2', '2022-07-29 18:58:00'),
(2, 'Demo PM Set 1', 1, '2', 1, NULL, NULL, 'original', '1||1~~2||1', '67||68', NULL, NULL, '2', '2022-08-19 03:48:29'),
(3, 'PM set 1', 2, '20', 1, NULL, NULL, 'original', '1||5~~2||5~~3||5~~4||5', '96||90||92||93||89||101||106||105||103||107||118||113||110||117||115||122||126||119||121||125', NULL, NULL, '1', '2022-10-01 08:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'all permission', NULL, NULL),
(2, 'user', 'psy', 'only show', NULL, '2020-07-22 05:03:49'),
(3, 'testing', 'testing', 'Testing Officer', '2021-10-10 12:45:12', '2021-10-10 12:45:12'),
(4, 'conductingOfficer', 'Conducting Officer', 'Conducting Officer', '2022-04-13 15:14:51', '2022-04-13 15:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(5, 2),
(6, 2),
(7, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `test_config`
--

CREATE TABLE `test_config` (
  `id` int(11) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `test_for` varchar(191) NOT NULL,
  `test_configuration_type` int(11) NOT NULL,
  `item_level` text,
  `item_id` text,
  `total_item` int(11) DEFAULT NULL,
  `set_id` text,
  `flag` int(11) NOT NULL,
  `candidate_type` varchar(191) NOT NULL,
  `total_time` varchar(255) NOT NULL,
  `pass_mark` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test_config_instructions`
--

CREATE TABLE `test_config_instructions` (
  `id` int(11) NOT NULL,
  `test_config_id` int(11) NOT NULL COMMENT 'FK = test_configs.id',
  `text` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `image` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_groups`
--

CREATE TABLE `test_groups` (
  `id` int(11) NOT NULL,
  `groups` varchar(255) NOT NULL,
  `test_config_id` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test_lists`
--

CREATE TABLE `test_lists` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` varchar(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_lists`
--

INSERT INTO `test_lists` (`id`, `name`, `status`, `updated_at`) VALUES
(1, 'Demo PM', '1', '2022-08-19 03:30:16'),
(2, 'PM', '1', '2022-10-01 07:00:00'),
(3, 'TAT', '1', '2022-10-01 07:50:58'),
(4, 'VIT', '1', '2022-10-01 07:59:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_student` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Authority, 1=Student',
  `logged_in_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `is_student`, `logged_in_status`) VALUES
(1, 'S. Admin', 'admin@admin.com', '$2y$10$XOCJ7P9ciDDMh6eMLQAwj.veZKR9/v3GiSvGURpT.lAAT211/OCie', 'N5FDx2VtJUv5YleJ3tfUsnMqieqDyjMEQCSMZBHGAfRp5nRi3Tisq26Y216J', NULL, '2021-08-11 02:28:44', 0, 0),
(2, 'Psychologist', 'psy@issb.com', '$2y$10$xXDgiiE0/XzYsvuU.9gL7uZ3X0gfg3IvYrxOmfWQ0mC8OltKgd39i', 'N6eXoQTud2jv8hn4FmaEMVQ6RFmpdE2uiXjBXKEBgglHVot3zvGb88myJIa8', NULL, '2021-10-12 16:24:03', 0, 0),
(3, 'Testing Officer', 'testing@admin.com', '$2y$10$kn0.wF0/SEWBDDK324ljp.xnowoLjPrwZ6JuH/8gE.iITWJ/L7FGq', NULL, '2021-10-10 06:51:17', '2021-10-12 16:24:51', 0, 0),
(4, 'Conduct Officer', 'conduct@admin.com', '$2y$10$vsuyXhSf7ivZLchddOuE1.L9VqETbMrIq4z9h.Inuuht2Zxk1NyUC', NULL, '2022-04-13 09:16:30', '2022-05-09 04:36:33', 0, 0),
(5, 'Cdr Zahid', 'psy1609zahid@issb.com', '$2y$10$QgexLhY0buOupp2P9kAU8euQnJ7GrEvLtG1NTusi/OvrXRiidM/6S', '0vMFOK5ZpY5ZwjdzSG3G8nPzqcfFwY7X4YOWeqGhxjjK1qvUbq7qryu1D0Nw', '2021-10-13 12:58:21', '2021-10-13 16:42:08', 0, 0),
(6, 'Lt Col Mahbub', 'psy6025mahbub@issb.com', '$2y$10$ysSbZY9uhWGnT3f2srtFq.tIP4wBB79vs1V3n7uHtJX/dMwX8yQwe', 'cGnTZKvE9kHWf13w5O4lE2kVYNLApRyHHhC7jjof46CCc5uLJuUSNMPeWehw', '2021-10-13 12:58:58', '2021-10-13 16:42:51', 0, 0),
(7, 'Maj Munsur', 'psy8021munsur@issb.com', '$2y$10$K.uRUZKgFj/xJqdbNE8GQeSZeQh7qDRiU4ZeP6TdgH3/megYd9QX6', 'gmw2FgdWsMxrW6ObKXpnI0Hvqed26JboV1Vid1D4uNIVpaUlVJp6XxodResF', '2021-10-13 13:00:05', '2021-10-13 16:43:29', 0, 0),
(9, 'Maj Ashif', 'psy8838ashif@issb.com', '$2y$10$WTnXmuHWgVxNee4zWmJ9IOJMtte5c5XfHC1RgvM6m/gf.EzCJlyLe', 'N1sm7N2vM8c3iXsxCR89RiUPZvFC4KyVDv1PDdrxIWh9qNbFuUXWfE1Fi4RX', '2021-10-13 13:01:29', '2021-10-13 16:44:44', 0, 0),
(10, 'Maj Mahmud', 'psy8843mahmud@issb.com', '$2y$10$OhKm97vRDhKIJ1MIn9QAae3OG05GpoNMK/3SjUgqipzBP1psLXZz2', 'mZxXcOPCxdk0rj7cXYYPV7RYivvciTwiT5MdU7ySROvxb1OApC3acfbdfSdd', '2021-10-13 13:01:59', '2021-10-13 16:45:24', 0, 0),
(11, 'Wg Cdr Rumana', 'psy8866rumana@issb.com', '$2y$10$0U01A4OWA5hFp/SyiVYuhejQ4gHQQWX46qE/W1WNgWvDzWLdpi2eW', '5GZq3Psk8eEPOMOwKo3UpYTOBO1xqRiFW56vAqJdVuXYJh2Q10UfyGYaOZlY', '2021-10-13 13:02:25', '2022-01-24 10:34:18', 0, 0),
(12, 'Maj Dhina', 'psy8944dhina@issb.com', '$2y$10$Q.wZLQQMMxTBf3GwJEZU9.vJWhCdSz7Msn8PCJEqceHTVNsYgEKZC', 'KbE8v56oUvQVQPDOaUZVMTjzROTgZbgk43Zt5qr8J22pk9L1gZXr6ZRWrjXl', '2021-10-13 13:02:52', '2021-10-13 16:46:42', 0, 0),
(13, 'Sqn Ldr Fardous', 'psy9324fardous@issb.com', '$2y$10$CPcHQ5wUqWZlD8MjcagfX.Y8e8pGynTVsqrXdNHsUUC6cooZuJUwW', 'w9ts9O2yVY4tkZ8ngAjk8QPDnmZMbdSJuoh0ZVb2MUd23FG2jNZ6uIpsGcqs', '2021-10-13 13:03:18', '2021-10-13 16:47:48', 0, 0),
(14, 'Psychologist 11', 'psy11@admin.com', '$2y$10$CVXl75IjmNkrtkRdj3vGneeZeDPhE7N1YKfI9uuFJL40F90S1Xz/6', NULL, '2021-10-13 13:03:58', '2021-10-13 13:03:58', 0, 0),
(15, 'Psychologist 12', 'psy12@admin.com', '$2y$10$lUvx8Z8pGqLOM6XD.rC6Cu2ywzmdMKhbxQHHfpWTK7sQXM1FhOPp.', NULL, '2021-10-13 13:04:32', '2021-10-13 13:04:32', 0, 0),
(16, 'Psychologist 13', 'psy13@admin.com', '$2y$10$/aOrqNIXd/b4CN52r.SLyeF70dN2fLwvg9z1m6Y5Gx8Cg8zkOBBvi', NULL, '2021-10-13 13:04:56', '2021-10-13 13:04:56', 0, 0),
(17, 'Psychologist 14', 'psy14@admin.com', '$2y$10$GxcoOxPOCBHytWlIJuSaq.ENB5Fvyt2lb1Po0f8I7pXD7dGyGkvUK', NULL, '2021-10-13 13:05:20', '2021-10-13 13:05:20', 0, 0),
(18, 'Psychologist 15', 'psy15@admin.com', '$2y$10$N2D9YYLzPGBrMuEcnmpD2eyRE6jLCgyrnoZZdfSl/WgSamBKalApe', NULL, '2021-10-13 13:05:45', '2021-10-13 13:05:45', 0, 0),
(20, 'Sr Psy - Lt Col Zahir', 'psy5681zahir@issb.com', '$2y$10$Gd8uRXPOWHKn1LetmRroq.sl.M8gUPar5PlEoa70dQ9Z0fqI/WX/y', 'iLQ16Qc8FwXdw3pnQMflkvxEQoXcUvSSNKHQ0kOuiGEfMiSa7qOnXQPlCsln', '2021-10-13 16:35:37', '2021-10-13 16:39:44', 0, 0),
(21, 'Lt Cdr Rabiul', 'psy1863rabiul@issb.com', '$2y$10$EY2EsUnLcuE9skNxILgCju5Ku/AshWFcExnuj6pEqmKbuCkZOMhqO', 'aZ1E9zsjBgHOsoKeSZK6xPWJlMcjAVBcHHSTUO8UQA6xpW5R5LFaK8L1t4ty', '2022-02-17 10:35:11', '2022-02-17 10:35:11', 0, 0),
(22, 'Lt Col Jahangir', 'psy5906jahangir@issb.com', '$2y$10$ZcXdOGGs2gaoJup3bBBa.uXKEdZboDIazEWYVhpcRUxUbmXLButk2', 'uMO01aQmZ61HrQ60pIrIKaiqfHNqetapVC8G4ZjbaX5BAkYW2KySv4rJ4VX9', '2022-02-22 13:46:42', '2022-02-22 13:46:42', 0, 0),
(23, 'Cdr Habib', 'psy1608mhrkhan@issb.com', '$2y$10$ihypIBT1GMdwTKHk2aiKk.h.aFvfesV3vC9/NUwyLtAv6ExeWV0lG', '6X2wXOJ6JOZ8jNJhHulMkVsVKglTO3AylyWkd26G4ZY1WSWUqlKhZxDPdGRG', '2021-10-13 12:37:16', '2021-10-13 16:41:37', 0, 0),
(24, 'Chief Psy Col Kabir', 'psy5850kabir@issb.com', '$2y$10$Jg750K1tD.Bv5ca4moHRj.dkjaicVqWnwo9oqA/.9JXS/NBs.HGe6', NULL, '2022-05-29 23:53:38', '2022-05-29 23:53:38', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board_candidates`
--
ALTER TABLE `board_candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `board_config`
--
ALTER TABLE `board_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_exams`
--
ALTER TABLE `candidate_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_exam_details`
--
ALTER TABLE `candidate_exam_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_type`
--
ALTER TABLE `candidate_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_configs`
--
ALTER TABLE `exam_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_config_statuses`
--
ALTER TABLE `exam_config_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_bank`
--
ALTER TABLE `item_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_level`
--
ALTER TABLE `item_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_statuses`
--
ALTER TABLE `item_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tag1s`
--
ALTER TABLE `item_tag1s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tag2s`
--
ALTER TABLE `item_tag2s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tag3s`
--
ALTER TABLE `item_tag3s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tag4s`
--
ALTER TABLE `item_tag4s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tag5s`
--
ALTER TABLE `item_tag5s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tag6s`
--
ALTER TABLE `item_tag6s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tag7s`
--
ALTER TABLE `item_tag7s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tag_maps`
--
ALTER TABLE `item_tag_maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memory_bank`
--
ALTER TABLE `memory_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `psy_images`
--
ALTER TABLE `psy_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `psy_modules`
--
ALTER TABLE `psy_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_set`
--
ALTER TABLE `question_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `test_config`
--
ALTER TABLE `test_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_config_instructions`
--
ALTER TABLE `test_config_instructions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_groups`
--
ALTER TABLE `test_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_lists`
--
ALTER TABLE `test_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board_candidates`
--
ALTER TABLE `board_candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `board_config`
--
ALTER TABLE `board_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=814;

--
-- AUTO_INCREMENT for table `candidate_exams`
--
ALTER TABLE `candidate_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_exam_details`
--
ALTER TABLE `candidate_exam_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_type`
--
ALTER TABLE `candidate_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_configs`
--
ALTER TABLE `exam_configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_config_statuses`
--
ALTER TABLE `exam_config_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_bank`
--
ALTER TABLE `item_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_level`
--
ALTER TABLE `item_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_statuses`
--
ALTER TABLE `item_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_tag1s`
--
ALTER TABLE `item_tag1s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_tag2s`
--
ALTER TABLE `item_tag2s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_tag3s`
--
ALTER TABLE `item_tag3s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_tag4s`
--
ALTER TABLE `item_tag4s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_tag5s`
--
ALTER TABLE `item_tag5s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_tag6s`
--
ALTER TABLE `item_tag6s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_tag7s`
--
ALTER TABLE `item_tag7s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_tag_maps`
--
ALTER TABLE `item_tag_maps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `memory_bank`
--
ALTER TABLE `memory_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `psy_images`
--
ALTER TABLE `psy_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `psy_modules`
--
ALTER TABLE `psy_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `question_set`
--
ALTER TABLE `question_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_config`
--
ALTER TABLE `test_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_config_instructions`
--
ALTER TABLE `test_config_instructions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_groups`
--
ALTER TABLE `test_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_lists`
--
ALTER TABLE `test_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
