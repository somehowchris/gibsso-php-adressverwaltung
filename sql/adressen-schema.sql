SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Tabellenstruktur für Tabelle `land`
--

CREATE TABLE `land` (
  `lid` int(11) NOT NULL auto_increment,
  `land` varchar(30) collate latin1_german2_ci NOT NULL,
  PRIMARY KEY  (`lid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ort`
--

CREATE TABLE `ort` (
  `oid` int(11) NOT NULL auto_increment,
  `plz` int(11) NOT NULL,
  `ort` varchar(30) collate latin1_german2_ci NOT NULL,
  PRIMARY KEY  (`oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `personen`
--

CREATE TABLE `personen` (
  `pid` int(11) NOT NULL auto_increment,
  `name` varchar(30) collate latin1_german2_ci NOT NULL,
  `vorname` varchar(20) collate latin1_german2_ci NOT NULL,
  `strasse` varchar(30) collate latin1_german2_ci NOT NULL,
  `oid` int(11) default NULL,
  `email` varchar(50) collate latin1_german2_ci NOT NULL,
  `tel_priv` varchar(20) collate latin1_german2_ci NOT NULL,
  `tel_gesch` varchar(20) collate latin1_german2_ci NOT NULL,
  `lid` int(11) default NULL,
  PRIMARY KEY  (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
