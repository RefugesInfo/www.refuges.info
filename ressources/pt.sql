-- MySQL dump 10.11
--
-- Host: localhost    Database: refuges
-- ------------------------------------------------------
-- Server version	5.0.32-Debian_7etch8

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `point_type`
--

DROP TABLE IF EXISTS `point_type`;
CREATE TABLE `point_type` (
  `id_point_type` int(10) unsigned NOT NULL auto_increment,
  `article_demonstratif` varchar(20) NOT NULL default '',
  `article_defini` varchar(20) NOT NULL default '',
  `article_partitif_point_type` varchar(20) NOT NULL default '',
  `nom_type` varchar(50) NOT NULL default '',
  `equivalent_site_officiel` varchar(255) NOT NULL default '',
  `equivalent_sommaire` varchar(255) NOT NULL default '',
  `equivalent_places` varchar(50) NOT NULL default '',
  `equivalent_proprio` varchar(200) NOT NULL default '',
  `equivalent_ferme` varchar(255) NOT NULL default '',
  `equivalent_cheminee` varchar(255) NOT NULL default '',
  `equivalent_poele` varchar(255) NOT NULL default '',
  `equivalent_couvertures` varchar(255) NOT NULL default '',
  `equivalent_matelas` varchar(255) NOT NULL default '',
  `equivalent_places_matelas` varchar(255) NOT NULL default '',
  `equivalent_latrines` varchar(255) NOT NULL default '',
  `equivalent_bois_a_proximite` varchar(255) NOT NULL default '',
  `equivalent_eau_a_proximite` varchar(255) NOT NULL default '',
  `equivalent_clef_a_recuperer` varchar(100) NOT NULL default '',
  `nom_icone` varchar(50) NOT NULL default '',
  `nom_icone_ferme` varchar(255) NOT NULL default '',
  `nom_icone_sommaire` varchar(255) NOT NULL default '',
  `ech_max` int(11) NOT NULL default '50',
  `importance` int(11) NOT NULL default '0',
  `pas_afficher` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_point_type`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 PACK_KEYS=0 COMMENT='type (sommet, ville, via ferat, ...)';

--
-- Dumping data for table `point_type`
--

LOCK TABLES `point_type` WRITE;
/*!40000 ALTER TABLE `point_type` DISABLE KEYS */;
INSERT INTO `point_type` VALUES (7,'cette','la','d\'une','cabane non gardée','Site Internet','Manque un mur','Places pour dormir','Auprès de qui se renseigner','Fermée','Cheminée','Poêle','Couvertures','Matelas','Places sur Matelas','Latrines','Bois à proximité','Eau à proximité','Clef à récupérer','cabane','cabane_fermee','abri_sommaire',600,100,0),(10,'ce','le','d\'un','refuge gardé','Site officiel','','Capacité d\'accueil','Propriétaires','Fermé','','','','','','Latrines','','Ravitaillement en eau possible','','refuge_garde','refuge_ferme','',600,97,0),(9,'ce','le','d\'un','gîte d\'étape','Site officiel','','Capacité d\'accueil','Propriétaires','Fermé','','','','','','','','Ravitaillement en eau possible','','gite','gite_ferme','',600,95,0),(26,'','','','censuré','','','','','','','','','','','','','','','censure','censure','',1000000,0,1),(6,'ce','le','d\'un','sommet','','','','','','','','','','','','','','','sommet','','',250,82,0),(3,'ce','le','d\'un','point de passage','','','','','','','','','','','','','','','col','','',50,75,0),(23,'ce','le','d\'un','point d\'eau','','','','','Tari définitivement','','','','','','','','','','point_eau','','',50,83,0),(19,'ce','le','d\'un','bivouac','','','','','','','','','','','','','','','bivouac','','',50,49,1),(22,'ce','le','d\'un','site remarquable','Site officiel','','','Renseignements','','','','','','','','','','','site','','',50,48,1),(16,'ce','le','d\'un','lac','','','','','','','','','','','','','','','lac','','',100,20,1);
/*!40000 ALTER TABLE `point_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-06 23:42:06
