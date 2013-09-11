<?php

include ("../../../inc/includes.php");
Html::header($LANG['plugin_custom']["name"], $_SERVER['PHP_SELF'], 
   "plugins", "custom", "defaulttab");

Search::Show('PluginCustomDefaulttab');

Html::footer();
?>
