-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 07. Mrz 2017 um 20:41
-- Server Version: 5.5.54-0ubuntu0.14.04.1
-- PHP-Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `zzapapp`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('mail','group','stream','forum') NOT NULL,
  `written` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `read` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `from_id` int(10) unsigned NOT NULL,
  `from` varchar(255) NOT NULL,
  `to_id` int(10) unsigned NOT NULL,
  `to` varchar(255) NOT NULL,
  `subject` varchar(128) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
