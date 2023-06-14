INSERT INTO db_version
(db_id,name,descr)
VALUES
(6,'database version 0.1','add table cartype');
;


CREATE TABLE if not exists `car_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
);

ALTER TABLE `car_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `car_type_unique` (`name`);

ALTER TABLE `car_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

INSERT INTO `car_type` (`name`) VALUES
('Sedan')
,('Hatchback')
,('Saloon')
,('MUV')
,('SUV')
,('AWD')
,('4WD')
,('Coupe')
,('Convertibles')
,('Pickup Trucks')
;


