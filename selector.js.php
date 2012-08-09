<?php

define('GLPI_ROOT', '../..');
include (GLPI_ROOT."/inc/includes.php");

//change mimetype
header("Content-type: application/javascript");

if (!plugin_custom_haveRight('view_color', 1)) exit();

if ($plugin->isInstalled("custom") && $plugin->isActivated("custom")) {
   echo "Ext.onReady(function() {\n
      if (typeof tabpanel !== 'undefined' ) {
         Ext.select('.x-tab-strip > li').toggleClass('custom_heading_none');
      ";

      $itemtype = PluginCustomTab::getItemtype();

      /*** Color Tabs ***/
      $query = "SELECT * FROM glpi_plugin_custom_tabs WHERE itemtype = '$itemtype'";
      $res = $DB->query($query);
      while($data = $DB->fetch_array($res)) {

         $color = $data['color'];
         $tab = PluginCustomTab::escapeTabName($data['tab']);

         if ($color != "deleted") {
            echo "
               var extcomp = tabpanel.id;

               Ext.select('#'+extcomp+'__".$tab."').toggleClass('$color');
               Ext.select('#'+extcomp+'__".$tab."').toggleClass('custom_heading');
               Ext.select('#'+extcomp+'__".$tab."').toggleClass('custom_heading_none');
               Ext.select('#'+extcomp+'__".$tab." .x-tab-right').addClass('right-colored-$color');
               Ext.select('#'+extcomp+'__".$tab." .x-tab-left').addClass('left-colored-$color');
               Ext.select('#'+extcomp+'__".$tab." .x-tab-strip-inner').addClass('inner-colored-$color');
               Ext.select('#'+extcomp+'__".$tab." .x-tab-strip-text').addClass('custom_headings-$color');
            ";
         } else {
            echo "Ext.select('#'+tabpanel.id+'__".$tab."').remove();";
         }
      }
     


      /*** Default Tabs ***/
      $query = "SELECT * FROM glpi_plugin_custom_defaulttabs WHERE itemtype = '$itemtype'";
      $res = $DB->query($query);
      while($data = $DB->fetch_array($res)) {

         echo "
            tabpanel.setActiveTab('{$data['tab']}');
         ";
      }


      echo "}";

      //add a star to user group vip
      echo "
      Ext.select('span.x-hidden').each(function(el){
         if (el.dom.innerHTML.indexOf('VIP') > 0) {
            el.insertHtml(
               'beforeBegin',
               '<img src=\"../plugins/custom/pics/vip.png\" alt=\"VIP\" title=\"VIP\" />'
            );
         }
      });
      ";
   echo "});";
}

?>
