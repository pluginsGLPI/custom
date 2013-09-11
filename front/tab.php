<?php

include ("../../../inc/includes.php");

Html::header($LANG['plugin_custom']["name"], $_SERVER['PHP_SELF'] ,"plugins", "custom", "tab");

Search::Show('PluginCustomTab');

Html::footer();
?>
