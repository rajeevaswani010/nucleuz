INSERT INTO db_version
(db_id,name,descr)
VALUES
(15,'database version 0.1','vehicle table unique constraint on reg_no removed, added unique company+reg_no')
;

ALTER TABLE `vehicles`
    DROP INDEX vehicles_unique
    ;

ALTER TABLE `vehicles`
    ADD UNIQUE KEY `unique_company_vehicle` (`company_id`,`reg_no`)
    ;




