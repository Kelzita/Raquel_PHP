-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Jul-2025 às 21:41
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `raquel_fernandes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id` int(11) NOT NULL COMMENT 'Campo responsável por guardar o ID da tarefa',
  `nome` varchar(20) NOT NULL COMMENT 'Campo responsável pro guardar o nome da tarefa',
  `descricao` text NOT NULL COMMENT 'Campo responsável por armazenar a descrição da tarefa',
  `prazo` date NOT NULL COMMENT 'Campo responsável de informar o prazo da tarefa',
  `prioridade` int(11) NOT NULL COMMENT 'Campo responsável por informar a prioridade da tarefa',
  `concluida` tinyint(1) NOT NULL COMMENT 'Campo responsável de informar se a tarefa está concluída'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`id`, `nome`, `descricao`, `prazo`, `prioridade`, `concluida`) VALUES
(1, 'Estudar PHP', 'Continuar meus estudos de PHP e MYSQL', '0000-00-00', 1, 0),
(2, 'Estudar CSS', 'Estudar CSS para ter conhecimento sobre estilização de sites', '0000-00-00', 0, 0),
(31, 'Estudar Python', 'Estudar para ter conhecimento sobre Python', '0000-00-00', 0, 0),
(32, 'Estudar C++', 'Estudar C++', '0000-00-00', 0, 0),
(33, 'A', 'A', '2025-10-25', 0, 0),
(34, 'A', 'A', '2025-10-25', 0, 0),
(35, 'A', 'A', '2025-10-25', 0, 0),
(36, 'Estudar C++', 'Estudar C++', '0000-00-00', 0, 0),
(37, 'Estudar C++', 'Estudar C++', '0000-00-00', 0, 0),
(38, 'a', 'a', '0000-00-00', 3, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Campo responsável por guardar o ID da tarefa', AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
