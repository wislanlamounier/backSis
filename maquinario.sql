-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25-Ago-2015 às 22:11
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
-- Estrutura da tabela `maquinario`
--

CREATE TABLE IF NOT EXISTS `maquinario` (
  `id` int(11) NOT NULL,
  `matricula` varchar(255) NOT NULL,
  `chassi_nserie` varchar(255) NOT NULL,
  `fabricante` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `cor` varchar(255) NOT NULL,
  `tipo_consumo` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `ano` int(11) NOT NULL,
  `data_compra` date NOT NULL,
  `seguro` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `horimetro_inicial` int(11) NOT NULL,
  `observacao` varchar(255) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `horimetro_final` int(11) NOT NULL,
  `oculto` int(11) NOT NULL,
  `controle` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `maquinario`
--

INSERT INTO `maquinario` (`id`, `matricula`, `chassi_nserie`, `fabricante`, `modelo`, `cor`, `tipo_consumo`, `tipo`, `ano`, `data_compra`, `seguro`, `valor`, `horimetro_inicial`, `observacao`, `id_fornecedor`, `id_empresa`, `id_responsavel`, `horimetro_final`, `oculto`, `controle`) VALUES
(10, 'F_001', '41s65df15', 'New Holand', 'Escavadeira', 'Amarela', 'eletrico', 'escavadeira de pedra', 2015, '2015-08-25', 1, 25000, 465, 'observacao', 51, 5, 18, 0, 0, 0),
(11, 'F_001', '41s65df15', 'New Holand', 'Escavadeira', 'Amarela', 'eletrico', 'escavadeira de pedra', 2015, '2015-08-26', 1, 0, 465, 'observacao', 50, 5, 21, 0, 0, 0),
(12, '3453', '345', 'volvo', 'trator', '345', 'combustivel', '35', 2015, '2015-08-06', 1, 0, 345, '345', 58, 5, 18, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maquinario`
--
ALTER TABLE `maquinario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maquinario`
--
ALTER TABLE `maquinario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
