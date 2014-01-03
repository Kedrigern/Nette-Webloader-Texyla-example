
DROP PROCEDURE IF EXISTS `category_insert_leaf`;
DELIMITER ;;
CREATE PROCEDURE `category_insert_leaf` (IN `name` varchar(15), IN `parent` int unsigned)
BEGIN
  DECLARE newid BIGINT;

  INSERT INTO `category` (name) VALUES (name);
  SET newid = LAST_INSERT_ID();
  INSERT INTO `category_closure` VALUES ( newid, newid, 0 );
  INSERT INTO `category_closure` (ancestor, descendant, depth ) SELECT ancestor, newid, depth+1 FROM `category_closure` WHERE descendant = parent;
END;;
DELIMITER ;

DROP PROCEDURE IF EXISTS `category_insert_node`;
DELIMITER ;;
CREATE PROCEDURE `category_insert_node` (IN `name` varchar(15), IN `parent` int unsigned)
BEGIN
	
END;;
DELIMITER ;


DROP PROCEDURE IF EXISTS `category_truncate`;
DELIMITER ;;
CREATE PROCEDURE `category_truncate` ()
BEGIN
	SET foreign_key_checks = 0;

	TRUNCATE TABLE `category`;
	TRUNCATE TABLE `category_closure`;

	INSERT INTO `category` (`id`, `name`, `description`) VALUES (1, 'top', 'Default top category.'); # top node
	INSERT INTO `category_closure` VALUES (1, 1, 0); # loop
END;;
DELIMITER ;

