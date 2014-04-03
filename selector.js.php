<?php

include ("../../inc/includes.php");

//change mimetype
header("Content-type: application/javascript");

if ($plugin->isInstalled("custom") && $plugin->isActivated("custom")) {
   echo "Ext.onReady(function() {\n
      if (typeof tabpanel !== 'undefined' ) {
         Ext.select('.x-tab-strip > li').toggleClass('custom_heading_none');
      ";

      $itemtype = PluginCustomTab::getItemtype();

      /*** Color Tabs ***/
      //if (plugin_custom_haveRight('view_color', 1)) {
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
      //}     


      /*** Default Tabs ***/
      $query = "SELECT * FROM glpi_plugin_custom_defaulttabs WHERE itemtype = '$itemtype'";
      $res = $DB->query($query);
      while($data = $DB->fetch_array($res)) {

         echo "
            tabpanel.setActiveTab('{$data['tab']}');
         ";
      }


      echo "}";

      
      $path = dirname(dirname(dirname($_SERVER['REQUEST_URI'])));
      $login_locale = __("Login");
      
      $JS = <<<JAVASCRIPT
      //add a star to user group vip
      Ext.select('span.x-hidden').each(function(el){
         if (el.dom.innerHTML.indexOf('VIP') > 0 && el.dom.innerHTML.indexOf('$login_locale') > 0) {
            el.insertHtml(
               'beforeBegin',
               "<img src='$path/plugins/custom/pics/vip.png' alt='VIP' title='VIP' />"
            );
         }
      });
      //add a star to user group vip (after ajax request)
      Ext.Ajax.on('requestcomplete', function(conn, response, option) {
         //delay the execution (ajax requestcomplete event fired before dom loading)
         setTimeout( function () {
            Ext.select('span.x-hidden').each(function(el){
               if (el.dom.innerHTML.indexOf('VIP') > 0
                  && el.dom.innerHTML.indexOf('$login_locale') > 0
                  && el.dom.parentNode.innerHTML.indexOf('vip.png') == -1) {
                     
                  el.insertHtml(
                     'beforeBegin',
                     "<img src='$path/plugins/custom/pics/vip.png' alt='VIP' title='VIP' />"
                  );
               }
            });
         }, 300);      
      });


      //add a toggle button on debug h2 elements
      Ext.select('#debug h2').each(function(el){
         el.insertHtml(
            'afterBegin',
            "<a class='toggle_debug pointer'>"
               +"<img alt='' class='toggle_debug_img'"
               +" src='$path/pics/deplier_down.png'></a>&nbsp;"
         );
      }).on('click', function() {
         //toggle element under h2 clicked
         Ext.select('#'+this.id+' + table').toggle();
         Ext.select('#'+this.id+' + p').toggle();

         //scroll to element clicked
         y = Ext.get(this.id).getY();
         window.scroll(0, y);

         //toggle img
         var sel_img = Ext.select('#'+this.id+' .toggle_debug_img');
         var src_img = sel_img.elements[0].src;
         if (src_img.indexOf('down') > 0) {
            sel_img.elements[0].src = '$path/pics/deplier_up.png';
         } else {
            sel_img.elements[0].src = '$path/pics/deplier_down.png';
         }
         
         return false;
      });

      //set toggle function to add "display:none" instead "visibility:hidden"
      Ext.select('#debug>table, #debug>p').setVisibilityMode(Ext.Element.DISPLAY);
      Ext.select('#debug>table, #debug>p').toggle();
   });
JAVASCRIPT;
echo $JS;
}

?>
