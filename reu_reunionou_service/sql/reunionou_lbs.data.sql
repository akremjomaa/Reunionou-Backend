-- phpmyadmin 4.8.1 MySQL 5.5.5-10.10.2-MariaDB-1:10.10.2+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `user` (`id`, `name`, `firstname`, `email`, `password`, `status`)
VALUES (1, 'Jomaa', 'Akrem', 'akrem@gmail.com', 'akrem', 1),
       (2, 'Zidane', 'Wail', 'wail@gmail.com', 'wail', NULL),
       (3, 'Boulhdir', 'khaoula', 'khaoula@gmail.com', 'khaoula', NULL),
       (4, 'Six', 'leo', 'leo@gmail.com', 'leo', NULL),
       (5, 'please come', 'we gonna eat churros', ' parc de la pepiniere', '2023-03-10 02:55:07', NULL),
       (6, 'please cssome', 'we gonna eat churros', ' parc de la pepiniere', '2023-03-10 02:55:07', NULL),
       (7, 'plssease cssome', 'we gonna eat churros', ' parc de la pepiniere', '2023-03-10 02:55:07', NULL),
       (8, 'a', 'e', 'a@gmail.com', 'a', NULL);

INSERT INTO `event` (`id`, `title`, `description`, `lieu`, `date`, `status`, `user_id`) VALUES
(1,	'anniversaire Wail',	'ho ho ',	'IUT charlemagne',	'2019-03-10 02:55:05',	1,	2),
(2,	'Le weekend !',	"c\'est le weekend !", 'supermarche match', '2023-03-10 02:55:07', 0, 3),
       (3, 'please come', 'we gonna eat churros', ' parc de la pepiniere', '2023-03-10 02:55:07', 1, 3),
       (4, 'please come', 'we gonna eat churros', ' parc de la pepiniere', '2023-03-10 02:55:07', 1, 3),
       (5, 'please come', 'we gonna eat churros', ' parc de la pepiniere', '2023-03-10 02:55:07', 1, 3),
       (6, 'please come', 'we gonna eat churros', ' parc de la pepiniere', '2023-03-10 02:55:07', 1, 3),
       (7, 'please come', 'we gonna eat churros', ' parc de la pepiniere', '2023-03-10 02:55:07', 1, 3);

INSERT INTO `comment` (`id`, `content`, `event_id`, `user_id`, `user_name`)
VALUES (1, "ho ho je suis excite pour l\'anniversaire de Wail",	1,	1,	NULL),
       (2,	'cant wait !',	1,	3,	NULL);

INSERT INTO `invitation` (`id`, `date`, `status`, `user_id`, `event_id`)
VALUES (1, '2019-03-10 02:55:05', 1, 4, 1),
       (2, '2023-03-10 02:55:07', NULL, 2, 1),
       (3, '2023-03-10 02:55:07', NULL, 2, 1);

-- 2023-03-29 14:02:26
