-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 01:26 PM
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
-- Database: `universitysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `profile_picture`) VALUES
(1, 'Ammara Khawaja', 'ammara@gmail.com', 'ammara', 'profile.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `allocated_courses`
--

CREATE TABLE `allocated_courses` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `course_id` int(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allocated_courses`
--

INSERT INTO `allocated_courses` (`id`, `session`, `course_id`, `student_id`, `faculty_id`, `semester`) VALUES
(1, '2021-2025', 1, '1', 1, 'Spring'),
(2, '2021-2025', 1, '2', 1, 'Spring');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `pre_requisite` varchar(255) NOT NULL,
  `credits` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`, `pre_requisite`, `credits`) VALUES
(1, 'Web Design & Development', 'SE-3203', '-', '3'),
(2, 'Human Computer Interaction', 'SE-3204', 'Software Construction', '4'),
(3, 'Object Oriented Programming', 'MS-1203', 'Programming Fundamentals', '4'),
(4, 'Information Security', 'MS-1023', '-', '3');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `email`, `designation`, `password`, `department`, `address`, `gender`, `qualification`, `phone`) VALUES
(1, 'Dr. Zaman Fakhar', 'zaman@gmail.com', 'Lecturer', '76348738273', 'Software Engineering', 'Muzaffarabad', 'Male', 'PhD', '9876543678'),
(2, 'Dr Engr. Zaman Fakhar', 'zaman@gmail.com', 'Lecturer', '5367368', 'Software Engineering', 'Muzaffarabad', 'Male', 'PhD', '9876543678'),
(3, 'Engr. Dr Asma Javaid', 'asmajavaid@gmail.com', 'Lab Engineer', '6747838', 'Software Engineering', 'Muzaffarabad', 'Female', 'PhD', ''),
(4, 'Engr Yaseen Malik', 'yaseen@gmail.com', 'Lab Engineer', '8798993', 'Cyber Security', 'Kotli', 'Male', 'MPhil', ''),
(5, 'Engr Sidra Rafique', 'sidra@gmail.com', 'Lab Engineer', '765467890', 'Arificial Intelligence', 'Muzaffarabad', 'Female', 'MS', ''),
(6, 'Hamza Rasheed', 'hamza@gmail.com', 'Lecturer', '4567328', 'Cyber Security', 'Hajira', 'Male', 'MPhil', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `registration_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phone`, `password`, `session`, `gender`, `address`, `program`, `registration_number`) VALUES
(1, 'Zubia Israr', 'zubia@gmail.com', '987654567', 'zubia', '2021-2025', 'Female', 'Gojara Muzaffarabad', 'BSc. SE', '2021-SE-01'),
(2, 'Anish Waseem', 'anish@gmail.com', '56789009870', 'anish', '2021-2025', 'Female', 'Muzaffarabad', 'BSc. SE', '2021-SE-02'),
(4, 'Momina Naveed', 'momna@gmail.com', '09876543', 'momna', '2023-2027', 'Female', 'Muzaffarabad', 'BSc. SE', '2023-SE-01'),
(5, 'Muneeba Shafiq', 'muneeba@gmail.com', '09876876', 'muneeba', '2021-2025', 'Female', 'Muzaffarabad', 'BSc. SE', '2021-SE-03'),
(6, 'Humna Ayub', 'humna@gmail.com', '121327329', '48479843', '2023-2027', 'Female', 'Rawalakot', 'BSc. SE', '2023-SE-02'),
(7, 'Yahya Ali', 'yahya@gmail.com', '873874729', '123456', '2024-2028', 'Male', 'Mirpur', 'BSc. SE', '2024-SE-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `allocated_courses`
--
ALTER TABLE `allocated_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allocated_courses`
--
ALTER TABLE `allocated_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
