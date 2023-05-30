INSERT INTO db_version
(db_id,name,descr)
VALUES
(4,'database version 0.1','added column booking_id to table booking_invite')
;

ALTER TABLE booking_invites
Add COLUMN booking_id int(11) DEFAULT NULL AFTER customer_id;

