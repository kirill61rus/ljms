-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 09 2014 г., 16:51
-- Версия сервера: 5.5.32
-- Версия PHP: 5.4.19

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



-- --------------------------------------------------------

--
-- Структура таблицы `divisions`
--

CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `fall_ball` tinyint(1) NOT NULL,
  `age_from` int(2) NOT NULL,
  `age_to` int(2) NOT NULL,
  `description` text NOT NULL,
  `rules` text NOT NULL,
  `base_fee` float NOT NULL,
  `addon_fee` float NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `status`, `fall_ball`, `age_from`, `age_to`, `description`, `rules`, `base_fee`, `addon_fee`, `logo`) VALUES
(1, '1', 0, 0, 5, 5, '', '', 0, 0, ''),
(2, '2', 0, 0, 5, 5, '', '', 0, 0, ''),
(3, '3', 0, 0, 5, 5, '', '', 0, 0, ''),
(4, '4', 0, 0, 5, 5, '', '', 0, 0, ''),
(5, '5', 0, 0, 5, 5, '', '', 0, 0, ''),
(6, '6', 0, 0, 5, 5, '', '', 0, 0, ''),
(7, '7', 0, 0, 5, 5, '', '', 0, 0, ''),
(8, '8', 0, 0, 5, 5, '', '', 0, 0, ''),
(9, '9', 0, 0, 5, 5, '', '', 0, 0, ''),
(10, '10', 0, 0, 5, 5, '', '', 0, 0, ''),
(11, 'хххх', 0, 0, 5, 8, '', '', 12, 21, '');

-- --------------------------------------------------------

--
-- Структура таблицы `leagues`
--

CREATE TABLE IF NOT EXISTS `leagues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `leagues`
--

INSERT INTO `leagues` (`id`, `name`) VALUES
(1, 'LJMS Teams'),
(2, 'Non conference Teams');

-- --------------------------------------------------------

--
-- Структура таблицы `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(256) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state_id` int(11) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `medical_info` text NOT NULL,
  `shirt_type_id` int(11) NOT NULL,
  `shirt_size_id` int(11) NOT NULL,
  `short_type_id` int(11) NOT NULL,
  `short_size_id` int(11) NOT NULL,
  `name_jersey` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  KEY `short_size_id` (`short_size_id`),
  KEY `short_type_id` (`short_type_id`),
  KEY `shirt_size_id` (`shirt_size_id`),
  KEY `shirt_type_id` (`shirt_type_id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- СВЯЗИ ТАБЛИЦЫ `players`:
--   `state_id`
--       `states` -> `id`
--   `shirt_type_id`
--       `wear_types` -> `id`
--   `shirt_size_id`
--       `wear_sizes` -> `id`
--   `short_type_id`
--       `wear_types` -> `id`
--   `short_size_id`
--       `wear_sizes` -> `id`
--   `team_id`
--       `teams` -> `id`
--

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Director'),
(3, 'Coach'),
(4, 'Manager'),
(5, 'Guardian');

-- --------------------------------------------------------

--
-- Структура таблицы `roles_to_users`
--

