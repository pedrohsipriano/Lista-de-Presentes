-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/01/2025 às 14:56
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `listadepresentes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista`
--

CREATE TABLE `lista` (
  `id_lista` int(11) NOT NULL,
  `nome_lista` varchar(255) NOT NULL,
  `descricao_lista` text NOT NULL,
  `data_lista` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id_usuario` int(11) NOT NULL,
  `presente_id_presente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lista`
--

INSERT INTO `lista` (`id_lista`, `nome_lista`, `descricao_lista`, `data_lista`, `usuario_id_usuario`, `presente_id_presente`) VALUES
(3, 'gigi', 'Presentes de aniversário da gigi', '2024-12-13 19:10:41', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `presente`
--

CREATE TABLE `presente` (
  `id_presente` int(11) NOT NULL,
  `nome_presente` varchar(255) NOT NULL,
  `descricao_presente` text NOT NULL,
  `preco_presente` decimal(10,2) NOT NULL,
  `img_presente` varchar(255) NOT NULL,
  `usuario_id_usuario` int(11) NOT NULL,
  `lista_id_lista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `presente`
--

INSERT INTO `presente` (`id_presente`, `nome_presente`, `descricao_presente`, `preco_presente`, `img_presente`, `usuario_id_usuario`, `lista_id_lista`) VALUES
(1, 'Carrinho de controle', 'Carrinho de controle remoto', 333.33, 'aaa', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `senha_usuario` varchar(255) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `data_criacao`) VALUES
(1, 'Pedro', 'pedrohsipriano00@gmail.com', '$2y$10$1YEFlV/PAA7d1WMN88y05.DFXjTD1o1XjNIQ7opEAxH67Qht7jkGi', '2024-12-10 00:19:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_listas`
--

CREATE TABLE `usuarios_listas` (
  `id_usuario` int(11) NOT NULL,
  `id_lista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios_listas`
--

INSERT INTO `usuarios_listas` (`id_usuario`, `id_lista`) VALUES
(1, 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`id_lista`),
  ADD KEY `fk_usuario_lista` (`usuario_id_usuario`),
  ADD KEY `fk_presnte_lista` (`presente_id_presente`) USING BTREE;

--
-- Índices de tabela `presente`
--
ALTER TABLE `presente`
  ADD PRIMARY KEY (`id_presente`),
  ADD KEY `fk_usuario_presente` (`usuario_id_usuario`),
  ADD KEY `fk_lista_presente` (`lista_id_lista`) USING BTREE;

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email_usuario` (`email_usuario`);

--
-- Índices de tabela `usuarios_listas`
--
ALTER TABLE `usuarios_listas`
  ADD PRIMARY KEY (`id_usuario`,`id_lista`),
  ADD KEY `id_lista` (`id_lista`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista`
--
ALTER TABLE `lista`
  MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `presente`
--
ALTER TABLE `presente`
  MODIFY `id_presente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `lista`
--
ALTER TABLE `lista`
  ADD CONSTRAINT `fk_usuario_lista` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `presente`
--
ALTER TABLE `presente`
  ADD CONSTRAINT `fk_lista_presente` FOREIGN KEY (`lista_id_lista`) REFERENCES `lista` (`id_lista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_presente` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `usuarios_listas`
--
ALTER TABLE `usuarios_listas`
  ADD CONSTRAINT `usuarios_listas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_listas_ibfk_2` FOREIGN KEY (`id_lista`) REFERENCES `lista` (`id_lista`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
