-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 27-Jan-2025 às 22:12
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
  `CH` int DEFAULT NULL,
  `data` date DEFAULT NULL,
  `fk_id_projeto` int DEFAULT NULL,
  PRIMARY KEY (`id_encontro`),
  KEY `fk_encontro_projeto_id_projeto` (`fk_id_projeto`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `encontro`
--

INSERT INTO `encontro` (`id_encontro`, `CH`, `data`, `fk_id_projeto`) VALUES
(19, 2, '2025-01-15', 16),
(23, 3, '2025-01-12', 16),
(24, 3, '2025-01-23', 24),
(25, 6, '2025-01-28', 24),
(26, 2, '2025-01-14', 24),
(27, 2, '2025-01-23', 24),
(29, 3, '2025-01-28', 25),
(30, 4444, '2025-01-08', 25);

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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `frequencia`
--

INSERT INTO `frequencia` (`id_frequencia`, `fk_id_encontro`, `fk_usuario_id_usuario`) VALUES
(69, 19, 3),
(70, 23, 3),
(81, 24, 17),
(82, 29, 4),
(83, 30, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `monitor_projeto`
--

DROP TABLE IF EXISTS `monitor_projeto`;
CREATE TABLE IF NOT EXISTS `monitor_projeto` (
  `id_usuario_projeto` int NOT NULL AUTO_INCREMENT,
  `fk_id_usuario` int NOT NULL,
  `fk_id_projeto` int NOT NULL,
  PRIMARY KEY (`id_usuario_projeto`),
  KEY `fk_id_usuario_monitor` (`fk_id_usuario`),
  KEY `fk_id_projeto_monitor` (`fk_id_projeto`)
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
  `data_finalizacao` date NOT NULL,
  `id_monitor` int NOT NULL,
  PRIMARY KEY (`id_projeto`),
  KEY `fk_projeto_id_professor` (`fk_projeto_id_professor`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`id_projeto`, `nome_projeto`, `situacao`, `fk_projeto_id_professor`, `data_finalizacao`, `id_monitor`) VALUES
(16, 'Projeto de linguagem', 'Inativo', 9, '0000-00-00', 0),
(22, 'Projeto de Ingles', 'Ativo', 9, '0000-00-00', 0),
(24, 'projeto de poker', 'Inativo', 9, '2025-01-27', 0),
(25, 'Projeto de Xadrez', 'Ativo', 9, '0000-00-00', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `recuperar_senha`
--

INSERT INTO `recuperar_senha` (`id_recuperar_senha`, `email`, `token`, `data_criacao`, `usado`) VALUES
(1, 'luiz.2022310970@aluno.iffar.edu.br', '1e1c5277fd292289153bdf6295059bdb5c1d96ac92762b6e3c61d1e065cd1bb7353331393f1e4cfeac9b7aec69635c396d05', '2025-01-17 08:57:12', 0),
(2, 'luiz.2022310970@aluno.iffar.edu.br', '83e6af5e74c6ddfe5cce54e5e160334a8fa72ac912f0484fed5aa297bfb8e451df328b1dd5370b8684a5e04f8b311c581223', '2025-01-18 16:18:23', 0),
(3, 'luiz.2022310970@aluno.iffar.edu.br', '04de8b870ea379fae2939181b70cc5bef20366311d2ad67fb695523b0a892e0180356671d583b416f2816a812f1379dff6f0', '2025-01-18 16:27:40', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `usuario_tipo`) VALUES
(3, 'Jeverson', 'jeverson.2022311922@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$cTRKalhLNURrWHB0LlJJeg$NV5R+vwpSsZsamyex6WertFw2IsHrrplu5PaHxg+ACc', 2),
(4, 'Roberto Graziadei', 'roberto.2022315930@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$Z1k5aXEzZXlEYlRaQ29oYw$NA7P8SlNwOdGxIGfqeTL/aiUm0zovcmtHJ8civQDJdw', 3),
(9, 'Luiz Guilherme', 'luiz.2022310970@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$Q3ZNM0JDOW5jaVZJYzB2Yw$PijhV7DLf8QjGZyW6LciwX5Ac36hOZH/2ZSQhgzTEpc', 1),
(17, 'feijao', 'luiz@luiz', '$argon2i$v=19$m=65536,t=4,p=1$d1lmNkJJNlRweXFDWFJZcg$rbssj12HTisyVUOYfmeZe4derQjK9BxeXxrQpfrGY8U', 3),
(18, 'Luiz Guilherme', '123@123', '$argon2i$v=19$m=65536,t=4,p=1$d3loM3FqOWxyVGxuOXhQZw$73MAKWUqB6XecO7btyoinCCx+xAmHNpbrIdP+7cwuew', 3),
(19, 'fabricio', 'fabricio@fabricio', '$argon2i$v=19$m=65536,t=4,p=1$RGQwREJ2UkYyMElhV3phZg$IgNr+KOSpulQndwdXeF7+gzRAGH5sJAp64Z081UBflw', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_projeto`
--

DROP TABLE IF EXISTS `usuario_projeto`;
CREATE TABLE IF NOT EXISTS `usuario_projeto` (
  `fk_usuario_id_usuario` int DEFAULT NULL,
  `fk_projeto_id_projeto` int DEFAULT NULL,
  `id_inscricao` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_inscricao`),
  KEY `fk_usuario_id_usuario` (`fk_usuario_id_usuario`),
  KEY `fk_projeto_id_projeto` (`fk_projeto_id_projeto`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario_projeto`
--

INSERT INTO `usuario_projeto` (`fk_usuario_id_usuario`, `fk_projeto_id_projeto`, `id_inscricao`) VALUES
(3, 16, 27),
(17, 24, 30),
(18, 24, 31),
(19, 24, 33),
(19, 22, 34),
(4, 25, 35);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `encontro`
--
ALTER TABLE `encontro`
  ADD CONSTRAINT `fk_encontro_projeto_id_projeto` FOREIGN KEY (`fk_id_projeto`) REFERENCES `projeto` (`id_projeto`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD CONSTRAINT `fk_frequencia_id_encontro` FOREIGN KEY (`fk_id_encontro`) REFERENCES `encontro` (`id_encontro`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_frequencia_usuario_id_usuario` FOREIGN KEY (`fk_usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `monitor_projeto`
--
ALTER TABLE `monitor_projeto`
  ADD CONSTRAINT `fk_id_projeto_monitor` FOREIGN KEY (`fk_id_projeto`) REFERENCES `projeto` (`id_projeto`),
  ADD CONSTRAINT `fk_id_usuario_monitor` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `projeto`
--
ALTER TABLE `projeto`
  ADD CONSTRAINT `fk_projeto_id_professor` FOREIGN KEY (`fk_projeto_id_professor`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `usuario_projeto`
--
ALTER TABLE `usuario_projeto`
  ADD CONSTRAINT `fk_projeto_id_projeto` FOREIGN KEY (`fk_projeto_id_projeto`) REFERENCES `projeto` (`id_projeto`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usuario_id_usuario` FOREIGN KEY (`fk_usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
