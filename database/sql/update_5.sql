INSERT INTO db_version
(db_id,name,descr)
VALUES
(5,'database version 0.1','remove column booking_id to table booking_invite and add colum requirements which stores customers requirements in string delimited format')
;

ALTER TABLE booking_invites DROP COLUMN booking_id;

ALTER TABLE booking_invites Add COLUMN requirements VARCHAR(1024) DEFAULT NULL AFTER updated_at;

ALTER TABLE notifications MODIFY COLUMN linked_id INT NULL;
