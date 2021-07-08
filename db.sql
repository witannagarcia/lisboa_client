-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-07-2021 a las 21:27:38
-- Versión del servidor: 5.7.32
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `lisboa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `ext_num` varchar(10) NOT NULL,
  `suburb` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `coordinates` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `branches`
--

INSERT INTO `branches` (`id`, `restaurant_id`, `name`, `address`, `ext_num`, `suburb`, `city`, `state`, `coordinates`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 3, 'Villa de Alvarez', 'Mar Caribe', '340', 'Vista Bugambilias', 'Villa de Álvarez', 'Colima', '19.2924085,-103.7384626', '2021-06-30 20:49:56', '2021-06-30 20:49:56', NULL),
(5, 3, 'Colima', 'Av Felipe Sevilla del rio', '1025', 'José María Morelos', 'Colima', 'Colima', '19.25161158387816,-103.71007081691893', '2021-07-01 17:20:36', '2021-07-01 17:20:36', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch_schedules`
--

CREATE TABLE `branch_schedules` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `open` varchar(8) NOT NULL,
  `close` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch_table`
--

CREATE TABLE `branch_table` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `width` int(11) NOT NULL DEFAULT '500',
  `height` int(11) NOT NULL DEFAULT '350'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `branch_table`
--

INSERT INTO `branch_table` (`id`, `branch_id`, `width`, `height`) VALUES
(1, 4, 800, 350),
(2, 5, 983, 558);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `branch_id`, `category_id`, `name`, `image_banner`, `image_icon`, `order`) VALUES
(1, 4, NULL, 'Bebidas', '/images/categories/1/image_banner.png', '/images/categories/1/image_icon.png', 1),
(2, 4, 1, 'Vinos', '/images/categories/2/image_banner.png', '/images/categories/2/image_icon.png', 2),
(3, 4, NULL, 'Cortes Finos', '/images/categories/3/image_banner.jpeg', '/images/categories/3/image_icon.png', NULL),
(4, 5, NULL, 'Cortes finos', '/images/categories/4/image_banner.jpeg', '/images/categories/4/image_icon.png', NULL),
(5, 5, NULL, 'Vinos', '/images/categories/5/image_banner.jpeg', '/images/categories/5/image_icon.png', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dishes`
--

CREATE TABLE `dishes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `price_half` decimal(10,2) DEFAULT NULL,
  `preparation_time` int(11) NOT NULL,
  `preview` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dishes`
--

