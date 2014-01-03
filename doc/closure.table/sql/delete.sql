
DROP PROCEDURE IF EXISTS `category_delete_node`;
DELIMITER ;;
CREATE PROCEDURE `category_delete_node` (IN `node` int unsigned)
BEGIN
  UPDATE category_closure SET depth = depth-1
   WHERE ancestor != descendant
     AND descendant IN (SELECT descendant FROM (SELECT * FROM category_closure) as did WHERE ancestor = node);
  DELETE FROM category_closure WHERE ancestor = node OR descendant = node;
  DELETE FROM category WHERE id = node;
END;;
DELIMITER ;

#TODO: Does not delete nodes from category expect root
DROP PROCEDURE IF EXISTS  `category_delete_subtree`;
DELIMITER ;;
CREATE PROCEDURE `category_delete_subtree` (IN `node` int unsigned)
BEGIN
	SET foreign_key_checks = 0;
	DELETE 
		FROM category
		WHERE id IN (
			SELECT cc_a
			FROM category_closure cc_a
	    JOIN category_closure cc_d USING (descendant) WHERE cc_d.ancestor = node
		)
  DELETE cc_a 
    FROM category_closure cc_a 
    JOIN category_closure cc_d USING (descendant) WHERE cc_d.ancestor = node;
 # DELETE 
#		FROM category 
#		WHERE id = node;
	SET foreign_key_checks = 1;
END;;
DELIMITER ;
