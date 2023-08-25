INSERT INTO db_version
(db_id,name,descr)
VALUES
(10,'database version 0.1','changes for customer multiple upload images')
;

CREATE TABLE `customer_images` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `caption` varchar(512) DEFAULT NULL COMMENT 'caption for image type "others"',
  `link` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
);


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `customerImageMigration`()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE _company_id INT;
    DECLARE _customer_id INT(11);
    DECLARE _residency_card VARCHAR(255);
    DECLARE _passport_detail VARCHAR(255);
    DECLARE _visa_detail VARCHAR(255);
    DECLARE _driving_license VARCHAR(255);

    DECLARE cur CURSOR FOR SELECT  id, company_id, residency_card, passport_detail, visa_detail, driving_license FROM customers;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO _customer_id,_company_id,_residency_card, _passport_detail, _visa_detail, _driving_license;
        IF done THEN
            LEAVE read_loop;
        END IF;

        -- You can perform operations on userId, userName, and userEmail here
        -- For example, you can use SELECT or other statements to work with the values

        -- Print the values as an example
        SELECT CONCAT('ID: ', _company_id, ' - customer: ', _customer_id, ' - card: ', _residency_card) AS output;

		INSERT INTO customer_images (customer_id,company_id,type,link) VALUES (_customer_id,_company_id,"residency_card",_residency_card);

        INSERT INTO customer_images (customer_id,company_id,type,link) VALUES (_customer_id,_company_id,"passport_detail",_passport_detail);

        INSERT INTO customer_images (customer_id,company_id,type,link) VALUES (_customer_id,_company_id,"visa_detail",_visa_detail);

        INSERT INTO customer_images (customer_id,company_id,type,link) VALUES (_customer_id,_company_id,"driving_license",_driving_license);

    END LOOP;

    CLOSE cur;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`nucleuz`@`%` PROCEDURE `customerNameMigration`()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE _customer_id INT(11);
    DECLARE _first_name VARCHAR(255);
    DECLARE _middle_name VARCHAR(255);
    DECLARE _last_name VARCHAR(255);

    DECLARE cur CURSOR FOR SELECT  id, first_name, middle_name, last_name FROM customers;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO _customer_id,_first_name,_middle_name,_last_name;
        IF done THEN
            LEAVE read_loop;
        END IF;

        -- You can perform operations on userId, userName, and userEmail here
        -- For example, you can use SELECT or other statements to work with the values
        IF _middle_name IS NOT NULL THEN
            SET _first_name = CONCAT(_first_name," ",_middle_name);
        END IF;

        IF _last_name IS NOT NULL THEN
            SET _first_name = CONCAT(_first_name," ",_last_name);
        END IF;

	UPDATE customers SET first_name = _first_name WHERE id = _customer_id;

    END LOOP;

    CLOSE cur;
END$$
DELIMITER ;

CALL customerNameMigration();
CALL customerImageMigration();
