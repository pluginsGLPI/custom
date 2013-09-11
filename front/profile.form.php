<?php

include ("../../../inc/includes.php");

Session::checkRight("profile","r");

$prof = new PluginCustomProfile();

//Save profile
if (isset ($_POST['update'])) {
   $prof->update($_POST);
   PluginCustomProfile::changeProfile();
   Html::redirect($_SERVER['HTTP_REFERER']);
}

?>
