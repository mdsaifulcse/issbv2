-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2022 at 12:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `issb_psychometrics_9_8_22`
--

-- --------------------------------------------------------

--
-- Table structure for table `board_candidates`
--

CREATE TABLE `board_candidates` (
  `id` int(11) NOT NULL,
  `board_name` varchar(255) NOT NULL,
  `total_candidate` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `board_candidates`
--

INSERT INTO `board_candidates` (`id`, `board_name`, `total_candidate`, `status`, `created_at`, `updated_at`, `deleted_at`, `deleted_by`) VALUES
(1, '2022', 120, 1, '2022-08-08 20:49:36', '2022-08-09 18:20:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `board_config`
--

CREATE TABLE `board_config` (
  `id` int(11) NOT NULL,
  `test_group_id` int(11) NOT NULL,
  `result` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chest_no` int(11) NOT NULL,
  `secret_key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roll_no` int(11) NOT NULL,
  `course` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `board_no` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_logged_in` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=Yes, 0=No',
  `seat_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `chest_no`, `secret_key`, `roll_no`, `course`, `board_no`, `name`, `email`, `address`, `password`, `phone`, `image`, `created_at`, `updated_at`, `deleted_at`, `is_logged_in`, `seat_no`) VALUES
(1, 11, 'asfaofdfasfoiasdf', 11, NULL, 'preview', 'Md Hiron Mollik', NULL, NULL, NULL, NULL, NULL, '2022-08-11 02:10:14', '2022-08-11 02:10:14', NULL, 0, NULL),
(2, 10, 'asdfafat', 10, NULL, '2022', 'Md Sagor Mollik', NULL, NULL, NULL, NULL, '021.jpg', '2022-08-11 02:10:14', '2022-08-13 10:08:07', NULL, 1, 10),
(3, 9, 'asdfafat', 9, NULL, '2022', 'Md Miraj', NULL, NULL, NULL, NULL, NULL, '2022-08-11 02:10:14', '2022-08-12 19:06:41', NULL, 1, 9),
(8, 12, 'E45ntj', 12, NULL, 'Barisal', 'Md Miraj', NULL, NULL, NULL, NULL, NULL, '2022-08-12 19:13:15', '2022-08-12 19:13:15', NULL, 0, NULL),
(9, 13, 'HpHd8d', 13, NULL, 'Barisal', 'Jamal miah', NULL, NULL, NULL, NULL, NULL, '2022-08-12 19:13:15', '2022-08-12 19:13:15', NULL, 0, NULL),
(10, 12, 'Pk0Phh', 12, NULL, 'Barisal', 'Md Miraj', NULL, NULL, NULL, NULL, NULL, '2022-08-12 19:13:18', '2022-08-12 19:13:18', NULL, 0, NULL),
(11, 13, '5lTgrB', 13, NULL, 'Barisal', 'Jamal miah', NULL, NULL, NULL, NULL, NULL, '2022-08-12 19:13:18', '2022-08-12 19:13:18', NULL, 0, NULL),
(12, 12, 'Irf3tf', 12, NULL, 'Barisal', 'Md Miraj', NULL, NULL, NULL, NULL, NULL, '2022-08-12 19:13:39', '2022-08-12 19:13:39', NULL, 0, NULL),
(13, 13, 'R0nUCZ', 13, NULL, 'Barisal', 'Jamal miah', NULL, NULL, NULL, NULL, NULL, '2022-08-12 19:13:39', '2022-08-12 19:13:39', NULL, 0, NULL),
(14, 12, 'JGNfQb', 12, NULL, 'Barisal', 'Md Miraj', NULL, NULL, NULL, NULL, NULL, '2022-08-12 19:13:59', '2022-08-12 19:13:59', NULL, 0, NULL),
(15, 13, 'j5VnFS', 13, NULL, 'Barisal', 'Jamal miah', NULL, NULL, NULL, NULL, NULL, '2022-08-12 19:13:59', '2022-08-12 19:13:59', NULL, 0, NULL),
(16, 12, '7Qb1LD', 12, NULL, 'Barisal', 'Md Miraj', NULL, NULL, NULL, NULL, NULL, '2022-08-12 19:14:44', '2022-08-12 19:14:44', NULL, 0, NULL),
(17, 13, 'Wr8RxV', 13, NULL, 'Barisal', 'Jamal miah', NULL, NULL, NULL, NULL, NULL, '2022-08-12 19:14:44', '2022-08-12 19:14:44', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `candidate_exams`
--

CREATE TABLE `candidate_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` int(11) DEFAULT NULL COMMENT 'FK:candidates.id',
  `exam_config_id` int(11) NOT NULL COMMENT 'FK:exam_configs.id',
  `instruction_seen_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '1=Seen, 0=Unseen',
  `demo_exam_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '1=Completed, 0=Pending',
  `board_id` int(11) DEFAULT NULL COMMENT 'FK:boards.id',
  `exam_date` date DEFAULT NULL COMMENT 'Exam Date',
  `exam_duration` int(11) DEFAULT NULL COMMENT 'Exam Duration by Minutes',
  `start_time` time DEFAULT NULL COMMENT 'Exam Start Time',
  `end_time` time DEFAULT NULL COMMENT 'Exam End Time',
  `running_exam_time` time DEFAULT NULL COMMENT 'Running Exam time',
  `remaining_exam_duration` int(11) DEFAULT NULL COMMENT 'Remaining Exam Duration by Minutes',
  `exam_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Not Running, 1=Running, 2=Finished/Completed, 3=Hold\r\n',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `deleted_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidate_exams`
--

INSERT INTO `candidate_exams` (`id`, `candidate_id`, `exam_config_id`, `instruction_seen_status`, `demo_exam_status`, `board_id`, `exam_date`, `exam_duration`, `start_time`, `end_time`, `running_exam_time`, `remaining_exam_duration`, `exam_status`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 1, 0, '2022-08-13', 1, NULL, NULL, '00:00:00', 60, 0, 1, '2', NULL, NULL, NULL, '2022-08-13 10:43:30', '2022-08-13 10:44:35');

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
  `question_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=Main Question, 2=Sub-Questions',
  `item_type` int(11) DEFAULT NULL COMMENT 'comment pending',
  `option_type` int(11) DEFAULT NULL COMMENT 'comment pending',
  `question` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_answer_id` int(11) DEFAULT NULL COMMENT 'Options Array index id 0,1,2..',
  `answer_id` int(11) DEFAULT NULL COMMENT 'Options Array index id 0,1,2..',
  `answer_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Correct Answer, 0=In-Correct Answer',
  `running_question_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Yes, 0=No',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Answered',
  `item_status` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `deleted_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FK:candidates.id',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidate_exam_details`
--

INSERT INTO `candidate_exam_details` (`id`, `sl_no`, `candidate_exam_id`, `candidate_id`, `item_bank_id`, `sub_item_bank_id`, `question_status`, `item_type`, `option_type`, `question`, `options`, `correct_answer_id`, `answer_id`, `answer_status`, `running_question_status`, `status`, `item_status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 67, NULL, 1, 2, 2, '6_1.JPG', '4_2.JPG||3_3.JPG||6_4.JPG||3_5.JPG', 2, NULL, 1, 1, 0, 1, '2', NULL, NULL, NULL, '2022-08-13 10:43:30', '2022-08-13 10:43:30'),
(2, 2, 1, 2, 68, NULL, 1, 2, 2, '6_BAF-Shaheen.jpg', '3_BAF-Shaheen-XI.jpg||3_EC committee.JPG||5_b1kjjyonv3qy4inc.jpg||6_27331994_10155020008626786_1409469388090149556_n.jpg', 2, NULL, 1, 0, 0, 1, '2', NULL, NULL, NULL, '2022-08-13 10:43:30', '2022-08-13 10:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_type`
--

CREATE TABLE `candidate_type` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
  `preview_status` tinyint(2) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=InActive, 1=Active, 2=Force Stop',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_configs`
--

INSERT INTO `exam_configs` (`id`, `board_candidate_id`, `exam_date`, `exam_start_time`, `exam_end_time`, `exam_duration`, `guest_time_duration`, `test_config_id`, `assign_to`, `exam_status`, `preview_status`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, '2022-08-13', NULL, NULL, 1, NULL, 1, NULL, 1, 0, 1, '2022-08-13 10:41:07', 3, '2022-08-11 02:45:55', 4, NULL, NULL),
(2, 1, '2022-08-11', NULL, NULL, 1, NULL, 1, NULL, 0, 0, 1, '2022-08-11 02:37:50', 3, '2022-08-11 02:37:50', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_config_statuses`
--

CREATE TABLE `exam_config_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sl_no` int(11) DEFAULT NULL COMMENT 'serial_no',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `category` int(11) NOT NULL,
  `tag1` int(6) DEFAULT NULL,
  `tag2` int(6) DEFAULT NULL,
  `tag3` int(6) DEFAULT NULL,
  `tag4` int(6) DEFAULT NULL,
  `tag5` int(6) DEFAULT NULL,
  `tag6` int(6) DEFAULT NULL,
  `tag7` int(6) DEFAULT NULL,
  `top_text` text DEFAULT NULL,
  `down_text` text DEFAULT NULL,
  `item_type` int(11) NOT NULL COMMENT '1=Text,2=Image,3=Sound',
  `item` varchar(255) NOT NULL,
  `sub_question_status` varchar(11) DEFAULT NULL,
  `option_type` varchar(11) DEFAULT NULL COMMENT '1=Text,2=Image,3=Sound	',
  `options` text DEFAULT NULL,
  `correct_answer` varchar(255) DEFAULT NULL,
  `sub_question_type` varchar(255) DEFAULT NULL COMMENT '1=Text,2=Image,3=Sound	',
  `sub_question` text DEFAULT NULL,
  `sub_option_type` varchar(255) DEFAULT NULL COMMENT '1=Text,2=Image,3=Sound	',
  `sub_options` text DEFAULT NULL,
  `sub_correct_answer` varchar(255) DEFAULT NULL,
  `item_status` int(11) NOT NULL COMMENT 'FK:item_statuses.id',
  `test_type` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_bank`
--

INSERT INTO `item_bank` (`id`, `name`, `item_for`, `level`, `category`, `tag1`, `tag2`, `tag3`, `tag4`, `tag5`, `tag6`, `tag7`, `top_text`, `down_text`, `item_type`, `item`, `sub_question_status`, `option_type`, `options`, `correct_answer`, `sub_question_type`, `sub_question`, `sub_option_type`, `sub_options`, `sub_correct_answer`, `item_status`, `test_type`, `created_at`, `updated_at`) VALUES
(1, 'PM Item 2020 (4)', 4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Top Text', 'Down Text', 1, 'Verbal Item for Test.', '1', '', '', '', '1', 'Sub Question Test 1||Sub Question Test 2||Sub Question Test 3||Sub Question Test 4', '1', 'Option  Test 1||Option Test  2||Option  Test  3~~Option Test 1||Option Test 2||Option Test 3~~Option Test 1||Option Test 2||Option Test 3~~Option Test 1||Option Test 2||Option Test 3', '1||2||2||3', 1, 1, '2020-09-13 04:22:56', '2022-08-08 20:35:40'),
(67, 'Pic Test', 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_1.JPG', NULL, '2', '4_2.JPG||3_3.JPG||6_4.JPG||3_5.JPG', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-08 20:38:24', '2022-08-08 20:38:24'),
(68, 'Pic Test 2', 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '6_BAF-Shaheen.jpg', NULL, '2', '3_BAF-Shaheen-XI.jpg||3_EC committee.JPG||5_b1kjjyonv3qy4inc.jpg||6_27331994_10155020008626786_1409469388090149556_n.jpg', '2', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-08-08 20:40:42', '2022-08-08 20:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_level`
--

INSERT INTO `item_level` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Easy', '2022-07-29 17:44:06', '2022-07-29 17:44:06'),
(2, 'Medium', '2022-07-29 17:44:21', '2022-07-29 17:44:21'),
(3, 'Hard', '2022-07-29 17:44:34', '2022-07-29 17:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `item_statuses`
--

CREATE TABLE `item_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sl_no` int(11) NOT NULL,
  `item_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag2s`
--

CREATE TABLE `item_tag2s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag3s`
--

CREATE TABLE `item_tag3s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag4s`
--

CREATE TABLE `item_tag4s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag5s`
--

CREATE TABLE `item_tag5s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag6s`
--

CREATE TABLE `item_tag6s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag7s`
--

CREATE TABLE `item_tag7s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_tag_maps`
--

CREATE TABLE `item_tag_maps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
  `notice` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `startfrom` date DEFAULT NULL,
  `endsat` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
(1, 2),
(1, 3),
(2, 3),
(3, 1),
(3, 3),
(4, 3),
(5, 3),
(6, 1),
(6, 3),
(7, 3),
(8, 3),
(9, 1),
(9, 3),
(10, 1),
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
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `psy_modules`
--

CREATE TABLE `psy_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startfrom` date DEFAULT NULL,
  `endsat` date DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `psy_modules`
--

INSERT INTO `psy_modules` (`id`, `title`, `file`, `extension`, `details`, `startfrom`, `endsat`, `type`, `order`, `status`, `created_at`, `updated_at`) VALUES
(15, 'Summer Session 2022', 'qfv_San Docus_001.jpg', 'jpg', NULL, NULL, NULL, 'session_calender', NULL, 1, '2022-01-24 01:34:57', '2022-01-24 01:34:57'),
(17, '2', 'AnH_San Docus_0002.jpg', '2', '2', NULL, NULL, 'testing_schedule', 2, 1, '2022-01-24 01:35:50', '2022-03-01 23:52:40'),
(78, 'Session Calendar Psy Dimension 2022', 'Om4_San Docus_0001.jpg', 'jpg', '1', NULL, NULL, 'testing_schedule', 1, 1, '2022-03-01 23:53:10', '2022-03-01 23:53:10'),
(88, 'Board No 2317', 'UJw_1.jpg', '1', '1', NULL, NULL, 'tat_bl', 1, 1, '2022-03-27 21:47:05', '2022-07-17 08:29:13'),
(89, '2', 'Olr_2.jpg', '2', '2', NULL, NULL, 'tat_bl', 2, 1, '2022-03-27 21:47:15', '2022-07-17 08:29:22'),
(90, '3', 'w45_3.jpg', '3', '3', NULL, NULL, 'tat_bl', 3, 1, '2022-03-27 21:47:27', '2022-07-17 08:29:31'),
(91, '4', 'nuk_4.jpg', '4', '4', NULL, NULL, 'tat_bl', 4, 1, '2022-03-27 21:47:36', '2022-07-17 08:29:39'),
(92, '5', 'H1u_5.jpg', '5', '5', NULL, NULL, 'tat_bl', 5, 1, '2022-03-27 21:47:47', '2022-07-17 08:29:49'),
(93, '6', 'o20_6.jpg', '6', '6', NULL, NULL, 'tat_bl', 6, 1, '2022-03-27 21:47:57', '2022-07-17 08:30:00'),
(95, '7', 'lRi_7.jpg', '7', '7', NULL, NULL, 'tat_bl', 7, 1, '2022-03-27 21:51:31', '2022-07-17 08:30:08'),
(96, '8', 'HaT_8.jpg', '8', '8', NULL, NULL, 'tat_bl', 8, 1, '2022-03-31 20:54:16', '2022-07-17 08:30:17');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `set_configuration_type` varchar(3) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
(3, 3),
(4, 4),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
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
(24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `test_config`
--

CREATE TABLE `test_config` (
  `id` int(11) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `test_for` varchar(191) NOT NULL,
  `test_configuration_type` int(11) NOT NULL,
  `item_level` text DEFAULT NULL,
  `item_id` text DEFAULT NULL,
  `total_item` int(11) DEFAULT NULL,
  `set_id` text DEFAULT NULL,
  `flag` int(11) NOT NULL,
  `candidate_type` varchar(191) NOT NULL,
  `total_time` varchar(255) NOT NULL,
  `pass_mark` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_config`
--

INSERT INTO `test_config` (`id`, `test_name`, `test_for`, `test_configuration_type`, `item_level`, `item_id`, `total_item`, `set_id`, `flag`, `candidate_type`, `total_time`, `pass_mark`, `created_at`, `updated_at`) VALUES
(1, 'PM Test Mynul', '1', 1, '1||2', '68||67', 2, NULL, 0, '2', '1', 2, '2022-08-08 20:44:11', '2022-08-08 20:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `test_config_instructions`
--

CREATE TABLE `test_config_instructions` (
  `id` int(11) NOT NULL,
  `test_config_id` int(11) NOT NULL COMMENT 'FK = test_configs.id',
  `text` mediumtext DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_config_instructions`
--

INSERT INTO `test_config_instructions` (`id`, `test_config_id`, `text`, `image`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, NULL, '1659991484.jpg', '2022-08-08 20:44:44', 1, '2022-08-08 20:44:44', NULL, NULL, NULL),
(2, 1, 'Title-2', '1659991499.jpg', '2022-08-11 02:34:26', 1, '2022-08-08 20:45:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_groups`
--

CREATE TABLE `test_groups` (
  `id` int(11) NOT NULL,
  `groups` varchar(255) NOT NULL,
  `test_config_id` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_lists`
--

INSERT INTO `test_lists` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PM', '1', '2022-08-08 20:32:20', '2022-08-08 20:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_student` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Authority, 1=Student',
  `logged_in_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=No, 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `is_student`, `logged_in_status`) VALUES
(1, 'S. Admin', 'admin@admin.com', '$2y$10$XOCJ7P9ciDDMh6eMLQAwj.veZKR9/v3GiSvGURpT.lAAT211/OCie', 'BgrxBp7HaEvBzSemJmpblMseS7DeafhsTTyMeVibPdeYrKRG5EWVlVNnrmnt', NULL, '2021-08-11 02:28:44', 0, 0),
(2, 'Psychologist', 'psy@issb.com', '$2y$10$xXDgiiE0/XzYsvuU.9gL7uZ3X0gfg3IvYrxOmfWQ0mC8OltKgd39i', 'N6eXoQTud2jv8hn4FmaEMVQ6RFmpdE2uiXjBXKEBgglHVot3zvGb88myJIa8', NULL, '2021-10-12 16:24:03', 0, 0),
(3, 'Testing Officer', 'testing@admin.com', '$2y$10$XOCJ7P9ciDDMh6eMLQAwj.veZKR9/v3GiSvGURpT.lAAT211/OCie', NULL, '2021-10-10 06:51:17', '2021-10-12 16:24:51', 0, 0),
(4, 'Conduct Officer', 'conduct@admin.com', '$2y$10$XOCJ7P9ciDDMh6eMLQAwj.veZKR9/v3GiSvGURpT.lAAT211/OCie', NULL, '2022-04-13 09:16:30', '2022-05-09 04:36:33', 0, 0),
(5, 'Cdr Zahid', 'psy1609zahid@issb.com', '$2y$10$QgexLhY0buOupp2P9kAU8euQnJ7GrEvLtG1NTusi/OvrXRiidM/6S', 'LlmeWEMW8LHXD9l7qXjqOC0gbURhlU2iuRumbD8y99vm0LnZvN0ZBqDT0AVO', '2021-10-13 12:58:21', '2021-10-13 16:42:08', 0, 0),
(6, 'Lt Col Mahbub', 'psy6025mahbub@issb.com', '$2y$10$ysSbZY9uhWGnT3f2srtFq.tIP4wBB79vs1V3n7uHtJX/dMwX8yQwe', 'cGnTZKvE9kHWf13w5O4lE2kVYNLApRyHHhC7jjof46CCc5uLJuUSNMPeWehw', '2021-10-13 12:58:58', '2021-10-13 16:42:51', 0, 0),
(7, 'Maj Munsur', 'psy8021munsur@issb.com', '$2y$10$K.uRUZKgFj/xJqdbNE8GQeSZeQh7qDRiU4ZeP6TdgH3/megYd9QX6', 'gmw2FgdWsMxrW6ObKXpnI0Hvqed26JboV1Vid1D4uNIVpaUlVJp6XxodResF', '2021-10-13 13:00:05', '2021-10-13 16:43:29', 0, 0),
(8, 'Gp Capt Islam', 'psy8448islam@issb.com', '$2y$10$Qt09nvgY1o6UYCjNrIiLbeFdo8xFACXZXLRaCRuYHprtHExMDAst.', 'hllzCqQRQxTHQf0MmBm1P10N8kOkxVOP8VsN5WN20ghRyQYCD7Cf8djw8Cy3', '2021-10-13 13:00:39', '2021-10-13 16:44:07', 0, 0),
(9, 'Maj Ashif', 'psy8838ashif@issb.com', '$2y$10$WTnXmuHWgVxNee4zWmJ9IOJMtte5c5XfHC1RgvM6m/gf.EzCJlyLe', 'pVVqnyzaHxQy2PnJ9InPcCt6L5JUWnCtufNJffGldSKm3GswrRSAHpHmcsg0', '2021-10-13 13:01:29', '2021-10-13 16:44:44', 0, 0),
(10, 'Maj Mahmud', 'psy8843mahmud@issb.com', '$2y$10$OhKm97vRDhKIJ1MIn9QAae3OG05GpoNMK/3SjUgqipzBP1psLXZz2', 'mZxXcOPCxdk0rj7cXYYPV7RYivvciTwiT5MdU7ySROvxb1OApC3acfbdfSdd', '2021-10-13 13:01:59', '2021-10-13 16:45:24', 0, 0),
(11, 'Wg Cdr Rumana', 'psy8866rumana@issb.com', '$2y$10$0U01A4OWA5hFp/SyiVYuhejQ4gHQQWX46qE/W1WNgWvDzWLdpi2eW', '5GZq3Psk8eEPOMOwKo3UpYTOBO1xqRiFW56vAqJdVuXYJh2Q10UfyGYaOZlY', '2021-10-13 13:02:25', '2022-01-24 10:34:18', 0, 0),
(12, 'Maj Dhina', 'psy8944dhina@issb.com', '$2y$10$Q.wZLQQMMxTBf3GwJEZU9.vJWhCdSz7Msn8PCJEqceHTVNsYgEKZC', 'KbE8v56oUvQVQPDOaUZVMTjzROTgZbgk43Zt5qr8J22pk9L1gZXr6ZRWrjXl', '2021-10-13 13:02:52', '2021-10-13 16:46:42', 0, 0),
(13, 'Sqn Ldr Fardous', 'psy9324fardous@issb.com', '$2y$10$CPcHQ5wUqWZlD8MjcagfX.Y8e8pGynTVsqrXdNHsUUC6cooZuJUwW', 'ipTzcKWFNLStdwOAFMAvEJp7G8oHHjY5FmqyhNIXDgU3qzyhGj3UJlN6Qb5w', '2021-10-13 13:03:18', '2021-10-13 16:47:48', 0, 0),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `board_config`
--
ALTER TABLE `board_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `candidate_exams`
--
ALTER TABLE `candidate_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidate_exam_details`
--
ALTER TABLE `candidate_exam_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `candidate_type`
--
ALTER TABLE `candidate_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_configs`
--
ALTER TABLE `exam_configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_config_statuses`
--
ALTER TABLE `exam_config_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_bank`
--
ALTER TABLE `item_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_level`
--
ALTER TABLE `item_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `question_set`
--
ALTER TABLE `question_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_config`
--
ALTER TABLE `test_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test_config_instructions`
--
ALTER TABLE `test_config_instructions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test_groups`
--
ALTER TABLE `test_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_lists`
--
ALTER TABLE `test_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
