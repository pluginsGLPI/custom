<?php

include ("../../../inc/includes.php");
Html::header(__('Custom', 'custom'), $_SERVER['PHP_SELF'],
   "plugins", "custom", "defaulttab");

Search::Show('PluginCustomDefaulttab');

Html::footer();
