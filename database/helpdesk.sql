-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           10.4.20-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando dados para a tabela helpdesk.chamados: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `chamados` DISABLE KEYS */;
INSERT INTO `chamados` (`chamado_id`, `id_user_id`, `data_criacao`, `data_fechamento`, `prioridade`, `descricao`, `problema`, `imagem`, `setor`, `tipo`, `status`, `urgencia`, `impacto`, `contesta`) VALUES
	(19, 66, '2021-06-25 17:51:05', NULL, 2, 'Estava utilizando meu PC normalmente quando do nada meu monitor queimou, preciso da  troca urgentemente.', 'Monitor queimado', '/public/images/chamados/monitor_queimado.jpg', 'Financeiro', 'Problema de Hardware', 4, 'Altíssima', 'Médio', NULL),
	(20, 66, '2021-06-25 18:08:09', '2021-06-26 01:48:59', 4, 'Nossas maquinas estão demasiadamente lentas, preciso que sejam instalado SSDs.', 'Instalar SSD nas máquinas.', '/public/images/chamados/ssd.jpg', 'Financeiro', 'Melhoria', 4, 'Baixa', 'Médio', NULL),
	(21, 61, '2021-06-25 18:13:19', NULL, 1, 'A pagina de vendas está com aviso de sem resposta.', 'Pagina sem resposta', '/public/images/chamados/3x81as4c6wl61.png', 'Vendas', 'Problema de Software', 2, 'Altíssima', 'Altíssimo', NULL),
	(22, 66, '2021-06-25 19:58:10', NULL, 2, 'Estou criando este chamado no momento da apresentação do trabalho!!', 'Chamado teste', '/public/images/chamados/Captura_de_Tela_(10).png', 'Vendas', 'Problema de Hardware', 4, 'Média', 'Altíssimo', 'O problema não foi resolvido!'),
	(23, 66, '2021-06-25 21:10:40', '2021-06-26 02:18:17', 2, 'Meu pc reinicia sozinho a todo momento.', 'Pc reiniciando sozinho', NULL, 'Financeiro', 'Problema de Hardware', 4, 'Alta', 'Alto', 'Ta reiniciando ainda!'),
	(24, 60, '2021-07-02 18:05:34', NULL, 4, 'Meu email é da globo', 'O sbt esta com problema', '/public/images/chamados/702814.png', 'Financeiro', 'Problema de Hardware', 3, 'Média', 'Baixo', NULL);
/*!40000 ALTER TABLE `chamados` ENABLE KEYS */;

-- Copiando dados para a tabela helpdesk.usuarios: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`ativo`, `user_id`, `email`, `senha_hash`, `nome_completo`, `permissao`) VALUES
	(1, 1, 'jonasbastani1999@gmail.com', '$2y$10$DFH1kc7i6TiYfqTIXFoWF.jLNPXwsXcLcfdstCaypCAD4s5ADmK22', 'Jonas Bastani', 2),
	(1, 3, 'LucasH@gmail.com', '$2y$10$DFH1kc7i6TiYfqTIXFoWF.jLNPXwsXcLcfdstCaypCAD4s5ADmK22', 'Lucas Henrique', 1),
	(1, 4, 'karolmathias@hotmail.com', '$2y$10$822Qmi9H4RarcykTTpP9h.wn1J02D2cfx1IyRL9pbDA4Bx4VHX8Pa', 'Karolina Mathias', 2),
	(0, 55, 'jonasluz@outlook.com', '$2y$10$2rNWEGaWVd827uHwpn1Js.6zVS9kDY2r2ya7z4qIFkx5GIVu6uKda', 'Jonas Bastani da Silva Luz', 0),
	(1, 60, 'silviosantos@globo.com.br', '$2y$10$goL1xUKxII5zeIphsK3V/Ocy7Zvyw7Q4l8vVLzxc23NuHOHo/VR9m', 'Silvio Santos', 0),
	(1, 61, 'fernandacristina@hotmail.com', '$2y$10$wwxdHDsnPvR6Hxq1ZbKtM.PsUW3aGvV2WmJ6CDRwkEakJqeXr.SUa', 'Fernanda Cristina', 0),
	(1, 62, 'iza@outlook.com', '$2y$10$0leTwHJwt0kotieLjGUSFO70UtQ83euEmu77ZhQ1sOnkGMK0AAILW', 'Izabely Henriques', 2),
	(1, 63, 'brunoleopoldo@hotmail.com', '$2y$10$56LG2IfO/Hm0pkZRtC9pD.qPbSa24Nsi0u/ncjy.F28YrA81JV0Q6', 'Bruno Leopoldo', 1),
	(1, 65, 'gui38g@gmail.com', '$2y$10$y9NuiqE1mSsLAsLHMVDY6e52P8j0WTWdABh4dfs37wCfSQyvJHk7S', 'Guilherme de Souza', 1),
	(1, 66, 'erickbatista@gmail.com', '$2y$10$Fpqtp98juLKlJxE2wNtMq.tlrkAxmT7KwiqC9y5XIH68OpVACDx1y', 'Erick Batista', 0),
	(0, 67, 'dudu@hotmail.com', '$2y$10$5mINORVCv/9jP6lgoAm/o.pF4GUtiVBSFJBe7.hXOpdZt6otm/rb6', 'Eduardo Daniel', 1),
	(1, 68, 'teste@teste', '$2y$10$w8XAiMBY59Fo0QG.V9tRiujsVXUO74g/RETFFVYFejt/CwnJGKko2', 'Teste', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
