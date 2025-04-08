-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08/04/2025 às 18:09
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro_imoveis`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis`
--

DROP TABLE IF EXISTS `imoveis`;
CREATE TABLE IF NOT EXISTS `imoveis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `id_contribuinte` int NOT NULL,
  `cep` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_contribuinte` (`id_contribuinte`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `imoveis`
--

INSERT INTO `imoveis` (`id`, `logradouro`, `numero`, `bairro`, `complemento`, `id_contribuinte`, `cep`) VALUES
(16, 'Rua Presidente Lucena', '601', 'Scharlau', 'até 1726/1727', 14, '93120-050'),
(17, 'Avenida Senador Salgado Filho', '666', 'Campina', 'até 1122 - lado par', 17, '93110-351'),
(18, 'Rua Ivoti', '2000', 'Campina', 'nada a declarar', 14, '93130-380'),
(19, 'Avenida Henrique Bier', '777', 'Campina', 'até 918/919', 19, '93130-000'),
(20, 'Rua Independência', '601', 'scharlau', 'nada a declarar', 18, '93040-360'),
(21, 'Rua Dom Pedro I', '777777', 'Rio Branco', 'nada a declarar', 20, '93040-610');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
CREATE TABLE IF NOT EXISTS `pessoas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `nascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `cpf_2` (`cpf`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `telefone` (`telefone`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `nascimento`, `cpf`, `sexo`, `telefone`, `email`) VALUES
(16, 'Amanda bitencurt', '2006-08-19', '341.241.412-41', 'F', '(14) 21414-1241', 'amandabiten@gmail.com'),
(15, 'gabriel puchulo', '2007-04-24', '414.214.124-21', 'M', '(42) 14124-1414', 'gabrielpuchila@gmail.com'),
(14, 'JOAO ANTONIO TIETBOHL SCHMIDT', '2006-06-19', '041.459.670-62', 'M', '(51) 98533-8145', 'joaotietbohl3@gmail.com'),
(17, 'kauan rafaela', '2006-04-02', '666.666.666-66', 'M', '(66) 66666-6666', 'kauan@gmail.com'),
(18, 'Mirelle', '2006-04-02', '447.907.523-23', 'F', '(79) 17456-5474', 'mirelle@gmail.com'),
(19, 'Pamela Talissa', '2006-12-24', '535.353.535-35', 'F', '(53) 25355-3235', 'panelinha@gmail.com'),
(20, 'Arthur rambo juwer', '2008-02-04', '421.412.414-14', 'M', '(12) 41241-4141', 'rambola@gmail.com'),
(21, 'yaspinto', '2006-02-04', '414.214.124-14', 'F', '(41) 24141-2412', 'yaspinto@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema_login`
--

DROP TABLE IF EXISTS `sistema_login`;
CREATE TABLE IF NOT EXISTS `sistema_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `sistema_login`
--

INSERT INTO `sistema_login` (`id`, `email`, `senha`) VALUES
(1, 'joaotietbohl3@gmail.com', 'COCOgamer12'),
(2, 'joaotietbohl2@gmail.com', 'COCOgamer12'),
(3, '218471283@gmail.com', 'COCOgamer12'),
(4, 'panaelinha@gmail.com', 'COCOgamer12'),
(5, 'joaotietbohl69@gmail.com', 'COCOgamer12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
