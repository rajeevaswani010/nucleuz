INSERT INTO db_version
(db_id,name,descr)
VALUES
(13,'database version 0.1','vehicle status added')
;

ALTER TABLE vehicles ADD COLUMN status int(11) DEFAULT 1;

ALTER TABLE booking_images ADD COLUMN booking_vehicle_id INT NOT NULL;
ALTER TABLE booking_images DROP COLUMN vehicle_id;
Alter table booking_vehicles add column km_driven bigint default null;
ALTER TABLE `bookings` ADD `cur_booking_vehicle_id` INT(11) NULL DEFAULT NULL AFTER `vehicle_id`;



