INSERT INTO db_version
(db_id,name,descr)
VALUES
(3,'database version 0.1','added unique for vehicles table param to avoid data duplication')
;

ALTER TABLE vehicles
ADD CONSTRAINT vehicles_unique UNIQUE (reg_no);

