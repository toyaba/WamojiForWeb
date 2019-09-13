-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql632.db.sakura.ne.jp
-- Generation Time: 2018 年 9 月 17 日 20:43
-- サーバのバージョン： 5.7.22-log
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wamoji2_wamoji`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `MST_FACILITY`
--

CREATE TABLE `MST_FACILITY` (
  `facility_id` varchar(13) NOT NULL COMMENT '施設ID',
  `password` varchar(256) NOT NULL COMMENT 'パスワード',
  `facility_name` varchar(20) NOT NULL COMMENT '施設名',
  `background_cd_1` int(3) DEFAULT NULL COMMENT '背景コード1',
  `background_cd_2` int(3) DEFAULT NULL COMMENT '背景コード2',
  `background_cd_3` int(3) DEFAULT NULL COMMENT '背景コード3',
  `background_cd_4` int(3) DEFAULT NULL COMMENT '背景コード4',
  `pr_cd` int(3) NOT NULL COMMENT 'PRコード',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='施設マスタ';

-- --------------------------------------------------------

--
-- テーブルの構造 `MST_GOGYO_SHISOU`
--

CREATE TABLE `MST_GOGYO_SHISOU` (
  `gogyo_cd` int(3) NOT NULL COMMENT '五行コード',
  `gogyo_picture` mediumblob NOT NULL COMMENT '五行イメージファイル',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='五行思想マスタ';

-- --------------------------------------------------------

--
-- テーブルの構造 `MST_LANGUAGE`
--

CREATE TABLE `MST_LANGUAGE` (
  `language_cd` int(4) NOT NULL COMMENT '言語区分コード',
  `language_code` varchar(10) NOT NULL COMMENT '言語コード',
  `language_name` varchar(10) NOT NULL COMMENT '言語名',
  `enable_flg` tinyint(1) NOT NULL COMMENT '有効フラグ',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='言語区分マスター';

-- --------------------------------------------------------

--
-- テーブルの構造 `MST_PR`
--

CREATE TABLE `MST_PR` (
  `pr_cd` int(3) NOT NULL COMMENT 'PRコード',
  `pr_picture` mediumblob NOT NULL COMMENT 'PRメージファイル',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='PRマスタ';

-- --------------------------------------------------------

--
-- テーブルの構造 `MST_SYMBOL_IMAGE`
--

CREATE TABLE `MST_SYMBOL_IMAGE` (
  `category_cd` int(3) NOT NULL COMMENT 'カテゴリ区分コード',
  `picture_type_cd` int(3) NOT NULL COMMENT '図種区分コード',
  `item_cd` int(3) NOT NULL COMMENT 'アイテムコード',
  `size_cd` int(2) NOT NULL COMMENT 'サイズ区分コード',
  `font_cd` int(2) NOT NULL COMMENT 'フォント種区分コード',
  `symbol_type_cd` int(4) NOT NULL COMMENT '図柄区分コード',
  `picture_type_name` varchar(20) NOT NULL COMMENT '図柄名',
  `picture` mediumblob NOT NULL COMMENT '図柄ファイル',
  `enable_flg` tinyint(1) NOT NULL COMMENT '有効フラグ',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='図柄イメージマスタ';

-- --------------------------------------------------------

--
-- テーブルの構造 `MST_SYMBOL_TYPE`
--

CREATE TABLE `MST_SYMBOL_TYPE` (
  `category_cd` int(3) NOT NULL COMMENT 'カテゴリ区分コード',
  `picture_type_cd` int(3) NOT NULL COMMENT '図種区分コード',
  `symbol_type_cd` int(4) NOT NULL COMMENT '図柄区分コード',
  `language_cd` int(4) NOT NULL COMMENT '言語区分コード',
  `picture_type_name` varchar(20) NOT NULL COMMENT '図柄名',
  `picture` mediumblob COMMENT '図柄ファイル',
  `enable_flg` tinyint(1) NOT NULL COMMENT '有効フラグ',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='図柄区分マスタ';

-- --------------------------------------------------------

--
-- テーブルの構造 `process_log`
--

CREATE TABLE `process_log` (
  `facility_id` varchar(13) NOT NULL COMMENT '施設ID',
  `terminal_id` varchar(14) NOT NULL COMMENT '端末ID',
  `screen_no` varchar(24) NOT NULL COMMENT '画面処理NO',
  `record_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '記録日時',
  `log_level` tinyint(1) NOT NULL COMMENT 'ログレベル',
  `information` mediumtext NOT NULL COMMENT '情報'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='処理ログ';

-- --------------------------------------------------------

--
-- テーブルの構造 `TBL_KANJI_COUNT`
--

