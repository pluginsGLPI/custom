<?php
class PluginCustomStyle extends CommonDBTM {

   static function getTypeName($nb=0) {
      global $LANG;

      return $LANG['plugin_custom']['type'][2];
   }

   static function canCreate() {
      return plugin_custom_haveRight("edit_style", 1);
   }

   static function canView() {
      return plugin_custom_haveRight("edit_style", 1);
   }

   function showForm($ID, $options=array()) {
      global $LANG, $CFG_GLPI;

      if ($ID <= 0) $ID = $this->add(array('id' => 0));
      $this->check($ID,'r');

      $options['colspan'] = 4;
      $this->showFormHeader($this->fields);

      echo "<tr><th colspan='4'>".$LANG['plugin_custom']['config'][2]."</th></tr>";

      echo "<tr>";
      echo "<td>"."##BODY##"."</td>";
      echo "<td>";
      self::colorInput('body', $this->fields['body']);
      echo "</td>";

      echo "<td>"."##TEXT_COLOR##"."</td>";
      echo "<td>";
      self::colorInput('text_color', $this->fields['text_color']);
      echo "</td>";
      echo "</tr>";

      echo "<tr><th colspan='4'>Links</th></tr>";

      echo "<tr>";
      echo "<td>"."##LINK_COLOR##"."</td>";
      echo "<td>";
      self::colorInput('link_color', $this->fields['link_color']);
      echo "</td>";

      echo "<td>"."##HOVER_LINK_COLOR##"."</td>";
      echo "<td>";
      self::colorInput('link_hover_color', $this->fields['link_hover_color']);
      echo "</td>";
      echo "</tr>";

      echo "<tr><th colspan='4'>Menu</th></tr>";

      echo "<tr>";
      echo "<td>"."##MENU_BORDER##"."</td>";
      echo "<td>";
      self::colorInput('menu_border', $this->fields['menu_border']);
      echo "</td>";
      echo "<td>"."##MENU_ITEM_BG##"."</td>";
      echo "<td>";
      self::colorInput('menu_item_bg', $this->fields['menu_item_bg']);
      echo "</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td>"."##MENU_ITEM_BORDER##"."</td>";
      echo "<td>";
      self::colorInput('menu_item_border', $this->fields['menu_item_border']);
      echo "</td>";

      echo "<td>"."##MENU_ITEM_BG_HOVER##"."</td>";
      echo "<td>";
      self::colorInput('menu_item_bg_hover', $this->fields['menu_item_bg_hover']);
      echo "</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td>"."##MENU_LINK##"."</td>";
      echo "<td>";
      self::colorInput('menu_link', $this->fields['menu_link']);
      echo "</td>";
      
      echo "<td>"."##MENU_ITEM_LINK##"."</td>";
      echo "<td>";
      self::colorInput('menu_item_link', $this->fields['menu_item_link']);
      echo "</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td>"."##SSMENU1_LINK##"."</td>";
      echo "<td>";
      self::colorInput('ssmenu1_link', $this->fields['ssmenu1_link']);
      echo "</td>";

      echo "<td>"."##SSMENU2_LINK##"."</td>";
      echo "<td>";
      self::colorInput('ssmenu2_link', $this->fields['ssmenu2_link']);
      echo "</td>";
      echo "</tr>";

      echo "<tr><th colspan='4'>Tables</th></tr>";

      echo "<tr>";
      echo "<td>"."##TH##"."</td>";
      echo "<td>";
      self::colorInput('th', $this->fields['th']);
      echo "</td>";

      echo "</tr>";

      echo "<tr>";
      echo "<td>"."##TAB_BG_1##"."</td>";
      echo "<td>";
      self::colorInput('tab_bg_1', $this->fields['tab_bg_1']);
      echo "</td>";


      echo "<td>"."##TAB_BG_2##"."</td>";
      echo "<td>";
      self::colorInput('tab_bg_2', $this->fields['tab_bg_2']);
      echo "</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td>"."##TAB_BG_1_2##"."</td>";
      echo "<td>";
      self::colorInput('tab_bg_1_2', $this->fields['tab_bg_1_2']);
      echo "</td>";


      echo "<td>"."##TAB_BG_2_2##"."</td>";
      echo "<td>";
      self::colorInput('tab_bg_2_2', $this->fields['tab_bg_2_2']);
      echo "</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td>"."##TAB_BG_3##"."</td>";
      echo "<td>";
      self::colorInput('tab_bg_3', $this->fields['tab_bg_3']);
      echo "</td>";

      echo "<td>"."##TAB_BG_4##"."</td>";
      echo "<td>";
      self::colorInput('tab_bg_4', $this->fields['tab_bg_4']);
      echo "</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td>"."##TAB_BG_5##"."</td>";
      echo "<td>";
      self::colorInput('tab_bg_5', $this->fields['tab_bg_5']);
      echo "</td>";
      echo "</tr>";

      echo "<tr><th colspan='4'>Cadres</th></tr>";

      echo "<tr>";
      echo "<td>"."##CADRE_CENTRAL_BG1##"."</td>";
      echo "<td>";
      self::colorInput('cadre_central_bg1', $this->fields['cadre_central_bg1']);
      echo "</td>";   

      echo "<td>"."##CADRE_CENTRAL_BG1##"."</td>";
      echo "<td>";
      self::colorInput('cadre_central_bg2', $this->fields['cadre_central_bg2']);
      echo "</td>";  
      echo "</tr>";    

      echo "<tr><th colspan='4'>Onglets</th></tr>";

      echo "<tr>";
      echo "<td>"."##TABS_BG1##"."</td>";
      echo "<td>";
      self::colorInput('tabs_bg1', $this->fields['tabs_bg1']);
      echo "</td>";   

      echo "<td>"."##TABS_BG2##"."</td>";
      echo "<td>";
      self::colorInput('tabs_bg2', $this->fields['tabs_bg2']);
      echo "</td>";  
      echo "</tr>";

      echo "<tr>";
      echo "<td>"."##TABS_BG3##"."</td>";
      echo "<td>";
      self::colorInput('tabs_bg3', $this->fields['tabs_bg3']);
      echo "</td>";    
      echo "</tr>";  

      echo "<tr>";
      echo "<td>"."##TABS_BORDER##"."</td>";
      echo "<td>";
      self::colorInput('tabs_border', $this->fields['tabs_border']);
      echo "</td>";  

      echo "<td>"."##TABS_TITLE_COLOR##"."</td>";
      echo "<td>";
      self::colorInput('tabs_title_color', $this->fields['tabs_title_color']);
      echo "</td>";  
      echo "</tr>";    


      echo "<tr><th colspan='4'>Header</th></tr>";

      echo "<tr>";
      echo "<td>"."##HEADER_BG1##"."</td>";
      echo "<td>";
      self::colorInput('header_bg1', $this->fields['header_bg1']);
      echo "</td>";       

      echo "<td>"."##HEADER_BG2##"."</td>";
      echo "<td>";
      self::colorInput('header_bg2', $this->fields['header_bg2']);
      echo "</td>";  
      echo "</tr>";         

      echo "<tr>";
      echo "<td>"."##HEADER_BG3##"."</td>";
      echo "<td>";
      self::colorInput('header_bg3', $this->fields['header_bg3']);
      echo "</td>";       

      echo "<td>"."##HEADER_BG4##"."</td>";
      echo "<td>";
      self::colorInput('header_bg4', $this->fields['header_bg4']);
      echo "</td>";  
      echo "</tr>";

      echo "<tr>";
      echo "<td>"."##HEADER_BG5##"."</td>";
      echo "<td>";
      self::colorInput('header_bg5', $this->fields['header_bg5']);
      echo "</td>";       

      echo "<td>"."##HEADER_BG6##"."</td>";
      echo "<td>";
      self::colorInput('header_bg6', $this->fields['header_bg6']);
      echo "</td>";  
      echo "</tr>";    

      echo "<tr><th colspan='4'>Ombres</th></tr>";

      echo "<tr>";
      echo "<td>"."##HEADER_SHADOW_COLOR##"."</td>";
      echo "<td>";
      self::colorInput('header_shadow_color', $this->fields['header_shadow_color']);
      echo "</td>";

      echo "<td>"."##HEADER_SHADOW_SIZE##"."</td>";
      echo "<td>";
      ##size input
      echo "</td>";
      echo "</tr>";      

      echo "<tr>";
      echo "<td>"."##PAGE_SHADOW_COLOR##"."</td>";
      echo "<td>";
      self::colorInput('page_shadow_color', $this->fields['page_shadow_color']);
      echo "</td>";

      echo "<td>"."##PAGE_SHADOW_SIZE##"."</td>";
      echo "<td>";
      ##size input
      echo "</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td>"."##FOOTER_SHADOW_COLOR##"."</td>";
      echo "<td>";
      self::colorInput('footer_shadow_color', $this->fields['footer_shadow_color']);
      echo "</td>";

      echo "<td>"."##FOOTER_SHADOW_SIZE##"."</td>";
      echo "<td>";
      ##size input
      echo "</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td>"."##FOOTER_BG1##"."</td>";
      echo "<td>";
      self::colorInput('footer_bg1', $this->fields['footer_bg1']);
      echo "</td>";

      echo "<td>"."##FOOTER_BG2##"."</td>";
      echo "<td>";
      self::colorInput('footer_bg2', $this->fields['footer_bg2']);
      echo "</td>";
      echo "</tr>";

      $this->showFormButtons($options);
   }

