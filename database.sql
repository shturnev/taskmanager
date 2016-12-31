-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.13 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.3.0.5107
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица taskManager.forTest
CREATE TABLE IF NOT EXISTS `forTest` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '0',
  `date` bigint(15) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.
-- Дамп структуры для таблица taskManager.invites
CREATE TABLE IF NOT EXISTS `invites` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `date` bigint(15) NOT NULL DEFAULT '0',
  `for_email` varchar(255) NOT NULL DEFAULT '0',
  `from_user_id` int(6) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0 - ожидается, 1 - принято, 2 -отклонен',
  `delete_1` int(2) NOT NULL DEFAULT '0',
  `delete_2` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `FK_invites_users_2` (`from_user_id`),
  KEY `FK_invites_users` (`for_email`),
  CONSTRAINT `FK_invites_users_2` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.
-- Дамп структуры для таблица taskManager.task
CREATE TABLE IF NOT EXISTS `task` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(6) NOT NULL DEFAULT '0',
  `for_user_id` int(6) NOT NULL DEFAULT '0',
  `date_created` bigint(15) NOT NULL DEFAULT '0',
  `date_deadline` bigint(15) DEFAULT '0',
  `date_finished` bigint(15) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0' COMMENT 'в случае если удалил приглашенный',
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`ID`),
  KEY `FK_task_users` (`from_user_id`),
  KEY `FK_task_users_2` (`for_user_id`),
  CONSTRAINT `FK_task_users` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_task_users_2` FOREIGN KEY (`for_user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.
-- Дамп структуры для таблица taskManager.users
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(7) NOT NULL AUTO_INCREMENT,
  `date` bigint(15) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `pass` varchar(255) NOT NULL DEFAULT '0',
  `confirm_email` int(2) NOT NULL DEFAULT '0',
  `token` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
