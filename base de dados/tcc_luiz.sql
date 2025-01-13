-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Jan-2025 às 18:28
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc_luiz`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `encontro`
--

DROP TABLE IF EXISTS `encontro`;
CREATE TABLE IF NOT EXISTS `encontro` (
  `id_encontro` int NOT NULL AUTO_INCREMENT,
  `horario` time DEFAULT NULL,
  `data` date DEFAULT NULL,
  `fk_id_projeto` int DEFAULT NULL,
  PRIMARY KEY (`id_encontro`),
  KEY `fk_encontro_projeto_id_projeto` (`fk_id_projeto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `encontro`
--

INSERT INTO `encontro` (`id_encontro`, `horario`, `data`, `fk_id_projeto`) VALUES
(1, '17:25:00', '2025-01-14', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia`
--

DROP TABLE IF EXISTS `frequencia`;
CREATE TABLE IF NOT EXISTS `frequencia` (
  `id_frequencia` int NOT NULL AUTO_INCREMENT,
  `fk_id_encontro` int DEFAULT NULL,
  `fk_usuario_id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id_frequencia`),
  KEY `fk_frequencia_id_encontro` (`fk_id_encontro`),
  KEY `fk_frequencia_usuario_id_usuario` (`fk_usuario_id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `frequencia`
--

INSERT INTO `frequencia` (`id_frequencia`, `fk_id_encontro`, `fk_usuario_id_usuario`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `id_horario` int NOT NULL AUTO_INCREMENT,
  `cod_semana` int DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `fk_projeto_id_projeto` int DEFAULT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `fk_horario_projeto_id_projeto` (`fk_projeto_id_projeto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

DROP TABLE IF EXISTS `projeto`;
CREATE TABLE IF NOT EXISTS `projeto` (
  `id_projeto` int NOT NULL AUTO_INCREMENT,
  `nome_projeto` varchar(255) DEFAULT NULL,
  `situacao` varchar(255) DEFAULT NULL,
  `fk_projeto_id_professor` int DEFAULT NULL,
  PRIMARY KEY (`id_projeto`),
  KEY `fk_projeto_id_professor` (`fk_projeto_id_professor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`id_projeto`, `nome_projeto`, `situacao`, `fk_projeto_id_professor`) VALUES
(2, 'Projeto de xadrez', 'disponivel', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperar_senha`
--

DROP TABLE IF EXISTS `recuperar_senha`;
CREATE TABLE IF NOT EXISTS `recuperar_senha` (
  `id_recuperar_senha` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `token` char(100) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `usado` tinyint DEFAULT NULL,
  PRIMARY KEY (`id_recuperar_senha`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `usuario_tipo` int NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `usuario_tipo`) VALUES
(2, 'Luiz Guilherme', 'luiz.2022310970@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$V25hMnJzUklIR05keGVVSQ$58rXhK/pFqDYK8d7Wtwft0I3q69XaBCDLwo8yZQzP6I', 1),
(3, 'Jeverson', 'jeverson.2022311922@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$cTRKalhLNURrWHB0LlJJeg$NV5R+vwpSsZsamyex6WertFw2IsHrrplu5PaHxg+ACc', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_projeto`
--

DROP TABLE IF EXISTS `usuario_projeto`;
CREATE TABLE IF NOT EXISTS `usuario_projeto` (
  `fk_usuario_id_usuario` int DEFAULT NULL,
  `fk_projeto_id_projeto` int DEFAULT NULL,
  KEY `fk_usuario_id_usuario` (`fk_usuario_id_usuario`),
  KEY `fk_projeto_id_projeto` (`fk_projeto_id_projeto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario_projeto`
--

INSERT INTO `usuario_projeto` (`fk_usuario_id_usuario`, `fk_projeto_id_projeto`) VALUES
(3, 2);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `encontro`
--
ALTER TABLE `encontro`
  ADD CONSTRAINT `fk_encontro_projeto_id_projeto` FOREIGN KEY (`fk_id_projeto`) REFERENCES `projeto` (`id_projeto`);

--
-- Limitadores para a tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD CONSTRAINT `fk_frequencia_id_encontro` FOREIGN KEY (`fk_id_encontro`) REFERENCES `encontro` (`id_encontro`),
  ADD CONSTRAINT `fk_frequencia_usuario_id_usuario` FOREIGN KEY (`fk_usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_horario_projeto_id_projeto` FOREIGN KEY (`fk_projeto_id_projeto`) REFERENCES `projeto` (`id_projeto`);

--
-- Limitadores para a tabela `projeto`
--
ALTER TABLE `projeto`
  ADD CONSTRAINT `fk_projeto_id_professor` FOREIGN KEY (`fk_projeto_id_professor`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `usuario_projeto`
--
ALTER TABLE `usuario_projeto`
  ADD CONSTRAINT `fk_projeto_id_projeto` FOREIGN KEY (`fk_projeto_id_projeto`) REFERENCES `projeto` (`id_projeto`),
  ADD CONSTRAINT `fk_usuario_id_usuario` FOREIGN KEY (`fk_usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
