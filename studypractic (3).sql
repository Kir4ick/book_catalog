-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Ноя 21 2021 г., 22:38
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `studypractic`
--

-- --------------------------------------------------------

--
-- Структура таблицы `autors`
--

CREATE TABLE `autors` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `autors`
--

INSERT INTO `autors` (`id`, `name`) VALUES
(1, 'Пушкин'),
(2, 'Гоголь'),
(4, 'Достоевский'),
(5, 'Тютчев'),
(6, 'Грибоедов');

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id_autors` int NOT NULL,
  `id_book` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id_autors`, `id_book`) VALUES
(1, 1),
(4, 2),
(4, 3),
(2, 4),
(5, 4),
(6, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `name_book` varchar(255) NOT NULL,
  `illustration` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `year` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name_book`, `illustration`, `description`, `year`) VALUES
(1, 'Руслан и Людмила', 'illustrations_book/1637251174cover.jpg', 'Что то про Руслана и Людмилу', '2021-11-02'),
(2, 'Идиот', 'illustrations_book/1637427803cover1__w600.jpg', 'Идио́т» — роман Фёдора Михайловича Достоевского, впервые опубликованный в номерах журнала «Русский вестник» за 1868 год. Являлся одним из самых любимых произведений писателя, наиболее полно выразившим и нравственно-философскую позицию Достоевского, и его художественные принципы в 1860-х годах.', '1860-06-20'),
(3, 'Преступление и не наказание', 'illustrations_book/1637427880570a590b9aa16a378473_400x.jpg', '«Преступлениеинаказание»—социально-психологическийисоциально-философскийроманФёдораМихайловичаДостоевского,надкоторымписательработалв1865—1866годах.Впервыеопубликованв1866годувжурнале«Русскийвестник».', '1866-06-20'),
(4, 'Мёртвые души', 'illustrations_book/1637432615137624-nikolay-gogol-mertvye-dushi.jpg', '«Мёртвые ду́ши» — произведение Николая Васильевича Гоголя, жанр которого сам автор обозначил как поэма. Изначально задумано как трёхтомник. Первый том был издан в 1842 году. Практически готовый второй том был утерян, но сохранилось несколько глав в черновиках.', '2021-11-04'),
(5, 'Горе от ума', 'illustrations_book/1637432690i360275.jpg', '«Го́ре от ума́» — комедия в стихах Александра Сергеевича Грибоедова. Она сочетает в себе элементы классицизма и новых для начала XIX века романтизма и реализма. Она описывает светское общество времён крепостного права и показывает жизнь 1808 — 1824 годов.', '2021-11-02');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_book` int NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `groups` int NOT NULL,
  `date_registration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `password`, `groups`, `date_registration`) VALUES
(1, 'Kir4ick@mail.ru', 'Kir4ick', '8a55a76e757424f05997a8900fa12940', 2, '2021-11-18 17:58:04'),
(2, 'ulia23-30@mail.ru', 'Kir4ick', 'b7214584999c5ac7e3cf97da0b709037', 1, '2021-11-18 18:20:21'),
(3, 'test@mail.ru', 'user', 'b7214584999c5ac7e3cf97da0b709037', 1, '2021-11-18 18:20:44'),
(4, 'ulia23-30@mail.ru', 'Sergey', '02c425157ecd32f259548b33402ff6d3', 1, '2021-11-21 22:15:39');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `autors`
--
ALTER TABLE `autors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD KEY `book_ibfk_1` (`id_autors`),
  ADD KEY `book_ibfk_2` (`id_book`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_ibfk_1` (`id_book`),
  ADD KEY `comments_ibfk_2` (`id_user`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `autors`
--
ALTER TABLE `autors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`id_autors`) REFERENCES `autors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
