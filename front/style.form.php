<?php

define('GLPI_ROOT', '../../..');
include (GLPI_ROOT."/inc/includes.php");

Html::header($LANG['plugin_custom']["name"], $_SERVER['PHP_SELF'] ,"plugins", "custom", "style");

$style = new PluginCustomStyle;

if (isset($_POST['add'])) {
   $style->add($_POST);

} elseif(isset($_POST['update'])) {
   $style->update($_POST);

}


$ID = isset($_POST['id'])?$_POST['id']:PluginCustomStyle::getSingle();
$style->showForm($ID);

Html::footer();
?>
