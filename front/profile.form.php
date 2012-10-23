<?php

define('GLPI_ROOT', '../../..');
include (GLPI_ROOT."/inc/includes.php");

Session::checkRight("profile","r");

$prof = new PluginCustomProfile();

//Save profile
if (isset ($_POST['update'])) {
   $prof->update($_POST);
   Html::redirect($_SERVER['HTTP_REFERER']);
}

?>
