-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 22, 2024 lúc 12:10 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `users`
--
CREATE DATABASE IF NOT EXISTS `users` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `users`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `challenge`
--

CREATE TABLE `challenge` (
  `challengeID` int(11) NOT NULL,
  `challengeName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `file`
--

CREATE TABLE `file` (
  `studentID` varchar(11) NOT NULL,
  `challenge` varchar(11) NOT NULL,
  `fileName` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `sender_id` varchar(200) NOT NULL,
  `receiver_id` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `timestamp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(255) NOT NULL,
  `student_name` varchar(30) NOT NULL,
  `student_email` varchar(30) NOT NULL,
  `student_class` varchar(5) NOT NULL,
  `student_ID` char(12) NOT NULL,
  `phone_num` int(11) NOT NULL,
  `avatar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`id`, `username`, `password`, `student_name`, `student_email`, `student_class`, `student_ID`, `phone_num`, `avatar`) VALUES
(1, 'student1', 'c0b1d84fd16d13bf53eb5e8b2c197565b569855240b59ad4b7b812df946534c4', 'Trần Văn A', 'student1@gmail.com', '1a2', '12345', 123456789, ''),
(2, 'student2', 'c0b1d84fd16d13bf53eb5e8b2c197565b569855240b59ad4b7b812df946534c4', 'Trần Văn B', 'student2@gmail.com', '1a2', '12345', 123456789, 'avatar/avatar.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(255) NOT NULL,
  `teacher_name` varchar(30) NOT NULL,
  `teacher_email` varchar(30) NOT NULL,
  `teacher_class` varchar(5) NOT NULL,
  `teacher_ID` char(12) NOT NULL,
  `phone_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `teachers`
--

INSERT INTO `teachers` (`id`, `username`, `password`, `teacher_name`, `teacher_email`, `teacher_class`, `teacher_ID`, `phone_num`) VALUES
(1, 'teacher1', 'c0b1d84fd16d13bf53eb5e8b2c197565b569855240b59ad4b7b812df946534c4', 'teacher1', 'teacher1@gmail.com', '1a2', '123a123', 123456789),
(2, 'teacher2', 'c0b1d84fd16d13bf53eb5e8b2c197565b569855240b59ad4b7b812df946534c4', 'Nguyễn Văn B', 'teacher2@gmail.com', '2a1', '123abc', 123456789);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `challenge`
--
ALTER TABLE `challenge`
  ADD PRIMARY KEY (`challengeID`);

--
-- Chỉ mục cho bảng `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `challenge`
--
ALTER TABLE `challenge`
  MODIFY `challengeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
