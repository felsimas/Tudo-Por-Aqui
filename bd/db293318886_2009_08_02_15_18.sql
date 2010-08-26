DROP TABLE IF EXISTS `Account`;
CREATE TABLE `Account` (
  `id` int(11) NOT NULL auto_increment,
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `entered` datetime NOT NULL default '0000-00-00 00:00:00',
  `agree_tou` char(1) default NULL,
  `lastlogin` datetime NOT NULL default '0000-00-00 00:00:00',
  `username` varchar(100) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `foreignaccount` char(1) NOT NULL default 'n',
  `foreignaccount_done` char(1) NOT NULL default 'n',
  `foreignaccount_redirect` varchar(255) NOT NULL,
  `foreignaccount_auth` text NOT NULL,
  `faillogin_count` int(11) NOT NULL default '0',
  `faillogin_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `importID` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `username` (`username`),
  KEY `lastlogin` (`lastlogin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Data for Table `Account`
--

/*!40000 ALTER TABLE `Account` DISABLE KEYS */;
INSERT INTO `Account` (`id`,`updated`,`entered`,`agree_tou`,`lastlogin`,`username`,`password`,`foreignaccount`,`foreignaccount_done`,`foreignaccount_redirect`,`foreignaccount_auth`,`faillogin_count`,`faillogin_datetime`,`importID`) VALUES ('1','2009-07-02 02:04:45','2009-07-02 02:04:45','0','0000-00-00 00:00:00','FlunkdAccounts','38a09dc3c3c45a95cde118af5fe44576','n','n','','','0','0000-00-00 00:00:00','0');
/*!40000 ALTER TABLE `Account` ENABLE KEYS */;


--
-- Create Table `Article`
--

DROP TABLE IF EXISTS `Article`;
CREATE TABLE `Article` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL default '0',
  `image_id` int(11) NOT NULL default '0',
  `thumb_id` int(11) NOT NULL default '0',
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `entered` datetime NOT NULL default '0000-00-00 00:00:00',
  `renewal_date` date NOT NULL default '0000-00-00',
  `discount_id` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `friendly_url` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL default '',
  `author_url` varchar(255) NOT NULL,
  `publication_date` date NOT NULL default '0000-00-00',
  `image_attribute` varchar(100) NOT NULL default '',
  `image_caption` varchar(255) NOT NULL default '',
  `abstract` varchar(255) NOT NULL default '',
  `abstract1` varchar(255) NOT NULL,
  `abstract2` varchar(255) NOT NULL,
  `abstract3` varchar(255) NOT NULL,
  `abstract4` varchar(255) NOT NULL,
  `seo_abstract` varchar(255) NOT NULL,
  `seo_abstract1` varchar(255) NOT NULL,
  `seo_abstract2` varchar(255) NOT NULL,
  `seo_abstract3` varchar(255) NOT NULL,
  `seo_abstract4` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `keywords1` text NOT NULL,
  `keywords2` text NOT NULL,
  `keywords3` text NOT NULL,
  `keywords4` text NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `seo_keywords1` varchar(255) NOT NULL,
  `seo_keywords2` varchar(255) NOT NULL,
  `seo_keywords3` varchar(255) NOT NULL,
  `seo_keywords4` varchar(255) NOT NULL,
  `fulltextsearch_keyword` text NOT NULL,
  `fulltextsearch_where` text NOT NULL,
  `content` text NOT NULL,
  `content1` text NOT NULL,
  `content2` text NOT NULL,
  `content3` text NOT NULL,
  `content4` text NOT NULL,
  `status` char(1) NOT NULL default '',
  `level` tinyint(3) NOT NULL default '0',
  `random_number` bigint(15) NOT NULL default '0',
  `cat_1_id` int(11) NOT NULL default '0',
  `parcat_1_level1_id` int(11) NOT NULL default '0',
  `cat_2_id` int(11) NOT NULL default '0',
  `parcat_2_level1_id` int(11) NOT NULL default '0',
  `cat_3_id` int(11) NOT NULL default '0',
  `parcat_3_level1_id` int(11) NOT NULL default '0',
  `cat_4_id` int(11) NOT NULL default '0',
  `parcat_4_level1_id` int(11) NOT NULL default '0',
  `cat_5_id` int(11) NOT NULL default '0',
  `parcat_5_level1_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `title` (`title`),
  KEY `publication_date` (`publication_date`),
  KEY `status` (`status`),
  KEY `level` (`level`),
  KEY `account_id` (`account_id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `random_number` (`random_number`),
  KEY `entered` (`entered`),
  KEY `updated` (`updated`),
  KEY `cat_1_id` (`cat_1_id`),
  KEY `parcat_1_level1_id` (`parcat_1_level1_id`),
  KEY `cat_2_id` (`cat_2_id`),
  KEY `parcat_2_level1_id` (`parcat_2_level1_id`),
  KEY `cat_3_id` (`cat_3_id`),
  KEY `parcat_3_level1_id` (`parcat_3_level1_id`),
  KEY `cat_4_id` (`cat_4_id`),
  KEY `parcat_4_level1_id` (`parcat_4_level1_id`),
  KEY `cat_5_id` (`cat_5_id`),
  KEY `parcat_5_level1_id` (`parcat_5_level1_id`),
  FULLTEXT KEY `fulltextsearch_keyword` (`fulltextsearch_keyword`),
  FULLTEXT KEY `fulltextsearch_where` (`fulltextsearch_where`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Article`
--

/*!40000 ALTER TABLE `Article` DISABLE KEYS */;
/*!40000 ALTER TABLE `Article` ENABLE KEYS */;


--
-- Create Table `ArticleCategory`
--

DROP TABLE IF EXISTS `ArticleCategory`;
CREATE TABLE `ArticleCategory` (
  `id` int(11) NOT NULL auto_increment,
  `lang` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `title1` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `title3` varchar(255) NOT NULL,
  `title4` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL default '0',
  `seo_description` varchar(255) NOT NULL,
  `seo_description1` varchar(255) NOT NULL,
  `seo_description2` varchar(255) NOT NULL,
  `seo_description3` varchar(255) NOT NULL,
  `seo_description4` varchar(255) NOT NULL,
  `friendly_url` varchar(255) NOT NULL,
  `friendly_url1` varchar(255) NOT NULL,
  `friendly_url2` varchar(255) NOT NULL,
  `friendly_url3` varchar(255) NOT NULL,
  `friendly_url4` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `keywords1` text NOT NULL,
  `keywords2` text NOT NULL,
  `keywords3` text NOT NULL,
  `keywords4` text NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `seo_keywords1` varchar(255) NOT NULL,
  `seo_keywords2` varchar(255) NOT NULL,
  `seo_keywords3` varchar(255) NOT NULL,
  `seo_keywords4` varchar(255) NOT NULL,
  `active_article` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `category_id` (`category_id`),
  KEY `title` (`title`),
  KEY `active_article` (`active_article`),
  KEY `title1` (`title1`),
  KEY `title2` (`title2`),
  KEY `title3` (`title3`),
  KEY `title4` (`title4`),
  KEY `friendly_url1` (`friendly_url1`),
  KEY `friendly_url2` (`friendly_url2`),
  KEY `friendly_url3` (`friendly_url3`),
  KEY `friendly_url4` (`friendly_url4`),
  KEY `lang` (`lang`),
  FULLTEXT KEY `keywords` (`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`title`,`title1`,`title2`,`title3`,`title4`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Data for Table `ArticleCategory`
--

/*!40000 ALTER TABLE `ArticleCategory` DISABLE KEYS */;
INSERT INTO `ArticleCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_article`) VALUES ('1','','category-article','','','','','0','','','','','','category-article','','','','','category-article','','','','','','','','','','0');
/*!40000 ALTER TABLE `ArticleCategory` ENABLE KEYS */;


--
-- Create Table `ArticleLevel`
--

DROP TABLE IF EXISTS `ArticleLevel`;
CREATE TABLE `ArticleLevel` (
  `value` int(3) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `defaultlevel` char(1) NOT NULL default 'n',
  `detail` char(1) NOT NULL default 'y',
  `images` int(3) NOT NULL default '0',
  `price` decimal(10,2) NOT NULL default '0.00',
  `content` text NOT NULL,
  `active` char(1) NOT NULL default 'y',
  PRIMARY KEY  (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `ArticleLevel`
--

/*!40000 ALTER TABLE `ArticleLevel` DISABLE KEYS */;
INSERT INTO `ArticleLevel` (`value`,`name`,`defaultlevel`,`detail`,`images`,`price`,`content`,`active`) VALUES ('50','article','y','y','5','30.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent\" colspan=\"2\">\r\n<ul>\r\n<li>Contains summary View and Detail View. </li>\r\n<li>Title, Publication Date, Author, Abstract, Image, Photo Caption, Photo Attribute, Photo Gallery, Send to a Friend, Add to Favorites, Print. </li></ul></td></tr>\r\n<tr>\r\n<td valign=\"top\" colspan=\"2\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Summary View</th>\r\n<th class=\"detailColumn\">Detail View</th></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_article_summary_enus.gif\"> [LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_article_detail_enus.gif\"> <span class=\"advertiseAlert\">* These images are <strong>illustrative</strong></span> </td></tr></tbody></table></td></tr></tbody></table>','y');
/*!40000 ALTER TABLE `ArticleLevel` ENABLE KEYS */;


--
-- Create Table `ArticleLevel_Lang`
--

DROP TABLE IF EXISTS `ArticleLevel_Lang`;
CREATE TABLE `ArticleLevel_Lang` (
  `value` int(3) NOT NULL,
  `lang` char(5) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`value`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `ArticleLevel_Lang`
--

/*!40000 ALTER TABLE `ArticleLevel_Lang` DISABLE KEYS */;
INSERT INTO `ArticleLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','pt_br','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td colspan=\"2\" class=\"advertiseTableContent\">\r\n<ul>\r\n<li>Contém visualização resumida e visualização detalhada.</li>\r\n<li>Título, Data de publicação, Autor, Resumo, Imagem, Legenda da imagem, Autor da imagem, Galeria de fotos, Indique para um amigo, Adicionar aos favoritos, Imprimir.</li></ul></td></tr><tr><td valign=\"top\" colspan=\"2\">\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Visualização resumida</th>\r\n<th class=\"detailColumn\">Visualização detalhada</th></tr><tr><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_article_summary_ptbr.gif\" alt=\"\"> [LEVELBUTTON] </td><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_article_detail_ptbr.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Imagens ilustrativas</span> </td></tr></tbody></table></td></tr></tbody></table>');
INSERT INTO `ArticleLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','es_es','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td colspan=\"2\" class=\"advertiseTableContent\">\r\n<ul>\r\n<li>Contiene Descripcion Resumida y Descripcion Completa.</li>\r\n<li>Título, Fecha de publicación, Autor, Resumen, Imagen, Atributo de la imagen, Epígrafe de la imagen, Galeria de fotos, Enviar a un amigo, Agregar a lista rápida, Imprimir.</li></ul></td></tr><tr><td valign=\"top\" colspan=\"2\">\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Resumen</th>\r\n<th class=\"detailColumn\">Detalle</th></tr><tr><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_article_summary_eses.gif\" alt=\"\"> [LEVELBUTTON] </td><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_article_detail_eses.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Estas imágenes son ilustrativas</span> </td></tr></tbody></table></td></tr></tbody></table>');
INSERT INTO `ArticleLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','fr_fr','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td colspan=\"2\" class=\"advertiseTableContent\">\r\n<ul>\r\n<li>Contient vue résumée et détaillée.</li>\r\n<li>Titre, Date de Publication, Auteur, Résumé, Image, Attributs de l\'image, Légende de l\'image, Galerie photo, E-mail un ami, Ajouter à la liste rapide, Imprimer.</li></ul></td></tr><tr><td valign=\"top\" colspan=\"2\">\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Vue résumée</th>\r\n<th class=\"detailColumn\">Vue détaillée</th></tr><tr><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_article_summary_frfr.gif\" alt=\"\"> [LEVELBUTTON] </td><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_article_detail_frfr.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Ces images sont des exemples</span> </td></tr></tbody></table></td></tr></tbody></table>');
/*!40000 ALTER TABLE `ArticleLevel_Lang` ENABLE KEYS */;


--
-- Create Table `Banner`
--

DROP TABLE IF EXISTS `Banner`;
CREATE TABLE `Banner` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL default '0',
  `image_id` int(11) NOT NULL default '0',
  `image_id1` int(11) NOT NULL default '0',
  `image_id2` int(11) NOT NULL default '0',
  `image_id3` int(11) NOT NULL default '0',
  `image_id4` int(11) NOT NULL default '0',
  `category_id` int(11) NOT NULL default '0',
  `renewal_date` date NOT NULL default '0000-00-00',
  `discount_id` varchar(10) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `caption1` varchar(100) NOT NULL,
  `caption2` varchar(100) NOT NULL,
  `caption3` varchar(100) NOT NULL,
  `caption4` varchar(100) NOT NULL,
  `status` char(1) NOT NULL default 'P',
  `random_number` bigint(15) NOT NULL default '0',
  `target_window` tinyint(1) NOT NULL default '1',
  `type` tinyint(1) NOT NULL default '0',
  `section` varchar(255) NOT NULL default 'general',
  `content_line1` varchar(35) NOT NULL default '',
  `content_line11` varchar(35) NOT NULL,
  `content_line12` varchar(35) NOT NULL,
  `content_line13` varchar(35) NOT NULL,
  `content_line14` varchar(35) NOT NULL,
  `content_line2` varchar(35) NOT NULL default '',
  `content_line21` varchar(35) NOT NULL,
  `content_line22` varchar(35) NOT NULL,
  `content_line23` varchar(35) NOT NULL,
  `content_line24` varchar(35) NOT NULL,
  `destination_protocol` varchar(10) NOT NULL default '',
  `display_url` varchar(200) NOT NULL default '',
  `destination_url` text NOT NULL,
  `unpaid_impressions` mediumint(9) NOT NULL default '0',
  `impressions` mediumint(9) NOT NULL default '0',
  `unlimited_impressions` char(1) NOT NULL default 'n',
  `expiration_setting` char(1) NOT NULL default '',
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `entered` datetime NOT NULL default '0000-00-00 00:00:00',
  `show_type` tinyint(4) NOT NULL default '0',
  `script` text,
  PRIMARY KEY  (`id`),
  KEY `status` (`status`),
  KEY `type` (`type`),
  KEY `section` (`section`),
  KEY `expiration_setting` (`expiration_setting`),
  KEY `impressions` (`impressions`),
  KEY `account_id` (`account_id`),
  KEY `category_id` (`category_id`),
  KEY `random_number` (`random_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Banner`
--

/*!40000 ALTER TABLE `Banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `Banner` ENABLE KEYS */;


--
-- Create Table `BannerLevel`
--

DROP TABLE IF EXISTS `BannerLevel`;
CREATE TABLE `BannerLevel` (
  `value` int(3) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `defaultlevel` char(1) NOT NULL default 'n',
  `price` decimal(10,2) NOT NULL default '0.00',
  `width` int(11) NOT NULL default '0',
  `height` int(11) NOT NULL default '0',
  `impression_block` mediumint(9) NOT NULL default '0',
  `impression_price` decimal(10,2) NOT NULL default '0.00',
  `content` text NOT NULL,
  `active` char(1) NOT NULL default 'y',
  `displayName` varchar(255) NOT NULL,
  PRIMARY KEY  (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `BannerLevel`
--

/*!40000 ALTER TABLE `BannerLevel` DISABLE KEYS */;
INSERT INTO `BannerLevel` (`value`,`name`,`defaultlevel`,`price`,`width`,`height`,`impression_block`,`impression_price`,`content`,`active`,`displayName`) VALUES ('1','top','y','50.00','468','60','1000','50.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_top_enus.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>','y','top');
INSERT INTO `BannerLevel` (`value`,`name`,`defaultlevel`,`price`,`width`,`height`,`impression_block`,`impression_price`,`content`,`active`,`displayName`) VALUES ('2','bottom','n','20.00','728','90','1000','20.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_bottom_enus.gif\"><span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>','y','bottom');
INSERT INTO `BannerLevel` (`value`,`name`,`defaultlevel`,`price`,`width`,`height`,`impression_block`,`impression_price`,`content`,`active`,`displayName`) VALUES ('3','featured','n','40.00','180','150','1000','40.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_featured_enus.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>','y','featured');
INSERT INTO `BannerLevel` (`value`,`name`,`defaultlevel`,`price`,`width`,`height`,`impression_block`,`impression_price`,`content`,`active`,`displayName`) VALUES ('50','sponsored links','n','10.00','180','100','1000','10.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td>[LEVELBUTTON] </td>\r\n<td><img alt=\"\" src=\"/images/content/img_ad_banner_sponsored_enus.gif\"><span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>','y','sponsored links');
/*!40000 ALTER TABLE `BannerLevel` ENABLE KEYS */;


--
-- Create Table `BannerLevel_Lang`
--

DROP TABLE IF EXISTS `BannerLevel_Lang`;
CREATE TABLE `BannerLevel_Lang` (
  `value` int(3) NOT NULL,
  `lang` char(5) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`value`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `BannerLevel_Lang`
--

/*!40000 ALTER TABLE `BannerLevel_Lang` DISABLE KEYS */;
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','pt_br','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td>[LEVELBUTTON] </td>\r\n<td><img alt=\"\" src=\"/images/content/img_ad_banner_sponsored_ptbr.gif\"><span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','es_es','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td>[LEVELBUTTON] </td>\r\n<td><img alt=\"\" src=\"/images/content/img_ad_banner_sponsored_eses.gif\"><span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','fr_fr','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td>[LEVELBUTTON] </td>\r\n<td><img alt=\"\" src=\"/images/content/img_ad_banner_sponsored_frfr.gif\"><span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('3','pt_br','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_featured_ptbr.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('3','es_es','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_featured_eses.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('3','fr_fr','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_featured_frfr.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('2','pt_br','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_bottom_ptbr.gif\"><span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('2','es_es','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_bottom_eses.gif\"><span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('2','fr_fr','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_bottom_frfr.gif\"><span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('1','pt_br','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_top_ptbr.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('1','es_es','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_top_eses.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
INSERT INTO `BannerLevel_Lang` (`value`,`lang`,`content`) VALUES ('1','fr_fr','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_banner_top_frfr.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>');
/*!40000 ALTER TABLE `BannerLevel_Lang` ENABLE KEYS */;


--
-- Create Table `Claim`
--

DROP TABLE IF EXISTS `Claim`;
CREATE TABLE `Claim` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `listing_title` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  `step` char(1) NOT NULL,
  `status` varchar(255) NOT NULL,
  `old_estado_id` int(11) NOT NULL,
  `new_estado_id` int(11) NOT NULL,
  `old_cidade_id` int(11) NOT NULL,
  `new_cidade_id` int(11) NOT NULL,
  `old_bairro_id` int(11) NOT NULL,
  `new_bairro_id` int(11) NOT NULL,
  `old_city_id` int(11) NOT NULL,
  `new_city_id` int(11) NOT NULL,
  `old_area_id` int(11) NOT NULL,
  `new_area_id` int(11) NOT NULL,
  `old_title` varchar(255) NOT NULL,
  `new_title` varchar(255) NOT NULL,
  `old_friendly_url` varchar(255) NOT NULL,
  `new_friendly_url` varchar(255) NOT NULL,
  `old_email` varchar(255) NOT NULL,
  `new_email` varchar(255) NOT NULL,
  `old_url` varchar(255) NOT NULL,
  `new_url` varchar(255) NOT NULL,
  `old_phone` varchar(255) NOT NULL,
  `new_phone` varchar(255) NOT NULL,
  `old_fax` varchar(255) NOT NULL,
  `new_fax` varchar(255) NOT NULL,
  `old_address` varchar(255) NOT NULL,
  `new_address` varchar(255) NOT NULL,
  `old_address2` varchar(255) NOT NULL,
  `new_address2` varchar(255) NOT NULL,
  `old_zip_code` varchar(10) NOT NULL,
  `new_zip_code` varchar(10) NOT NULL,
  `old_level` tinyint(3) NOT NULL,
  `new_level` tinyint(3) NOT NULL,
  `old_listingtemplate_id` int(11) NOT NULL default '0',
  `new_listingtemplate_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Claim`
--

/*!40000 ALTER TABLE `Claim` DISABLE KEYS */;
/*!40000 ALTER TABLE `Claim` ENABLE KEYS */;


--
-- Create Table `Classified`
--

DROP TABLE IF EXISTS `Classified`;
CREATE TABLE `Classified` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL default '0',
  `image_id` int(11) NOT NULL default '0',
  `thumb_id` int(11) NOT NULL default '0',
  `estado_id` int(11) NOT NULL default '0',
  `cidade_id` int(11) NOT NULL default '0',
  `bairro_id` int(11) NOT NULL default '0',
  `city_id` int(11) NOT NULL default '0',
  `area_id` int(11) NOT NULL default '0',
  `entered` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `renewal_date` date NOT NULL default '0000-00-00',
  `discount_id` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `seo_title` varchar(255) NOT NULL,
  `friendly_url` varchar(255) NOT NULL,
  `email` varchar(50) default NULL,
  `url` varchar(255) NOT NULL,
  `contactname` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `address2` varchar(255) NOT NULL default '',
  `phone` varchar(255) NOT NULL default '',
  `fax` varchar(255) NOT NULL default '',
  `summarydesc` varchar(255) NOT NULL default '',
  `summarydesc1` varchar(255) NOT NULL,
  `summarydesc2` varchar(255) NOT NULL,
  `summarydesc3` varchar(255) NOT NULL,
  `summarydesc4` varchar(255) NOT NULL,
  `seo_summarydesc` varchar(255) NOT NULL,
  `seo_summarydesc1` varchar(255) NOT NULL,
  `seo_summarydesc2` varchar(255) NOT NULL,
  `seo_summarydesc3` varchar(255) NOT NULL,
  `seo_summarydesc4` varchar(255) NOT NULL,
  `detaildesc` text NOT NULL,
  `detaildesc1` text NOT NULL,
  `detaildesc2` text NOT NULL,
  `detaildesc3` text NOT NULL,
  `detaildesc4` text NOT NULL,
  `keywords` text NOT NULL,
  `keywords1` text NOT NULL,
  `keywords2` text NOT NULL,
  `keywords3` text NOT NULL,
  `keywords4` text NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `seo_keywords1` varchar(255) NOT NULL,
  `seo_keywords2` varchar(255) NOT NULL,
  `seo_keywords3` varchar(255) NOT NULL,
  `seo_keywords4` varchar(255) NOT NULL,
  `fulltextsearch_keyword` text NOT NULL,
  `fulltextsearch_where` text NOT NULL,
  `zip_code` varchar(10) NOT NULL default '',
  `zip5` varchar(10) NOT NULL default '0',
  `latitude` double(10,6) NOT NULL default '0.000000',
  `longitude` double(10,6) NOT NULL default '0.000000',
  `maptuning` varchar(255) NOT NULL,
  `level` int(3) NOT NULL default '0',
  `status` char(1) NOT NULL default '',
  `random_number` bigint(15) NOT NULL default '0',
  `cat_1_id` int(11) NOT NULL default '0',
  `parcat_1_level1_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `estado_id` (`estado_id`),
  KEY `cidade_id` (`cidade_id`),
  KEY `bairro_id` (`bairro_id`),
  KEY `latitude` (`latitude`),
  KEY `longitude` (`longitude`),
  KEY `level` (`level`),
  KEY `status` (`status`),
  KEY `account_id` (`account_id`),
  KEY `city_id` (`city_id`),
  KEY `area_id` (`area_id`),
  KEY `title` (`title`),
  KEY `friendly_url` (`friendly_url`),
  KEY `random_number` (`random_number`),
  KEY `cat_1_id` (`cat_1_id`),
  KEY `parcat_1_level1_id` (`parcat_1_level1_id`),
  FULLTEXT KEY `fulltextsearch_keyword` (`fulltextsearch_keyword`),
  FULLTEXT KEY `fulltextsearch_where` (`fulltextsearch_where`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Classified`
--

/*!40000 ALTER TABLE `Classified` DISABLE KEYS */;
/*!40000 ALTER TABLE `Classified` ENABLE KEYS */;


--
-- Create Table `ClassifiedCategory`
--

DROP TABLE IF EXISTS `ClassifiedCategory`;
CREATE TABLE `ClassifiedCategory` (
  `id` int(11) NOT NULL auto_increment,
  `lang` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `title1` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `title3` varchar(255) NOT NULL,
  `title4` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL default '0',
  `seo_description` varchar(255) NOT NULL,
  `seo_description1` varchar(255) NOT NULL,
  `seo_description2` varchar(255) NOT NULL,
  `seo_description3` varchar(255) NOT NULL,
  `seo_description4` varchar(255) NOT NULL,
  `friendly_url` varchar(255) NOT NULL,
  `friendly_url1` varchar(255) NOT NULL,
  `friendly_url2` varchar(255) NOT NULL,
  `friendly_url3` varchar(255) NOT NULL,
  `friendly_url4` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `keywords1` text NOT NULL,
  `keywords2` text NOT NULL,
  `keywords3` text NOT NULL,
  `keywords4` text NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `seo_keywords1` varchar(255) NOT NULL,
  `seo_keywords2` varchar(255) NOT NULL,
  `seo_keywords3` varchar(255) NOT NULL,
  `seo_keywords4` varchar(255) NOT NULL,
  `active_classified` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `category_id` (`category_id`),
  KEY `title` (`title`),
  KEY `active_classified` (`active_classified`),
  KEY `title1` (`title1`),
  KEY `title2` (`title2`),
  KEY `title3` (`title3`),
  KEY `title4` (`title4`),
  KEY `friendly_url1` (`friendly_url1`),
  KEY `friendly_url2` (`friendly_url2`),
  KEY `friendly_url3` (`friendly_url3`),
  KEY `friendly_url4` (`friendly_url4`),
  KEY `lang` (`lang`),
  FULLTEXT KEY `keywords` (`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`title`,`title1`,`title2`,`title3`,`title4`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Data for Table `ClassifiedCategory`
--

/*!40000 ALTER TABLE `ClassifiedCategory` DISABLE KEYS */;
INSERT INTO `ClassifiedCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_classified`) VALUES ('1','','category-classified','','','','','0','','','','','','category-classified','','','','','category-classified','','','','','','','','','','0');
/*!40000 ALTER TABLE `ClassifiedCategory` ENABLE KEYS */;


--
-- Create Table `ClassifiedLevel`
--

DROP TABLE IF EXISTS `ClassifiedLevel`;
CREATE TABLE `ClassifiedLevel` (
  `value` int(3) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `defaultlevel` char(1) NOT NULL default 'n',
  `detail` char(1) NOT NULL default 'y',
  `images` int(3) NOT NULL default '0',
  `price` decimal(10,2) NOT NULL default '0.00',
  `content` text NOT NULL,
  `active` char(1) NOT NULL default 'y',
  PRIMARY KEY  (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `ClassifiedLevel`
--

/*!40000 ALTER TABLE `ClassifiedLevel` DISABLE KEYS */;
INSERT INTO `ClassifiedLevel` (`value`,`name`,`defaultlevel`,`detail`,`images`,`price`,`content`,`active`) VALUES ('10','basic','n','n','0','0.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\">\r\n<ul>\r\n<li>Title, Photo, Phone, E-mail, Short Description, Send to a Friend, Add to Favorites. </li></ul>[LEVELBUTTON] </td>\r\n<td>\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Summary View</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_classified_basic_summary_enus.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>','y');
INSERT INTO `ClassifiedLevel` (`value`,`name`,`defaultlevel`,`detail`,`images`,`price`,`content`,`active`) VALUES ('30','premium','n','y','3','25.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent\" colspan=\"2\">\r\n<ul>\r\n<li>Premium Classifieds appear in search results above Basic Classifieds. </li>\r\n<li>Contains Summary View and Detail View. </li>\r\n<li>Title, Address, Photo, Contact Name, Contact Phone, E-mail, Short Description, Detail Description, Photo Gallery, Send to a Friend, Add to Favorites, Print. </li></ul></td></tr>\r\n<tr>\r\n<td valign=\"top\" colspan=\"2\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Summary View</th>\r\n<th class=\"detailColumn\">Detail View</th></tr></tbody></table></td></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_classified_premium_showcase_enus.gif\"> [LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_classified_premium_detail_enus.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>','y');
INSERT INTO `ClassifiedLevel` (`value`,`name`,`defaultlevel`,`detail`,`images`,`price`,`content`,`active`) VALUES ('50','showcase','y','y','7','50.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent\" colspan=\"2\">\r\n<ul>\r\n<li>Showcase Classifieds appear in search results above Premium and Basic Classifieds. </li>\r\n<li>Contains Summary View and Detail View. </li>\r\n<li>Title, Address, Photo, Contact Name, Contact Phone, Contact Fax, E-mail, Web Link, Short Description, Detail Description, Photo Gallery, Send to a Friend, Add to Favorites, Print. </li></ul></td></tr>\r\n<tr>\r\n<td valign=\"top\" colspan=\"2\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Summary View</th>\r\n<th class=\"detailColumn\">Detail View</th></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_classified_showcase_summary_enus.gif\"> [LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_classified_showcase_detail_enus.gif\"> <span class=\"advertiseAlert\">* These images are <strong>illustrative</strong></span> </td></tr></tbody></table></td></tr></tbody></table>','y');
/*!40000 ALTER TABLE `ClassifiedLevel` ENABLE KEYS */;


--
-- Create Table `ClassifiedLevel_Lang`
--

DROP TABLE IF EXISTS `ClassifiedLevel_Lang`;
CREATE TABLE `ClassifiedLevel_Lang` (
  `value` int(3) NOT NULL,
  `lang` char(5) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`value`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `ClassifiedLevel_Lang`
--

/*!40000 ALTER TABLE `ClassifiedLevel_Lang` DISABLE KEYS */;
INSERT INTO `ClassifiedLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','pt_br','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td colspan=\"2\" class=\"advertiseTableContent\">\r\n<ul>\r\n<li>Os classificados de nível Showcase aparecem acima dos classificados de nível Premium e Basic.</li>\r\n<li>Contém visualização resumida e visualização detalhada.</li>\r\n<li>Título, Endereço, Foto, Nome do contato, Telefone, Fax, E-mail, Site, Descrição resumida, Descrição detalhada, Galeria de fotos, Indique para um amigo, Adicionar aos favoritos, Imprimir.</li></ul></td></tr><tr><td valign=\"top\" colspan=\"2\">\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Visualização resumida</th>\r\n<th class=\"detailColumn\">Visualização detalhada</th></tr><tr><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_showcase_summary_ptbr.gif\" alt=\"\"> [LEVELBUTTON] </td><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_showcase_detail_ptbr.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Imagens ilustrativas</span> </td></tr></tbody></table></td></tr></tbody></table>');
INSERT INTO `ClassifiedLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','es_es','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td colspan=\"2\" class=\"advertiseTableContent\">\r\n<ul>\r\n<li>Cuando se hace una busqueda, los clasificados de  nivel Showcase aparecen sobre los clasificados Premium y Basico.</li>\r\n<li>Contiene Descripcion Resumiday Descripcion Completa.</li>\r\n<li>Titulo, Direccion, Foto, Nombre del contacto, Telefono del contacto, Fax, Enlace para Correo Electronico, Enlace para Sitio de Internet, Resumen Descripción, Galeria de fotos, Enviar a un amigo, Agregar a lista rápida, Imprimir.</li></ul></td></tr><tr><td valign=\"top\" colspan=\"2\">\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Resumen</th>\r\n<th class=\"detailColumn\">Detalle</th></tr><tr><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_showcase_summary_eses.gif\" alt=\"\"> [LEVELBUTTON] </td><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_showcase_detail_eses.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Estas imágenes son ilustrativas</span> </td></tr></tbody></table></td></tr></tbody></table>');
INSERT INTO `ClassifiedLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','fr_fr','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td colspan=\"2\" class=\"advertiseTableContent\">\r\n<ul>\r\n<li>Les Annonces de niveau Showcase apparaissent au-dessus de Premium et Basic dans les résultats de recherche.</li>\r\n<li>Contient vue résumée et détaillée.</li>\r\n<li>Titre, Adresse, Logo, Nom du Contact, Téléphone du Contact, Fax du Contact, E-Mail, Description sommaire, Description détaillée, Galerie photo, E-mail un ami, Ajouter à la liste rapide, Imprimer.</li></ul></td></tr><tr><td valign=\"top\" colspan=\"2\">\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Vue résumée</th>\r\n<th class=\"detailColumn\">Vue détaillée</th></tr><tr><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_showcase_summary_frfr.gif\" alt=\"\"> [LEVELBUTTON] </td><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_showcase_detail_frfr.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Ces images sont des exemples</span> </td></tr></tbody></table></td></tr></tbody></table>');
INSERT INTO `ClassifiedLevel_Lang` (`value`,`lang`,`content`) VALUES ('30','pt_br','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td colspan=\"2\" class=\"advertiseTableContent\">\r\n<ul>\r\n<li>Os classificados de nível Premium aparecem acima dos classificados de nível Basic nos resultados das buscas.</li>\r\n<li>Contém visualização resumida e visualização detalhada.</li>\r\n<li>Título, Endereço, Foto, Nome do contato, Telefone, E-mail, Descrição resumida, Descrição detalhada, Galeria de fotos, Indique para um amigo, Adicionar aos favoritos, Imprimir.</li></ul></td></tr><tr><td valign=\"top\" colspan=\"2\">\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Visualização resumida</th>\r\n<th class=\"detailColumn\">Visualização detalhada</th></tr></tbody></table></td></tr><tr><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_premium_showcase_ptbr.gif\" alt=\"\"> [LEVELBUTTON] </td><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_premium_detail_ptbr.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Imagens ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `ClassifiedLevel_Lang` (`value`,`lang`,`content`) VALUES ('30','es_es','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td colspan=\"2\" class=\"advertiseTableContent\">\r\n<ul>\r\n<li>Cuando se hace una busqueda, los clasificados de  nivel Premium aparecen sobre los clasificados Basico.</li>\r\n<li>Contiene Descripcion Resumiday Descripcion Completa.</li>\r\n<li>Titulo, Direccion, Foto, Nombre del contacto, Telefono del contacto, Enlace para Correo Electronico, Resumen Descripción, Galeria de fotos, Enviar a un amigo, Agregar a lista rápida, Imprimir.</li></ul></td></tr><tr><td valign=\"top\" colspan=\"2\">\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Resumen</th>\r\n<th class=\"detailColumn\">Detalle</th></tr></tbody></table></td></tr><tr><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_premium_showcase_eses.gif\" alt=\"\"> [LEVELBUTTON] </td><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_premium_detail_eses.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Estas imágenes son ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `ClassifiedLevel_Lang` (`value`,`lang`,`content`) VALUES ('30','fr_fr','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td colspan=\"2\" class=\"advertiseTableContent\">\r\n<ul>\r\n<li>Les Annonces de niveau Premium apparaissent au-dessus de Basic dans les résultats de recherche.</li>\r\n<li>Contient vue résumée et détaillée.</li>\r\n<li>Titre, Adresse, Logo, Nom du Contact, Téléphone du Contact, E-mail, Description sommaire, Description détaillée, Galerie photo, E-mail un ami, Ajouter à la liste rapide, Imprimer.</li></ul></td></tr><tr><td valign=\"top\" colspan=\"2\">\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Vue résumée</th>\r\n<th class=\"detailColumn\">Vue détaillée</th></tr></tbody></table></td></tr><tr><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_premium_showcase_frfr.gif\" alt=\"\"> [LEVELBUTTON] </td><td class=\"advertiseScreen\"><img src=\"/images/content/img_ad_classified_premium_detail_frfr.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Ces images sont des exemples</span> </td></tr></tbody></table>');
INSERT INTO `ClassifiedLevel_Lang` (`value`,`lang`,`content`) VALUES ('10','pt_br','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td class=\"advertiseScreen\">\r\n<ul>\r\n<li>Título, Foto, Telefone, E-mail, Descrição resumida, Indique para um amigo, Adicionar aos favoritos, Imprimir.</li></ul>[LEVELBUTTON] </td><td>\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Visualização resumida</th></tr></tbody></table><img src=\"/images/content/img_ad_classified_basic_summary_ptbr.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Imagens ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `ClassifiedLevel_Lang` (`value`,`lang`,`content`) VALUES ('10','es_es','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td class=\"advertiseScreen\">\r\n<ul>\r\n<li>Titulo, Foto, Telefono del contacto, Enlace para Correo Electronico, Resumen Descripción, Enviar a un amigo, Agregar a lista rápida, Imprimir.</li></ul>[LEVELBUTTON] </td><td>\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Resumen</th></tr></tbody></table><img src=\"/images/content/img_ad_classified_basic_summary_eses.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Estas imágenes son ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `ClassifiedLevel_Lang` (`value`,`lang`,`content`) VALUES ('10','fr_fr','<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"advertiseTable\"><tbody><tr>\r\n<th class=\"type\">[LEVELNAME]</th><td class=\"prize\">[LEVELPRICE]</td></tr><tr><td class=\"advertiseScreen\">\r\n<ul>\r\n<li>Titre, Logo, Téléphone du Contact, E-mail, Description sommaire, E-mail un ami, Ajouter à la liste rapide, Imprimer.</li></ul>[LEVELBUTTON] </td><td>\r\n<table cellspacing=\"0\" cellpadding=\"0\" class=\"advertiseScreenDesc\"><tbody><tr>\r\n<th>Vue résumée</th></tr></tbody></table><img src=\"/images/content/img_ad_classified_basic_summary_frfr.gif\" alt=\"\"> <span class=\"advertiseAlert\">* Ces images sont des exemples</span> </td></tr></tbody></table>');
/*!40000 ALTER TABLE `ClassifiedLevel_Lang` ENABLE KEYS */;


--
-- Create Table `Contact`
--

DROP TABLE IF EXISTS `Contact`;
CREATE TABLE `Contact` (
  `account_id` int(11) NOT NULL default '0',
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `entered` datetime NOT NULL default '0000-00-00 00:00:00',
  `lang` char(5) NOT NULL default 'en_us',
  `first_name` varchar(50) NOT NULL default '',
  `last_name` varchar(50) NOT NULL default '',
  `company` varchar(50) NOT NULL default '',
  `address` varchar(50) NOT NULL default '',
  `address2` varchar(50) default NULL,
  `city` varchar(50) NOT NULL default '',
  `state` varchar(50) NOT NULL default '',
  `zip` varchar(15) NOT NULL default '',
  `country` varchar(50) NOT NULL default '',
  `phone` varchar(255) NOT NULL default '',
  `fax` varchar(255) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `url` varchar(50) NOT NULL default '',
  `importID` int(11) NOT NULL default '0',
  PRIMARY KEY  (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Contact`
--

/*!40000 ALTER TABLE `Contact` DISABLE KEYS */;
INSERT INTO `Contact` (`account_id`,`updated`,`entered`,`lang`,`first_name`,`last_name`,`company`,`address`,`address2`,`city`,`state`,`zip`,`country`,`phone`,`fax`,`email`,`url`,`importID`) VALUES ('1','2009-07-02 02:04:45','2009-07-02 02:04:45','en_us','Kamran','Riaz','','','','','','','','','','cameron@orangemango.co.uk','','0');
/*!40000 ALTER TABLE `Contact` ENABLE KEYS */;


--
-- Create Table `Content`
--

DROP TABLE IF EXISTS `Content`;
CREATE TABLE `Content` (
  `id` int(11) NOT NULL auto_increment,
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `type` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `url` varchar(255) NOT NULL default '',
  `section` varchar(255) NOT NULL default 'general',
  `content` longtext NOT NULL,
  `sitemap` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `section` (`section`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Data for Table `Content`
--

/*!40000 ALTER TABLE `Content` DISABLE KEYS */;
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('1','0000-00-00 00:00:00','Home Page','','','','','general','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('2','0000-00-00 00:00:00','Home Page Bottom','','','','','general','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('3','0000-00-00 00:00:00','Directory Results','','','','','general','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('4','0000-00-00 00:00:00','Directory Results Bottom','','','','','general','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('5','0000-00-00 00:00:00','Advertise with Us','','','','','general','<h1 style=\"margin: 0px; font: bold 13pt Arial,Helvetica,sans-serif; color: rgb(0,51,101); font-size-adjust: none; font-stretch: normal;\">Sign up today - It\'s quick and simple!</h1>\r\n<br>\r\n<p style=\"font: 8pt Verdana,Arial,Helvetica,sans-serif; font-size-adjust: none; font-stretch: normal;\"><font color=\"#000000\">Demo Directory is proud to announce its new directory service which is now available online to visitors and new suppliers. It boasts endless amounts of new features for customers and suppliers.</font></p>\r\n<p style=\"font: 8pt Verdana,Arial,Helvetica,sans-serif; font-size-adjust: none; font-stretch: normal;\"><font color=\"#000000\">Your directory items are also controlled entirely by you. We have a membros interface where you can log in and change any details, add special promotions for Demo Directory customers and much more!</font></p><br>','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('6','0000-00-00 00:00:00','Advertise with Us Bottom','','','','','general','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('7','0000-00-00 00:00:00','Favorites','','','','','general','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('8','0000-00-00 00:00:00','Favorites Bottom','','','','','general','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('9','0000-00-00 00:00:00','Contact Us','','','','','general','<div id=\"lipsum\" align=\"justify\">\r\n	<h1 style=\"margin: 0px; font: bold 13pt Arial,Helvetica,sans-serif; color: rgb(0,51,101); font-size-adjust: none; font-stretch: normal;\">Contact Us</h1> \r\n	<font face=\"Verdana\" size=\"2\"><br />\r\n	</font><font face=\"Verdana\" size=\"2\">7004 Little River Turnpike</font><font face=\"Verdana\" size=\"2\"><br />\r\n	Suite O<br />\r\n	Annandale, VA 22003-3201, USA<br />\r\n	<br />\r\n	<strong>Toll Free: 1-800-630-4694</strong><br />\r\n	<strong>Tel: </strong>703.914.0770<br />\r\n	<strong>Fax: </strong>703.842.8199<br />\r\n	<strong>Email:</strong> <a href=\"mailto:sales@xx.cc?subject=Edirectory%20Sales\">sales@xx.cc</a><br />\r\n	</font></div>\r\n<br />','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('10','0000-00-00 00:00:00','Terms of Use','','','','','general','<h1 style=\"margin: 0px; font: bold 13pt Arial,Helvetica,sans-serif; color: rgb(0,51,101); font-size-adjust: none; font-stretch: normal;\">Terms of Use</h1>\r\n<br>\r\n<div align=\"justify\"><font face=\"Verdana\" size=\"2\">Curabitur in eros. Donec id tellus. Mauris arcu. Etiam volutpat. Pellentesque ultricies est sit amet nulla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus viverra turpis eu dui. Duis dolor. Morbi porta posuere nunc. Donec at leo. Fusce ut nulla porta ipsum dictum volutpat. Sed congue porta arcu. Donec viverra nulla sit amet leo molestie mollis. In ultricies. </font></div>\r\n<div align=\"justify\"><font face=\"Verdana\" size=\"2\">&nbsp;</font></div>\r\n<div align=\"justify\"><font face=\"Verdana\" size=\"2\">Curabitur pharetra suscipit neque. In hac habitasse platea dictumst. Fusce vitae erat. Nam malesuada, ipsum in semper porttitor, elit sapien aliquam eros, sit amet euismod lectus nibh et augue. Fusce sollicitudin venenatis orci. Etiam vehicula. Quisque tincidunt est a erat. Praesent consectetur pulvinar mauris. Nulla lorem risus, blandit eu, egestas nec, bibendum vel, dolor. Donec ultricies, lacus in venenatis feugiat, arcu mi viverra nulla, hendrerit hendrerit ipsum neque ut nisl. </font></div>\r\n<div align=\"justify\"><font face=\"Verdana\" size=\"2\">&nbsp;</font></div>\r\n<div align=\"justify\"><font face=\"Verdana\" size=\"2\">Nam blandit. Morbi non eros. Pellentesque eleifend, purus nec luctus dignissim, enim mi semper leo, et sodales arcu nunc sit amet arcu. Nunc pulvinar. Pellentesque eget sapien. Pellentesque ac arcu ut lorem ultrices pharetra. Aenean eu erat sed neque consequat molestie. Mauris mollis nunc. Aenean placerat. Morbi congue, augue ac molestie eleifend, dolor urna semper lacus, at malesuada eros dui eget lorem. Fusce vel risus ut urna vulputate interdum. </font></div></font></div>','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('11','0000-00-00 00:00:00','Listing Advertisement','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('12','0000-00-00 00:00:00','Listing Home','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('13','0000-00-00 00:00:00','Listing Home Bottom','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('14','0000-00-00 00:00:00','Listing Results','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('15','0000-00-00 00:00:00','Listing Results Bottom','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('16','0000-00-00 00:00:00','Listing View All Categories','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('17','0000-00-00 00:00:00','Listing View All Categories Bottom','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('18','0000-00-00 00:00:00','Promotion Home','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('19','0000-00-00 00:00:00','Promotion Home Bottom','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('20','0000-00-00 00:00:00','Promotion Results','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('21','0000-00-00 00:00:00','Promotion Results Bottom','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('22','0000-00-00 00:00:00','Promotion View All Categories','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('23','0000-00-00 00:00:00','Promotion View All Categories Bottom','','','','','listing','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('24','0000-00-00 00:00:00','Event Advertisement','','','','','event','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('25','0000-00-00 00:00:00','Event Home','','','','','event','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('26','0000-00-00 00:00:00','Event Home Bottom','','','','','event','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('27','0000-00-00 00:00:00','Event Results','','','','','event','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('28','0000-00-00 00:00:00','Event Results Bottom','','','','','event','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('29','0000-00-00 00:00:00','Event View All Categories','','','','','event','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('30','0000-00-00 00:00:00','Event View All Categories Bottom','','','','','event','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('31','0000-00-00 00:00:00','Banner Advertisement','','','','','banner','<h1 style=\"margin: 0px; font: bold 13pt Arial,Helvetica,sans-serif; color: rgb(0,51,101); font-size-adjust: none; font-stretch: normal;\">Banners</h1><br>\r\n<tr>\r\n<td class=\"advertiseScreen\">\r\n<ul>\r\n<li>Display targeted ads that match the directory content </li>\r\n<li>Reach people seeking information on products and services in the directory </li>\r\n<li>Build brand recognition </li>\r\n<li>Return on Investment - Start getting customers in minutes!\r\n</td>\r\n</tr></li></ul>','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('32','0000-00-00 00:00:00','Classified Advertisement','','','','','classified','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('33','0000-00-00 00:00:00','Classified Home','','','','','classified','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('34','0000-00-00 00:00:00','Classified Home Bottom','','','','','classified','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('35','0000-00-00 00:00:00','Classified Results','','','','','classified','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('36','0000-00-00 00:00:00','Classified Results Bottom','','','','','classified','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('37','0000-00-00 00:00:00','Classified View All Categories','','','','','classified','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('38','0000-00-00 00:00:00','Classified View All Categories Bottom','','','','','classified','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('39','0000-00-00 00:00:00','Article Advertisement','','','','','article','<tr>\r\n<td class=\"advertiseScreen\">Post your article and become known to prospective clients and customers.\r\n</td>\r\n</tr>','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('40','0000-00-00 00:00:00','Article Home','','','','','article','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('41','0000-00-00 00:00:00','Article Home Bottom','','','','','article','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('42','0000-00-00 00:00:00','Article Results','','','','','article','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('43','0000-00-00 00:00:00','Article Results Bottom','','','','','article','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('44','0000-00-00 00:00:00','Article View All Categories','','','','','article','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('45','0000-00-00 00:00:00','Article View All Categories Bottom','','','','','article','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('46','0000-00-00 00:00:00','Member Home','','','','','member','<p>You can <strong>add</strong>, <strong>review</strong> or <strong>update</strong> all your items anytime by selecting one of the links below. </p>','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('47','0000-00-00 00:00:00','Member Home Bottom','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('48','0000-00-00 00:00:00','Manage Account','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('49','0000-00-00 00:00:00','Manage Account Bottom','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('50','0000-00-00 00:00:00','Member Help','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('51','0000-00-00 00:00:00','Member Help Bottom','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('52','0000-00-00 00:00:00','Manage Listings','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('53','0000-00-00 00:00:00','Manage Listings Bottom','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('54','0000-00-00 00:00:00','Manage Galleries','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('55','0000-00-00 00:00:00','Manage Galleries Bottom','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('56','0000-00-00 00:00:00','Manage Promotions','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('57','0000-00-00 00:00:00','Manage Promotions Bottom','','','','','member','<p>   A Promotion is a discount coupon that can be added to a listing and becomes active once associated to a listing. You begin by      selecting the<strong> promotions </strong>link and <strong>add your promotion</strong>. To activate it the promotion click on the \"gift box\" icon within the listing section and this will attach your promotion \"coupon\" to your showcase listing.</p>\r\n<div>&nbsp;</div>\r\n<div>Your promotion will show up at the directory high traffic areas: </div>\r\n<ul class=\"general-item\">\r\n<li>-Within the promotion section, there is an area where potential customers will find current promotions. Making an initial search easy. </li>\r\n<li>-Within the listing section, linked to a showcase listing you will see a clickable \"promotion icon\". This lets visitors know that your listing is currently offering a promotional coupon.<br>\r\n</li></ul>','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('58','0000-00-00 00:00:00','Manage Events','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('59','0000-00-00 00:00:00','Manage Events Bottom','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('60','0000-00-00 00:00:00','Manage Banners','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('61','0000-00-00 00:00:00','Manage Banners Bottom','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('62','0000-00-00 00:00:00','Manage Classifieds','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('63','0000-00-00 00:00:00','Manage Classifieds Bottom','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('64','0000-00-00 00:00:00','Manage Articles','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('65','0000-00-00 00:00:00','Manage Articles Bottom','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('66','0000-00-00 00:00:00','Transaction','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('67','0000-00-00 00:00:00','Transaction Bottom','','','','','member','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('68','0000-00-00 00:00:00','Sitemap','','','','','general','','0');
INSERT INTO `Content` (`id`,`updated`,`type`,`title`,`description`,`keywords`,`url`,`section`,`content`,`sitemap`) VALUES ('69','0000-00-00 00:00:00','Error Page','Page not found','','','','general','<h1 style=\"margin: 0px; font: bold 13pt Arial,Helvetica,sans-serif; color: rgb(0,51,101); font-size-adjust: none; font-stretch: normal;\">Page not found</h1>\r\n<br>\r\n<div>The requested page was not found.</div>','0');
/*!40000 ALTER TABLE `Content` ENABLE KEYS */;


--
-- Create Table `Content_Lang`
--

DROP TABLE IF EXISTS `Content_Lang`;
CREATE TABLE `Content_Lang` (
  `id` int(11) NOT NULL default '0',
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `lang` char(5) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY  (`id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Content_Lang`
--

/*!40000 ALTER TABLE `Content_Lang` DISABLE KEYS */;
/*!40000 ALTER TABLE `Content_Lang` ENABLE KEYS */;


--
-- Create Table `CustomInvoice`
--

DROP TABLE IF EXISTS `CustomInvoice`;
CREATE TABLE `CustomInvoice` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `sent_date` text NOT NULL,
  `amount` decimal(10,2) NOT NULL default '0.00',
  `paid` char(1) NOT NULL default '',
  `sent` char(1) NOT NULL default '',
  `completed` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `account_id` (`account_id`),
  KEY `paid` (`paid`),
  KEY `sent` (`sent`),
  KEY `completed` (`completed`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `CustomInvoice`
--

/*!40000 ALTER TABLE `CustomInvoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `CustomInvoice` ENABLE KEYS */;


--
-- Create Table `CustomInvoice_Items`
--

DROP TABLE IF EXISTS `CustomInvoice_Items`;
CREATE TABLE `CustomInvoice_Items` (
  `id` int(11) NOT NULL auto_increment,
  `custominvoice_id` int(11) NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `price` decimal(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`),
  KEY `custominvoice_id` (`custominvoice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `CustomInvoice_Items`
--

/*!40000 ALTER TABLE `CustomInvoice_Items` DISABLE KEYS */;
/*!40000 ALTER TABLE `CustomInvoice_Items` ENABLE KEYS */;


--
-- Create Table `CustomText`
--

DROP TABLE IF EXISTS `CustomText`;
CREATE TABLE `CustomText` (
  `name` varchar(255) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `CustomText`
--

/*!40000 ALTER TABLE `CustomText` DISABLE KEYS */;
INSERT INTO `CustomText` (`name`,`value`) VALUES ('header_title','');
INSERT INTO `CustomText` (`name`,`value`) VALUES ('header_author','');
INSERT INTO `CustomText` (`name`,`value`) VALUES ('header_description','');
INSERT INTO `CustomText` (`name`,`value`) VALUES ('header_keywords','');
INSERT INTO `CustomText` (`name`,`value`) VALUES ('footer_copyright','');
INSERT INTO `CustomText` (`name`,`value`) VALUES ('claim_textlink','Este estabelecimento lhe pertence?');
INSERT INTO `CustomText` (`name`,`value`) VALUES ('promotion_default_conditions','Coupon must be presented to receive discount. Limit of 1 coupon per purchase. Not valid with other coupons, offers or discounts of any kind. Some restrictions may apply.');
/*!40000 ALTER TABLE `CustomText` ENABLE KEYS */;


--
-- Create Table `CustomText_Lang`
--

DROP TABLE IF EXISTS `CustomText_Lang`;
CREATE TABLE `CustomText_Lang` (
  `name` varchar(255) NOT NULL default '',
  `lang` char(5) NOT NULL,
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`name`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `CustomText_Lang`
--

/*!40000 ALTER TABLE `CustomText_Lang` DISABLE KEYS */;
/*!40000 ALTER TABLE `CustomText_Lang` ENABLE KEYS */;


--
-- Create Table `Discount_Code`
--

DROP TABLE IF EXISTS `Discount_Code`;
CREATE TABLE `Discount_Code` (
  `id` varchar(10) NOT NULL default '',
  `amount` decimal(10,2) NOT NULL default '0.00',
  `type` varchar(15) NOT NULL default '',
  `status` char(1) NOT NULL default '',
  `expire_date` date NOT NULL,
  `recurring` char(3) NOT NULL default '',
  `listing` char(3) NOT NULL,
  `event` char(3) NOT NULL,
  `banner` char(3) NOT NULL,
  `classified` char(3) NOT NULL,
  `article` char(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `type` (`type`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Discount_Code`
--

/*!40000 ALTER TABLE `Discount_Code` DISABLE KEYS */;
/*!40000 ALTER TABLE `Discount_Code` ENABLE KEYS */;


--
-- Create Table `Editor_Choice`
--

DROP TABLE IF EXISTS `Editor_Choice`;
CREATE TABLE `Editor_Choice` (
  `id` int(11) NOT NULL auto_increment,
  `available` char(1) NOT NULL default '0',
  `image_id` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `available` (`available`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Editor_Choice`
--

/*!40000 ALTER TABLE `Editor_Choice` DISABLE KEYS */;
/*!40000 ALTER TABLE `Editor_Choice` ENABLE KEYS */;


--
-- Create Table `Email_Notification`
--

DROP TABLE IF EXISTS `Email_Notification`;
CREATE TABLE `Email_Notification` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(255) default NULL,
  `days` tinyint(3) NOT NULL default '0',
  `deactivate` char(1) NOT NULL default '0',
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `bcc` varchar(255) default NULL,
  `about` varchar(255) default NULL,
  `subject` varchar(255) default NULL,
  `content_type` varchar(15) default NULL,
  `body` text,
  PRIMARY KEY  (`id`),
  KEY `deactivate` (`deactivate`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Data for Table `Email_Notification`
--

/*!40000 ALTER TABLE `Email_Notification` DISABLE KEYS */;
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('1','30 day renewal reminder','30','0','0000-00-00 00:00:00','','Automatic email sent 30 days before account expiration date to remind listing owners to renew their account.','Listing renewal notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYour listing \"LISTING_TITLE\" will expire in DAYS_INTERVAL days.\r\n\r\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow.\r\n\r\nDEFAULT_URL/membros/billing/index.php\r\n\r\nFor further assistance please contact SITEMGR_EMAIL\r\n\r\nThank you for being a member of the Directory.\r\n\r\nRegards,\r\nThe EDIRECTORY_TITLE Team');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('2','15 day renewal reminder','15','0','0000-00-00 00:00:00','','Automatic email sent 15 days before account expiration date to remind listing owners to renew their account.','Listing renewal notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYour listing &quot;LISTING_TITLE&quot; will expire in DAYS_INTERVAL days.\r\n\r\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow.\r\n\r\nDEFAULT_URL/membros/billing/index.php\r\n\r\nFor further assistance please contact SITEMGR_EMAIL\r\n\r\nThank you for being a member of the Directory.\r\n\r\nRegards,\r\nThe EDIRECTORY_TITLE Team');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('3','7 day renewal reminder','7','0','0000-00-00 00:00:00','','Automatic email sent 7 days before account expiration date to remind listing owners to renew their account.','Listing renewal notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYour listing \"LISTING_TITLE\" will expire in DAYS_INTERVAL days.\r\n\r\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow.\r\n\r\nDEFAULT_URL/membros/billing/index.php\r\n\r\nFor further assistance please contact SITEMGR_EMAIL\r\n\r\nThank you for being a member of the Directory.\r\n\r\nRegards,\r\nThe EDIRECTORY_TITLE Team');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('4','1 day renewal reminder','1','0','0000-00-00 00:00:00','','Automatic email sent 1 day before account expiration date to remind listing owners to renew their account.','Listing renewal notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYour listing \"LISTING_TITLE\" will expire in DAYS_INTERVAL days.\r\n\r\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow.\r\n\r\nDEFAULT_URL/membros/billing/index.php\r\n\r\nFor further assistance please contact SITEMGR_EMAIL\r\n\r\nThank you for being a member of the Directory.\r\n\r\nRegards,\r\nThe EDIRECTORY_TITLE Team');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('5','Member Account Create (sitemgr area)','0','0','0000-00-00 00:00:00','','Email sent to the listing owner when site manager creates an account for him.','EDIRECTORY_TITLE Account','text/plain','Dear ACCOUNT_NAME,\r\n\r\nThank you for signing up for an account in DEFAULT_URL\r\nLogin to manage your account with the username and password below.\r\n\r\nDEFAULT_URL/membros\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nDEFAULT_URL');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('6','Member Account Update (sitemgr area)','0','0','0000-00-00 00:00:00','','Email sent to the listing owner when sitemgr modifies his account in the system.','EDIRECTORY_TITLE Account','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYour account is updated in DEFAULT_URL\r\nLogin to manage your account with the username and password below.\r\n\r\nDEFAULT_URL/membros\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nDEFAULT_URL');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('7','Forgotten Password','0','0','0000-00-00 00:00:00','','Email sent to the listing owner informing his new password when requested.','EDIRECTORY_TITLE account information','text/plain','As requested, here is the information regarding your EDIRECTORY_TITLE account.\r\nTo change your forgotten password please click the link below and enter a new password.\r\nKEY_ACCOUNT\r\n\r\nFor further assistance please contact SITEMGR_EMAIL.\r\n\r\nThank you for being a member of the EDIRECTORY_TITLE.');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('8','New Listing','0','0','0000-00-00 00:00:00','','Email sent to the listing owner when he creates a new listing in the directory.','EDIRECTORY_TITLE Notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYou have just added one listing in our directory.\r\n\r\nWhat do I do next?\r\n\r\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your listing.\r\nDEFAULT_URL/membros\r\n\r\nOnce this has been completed a directory administrator will review your listing and set it live within the directory.\r\n\r\nSubmissions are reviewed within 2 working days following payment.\r\n\r\nThank you for being a member of the EDIRECTORY_TITLE!\r\n\r\nRegards\r\nEDIRECTORY_TITLE Advertising Team\r\n');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('9','New Event','0','0','0000-00-00 00:00:00','','Email sent to the listing owner when he creates a new event in the directory.','EDIRECTORY_TITLE Notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nThank you for adding your event to our directory calendar.\r\n\r\nAn administrator will review your event and make it live within the directory within 2 working days.\r\n\r\nThank you for being a member of the EDIRECTORY_TITLE!\r\n\r\nRegards\r\nEDIRECTORY_TITLE Advertising Team');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('10','New Banner','0','0','0000-00-00 00:00:00','','Email sent to the banner owner when he creates a new banner in the directory.','EDIRECTORY_TITLE Notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYou have just added one banner in our directory.\r\n\r\nWhat do I do next?\r\n\r\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your banner.\r\nDEFAULT_URL/membros\r\n\r\nOnce this has been completed a directory administrator will review your banner and set it live within the directory.\r\n\r\nSubmissions are reviewed within 2 working days following payment.\r\n\r\nThank you for being a member of the EDIRECTORY_TITLE!\r\n\r\nRegards\r\nEDIRECTORY_TITLE Advertising Team\r\n');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('11','New Classified','0','0','0000-00-00 00:00:00','','Email sent to the classified owner when he creates a new classified in the directory.','EDIRECTORY_TITLE Notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYou have just added one classified in our directory.\r\n\r\nWhat do I do next?\r\n\r\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your classified.\r\nDEFAULT_URL/membros\r\n\r\nOnce this has been completed a directory administrator will review your classified and set it live within the directory.\r\n\r\nSubmissions are reviewed within 2 working days following payment.\r\n\r\nThank you for being a member of the EDIRECTORY_TITLE!\r\n\r\nRegards\r\nEDIRECTORY_TITLE Advertising Team\r\n');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('12','New Article','0','0','0000-00-00 00:00:00','','Email sent to the article owner when he creates a new article in the directory.','EDIRECTORY_TITLE Notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYou have just added one article in our directory.\r\n\r\nWhat do I do next?\r\n\r\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your article.\r\nDEFAULT_URL/membros\r\n\r\nOnce this has been completed a directory administrator will review your article and set it live within the directory.\r\n\r\nSubmissions are reviewed within 2 working days following payment.\r\n\r\nThank you for being a member of the EDIRECTORY_TITLE!\r\n\r\nRegards\r\nEDIRECTORY_TITLE Advertising Team\r\n');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('13','Custom Invoice','0','0','0000-00-00 00:00:00','','Custom Invoice email','EDIRECTORY_TITLE Invoice','text/plain','Hello ACCOUNT_NAME,\r\n\r\nYour invoice is ready for payment at the following link:\r\n\r\nDEFAULT_URL/membros/billing/index.php\r\n\r\nAmount Due: CUSTOM_INVOICE_AMOUNT\r\n\r\nEDIRECTORY_TITLE\r\n');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('14','Active Listing','0','0','0000-00-00 00:00:00','','Email sent to the listing owner when sitemgr activate the listing.','EDIRECTORY_TITLE Activation Notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYour listing is live and active on EDIRECTORY_TITLE\r\n\r\nDEFAULT_URL/listing/\r\n\r\nThank you for being a member of the EDIRECTORY_TITLE!\r\n\r\nRegards\r\nEDIRECTORY_TITLE Team\r\n');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('15','Active Event','0','0','0000-00-00 00:00:00','','Email sent to the event owner when sitemgr activate the event.','EDIRECTORY_TITLE Activation Notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYour event is live and active on EDIRECTORY_TITLE\r\n\r\nDEFAULT_URL/event/\r\n\r\nThank you for being a member of the EDIRECTORY_TITLE!\r\n\r\nRegards\r\nEDIRECTORY_TITLE Team\r\n');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('16','Active Banner','0','0','0000-00-00 00:00:00','','Email sent to the banner owner when sitemgr activate the banner.','EDIRECTORY_TITLE Activation Notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYour banner is live and active on EDIRECTORY_TITLE\r\n\r\nDEFAULT_URL/\r\n\r\nThank you for being a member of the EDIRECTORY_TITLE!\r\n\r\nRegards\r\nEDIRECTORY_TITLE Team\r\n');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('17','Active Classified','0','0','0000-00-00 00:00:00','','Email sent to the classified owner when sitemgr activate the classified.','EDIRECTORY_TITLE Activation Notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYour classified is live and active on EDIRECTORY_TITLE\r\n\r\nDEFAULT_URL/classified/\r\n\r\nThank you for being a member of the EDIRECTORY_TITLE!\r\n\r\nRegards\r\nEDIRECTORY_TITLE Team\r\n');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('18','Active Article','0','0','0000-00-00 00:00:00','','Email sent to the article owner when sitemgr activate the article.','EDIRECTORY_TITLE Activation Notification','text/plain','Dear ACCOUNT_NAME,\r\n\r\nYour article is live and active on EDIRECTORY_TITLE\r\n\r\nDEFAULT_URL/article/\r\n\r\nThank you for being a member of the EDIRECTORY_TITLE!\r\n\r\nRegards\r\nEDIRECTORY_TITLE Team\r\n');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('19','Email to Friend','0','0','0000-00-00 00:00:00','','Email sent from an user to your friend.','Here is information on ITEM_TITLE from EDIRECTORY_TITLE','text/plain','Hello, I found this item in EDIRECTORY_TITLE and I think it would be great for you.\r\n\r\nYou can view it at ITEM_URL\r\n');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('20','Listing Signup','0','0','0000-00-00 00:00:00','','Email sent to the listing owner when he makes the signup process.','EDIRECTORY_TITLE Signup Notification','text/plain','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see:\r\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.\r\nAnd\r\nYour item in DEFAULT_URL/membros/ \"Manage Listings\" link.');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('21','Event Signup','0','0','0000-00-00 00:00:00','','Email sent to the event owner when he makes the signup process.','EDIRECTORY_TITLE Signup Notification','text/plain','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see:\r\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.\r\nAnd\r\nYour item in DEFAULT_URL/membros/ \"Manage Events\" link.');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('22','Banner Signup','0','0','0000-00-00 00:00:00','','Email sent to the banner owner when he makes the signup process.','EDIRECTORY_TITLE Signup Notification','text/plain','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see:\r\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.\r\nAnd\r\nYour item in DEFAULT_URL/membros/ \"Manage Banners\" link.');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('23','Classified Signup','0','0','0000-00-00 00:00:00','','Email sent to the classified owner when he makes the signup process.','EDIRECTORY_TITLE Signup Notification','text/plain','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see:\r\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.\r\nAnd\r\nYour item in DEFAULT_URL/membros/ \"Manage Classifieds\" link.');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('24','Article Signup','0','0','0000-00-00 00:00:00','','Email sent to the article owner when he makes the signup process.','EDIRECTORY_TITLE Signup Notification','text/plain','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see:\r\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.\r\nAnd\r\nYour item in DEFAULT_URL/membros/ \"Manage Articles\" link.');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('25','Claimer Signup','0','0','0000-00-00 00:00:00','','Email sent to the claimer when he makes the signup process.','EDIRECTORY_TITLE Claimer Signup Notification','text/plain','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see your account in DEFAULT_URL/membros/ \"Manage Account\" link.');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('26','Claim Automatically Approved','0','0','0000-00-00 00:00:00','','Email sent to the claimer when his claim is approved automatically.','EDIRECTORY_TITLE Claim Approved Notification','text/plain','Dear ACCOUNT_NAME,\r\nYour claim to the item \"LISTING_TITLE\" was \"automatically approved\".');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('27','Claim Approved','0','0','0000-00-00 00:00:00','','Email sent to the claimer when his claim is approved.','EDIRECTORY_TITLE Claim Approved Notification','text/plain','Dear ACCOUNT_NAME,\r\nYour claim to the item \"LISTING_TITLE\" was \"approved\" by site manager.');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('28','Claim Denied','0','0','0000-00-00 00:00:00','','Email sent to the claimer when his claim is denied.','EDIRECTORY_TITLE Claim Denied Notification','text/plain','Dear ACCOUNT_NAME,\r\nYour claim to the item \"LISTING_TITLE\" was \"denied\" by site manager.');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('29','Approve Reply','0','0','2009-04-17 15:28:18','','Email sent to the item owner when sitemgr approve the reply.','[EDIRECTORY_TITLE] Reply Approved Notification','text/plain',' Dear ACCOUNT_NAME,\r\n\r\n Your reply was approved by site manager. \r\n  \r\n Thank you for being a member of the EDIRECTORY_TITLE! \r\n  \r\n Regards \r\n EDIRECTORY_TITLE Team');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('30','Approve Review','0','0','2009-04-17 15:31:38','','Email sent to the item owner when sitemgr approve the review.','[EDIRECTORY_TITLE] Review Approved Notification','text/plain',' Dear ACCOUNT_NAME, \r\n  \r\n Your item has a new review approved by site manager. \r\n  \r\n Regards \r\n EDIRECTORY_TITLE Team ');
INSERT INTO `Email_Notification` (`id`,`email`,`days`,`deactivate`,`updated`,`bcc`,`about`,`subject`,`content_type`,`body`) VALUES ('31','New Review','0','0','2009-04-17 15:35:11','','Email sent to the item owner when his item receives a new review.','[EDIRECTORY_TITLE] New Review Notification','text/plain',' Dear ACCOUNT_NAME, \r\n  \r\n Your item on EDIRECTORY_TITLE has a new review. \r\n  \r\n Thank you for being a member of the EDIRECTORY_TITLE! \r\n  \r\n Regards \r\n EDIRECTORY_TITLE Team');
/*!40000 ALTER TABLE `Email_Notification` ENABLE KEYS */;


--
-- Create Table `Email_Notification_Default`
--

DROP TABLE IF EXISTS `Email_Notification_Default`;
CREATE TABLE `Email_Notification_Default` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body_text` text NOT NULL,
  `body_html` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Email_Notification_Default`
--

/*!40000 ALTER TABLE `Email_Notification_Default` DISABLE KEYS */;
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('1','Listing renewal notification','Dear ACCOUNT_NAME,\n\nYour listing \"LISTING_TITLE\" will expire in DAYS_INTERVAL days.\n\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow.\n\nDEFAULT_URL/membros/billing/index.php\n\nFor further assistance please contact SITEMGR_EMAIL\n\nThank you for being a member of the Directory.\n\nRegards,\nThe EDIRECTORY_TITLE Team','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYour listing \"LISTING_TITLE\" will expire in DAYS_INTERVAL days.<br /><br />\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow. <br /><br />\n<a href=\"DEFAULT_URL/membros/billing/index.php\">DEFAULT_URL/membros/billing/index.php</a><br /><br />\nFor further assistance please contact <a href=\"mailto:SITEMGR_EMAIL\">SITEMGR_EMAIL</a> <br /><br />\nThank you for being a member of the Directory. <br /><br />\nRegards,<br />\nThe EDIRECTORY_TITLE Team\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('2','Listing renewal notification','Dear ACCOUNT_NAME,\n\nYour listing \"LISTING_TITLE\" will expire in DAYS_INTERVAL days.\n\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow.\n\nDEFAULT_URL/membros/billing/index.php\n\nFor further assistance please contact SITEMGR_EMAIL\n\nThank you for being a member of the Directory.\n\nRegards,\nThe EDIRECTORY_TITLE Team','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYour listing \"LISTING_TITLE\" will expire in DAYS_INTERVAL days.<br /><br />\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow. <br /><br />\n<a href=\"DEFAULT_URL/membros/billing/index.php\">DEFAULT_URL/membros/billing/index.php</a><br /><br />\nFor further assistance please contact <a href=\"mailto:SITEMGR_EMAIL\">SITEMGR_EMAIL</a> <br /><br />\nThank you for being a member of the Directory. <br /><br />\nRegards,<br />\nThe EDIRECTORY_TITLE Team\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('3','Listing renewal notification','Dear ACCOUNT_NAME,\n\nYour listing \"LISTING_TITLE\" will expire in DAYS_INTERVAL days.\n\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow.\n\nDEFAULT_URL/membros/billing/index.php\n\nFor further assistance please contact SITEMGR_EMAIL\n\nThank you for being a member of the Directory.\n\nRegards,\nThe EDIRECTORY_TITLE Team','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYour listing \"LISTING_TITLE\" will expire in DAYS_INTERVAL days.<br /><br />\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow. <br /><br />\n<a href=\"DEFAULT_URL/membros/billing/index.php\">DEFAULT_URL/membros/billing/index.php</a><br /><br />\nFor further assistance please contact <a href=\"mailto:SITEMGR_EMAIL\">SITEMGR_EMAIL</a> <br /><br />\nThank you for being a member of the Directory. <br /><br />\nRegards,<br />\nThe EDIRECTORY_TITLE Team\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('4','Listing renewal notification','Dear ACCOUNT_NAME,\n\nYour listing \"LISTING_TITLE\" will expire in DAYS_INTERVAL days.\n\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow.\n\nDEFAULT_URL/membros/billing/index.php\n\nFor further assistance please contact SITEMGR_EMAIL\n\nThank you for being a member of the Directory.\n\nRegards,\nThe EDIRECTORY_TITLE Team','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYour listing \"LISTING_TITLE\" will expire in DAYS_INTERVAL days.<br /><br />\nYou can renew immediately by logging in to your account and submitting a credit card payment through the Payment area by the link bellow. <br /><br />\n<a href=\"DEFAULT_URL/membros/billing/index.php\">DEFAULT_URL/membros/billing/index.php</a><br /><br />\nFor further assistance please contact <a href=\"mailto:SITEMGR_EMAIL\">SITEMGR_EMAIL</a> <br /><br />\nThank you for being a member of the Directory. <br /><br />\nRegards,<br />\nThe EDIRECTORY_TITLE Team\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('5','EDIRECTORY_TITLE Account','Dear ACCOUNT_NAME,\n\nThank you for signing up for an account in DEFAULT_URL\nLogin to manage your account with the username and password below.\n\nDEFAULT_URL/membros\n\nUsername: ACCOUNT_USERNAME\nPassword: ACCOUNT_PASSWORD\n\nDEFAULT_URL','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nThank you for signing up for an account in <a href=\"DEFAULT_URL\">DEFAULT_URL</a><br />\nLogin to manage your account with the username and password below.<br /><br />\n<a href=\"DEFAULT_URL/membros\">DEFAULT_URL/membros</a><br /><br />\nUsername: ACCOUNT_USERNAME<br />\nPassword: ACCOUNT_PASSWORD<br /><br />\n<a href=\"DEFAULT_URL\">DEFAULT_URL</a></div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('6','EDIRECTORY_TITLE Account','Dear ACCOUNT_NAME,\n\nYour account is updated in DEFAULT_URL\nLogin to manage your account with the username and password below.\n\nDEFAULT_URL/membros\n\nUsername: ACCOUNT_USERNAME\nPassword: ACCOUNT_PASSWORD\n\nDEFAULT_URL','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYour account is updated in <a href=\"DEFAULT_URL\">DEFAULT_URL</a><br />\nLogin to manage your account with the username and password below.<br /><br />\n<a href=\"DEFAULT_URL/membros\">DEFAULT_URL/membros</a><br /><br />\nUsername: ACCOUNT_USERNAME<br />\nPassword: ACCOUNT_PASSWORD<br /><br />\n<a href=\"DEFAULT_URL\">DEFAULT_URL</a></div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('7','EDIRECTORY_TITLE account information','As requested, here is the information regarding your EDIRECTORY_TITLE account.\nTo change your forgotten password please click the link below and enter a new password.\nKEY_ACCOUNT\n\nFor further assistance please contact SITEMGR_EMAIL.\n\nThank you for being a member of the EDIRECTORY_TITLE.','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nAs requested, here is the information regarding your EDIRECTORY_TITLE account.<br />\nTo change your forgotten password please click the link below and enter a new password.<br />\nKEY_ACCOUNT<br /><br />\nFor further assistance please contact SITEMGR_EMAIL.<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE.</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('8','EDIRECTORY_TITLE Notification','Dear ACCOUNT_NAME,\n\nYou have just added one listing in our directory.\n\nWhat do I do next?\n\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your listing.\nDEFAULT_URL/membros\n\nOnce this has been completed a directory administrator will review your listing and set it live within the directory.\n\nSubmissions are reviewed within 2 working days following payment.\n\nThank you for being a member of the EDIRECTORY_TITLE!\n\nRegards\nEDIRECTORY_TITLE Advertising Team\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYou have just added one listing in our directory.<br /><br />\nWhat do I do next? <br /><br />\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your listing. <br />\n<a href=\"DEFAULT_URL/membros\" class=\"email_style_settings\">DEFAULT_URL/membros</a> <br /><br />\nOnce this has been completed a directory administrator will review your listing and set it live within the directory.<br /><br />\nSubmissions are reviewed within 2 working days following payment.<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\nRegards<br />\nEDIRECTORY_TITLE Advertising Team</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('9','EDIRECTORY_TITLE Notification','Dear ACCOUNT_NAME,\n\nThank you for adding your event to our directory calendar.\n\nAn administrator will review your event and make it live within the directory within 2 working days.\n\nThank you for being a member of the EDIRECTORY_TITLE!\n\nRegards\nEDIRECTORY_TITLE Advertising Team','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nThank you for adding your event to our directory calendar.<br /><br />\nAn administrator will review your event and make it live within the directory within 2 working days.<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\nRegards<br />\nEDIRECTORY_TITLE Advertising Team</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('10','EDIRECTORY_TITLE Notification','Dear ACCOUNT_NAME,\n\nYou have just added one banner in our directory.\n\nWhat do I do next?\n\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your banner.\nDEFAULT_URL/membros\n\nOnce this has been completed a directory administrator will review your banner and set it live within the directory.\n\nSubmissions are reviewed within 2 working days following payment.\n\nThank you for being a member of the EDIRECTORY_TITLE!\n\nRegards\nEDIRECTORY_TITLE Advertising Team\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYou have just added one banner in our directory.<br /><br />\nWhat do I do next? <br /><br />\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your banner. <br />\n<a href=\"DEFAULT_URL/membros\" class=\"email_style_settings\">DEFAULT_URL/membros</a> <br /><br />\nOnce this has been completed a directory administrator will review your banner and set it live within the directory.<br /><br />\nSubmissions are reviewed within 2 working days following payment.<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\nRegards<br />\nEDIRECTORY_TITLE Advertising Team</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('11','EDIRECTORY_TITLE Notification','Dear ACCOUNT_NAME,\n\nYou have just added one classified in our directory.\n\nWhat do I do next?\n\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your classified.\nDEFAULT_URL/membros\n\nOnce this has been completed a directory administrator will review your classified and set it live within the directory.\n\nSubmissions are reviewed within 2 working days following payment.\n\nThank you for being a member of the EDIRECTORY_TITLE!\n\nRegards\nEDIRECTORY_TITLE Advertising Team\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYou have just added one classified in our directory.<br /><br />\nWhat do I do next? <br /><br />\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your classified. <br />\n<a href=\"DEFAULT_URL/membros\" class=\"email_style_settings\">DEFAULT_URL/membros</a> <br /><br />\nOnce this has been completed a directory administrator will review your classified and set it live within the directory.<br /><br />\nSubmissions are reviewed within 2 working days following payment.<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\nRegards<br />\nEDIRECTORY_TITLE Advertising Team</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('12','EDIRECTORY_TITLE Notification','Dear ACCOUNT_NAME,\n\nYou have just added one article in our directory.\n\nWhat do I do next?\n\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your article.\nDEFAULT_URL/membros\n\nOnce this has been completed a directory administrator will review your article and set it live within the directory.\n\nSubmissions are reviewed within 2 working days following payment.\n\nThank you for being a member of the EDIRECTORY_TITLE!\n\nRegards\nEDIRECTORY_TITLE Advertising Team\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYou have just added one article in our directory.<br /><br />\nWhat do I do next? <br /><br />\nPlease login to the directory at the link below and click on Make your Payment link on the left menu options to pay for your article. <br />\n<a href=\"DEFAULT_URL/membros\" class=\"email_style_settings\">DEFAULT_URL/membros</a> <br /><br />\nOnce this has been completed a directory administrator will review your article and set it live within the directory.<br /><br />\nSubmissions are reviewed within 2 working days following payment.<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\nRegards<br />\nEDIRECTORY_TITLE Advertising Team</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('13','[EDIRECTORY_TITLE] Invoice','Hello ACCOUNT_NAME,\n\nYour invoice is ready for payment at the following link:\n\nDEFAULT_URL/membros/billing/index.php\n\nAmount Due: CUSTOM_INVOICE_AMOUNT\n\nEDIRECTORY_TITLE\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nHello ACCOUNT_NAME,<br /><br />\nYour invoice is ready for payment at the following link:<br /><br />\nDEFAULT_URL/membros/billing/index.php<br /><br />\nAmount Due: CUSTOM_INVOICE_AMOUNT<br /><br />\nEDIRECTORY_TITLE</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('14','EDIRECTORY_TITLE Activation Notification','Dear ACCOUNT_NAME,\n\nYour listing is live and active on EDIRECTORY_TITLE\n\nDEFAULT_URL/listing/\n\nThank you for being a member of the EDIRECTORY_TITLE!\n\nRegards\nEDIRECTORY_TITLE Team\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYour listing is live and active on EDIRECTORY_TITLE<br /><br />\nDEFAULT_URL/listing/<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\nRegards<br />\nEDIRECTORY_TITLE Team</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('15','EDIRECTORY_TITLE Activation Notification','Dear ACCOUNT_NAME,\n\nYour event is live and active on EDIRECTORY_TITLE\n\nDEFAULT_URL/event/\n\nThank you for being a member of the EDIRECTORY_TITLE!\n\nRegards\nEDIRECTORY_TITLE Team\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYour event is live and active on EDIRECTORY_TITLE<br /><br />\nDEFAULT_URL/event/<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\nRegards<br />\nEDIRECTORY_TITLE Team</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('16','EDIRECTORY_TITLE Activation Notification','Dear ACCOUNT_NAME,\n\nYour banner is live and active on EDIRECTORY_TITLE\n\nDEFAULT_URL/\n\nThank you for being a member of the EDIRECTORY_TITLE!\n\nRegards\nEDIRECTORY_TITLE Team\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYour banner is live and active on EDIRECTORY_TITLE<br /><br />\nDEFAULT_URL/<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\nRegards<br />\nEDIRECTORY_TITLE Team</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('17','EDIRECTORY_TITLE Activation Notification','Dear ACCOUNT_NAME,\n\nYour classified is live and active on EDIRECTORY_TITLE\n\nDEFAULT_URL/classified/\n\nThank you for being a member of the EDIRECTORY_TITLE!\n\nRegards\nEDIRECTORY_TITLE Team\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYour classified is live and active on EDIRECTORY_TITLE<br /><br />\nDEFAULT_URL/classified/<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\nRegards<br />\nEDIRECTORY_TITLE Team</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('18','EDIRECTORY_TITLE Activation Notification','Dear ACCOUNT_NAME,\n\nYour article is live and active on EDIRECTORY_TITLE\n\nDEFAULT_URL/article/\n\nThank you for being a member of the EDIRECTORY_TITLE!\n\nRegards\nEDIRECTORY_TITLE Team\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYour article is live and active on EDIRECTORY_TITLE<br /><br />\nDEFAULT_URL/article/<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\nRegards<br />\nEDIRECTORY_TITLE Team</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('19','Here\'s information on ITEM_TITLE from EDIRECTORY_TITLE','Hello, I found this item in EDIRECTORY_TITLE and I think it would be great for you.\n\nYou can view it at ITEM_URL\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nHello, I found this item in EDIRECTORY_TITLE and I think it would be great for you.<br /><br />\nYou can view it at ITEM_URL</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('20','EDIRECTORY_TITLE Signup Notification','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see:\r\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.\r\nAnd\r\nYour item in DEFAULT_URL/membros/ \"Manage Listings\" link.','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br />\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).<br />\nLogin to manage your account with the username and password below.<br /><br />\nUsername: ACCOUNT_USERNAME<br />\nPassword: ACCOUNT_PASSWORD<br /><br />\nYou can see:<br />\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.<br />\nAnd<br />\nYour item in DEFAULT_URL/membros/ \"Manage Listings\" link.\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('21','EDIRECTORY_TITLE Signup Notification','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see:\r\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.\r\nAnd\r\nYour item in DEFAULT_URL/membros/ \"Manage Events\" link.','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br />\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).<br />\nLogin to manage your account with the username and password below.<br /><br />\nUsername: ACCOUNT_USERNAME<br />\nPassword: ACCOUNT_PASSWORD<br /><br />\nYou can see:<br />\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.<br />\nAnd<br />\nYour item in DEFAULT_URL/membros/ \"Manage Events\" link.\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('22','EDIRECTORY_TITLE Signup Notification','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see:\r\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.\r\nAnd\r\nYour item in DEFAULT_URL/membros/ \"Manage Banners\" link.','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br />\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).<br />\nLogin to manage your account with the username and password below.<br /><br />\nUsername: ACCOUNT_USERNAME<br />\nPassword: ACCOUNT_PASSWORD<br /><br />\nYou can see:<br />\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.<br />\nAnd<br />\nYour item in DEFAULT_URL/membros/ \"Manage Banners\" link.\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('23','EDIRECTORY_TITLE Signup Notification','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see:\r\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.\r\nAnd\r\nYour item in DEFAULT_URL/membros/ \"Manage Classifieds\" link.','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br />\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).<br />\nLogin to manage your account with the username and password below.<br /><br />\nUsername: ACCOUNT_USERNAME<br />\nPassword: ACCOUNT_PASSWORD<br /><br />\nYou can see:<br />\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.<br />\nAnd<br />\nYour item in DEFAULT_URL/membros/ \"Manage Classifieds\" link.\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('24','EDIRECTORY_TITLE Signup Notification','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see:\r\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.\r\nAnd\r\nYour item in DEFAULT_URL/membros/ \"Manage Articles\" link.','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br />\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).<br />\nLogin to manage your account with the username and password below.<br /><br />\nUsername: ACCOUNT_USERNAME<br />\nPassword: ACCOUNT_PASSWORD<br /><br />\nYou can see:<br />\nYour account in DEFAULT_URL/membros/ \"Manage Account\" link.<br />\nAnd<br />\nYour item in DEFAULT_URL/membros/ \"Manage Articles\" link.\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('25','EDIRECTORY_TITLE Claimer Signup Notification','Dear ACCOUNT_NAME,\r\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).\r\nLogin to manage your account with the username and password below.\r\n\r\nUsername: ACCOUNT_USERNAME\r\nPassword: ACCOUNT_PASSWORD\r\n\r\nYou can see your account in DEFAULT_URL/membros/ \"Manage Account\" link.','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br />\nThank you for signing up for an account in EDIRECTORY_TITLE (DEFAULT_URL).<br />\nLogin to manage your account with the username and password below.<br /><br />\nUsername: ACCOUNT_USERNAME<br />\nPassword: ACCOUNT_PASSWORD<br /><br />\nYou can see your account in DEFAULT_URL/membros/ \"Manage Account\" link.\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('26','EDIRECTORY_TITLE Claim Approved Notification','Dear ACCOUNT_NAME,\r\nYour claim to the item \"LISTING_TITLE\" was \"automatically approved\".','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br />\nYour claim to the item \"LISTING_TITLE\" was \"automatically approved\".\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('27','EDIRECTORY_TITLE Claim Approved Notification','Dear ACCOUNT_NAME,\r\nYour claim to the item \"LISTING_TITLE\" was \"approved\" by site manager.','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br />\nYour claim to the item \"LISTING_TITLE\" was \"approved\" by site manager.\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('28','EDIRECTORY_TITLE Claim Denied Notification','Dear ACCOUNT_NAME,\r\nYour claim to the item \"LISTING_TITLE\" was \"denied\" by site manager.','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br />\nYour claim to the item \"LISTING_TITLE\" was \"denied\" by site manager.\n</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('29','[EDIRECTORY_TITLE] Reply Approved Notification','Dear ACCOUNT_NAME,\n\nYour reply is live and active on EDIRECTORY_TITLE\n\nDEFAULT_URL/listing/\n\nThank you for being a member of the EDIRECTORY_TITLE!\n\nRegards\nEDIRECTORY_TITLE Team\n','<html>\n<head>\n<style type=\"text/css\">\n.default_text_settings {\nfont-family: Verdana, Arial, Helvetica, sans-serif;\nfont-size: 8pt;\ncolor: #003365;\nmargin: 0;\npadding: 5px;\nbackground: #FBFBFB;\nborder: 1px solid #E9E9E9;\ntext-align: justify;\n};\n</style>\n</head>\n<body>\n<div class=\"default_text_settings\">\nDear ACCOUNT_NAME,<br /><br />\nYour reply is live and active on EDIRECTORY_TITLE<br /><br />\nDEFAULT_URL/listing/<br /><br />\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\nRegards<br />\nEDIRECTORY_TITLE Team</div>\n</body>\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('30','[EDIRECTORY_TITLE] Review Approved Notification','Dear ACCOUNT_NAME,\r\n\r\nYour item has a new review approved by site manager.\r\n\r\nRegards\r\nEDIRECTORY_TITLE Team\r\n','<html>\r\n<head>\r\n<style type=\"text/css\">\r\n.default_text_settings {\r\nfont-family: Verdana, Arial, Helvetica, sans-serif;\r\nfont-size: 8pt;\r\ncolor: #003365;\r\nmargin: 0;\r\npadding: 5px;\r\nbackground: #FBFBFB;\r\nborder: 1px solid #E9E9E9;\r\ntext-align: justify;\r\n};\r\n</style>\r\n</head>\r\n<body>\r\n<div class=\"default_text_settings\">\r\nDear ACCOUNT_NAME,<br /><br />\r\nYour item has a new review approved by site manager.<br /><br />\r\nRegards<br />\r\nEDIRECTORY_TITLE Team</div>\r\n</body>\r\n</html>');
INSERT INTO `Email_Notification_Default` (`id`,`subject`,`body_text`,`body_html`) VALUES ('31','[EDIRECTORY_TITLE] New Review Notification','Dear ACCOUNT_NAME,\r\n\r\nYour item on EDIRECTORY_TITLE has a new review. \r\n  \r\nThank you for being a member of the EDIRECTORY_TITLE!\r\n\r\nRegards\r\nEDIRECTORY_TITLE Team\r\n','<html>\r\n<head>\r\n<style type=\"text/css\">\r\n.default_text_settings {\r\nfont-family: Verdana, Arial, Helvetica, sans-serif;\r\nfont-size: 8pt;\r\ncolor: #003365;\r\nmargin: 0;\r\npadding: 5px;\r\nbackground: #FBFBFB;\r\nborder: 1px solid #E9E9E9;\r\ntext-align: justify;\r\n};\r\n</style>\r\n</head>\r\n<body>\r\n<div class=\"default_text_settings\">\r\nDear ACCOUNT_NAME,<br /><br />\r\nYour item on EDIRECTORY_TITLE has a new review. \r\n<br /><br />\r\nThank you for being a member of the EDIRECTORY_TITLE!<br /><br />\r\nRegards<br />\r\nEDIRECTORY_TITLE Team</div>\r\n</body>\r\n</html>');
/*!40000 ALTER TABLE `Email_Notification_Default` ENABLE KEYS */;


--
-- Create Table `Email_Notification_Lang`
--

DROP TABLE IF EXISTS `Email_Notification_Lang`;
CREATE TABLE `Email_Notification_Lang` (
  `id` int(11) NOT NULL default '0',
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `lang` char(5) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY  (`id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Email_Notification_Lang`
--

/*!40000 ALTER TABLE `Email_Notification_Lang` DISABLE KEYS */;
/*!40000 ALTER TABLE `Email_Notification_Lang` ENABLE KEYS */;


--
-- Create Table `Event`
--

DROP TABLE IF EXISTS `Event`;
CREATE TABLE `Event` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL default '0',
  `discount_id` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `seo_title` varchar(255) NOT NULL,
  `friendly_url` varchar(255) NOT NULL,
  `image_id` int(11) NOT NULL default '0',
  `thumb_id` int(11) NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `description1` varchar(255) NOT NULL,
  `description2` varchar(255) NOT NULL,
  `description3` varchar(255) NOT NULL,
  `description4` varchar(255) NOT NULL,
  `seo_description` varchar(255) NOT NULL,
  `seo_description1` varchar(255) NOT NULL,
  `seo_description2` varchar(255) NOT NULL,
  `seo_description3` varchar(255) NOT NULL,
  `seo_description4` varchar(255) NOT NULL,
  `long_description` text NOT NULL,
  `long_description1` text NOT NULL,
  `long_description2` text NOT NULL,
  `long_description3` text NOT NULL,
  `long_description4` text NOT NULL,
  `keywords` text NOT NULL,
  `keywords1` text NOT NULL,
  `keywords2` text NOT NULL,
  `keywords3` text NOT NULL,
  `keywords4` text NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `seo_keywords1` varchar(255) NOT NULL,
  `seo_keywords2` varchar(255) NOT NULL,
  `seo_keywords3` varchar(255) NOT NULL,
  `seo_keywords4` varchar(255) NOT NULL,
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `entered` datetime NOT NULL default '0000-00-00 00:00:00',
  `start_date` date NOT NULL default '0000-00-00',
  `has_start_time` char(1) NOT NULL default 'n',
  `start_time` time NOT NULL default '00:00:00',
  `end_date` date NOT NULL default '0000-00-00',
  `has_end_time` char(1) NOT NULL default 'n',
  `end_time` time NOT NULL default '00:00:00',
  `location` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `zip_code` varchar(10) NOT NULL default '',
  `zip5` varchar(10) NOT NULL default '0',
  `latitude` double(10,6) NOT NULL default '0.000000',
  `longitude` double(10,6) NOT NULL default '0.000000',
  `maptuning` varchar(255) NOT NULL,
  `estado_id` int(11) NOT NULL default '0',
  `cidade_id` int(11) NOT NULL default '0',
  `bairro_id` int(11) NOT NULL default '0',
  `city_id` int(11) NOT NULL default '0',
  `area_id` int(11) NOT NULL default '0',
  `url` varchar(255) NOT NULL default '',
  `contact_name` varchar(255) NOT NULL default '',
  `phone` varchar(255) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `renewal_date` date NOT NULL default '0000-00-00',
  `status` char(1) NOT NULL default '',
  `level` tinyint(3) NOT NULL default '0',
  `random_number` bigint(15) NOT NULL default '0',
  `cat_1_id` int(11) NOT NULL default '0',
  `parcat_1_level1_id` int(11) NOT NULL default '0',
  `cat_2_id` int(11) NOT NULL default '0',
  `parcat_2_level1_id` int(11) NOT NULL default '0',
  `cat_3_id` int(11) NOT NULL default '0',
  `parcat_3_level1_id` int(11) NOT NULL default '0',
  `cat_4_id` int(11) NOT NULL default '0',
  `parcat_4_level1_id` int(11) NOT NULL default '0',
  `cat_5_id` int(11) NOT NULL default '0',
  `parcat_5_level1_id` int(11) NOT NULL default '0',
  `fulltextsearch_keyword` text NOT NULL,
  `fulltextsearch_where` text NOT NULL,
  `recurring` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`),
  KEY `account_id` (`account_id`),
  KEY `latitude` (`latitude`),
  KEY `longitude` (`longitude`),
  KEY `estado_id` (`estado_id`),
  KEY `cidade_id` (`cidade_id`),
  KEY `bairro_id` (`bairro_id`),
  KEY `status` (`status`),
  KEY `level` (`level`),
  KEY `city_id` (`city_id`),
  KEY `area_id` (`area_id`),
  KEY `title` (`title`),
  KEY `friendly_url` (`friendly_url`),
  KEY `random_number` (`random_number`),
  KEY `cat_1_id` (`cat_1_id`),
  KEY `parcat_1_level1_id` (`parcat_1_level1_id`),
  KEY `cat_2_id` (`cat_2_id`),
  KEY `parcat_2_level1_id` (`parcat_2_level1_id`),
  KEY `cat_3_id` (`cat_3_id`),
  KEY `parcat_3_level1_id` (`parcat_3_level1_id`),
  KEY `cat_4_id` (`cat_4_id`),
  KEY `parcat_4_level1_id` (`parcat_4_level1_id`),
  KEY `cat_5_id` (`cat_5_id`),
  KEY `parcat_5_level1_id` (`parcat_5_level1_id`),
  FULLTEXT KEY `fulltextsearch_keyword` (`fulltextsearch_keyword`),
  FULLTEXT KEY `fulltextsearch_where` (`fulltextsearch_where`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Data for Table `Event`
--

/*!40000 ALTER TABLE `Event` DISABLE KEYS */;
INSERT INTO `Event` (`id`,`account_id`,`discount_id`,`title`,`seo_title`,`friendly_url`,`image_id`,`thumb_id`,`description`,`description1`,`description2`,`description3`,`description4`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`long_description`,`long_description1`,`long_description2`,`long_description3`,`long_description4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`updated`,`entered`,`start_date`,`has_start_time`,`start_time`,`end_date`,`has_end_time`,`end_time`,`location`,`address`,`zip_code`,`zip5`,`latitude`,`longitude`,`maptuning`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`url`,`contact_name`,`phone`,`email`,`renewal_date`,`status`,`level`,`random_number`,`cat_1_id`,`parcat_1_level1_id`,`cat_2_id`,`parcat_2_level1_id`,`cat_3_id`,`parcat_3_level1_id`,`cat_4_id`,`parcat_4_level1_id`,`cat_5_id`,`parcat_5_level1_id`,`fulltextsearch_keyword`,`fulltextsearch_where`,`recurring`) VALUES ('1','0','','Take That','Take That','take-that','0','0','','','','','','','','','','','','','','','','','','','','','','','','','','2009-07-04 17:33:19','2009-07-04 17:33:10','2009-07-04','n','00:00:00','2009-07-04','n','00:00:00','Wembley Stadium','Empire Way','HA9 0DS','HA9','51.559000','-0.287000','','235','3413','233','0','0','','','','','0000-00-00','A','10','882876655909118','0','0','0','0','0','0','0','0','0','0','Take That','Empire Way Wembley Stadium HA9 0DS United Kingdom  England  London','');
INSERT INTO `Event` (`id`,`account_id`,`discount_id`,`title`,`seo_title`,`friendly_url`,`image_id`,`thumb_id`,`description`,`description1`,`description2`,`description3`,`description4`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`long_description`,`long_description1`,`long_description2`,`long_description3`,`long_description4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`updated`,`entered`,`start_date`,`has_start_time`,`start_time`,`end_date`,`has_end_time`,`end_time`,`location`,`address`,`zip_code`,`zip5`,`latitude`,`longitude`,`maptuning`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`url`,`contact_name`,`phone`,`email`,`renewal_date`,`status`,`level`,`random_number`,`cat_1_id`,`parcat_1_level1_id`,`cat_2_id`,`parcat_2_level1_id`,`cat_3_id`,`parcat_3_level1_id`,`cat_4_id`,`parcat_4_level1_id`,`cat_5_id`,`parcat_5_level1_id`,`fulltextsearch_keyword`,`fulltextsearch_where`,`recurring`) VALUES ('2','0','',' Madonna',' Madonna','-madonna','0','0','7pm','','','','','7pm','','','','','','','','','','pop || electronica || dance || pop || rock','','','','','pop, electronica, dance, pop, rock','','','','','2009-07-04 18:02:48','2009-07-04 18:01:39','2009-07-07','n','00:00:00','2009-07-31','n','00:00:00','MEN Arena','Victoria Station ','M3 1AR ','M3','53.483000','-2.251000','','235','3413','244','0','0','','','','','0000-00-00','A','10','567077734104430','0','0','0','0','0','0','0','0','0','0',' Madonna pop electronica dance pop rock 7pm','Victoria Station  MEN Arena M3 1AR  United Kingdom  England  Manchester','');



--
-- Create Table `EventCategory`
--

DROP TABLE IF EXISTS `EventCategory`;
CREATE TABLE `EventCategory` (
  `id` int(11) NOT NULL auto_increment,
  `lang` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `title1` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `title3` varchar(255) NOT NULL,
  `title4` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL default '0',
  `seo_description` varchar(255) NOT NULL,
  `seo_description1` varchar(255) NOT NULL,
  `seo_description2` varchar(255) NOT NULL,
  `seo_description3` varchar(255) NOT NULL,
  `seo_description4` varchar(255) NOT NULL,
  `friendly_url` varchar(255) NOT NULL,
  `friendly_url1` varchar(255) NOT NULL,
  `friendly_url2` varchar(255) NOT NULL,
  `friendly_url3` varchar(255) NOT NULL,
  `friendly_url4` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `keywords1` text NOT NULL,
  `keywords2` text NOT NULL,
  `keywords3` text NOT NULL,
  `keywords4` text NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `seo_keywords1` varchar(255) NOT NULL,
  `seo_keywords2` varchar(255) NOT NULL,
  `seo_keywords3` varchar(255) NOT NULL,
  `seo_keywords4` varchar(255) NOT NULL,
  `active_event` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `category_id` (`category_id`),
  KEY `title` (`title`),
  KEY `active_event` (`active_event`),
  KEY `title1` (`title1`),
  KEY `title2` (`title2`),
  KEY `title3` (`title3`),
  KEY `title4` (`title4`),
  KEY `friendly_url1` (`friendly_url1`),
  KEY `friendly_url2` (`friendly_url2`),
  KEY `friendly_url3` (`friendly_url3`),
  KEY `friendly_url4` (`friendly_url4`),
  KEY `lang` (`lang`),
  FULLTEXT KEY `keywords` (`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`title`,`title1`,`title2`,`title3`,`title4`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Data for Table `EventCategory`
--

/*!40000 ALTER TABLE `EventCategory` DISABLE KEYS */;
INSERT INTO `EventCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_event`) VALUES ('1','','category-event','','','','','0','','','','','','category-event','','','','','category-event','','','','','','','','','','0');
/*!40000 ALTER TABLE `EventCategory` ENABLE KEYS */;


--
-- Create Table `EventLevel`
--

DROP TABLE IF EXISTS `EventLevel`;
CREATE TABLE `EventLevel` (
  `value` int(3) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `defaultlevel` char(1) NOT NULL default 'n',
  `detail` char(1) NOT NULL default 'y',
  `images` int(3) NOT NULL default '0',
  `price` decimal(10,2) NOT NULL default '0.00',
  `content` text NOT NULL,
  `active` char(1) NOT NULL default 'y',
  PRIMARY KEY  (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `EventLevel`
--

/*!40000 ALTER TABLE `EventLevel` DISABLE KEYS */;
INSERT INTO `EventLevel` (`value`,`name`,`defaultlevel`,`detail`,`images`,`price`,`content`,`active`) VALUES ('10','basic','n','n','0','0.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\">\r\n<ul>\r\n<li>Title, Date, Address, Phone, Send to a Friend, Add to Favorites. </li></ul>[LEVELBUTTON] </td>\r\n<td>\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Summary View</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_event_basic_summary_enus.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>','y');
INSERT INTO `EventLevel` (`value`,`name`,`defaultlevel`,`detail`,`images`,`price`,`content`,`active`) VALUES ('30','premium','n','n','0','25.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>Premium Events appear in search results above the Basic Events. </li>\r\n<li>Title, Date, Time, Logo image, Address, Phone, Summary Description, Send to a Friend, Add to Favorites. </li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Summary View</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_event_premium_summary_enus.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>','y');
INSERT INTO `EventLevel` (`value`,`name`,`defaultlevel`,`detail`,`images`,`price`,`content`,`active`) VALUES ('50','showcase','y','y','3','50.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">\r\n<p align=\"right\">[LEVELPRICE]</p></td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent\" colspan=\"2\">\r\n<ul>\r\n<li>Showcase Events appear in search results above Premium and Basic Events. </li>\r\n<li>Contains Summary View and Detail view. </li>\r\n<li>Title, Date, Time, Logo Image, Address, Location, Summary Description, Driving Directions, Phone, Web Link, E-mail, Contact Name, Photo Gallery, Detail Description, Send to a Friend, Add to Favorites, Print. </li></ul></td></tr>\r\n<tr>\r\n<td valign=\"top\" colspan=\"2\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Summary View</th>\r\n<th class=\"detailColumn\">Detail View</th></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_event_showcase_summary_enus.gif\"> [LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_event_showcase_detail_enus.gif\"> <span class=\"advertiseAlert\">* These images are <strong>illustrative</strong></span> </td></tr></tbody></table></td></tr></tbody></table>','y');
/*!40000 ALTER TABLE `EventLevel` ENABLE KEYS */;


--
-- Create Table `EventLevel_Lang`
--

DROP TABLE IF EXISTS `EventLevel_Lang`;
CREATE TABLE `EventLevel_Lang` (
  `value` int(3) NOT NULL,
  `lang` char(5) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`value`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `EventLevel_Lang`
--

/*!40000 ALTER TABLE `EventLevel_Lang` DISABLE KEYS */;
INSERT INTO `EventLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','pt_br','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">\r\n<p align=\"right\">[LEVELPRICE]</p></td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent\" colspan=\"2\">\r\n<ul>\r\n<li>Os eventos de nível Showcase aparecem acima dos eventos de nível Premium e Basic nos resultados das buscas. </li>\r\n<li>Contém visualização resumida e visualização detalhada. </li>\r\n<li>Título, Data, Hora, Logo, Endereço, Local, Descrição resumida, Como chegar, Fone, Site, E-mail, Nome do contato, Galeria de fotos, Descrição detalhada, Indique para um amigo, Adicionar aos favoritos, Imprimir.</li></ul></td></tr>\r\n<tr>\r\n<td valign=\"top\" colspan=\"2\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Visualização resumida</th>\r\n<th class=\"detailColumn\">Visualização detalhada</th></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_event_showcase_summary_ptbr.gif\"> [LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_event_showcase_detail_ptbr.gif\"> <span class=\"advertiseAlert\">* Imagens ilustrativas</span> </td></tr></tbody></table></td></tr></tbody></table>');
INSERT INTO `EventLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','es_es','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">\r\n<p align=\"right\">[LEVELPRICE]</p></td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent\" colspan=\"2\">\r\n<ul>\r\n<li>Cuando se hace una busqueda, los Eventos de nivel Showcase aparecen sobre los eventos Premium y Basic. </li>\r\n<li>Contiene Descripcion Resumida y Descripcion Completa. </li>\r\n<li>Titulo, Fecha, Hora, Logo, Dirección, Ubicación, Resumen Descripción, Indicaciones, Teléfono, Enlace para Sitio de Internet, Correo Electronico, Nombre del contacto, Galería de Fotos, Descripción detallada, Enviar a un amigo, Agregar a lista rápida, Imprimir.</li></ul></td></tr>\r\n<tr>\r\n<td valign=\"top\" colspan=\"2\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Resumen</th>\r\n<th class=\"detailColumn\">Detalle</th></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_event_showcase_summary_eses.gif\"> [LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_event_showcase_detail_eses.gif\"> <span class=\"advertiseAlert\">* Estas imágenes son ilustrativas</span> </td></tr></tbody></table></td></tr></tbody></table>');
INSERT INTO `EventLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','fr_fr','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">\r\n<p align=\"right\">[LEVELPRICE]</p></td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent\" colspan=\"2\">\r\n<ul>\r\n<li>Les Événements de niveau Showcase apparaissent au-dessus de Premium et Basic dans les résultats de recherche. </li>\r\n<li>Contient vue résumée et détaillée. </li>\r\n<li>Titre, Date, Heure, Logo, Adresse, Emplacement, Description sommaire, Obtenir l\'itinéraire, Téléphone, Web Link, E-Mail, Nom du Contact, Galerie photo, Description détaillée, E-mail un ami, Ajouter à la liste rapide, Imprimer.</li></ul></td></tr>\r\n<tr>\r\n<td valign=\"top\" colspan=\"2\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Vue résumée</th>\r\n<th class=\"detailColumn\">Vue détaillée</th></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_event_showcase_summary_frfr.gif\"> [LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_event_showcase_detail_frfr.gif\"> <span class=\"advertiseAlert\">* Ces images sont des exemples</span> </td></tr></tbody></table></td></tr></tbody></table>');
INSERT INTO `EventLevel_Lang` (`value`,`lang`,`content`) VALUES ('30','pt_br','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>Os eventos de nível Premium aparecem acima dos eventos de nível Basic nos resultados das buscas. </li>\r\n<li>Título, Data, Hora, Logo, Endereço, Fone, Descrição resumida, Indique para um amigo, Adicionar aos favoritos.</li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Visualização resumida</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_event_premium_summary_ptbr.gif\"> <span class=\"advertiseAlert\">* Imagens ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `EventLevel_Lang` (`value`,`lang`,`content`) VALUES ('30','es_es','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>Cuando se hace una busqueda, los Eventos de nivel Premium aparecen sobre los eventos Basic. </li>\r\n<li>Titulo, Fecha, Hora, Logo, Dirección, Teléfono, Resumen Descripción, Enviar a un amigo, Agregar a lista rápida.</li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Resumen</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_event_premium_summary_eses.gif\"> <span class=\"advertiseAlert\">* Estas imágenes son ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `EventLevel_Lang` (`value`,`lang`,`content`) VALUES ('30','fr_fr','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>Les Événements de niveau Premium apparaissent au-dessus de Basic dans les résultats de recherche. </li>\r\n<li>Titre, Date, Heure, Logo, Adresse, Téléphone, Description sommaire, E-mail un ami, Ajouter à la liste rapide.</li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Vue résumée</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_event_premium_summary_frfr.gif\"> <span class=\"advertiseAlert\">* Ces images sont des exemples</span> </td></tr></tbody></table>');
INSERT INTO `EventLevel_Lang` (`value`,`lang`,`content`) VALUES ('10','pt_br','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\">\r\n<ul>\r\n<li>Título, Data, Endereço, Fone, Indique para um amigo, Adicionar aos favoritos.</li></ul>[LEVELBUTTON] </td>\r\n<td>\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Visualização resumida</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_event_basic_summary_ptbr.gif\"> <span class=\"advertiseAlert\">* Imagens ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `EventLevel_Lang` (`value`,`lang`,`content`) VALUES ('10','es_es','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\">\r\n<ul>\r\n<li>Titulo, Fecha, Dirección, Teléfono, Enviar a un amigo, Agregar a lista rápida.</li></ul>[LEVELBUTTON] </td>\r\n<td>\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Resumen</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_event_basic_summary_eses.gif\"> <span class=\"advertiseAlert\">* Estas imágenes son ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `EventLevel_Lang` (`value`,`lang`,`content`) VALUES ('10','fr_fr','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\">\r\n<ul>\r\n<li>Titre, Date, Adresse, Téléphone, E-mail un ami, Ajouter à la liste rapide.</li></ul>[LEVELBUTTON] </td>\r\n<td>\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Vue résumée</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_event_basic_summary_frfr.gif\"> <span class=\"advertiseAlert\">* Ces images sont des exemples</span> </td></tr></tbody></table>');
/*!40000 ALTER TABLE `EventLevel_Lang` ENABLE KEYS */;


--
-- Create Table `FAQ`
--

DROP TABLE IF EXISTS `FAQ`;
CREATE TABLE `FAQ` (
  `id` int(11) NOT NULL auto_increment,
  `sitemgr` char(1) NOT NULL default 'n',
  `member` char(1) NOT NULL default 'n',
  `frontend` char(1) NOT NULL default 'n',
  `question` text NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Data for Table `FAQ`
--

/*!40000 ALTER TABLE `FAQ` DISABLE KEYS */;
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('1','y','n','n','When \"Claim this ad\" is available?','Listings without accounts (No Owner) can use the claim feature (\"Claim this ad\" link will show up at front area for no owner listings).');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('2','y','n','n','Who can \"Claim this ad\"?','If the \"Claim this ad\" link is available at front area, any member or new membros can claim the listing, after the claim the sitemgr can approve it or not.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('3','y','n','n','Can I turn off \"Claim this ad\" for a listing?','If the listing does not have an account and it is not available to claim, you can check the box \"Disable claim feature for this listing\". The \"Claim this ad\" link will be turned off for this listing.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('4','y','n','n','What is \"No Image\"? And Where is it used?','If the member or sitemgr forget to upload an image to an item, to the gallery or other image field, \"No Image\" will replace the space related to image.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('5','y','n','n','My .csv file must have the same columns as .csv sample?','Make sure that your data columns match the sample .csv format provided. All fields must be on the file to the import works correctly.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('6','y','n','n','Can I delete any column on the .csv file import?','No, you cannot. Please base your import on the .csv sample file and do not delete any columns or the import will not work correctly.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('7','y','n','n','Do I have to put my .csv file on the same order as the import .csv sample file?','Yes, you have. The data fields in the .csv that you upload must be in the same order as the sample template format. If the data is not in the correct format order your data will not be imported correctly.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('8','y','n','n','Can I make imports with the same account? And different accounts?','If you want that each listing has its own account, then the file has to have a different account username for each listing. But if the listings have the same account on the file, they will be imported to the same account.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('9','y','n','n','What does it happen if I misspell some location on the import?','Please be specific when you are spelling text for your location fields. For example, if you import two listings for the State of \"New York\", and on a listing you write \"NewYork\", and on the other one you write \"New York\", both States will appear on the search dropdowns into the directory.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('10','y','n','n','What does it happen if I misspell same category on import?','Please be specific when you are spelling text for your category fields. If a listing has the \"Arts & Entertainment\" category and the other one has \"Arts and Entertainment\", both categories will appear on the listing search dropdown fields, on the listing browse by category area, and on the browse categories area on listing results pages.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('11','y','n','n','How many categories can I import?','The category level amount allowed to import is 5. More than that it will not import.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('12','y','n','n','Can I import any username/password?','Invalid Username/Password will not be imported. A valid username needs to have a min of 4 chars and a max of 80 chars.The Password needs to have a min of 4 chars and max of 50 chars. And it does not allow special chars.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('13','y','n','n','Do I have to import all listings with account?','If the username is empty, the listing will be imported without account. That means that the listing is a no owner listing.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('14','y','n','n','What does it happen if I import more than one listing with the same title?','Import will add the new listings to database without deleting existing listings.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('15','y','n','n','What is required to import works?','The Listing Title text is required.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('16','y','n','n','How can I import listings to have the \"claim this ad\" link for the claim feature?','To use the \"claim listing\" feature and don´t assign a listing to a specific account, when doing the .csv import file leave the columns related to member account information blank.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('17','y','n','n','Can I import a listing to be claimed later?','To import listings for future customers to \"claim\" the listings on the front of the directory with the sitemgr approval, please import the listing information and leave the .csv fields associated with the account empty.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('18','y','n','n','Can I rollback an import?','You can roll back a finished or stopped import. All the accounts and listings imported will be removed, but for security reason the categories and locations imported will remain in the directory.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('19','y','n','n','How can I rollback imported data?','To rollback imported data, click on the \"Rollback\" button on the \"Import Log\" section and follow the rollback process.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('20','y','n','n','Can I delete an imported data log?','When using \"Delete Log\" button, data will not be removed from the directory. The specific log will only be removed from this page but the data will remain in the directory.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('21','y','n','n','What is \"Designations\"?','Listing Designations allow you to designate listings with certain properties. For example, if you want to mark a listing as \"Editor\'s Choice\", you can upload your own icon, and mark(on the listing form) the listings you want to display the icon. You can also give membros access to select the designations themselves by checking the box. For example you may want a \"Pet Friendly\" option that membros can use to add to their listings.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('22','y','n','n','What are the templates?','With the templates you can modify the listings summary and detail styles.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('23','y','n','n','Which type of modifications the templates support?','You can charge an additional price per template, determine the detail layout, define the template colors, rename common fields (example: \"Restaurant Name\" instead of \"Listing Title\"), add new fields (checkboxes, dropdowns, text fields, short description fields and long descritpion fields) and select which of them will be required and searchable on the front-end.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('24','y','y','n','How can I add videos to my listing?','Only the showcase listing level has the video feature. You need to insert the video code on the listing form on the Code field.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('25','y','y','n','Where can I find videos to my listings?','There are some sites that host videos. Examples: http://www.youtube.com, http://video.google.com, http://video.yahoo.com, http://www.dailymotion.com');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('26','y','n','n','How does the Import Settings work?','On the \"Import\" settings on the \"Settings\" section, you can setup some import options: * The import file comes from export section: If you export a csv file from the Export section and want to import this file, you must check this option. * Enable all imported listings as Active: If you want all the imported listings to be active you must check this option. * Default Level for imported listings without level: If the file has listings without level, you must define which level they will be imported. * Import listings to the same account: If you want all listings to be imported to the same account you must choose the account.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('27','y','n','n','How can I disable an Email Notification?','Go to \"Email Notifications\" section, click on the email you want to disable, you will see a \"Disable e-mail\" checkbox, check this box and hit the next button, then save.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('28','n','y','n','How can I enable Google Maps?','The google maps feature is automatically enabled when you fill out the location fields on all items forms.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('29','n','y','n','How does the \"Log Me In Automatically\" work?','The \"Log me in automatically\" is optional, it saves your username and password on your computer and every time you access the page you will be automatically logged in.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('30','y','y','y','What happens if I forget my password?','If you forget your password, please click on the \'Forgot your Password?\' link of the front of the directory or on the member login page. The password recovery email will be sent to the email address provided from your Contact Information. The email will contain a link which will redirect the member to the \'Manage Account\' section, where the password can be updated.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('31','n','y','n','How can I change my password?','After you are logged in, click on \'Manage account\' link, you will see the \"Current Password\" field, type your current password in this field and your new password on the fields \"Password\" and \"Retype Password\", then hit the submit button.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('32','n','y','n','Can I change my username?','No, you cannot. Only your password and contact information can be updated.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('33','n','y','n','Can I change my items status (active, pending or suspended)?','Yes, you can. If your item is active you can change it to suspeded and vice versa. You cannot change the pending status of any item.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('34','n','y','n','Can I change my item level?','Yes, you can. After your item is expired you can choose the level(if it´s free you can change the level anytime) and pay for it.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('35','n','y','n','Can I add categories to my promotion?','No, you cannot. The promotion is related to the listing categories you choose.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('36','n','n','y','What is \'View Quick List\'?','The \'View Quick List\' link will redirect the user to a page which illustrates their favorite items. To add an item to your \'View Quick List\' page, click the text \'Add to Quick List\' on any item.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('37','n','n','y','Am I required to have an account to add items to the site?','Yes. In order to add any item, including Free items, to the directory you must have an account.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('38','n','n','y','How can I signup for an account?','To signup as a member go to \"Advertise with us\" link at top menu, select an item and level and click in \"Order Now\" button. Fill out all fields, write down your username and password for future reference, choose the best payment gateway for you and follow the steps to finish the process.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('39','n','n','y','What determines which listings appear as Featured Listings on the Home Page and main Listings page?','Only Showcase Listings appear as Featured Listings, and they are then randomly rotated.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('40','n','n','y','How can I print an item from the directory?','The items in the directory which have a detail page will contain a \'Print\' link. Once you click the link a new page will open with the information in printer friendly format.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('41','n','n','y','Is it possible to tell a friend about something found within the directory?','Yes. Each item with in the directory contains a \'Sent to Friend\' link. Click the link and a pop-up will open. Please fill out all fields in the pop-up and an email will be sent to your friend.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('42','n','n','y','How can I switch the language the directory is displayed in?','You can change the language by clicking one of the flags in the top right of any page.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('43','n','n','y','What do the numbers that appear after Category and Sub-Category names mean?','These numbers illustrate the total number of items registered under that category.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('44','n','n','y','Is it possible to search for events by date?','You can search for events by date by clicking on any specific day/month you choose directly on the calendar.');
INSERT INTO `FAQ` (`id`,`sitemgr`,`member`,`frontend`,`question`,`answer`) VALUES ('45','y','y','y','Why am I receiving an \'Account Locked\' message?','If you attempt to access your account and type in an incorrect password 5 times the account will lock for 1 hour. This is for security reasons.');
/*!40000 ALTER TABLE `FAQ` ENABLE KEYS */;


--
-- Create Table `Forgot_Password`
--

DROP TABLE IF EXISTS `Forgot_Password`;
CREATE TABLE `Forgot_Password` (
  `account_id` int(11) NOT NULL default '0',
  `unique_key` varchar(255) NOT NULL,
  `entered` date NOT NULL default '0000-00-00',
  `section` varchar(255) NOT NULL,
  KEY `account_id` (`account_id`),
  KEY `unique_key` (`unique_key`),
  KEY `entered` (`entered`),
  KEY `section` (`section`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Forgot_Password`
--

/*!40000 ALTER TABLE `Forgot_Password` DISABLE KEYS */;
/*!40000 ALTER TABLE `Forgot_Password` ENABLE KEYS */;


--
-- Create Table `Gallery`
--

DROP TABLE IF EXISTS `Gallery`;
CREATE TABLE `Gallery` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL,
  `entered` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Gallery`
--

/*!40000 ALTER TABLE `Gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `Gallery` ENABLE KEYS */;


--
-- Create Table `Gallery_Image`
--

DROP TABLE IF EXISTS `Gallery_Image`;
CREATE TABLE `Gallery_Image` (
  `id` int(11) NOT NULL auto_increment,
  `gallery_id` int(11) NOT NULL default '0',
  `image_id` int(11) NOT NULL default '0',
  `image_caption` varchar(255) NOT NULL default '',
  `image_caption1` varchar(255) NOT NULL,
  `image_caption2` varchar(255) NOT NULL,
  `image_caption3` varchar(255) NOT NULL,
  `image_caption4` varchar(255) NOT NULL,
  `thumb_id` int(11) NOT NULL default '0',
  `thumb_caption` varchar(255) NOT NULL default '',
  `thumb_caption1` text NOT NULL,
  `thumb_caption2` text NOT NULL,
  `thumb_caption3` text NOT NULL,
  `thumb_caption4` text NOT NULL,
  `order` int(3) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `gallery_id` (`gallery_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Gallery_Image`
--

/*!40000 ALTER TABLE `Gallery_Image` DISABLE KEYS */;
/*!40000 ALTER TABLE `Gallery_Image` ENABLE KEYS */;


--
-- Create Table `Gallery_Item`
--

DROP TABLE IF EXISTS `Gallery_Item`;
CREATE TABLE `Gallery_Item` (
  `id` int(11) NOT NULL auto_increment,
  `item_type` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL default '0',
  `gallery_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `item_type` (`item_type`),
  KEY `item_id` (`item_id`),
  KEY `gallery_id` (`gallery_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Gallery_Item`
--

/*!40000 ALTER TABLE `Gallery_Item` DISABLE KEYS */;
/*!40000 ALTER TABLE `Gallery_Item` ENABLE KEYS */;


--
-- Create Table `Image`
--

DROP TABLE IF EXISTS `Image`;
CREATE TABLE `Image` (
  `id` int(11) NOT NULL auto_increment,
  `type` set('JPG','GIF','SWF') NOT NULL default 'JPG',
  `width` smallint(6) NOT NULL default '0',
  `height` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Data for Table `Image`
--

/*!40000 ALTER TABLE `Image` DISABLE KEYS */;
INSERT INTO `Image` (`id`,`type`,`width`,`height`) VALUES ('1','JPG','250','250');
INSERT INTO `Image` (`id`,`type`,`width`,`height`) VALUES ('2','JPG','83','83');
/*!40000 ALTER TABLE `Image` ENABLE KEYS */;


--
-- Create Table `ImportLog`
--

DROP TABLE IF EXISTS `ImportLog`;
CREATE TABLE `ImportLog` (
  `id` int(11) NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  `time` time NOT NULL default '00:00:00',
  `filename` varchar(255) NOT NULL default '',
  `linesadded` varchar(255) NOT NULL,
  `phisicalname` varchar(255) NOT NULL,
  `status` char(1) NOT NULL default '',
  `progress` char(5) NOT NULL,
  `totallines` varchar(255) NOT NULL,
  `history` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Data for Table `ImportLog`
--

/*!40000 ALTER TABLE `ImportLog` DISABLE KEYS */;
INSERT INTO `ImportLog` (`id`,`date`,`time`,`filename`,`linesadded`,`phisicalname`,`status`,`progress`,`totallines`,`history`) VALUES ('1','2009-07-08','05:18:20','accomnewload.csv','52151','accomnewload.csv','F','100%','52151','File uploaded by ftp.\nImporting data to temporary table.\nCSV imported to temporary table.\nTotal lines read: 52151.\n');
/*!40000 ALTER TABLE `ImportLog` ENABLE KEYS */;


--
-- Create Table `ImportTemporary`
--

DROP TABLE IF EXISTS `ImportTemporary`;
CREATE TABLE `ImportTemporary` (
  `id` bigint(255) NOT NULL auto_increment,
  `import_log_id` int(11) NOT NULL default '0',
  `account_username` varchar(255) default NULL,
  `account_password` varchar(255) default NULL,
  `account_first_name` varchar(255) default NULL,
  `account_last_name` varchar(255) default NULL,
  `account_company` varchar(255) default NULL,
  `account_address` varchar(255) default NULL,
  `account_address2` varchar(255) default NULL,
  `account_country` varchar(255) default NULL,
  `account_state` varchar(255) default NULL,
  `account_city` varchar(255) default NULL,
  `account_zip` varchar(255) default NULL,
  `account_phone` varchar(255) default NULL,
  `account_fax` varchar(255) default NULL,
  `account_email` varchar(255) default NULL,
  `account_url` varchar(255) default NULL,
  `listing_title` varchar(255) default NULL,
  `listing_email` varchar(255) default NULL,
  `listing_url` varchar(255) default NULL,
  `listing_address` varchar(255) default NULL,
  `listing_address2` varchar(255) default NULL,
  `listing_country` varchar(255) default NULL,
  `listing_state` varchar(255) default NULL,
  `listing_city` varchar(255) default NULL,
  `listing_zip` varchar(255) default NULL,
  `listing_phone` varchar(255) default NULL,
  `listing_fax` varchar(255) default NULL,
  `listing_description` varchar(255) default NULL,
  `listing_long_description` text,
  `listing_keyword` varchar(255) default NULL,
  `listing_renewal_date` varchar(255) default NULL,
  `listing_status` varchar(255) default NULL,
  `listing_level` varchar(255) default NULL,
  `listing_category_1` text,
  `listing_category_2` text,
  `listing_category_3` text,
  `listing_category_4` text,
  `listing_category_5` text,
  `listing_template` varchar(255) default NULL,
  `file_line_number` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52152 DEFAULT CHARSET=latin1;

--
-- Data for Table `ImportTemporary`
--

/*!40000 ALTER TABLE `ImportTemporary` DISABLE KEYS */;
/*!40000 ALTER TABLE `ImportTemporary` ENABLE KEYS */;


--
-- Create Table `Invoice`
--

DROP TABLE IF EXISTS `Invoice`;
CREATE TABLE `Invoice` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `ip` varchar(15) default NULL,
  `date` datetime default NULL,
  `status` char(1) default NULL,
  `amount` decimal(10,2) default NULL,
  `currency` char(3) NOT NULL,
  `expire_date` date default NULL,
  `payment_date` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `account_id` (`account_id`),
  KEY `date` (`date`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Invoice`
--

/*!40000 ALTER TABLE `Invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `Invoice` ENABLE KEYS */;


--
-- Create Table `Invoice_Article`
--

DROP TABLE IF EXISTS `Invoice_Article`;
CREATE TABLE `Invoice_Article` (
  `invoice_id` int(11) NOT NULL default '0',
  `article_id` int(11) NOT NULL default '0',
  `article_title` varchar(255) NOT NULL default '',
  `discount_id` varchar(10) NOT NULL,
  `level` tinyint(4) default NULL,
  `renewal_date` date default NULL,
  `amount` decimal(10,2) default NULL,
  KEY `invoice_id` (`invoice_id`),
  KEY `article_id` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Invoice_Article`
--

/*!40000 ALTER TABLE `Invoice_Article` DISABLE KEYS */;
/*!40000 ALTER TABLE `Invoice_Article` ENABLE KEYS */;


--
-- Create Table `Invoice_Banner`
--

DROP TABLE IF EXISTS `Invoice_Banner`;
CREATE TABLE `Invoice_Banner` (
  `invoice_id` int(11) NOT NULL default '0',
  `banner_id` int(11) NOT NULL default '0',
  `banner_caption` varchar(255) NOT NULL default '',
  `discount_id` varchar(10) NOT NULL,
  `level` tinyint(4) default NULL,
  `renewal_date` date default NULL,
  `impressions` mediumint(9) NOT NULL default '0',
  `amount` decimal(10,2) default NULL,
  KEY `invoice_id` (`invoice_id`),
  KEY `banner_id` (`banner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Invoice_Banner`
--

/*!40000 ALTER TABLE `Invoice_Banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `Invoice_Banner` ENABLE KEYS */;


--
-- Create Table `Invoice_Classified`
--

DROP TABLE IF EXISTS `Invoice_Classified`;
CREATE TABLE `Invoice_Classified` (
  `invoice_id` int(11) NOT NULL default '0',
  `classified_id` int(11) NOT NULL default '0',
  `classified_title` varchar(255) NOT NULL default '',
  `discount_id` varchar(10) NOT NULL,
  `level` tinyint(4) default NULL,
  `renewal_date` date default NULL,
  `amount` decimal(10,2) default NULL,
  KEY `invoice_id` (`invoice_id`),
  KEY `classified_id` (`classified_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Invoice_Classified`
--

/*!40000 ALTER TABLE `Invoice_Classified` DISABLE KEYS */;
/*!40000 ALTER TABLE `Invoice_Classified` ENABLE KEYS */;


--
-- Create Table `Invoice_CustomInvoice`
--

DROP TABLE IF EXISTS `Invoice_CustomInvoice`;
CREATE TABLE `Invoice_CustomInvoice` (
  `invoice_id` int(11) NOT NULL default '0',
  `custom_invoice_id` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `items` text NOT NULL,
  `items_price` text NOT NULL,
  `amount` decimal(10,2) NOT NULL default '0.00',
  KEY `invoice_id` (`invoice_id`),
  KEY `custom_invoice_id` (`custom_invoice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Invoice_CustomInvoice`
--

/*!40000 ALTER TABLE `Invoice_CustomInvoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `Invoice_CustomInvoice` ENABLE KEYS */;


--
-- Create Table `Invoice_Event`
--

DROP TABLE IF EXISTS `Invoice_Event`;
CREATE TABLE `Invoice_Event` (
  `invoice_id` int(11) NOT NULL default '0',
  `event_id` int(11) NOT NULL default '0',
  `event_title` varchar(255) NOT NULL default '',
  `discount_id` varchar(10) NOT NULL,
  `level` tinyint(4) default NULL,
  `renewal_date` date default NULL,
  `amount` decimal(10,2) default NULL,
  KEY `invoice_id` (`invoice_id`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Invoice_Event`
--

/*!40000 ALTER TABLE `Invoice_Event` DISABLE KEYS */;
/*!40000 ALTER TABLE `Invoice_Event` ENABLE KEYS */;


--
-- Create Table `Invoice_Listing`
--

DROP TABLE IF EXISTS `Invoice_Listing`;
CREATE TABLE `Invoice_Listing` (
  `invoice_id` int(11) NOT NULL default '0',
  `listing_id` int(11) NOT NULL default '0',
  `listing_title` varchar(255) NOT NULL default '',
  `discount_id` varchar(10) default NULL,
  `level` tinyint(4) default NULL,
  `renewal_date` date default NULL,
  `categories` tinyint(4) NOT NULL,
  `extra_categories` tinyint(4) NOT NULL default '0',
  `listingtemplate_title` varchar(255) NOT NULL,
  `amount` decimal(10,2) default NULL,
  KEY `invoice_id` (`invoice_id`),
  KEY `listing_id` (`listing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Invoice_Listing`
--

/*!40000 ALTER TABLE `Invoice_Listing` DISABLE KEYS */;
/*!40000 ALTER TABLE `Invoice_Listing` ENABLE KEYS */;


--
-- Create Table `ItemStatistic`
--

DROP TABLE IF EXISTS `ItemStatistic`;
CREATE TABLE `ItemStatistic` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `ItemStatistic`
--

/*!40000 ALTER TABLE `ItemStatistic` DISABLE KEYS */;
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('l_pending','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('l_expiring','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('l_expired','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('l_active','about 52160');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('l_suspended','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('l_added30','about 52160');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('e_pending','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('e_expiring','about 10');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('e_expired','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('e_active','about 10');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('e_suspended','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('e_added30','about 10');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('b_pending','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('b_expired','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('b_active','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('b_suspended','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('b_added30','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('c_pending','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('c_expiring','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('c_expired','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('c_active','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('c_suspended','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('c_added30','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('a_pending','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('a_expiring','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('a_expired','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('a_active','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('a_suspended','0');
INSERT INTO `ItemStatistic` (`name`,`value`) VALUES ('a_added30','0');
/*!40000 ALTER TABLE `ItemStatistic` ENABLE KEYS */;


--
-- Create Table `Lang`
--

DROP TABLE IF EXISTS `Lang`;
CREATE TABLE `Lang` (
  `id` char(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lang_enabled` char(1) NOT NULL default 'n',
  `lang_default` char(1) NOT NULL default 'n',
  `lang_order` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `enabled` (`lang_enabled`),
  KEY `default` (`lang_default`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Lang`
--

/*!40000 ALTER TABLE `Lang` DISABLE KEYS */;
INSERT INTO `Lang` (`id`,`name`,`lang_enabled`,`lang_default`,`lang_order`) VALUES ('en_us','English','y','y','0');
INSERT INTO `Lang` (`id`,`name`,`lang_enabled`,`lang_default`,`lang_order`) VALUES ('pt_br','Português','n','n','1');
INSERT INTO `Lang` (`id`,`name`,`lang_enabled`,`lang_default`,`lang_order`) VALUES ('es_es','Español','n','n','2');
INSERT INTO `Lang` (`id`,`name`,`lang_enabled`,`lang_default`,`lang_order`) VALUES ('fr_fr','Français','n','n','3');
/*!40000 ALTER TABLE `Lang` ENABLE KEYS */;


--
-- Create Table `Listing`
--

DROP TABLE IF EXISTS `Listing`;
CREATE TABLE `Listing` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL default '0',
  `image_id` int(11) NOT NULL default '0',
  `thumb_id` int(11) NOT NULL default '0',
  `promotion_id` int(11) NOT NULL default '0',
  `estado_id` int(11) default NULL,
  `cidade_id` int(11) default NULL,
  `bairro_id` int(11) default NULL,
  `city_id` int(11) default NULL,
  `area_id` int(11) default NULL,
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `entered` datetime NOT NULL default '0000-00-00 00:00:00',
  `renewal_date` date NOT NULL default '0000-00-00',
  `discount_id` varchar(10) default NULL,
  `title` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `friendly_url` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL default '',
  `show_email` enum('y','n') NOT NULL default 'y',
  `url` varchar(255) NOT NULL default '',
  `display_url` varchar(255) NOT NULL default '',
  `address` varchar(50) NOT NULL default '',
  `address2` varchar(50) NOT NULL default '',
  `zip_code` varchar(10) NOT NULL default '',
  `zip5` varchar(10) NOT NULL default '0',
  `latitude` double(10,6) NOT NULL default '0.000000',
  `longitude` double(10,6) NOT NULL default '0.000000',
  `maptuning` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL default '',
  `fax` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `description1` varchar(255) NOT NULL,
  `description2` varchar(255) NOT NULL,
  `description3` varchar(255) NOT NULL,
  `description4` varchar(255) NOT NULL,
  `seo_description` varchar(255) NOT NULL,
  `seo_description1` varchar(255) NOT NULL,
  `seo_description2` varchar(255) NOT NULL,
  `seo_description3` varchar(255) NOT NULL,
  `seo_description4` varchar(255) NOT NULL,
  `long_description` text NOT NULL,
  `long_description1` text NOT NULL,
  `long_description2` text NOT NULL,
  `long_description3` text NOT NULL,
  `long_description4` text NOT NULL,
  `keywords` text NOT NULL,
  `keywords1` text NOT NULL,
  `keywords2` text NOT NULL,
  `keywords3` text NOT NULL,
  `keywords4` text NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `seo_keywords1` varchar(255) NOT NULL,
  `seo_keywords2` varchar(255) NOT NULL,
  `seo_keywords3` varchar(255) NOT NULL,
  `seo_keywords4` varchar(255) NOT NULL,
  `attachment_file` varchar(255) NOT NULL default '',
  `attachment_caption` varchar(255) NOT NULL default '',
  `status` char(1) NOT NULL default '',
  `level` tinyint(3) NOT NULL default '0',
  `random_number` bigint(15) NOT NULL default '0',
  `reminder` tinyint(4) NOT NULL default '0',
  `fulltextsearch_keyword` text NOT NULL,
  `fulltextsearch_where` text NOT NULL,
  `video_snippet` text NOT NULL,
  `importID` int(11) NOT NULL default '0',
  `hours_work` text NOT NULL,
  `locations` text NOT NULL,
  `claim_disable` char(1) NOT NULL default 'n',
  `cat_1_id` int(11) NOT NULL default '0',
  `parcat_1_level1_id` int(11) NOT NULL default '0',
  `parcat_1_level2_id` int(11) NOT NULL default '0',
  `parcat_1_level3_id` int(11) NOT NULL default '0',
  `parcat_1_level4_id` int(11) NOT NULL default '0',
  `cat_2_id` int(11) NOT NULL default '0',
  `parcat_2_level1_id` int(11) NOT NULL default '0',
  `parcat_2_level2_id` int(11) NOT NULL default '0',
  `parcat_2_level3_id` int(11) NOT NULL default '0',
  `parcat_2_level4_id` int(11) NOT NULL default '0',
  `cat_3_id` int(11) NOT NULL default '0',
  `parcat_3_level1_id` int(11) NOT NULL default '0',
  `parcat_3_level2_id` int(11) NOT NULL default '0',
  `parcat_3_level3_id` int(11) NOT NULL default '0',
  `parcat_3_level4_id` int(11) NOT NULL default '0',
  `cat_4_id` int(11) NOT NULL default '0',
  `parcat_4_level1_id` int(11) NOT NULL default '0',
  `parcat_4_level2_id` int(11) NOT NULL default '0',
  `parcat_4_level3_id` int(11) NOT NULL default '0',
  `parcat_4_level4_id` int(11) NOT NULL default '0',
  `cat_5_id` int(11) NOT NULL default '0',
  `parcat_5_level1_id` int(11) NOT NULL default '0',
  `parcat_5_level2_id` int(11) NOT NULL default '0',
  `parcat_5_level3_id` int(11) NOT NULL default '0',
  `parcat_5_level4_id` int(11) NOT NULL default '0',
  `listingtemplate_id` int(11) NOT NULL default '0',
  `custom_checkbox0` char(1) NOT NULL,
  `custom_checkbox1` char(1) NOT NULL,
  `custom_checkbox2` char(1) NOT NULL,
  `custom_checkbox3` char(1) NOT NULL,
  `custom_checkbox4` char(1) NOT NULL,
  `custom_checkbox5` char(1) NOT NULL,
  `custom_checkbox6` char(1) NOT NULL,
  `custom_checkbox7` char(1) NOT NULL,
  `custom_checkbox8` char(1) NOT NULL,
  `custom_checkbox9` char(1) NOT NULL,
  `custom_dropdown0` varchar(255) NOT NULL,
  `custom_dropdown1` varchar(255) NOT NULL,
  `custom_dropdown2` varchar(255) NOT NULL,
  `custom_dropdown3` varchar(255) NOT NULL,
  `custom_dropdown4` varchar(255) NOT NULL,
  `custom_dropdown5` varchar(255) NOT NULL,
  `custom_dropdown6` varchar(255) NOT NULL,
  `custom_dropdown7` varchar(255) NOT NULL,
  `custom_dropdown8` varchar(255) NOT NULL,
  `custom_dropdown9` varchar(255) NOT NULL,
  `custom_text0` varchar(255) NOT NULL,
  `custom_text1` varchar(255) NOT NULL,
  `custom_text2` varchar(255) NOT NULL,
  `custom_text3` varchar(255) NOT NULL,
  `custom_text4` varchar(255) NOT NULL,
  `custom_text5` varchar(255) NOT NULL,
  `custom_text6` varchar(255) NOT NULL,
  `custom_text7` varchar(255) NOT NULL,
  `custom_text8` varchar(255) NOT NULL,
  `custom_text9` varchar(255) NOT NULL,
  `custom_short_desc0` varchar(255) NOT NULL,
  `custom_short_desc1` varchar(255) NOT NULL,
  `custom_short_desc2` varchar(255) NOT NULL,
  `custom_short_desc3` varchar(255) NOT NULL,
  `custom_short_desc4` varchar(255) NOT NULL,
  `custom_short_desc5` varchar(255) NOT NULL,
  `custom_short_desc6` varchar(255) NOT NULL,
  `custom_short_desc7` varchar(255) NOT NULL,
  `custom_short_desc8` varchar(255) NOT NULL,
  `custom_short_desc9` varchar(255) NOT NULL,
  `custom_long_desc0` text NOT NULL,
  `custom_long_desc1` text NOT NULL,
  `custom_long_desc2` text NOT NULL,
  `custom_long_desc3` text NOT NULL,
  `custom_long_desc4` text NOT NULL,
  `custom_long_desc5` text NOT NULL,
  `custom_long_desc6` text NOT NULL,
  `custom_long_desc7` text NOT NULL,
  `custom_long_desc8` text NOT NULL,
  `custom_long_desc9` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `title` (`title`),
  KEY `random_number` (`random_number`),
  KEY `estado_id` (`estado_id`),
  KEY `cidade_id` (`cidade_id`),
  KEY `bairro_id` (`bairro_id`),
  KEY `account_id` (`account_id`),
  KEY `renewal_date` (`renewal_date`),
  KEY `status` (`status`),
  KEY `promotion_id` (`promotion_id`),
  KEY `latitude` (`latitude`),
  KEY `longitude` (`longitude`),
  KEY `level` (`level`),
  KEY `city_id` (`city_id`),
  KEY `area_id` (`area_id`),
  KEY `zip_code` (`zip_code`),
  KEY `friendly_url` (`friendly_url`),
  KEY `cat_1_id` (`cat_1_id`),
  KEY `parcat_1_level1_id` (`parcat_1_level1_id`),
  KEY `parcat_1_level2_id` (`parcat_1_level2_id`),
  KEY `parcat_1_level3_id` (`parcat_1_level3_id`),
  KEY `parcat_1_level4_id` (`parcat_1_level4_id`),
  KEY `cat_2_id` (`cat_2_id`),
  KEY `parcat_2_level1_id` (`parcat_2_level1_id`),
  KEY `parcat_2_level2_id` (`parcat_2_level2_id`),
  KEY `parcat_2_level3_id` (`parcat_2_level3_id`),
  KEY `parcat_2_level4_id` (`parcat_2_level4_id`),
  KEY `cat_3_id` (`cat_3_id`),
  KEY `parcat_3_level1_id` (`parcat_3_level1_id`),
  KEY `parcat_3_level2_id` (`parcat_3_level2_id`),
  KEY `parcat_3_level3_id` (`parcat_3_level3_id`),
  KEY `parcat_3_level4_id` (`parcat_3_level4_id`),
  KEY `cat_4_id` (`cat_4_id`),
  KEY `parcat_4_level1_id` (`parcat_4_level1_id`),
  KEY `parcat_4_level2_id` (`parcat_4_level2_id`),
  KEY `parcat_4_level3_id` (`parcat_4_level3_id`),
  KEY `parcat_4_level4_id` (`parcat_4_level4_id`),
  KEY `cat_5_id` (`cat_5_id`),
  KEY `parcat_5_level1_id` (`parcat_5_level1_id`),
  KEY `parcat_5_level2_id` (`parcat_5_level2_id`),
  KEY `parcat_5_level3_id` (`parcat_5_level3_id`),
  KEY `parcat_5_level4_id` (`parcat_5_level4_id`),
  FULLTEXT KEY `fulltextsearch_keyword` (`fulltextsearch_keyword`),
  FULLTEXT KEY `fulltextsearch_where` (`fulltextsearch_where`)
) ENGINE=MyISAM AUTO_INCREMENT=52152 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `ListingCategory`;
CREATE TABLE `ListingCategory` (
  `id` int(11) NOT NULL auto_increment,
  `lang` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `title1` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `title3` varchar(255) NOT NULL,
  `title4` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL default '0',
  `seo_description` varchar(255) NOT NULL,
  `seo_description1` varchar(255) NOT NULL,
  `seo_description2` varchar(255) NOT NULL,
  `seo_description3` varchar(255) NOT NULL,
  `seo_description4` varchar(255) NOT NULL,
  `friendly_url` varchar(255) NOT NULL default '',
  `friendly_url1` varchar(255) NOT NULL,
  `friendly_url2` varchar(255) NOT NULL,
  `friendly_url3` varchar(255) NOT NULL,
  `friendly_url4` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `keywords1` text NOT NULL,
  `keywords2` text NOT NULL,
  `keywords3` text NOT NULL,
  `keywords4` text NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `seo_keywords1` varchar(255) NOT NULL,
  `seo_keywords2` varchar(255) NOT NULL,
  `seo_keywords3` varchar(255) NOT NULL,
  `seo_keywords4` varchar(255) NOT NULL,
  `active_listing` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `category_id` (`category_id`),
  KEY `title` (`title`),
  KEY `active_listing` (`active_listing`),
  KEY `title1` (`title1`),
  KEY `title2` (`title2`),
  KEY `title3` (`title3`),
  KEY `title4` (`title4`),
  KEY `friendly_url1` (`friendly_url1`),
  KEY `friendly_url2` (`friendly_url2`),
  KEY `friendly_url3` (`friendly_url3`),
  KEY `friendly_url4` (`friendly_url4`),
  KEY `lang` (`lang`),
  FULLTEXT KEY `keywords` (`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`title`,`title1`,`title2`,`title3`,`title4`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Data for Table `ListingCategory`
--

/*!40000 ALTER TABLE `ListingCategory` DISABLE KEYS */;
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('1','en_us','category-listing','','','','','0','','','','','','category-listing','','','','','category-listing','','','','','','','','','','0');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('2','en_us','Accomodation and Housing','','','','','0','','','','','','accomodation-and-housing','','','','','','','','','','','','','','','52151');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('3','en_us','Hotels','','','','','2','','','','','','hotels','','','','','','','','','','','','','','','17361');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('4','en_us','Estate Agents','','','','','2','','','','','','estate-agents','','','','','','','','','','','','','','','21075');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('5','en_us','Student Accomodation','','','','','2','','','','','','student-accomodation','','','','','','','','','','','','','','','25093');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('6','en_us','Estate Agents','','','','','5','','','','','','estate-agents','','','','','','','','','','','','','','','21075');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('7','en_us','Student Accomodation','','','','','0','','','','','','student-accomodation','','','','','','','','','','','','','','','25093');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('8','en_us','Estate Agents','','','','','7','','','','','','estate-agents','','','','','','','','','','','','','','','21075');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('9','en_us','Hostels','','','','','2','','','','','','hostels','','','','','','','','','','','','','','','1024');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('10','en_us','Hostels','','','','','5','','','','','','hostels','','','','','','','','','','','','','','','1024');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('11','en_us','Hostels','','','','','7','','','','','','hostels','','','','','','','','','','','','','','','1024');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('12','en_us','Guest Houses','','','','','2','','','','','','guest-houses','','','','','','','','','','','','','','','9417');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('13','en_us','Hotel Booking Agencies','','','','','2','','','','','','hotel-booking-agencies','','','','','','','','','','','','','','','280');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('14','en_us','Letting Agents','','','','','2','','','','','','letting-agents','','','','','','','','','','','','','','','2994');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('15','en_us','Letting Agents','','','','','5','','','','','','letting-agents','','','','','','','','','','','','','','','2994');
INSERT INTO `ListingCategory` (`id`,`lang`,`title`,`title1`,`title2`,`title3`,`title4`,`category_id`,`seo_description`,`seo_description1`,`seo_description2`,`seo_description3`,`seo_description4`,`friendly_url`,`friendly_url1`,`friendly_url2`,`friendly_url3`,`friendly_url4`,`keywords`,`keywords1`,`keywords2`,`keywords3`,`keywords4`,`seo_keywords`,`seo_keywords1`,`seo_keywords2`,`seo_keywords3`,`seo_keywords4`,`active_listing`) VALUES ('16','en_us','Letting Agents','','','','','7','','','','','','letting-agents','','','','','','','','','','','','','','','2994');
/*!40000 ALTER TABLE `ListingCategory` ENABLE KEYS */;


--
-- Create Table `ListingLevel`
--

DROP TABLE IF EXISTS `ListingLevel`;
CREATE TABLE `ListingLevel` (
  `value` int(3) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `defaultlevel` char(1) NOT NULL default 'n',
  `detail` char(1) NOT NULL default 'n',
  `images` int(3) NOT NULL default '0',
  `has_promotion` char(1) NOT NULL default 'n',
  `price` decimal(10,2) NOT NULL default '0.00',
  `free_category` int(3) NOT NULL default '0',
  `category_price` decimal(10,2) NOT NULL default '0.00',
  `content` text NOT NULL,
  `active` char(1) NOT NULL default 'y',
  PRIMARY KEY  (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `ListingLevel`
--

/*!40000 ALTER TABLE `ListingLevel` DISABLE KEYS */;
INSERT INTO `ListingLevel` (`value`,`name`,`defaultlevel`,`detail`,`images`,`has_promotion`,`price`,`free_category`,`category_price`,`content`,`active`) VALUES ('10','free','n','n','0','n','0.00','1','5.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseScreenDesc\">\r\n<ul>\r\n<li>Title, Address, Phone, Send to a Friend, Add to Favorites, Ratings and Reviews. </li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Summary View</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_free_summary_enus.gif\"><span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>','y');
INSERT INTO `ListingLevel` (`value`,`name`,`defaultlevel`,`detail`,`images`,`has_promotion`,`price`,`free_category`,`category_price`,`content`,`active`) VALUES ('30','basic','n','n','0','n','99.00','1','10.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>Basic level listings appear in search results above Free listings. </li>\r\n<li>Title, Address, Phone, Web Link, E-mail Link, Send to a Friend, Add to Favorites, Ratings and Reviews. </li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Summary View</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_basic_summary_enus.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>','y');
INSERT INTO `ListingLevel` (`value`,`name`,`defaultlevel`,`detail`,`images`,`has_promotion`,`price`,`free_category`,`category_price`,`content`,`active`) VALUES ('50','premium','n','n','0','n','199.00','2','15.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>Premium level listings appear in search results above Basic and Free listings. </li>\r\n<li>Title, Address, Phone, Fax, Web Link, E-Mail Link, Summary Description, Send to a Friend, Add to Favorites, Designation Icon, Ratings and Reviews. </li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Summary View</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_premium_summary_enus.gif\"> <span class=\"advertiseAlert\">* This image is <strong>illustrative</strong></span> </td></tr></tbody></table>','y');
INSERT INTO `ListingLevel` (`value`,`name`,`defaultlevel`,`detail`,`images`,`has_promotion`,`price`,`free_category`,`category_price`,`content`,`active`) VALUES ('70','showcase','y','y','9','y','299.00','3','20.00','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME] </th>\r\n<td class=\"prize\">[LEVELPRICE] </td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent\" colspan=\"2\">\r\n<ul>\r\n<li>Showcase level listings appear in search results above Premium, Basic and Free listings </li>\r\n<li>Contains Detail View and Summary View </li>\r\n<li>Title, Logo Image, Address, Phone, Fax, Web Link, E-Mail Link, Summary Description, Detail Description, Send to a Friend, Add to Favorites, Print, Map, Designation Icon, Coupon, Ratings and Reviews, Photo Gallery, Contact Form, Video Snippet. </li></ul></td></tr>\r\n<tr>\r\n<td valign=\"top\" colspan=\"2\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Summary View </th>\r\n<th class=\"detailColumn\">Detail View </th></tr></tbody></table></td></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_listing_showcase_summary_enus.gif\"> [LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_listing_showcase_detail_enus.gif\"><span class=\"advertiseAlert\">* These images are <strong>illustrative</strong></span> </td></tr></tbody></table>','y');
/*!40000 ALTER TABLE `ListingLevel` ENABLE KEYS */;


--
-- Create Table `ListingLevel_Lang`
--

DROP TABLE IF EXISTS `ListingLevel_Lang`;
CREATE TABLE `ListingLevel_Lang` (
  `value` int(3) NOT NULL,
  `lang` char(5) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`value`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `ListingLevel_Lang`
--

/*!40000 ALTER TABLE `ListingLevel_Lang` DISABLE KEYS */;
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('70','pt_br','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME] </th>\r\n<td class=\"prize\">[LEVELPRICE] </td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent\" colspan=\"2\">\r\n<ul>\r\n<li>As empresas de nível Showcase aparecem acima das empresas de nível Premium, Basic e Free nos resultados das buscas </li>\r\n<li>Contém visualização resumida e visualização detalhada </li>\r\n<li>Título, Logo, Endereço, Fone, Fax, Site, E-mail, Descrição resumida, Descrição detalhada, Indique para um amigo, Adicionar aos Favoritos, Imprimir, Mapa, Ícones de classificação, Promoção, Avaliação, Galeria de fotos, Formulário para contato, Vídeo.</li></ul></td></tr>\r\n<tr>\r\n<td valign=\"top\" colspan=\"2\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Visualização resumida</th>\r\n<th class=\"detailColumn\">Visualização detalhada</th></tr></tbody></table></td></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_listing_showcase_summary_ptbr.gif\"> [LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_listing_showcase_detail_ptbr.gif\"><span class=\"advertiseAlert\">* Imagens ilustrativas</span></td></tr></tbody></table>');
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('70','es_es','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME] </th>\r\n<td class=\"prize\">[LEVELPRICE] </td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent\" colspan=\"2\">\r\n<ul>\r\n<li>Cuando se hace una busqueda, las listas de nivel Showcase aparecen sobre las listas Premium, Basic y Free </li>\r\n<li>Contiene Descripcion Resumida y Descripcion Completa </li>\r\n<li>Título, Imagen del logotipo, Dirección, Teléfono, Fax, Enlace para Sitio de Internet, Enlace para Correo Electrónico, Resumen Descripción, Descripción detallada, Enviar a un amigo, Agregar a lista rápida, Imprimir, Mapa, Iconos de Designación, Promociones, Calificaciones, Galería de Fotos, Formulario de contacto, Video.</li></ul></td></tr>\r\n<tr>\r\n<td valign=\"top\" colspan=\"2\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Resumen</th>\r\n<th class=\"detailColumn\">Detalle</th></tr></tbody></table></td></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_listing_showcase_summary_eses.gif\"> [LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_listing_showcase_detail_eses.gif\"><span class=\"advertiseAlert\">* Estas imágenes son ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('70','fr_fr','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME] </th>\r\n<td class=\"prize\">[LEVELPRICE] </td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent\" colspan=\"2\">\r\n<ul>\r\n<li>Les listes de niveau Showcase apparaissent au-dessus de Premium, Basic et Free dans les résultats de recherche </li>\r\n<li>Contient vue résumée et détaillée </li>\r\n<li>Titre, Logo, Adresse, Téléphone, Fax, Web Link, E-Mail Link, Description sommaire, Description détaillée, E-mail un ami, Ajouter à la liste rapide, Imprimer, Carte, Désignation d\'icône, Promotions, Revisiones, Galerie photo, Formulaire de contact, Vidéo</li></ul></td></tr>\r\n<tr>\r\n<td valign=\"top\" colspan=\"2\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Vue résumée</th>\r\n<th class=\"detailColumn\">Vue détaillée</th></tr></tbody></table></td></tr>\r\n<tr>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_listing_showcase_summary_frfr.gif\"> [LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\"><img alt=\"\" src=\"/images/content/img_ad_listing_showcase_detail_frfr.gif\"><span class=\"advertiseAlert\">* Ces images sont des exemples</span> </td></tr></tbody></table>');
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','pt_br','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>As empresas de nível Premium aparecem acima das empresas Basic e Free nos resultados das buscas. </li>\r\n<li>Título, Endereço, Fone, Fax, Site, E-mail, Descrição resumida, Indique para um amigo, Adicionar aos Favoritos, Ícones de classificação, Avaliação. </li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Visualização resumida</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_premium_summary_ptbr.gif\"> <span class=\"advertiseAlert\">* Imagens ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','es_es','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>Cuando se hace una busqueda, las listas de nivel Premium aparecen sobre las listas Basic y Free. </li>\r\n<li>Título, Dirección, Teléfono, Fax, Enlace para Sitio de Internet, Enlace para Correo Electrónico, Resumen Descripción, Enviar a un amigo, Agregar a lista rápida, Iconos de Designación, Calificaciones. </li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Resumen</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_premium_summary_eses.gif\"> <span class=\"advertiseAlert\">* Estas imágenes son ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('50','fr_fr','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>Les listes de niveau Premium apparaissent au-dessus de Basic et Free dans les résultats de recherche. </li>\r\n<li>Titre, Adresse, Téléphone, Fax, Web Link, E-Mail Link, Description sommaire, E-mail un ami, Ajouter à la liste rapide, Désignation d\'icône, Revisiones. </li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Vue résumée</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_premium_summary_frfr.gif\"> <span class=\"advertiseAlert\">* Ces images sont des exemples</span> </td></tr></tbody></table>');
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('30','pt_br','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>As empresas de nível Basic aparecem acima das empresas Free nos resultados das buscas. </li>\r\n<li>Título, Endereço, Fone, Fax, Site, E-mail, Indique para um amigo, Adicionar aos Favoritos, Avaliação.</li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Visualização resumida</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_basic_summary_ptbr.gif\"> <span class=\"advertiseAlert\">* Imagens ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('30','es_es','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>Cuando se hace una busqueda, las listas de nivel Basic aparecen sobre las listas Free. </li>\r\n<li>Título, Dirección, Teléfono, Fax, Enlace para Sitio de Internet, Enlace para Correo Electrónico, Enviar a un amigo, Agregar a lista rápida, Calificaciones.</li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Resumen</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_basic_summary_eses.gif\"> <span class=\"advertiseAlert\">* Estas imágenes son ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('30','fr_fr','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseTableContent2\">\r\n<ul>\r\n<li>Les listes de niveau Basic apparaissent au-dessus de Free dans les résultats de recherche. </li>\r\n<li>Titre, Adresse, Téléphone, Fax, Web Link, E-Mail Link, E-mail un ami, Ajouter à la liste rapide, Revisiones.</li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table class=\"advertiseScreenDesc\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Vue résumée</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_basic_summary_frfr.gif\"> <span class=\"advertiseAlert\">* Ces images sont des exemples</span> </td></tr></tbody></table>');
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('10','pt_br','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseScreenDesc\">\r\n<ul>\r\n<li>Título, Endereço, Fone, Indique para um amigo, Adicionar aos Favoritos, Avaliação.</li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Visualização resumida</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_free_summary_ptbr.gif\"><span class=\"advertiseAlert\">* Imagens ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('10','es_es','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseScreenDesc\">\r\n<ul>\r\n<li>Título, Dirección, Teléfono, Enviar a un amigo, Agregar a lista rápida, Calificaciones.</li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Resumen</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_free_summary_eses.gif\"><span class=\"advertiseAlert\">* Estas imágenes son ilustrativas</span> </td></tr></tbody></table>');
INSERT INTO `ListingLevel_Lang` (`value`,`lang`,`content`) VALUES ('10','fr_fr','<table class=\"advertiseTable\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<th class=\"type\">[LEVELNAME]</th>\r\n<td class=\"prize\">[LEVELPRICE]</td></tr>\r\n<tr>\r\n<td class=\"advertiseScreenDesc\">\r\n<ul>\r\n<li>Titre, Adresse, Téléphone, E-mail un ami, Ajouter à la liste rapide, Revisiones.</li></ul>[LEVELBUTTON] </td>\r\n<td class=\"advertiseScreen\">\r\n<table cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<th>Vue résumée</th></tr></tbody></table><img alt=\"\" src=\"/images/content/img_ad_listing_free_summary_frfr.gif\"><span class=\"advertiseAlert\">* Ces images sont des exemples</span> </td></tr></tbody></table>');
/*!40000 ALTER TABLE `ListingLevel_Lang` ENABLE KEYS */;


--
-- Create Table `ListingTemplate`
--

DROP TABLE IF EXISTS `ListingTemplate`;
CREATE TABLE `ListingTemplate` (
  `id` int(11) NOT NULL auto_increment,
  `layout_id` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL,
  `friendly_url` varchar(255) NOT NULL,
  `updated` datetime NOT NULL,
  `entered` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL default '0.00',
  `color_background` char(6) NOT NULL,
  `color_border` char(6) NOT NULL,
  `color_label` char(6) NOT NULL,
  `color_text` char(6) NOT NULL,
  `color_titlebackground` char(6) NOT NULL,
  `color_titleborder` char(6) NOT NULL,
  `color_titletext` char(6) NOT NULL,
  `cat_id` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Data for Table `ListingTemplate`
--

/*!40000 ALTER TABLE `ListingTemplate` DISABLE KEYS */;
INSERT INTO `ListingTemplate` (`id`,`layout_id`,`title`,`friendly_url`,`updated`,`entered`,`status`,`price`,`color_background`,`color_border`,`color_label`,`color_text`,`color_titlebackground`,`color_titleborder`,`color_titletext`,`cat_id`) VALUES ('1','1','Restaurant','restaurant','2009-04-16 08:30:45','2007-11-12 16:12:18','enabled','0.00','FFFBDE','FFFBDE','915316','915316','','','C78927','4');
INSERT INTO `ListingTemplate` (`id`,`layout_id`,`title`,`friendly_url`,`updated`,`entered`,`status`,`price`,`color_background`,`color_border`,`color_label`,`color_text`,`color_titlebackground`,`color_titleborder`,`color_titletext`,`cat_id`) VALUES ('2','1','Golf Course','golf-course','2009-04-15 17:25:55','2007-11-12 16:40:55','enabled','0.00','F7F7F7','009900','416000','416000','F7F7F7','','669900','25,5');
INSERT INTO `ListingTemplate` (`id`,`layout_id`,`title`,`friendly_url`,`updated`,`entered`,`status`,`price`,`color_background`,`color_border`,`color_label`,`color_text`,`color_titlebackground`,`color_titleborder`,`color_titletext`,`cat_id`) VALUES ('3','1','Lawyer','lawyer','2009-04-15 16:58:19','2007-11-12 16:52:50','enabled','0.00','F7F7F7','F7F7F7','706E6E','757575','','','706E6E','122');
INSERT INTO `ListingTemplate` (`id`,`layout_id`,`title`,`friendly_url`,`updated`,`entered`,`status`,`price`,`color_background`,`color_border`,`color_label`,`color_text`,`color_titlebackground`,`color_titleborder`,`color_titletext`,`cat_id`) VALUES ('4','1','Real Estate','real-estate','2009-04-15 18:01:57','2007-11-12 17:09:13','enabled','0.00','FAF9F5','E3DCC2','FF6600','80754D','','','CC3300','123');
INSERT INTO `ListingTemplate` (`id`,`layout_id`,`title`,`friendly_url`,`updated`,`entered`,`status`,`price`,`color_background`,`color_border`,`color_label`,`color_text`,`color_titlebackground`,`color_titleborder`,`color_titletext`,`cat_id`) VALUES ('5','1','Hotel','hotel','2009-04-15 16:58:06','2007-11-12 17:15:22','enabled','0.00','FCE3EA','','84233F','84233F','','','963752','5');
INSERT INTO `ListingTemplate` (`id`,`layout_id`,`title`,`friendly_url`,`updated`,`entered`,`status`,`price`,`color_background`,`color_border`,`color_label`,`color_text`,`color_titlebackground`,`color_titleborder`,`color_titletext`,`cat_id`) VALUES ('6','1','Doctor','doctor','2009-04-14 16:25:20','2007-11-13 08:27:36','enabled','0.00','DCF2DF','948D56','459654','4D5727','','','124706','121');
INSERT INTO `ListingTemplate` (`id`,`layout_id`,`title`,`friendly_url`,`updated`,`entered`,`status`,`price`,`color_background`,`color_border`,`color_label`,`color_text`,`color_titlebackground`,`color_titleborder`,`color_titletext`,`cat_id`) VALUES ('7','1','Dentist','dentist','2009-04-15 16:55:29','2007-11-13 08:50:54','enabled','0.00','FFFFFF','DBF8C8','71A250','37A277','','','56D800','121');
INSERT INTO `ListingTemplate` (`id`,`layout_id`,`title`,`friendly_url`,`updated`,`entered`,`status`,`price`,`color_background`,`color_border`,`color_label`,`color_text`,`color_titlebackground`,`color_titleborder`,`color_titletext`,`cat_id`) VALUES ('8','1','Auto Part Supplier','auto-part-supplier','2009-04-15 16:55:15','2007-11-14 10:30:03','enabled','0.00','E6E6E6','CCC','00BFFF','367779','','','00A2D8','120');
/*!40000 ALTER TABLE `ListingTemplate` ENABLE KEYS */;


--
-- Create Table `ListingTemplate_Field`
--

DROP TABLE IF EXISTS `ListingTemplate_Field`;
CREATE TABLE `ListingTemplate_Field` (
  `listingtemplate_id` int(11) NOT NULL,
  `field` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `fieldvalues` text NOT NULL,
  `instructions` varchar(255) NOT NULL,
  `required` char(1) NOT NULL,
  `search` char(1) NOT NULL,
  `searchbykeyword` char(1) NOT NULL,
  `searchbyrange` char(1) NOT NULL,
  `show_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`listingtemplate_id`,`field`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `ListingTemplate_Field`
--

/*!40000 ALTER TABLE `ListingTemplate_Field` DISABLE KEYS */;
/*!40000 ALTER TABLE `ListingTemplate_Field` ENABLE KEYS */;


--
-- Create Table `Listing_Choice`
--

DROP TABLE IF EXISTS `Listing_Choice`;
CREATE TABLE `Listing_Choice` (
  `id` int(11) NOT NULL auto_increment,
  `editor_choice_id` int(11) NOT NULL default '0',
  `listing_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `EditorChoice_has_Listing_FKIndex1` (`editor_choice_id`),
  KEY `EditorChoice_has_Listing_FKIndex2` (`listing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Listing_Choice`
--

/*!40000 ALTER TABLE `Listing_Choice` DISABLE KEYS */;
/*!40000 ALTER TABLE `Listing_Choice` ENABLE KEYS */;


--
-- Create Table `Location_Area`
--

DROP TABLE IF EXISTS `Location_Area`;
CREATE TABLE `Location_Area` (
  `id` int(11) NOT NULL auto_increment,
  `city_id` int(11) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `abbreviation` varchar(100) NOT NULL,
  `friendly_url` varchar(255) NOT NULL default '',
  `seo_description` varchar(255) NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `city_id` (`city_id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Location_Area`
--

/*!40000 ALTER TABLE `Location_Area` DISABLE KEYS */;
/*!40000 ALTER TABLE `Location_Area` ENABLE KEYS */;


--
-- Create Table `Location_City`
--

DROP TABLE IF EXISTS `Location_City`;
CREATE TABLE `Location_City` (
  `id` int(11) NOT NULL auto_increment,
  `bairro_id` int(11) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `abbreviation` varchar(100) NOT NULL,
  `friendly_url` varchar(255) NOT NULL default '',
  `seo_description` varchar(255) NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `bairro_id` (`bairro_id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Location_City`
--

/*!40000 ALTER TABLE `Location_City` DISABLE KEYS */;
/*!40000 ALTER TABLE `Location_City` ENABLE KEYS */;


--
-- Create Table `Location_Country`
--

DROP TABLE IF EXISTS `Location_Country`;
CREATE TABLE `Location_Country` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `abbreviation` varchar(100) NOT NULL,
  `friendly_url` varchar(255) NOT NULL default '',
  `seo_description` varchar(255) NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=236 DEFAULT CHARSET=latin1;

--
-- Data for Table `Location_Country`
--

/*!40000 ALTER TABLE `Location_Country` DISABLE KEYS */;
INSERT INTO `Location_Country` (`id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('235','United Kingdom ','','united-kingdom','','');
/*!40000 ALTER TABLE `Location_Country` ENABLE KEYS */;


--
-- Create Table `Location_Region`
--

DROP TABLE IF EXISTS `Location_Region`;
CREATE TABLE `Location_Region` (
  `id` int(11) NOT NULL auto_increment,
  `cidade_id` int(11) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `abbreviation` varchar(100) NOT NULL,
  `friendly_url` varchar(255) NOT NULL default '',
  `seo_description` varchar(255) NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `cidade_id` (`cidade_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=482 DEFAULT CHARSET=latin1;

--
-- Data for Table `Location_Region`
--

/*!40000 ALTER TABLE `Location_Region` DISABLE KEYS */;
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('1','3413','Abingdon','','abingdon','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('2','3413','Accrington','','accrington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('3','3413','Aldershot','','aldershot','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('4','3413','Alfreton','','alfreton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('5','3413','Altrincham','','altrincham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('6','3413','Amersham','','amersham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('7','3413','Andover','','andover','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('8','3413','Arnold','','arnold','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('9','3413','Ashford','','ashford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('10','3413','Ashington','','ashington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('11','3413','Ashton-in-Makerfield','','ashton-in-makerfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('12','3413','Ashton-under-Lyne','','ashton-under-lyne','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('13','3413','Atherton','','atherton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('14','3413','Aylesbury','','aylesbury','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('15','3413','Aylesford-East Malling','','aylesford-east-malling','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('16','3413','Banbury','','banbury','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('17','3413','Banstead-Tadworth','','banstead-tadworth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('18','3413','Barnsley','','barnsley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('19','3413','Barnstaple','','barnstaple','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('20','3413','Barrow-in-Furness','','barrow-in-furness','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('21','3413','Basildon','','basildon','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('22','3413','Basingstoke','','basingstoke','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('23','3413','Bath','','bath','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('24','3413','Batley','','batley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('25','3413','Bebington','','bebington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('26','3413','Bedford','','bedford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('27','3413','Bedworth','','bedworth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('28','3413','Beeston and Stapleford','','beeston-and-stapleford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('29','3413','Benfleet','','benfleet','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('30','3413','Bentley','','bentley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('31','3413','Berwick-upon-Tweed','','berwick-upon-tweed','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('32','3413','Beverley','','beverley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('33','3413','Bexhil','','bexhil','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('34','3413','Bicester','','bicester','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('35','3413','Bideford','','bideford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('36','3413','Billericay','','billericay','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('37','3413','Billingham','','billingham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('38','3413','Birkenhead','','birkenhead','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('39','3413','Birmingham','','birmingham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('40','3413','Bishop Auckland','','bishop-auckland','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('41','3413','Blackburn','','blackburn','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('42','3413','Blackpool','','blackpool','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('43','3413','Bletchley','','bletchley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('44','3413','Blyth','','blyth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('45','3413','Bognor Regis','','bognor-regis','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('46','3413','Bolton','','bolton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('47','3413','Bootle','','bootle','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('48','3413','Borehamwood','','borehamwood','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('49','3413','Boston','','boston','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('50','3413','Bournemouth','','bournemouth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('51','3413','Bracknell','','bracknell','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('52','3413','Bradford','','bradford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('53','3413','Braintree','','braintree','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('54','3413','Bredbury and Romiley','','bredbury-and-romiley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('55','3413','Brentwood','','brentwood','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('56','3413','Bridgwater','','bridgwater','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('57','3413','Bridlington','','bridlington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('58','3413','Brighouse','','brighouse','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('59','3413','Brighton','','brighton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('60','3413','Bristol','','bristol','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('61','3413','Broadstairs','','broadstairs','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('62','3413','Bromley Cross-Bradshaw','','bromley-cross-bradshaw','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('63','3413','Bromsgrove-Catshill','','bromsgrove-catshill','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('64','3413','Burgess Hill','','burgess-hill','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('65','3413','Burnley','','burnley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('66','3413','Burntwood','','burntwood','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('67','3413','Burton-upon-Trent','','burton-upon-trent','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('68','3413','Bury','','bury','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('69','3413','Bury Saint Edmunds','','bury-saint-edmunds','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('70','3413','Camberley-Frimley','','camberley-frimley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('71','3413','Cambourne-Redruth','','cambourne-redruth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('72','3413','Cambridge','','cambridge','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('73','3413','Cannock','','cannock','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('74','3413','Canterbury','','canterbury','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('75','3413','Canvey Island','','canvey-island','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('76','3413','Carlisle','','carlisle','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('77','3413','Carlton','','carlton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('78','3413','Castleford','','castleford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('79','3413','Caterham and Warlingham','','caterham-and-warlingham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('80','3413','Chadderton','','chadderton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('81','3413','Chapeltown','','chapeltown','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('82','3413','Chatham','','chatham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('83','3413','Cheadle and Gatley','','cheadle-and-gatley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('84','3413','Chelmsford','','chelmsford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('85','3413','Cheltenham','','cheltenham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('86','3413','Chesham','','chesham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('87','3413','Cheshunt','','cheshunt','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('88','3413','Chester','','chester','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('89','3413','Chesterfield','','chesterfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('90','3413','Chester-le-Street','','chester-le-street','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('91','3413','Chichester','','chichester','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('92','3413','Chippenham','','chippenham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('93','3413','Chipping Sodbury','','chipping-sodbury','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('94','3413','Chorley','','chorley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('95','3413','Christchurch','','christchurch','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('96','3413','Clacton-on-Sea','','clacton-on-sea','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('97','3413','Clay Cross-North Wingfield','','clay-cross-north-wingfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('98','3413','Cleethorpes','','cleethorpes','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('99','3413','Clevedon','','clevedon','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('100','3413','Coalville','','coalville','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('101','3413','Colchester','','colchester','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('102','3413','Congleton','','congleton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('103','3413','Consett','','consett','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('104','3413','Corby','','corby','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('105','3413','Coventry','','coventry','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('106','3413','Cramlington','','cramlington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('107','3413','Crawley','','crawley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('108','3413','Crewe','','crewe','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('109','3413','Crosby','','crosby','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('110','3413','Crowthorne','','crowthorne','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('111','3413','Darlington','','darlington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('112','3413','Dartford','','dartford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('113','3413','Darwen','','darwen','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('114','3413','Deal','','deal','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('115','3413','Denton','','denton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('116','3413','Derby','','derby','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('117','3413','Dewsbury','','dewsbury','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('118','3413','Doncaster','','doncaster','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('119','3413','Dover','','dover','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('120','3413','Droitwich','','droitwich','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('121','3413','Dronfield','','dronfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('122','3413','Droylsden','','droylsden','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('123','3413','Dudley','','dudley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('124','3413','Dunstable','','dunstable','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('125','3413','Durham','','durham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('126','3413','Eastbourne','','eastbourne','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('127','3413','East Grinstead','','east-grinstead','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('128','3413','Eastleigh','','eastleigh','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('129','3413','East Retford','','east-retford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('130','3413','Eaton Socon-Saint Neots','','eaton-socon-saint-neots','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('131','3413','Eccles','','eccles','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('132','3413','Egham','','egham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('133','3413','Ellesmere Port','','ellesmere-port','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('134','3413','Epsom and Ewell','','epsom-and-ewell','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('135','3413','Esher-Molesey','','esher-molesey','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('136','3413','Eston and South Bank','','eston-and-south-bank','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('137','3413','Exeter','','exeter','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('138','3413','Exmouth','','exmouth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('139','3413','Failsworth','','failsworth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('140','3413','Falmouth-Penryn','','falmouth-penryn','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('141','3413','Fareham','','fareham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('142','3413','Farnborough','','farnborough','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('143','3413','Farnham','','farnham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('144','3413','Farnworth','','farnworth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('145','3413','Felixtowe','','felixtowe','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('146','3413','Felling','','felling','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('147','3413','Ferndown','','ferndown','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('148','3413','Fleet','','fleet','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('149','3413','Fleetwood','','fleetwood','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('150','3413','Folkestone','','folkestone','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('151','3413','Formby','','formby','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('152','3413','Frome','','frome','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('153','3413','Gateshead','','gateshead','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('154','3413','Gillingham','','gillingham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('155','3413','Glossop','','glossop','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('156','3413','Gloucester','','gloucester','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('157','3413','Godalming','','godalming','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('158','3413','Golborne','','golborne','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('159','3413','Gosforth','','gosforth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('160','3413','Gosport','','gosport','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('161','3413','Grantham','','grantham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('162','3413','Gravesend','','gravesend','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('163','3413','Grays','','grays','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('164','3413','Greasby','','greasby','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('165','3413','Great Malvern','','great-malvern','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('166','3413','Great Sankey','','great-sankey','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('167','3413','Great Yarmouth','','great-yarmouth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('168','3413','Grimsby','','grimsby','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('169','3413','Guildford','','guildford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('170','3413','Guiseley-Yeadon','','guiseley-yeadon','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('171','3413','Halesowen','','halesowen','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('172','3413','Halifax','','halifax','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('173','3413','Harlow','','harlow','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('174','3413','Harpenden','','harpenden','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('175','3413','Harrogate','','harrogate','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('176','3413','Hartlepool','','hartlepool','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('177','3413','Hastings','','hastings','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('178','3413','Hatfield','','hatfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('179','3413','Hatfield-Stainforth','','hatfield-stainforth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('180','3413','Havant','','havant','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('181','3413','Haywards Heath','','haywards-heath','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('182','3413','Hazel Grove and Bramhill','','hazel-grove-and-bramhill','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('183','3413','Hazlemere','','hazlemere','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('184','3413','Heanor','','heanor','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('185','3413','Hemel Hempstead','','hemel-hempstead','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('186','3413','Hereford','','hereford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('187','3413','Herne Bay','','herne-bay','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('188','3413','Hertford','','hertford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('189','3413','Heswall','','heswall','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('190','3413','Heywood','','heywood','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('191','3413','High Wycombe','','high-wycombe','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('192','3413','Hinckley','','hinckley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('193','3413','Hindley','','hindley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('194','3413','Hitchin','','hitchin','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('195','3413','Hoddesdon','','hoddesdon','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('196','3413','Holmfirth-Honley','','holmfirth-honley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('197','3413','Horsham','','horsham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('198','3413','Houghton-le-Spring','','houghton-le-spring','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('199','3413','Hove','','hove','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('200','3413','Hoylake-West Kirby','','hoylake-west-kirby','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('201','3413','Hucknall','','hucknall','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('202','3413','Huddersfield','','huddersfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('203','3413','Huyton-with-Roby','','huyton-with-roby','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('204','3413','Hyde','','hyde','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('205','3413','Ilkeston','','ilkeston','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('206','3413','Ipswich','','ipswich','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('207','3413','Jarrow','','jarrow','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('208','3413','Keighley','','keighley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('209','3413','Kendal','','kendal','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('210','3413','Kenilworth','','kenilworth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('211','3413','Kettering','','kettering','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('212','3413','Kidderminster','','kidderminster','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('213','3413','Kidsgrove','','kidsgrove','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('214','3413','Kingston upon Hull','','kingston-upon-hull','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('215','3413','Kingswood','','kingswood','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('216','3413','Kirby in Ashfield','','kirby-in-ashfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('217','3413','Kirkby','','kirkby','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('218','3413','Lancaster','','lancaster','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('219','3413','Leamington','','leamington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('220','3413','Leatherhead','','leatherhead','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('221','3413','Leeds','','leeds','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('222','3413','Leicester','','leicester','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('223','3413','Leigh','','leigh','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('224','3413','Leighton Buzzard','','leighton-buzzard','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('225','3413','Letchworth','','letchworth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('226','3413','Leyland','','leyland','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('227','3413','Lichfield','','lichfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('228','3413','Lincoln','','lincoln','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('229','3413','Litherland','','litherland','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('230','3413','Littlehampton','','littlehampton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('231','3413','Liverpool','','liverpool','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('232','3413','Locks Heath','','locks-heath','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('233','3413','London','','london','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('234','3413','Long Benton-Killingworth','','long-benton-killingworth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('235','3413','Long Eaton','','long-eaton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('236','3413','Loughborough','','loughborough','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('237','3413','Loughton','','loughton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('238','3413','Lowestoft','','lowestoft','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('239','3413','Luton','','luton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('240','3413','Macclesfield','','macclesfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('241','3413','Maghull-Lydiate','','maghull-lydiate','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('242','3413','Maidenhead','','maidenhead','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('243','3413','Maidstone','','maidstone','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('244','3413','Manchester','','manchester','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('245','3413','Mangotsfield','','mangotsfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('246','3413','Mansfield','','mansfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('247','3413','Margate','','margate','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('248','3413','Melton Mowbray','','melton-mowbray','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('249','3413','Middlesbrough','','middlesbrough','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('250','3413','Middleton','','middleton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('251','3413','Milton Keynes','','milton-keynes','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('252','3413','Morecambe','','morecambe','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('253','3413','Morley','','morley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('254','3413','Nailsea','','nailsea','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('255','3413','Nelson','','nelson','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('256','3413','New Addington','','new-addington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('257','3413','Newark-on-Trent','','newark-on-trent','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('258','3413','Newburn','','newburn','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('259','3413','Newbury','','newbury','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('260','3413','Newcastle-under-Lyme','','newcastle-under-lyme','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('261','3413','Newcastle upon Tyne','','newcastle-upon-tyne','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('262','3413','New Milton-Barton-on-Sea','','new-milton-barton-on-sea','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('263','3413','Newport','','newport','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('264','3413','Newton Abbot','','newton-abbot','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('265','3413','Newton Aycliffe','','newton-aycliffe','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('266','3413','Northampton','','northampton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('267','3413','Northfleet','','northfleet','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('268','3413','North Shields','','north-shields','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('269','3413','Northwich','','northwich','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('270','3413','Norwich','','norwich','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('271','3413','Nottingham','','nottingham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('272','3413','Nuneaton','','nuneaton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('273','3413','Oakengates-Donnington','','oakengates-donnington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('274','3413','Oldbury-Smethwick','','oldbury-smethwick','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('275','3413','Oldham','','oldham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('276','3413','Ormskirk','','ormskirk','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('277','3413','Ossett','','ossett','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('278','3413','Oxford','','oxford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('279','3413','Paignton','','paignton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('280','3413','Penzance','','penzance','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('281','3413','Peterborough','','peterborough','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('282','3413','Peterlee','','peterlee','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('283','3413','Plymouth','','plymouth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('284','3413','Pontefract','','pontefract','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('285','3413','Poole','','poole','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('286','3413','Portsmouth','','portsmouth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('287','3413','Potters Bar','','potters-bar','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('288','3413','Prescot','','prescot','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('289','3413','Preston','','preston','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('290','3413','Prestwich','','prestwich','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('291','3413','Pudsey','','pudsey','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('292','3413','Radcliffe','','radcliffe','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('293','3413','Ramsgate','','ramsgate','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('294','3413','Rawtenstall','','rawtenstall','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('295','3413','Rayleigh','','rayleigh','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('296','3413','Reading','','reading','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('297','3413','Redcar','','redcar','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('298','3413','Redditch','','redditch','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('299','3413','Reigate','','reigate','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('300','3413','Rochdale','','rochdale','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('301','3413','Rochester','','rochester','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('302','3413','Rotherham','','rotherham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('303','3413','Rottingdean','','rottingdean','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('304','3413','Royal Tunbridge Wells','','royal-tunbridge-wells','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('305','3413','Royton','','royton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('306','3413','Rugby','','rugby','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('307','3413','Rugeley','','rugeley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('308','3413','Runcorn','','runcorn','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('309','3413','Rushden','','rushden','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('310','3413','Ryde','','ryde','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('311','3413','Saint Albans','','saint-albans','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('312','3413','Saint Austell','','saint-austell','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('313','3413','Saint Helens','','saint-helens','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('314','3413','Sale','','sale','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('315','3413','Salford','','salford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('316','3413','Salisbury','','salisbury','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('317','3413','Scarborough','','scarborough','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('318','3413','Scunthorpe','','scunthorpe','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('319','3413','Seaham','','seaham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('320','3413','Sevenoaks','','sevenoaks','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('321','3413','Sheffield','','sheffield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('322','3413','Shipley','','shipley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('323','3413','Shrewsbury','','shrewsbury','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('324','3413','Sittingbourne','','sittingbourne','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('325','3413','Skelmersdale','','skelmersdale','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('326','3413','Slough','','slough','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('327','3413','Solihull','','solihull','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('328','3413','Sompting-Lancing','','sompting-lancing','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('329','3413','Southampton','','southampton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('330','3413','Southend-on-Sea','','southend-on-sea','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('331','3413','Southport','','southport','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('332','3413','South Shields','','south-shields','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('333','3413','Spalding-Pinchbeck','','spalding-pinchbeck','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('334','3413','Stafford','','stafford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('335','3413','Staines','','staines','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('336','3413','Stalybridge','','stalybridge','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('337','3413','Stanford le Hope-Corringham','','stanford-le-hope-corringham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('338','3413','Stanley-Annfield Plain','','stanley-annfield-plain','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('339','3413','Staveley','','staveley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('340','3413','Stevenage','','stevenage','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('341','3413','Stockport','','stockport','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('342','3413','Stockton Heath-Thelwall','','stockton-heath-thelwall','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('343','3413','Stockton-on-Tees','','stockton-on-tees','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('344','3413','Stoke-on-Trent','','stoke-on-trent','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('345','3413','Stourbridge','','stourbridge','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('346','3413','Stratford-upon-Avon','','stratford-upon-avon','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('347','3413','Stretford','','stretford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('348','3413','Strood','','strood','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('349','3413','Stroud','','stroud','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('350','3413','Stubbington','','stubbington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('351','3413','Sunbury','','sunbury','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('352','3413','Sunderland','','sunderland','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('353','3413','Sutton Coldfield','','sutton-coldfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('354','3413','Sutton in Ashfield','','sutton-in-ashfield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('355','3413','Swadlincote','','swadlincote','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('356','3413','Swanley-Hextable','','swanley-hextable','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('357','3413','Swindon','','swindon','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('358','3413','Swinton and Pendlebury','','swinton-and-pendlebury','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('359','3413','Tamworth','','tamworth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('360','3413','Taunton','','taunton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('361','3413','Telford','','telford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('362','3413','Thatcham','','thatcham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('363','3413','Thetford','','thetford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('364','3413','Thornaby','','thornaby','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('365','3413','Thornton-Cleveleys','','thornton-cleveleys','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('366','3413','Tonbridge','','tonbridge','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('367','3413','Torquay','','torquay','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('368','3413','Totton','','totton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('369','3413','Trowbridge','','trowbridge','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('370','3413','Tyldesley','','tyldesley','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('371','3413','Urmston','','urmston','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('372','3413','Wakefield','','wakefield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('373','3413','Walkden','','walkden','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('374','3413','Wallasey','','wallasey','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('375','3413','Wallsend','','wallsend','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('376','3413','Walsall','','walsall','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('377','3413','Walton and Weybridge','','walton-and-weybridge','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('378','3413','Warrington','','warrington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('379','3413','Warwick','','warwick','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('380','3413','Washington','','washington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('381','3413','Waterlooville','','waterlooville','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('382','3413','Watford','','watford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('383','3413','Wellingborough','','wellingborough','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('384','3413','Welwyn Garden City','','welwyn-garden-city','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('385','3413','West Bridgeford','','west-bridgeford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('386','3413','West Bromwich','','west-bromwich','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('387','3413','Westhoughton','','westhoughton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('388','3413','Weston-super-Mare','','weston-super-mare','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('389','3413','Weymouth','','weymouth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('390','3413','Whitefield','','whitefield','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('391','3413','Whitehaven','','whitehaven','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('392','3413','Whitley Bay','','whitley-bay','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('393','3413','Wickford','','wickford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('394','3413','Widnes','','widnes','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('395','3413','Wigan','','wigan','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('396','3413','Wigston','','wigston','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('397','3413','Wilmslow','','wilmslow','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('398','3413','Wimbourne Minster','','wimbourne-minster','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('399','3413','Winchester','','winchester','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('400','3413','Windsor-Eton','','windsor-eton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('401','3413','Winsford','','winsford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('402','3413','Wisbech','','wisbech','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('403','3413','Witham','','witham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('404','3413','Witney','','witney','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('405','3413','Woking-Byfleet','','woking-byfleet','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('406','3413','Wokingham','','wokingham','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('407','3413','Wolverhampton','','wolverhampton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('408','3413','Wolverton-Stony Stratford','','wolverton-stony-stratford','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('409','3413','Worcester','','worcester','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('410','3413','Workington','','workington','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('411','3413','Worksop','','worksop','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('412','3413','Worthing','','worthing','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('413','3413','Yeovil','','yeovil','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('414','3413','York','','york','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('415','3414','Antrim','','antrim','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('416','3414','Ballymena','','ballymena','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('417','3414','Bangor','','bangor','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('418','3414','Belfast','','belfast','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('419','3414','Carrickfergus','','carrickfergus','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('420','3414','Coleraine','','coleraine','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('421','3414','Lisburn','','lisburn','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('422','3414','Londonderry','','londonderry','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('423','3414','Lurgan','','lurgan','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('424','3414','Newry','','newry','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('425','3414','Newtonabbey','','newtonabbey','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('426','3414','Newtownards','','newtownards','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('427','3414','Portadown','','portadown','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('428','3415','Aberdeen','','aberdeen','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('429','3415','Alloa','','alloa','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('430','3415','Arbroath','','arbroath','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('431','3415','Ardrossan','','ardrossan','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('432','3415','Ayr','','ayr','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('433','3415','Blantyre-Hamilton','','blantyre-hamilton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('434','3415','Buckhaven','','buckhaven','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('435','3415','Cumbernauld','','cumbernauld','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('436','3415','Dalkeith','','dalkeith','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('437','3415','Dumbarton','','dumbarton','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('438','3415','Dumfries','','dumfries','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('439','3415','Dundee','','dundee','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('440','3415','Dunfermline','','dunfermline','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('441','3415','East Kilbride','','east-kilbride','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('442','3415','Edinburgh','','edinburgh','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('443','3415','Elgin','','elgin','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('444','3415','Falkirk','','falkirk','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('445','3415','Glasgow','','glasgow','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('446','3415','Glenrothes','','glenrothes','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('447','3415','Greenock','','greenock','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('448','3415','Inverkeithing-Dalgety Bay','','inverkeithing-dalgety-bay','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('449','3415','Inverness','','inverness','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('450','3415','Irvine','','irvine','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('451','3415','Kilmarnock','','kilmarnock','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('452','3415','Kirkcaldy','','kirkcaldy','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('453','3415','Kirkintilloch-Lenzie','','kirkintilloch-lenzie','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('454','3415','Livingston','','livingston','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('455','3415','Motherwell','','motherwell','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('456','3415','Perth','','perth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('457','3415','Stirling','','stirling','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('458','3416','Aberdare','','aberdare','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('459','3416','Barry','','barry','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('460','3416','Bridgend','','bridgend','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('461','3416','Brynmawr','','brynmawr','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('462','3416','Caerphily','','caerphily','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('463','3416','Cardiff','','cardiff','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('464','3416','Colwyn Bay','','colwyn-bay','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('465','3416','Cwmbran','','cwmbran','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('466','3416','Ebbw Vale','','ebbw-vale','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('467','3416','Llanelli','','llanelli','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('468','3416','Maesteg','','maesteg','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('469','3416','Merthyr Tydfil','','merthyr-tydfil','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('470','3416','Mountain Ash-Abercynon','','mountain-ash-abercynon','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('471','3416','Neath','','neath','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('472','3416','Newport','','newport','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('473','3416','Penarth','','penarth','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('474','3416','Pontypool','','pontypool','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('475','3416','Pontypridd','','pontypridd','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('476','3416','Port Talbot','','port-talbot','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('477','3416','Rhondda','','rhondda','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('478','3416','Rhyl','','rhyl','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('479','3416','Shotton-Hawarden','','shotton-hawarden','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('480','3416','Swansea','','swansea','','');
INSERT INTO `Location_Region` (`id`,`cidade_id`,`name`,`abbreviation`,`friendly_url`,`seo_description`,`seo_keywords`) VALUES ('481','3416','Wrexham','','wrexham','','');
/*!40000 ALTER TABLE `Location_Region` ENABLE KEYS */;


--
-- Create Table `Location_State`
--

DROP TABLE IF EXISTS `Location_State`;
CREATE TABLE `Location_State` (
  `id` int(11) NOT NULL auto_increment,
  `estado_id` int(11) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `abbreviation` varchar(100) NOT NULL,
  `friendly_url` varchar(255) NOT NULL default '',
  `popular` char(1) NOT NULL default 'n',
  `seo_description` varchar(255) NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `friendly_url` (`friendly_url`),
  KEY `estado_id` (`estado_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3417 DEFAULT CHARSET=latin1;

--
-- Data for Table `Location_State`
--

/*!40000 ALTER TABLE `Location_State` DISABLE KEYS */;
INSERT INTO `Location_State` (`id`,`estado_id`,`name`,`abbreviation`,`friendly_url`,`popular`,`seo_description`,`seo_keywords`) VALUES ('3413','235','England ','','england-','n','','');
INSERT INTO `Location_State` (`id`,`estado_id`,`name`,`abbreviation`,`friendly_url`,`popular`,`seo_description`,`seo_keywords`) VALUES ('3414','235','Northern Ireland ','','northern-ireland-','n','','');
INSERT INTO `Location_State` (`id`,`estado_id`,`name`,`abbreviation`,`friendly_url`,`popular`,`seo_description`,`seo_keywords`) VALUES ('3415','235','Scotland ','','scotland-','n','','');
INSERT INTO `Location_State` (`id`,`estado_id`,`name`,`abbreviation`,`friendly_url`,`popular`,`seo_description`,`seo_keywords`) VALUES ('3416','235','Wales ','','wales-','n','','');
/*!40000 ALTER TABLE `Location_State` ENABLE KEYS */;


--
-- Create Table `Payment_Article_Log`
--

DROP TABLE IF EXISTS `Payment_Article_Log`;
CREATE TABLE `Payment_Article_Log` (
  `payment_log_id` int(11) NOT NULL default '0',
  `article_id` int(11) NOT NULL default '0',
  `article_title` varchar(255) NOT NULL default '',
  `discount_id` varchar(10) NOT NULL,
  `level` tinyint(4) NOT NULL default '0',
  `renewal_date` date NOT NULL default '0000-00-00',
  `amount` decimal(10,2) NOT NULL default '0.00',
  KEY `payment_log_id` (`payment_log_id`),
  KEY `article_id` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Payment_Article_Log`
--

/*!40000 ALTER TABLE `Payment_Article_Log` DISABLE KEYS */;
/*!40000 ALTER TABLE `Payment_Article_Log` ENABLE KEYS */;


--
-- Create Table `Payment_Banner_Log`
--

DROP TABLE IF EXISTS `Payment_Banner_Log`;
CREATE TABLE `Payment_Banner_Log` (
  `payment_log_id` int(11) NOT NULL default '0',
  `banner_id` int(11) NOT NULL default '0',
  `banner_caption` varchar(255) NOT NULL default '',
  `discount_id` varchar(10) NOT NULL,
  `level` tinyint(4) NOT NULL default '0',
  `renewal_date` date NOT NULL default '0000-00-00',
  `impressions` mediumint(9) NOT NULL default '0',
  `amount` decimal(10,2) NOT NULL default '0.00',
  KEY `payment_log_id` (`payment_log_id`),
  KEY `banner_id` (`banner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Payment_Banner_Log`
--

/*!40000 ALTER TABLE `Payment_Banner_Log` DISABLE KEYS */;
/*!40000 ALTER TABLE `Payment_Banner_Log` ENABLE KEYS */;


--
-- Create Table `Payment_Classified_Log`
--

DROP TABLE IF EXISTS `Payment_Classified_Log`;
CREATE TABLE `Payment_Classified_Log` (
  `payment_log_id` int(11) NOT NULL default '0',
  `classified_id` int(11) NOT NULL default '0',
  `classified_title` varchar(255) NOT NULL default '',
  `discount_id` varchar(10) NOT NULL,
  `level` tinyint(4) NOT NULL default '0',
  `renewal_date` date NOT NULL default '0000-00-00',
  `amount` decimal(10,2) NOT NULL default '0.00',
  KEY `payment_log_id` (`payment_log_id`),
  KEY `classified_id` (`classified_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Payment_Classified_Log`
--

/*!40000 ALTER TABLE `Payment_Classified_Log` DISABLE KEYS */;
/*!40000 ALTER TABLE `Payment_Classified_Log` ENABLE KEYS */;


--
-- Create Table `Payment_CustomInvoice_Log`
--

DROP TABLE IF EXISTS `Payment_CustomInvoice_Log`;
CREATE TABLE `Payment_CustomInvoice_Log` (
  `payment_log_id` int(11) NOT NULL default '0',
  `custom_invoice_id` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `items` text NOT NULL,
  `items_price` text NOT NULL,
  `amount` decimal(10,2) NOT NULL default '0.00',
  KEY `payment_log_id` (`payment_log_id`),
  KEY `custom_invoice_id` (`custom_invoice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Payment_CustomInvoice_Log`
--

/*!40000 ALTER TABLE `Payment_CustomInvoice_Log` DISABLE KEYS */;
/*!40000 ALTER TABLE `Payment_CustomInvoice_Log` ENABLE KEYS */;


--
-- Create Table `Payment_Event_Log`
--

DROP TABLE IF EXISTS `Payment_Event_Log`;
CREATE TABLE `Payment_Event_Log` (
  `payment_log_id` int(11) NOT NULL default '0',
  `event_id` int(11) NOT NULL default '0',
  `event_title` varchar(255) NOT NULL default '',
  `discount_id` varchar(10) NOT NULL,
  `level` tinyint(4) NOT NULL default '0',
  `renewal_date` date NOT NULL default '0000-00-00',
  `amount` decimal(10,2) NOT NULL default '0.00',
  KEY `payment_log_id` (`payment_log_id`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Payment_Event_Log`
--

/*!40000 ALTER TABLE `Payment_Event_Log` DISABLE KEYS */;
/*!40000 ALTER TABLE `Payment_Event_Log` ENABLE KEYS */;


--
-- Create Table `Payment_Listing_Log`
--

DROP TABLE IF EXISTS `Payment_Listing_Log`;
CREATE TABLE `Payment_Listing_Log` (
  `payment_log_id` int(11) NOT NULL default '0',
  `listing_id` int(11) NOT NULL default '0',
  `listing_title` varchar(255) NOT NULL default '',
  `discount_id` varchar(10) NOT NULL default '',
  `level` tinyint(4) NOT NULL default '0',
  `renewal_date` date NOT NULL default '0000-00-00',
  `categories` tinyint(4) NOT NULL default '0',
  `extra_categories` tinyint(4) NOT NULL default '0',
  `listingtemplate_title` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL default '0.00',
  KEY `payment_log_id` (`payment_log_id`),
  KEY `listing_id` (`listing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Payment_Listing_Log`
--

/*!40000 ALTER TABLE `Payment_Listing_Log` DISABLE KEYS */;
/*!40000 ALTER TABLE `Payment_Listing_Log` ENABLE KEYS */;


--
-- Create Table `Payment_Log`
--

DROP TABLE IF EXISTS `Payment_Log`;
CREATE TABLE `Payment_Log` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `transaction_id` varchar(255) NOT NULL default '',
  `transaction_status` varchar(255) NOT NULL default '',
  `transaction_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `transaction_amount` decimal(10,2) NOT NULL default '0.00',
  `transaction_currency` char(3) NOT NULL default '',
  `system_type` varchar(255) NOT NULL default '',
  `recurring` char(1) NOT NULL default 'n',
  `notes` text NOT NULL,
  `return_fields` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Payment_Log`
--

/*!40000 ALTER TABLE `Payment_Log` DISABLE KEYS */;
/*!40000 ALTER TABLE `Payment_Log` ENABLE KEYS */;


--
-- Create Table `Promotion`
--

DROP TABLE IF EXISTS `Promotion`;
CREATE TABLE `Promotion` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL default '0',
  `image_id` int(11) NOT NULL default '0',
  `thumb_id` int(11) NOT NULL default '0',
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `entered` datetime NOT NULL default '0000-00-00 00:00:00',
  `name` varchar(255) NOT NULL default '',
  `seo_name` varchar(255) NOT NULL,
  `offer` varchar(255) NOT NULL default '',
  `offer1` varchar(255) NOT NULL,
  `offer2` varchar(255) NOT NULL,
  `offer3` varchar(255) NOT NULL,
  `offer4` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL default '',
  `description1` varchar(255) NOT NULL,
  `description2` varchar(255) NOT NULL,
  `description3` varchar(255) NOT NULL,
  `description4` varchar(255) NOT NULL,
  `seo_description` varchar(255) NOT NULL,
  `seo_description1` varchar(255) NOT NULL,
  `seo_description2` varchar(255) NOT NULL,
  `seo_description3` varchar(255) NOT NULL,
  `seo_description4` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `keywords1` text NOT NULL,
  `keywords2` text NOT NULL,
  `keywords3` text NOT NULL,
  `keywords4` text NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `seo_keywords1` varchar(255) NOT NULL,
  `seo_keywords2` varchar(255) NOT NULL,
  `seo_keywords3` varchar(255) NOT NULL,
  `seo_keywords4` varchar(255) NOT NULL,
  `fulltextsearch_keyword` text NOT NULL,
  `fulltextsearch_where` text NOT NULL,
  `start_date` date NOT NULL default '0000-00-00',
  `end_date` date NOT NULL default '0000-00-00',
  `random_number` bigint(15) NOT NULL default '0',
  `html` set('yes','no') NOT NULL default '',
  `conditions` varchar(255) NOT NULL default '',
  `conditions1` text NOT NULL,
  `conditions2` text NOT NULL,
  `conditions3` text NOT NULL,
  `conditions4` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `account_id` (`account_id`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`),
  KEY `name` (`name`),
  KEY `random_number` (`random_number`),
  FULLTEXT KEY `fulltextsearch_keyword` (`fulltextsearch_keyword`),
  FULLTEXT KEY `fulltextsearch_where` (`fulltextsearch_where`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Promotion`
--

/*!40000 ALTER TABLE `Promotion` DISABLE KEYS */;
/*!40000 ALTER TABLE `Promotion` ENABLE KEYS */;


--
-- Create Table `Registration`
--

DROP TABLE IF EXISTS `Registration`;
CREATE TABLE `Registration` (
  `name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`name`,`domain`,`date_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Registration`
--

/*!40000 ALTER TABLE `Registration` DISABLE KEYS */;
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('license','','0000-00-00 00:00:00','6C5A-826A-82E2-F21E-7F06-1638-3670-2E86');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('extra','','0000-00-00 00:00:00','A3A0453822D4CBB199ADC8EF36D34F91');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('a','flunkd.co.uk','2009-06-30 17:27:16','6C5A826A82E2F21E7F06163836702E86');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('b','flunkd.co.uk','2009-06-30 17:27:16','50EC77045BBB44CF8603D3F52BAC23BC');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('c','flunkd.co.uk','2009-06-30 17:27:16','DF3652A1E4280E8F54D54BBD9AA0CD37');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('d','flunkd.co.uk','2009-06-30 17:27:16','FFCF78DCCFA3E59F352688A83D55E11F');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('e','flunkd.co.uk','2009-06-30 17:27:16','778604AD9D798CC367F9474E5A2B0E5D');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('f','flunkd.co.uk','2009-06-30 17:27:16','A9C3ABCDCD4082D4BDAB000728F39E79');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('g','flunkd.co.uk','2009-06-30 17:27:16','87EF7172C3450BDF8C40C695A52009FF');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('h','flunkd.co.uk','2009-06-30 17:27:16','AA7188E7E7C8D87482A37C302AEDFDDD');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('i','flunkd.co.uk','2009-06-30 17:27:16','DB83B5450A18E16A1EAC55EDB87CA614');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('j','flunkd.co.uk','2009-06-30 17:27:16','9FCBA7766AAF2B5D0B9FE73F6CAA43F5');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('k','flunkd.co.uk','2009-06-30 17:27:16','E1101BABE4EC31326C7497E64BF9F685');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('l','flunkd.co.uk','2009-06-30 17:27:16','04ABFB09C1E9E4ED876EE6A947605441');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('m','flunkd.co.uk','2009-06-30 17:27:16','1282D94D6A3A5A52CC3192E0290789E4');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('n','flunkd.co.uk','2009-06-30 17:27:16','1E33E118F70793BE68D9B91B9B137891');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('o','flunkd.co.uk','2009-06-30 17:27:16','59BF340472AEAC049C7CA5AECDA980C8');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('p','flunkd.co.uk','2009-06-30 17:27:16','298FB93AE0D61A8E6E06627DC62567EA');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('q','flunkd.co.uk','2009-06-30 17:27:16','C85A1C70A093573100DEB84354C0B42B');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('r','flunkd.co.uk','2009-06-30 17:27:16','2CD6E9E93419D04CB62514CC91A5A219');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('s','flunkd.co.uk','2009-06-30 17:27:16','F0E77063967BFFF164C4B538A1006995');
INSERT INTO `Registration` (`name`,`domain`,`date_time`,`value`) VALUES ('t','flunkd.co.uk','2009-06-30 17:27:16','B353679E7FCA9A488F2B4B96C424B5B8');
/*!40000 ALTER TABLE `Registration` ENABLE KEYS */;


--
-- Create Table `Report_Article`
--

DROP TABLE IF EXISTS `Report_Article`;
CREATE TABLE `Report_Article` (
  `id` int(11) NOT NULL auto_increment,
  `article_id` int(11) NOT NULL default '0',
  `report_type` tinyint(1) NOT NULL default '0',
  `report_amount` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  KEY `article_id` (`article_id`),
  KEY `report_type` (`report_type`),
  KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Article`
--

/*!40000 ALTER TABLE `Report_Article` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Article` ENABLE KEYS */;


--
-- Create Table `Report_Article_Daily`
--

DROP TABLE IF EXISTS `Report_Article_Daily`;
CREATE TABLE `Report_Article_Daily` (
  `article_id` int(11) NOT NULL default '0',
  `day` date NOT NULL default '0000-00-00',
  `summary_view` int(11) NOT NULL default '0',
  `detail_view` int(11) NOT NULL default '0',
  PRIMARY KEY  (`article_id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Article_Daily`
--

/*!40000 ALTER TABLE `Report_Article_Daily` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Article_Daily` ENABLE KEYS */;


--
-- Create Table `Report_Article_Monthly`
--

DROP TABLE IF EXISTS `Report_Article_Monthly`;
CREATE TABLE `Report_Article_Monthly` (
  `article_id` int(11) NOT NULL default '0',
  `day` date NOT NULL,
  `summary_view` int(11) NOT NULL default '0',
  `detail_view` int(11) NOT NULL default '0',
  PRIMARY KEY  (`article_id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Article_Monthly`
--

/*!40000 ALTER TABLE `Report_Article_Monthly` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Article_Monthly` ENABLE KEYS */;


--
-- Create Table `Report_Banner`
--

DROP TABLE IF EXISTS `Report_Banner`;
CREATE TABLE `Report_Banner` (
  `id` int(11) NOT NULL auto_increment,
  `banner_id` int(11) NOT NULL default '0',
  `report_type` tinyint(1) NOT NULL default '0',
  `report_amount` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  KEY `banner_id` (`banner_id`),
  KEY `report_type` (`report_type`),
  KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Banner`
--

/*!40000 ALTER TABLE `Report_Banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Banner` ENABLE KEYS */;


--
-- Create Table `Report_Banner_Daily`
--

DROP TABLE IF EXISTS `Report_Banner_Daily`;
CREATE TABLE `Report_Banner_Daily` (
  `banner_id` int(11) NOT NULL default '0',
  `day` date NOT NULL default '0000-00-00',
  `view` int(11) NOT NULL default '0',
  `click_thru` int(11) NOT NULL default '0',
  PRIMARY KEY  (`banner_id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Banner_Daily`
--

/*!40000 ALTER TABLE `Report_Banner_Daily` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Banner_Daily` ENABLE KEYS */;


--
-- Create Table `Report_Banner_Monthly`
--

DROP TABLE IF EXISTS `Report_Banner_Monthly`;
CREATE TABLE `Report_Banner_Monthly` (
  `banner_id` int(11) NOT NULL default '0',
  `day` date NOT NULL,
  `view` int(11) NOT NULL default '0',
  `click_thru` int(11) NOT NULL default '0',
  PRIMARY KEY  (`banner_id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Banner_Monthly`
--

/*!40000 ALTER TABLE `Report_Banner_Monthly` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Banner_Monthly` ENABLE KEYS */;


--
-- Create Table `Report_Classified`
--

DROP TABLE IF EXISTS `Report_Classified`;
CREATE TABLE `Report_Classified` (
  `id` int(11) NOT NULL auto_increment,
  `classified_id` int(11) NOT NULL default '0',
  `report_type` tinyint(1) NOT NULL default '0',
  `report_amount` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  KEY `classified_id` (`classified_id`),
  KEY `report_type` (`report_type`),
  KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Classified`
--

/*!40000 ALTER TABLE `Report_Classified` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Classified` ENABLE KEYS */;


--
-- Create Table `Report_Classified_Daily`
--

DROP TABLE IF EXISTS `Report_Classified_Daily`;
CREATE TABLE `Report_Classified_Daily` (
  `classified_id` int(11) NOT NULL default '0',
  `day` date NOT NULL default '0000-00-00',
  `summary_view` int(11) NOT NULL default '0',
  `detail_view` int(11) NOT NULL default '0',
  PRIMARY KEY  (`classified_id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Classified_Daily`
--

/*!40000 ALTER TABLE `Report_Classified_Daily` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Classified_Daily` ENABLE KEYS */;


--
-- Create Table `Report_Classified_Monthly`
--

DROP TABLE IF EXISTS `Report_Classified_Monthly`;
CREATE TABLE `Report_Classified_Monthly` (
  `classified_id` int(11) NOT NULL default '0',
  `day` date NOT NULL,
  `summary_view` int(11) NOT NULL default '0',
  `detail_view` int(11) NOT NULL default '0',
  PRIMARY KEY  (`classified_id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Classified_Monthly`
--

/*!40000 ALTER TABLE `Report_Classified_Monthly` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Classified_Monthly` ENABLE KEYS */;


--
-- Create Table `Report_Event`
--

DROP TABLE IF EXISTS `Report_Event`;
CREATE TABLE `Report_Event` (
  `id` int(11) NOT NULL auto_increment,
  `event_id` int(11) NOT NULL default '0',
  `report_type` tinyint(1) NOT NULL default '0',
  `report_amount` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  KEY `event_id` (`event_id`),
  KEY `report_type` (`report_type`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Event`
--

/*!40000 ALTER TABLE `Report_Event` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Event` ENABLE KEYS */;


--
-- Create Table `Report_Event_Daily`
--

DROP TABLE IF EXISTS `Report_Event_Daily`;
CREATE TABLE `Report_Event_Daily` (
  `event_id` int(11) NOT NULL default '0',
  `day` date NOT NULL default '0000-00-00',
  `summary_view` int(11) NOT NULL default '0',
  `detail_view` int(11) NOT NULL default '0',
  PRIMARY KEY  (`event_id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Event_Daily`
--

/*!40000 ALTER TABLE `Report_Event_Daily` DISABLE KEYS */;
INSERT INTO `Report_Event_Daily` (`event_id`,`day`,`summary_view`,`detail_view`) VALUES ('1','2009-07-04','7','0');
INSERT INTO `Report_Event_Daily` (`event_id`,`day`,`summary_view`,`detail_view`) VALUES ('2','2009-07-04','13','0');
INSERT INTO `Report_Event_Daily` (`event_id`,`day`,`summary_view`,`detail_view`) VALUES ('3','2009-07-04','11','9');
INSERT INTO `Report_Event_Daily` (`event_id`,`day`,`summary_view`,`detail_view`) VALUES ('3','2009-07-05','2','0');
INSERT INTO `Report_Event_Daily` (`event_id`,`day`,`summary_view`,`detail_view`) VALUES ('3','2009-07-06','32','2');
INSERT INTO `Report_Event_Daily` (`event_id`,`day`,`summary_view`,`detail_view`) VALUES ('3','2009-07-07','1','0');
INSERT INTO `Report_Event_Daily` (`event_id`,`day`,`summary_view`,`detail_view`) VALUES ('3','2009-07-08','7','0');
INSERT INTO `Report_Event_Daily` (`event_id`,`day`,`summary_view`,`detail_view`) VALUES ('3','2009-07-09','3','0');
/*!40000 ALTER TABLE `Report_Event_Daily` ENABLE KEYS */;


--
-- Create Table `Report_Event_Monthly`
--

DROP TABLE IF EXISTS `Report_Event_Monthly`;
CREATE TABLE `Report_Event_Monthly` (
  `event_id` int(11) NOT NULL default '0',
  `day` date NOT NULL,
  `summary_view` int(11) NOT NULL default '0',
  `detail_view` int(11) NOT NULL default '0',
  PRIMARY KEY  (`event_id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Event_Monthly`
--

/*!40000 ALTER TABLE `Report_Event_Monthly` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Event_Monthly` ENABLE KEYS */;


--
-- Create Table `Report_Listing`
--

DROP TABLE IF EXISTS `Report_Listing`;
CREATE TABLE `Report_Listing` (
  `id` int(11) NOT NULL auto_increment,
  `listing_id` int(11) NOT NULL default '0',
  `report_type` tinyint(1) NOT NULL default '0',
  `report_amount` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  KEY `listing_id` (`listing_id`),
  KEY `report_type` (`report_type`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=2423 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Report_Listing_Daily`;
CREATE TABLE `Report_Listing_Daily` (
  `listing_id` int(11) NOT NULL default '0',
  `day` date NOT NULL default '0000-00-00',
  `summary_view` int(11) NOT NULL default '0',
  `detail_view` int(11) NOT NULL default '0',
  `click_thru` int(11) NOT NULL default '0',
  `email_sent` int(11) NOT NULL default '0',
  `phone_view` int(11) NOT NULL default '0',
  `fax_view` int(11) NOT NULL default '0',
  PRIMARY KEY  (`listing_id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Report_Listing_Monthly`;
CREATE TABLE `Report_Listing_Monthly` (
  `listing_id` int(11) NOT NULL default '0',
  `day` date NOT NULL,
  `summary_view` int(11) NOT NULL default '0',
  `detail_view` int(11) NOT NULL default '0',
  `click_thru` int(11) NOT NULL default '0',
  `email_sent` int(11) NOT NULL default '0',
  `phone_view` int(11) NOT NULL default '0',
  `fax_view` int(11) NOT NULL default '0',
  PRIMARY KEY  (`listing_id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Listing_Monthly`
--

/*!40000 ALTER TABLE `Report_Listing_Monthly` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report_Listing_Monthly` ENABLE KEYS */;


--
-- Create Table `Report_Login`
--

DROP TABLE IF EXISTS `Report_Login`;
CREATE TABLE `Report_Login` (
  `id` int(11) NOT NULL auto_increment,
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `ip` varchar(255) NOT NULL default '',
  `type` varchar(255) NOT NULL default '',
  `page` varchar(255) NOT NULL default '',
  `username` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `Report_Statistic`;
CREATE TABLE `Report_Statistic` (
  `day` date NOT NULL,
  `module` char(1) character set utf8 NOT NULL,
  `key` varchar(255) character set utf8 NOT NULL,
  `value` varchar(255) character set utf8 NOT NULL,
  `quantity` int(11) NOT NULL,
  KEY `key` (`key`),
  KEY `module` (`module`),
  KEY `day` (`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Statistic`
--

/*!40000 ALTER TABLE `Report_Statistic` DISABLE KEYS */;
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-01','h','keywords','gift','4');
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-04','e','keywords','Take That','6');
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-04','e','where','Manchester, England','11');
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-04','e','where','London, England','7');
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-04','l','locations','United Kingdom  » England  » Amersham','2');
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-06','l','categories','category-listing','3');
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-08','l','categories','Accomodation and Housing','9');
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-08','l','categories','Accomodation and Housing » Estate Agents','4');
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-09','l','categories','Accomodation and Housing','2');
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-10','l','categories','Student Accomodation » Estate Agents','4');
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-14','l','categories','Accomodation and Housing','2');
INSERT INTO `Report_Statistic` (`day`,`module`,`key`,`value`,`quantity`) VALUES ('2009-07-28','l','categories','Accomodation and Housing','4');
/*!40000 ALTER TABLE `Report_Statistic` ENABLE KEYS */;


--
-- Create Table `Report_Statistic_Daily`
--

DROP TABLE IF EXISTS `Report_Statistic_Daily`;
CREATE TABLE `Report_Statistic_Daily` (
  `search_date` date NOT NULL,
  `module` char(1) character set utf8 NOT NULL,
  `keyword` varchar(50) character set utf8 NOT NULL,
  `category_id` int(11) NOT NULL default '0',
  `estado_id` int(11) NOT NULL default '0',
  `cidade_id` int(11) NOT NULL default '0',
  `bairro_id` int(11) NOT NULL default '0',
  `city_id` int(11) NOT NULL default '0',
  `area_id` int(11) NOT NULL default '0',
  `search_where` varchar(255) character set utf8 default NULL,
  KEY `search_date` (`search_date`),
  KEY `module` (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Report_Statistic_Daily`
--

/*!40000 ALTER TABLE `Report_Statistic_Daily` DISABLE KEYS */;
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','h','estate agents','0','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','h','estate agents','0','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','h','estate agents','0','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','h','estate agents','0','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','h','estate agents','0','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','1','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','1','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','2','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','7','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3415','456','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','12','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','9','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','16','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3414','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3416','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3415','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','189','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','393','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','179','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','173','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3415','441','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','108','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','330','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','154','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','219','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','177','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','93','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','344','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','345','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','319','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','292','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','16','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','131','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3415','433','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','403','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','88','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','320','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3415','447','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','390','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3415','438','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','326','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3416','479','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','48','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3415','444','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','315','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','52','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','312','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3416','478','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','148','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3415','451','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','335','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','135','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','153','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','147','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3414','425','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','41','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','201','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','107','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','411','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','331','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','306','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','40','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','63','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','275','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','308','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','305','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','122','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','214','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','5','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','185','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','256','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','211','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','156','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','318','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','79','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','226','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','353','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3415','431','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','384','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','87','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','58','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','106','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','19','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','92','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','234','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','180','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','351','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','376','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','32','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','285','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','166','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','355','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','381','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','159','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','352','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','272','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','1','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','26','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','369','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','216','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','325','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','50','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','152','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','94','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','357','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','150','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','288','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','370','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','114','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','397','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','109','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','401','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','56','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','341','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3414','417','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','321','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3415','455','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','167','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','410','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3415','435','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','278','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','120','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','98','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','396','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','221','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','253','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','0','235','3413','139','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-07-31','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','8','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','4','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','11','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','3','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','13','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','14','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','5','0','0','0','0','0','');
INSERT INTO `Report_Statistic_Daily` (`search_date`,`module`,`keyword`,`category_id`,`estado_id`,`cidade_id`,`bairro_id`,`city_id`,`area_id`,`search_where`) VALUES ('2009-08-01','l','','8','0','0','0','0','0','');
/*!40000 ALTER TABLE `Report_Statistic_Daily` ENABLE KEYS */;


--
-- Create Table `Review`
--

DROP TABLE IF EXISTS `Review`;
CREATE TABLE `Review` (
  `id` int(11) NOT NULL auto_increment,
  `item_type` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL default '0',
  `added` datetime NOT NULL default '0000-00-00 00:00:00',
  `ip` varchar(20) default NULL,
  `review_title` varchar(255) default NULL,
  `review` text,
  `reviewer_name` varchar(255) default NULL,
  `reviewer_email` varchar(255) default NULL,
  `reviewer_location` varchar(255) default NULL,
  `rating` tinyint(2) NOT NULL default '0',
  `approved` int(1) NOT NULL default '0',
  `response` text NOT NULL,
  `responseapproved` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `listing_id` (`item_id`),
  KEY `approved` (`approved`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Review`
--

/*!40000 ALTER TABLE `Review` DISABLE KEYS */;
/*!40000 ALTER TABLE `Review` ENABLE KEYS */;


--
-- Create Table `SMAccount`
--

DROP TABLE IF EXISTS `SMAccount`;
CREATE TABLE `SMAccount` (
  `id` int(11) NOT NULL auto_increment,
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `entered` datetime NOT NULL default '0000-00-00 00:00:00',
  `username` varchar(255) NOT NULL default '',
  `password` varchar(255) NOT NULL default '',
  `permission` varchar(255) NOT NULL default '',
  `iprestriction` text NOT NULL,
  `faillogin_count` int(11) NOT NULL default '0',
  `faillogin_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `name` varchar(255) NOT NULL default '',
  `phone` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Data for Table `SMAccount`
--

/*!40000 ALTER TABLE `SMAccount` DISABLE KEYS */;
INSERT INTO `SMAccount` (`id`,`updated`,`entered`,`username`,`password`,`permission`,`iprestriction`,`faillogin_count`,`faillogin_datetime`,`name`,`phone`,`email`) VALUES ('1','2009-06-30 20:26:07','0000-00-00 00:00:00','user','21232f297a57a5a743894a0e4a801fc3','32767','127.0.0.1','0','0000-00-00 00:00:00','google','703.914.0770','vn@vv.com');
/*!40000 ALTER TABLE `SMAccount` ENABLE KEYS */;


--
-- Create Table `Setting`
--

DROP TABLE IF EXISTS `Setting`;
CREATE TABLE `Setting` (
  `name` varchar(255) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Setting`
--

/*!40000 ALTER TABLE `Setting` DISABLE KEYS */;
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_username','admin');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_password','21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_faillogin_count','0');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_faillogin_datetime','0000-00-00 00:00:00');
INSERT INTO `Setting` (`name`,`value`) VALUES ('default_url','http://127.0.0.1/edirectory7');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_first_login','no');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_seocenter','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_listingtemplate','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_pricing','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_invoice','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_email','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_emailnotification','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_sitecontent','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_googleads','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_googlemaps','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_googleanalytics','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_headerlogo','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_noimage','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_claim','yes');
INSERT INTO `Setting` (`name`,`value`) VALUES ('todo_langcenter','done');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_email','info@xx.cc');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_send_email','on');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_listing_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_event_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_banner_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_classified_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_article_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_account_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_contactus_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_support_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_payment_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_rate_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('sitemgr_claim_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('invoice_company','Your Company, Inc.');
INSERT INTO `Setting` (`name`,`value`) VALUES ('invoice_address','123 Main Street');
INSERT INTO `Setting` (`name`,`value`) VALUES ('invoice_city','Arlington');
INSERT INTO `Setting` (`name`,`value`) VALUES ('invoice_state','VA');
INSERT INTO `Setting` (`name`,`value`) VALUES ('invoice_zipcode','22207');
INSERT INTO `Setting` (`name`,`value`) VALUES ('invoice_phone','703.914.0770');
INSERT INTO `Setting` (`name`,`value`) VALUES ('invoice_country','USA');
INSERT INTO `Setting` (`name`,`value`) VALUES ('invoice_fax','703.914.0770');
INSERT INTO `Setting` (`name`,`value`) VALUES ('invoice_email','info@xx.cc');
INSERT INTO `Setting` (`name`,`value`) VALUES ('invoice_notes','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('invoice_image','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('review_listing_enabled','on');
INSERT INTO `Setting` (`name`,`value`) VALUES ('review_article_enabled','on');
INSERT INTO `Setting` (`name`,`value`) VALUES ('review_approve','on');
INSERT INTO `Setting` (`name`,`value`) VALUES ('review_manditory','on');
INSERT INTO `Setting` (`name`,`value`) VALUES ('claim_approve','on');
INSERT INTO `Setting` (`name`,`value`) VALUES ('claim_deny','on');
INSERT INTO `Setting` (`name`,`value`) VALUES ('claim_approveemail','on');
INSERT INTO `Setting` (`name`,`value`) VALUES ('claim_denyemail','on');
INSERT INTO `Setting` (`name`,`value`) VALUES ('import_enable_listing_active','1');
INSERT INTO `Setting` (`name`,`value`) VALUES ('import_defaultlevel','10');
INSERT INTO `Setting` (`name`,`value`) VALUES ('import_sameaccount','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('import_account_id','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('import_from_export','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_report_rollup','2009-07-31');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_listing_randomizer','20000');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_promotion_randomizer','0');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_banner_randomizer','0');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_event_randomizer','0');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_classified_randomizer','0');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_article_randomizer','0');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_listing_reminder','0');
INSERT INTO `Setting` (`name`,`value`) VALUES ('edir_default_language','en_us');
INSERT INTO `Setting` (`name`,`value`) VALUES ('edir_languages','en_us');
INSERT INTO `Setting` (`name`,`value`) VALUES ('edir_languagenames','English');
INSERT INTO `Setting` (`name`,`value`) VALUES ('edir_language','en_us');
INSERT INTO `Setting` (`name`,`value`) VALUES ('emailconf_method','mail');
INSERT INTO `Setting` (`name`,`value`) VALUES ('emailconf_host','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('emailconf_port','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('emailconf_auth','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('emailconf_email','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('emailconf_username','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('emailconf_password','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('foreignaccount_openid','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('foreignaccount_facebook','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('foreignaccount_facebook_apikey','');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_datetime_dailymaintenance','2009-07-31 01:23:02');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_datetime_import','2009-07-08 08:01:54');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_datetime_randomizer','2009-07-31 02:45:22');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_datetime_renewalreminder','2009-07-31 02:35:02');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_datetime_reportrollup','2009-07-31 02:44:04');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_datetime_sitemap','0000-00-00 00:00:00');
INSERT INTO `Setting` (`name`,`value`) VALUES ('last_datetime_statisticreport','2009-07-31 02:30:02');
/*!40000 ALTER TABLE `Setting` ENABLE KEYS */;


--
-- Create Table `Setting_Google`
--

DROP TABLE IF EXISTS `Setting_Google`;
CREATE TABLE `Setting_Google` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Data for Table `Setting_Google`
--

/*!40000 ALTER TABLE `Setting_Google` DISABLE KEYS */;
INSERT INTO `Setting_Google` (`id`,`name`,`value`) VALUES ('1','google_ad_client','pub-1254273197347725');
INSERT INTO `Setting_Google` (`id`,`name`,`value`) VALUES ('2','google_maps_key','ABQIAAAA9eM4TnIprp_nksYmNH03gRTHOLb9pFeRJwTTHTz7Ob8smLNXwBSbsQoTAQqOPFYFkfIpeKfWepPEgw');
INSERT INTO `Setting_Google` (`id`,`name`,`value`) VALUES ('3','google_analytics_account','');
INSERT INTO `Setting_Google` (`id`,`name`,`value`) VALUES ('4','google_analytics_front','on');
INSERT INTO `Setting_Google` (`id`,`name`,`value`) VALUES ('5','google_analytics_membros','on');
INSERT INTO `Setting_Google` (`id`,`name`,`value`) VALUES ('6','google_analytics_sitemgr','on');
INSERT INTO `Setting_Google` (`id`,`name`,`value`) VALUES ('7','google_ad_channel','');
INSERT INTO `Setting_Google` (`id`,`name`,`value`) VALUES ('8','google_ad_status','on');
/*!40000 ALTER TABLE `Setting_Google` ENABLE KEYS */;


--
-- Create Table `Setting_Payment`
--

DROP TABLE IF EXISTS `Setting_Payment`;
CREATE TABLE `Setting_Payment` (
  `name` varchar(255) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Setting_Payment`
--

/*!40000 ALTER TABLE `Setting_Payment` DISABLE KEYS */;
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('PAYPAL_ACCOUNT','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('PAYPALAPI_USERNAME','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('PAYPALAPI_PASSWORD','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('PAYPALAPI_SIGNATURE','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('PAYFLOW_LOGIN','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('PAYFLOW_PARTNER','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('TWOCHECKOUT_LOGIN','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('PSIGATE_STOREID','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('PSIGATE_PASSPHRASE','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('WORLDPAY_INSTID','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('ITRANSACT_VENDORID','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('AUTHORIZE_LOGIN','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('AUTHORIZE_TXNKEY','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('LINKPOINT_CONFIGFILE','');
INSERT INTO `Setting_Payment` (`name`,`value`) VALUES ('LINKPOINT_KEYFILE','');
/*!40000 ALTER TABLE `Setting_Payment` ENABLE KEYS */;


--
-- Create Table `Setting_Search_Tag`
--

DROP TABLE IF EXISTS `Setting_Search_Tag`;
CREATE TABLE `Setting_Search_Tag` (
  `id` int(50) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data for Table `Setting_Search_Tag`
--

/*!40000 ALTER TABLE `Setting_Search_Tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `Setting_Search_Tag` ENABLE KEYS */;


--
-- Create Table `ZipCode_Data`
--

DROP TABLE IF EXISTS `ZipCode_Data`;
CREATE TABLE `ZipCode_Data` (
  `ZipCode` varchar(10) NOT NULL default '',
  `Country` char(2) NOT NULL,
  `Latitude` double(10,6) NOT NULL default '0.000000',
  `Longitude` double(10,6) NOT NULL default '0.000000',
  KEY `ZipCode` (`ZipCode`),
  KEY `Country` (`Country`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



