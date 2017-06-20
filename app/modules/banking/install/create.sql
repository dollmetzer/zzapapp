-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 24. Jan 2017 um 19:04
-- Server Version: 5.5.54-0ubuntu0.14.04.1
-- PHP-Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `zzapapp`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `banking_account`
--

CREATE TABLE IF NOT EXISTS `banking_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` int(10) unsigned NOT NULL,
  `bank_id` int(8) unsigned NOT NULL,
  `iban` varchar(22) NOT NULL,
  `bic` varchar(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `description` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `banking_transaction`
--

CREATE TABLE IF NOT EXISTS `banking_transaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL DEFAULT '0',
  `transaction_date` date NOT NULL DEFAULT '0000-00-00' COMMENT 'Buchungstag',
  `value_day` date NOT NULL DEFAULT '0000-00-00' COMMENT 'Tag der Wertstellung',
  `booking_text` varchar(64) NOT NULL,
  `reason_for_transfer` varchar(255) NOT NULL,
  `recipient` varchar(64) NOT NULL,
  `account` varchar(64) NOT NULL,
  `amount` float NOT NULL,
  `currency` varchar(3) NOT NULL,
  `info` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
