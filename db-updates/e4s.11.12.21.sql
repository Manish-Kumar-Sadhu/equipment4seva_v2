---
--- Inserting default values for document constraints
---

INSERT INTO `defaults` (`default_id`, `default_tilte`, `default_description`, `default_type`, `default_unit`, `lower_range`, `upper_range`, `value`) VALUES
('upload_max_size', 'Equipment Document Maximum Size', 'File size limit for Equipment Documents to be uploaded. The maximum size (in kilobytes) that the file can be. Set to zero for no limit. Note: Most PHP installations have their own limit, as specified in the php.ini file. Usually 2 MB (or 2048 KB) by default.', 'Numeric', 'KB', '', '', '3072'),
('upload_max_width', 'Equipment Document Image Maximum Width', 'Image width limit for Equipment Documents to be uploaded. The minimum width (in pixels) that the image can be. Set to zero for no limit.', 'Numeric', 'Pixel', '', '', '3000'),
('upload_max_height', 'Equipment Document Image Maximum Height', 'Image height limit for Equipment Documents to be uploaded. The maximum height (in pixels) that the image can be. Set to zero for no limit.', 'Numeric', 'Pixel', '', '', '3000'),
('upload_allowed_types', 'Equipment Document files types', 'Equipment Document files types allowed for upload. The mime types corresponding to the types of files you allow to be uploaded. Usually the file extension can be used as the mime type. Can be either an array or a pipe-separated string.', 'Text', 'File Type', '', '', 'gif|jpg|jpeg|png'),
('upload_remove_spaces', 'Remove spaces in Equipment Document file name', 'If set to TRUE, any spaces in the file name will be converted to underscores. This is recommended.', 'Text', '', '', '', 1),
('upload_overwrite', 'Overwrite feature for document upload', 'If set to true, if a file with the same name as the one you are uploading exists, it will be overwritten. If set to false, a number will be appended to the filename if another with the same name exists.', 'Text', '', '', '', 1);
COMMIT;

---
--- Updated document type to allow pdf
---
UPDATE `defaults` SET `value` = 'gif|jpg|jpeg|png|pdf' WHERE `defaults`.`default_id` = 'upload_allowed_types';

---
--- Inserting current timestamp for create_datetime in equipment_documents
---
ALTER TABLE `equipment_documents` CHANGE `create_datetime` `create_datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

---
--- fixed column name 
---
ALTER TABLE `equipment_documents` CHANGE `update_by` `updated_by` INT(11) NULL DEFAULT NULL;

--
-- new user function for equipment document
--
INSERT INTO `user_function` (`user_function_id`, `user_function`, `user_function_display`, `description`) 
VALUES (NULL, 'equipment_document', 'Equipment Document', '');


---
--- added user function for summary report
---
INSERT INTO `user_function` (`user_function_id`, `user_function`, `user_function_display`, `description`)
VALUES (NULL, 'summary_report', 'Summary report', '');