   static function colorInput($name, $value) {
      echo "<div id='$name' style='width:105px'></div>";

      $JS = <<<JAVASCRIPT
      Ext.onReady(function() {
         //extjs color picker
         new Ext.Panel({
            renderTo:document.getElementById('$name'),
            plain:false,
            header:false,
            border:false,
            items:[{
                  xtype:'colorfield',
                  hideLabel:true,
                  value:'{$value}',
                  name:'$name',
                  colorSelector:'mixer'
            }]
         });
      });
JAVASCRIPT;

      echo "<script type='text/javascript'>";
      echo $JS;
      echo "</script>";
   }

   function post_updateItem($history=1) {
      //generate header gradient img for internet explorer
      $gradient = new PluginCustomGradientgd;
      $image = $gradient->generate_gradient(1, 60, array(
         0  => $this->fields['header_bg2'], 
         31 => $this->fields['header_bg3'], 
         32 => $this->fields['header_bg4'], 
         66 => $this->fields['header_bg4'], 
         67 => $this->fields['header_bg5'], 
         100 => $this->fields['header_bg5']
      ), 'vertical');
      $gradient->save_image($image, GLPI_ROOT."/files/_plugins/custom/fn_nav.png", "png");

      //generate css
      $CSS = "
      body {
         background-color: {$this->fields['body']} !important;
         color: {$this->fields['text_color']}
      }

      div#header div#c_logo {
         background: url('".GLPI_ROOT."/plugins/custom/pics/fd_logo.png') 0 0 repeat-x;
      }

