--
-- Updating party_address length to 100
--

ALTER TABLE `party` CHANGE `party_address` `party_address` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

--
-- Updating party_name length to 70
--

ALTER TABLE `party` CHANGE `party_name` `party_name` VARCHAR(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

--
-- Added party_bank_ifsc column to party table
--
ALTER TABLE `party` ADD `bank_branch_ifsc` VARCHAR(50) NULL DEFAULT NULL AFTER `bank_branch`;

--
-- Added created_by, created_datetime, updated_by and updated_datetime to party table
--
ALTER TABLE `party` 
ADD `created_by` INT(11) NULL DEFAULT NULL AFTER `party_pan`, 
ADD `created_datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by`, 
ADD `updated_by` INT(11) NULL DEFAULT NULL AFTER `created_datetime`,
ADD `updated_datetime` DATETIME NULL DEFAULT NULL AFTER `updated_by`;

--
-- new user function for location
--
INSERT INTO `user_function` (`user_function_id`, `user_function`, `user_function_display`, `description`) 
VALUES (NULL, 'location', 'Location', '');

