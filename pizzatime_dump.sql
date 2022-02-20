-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 20 2022 г., 23:07
-- Версия сервера: 8.0.28
-- Версия PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pizzatime`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bkvwbc_pizza`
--

CREATE TABLE `bkvwbc_pizza` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bkvwbc_pizza`
--

INSERT INTO `bkvwbc_pizza` (`id`, `name`) VALUES
(1, 'Пепперони'),
(2, 'Деревенская'),
(3, 'Гавайская'),
(4, 'Грибная');

-- --------------------------------------------------------

--
-- Структура таблицы `bkvwbc_price`
--

CREATE TABLE `bkvwbc_price` (
  `id` int NOT NULL,
  `pizza_id` int NOT NULL,
  `size_id` int NOT NULL,
  `price_usd` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bkvwbc_price`
--

INSERT INTO `bkvwbc_price` (`id`, `pizza_id`, `size_id`, `price_usd`) VALUES
(1, 1, 1, 16.22),
(2, 1, 2, 17.29),
(3, 1, 3, 18.45),
(4, 1, 4, 19.99),
(5, 2, 1, 16.45),
(6, 2, 2, 17.56),
(7, 2, 3, 19.58),
(8, 2, 4, 20.32),
(9, 3, 1, 18.91),
(10, 3, 2, 20.99),
(11, 3, 3, 22.45),
(12, 3, 4, 24.84),
(13, 4, 1, 20.47),
(14, 4, 2, 22.49),
(15, 4, 3, 24.54),
(16, 4, 4, 26.89);

-- --------------------------------------------------------

--
-- Структура таблицы `bkvwbc_sauce`
--

CREATE TABLE `bkvwbc_sauce` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_usd` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bkvwbc_sauce`
--

INSERT INTO `bkvwbc_sauce` (`id`, `name`, `price_usd`) VALUES
(1, 'сырный', 0.44),
(2, 'кисло-сладкий', 0.52),
(3, 'чесночный', 0.55),
(4, 'барбекю', 0.66);

-- --------------------------------------------------------

--
-- Структура таблицы `bkvwbc_size`
--

CREATE TABLE `bkvwbc_size` (
  `id` int NOT NULL,
  `size` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bkvwbc_size`
--

INSERT INTO `bkvwbc_size` (`id`, `size`) VALUES
(1, 21),
(2, 26),
(3, 31),
(4, 45);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bkvwbc_pizza`
--
ALTER TABLE `bkvwbc_pizza`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bkvwbc_price`
--
ALTER TABLE `bkvwbc_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `size_id` (`size_id`),
  ADD KEY `name_id` (`pizza_id`);

--
-- Индексы таблицы `bkvwbc_sauce`
--
ALTER TABLE `bkvwbc_sauce`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bkvwbc_size`
--
ALTER TABLE `bkvwbc_size`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bkvwbc_pizza`
--
ALTER TABLE `bkvwbc_pizza`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `bkvwbc_price`
--
ALTER TABLE `bkvwbc_price`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `bkvwbc_sauce`
--
ALTER TABLE `bkvwbc_sauce`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `bkvwbc_size`
--
ALTER TABLE `bkvwbc_size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bkvwbc_price`
--
ALTER TABLE `bkvwbc_price`
  ADD CONSTRAINT `bkvWbc_price_ibfk_1` FOREIGN KEY (`size_id`) REFERENCES `bkvwbc_size` (`id`),
  ADD CONSTRAINT `bkvWbc_price_ibfk_2` FOREIGN KEY (`pizza_id`) REFERENCES `bkvwbc_pizza` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
