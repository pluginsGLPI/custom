<?php

include ("../../../inc/includes.php");

Html::header($LANG['plugin_custom']["name"], $_SERVER['PHP_SELF'] ,"plugins", "custom", "config");

echo "<div class='custom_center'><ul class='custom_config'>";
if (plugin_custom_haveRight("add_tabs", 1)) {
   echo "<li onclick='location.href=\"tab.php\"'>
      <img src='../pics/tab_edit.png' />
      <p><a>".$LANG['plugin_custom']['config'][0]."</a></p></li>";
}
if (plugin_custom_haveRight("add_defaulttabs", 1)) {
   echo "<li onclick='location.href=\"defaulttab.php\"'>
      <img src='../pics/tab_default.png' />
      <p><a>".$LANG['plugin_custom']['config'][1]."</a></p></li>";
}
if (plugin_custom_haveRight("edit_style", 1)) {
   echo "<li onclick='location.href=\"style.form.php\"'>
      <img src='../pics/palette.png' />
      <p><a>".$LANG['plugin_custom']['config'][2]."</a></p></li>";
}
echo "</ul><div class='custom_clear'></div></div>";

Html::footer();
?>