CREATE TABLE `TBL_KANJI_COUNT` (
  `kanji` varchar(1) DEFAULT NULL COMMENT '漢字',
  `kanji_count` int(11) DEFAULT NULL COMMENT '漢字使用回数',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='漢字カウントデータテーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `TBL_PRINT_IMAGE`
--

CREATE TABLE `TBL_PRINT_IMAGE` (
  `facility_id` varchar(13) NOT NULL COMMENT '施設ID',
  `order_number` int(9) NOT NULL COMMENT 'サービス処理NO',
  `received_no` int(3) NOT NULL COMMENT '受付番号',
  `input_data` varchar(20) NOT NULL COMMENT '入力文字',
  `wamoji_hiragana` varchar(20) NOT NULL COMMENT 'ひらがな',
  `wamoji_katakana` varchar(20) NOT NULL COMMENT 'カタカナ',
  `wamoji` varchar(20) NOT NULL COMMENT '漢字',
  `sticker_picture` mediumblob COMMENT 'シールイメージファイル',
  `data_picture` mediumblob COMMENT '画像データファイル',
  `add_date` date NOT NULL COMMENT '作成日時',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='印刷イメージテーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `tbl_service_data`
--

CREATE TABLE `tbl_service_data` (
  `order_number` int(9) NOT NULL COMMENT 'サービス処理NO',
  `facility_id` varchar(13) NOT NULL COMMENT '施設ID',
  `terminal_id` varchar(14) NOT NULL COMMENT '端末ID',
  `country_id` varchar(3) DEFAULT 'JPN' COMMENT '国コード',
  `prefecture_cd` int(2) DEFAULT NULL COMMENT '都道府県コード',
  `language_cd` int(4) DEFAULT NULL COMMENT '言語区分コード',
  `category_cd` int(3) DEFAULT NULL COMMENT 'カテゴリ区分コード',
  `size_cd` int(2) DEFAULT NULL COMMENT 'サイズ区分コード',
  `item_cd` int(3) DEFAULT NULL COMMENT 'アイテムコード',
  `charactor_type_cd` tinyint(1) DEFAULT NULL COMMENT '文字種区分コード',
  `input_data` varchar(20) NOT NULL COMMENT '入力文字',
  `wamoji_hiragana` varchar(20) NOT NULL COMMENT 'ひらがな',
  `wamoji_katakana` varchar(20) NOT NULL COMMENT 'カタカナ',
  `wamoji` varchar(20) NOT NULL COMMENT '変換文字',
  `font_cd` int(2) DEFAULT NULL COMMENT 'フォント種コード',
  `picture_type_cd` int(3) DEFAULT NULL COMMENT '図種区分',
  `symbol_type_cd` int(4) NOT NULL COMMENT '図柄区分',
  `gender` int(11) NOT NULL COMMENT '性別',
  `conversion_id` int(11) NOT NULL COMMENT '変換ID',
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '開始日時',
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '終了日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='サービスデータテーブル';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `MST_FACILITY`
--
ALTER TABLE `MST_FACILITY`
  ADD PRIMARY KEY (`facility_id`);

--
-- Indexes for table `MST_GOGYO_SHISOU`
--
ALTER TABLE `MST_GOGYO_SHISOU`
  ADD PRIMARY KEY (`gogyo_cd`);

--
-- Indexes for table `MST_LANGUAGE`
--
ALTER TABLE `MST_LANGUAGE`
  ADD PRIMARY KEY (`language_cd`),
  ADD UNIQUE KEY `language_code` (`language_code`);

--
-- Indexes for table `MST_PR`
--
ALTER TABLE `MST_PR`
  ADD PRIMARY KEY (`pr_cd`);

--
-- Indexes for table `MST_SYMBOL_IMAGE`
--
ALTER TABLE `MST_SYMBOL_IMAGE`
  ADD PRIMARY KEY (`category_cd`,`picture_type_cd`,`item_cd`,`size_cd`,`font_cd`,`symbol_type_cd`);

--
-- Indexes for table `MST_SYMBOL_TYPE`
--
ALTER TABLE `MST_SYMBOL_TYPE`
  ADD PRIMARY KEY (`category_cd`,`picture_type_cd`,`symbol_type_cd`,`language_cd`);

--
-- Indexes for table `TBL_KANJI_COUNT`
--
ALTER TABLE `TBL_KANJI_COUNT`
  ADD UNIQUE KEY `kanji` (`kanji`);

--
-- Indexes for table `TBL_PRINT_IMAGE`
--
ALTER TABLE `TBL_PRINT_IMAGE`
  ADD PRIMARY KEY (`facility_id`,`order_number`);

--
-- Indexes for table `tbl_service_data`
--
ALTER TABLE `tbl_service_data`
  ADD PRIMARY KEY (`order_number`),
  ADD KEY `facility_id` (`facility_id`,`terminal_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
