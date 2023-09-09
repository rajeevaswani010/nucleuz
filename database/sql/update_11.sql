INSERT INTO db_version
(db_id,name,descr)
VALUES
(11,'database version 0.1','added office setting parameters')
;


ALTER TABLE offices ADD COLUMN license_expiry_in_month ENUM('1','2','3') DEFAULT '3' NOT NULL;
ALTER TABLE offices ADD COLUMN residence_expiry_in_month ENUM('1','2','3') DEFAULT '3' NOT NULL;
ALTER TABLE offices ADD COLUMN reason_for_vehicle_replacement ENUM('Others','Issue-In-Vehicle','Upgrade-The-Vehicle') DEFAULT 'Others' NOT NULL;
ALTER TABLE offices ADD COLUMN page VARCHAR(256) DEFAULT NULL;

