<?php

define('GLPI_ROOT', '../../..');
include (GLPI_ROOT."/inc/includes.php");

Html::header($LANG['plugin_custom']["name"], $_SERVER['PHP_SELF'] ,"plugins", "custom", "config");

echo "<div class'center'>";
echo "<table class='tab_cadrehov'>
<tr>
<td><a href='tab.php'>".$LANG['plugin_custom']['config'][0]."</a></td>
<td><a href='defaulttab.php'>".$LANG['plugin_custom']['config'][1]."</a></td>
<td></td>
</tr>
</table>";
echo "</div>";

Html::footer();
?>
