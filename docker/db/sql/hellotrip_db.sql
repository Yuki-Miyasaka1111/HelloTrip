-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-05-08 06:21:09
-- サーバのバージョン： 10.4.27-MariaDB
-- PHP のバージョン: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `hellotrip_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `description`, `start_date`, `end_date`, `client_id`, `created_at`, `updated_at`) VALUES
(2, '株式会社micadoで登録したホテル', '株式会社micadoで登録したホテル株式会社micadoで登録したホテル株式会社micadoで登録したホテル株式会社micadoで登録したホテル', '2023-03-01 00:00:00', '2023-03-30 00:00:00', 7, '2023-03-29 08:17:06', '2023-03-29 08:39:59'),
(3, 'test3で登録したキャンペーン', 'test3で登録したキャンペーンtest3で登録したキャンペーンtest3で登録したキャンペーンtest3で登録したキャンペーン', '2023-03-15 00:00:00', '2023-03-23 00:00:00', 13, '2023-03-29 09:08:22', '2023-03-29 09:15:04');

-- --------------------------------------------------------

--
-- テーブルの構造 `campaign_hotel`
--

CREATE TABLE `campaign_hotel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `campaign_hotel`
--

INSERT INTO `campaign_hotel` (`id`, `campaign_id`, `hotel_id`, `created_at`, `updated_at`) VALUES
(4, 2, 16, NULL, NULL),
(5, 2, 15, NULL, NULL),
(6, 3, 17, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'リゾート', '2023-03-03 07:07:36', NULL),
(2, 'アート', '2023-03-03 07:07:36', NULL),
(3, '海鮮', '2023-03-03 07:07:36', NULL),
(4, '自然豊か', '2023-03-03 07:07:36', NULL),
(5, 'シティ', '2023-03-03 07:07:36', NULL),
(6, 'ビズネス', '2023-03-03 07:07:36', NULL),
(7, 'ラグジュアリー', '2023-03-03 07:07:36', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `manager_name` varchar(255) NOT NULL,
  `manager_department` varchar(255) NOT NULL,
  `manager_phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `email_verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `clients`
--

INSERT INTO `clients` (`id`, `name`, `manager_name`, `manager_department`, `manager_phone_number`, `email`, `password`, `created_at`, `updated_at`, `remember_token`, `is_active`, `email_verification_token`) VALUES
(4, '株式会社ほげほげ', '田中太郎', '営業部長', '0123456789', 'client01@gmail.com', 'password', '2023-03-09 06:31:42', NULL, NULL, 0, NULL),
(5, '株式会社ほげほげ', '田中花子', '営業部長', '0123456789', 'client02@gmail.com', 'password', '2023-03-09 06:31:42', NULL, NULL, 0, NULL),
(6, '株式会社ほげほげ', '田中次郎', '営業部長', '0123456789', 'client03@gmail.com', '$2y$10$3IFXFbOueT9QZQyY6HaWRuKkcAPZAY461w2a3qK6aj/W5jRMmc4wu', '2023-03-09 06:31:42', '2023-04-11 02:32:12', '7U88aeIe5TAijPNnkYFDkwnytZuLnJlzQ2FWdIIV3kUuE06HO7EY2YTmYIfa', 0, NULL),
(7, '株式会社micado', 'テスト', 'テスト', '0123456789', 'client04@gmail.com', '$2y$10$mFcSJWQUQwKIyoO8rwDMZu0Wr8MHj5Xl220rB.dokPgn32Kltt4Cq', '2023-03-10 11:19:52', '2023-03-31 09:32:37', 'shz1DYFqA77XUQj3i2VLgKrghzTksdwrmQa5yrP0sI8QK40J8TFHaHRCUWRS', 0, NULL),
(13, 'test3', 'test3', 'test3', '0123456789', 'test@example.com', '$2y$10$Nrf1z.LGOTBOZdCooFD6pOuiDpOtioBJN/VPF4c3pAlEcxUzQTYoe', '2023-03-14 08:29:13', '2023-03-14 08:29:13', NULL, 0, NULL),
(14, 'test4', 'test', 'test', '123456789', 'client05@gmail.com', '$2y$10$fX.pJch/2.5qa/VMNEfWM.kso9W8deEb/YdKGt3O95sPKYmOz4MZy', '2023-04-11 02:37:27', '2023-04-11 02:50:35', 'iyUhYJYbXmfGFuHyoqSz7yY87bSR447yYPhDV1ZkkB9LqJgUCXbaR4FALwEs', 0, 'CqfD5zC9zcajOEsSV3dga6lSBr6LQQCy'),
(15, 'client6', 'テスト', 'テスト２', '0123456789', 'client06@gmail.com', '$2y$10$ahMzguSegXK9brfkW8ldlujPMreZChbZUZ1xXeSnj1UgyCtB2b6S2', '2023-04-11 02:53:16', '2023-04-11 02:53:16', NULL, 0, 'bTKXe3nnhjGSRbpD5EDKgXaKhr3JlnSV'),
(22, 'ホテル７', 'テスト', 'テスト', '0123456789', 'client7@gmail.com', '$2y$10$/g7WXyq/G5lPUFxDivs4UOFhDrqOPDh3rLBDnlqbwOwBkB4mP2BSW', '2023-04-11 03:43:00', '2023-04-11 03:43:00', NULL, 0, 'jpFJuIv73UuIZ4slxvupKT80UglkiNCC'),
(23, 'ホテル8', 'テスト', 'テスト', '0123456789', 'client8@gmail.com', '$2y$10$VdMfLvA055KDe2aVs6OZs.0XM7ycmdd.zfPwzWfWcoNh6g3jl6cMG', '2023-04-11 03:53:54', '2023-04-11 03:53:54', NULL, 0, '9Mo1O1ShpFBle9s36RX9oyXSTaLy22DW'),
(24, 'ホテル9', 'テスト', 'テスト', '0123456789', 'client09@gmail.com', '$2y$10$NJ/niGze5vwWp65a.cmf4.f/WiIbmtI.4LSabEnqGduaaa293godG', '2023-04-11 03:56:21', '2023-04-11 03:56:32', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `region_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `price`, `address`, `description`, `phone_number`, `region_id`, `category_id`, `url`, `created_at`, `updated_at`, `client_id`, `user_id`) VALUES
(1, 'ホテル１', 10000, '神奈川県足柄下郡箱根町', 'ゆったりとお風呂に浸かり会席料理を楽しむ。別荘感覚で過ごしBBQの夕食まで静かな森の中で過ごす', '0123456789', 1, 1, 'https://www.google.com/', '2023-03-03 07:07:42', NULL, 3, 1),
(2, 'ホテル2', 60000, '神奈川県足柄下郡箱根町', '飛騨高山のカルチャーと共に生まれた新しい発見を探索する拠点になる', '0123456789', 2, 2, 'https://www.google.com/', '2023-03-03 07:07:42', '2023-03-03 10:08:46', 4, 2),
(3, 'ホテル3', 30000, '神奈川県足柄下郡箱根町', 'GOOD LOCAL\"と出会う旅へ', '0123456789', 3, 3, 'https://www.google.com/', '2023-03-03 07:07:42', NULL, 5, 3),
(5, 'ホテル４', 40000, '神奈川県足柄下郡箱根町', 'ホテル４ホテル４ホテル４ホテル４ホテル４ホテル４ホテル４', '0123456789', 5, 3, 'https://www.google.com/', '2023-03-06 02:01:30', '2023-03-06 02:01:30', 4, 4),
(6, 'ホテル5', 30000, '神奈川県足柄下郡箱根町', 'ホテル5ホテル5ホテル5ホテル5ホテル5ホテル5ホテル5ホテル5', '0123456789', 4, 2, 'https://www.google.com/', '2023-03-06 02:01:57', '2023-03-06 02:01:57', 3, 5),
(7, 'Yukiで登録したホテル', 30000, 'あああああ', 'あああああああああああああああああああああああああ', '0123456789', 1, 1, 'https://www.google.com/', '2023-03-09 06:39:29', '2023-03-09 06:39:29', 1, 6),
(8, 'Yukiで登録したホテル２', 40000, 'ああああ', 'ああああ', '0123456789', 2, 2, 'https://www.google.com/', '2023-03-09 06:41:06', '2023-03-09 06:41:06', 1, 5),
(9, 'ゆうきで登録したホテル', 30000, 'ええええええ', 'ええええええ', '0123456789', 4, 3, 'https://www.google.com/', '2023-03-09 06:42:55', '2023-03-09 06:42:55', 2, 4),
(10, 'ゆうきで登録したホテル02', 40000, 'うううううう', 'うううううううううううううううううううううううう', '0123456789', 8, 7, 'https://www.google.com/', '2023-03-09 06:43:29', '2023-03-09 06:43:29', 2, 3),
(14, 'エンド６で登録したホテル', 30000, '世田谷区代田', 'エンド６で登録したホテルエンド６で登録したホテルエンド６で登録したホテル', '0123456789', 5, 2, 'https://www.google.com/', '2023-03-14 03:29:37', '2023-03-14 03:29:37', NULL, 9),
(15, '株式会社micadoで登録したホテル', 30000, '世田谷区代田', '株式会社micadoで登録したホテル株式会社micadoで登録したホテル株式会社micadoで登録したホテル', '0123456789', 3, 1, 'https://www.google.com/', '2023-03-28 08:48:02', '2023-03-28 08:48:02', 24, NULL),
(16, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 6, 'https://www.google.com/', '2023-03-28 09:07:09', '2023-05-04 05:50:48', 24, NULL),
(17, 'test3で登録したホテル', 20000, '世田谷区代田', 'test3で登録したホテルtest3で登録したホテルtest3で登録したホテルtest3で登録したホテル', '0123456789', 2, 4, 'https://www.google.com/', '2023-03-29 09:02:14', '2023-03-29 09:07:34', 13, NULL),
(18, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:28:50', '2023-05-04 03:28:50', NULL, NULL),
(19, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:34:38', '2023-05-04 03:34:38', NULL, NULL),
(20, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:35:04', '2023-05-04 03:35:04', NULL, NULL),
(21, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:35:16', '2023-05-04 03:35:16', NULL, NULL),
(22, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:35:24', '2023-05-04 03:35:24', NULL, NULL),
(23, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:35:35', '2023-05-04 03:35:35', NULL, NULL),
(24, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:35:40', '2023-05-04 03:35:40', NULL, NULL),
(25, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:36:03', '2023-05-04 03:36:03', NULL, NULL),
(26, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:36:15', '2023-05-04 03:36:15', NULL, NULL),
(27, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:36:27', '2023-05-04 03:36:27', NULL, NULL),
(28, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:45:43', '2023-05-04 03:45:43', NULL, NULL),
(29, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:45:59', '2023-05-04 03:45:59', NULL, NULL),
(30, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 03:47:15', '2023-05-04 03:47:15', NULL, NULL),
(31, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 04:18:36', '2023-05-04 04:18:36', NULL, NULL),
(32, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 04:20:00', '2023-05-04 04:20:00', NULL, NULL),
(33, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 04:25:37', '2023-05-04 04:25:37', NULL, NULL),
(34, '株式会社micadoで登録したホテル２', 40000, '世田谷区代田', '株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２株式会社micadoで登録したホテル２', '0123456789', 4, 3, 'https://www.google.com/', '2023-05-04 04:28:11', '2023-05-04 04:28:11', NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `hotel_images`
--

CREATE TABLE `hotel_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `hotel_images`
--

INSERT INTO `hotel_images` (`id`, `hotel_id`, `filename`, `path`, `created_at`, `updated_at`) VALUES
(11, 16, 'スクリーンショット 2023-04-27 122432.png', 'public/hotel_images/スクリーンショット 2023-04-27 122432.png', '2023-05-04 04:35:52', '2023-05-04 04:35:52'),
(12, 16, 'スクリーンショット 2023-04-27 122432.png', 'public/hotel_images/スクリーンショット 2023-04-27 122432.png', '2023-05-04 04:39:19', '2023-05-04 04:39:19'),
(13, 16, 'スクリーンショット 2023-04-27 122352.png', 'public/hotel_images/スクリーンショット 2023-04-27 122352.png', '2023-05-04 04:42:06', '2023-05-04 04:42:06'),
(14, 16, 'スクリーンショット 2023-04-27 122352.png', 'public/hotel_images/スクリーンショット 2023-04-27 122352.png', '2023-05-04 05:27:50', '2023-05-04 05:27:50');

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(29, '2014_10_12_000000_create_users_table', 1),
(30, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(31, '2019_08_19_000000_create_failed_jobs_table', 1),
(32, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(33, '2023_02_24_164008_create_hotels_table', 1),
(34, '2023_02_28_112339_create_categories_table', 1),
(35, '2023_02_28_112647_create_regions_table', 1),
(36, '2023_03_09_144804_create_clients_table', 2),
(37, '2023_03_14_114618_add_user_id_to_hotels_table', 3),
(38, '2014_10_12_100000_create_password_resets_table', 4),
(39, '2023_03_29_133353_create_campaigns_table', 4),
(40, '2023_03_29_154815_create_campaign_hotel_table', 5),
(41, '2023_03_29_161255_add_client_id_to_campaigns', 6),
(42, '2023_03_29_163717_remove_hotels_from_campaigns', 7),
(43, '2023_03_29_184545_add_remember_token_to_clients_table', 8),
(44, '2023_04_07_133828_add_activation_token', 9),
(45, '2023_04_07_140029_add_is_active_and_email_verification_token_to_users_table', 10),
(46, '2023_04_11_105948_add_is_active_and_email_verification_token_to_clients_table', 11),
(47, '2023_05_04_115905_create_hotel_images_table', 12),
(48, '2023_05_04_130939_add_filename_to_hotel_images_table', 13);

-- --------------------------------------------------------

--
-- テーブルの構造 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('end1@gmail.com', '$2y$10$lP.erk6r1lM.zLt8N3rqg.pz2i0XxVC8pwgpnCUYZj60LYJbMsKXi', '2023-03-31 08:37:06'),
('end6@gmail.com', '$2y$10$ICIXthm7/LEqt7FkX.OfJuQaQfDLWDccgtlecBlm2K44eKcb2gVrC', '2023-03-31 08:40:33'),
('diyhb1369@gmail.com', '$2y$10$4Q5dvCofLSfHyQg3OR3b5OVkvTsGXZvmJvXYR6j69cUkuczfEm0E6', '2023-03-31 08:40:54');

-- --------------------------------------------------------

--
-- テーブルの構造 `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('diyhb1369@gmail.com', '$2y$10$hi28nYmCq2t7QpfZdCK5deBD1aN3Fb9MRppXstC6vH23hCzwxFZZC', '2023-03-30 04:19:50'),
('info@micado.jp', '$2y$10$N0pQVBXsOBlw404zCau5iuFjFZENakchpCGj38scUteLXvFN0bDcy', '2023-03-30 04:19:07');

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `regions`
--

CREATE TABLE `regions` (
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `region_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `regions`
--

INSERT INTO `regions` (`region_id`, `region_name`, `created_at`, `updated_at`) VALUES
(1, '北海道', '2023-03-03 07:07:26', NULL),
(2, '東北', '2023-03-03 07:07:26', NULL),
(3, '中部', '2023-03-03 07:07:26', NULL),
(4, '関東', '2023-03-03 07:07:26', NULL),
(5, '近畿', '2023-03-03 07:07:26', NULL),
(6, '中国', '2023-03-03 07:07:26', NULL),
(7, '四国', '2023-03-03 07:07:26', NULL),
(8, '九州', '2023-03-03 07:07:26', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `email_verification_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `is_active`, `email_verification_token`, `created_at`, `updated_at`) VALUES
(1, 'Yuki', 'diyhb1369@gmail.com', NULL, 'password', 'AQlgjwEIspav0WWkUzrhGeJrDyUrflz9H1C2oCwjuxnHhakdEwIV9brhRNwf', 0, NULL, '2023-03-09 04:12:21', '2023-03-09 04:12:21'),
(3, 'Admin', 'info@micado.jp', NULL, 'password', NULL, 0, NULL, '2023-03-09 07:35:31', '2023-03-09 07:35:31'),
(4, 'エンドユーザー１', 'end1@gmail.com', NULL, 'password', NULL, 0, NULL, '2023-03-10 05:28:52', '2023-03-10 05:28:52'),
(5, 'エンド２', 'end2@gmail.com', NULL, '$2y$10$ttbHPxl0iV9SQJ1m4evISOUVyAilsdaowQkSVK5kZSYPuAw5Cwe5y', NULL, 0, NULL, '2023-03-10 10:38:42', '2023-03-10 10:38:42'),
(6, 'テスト', 'client10@gmail.com', NULL, 'password', NULL, 0, NULL, '2023-03-13 07:10:29', '2023-03-13 07:10:29'),
(7, 'テスト', 'client11@gmail.com', NULL, 'password', NULL, 0, NULL, '2023-03-13 07:11:07', '2023-03-13 07:11:07'),
(8, 'ユーザー５', 'end5@gmail.com', NULL, '$2y$10$goUYAnR3wVZWcROBfLv0Re6JpmNrbc3IAf8izVGNZAvjfaFFhusQ2', NULL, 0, NULL, '2023-03-13 07:22:01', '2023-03-13 07:22:01'),
(9, 'エンド６', 'end6@gmail.com', NULL, '$2y$10$aGhsAripVdZHjtohVnnq8.eU6E5HIijXoGhHYE36wfbJ.hIFeSSEq', NULL, 0, NULL, '2023-03-13 08:07:19', '2023-03-13 08:07:19'),
(10, 'エンド７', 'end7@gmail.com', NULL, '$2y$10$Nru0a3d28vjeqgcctZhZBevW0a46hQ22IiRqotN4MX6B8GoNtH4nK', NULL, 0, NULL, '2023-03-28 10:00:27', '2023-03-28 10:00:27'),
(11, '宮坂優樹', 'miyasaka@micado.jp', '2023-04-06 09:22:04', '$2y$10$w4YsnXQ/XZbXrkeo6.cxXurVknk8FCqul.7OZ4cV0lnV18pZE6Pga', 'qM60jjFwIQ3HrvTbRg7r4Zxpe2ovJvJgEh0W3g1T0BxKo1jt4rtKpVkygZ7c', 0, NULL, '2023-03-31 09:07:31', '2023-04-06 09:22:04'),
(12, 'end8', 'end8@gmail.com', NULL, '$2y$10$K1buQq9Lh5R51m0Ohrb3ke5vCUt.BLCix4AFI1DDT31WJ7871Qiqm', NULL, 0, NULL, '2023-04-06 09:30:53', '2023-04-06 09:30:53'),
(13, 'end9', 'end9@gmail.com', '2023-04-06 09:38:26', '$2y$10$HfWxIC.sVCVeRswc1IXTzeDq41cAR8XwBwjgbcm/B3Az8XnKVDk5e', NULL, 0, NULL, '2023-04-06 09:38:07', '2023-04-06 09:38:26'),
(15, 'end11', 'end11@gmail.com', NULL, '$2y$10$kKCj37NZBWlNcxdx.hcVqetu2oAiiP/j2bAA8KVvxRJnEouG51bg6', NULL, 0, NULL, '2023-04-07 04:57:14', '2023-04-07 04:57:14'),
(18, 'end12', 'end12@gmail.com', NULL, '$2y$10$VgaUSXzNjXfsT4hpnM7ZQuOCvTWD39iHce3SO5GCN0jdS9oBXsaKO', NULL, 0, 'hRY06iPDvXcya0lP5AQmafDpXXZTeErZ', '2023-04-07 05:41:44', '2023-04-07 05:41:44'),
(19, 'end13', 'end13@gmail.com', NULL, '$2y$10$fg0LJK8pdlxANpjEBj1GCupFQzwi1e0YvFtqbq9zUIaKNwpYcqrE.', NULL, 0, '1RsADLuxuHWMdkHaL7G3j3TFFWWEctGM', '2023-04-07 05:49:11', '2023-04-07 05:49:11'),
(20, 'end14', 'end14@gmail.com', NULL, '$2y$10$CIeCuoYsJDGKHOdb.MHwfO/bePIJ7nRiT6W72NleQh4gjn1frIr5O', NULL, 0, 'hIKoF5l5qnZR6L7zdDAKVBvGm7YSM1Nn', '2023-04-07 05:50:26', '2023-04-07 05:50:26'),
(21, 'end15', 'end15@gmail.com', NULL, '$2y$10$b4cA9ANXG9DdCNW5jtx0..B/.z.2Pfiu6FOpLy/a3taZ7PYt4hZ.u', NULL, 0, 'kU2igaiFrhKS5Zsm4RvVqJyUbePktG6J', '2023-04-07 05:54:33', '2023-04-07 05:54:33'),
(22, 'end16', 'end16@gmail.com', NULL, '$2y$10$xz1kkvl.FIxgtcqGDCjqg.YxdmEicVSUAO0AOq20RFQW3n61CLlZe', NULL, 0, '1', '2023-04-07 05:56:50', '2023-04-07 06:03:38'),
(23, 'end17', 'end17@gmail.com', NULL, '$2y$10$ntIXM0iqWTs8yb9FXSkRtO6x1yOHWKGj1wTZGA/1OEz5nKI1roK1O', NULL, 1, NULL, '2023-04-07 06:16:21', '2023-04-07 06:16:44'),
(24, 'end18', 'end18@gmail.com', NULL, '$2y$10$1ZHCLgBgbqjbJ8t3kpSenOCZpxnfQU6KW5gAP8YhbYF7ABUga1Bh2', NULL, 1, NULL, '2023-04-07 06:27:46', '2023-04-07 06:28:04'),
(25, 'end19', 'end19@gmail.com', NULL, '$2y$10$Ad8rDclcug9Od25HNNU3a.SlDKZNZ9K3ctPJQYNqWL3ql3P6Fe42K', NULL, 0, 'U6RIe3L43VyhOlQXkTxXdeFgQtfSq5v8', '2023-04-07 06:58:41', '2023-04-07 06:58:41'),
(26, 'end20', 'end20@gmail.com', NULL, '$2y$10$JmlfbEvvpu66hfr6VtwXy.5TzL7UToDVEuK.lSmXGglSMMKzfy.Oe', NULL, 0, 'fPR0RFEEqkspndw8IKgHnveF9Y4h3BlR', '2023-04-07 07:04:04', '2023-04-07 07:04:04'),
(27, 'end21', 'end21@gamil.com', NULL, '$2y$10$vaPOEFDXiiYyU8cI1JRgD.Yqf0T8xfFg3Y90wcdGrBqqDrFpDUnUe', NULL, 0, 'yGr35304L2T20nVYcMsZxv4kCK9e4TgO', '2023-04-07 07:08:27', '2023-04-07 07:08:27'),
(28, 'end22', 'end22@gmail.com', NULL, '$2y$10$aCWYbm6NR8IfPL1RXOI8feh4GE6pDmZTTQ6pSw59CF10v3fu9dJ5C', NULL, 0, '0gsOBPZP2DcKPFxtvIJCK62ylyILQaYs', '2023-04-07 07:12:00', '2023-04-07 07:12:00'),
(29, 'end23', 'end23@gmail.com', NULL, '$2y$10$OieICht/LrV3TUnyvMqlwOa/uzlONC/HOpzIW262Se6lFTGpe4E7e', NULL, 0, 'nczNGrl5czT5gz7IodnK8ueyrBrAiISO', '2023-04-07 07:22:30', '2023-04-07 07:22:30'),
(30, 'end24', 'end24@gmail.com', NULL, '$2y$10$15iDwSc6evoAD6eikBge4e5Us3y6283gVJysh2/uKhhCxYAVqCAgW', NULL, 0, 'eyzREcE0nIQeBtDPZcZpdEzyjy2PPqhi', '2023-04-07 07:44:08', '2023-04-07 07:44:08'),
(31, 'end25', 'end25@gmail.com', NULL, '$2y$10$Kyp9CiwVeECyP/3vuFZzneMdgMpQ8oCJsQvh8W5XX5.9EDV.FBodO', NULL, 1, NULL, '2023-04-07 07:47:18', '2023-04-07 07:47:56'),
(32, 'end26', 'end26@gmail.com', NULL, '$2y$10$B1fQLgdd6YK7eairniTwUexJnf/Rsm5Qh31zBv75IU9zNnAlQxEI2', NULL, 0, 'zJxCOitfUkU2fap9ZURURk7yuhE45lps', '2023-04-07 08:09:59', '2023-04-07 08:09:59'),
(33, 'end27', 'end27@gmail.com', NULL, '$2y$10$ZHdSOjoUkAMCTWmmCtd8XO8kz/cDaWwjCgck2n8epvi91ZH2Lll6G', NULL, 0, 'jGKCgldt6DJuelpaCAjw9i8YTdmYBfTu', '2023-04-07 09:01:44', '2023-04-07 09:01:44'),
(34, 'end28', 'end28@gmail.com', NULL, '$2y$10$/6kSYsGG9zxTeSIOtTecseFN4FYQQALpt9Rl6EXdxevHQvc6tb.rG', NULL, 1, NULL, '2023-04-07 09:16:47', '2023-04-07 09:24:53');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaigns_client_id_foreign` (`client_id`);

--
-- テーブルのインデックス `campaign_hotel`
--
ALTER TABLE `campaign_hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_hotel_campaign_id_foreign` (`campaign_id`),
  ADD KEY `campaign_hotel_hotel_id_foreign` (`hotel_id`);

--
-- テーブルのインデックス `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- テーブルのインデックス `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_client_email_unique` (`email`);

--
-- テーブルのインデックス `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- テーブルのインデックス `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_images_hotel_id_foreign` (`hotel_id`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- テーブルのインデックス `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- テーブルのインデックス `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- テーブルのインデックス `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `campaign_hotel`
--
ALTER TABLE `campaign_hotel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- テーブルの AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- テーブルの AUTO_INCREMENT `hotel_images`
--
ALTER TABLE `hotel_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- テーブルの AUTO_INCREMENT `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `campaign_hotel`
--
ALTER TABLE `campaign_hotel`
  ADD CONSTRAINT `campaign_hotel_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `campaign_hotel_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD CONSTRAINT `hotel_images_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
