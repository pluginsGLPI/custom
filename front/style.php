<?php

define('GLPI_ROOT', '../../..');
include (GLPI_ROOT."/inc/includes.php");

Html::header($LANG['plugin_custom']["name"], $_SERVER['PHP_SELF'] ,"plugins", "custom", "style");

$style = new PluginCustomStyle;
$style->showForm();

Html::footer();
?>
