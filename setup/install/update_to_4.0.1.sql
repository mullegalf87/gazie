UPDATE `gaz_config` SET `cvalue` = '43' WHERE `id` =2;
ALTER TABLE `gaz_admin` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_admin_module` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_agenti` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_aliiva` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_artico` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_aziend` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_banapp` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_catmer` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_caucon` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_caumag` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_clfoco` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_config` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_country` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_effett` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_imball` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_letter` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_menu_module` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_menu_script` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_module` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_movmag` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_pagame` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_portos` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_provvigioni` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_rigbro` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_rigdoc` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_rigmoc` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_rigmoi` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_spediz` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_tesbro` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_tesdoc` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_tesmov` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_vettor` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `gaz_admin` ENGINE = MYISAM;
ALTER TABLE `gaz_admin_module` ENGINE = MYISAM;
ALTER TABLE `gaz_agenti` ENGINE = MYISAM;
ALTER TABLE `gaz_aliiva` ENGINE = MYISAM;
ALTER TABLE `gaz_artico` ENGINE = MYISAM;
ALTER TABLE `gaz_aziend` ENGINE = MYISAM;
ALTER TABLE `gaz_banapp` ENGINE = MYISAM;
ALTER TABLE `gaz_catmer` ENGINE = MYISAM;
ALTER TABLE `gaz_caucon` ENGINE = MYISAM;
ALTER TABLE `gaz_caumag` ENGINE = MYISAM;
ALTER TABLE `gaz_clfoco` ENGINE = MYISAM;
ALTER TABLE `gaz_config` ENGINE = MYISAM;
ALTER TABLE `gaz_country` ENGINE = MYISAM;
ALTER TABLE `gaz_effett` ENGINE = MYISAM;
ALTER TABLE `gaz_imball` ENGINE = MYISAM;
ALTER TABLE `gaz_letter` ENGINE = MYISAM;
ALTER TABLE `gaz_menu_module` ENGINE = MYISAM;
ALTER TABLE `gaz_menu_script` ENGINE = MYISAM;
ALTER TABLE `gaz_module` ENGINE = MYISAM;
ALTER TABLE `gaz_movmag` ENGINE = MYISAM;
ALTER TABLE `gaz_pagame` ENGINE = MYISAM;
ALTER TABLE `gaz_portos` ENGINE = MYISAM;
ALTER TABLE `gaz_provvigioni` ENGINE = MYISAM;
ALTER TABLE `gaz_rigbro` ENGINE = MYISAM;
ALTER TABLE `gaz_rigdoc` ENGINE = MYISAM;
ALTER TABLE `gaz_rigmoc` ENGINE = MYISAM;
ALTER TABLE `gaz_rigmoi` ENGINE = MYISAM;
ALTER TABLE `gaz_spediz` ENGINE = MYISAM;
ALTER TABLE `gaz_tesbro` ENGINE = MYISAM;
ALTER TABLE `gaz_tesdoc` ENGINE = MYISAM;
ALTER TABLE `gaz_tesmov` ENGINE = MYISAM;
ALTER TABLE `gaz_vettor` ENGINE = MYISAM;
UPDATE `gaz_config` SET `cvalue` = '' WHERE `id` =3 LIMIT 1 ;
UPDATE `gaz_config` SET `cvalue` = '43' WHERE `id` =2;
