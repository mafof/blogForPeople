-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 21 2019 г., 21:06
-- Версия сервера: 5.7.20
-- Версия PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blogForPeople`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments_info`
--

CREATE TABLE `comments_info` (
  `id` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `dateCreate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments_info`
--

INSERT INTO `comments_info` (`id`, `idPost`, `author`, `text`, `dateCreate`) VALUES
(1, 1, 'admin', 'Рабочая система сообщений. Привет чат!', '2019-01-21');

-- --------------------------------------------------------

--
-- Структура таблицы `groups_users_list`
--

CREATE TABLE `groups_users_list` (
  `id` int(11) NOT NULL,
  `unicalId` tinyint(4) NOT NULL,
  `nameGroup` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups_users_list`
--

INSERT INTO `groups_users_list` (`id`, `unicalId`, `nameGroup`) VALUES
(1, 0, 'Администратор'),
(2, 1, 'Пользователь');

-- --------------------------------------------------------

--
-- Структура таблицы `posts_info`
--

CREATE TABLE `posts_info` (
  `id` int(11) NOT NULL,
  `author` text NOT NULL,
  `title` varchar(50) NOT NULL,
  `prevImage` text NOT NULL,
  `prevText` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `categoryName` text NOT NULL,
  `dateCreate` date NOT NULL,
  `isShow` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts_info`
--

INSERT INTO `posts_info` (`id`, `author`, `title`, `prevImage`, `prevText`, `text`, `categoryName`, `dateCreate`, `isShow`) VALUES
(1, 'admin', 'Преимущества данной CMS', '5c4602caac404.jpeg', 'В этом посте будет описаны возможности данной CMS', 'Работа с текстом =><br><b>Жирный шрифт</b><br><s>Зачеркнутый текст</s><br><div class=\"spoiler\">Скрытый текст</div><br><div class=\"spoiler\"><b><s>Смешанный тип</s></b></div><br>Вставка изображений с интернета =><br><img src=\'https://i.imgur.com/kgjjlo6.jpg\'><br>', 'ВозможностиСистемы', '2019-01-21', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `temp_urn_for_accept_account`
--

CREATE TABLE `temp_urn_for_accept_account` (
  `id` int(11) NOT NULL,
  `nickname` text NOT NULL,
  `urn` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users_info`
--

CREATE TABLE `users_info` (
  `id` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userGroup` tinyint(4) NOT NULL,
  `isConfirm` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_info`
--

INSERT INTO `users_info` (`id`, `nickname`, `email`, `password`, `userGroup`, `isConfirm`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$nc8rIsEKdL1sEXEzqAJxyO.rLGhXqlcN2bGnF.afn6/dcOUAws1sK', 0, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments_info`
--
ALTER TABLE `comments_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups_users_list`
--
ALTER TABLE `groups_users_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts_info`
--
ALTER TABLE `posts_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `temp_urn_for_accept_account`
--
ALTER TABLE `temp_urn_for_accept_account`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments_info`
--
ALTER TABLE `comments_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `groups_users_list`
--
ALTER TABLE `groups_users_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `posts_info`
--
ALTER TABLE `posts_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `temp_urn_for_accept_account`
--
ALTER TABLE `temp_urn_for_accept_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
