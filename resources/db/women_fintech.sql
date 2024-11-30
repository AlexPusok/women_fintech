-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 02:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `women_fintech`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `event_type` enum('workshop','mentoring','networking','conference') DEFAULT NULL,
  `max_participants` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `location`, `event_type`, `max_participants`, `created_by`, `created_at`) VALUES
(1, 'Women\'s Conference', 'A conference about women\'s role in fintech', '2024-12-03 13:03:55', 'FSEGA', 'conference', 200, 1, '2024-11-30 11:05:11'),
(2, 'Introductory Workshop', 'A workshop for all the new members', '2024-12-06 15:00:00', 'FSEGA', 'workshop', 50, 1, '2024-11-30 11:25:14'),
(3, 'First Mentoring Event', 'First Mentoring Event in the history of our organization', '2024-11-28 13:32:22', 'FSEGA', 'mentoring', 20, 1, '2024-11-30 11:33:40');

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('confirmed','waiting','cancelled') DEFAULT 'confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_registrations`
--

INSERT INTO `event_registrations` (`id`, `member_id`, `event_id`, `registration_date`, `status`) VALUES
(2, 14, 1, '2024-11-30 12:35:15', 'confirmed'),
(3, 14, 2, '2024-11-30 12:35:31', 'confirmed'),
(4, 2, 1, '2024-11-30 13:00:03', 'confirmed'),
(5, 1, 2, '2024-11-30 13:08:28', 'confirmed'),
(6, 1, 1, '2024-11-30 13:10:25', 'confirmed'),
(7, 14, 3, '2024-11-30 13:30:18', 'confirmed'),
(8, 4, 1, '2024-11-30 13:43:50', 'confirmed'),
(9, 4, 3, '2024-11-30 13:44:41', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profession` varchar(100) DEFAULT '-',
  `company` varchar(100) DEFAULT '-',
  `expertise` text DEFAULT NULL,
  `linkedin_profile` varchar(255) DEFAULT NULL,
  `pfp` varchar(500) NOT NULL DEFAULT 'resources/default_profile_pic.jpg',
  `status` enum('admin','member','mentor') DEFAULT 'member',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(200) NOT NULL DEFAULT 'parola'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `email`, `profession`, `company`, `expertise`, `linkedin_profile`, `pfp`, `status`, `created_at`, `password`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '-', '-', '', '', 'resources/pfp_674917b8aee725.33131065.jpg', 'admin', '2024-11-28 22:04:01', 'parola'),
(2, 'Ana', 'Pop', 'ana@pop.ro', 'Scriitor', 'x', 'dada', 'https://www.linkedin.com/in/ana_pop', 'resources/default_profile_pic.jpg', 'member', '2024-11-25 22:20:14', 'parola'),
(3, 'Maria', 'Popescu', 'mariapopescu@yahoo.com', 'Contabil', 'a', 'dasd', 'https://www.linkedin.com/in/maria_popescu', 'resources/default_profile_pic.jpg', 'member', '2024-11-26 10:07:13', 'parola'),
(4, 'Mara', 'Banc', 'marabanc@gmail.com', 'Contabil', 'ad', 'kvcxv', 'https://www.linkedin.com/in/mara_banc', 'resources/default_profile_pic.jpg', 'mentor', '2024-11-26 10:09:06', 'parola'),
(5, 'Oana', 'Cenan', 'cenanoana@yahoo.com', 'Secretar', 'rkpfg', 'gpkdpskf', 'https://www.linkedin.com/in/oana_cenan', 'resources/default_profile_pic.jpg', 'mentor', '2024-11-26 10:09:53', 'parola'),
(6, 'Roxana', 'Toma', 'roxanatoma@gmail.com', 'Programator', 'faed', 'fdsvasd', 'https://www.linkedin.com/in/roxana_toma', 'resources/default_profile_pic.jpg', 'member', '2024-11-26 10:12:18', 'parola'),
(7, 'Sara', 'Daniel', 'saradaniel@yahoo.com', 'Director', 'faelsk', 'fkldskl', 'https://www.linkedin.com/in/sara_daniel', 'resources/default_profile_pic.jpg', 'member', '2024-11-26 10:13:03', 'parola'),
(8, 'Flavia', 'Antonescu', 'flaviaantonescu@yahoo.com', 'HR', 'fldak', 'lfkdalk', 'https://www.linkedin.com/in/flavia_antonescu', 'resources/default_profile_pic.jpg', 'member', '2024-11-26 10:16:04', 'parola'),
(9, 'Mihaela', 'Deac', 'mihaeladeac@gmail.com', 'Developer', 'fae', 'fasf', 'https://www.linkedin.com/in/mihaela_deac', 'resources/default_profile_pic.jpg', 'member', '2024-11-27 22:10:17', 'parola'),
(10, 'Denisa', 'Andreica', 'denisaandreica@gmail.com', 'HR', 'fsd', 'sfvdsf', 'https://www.linkedin.com/in/denisa_andreica', 'resources/default_profile_pic.jpg', 'member', '2024-11-27 22:11:18', 'parola'),
(11, 'Andreea', 'Plosca', 'andreeaplosca@gmail.com', 'Contabil', 'gdsg', 'eafas', 'https://www.linkedin.com/in/andreea_plosca', 'resources/default_profile_pic.jpg', 'member', '2024-11-27 22:12:10', 'parola'),
(12, 'Larisa', 'Bota', 'larisabota@gmail.com', 'Developer', 'kad', 'fljdsjflvcx', 'https://www.linkedin.com/in/larisa_bota', 'resources/default_profile_pic.jpg', 'member', '2024-11-28 23:09:59', 'parola'),
(13, 'Ramona', 'Zaha', 'ramonazaha@yahoo.com', 'Director', 'fgeakd', 'flkdlfkdsq', 'https://www.linkedin.com/in/ramona_zaha', 'resources/pfp_674918c5b59218.60502720.jpg', 'member', '2024-11-28 23:13:16', 'parola'),
(14, 'Briana', 'Ochis', 'bri@gmail.com', '-', '-', NULL, NULL, 'resources/default_profile_pic.jpg', 'member', '2024-11-29 16:04:22', 'parola');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `read_status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `member_id`, `message`, `read_status`, `created_at`) VALUES
(1, 1, 'Welcome to the Women Fintech website!', 1, '2024-11-29 15:33:21'),
(2, 14, 'Welcome to Women in FinTech, Briana! Your account has been created successfully.', 1, '2024-11-29 16:04:22'),
(3, 1, 'notification', 1, '2024-11-30 10:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `event_id`, `member_id`, `rating`, `review`, `created_at`) VALUES
(1, 3, 1, 5, 'This was very eye opening', '2024-11-30 12:07:49'),
(2, 3, 2, 4, 'It was a good experience', '2024-11-30 12:08:51'),
(3, 3, 14, 1, 'Not very interesting', '2024-11-30 13:30:18'),
(4, 3, 4, 1, 'Rau', '2024-11-30 13:44:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `members` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_registrations_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_registrations_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
