INSERT INTO db_version
(db_id,name,descr)
VALUES
(8,'database version 0.1','added office setting parameters')
;


ALTER TABLE offices ADD COLUMN billing_method ENUM('FIXED','Hybrid','Pro-Rata') DEFAULT 'Hybrid' NOT NULL;
ALTER TABLE offices ADD COLUMN logo VARCHAR(256) DEFAULT NULL;
ALTER TABLE offices ADD COLUMN terms_conditions VARCHAR(2048) DEFAULT NULL;