      a, a:link {
         color: {$this->fields['link_color']} !important;
      }

      a:hover {
        color: {$this->fields['link_hover_color']} !important;
      }

      ul#menu a.itemP, ul#menu a.itemP1 {
         color: {$this->fields['menu_link']} !important;
         border-right: 1px solid {$this->fields['menu_border']} !important;
      }

      ul#menu ul.ssmenu {
         background-image:none !important;
         background-color:{$this->fields['menu_item_bg']} !important;
         border: 1px solid {$this->fields['menu_item_border']} !important;
      }

      ul#menu ul li {
         border-bottom: 1px solid {$this->fields['menu_item_border']} !important;
      }

      ul#menu ul li a {
         color: {$this->fields['menu_item_link']} !important;
      }

      ul#menu ul li a:hover {
         background-image:none !important;
         background-color:{$this->fields['menu_item_bg_hover']} !important;
      }

      div#c_ssmenu1 {
         background-image:none !important;
      }

      div#c_ssmenu1 ul li a {
         color:{$this->fields['ssmenu1_link']} !important;
      }

      div#c_ssmenu2 {
         background-image:none !important;
      }

      div#c_ssmenu2 ul li a {
         color:{$this->fields['ssmenu2_link']} !important;
      }

      div#show_all_menu {
         border: 1px solid {$this->fields['menu_item_border']} !important;
         background-image:none !important;
         background-color:{$this->fields['menu_item_bg']} !important;
      }

      div#c_preference a {
         color: {$this->fields['menu_link']} !important;
      }

      #debug-float a {
         color:red !important;
      }

      .tab_cadre th, .tab_cadre_fixe th, .tab_cadre_fixehov th, 
         .tab_cadrehov th, .tab_cadrehov_pointer th, .tab_cadre_report th {
         background-color:{$this->fields['th']} !important;
      }

      .tab_bg_1 {
         background-color: {$this->fields['tab_bg_1']} !important;
      }

      .tab_bg_1_2 {
         background-color: {$this->fields['tab_bg_1_2']} !important;
      }

      .tab_bg_2 {
         background-color: {$this->fields['tab_bg_2']} !important;
      }

      .tab_bg_2_2 {
         background-color: {$this->fields['tab_bg_2_2']} !important;
      }

      .tab_bg_3 {
         background-color: {$this->fields['tab_bg_3']} !important;
      }

      .tab_bg_4 {
         background-color: {$this->fields['tab_bg_4']} !important;
      }

      .tab_bg_5 {
         background-color: {$this->fields['tab_bg_5']} !important;
      }

      .tab_cadre_central {
         background:-webkit-linear-gradient(top, 
            {$this->fields['cadre_central_bg1']}, {$this->fields['cadre_central_bg2']});
         background:-moz-linear-gradient(top, 
            {$this->fields['cadre_central_bg1']}, {$this->fields['cadre_central_bg2']});
         background:-o-linear-gradient(top, 
            {$this->fields['cadre_central_bg1']}, {$this->fields['cadre_central_bg2']});
         background:linear-gradient(top, 
            {$this->fields['cadre_central_bg1']}, {$this->fields['cadre_central_bg2']});
      }

      div#header {
         -moz-box-shadow: 0px 7px 10px {$this->fields['header_shadow_color']};
         -webkit-box-shadow: 0px 7px 10px {$this->fields['header_shadow_color']};
         box-shadow: 0px 7px 10px {$this->fields['header_shadow_color']};
         background: #ffffff; /* Old browsers */
         background: -moz-linear-gradient(top,  
            {$this->fields['header_bg1']} 0%, 
            {$this->fields['header_bg2']} 2%, {$this->fields['header_bg3']} 20%, 
            {$this->fields['header_bg4']} 21%, {$this->fields['header_bg4']} 40%, 
            {$this->fields['header_bg5']} 40%, {$this->fields['header_bg5']} 63%, 
            {$this->fields['header_bg6']} 65%, {$this->fields['header_bg6']} 99%
            ); /* FF3.6+ */
         background: -webkit-gradient(linear, left top, left bottom, 
            color-stop(0%,{$this->fields['header_bg1']}),
            color-stop(
               1%,{$this->fields['header_bg2']}), color-stop(20%,{$this->fields['header_bg3']}), 
            color-stop(
               21%,{$this->fields['header_bg4']}), color-stop(40%,{$this->fields['header_bg4']}), 
            color-stop(
               40%,{$this->fields['header_bg5']}), color-stop(63%,{$this->fields['header_bg5']}), 
            color-stop(
               65%,{$this->fields['header_bg6']}), color-stop(99%,{$this->fields['header_bg6']})
            ); /* Chrome,Safari4+ */
         background: -webkit-linear-gradient(top,  
            {$this->fields['header_bg1']} 0%,
            {$this->fields['header_bg2']} 2%,{$this->fields['header_bg3']} 20%,
            {$this->fields['header_bg4']} 21%,{$this->fields['header_bg4']} 40%,
            {$this->fields['header_bg5']} 40%,{$this->fields['header_bg5']} 63%,
            {$this->fields['header_bg6']} 65%,{$this->fields['header_bg6']} 99%
            ); /* Chrome10+,Safari5.1+ */
         background: -o-linear-gradient(top,  
            {$this->fields['header_bg1']} 0%,
            {$this->fields['header_bg2']} 2%,{$this->fields['header_bg3']} 20%,
            {$this->fields['header_bg4']} 21%,{$this->fields['header_bg4']} 40%,
            {$this->fields['header_bg5']} 40%,{$this->fields['header_bg5']} 63%,
            {$this->fields['header_bg6']} 65%,{$this->fields['header_bg6']} 99%
            ); /* Opera 11.10+ */
         background: -ms-linear-gradient(top,  
            {$this->fields['header_bg1']} 0%,
            {$this->fields['header_bg2']} 2%,{$this->fields['header_bg3']} 20%,
            {$this->fields['header_bg4']} 21%,{$this->fields['header_bg4']} 40%,
            {$this->fields['header_bg5']} 40%,{$this->fields['header_bg5']} 63%,
            {$this->fields['header_bg6']} 65%,{$this->fields['header_bg6']} 99%
            ); /* IE10+ */

         background: linear-gradient(to bottom,  
            #ffffff 0%,
            {$this->fields['header_bg2']} 2%,{$this->fields['header_bg3']} 20%,
            {$this->fields['header_bg4']} 21%,{$this->fields['header_bg4']} 40%,
            {$this->fields['header_bg5']} 40%, {$this->fields['header_bg5']} 63%,
            {$this->fields['header_bg6']} 65%,{$this->fields['header_bg6']} 99%
            ); /* W3C */
      }

      .ext-ie div#header {
         background:{$this->fields['header_bg6']} url(\"fn_nav.png\") 0 0 repeat-x; /* IE6-9 */
      }

      #page {
         -moz-box-shadow: 0px 7px 10px {$this->fields['page_shadow_color']};
         -webkit-box-shadow: 0px 7px 10px {$this->fields['page_shadow_color']};
         box-shadow: 0px 7px 10px {$this->fields['page_shadow_color']};
      }      

      #footer {
         -moz-box-shadow: 0px 7px 10px {$this->fields['footer_shadow_color']};
         -webkit-box-shadow: 0px 7px 10px {$this->fields['footer_shadow_color']};
         box-shadow: 0px 7px 10px {$this->fields['footer_shadow_color']};
         background:-webkit-linear-gradient(top, 
            {$this->fields['footer_bg1']}, {$this->fields['footer_bg2']});
         background:-moz-linear-gradient(top, 
            {$this->fields['footer_bg1']}, {$this->fields['footer_bg2']});
         background:-o-linear-gradient(top, 
            {$this->fields['footer_bg1']}, {$this->fields['footer_bg2']});
         background:linear-gradient(top, 
            {$this->fields['footer_bg1']}, {$this->fields['footer_bg2']});
      }  

      #debug h2, #debugajax h2 {
         border-left: 4px solid {$this->fields['menu_item_border']} !important;
         border-bottom: 2px solid {$this->fields['menu_item_border']} !important;
      }    

      /*** TABS ***/

      .custom_heading_none .x-tab-strip span.x-tab-strip-text {
         color:{$this->fields['tabs_title_color']}
      }

      .custom_heading_none .x-tab-left {
         background-image:none !important;
         border-top-right-radius: 4px;
      }

      .custom_heading_none .x-tab-right {
         background-image:none !important;
         border-top-left-radius: 4px;
         border-top-right-radius: 4px;
         border-color:{$this->fields['tabs_border']};
         border-width:1px 1px 0 1px;
         border-style:solid;
         border-top: 1px solid white;
         box-shadow: 0 -1px 0 {$this->fields['tabs_border']};
         margin-top: 1px;
      }

      .ext-ie .custom_heading_none .x-tab-right {
         margin-top: 0;
         box-shadow: 0 0 0;
         border-top: 1px solid {$this->fields['tabs_border']};
      }

      .custom_heading_none .x-tab-strip-active .x-tab-right {
         border-style:solid;
         border-width:1px 1px 0 1px;
      }

      .custom_heading_none .x-tab-strip-inner, 
      .custom_heading_none .x-tab-right, 
      .custom_heading_none .x-tab-left {
         background-image:none !important;
         background-position:top !important;
         background-color: {$this->fields['tabs_bg2']} !important;
         background: -moz-linear-gradient(
            top, {$this->fields['tabs_bg3']} 0%, {$this->fields['tabs_bg2']} 100%) !important;
         background: -webkit-linear-gradient(
            top, {$this->fields['tabs_bg3']} 0%, {$this->fields['tabs_bg2']} 100%) !important;
         background: -o-linear-gradient(
            top, {$this->fields['tabs_bg3']} 0%, {$this->fields['tabs_bg2']} 100%) !important;
         background: -ms-linear-gradient(
            top, {$this->fields['tabs_bg3']} 0%, {$this->fields['tabs_bg2']} 100%) !important;
         background: linear-gradient(
            top bottom,{$this->fields['tabs_bg3']} 0%, {$this->fields['tabs_bg2']} 100%) !important;
         filter: progid:DXImageTransform.Microsoft.gradient(
            startColorstr='{$this->fields['tabs_bg3']}', 
            endColorstr='{$this->fields['tabs_bg2']}',GradientType=0 ) !important;
      }

      .custom_heading_none.x-tab-strip-over .x-tab-right, 
      .custom_heading_none.x-tab-strip-over .x-tab-left,
      .custom_heading_none.x-tab-strip-over .x-tab-strip-inner {
         background:-webkit-linear-gradient(
            top, {$this->fields['tabs_bg2']}, {$this->fields['tabs_bg1']}) !important;
         background:-moz-linear-gradient(
            top, {$this->fields['tabs_bg2']}, {$this->fields['tabs_bg1']}) !important;
         background:-o-linear-gradient(
            top, {$this->fields['tabs_bg2']}, {$this->fields['tabs_bg1']}) !important;
         background:linear-gradient(
            top, {$this->fields['tabs_bg2']}, {$this->fields['tabs_bg1']}) !important;
         filter: progid:DXImageTransform.Microsoft.gradient(
            startColorstr='{$this->fields['tabs_bg2']}', 
            endColorstr='{$this->fields['tabs_bg1']}',GradientType=0 ) !important;
      }

      .custom_heading_none.x-tab-strip-active .x-tab-right, 
      .custom_heading_none.x-tab-strip-active .x-tab-left,
      .custom_heading_none.x-tab-strip-active .x-tab-strip-inner {
         background:-webkit-linear-gradient(
            top, {$this->fields['tabs_bg1']}, {$this->fields['tabs_bg2']}) !important;
         background:-moz-linear-gradient(
            top, {$this->fields['tabs_bg1']}, {$this->fields['tabs_bg2']}) !important;
         background:-o-linear-gradient(
            top, {$this->fields['tabs_bg1']}, {$this->fields['tabs_bg2']}) !important;
         background:linear-gradient(
            top, {$this->fields['tabs_bg1']}, {$this->fields['tabs_bg2']}) !important;
         filter: progid:DXImageTransform.Microsoft.gradient(
            startColorstr='{$this->fields['tabs_bg1']}', 
            endColorstr='{$this->fields['tabs_bg2']}',GradientType=0 ) !important;
      }
      ";
      return file_put_contents(CUSTOM_FILES_DIR."glpi_style.css", $CSS);
   }

   static function getSingle() {
      $style = new self;
      $tmp = $style->find();
      $tmp = array_shift($tmp);
      if (!empty($tmp)) {
         return $tmp['id'];
      }
      return -1;
   }
}
?>
