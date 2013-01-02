-- Adminer 3.6.2 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DELIMITER ;;

DROP PROCEDURE IF EXISTS `category_delete_node`;;
CREATE PROCEDURE `category_delete_node`(IN `node` int unsigned)
BEGIN
  UPDATE category_closure SET depth = depth-1
   WHERE ancestor != descendant
     AND descendant IN (SELECT descendant FROM (SELECT * FROM category_closure) as did WHERE ancestor = node);
  DELETE FROM category_closure WHERE ancestor = node OR descendant = node;
  DELETE FROM category WHERE id = node;
END;;

DROP PROCEDURE IF EXISTS `category_delete_subtree`;;
CREATE PROCEDURE `category_delete_subtree`(IN `node` int unsigned)
BEGIN
  DELETE cc_a
    FROM category_closure cc_a
    JOIN category_closure cc_d USING (descendant) WHERE cc_d.ancestor = node;
  DELETE
FROM category
WHERE id = node;
 END;;

DROP PROCEDURE IF EXISTS `category_insert_leaf`;;
CREATE PROCEDURE `category_insert_leaf`(IN `name` varchar(15), IN `parent` int unsigned)
BEGIN
  DECLARE newid BIGINT;
  INSERT INTO `category` (name) VALUES (name);
  SET newid = LAST_INSERT_ID();
  INSERT INTO `category_closure` VALUES ( newid, newid, 0 );
  INSERT INTO `category_closure` (ancestor, descendant, depth ) SELECT ancestor, newid, depth+1 FROM `category_closure` WHERE descendant = parent;
END;;

DROP PROCEDURE IF EXISTS `category_move_subtree`;;
CREATE PROCEDURE `category_move_subtree`(IN `root` int unsigned, IN `newroot` int unsigned)
BEGIN
  DELETE a FROM category_closure AS a
   JOIN category_closure AS d ON a.descendant = d.descendant
   LEFT JOIN category_closure AS x
   ON x.ancestor = d.ancestor AND x.descendant = a.ancestor
   WHERE d.ancestor = root AND x.ancestor IS NULL;

   INSERT INTO category_closure (ancestor, descendant, depth)
   SELECT supertree.ancestor, subtree.descendant,
   supertree.depth+subtree.depth+1
   FROM category_closure AS supertree JOIN category_closure AS subtree
   WHERE subtree.ancestor = root
   AND supertree.descendant = newroot;
END;;

DELIMITER ;

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `keywords` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `insert_datetime` datetime NOT NULL,
  `last_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content_texy` text COLLATE utf8_czech_ci NOT NULL,
  `content_html` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `article` (`id`, `name`, `keywords`, `user_id`, `insert_datetime`, `last_modification`, `content_texy`, `content_html`) VALUES
(1,	'First article',	'first article empty',	1,	'2012-11-02 23:07:52',	'2013-01-02 21:16:00',	'...',	'...\r\n'),
(2,	'Second article',	'article empty',	NULL,	'2012-11-03 00:08:38',	'2013-01-02 22:11:19',	'*Ahoj* **světe**,\r\n\r\njsi rád, že mě vidíš?\r\n\r\nnadpis\r\n######',	'\n<p><em>Ahoj</em> <strong>světe</strong>,</p>\n\n<p>jsi rád, že mě vidíš?</p>\n\n<h1>nadpis</h1>\n'),
(3,	'Third article',	'',	2,	'2013-01-02 14:40:27',	'2013-01-02 22:10:32',	'Lorem ipsum',	'<p>Lorem ipsum</p>');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `surname` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `mail` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `address_id` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `user` (`id`, `name`, `surname`, `mail`, `address_id`) VALUES
(1,	'Ivan',	'Ivánovič',	'ivan@ivan.org',	 NULL),
(2,	'Astor','Brown',	'astor@example.com', NULL);
