-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Paź 2021, 21:39
-- Wersja serwera: 10.4.13-MariaDB
-- Wersja PHP: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mircel`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `about`
--

CREATE TABLE `about` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_alt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `about`
--

INSERT INTO `about` (`id`, `title`, `short_description`, `photo`, `photo_alt`, `button_name`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Firma Mircel oferuje<br>{kompleksowe rozwiązania}', '<p>Działamy kompleksowo w zakresie montażu, serwisowaniu i modernizowaniu instalacji elektrycznych!</p>', '2021-10-24/about_1635075788.jpg', NULL, 'Zadzwoń teraz', '+48 791 333 999', NULL, '2021-10-24 13:12:13');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ig` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tw` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `contact`
--

INSERT INTO `contact` (`id`, `title`, `email_1`, `email_2`, `phone_1`, `phone_2`, `zip_code`, `city`, `address`, `name`, `fb`, `ig`, `yt`, `tw`, `map`, `created_at`, `updated_at`) VALUES
(1, '', 'a.chamiolo@mircel.pl', '', '+48 791 333 999', '', '59-500', 'Złotoryja', 'Gierałtowiec 17', '', '', '', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gallery`
--

CREATE TABLE `gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_alt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `table_name`, `photo_id`, `created_at`, `updated_at`, `item_id`, `path`, `photo_alt`) VALUES
(1, NULL, 'realizations', NULL, '2021-10-24 11:46:25', '2021-10-24 12:14:18', 1, '2021-10-16/slide_1634376771.jpg', 'Instalacja elektryczna'),
(2, NULL, 'realizations', NULL, '2021-10-24 11:46:25', '2021-10-24 12:14:18', 1, '2021-10-21/services-banner_1634836054.jpg', 'Instalacja fotowoltaiczna'),
(3, NULL, 'realizations', NULL, '2021-10-24 11:46:26', '2021-10-24 12:14:18', 1, '2021-10-21/an-electrical-technician-working-in-a-switchboard-with-fuses_1634836192.jpg', 'Eksploatacja instalacji elektrycznej'),
(4, NULL, 'realizations', NULL, '2021-10-24 11:46:26', '2021-10-24 12:14:19', 1, '2021-10-21/service-4_1634845224.jpg', 'Pomiary elektryczne Wrocław'),
(5, NULL, 'realizations', NULL, '2021-10-24 11:46:26', '2021-10-24 12:14:19', 1, '2021-10-24/about_1635075788.jpg', 'Pomiary elektryczne Łódź'),
(6, NULL, 'realizations', NULL, '2021-10-24 11:46:27', '2021-10-24 12:14:19', 1, '2021-10-24/service-1_1635075791.jpg', 'Montaż instalacji elektrycznej domowej'),
(7, NULL, 'realizations', NULL, '2021-10-24 11:46:27', '2021-10-24 12:14:20', 1, '2021-10-24/call-us_1635075792.jpg', 'Konsultacje'),
(9, NULL, 'realizations', NULL, '2021-10-24 11:49:00', '2021-10-24 12:14:20', 1, '2021-10-24/an-electrical-technician-working-in-a-switchboard-with-fuses_1635075795.jpg', 'Konserwacja instalacji elektrycznych'),
(10, NULL, 'services', NULL, '2021-10-24 19:14:49', '2021-10-24 19:14:49', 1, '2021-10-16/slide_1634376771.jpg', NULL),
(11, NULL, 'services', NULL, '2021-10-24 19:14:50', '2021-10-24 19:14:50', 1, '2021-10-21/an-electrical-technician-working-in-a-switchboard-with-fuses_1634836192.jpg', NULL),
(12, NULL, 'services', NULL, '2021-10-24 19:14:50', '2021-10-24 19:14:50', 1, '2021-10-21/service-4_1634845224.jpg', NULL),
(13, NULL, 'services', NULL, '2021-10-24 19:18:42', '2021-10-24 19:18:42', 1, '2021-10-24/service-3_1635099261.jpg', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `media`
--

INSERT INTO `media` (`id`, `type`, `name`, `path`, `size`, `created_at`, `updated_at`) VALUES
(1, 'image/jpeg', 'slide', '2021-10-16/slide_1634376771.jpg', 141404, '2021-10-16 09:32:51', '2021-10-16 09:32:51'),
(3, 'image/jpeg', 'services-banner', '2021-10-21/services-banner_1634836054.jpg', 519688, '2021-10-21 17:07:35', '2021-10-21 17:07:35'),
(4, 'image/jpeg', 'an-electrical-technician-working-in-a-switchboard-with-fuses', '2021-10-21/an-electrical-technician-working-in-a-switchboard-with-fuses_1634836192.jpg', 537752, '2021-10-21 17:09:53', '2021-10-21 17:09:53'),
(5, 'image/jpeg', 'service-4', '2021-10-21/service-4_1634845224.jpg', 351135, '2021-10-21 19:40:25', '2021-10-21 19:40:25'),
(6, 'image/jpeg', 'about', '2021-10-24/about_1635075788.jpg', 289745, '2021-10-24 11:43:10', '2021-10-24 11:43:10'),
(7, 'image/jpeg', 'service-1', '2021-10-24/service-1_1635075791.jpg', 81294, '2021-10-24 11:43:11', '2021-10-24 11:43:11'),
(8, 'image/jpeg', 'call-us', '2021-10-24/call-us_1635075792.jpg', 450971, '2021-10-24 11:43:14', '2021-10-24 11:43:14'),
(9, 'image/jpeg', 'an-electrical-technician-working-in-a-switchboard-with-fuses', '2021-10-24/an-electrical-technician-working-in-a-switchboard-with-fuses_1635075795.jpg', 537752, '2021-10-24 11:43:17', '2021-10-24 11:43:17'),
(10, 'image/png', 'logo', '2021-10-24/logo_1635078266.png', 23124, '2021-10-24 12:24:26', '2021-10-24 12:24:26'),
(11, 'image/jpeg', 'service-2', '2021-10-24/service-2_1635099260.jpg', 302790, '2021-10-24 18:14:21', '2021-10-24 18:14:21'),
(12, 'image/jpeg', 'service-3', '2021-10-24/service-3_1635099261.jpg', 322655, '2021-10-24 18:14:22', '2021-10-24 18:14:22'),
(13, 'image/jpeg', 'service-4', '2021-10-24/service-4_1635099263.jpg', 351135, '2021-10-24 18:14:23', '2021-10-24 18:14:23');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_05_23_104037_create_contact_table', 1),
(10, '2020_05_23_104119_create_gallery_table', 1),
(11, '2020_05_23_104552_create_settings_table', 1),
(12, '2020_05_23_104731_create_subpages_table', 1),
(13, '2020_07_08_154907_create_media_table', 1),
(14, '2021_09_26_152721_create_snackbar_alerts_table', 1),
(15, '2021_09_26_164037_create_validation_rules_table', 1),
(17, '2021_10_16_103701_create_slider_table', 2),
(18, '2021_10_16_112506_add_active_to_slider', 3),
(19, '2021_10_24_144330_create_about_table', 4),
(20, '2021_10_24_153151_create_services_table', 5),
(21, '2021_10_24_155233_create_service_categories_table', 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0b4126d2c844d0257c4edf903e793ab384b92b32f94388c9d81fd4cec9ce618047bc6bf67f4672be', 1, 1, 'authToken', '[]', 0, '2021-10-16 07:29:58', '2021-10-16 07:29:58', '2022-10-16 09:29:58'),
('4b4abd82eb930447160c7dab7bb72b0f3ed3ffdfe69736b7b04102fbd11fd3861a9a5dd3a092cb7b', 1, 1, 'authToken', '[]', 0, '2021-10-24 11:25:27', '2021-10-24 11:25:27', '2022-10-24 13:25:27'),
('9e31a08060905ec8bb39888622678717c21d7ca9eff1aee502feda35b9798bbf21aab88739d568a0', 1, 1, 'authToken', '[]', 0, '2021-10-24 11:22:27', '2021-10-24 11:22:27', '2022-10-24 13:22:27');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Mircel Personal Access Client', '9on1C745rNA3MhyHAPDykgHQ0TBAh0MTNNcwIoRz', 'http://localhost', 1, 0, 0, '2021-10-16 07:29:34', '2021-10-16 07:29:34'),
(2, NULL, 'Mircel Password Grant Client', 'a5TrZToHD2NwNXZ517pAPT2xS4DGQQXMvBzE17ZB', 'http://localhost', 0, 1, 0, '2021-10-16 07:29:34', '2021-10-16 07:29:34');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-10-16 07:29:34', '2021-10-16 07:29:34');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_alt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home_page` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `services`
--

