---
--- Added deleted_by, and deleted_datetime to equipment_location_log table
---

ALTER TABLE `equipment_location_log` 
ADD `deleted_by` INT(11) NULL DEFAULT NULL AFTER `updated_datetime`,
ADD `deleted_datetime` DATETIME NULL DEFAULT NULL AFTER `deleted_by`;

---
-- Updating created_datetime  default equipment_location_log value
---

ALTER TABLE `equipment_location_log` CHANGE `created_datetime` `created_datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

---
-- Updating created_datetime  default value in equipment table
---

ALTER TABLE `equipment` CHANGE `created_datetime` `created_datetime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP;

--
-- new user function for equipment_location
--
INSERT INTO `user_function` (`user_function_id`, `user_function`, `user_function_display`, `description`) 
VALUES (NULL, 'equipment_location', 'Equipment Location', '');