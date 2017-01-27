CREATE TABLE IF NOT EXISTS `musicguess` (
  `hash` varchar(64) NOT NULL,
  `stream_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `musicguess`
--
ALTER TABLE `musicguess`
  ADD PRIMARY KEY (`hash`);