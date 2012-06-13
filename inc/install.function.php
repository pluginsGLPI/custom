<?php
if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access directly to this file");
}

include_once (GLPI_ROOT . "/inc/includes.php");

function plugin_custom_install() {
   global $DB;

   if (!TableExists('glpi_plugin_custom_tabs')) {
      $query = "CREATE TABLE `glpi_plugin_custom_tabs` (
         `id` INT(11) NOT NULL AUTO_INCREMENT,
         `name` VARCHAR(255)  collate utf8_unicode_ci NOT NULL,
         `itemtype` VARCHAR(255) NOT NULL DEFAULT 0,
         `tab` VARCHAR(255) NOT NULL DEFAULT 0,
         `color` VARCHAR(255) NOT NULL DEFAULT 0,
         PRIMARY KEY (`id`)
      ) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
      $DB->query($query);
   }   

   if (!TableExists('glpi_plugin_custom_defaulttabs')) {
      $query = "CREATE TABLE `glpi_plugin_custom_defaulttabs` (
         `id` INT(11) NOT NULL AUTO_INCREMENT,
         `name` VARCHAR(255)  collate utf8_unicode_ci NOT NULL,
         `itemtype` VARCHAR(255) NOT NULL DEFAULT 0,
         `tab` VARCHAR(255) NOT NULL DEFAULT 0,
         PRIMARY KEY (`id`)
      ) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
      $DB->query($query);
   }

   if (!TableExists('glpi_plugin_custom_profiles')) {
      $query = "CREATE TABLE `glpi_plugin_custom_profiles` (
         `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
         `profiles_id` VARCHAR(45) NOT NULL,
         `view_color` CHAR(1),
         `add_tabs` CHAR(1),
         PRIMARY KEY (`id`)
      )
      ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
      $DB->query($query);
   }

   include_once (GLPI_ROOT."/plugins/custom/inc/profile.class.php");
   PluginCustomProfile::createFirstAccess($_SESSION['glpiactiveprofile']['id']);

   return true;
}

function plugin_custom_uninstall() {
   global $DB;

   //Delete plugin's table
   $tables = array (
      'glpi_plugin_custom_tabs',
      'glpi_plugin_custom_defaulttabs',
      'glpi_plugin_custom_profiles'
   );
   foreach ($tables as $table)
      $DB->query("DROP TABLE IF EXISTS `$table`");

   return true;
}

?>
