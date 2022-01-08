---
--- updated the varchar length to 500
---
ALTER TABLE `defaults` CHANGE `value` `value` VARCHAR(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

---
--- created new default value to display columns in equipments table
---
INSERT INTO `defaults` (`default_id`, `default_tilte`, `default_description`, `default_type`, `default_unit`, `lower_range`, `upper_range`, `value`) 
VALUES ('equipments_default_columns', 'equipments_default_columns', 'list of default columns that are to be displayed in equipments details table', '', NULL, NULL, NULL, 'equipment-type,equipment-name');

---
--- updated  default value of display columns in equipments table
---
UPDATE `defaults` SET `value` = 'equipment-type, equipment-name,serial-number,current-location,district-state,cost,invoice-date' 
WHERE `defaults`.`default_id` = 'equipments_default_columns';

---
--- Created new default value that has list of all columns that can be displayed in equipments tablw
---
INSERT INTO `defaults` (`default_id`, `default_tilte`, `default_description`, `default_type`, `default_unit`, `lower_range`, `upper_range`, `value`) 
VALUES ('equipments_table_all_columns', 'equipments_table_all_columns', 'list of all columns that can be displayed in the equipments table', '', NULL, NULL, NULL, 'equipment-type,equipment-name,serial-number,model,mac-address,procurement-status,procurement-type,purchase-order-data,current-location,district-state,cost,invoice-number,invoice-date,functional-status,');