-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 05, 2022 alle 20:01
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progetto`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `blog`
--

CREATE TABLE `blog` (
  `id_blog` int(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id_grafica` int(100) DEFAULT NULL,
  `id_tema` int(100) DEFAULT NULL,
  `id_user` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `blog`
--

INSERT INTO `blog` (`id_blog`, `nome`, `id_grafica`, `id_tema`, `id_user`) VALUES
(128, 'Gatti', 62, 1, 79),
(130, 'cani', 64, 1, 79),
(131, 'Svizzera', 65, 11, 80),
(132, 'Italia', 66, 11, 80),
(133, 'Calcio', 67, 9, 83),
(134, 'Tennis', 68, 9, 83),
(135, 'Cucina italiana', 69, 5, 82),
(136, 'Cucina Araba', 70, 5, 82),
(137, 'Reggae', 71, 8, 81),
(138, 'Blues', 72, 8, 81);

-- --------------------------------------------------------

--
-- Struttura della tabella `coautore`
--

CREATE TABLE `coautore` (
  `id_blog` int(100) NOT NULL,
  `id_user` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `coautore`
--

INSERT INTO `coautore` (`id_blog`, `id_user`) VALUES
(128, 80),
(131, 82),
(133, 80),
(134, 81),
(135, 79),
(136, 81),
(137, 79),
(138, 82);

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `id_commento` int(100) NOT NULL,
  `id_post` int(100) DEFAULT NULL,
  `id_user` int(100) DEFAULT NULL,
  `testo` varchar(140) NOT NULL,
  `data` date NOT NULL,
  `ora` time(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`id_commento`, `id_post`, `id_user`, `testo`, `data`, `ora`) VALUES
(23, 43, 80, 'Adoro', '2022-06-02', '12:00:00.0000'),
(24, 51, 81, 'che squadra!', '2022-06-02', '14:36:08.0000'),
(25, 53, 80, 'Non mi piacciono', '2022-06-02', '18:00:00.0000'),
(26, 53, 82, 'Bellissimi', '2022-06-02', '13:00:00.0000'),
(27, 44, 80, 'IL migliore', '2022-06-02', '16:18:00.0000');

-- --------------------------------------------------------

--
-- Struttura della tabella `grafica`
--

CREATE TABLE `grafica` (
  `id_grafica` int(100) NOT NULL,
  `font` varchar(50) DEFAULT NULL,
  `colore_font` text DEFAULT NULL,
  `sfondo` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `grafica`
--

INSERT INTO `grafica` (`id_grafica`, `font`, `colore_font`, `sfondo`) VALUES
(62, 'Roboto', '#b12b2b', 'gatti.jpg'),
(63, 'Comic Sans MS', '#6035fd', 'gatti.jpg'),
(64, 'Times New Roman', '#b42727', 'cani.jpg'),
(65, 'Roboto', '#000000', 'svizzera.jpg'),
(66, 'Times New Roman', '#56c2e6', 'italia.jpg'),
(67, 'Comic Sans MS', '#a05a5a', 'calcio.jpg'),
(68, 'Roboto', '#7b7d08', 'tennis.jpg'),
(69, 'Comic Sans MS', '#282db8', 'cucina1.jpg'),
(70, 'Comic Sans MS', '#48bef9', 'cucina2.jpg'),
(71, 'Comic Sans MS', '#b31414', 'reggae.jpg'),
(72, 'Default', '#000000', 'blues.jpg'),
(73, 'Times New Roman', '#000000', 'reggae.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `id_post` int(100) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `ora` time(4) NOT NULL,
  `data` date NOT NULL,
  `id_blog` int(100) DEFAULT NULL,
  `id_utente` int(100) NOT NULL,
  `testo` varchar(200) NOT NULL,
  `immagine` varchar(50) NOT NULL,
  `immagine1` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`id_post`, `titolo`, `ora`, `data`, `id_blog`, `id_utente`, `testo`, `immagine`, `immagine1`) VALUES
(43, 'Bob Marley', '10:00:00.0000', '2022-06-01', 137, 81, 'Bob Marley, nato Robert Nesta Marley (Nine Mile, 6 febbraio 1945 – Miami, 11 maggio 1981), è stato un cantautore, chitarrista e attivista giamaicano.', 'bob.jpg', 'bob1.jpg'),
(44, 'Jimi Hendrix', '11:25:00.0000', '2022-06-01', 138, 81, 'James Marshall \"Jimi\" Hendrix, nato Johnny Allen Hendrix, è stato un chitarrista e cantautore statunitense.', 'jimi.jpg', ''),
(45, 'Rafa Nadal', '12:26:00.0000', '2022-06-01', 134, 81, 'Rafael Nadal Parera, detto Rafa, è un tennista spagnolo, numero 5 della classifica ATP.', 'nadal.jpg', ''),
(46, 'Ginevra', '12:27:00.0000', '2022-06-01', 131, 80, 'Ginevra è una città svizzera all’estremità meridionale del grande Lago Lemàno o Lago di Ginevra.', 'ginevra.jpg', ''),
(47, 'Roma', '12:30:00.0000', '2022-06-01', 132, 80, 'Roma, capitale dell’Italia, è una grande città cosmopolita con una storia artistica, architettonica e culturale che ha influenzato tutto il mondo e che risale a quasi 3000 anni fa.', 'roma.jpg', ''),
(48, 'Siamesi', '13:00:00.7250', '2022-06-01', 128, 80, 'Il siamese è un gatto di origine asiatica, del Siam, dal corpo elegante e longilineo e la particolare testa triangolare.', 'siamese.jpg', ''),
(49, 'Pasta al pesto', '13:07:00.0000', '2022-06-01', 135, 82, 'Il pesto alla genovese è un condimento tradizionale tipico originario della Liguria.', 'pesto.jpg', ''),
(50, 'Kebab', '14:19:00.0000', '2022-06-01', 136, 82, 'Il kebab è un piatto a base di carne arrostita di origine mediorientale, divenuto popolare in tutto il mondo grazie alle migrazioni', 'kebab.jpg', ''),
(51, 'Brasile', '16:38:00.0000', '2022-06-01', 133, 83, 'Il Brasile è stato 5 volte campione del mondo', 'brasile.jpg', ''),
(52, 'Labrador', '18:11:00.0000', '2022-06-01', 130, 83, 'I labrador sono cani molto mansueti', 'labrador.jpg', ''),
(53, 'Pitbull', '19:31:00.0000', '2022-06-01', 130, 79, 'I pitbull sono cani di stazza media-grande', 'pitbull.jpg', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `reazione`
--

CREATE TABLE `reazione` (
  `id_reazione` int(100) NOT NULL,
  `id_utente` int(100) DEFAULT NULL,
  `id_post` int(100) DEFAULT NULL,
  `positivo` tinyint(1) NOT NULL,
  `negativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `reazione`
--

INSERT INTO `reazione` (`id_reazione`, `id_utente`, `id_post`, `positivo`, `negativo`) VALUES
(133298, 79, 46, 1, 0),
(133299, 81, 50, 1, 0),
(133300, 80, 49, 1, 0),
(133301, 81, 47, 1, 0),
(133302, 79, 46, 0, 1),
(133303, 79, 50, 0, 1),
(133304, 81, 45, 0, 1),
(133305, 79, 44, 1, 0),
(133306, 79, 45, 0, 1),
(133307, 80, 51, 0, 1),
(133308, 83, 51, 0, 1),
(133309, 82, 49, 1, 0),
(133310, 83, 44, 0, 1),
(133311, 80, 52, 1, 0),
(133312, 80, 53, 0, 1),
(133313, 83, 48, 0, 1),
(133314, 79, 48, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `sottotema`
--

CREATE TABLE `sottotema` (
  `id_sottotema` int(100) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_blog` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `sottotema`
--

INSERT INTO `sottotema` (`id_sottotema`, `id_tema`, `id_blog`, `nome`) VALUES
(41, 1, 128, ''),
(42, 1, 128, ''),
(43, 1, 130, ''),
(44, 11, 131, ''),
(45, 11, 132, ''),
(46, 9, 133, ''),
(47, 9, 134, ''),
(48, 5, 135, ''),
(49, 5, 136, ''),
(50, 8, 137, ''),
(51, 8, 138, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `tema`
--

CREATE TABLE `tema` (
  `id_tema` int(100) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tema`
--

INSERT INTO `tema` (`id_tema`, `nome`) VALUES
(1, 'animali'),
(2, 'arredamento'),
(3, 'arte'),
(4, 'cronaca'),
(5, 'cucina'),
(6, 'economia'),
(7, 'informatica'),
(8, 'musica'),
(9, 'sport'),
(10, 'storia'),
(11, 'viaggiare');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente_log`
--

CREATE TABLE `utente_log` (
  `id_utente` int(100) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `telefono` bigint(10) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `immagine` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente_log`
--

INSERT INTO `utente_log` (`id_utente`, `nome`, `email`, `password`, `telefono`, `documento`, `immagine`) VALUES
(79, 'Sonia', 'sonia@gmail.com', '12345678', 3279896151, 'IT00000IT', 'sonia.jpg'),
(80, 'Dylan', 'dylan@gmail.com', '12345678', 3279896141, 'IT90900IT', 'dylan.jpg'),
(81, 'Benedetta', 'benedetta@gmail.com', '12345678', 3245654345, 'IT00990IT', 'benedetta.jpg'),
(82, 'Luana', 'luana@gmail.com', '12345678', 3245657898, 'IT34233OP', 'luana.jpg'),
(83, 'Simona', 'simona@gmail.com', '12345678', 3243243545, 'IT78789PO', 'simona.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `visitatore`
--

CREATE TABLE `visitatore` (
  `IP` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `visitatore`
--

INSERT INTO `visitatore` (`IP`) VALUES
('::1');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_blog`,`nome`) USING BTREE,
  ADD KEY `descrizione` (`id_tema`),
  ADD KEY `proprietà` (`id_user`),
  ADD KEY `allegato2` (`id_grafica`);

--
-- Indici per le tabelle `coautore`
--
ALTER TABLE `coautore`
  ADD PRIMARY KEY (`id_blog`,`id_user`),
  ADD KEY `collaborazione` (`id_blog`),
  ADD KEY `autorizzazione` (`id_user`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`id_commento`),
  ADD KEY `allegato` (`id_post`),
  ADD KEY `produzione` (`id_user`);

--
-- Indici per le tabelle `grafica`
--
ALTER TABLE `grafica`
  ADD PRIMARY KEY (`id_grafica`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `composizione` (`id_blog`),
  ADD KEY `allegato3` (`id_utente`);

--
-- Indici per le tabelle `reazione`
--
ALTER TABLE `reazione`
  ADD PRIMARY KEY (`id_reazione`),
  ADD KEY `produzione1` (`id_utente`),
  ADD KEY `allegato1` (`id_post`);

--
-- Indici per le tabelle `sottotema`
--
ALTER TABLE `sottotema`
  ADD PRIMARY KEY (`id_sottotema`),
  ADD KEY `Ricorsione` (`id_tema`),
  ADD KEY `Riferimento` (`id_blog`);

--
-- Indici per le tabelle `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`);

--
-- Indici per le tabelle `utente_log`
--
ALTER TABLE `utente_log`
  ADD PRIMARY KEY (`id_utente`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `email` (`email`);

--
-- Indici per le tabelle `visitatore`
--
ALTER TABLE `visitatore`
  ADD PRIMARY KEY (`IP`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `blog`
--
ALTER TABLE `blog`
  MODIFY `id_blog` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `id_commento` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT per la tabella `grafica`
--
ALTER TABLE `grafica`
  MODIFY `id_grafica` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT per la tabella `reazione`
--
ALTER TABLE `reazione`
  MODIFY `id_reazione` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133316;

--
-- AUTO_INCREMENT per la tabella `sottotema`
--
ALTER TABLE `sottotema`
  MODIFY `id_sottotema` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT per la tabella `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `utente_log`
--
ALTER TABLE `utente_log`
  MODIFY `id_utente` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `allegato2` FOREIGN KEY (`id_grafica`) REFERENCES `grafica` (`id_grafica`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `descrizione` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id_tema`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proprietà` FOREIGN KEY (`id_user`) REFERENCES `utente_log` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `coautore`
--
ALTER TABLE `coautore`
  ADD CONSTRAINT `autorizzazione` FOREIGN KEY (`id_user`) REFERENCES `utente_log` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `collaborazione` FOREIGN KEY (`id_blog`) REFERENCES `blog` (`id_blog`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `allegato` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produzione` FOREIGN KEY (`id_user`) REFERENCES `utente_log` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `allegato3` FOREIGN KEY (`id_utente`) REFERENCES `utente_log` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `composizione` FOREIGN KEY (`id_blog`) REFERENCES `blog` (`id_blog`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `reazione`
--
ALTER TABLE `reazione`
  ADD CONSTRAINT `allegato1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produzione1` FOREIGN KEY (`id_utente`) REFERENCES `utente_log` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `sottotema`
--
ALTER TABLE `sottotema`
  ADD CONSTRAINT `Ricorsione` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id_tema`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Riferimento` FOREIGN KEY (`id_blog`) REFERENCES `blog` (`id_blog`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
