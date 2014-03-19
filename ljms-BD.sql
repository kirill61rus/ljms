-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 19 2014 г., 16:56
-- Версия сервера: 5.6.16
-- Версия PHP: 5.5.9

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ljms`
--

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
(1, '1', 1, 0, 5, 8, '', '', 0, 0, ''),
(2, '2', 1, 0, 5, 10, '', '', 0, 0, ''),
(3, '3', 1, 0, 5, 8, '', '', 0, 0, ''),
(4, '4', 0, 0, 5, 5, '', '', 0, 0, ''),
(5, '5', 0, 0, 5, 5, '', '', 0, 0, ''),
(6, '6', 1, 0, 5, 5, '', '', 0, 0, ''),
(7, '7', 1, 0, 5, 5, '', '', 0, 0, ''),
(8, '8', 1, 0, 5, 5, '', '', 0, 0, ''),
(9, '9', 1, 0, 5, 5, '', '', 0, 0, ''),
(10, '10', 1, 0, 5, 5, '', '', 0, 0, ''),
(11, '<iNpUt type="text" />', 0, 0, 5, 8, 'The <iNpUt type="text" /> Division shall be the next level of play after 12U. A semi travel competitive division, which competes with surrounding towns.The <iNpUt type="text" /> Division shall be the next level of play after 12U. A semi travel competitive division, which competes with surrounding towns.The <iNpUt type="text" /> Division shall be the next level of play after 12U. A semi travel competitive division, which competes with surrounding towns.', 'ASA and SWS League - click here ASA and SWS League - click here ASA and SWS League - click here ASA and SWS League - click here ASA and SWS League - click here ASA and SWS League - click here ASA and SWS League - click here ASA and SWS League - click here ASA and SWS League - click here ASA and SWS League - click here ASA and SWS League - click here ASA and SWS League - click here ', 12, 21, '');

-- --------------------------------------------------------

--
-- Структура таблицы `game_schedule`
--

CREATE TABLE IF NOT EXISTS `game_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `division_id` int(11) NOT NULL,
  `home_team_id` int(11) NOT NULL,
  `visitor_team_id` int(11) NOT NULL,
  `practice` tinyint(1) NOT NULL,
  `location_id` int(11) NOT NULL,
  `home_team_result` int(11) NOT NULL,
  `visitor_team_result` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `division_id` (`division_id`),
  KEY `home_team_id` (`home_team_id`),
  KEY `visitor_team_id` (`visitor_team_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `game_schedule`
--

INSERT INTO `game_schedule` (`id`, `date`, `time`, `division_id`, `home_team_id`, `visitor_team_id`, `practice`, `location_id`, `home_team_result`, `visitor_team_result`, `status`) VALUES
(3, '2014-03-19', '22:22:00', 4, 3, 8, 1, 11, 9, 0, 1),
(4, '2014-03-26', '23:10:00', 4, 3, 8, 1, 15, 5, 3, 1),
(5, '2014-03-12', '11:25:00', 6, 4, 4, 0, 11, 0, 0, 0),
(6, '2014-03-12', '11:15:00', 5, 9, 9, 0, 16, 0, 0, 0),
(7, '2014-03-25', '22:17:00', 8, 10, 10, 1, 15, 0, 0, 0),
(8, '2014-03-11', '03:24:00', 7, 1, 1, 1, 12, 0, 0, 0),
(9, '2014-03-26', '21:13:00', 5, 9, 9, 1, 14, 0, 0, 0),
(10, '2014-04-17', '12:36:00', 6, 4, 4, 0, 8, 0, 0, 0),
(11, '2014-12-18', '23:36:00', 4, 3, 8, 0, 10, 0, 0, 0);

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
-- Структура таблицы `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'Beau Bien Park'),
(2, 'Bolingbrook Fury'),
(3, 'Butler School'),
(4, 'Central Park #1'),
(5, 'Central Park #2'),
(6, 'Community Park - C5'),
(7, 'Crossroads - West'),
(8, 'Doerhoefer Park - SW'),
(9, 'Frontier South Field#5'),
(10, 'Hassert Park Blue'),
(11, 'Jackson Creek East'),
(12, 'Knoch Park Field #2'),
(13, 'LTHS Freshman Field'),
(14, 'McCollum Park #1'),
(15, 'Mokena, Heritage'),
(16, 'OHS Field #1'),
(17, 'Plainfield'),
(18, 'Powers Park - SW'),
(19, 'Raintree Field'),
(20, 'Tate Woods Park'),
(21, 'Volunteer Park #3'),
(22, 'Washington Park');

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
-- Дамп данных таблицы `roles_to_users`
--

