-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mer. 05 avr. 2023 à 14:42
-- Version du serveur : 10.10.2-MariaDB-1:10.10.2+maria~ubu2204
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reunionou_lbs`
--

-- --------------------------------------------------------

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `firstname`, `email`, `password`, `status`, `refresh_token`) VALUES
    ('4638cbee-d3bd-11ed-94d3-0242ac150002', 'Jomaa', 'Akrem', 'akrem@gmail.com', 'akrem', NULL, ''),
    ('56b13ccd-d3bd-11ed-94d3-0242ac150002', 'Zidane', 'Wail', 'wail@gmail.com', 'wail', NULL, ''),
    ('5f10b33c-d3bd-11ed-94d3-0242ac150002', 'Boulhdir', 'Khaoula', 'khaoula@gmail.com', 'khaoula', NULL, ''),
    ('6552ed43-d3bd-11ed-94d3-0242ac150002', 'Six', 'Léo', 'leo@gmail.com', 'leo', NULL, '');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `lieu`, `date`, `status`, `user_id`) VALUES
    ('87de0726-d3bd-11ed-94d3-0242ac150002', 'examen', 'demo', 'IUT charlemagne', '2023-04-05 12:16:10', 'en attente', '56b13ccd-d3bd-11ed-94d3-0242ac150002');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `invitation`
--

INSERT INTO `invitation` (`id`, `invitation_date`, `invited_id`, `event_id`, `status`) VALUES
    ('d6629875-d3bd-11ed-94d3-0242ac150002', '2023-04-05 14:17:15', '4638cbee-d3bd-11ed-94d3-0242ac150002', '87de0726-d3bd-11ed-94d3-0242ac150002', 'en attente'),
    ('de1ddd64-d3bd-11ed-94d3-0242ac150002', '0000-00-00 00:00:00', '5f10b33c-d3bd-11ed-94d3-0242ac150002', '87de0726-d3bd-11ed-94d3-0242ac150002', 'en attente');

-- --------------------------------------------------------
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
