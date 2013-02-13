-- phpMyAdmin SQL Dump
-- version 2.11.2.2
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 27 Novembre 2008 à 14:34
-- Version du serveur: 5.0.32
-- Version de PHP: 5.2.0-8+etch13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `refuges`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartenance_polygone`
--

CREATE TABLE IF NOT EXISTS `appartenance_polygone` (
  `id_appartenance_polygone` int(11) NOT NULL auto_increment,
  `id_point_gps` int(11) NOT NULL default '0',
  `id_polygone` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_appartenance_polygone`),
  KEY `id_point_gps` (`id_point_gps`,`id_polygone`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3781 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int(10) NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_point` int(10) NOT NULL default '0',
  `texte` text NOT NULL,
  `auteur` varchar(80) NOT NULL default '',
  `photo_existe` int(11) NOT NULL default '0',
  `demande_correction` tinyint(4) NOT NULL default '0',
  `qualite_supposee` int(11) NOT NULL default '0',
  `id_createur` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_commentaire`),
  KEY `id_createur` (`id_createur`),
  KEY `auteur` (`auteur`),
  KEY `date` (`date`),
  KEY `id_point` (`id_point`),
  KEY `photo_existe` (`photo_existe`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='commentaires de refuges' AUTO_INCREMENT=9901 ;

-- --------------------------------------------------------

--
-- Structure de la table `lien_polygone_gps`
--

CREATE TABLE IF NOT EXISTS `lien_polygone_gps` (
  `id_lien_polygone_gps` int(11) NOT NULL auto_increment,
  `id_point_gps` int(11) NOT NULL default '0',
  `id_polygone` int(11) NOT NULL default '0',
  `ordre` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_lien_polygone_gps`),
  KEY `id_point_gps` (`id_point_gps`,`id_polygone`,`ordre`),
  KEY `id_polygone` (`id_polygone`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3364 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_auth_access`
--

CREATE TABLE IF NOT EXISTS `phpbb_auth_access` (
  `group_id` mediumint(8) NOT NULL default '0',
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `auth_view` tinyint(1) NOT NULL default '0',
  `auth_read` tinyint(1) NOT NULL default '0',
  `auth_post` tinyint(1) NOT NULL default '0',
  `auth_reply` tinyint(1) NOT NULL default '0',
  `auth_edit` tinyint(1) NOT NULL default '0',
  `auth_delete` tinyint(1) NOT NULL default '0',
  `auth_sticky` tinyint(1) NOT NULL default '0',
  `auth_announce` tinyint(1) NOT NULL default '0',
  `auth_vote` tinyint(1) NOT NULL default '0',
  `auth_pollcreate` tinyint(1) NOT NULL default '0',
  `auth_attachments` tinyint(1) NOT NULL default '0',
  `auth_mod` tinyint(1) NOT NULL default '0',
  KEY `group_id` (`group_id`),
  KEY `forum_id` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_banlist`
--

CREATE TABLE IF NOT EXISTS `phpbb_banlist` (
  `ban_id` mediumint(8) unsigned NOT NULL auto_increment,
  `ban_userid` mediumint(8) NOT NULL default '0',
  `ban_ip` varchar(8) NOT NULL default '',
  `ban_email` varchar(255) default NULL,
  PRIMARY KEY  (`ban_id`),
  KEY `ban_ip_user_id` (`ban_ip`,`ban_userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_categories`
--

CREATE TABLE IF NOT EXISTS `phpbb_categories` (
  `cat_id` mediumint(8) unsigned NOT NULL auto_increment,
  `cat_title` varchar(100) default NULL,
  `cat_order` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cat_id`),
  KEY `cat_order` (`cat_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_config`
--

CREATE TABLE IF NOT EXISTS `phpbb_config` (
  `config_name` varchar(255) NOT NULL default '',
  `config_value` text NOT NULL,
  PRIMARY KEY  (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_confirm`
--

CREATE TABLE IF NOT EXISTS `phpbb_confirm` (
  `confirm_id` char(32) NOT NULL default '',
  `session_id` char(32) NOT NULL default '',
  `code` char(6) NOT NULL default '',
  PRIMARY KEY  (`session_id`,`confirm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_disallow`
--

CREATE TABLE IF NOT EXISTS `phpbb_disallow` (
  `disallow_id` mediumint(8) unsigned NOT NULL auto_increment,
  `disallow_username` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`disallow_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_forums`
--

CREATE TABLE IF NOT EXISTS `phpbb_forums` (
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `cat_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_name` varchar(150) default NULL,
  `forum_desc` text,
  `forum_status` tinyint(4) NOT NULL default '0',
  `forum_order` mediumint(8) unsigned NOT NULL default '1',
  `forum_posts` mediumint(8) unsigned NOT NULL default '0',
  `forum_topics` mediumint(8) unsigned NOT NULL default '0',
  `forum_last_post_id` mediumint(8) unsigned NOT NULL default '0',
  `prune_next` int(11) default NULL,
  `prune_enable` tinyint(1) NOT NULL default '0',
  `auth_view` tinyint(2) NOT NULL default '0',
  `auth_read` tinyint(2) NOT NULL default '0',
  `auth_post` tinyint(2) NOT NULL default '0',
  `auth_reply` tinyint(2) NOT NULL default '0',
  `auth_edit` tinyint(2) NOT NULL default '0',
  `auth_delete` tinyint(2) NOT NULL default '0',
  `auth_sticky` tinyint(2) NOT NULL default '0',
  `auth_announce` tinyint(2) NOT NULL default '0',
  `auth_vote` tinyint(2) NOT NULL default '0',
  `auth_pollcreate` tinyint(2) NOT NULL default '0',
  `auth_attachments` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`forum_id`),
  KEY `forums_order` (`forum_order`),
  KEY `cat_id` (`cat_id`),
  KEY `forum_last_post_id` (`forum_last_post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_forum_prune`
--

CREATE TABLE IF NOT EXISTS `phpbb_forum_prune` (
  `prune_id` mediumint(8) unsigned NOT NULL auto_increment,
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `prune_days` smallint(5) unsigned NOT NULL default '0',
  `prune_freq` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`prune_id`),
  KEY `forum_id` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_groups`
--

CREATE TABLE IF NOT EXISTS `phpbb_groups` (
  `group_id` mediumint(8) NOT NULL auto_increment,
  `group_type` tinyint(4) NOT NULL default '1',
  `group_name` varchar(40) NOT NULL default '',
  `group_description` varchar(255) NOT NULL default '',
  `group_moderator` mediumint(8) NOT NULL default '0',
  `group_single_user` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`group_id`),
  KEY `group_single_user` (`group_single_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=846 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_posts`
--

CREATE TABLE IF NOT EXISTS `phpbb_posts` (
  `post_id` mediumint(8) unsigned NOT NULL auto_increment,
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `poster_id` mediumint(8) NOT NULL default '0',
  `post_time` int(11) NOT NULL default '0',
  `poster_ip` varchar(8) NOT NULL default '',
  `post_username` varchar(25) default NULL,
  `enable_bbcode` tinyint(1) NOT NULL default '1',
  `enable_html` tinyint(1) NOT NULL default '0',
  `enable_smilies` tinyint(1) NOT NULL default '1',
  `enable_sig` tinyint(1) NOT NULL default '1',
  `post_edit_time` int(11) default NULL,
  `post_edit_count` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `post_time` (`post_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10510 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_posts_text`
--

CREATE TABLE IF NOT EXISTS `phpbb_posts_text` (
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `bbcode_uid` varchar(10) NOT NULL default '',
  `post_subject` varchar(60) default NULL,
  `post_text` text,
  PRIMARY KEY  (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_privmsgs`
--

CREATE TABLE IF NOT EXISTS `phpbb_privmsgs` (
  `privmsgs_id` mediumint(8) unsigned NOT NULL auto_increment,
  `privmsgs_type` tinyint(4) NOT NULL default '0',
  `privmsgs_subject` varchar(255) NOT NULL default '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL default '0',
  `privmsgs_to_userid` mediumint(8) NOT NULL default '0',
  `privmsgs_date` int(11) NOT NULL default '0',
  `privmsgs_ip` varchar(8) NOT NULL default '',
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL default '1',
  `privmsgs_enable_html` tinyint(1) NOT NULL default '0',
  `privmsgs_enable_smilies` tinyint(1) NOT NULL default '1',
  `privmsgs_attach_sig` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`privmsgs_id`),
  KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  KEY `privmsgs_to_userid` (`privmsgs_to_userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1144 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_privmsgs_text`
--

CREATE TABLE IF NOT EXISTS `phpbb_privmsgs_text` (
  `privmsgs_text_id` mediumint(8) unsigned NOT NULL default '0',
  `privmsgs_bbcode_uid` varchar(10) NOT NULL default '0',
  `privmsgs_text` text,
  PRIMARY KEY  (`privmsgs_text_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_ranks`
--

CREATE TABLE IF NOT EXISTS `phpbb_ranks` (
  `rank_id` smallint(5) unsigned NOT NULL auto_increment,
  `rank_title` varchar(50) NOT NULL default '',
  `rank_min` mediumint(8) NOT NULL default '0',
  `rank_special` tinyint(1) default '0',
  `rank_image` varchar(255) default NULL,
  PRIMARY KEY  (`rank_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_search_rebuild`
--

CREATE TABLE IF NOT EXISTS `phpbb_search_rebuild` (
  `rebuild_session_id` mediumint(8) unsigned NOT NULL auto_increment,
  `start_post_id` mediumint(8) unsigned NOT NULL default '0',
  `end_post_id` mediumint(8) unsigned NOT NULL default '0',
  `start_time` int(11) NOT NULL default '0',
  `end_time` int(11) NOT NULL default '0',
  `last_cycle_time` int(11) NOT NULL default '0',
  `session_time` int(11) NOT NULL default '0',
  `session_posts` mediumint(8) unsigned NOT NULL default '0',
  `session_cycles` mediumint(8) unsigned NOT NULL default '0',
  `search_size` int(10) unsigned NOT NULL default '0',
  `rebuild_session_status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`rebuild_session_id`),
  KEY `end_post_id` (`end_post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_search_results`
--

CREATE TABLE IF NOT EXISTS `phpbb_search_results` (
  `search_id` int(11) unsigned NOT NULL default '0',
  `session_id` varchar(32) NOT NULL default '',
  `search_array` text NOT NULL,
  PRIMARY KEY  (`search_id`),
  KEY `session_id` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_search_wordlist`
--

CREATE TABLE IF NOT EXISTS `phpbb_search_wordlist` (
  `word_text` varchar(50) character set latin1 collate latin1_bin NOT NULL default '',
  `word_id` mediumint(8) unsigned NOT NULL auto_increment,
  `word_common` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`word_text`),
  KEY `word_id` (`word_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35759 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_search_wordmatch`
--

CREATE TABLE IF NOT EXISTS `phpbb_search_wordmatch` (
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `word_id` mediumint(8) unsigned NOT NULL default '0',
  `title_match` tinyint(1) NOT NULL default '0',
  KEY `post_id` (`post_id`),
  KEY `word_id` (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_sessions`
--

CREATE TABLE IF NOT EXISTS `phpbb_sessions` (
  `session_id` char(32) NOT NULL default '',
  `session_user_id` mediumint(8) NOT NULL default '0',
  `session_start` int(11) NOT NULL default '0',
  `session_time` int(11) NOT NULL default '0',
  `session_ip` char(8) NOT NULL default '0',
  `session_page` int(11) NOT NULL default '0',
  `session_logged_in` tinyint(1) NOT NULL default '0',
  `session_admin` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`session_id`),
  KEY `session_user_id` (`session_user_id`),
  KEY `session_id_ip_user_id` (`session_id`,`session_ip`,`session_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_smilies`
--

CREATE TABLE IF NOT EXISTS `phpbb_smilies` (
  `smilies_id` smallint(5) unsigned NOT NULL auto_increment,
  `code` varchar(50) default NULL,
  `smile_url` varchar(100) default NULL,
  `emoticon` varchar(75) default NULL,
  PRIMARY KEY  (`smilies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_themes`
--

CREATE TABLE IF NOT EXISTS `phpbb_themes` (
  `themes_id` mediumint(8) unsigned NOT NULL auto_increment,
  `template_name` varchar(30) NOT NULL default '',
  `style_name` varchar(30) NOT NULL default '',
  `head_stylesheet` varchar(100) default NULL,
  `body_background` varchar(100) default NULL,
  `body_bgcolor` varchar(6) default NULL,
  `body_text` varchar(6) default NULL,
  `body_link` varchar(6) default NULL,
  `body_vlink` varchar(6) default NULL,
  `body_alink` varchar(6) default NULL,
  `body_hlink` varchar(6) default NULL,
  `tr_color1` varchar(6) default NULL,
  `tr_color2` varchar(6) default NULL,
  `tr_color3` varchar(6) default NULL,
  `tr_class1` varchar(25) default NULL,
  `tr_class2` varchar(25) default NULL,
  `tr_class3` varchar(25) default NULL,
  `th_color1` varchar(6) default NULL,
  `th_color2` varchar(6) default NULL,
  `th_color3` varchar(6) default NULL,
  `th_class1` varchar(25) default NULL,
  `th_class2` varchar(25) default NULL,
  `th_class3` varchar(25) default NULL,
  `td_color1` varchar(6) default NULL,
  `td_color2` varchar(6) default NULL,
  `td_color3` varchar(6) default NULL,
  `td_class1` varchar(25) default NULL,
  `td_class2` varchar(25) default NULL,
  `td_class3` varchar(25) default NULL,
  `fontface1` varchar(50) default NULL,
  `fontface2` varchar(50) default NULL,
  `fontface3` varchar(50) default NULL,
  `fontsize1` tinyint(4) default NULL,
  `fontsize2` tinyint(4) default NULL,
  `fontsize3` tinyint(4) default NULL,
  `fontcolor1` varchar(6) default NULL,
  `fontcolor2` varchar(6) default NULL,
  `fontcolor3` varchar(6) default NULL,
  `span_class1` varchar(25) default NULL,
  `span_class2` varchar(25) default NULL,
  `span_class3` varchar(25) default NULL,
  `img_size_poll` smallint(5) unsigned default NULL,
  `img_size_privmsg` smallint(5) unsigned default NULL,
  PRIMARY KEY  (`themes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_themes_name`
--

CREATE TABLE IF NOT EXISTS `phpbb_themes_name` (
  `themes_id` smallint(5) unsigned NOT NULL default '0',
  `tr_color1_name` char(50) default NULL,
  `tr_color2_name` char(50) default NULL,
  `tr_color3_name` char(50) default NULL,
  `tr_class1_name` char(50) default NULL,
  `tr_class2_name` char(50) default NULL,
  `tr_class3_name` char(50) default NULL,
  `th_color1_name` char(50) default NULL,
  `th_color2_name` char(50) default NULL,
  `th_color3_name` char(50) default NULL,
  `th_class1_name` char(50) default NULL,
  `th_class2_name` char(50) default NULL,
  `th_class3_name` char(50) default NULL,
  `td_color1_name` char(50) default NULL,
  `td_color2_name` char(50) default NULL,
  `td_color3_name` char(50) default NULL,
  `td_class1_name` char(50) default NULL,
  `td_class2_name` char(50) default NULL,
  `td_class3_name` char(50) default NULL,
  `fontface1_name` char(50) default NULL,
  `fontface2_name` char(50) default NULL,
  `fontface3_name` char(50) default NULL,
  `fontsize1_name` char(50) default NULL,
  `fontsize2_name` char(50) default NULL,
  `fontsize3_name` char(50) default NULL,
  `fontcolor1_name` char(50) default NULL,
  `fontcolor2_name` char(50) default NULL,
  `fontcolor3_name` char(50) default NULL,
  `span_class1_name` char(50) default NULL,
  `span_class2_name` char(50) default NULL,
  `span_class3_name` char(50) default NULL,
  PRIMARY KEY  (`themes_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_topics`
--

CREATE TABLE IF NOT EXISTS `phpbb_topics` (
  `topic_id` mediumint(8) unsigned NOT NULL auto_increment,
  `forum_id` smallint(8) unsigned NOT NULL default '0',
  `topic_title` char(60) NOT NULL default '',
  `topic_poster` mediumint(8) NOT NULL default '0',
  `topic_time` int(11) NOT NULL default '0',
  `topic_views` mediumint(8) unsigned NOT NULL default '0',
  `topic_replies` mediumint(8) unsigned NOT NULL default '0',
  `topic_status` tinyint(3) NOT NULL default '0',
  `topic_vote` tinyint(1) NOT NULL default '0',
  `topic_type` tinyint(3) NOT NULL default '0',
  `topic_first_post_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_last_post_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_moved_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_id_point` int(11) NOT NULL default '0',
  PRIMARY KEY  (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_moved_id` (`topic_moved_id`),
  KEY `topic_status` (`topic_status`),
  KEY `topic_type` (`topic_type`),
  KEY `topic_id_point` (`topic_id_point`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3287 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_topics_watch`
--

CREATE TABLE IF NOT EXISTS `phpbb_topics_watch` (
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) NOT NULL default '0',
  `notify_status` tinyint(1) NOT NULL default '0',
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_status` (`notify_status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_users`
--

CREATE TABLE IF NOT EXISTS `phpbb_users` (
  `user_id` mediumint(8) NOT NULL default '0',
  `user_active` tinyint(1) default '1',
  `username` varchar(25) NOT NULL default '',
  `user_password` varchar(32) NOT NULL default '',
  `user_session_time` int(11) NOT NULL default '0',
  `user_session_page` smallint(5) NOT NULL default '0',
  `user_lastvisit` int(11) NOT NULL default '0',
  `user_regdate` int(11) NOT NULL default '0',
  `user_level` tinyint(4) default '0',
  `user_posts` mediumint(8) unsigned NOT NULL default '0',
  `user_timezone` decimal(5,2) NOT NULL default '0.00',
  `user_style` tinyint(4) default NULL,
  `user_lang` varchar(255) default NULL,
  `user_dateformat` varchar(14) NOT NULL default 'd M Y H:i',
  `user_new_privmsg` smallint(5) unsigned NOT NULL default '0',
  `user_unread_privmsg` smallint(5) unsigned NOT NULL default '0',
  `user_last_privmsg` int(11) NOT NULL default '0',
  `user_emailtime` int(11) default NULL,
  `user_viewemail` tinyint(1) default NULL,
  `user_attachsig` tinyint(1) default NULL,
  `user_allowhtml` tinyint(1) default '1',
  `user_allowbbcode` tinyint(1) default '1',
  `user_allowsmile` tinyint(1) default '1',
  `user_allowavatar` tinyint(1) NOT NULL default '1',
  `user_allow_pm` tinyint(1) NOT NULL default '1',
  `user_allow_viewonline` tinyint(1) NOT NULL default '1',
  `user_notify` tinyint(1) NOT NULL default '1',
  `user_notify_pm` tinyint(1) NOT NULL default '0',
  `user_popup_pm` tinyint(1) NOT NULL default '0',
  `user_rank` int(11) default '0',
  `user_avatar` varchar(100) default NULL,
  `user_avatar_type` tinyint(4) NOT NULL default '0',
  `user_email` varchar(255) default NULL,
  `user_icq` varchar(15) default NULL,
  `user_website` varchar(100) default NULL,
  `user_from` varchar(100) default NULL,
  `user_sig` text,
  `user_sig_bbcode_uid` varchar(10) default NULL,
  `user_aim` varchar(255) default NULL,
  `user_yim` varchar(255) default NULL,
  `user_msnm` varchar(255) default NULL,
  `user_occ` varchar(100) default NULL,
  `user_interests` varchar(255) default NULL,
  `user_actkey` varchar(32) default NULL,
  `user_newpasswd` varchar(32) default NULL,
  `user_niveau_moderation` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  KEY `user_session_time` (`user_session_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_user_group`
--

CREATE TABLE IF NOT EXISTS `phpbb_user_group` (
  `group_id` mediumint(8) NOT NULL default '0',
  `user_id` mediumint(8) NOT NULL default '0',
  `user_pending` tinyint(1) default NULL,
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_vote_desc`
--

CREATE TABLE IF NOT EXISTS `phpbb_vote_desc` (
  `vote_id` mediumint(8) unsigned NOT NULL auto_increment,
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `vote_text` text NOT NULL,
  `vote_start` int(11) NOT NULL default '0',
  `vote_length` int(11) NOT NULL default '0',
  PRIMARY KEY  (`vote_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_vote_results`
--

CREATE TABLE IF NOT EXISTS `phpbb_vote_results` (
  `vote_id` mediumint(8) unsigned NOT NULL default '0',
  `vote_option_id` tinyint(4) unsigned NOT NULL default '0',
  `vote_option_text` varchar(255) NOT NULL default '',
  `vote_result` int(11) NOT NULL default '0',
  KEY `vote_option_id` (`vote_option_id`),
  KEY `vote_id` (`vote_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_vote_voters`
--

CREATE TABLE IF NOT EXISTS `phpbb_vote_voters` (
  `vote_id` mediumint(8) unsigned NOT NULL default '0',
  `vote_user_id` mediumint(8) NOT NULL default '0',
  `vote_user_ip` char(8) NOT NULL default '',
  KEY `vote_id` (`vote_id`),
  KEY `vote_user_id` (`vote_user_id`),
  KEY `vote_user_ip` (`vote_user_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phpbb_words`
--

CREATE TABLE IF NOT EXISTS `phpbb_words` (
  `word_id` mediumint(8) unsigned NOT NULL auto_increment,
  `word` char(100) NOT NULL default '',
  `replacement` char(100) NOT NULL default '',
  PRIMARY KEY  (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `id_point` int(10) unsigned NOT NULL auto_increment,
  `id_point_gps` int(11) NOT NULL default '0',
  `nom` varchar(80) NOT NULL default '',
  `id_point_type` int(11) NOT NULL default '0',
  `places` int(11) unsigned NOT NULL default '0',
  `remark` text NOT NULL,
  `proprio` varchar(255) NOT NULL default '',
  `date_insertion` bigint(20) NOT NULL default '0',
  `auteur_derniere_modification` varchar(255) NOT NULL,
  `date_derniere_modification` date NOT NULL default '0000-00-00',
  `id_auteur_derniere_modification` int(11) NOT NULL default '0',
  `modele` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_point`),
  KEY `nom` (`nom`),
  KEY `modele` (`modele`),
  KEY `places` (`places`),
  KEY `id_point_type` (`id_point_type`),
  KEY `id_point_gps` (`id_point_gps`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='l''abri' AUTO_INCREMENT=2633 ;

-- --------------------------------------------------------

--
-- Structure de la table `points_gps`
--

CREATE TABLE IF NOT EXISTS `points_gps` (
  `id_point_gps` int(11) NOT NULL auto_increment,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `altitude` int(11) NOT NULL,
  `acces` text NOT NULL,
  `id_type_precision_gps` int(11) NOT NULL,
  PRIMARY KEY  (`id_point_gps`),
  KEY `latitude` (`latitude`),
  KEY `altitude` (`altitude`),
  KEY `longitude` (`longitude`),
  KEY `id_type_precision_gps` (`id_type_precision_gps`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3812 ;

-- --------------------------------------------------------

--
-- Structure de la table `point_type`
--

CREATE TABLE IF NOT EXISTS `point_type` (
  `id_point_type` int(10) unsigned NOT NULL auto_increment,
  `article_demonstratif` varchar(20) NOT NULL default '',
  `article_defini` varchar(20) NOT NULL default '',
  `article_partitif_point_type` varchar(20) NOT NULL default '',
  `nom_type` varchar(50) NOT NULL default '',
  `equivalent_places` varchar(50) NOT NULL default '',
  `equivalent_proprio` varchar(200) NOT NULL default '',
  `equivalent_orientation` varchar(255) NOT NULL default '',
  `nom_icone` varchar(50) NOT NULL default '',
  `ech_max` int(11) NOT NULL default '50',
  `importance` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_point_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 COMMENT='type (sommet, ville, via ferat, ...)' AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Structure de la table `polygones`
--

CREATE TABLE IF NOT EXISTS `polygones` (
  `id_polygone` int(11) NOT NULL auto_increment,
  `id_polygone_type` tinyint(2) NOT NULL default '1',
  `article_partitif` varchar(20) NOT NULL default '4',
  `nom_polygone` varchar(255) NOT NULL default '',
  `source` varchar(255) NOT NULL default '',
  `url_exterieure` varchar(255) NOT NULL,
  PRIMARY KEY  (`id_polygone`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=1 AUTO_INCREMENT=315 ;

-- --------------------------------------------------------

--
-- Structure de la table `polygone_type`
--

CREATE TABLE IF NOT EXISTS `polygone_type` (
  `id_polygone_type` tinyint(2) NOT NULL auto_increment,
  `art_dem_poly` varchar(6) NOT NULL default '',
  `art_def_poly` varchar(6) NOT NULL default '',
  `type_polygone` varchar(32) NOT NULL default '',
  `ordre_taille` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_polygone_type`),
  KEY `ordre_taille` (`ordre_taille`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_precision_gps`
--

CREATE TABLE IF NOT EXISTS `type_precision_gps` (
  `id_type_precision_gps` int(11) NOT NULL auto_increment,
  `nom_precision_gps` varchar(255) NOT NULL default '',
  `ordre` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_type_precision_gps`),
  KEY `ordre` (`ordre`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
