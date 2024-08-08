-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 03:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `truekords`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fullname`, `username`, `password`, `avatar`) VALUES
(1, 'Mai Đức Anh', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chords`
--

CREATE TABLE `chords` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chords`
--

INSERT INTO `chords` (`id`, `name`, `image_path`, `description`, `category_id`) VALUES
(1, 'Am7', 'chord_images/Am7.png', 'C Major chord', NULL),
(2, 'C Minor', NULL, 'C Minor chord', NULL),
(3, 'D Major', NULL, 'D Major chord', NULL),
(4, 'D Minor', NULL, 'D Minor chord', NULL),
(5, 'E Major', NULL, 'E Major chord', NULL),
(6, 'E Minor', NULL, 'E Minor chord', NULL),
(7, 'F Major', NULL, 'F Major chord', NULL),
(8, 'F Minor', NULL, 'F Minor chord', NULL),
(9, 'G Major', NULL, 'G Major chord', NULL),
(12, 'A Minor', NULL, 'A Minor chord', NULL),
(13, 'B Major', NULL, 'B Major chord', NULL),
(14, 'B Minor', NULL, 'B Minor chord', NULL),
(15, 'Dm7', 'chord_images/Dm7.png', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lyrics`
--

CREATE TABLE `lyrics` (
  `song_id` int(11) NOT NULL,
  `lyric` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lyrics`
--

INSERT INTO `lyrics` (`song_id`, `lyric`) VALUES
(1, 'Ánh mắt long lanh nhìn qua khung trời nhỏ\r\nLê bước chân theo, vượt qua con đường rộng\r\nEm xõa mái tóc, nhẹ nhàng ôm lấy anh trong chiều thu\r\nTừng chiếc lá nhẹ rơi\r\nThời gian đi qua, mưa vắng từng lần gặp mặt\r\nVà hình bóng ai đã bên em mỗi chiều hẹn\r\nHay tại vì anh đã không dám bước qua ranh giới ? \r\nCùng người vẫn chờ ai\r\n \r\nVà anh nhìn em cười vui hồn nhiên như ngày xưa gặp nhau\r\nCó lỡ phút giây nào trong tim em giống như yêu\r\nVẫn ngày qua hẹn nhau, dẫu chẳng đi về đâu\r\nVẫn sẻ chia từng câu chuyện dài\r\nVà anh chỉ biết mặc cho thời gian sẽ dần phai nhạt đi\r\nNhững ký ức vẫn từ con tim em đã như yêu\r\nVà ta sẽ cùng nhau giữ mãi nụ cười vui\r\nVì ta sẽ mãi là tình nhân.\r\n\r\n'),
(2, 'Đêm qua em mơ thấy anh mang mùa xuân yêu thương dịu êm\r\nCùng điệu nhạc chất ngất, hòa theo tiếng trái tim em rộn lên\r\nCầm bàn tay, anh nói những lời ân ái mặn nồng\r\nThời gian ngưng mãi cho hoa lá khoe màu\r\nKhi ban mai đánh thức giấc mơ hồng đêm qua em đã mơ\r\nNgười giờ này đã đến một nơi rất xa xăm em còn đây\r\nBờ mi em hoen nước mắt vì tình yêu tan vỡ\r\nBiết khi nào anh như giấc mơ ngày qua\r\nLòng em luôn khao khát nhớ mong người ơi anh biết chăng?\r\nChìm đắm không gian lặng im ngàn vì sao vụt tắt\r\nThuyền đã sang ngang làm cho con sóng không xô về bờ\r\nNgày đó đắm say vì sao anh quên bao câu ca\r\nCùng mùa xuân thắm tươi ước hẹn tình đầu môi hôn thay lời yêu\r\nLạc bước cô đơn mình em một mùa đông giá băng\r\nLạnh buốt môi em nhẹ run run hát câu ca ngày xưa\r\nChỉ biết mất anh là đau thương dù còn vấn vương\r\nEm sẽ tin giấc mơ có thật\r\nEm chờ anh\r\nHuh-hoh, huh-hoh, hoh\r\nKhi ban mai đánh thức giấc mơ hồng đêm qua em đã mơ\r\nNgười giờ này đã đến một nơi rất xa xăm em còn đây\r\nBờ mi em hoen nước mắt vì tình yêu tan vỡ\r\nBiết khi nào anh như giấc mơ ngày qua\r\nLòng em luôn khao khát nhớ mong người ơi anh biết chăng\r\nChìm đắm không gian lặng im ngàn vì sao vụt tắt\r\nThuyền đã sang ngang làm cho con sóng không xô về bờ\r\nNgày đó đắm say vì sao anh quên bao câu ca\r\nCùng mùa xuân thắm tươi ước hẹn tình đầu môi hôn thay lời yêu\r\nLạc bước cô đơn mình em một mùa đông giá băng\r\nLạnh buốt môi em nhẹ run run hát câu ca ngày xưa\r\nChỉ biết mất anh là đau thương dù còn vấn vương\r\nEm sẽ tin giấc mơ có thật\r\nChìm đắm không gian lặng im ngàn vì sao vụt tắt\r\nThuyền đã sang ngang làm cho con sóng không xô về bờ\r\nNgày đó đắm say vì sao anh quên bao câu ca\r\nCùng mùa xuân thắm tươi ước hẹn tình đầu môi hôn thay lời yêu\r\nLạc bước cô đơn mình em một mùa đông giá băng\r\nLạnh buốt môi em nhẹ run run hát câu ca ngày xưa\r\nChỉ biết mất anh là đau thương dù còn vấn vương\r\nEm sẽ tin giấc mơ có thật\r\nEm chờ anh\r\nHuh-hoh, huh-hoh, hoh\r\nEm chờ anh'),
(3, 'Anh, những lúc say em hay thường nghĩ…\r\nNếu ngày xưa ấy, em đến sớm hơn thì sao?\r\nChắc có lẽ ta đang vui với nhau\r\nChắc có lẽ ta đang xây với nhau\r\nMột tình yêu, một giấc mơ\r\n\r\nAnh, đã mấy tháng trôi qua khi ta cách xa\r\nĐôi đường đôi ngả, giờ ta cũng sắp xa lạ…\r\nMỗi đêm em nhớ về anh\r\nVào lúc 11 giờ 11 phút\r\nNhưng chắc anh chẳng nhớ em đâu\r\n\r\nVì em vẫn chỉ là người đến sau\r\nVẫn mang trong mình một ngàn nỗi đau\r\nVà có lẽ chắc giờ này, anh đang hạnh phúc bên người… oh oh…\r\nVì em vẫn mãi là người đến sau\r\nMãi mang trong mình một ngàn nỗi đau\r\nMong anh sớm quên em / người anh đã từng yêu thương.\r\n\r\nTrong tình yêu có lẽ ai yêu hơn sẽ là người tổn thương nhiều hơn\r\nSẽ lâu lành hơn cũng như mất nhiều năm hơn để quên đi.\r\nNhưng vì do quá yêu nên càng hạnh phúc lại càng thấy nâng niu.\r\nKỷ niệm em xin giữ, còn người hãy cứ đi đi.\r\n\r\nVì sao anh nỡ làm tim em nát tan\r\nĐến đây vội vàng rồi lại dở dang\r\nTình yêu cứ ngỡ dịu dàng\r\nBỗng dưng lại hóa bẽ bàng\r\nVì em vẫn mãi là người đến sau\r\nMãi mang trong mình một ngàn nỗi đau\r\nMong anh sớm quên em  người anh đã từng yêu thương.'),
(4, '(Verse 1)\r\n[15] Cứ ngỡ suốt đời chẳng thể yêu một ai\r\nNhưng trái tim của em, đã rung động lúc anh ngang chốn đây.\r\nThắp sáng cả cuộc đời buồn tênh\r\nChắc là, tuyết đang tan khi có cơn gió xuân ghé đến.\r\n\r\n(Chorus 1)\r\nĐược nhìn anh mỗi ban mai\r\nKhép môi nhẹ khi cánh hoa rơi ngoài sân\r\nDù cho đôi lúc em hay lo sợ\r\nRằng ngày mai đôi ta tan như khói mây.\r\nEm vẫn nhớ tay anh \r\nĐã nắm tay em bước đi dưới mưa\r\nNiềm hạnh phúc trong em nhỏ bé vậy thôi...\r\n\r\n(Verse 2)\r\nCứ ngỡ suốt đời sẽ chung đôi niềm vui\r\nNhưng trái tim của em, vỡ tan rồi lúc anh xa chốn đây.\r\nChớm tắt cả cuộc đời buồn tênh,\r\nChắc là tuyết đang rơi khi lá thu đã tàn khắp lối.\r\n\r\n(Chorus 2)\r\nThật lòng em rất tham lam\r\nChỉ muốn cùng anh đến nơi xa thật xa\r\nCùng già đi với nếp nhăn chân đồi\r\nCùng cầm tay đôi ta phiêu du khắp nơi\r\nCho đến lúc tan đi\r\nVẫn ước bên nhau có nhau kiếp sau.\r\nNiềm hạnh phúc trong em nhỏ bé vậy thôi.\r\n\r\n(Bridge)\r\nĐiều em mong ước, cho đến sau cùng\r\nLà được sống cùng anh\r\nDù điều đó, có thể sẽ làm anh khóc...\r\nVậy thôi em xin anh cứ đi đi\r\nVà hãy sống, sống thật bình yên\r\nDù tên anh, vẫn mãi ghi trong niềm nhớ.\r\n\r\n(Chorus 3)\r\nKhi nhìn anh mỗi ngày\r\nKhép môi nhẹ khi hoa khẽ rơi ngoài sân\r\nLàm cho đôi lúc em hay lo sợ\r\nRằng ngày mai đôi ta tan như khói mây.\r\nEm vẫn nhớ nắm tay\r\nMình nắm tay nhau bước đi dưới mưa\r\nNiềm hạnh phúc trong em nhỏ bé vậy thôi...\r\n\r\nVà sẽ yêu như mùa như mùa tuyết đầu tiên...');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sheets`
--

CREATE TABLE `sheets` (
  `id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `sheet_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sheets`
--

INSERT INTO `sheets` (`id`, `song_id`, `sheet_path`) VALUES
(1, 2, 'sheet_path/Giacmocothat.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `release_date` date DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `root_tone` varchar(255) DEFAULT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `release_date`, `youtube_link`, `root_tone`, `update_date`) VALUES
(1, 'Những Giai Điệu Khác 2', 'Minh Tốc & Lam', '2021-02-12', 'wN5gtfGI6Hg', 'D', '2024-08-07 23:48:34'),
(2, 'Giấc Mơ Có Thật', 'Lệ Quyên', '2013-05-23', 'c6EBuAUfNHU', 'A', '2024-08-07 23:48:34'),
(3, 'Một Ngàn Nỗi Đau', 'Văn Mai Hương', '2022-03-04', 'l0yKQLaNk5g', 'E', '2024-08-07 23:48:34'),
(4, 'Như Mùa Tuyết Đầu Tiên (Cover)', 'Văn Mai Hương', '2009-03-05', 'YNOw54TYVbI', 'C', '2024-08-07 23:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `song_requests`
--

CREATE TABLE `song_requests` (
  `id` int(11) NOT NULL,
  `song_title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chords`
--
ALTER TABLE `chords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `lyrics`
--
ALTER TABLE `lyrics`
  ADD PRIMARY KEY (`song_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `sheets`
--
ALTER TABLE `sheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song_requests`
--
ALTER TABLE `song_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chords`
--
ALTER TABLE `chords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sheets`
--
ALTER TABLE `sheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `song_requests`
--
ALTER TABLE `song_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chords`
--
ALTER TABLE `chords`
  ADD CONSTRAINT `chords_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `chord_categories` (`id`);

--
-- Constraints for table `lyrics`
--
ALTER TABLE `lyrics`
  ADD CONSTRAINT `lyrics_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lyrics_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lyrics_ibfk_3` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_4` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_6` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sheets`
--
ALTER TABLE `sheets`
  ADD CONSTRAINT `sheets_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`);

--
-- Constraints for table `song_requests`
--
ALTER TABLE `song_requests`
  ADD CONSTRAINT `song_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `song_requests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `song_requests_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
