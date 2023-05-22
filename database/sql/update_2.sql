INSERT INTO db_version
(db_id,name,descr)
VALUES
(2,'database version 0.1','added column booking_id into booking_invites table to track bookings for customer registration')
;


ALTER TABLE booking_invites ADD COLUMN booking_id int AFTER customer_id;
