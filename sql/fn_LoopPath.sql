CREATE FUNCTION `fn_LoopPath`(`varId` INT(11)) RETURNS varchar(1000) CHARSET utf8
    READS SQL DATA
    SQL SECURITY INVOKER
BEGIN

DECLARE varParentId INT(11) DEFAULT 1;
DECLARE varPath VARCHAR(128) DEFAULT '';
DECLARE varRetPath VARCHAR(1000) DEFAULT '';


WHILE (varPath IS NOT NULL) DO

SELECT a.g_parentId, b.g_pathComponent
INTO varParentId, varPath
FROM g2_ChildEntity a
INNER JOIN g2_FileSystemEntity b ON a.g_id = b.g_id
WHERE a.g_id = varId
LIMIT 1;

SET varId = varParentId;

IF (varPath IS NOT NULL) THEN 
  IF varRetPath != '' THEN SET varRetPath = CONCAT('/', varRetPath);
	END IF;
  SET varRetPath = CONCAT(varPath, varRetPath);
END IF;

END WHILE;


RETURN varRetPath;


END