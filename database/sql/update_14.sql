INSERT INTO db_version
(db_id,name,descr)
VALUES
(14,'database version 0.1','added additional columns to office and customer table')
;

ALTER TABLE offices
CHANGE address addr_line_1 VARCHAR(255)
;

ALTER TABLE offices
ADD COLUMN addr_line_2 VARCHAR(255) DEFAULT '',
ADD COLUMN city VARCHAR(30) DEFAULT '',
ADD COLUMN country VARCHAR(30) DEFAULT '',
ADD COLUMN zip VARCHAR(10) DEFAULT '',
ADD COLUMN mobile_primary VARCHAR(30) DEFAULT '',
ADD COLUMN mobile_secondary VARCHAR(30) DEFAULT ''
;

ALTER TABLE customers
ADD COLUMN city VARCHAR(30) DEFAULT '',
ADD COLUMN country VARCHAR(30) DEFAULT '',
ADD COLUMN passport_num VARCHAR(20) DEFAULT '',
ADD COLUMN passport_valid_upto DATE,
ADD COLUMN id_num VARCHAR(30) DEFAULT '',
ADD COLUMN id_valid_upto DATE,
ADD COLUMN driving_license_num VARCHAR(30) DEFAULT '',
ADD COLUMN driving_lic_issuedby VARCHAR(30) DEFAULT '',
ADD COLUMN driving_lic_valid_upto DATE
;

ALTER TABLE vehicles
ADD COLUMN color VARCHAR(15) DEFAULT ''
;

ALTER TABLE pricings
CHANGE COLUMN car_type car_type VARCHAR(30) DEFAULT '',
ADD COLUMN annual_pricing VARCHAR(10) DEFAULT ''
;

CREATE TABLE `vehicle_images` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `link` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
);


