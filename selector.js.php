<?php
/*
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2010 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Alexandre delaunay
// Purpose of file:
// ----------------------------------------------------------------------

define('GLPI_ROOT', '../..');
include (GLPI_ROOT."/inc/includes.php");

if (!plugin_custom_haveRight('view_color', 1)) exit();

if ($plugin->isInstalled("custom") && $plugin->isActivated("custom")) {
   echo "Ext.onReady(function() {\n
      if (typeof tabpanel !== 'undefined' ) {
      ";

      $itemtype = PluginCustomTab::getItemtype();

      $query = "SELECT * FROM glpi_plugin_custom_tabs WHERE itemtype = '$itemtype'";
      $res = $DB->query($query);
      while($data = $DB->fetch_array($res)) {

         $color = $data['color'];
         $tab = PluginCustomTab::escapeTabName($data['tab']);

         if ($color != "deleted") {
            echo "
               var extcomp = tabpanel.id;

               Ext.select('#'+extcomp+'__".$tab."').toggleClass('$color');
               Ext.select('#'+extcomp+'__".$tab." .x-tab-right').addClass('right-colored-$color');
               Ext.select('#'+extcomp+'__".$tab." .x-tab-left').addClass('left-colored-$color');
               Ext.select('#'+extcomp+'__".$tab." .x-tab-strip-inner').addClass('inner-colored-$color');
               Ext.select('#'+extcomp+'__".$tab." .x-tab-strip-text').addClass('nm_headings-$color');
            ";
         } else {
            echo "Ext.select('#'+tabpanel.id+'__".$tab."').remove();";
         }
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
