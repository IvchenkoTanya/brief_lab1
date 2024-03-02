-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 02 2024 г., 14:35
-- Версия сервера: 10.5.20-MariaDB
-- Версия PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `id21929239_brief`
--

-- --------------------------------------------------------

--
-- Структура таблицы `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `position` varchar(150) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `contact_time` text DEFAULT NULL,
  `contact_method` text DEFAULT NULL,
  `communication_format` text DEFAULT NULL,
  `additional_name` text DEFAULT NULL,
  `additional_email` text DEFAULT NULL,
  `additional_phone` text DEFAULT NULL,
  `additional_comments` text DEFAULT NULL,
  `company_name` text DEFAULT NULL,
  `company_description` text DEFAULT NULL,
  `unique_differentiators` text DEFAULT NULL,
  `key_values` text DEFAULT NULL,
  `customer_interests` text DEFAULT NULL,
  `other_classification` text DEFAULT NULL,
  `classification` text DEFAULT NULL,
  `website_description` text DEFAULT NULL,
  `website_comments` text DEFAULT NULL,
  `target_audience` text DEFAULT NULL,
  `how_users_find_you` text DEFAULT NULL,
  `website_problem` text DEFAULT NULL,
  `next_step` text DEFAULT NULL,
  `website_type` text DEFAULT NULL,
  `design_style` text DEFAULT NULL,
  `other_design_style` text DEFAULT NULL,
  `color_scheme` text DEFAULT NULL,
  `other_color_scheme` text DEFAULT NULL,
  `logo_branding` text DEFAULT NULL,
  `design_description` text DEFAULT NULL,
  `undesired_elements` text DEFAULT NULL,
  `site_sections` text DEFAULT NULL,
  `other_site_sections` text DEFAULT NULL,
  `user_interaction` text DEFAULT NULL,
  `structure_navigation` text DEFAULT NULL,
  `undesired_structure` text DEFAULT NULL,
  `content_type` text DEFAULT NULL,
  `other_content_types` text DEFAULT NULL,
  `existing_content` text DEFAULT NULL,
  `languages` text DEFAULT NULL,
  `content_assistance` text DEFAULT NULL,
  `site_maintenance` text DEFAULT NULL,
  `visitation_frequency` text DEFAULT NULL,
  `additional_features` text DEFAULT NULL,
  `company1_name` text DEFAULT NULL,
  `company1_url` text DEFAULT NULL,
  `company1_strengths_weaknesses` text DEFAULT NULL,
  `company2_name` text DEFAULT NULL,
  `company2_url` text DEFAULT NULL,
  `company2_strengths_weaknesses` text DEFAULT NULL,
  `borrow_avoid` text DEFAULT NULL,
  `market_research` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `host` text DEFAULT NULL,
  `work_process` text DEFAULT NULL,
  `last_comment` text DEFAULT NULL,
  `promotion` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `deadline` text DEFAULT NULL,
  `next_location` text DEFAULT NULL,
  `key_words` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `info`
--

INSERT INTO `info` (`id`, `username`, `position`, `email`, `phone`, `contact_time`, `contact_method`, `communication_format`, `additional_name`, `additional_email`, `additional_phone`, `additional_comments`, `company_name`, `company_description`, `unique_differentiators`, `key_values`, `customer_interests`, `other_classification`, `classification`, `website_description`, `website_comments`, `target_audience`, `how_users_find_you`, `website_problem`, `next_step`, `website_type`, `design_style`, `other_design_style`, `color_scheme`, `other_color_scheme`, `logo_branding`, `design_description`, `undesired_elements`, `site_sections`, `other_site_sections`, `user_interaction`, `structure_navigation`, `undesired_structure`, `content_type`, `other_content_types`, `existing_content`, `languages`, `content_assistance`, `site_maintenance`, `visitation_frequency`, `additional_features`, `company1_name`, `company1_url`, `company1_strengths_weaknesses`, `company2_name`, `company2_url`, `company2_strengths_weaknesses`, `borrow_avoid`, `market_research`, `date`, `host`, `work_process`, `last_comment`, `promotion`, `price`, `deadline`, `next_location`, `key_words`) VALUES
(31, 'Івченко Тетяна', '', 'ipz201_itv@student.ztu.edu.ua', '+380981111111', 'Після обіду', 'Email', 'Офлайн', '', '', '', '', 'Здорове Харчування Plus', 'Ми пропонуємо широкий вибір можливостей для створення індивідуальних програм здорового харчування.', 'Наша компанія надає якісні послуги з розрахунку добових норм вживання калорій і пропонує консультації з професійними дієтологами.', 'Здорове харчування, якість продукції, індивідуальний підхід.', 'Можливість створення власної програми здорового харчування за особистими вподобаннями.', '', 'Повсякденного попиту', '', '', 'Жінки та чоловіки, 18-60, активні люди, які цінують здоровий спосіб життя, піклуються про власне здоров\'я', 'Через рекламу в медіа, соціальних мережах, рекомендації від клієнтів', 'Надати зручний інструмент для створення індивідуальних програм харчування', 'Я хочу сайт з нуля', 'Я не можу визначитись', 'Мінімалістичний, Organic & Natural(використання різних «природних» текстур)', '+380981111111', 'Зелений', 'Пастельні та природні відтінки', 'Бажаю розробити', 'Без анімацій, легкий для сприйняття', 'Перевантажений і заплутаний дизайн', 'Домашня сторінка, Про нас, Послуги, Контакти, Панель адміністратора, FAQ (Часті питання), Панель користувача, Підтримка клієнтів', '', '', 'Проста та зрозуміла структура з інтуїтивними розділами', ' Складні та заплутані меню', 'Статті, Фотографії, Відео, Продукти/Послуги, Коментарі', '', 'Так', 'Українська, англійська', 'Так', 'Потрібно уточнити', 'Щоденно', 'Чат, Оплата на сайті, Реєстрація та різні ролі користувачів, Пошук і фільтри, Розсилка новин', 'Healthy Eating Solutions', 'healthyeatingsolutions.com', 'Високі ціни, обмежений вибір функцій', 'FitFoods', 'fitfoods.com', 'Широкий вибір програм, але менше уваги до індивідуальних потреб', 'Більше уваги до індивідуальних потреб клієнтів, уникати високих цін', 'Так', '2024-03-02 14:03:56', 'Так', 'Хочу бачити ключові моменти', 'Бажаємо, щоб сайт був легким у використанні та мав привабливий дизайн', 'Так', '5000', '4', 'Міжнародно', 'Здорове харчування, дієтологія, програма харчування.');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$pcJE9cJ.IfarP7nOl24yWu4Jk97nVUNK5QtfYkiwkfdWYSmb3yJny');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
