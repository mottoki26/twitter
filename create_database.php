<?php
    try {
        include_once './common/dbConnection.php';
        $sql = "CREATE TABLE `user` (
            `mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            `user_id` int(5) NOT NULL,
            `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
            `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
          ) ENGINE=InnoDB";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        
    } catch (Exception $e) {

    }
?>
<!-- 
    -- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-12-15 11:05:12
-- サーバのバージョン： 10.4.19-MariaDB
-- PHP のバージョン: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/* ユーザ追加 */
GRANT ALL PRIVILEGES ON *.* TO `testcode`@`localhost` IDENTIFIED BY PASSWORD '*81A026BD77B7898E94D076D81F7C37B03E7039C4' WITH GRANT OPTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `twitter`
--
CREATE DATABASE IF NOT EXISTS `twitter` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `twitter`;

-- --------------------------------------------------------

--
-- テーブルの構造 `bookmark`
--

CREATE TABLE `bookmark` (
  `user_id` int(5) NOT NULL,
  `reference_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `reference`
--

CREATE TABLE `reference` (
  `reference_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `word` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `definition` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `reply`
--

CREATE TABLE `reply` (
  `reference_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(5) NOT NULL,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `bookmark`
--
ALTER TABLE `bookmark`
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `reference_id` (`reference_id`) USING BTREE;

--
-- テーブルのインデックス `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`reference_id`),
  ADD KEY `reference_user_id` (`user_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- テーブルのインデックス `reply`
--
ALTER TABLE `reply`
  ADD KEY `reply_user_id` (`user_id`),
  ADD KEY `reply_reference_id` (`reference_id`);

--
-- テーブルのインデックス `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`mail`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `reference`
--
ALTER TABLE `reference`
  MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `bookmark_referrence_id` FOREIGN KEY (`reference_id`) REFERENCES `reference` (`reference_id`),
  ADD CONSTRAINT `bookmark_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- テーブルの制約 `reference`
--
ALTER TABLE `reference`
  ADD CONSTRAINT `reference_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`);

--
-- テーブルの制約 `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_reference_id` FOREIGN KEY (`reference_id`) REFERENCES `reference` (`reference_id`),
  ADD CONSTRAINT `reply_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
 -->