---
--- Renaming create_datetime coulmn to created_datetime in equipment_documents table
---
ALTER TABLE `equipment_documents` CHANGE `create_datetime` `created_datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
---
--- Renaming update_datetime column to updated_datetime in equipment_documents table
---
ALTER TABLE `equipment_documents` CHANGE `update_datetime` `updated_datetime` DATETIME NULL DEFAULT NULL;