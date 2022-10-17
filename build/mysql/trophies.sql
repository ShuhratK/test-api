-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Окт 17 2022 г., 14:05
-- Версия сервера: 8.0.31
-- Версия PHP: 8.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `trophies`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`%` PROCEDURE `incrementTrophy` (IN `user_id` INT, IN `amount` INT)   UPDATE trophies
SET trophies.count = trophies.count + amount
WHERE trophies.user_id = user_id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `trophies`
--

CREATE TABLE `trophies` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `date_db` datetime DEFAULT CURRENT_TIMESTAMP,
  `count` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `trophies`
--

INSERT INTO `trophies` (`id`, `user_id`, `date_db`, `count`) VALUES
(8, 1, '2022-10-16 20:27:27', 123),
(9, 1, '2022-10-16 20:28:36', 240),
(10, 1, '2022-10-16 20:29:06', 123),
(12, 1, '2022-10-16 20:29:29', 123),
(13, 1, '2022-10-16 20:35:05', 240),
(14, 1, '2022-10-16 20:35:19', 240),
(15, 1, '2022-10-16 20:37:25', 240),
(16, 1, '2022-10-16 20:39:00', 240),
(17, 1, '2022-10-16 20:50:24', 240);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'aleksey', '12345'),
(3, 'Шухрат', 'root'),
(5, 'shuhrat', '123456789'),
(6, ':name', ':password'),
(7, 'huan', '12345'),
(8, 'inde', 'html'),
(9, 'html', '12345');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `trophies`
--
ALTER TABLE `trophies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `trophies`
--
ALTER TABLE `trophies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `trophies`
--
ALTER TABLE `trophies`
  ADD CONSTRAINT `trophies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
