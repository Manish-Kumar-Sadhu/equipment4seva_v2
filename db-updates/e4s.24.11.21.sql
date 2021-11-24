--
-- Updating party_address length to 100
--

ALTER TABLE `party` CHANGE `party_address` `party_address` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

--
-- Updating party_name length to 70
--

ALTER TABLE `party` CHANGE `party_name` `party_name` VARCHAR(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

