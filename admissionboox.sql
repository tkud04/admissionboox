-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 28, 2024 at 09:54 AM
-- Server version: 8.0.35
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admissionboox`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_classes`
--

CREATE TABLE `admission_classes` (
  `id` int UNSIGNED NOT NULL,
  `admission_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `class_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `admission_classes`
--

INSERT INTO `admission_classes` (`id`, `admission_id`, `class_id`, `created_at`, `updated_at`) VALUES
(1, '3', '1', '2024-07-27 17:24:14', '2024-07-27 17:24:14'),
(2, '3', '4', '2024-07-27 17:24:14', '2024-07-27 17:24:14'),
(3, '4', '1', '2024-07-28 06:07:30', '2024-07-28 06:07:30'),
(4, '4', '4', '2024-07-28 06:07:30', '2024-07-28 06:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `admission_forms`
--

CREATE TABLE `admission_forms` (
  `id` int UNSIGNED NOT NULL,
  `admission_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `admission_forms`
--

INSERT INTO `admission_forms` (`id`, `admission_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'active', '2024-07-27 17:21:09', '2024-07-27 17:21:09'),
(2, '2', 'active', '2024-07-27 17:21:28', '2024-07-27 17:21:28'),
(3, '3', 'active', '2024-07-27 17:24:14', '2024-07-27 17:24:14'),
(4, '4', 'active', '2024-07-28 06:07:30', '2024-07-28 06:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `application_data`
--

CREATE TABLE `application_data` (
  `id` int UNSIGNED NOT NULL,
  `application_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `form_field_value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int UNSIGNED NOT NULL,
  `club_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `club_value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `img_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `club_name`, `club_value`, `img_url`, `created_at`, `updated_at`) VALUES
(1, 'Ballet', 'ballet', 'im-icon-Ballet-Shoes', '2024-07-26 15:43:50', '2024-07-26 15:43:50'),
(2, 'Chess', 'chess', 'im-icon-Chess', '2024-07-26 15:45:14', '2024-07-26 15:45:14'),
(3, 'Scrabble', 'scrabble', 'im-icon-Book', '2024-07-26 15:46:25', '2024-07-26 15:46:25'),
(4, 'Football', 'football', 'im-icon-Football-2', '2024-07-26 15:47:11', '2024-07-26 15:47:11'),
(5, 'Swimming', 'swimming', 'im-icon-Swimming', '2024-07-26 15:47:49', '2024-07-26 15:47:49'),
(6, 'Taekwondo', 'taekwondo', 'im-icon-Aerobics-2', '2024-07-26 16:01:07', '2024-07-26 16:01:07'),
(7, 'Music', 'music', 'im-icon-Music-Note2', '2024-07-26 16:02:17', '2024-07-26 16:02:17'),
(8, 'Robotics', 'robotics', 'im-icon-Robot-2', '2024-07-26 16:03:05', '2024-07-26 16:03:05'),
(9, 'Basketball', 'basketball', 'im-icon-Basket-Ball', '2024-07-26 16:04:47', '2024-07-26 16:04:47'),
(10, 'Table and Lawn Tennis', 'table-and-lawn-tennis', 'im-icon-Tennis', '2024-07-26 16:05:45', '2024-07-26 16:05:45'),
(11, 'Badminton', 'badminton', 'im-icon-Tennis-Ball', '2024-07-26 16:07:02', '2024-07-26 16:07:02'),
(12, 'Volleyball', 'volleyball', 'im-icon-Volleyball', '2024-07-26 16:07:28', '2024-07-26 16:07:28'),
(13, 'Cheerleading', 'cheerleading', 'im-icon-Lesbians', '2024-07-26 16:10:00', '2024-07-26 16:10:00'),
(14, 'Board Games', 'board-games', 'im-icon-Chess-Board', '2024-07-26 16:11:59', '2024-07-26 16:11:59'),
(15, 'Debating', 'debating', 'im-icon-Speach-Bubbles', '2024-07-26 16:12:22', '2024-07-26 16:12:22'),
(16, 'Public Speaking', 'public-speaking', 'im-icon-Microphone-7', '2024-07-26 16:13:00', '2024-07-26 16:13:00'),
(17, 'Drama', 'drama', 'im-icon-Film-Board', '2024-07-26 16:14:13', '2024-07-26 16:14:13'),
(18, 'MAD Sciences', 'mad-sciences', 'im-icon-Formula', '2024-07-26 16:16:38', '2024-07-26 16:16:38'),
(19, 'Reading and Books', 'reading-and-books', 'im-icon-Book', '2024-07-26 16:17:01', '2024-07-26 16:17:01'),
(20, 'Robotics and Coding', 'robotics-and-coding', 'im-icon-Robot', '2024-07-26 16:17:35', '2024-07-26 16:17:35'),
(21, 'Computing', 'computing', 'im-icon-Computer', '2024-07-26 16:18:11', '2024-07-26 16:18:11'),
(22, 'Mathletics', 'mathletics', 'im-icon-Formula', '2024-07-26 16:18:54', '2024-07-26 16:18:54'),
(23, 'Engineering', 'engineering', 'im-icon-Engineering', '2024-07-26 16:19:16', '2024-07-26 16:19:16'),
(24, 'Press', 'press', 'im-icon-TV', '2024-07-26 16:19:38', '2024-07-26 16:19:38'),
(25, 'JET', 'jet', 'im-icon-Engineering', '2024-07-26 16:20:13', '2024-07-26 16:20:13'),
(26, 'Safety', 'safety', 'im-icon-Security-Check', '2024-07-26 16:21:04', '2024-07-26 16:21:04'),
(27, 'Young Entrepeneurs', 'young-entrepeneurs', 'im-icon-Business-ManWoman', '2024-07-26 16:21:48', '2024-07-26 16:21:48'),
(28, 'Arts and Craft', 'arts-and-craft', 'im-icon-Palette', '2024-07-26 16:23:07', '2024-07-26 16:23:07'),
(29, 'Foreign Languages', 'foreign-languages', 'im-icon-Books-2', '2024-07-26 16:24:41', '2024-07-26 16:24:41'),
(30, 'Red Cross', 'red-cross', 'im-icon-Hospital-2', '2024-07-26 16:27:01', '2024-07-26 16:27:01'),
(31, 'Girls Guide', 'girls-guide', 'im-icon-Female', '2024-07-26 16:27:55', '2024-07-26 16:27:55'),
(32, 'Boys Scout', 'boys-scout', 'im-icon-Male', '2024-07-26 16:28:24', '2024-07-26 16:28:24'),
(33, 'Gymnastics', 'gymnastics', 'im-icon-Gymnastics', '2024-07-26 16:28:56', '2024-07-26 16:28:56'),
(34, 'STEM', 'stem', 'im-icon-Formula', '2024-07-26 16:29:47', '2024-07-26 16:29:47'),
(35, 'Sewing', 'sewing', 'im-icon-Sewing-Machine', '2024-07-26 16:30:15', '2024-07-26 16:30:15'),
(36, 'Home Makers', 'home-makers', 'im-icon-Home-2', '2024-07-26 16:32:33', '2024-07-26 16:32:33'),
(37, 'Bible', 'bible', 'im-icon-Book', '2024-07-26 16:33:08', '2024-07-26 16:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int UNSIGNED NOT NULL,
  `facility_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facility_value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `facility_name`, `facility_value`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Science laboratory', 'science-laboratory', 'im-icon-Chemical', '2024-07-26 16:40:39', '2024-07-26 16:40:39'),
(2, 'ICT Laboratory', 'ict-laboratory', 'im-icon-Computer', '2024-07-26 16:41:59', '2024-07-26 16:41:59'),
(3, 'ART Room', 'art-room', 'im-icon-Palette', '2024-07-26 16:42:34', '2024-07-26 16:42:34'),
(4, 'Music room', 'music-room', 'im-icon-Music-Note4', '2024-07-26 16:43:05', '2024-07-26 16:43:05'),
(5, 'Sporting Facilities', 'sporting-facilities', 'im-icon-Sports-Shirt', '2024-07-26 16:44:13', '2024-07-26 16:44:13'),
(6, 'Football Academy', 'football-academy', 'im-icon-Football-2', '2024-07-26 16:44:42', '2024-07-26 16:44:42'),
(7, 'Medicare', 'medicare', 'im-icon-Hospital', '2024-07-26 16:45:09', '2024-07-26 16:45:09'),
(8, 'Swimming Pool', 'swimming-pool', 'im-icon-Swimming', '2024-07-26 16:45:34', '2024-07-26 16:45:34'),
(9, 'Internet', 'internet', 'im-icon-Globe', '2024-07-26 16:46:17', '2024-07-26 16:46:17'),
(10, 'Dinning Hall', 'dinning-hall', 'im-icon-Plates', '2024-07-26 16:52:31', '2024-07-26 16:52:31'),
(11, 'Robotics lab', 'robotics-lab', 'im-icon-Robot-2', '2024-07-26 16:52:55', '2024-07-26 16:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `form_fields`
--

CREATE TABLE `form_fields` (
  `id` int UNSIGNED NOT NULL,
  `section_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bs_length` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `options` varchar(20000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`id`, `section_id`, `title`, `type`, `description`, `bs_length`, `options`, `created_at`, `updated_at`) VALUES
(1, '1', 'First name', 'text', 'Applicant\'s first name', '6', '[]', '2024-07-28 07:50:17', '2024-07-28 07:50:17'),
(2, '1', 'Last name', 'text', 'Applicant\'s last name', '6', '[]', '2024-07-28 08:01:38', '2024-07-28 08:01:38'),
(3, '1', 'Gender', 'select', 'Gender of applicant', '6', '[{\"id\":\"option-0\",\"name\":\"Male\",\"value\":\"male\"},{\"id\":\"option-1\",\"name\":\"Female\",\"value\":\"female\"}]', '2024-07-28 08:02:38', '2024-07-28 08:02:38'),
(4, '1', 'Date of Birth', 'date', 'Applicant\'s date of birth', '6', '[]', '2024-07-28 08:49:56', '2024-07-28 08:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `form_sections`
--

CREATE TABLE `form_sections` (
  `id` int UNSIGNED NOT NULL,
  `form_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `form_sections`
--

INSERT INTO `form_sections` (`id`, `form_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, '4', 'Personal Information', 'Submit applicant information', '2024-07-28 07:45:55', '2024-07-28 07:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-04-02 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-04-02 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `landing_page_pic` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `email`, `country`, `phone`, `url`, `status`, `logo`, `landing_page_pic`, `created_at`, `updated_at`) VALUES
(1, 'Test School', 'kkudayisitobi@gmail.com', 'Nigeria', '7054291601', 'testschools', 'pending', 'https://res.cloudinary.com/admissionboox/image/upload/v1722103103/rtk6wnecop3kyzbxi5y9.jpg', 'https://res.cloudinary.com/admissionboox/image/upload/v1722103113/ozbjmpui9w9mnw7eopzf.jpg', '2024-07-26 15:27:45', '2024-07-27 16:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `school_addresses`
--

CREATE TABLE `school_addresses` (
  `id` int UNSIGNED NOT NULL,
  `school_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `school_state` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `school_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `school_coords` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `school_addresses`
--

INSERT INTO `school_addresses` (`id`, `school_id`, `school_state`, `school_address`, `school_coords`, `created_at`, `updated_at`) VALUES
(1, '1', 'undefined', 'undefined', 'undefined,undefined', '2024-07-26 15:27:45', '2024-07-27 17:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `school_admissions`
--

CREATE TABLE `school_admissions` (
  `id` int UNSIGNED NOT NULL,
  `school_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `session` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `term_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `form_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `school_admissions`
--

INSERT INTO `school_admissions` (`id`, `school_id`, `session`, `term_id`, `form_id`, `end_date`, `created_at`, `updated_at`) VALUES
(4, '1', '2024/2025', '1', '4', '2024-09-13', '2024-07-28 06:07:30', '2024-07-28 06:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `school_applications`
--

CREATE TABLE `school_applications` (
  `id` int UNSIGNED NOT NULL,
  `admission_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_classes`
--

CREATE TABLE `school_classes` (
  `id` int UNSIGNED NOT NULL,
  `school_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `class_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `class_value` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `school_classes`
--

INSERT INTO `school_classes` (`id`, `school_id`, `class_name`, `class_value`, `created_at`, `updated_at`) VALUES
(1, '1', 'JSS 1', 'jss-1', '2024-07-27 17:16:12', '2024-07-27 17:16:12'),
(2, '1', 'JSS 2', 'jss-2', '2024-07-27 17:16:19', '2024-07-27 17:16:19'),
(3, '1', 'JSS 3', 'jss-3', '2024-07-27 17:16:25', '2024-07-27 17:16:25'),
(4, '1', 'SSS 1', 'sss-1', '2024-07-27 17:16:34', '2024-07-27 17:16:34'),
(5, '1', 'SSS 2', 'sss-2', '2024-07-27 17:16:46', '2024-07-27 17:16:46'),
(6, '1', 'SSS 3', 'sss-3', '2024-07-27 17:16:52', '2024-07-27 17:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `school_clubs`
--

CREATE TABLE `school_clubs` (
  `id` int UNSIGNED NOT NULL,
  `school_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `club_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `school_clubs`
--

INSERT INTO `school_clubs` (`id`, `school_id`, `club_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(2, '1', '2', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(3, '1', '5', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(4, '1', '14', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(5, '1', '5', '2024-07-27 17:01:17', '2024-07-27 17:01:17'),
(6, '1', '9', '2024-07-27 17:01:17', '2024-07-27 17:01:17'),
(7, '1', '21', '2024-07-27 17:01:17', '2024-07-27 17:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `school_facilities`
--

CREATE TABLE `school_facilities` (
  `id` int UNSIGNED NOT NULL,
  `school_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `facility_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `school_facilities`
--

INSERT INTO `school_facilities` (`id`, `school_id`, `facility_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(2, '1', '2', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(3, '1', '3', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(4, '1', '4', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(5, '1', '5', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(6, '1', '7', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(7, '1', '9', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(8, '1', '10', '2024-07-26 20:34:37', '2024-07-26 20:34:37'),
(9, '1', '6', '2024-07-27 17:01:17', '2024-07-27 17:01:17'),
(10, '1', '8', '2024-07-27 17:01:17', '2024-07-27 17:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `school_infos`
--

CREATE TABLE `school_infos` (
  `id` int UNSIGNED NOT NULL,
  `school_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `boarding_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `hbu` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `hbu_other` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `school_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `school_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `school_curriculum` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `school_fees` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `wcu` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `school_infos`
--

INSERT INTO `school_infos` (`id`, `school_id`, `boarding_type`, `hbu`, `hbu_other`, `school_name`, `school_type`, `school_curriculum`, `school_fees`, `wcu`, `created_at`, `updated_at`) VALUES
(1, '1', 'both', 'other', 'Testing others', 'Test School', 'early-primary-secondary', 'early-only', '151-300', 'This is an awesome description of our great school. We   have a lot of facilities and equipment to ensure your child has a wonderful environment to learn in.', '2024-07-26 15:27:45', '2024-07-26 15:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `school_owners`
--

CREATE TABLE `school_owners` (
  `id` int UNSIGNED NOT NULL,
  `school_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `school_owners`
--

INSERT INTO `school_owners` (`id`, `school_id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, '1', 'Ashaka', 'ashaka@testschools.com', '08079284917', '2024-07-26 15:27:45', '2024-07-26 15:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `school_resources`
--

CREATE TABLE `school_resources` (
  `id` int UNSIGNED NOT NULL,
  `school_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `school_resources`
--

INSERT INTO `school_resources` (`id`, `school_id`, `url`, `created_at`, `updated_at`) VALUES
(1, '1', 'https://res.cloudinary.com/admissionboox/image/upload/v1722103029/aysnxgugodwzqtqywjno.jpg', '2024-07-27 16:57:10', '2024-07-27 16:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `senders`
--

CREATE TABLE `senders` (
  `id` int UNSIGNED NOT NULL,
  `ss` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sa` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sec` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `su` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `spp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `current` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sn` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `se` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-03-23 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-03-23 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `senders`
--

INSERT INTO `senders` (`id`, `ss`, `sp`, `sa`, `sec`, `su`, `spp`, `current`, `type`, `sn`, `se`, `status`, `created_at`, `updated_at`) VALUES
(1, 'smtp-pulse.com', '465', 'yes', 'ssl', 'pancraseikore@gmail.com', 'F6HQmJkQf44T3', 'yes', 'other', 'AdmissionBoox', 'info@primetechmedia.com.ng', 'enabled', '2024-05-20 22:00:00', '2024-05-20 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, '1st Term', '1', '2024-05-16 22:00:00', '2024-05-16 22:00:00'),
(2, '2nd Term', '2', '2024-05-16 22:00:00', '2024-05-16 22:00:00'),
(3, '3rd Term', '3', '2024-05-16 22:00:00', '2024-05-16 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fname` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lname` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `verified` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `complete_signup` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `reset_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-03-28 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-03-28 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `fname`, `lname`, `phone`, `gender`, `role`, `verified`, `complete_signup`, `password`, `remember_token`, `reset_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'kkudayisitobi@gmail.com', 'Test School', '', '7054291601', '', 'school_admin', 'yes', 'yes', '$2y$10$XMlYy.5BgPgpJD7S2fip6e/lQ6.3mS3srf5GwPFutpI6EskCaqlhS', 'jwGOpR49WKE3MFthEO2buwak8WUlQvqP9SxQTUnucyCKpF34sSuvy67rHF0F', 'default', 'ok', '2024-07-26 15:27:45', '2024-07-26 15:29:19'),
(2, 'kudayisitobi@gmail.com', 'Tobi', 'Tobi', '08063378465', 'male', 'admin', 'yes', 'yes', '$2y$10$AR8.zf5rncwDn7xAmDA5me.V.bXOpPjwN9UciWqnaAcveNPm3Srnu', 'F0VlmFUigbkY8ycYraJ9pHrOHL6ORbKrsZ8xpdbmXFlTiLecemVbJYByVZGN', 'default', 'ok', '2024-07-26 15:31:27', '2024-07-26 15:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int UNSIGNED NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2024-05-16 22:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `country`, `city`, `address`, `created_at`, `updated_at`) VALUES
(1, '2', 'nigeria', 'Lagos', 'Patience St', '2024-07-26 15:31:27', '2024-07-26 15:31:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_classes`
--
ALTER TABLE `admission_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_forms`
--
ALTER TABLE `admission_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_data`
--
ALTER TABLE `application_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_sections`
--
ALTER TABLE `form_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plugins`
--
ALTER TABLE `plugins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_addresses`
--
ALTER TABLE `school_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_admissions`
--
ALTER TABLE `school_admissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_applications`
--
ALTER TABLE `school_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_classes`
--
ALTER TABLE `school_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_clubs`
--
ALTER TABLE `school_clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_facilities`
--
ALTER TABLE `school_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_infos`
--
ALTER TABLE `school_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_owners`
--
ALTER TABLE `school_owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_resources`
--
ALTER TABLE `school_resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senders`
--
ALTER TABLE `senders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_classes`
--
ALTER TABLE `admission_classes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admission_forms`
--
ALTER TABLE `admission_forms`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `application_data`
--
ALTER TABLE `application_data`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `form_fields`
--
ALTER TABLE `form_fields`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `form_sections`
--
ALTER TABLE `form_sections`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_addresses`
--
ALTER TABLE `school_addresses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_admissions`
--
ALTER TABLE `school_admissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `school_applications`
--
ALTER TABLE `school_applications`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_classes`
--
ALTER TABLE `school_classes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `school_clubs`
--
ALTER TABLE `school_clubs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `school_facilities`
--
ALTER TABLE `school_facilities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `school_infos`
--
ALTER TABLE `school_infos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_owners`
--
ALTER TABLE `school_owners`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_resources`
--
ALTER TABLE `school_resources`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `senders`
--
ALTER TABLE `senders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
