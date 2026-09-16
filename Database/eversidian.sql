-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Set-2026 às 22:37
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `eversidian`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `amizades`
--

CREATE TABLE `amizades` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_amigo` int(11) NOT NULL,
  `status` enum('pendente','aceito','rejeitado') DEFAULT 'pendente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `campanhas`
--

CREATE TABLE `campanhas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `max_jogadores` int(11) DEFAULT 5,
  `status` enum('aberto','fechado','finalizado') DEFAULT 'aberto',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `campanha_participantes`
--

CREATE TABLE `campanha_participantes` (
  `id` int(11) NOT NULL,
  `id_campanha` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_personagem` int(11) DEFAULT NULL,
  `papel` enum('jogador','mestre','co_mestre') DEFAULT 'jogador',
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `id_usuario`, `created_at`) VALUES
(1, 2, '2026-09-16 19:41:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_itens`
--

CREATE TABLE `carrinho_itens` (
  `id` int(11) NOT NULL,
  `id_carrinho` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `carrinho_itens`
--

INSERT INTO `carrinho_itens` (`id`, `id_carrinho`, `id_produto`, `quantidade`) VALUES
(1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`) VALUES
(1, 'Tomos & Pergaminhos', 'O conhecimento é a maior arma. Adquira livros de regras, bestiários, suplementos de classes e campanhas prontas (em formato físico ou pergaminhos digitais em PDF).'),
(2, 'Relíquias dos Cosmos', 'Instrumentos tocados pelo destino. Encontre conjuntos de dados de resina, metal ou osso, torres de rolagem, bolsas de couro e escudos do mestre para a sua mesa.'),
(3, 'Cartografia do Vácuo', 'O palco da sua lenda. Mapas de batalha detalhados, grids táteis e cenários imersivos prontos para impressão física ou integração na Mesa Virtual (VTT).'),
(4, 'Efígies & Invocações', 'Dê um rosto aos heróis e aos pesadelos. Miniaturas físicas detalhadas de monstros e personagens, ou arquivos digitais (.STL) para impressão 3D na sua própria forja.'),
(5, 'Manifestações Arcanas', 'A magia visual para a sua Mesa Virtual (VTT). Pacotes de tokens de personagens, molduras de avatares personalizadas e animações de feitiços e efeitos visuais.'),
(6, 'Ecos do Além', 'A atmosfera sonora do seu mundo. Trilhas sonoras épicas, melodias de taverna e efeitos de áudio (choques de espadas, tempestades, magias) para aprofundar a imersão da sua narrativa.'),
(7, 'Espólios & Relicários', 'Traga o Vácuo para o plano real. Action figures detalhadas, réplicas de artefatos, copos de taverna, vestuário oficial e itens de colecionador exclusivos adornados com as marcas do Eversidian.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text DEFAULT NULL,
  `bonus_vida` int(11) DEFAULT 0,
  `bonus_mana` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conquistas`
--

CREATE TABLE `conquistas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `recompensa` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cronicas`
--

CREATE TABLE `cronicas` (
  `id` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `id_campanha` int(11) DEFAULT NULL,
  `titulo` varchar(150) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `resumo` text DEFAULT NULL,
  `conteudo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `efeitos`
--

CREATE TABLE `efeitos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `tipo` enum('buff','debuff') DEFAULT NULL,
  `duracao_turnos` int(11) DEFAULT 1,
  `efeito_valor` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `tipo` enum('arma','armadura','acessorio','escudo') DEFAULT NULL,
  `bonus_forca` int(11) DEFAULT 0,
  `bonus_agilidade` int(11) DEFAULT 0,
  `bonus_inteligencia` int(11) DEFAULT 0,
  `bonus_defesa` int(11) DEFAULT 0,
  `raridade` enum('comum','raro','epico','lendario') DEFAULT 'comum',
  `nivel_minimo` int(11) DEFAULT 1,
  `preco` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  `recompensa` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `guildas`
--

CREATE TABLE `guildas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `id_lider` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `guilda_membros`
--

CREATE TABLE `guilda_membros` (
  `id` int(11) NOT NULL,
  `id_guilda` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cargo` enum('membro','oficial','lider') DEFAULT 'membro',
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `habilidades`
--

CREATE TABLE `habilidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `custo_mana` int(11) DEFAULT 0,
  `dano` int(11) DEFAULT 0,
  `cooldown` int(11) DEFAULT 0,
  `tipo` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventarios`
--

CREATE TABLE `inventarios` (
  `id` int(11) NOT NULL,
  `id_personagem` int(11) NOT NULL,
  `max_slots` int(11) DEFAULT 27,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventario_itens`
--

CREATE TABLE `inventario_itens` (
  `id` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE `itens` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `raridade` enum('comum','raro','épico','lendário','mítico') DEFAULT 'comum',
  `tipo_item` varchar(50) DEFAULT NULL,
  `bonus_ataque` int(11) DEFAULT 0,
  `bonus_defesa` int(11) DEFAULT 0,
  `preco` decimal(10,2) DEFAULT 0.00,
  `imagem` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `acao` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id`, `id_usuario`, `acao`, `ip_address`, `created_at`) VALUES
(1, 1, 'Forjou o artefato com imagem: Artefato Físico: Espada do Poder - He-Man', '::1', '2026-09-16 19:18:21'),
(2, 1, 'Forjou o artefato com imagem: Artefato Físico: Action Figure Kit Bodega', '::1', '2026-09-16 19:31:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `magias`
--

CREATE TABLE `magias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `elemento` varchar(50) DEFAULT NULL,
  `custo_mana` int(11) DEFAULT 0,
  `dano` int(11) DEFAULT 0,
  `area_efeito` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mapas`
--

CREATE TABLE `mapas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `nivel_minimo` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `id_remetente` int(11) NOT NULL,
  `id_destinatario` int(11) DEFAULT NULL,
  `id_campanha` int(11) DEFAULT NULL,
  `mensagem` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `missoes`
--

CREATE TABLE `missoes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `recompensa_xp` int(11) DEFAULT 0,
  `recompensa_ouro` int(11) DEFAULT 0,
  `nivel_recomendado` int(11) DEFAULT 1,
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `conteudo` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `npcs`
--

CREATE TABLE `npcs` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `vida` int(11) DEFAULT 100,
  `hostile` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `metodo_pagamento` varchar(50) DEFAULT NULL,
  `codigo_transacao` varchar(100) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `status` enum('pendente','aprovado','rejeitado') DEFAULT 'pendente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pendente','pago','cancelado') DEFAULT 'pendente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_itens`
--

CREATE TABLE `pedido_itens` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT 1,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `nome_permissao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personagem_conquistas`
--

CREATE TABLE `personagem_conquistas` (
  `id` int(11) NOT NULL,
  `id_personagem` int(11) NOT NULL,
  `id_conquista` int(11) NOT NULL,
  `unlocked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personagem_efeitos`
--

CREATE TABLE `personagem_efeitos` (
  `id` int(11) NOT NULL,
  `id_personagem` int(11) NOT NULL,
  `id_efeito` int(11) NOT NULL,
  `turnos_restantes` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personagem_equipamentos`
--

CREATE TABLE `personagem_equipamentos` (
  `id` int(11) NOT NULL,
  `id_personagem` int(11) NOT NULL,
  `id_equipamento` int(11) NOT NULL,
  `equipado` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personagem_habilidades`
--

CREATE TABLE `personagem_habilidades` (
  `id` int(11) NOT NULL,
  `id_personagem` int(11) NOT NULL,
  `id_habilidade` int(11) NOT NULL,
  `nivel_habilidade` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personagem_magias`
--

CREATE TABLE `personagem_magias` (
  `id` int(11) NOT NULL,
  `id_personagem` int(11) NOT NULL,
  `id_magia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personagem_missoes`
--

CREATE TABLE `personagem_missoes` (
  `id` int(11) NOT NULL,
  `id_personagem` int(11) NOT NULL,
  `id_missao` int(11) NOT NULL,
  `status` enum('em_progresso','concluído','falhou') DEFAULT 'em_progresso',
  `progresso` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personagens`
--

CREATE TABLE `personagens` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_raca` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nivel` int(11) DEFAULT 1,
  `experiencia` int(11) DEFAULT 0,
  `vida` int(11) DEFAULT 100,
  `mana` int(11) DEFAULT 100,
  `forca` int(11) DEFAULT 10,
  `agilidade` int(11) DEFAULT 10,
  `inteligencia` int(11) DEFAULT 10,
  `ouro` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `id_personagem` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `especie` varchar(100) DEFAULT NULL,
  `nivel` int(11) DEFAULT 1,
  `vida` int(11) DEFAULT 100,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(11) DEFAULT 0,
  `tipo` enum('físico','virtual') DEFAULT 'virtual',
  `imagem` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `id_categoria`, `nome`, `descricao`, `preco`, `estoque`, `tipo`, `imagem`, `created_at`) VALUES
(1, 7, 'Espada do Poder - He-Man', 'A Espada do Poder é o símbolo absoluto de força e bravura de Eternia, forjada para canalizar energias cósmicas insondáveis. Com um design brutal e imponente, sua lâmina larga e espessa culmina em uma guarda cruzada icônica, feita para suportar os impactos mais devastadores. Imensa, pesada e de presença inegável, esta relíquia indestrutível não é apenas uma arma formidável, mas a chave lendária destinada àquele que tem a coragem de erguê-la aos céus e reivindicar os segredos do Castelo de Grayskull.', '1500.00', 100, 'físico', 'item_6aaaeb7d5a583.webp', '2026-09-16 19:18:21'),
(2, 7, 'Action Figure Kit Bodega', 'Esta action figure da Kit traz toda a atitude e a estética vibrante do Gameoverse direto para o mundo físico. Esculpida com atenção meticulosa aos detalhes, a figura captura o design inconfundível da personagem, destacando suas cores marcantes e sua silhueta expressiva. Com múltiplos pontos de articulação premium e pintura de alta qualidade, ela permite recriar poses ágeis e dinâmicas com perfeição. Acompanhada de seus gadgets clássicos e de uma base temática, é uma peça de exibição carismática que traduz toda a energia do seu universo para a escala colecionável.', '300.00', 100, 'físico', 'item_6aaaee97182e5.jpg', '2026-09-16 19:31:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `racas`
--

CREATE TABLE `racas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text DEFAULT NULL,
  `bonus_forca` int(11) DEFAULT 0,
  `bonus_agilidade` int(11) DEFAULT 0,
  `bonus_inteligencia` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome_usuario` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `role` enum('jogador','moderador','gmAdmin') DEFAULT 'jogador',
  `status` enum('ativo','banido','inativo') DEFAULT 'ativo',
  `banido_ate` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome_usuario`, `email`, `senha`, `foto_perfil`, `role`, `status`, `banido_ate`, `created_at`, `updated_at`) VALUES
(1, 'Shenlord', 'admin@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bm96bWc5RFZCRkxaTHVMRw$KFibG2Ji+ica4uPkkSWGt0JepsCBK4BAUYIDJL266kc', NULL, 'gmAdmin', 'ativo', NULL, '2026-06-09 00:52:15', '2026-06-09 01:07:02'),
(2, 'Trombone', 'trombeta@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$dmxmRm1SRzhULzdrZnpxdg$33mf/oaJXWLcBsd772oFPKfCSlDx5qS9f7TamxlReAo', NULL, 'jogador', 'ativo', NULL, '2026-09-16 18:55:42', '2026-09-16 18:55:42');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `amizades`
--
ALTER TABLE `amizades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_amigo` (`id_amigo`);

--
-- Índices para tabela `campanhas`
--
ALTER TABLE `campanhas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `campanha_participantes`
--
ALTER TABLE `campanha_participantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_campanha` (`id_campanha`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_personagem` (`id_personagem`);

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `carrinho_itens`
--
ALTER TABLE `carrinho_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carrinho` (`id_carrinho`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `conquistas`
--
ALTER TABLE `conquistas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cronicas`
--
ALTER TABLE `cronicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_autor` (`id_autor`),
  ADD KEY `id_campanha` (`id_campanha`);

--
-- Índices para tabela `efeitos`
--
ALTER TABLE `efeitos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `guildas`
--
ALTER TABLE `guildas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `id_lider` (`id_lider`);

--
-- Índices para tabela `guilda_membros`
--
ALTER TABLE `guilda_membros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guilda` (`id_guilda`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `habilidades`
--
ALTER TABLE `habilidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_personagem` (`id_personagem`);

--
-- Índices para tabela `inventario_itens`
--
ALTER TABLE `inventario_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inventario` (`id_inventario`),
  ADD KEY `id_item` (`id_item`);

--
-- Índices para tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `magias`
--
ALTER TABLE `magias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `mapas`
--
ALTER TABLE `mapas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_remetente` (`id_remetente`),
  ADD KEY `id_destinatario` (`id_destinatario`),
  ADD KEY `id_campanha` (`id_campanha`);

--
-- Índices para tabela `missoes`
--
ALTER TABLE `missoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `npcs`
--
ALTER TABLE `npcs`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices para tabela `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `personagem_conquistas`
--
ALTER TABLE `personagem_conquistas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personagem` (`id_personagem`),
  ADD KEY `id_conquista` (`id_conquista`);

--
-- Índices para tabela `personagem_efeitos`
--
ALTER TABLE `personagem_efeitos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personagem` (`id_personagem`),
  ADD KEY `id_efeito` (`id_efeito`);

--
-- Índices para tabela `personagem_equipamentos`
--
ALTER TABLE `personagem_equipamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personagem` (`id_personagem`),
  ADD KEY `id_equipamento` (`id_equipamento`);

--
-- Índices para tabela `personagem_habilidades`
--
ALTER TABLE `personagem_habilidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personagem` (`id_personagem`),
  ADD KEY `id_habilidade` (`id_habilidade`);

--
-- Índices para tabela `personagem_magias`
--
ALTER TABLE `personagem_magias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personagem` (`id_personagem`),
  ADD KEY `id_magia` (`id_magia`);

--
-- Índices para tabela `personagem_missoes`
--
ALTER TABLE `personagem_missoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personagem` (`id_personagem`),
  ADD KEY `id_missao` (`id_missao`);

--
-- Índices para tabela `personagens`
--
ALTER TABLE `personagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_raca` (`id_raca`),
  ADD KEY `id_classe` (`id_classe`);

--
-- Índices para tabela `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personagem` (`id_personagem`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices para tabela `racas`
--
ALTER TABLE `racas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome_usuario` (`nome_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `amizades`
--
ALTER TABLE `amizades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `campanhas`
--
ALTER TABLE `campanhas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `campanha_participantes`
--
ALTER TABLE `campanha_participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `carrinho_itens`
--
ALTER TABLE `carrinho_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conquistas`
--
ALTER TABLE `conquistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cronicas`
--
ALTER TABLE `cronicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `efeitos`
--
ALTER TABLE `efeitos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `guildas`
--
ALTER TABLE `guildas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `guilda_membros`
--
ALTER TABLE `guilda_membros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `inventario_itens`
--
ALTER TABLE `inventario_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `magias`
--
ALTER TABLE `magias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mapas`
--
ALTER TABLE `mapas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `missoes`
--
ALTER TABLE `missoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `npcs`
--
ALTER TABLE `npcs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personagem_conquistas`
--
ALTER TABLE `personagem_conquistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personagem_efeitos`
--
ALTER TABLE `personagem_efeitos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personagem_equipamentos`
--
ALTER TABLE `personagem_equipamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personagem_habilidades`
--
ALTER TABLE `personagem_habilidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personagem_magias`
--
ALTER TABLE `personagem_magias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personagem_missoes`
--
ALTER TABLE `personagem_missoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personagens`
--
ALTER TABLE `personagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `racas`
--
ALTER TABLE `racas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `amizades`
--
ALTER TABLE `amizades`
  ADD CONSTRAINT `amizades_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `amizades_ibfk_2` FOREIGN KEY (`id_amigo`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `campanha_participantes`
--
ALTER TABLE `campanha_participantes`
  ADD CONSTRAINT `campanha_participantes_ibfk_1` FOREIGN KEY (`id_campanha`) REFERENCES `campanhas` (`id`),
  ADD CONSTRAINT `campanha_participantes_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `campanha_participantes_ibfk_3` FOREIGN KEY (`id_personagem`) REFERENCES `personagens` (`id`);

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `carrinho_itens`
--
ALTER TABLE `carrinho_itens`
  ADD CONSTRAINT `carrinho_itens_ibfk_1` FOREIGN KEY (`id_carrinho`) REFERENCES `carrinho` (`id`),
  ADD CONSTRAINT `carrinho_itens_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `cronicas`
--
ALTER TABLE `cronicas`
  ADD CONSTRAINT `cronicas_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `cronicas_ibfk_2` FOREIGN KEY (`id_campanha`) REFERENCES `campanhas` (`id`);

--
-- Limitadores para a tabela `guildas`
--
ALTER TABLE `guildas`
  ADD CONSTRAINT `guildas_ibfk_1` FOREIGN KEY (`id_lider`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `guilda_membros`
--
ALTER TABLE `guilda_membros`
  ADD CONSTRAINT `guilda_membros_ibfk_1` FOREIGN KEY (`id_guilda`) REFERENCES `guildas` (`id`),
  ADD CONSTRAINT `guilda_membros_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `inventarios`
--
ALTER TABLE `inventarios`
  ADD CONSTRAINT `inventarios_ibfk_1` FOREIGN KEY (`id_personagem`) REFERENCES `personagens` (`id`);

--
-- Limitadores para a tabela `inventario_itens`
--
ALTER TABLE `inventario_itens`
  ADD CONSTRAINT `inventario_itens_ibfk_1` FOREIGN KEY (`id_inventario`) REFERENCES `inventarios` (`id`),
  ADD CONSTRAINT `inventario_itens_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `itens` (`id`);

--
-- Limitadores para a tabela `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `mensagens_ibfk_1` FOREIGN KEY (`id_remetente`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `mensagens_ibfk_2` FOREIGN KEY (`id_destinatario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `mensagens_ibfk_3` FOREIGN KEY (`id_campanha`) REFERENCES `campanhas` (`id`);

--
-- Limitadores para a tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`);

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD CONSTRAINT `pedido_itens_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `pedido_itens_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `personagem_conquistas`
--
ALTER TABLE `personagem_conquistas`
  ADD CONSTRAINT `personagem_conquistas_ibfk_1` FOREIGN KEY (`id_personagem`) REFERENCES `personagens` (`id`),
  ADD CONSTRAINT `personagem_conquistas_ibfk_2` FOREIGN KEY (`id_conquista`) REFERENCES `conquistas` (`id`);

--
-- Limitadores para a tabela `personagem_efeitos`
--
ALTER TABLE `personagem_efeitos`
  ADD CONSTRAINT `personagem_efeitos_ibfk_1` FOREIGN KEY (`id_personagem`) REFERENCES `personagens` (`id`),
  ADD CONSTRAINT `personagem_efeitos_ibfk_2` FOREIGN KEY (`id_efeito`) REFERENCES `efeitos` (`id`);

--
-- Limitadores para a tabela `personagem_equipamentos`
--
ALTER TABLE `personagem_equipamentos`
  ADD CONSTRAINT `personagem_equipamentos_ibfk_1` FOREIGN KEY (`id_personagem`) REFERENCES `personagens` (`id`),
  ADD CONSTRAINT `personagem_equipamentos_ibfk_2` FOREIGN KEY (`id_equipamento`) REFERENCES `equipamentos` (`id`);

--
-- Limitadores para a tabela `personagem_habilidades`
--
ALTER TABLE `personagem_habilidades`
  ADD CONSTRAINT `personagem_habilidades_ibfk_1` FOREIGN KEY (`id_personagem`) REFERENCES `personagens` (`id`),
  ADD CONSTRAINT `personagem_habilidades_ibfk_2` FOREIGN KEY (`id_habilidade`) REFERENCES `habilidades` (`id`);

--
-- Limitadores para a tabela `personagem_magias`
--
ALTER TABLE `personagem_magias`
  ADD CONSTRAINT `personagem_magias_ibfk_1` FOREIGN KEY (`id_personagem`) REFERENCES `personagens` (`id`),
  ADD CONSTRAINT `personagem_magias_ibfk_2` FOREIGN KEY (`id_magia`) REFERENCES `magias` (`id`);

--
-- Limitadores para a tabela `personagem_missoes`
--
ALTER TABLE `personagem_missoes`
  ADD CONSTRAINT `personagem_missoes_ibfk_1` FOREIGN KEY (`id_personagem`) REFERENCES `personagens` (`id`),
  ADD CONSTRAINT `personagem_missoes_ibfk_2` FOREIGN KEY (`id_missao`) REFERENCES `missoes` (`id`);

--
-- Limitadores para a tabela `personagens`
--
ALTER TABLE `personagens`
  ADD CONSTRAINT `personagens_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `personagens_ibfk_2` FOREIGN KEY (`id_raca`) REFERENCES `racas` (`id`),
  ADD CONSTRAINT `personagens_ibfk_3` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id`);

--
-- Limitadores para a tabela `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`id_personagem`) REFERENCES `personagens` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