INSERT INTO `roles_to_users` (`id`, `user_id`, `role_id`, `division_id`, `team_id`) VALUES
(1, 25, 1, 0, 0),
(2, 25, 2, 5, 0),
(10, 19, 1, 0, 0),
(25, 27, 1, 0, 0),
(26, 32, 1, 0, 0),
(27, 32, 3, 6, 4),
(28, 10, 3, 4, 3),
(30, 36, 1, 0, 0),
(31, 35, 1, 0, 0),
(32, 35, 2, 8, 0),
(33, 35, 3, 7, 1),
(34, 35, 3, 1, 11),
(35, 35, 4, 7, 1),
(36, 15, 1, 0, 0),
(37, 35, 5, 0, 0),
(38, 35, 4, 4, 3),
(39, 35, 3, 1, 7),
(40, 16, 3, 5, 9),
(41, 17, 3, 8, 10),
(42, 10, 1, 0, 0),
(43, 10, 2, 6, 0),
(44, 37, 1, 0, 0),
(45, 37, 5, 0, 0),
(48, 10, 3, 11, 12),
(49, 10, 4, 11, 12),
(50, 4, 1, 0, 0);

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
-- Дамп данных таблицы `teams`
--

INSERT INTO `teams` (`id`, `name`, `division_id`, `league_type_id`, `status`, `is_visitor`) VALUES
(1, '1', 7, 1, 0, 1),
(3, 'команда', 4, 2, 1, 0),
(4, '7', 6, 1, 1, 1),
(7, '6', 1, 1, 1, 0),
(8, 'team best', 4, 1, 1, 0),
(9, '4', 5, 1, 0, 0),
(10, 'уууеее', 8, 1, 0, 0),
(11, '<iNpUt type="text" />team', 1, 1, 1, 0),
(12, 'для пробы', 11, 1, 1, 0);

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
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `address`, `city`, `state_id`, `zipcode`, `email`, `home_phone`, `cell_phone`, `alt_phone`, `password`, `alt_first_name`, `alt_last_name`, `alt_email`, `alt_phone_2`, `status`) VALUES
(3, 'kirill', 'star', 'petr', 'tag', 1, 111111, 'kirill@kirill.com', '35234421', '421124354321', '41245231451', '', 'alt_first_name', 'alt_last_name', 'First@fas.sd', '5489543516', 1),
(4, 'второй', 'пользователь', 'rnd', 'ros', 3, 109, 'fgrrrsdf@dsgas.dg', '5252353252', '22241241', '2221241241', '111111', 'first', 'last', 'fdgrrrsdf@dsgas.dg', '5546465489', 1),
(10, 'gdsags', 'dgagasdgas', 'gdsags', 'gdsags', 10, 123141, 'fgasdf@dsgas.dg', '1413514551', '', '', 'd25e5308c3b59561719a3f5d82567648', '', 'dgsdsdgs', '', '', 0),
(15, 'второй', 'второй', 'nonono', 'no', 7, 13323322, 'kkkirill@kirill.com', '12312414', '', '', '96e79218965eb72c92a549dd5a330112', 'totototo', '', '', '', 1),
(16, 'fgasdf@dsgas.dg', 'fgasdf@dsgas.dg', 'fgasdf@dsgas.dg', 'fgasdf@dsgas.dg', 7, 32352, 'dfgasdf@dsgas.dg', '5321521523', '', '', 'd25e5308c3b59561719a3f5d82567648', '', '0', '', '', 1),
(17, 'fgasdfg', 'fgasdf', 'fgasdf', 'fgasd', 5, 34563, 'fgassdf@dsgas.dg', '325125312', '', '', 'b508a724fae00d7eaaf01934809a011e', '', '0', '', '', 1),
(18, 'sdfas', 'sdgfsd', 'safa', 'safas', 13, 3523, 'ffgassdf@dsgas.dg', '526234564632', '', '', 'b508a724fae00d7eaaf01934809a011e', '', '0', '', '', 1),
(19, 'ytytyty', 'wqqwd', 'dgadg', 'dssf', 7, 323, 'ftgassdf@dsgas.dg', '54134124', '', '', 'b508a724fae00d7eaaf01934809a011e', '', '0', '', '', 1),
(21, 'fwf', 'dsfds', 'safasdf', 'dsgfasd', 17, 2412, 'fgfassdf@dsgas.dg', '21412245132', '', '', 'b508a724fae00d7eaaf01934809a011e', '', '0', '', '', 1),
(25, 'name', 'family', 'dfgsdfa', 'dsgagfasd', 4, 3241, 'fgrassdf@dsgas.dg', '15132452313', '', '', 'b508a724fae00d7eaaf01934809a011e', '', '0', '', '', 1),
(27, 'проверка', 'проверка', 'проверка', 'проверка', 6, 0, 'dsfs@sfdsa.fs', '124141341', '', '', '', '', '0', '', '', 1),
(28, '32523523', '235123521', 'gdsga', 'agfsagfa', 11, 3232, 'fgtassdf@dsgas.dg', '1245123412', '', '', 'b508a724fae00d7eaaf01934809a011e', '', '0', '', '', 1),
(32, 'First', 'Last', 'alasdd', 'tikol', 4, 51465, 'rtwer@dsfsa.re', '456846465', '', '', '96e79218965eb72c92a549dd5a330112', '', '0', '', '', 1),
(34, 'kkirill@kirill.com', 'kkirill@kirill.com', 'kkirill@kirill.com', 'kkirill@kirill.com', 3, 1, 'k1irill@kirill.com', '11111111', '', '', 'ecc805eb4ed4b15ca0459e23e1872d9f', '', '', '', '', 1),
(35, '<iNpUt type="text" />', '<iNpUt type="text" />', '<iNpUt type="text" />', '<iNpUt type="text" />', 2, 1, 'dg.sd@sfg.yu', '89094356440', '4523523', '', 'dg.sd@sfg.yu', '\\\\ "test" /?.&amp;&*@#$%^*;~`<iNpUt type="text" />фыва.&%\\ ''<b>t_e_st</b>''', '\\\\ "test" /?.&amp;&*@#$%^*;~`<iNpUt type="text" />фыва.&%\\ ''<b>t_e_st</b>''', '', '', 1),
(36, '1', '1', '1', '1', 3, 1, 'sdg@sdg.ri', '111111111111', '11111111111', '', '5095f5ac9780f552085a5dc06bd5ee48', '', '', '', '', 1),
(37, 'user', 'user', 'adress', 'city', 6, 21, 'sdfasd@fgb.ff', '3214124', '', '', '4f5a5a047bac53e630b352cb12fd85f5', '', '', '', '', 1);

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
-- Ограничения внешнего ключа таблицы `game_schedule`
--
ALTER TABLE `game_schedule`
  ADD CONSTRAINT `game_schedule_ibfk_1` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_schedule_ibfk_2` FOREIGN KEY (`home_team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_schedule_ibfk_3` FOREIGN KEY (`visitor_team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_schedule_ibfk_4` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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