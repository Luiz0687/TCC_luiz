-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 02-Jan-2025 às 19:12
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
  `fk_id_projeto` int NOT NULL,
  PRIMARY KEY (`id_encontro`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `encontro`
--

INSERT INTO `encontro` (`id_encontro`, `horario`, `data`, `fk_id_projeto`) VALUES
(7, '11:35:00', '2024-11-19', 23),
(16, '16:36:00', '2024-12-18', 14),
(21, '15:02:00', '2024-12-18', 12),
(22, '16:03:00', '2024-12-03', 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia`
--

DROP TABLE IF EXISTS `frequencia`;
CREATE TABLE IF NOT EXISTS `frequencia` (
  `id_frequencia` int NOT NULL AUTO_INCREMENT,
  `fk_encontro_id_encontro` int DEFAULT NULL,
  `fk_usuario_id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id_frequencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  PRIMARY KEY (`id_horario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `horario`
--

INSERT INTO `horario` (`id_horario`, `cod_semana`, `hora`, `fk_projeto_id_projeto`) VALUES
(14, 2, '13:12:00', 16),
(15, 4, '17:18:00', 23);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

DROP TABLE IF EXISTS `projeto`;
CREATE TABLE IF NOT EXISTS `projeto` (
  `id_projeto` int NOT NULL AUTO_INCREMENT,
  `nome_projeto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `situacao` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_projeto`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`id_projeto`, `nome_projeto`, `situacao`) VALUES
(12, 'Clube de damas', 'disponivel'),
(13, 'Clube de Xadrez', 'disponivel'),
(14, 'Feira de Ciências', 'disponivel'),
(15, 'Oficina de Robótica', 'disponivel'),
(16, 'Projeto de Leitura', 'disponivel'),
(17, 'Grupo de Teatro Escolar', 'indisponivel'),
(18, 'Jornal Estudantil', 'disponivel'),
(19, 'Horta Comunitária', 'disponivel'),
(20, 'Aulas de Música', 'disponivel'),
(23, 'Libras', 'indisponivel');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `recuperar_senha`
--

INSERT INTO `recuperar_senha` (`id_recuperar_senha`, `email`, `token`, `data_criacao`, `usado`) VALUES
(1, 'luiz.2022310970@aluno.iffar.edu.br', 'd4b6c67f115dc08db609aafff52c918e57d1167b4ef7301107f37f52920e521827c58bd45954fa4aa80c715bc2a9514a78f8', '2024-12-12 16:04:29', 0),
(2, 'luiz.2022310970@aluno.iffar.edu.br', '1e4c9523bc7a37a0b457d80c0d62e4f4144ccccdf052abbd1b53c72295506d84d040253dbbba7a235b75137d234cdd9e4b45', '2024-12-12 16:04:33', 0),
(3, 'luiz.2022310970@aluno.iffar.edu.br', '52aa86447d0c862ba01d0f35e29005d650a3f2dd035a519f0ef98e54dc66c5cd258c17c0952f35e7b5e1e169d372f00960fd', '2024-12-12 16:04:33', 0),
(4, 'luiz.2022310970@aluno.iffar.edu.br', '2777dd598144e808f78875329d853c2c1d6aa20320451115cf77910f5e40ff0cce113efb964e91b488b3bd758133ecb770b0', '2024-12-12 16:05:10', 0),
(5, 'luiz.2022310970@aluno.iffar.edu.br', 'e4b4509371e788274ca47bc487575a0057697f587a493db1a775209c3af22d9977bae05d36362291f3217967bbf8fbf18bf0', '2024-12-12 16:08:06', 1),
(6, 'fabio.dasilva@iffarroupilha.edu.br', '0e1859e463b4e27dcb78aebe2c54d51e5105a71752b9ba5ae73ddcb960f0548e6397d23bbed9c235c650fa310b7fe5283d87', '2024-12-19 13:44:02', 0),
(7, 'luiz.2022310970@aluno.iffar.edu.br', '675f4ad1c46bec542a55580ab609c00ab8af85703eaff4bdfdc6ca0e1460f0fab8f424ef8c8d4c80ad0ea97c0111c9b7187b', '2024-12-19 13:44:34', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usuario_tipo` int DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `usuario_tipo`) VALUES
(61, 'Luiz Guilherme', 'luiz@luiz', '$argon2i$v=19$m=65536,t=4,p=1$Y0dmQ0FvQ1J6eXdNRlVoUg$JuDBblgJg28L3IgmnJElB9/eeY6KyBVbtUM8XNMw7h8', 1),
(62, 'Jeverson Fagundes', 'jeverson@jeverson', '$argon2i$v=19$m=65536,t=4,p=1$LmpJQ3VvSUlqWUpXa0NaTQ$/IpR4UMyQshHxmNJPc3u2NNm461k22oHvD0QNk12Zmo', 2),
(63, 'Roberto Graziadei', 'roberto@roberto', '$argon2i$v=19$m=65536,t=4,p=1$RlQ0a05qZG5rMENYdjQ5bg$YVrXOTwXkM4PRXa17vPlGWH+2OGUbYf7cVFqABQyvmg', 2),
(66, 'Luiz Guilherme ', 'luiz.2022310970@aluno.iffar.edu.br', '$argon2id$v=19$m=65536,t=4,p=1$Q21ZYjhwVUg4cGtEWTVrSA$osnS6GjpIXNm2Uc6r2GLTV7t5xuU8siHDFwbziaHE6g', 2),
(67, 'Fábio', 'fabio.dasilva@iffarroupilha.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$UGd1UXZWZUtUcWE1dGNRcw$PIUbmQAj46GWUX5erdi33Eb0aMvg5DzSSs0dn3zKToY', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_projeto`
--

DROP TABLE IF EXISTS `usuario_projeto`;
CREATE TABLE IF NOT EXISTS `usuario_projeto` (
  `fk_usuario_id_usuario` int DEFAULT NULL,
  `fk_projeto_id_projeto` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario_projeto`
--

INSERT INTO `usuario_projeto` (`fk_usuario_id_usuario`, `fk_projeto_id_projeto`) VALUES
(5, 12),
(6, 13),
(7, 14),
(8, 12),
(9, 15),
(10, 16),
(11, 17),
(12, 24),
(13, 19),
(14, 20),
(5, 13),
(6, 15),
(8, 16),
(9, 24),
(10, 19),
(7, 12),
(11, 14),
(12, 15),
(13, 17),
(14, 24),
(15, 19),
(16, 20),
(5, 14),
(8, 20),
(6, 17),
(9, 12),
(7, 19),
(10, 13),
(11, 16),
(12, 20),
(63, 12),
(63, 23),
(63, 20),
(63, 19),
(63, 20),
(63, 17),
(66, 16),
(66, 19),
(66, 13);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
