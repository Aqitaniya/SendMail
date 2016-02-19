-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 19 2015 г., 14:47
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `bd_mails`
--

-- --------------------------------------------------------

--
-- Структура таблицы `mails_in`
--

CREATE TABLE IF NOT EXISTS `mails_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(200) NOT NULL,
  `theme` varchar(250) NOT NULL DEFAULT 'no team',
  `date` date NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `mails_in`
--

INSERT INTO `mails_in` (`id`, `sender`, `theme`, `date`, `text`) VALUES
(2, 'a', 'theme1', '2015-09-23', 'text1'),
(6, 'b', 'theme2', '0000-00-00', 'text2'),
(7, 'c', 'theme3', '2015-10-20', 'text3'),
(9, 'd', 'theme4', '2015-10-20', 'text4'),
(10, 'e', 'theme5', '2015-10-19', 'text5');

-- --------------------------------------------------------

--
-- Структура таблицы `mails_out`
--

CREATE TABLE IF NOT EXISTS `mails_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient` varchar(200) NOT NULL,
  `theme` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`,`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=224 ;

--
-- Дамп данных таблицы `mails_out`
--

INSERT INTO `mails_out` (`id`, `recipient`, `theme`, `date`, `text`) VALUES
(178, 'a', 'theme1', '2015-09-17 00:00:00', 'text1'),
(180, 'b', 'theme2', '2015-09-17 00:00:00', 'text2'),
(183, 'c', 'theme4', '2015-09-11 00:00:00', 'text4'),
(204, 'stacey2008@mail.ru', 'theme5', '2015-09-17 00:00:00', 'text5'),
(218, 'stacey2008@mail.ru', 'theme6', '2015-10-12 19:31:00', 'text6'),
(219, 'd', 'theme7', '2015-10-19 00:00:00', 'text7'),
(220, 'e', 'theme8', '2015-10-19 00:00:00', 'text8'),
(221, 'f', 'theme9', '2015-10-19 00:00:00', 'text9'),
(222, 'j', 'theme0', '2015-10-19 00:00:00', 'text0'),
(223, 'stacey2008@mail.ru', 'theme', '2015-10-19 14:39:44', 'text');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
