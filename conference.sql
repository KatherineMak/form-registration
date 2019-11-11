-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Сен 12 2019 г., 18:06
-- Версия сервера: 5.7.27-0ubuntu0.18.04.1
-- Версия PHP: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `conference`
--

-- --------------------------------------------------------

--
-- Структура таблицы `participaints`
--

CREATE TABLE `participaints` (
  `id` int(11) NOT NULL,
  `firstname` text CHARACTER SET utf8 COLLATE utf8_bin,
  `lastname` text CHARACTER SET utf8 COLLATE utf8_bin,
  `birthday` text CHARACTER SET utf8 COLLATE utf8_bin,
  `reportSubject` text CHARACTER SET utf8 COLLATE utf8_bin,
  `phone` text CHARACTER SET utf8 COLLATE utf8_bin,
  `country` text CHARACTER SET utf8 COLLATE utf8_bin,
  `email` text CHARACTER SET utf8 COLLATE utf8_bin,
  `company` text CHARACTER SET utf8 COLLATE utf8_bin,
  `position` text CHARACTER SET utf8 COLLATE utf8_bin,
  `aboutMe` text CHARACTER SET utf8 COLLATE utf8_bin,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'photo.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `participaints`
--

INSERT INTO `participaints` (`id`, `firstname`, `lastname`, `birthday`, `reportSubject`, `phone`, `country`, `email`, `company`, `position`, `aboutMe`, `photo`) VALUES
(41, 'Kate', 'Makogon', '29/05/2000', 'Web', '+3(068) 980-8244', 'Ukraine', 'kat@gmail.com', 'Albedo', 'Junior', 'Good.', 'a36cc5881db8300a482c731ee15bbe67.jpg'),
(42, 'Daiv', 'Alon', '09/12/1963', 'Frontend', '+3(805) 452-3478', 'Ukraine', 'daiv@gmail.com', NULL, NULL, NULL, 'photo.png'),
(47, 'Julia', 'fgfdg', '08/14/2019', 'knitting', '+1(555) 555-5555', 'Ukraine', 'julia@gmail.com', NULL, NULL, NULL, 'photo.png'),
(69, 'kate', 'gee', '09/13/1967', 'Kos', '+1(345) 453-5345', 'Ukraine', 'km@albedo.dev', 'Lalal', 'alalala', 'dfsf', 'a16fd5616dd425e8f5d2f1b9407020f7.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `participaints`
--
ALTER TABLE `participaints`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `participaints`
--
ALTER TABLE `participaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
