-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21-Ago-2015 às 20:16
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bd_viacampos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int(11) NOT NULL,
  `matricula` varchar(56) NOT NULL,
  `chassi` varchar(56) NOT NULL,
  `renavam` int(11) NOT NULL,
  `placa` varchar(8) NOT NULL,
  `marca` varchar(56) NOT NULL,
  `modelo` varchar(56) NOT NULL,
  `ano` int(11) NOT NULL,
  `cor` varchar(56) NOT NULL,
  `valor` int(11) NOT NULL,
  `data_compra` date NOT NULL,
  `seguro` int(11) NOT NULL,
  `quilometragem` int(11) NOT NULL,
  `km_inicial` int(20) NOT NULL,
  `tipo_combustivel` varchar(56) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `oculto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
