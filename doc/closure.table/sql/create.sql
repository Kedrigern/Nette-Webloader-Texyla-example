
#
# CLEAN DB
#


SET foreign_key_checks = 0;
DROP TRIGGER IF EXISTS `category_root_node`;
DROP TRIGGER IF EXISTS `category_closure_root_node`;
DROP TABLE IF EXISTS `category`, `category_closure`;


CREATE TABLE `category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(15) NOT NULL,
  `description` text NULL
) COMMENT='Table of categories';


CREATE TABLE `category_closure` (
  `ancestor` int unsigned NOT NULL,
  `descendant` int unsigned NOT NULL,
  `depth` int unsigned NOT NULL
) COMMENT='Table with categories relations';

ALTER TABLE `category_closure`
ADD FOREIGN KEY (`ancestor`) REFERENCES `category` (`id`);
ALTER TABLE `category_closure`
ADD FOREIGN KEY (`descendant`) REFERENCES `category` (`id`);


DROP VIEW `category_parent_reference`;
CREATE VIEW `category_parent _reference` AS
	select `category`.`*,
		NULL AS `parent` 
		from `category` 
		where (`category`.`id` = 1) 
	union 
	select `c`.*, `cc`.`ancestor` 
	from (`category` `c` 
		join `category_closure` `cc` 
		on((`c`.`id` = `cc`.`descendant`)))
	 where (`cc`.`depth` = 1);


#
# INSERT DEFAULT (TOP NODE) VALUES
#

INSERT INTO `category` (`id`, `name`, `description`) VALUES (1, 'top', 'Default top category.'); # top node
INSERT INTO `category_closure` VALUES (1, 1, 0);         # loop
# NOTE: There is some issue if inserts are after create triggers...



#
# CREATE TRIGGERS
#

DELIMITER ;;
CREATE TRIGGER `category_root_node` BEFORE DELETE ON `category` FOR EACH ROW
BEGIN
	IF OLD.id = 1 THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'DELETE canceled. Because you try to delete root node.'; 
	END IF;
END;;
DELIMITER ;


DELIMITER ;;
CREATE TRIGGER `category_closure_root_node` BEFORE DELETE ON `category_closure` FOR EACH ROW
BEGIN
        IF OLD.ancestor = 1 && OLD.descendant = 1 && OLD.depth = 0 THEN
	        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'DELETE canceled. Because you try to delete root node.';
        END IF;
END;;
DELIMITER ;
