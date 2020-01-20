-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Darbinė stotis: localhost
-- Atlikimo laikas: 2019 m. Grd 11 d. 12:21
-- Serverio versija: 1.0.35
-- PHP versija: 5.6.37-1~dotdeb+zts+7.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Duomenų bazė: `erisni1`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `kursaikursantai`
--

CREATE TABLE IF NOT EXISTS `kursaikursantai` (
  `coursesID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`),
  KEY `coursesID` (`coursesID`) USING BTREE,
  KEY `usersID` (`usersID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

--
-- Sukurta duomenų kopija lentelei `kursaikursantai`
--

INSERT INTO `kursaikursantai` (`coursesID`, `usersID`, `ID`) VALUES
(3, 35, 84),
(4, 35, 85),
(2, 35, 86),
(1, 36, 87),
(2, 36, 88),
(3, 36, 89),
(4, 36, 90),
(4, 38, 91);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `kursaimano`
--

CREATE TABLE IF NOT EXISTS `kursaimano` (
  `name` varchar(50) NOT NULL,
  `notes` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `date` date NOT NULL,
  `price` double NOT NULL,
  `capacity` int(11) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Sukurta duomenų kopija lentelei `kursaimano`
--

INSERT INTO `kursaimano` (`name`, `notes`, `date`, `price`, `capacity`, `ID`) VALUES
('Coding', 'Coding programe for beginers', '2017-11-02', 100.36, 0, 1),
('Economics', 'For fist course students', '2016-11-02', 2.3, 4, 2),
('Music production', 'This course is only for music lovers', '2025-04-03', 12.54, 19, 3),
('Naujienas', 'Naujas kursas', '2030-11-30', 1888.58, 20, 4),
('IT projektas', 'IT projektas smagus, naudingas, bet labai daug laiko atimantis darbas', '1998-08-31', 999.99, 0, 6),
('Signalai', 'Signalu 5 semetro kursas', '2020-12-01', 99.99, 36, 16),
('Imones', 'Imones 5 semetro kursas', '2026-09-09', 119.99, 15, 17),
('Komandinis darbas', 'Komandinis darbas skirtas dirbti grupemis ir kurti bendrus projektus', '2019-12-12', 19.57, 87, 18),
('Sauga', 'Saugos modulis yra labai reiksmingas ateities vizijai vystyti', '2019-12-12', 999.99, 0, 19),
('Kurselis', 'Naujas kursas testavimui', '2020-02-02', 11.99, 0, 21),
('Ä…Ä…Ä…Ä…', 'Ä…Ä…Ä…Ä…', '2018-08-30', 111, 10, 22);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `usersmano`
--

CREATE TABLE IF NOT EXISTS `usersmano` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `userid` int(50) NOT NULL AUTO_INCREMENT,
  `userlevel` varchar(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Sukurta duomenų kopija lentelei `usersmano`
--

INSERT INTO `usersmano` (`username`, `password`, `userid`, `userlevel`, `email`, `name`) VALUES
('Studentas', '74216f3e15c761ee1a5e255f06795362', 35, '3', 'studentas@gmail.com', 'Erikas'),
('Lektorius', '74216f3e15c761ee1a5e255f06795362', 36, '2', 'Lektorius@gmail.com', 'Erikas'),
('Admin', '74216f3e15c761ee1a5e255f06795362', 37, '1', 'Admin@gmail.com', 'Erikas'),
('a', '588ba39fa4e0ff9d82b3772363af9099', 38, '2', 'sdd@aa.com', 'a'),
('Lektorius1', '74216f3e15c761ee1a5e255f06795362', 39, '2', 'Lektorinis@gmail.com', 'Erikas');

--
-- Apribojimai eksportuotom lentelėm
--

--
-- Apribojimai lentelei `kursaikursantai`
--
ALTER TABLE `kursaikursantai`
  ADD CONSTRAINT `KursaiKursantai_ibfk_1` FOREIGN KEY (`coursesID`) REFERENCES `kursaimano` (`ID`),
  ADD CONSTRAINT `KursaiKursantai_ibfk_2` FOREIGN KEY (`usersID`) REFERENCES `usersmano` (`userid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
