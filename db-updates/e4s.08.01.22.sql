---
--- updated the varchar length to 500
---
ALTER TABLE `defaults` CHANGE `value` `value` VARCHAR(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

---
--- created new default value to display columns in equipments table
---
INSERT INTO `defaults` (`default_id`, `default_tilte`, `default_description`, `default_type`, `default_unit`, `lower_range`, `upper_range`, `value`) 
VALUES ('equipments_default_columns', 'equipments_default_columns', 'list of default columns that are to be displayed in equipments details table', '', NULL, NULL, NULL, 'equipment-type,equipment-name');