INSERT INTO db_version
(db_id,name,descr)
VALUES
(9,'database version 0.1','update last_name to be nullable')
;

ALTER TABLE customers MODIFY COLUMN last_name VARCHAR(255) NULL;