INSERT INTO `dishes` (`id`, `branch_id`, `category_id`, `name`, `price`, `price_half`, `preparation_time`, `preview`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, 'Vino Tinto', '40.00', NULL, 5, 'Vino tinto de calidad', 'Vino tinto de calidad', '2021-07-01 19:08:25', '2021-07-01 21:25:41', NULL),
(2, 4, 3, 'Rib eye', '100.00', NULL, 50, 'Corte fino', 'Corte fino', '2021-07-01 22:12:53', '2021-07-01 22:12:53', NULL),
(3, 5, 4, 'Rib Eye 500 GR.', '389.00', NULL, 50, 'Delicioso corte con marmoleo.', 'Carne fina y suave. posee una gran cantidad de marmoleo que lo hace especialmente tierno y de gran sabor.', '2021-07-07 22:20:27', '2021-07-07 22:20:27', NULL),
(4, 5, 5, 'Casa Madero 3V', '640.00', NULL, 5, 'Color Rubi intenso con aromas y sabores.', 'Color Rubi intenso con aromas y sabores.', '2021-07-08 00:51:57', '2021-07-08 00:51:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dish_images`
--

CREATE TABLE `dish_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dish_id` int(11) NOT NULL,
  `url` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dish_images`
--

INSERT INTO `dish_images` (`id`, `dish_id`, `url`) VALUES
(11, 1, '/images/dishes/1/2hyE3sg1FL1fwwHpRl0cU8gu.png'),
(12, 2, '/images/dishes/2/78FKlds2e63z3h1Ahd8KojDf.jpeg'),
(13, 3, '/images/dishes/3/3MB5J5gjJKRV0eTzG7tTJ72x.jpeg'),
(14, 4, '/images/dishes/4/fGq6GV0K9EcSelWSbcKXqi8S.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elements`
--

CREATE TABLE `elements` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `left` int(11) NOT NULL,
  `top` int(11) NOT NULL,
  `scaleX` float NOT NULL DEFAULT '1',
  `scaleY` float NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `elements`
--

INSERT INTO `elements` (`id`, `branch_id`, `width`, `height`, `type`, `number`, `left`, `top`, `scaleX`, `scaleY`) VALUES
(402, 5, 30, 30, 'chair', NULL, 250, 338, 1, 1),
(403, 5, 30, 30, 'chair', NULL, 313, 338, 1, 1),
(404, 5, 30, 30, 'chair', NULL, 250, 238, 1, 1),
(405, 5, 30, 30, 'chair', NULL, 313, 238, 1, 1),
(406, 5, 30, 30, 'chair', NULL, 525, 338, 1, 1),
(407, 5, 30, 30, 'chair', NULL, 588, 338, 1, 1),
(408, 5, 30, 30, 'chair', NULL, 588, 238, 1, 1),
(409, 5, 30, 30, 'chair', NULL, 525, 238, 1, 1),
(410, 5, 30, 30, 'chair', NULL, 200, 163, 1, 1),
(411, 5, 30, 30, 'chair', NULL, 250, 163, 1, 1),
(412, 5, 30, 30, 'chair', NULL, 200, 88, 1, 1),
(413, 5, 30, 30, 'chair', NULL, 250, 88, 1, 1),
(414, 5, 30, 30, 'chair', NULL, 388, 150, 1, 1),
(415, 5, 30, 30, 'chair', NULL, 425, 150, 1, 1),
(416, 5, 30, 30, 'chair', NULL, 388, 88, 1, 1),
(417, 5, 30, 30, 'chair', NULL, 425, 88, 1, 1),
(418, 5, 30, 30, 'chair', NULL, 563, 150, 1, 1),
(419, 5, 30, 30, 'chair', NULL, 600, 150, 1, 1),
(420, 5, 30, 30, 'chair', NULL, 563, 88, 1, 1),
(421, 5, 30, 30, 'chair', NULL, 600, 88, 1, 1),
(422, 5, 192, 72, 'bar', NULL, 325, 0, 1, 1),
(423, 5, 102, 72, 'table', 1, 550, 100, 1, 1),
(424, 5, 102, 72, 'table', 2, 375, 100, 1, 1),
(425, 5, 109, 79, 'table', 3, 188, 100, 1, 1),
(426, 5, 62, 62, 'table', 4, 225, 250, 2.40323, 1.62903),
(427, 5, 62, 62, 'table', 5, 500, 250, 2.41935, 1.62903);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `ext_num` varchar(10) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(80) NOT NULL,
  `name` varchar(50) NOT NULL,
  `coordinates` varchar(120) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_01_202223_create_categories_table', 1),
(5, '2021_06_01_202556_create_restaurants_table', 1),
(6, '2021_06_01_202626_create_qr_settings_table', 1),
(7, '2021_06_01_234407_create_dishes_table', 2),
(9, '2021_06_02_112139_create_dish_images_table', 3),
(10, '2021_06_02_164236_create_settings_table', 4),
(11, '2016_06_01_000001_create_oauth_auth_codes_table', 5),
(12, '2016_06_01_000002_create_oauth_access_tokens_table', 5),
(13, '2016_06_01_000003_create_oauth_refresh_tokens_table', 5),
(14, '2016_06_01_000004_create_oauth_clients_table', 5),
(15, '2016_06_01_000005_create_oauth_personal_access_clients_table', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('034c575655b7f71cb199311d75dd74b6a79759e4af18dbd9d588c37813014e02bbe984baa03c4ae0', 1, 1, 'l6JcTf2IwaXc', '[]', 0, '2021-06-04 07:49:02', '2021-06-04 07:49:02', '2022-06-03 21:49:02'),
('19b899574ef43d64197ccd74ccb128a8c663e40da81e9d0122593d41a53fbbe4a8334a323427246c', 105, 1, 'e5fYiVTX1Crp', '[]', 0, '2021-06-18 00:08:31', '2021-06-18 00:08:31', '2022-06-17 19:08:31'),
('1a6333187562eda1ad4c60743c15fa8473be58d4bbbdf5fadf6e2912955b35ab294d9c2cf23822ed', 105, 1, 'GGZSKHkWsnWo', '[]', 0, '2021-06-12 23:05:47', '2021-06-12 23:05:47', '2022-06-12 18:05:47'),
('1bc807064154f136badcafc5d8bba171508c121f22179c3a46b6ed0c2dd9b4a30c6608dcab5f892a', 15, 1, 'MyApp', '[]', 0, '2021-06-11 19:23:15', '2021-06-11 19:23:15', '2022-06-11 14:23:15'),
('1c2307e7db10fe5160ad2f8e48b0176f4a30de6e5c9b7257ae122517053e15755026cd10e8e442f4', 1, 3, 'DTdoaHubVw92', '[]', 0, '2021-06-23 23:14:19', '2021-06-23 23:14:19', '2022-06-23 18:14:19'),
('2772f5471b1e691e1cec5366d49f2249fa4792a59777ac623fe7ea5b71c87c6fcc6c4ca10a223f29', 105, 1, 'QvmtudoY5bMO', '[]', 0, '2021-06-12 23:08:04', '2021-06-12 23:08:04', '2022-06-12 18:08:04'),
('27830cda47f27d6d74e51d31a9661f8eedd0c369f7b046aec03ae954662fbf6182d15bb84eec6d88', 105, 1, 'o4PPopEXWlya', '[]', 0, '2021-06-12 23:33:24', '2021-06-12 23:33:24', '2022-06-12 18:33:24'),
('2f5f8c084e4a1b9365565f78d4778f18447a43b4d1cdca0d4ff3f2c565f3cfd3a8ff0effcf494da7', 55, 1, 'MyApp', '[]', 0, '2021-06-11 19:51:41', '2021-06-11 19:51:41', '2022-06-11 14:51:41'),
('32c4de4f01c6e0d29f323e217a8349d4597cba6f1ec50b629dec4703bf87c89e8eb105d839ea567f', 1, 1, 'k8rRwZdkrypB', '[]', 0, '2021-06-04 07:52:02', '2021-06-04 07:52:02', '2022-06-03 21:52:02'),
('3543638be9b0aeb645cf404416b3d026e8bf2fd4267c2a1fcc7c9ea47c64a82edf7a531ff2d22d07', 105, 1, 'qJVQGTp6MjcP', '[]', 0, '2021-06-12 23:40:50', '2021-06-12 23:40:50', '2022-06-12 18:40:50'),
('361653aae050f78b2a6f0258715f64ee0611169dd5e0adac77dcf6b7044d5439638704189f357429', 105, 1, '9TZclJkhjrKq', '[]', 0, '2021-06-12 23:31:36', '2021-06-12 23:31:36', '2022-06-12 18:31:36'),
('3a3670b5245d91ed47ff66e675947b51d9a824f6ad093a66659b880eb26ee6950508acb00fe30b2a', 105, 1, 'CESe6iq6szUE', '[]', 0, '2021-06-16 22:41:57', '2021-06-16 22:41:57', '2022-06-16 17:41:57'),
('3bab3f449868df5fd623fd2047d8ebac2f7046da9664d163efc9872c48eade824b089b649a1af6ee', 1, 1, 'PWSCNF52kVa1', '[]', 0, '2021-06-04 07:43:27', '2021-06-04 07:43:27', '2022-06-03 21:43:27'),
('3f735c0988e7fd2caf4d72beb5e3eff923b140a88e155dba35ba293f8034cf179807d469715e1e31', 105, 1, 'EokQDpxcBmYB', '[]', 0, '2021-06-12 22:32:38', '2021-06-12 22:32:38', '2022-06-12 17:32:38'),
('498c54bfa31004571225029f1c08b2ebb53f499fba4b7283ef3f1dcea473dda8653fe10038cc179c', 1, 1, 'f7G4N5dL7pfO', '[]', 0, '2021-06-04 07:53:48', '2021-06-04 07:53:48', '2022-06-03 21:53:48'),
('4d3242f9bcb6eb0f89e349eae995062c1b68c405a056f10ed03e2d653658b3cbaf8b8418e96e2b5f', 1, 1, 'NjInSTUHj0w5', '[]', 0, '2021-06-04 08:15:20', '2021-06-04 08:15:20', '2022-06-03 22:15:20'),
('4da02bd9d7b9aef3d768a46d28fa23cb7113959ddaea98582f81aaf186732089692a3ed297ac1451', 105, 1, 'ZL1ReDDlZQiO', '[]', 0, '2021-06-16 22:41:57', '2021-06-16 22:41:57', '2022-06-16 17:41:57'),
('58c368bae8ecb5bff2f9fff2bf5fe038d37ec72ffa60106c6491379aadbb2f8b77156337e67ba91f', 1, 1, '6T1V9A6czCWu', '[]', 0, '2021-06-04 08:13:34', '2021-06-04 08:13:34', '2022-06-03 22:13:34'),
('5aa0833d34db306ee013ed7eb44b9b29045a6c550671c61a935a35b86d0e97ae0bcbb8a32f71b339', 85, 1, 'MyApp', '[]', 0, '2021-06-12 20:46:19', '2021-06-12 20:46:19', '2022-06-12 15:46:19'),
('5bbefded7921400b07f8c94bfe195ffb0ac1b597c95b982d0e31651859ece6aaeddf55fca0631094', 95, 1, 'MyApp', '[]', 0, '2021-06-12 20:52:29', '2021-06-12 20:52:29', '2022-06-12 15:52:29'),
('681657eed3a5f8f82bae0d70d73b5b0fba576aff22042a2e7d76f8eef1f9a0988ebff5e02b0c0223', 105, 1, 'XdQltKctvUMO', '[]', 0, '2021-06-12 22:46:45', '2021-06-12 22:46:45', '2022-06-12 17:46:45'),
('6900a5e779f6cfe8fb8a9abfe774e410e0e01c222ebf0c389f7904d0fea7b5de0811858c9d1d2164', 1, 1, 'UuXZnccEewVd', '[]', 0, '2021-06-14 22:15:45', '2021-06-14 22:15:45', '2022-06-14 17:15:45'),
('6be3b78169ca017a2ed205319baedb4f02a7d50b5d3fc16aa7d6cb2fde8bf4bf56b10b98dce90ee9', 105, 1, 'oHKcmPbjOjcx', '[]', 0, '2021-06-12 23:27:26', '2021-06-12 23:27:26', '2022-06-12 18:27:26'),
('6dbd6708172cae8f4ef5790dbb424201c309d104a4024101581a9b56dd26f03ee6fc8e44d7264347', 105, 1, 'qag8nin2n37x', '[]', 0, '2021-06-16 22:41:58', '2021-06-16 22:41:58', '2022-06-16 17:41:58'),
('6f26b00e5c1aa4a9e4a353517a5fce52a7b6f7b5abe996bdb77d240cc8b71c1279176285c0685fda', 105, 1, 'LrJq9sJDAcar', '[]', 0, '2021-06-12 23:21:52', '2021-06-12 23:21:52', '2022-06-12 18:21:52'),
('6f6a4e9748c203e00df02059822fbbbbc7ec1a48eb9de4fa7a5c73050851a9b93d2702aa47ed16e9', 105, 1, 'Cl9jylQKUdyg', '[]', 1, '2021-06-14 21:11:11', '2021-06-14 21:11:11', '2022-06-14 16:11:11'),
('8013a376b91acb75ef56d1d9b6188b784ddf7a993e8351ccc4840740f6b4b3f033c22053d11d813f', 105, 1, 'YT3WUQ8A3Gwr', '[]', 0, '2021-06-12 21:08:55', '2021-06-12 21:08:55', '2022-06-12 16:08:55'),
('833dae336d74dc7cb2fba4f76149f63d4c64fdd5eeb35c051818eccc0b1f98e100f37833eb5b8088', 65, 1, 'MyApp', '[]', 0, '2021-06-11 19:59:05', '2021-06-11 19:59:05', '2022-06-11 14:59:05'),
('847acd1cbcf3cc0dd4ed4705f6296e4f6196ef38dcaca6947cd9b8288c89db5da400678ad018dc27', 105, 1, 'EGOCGcZHU46Z', '[]', 0, '2021-06-12 23:15:47', '2021-06-12 23:15:47', '2022-06-12 18:15:47'),
('8619495a7b97f43d0a660a9eb48fe042101d8b7d801db4bec1d5e6ba6eba6d268a3418f8f4e9e4c8', 1, 1, 't78aWPprrL0s', '[]', 0, '2021-06-04 07:40:26', '2021-06-04 07:40:26', '2022-06-03 21:40:26'),
('865a9521025cb87f42583864b4f6bb434cc965cdd158686d2f2f8a97a9d3a3c1a2571c86333d449a', 25, 1, 'MyApp', '[]', 0, '2021-06-11 19:23:53', '2021-06-11 19:23:53', '2022-06-11 14:23:53'),
('868830347011f3fc19526d119d866945d545c558c097c245f3f7df1a07eea6e2cc83cd843ea8214a', 105, 1, 'MyApp', '[]', 0, '2021-06-12 21:03:11', '2021-06-12 21:03:11', '2022-06-12 16:03:11'),
('87f7489598f15b5db1c2dc5bc89ede421172ba4bee3b26da2d5ea2a5e5ed298a1cd3d674f14b96ca', 1, 3, '0jdE3owLE24w', '[]', 0, '2021-06-23 23:14:54', '2021-06-23 23:14:54', '2022-06-23 18:14:54'),
('90d6c5fe17bc1af242fe0730e850877adf08515522223d33966e2fd9e0f8fe89f091e115bd6ff270', 105, 1, 'EAyingAR8PYU', '[]', 0, '2021-06-12 23:10:30', '2021-06-12 23:10:30', '2022-06-12 18:10:30'),
('92968907e6539e43fa1325653cfea8d6170edb2267ab071718c0749d4b25ce855c61dcb4121d6a63', 75, 1, 'MyApp', '[]', 0, '2021-06-11 20:03:03', '2021-06-11 20:03:03', '2022-06-11 15:03:03'),
('9691a118596d1362757b7825a5640bc837ac8ceb3456d7934bee3ddfeb0c504fc4f1901ded8d6d91', 105, 1, 'HlafoaoPwESS', '[]', 0, '2021-06-12 23:17:37', '2021-06-12 23:17:37', '2022-06-12 18:17:37'),
('99280a1332de1b6f1a4782167bcc69ef49b5aebe987b03ed55a0d42b2743511084137e951772a82a', 35, 1, 'MyApp', '[]', 0, '2021-06-11 19:42:20', '2021-06-11 19:42:20', '2022-06-11 14:42:20'),
('9aa8e85a9d7e324a2a5e978f5e897b93cd198e7e4bbe17df6f51efee49e3f7dfe3dfd48b39de8a43', 45, 1, 'MyApp', '[]', 0, '2021-06-11 19:50:29', '2021-06-11 19:50:29', '2022-06-11 14:50:29'),
('9df6c8702911c56cd796e0d4ef568f16eed45835265e09721b4c5326142770667bb1892f1c166a32', 106, 3, 'MyApp', '[]', 0, '2021-06-25 19:31:12', '2021-06-25 19:31:12', '2022-06-25 14:31:12'),
('9e02620043123b8b2e2eb567ddafefd454b39e0a2904620a48734ee24b72d547f137bc5badf1427f', 105, 1, 'QQrDFnmDrMuY', '[]', 0, '2021-06-12 22:42:35', '2021-06-12 22:42:35', '2022-06-12 17:42:35'),
('a0d5e0af15f9953515e95132f6a2ee3e3a8efa44a5f5d94c23ab5175d99dffe3927b74b2818095c2', 105, 1, 'C1QsTrmhcfIM', '[]', 1, '2021-06-17 20:36:04', '2021-06-17 20:36:04', '2022-06-17 15:36:04'),
('a16f986ecd61dcf76a8aad411501f13e4a930a1eb8e4e4351350da1a0bb1b74605c61a9dfe479852', 105, 1, '4kLWSRqVOPpe', '[]', 0, '2021-06-16 22:41:57', '2021-06-16 22:41:57', '2022-06-16 17:41:57'),
('a493c9460717602c1209fc08ea18a436d2263cb32df2039e668e637df99dfa88dd6dc2358bba69a6', 1, 1, 'hB6J5d0O7Jxm', '[]', 0, '2021-06-14 22:08:00', '2021-06-14 22:08:00', '2022-06-14 17:08:00'),
('c3cdd6edce55f62f6852604cfe4dfed541bb7435e1ca5de2bca792fec738655e92f0299ce62a9b5e', 106, 3, 'C0p8wrvjTVfm', '[]', 0, '2021-06-25 19:33:53', '2021-06-25 19:33:53', '2022-06-25 14:33:53'),
('c76bf074666a90cb6f2f94c4db05c766027d3e5953c02486e31452db1caf0914d4443e7e0f2538ed', 105, 1, 'NF3NcXNTVwKP', '[]', 0, '2021-06-12 22:22:15', '2021-06-12 22:22:15', '2022-06-12 17:22:15'),
('c8e4bdd9c24f0613484847f36721a04bd49eda46896eba38dcf3b20d6b049eaf111d44c5537d341a', 105, 1, '8Y0ZhN5K62Ai', '[]', 0, '2021-06-12 23:24:47', '2021-06-12 23:24:47', '2022-06-12 18:24:47'),
('cba86bbfdb4baae79f306a343bfa048fe70badf773b6acc0f850c8cceb6887574aadb8e89cd769a6', 105, 1, 'v6bfK7nvKe9R', '[]', 0, '2021-06-12 22:08:04', '2021-06-12 22:08:04', '2022-06-12 17:08:04'),
('cf8dd6749f46996ddd08a16dc0378bc67f727fa62fbe8f51573d47183d16b9c1f660696d5f825cca', 1, 1, 'MLx2Vnt5jIyo', '[]', 0, '2021-06-19 01:20:39', '2021-06-19 01:20:39', '2022-06-18 20:20:39'),
('d13d34a3d3260120415f341a861a3b226928014391644ad7d9a48abd413407d9c54546d8af990040', 107, 3, 'MyApp', '[]', 0, '2021-06-26 03:13:07', '2021-06-26 03:13:07', '2022-06-25 22:13:07'),
('d1f32ad5cd1e2a7483d3e790bfea0925a05c61ac974eb927885b6164d94e7aedf3ea08ae92d48582', 1, 1, 'oVf8R6TrFObY', '[]', 0, '2021-06-18 22:08:55', '2021-06-18 22:08:55', '2022-06-18 17:08:55'),
('d6a0c6b653ddbdff5c57cfbc45ce132cc1f06f873e79f52b55e49bba9600a8d488e61f4f69f2e3d1', 105, 1, 'ubETl1bvVsZU', '[]', 1, '2021-06-18 00:20:28', '2021-06-18 00:20:28', '2022-06-17 19:20:28'),
('d7249e75357be85b379b741e389711c3bcd2b0d5a8895765f3dfbcababc9048432bcef5331a9105c', 1, 1, 'dvYhRFmIxNqg', '[]', 0, '2021-06-11 00:20:53', '2021-06-11 00:20:53', '2022-06-10 19:20:53'),
('ddc55ee5198c2f8bf54ae007505306e408002723dc77113ebcd0fa3f19db490b88a7f04defc157ff', 1, 1, 'Aeooy0uTKnA0', '[]', 0, '2021-06-11 19:23:47', '2021-06-11 19:23:47', '2022-06-11 14:23:47'),
('ddcff6aabfb5b4bedb513be3929bfa3acc3764b1db3173f2172c737d5ba380c0b5f3556e46bf9a5f', 105, 1, '2PW25lWb7GSH', '[]', 0, '2021-06-12 23:19:06', '2021-06-12 23:19:06', '2022-06-12 18:19:06'),
('de18c6c1144756248affecae1355efca7ab43a629ebe86b5510a615aaa81c8db63d4d5c8d09c46f5', 105, 1, 'rWABmZLD37yV', '[]', 0, '2021-06-12 23:38:51', '2021-06-12 23:38:51', '2022-06-12 18:38:51'),
('dfe1c9e5710cec14f8e13d9acf9cc990873ba9f96083344949a143f787fa18e73d01700008ad2fdc', 1, 1, 'NHesZIdGnST7', '[]', 0, '2021-06-04 08:13:06', '2021-06-04 08:13:06', '2022-06-03 22:13:06'),
('e01a474dc6c99cdb2671c348b21df6bb4afec0eee3c402b354effed66cb230c0392a1a87d8812b8d', 105, 1, 'MXqRqLahY9wI', '[]', 1, '2021-06-14 21:07:29', '2021-06-14 21:07:29', '2022-06-14 16:07:29'),
('e0306e3c8f97a9a58d93d107cae42a9656ee518ca3f8bfe92109b43890025258e112260b0490b533', 105, 1, 'Tx2ypG1qMMxB', '[]', 0, '2021-06-14 20:36:25', '2021-06-14 20:36:25', '2022-06-14 15:36:25'),
('ec216bb3d2ab75c81d7768259b521e5d4847ab532367da9bb493a710987cab1e94b5078c5e1284df', 5, 1, 'MyApp', '[]', 0, '2021-06-11 19:21:53', '2021-06-11 19:21:53', '2022-06-11 14:21:53'),
('ef214d05220c2022bda9404733da9eb086dd498922cf65f6668495c6cd3953db0c12c1fa8189e7fc', 105, 1, 'Gi79AspyrQIA', '[]', 0, '2021-06-12 23:38:49', '2021-06-12 23:38:49', '2022-06-12 18:38:49'),
('f10714ee1c8cb6159c53b30299c9e1af22b889772aa0bffb9663d76b81c5132ccf21b25390b96079', 1, 1, 'lTtwmrZzGCKi', '[]', 0, '2021-06-15 20:56:53', '2021-06-15 20:56:53', '2022-06-15 15:56:53'),
('f1782243261250d124bebff82f1e7fd7f2ce05d84ed787565849cfcb6bd5c1c46304063948bcadea', 1, 1, 'HaJTHz0BhVfh', '[]', 0, '2021-06-04 08:12:50', '2021-06-04 08:12:50', '2022-06-03 22:12:50'),
('fe428328a8a9612995e52f18f7db8d3e54460b3c513b51c1fd4618fc5632dbb56afc267b06458ed8', 1, 1, 'IC2hDvLDqptE', '[]', 0, '2021-06-04 07:40:48', '2021-06-04 07:40:48', '2022-06-03 21:40:48'),
('fe740cba108705ff8f98c1c4d407434d40311fe80762aa8e654f2ccd8ffc63b9f6168c8923e92bd8', 105, 1, 'nppV0Q712G8C', '[]', 1, '2021-06-16 22:41:58', '2021-06-16 22:41:58', '2022-06-16 17:41:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Lisboa Personal Access Client', 'QVoIlXzvhUUx2BzhUEhO0xMBToVphcpN8gYtk3gF', NULL, 'http://localhost', 1, 0, 0, '2021-06-04 07:00:47', '2021-06-04 07:00:47'),
(2, NULL, 'Lisboa Password Grant Client', 'cyEFH1UVeRhq2qlpiWVBVvvaQMWVDOJ1GUZXJi6I', 'users', 'http://localhost', 0, 1, 0, '2021-06-04 07:00:47', '2021-06-04 07:00:47'),
(3, NULL, 'La Finca del Barrio Personal Access Client', 'aL2mm6a7rFJVggBj67quoeR21f0HsKKLL9yizLQ9', NULL, 'http://localhost', 1, 0, 0, '2021-06-23 23:14:13', '2021-06-23 23:14:13'),
(4, NULL, 'La Finca del Barrio Password Grant Client', 'pnbvVxiTfcWkGurzE5u4UQfSREaedqYTPk63I6G6', 'users', 'http://localhost', 0, 1, 0, '2021-06-23 23:14:13', '2021-06-23 23:14:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-06-04 07:00:47', '2021-06-04 07:00:47'),
(2, 3, '2021-06-23 23:14:13', '2021-06-23 23:14:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `branch_table_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `status` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `restaurant_id`, `branch_id`, `branch_table_id`, `location_id`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 3, 5, NULL, NULL, 'creado', '2021-07-07 20:31:12', '2021-07-07 20:31:12'),
(2, NULL, 3, 5, 5, NULL, 'creado', '2021-07-07 20:38:54', '2021-07-07 20:38:54'),
(3, NULL, 3, 5, 5, NULL, 'creado', '2021-07-07 20:59:37', '2021-07-07 20:59:37'),
(4, NULL, 3, 5, 5, NULL, 'creado', '2021-07-07 21:00:34', '2021-07-07 21:00:34'),
(5, NULL, 3, 5, 2, NULL, 'creado', '2021-07-07 21:11:05', '2021-07-07 21:11:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_dishes`
--

CREATE TABLE `order_dishes` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `special_instructions` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `order_dishes`
--

INSERT INTO `order_dishes` (`id`, `order_id`, `dish_id`, `special_instructions`) VALUES
(1, 1, 4, 'Puede traerlo hasta que el rib eye este listo'),
(2, 1, 3, 'Termino 3/4'),
(3, 2, 4, 'Puede traerlo hasta que el rib eye este listo'),
(4, 2, 3, 'Termino 3/4'),
(5, 3, 3, 'Termino 3/4'),
(6, 3, 4, 'Bien frio por favor'),
(7, 4, 3, 'Termino 3/4'),
(8, 4, 4, 'Bien frio por favor'),
(9, 5, 3, 'Bien cocido por favor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `qr_settings`
--

CREATE TABLE `qr_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eye_style` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#000000',
  `color2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#000000',
  `logo` tinyint(1) NOT NULL DEFAULT '0',
  `gradiant` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `qr_settings`
--

INSERT INTO `qr_settings` (`id`, `restaurant_id`, `branch_id`, `type`, `eye_style`, `color`, `color2`, `logo`, `gradiant`, `created_at`, `updated_at`) VALUES
(1, '3', 4, NULL, NULL, '#000000', '#000000', 0, 0, '2021-07-01 01:49:56', '2021-07-01 01:49:56'),
(2, '3', 5, 'square', 'circle', '#cb2020', '#615c5c', 0, 1, '2021-07-01 22:20:36', '2021-07-07 21:53:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `active`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Lisboa', 0, NULL, '2021-06-02 07:22:01', '2021-06-02 07:22:01'),
(3, 'La Finca del Barrio', 1, 'restaurants/3/HNA6THKAHGph36HICx.jpeg', '2021-06-21 21:53:28', '2021-06-21 23:12:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `branch_id`, `name`, `phone`, `website`, `address`, `logo`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, NULL, NULL, NULL, NULL, '2021-07-01 01:49:56', '2021-07-01 01:49:56'),
(2, 5, NULL, NULL, NULL, NULL, '/images/restaurants/3/logo_VaDOmBfDEnfI.jpeg', '2021-07-01 22:20:36', '2021-07-03 03:44:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_hash` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `restaurant_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `verification_hash`, `role`, `created_at`, `updated_at`) VALUES
(1, 3, 'Angel Garcia', 'angel@witann.com', '2021-06-02 08:29:57', '$2y$10$R8Qo.8t2IBDG6OgFcfERhuZkUeVWDGrPA39OgaNsdxYdvSOfw42Pu', NULL, NULL, 'admin', '2021-06-02 07:22:01', '2021-06-02 08:29:57'),
(5, NULL, 'Juan Carlos', 'Carlos@gmail.com', NULL, '$2y$10$qKuedV5m9eJpjl7evzhkiORL01oqrRc4WH0Dy9meEHRf1l5YgH6OW', NULL, NULL, 'cliente', '2021-06-11 19:21:52', '2021-06-11 19:21:52'),
(15, NULL, 'Tu nombre', 'tucorreo@gmail.com', NULL, '$2y$10$VTB21Z5Wdycflv.CD0F83Ozc/2kISaNZMioem6.BRPSjM1JNY9Q9m', NULL, NULL, 'cliente', '2021-06-11 19:23:15', '2021-06-11 19:23:15'),
(25, NULL, 'Cómo', 'como@gmail.com', NULL, '$2y$10$xflEyBcJk7j8D.8VP2w4.uvEfvo164tBQEAj/XxFOqL91TPX6jAjC', NULL, NULL, 'cliente', '2021-06-11 19:23:53', '2021-06-11 19:23:53'),
(35, NULL, 'Mari', 'mar@gmail.com', NULL, '$2y$10$4Oj2xkJPLPwu9nAlpDLxI.bUp5j.UDpwTVZTRUuqmWb/AE6sXYMKu', NULL, NULL, 'cliente', '2021-06-11 19:42:20', '2021-06-11 19:42:20'),
(45, NULL, 'eljefe', 'adh@gmail.com', NULL, '$2y$10$HD1YlmDx.kpowUUcBVSSHODdGoJvDLfvYdTXNhJoEgXFHJkvb4jJ2', NULL, NULL, 'cliente', '2021-06-11 19:50:29', '2021-06-11 19:50:29'),
(55, NULL, 'eljefe', 'afdh@gmail.com', NULL, '$2y$10$XjxyaksvNTdd95cdFYV2MO/7ouDeaqwvofF2vPvQtV/RkDw4tUB.e', NULL, NULL, 'cliente', '2021-06-11 19:51:41', '2021-06-11 19:51:41'),
(65, NULL, 'Maria Elena', 'malen@gmail.com', NULL, '$2y$10$Pqv9aDsD5SFDzh4xWCOaee0728wUIPXby6EQhi4IYgueKV7j9Ox42', NULL, NULL, 'cliente', '2021-06-11 19:59:05', '2021-06-11 19:59:05'),
(75, NULL, 'Mari Fran', 'Marc@gmail.com', NULL, '$2y$10$UYKdyEBFz.5q7PjafC1ErOicbr6jOGGhkK65nWzbsTSi.WhucSS5S', NULL, NULL, 'cliente', '2021-06-11 20:03:03', '2021-06-11 20:03:03'),
(85, NULL, 'Maria Fernanda', 'Mariafer@gmail.com', NULL, '$2y$10$k2UPU3i3GX2XtrYWFNgxPeBRUHIALGCwsGWCpyAoSWHofWMoTWVTy', NULL, NULL, 'cliente', '2021-06-12 20:46:18', '2021-06-12 20:46:18'),
(95, NULL, 'mario paza', 'mario@gmail.com', NULL, '$2y$10$O3OSZB84FJcWBIu4TZmLQ.n//OrOdUN4LSpEB3OP1vV2RZRf1VFg2', NULL, NULL, 'cliente', '2021-06-12 20:52:29', '2021-06-12 20:52:29'),
(105, NULL, 'madre', 'mas@gmail.com', NULL, '$2y$10$hF6RGJIKN9J67iS0rTkQW.s870ppadSdSaETVKOv0f3Ktsh/6jN2m', NULL, NULL, 'cliente', '2021-06-12 21:03:11', '2021-06-12 21:03:11'),
(106, 3, 'Angel David', 'angelrodriguez@ucol.mx', NULL, '$2y$10$DKw4YkuY2/hoVL.Yf88X4uLkXTccXeG4VG0f9Jp1VGyGOF/H2xYhO', NULL, NULL, 'cliente', '2021-06-25 19:31:12', '2021-06-25 19:31:12'),
(107, 3, 'Cesário Sepúlveda', 'csepulveda@witann.com', NULL, '$2y$10$6b6b8CDEjRtRepvWX/zTz.7z6yiJzKmDoavmfQK6mdjz5bBvNSjSe', NULL, NULL, 'cliente', '2021-06-26 03:13:07', '2021-06-26 03:13:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `branch_schedules`
--
ALTER TABLE `branch_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `branch_table`
--
ALTER TABLE `branch_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dish_images`
--
ALTER TABLE `dish_images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `order_dishes`
--
ALTER TABLE `order_dishes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `qr_settings`
--
ALTER TABLE `qr_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `branch_schedules`
--
ALTER TABLE `branch_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `branch_table`
--
ALTER TABLE `branch_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `dish_images`
--
ALTER TABLE `dish_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=428;

--
-- AUTO_INCREMENT de la tabla `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `order_dishes`
--
ALTER TABLE `order_dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `qr_settings`
--
ALTER TABLE `qr_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
