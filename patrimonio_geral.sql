-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25-Ago-2015 às 22:12
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bd_viacampus`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `patrimonio_geral`
--

CREATE TABLE IF NOT EXISTS `patrimonio_geral` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `matricula` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` double NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `oculto` int(11) NOT NULL,
  `controle` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `patrimonio_geral`
--

INSERT INTO `patrimonio_geral` (`id`, `id_empresa`, `nome`, `matricula`, `quantidade`, `valor`, `descricao`, `marca`, `oculto`, `controle`) VALUES
(21, 6, 'Marreta', 'M-123', 123, 0, 'Marreta de bater prego', 'Excelente', 0, 0),
(22, 5, 'Marreta', 'm-123', 10, 25, 'Marreta de bater prego', 'Excelente', 0, 0),
(23, 5, 'Cortadora de grama', 'M-223', 2, 234.23, 'Maquina para cortar grama e aparar a 3 cm', 'Ruim', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patrimonio_geral`
--
ALTER TABLE `patrimonio_geral`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patrimonio_geral`
--
ALTER TABLE `patrimonio_geral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
