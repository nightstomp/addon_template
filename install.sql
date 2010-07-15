DROP TABLE IF EXISTS `rex_720_data`;
CREATE TABLE `rex_720_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `textarea` varchar(255) NOT NULL,
  `select` varchar(255) NOT NULL,
  `multiselect` varchar(255) NOT NULL,
  `checkbox` varchar(255) NOT NULL,
  `radiobutton` varchar(255) NOT NULL,
  `mediabutton` varchar(255) NOT NULL,
  `medialist` varchar(255) NOT NULL,
  `linkbutton` varchar(255) NOT NULL,
  `linklist` varchar(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

LOCK TABLES `rex_720_data` WRITE;
/*!40000 ALTER TABLE `rex_720_data` DISABLE KEYS */;
INSERT INTO `rex_720_data` VALUES
  (1,'Erster..','..Datensatz..','foo','frzl','|1|',2,'team-bild.gif','markus.gif,thomas.gif,jan.gif',4,'16,12,13,14');
/*!40000 ALTER TABLE `rex_720_data` ENABLE KEYS */;
UNLOCK TABLES;