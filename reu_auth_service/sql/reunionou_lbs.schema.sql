-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mer. 05 avr. 2023 à 14:42
-- Version du serveur : 10.10.2-MariaDB-1:10.10.2+maria~ubu2204
-- Version de PHP : 8.1.17

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reunionou_lbs`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment`
(
    `id`         uuid         NOT NULL DEFAULT uuid(),
    `content`    varchar(255) NOT NULL,
    `event_id`   uuid         NOT NULL,
    `invited_id` uuid                  DEFAULT NULL,
    `user_name`  varchar(255)          DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event`
(
    `id`          uuid         NOT NULL DEFAULT uuid(),
    `title`       varchar(255) NOT NULL,
    `description` varchar(255)          DEFAULT NULL,
    `lieu`        varchar(255) NOT NULL,
    `date`        datetime     NOT NULL,
    `status`      varchar(255) NOT NULL,
    `user_id`     uuid         NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

CREATE TABLE `invitation`
(
    `id`              uuid        NOT NULL DEFAULT uuid(),
    `invitation_date` datetime    NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp (),
    `invited_id`      uuid                 DEFAULT NULL,
    `event_id`        uuid                 DEFAULT NULL,
    `status`          varchar(50) NOT NULL DEFAULT 'en attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user`
(
    `id`            uuid         NOT NULL DEFAULT uuid(),
    `name`          varchar(128) NOT NULL,
    `firstname`     varchar(128) NOT NULL,
    `email`         varchar(255) NOT NULL,
    `password`      varchar(128) NOT NULL,
    `status`        varchar(255)          DEFAULT NULL,
    `refresh_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Index pour les tables déchargées
--

-- --------------------------------------------------------

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
    ADD PRIMARY KEY (`id`),
    ADD KEY `event_id` (`event_id`),
    ADD KEY `invited_id` (`invited_id`) USING BTREE;

--
-- Index pour la table `event`
--
ALTER TABLE `event`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `invitation`
--
ALTER TABLE `invitation`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `unique_invitation` (`invited_id`,`event_id`),
    ADD KEY `event_id` (`event_id`),
    ADD KEY `invited_id` (`invited_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

--
-- Contraintes pour les tables déchargées
--

-- --------------------------------------------------------

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
    ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
    ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`invited_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
    ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `invitation`
--
ALTER TABLE `invitation`
    ADD CONSTRAINT `invitation_ibfk_1` FOREIGN KEY (`invited_id`) REFERENCES `user` (`id`),
    ADD CONSTRAINT `invitation_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;