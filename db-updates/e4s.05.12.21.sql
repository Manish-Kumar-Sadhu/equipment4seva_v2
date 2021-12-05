---
--- Updating model length to 100
---
ALTER TABLE `equipment` CHANGE `model` `model` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;