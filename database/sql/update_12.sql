INSERT INTO db_version
(db_id,name,descr)
VALUES
(12,'database version 0.1','vehicle replacement changes')
;

CREATE TABLE `booking_vehicles` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `car_type` varchar(255) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `variant` varchar(255) NOT NULL,
  `reg_no` varchar(255) NOT NULL,
  `pickup_date_time` timestamp NULL DEFAULT NULL,
  `dropoff_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `km_reading_pickup` varchar(255) DEFAULT NULL,
  `km_drop_time` bigint(20) DEFAULT NULL,
  `dmage` tinyint(1) NOT NULL DEFAULT 0,
  `return_note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
);

ALTER TABLE `booking_vehicles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `booking_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;



