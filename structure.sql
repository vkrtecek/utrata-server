-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 14. úno 2018, 01:23
-- Verze serveru: 10.1.25-MariaDB
-- Verze PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `test`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `utrata_check_states`
--

CREATE TABLE `utrata_check_states` (
  `CheckStateID` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'karta',
  `checked` datetime NOT NULL,
  `value` double NOT NULL,
  `WalletID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `utrata_currencies`
--

CREATE TABLE `utrata_currencies` (
  `CurrencyID` int(11) NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `utrata_items`
--

CREATE TABLE `utrata_items` (
  `ItemID` bigint(20) NOT NULL,
  `mainName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL,
  `course` double NOT NULL DEFAULT '1',
  `date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'karta',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `income` tinyint(1) NOT NULL DEFAULT '0',
  `vyber` tinyint(1) NOT NULL DEFAULT '0',
  `odepsat` tinyint(1) NOT NULL DEFAULT '0',
  `PurposeID` int(11) DEFAULT NULL,
  `CurrencyID` int(11) NOT NULL,
  `WalletID` int(11) NOT NULL,
  `MemberID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `utrata_languages`
--

CREATE TABLE `utrata_languages` (
  `LanguageCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `utrata_memberpurposes`
--

CREATE TABLE `utrata_memberpurposes` (
  `MemberPurposeID` int(11) NOT NULL,
  `PurposeID` int(11) NOT NULL,
  `MemberID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `utrata_members`
--

CREATE TABLE `utrata_members` (
  `MemberID` bigint(20) NOT NULL,
  `firstName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwordHash` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sendMonthly` tinyint(1) NOT NULL DEFAULT '1',
  `sendByOne` tinyint(1) NOT NULL DEFAULT '0',
  `motherMail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `myMail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `logged` int(11) NOT NULL DEFAULT '0',
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '2015-09-01 00:00:00',
  `facebook` tinyint(1) NOT NULL DEFAULT '0',
  `access` datetime DEFAULT NULL,
  `LanguageCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CurrencyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `utrata_purposes`
--

CREATE TABLE `utrata_purposes` (
  `PurposeID` int(11) NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base` tinyint(1) NOT NULL DEFAULT '0',
  `LanguageCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CreatorID` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `utrata_translations`
--

CREATE TABLE `utrata_translations` (
  `TranslationCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LanguageCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `utrata_wallets`
--

CREATE TABLE `utrata_wallets` (
  `WalletID` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `MemberID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `utrata_check_states`
--
ALTER TABLE `utrata_check_states`
  ADD PRIMARY KEY (`CheckStateID`),
  ADD KEY `utrata_check_states_walletid_foreign` (`WalletID`);

--
-- Klíče pro tabulku `utrata_currencies`
--
ALTER TABLE `utrata_currencies`
  ADD PRIMARY KEY (`CurrencyID`);

--
-- Klíče pro tabulku `utrata_items`
--
ALTER TABLE `utrata_items`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `utrata_items_purposeid_foreign` (`PurposeID`),
  ADD KEY `utrata_items_currencyid_foreign` (`CurrencyID`),
  ADD KEY `utrata_items_walletid_foreign` (`WalletID`),
  ADD KEY `utrata_items_memberid_foreign` (`MemberID`);

--
-- Klíče pro tabulku `utrata_languages`
--
ALTER TABLE `utrata_languages`
  ADD PRIMARY KEY (`LanguageCode`);

--
-- Klíče pro tabulku `utrata_memberpurposes`
--
ALTER TABLE `utrata_memberpurposes`
  ADD PRIMARY KEY (`MemberPurposeID`),
  ADD KEY `utrata_memberpurposes_purposeid_foreign` (`PurposeID`),
  ADD KEY `utrata_memberpurposes_memberid_foreign` (`MemberID`);

--
-- Klíče pro tabulku `utrata_members`
--
ALTER TABLE `utrata_members`
  ADD PRIMARY KEY (`MemberID`),
  ADD UNIQUE KEY `utrata_members_login_unique` (`login`),
  ADD KEY `utrata_members_languagecode_foreign` (`LanguageCode`),
  ADD KEY `utrata_members_currencyid_foreign` (`CurrencyID`);

--
-- Klíče pro tabulku `utrata_purposes`
--
ALTER TABLE `utrata_purposes`
  ADD PRIMARY KEY (`PurposeID`),
  ADD KEY `utrata_purposes_languagecode_foreign` (`LanguageCode`),
  ADD KEY `utrata_purposes_creatorid_foreign` (`CreatorID`);

--
-- Klíče pro tabulku `utrata_translations`
--
ALTER TABLE `utrata_translations`
  ADD PRIMARY KEY (`TranslationCode`,`LanguageCode`),
  ADD KEY `utrata_translations_languagecode_foreign` (`LanguageCode`);

--
-- Klíče pro tabulku `utrata_wallets`
--
ALTER TABLE `utrata_wallets`
  ADD PRIMARY KEY (`WalletID`),
  ADD KEY `utrata_wallets_memberid_foreign` (`MemberID`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `utrata_check_states`
--
ALTER TABLE `utrata_check_states`
  MODIFY `CheckStateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pro tabulku `utrata_currencies`
--
ALTER TABLE `utrata_currencies`
  MODIFY `CurrencyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `utrata_items`
--
ALTER TABLE `utrata_items`
  MODIFY `ItemID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1515;
--
-- AUTO_INCREMENT pro tabulku `utrata_memberpurposes`
--
ALTER TABLE `utrata_memberpurposes`
  MODIFY `MemberPurposeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pro tabulku `utrata_members`
--
ALTER TABLE `utrata_members`
  MODIFY `MemberID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pro tabulku `utrata_purposes`
--
ALTER TABLE `utrata_purposes`
  MODIFY `PurposeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pro tabulku `utrata_wallets`
--
ALTER TABLE `utrata_wallets`
  MODIFY `WalletID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `utrata_check_states`
--
ALTER TABLE `utrata_check_states`
  ADD CONSTRAINT `utrata_check_states_walletid_foreign` FOREIGN KEY (`WalletID`) REFERENCES `utrata_wallets` (`WalletID`);

--
-- Omezení pro tabulku `utrata_items`
--
ALTER TABLE `utrata_items`
  ADD CONSTRAINT `utrata_items_currencyid_foreign` FOREIGN KEY (`CurrencyID`) REFERENCES `utrata_currencies` (`CurrencyID`),
  ADD CONSTRAINT `utrata_items_memberid_foreign` FOREIGN KEY (`MemberID`) REFERENCES `utrata_members` (`MemberID`),
  ADD CONSTRAINT `utrata_items_purposeid_foreign` FOREIGN KEY (`PurposeID`) REFERENCES `utrata_purposes` (`PurposeID`),
  ADD CONSTRAINT `utrata_items_walletid_foreign` FOREIGN KEY (`WalletID`) REFERENCES `utrata_wallets` (`WalletID`);

--
-- Omezení pro tabulku `utrata_memberpurposes`
--
ALTER TABLE `utrata_memberpurposes`
  ADD CONSTRAINT `utrata_memberpurposes_memberid_foreign` FOREIGN KEY (`MemberID`) REFERENCES `utrata_members` (`MemberID`),
  ADD CONSTRAINT `utrata_memberpurposes_purposeid_foreign` FOREIGN KEY (`PurposeID`) REFERENCES `utrata_purposes` (`PurposeID`);

--
-- Omezení pro tabulku `utrata_members`
--
ALTER TABLE `utrata_members`
  ADD CONSTRAINT `utrata_members_currencyid_foreign` FOREIGN KEY (`CurrencyID`) REFERENCES `utrata_currencies` (`CurrencyID`),
  ADD CONSTRAINT `utrata_members_languagecode_foreign` FOREIGN KEY (`LanguageCode`) REFERENCES `utrata_languages` (`LanguageCode`);

--
-- Omezení pro tabulku `utrata_purposes`
--
ALTER TABLE `utrata_purposes`
  ADD CONSTRAINT `utrata_purposes_creatorid_foreign` FOREIGN KEY (`CreatorID`) REFERENCES `utrata_members` (`MemberID`),
  ADD CONSTRAINT `utrata_purposes_languagecode_foreign` FOREIGN KEY (`LanguageCode`) REFERENCES `utrata_languages` (`LanguageCode`);

--
-- Omezení pro tabulku `utrata_translations`
--
ALTER TABLE `utrata_translations`
  ADD CONSTRAINT `utrata_translations_languagecode_foreign` FOREIGN KEY (`LanguageCode`) REFERENCES `utrata_languages` (`LanguageCode`);

--
-- Omezení pro tabulku `utrata_wallets`
--
ALTER TABLE `utrata_wallets`
  ADD CONSTRAINT `utrata_wallets_memberid_foreign` FOREIGN KEY (`MemberID`) REFERENCES `utrata_members` (`MemberID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
