UPDATE `gaz_config` SET `cvalue` = '56' WHERE `id` =2;
ALTER TABLE `gaz_caucon` DROP `tipiv1`, DROP `tipiv2`, DROP `tipiv3`, DROP `tipiv4`, DROP `tipiv5`, DROP `tipiv6`;
UPDATE `gaz_menu_script` SET `link` = 'admin_portos.php?Insert' WHERE `id` =48 LIMIT 1 ;
UPDATE `gaz_menu_script` SET `link` = 'admin_spediz.php?Insert' WHERE `id` =45 LIMIT 1 ;
UPDATE `gaz_menu_script` SET `link` = 'admin_banapp.php?Insert' WHERE `id` =44 LIMIT 1 ;
INSERT INTO `gaz_menu_module` (`id`, `id_module`, `link`, `icon`, `class`, `translate_key`, `accesskey`, `weight`) VALUES ('52', '1', 'logout.php', '', '', '2', '', '2');
ALTER TABLE `gaz_clfoco` DROP `dare__`, DROP `avere_`;
UPDATE `gaz_menu_script` SET `link` = 'admin_piacon.php' WHERE `id`=29 LIMIT 1 ;
ALTER TABLE `gaz_artico` CHANGE `last_cost` `last_cost` DECIMAL( 14, 5 ) NULL DEFAULT '0.00000';
UPDATE `gaz_artico` SET `last_cost`=0.00000 WHERE `last_cost` IS NULL;
UPDATE `gaz_menu_script` SET `link` = 'accounting_documents.php?type=A' WHERE `id`=26 LIMIT 1;