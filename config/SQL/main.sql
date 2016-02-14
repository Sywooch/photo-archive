-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 14 Lut 2016, 12:55
-- Wersja serwera: 5.5.37
-- Wersja PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `photo_archive`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `is_published` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `albums`
--

INSERT INTO `albums` (`id`, `name`, `description`, `owner_id`, `is_deleted`, `is_published`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(2, 'Album1', 'test', 1, 0, 0, 1, '2016-01-09 23:31:35', 1, '2016-01-09 23:32:00'),
(3, 'Album2', 'test2', 1, 0, 0, 1, '2016-01-10 10:46:33', 1, '2016-01-10 10:46:33');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_polish_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1452112743),
('m150214_044831_init_user', 1452112751);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `album_id` int(11) NOT NULL,
  `file_orig_name` text COLLATE utf8_polish_ci NOT NULL,
  `file_sys_name` text COLLATE utf8_polish_ci NOT NULL,
  `file_ext` text COLLATE utf8_polish_ci NOT NULL,
  `title` text COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=85 ;

--
-- Zrzut danych tabeli `photos`
--

INSERT INTO `photos` (`id`, `is_deleted`, `album_id`, `file_orig_name`, `file_sys_name`, `file_ext`, `title`, `description`, `owner_id`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(11, 0, 2, 'DSC_0331.JPG', '11', 'jpg', 'DSC_0331.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 01:22:56', 1, '2016-01-10 01:22:56'),
(12, 0, 3, 'DSC_0376.JPG', '12', 'jpg', 'DSC_0376.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:44', 1, '2016-01-10 10:46:44'),
(13, 0, 3, 'DSC_0375.JPG', '13', 'jpg', 'DSC_0375.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:44', 1, '2016-01-10 10:46:44'),
(14, 0, 3, 'DSC_0373.JPG', '14', 'jpg', 'DSC_0373.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:44', 1, '2016-01-10 10:46:44'),
(15, 0, 3, 'DSC_0374.JPG', '15', 'jpg', 'DSC_0374.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:44', 1, '2016-01-10 10:46:44'),
(16, 0, 3, 'DSC_0372.JPG', '16', 'jpg', 'DSC_0372.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:44', 1, '2016-01-10 10:46:44'),
(17, 0, 3, 'DSC_0371.JPG', '17', 'jpg', 'DSC_0371.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:44', 1, '2016-01-10 10:46:44'),
(18, 0, 3, 'DSC_0369.JPG', '18', 'jpg', 'DSC_0369.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:44', 1, '2016-01-10 10:46:44'),
(19, 0, 3, 'DSC_0370.JPG', '19', 'jpg', 'DSC_0370.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:44', 1, '2016-01-10 10:46:44'),
(20, 0, 3, 'DSC_0368.JPG', '20', 'jpg', 'DSC_0368.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:45', 1, '2016-01-10 10:46:45'),
(21, 0, 3, 'DSC_0367.JPG', '21', 'jpg', 'DSC_0367.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:45', 1, '2016-01-10 10:46:45'),
(22, 0, 3, 'DSC_0366.JPG', '22', 'jpg', 'DSC_0366.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:45', 1, '2016-01-10 10:46:45'),
(23, 0, 3, 'DSC_0365.JPG', '23', 'jpg', 'DSC_0365.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:45', 1, '2016-01-10 10:46:45'),
(24, 0, 3, 'DSC_0363.JPG', '24', 'jpg', 'DSC_0363.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:45', 1, '2016-01-10 10:46:45'),
(25, 0, 3, 'DSC_0364.JPG', '25', 'jpg', 'DSC_0364.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:46', 1, '2016-01-10 10:46:46'),
(26, 0, 3, 'DSC_0361.JPG', '26', 'jpg', 'DSC_0361.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:46', 1, '2016-01-10 10:46:47'),
(27, 0, 3, 'DSC_0362.JPG', '27', 'jpg', 'DSC_0362.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 10:46:47', 1, '2016-01-10 10:46:47'),
(53, 0, 2, 'DSC_0117.JPG', '53', 'jpg', 'DSC_0117.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:21', 1, '2016-01-10 15:59:21'),
(54, 0, 2, 'DSC_0136.JPG', '54', 'jpg', 'DSC_0136.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:39', 1, '2016-01-10 15:59:39'),
(55, 0, 2, 'DSC_0135.JPG', '55', 'jpg', 'DSC_0135.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:39', 1, '2016-01-10 15:59:39'),
(56, 0, 2, 'DSC_0133.JPG', '56', 'jpg', 'DSC_0133.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:39', 1, '2016-01-10 15:59:39'),
(57, 0, 2, 'DSC_0134.JPG', '57', 'jpg', 'DSC_0134.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:39', 1, '2016-01-10 15:59:39'),
(58, 0, 2, 'DSC_0132.JPG', '58', 'jpg', 'DSC_0132.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:39', 1, '2016-01-10 15:59:39'),
(59, 0, 2, 'DSC_0131.JPG', '59', 'jpg', 'DSC_0131.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:39', 1, '2016-01-10 15:59:39'),
(60, 0, 2, 'DSC_0130.JPG', '60', 'jpg', 'DSC_0130.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:40', 1, '2016-01-10 15:59:40'),
(61, 0, 2, 'DSC_0129.JPG', '61', 'jpg', 'DSC_0129.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:40', 1, '2016-01-10 15:59:40'),
(62, 0, 2, 'DSC_0127.JPG', '62', 'jpg', 'DSC_0127.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:40', 1, '2016-01-10 15:59:40'),
(63, 0, 2, 'DSC_0128.JPG', '63', 'jpg', 'DSC_0128.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:40', 1, '2016-01-10 15:59:40'),
(64, 0, 2, 'DSC_0126.JPG', '64', 'jpg', 'DSC_0126.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:40', 1, '2016-01-10 15:59:40'),
(65, 0, 2, 'DSC_0125.JPG', '65', 'jpg', 'DSC_0125.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:40', 1, '2016-01-10 15:59:40'),
(66, 0, 2, 'DSC_0124.JPG', '66', 'jpg', 'DSC_0124.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:40', 1, '2016-01-10 15:59:40'),
(67, 0, 2, 'DSC_0123.JPG', '67', 'jpg', 'DSC_0123.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:41', 1, '2016-01-10 15:59:41'),
(68, 0, 2, 'DSC_0122.JPG', '68', 'jpg', 'DSC_0122.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:41', 1, '2016-01-10 15:59:41'),
(69, 0, 2, 'DSC_0121.JPG', '69', 'jpg', 'DSC_0121.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 15:59:42', 1, '2016-01-10 15:59:42'),
(70, 0, 2, 'DSC_0109.JPG', '70', 'jpg', 'DSC_0109.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-10 16:00:40', 1, '2016-01-10 16:00:40'),
(71, 0, 3, '1920469_10152557868328433_2154499309949155180_n.jpg', '71', 'jpg', '1920469_10152557868328433_2154499309949155180_n.jpg', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-11 13:45:13', 1, '2016-01-11 13:45:13'),
(72, 0, 3, 'logo-fcb-barselona-hd-pictures-4.jpg', '72', 'jpg', 'logo-fcb-barselona-hd-pictures-4.jpg', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-11 13:45:15', 1, '2016-01-11 13:45:15'),
(73, 0, 3, 'logo-fcb-barselona-hd-pictures-4-black.jpg', '73', 'jpg', 'logo-fcb-barselona-hd-pictures-4-black.jpg', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-11 13:45:15', 1, '2016-01-11 13:45:15'),
(74, 0, 3, '100_1915.JPG', '74', 'jpg', '100_1915.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-31 21:49:59', 1, '2016-01-31 21:49:59'),
(75, 0, 3, '100_1918.JPG', '75', 'jpg', '100_1918.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-31 21:50:00', 1, '2016-01-31 21:50:00'),
(76, 0, 3, '100_1911.JPG', '76', 'jpg', '100_1911.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-31 21:50:00', 1, '2016-01-31 21:50:00'),
(77, 0, 3, '100_1909.JPG', '77', 'jpg', '100_1909.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-31 21:50:00', 1, '2016-01-31 21:50:00'),
(78, 0, 3, '100_1908.JPG', '78', 'jpg', '100_1908.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-31 21:50:00', 1, '2016-01-31 21:50:00'),
(79, 0, 3, '100_1906.JPG', '79', 'jpg', '100_1906.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-31 21:50:01', 1, '2016-01-31 21:50:01'),
(80, 0, 3, '100_1905.JPG', '80', 'jpg', '100_1905.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-31 21:50:01', 1, '2016-01-31 21:50:01'),
(81, 0, 3, '100_1904.JPG', '81', 'jpg', '100_1904.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-31 21:50:02', 1, '2016-01-31 21:50:02'),
(82, 0, 3, '100_1903.JPG', '82', 'jpg', '100_1903.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-31 21:50:02', 1, '2016-01-31 21:50:02'),
(83, 0, 3, '100_1867.JPG', '83', 'jpg', '100_1867.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-31 21:50:03', 1, '2016-01-31 21:50:03'),
(84, 0, 3, '100_1902.JPG', '84', 'jpg', '100_1902.JPG', 'To zdjęcie nie ma jeszcze opisu.', 1, 1, '2016-01-31 21:50:03', 1, '2016-01-31 21:50:03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `created_at`, `updated_at`, `full_name`) VALUES
(1, 1, '2016-01-06 19:39:11', '2016-02-12 09:27:51', 'Mateusz Karczmarczyk');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `can_admin` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`, `can_admin`) VALUES
(1, 'Admin', '2016-01-06 19:39:11', NULL, 1),
(2, 'User', '2016-01-06 19:39:11', NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logged_in_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logged_in_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  `banned_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`email`),
  UNIQUE KEY `user_username` (`username`),
  KEY `user_role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `role_id`, `status`, `email`, `username`, `password`, `auth_key`, `access_token`, `logged_in_ip`, `logged_in_at`, `created_ip`, `created_at`, `updated_at`, `banned_at`, `banned_reason`) VALUES
(1, 1, 1, 'mateusz.karczmarczyk@gmail.com', 'Administrator', '$2y$13$d6k.mm39o6PGS8X4R6Wmr.DnEXNZeAAotLgDdd8utY04pLBkseQzy', 'lmtqDC_PX3Gx3PDQvKzWOoWa0zPevGvk', 'aeLIqWfg79Q76ibfXpAF3YpEYZX9sgbd', '46.187.148.114', '2016-02-12 09:26:43', NULL, '2016-01-06 19:39:11', '2016-02-12 09:27:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_auth`
--

CREATE TABLE IF NOT EXISTS `user_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_attributes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_auth_provider_id` (`provider_id`),
  KEY `user_auth_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_token`
--

CREATE TABLE IF NOT EXISTS `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` smallint(6) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_token_token` (`token`),
  KEY `user_token_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Ograniczenia dla tabeli `user_auth`
--
ALTER TABLE `user_auth`
  ADD CONSTRAINT `user_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ograniczenia dla tabeli `user_token`
--
ALTER TABLE `user_token`
  ADD CONSTRAINT `user_token_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

