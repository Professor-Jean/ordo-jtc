-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/12/2016 às 17:45
-- Versão do servidor: 5.7.11-log
-- Versão do PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jtc_database`
--
CREATE DATABASE IF NOT EXISTS `jtc_database` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jtc_database`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de categorias.',
  `category` varchar(45) NOT NULL COMMENT 'Tabela destinada a registrar as categorias do produtos.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela destinada a registrar as categorias do produto.';

--
-- Fazendo dump de dados para tabela `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(01, 'Bermuda'),
(03, 'Calça'),
(02, 'Camiseta'),
(04, 'Colete');

-- --------------------------------------------------------

--
-- Estrutura para tabela `checks`
--

DROP TABLE IF EXISTS `checks`;
CREATE TABLE `checks` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de cheques.',
  `sellers_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de vendedor relativo ao cheque.',
  `number` varchar(30) NOT NULL COMMENT 'Número do cheque.',
  `value` decimal(6,2) UNSIGNED NOT NULL COMMENT 'Valor contido no cheque.',
  `date_receipt` date NOT NULL COMMENT 'Data de recebimento do cheque.',
  `status` tinyint(1) NOT NULL COMMENT 'Status do cheque. Se foi descontado, ou ocorreu falha no desconto.',
  `date_good_for` date DEFAULT NULL COMMENT 'Data boa para o desconto do cheque.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena os cheques relativos aos vendedores.';

--
-- Fazendo dump de dados para tabela `checks`
--

