-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 28-Fev-2024 às 19:41
-- Versão do servidor: 8.0.30
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ciptea`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_carteira`
--

CREATE TABLE `dados_carteira` (
  `id` int NOT NULL,
  `sdt_criacao` date DEFAULT NULL,
  `cod_pessoa` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_pessoa`
--

CREATE TABLE `dados_pessoa` (
  `cod_pessoa` int NOT NULL,
  `vch_nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_nome_pai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_nome_mae` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdt_nascimento` date DEFAULT NULL,
  `endereco` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_rg` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_cpf` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_num_cartao_sus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bool_representante_legal` tinyint(1) DEFAULT NULL,
  `cod_usuario` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `dados_pessoa`
--

INSERT INTO `dados_pessoa` (`cod_pessoa`, `vch_nome`, `vch_nome_pai`, `vch_nome_mae`, `sdt_nascimento`, `endereco`, `bairro`, `cep`, `cidade`, `vch_rg`, `vch_cpf`, `vch_num_cartao_sus`, `bool_representante_legal`, `cod_usuario`) VALUES
(39, 'João Gomes', 'Antônio Cordeiro', 'Maria de Jesus', '2013-06-03', 'travessa amélia', 'Margaridas', '4285678', 'Camaçari', '7894561230', 'a', '85476932141', 1, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_responsavel_legal`
--

CREATE TABLE `dados_responsavel_legal` (
  `cod_responsavel_legal` int NOT NULL,
  `vch_nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_telefone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_cpf` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_endereco` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_bairro` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_cep` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_cidade` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cod_pessoa` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `dados_responsavel_legal`
--

INSERT INTO `dados_responsavel_legal` (`cod_responsavel_legal`, `vch_nome`, `vch_telefone`, `vch_cpf`, `vch_endereco`, `vch_bairro`, `vch_cep`, `vch_cidade`, `cod_pessoa`) VALUES
(23, 'a', '5', 'a', 'a', 'a', '65', 'as', 39);

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `cod_pessoa` bigint DEFAULT NULL,
  `cod_documento` int NOT NULL,
  `cod_tipo_documento` int DEFAULT NULL,
  `vch_documento` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdt_insercao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`cod_pessoa`, `cod_documento`, `cod_tipo_documento`, `vch_documento`, `sdt_insercao`, `status`) VALUES
(39, 41, 2, '../uploads/65df8592a973d.pdf', '2024-02-28 16:12:18', 0),
(39, 42, 1, '../uploads/65df8592a9742.png', '2024-02-28 16:12:18', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `observacao`
--

CREATE TABLE `observacao` (
  `cod_obs` bigint UNSIGNED NOT NULL,
  `cod_pessoa` int NOT NULL,
  `obs` varchar(2000) NOT NULL,
  `sdt_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `observacao`
--

INSERT INTO `observacao` (`cod_obs`, `cod_pessoa`, `obs`, `sdt_criacao`) VALUES
(3, 39, 'Teste', '2024-02-28 16:32:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `vch_login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vch_senha` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `int_perfil` bigint DEFAULT NULL,
  `int_situacao` bigint DEFAULT NULL,
  `cod_usuario` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`vch_login`, `vch_senha`, `int_perfil`, `int_situacao`, `cod_usuario`) VALUES
('teste@gmail.com', '$2y$10$JehWgPqMcV48NNpzGPHbi.EbPL/pPWGbqHznroYf/zbd9EOQJv7ce', 1, 1, 9);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `dados_carteira`
--
ALTER TABLE `dados_carteira`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `dados_pessoa`
--
ALTER TABLE `dados_pessoa`
  ADD PRIMARY KEY (`cod_pessoa`);

--
-- Índices para tabela `dados_responsavel_legal`
--
ALTER TABLE `dados_responsavel_legal`
  ADD PRIMARY KEY (`cod_responsavel_legal`);

--
-- Índices para tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`cod_documento`);

--
-- Índices para tabela `observacao`
--
ALTER TABLE `observacao`
  ADD UNIQUE KEY `cod_observacao` (`cod_obs`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dados_carteira`
--
ALTER TABLE `dados_carteira`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dados_pessoa`
--
ALTER TABLE `dados_pessoa`
  MODIFY `cod_pessoa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `dados_responsavel_legal`
--
ALTER TABLE `dados_responsavel_legal`
  MODIFY `cod_responsavel_legal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `cod_documento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `observacao`
--
ALTER TABLE `observacao`
  MODIFY `cod_obs` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
