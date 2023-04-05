-- phpmyadmin 4.8.1 MySQL 5.5.5-10.10.2-MariaDB-1:10.10.2+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `user` (`id`, `name`, `firstname`, `email`, `password`, `status`, `refresh_token`)
VALUES (1, 'Jomaa', 'Akrem', 'akrem@gmail.com', 'akrem', 1, 'e6241f293534857527c6f8780c6d615c949169d4fa24ae4bd7232f906f664189'),
       (2, 'Zidane', 'Wail', 'wail@gmail.com', 'wail', NULL, 'b4ae387cb269aba5131ac98d61319d147a5367888abb87230dcbe0d34e3b422d'),
       (3, 'Boulhdir', 'khaoula', 'khaoula@gmail.com', 'khaoula', NULL, '4232717e6d7f66c13b68083ef98fb8a022d7371f2e71ec953aa507af0e0788bb'),
       (4, 'Six', 'leo', 'leo@gmail.com', 'leo', NULL, '66a03e4501e40ac9316e4d0a62b272c7703432bb71cf2b476310f7f9580e3622');

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
