-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Abr-2018 às 20:19
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barretas`
--
CREATE DATABASE IF NOT EXISTS `barretas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `barretas`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL DEFAULT '',
  `descricao` varchar(255) DEFAULT NULL,
  `ordem` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ordem` (`ordem`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`, `ordem`) VALUES
(1, 'Bravura militar', 'destinadas a premiar a bravura militar', 1),
(2, 'Ferimento em ação', 'destinadas a agraciar os feridos em ação', 2),
(3, 'Participação em campanha', 'destinadas a premiar a participação em campanha e o cumprimento de missões ou operações de guerra', 3),
(4, 'Mérito', 'destinadas a atestar o mérido, quando recebida por bravura em missões ou operações de guerra, precederá todas as demais', 4),
(5, 'Serviços relevantes', 'destinadas a premiar serviços relevantes', 5),
(6, 'Bons serviços militares', 'destinadas a recompensar bons serviços militares', 6),
(7, 'Esforço nacional de guerra', 'destinadas a recompensar contribuição ao esforço nacional de guerra', 7),
(8, 'Serviços prestados às Forças Armadas', 'destinadas a reconhecer serviços prestados às Fôrças Armadas', 8),
(9, 'Serviços extraordinários', 'destinadas a premiar serviços extraordinários prestados à humanidade', 9),
(10, 'Mérito cívico', 'condecorações destinadas a premiar o mérito cívico', 10),
(11, 'Aplicação nos estudos militares', 'destinadas a premiar a aplicação aos estudos militares ou à instrução militar', 11),
(12, 'Dedicação à profissão', 'condecorações destinadas a reconhecer a dedicação à profissão e o interesse pelo seu aprimoramento', 12),
(13, 'Condecorações estrangeiras', 'condecorações estrangeiras aprovadas para uso nos uniformes da MB', 13),
(99, 'Outras Categorias', 'categoria provisória (deletar após a inserção das medalhas) - Ten Anders', 99);

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes`
--

DROP TABLE IF EXISTS `configuracoes`;
CREATE TABLE IF NOT EXISTS `configuracoes` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `area_tela` int(3) NOT NULL DEFAULT '0',
  `nr_colunas` int(1) NOT NULL DEFAULT '0',
  `largura_img` int(2) NOT NULL DEFAULT '0',
  `altura_img` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `area_tela`, `nr_colunas`, `largura_img`, `altura_img`) VALUES
(1, 100, 6, 80, 27);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL DEFAULT '',
  `descricao` varchar(255) DEFAULT NULL,
  `ordem` int(5) NOT NULL DEFAULT '0',
  `categoria_id` int(11) NOT NULL DEFAULT '1',
  `origem_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`),
  KEY `categoria_id_idx` (`categoria_id`),
  KEY `origem_id_idx` (`origem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=371 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`id`, `nome`, `descricao`, `ordem`, `categoria_id`, `origem_id`) VALUES