INSERT INTO `checks` (`id`, `sellers_id`, `number`, `value`, `date_receipt`, `status`, `date_good_for`) VALUES
(0001, 001, '12351523512348484', '155.00', '2016-11-26', 0, '2016-11-30'),
(0002, 002, '12351523512348486', '500.00', '2016-11-27', 0, '2016-11-28'),
(0003, 003, '5244123182165256', '155.00', '2016-11-27', 0, '2016-11-30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de cidade.',
  `states_id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de estado onde a cidade se localiza.',
  `name` varchar(45) NOT NULL COMMENT 'Nome de cidade.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as cidades relativas aos estados.';

--
-- Fazendo dump de dados para tabela `cities`
--

INSERT INTO `cities` (`id`, `states_id`, `name`) VALUES
(001, 01, 'Joinville'),
(002, 01, 'Tubarão'),
(003, 01, 'Campo Alegre');

-- --------------------------------------------------------

--
-- Estrutura para tabela `entries`
--

DROP TABLE IF EXISTS `entries`;
CREATE TABLE `entries` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de estrada.',
  `sellers_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'Identificador único de vendedor, pode ser nulo pois só é usado em caso de devolução.',
  `date` date NOT NULL COMMENT 'Data de entrada.',
  `hour` time NOT NULL COMMENT 'Hora de entrada.',
  `type` char(1) NOT NULL COMMENT 'Tipo de entrada [produto novo, devolução ou reposição].'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as entradas de produtos no estoque.';

--
-- Fazendo dump de dados para tabela `entries`
--

INSERT INTO `entries` (`id`, `sellers_id`, `date`, `hour`, `type`) VALUES
(00001, NULL, '2016-11-22', '16:22:00', '0'),
(00002, NULL, '2016-11-15', '12:00:00', '0'),
(00003, 001, '2016-11-27', '16:20:00', '1'),
(00004, NULL, '2016-11-27', '16:31:00', '2'),
(00005, NULL, '2016-11-27', '16:32:00', '2'),
(00006, NULL, '2016-11-27', '16:35:00', '2'),
(00007, NULL, '2016-11-27', '16:36:00', '2'),
(00008, NULL, '2016-11-27', '16:36:00', '2'),
(00009, 002, '2016-11-27', '18:02:00', '1'),
(00010, 002, '2016-11-27', '18:02:00', '1'),
(00011, 003, '2016-11-27', '18:02:00', '1'),
(00012, NULL, '2016-11-27', '18:03:00', '1'),
(00013, NULL, '2016-11-16', '13:00:00', '0'),
(00014, NULL, '2016-11-14', '14:00:00', '0'),
(00015, NULL, '2016-11-21', '15:00:00', '0'),
(00016, NULL, '2016-11-27', '22:31:00', '0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `entries_has_products_has_sizes`
--

DROP TABLE IF EXISTS `entries_has_products_has_sizes`;
CREATE TABLE `entries_has_products_has_sizes` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de entradas que tem produtos com tamanhos.',
  `entries_id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de entradas.',
  `products_has_sizes_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de produtos com tamanhos.',
  `quantity` smallint(4) UNSIGNED NOT NULL COMMENT 'Quantidade de produtos contidos na entrada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que vincula os produtos de cada tamanho com as estradas no estoque.';

--
-- Fazendo dump de dados para tabela `entries_has_products_has_sizes`
--

INSERT INTO `entries_has_products_has_sizes` (`id`, `entries_id`, `products_has_sizes_id`, `quantity`) VALUES
(00001, 00001, 001, 200),
(00002, 00002, 002, 300),
(00003, 00002, 003, 250),
(00004, 00003, 004, 230),
(00005, 00004, 002, 123),
(00006, 00005, 001, 20),
(00007, 00006, 002, 123),
(00008, 00007, 002, 123),
(00009, 00008, 003, 123),
(00010, 00009, 005, 123),
(00011, 00010, 006, 34),
(00012, 00011, 007, 23),
(00013, 00012, 008, 45),
(00014, 00013, 009, 200),
(00015, 00014, 010, 300),
(00016, 00015, 011, 400),
(00017, 00016, 008, 200),
(00018, 00016, 012, 300),
(00019, 00016, 013, 500),
(00020, 00016, 014, 200),
(00021, 00016, 015, 50);

-- --------------------------------------------------------

--
-- Estrutura para tabela `inventories`
--

DROP TABLE IF EXISTS `inventories`;
CREATE TABLE `inventories` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para estoque.',
  `products_has_sizes_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Tamanho do produo que está no estoque.',
  `quantity` smallint(4) UNSIGNED NOT NULL COMMENT 'Quantidade de produto por tamanho.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela destinada a armazenar a quantidade de cada produto por tamanho no estoque.';

--
-- Fazendo dump de dados para tabela `inventories`
--

INSERT INTO `inventories` (`id`, `products_has_sizes_id`, `quantity`) VALUES
(001, 001, 120),
(002, 002, 299),
(003, 003, 103),
(004, 004, 230),
(005, 005, 106),
(006, 006, 34),
(007, 007, 10),
(008, 008, 245),
(009, 009, 200),
(010, 010, 300),
(011, 011, 400),
(012, 012, 300),
(013, 013, 500),
(014, 014, 200),
(015, 015, 50);

-- --------------------------------------------------------

--
-- Estrutura para tabela `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
CREATE TABLE `manufacturers` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de fabricante.',
  `name` varchar(45) NOT NULL COMMENT 'Nome fantasia de fabricante.',
  `phone` bigint(20) UNSIGNED NOT NULL COMMENT 'Telefone de contato de fabricante.',
  `email` varchar(100) NOT NULL COMMENT 'E-mail de contato de fabricante.',
  `cnpj` bigint(18) UNSIGNED ZEROFILL NOT NULL COMMENT 'CNPJ de fabricante.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena os faricantes dos produtos.';

--
-- Fazendo dump de dados para tabela `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`, `phone`, `email`, `cnpj`) VALUES
(01, 'Cia. Rotta', 4756575657, 'central@ciarotta.com', 000013707528000147),
(02, 'Look One', 4746454746, 'atendimento@lookone.com', 000075467789000194),
(03, 'Skylife', 4749484740, 'sac@skylife.com', 000087261701000162);

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de produto.',
  `categories_id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Categoria de produto.',
  `manufacturers_id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de fabricante.',
  `code` int(3) NOT NULL COMMENT 'Código de produto.',
  `model` varchar(45) NOT NULL COMMENT 'Modelo de produto.',
  `sex` tinyint(1) NOT NULL COMMENT 'Sexo do produto.',
  `price` decimal(5,2) UNSIGNED NOT NULL COMMENT 'Preço de produto.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena os produtos.';

--
-- Fazendo dump de dados para tabela `products`
--

INSERT INTO `products` (`id`, `categories_id`, `manufacturers_id`, `code`, `model`, `sex`, `price`) VALUES
(001, 01, 01, 147, 'Saruel', 1, '120.00'),
(002, 02, 02, 159, 'Cigarrete', 0, '150.00'),
(003, 03, 03, 123, 'Gola V', 0, '89.99'),
(004, 02, 03, 195, 'Gola U', 2, '215.99'),
(005, 03, 03, 459, 'Skinny', 0, '59.99'),
(006, 03, 02, 565, 'Bailarina', 0, '120.99'),
(007, 03, 02, 585, 'Flare', 0, '59.99'),
(008, 03, 03, 789, 'Reta', 0, '129.99');

-- --------------------------------------------------------

--
-- Estrutura para tabela `products_has_sizes`
--

DROP TABLE IF EXISTS `products_has_sizes`;
CREATE TABLE `products_has_sizes` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de produto com tamanho.',
  `products_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de produto.',
  `sizes_id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de tamanho.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que vincula os produtos com os seus devidos tamanhos.';

--
-- Fazendo dump de dados para tabela `products_has_sizes`
--

INSERT INTO `products_has_sizes` (`id`, `products_id`, `sizes_id`) VALUES
(001, 001, 01),
(002, 004, 02),
(003, 002, 01),
(004, 001, 05),
(005, 006, 04),
(006, 005, 05),
(007, 004, 06),
(008, 002, 05),
(009, 006, 03),
(010, 007, 04),
(011, 004, 05),
(012, 006, 06),
(013, 004, 01),
(014, 005, 03),
(015, 001, 04);

-- --------------------------------------------------------

--
-- Estrutura para tabela `removals`
--

DROP TABLE IF EXISTS `removals`;
CREATE TABLE `removals` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de saída.',
  `sellers_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'Identificador de vendedor que recebe os itens da saída. Esse campo pode ser nulo, pois o tipo de saída pode ser de reparo',
  `date` date NOT NULL COMMENT 'Data de saída.',
  `hour` time NOT NULL COMMENT 'Hora de saída.',
  `type` char(1) NOT NULL COMMENT 'Tipo da saída.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as saídas de produtos do estoque.';

--
-- Fazendo dump de dados para tabela `removals`
--

INSERT INTO `removals` (`id`, `sellers_id`, `date`, `hour`, `type`) VALUES
(00001, 001, '2016-11-22', '16:44:00', '0'),
(00002, 001, '2016-11-22', '16:54:00', '0'),
(00003, NULL, '2016-11-27', '16:29:00', '2'),
(00004, NULL, '2016-11-27', '16:34:00', '2'),
(00005, NULL, '2016-11-27', '16:35:00', '2'),
(00006, NULL, '2016-11-27', '16:36:00', '2'),
(00007, 002, '2016-11-27', '17:27:00', '1'),
(00008, 002, '2016-11-27', '17:30:00', '1'),
(00009, 002, '2016-11-27', '17:31:00', '1'),
(00010, 003, '2016-11-27', '22:29:00', '1'),
(00011, 002, '2016-11-27', '22:29:00', '1'),
(00012, 003, '2016-12-05', '14:11:00', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `removals_has_products_has_sizes`
--

DROP TABLE IF EXISTS `removals_has_products_has_sizes`;
CREATE TABLE `removals_has_products_has_sizes` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de saída que tem produtos com tamanhos.',
  `removals_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `products_has_sizes_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de produto com tamnho.',
  `quantity` smallint(4) UNSIGNED NOT NULL COMMENT 'Quantidade de produtos contidos na saída.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que vincula os produtos de cada tamanho com as saídas do estoque.';

--
-- Fazendo dump de dados para tabela `removals_has_products_has_sizes`
--

INSERT INTO `removals_has_products_has_sizes` (`id`, `removals_id`, `products_has_sizes_id`, `quantity`) VALUES
(00001, 00001, 001, 100),
(00002, 00002, 002, 1),
(00003, 00003, 002, 123),
(00004, 00004, 002, 123),
(00005, 00005, 002, 123),
(00006, 00006, 003, 123),
(00007, 00007, 003, 123),
(00008, 00008, 003, 12),
(00009, 00009, 003, 12),
(00010, 00010, 005, 12),
(00011, 00011, 007, 13),
(00012, 00012, 005, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `repairs`
--

DROP TABLE IF EXISTS `repairs`;
CREATE TABLE `repairs` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de saída reparo.',
  `removals_has_products_has_sizes_id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de saída que tem produtos com tamanhos.',
  `entries_id` int(5) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'Identificador de entrada de produto.',
  `date` date NOT NULL COMMENT 'Data de saída de reparo.',
  `hour` time NOT NULL COMMENT 'Hora de saída de reparo.',
  `quantity` smallint(4) UNSIGNED NOT NULL COMMENT 'Quantidade de produtos.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as saída de produtos para reparo em seus respectivos fabricantes.';

--
-- Fazendo dump de dados para tabela `repairs`
--

INSERT INTO `repairs` (`id`, `removals_has_products_has_sizes_id`, `entries_id`, `date`, `hour`, `quantity`) VALUES
(00001, 00003, 00004, '2016-11-27', '16:29:00', 123),
(00002, 00001, 00005, '2016-11-27', '16:30:00', 20),
(00003, 00004, 00006, '2016-11-27', '16:34:00', 123),
(00004, 00005, 00007, '2016-11-27', '16:35:00', 123),
(00005, 00006, 00008, '2016-11-27', '16:36:00', 123),
(00006, 00009, NULL, '2016-11-27', '22:25:00', 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sellers`
--

DROP TABLE IF EXISTS `sellers`;
CREATE TABLE `sellers` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de vendedor.',
  `cities_id` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de cidade onde o vendedor atua.',
  `name` varchar(45) NOT NULL COMMENT 'Nome do vendedor.',
  `email` varchar(100) NOT NULL COMMENT 'E-mail de vendedor.',
  `phone` bigint(20) NOT NULL COMMENT 'Telefone de vendedor.',
  `birth_date` date NOT NULL COMMENT 'Data de nascimento do vendedor.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena os vededores.';

--
-- Fazendo dump de dados para tabela `sellers`
--

INSERT INTO `sellers` (`id`, `cities_id`, `name`, `email`, `phone`, `birth_date`) VALUES
(001, 001, 'Liany Rafaela', 'liany@gmai.com', 4745464889, '1999-11-01'),
(002, 003, 'Natasha Hostin', 'natasha@gmail.com', 4748484909, '1999-11-01'),
(003, 003, 'Lucas Bublitz', 'lucas@gmail.com', 4746474878, '1999-05-08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE `sizes` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para tamanho.',
  `size` varchar(10) NOT NULL COMMENT 'Campo destinado a registrar o tamanho dos produtos.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela destinada a armazenar o tamanho do produto.';

--
-- Fazendo dump de dados para tabela `sizes`
--

INSERT INTO `sizes` (`id`, `size`) VALUES
(05, 'EXG'),
(06, 'G1'),
(01, 'GG'),
(03, 'M'),
(04, 'P'),
(02, 'PP');

-- --------------------------------------------------------

--
-- Estrutura para tabela `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de estado.',
  `name` varchar(45) NOT NULL COMMENT 'Nome de estado.',
  `initials` char(2) NOT NULL COMMENT 'Sigla, ou iniciais, de estado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena os estados.';

--
-- Fazendo dump de dados para tabela `states`
--

INSERT INTO `states` (`id`, `name`, `initials`) VALUES
(01, 'Santa Catarina', 'SC');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Este campo serve como identificador único para usuário.',
  `username` varchar(20) NOT NULL COMMENT 'Este campo é destinado a armazenar o nome de usuário.',
  `password` char(32) NOT NULL COMMENT 'Este campo é a armazenar a senha para o usuário.',
  `email` varchar(100) NOT NULL COMMENT 'Este campo é destinado a armazanar o e-mail do usuário.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Esta tabela armazena todos os usuários do software.';

--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(01, 'adm', '38e3b110757d6579c48fcd19ff479835', 'adm@adm.com'),
(02, 'natasha', '05eec981eae260fded6dcfd83d0db438', 'natasha@gmai.com'),
(03, 'lucas', 'c18bf54c2f56c4f10b33f25405e4aec6', 'lucas@gmail.com');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_UNIQUE` (`category`);

--
-- Índices de tabela `checks`
--
ALTER TABLE `checks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_checks_sellers1_idx` (`sellers_id`);

--
-- Índices de tabela `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cities_states1_idx` (`states_id`);

--
-- Índices de tabela `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entries_sellers1_idx` (`sellers_id`);

--
-- Índices de tabela `entries_has_products_has_sizes`
--
ALTER TABLE `entries_has_products_has_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entries_has_products_has_sizes_products_has_sizes1_idx` (`products_has_sizes_id`),
  ADD KEY `fk_entries_has_products_has_sizes_entries1_idx` (`entries_id`);

--
-- Índices de tabela `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventories_products_has_sizes1_idx` (`products_has_sizes_id`);

--
-- Índices de tabela `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `e_mail_UNIQUE` (`email`),
  ADD UNIQUE KEY `cnpj_UNIQUE` (`cnpj`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`),
  ADD KEY `fk_products_categories1_idx` (`categories_id`),
  ADD KEY `fk_products_manufacturers1_idx` (`manufacturers_id`);

--
-- Índices de tabela `products_has_sizes`
--
ALTER TABLE `products_has_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_has_sizes_sizes1_idx` (`sizes_id`),
  ADD KEY `fk_products_has_sizes_products_idx` (`products_id`);

--
-- Índices de tabela `removals`
--
ALTER TABLE `removals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_outs_sellers1_idx` (`sellers_id`);

--
-- Índices de tabela `removals_has_products_has_sizes`
--
ALTER TABLE `removals_has_products_has_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_outs_has_products_has_sizes_products_has_sizes1_idx` (`products_has_sizes_id`),
  ADD KEY `fk_removals_has_products_has_sizes_removals1_idx` (`removals_id`);

--
-- Índices de tabela `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_repairs_outs_has_products_has_sizes1_idx` (`removals_has_products_has_sizes_id`),
  ADD KEY `fk_repairs_entries1_idx` (`entries_id`);

--
-- Índices de tabela `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `e_mail_UNIQUE` (`email`),
  ADD UNIQUE KEY `phone_UNIQUE` (`phone`),
  ADD KEY `fk_sellers_cities1_idx` (`cities_id`);

--
-- Índices de tabela `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `size_UNIQUE` (`size`);

--
-- Índices de tabela `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `initials_UNIQUE` (`initials`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `e_mail_UNIQUE` (`email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de categorias.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `checks`
--
ALTER TABLE `checks`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de cheques.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `cities`
--
ALTER TABLE `cities`
  MODIFY `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de cidade.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de estrada.', AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de tabela `entries_has_products_has_sizes`
--
ALTER TABLE `entries_has_products_has_sizes`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de entradas que tem produtos com tamanhos.', AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de tabela `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para estoque.', AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de tabela `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de fabricante.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de produto.', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `products_has_sizes`
--
ALTER TABLE `products_has_sizes`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de produto com tamanho.', AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de tabela `removals`
--
ALTER TABLE `removals`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de saída.', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `removals_has_products_has_sizes`
--
ALTER TABLE `removals_has_products_has_sizes`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de saída que tem produtos com tamanhos.', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de saída reparo.', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de vendedor.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para tamanho.', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `states`
--
ALTER TABLE `states`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de estado.', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve como identificador único para usuário.', AUTO_INCREMENT=4;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `checks`
--
ALTER TABLE `checks`
  ADD CONSTRAINT `fk_checks_sellers1` FOREIGN KEY (`sellers_id`) REFERENCES `sellers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `fk_cities_states1` FOREIGN KEY (`states_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `fk_entries_sellers1` FOREIGN KEY (`sellers_id`) REFERENCES `sellers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `entries_has_products_has_sizes`
--
ALTER TABLE `entries_has_products_has_sizes`
  ADD CONSTRAINT `fk_entries_has_products_has_sizes_entries1` FOREIGN KEY (`entries_id`) REFERENCES `entries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entries_has_products_has_sizes_products_has_sizes1` FOREIGN KEY (`products_has_sizes_id`) REFERENCES `products_has_sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `fk_inventories_products_has_sizes1` FOREIGN KEY (`products_has_sizes_id`) REFERENCES `products_has_sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_manufacturers1` FOREIGN KEY (`manufacturers_id`) REFERENCES `manufacturers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `products_has_sizes`
--
ALTER TABLE `products_has_sizes`
  ADD CONSTRAINT `fk_products_has_sizes_products` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_has_sizes_sizes1` FOREIGN KEY (`sizes_id`) REFERENCES `sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `removals`
--
ALTER TABLE `removals`
  ADD CONSTRAINT `fk_outs_sellers1` FOREIGN KEY (`sellers_id`) REFERENCES `sellers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `removals_has_products_has_sizes`
--
ALTER TABLE `removals_has_products_has_sizes`
  ADD CONSTRAINT `fk_outs_has_products_has_sizes_products_has_sizes1` FOREIGN KEY (`products_has_sizes_id`) REFERENCES `products_has_sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_removals_has_products_has_sizes_removals1` FOREIGN KEY (`removals_id`) REFERENCES `removals` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `repairs`
--
ALTER TABLE `repairs`
  ADD CONSTRAINT `fk_repairs_entries1` FOREIGN KEY (`entries_id`) REFERENCES `entries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_repairs_outs_has_products_has_sizes1` FOREIGN KEY (`removals_has_products_has_sizes_id`) REFERENCES `removals_has_products_has_sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `fk_sellers_cities1` FOREIGN KEY (`cities_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
