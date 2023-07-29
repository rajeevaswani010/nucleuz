INSERT INTO db_version
(db_id,name,descr)
VALUES
(7,'database version 0.1','added column total into bookings table')
;


ALTER TABLE bookings ADD COLUMN total double DEFAULT NULL AFTER discount_note;
ALTER TABLE bookings ADD COLUMN residence_expiry_date date DEFAULT NULL AFTER total;
