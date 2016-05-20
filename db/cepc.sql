-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 18/05/2016 às 16:46
-- Versão do servidor: 5.6.28-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `cepc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anexo`
--

CREATE TABLE IF NOT EXISTS `anexo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `declaracao`
--

CREATE TABLE IF NOT EXISTS `declaracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `tipo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `declaracoes`
--

CREATE TABLE IF NOT EXISTS `declaracoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `idusuario` int(11) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `nascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `orgao` varchar(30) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `fixo` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `segmento` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `resuldatotriagem`
--

CREATE TABLE IF NOT EXISTS `resuldatotriagem` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `segmento` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `segmento`
--

CREATE TABLE IF NOT EXISTS `segmento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `textos`
--

CREATE TABLE IF NOT EXISTS `textos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `curriculo` text NOT NULL,
  `proposta` text NOT NULL,
  `justificativa` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `triagem`
--

CREATE TABLE IF NOT EXISTS `triagem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `idtriagista` int(11) NOT NULL,
  `texto` text NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `triagista`
--

CREATE TABLE IF NOT EXISTS `triagista` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `status`) VALUES
(1, 'companhiagr@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', -3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `voto`
--

CREATE TABLE IF NOT EXISTS `voto` (
  `id` int(11) NOT NULL,
  `voto` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `segmento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
