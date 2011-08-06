--
-- MySQL database dump
--

SET NAMES utf8;

CREATE TABLE `gui_acl_privileges` (
  `id` int(11) NOT NULL auto_increment,
  `key_name` varchar(64) collate utf8_czech_ci NOT NULL,
  `name` varchar(64) collate utf8_czech_ci NOT NULL,
  `comment` varchar(250) collate utf8_czech_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `key_name` (`key_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=5 ;

INSERT INTO `gui_acl_privileges` (`id`, `key_name`, `name`, `comment`) VALUES
(1, 'acl_access', 'Acl Access', 'Access to the GUI for Acl.'),
(3, 'sprava', 'Správa', ''),
(4, 'nahled', 'Náhled', '');


-- -----------------------------------------------------------------------


CREATE TABLE `gui_acl_resources` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `key_name` varchar(64) collate utf8_czech_ci NOT NULL,
  `name` varchar(64) collate utf8_czech_ci NOT NULL,
  `comment` varchar(250) collate utf8_czech_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `key_name` (`key_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=23 ;

INSERT INTO `gui_acl_resources` (`id`, `key_name`, `parent_id`, `name`, `comment`) VALUES
(1, 'acl_permission', NULL, 'Acl Permission', 'GUI for Acl'),
(2, 'ceska_sporitelna', NULL, 'Česká Spořitelna', ''),
(3, 'oblast_zlin', 2, 'Oblast Zlín', ''),
(4, 'oblast_praha', 2, 'Oblash Praha', ''),
(5, 'oblast_usti', 2, 'Oblash Ústí', ''),
(6, 'zlinsky_region', 3, 'Zlínský region', ''),
(7, 'kromerizsky_region', 3, 'Kroměřížský region', ''),
(8, 'vsetinsky_region', 3, 'Vsetínský region', ''),
(9, 'pobocka_zarami', 6, 'Pobočka Zarámí', ''),
(10, 'pobocka_tr_t_bati', 6, 'Pobočka Tř. T. Bati', ''),
(11, 'pobocka_j_svahy', 6, 'Pobočka Jižní Svahy', ''),
(12, 'pobocka_slusovice', 6, 'Pobočka Slušovice', ''),
(13, 'pobocka_frystak', 6, 'Pobočka Fryšták', ''),
(14, 'stavebni_sporitelna', 2, 'Stavební Spořitelna', ''),
(15, 'penzijni_fond', 2, 'Penzijní fond ČS', ''),
(16, 'ceska_pojistovna', 2, 'České pojišťovna', ''),
(17, 'zlinsky_kraj', 16, 'Zlínský kraj', ''),
(19, 'moravskoslezsky_kraj', 16, 'Moravskoslezský kraj', ''),
(18, 'jihomoravsky_kraj', 16, 'Jihomoravský kraj', ''),
(20, 'zlin', 17, 'Zlín', ''),
(21, 'vsetin', 17, 'Vsetín', ''),
(22, 'kromeriz', 17, 'Kroměříž', '');

ALTER TABLE `gui_acl_resources`
ADD CONSTRAINT `gui_acl_resources_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `gui_acl_resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


-- -----------------------------------------------------------------------


CREATE TABLE `gui_acl_roles` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `key_name` varchar(64) collate utf8_czech_ci NOT NULL,
  `name` varchar(64) collate utf8_czech_ci NOT NULL,
  `comment` varchar(250) collate utf8_czech_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `key_name` (`key_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=20 ;

INSERT INTO `gui_acl_roles` (`id`, `parent_id`, `key_name`, `name`, `comment`) VALUES
(1, NULL, 'acl_admin', 'Acl Admin', 'Has access to the GUI for ACL.'),
(2, NULL, 'generalni_reditel', 'Generální ředitel', ''),
(3, 2, '1_namestek', '1. náměstek', ''),
(4, 2, '2_namestek', '2. náměstek', ''),
(6, 3, 'financni_rizeni', 'Finanční řízení', ''),
(7, 3, 'rizeni_majetku', 'Řízení majetku', ''),
(8, 4, 'podpora_prodeje', 'Podpora prodeje', ''),
(9, 4, 'usek_bezpecnosti', 'Úsek bezpečnosti', ''),
(10, 4, 'informacni_technologie', 'Informační technologie', ''),
(11, 10, 'administrator', 'Administrátor', ''),
(12, 11, 'it_technik', 'IT Technik', ''),
(16, NULL, 'guest', 'Guest', 'Role of anonymous user.'),
(17, NULL, 'financni_rizeni_2', 'Finanční řízení 2', ''),
(18, 17, '1_namestek_2', '1. náměstek 2', ''),
(19, 18, 'generalni_reditel_2', 'Generální ředitel 2', '');

ALTER TABLE `gui_acl_roles`
ADD CONSTRAINT `gui_acl_roles_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `gui_acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


-- -----------------------------------------------------------------------


CREATE TABLE `gui_users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) collate utf8_czech_ci NOT NULL,
  `password` varchar(250) collate utf8_czech_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=37 ;

INSERT INTO `gui_users` (`id`, `name`, `password`) VALUES
(1, 'Admin', 'e3afed0047b08059d0fada10f400c1e5'),
(22, 'Tom', 'd9ffaca46d5990ec39501bcdf22ee7a1'),
(23, 'Ota', 'ce2f7df9517a478394cd6f6954e8237a'),
(24, 'Petr', 'e3407b95ce4f9d4c42415ca35513b903'),
(25, 'Martin', '81d6f316d169150d0e8733866c38684d'),
(26, 'Kristyna', 'd74ba6d91abd272d509cfe11cdef9171'),
(27, 'Dasa', 'b9bd1167a96c54236d2740d8dc41e410'),
(28, 'Karel', 'c63b94714facab1f24e9b96d72436d77'),
(29, 'Jirka', '01b61ad8993fced8614cfa80289d4483'),
(30, 'Ales', 'ba73c1cbc7244121edd7a02a70083cda'),
(31, 'Roman', 'b5df36ac79aa6391ffb432b9e5ad7880'),
(32, 'Jakub', '8cc6fcef7d3e41ff8bda76c7aefff7a2'),
(33, 'Ivo', 'd51a04fb46898421a81f0016993b1cb0'),
(34, 'Honza', '33430040b67a6d9eb31b4463bc358738'),
(35, 'Marek', '091cbaf8fc9a3d12ce957d6228b3c04c'),
(36, 'Jana', 'f1a7074f7ad4776b17046a2abcc6d4d4');


-- -----------------------------------------------------------------------


CREATE TABLE `gui_users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `gui_users_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(22, 1),
(22, 2),
(23, 3),
(24, 4),
(27, 6),
(26, 7),
(29, 10),
(28, 11),
(25, 12),
(30, 7),
(30, 12),
(34, 17),
(33, 18),
(32, 19);

ALTER TABLE `gui_users_roles`
ADD CONSTRAINT `gui_users_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `gui_acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `gui_users_roles`
ADD CONSTRAINT `gui_users_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `gui_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


-- -----------------------------------------------------------------------

CREATE TABLE `gui_acl` (
  `id` int(11) NOT NULL auto_increment,
  `role_id` int(11) NOT NULL,
  `privilege_id` int(11) default NULL,
  `resource_id` int(11) default NULL,
  `access` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

INSERT INTO `gui_acl` (`role_id`, `privilege_id`, `resource_id`, `access`) VALUES
(1, 1, 1, true),
(2, 4, 2, true),
(3, 3, 4, true),
(3, 3, 5, true),
(3, 3, 3, true),
(6, 3, 4, false),
(6, 3, 5, false),
(6, 3, 3, false),
(6, 3, 7, true),
(6, 3, 8, true),
(6, 3, 6, true),
(7, 3, 7, false),
(7, 3, 8, false),
(7, 3, 6, false),
(7, 3, 13, true),
(7, 3, 11, true),
(7, 3, 12, true),
(7, 3, 10, true),
(7, 3, 9, true),
(7, 3, 4, false),
(7, 3, 5, false),
(7, 3, 3, false),
(10, 3, 18, true),
(10, 3, 19, true),
(10, 3, 17, true),
(12, 3, 18, false),
(12, 3, 19, false),
(12, 3, 17, false),
(12, 3, 22, true),
(12, 3, 21, true),
(12, 3, 20, true),
(17, 4, 2, true),
(17, 3, 7, true),
(17, 3, 8, true),
(17, 3, 6, true),
(18, 3, 4, true),
(18, 3, 5, true),
(18, 3, 3, true),
(19, 3, 4, false),
(19, 3, 5, false),
(19, 3, 3, false),
(19, 3, 7, false),
(19, 3, 8, false),
(19, 3, 6, false);

ALTER TABLE `gui_acl`
ADD CONSTRAINT `gui_acl_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `gui_acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `gui_acl`
ADD CONSTRAINT `gui_acl_ibfk_1` FOREIGN KEY (`privilege_id`) REFERENCES `gui_acl_privileges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `gui_acl`
ADD CONSTRAINT `gui_acl_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `gui_acl_resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
