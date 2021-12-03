---
--- Removed column is_default_party 
---
ALTER TABLE `user_party_link` DROP `is_default_party`;

---
--- Added default_party_id column to user table
---
ALTER TABLE `user` ADD `default_party_id` INT(11) NULL DEFAULT NULL AFTER `password`;