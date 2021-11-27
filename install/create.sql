-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 19. Nov 2019 um 22:09
-- Server-Version: 5.7.28-0ubuntu0.16.04.2
-- PHP-Version: 7.0.33-0ubuntu0.16.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `zzapapp3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `group`
--

CREATE TABLE `group` (
  `id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `group`
--

INSERT INTO `group` (`id`, `active`, `protected`, `name`, `description`) VALUES
(1, 1, 1, 'Administrator', 'System Administrator'),
(2, 1, 0, 'Operator', 'Operator'),
(3, 1, 0, 'Moderator', 'Moderator'),
(4, 1, 0, 'Premium', 'Premium User'),
(5, 1, 0, 'User', 'Basic User'),
(6, 1, 1, 'Guest', 'Guest');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `handle` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `language` varchar(2) NOT NULL DEFAULT 'en',
  `country` varchar(2) NOT NULL DEFAULT 'us',
  `email` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `confirmed` datetime DEFAULT NULL,
  `confirmcode` varchar(8) NOT NULL,
  `lastlogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `active`, `handle`, `password`, `language`, `country`, `email`, `created`, `confirmed`, `confirmcode`, `lastlogin`) VALUES
(1, 1, 'admin', 'dba06b2cd23e59fbdf28b9796e8bfa15d02394a5b460770d64e9295438613b58', 'de', 'de', 'your.name@domain.com', '2021-11-27 00:00:00', '2019-11-19 00:00:00', '', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_has_group`
--

CREATE TABLE `user_has_group` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user_has_group`
--

INSERT INTO `user_has_group` (`user_id`, `group_id`) VALUES
(1, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_has_group`
--
ALTER TABLE `user_has_group`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `group`
--
ALTER TABLE `group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `user_has_group`
--
ALTER TABLE `user_has_group`
    ADD CONSTRAINT `fk_uhg_group_id` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
    ADD CONSTRAINT `fk_uhg_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