INSERT INTO `services` (`id`, `title`, `short_description`, `description`, `photo`, `photo_alt`, `created_at`, `updated_at`, `home_page`) VALUES
(1, 'Pomiary elektryczne', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur eligendi nesciunt qui beatae eveniet ex suscipit molestiae dolor, itaque excepturi nobis temporibus deleniti deserunt optio obcaecati corporis labore eum porro!</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur eligendi nesciunt qui beatae eveniet ex suscipit molestiae dolor, itaque excepturi nobis temporibus deleniti deserunt optio obcaecati corporis labore eum porro!</p>', '<h2><strong>Lorem ipsum</strong></h2><blockquote>Lorem ipsum dolor sit amet consectetur adipisicing elit.</blockquote><p><br></p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur eligendi nesciunt qui beatae eveniet ex suscipit molestiae dolor, itaque excepturi nobis temporibus deleniti deserunt optio obcaecati corporis labore eum porro!&nbsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur eligendi nesciunt qui beatae eveniet ex suscipit molestiae dolor, itaque excepturi nobis temporibus deleniti deserunt optio obcaecati corporis labore eum porro!</p><p><br></p><ol><li>Lorem</li><li>Ipsum</li><li>Dolor</li><li>Sit</li><li>Amet</li></ol><p><br></p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur eligendi nesciunt qui beatae eveniet ex suscipit molestiae dolor, itaque excepturi nobis temporibus deleniti deserunt optio obcaecati corporis labore eum porro!</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur eligendi nesciunt qui beatae eveniet ex suscipit molestiae dolor, itaque excepturi nobis temporibus deleniti deserunt optio obcaecati corporis labore eum porro!</p>', '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 12:57:31', '2021-10-24 19:04:29', 0),
(2, 'Montaż od podstaw instalacji elektrycznych', '<p>Montaż instalacji elektrycznych opartych o najnowocześniejsze rozwiązania.</p>', NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 13:56:13', '2021-10-24 14:06:19', 1),
(3, 'Profesjonalny i trwały montaż tras kablowych', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 17:56:28', '2021-10-24 17:56:28', NULL),
(4, 'Montaż oświetlenia podstawowego i awaryjnego', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 17:56:39', '2021-10-24 17:56:39', NULL),
(5, 'Układanie zasilań', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 17:56:57', '2021-10-24 17:56:57', NULL),
(6, 'Podpinanie szaf, urządzeń i maszyn', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 17:57:12', '2021-10-24 17:57:12', NULL),
(7, 'Montaż szynoprzewodów', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 17:57:25', '2021-10-24 17:57:25', NULL),
(8, 'Montaż uziomów i instalacji odgromowych', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 17:57:38', '2021-10-24 17:57:38', NULL),
(9, 'Konserwacja i stała obsługa zakładów', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 17:57:50', '2021-10-24 17:57:50', NULL),
(10, 'Montaż oświetlenia ulicznego', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 17:58:04', '2021-10-24 17:58:04', NULL),
(11, 'Montaż instalacji fotowoltaicznych', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 17:58:16', '2021-10-24 17:58:16', NULL),
(12, 'Wykonywanie instalacji przeciwpożarowych', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 17:58:28', '2021-10-24 17:58:28', NULL),
(13, 'Wykonywanie instalacji alarmowych, dostępu', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 17:58:40', '2021-10-24 17:58:40', NULL),
(14, 'Zasilanie budynków', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 18:01:09', '2021-10-24 18:01:09', NULL),
(15, 'Montaż instalacji elektrycznej', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 18:02:11', '2021-10-24 18:02:11', NULL),
(16, 'Skrzynki i tablice bezpiecznikowe', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 18:02:25', '2021-10-24 18:02:25', NULL),
(17, 'Montaż oświetlenia', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 18:02:47', '2021-10-24 18:02:47', NULL),
(18, 'Montaż oświetlenia w ogrodach', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 18:03:05', '2021-10-24 18:03:05', NULL),
(19, 'Instalacje odgromowe', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 18:03:20', '2021-10-24 18:03:20', NULL),
(20, 'Wykonywanie instalacji uziemiających', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 18:03:34', '2021-10-24 18:03:34', NULL),
(21, 'Usuwanie awarii elektrycznych', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 18:03:57', '2021-10-24 18:03:57', NULL),
(22, 'Konserwacja instalacji elektrycznych', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 18:04:14', '2021-10-24 18:04:14', NULL),
(23, 'Montaż instalacji alarmowych', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 18:04:29', '2021-10-24 18:04:29', NULL),
(24, 'Montaż systemu monitoringu', NULL, NULL, '2021-10-24/service-1_1635075791.jpg', NULL, '2021-10-24 18:04:45', '2021-10-24 18:04:45', NULL),
(25, 'Modernizacja instalacji elektrycznych', '<p>Modernizujemy istniejące już instalacje elektryczne</p>', NULL, '2021-10-24/service-2_1635099260.jpg', NULL, '2021-10-24 16:14:37', '2021-10-24 16:14:37', 1),
(26, 'Naprawa instalacji elektrycznych', '<p>Diagnozujemy i serwisujemy (również domowe) instalacje elektryczne</p>', NULL, '2021-10-24/service-3_1635099261.jpg', NULL, '2021-10-24 16:15:17', '2021-10-24 16:15:17', 1),
(27, 'Testy instalacji elektrycznych', '<p>Wykonujemy profesjonalne testy instalacji elektrycznych</p>', NULL, '2021-10-24/service-4_1635099263.jpg', NULL, '2021-10-24 18:19:39', '2021-10-24 18:19:39', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `services_service_categories`
--

CREATE TABLE `services_service_categories` (
  `id` int(11) NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `services_service_categories`
--

INSERT INTO `services_service_categories` (`id`, `service_id`, `service_category_id`, `created_at`, `updated_at`) VALUES
(6, 2, 1, '2021-10-24 17:56:13', '2021-10-24 17:56:13'),
(7, 3, 1, '2021-10-24 17:56:28', '2021-10-24 17:56:28'),
(8, 4, 1, '2021-10-24 17:56:39', '2021-10-24 17:56:39'),
(9, 5, 1, '2021-10-24 17:56:57', '2021-10-24 17:56:57'),
(10, 6, 1, '2021-10-24 17:57:12', '2021-10-24 17:57:12'),
(11, 7, 1, '2021-10-24 17:57:25', '2021-10-24 17:57:25'),
(12, 8, 1, '2021-10-24 17:57:38', '2021-10-24 17:57:38'),
(13, 9, 1, '2021-10-24 17:57:50', '2021-10-24 17:57:50'),
(14, 10, 1, '2021-10-24 17:58:04', '2021-10-24 17:58:04'),
(15, 11, 1, '2021-10-24 17:58:16', '2021-10-24 17:58:16'),
(16, 12, 1, '2021-10-24 17:58:28', '2021-10-24 17:58:28'),
(17, 13, 1, '2021-10-24 17:58:40', '2021-10-24 17:58:40'),
(18, 1, 1, '2021-10-24 17:59:40', '2021-10-24 17:59:40'),
(19, 1, 2, '2021-10-24 17:59:40', '2021-10-24 17:59:40'),
(20, 14, 2, '2021-10-24 18:01:30', '2021-10-24 18:01:30'),
(21, 15, 2, '2021-10-24 18:02:11', '2021-10-24 18:02:11'),
(22, 16, 2, '2021-10-24 18:02:26', '2021-10-24 18:02:26'),
(23, 17, 2, '2021-10-24 18:02:47', '2021-10-24 18:02:47'),
(24, 18, 2, '2021-10-24 18:03:05', '2021-10-24 18:03:05'),
(25, 19, 2, '2021-10-24 18:03:20', '2021-10-24 18:03:20'),
(26, 20, 2, '2021-10-24 18:03:34', '2021-10-24 18:03:34'),
(27, 21, 2, '2021-10-24 18:03:57', '2021-10-24 18:03:57'),
(28, 22, 2, '2021-10-24 18:04:15', '2021-10-24 18:04:15'),
(29, 23, 2, '2021-10-24 18:04:29', '2021-10-24 18:04:29'),
(30, 24, 2, '2021-10-24 18:04:45', '2021-10-24 18:04:45'),
(31, 11, 2, '2021-10-24 18:05:03', '2021-10-24 18:05:03'),
(32, 25, 2, '2021-10-24 18:14:37', '2021-10-24 18:14:37'),
(33, 26, 2, '2021-10-24 18:15:17', '2021-10-24 18:15:17'),
(34, 26, 1, '2021-10-24 18:15:17', '2021-10-24 18:15:17'),
(35, 27, 1, '2021-10-24 18:19:39', '2021-10-24 18:19:39'),
(36, 27, 2, '2021-10-24 18:19:39', '2021-10-24 18:19:39');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `service_categories`
--

INSERT INTO `service_categories` (`id`, `title`, `created_at`, `updated_at`, `description`) VALUES
(1, 'Usługi<br>{dla firm}', '2021-10-24 14:02:47', '2021-10-24 18:54:35', '<p>Wszystkie prace wykonujemy starannie, ponieważ kładziemy duży nacisk na estetykę</p>'),
(2, 'Oferta dla<br>{klientów indywidualnych}', '2021-10-24 14:04:56', '2021-10-24 18:57:51', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rodo_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rodo_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privace_policy` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_alt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cookies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cookies_button` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cookies_privace_button` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `settings`
--

INSERT INTO `settings` (`id`, `title`, `company`, `rodo_1`, `rodo_2`, `privace_policy`, `photo`, `photo_alt`, `description`, `cookies`, `cookies_button`, `cookies_privace_button`, `created_at`, `updated_at`) VALUES
(1, 'Ustawienia', 'Mircel Elektroinstalacje', '„Wyrażam zgodę na przetwarzanie danych osobowych podanych w formularzu. Podanie danych jest dobrowolne. Administratorem podanych przez Pana/ Panią danych osobowych jest {NAZWA_FIRMY} z siedzibą o adresie {ADRES_FIRMY}. Pana/Pani dane będą przetwarzane w celach związanych z udzieleniem odpowiedzi, przedstawieniem oferty usług {NAZWA_FIRMY} oraz świadczeniem usług przez administratora danych. Przysługuje Panu/Pani prawo dostępu do treści swoich danych oraz ich poprawiania.”', '„Wyrażam zgodę na otrzymywanie informacji handlowych od {NAZWA_FIRMY} dotyczących jej oferty w szczególności poprzez połączenia telefoniczne lub sms z wykorzystaniem numeru telefonu podanego w formularzu, a także zgodę na przetwarzanie moich danych osobowych w tym celu przez {NAZWA_FIRMY} oraz w celach promocji, reklamy i badania rynku.”', NULL, '2021-10-24/logo_1635078266.png', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sollicitudin rhoncus ante eget iaculis. Integer placerat sed dolor quis pharetra.</p>', 'Ta strona używa plików cookie w celach statystycznych oraz marketingowych. Możesz zablokować zapisywanie plików cookie na swoim dysku twardym zmieniając ustawienia swojej przeglądarki internetowej. Kontynuując korzystanie z tej strony bez zablokowania plików cookie zgadzasz się na ich zapisywanie na swoim dysku twardym. Dowiedz się więcej w naszej', 'OK', 'Polityce Prywatności.', NULL, '2021-10-24 12:25:34');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `slider`
--

CREATE TABLE `slider` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_name_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_name_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_alt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `slider`
--

INSERT INTO `slider` (`id`, `title`, `subtitle`, `button_name_1`, `button_link_1`, `button_name_2`, `button_link_2`, `photo`, `photo_alt`, `created_at`, `updated_at`, `active`) VALUES
(1, 'Montujemy instalacje elektryczne', 'Dla Twojego domu lub firmy', 'Skontaktuj się', '/kontakt', 'Realizacje', '/realizacje', '2021-10-16/slide_1634376771.jpg', NULL, '2021-10-15 20:56:39', '2021-10-16 05:32:59', 1),
(4, 'Montujemy instalacje elektryczne', 'Dla Twojego domu lub firmy', 'Skontaktuj się', '/kontakt', 'Realizacje', '/realizacje', '2021-10-16/slide_1634376771.jpg', NULL, '2021-10-15 08:56:39', '2021-10-15 17:33:29', 1),
(5, 'Montujemy instalacje elektryczne', 'Dla Twojego domu lub firmy', 'Skontaktuj się', '/kontakt', 'Realizacje', '/realizacje', '2021-10-16/slide_1634376771.jpg', NULL, '2021-10-13 16:56:39', '2021-10-14 01:33:38', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `snackbar_alerts`
--

CREATE TABLE `snackbar_alerts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachments_error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recaptcha_error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_require` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservation_to_accept` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_to_cart` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_items_error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_account_success` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_from_cart_question` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_success` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_success` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_success` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validate` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `non_activated_account` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked_user` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_exist` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_success` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated_account_success` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_does_not_exist` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reminder_success` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `change_password_success` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lucky_number` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `snackbar_alerts`
--

INSERT INTO `snackbar_alerts` (`id`, `error`, `delete_comment`, `add_comment`, `mail_error`, `attachments_error`, `recaptcha_error`, `login_require`, `reservation_to_accept`, `add_to_cart`, `shop_items_error`, `photo_error`, `edit_account_success`, `delete_from_cart_question`, `order_success`, `login_success`, `register_success`, `validate`, `non_activated_account`, `blocked_user`, `user_exist`, `mail_success`, `title`, `activated_account_success`, `user_does_not_exist`, `password_reminder_success`, `password_error`, `change_password_success`, `lucky_number`, `created_at`, `updated_at`) VALUES
(1, 'Błąd serwera, przepraszamy...', 'Pomyślnie usunięto komentarz!', 'Pomyślnie dodano komentarz!', 'Przepraszamy, nie udało się wysłać maila...', 'Przepraszamy, nie udało się wysłać załączników...', 'System twierdzi, że jesteś robotem...', 'Musisz się zalogować!', 'Twoja rezerwacja czeka na akceptację!', 'Pomyślnie dodano do koszyka!', 'Nie udało się załadować wariantów...', 'Przepraszamy, nie udało się dodać zdjęcia...', 'Pomyślnie edytowano użytkownika!', 'Czy na pewno usunąć z koszyka przedmiot:', 'Pomyślnie złożono zamówienie!', 'Pomyślnie zalogowano!', 'Pomyślnie zarejestrowano! Wysłano link aktywacyjny!', 'Niepoprawne dane!', 'Proszę aktywować konto!', 'Przepraszamy, Twoje konto zostało zablokowane!', 'Taki użytkownik już istnieje!', 'Pomyślnie wysłano wiadomość!', 'Komunikaty', 'Pomyślnie aktywowano konto!', 'Użytkownik nie istnieje!', 'Pomyślnie wysłano nowe hasło!', 'Hasło nieprawidłowe!', 'Pomyślnie zmieniono hasło!', 'Wylosowano szczęśliwca o identyfikatorze {id}', NULL, '2021-03-27 15:53:43');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subpages`
--

CREATE TABLE `subpages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_alt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `subpages`
--

INSERT INTO `subpages` (`id`, `meta_description`, `active`, `title`, `page`, `photo`, `photo_alt`, `created_at`, `updated_at`) VALUES
(1, '<ul><li>dupa</li><li>dupa</li><li>dupa</li></ul>', 1, 'Strona główna', '/', NULL, NULL, NULL, '2021-10-21 17:16:56'),
(2, NULL, 1, 'Usługi', '/uslugi', '2021-10-21/service-4_1634845224.jpg', NULL, NULL, '2021-10-21 19:40:35'),
(3, NULL, 1, 'Realizacje', '/realizacje', '2021-10-21/services-banner_1634836054.jpg', NULL, NULL, '2021-10-24 11:56:06'),
(4, NULL, 1, 'Fotowoltaika', '/fotowoltaika', '2021-10-21/services-banner_1634836054.jpg', NULL, NULL, '2021-10-21 17:10:01'),
(5, NULL, 1, 'Kontakt', '/kontakt', '2021-10-21/services-banner_1634836054.jpg', NULL, NULL, '2021-10-21 17:10:40');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) DEFAULT 0,
  `blocked` tinyint(1) DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `photo`, `active`, `blocked`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Moderator', 'dany97971@gmail.com', '2020-09-27 08:46:39', '$2y$10$6XXh0PLYfKnPpNlUzciOOe7vdnObdN7xGcF8Opc4UqE9h23ndkZO.', 'Moderator', '', 1, 0, 'EfTdygXp8YPcbmUqfAtt3tZ9NCbCaVoqGgst8CLhc7xpPY8TVBH4II79jqNb', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `validation_rules`
--

CREATE TABLE `validation_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `required` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_length` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_confirm` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservation_min_time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservation_exist` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `validation_rules`
--

INSERT INTO `validation_rules` (`id`, `title`, `required`, `email`, `password_length`, `file_size`, `password_confirm`, `reservation_min_time`, `reservation_exist`, `created_at`, `updated_at`) VALUES
(1, 'Opisy', 'To pole jest wymagane!', 'Niepoprawny e-mail.', 'Hasło musi mieć co najmniej 8 liter!', 'Pliki powinny ważyć mniej niż 5 MB!', 'Hasła muszą być takie same!', 'Minimalny czas rezerwacji to 30 minut!', 'Taka rezerwacja już istnieje!', NULL, NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indeksy dla tabeli `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indeksy dla tabeli `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indeksy dla tabeli `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indeksy dla tabeli `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeksy dla tabeli `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `services_service_categories`
--
ALTER TABLE `services_service_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_service_categories_service_id_foreign` (`service_id`),
  ADD KEY `services_service_categories_service_category_id_foreign` (`service_category_id`);

--
-- Indeksy dla tabeli `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `snackbar_alerts`
--
ALTER TABLE `snackbar_alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `subpages`
--
ALTER TABLE `subpages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeksy dla tabeli `validation_rules`
--
ALTER TABLE `validation_rules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `about`
--
ALTER TABLE `about`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `contact`
--
ALTER TABLE `contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `services_service_categories`
--
ALTER TABLE `services_service_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT dla tabeli `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `slider`
--
ALTER TABLE `slider`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `snackbar_alerts`
--
ALTER TABLE `snackbar_alerts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `subpages`
--
ALTER TABLE `subpages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `validation_rules`
--
ALTER TABLE `validation_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `services_service_categories`
--
ALTER TABLE `services_service_categories`
  ADD CONSTRAINT `services_service_categories_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `services_service_categories_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
