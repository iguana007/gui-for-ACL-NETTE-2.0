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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

INSERT INTO `gui_acl_privileges` (`id`, `key_name`, `name`, `comment`) VALUES
(1, 'acl_access', 'Acl Access', 'Access to the GUI for Acl.');


-- -----------------------------------------------------------------------


CREATE TABLE `gui_acl_resources` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `key_name` varchar(64) collate utf8_czech_ci NOT NULL,
  `name` varchar(64) collate utf8_czech_ci NOT NULL,
  `comment` varchar(250) collate utf8_czech_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `key_name` (`key_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

INSERT INTO `gui_acl_resources` (`id`, `parent_id`, `key_name`, `name`, `comment`) VALUES
(1, NULL, 'acl_permission', 'Acl Permission', 'GUI for Acl');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=3 ;

INSERT INTO `gui_acl_roles` (`id`, `parent_id`, `key_name`, `name`, `comment`) VALUES
(1, NULL, 'acl_admin', 'Acl Admin', 'Has access to the GUI for ACL.'),
(2, NULL, 'guest', 'Guest', 'Role of anonymous user.');

ALTER TABLE `gui_acl_roles`
ADD CONSTRAINT `gui_acl_roles_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `gui_acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


-- -----------------------------------------------------------------------


CREATE TABLE `gui_users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) collate utf8_czech_ci NOT NULL,
  `password` varchar(250) collate utf8_czech_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

INSERT INTO `gui_users` (`id`, `name`, `password`) VALUES
(1, 'Admin', 'e3afed0047b08059d0fada10f400c1e5');


-- -----------------------------------------------------------------------


CREATE TABLE `gui_users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `gui_users_roles` (`user_id`, `role_id`) VALUES
(1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

INSERT INTO `gui_acl` (`id`, `role_id`, `privilege_id`, `resource_id`, `access`) VALUES
(1, 1, 1, 1, true);

ALTER TABLE `gui_acl`
ADD CONSTRAINT `gui_acl_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `gui_acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `gui_acl`
ADD CONSTRAINT `gui_acl_ibfk_1` FOREIGN KEY (`privilege_id`) REFERENCES `gui_acl_privileges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `gui_acl`
ADD CONSTRAINT `gui_acl_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `gui_acl_resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
