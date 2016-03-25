<?php
if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access directly to this file");
}

include_once (GLPI_ROOT . "/inc/includes.php");

function plugin_custom_install() {
   global $DB;

   $version = plugin_version_custom();
   $migration = new Migration($version['version']);

   // VERSION 1.0
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

   if (TableExists('glpi_plugin_custom_styles')) {
      // removed in 0.90
      $query = "DROP TABLE `glpi_plugin_custom_profiles`";
      $DB->query($query);
   }

   if (!TableExists('glpi_plugin_custom_profiles')) {
      $query = "CREATE TABLE `glpi_plugin_custom_profiles` (
         `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
         `profiles_id` VARCHAR(45) NOT NULL,
         `add_tabs` CHAR(1),
         `add_defaulttabs` CHAR(1)
         PRIMARY KEY (`id`)
      )
      ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
      $DB->query($query);
   }

   //create plugin file dir
   if (!is_dir(CUSTOM_FILES_DIR))
      mkdir(CUSTOM_FILES_DIR);


   //Version 1.1
   if (!TableExists('glpi_plugin_custom_tabprofiles')) {
      $query = "CREATE TABLE     `glpi_plugin_custom_tabprofiles` (
         `id`                    INT(11) NOT NULL AUTO_INCREMENT,
         `plugin_custom_tabs_id` INT(11),
         `profiles_id`           INT(11),
         PRIMARY KEY             (`id`),
         KEY                     (`plugin_custom_tabs_id`),
         KEY                     (`profiles_id`)
      ) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
      $DB->query($query);
   }

   return true;
}

function plugin_custom_uninstall() {
   global $DB;

   //Delete plugin's table
   $tables = array (
      'glpi_plugin_custom_tabs',
      'glpi_plugin_custom_defaulttabs',
      'glpi_plugin_custom_styles',
      'glpi_plugin_custom_profiles',
      'glpi_plugin_custom_tabprofiles'
   );
   foreach ($tables as $table)
      $DB->query("DROP TABLE IF EXISTS `$table`");

   //delete plugin files dir
   Toolbox::deleteDir(CUSTOM_FILES_DIR);


   return true;
}