(1, 'Cruz Naval', NULL, 1, 1, 4),
(2, 'Cruz de Combate de 1ª e 2ª classes', NULL, 2, 1, 1),
(3, 'Cruz de Bravura', NULL, 3, 1, 1),
(4, 'Medalha Sangue do Brasil', NULL, 4, 2, 1),
(5, 'Cruz de Sangue', NULL, 5, 2, 5),
(6, 'Cruz de Campanha (1ª Guerra Mundial)', NULL, 6, 3, 99),
(7, 'Medalha da Vitória (1ª Guerra Mundial)', NULL, 7, 3, 99),
(8, 'Medalha de Serviços Relevantes', NULL, 8, 3, 4),
(9, 'Medalhas de Serviços de Guerra com 3, 2 ou 1estrela', NULL, 9, 3, 4),
(10, 'Medalha da Força Naval do Nordeste', NULL, 10, 3, 4),
(11, 'Medalha da Força Naval do Sul', NULL, 11, 3, 4),
(12, 'Medalha de Campanha', NULL, 12, 3, 1),
(13, 'Cruz de Aviação - Fitas A e B (A)', NULL, 13, 3, 5),
(14, 'Medalha de Campanha na Itália', NULL, 14, 3, 5),
(15, 'Ordem do Mérito Médico', NULL, 15, 4, 99),
(16, 'Medalha Mérito Legislativo Câmara dos Deputados', NULL, 16, 4, 12),
(17, 'Ordem do Mérito da Defesa', NULL, 17, 4, 3),
(18, 'Ordem do Mérito Naval', NULL, 18, 4, 4),
(19, 'Ordem do Mérito Militar', NULL, 19, 4, 1),
(20, 'Ordem do Mérito Aeronáutico', NULL, 20, 4, 5),
(21, 'Ordem de Rio Branco', NULL, 21, 4, 99),
(22, 'Ordem do Mérito Judiciário Militar', NULL, 22, 4, 99),
(23, 'Ordem Nacional do Mérito', NULL, 23, 4, 99),
(24, 'Medalha do Mérito Mauá', NULL, 24, 4, 99),
(25, 'Ordem do Mérito Ministério Público Militar', NULL, 25, 4, 8),
(26, 'Medalha Mérito Desportivo Militar', NULL, 26, 4, 20),
(27, 'Ordem do Mérito da Inteligência', NULL, 27, 4, 99),
(28, 'Mérito da Aviação de Segurança Pública Major Ibes Carlos Pacheco', NULL, 28, 4, 99),
(29, 'Cruz de Serviços Relevantes', NULL, 29, 5, 5),
(30, 'Medalha da Vitória (2ª Guerra Mundial)', NULL, 30, 5, 99),
(31, 'Medalha do Mérito Marechal Cordeiro de Farias', NULL, 31, 5, 99),
(32, 'Medalha Sérgio Vieira de Mello', NULL, 32, 5, 99),
(33, 'Medalha Mérito Estado-Maior Conjunto das Forças Armadas', NULL, 33, 6, 99),
(34, 'Medalha Militar', NULL, 34, 6, 4),
(35, 'Medalha Corpo de Tropa', NULL, 35, 6, 99),
(36, 'Medalha de Serviços de Guerra, sem estrela', NULL, 36, 7, 4),
(37, 'Medalha de Campanha do Atlântico Sul (A)', NULL, 37, 7, 5),
(38, 'Medalha Naval de Serviços Distintos', NULL, 38, 8, 4),
(39, 'Medalha do Pacificador', NULL, 39, 8, 1),
(40, 'Medalha Mérito Santos Dumont', NULL, 40, 8, 5),
(41, 'Medalha Marechal Trompowski', NULL, 41, 8, 5),
(42, 'Medalha Mérito Tamandaré', NULL, 42, 8, 4),
(43, 'Medalha de Serviço Amazônico', NULL, 43, 8, 4),
(44, 'Medalha Bartolomeu de Gusmão', NULL, 44, 8, 99),
(45, 'Medalha Mérito Aeroterrestre', NULL, 45, 8, 99),
(46, 'Medalha Mérito Operacional Brigadeiro Nero Moura', NULL, 46, 8, 5),
(47, 'Medalha de Distinção de 1ª e 2ª Classe', NULL, 47, 9, 99),
(48, 'Medalha da Inconfidência (somente para os agraciados entre 31/03/64 e 05/10/67)', NULL, 48, 10, 99),
(49, 'Medalha-Prêmio Greenhalgh', NULL, 49, 11, 4),
(50, 'Medalha-Prêmio Escola de Guerra Naval', NULL, 50, 11, 4),
(51, 'Medalha-Prêmio Almirante Marques de Leão', NULL, 51, 11, 4),
(52, 'Medalha-Prêmio Saldanha da Gama', NULL, 52, 11, 4),
(53, 'Medalha-Prêmio Almirante Alexandrino de Alencar', NULL, 53, 11, 4),
(54, 'Medalha-Prêmio Faraday', NULL, 54, 11, 4),
(55, 'Medalha-Prêmio Almirante Jaceguai', NULL, 55, 11, 4),
(56, 'Medalha-Prêmio Revista Marítima Brasileira', NULL, 56, 11, 4),
(57, 'Medalha Mallet (E)', NULL, 57, 11, 1),
(58, 'Medalha Marechal Osório – O Legendário', NULL, 58, 11, 1),
(59, 'Medalha-Prêmio Conde de Anadia', NULL, 59, 11, 1),
(60, 'Medalha-Prêmio Almirante Júlio de Noronha', NULL, 60, 11, 4),
(61, 'Medalha de Caxias (E)', NULL, 61, 11, 1),
(62, 'Medalha Prêmio Marechal Bitencourt (E)', NULL, 62, 11, 1),
(63, 'Medalha Prêmio Correia Lima (E)', NULL, 63, 11, 1),
(64, 'Medalha Prêmio Duque de Caxias (PMDF)', NULL, 64, 11, 99),
(65, 'Medalha Marechal Hermes-Aplicação e Estudos (E)', NULL, 65, 11, 1),
(66, 'Medalha-Prêmio Intendência da Marinha', NULL, 66, 11, 4),
(67, 'Medalha-Prêmio Almirante Gastão Motta', NULL, 67, 11, 4),
(68, 'Medalha-Prêmio Forte Sebastopol', NULL, 68, 11, 4),
(69, 'Medalha-Prêmio Vanguarda', NULL, 69, 11, 4),
(70, 'Medalha-Prêmio Força Aérea Brasileira (A)', NULL, 70, 11, 5),
(85, 'Medalha-Prêmio Santos Dumont (A)', NULL, 71, 11, 5),
(86, 'Medalha-Prêmio Salgado Filho (A)', NULL, 72, 11, 5),
(87, 'Medalha “Eduardo Gomes Aplicação e Estudo” (A)', NULL, 73, 11, 5),
(88, 'Medalha-Prêmio do Colégio Militar', NULL, 74, 11, 99),
(89, 'Medalha-Prêmio Almirante Wandenkolk', NULL, 75, 11, 4),
(90, 'Medalha-Prêmio Militar Feminino da Marinha', NULL, 76, 11, 4),
(91, 'Medalha-Prêmio Sargento Francisco Borges de Souza (CPCFN)', NULL, 77, 11, 4),
(92, 'Medalha-Prêmio Almirante José Maria do Amaral Oliveira', NULL, 79, 11, 4),
(93, 'Medalha-Prêmio Almirante Àtilla Monteiro Aché', NULL, 80, 11, 4),
(94, 'Medalha-Prêmio Comandante Vital de Oliveira', NULL, 81, 11, 4),
(95, 'Medalha-Prêmio Almirante Newton Braga', NULL, 82, 11, 4),
(96, 'Medalha-Prêmio Almirante Sylvio de Camargo', NULL, 83, 11, 4),
(97, 'Medalha-Prêmio Marcílio Dias', NULL, 84, 1, 4),
(98, 'Medalha Mérito Marinheiro', NULL, 85, 12, 4),
(99, 'Medalha Sargento Max Wolf Filho', NULL, 86, 12, 1),
(100, 'Medalha Mérito Anfíbio', NULL, 87, 12, 4),
(101, 'Medalha Mérito Acanto', NULL, 88, 12, 4),
(102, 'Medalha Mérito Saúde Naval', NULL, 89, 12, 4),
(103, 'Medalha de Praça mais Distinta', NULL, 89, 12, 4),
(104, 'Ordem do Mérito República Federal da Alemanha', NULL, 92, 13, 13),
(105, 'Medalha “Serviço de CAMAS” (Coordenador da Área Marítima do Atlântico Sul)', NULL, 93, 13, 13),
(106, 'Ordem de Maio ao Mérito Naval', NULL, 94, 13, 15),
(107, 'Ordem do Libertador General San Martin', NULL, 95, 13, 15),
(108, 'Prêmio Armada Nacional', NULL, 96, 13, 15),
(109, 'Medalha do Mérito da Armada Argentina', NULL, 97, 13, 15),
(110, 'Cruz Naval a los Servicios Distinguidos', NULL, 98, 13, 15),
(111, 'Ordem de Leopoldo', NULL, 99, 13, 16),
(112, 'Ordem da Corôa', NULL, 100, 13, 16),
(113, 'Ordem de Leopoldo II', NULL, 101, 13, 16),
(114, 'Ordem Nacional do Condor dos Andes', NULL, 102, 13, 17),
(115, 'Ordem do Mérito Naval Boliviano', NULL, 103, 13, 17),
(116, 'Mérito Aeronáutico', NULL, 104, 13, 17),
(117, 'Medalha Batalha Naval Del Lago de Maracaibo', NULL, 105, 13, 17),
(118, 'Emblema de Oro', NULL, 106, 13, 17),
(119, 'Estrela do Mérito Militar', NULL, 106, 13, 18),
(120, 'Ordem do Mérito do Chile', NULL, 107, 13, 18),
(121, 'Ordem Bernardo O`Higgins', NULL, 108, 13, 18),
(122, 'Estrela Militar', NULL, 109, 13, 18),
(123, 'Grande Estrela do Mérito Militar', NULL, 110, 13, 18),
(124, 'Medalha Militar da Armada', NULL, 111, 13, 18),
(125, 'Medalha Serviços Distintos', NULL, 112, 13, 18),
(126, 'Medalha Minerva', NULL, 113, 13, 18),
(127, 'Medalha Escola Naval República do Chile', NULL, 114, 13, 18),
(128, 'Ordem do Mérito Naval do Chile', NULL, 115, 13, 18),
(129, 'Medalha Comemorativa “Primeiro de Agosto”', NULL, 116, 13, 18),
(145, 'Medalha Militar “Fe en la Causa”', NULL, 117, 13, 19),
(146, 'Ordem Naval Almirante Padilha', NULL, 118, 13, 19),
(147, 'Medalha Francisco José de Caldas', NULL, 119, 13, 19),
(148, 'Distintivos de Serviços Distinguidos', NULL, 120, 13, 19),
(149, 'Medalha ao Mérito Militar \"Torre de Castilla de los Ingenieros Militares\"', NULL, 121, 13, 19),
(150, 'Ordem do Mérito do Conselho Internacional do Desporto Militar', NULL, 122, 13, 20),
(151, 'Medalha de Excelência em Serviço da República da Costa Rica', NULL, 123, 13, 21),
(152, 'Ordem de Denebrog', NULL, 124, 13, 22),
(153, 'Ordem de São Daniel', NULL, 125, 13, 22),
(154, 'Condecoração Abdon Calderon', NULL, 126, 13, 23),
(155, 'Ordem Nacional ao Mérito', NULL, 127, 13, 23),
(156, 'Estrela das Forças Armadas do Equador', NULL, 128, 13, 23),
(157, 'Ordem do Mérito Naval da Espanha', NULL, 129, 13, 24),
(158, 'Ordem de lzabel, a Católica', NULL, 130, 13, 24),
(159, 'Medalha “Gruz Al Merito Almogávares”', NULL, 131, 13, 24),
(179, 'Medalha de Louvor da Marinha Americana', NULL, 133, 13, 25),
(180, 'Legião ao Mérito', NULL, 134, 13, 25),
(181, 'Medalha de Louvor do Exército Americano', NULL, 135, 13, 25),
(182, 'Medalha Serviço Meritório', NULL, 136, 13, 25),
(183, 'Medalha “Southwest Ásia Service Medal”', NULL, 137, 13, 25),
(184, 'Medalha “International Surface Warfare Officer School Merit Badge”', NULL, 138, 13, 25),
(185, 'Medalha “Red Interamericana de Telecomunicaciones Navales”', NULL, 139, 13, 25),
(186, 'Medalha “National Defense Service Medal”', NULL, 140, 13, 25),
(187, 'Medalha “Navy and Marine Corps Achievement Medal”', NULL, 141, 13, 25),
(188, 'Medalha “Meritorious Unit Commendation” ', NULL, 142, 13, 25),
(189, 'Medalha “Navy And Marine Corps Commendation Medal”', NULL, 143, 13, 25),
(190, 'Medalha da Defesa Nacional-Grau Ouro', NULL, 144, 13, 26),
(191, 'Medalha da Defesa Nacional-Grau Prata', NULL, 145, 13, 26),
(192, 'Medalha da Defesa Nacional-Grau Bronze', NULL, 146, 13, 26),
(193, 'Cruz de Guerra', NULL, 147, 13, 26),
(194, 'Ordem Nacional do Mérito da França', NULL, 148, 13, 26),
(195, 'Legião de Honra', NULL, 149, 13, 26),
(196, 'Ordem de Estrela Negra', NULL, 150, 13, 26),
(197, 'Ordem de Mérito Marítimo', NULL, 151, 13, 26),
(213, 'Real Ordem de Fênix', NULL, 152, 13, 27),
(214, 'Cruz do Mérito Militar', NULL, 153, 13, 28),
(215, 'Medalha “Monja Blanca de Segunda Classe”', NULL, 154, 13, 28),
(216, 'Ordem de Orange de Nassau', NULL, 155, 13, 29),
(217, 'Medalha ao Mérito II Classe', NULL, 156, 13, 30),
(218, 'Ordem Real Vitoriana', NULL, 157, 13, 31),
(219, 'Condecoração de Hemayeum', NULL, 158, 13, 32),
(220, 'Medalha Estrela de Solidariedade Italiana', NULL, 159, 13, 33),
(221, 'Ordem da Corôa da Itália', NULL, 160, 13, 33),
(222, 'Ordem de Mérito da República Italiana', NULL, 161, 13, 33),
(223, 'Medalha de Ouro do Estado-Maior da Marinha Italiana', NULL, 162, 13, 33),
(224, 'Medalha “Decorazione d’ Onore interforze dello Stato Maggiore della Difesa”', NULL, 163, 13, 33),
(225, 'Medalha Al Merito di Marina', NULL, 164, 13, 33),
(226, 'Ordem do Tesouro Sagrado', NULL, 165, 13, 34),
(227, 'Medalha da Junta lnteramericana de Defesa', NULL, 166, 13, 35),
(228, 'Ordem Nacional do Cedro', NULL, 167, 13, 36),
(229, 'Valor Militar – Grau Prata', NULL, 168, 13, 36),
(230, 'Ordem do Mérito do Grão-Ducado de Luxemburgo', NULL, 169, 13, 37),
(231, 'Ordem de Wissam Al-Alaoui', NULL, 170, 13, 38),
(232, 'Condecoração de Classe Única por Mérito Especial', NULL, 171, 13, 39),
(233, 'Medalha Militar do México', NULL, 172, 13, 39),
(234, 'Ordem da Águia Asteca', NULL, 174, 13, 39),
(235, 'Medalha Mérito Facultativo Naval', NULL, 175, 13, 39),
(236, 'Medalha Presidente Somoza', NULL, 176, 13, 40),
(237, 'Ordem Nacional Rubem Dário', NULL, 177, 13, 40),
(238, 'Medalha de Honra ao Mérito Militar \"Soldado de la Pátria\"', NULL, 178, 13, 40),
(239, 'Ordem Real de Santo Olavo', NULL, 179, 13, 41),
(240, 'Medalha das Nações Unidas', NULL, 180, 13, 42),
(241, 'Medalha ao Mérito da Força Interamericana de Paz', NULL, 181, 13, 43),
(242, 'Medalha da Organização dos Estados Americanos', NULL, 182, 13, 43),
(291, 'Medalha“Non-Article 5 Nato Medal for Operations and Activities in Relation to Africa”', NULL, 183, 13, 44),
(292, 'Medalha Honra ao Mérito da Guarda Nacional', NULL, 183, 13, 45),
(293, 'Medalha da Armada Nacional', NULL, 184, 13, 46),
(294, 'Ordem do Mérito Militar do Praguai', NULL, 185, 13, 46),
(295, 'Ordem Nacional do Mérito do Praguai', NULL, 186, 13, 46),
(296, 'Medalla del Ministerio de Defensa Nacional', NULL, 187, 13, 46),
(297, 'Cruz Peruana ao Mérito Naval', NULL, 188, 13, 47),
(298, 'Ordem Nacional o Sol do Peru', NULL, 189, 13, 47),
(299, 'Ordem Militar de Ayacucho', NULL, 190, 13, 47),
(300, 'Ordem do Mérito por Serviços Distintos', NULL, 191, 13, 47),
(301, 'Medalha Naval de Honra ao Mérito', NULL, 192, 13, 47),
(302, 'Medalha de Ouro da Armada Peruana', NULL, 193, 13, 47),
(303, 'Ordem da Recuperação da Polônia', NULL, 194, 13, 48),
(304, 'Cruz da Ordem do Mérito da República da Polônia', NULL, 195, 13, 48),
(305, 'Medalha “PRO MEMÓRIA”', NULL, 196, 13, 48),
(306, 'Medalha do Mérito Militar', NULL, 197, 13, 49),
(307, 'Medalha Naval de Vasco da Gama', NULL, 198, 13, 49),
(308, 'Ordem Militar de Cristo', NULL, 199, 13, 49),
(309, 'Ordem Militar de Avis', NULL, 200, 13, 49),
(310, 'Ordem Militar da Torre e Espada', NULL, 201, 13, 49),
(311, 'Ordem Militar de Santiago da Espada', NULL, 202, 13, 49),
(312, 'Ordem do Infante Dom Henrique', NULL, 203, 13, 49),
(313, 'Medalha Naval Comemorativa do 5º Centenário da Morte do Infante Dom Henrique', NULL, 204, 13, 49),
(314, 'Medalha da Cruz Naval', NULL, 205, 13, 49),
(343, 'Ordem do Mérito da Segurança Nacional', NULL, 206, 13, 50),
(344, 'Medalha de Serviço na Coréia', NULL, 207, 13, 50),
(345, 'Ordem do Mérito Juan Pablo Duarte', NULL, 208, 13, 51),
(346, 'Ordem Tudor Vladimirescu', NULL, 209, 13, 52),
(347, 'Estrela da Romênia', NULL, 210, 13, 52),
(348, 'Ordem Nacional da República do Senegal', NULL, 211, 13, 53),
(349, 'Ordem Real da Espada', NULL, 212, 13, 54),
(350, 'Medalha da Ordem Real da Estrela Polar', NULL, 213, 13, 54),
(351, 'Ordem de Honra da Palma', NULL, 214, 13, 55),
(352, 'Ordem do Mérito 3ª classe', NULL, 215, 13, 56),
(353, 'Medalha-Prêmio da Armada da República Oriental do Uruguai', NULL, 216, 13, 57),
(354, 'Medalha de Estado-Maior \"Honoris Causa\"', NULL, 217, 13, 57),
(355, 'Medalha de Honra ao Mérito Naval Comandante Pedro Campbell', NULL, 218, 13, 57),
(356, 'Medalha “15 de Noviembre de 1817”', NULL, 219, 13, 57),
(357, 'Ordem do Santo Sepulcro', NULL, 220, 13, 58),
(358, 'Ordem de São Gregório Magno', NULL, 221, 13, 58),
(359, 'Ordem de São Silvestre, Papa', NULL, 222, 13, 58),
(360, 'Ordem do Libertador', NULL, 223, 13, 59),
(361, 'Ordem do Mérito Naval da Venezuela', NULL, 224, 13, 59),
(362, 'Ordem Francisco de Miranda', NULL, 225, 13, 59),
(363, 'Cruz das Forças Terrestres Venezuelanas', NULL, 226, 13, 59),
(364, 'Medalha Naval Almirante Luiz Brión', NULL, 227, 13, 59),
(365, 'Medalha Naval Almirante Sebastián Francisco de Miranda', NULL, 228, 13, 59),
(366, 'Ordem Militar de Defesa Nacional', NULL, 229, 13, 59),
(367, 'Atos Distintivos em Tempo de Paz', NULL, 230, 13, 59),
(368, 'Mérito ao Serviço', NULL, 231, 13, 59),
(369, 'Medalha Naval “CA. José María García”', NULL, 232, 13, 59),
(370, 'Medalha “Servicios Distinguidos”', NULL, 233, 13, 59);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medalhas`
--

DROP TABLE IF EXISTS `medalhas`;
CREATE TABLE IF NOT EXISTS `medalhas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `imagem` varchar(150) NOT NULL,
  `ordem` int(5) NOT NULL DEFAULT '999',
  `origem_id` int(5) NOT NULL,
  `grupo_id` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `imagem` (`imagem`),
  KEY `med_origem_id_idx` (`origem_id`),
  KEY `med_grupo_id_idx` (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medalhas`
--

INSERT INTO `medalhas` (`id`, `nome`, `imagem`, `ordem`, `origem_id`, `grupo_id`) VALUES
(1, 'Cruz Naval', 'cruz_naval.jpg', 1, 4, 1),
(2, 'Medalha Cruz de Combate 1ª classe', 'medcruzcomb1.jpg', 2, 1, 2),
(3, 'Medalha Cruz de Combate 2ª classe', 'medcruzcomb2.jpg', 3, 1, 2),
(4, 'Cruz de Bravura', 'cruz_bravura.jpg', 4, 5, 3),
(5, 'Medalha Sangue do Brasil', 'msb.jpg', 5, 1, 4),
(6, 'Cruz de Sangue', 'cruz_de_sangue.jpg', 6, 5, 5),
(7, 'Cruz de Campanha', 'mc.jpg', 7, 4, 6),
(8, 'Medalha da Vitória (ex-Combatentes do Brasil, Seção Rio de Janeiro)', 'mvpras.jpg', 8, 3, 7),
(9, 'Medalha de Serviços Relevantes', 'm_servico_relevante.jpg', 9, 4, 8),
(10, 'Medalha de Serviços de Guerra	', 'guerra.jpg	', 10, 4, 9),
(11, 'FORCA NAVAL DO NORDESTE - OURO', 'mf_naval_nordeste_ouro.jpg', 11, 4, 10),
(12, 'FORCA NAVAL DO SUL - OURO', 'mf_naval_sul_ouro.JPG', 12, 4, 11),
(13, 'Medalha de Campanha', 'medc.jpg', 13, 1, 12),
(14, 'Cruz da Aviação Fita A', 'cruz_avi_a.jpg', 14, 5, 13),
(15, 'Cruz da Aviação Fita B', 'cruz_avi_b.jpg', 15, 5, 13),
(16, 'Medalha de Campanha na Itália', 'mc_italia.jpg', 16, 5, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `origens`
--

DROP TABLE IF EXISTS `origens`;
CREATE TABLE IF NOT EXISTS `origens` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(50) NOT NULL DEFAULT '',
  `ordem` int(5) NOT NULL DEFAULT '0',
  `descricao` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sigla` (`sigla`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `origens`
--

INSERT INTO `origens` (`id`, `sigla`, `ordem`, `descricao`) VALUES
(1, 'EB', 9, 'Exército Brasileiro'),
(2, 'MRE', 5, 'Ministério das Relações Exteriores (MRE)'),
(3, 'MD', 4, 'Ministério da Defesa (MD)'),
(4, 'MB', 1, 'Marinha do Brasil'),
(5, 'FAB', 10, 'Força Aérea Brasileira (FAB)'),
(6, 'MInt', 11, 'Medalhas Internacionais'),
(7, 'STM', 7, 'Superior Tribunal Militar (STM)'),
(8, 'MPM', 8, 'Ministério Público Militar (MPM)'),
(9, 'MT', 6, 'Ministério dos Transportes'),
(10, 'MJ', 3, 'Ministério da Justiça (MJ)'),
(11, 'CCPR', 2, 'Casa Civil da Presidência da República'),
(12, 'Outros', 12, 'Outros Órgãos'),
(13, 'DE', 13, 'Alemanha'),
(14, 'AMAS', 14, 'Área Marítima do Atlântico Sul '),
(15, 'AR', 15, 'Argentina'),
(16, 'BE', 16, 'Bélgica'),
(17, 'BO', 17, 'Bolívia'),
(18, 'CL', 18, 'Chile'),
(19, 'CO', 19, 'Colômbia'),
(20, 'CIDM', 20, 'Conselho Internacional do Desporto Militar'),
(21, 'CR', 21, 'Costa Rica'),
(22, 'DK', 22, 'Dinamarca'),
(23, 'EC', 23, 'Equador'),
(24, 'ES', 24, 'Espanha'),
(25, 'US', 25, 'Estados Unidos da América'),
(26, 'FR', 26, 'França'),
(27, 'GR', 27, 'Grécia'),
(28, 'GT', 28, 'Guatemala'),
(29, 'NL', 29, 'Holanda'),
(30, 'HN', 30, 'Honduras'),
(31, 'GB', 31, 'Inglaterra'),
(32, 'IR', 32, 'Irã'),
(33, 'IT', 33, 'Itália'),
(34, 'JP', 34, 'Japão'),
(35, 'JID', 35, 'Junta Interamericana de Defesa'),
(36, 'LB', 36, 'Líbano'),
(37, 'LU', 37, 'Luxemburgo'),
(38, 'MA', 38, 'Marrocos'),
(39, 'MX', 39, 'México'),
(40, 'NI', 40, 'Nicarágua'),
(41, 'NO', 41, 'Noruega'),
(42, 'ONU', 42, 'Organização das Nações Unidas'),
(43, 'OEA', 43, 'Organização dos Estados Americanos'),
(44, 'OTAN', 44, 'Organização do Tratado do Atlântico Norte'),
(45, 'PA', 45, 'Panamá'),
(46, 'PY', 46, 'Paraguai'),
(47, 'PE', 47, 'Peru'),
(48, 'PL', 48, 'Polônia'),
(49, 'PT', 49, 'Portugal'),
(50, 'KR', 50, 'República da Coréia'),
(51, 'DO', 51, 'República Dominicana'),
(52, 'RO', 52, 'Romênia'),
(53, 'SN', 53, 'Senegal'),
(54, 'SE', 54, 'Suécia'),
(55, 'SR', 55, 'Suriname'),
(56, 'UA', 56, 'Ucrânia'),
(57, 'UY', 57, 'Uruguai'),
(58, 'VA', 58, 'Vaticano'),
(59, 'VE', 59, 'Venezuela'),
(99, 'PROVI', 99, 'origem provisória (deletar)');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `categoria_id` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `origem_id` FOREIGN KEY (`origem_id`) REFERENCES `origens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `medalhas`
--
ALTER TABLE `medalhas`
  ADD CONSTRAINT `med_grupo_id` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `med_origem_id` FOREIGN KEY (`origem_id`) REFERENCES `origens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