CREATE TABLE IF NOT EXISTS `roles_to_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- СВЯЗИ ТАБЛИЦЫ `roles_to_users`:
--   `user_id`
--       `users` -> `id`
--   `role_id`
--       `roles` -> `id`
--

--
-- Дамп данных таблицы `roles_to_users`
--

INSERT INTO `roles_to_users` (`id`, `user_id`, `role_id`, `division_id`, `team_id`) VALUES
(1, 25, 1, 0, 0),
(2, 25, 2, 5, 0),
(3, 25, 1, 0, 0),
(4, 25, 1, 0, 0),
(10, 19, 1, 0, 0),
(11, 19, 1, 0, 0),
(12, 19, 1, 0, 0),
(13, 19, 1, 0, 0),
(14, 19, 1, 0, 0),
(15, 19, 1, 0, 0),
(18, 27, 2, 5, 0),
(23, 27, 3, 6, 2),
(25, 27, 1, 0, 0),
(26, 32, 1, 0, 0),
(27, 32, 3, 6, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Alaska'),
(2, 'Alabama'),
(3, 'American Samoa'),
(4, 'Arizona'),
(5, 'Arkansas'),
(6, 'California'),
(7, 'Colorado'),
(8, 'Connecticut'),
(9, 'Delaware'),
(10, 'District of Columbia'),
(11, 'Federated States of Micronesia'),
(12, 'Florida'),
(13, 'Georgia'),
(14, 'Guam'),
(15, 'Hawaii'),
(16, 'Idaho'),
(17, 'Illinois'),
(18, 'Indiana'),
(19, 'Iowa'),
(20, 'Kansas'),
(21, 'Kentucky'),
(22, 'Louisiana'),
(23, 'Maine'),
(24, 'Marshall Islands'),
(25, 'Maryland'),
(26, 'Massachusetts'),
(27, 'Michigan'),
(28, 'Minnesota'),
(29, 'Mississippi'),
(30, 'Missouri'),
(31, 'Montana'),
(32, 'Nebraska'),
(33, 'Nevada'),
(34, 'New Hampshire'),
(35, 'New Jersey'),
(36, 'New Mexico'),
(37, 'New York'),
(38, 'North Carolina'),
(39, 'North Dakota'),
(40, 'Northern Mariana Islands'),
(41, 'Ohio'),
(42, 'Oklahoma'),
(43, 'Oregon'),
(44, 'Palau'),
(45, 'Pennsylvania'),
(46, 'Puerto Rico'),
(47, 'Rhode Island'),
(48, 'South Carolina'),
(49, 'South Dakota'),
(50, 'Tennessee'),
(51, 'Texas'),
(52, 'Utah'),
(53, 'Vermont'),
(54, 'Virgin Islands'),
(55, 'Virginia'),
(56, 'Washington'),
(57, 'West Virginia'),
(58, 'Wisconsin'),
(59, 'Wyoming'),
(60, 'Armed Forces Africa'),
(61, 'Armed Forces Americas (except Canada)'),
(62, 'Armed Forces Canada'),
(63, 'Armed Forces Europe'),
(64, 'Armed Forces Middle East'),
(65, 'Armed Forces Pacific');

-- --------------------------------------------------------

--
-- Структура таблицы `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `division_id` int(11) NOT NULL,
  `league_type_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_visitor` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `division_id` (`division_id`),
  KEY `league_type_id` (`league_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- СВЯЗИ ТАБЛИЦЫ `teams`:
--   `division_id`
--       `divisions` -> `id`
--   `league_type_id`
--       `leagues` -> `id`
--

--
-- Дамп данных таблицы `teams`
--

INSERT INTO `teams` (`id`, `name`, `division_id`, `league_type_id`, `status`, `is_visitor`) VALUES
(1, '1', 7, 1, 1, 1),
(2, '2', 6, 1, 0, 1),
(3, '3', 4, 1, 1, 0),
(4, 'еще', 6, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `teams_to_users`
--

CREATE TABLE IF NOT EXISTS `teams_to_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- СВЯЗИ ТАБЛИЦЫ `teams_to_users`:
--   `user_id`
--       `users` -> `id`
--   `team_id`
--       `teams` -> `id`
--

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `age` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `name`, `email`, `age`) VALUES
(1, '444', 'gadfgfadsgdsfhga', 1),
(2, '444', 'dsgfds@dsfgsd/', 2),
(3, '444', 'dfgdsgasdg', 4),
(4, '22', 'dsgdsagasd', 3),
(5, '22', 'gsdgadsgas', 45);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state_id` int(11) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `home_phone` varchar(50) NOT NULL,
  `cell_phone` varchar(50) NOT NULL,
  `alt_phone` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `alt_first_name` varchar(100) NOT NULL,
  `alt_last_name` varchar(100) NOT NULL,
  `alt_email` varchar(100) NOT NULL,
  `alt_phone_2` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- СВЯЗИ ТАБЛИЦЫ `users`:
--   `state_id`
--       `states` -> `id`
--

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `address`, `city`, `state_id`, `zipcode`, `email`, `home_phone`, `cell_phone`, `alt_phone`, `password`, `alt_first_name`, `alt_last_name`, `alt_email`, `alt_phone_2`, `status`) VALUES
(3, 'kirill', 'star', 'petr', 'tag', 1, 111111, 'kirill@kirill.com', '123', '123', '122', '', 'alt_first_name', 'alt_last_name', 'alt_email', 'alt_phone_2', 1),
(4, 'второй', 'пользователь', 'rnd', 'ros', 3, 109, 'zzzzzzzzz', '2222', '222', '222', '111111', '11', '11', '11', '1111', 1),
(10, 'седьмой', 'ога', '', '', 10, 0, '', '', '', '', '', '', '0', '', '0', 1),
(15, '2', '2', '', '', 7, 0, '', '', '', '', '', '', '0', '', '', 1),
(16, '3', '3', '', '', 7, 0, '', '', '', '', '', '', '0', '', '', 1),
(17, '4', '4', '', '', 12, 0, '', '', '', '', '', '', '0', '', '', 1),
(18, '5', '5', '', '', 13, 0, '', '', '', '', '', '', '0', '', '', 1),
(19, 'ytytyty', '6', '', '', 7, 0, '', '', '', '', '', '', '0', '', '', 1),
(20, '7', '7', '', '', 11, 0, '', '', '', '', '', '', '0', '', '', 1),
(21, '8', '8', '', '', 17, 0, '', '', '', '', '', '', '0', '', '', 1),
(25, 'name', 'family', '', '', 4, 0, '', '', '', '', '', '', '0', '', '', 1),
(27, 'проверка', 'проверка', '', '', 6, 0, '', '', '', '', '', '', '0', '', '', 1),
(28, '32523523', '235123521', '', '', 5, 0, '', '', '', '', '', '', '0', '', '', 1),
(29, '325135123', '32523152', '', '', 7, 0, '', '', '', '', '', '', '0', '', '', 1),
(30, '3525123512', '325235321', '', '', 7, 0, '', '', '', '', '', '', '0', '', '', 1),
(31, '34523523', '3523523', '', '', 10, 0, '', '', '', '', '', '', '0', '', '', 1),
(32, '4444444444', '4444444444', '', '', 4, 0, '', '', '', '', '', '', '0', '', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `wear_sizes`
--

CREATE TABLE IF NOT EXISTS `wear_sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wear_sizes`
--

INSERT INTO `wear_sizes` (`id`, `name`) VALUES
(1, 'X-Small'),
(2, 'Small'),
(3, 'Medium'),
(4, 'Large'),
(5, 'X-Large'),
(6, 'XX-Large'),
(7, 'XXX-Large');

-- --------------------------------------------------------

--
-- Структура таблицы `wear_types`
--

CREATE TABLE IF NOT EXISTS `wear_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wear_types`
--

INSERT INTO `wear_types` (`id`, `name`) VALUES
(1, 'Youth'),
(2, 'Abult');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `players_ibfk_2` FOREIGN KEY (`shirt_type_id`) REFERENCES `wear_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `players_ibfk_3` FOREIGN KEY (`shirt_size_id`) REFERENCES `wear_sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `players_ibfk_4` FOREIGN KEY (`short_type_id`) REFERENCES `wear_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `players_ibfk_5` FOREIGN KEY (`short_size_id`) REFERENCES `wear_sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `players_ibfk_6` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `roles_to_users`
--
ALTER TABLE `roles_to_users`
  ADD CONSTRAINT `roles_to_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_to_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teams_ibfk_2` FOREIGN KEY (`league_type_id`) REFERENCES `leagues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `teams_to_users`
--
ALTER TABLE `teams_to_users`
  ADD CONSTRAINT `teams_to_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teams_to_users_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
