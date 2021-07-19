-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/07/2021 às 10:58
-- Versão do servidor: 10.4.17-MariaDB
-- Versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `av2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `cod_de_barras` varchar(13) CHARACTER SET utf8 NOT NULL,
  `nome` varchar(60) CHARACTER SET utf8 NOT NULL,
  `fabricante` varchar(20) CHARACTER SET utf8 NOT NULL,
  `categoria` varchar(20) CHARACTER SET utf8 NOT NULL,
  `tipo_produto` varchar(20) CHARACTER SET utf8 NOT NULL,
  `preco` float UNSIGNED NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL,
  `peso` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(700) CHARACTER SET utf8 NOT NULL,
  `data_inclusao` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `cod_de_barras`, `nome`, `fabricante`, `categoria`, `tipo_produto`, `preco`, `quantidade`, `peso`, `descricao`, `data_inclusao`, `status`) VALUES
(22, '2323123123123', 'iPhone 12 Pro Max 128GB', 'Apple', 'op1', 'op1', 123123000, 123123000, 12222, 'asdasd', '2021-07-19', 1),
(23, '1239081903812', 'Redmi Note 9S Dual SIM 64 GB azul 4 GB RAM', 'Xiaomi', 'op1', 'op1', 2000, 1, 2000, 'Pensado para você\nO Xiaomi Note 9S possui o novo sistema operacional Android 10 que incorpora respostas inteligentes e ações sugeridas para todos os seus aplicativos. Entre as suas várias funcionalidades irá encontrar o tema escuro, a navegação por gestos e o modo livre de distração, para que você possa completar as suas tarefas enquanto desfruta ao máximo do seu dispositivo.\n\nFotografia profissional no seu bolso\nDescubra infinitas possibilidades para suas fotos com as 4 câmeras principais de sua equipe. Teste sua criatividade e jogue com iluminação, diferentes planos e efeitos para obter ótimos resultados.\n\nDesbloqueio facial e de impressão digital\nMáxima segurança para que apenas você poss', '2021-07-19', 1),
(25, '9102839012839', 'Moto G30 Dual SIM 128 GB dark prism 4 GB RAM', 'Xiaomi', 'op1', 'op1', 1699, 1497, 1250, 'Dispositivo desbloqueado para que você escolha a companhia telefônica de sua preferência.\nTela IPS de 6.5 \".\nTem 4 câmeras traseiras de 64Mpx/8Mpx/2Mpx/2Mpx.\nCâmera frontal de 13Mpx.\nProcessador Snapdragon 662 Octa-Core de 2GHz com 4GB de RAM.\nBateria de 5000mAh.\nMemória interna de 128GB.\nResistente aos salpicos.\nCom reconhecimento facial e sensor de impressão digital.\nResistente à poeira.', '2021-07-19', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cod_de_barras` (`cod_de_barras`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
