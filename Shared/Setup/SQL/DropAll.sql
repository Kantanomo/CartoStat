SELECT * FROM (
  SELECT CONCAT('DROP TABLE ', GROUP_CONCAT(table_name) , ';')
  FROM INFORMATION_SCHEMA.TABLES
  WHERE table_name LIKE 'CS_%'
) a INTO @mystmt;

PREPARE mystatement FROM @mystmt;
EXECUTE mystatement;