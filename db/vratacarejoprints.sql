-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29-Abr-2022 às 22:57
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vratacarejoprints`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `databaseconfiguration`
--

CREATE TABLE IF NOT EXISTS `databaseconfiguration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(20) NOT NULL,
  `port` varchar(10) NOT NULL,
  `dbname` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `databaseconfiguration`
--

INSERT INTO `databaseconfiguration` (`id`, `host`, `port`, `dbname`, `user`, `password`) VALUES
(1, '192.168.1.149', '38561', 'vr_bonejao', 'upbackup', 'upbackup');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pdv`
--

CREATE TABLE IF NOT EXISTS `pdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ecf` int(10) NOT NULL,
  `printeraddress` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `pdv`
--

INSERT INTO `pdv` (`id`, `ecf`, `printeraddress`) VALUES
(1, 101, '//192.168.1.149/ELGINi9'),
(2, 102, '//192.168.1.148/ELGINi9');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
