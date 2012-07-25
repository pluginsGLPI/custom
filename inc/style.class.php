<?php
class PluginCustomStyle extends CommonDBTM {

   static function getTypeName() {
      global $LANG;

      return $LANG['plugin_custom']['type'][2];
   }

   function canCreate() {
      return true;
   }

   function canView() {
      return true;
   }

   function showForm($ID, $options=array()) {
      global $LANG, $CFG_GLPI;

      if ($ID <= 0) echo $ID = $this->add(array('id' => 0));

      if ($ID > 0) {
         $this->check($ID,'r');
      } 
      
      //$colors = self::getColors($this->fields);

      $options['colspan'] = 4;
      $options['candel'] = false;
      $this->showFormHeader($this->fields);

      echo "<tr><th colspan='4'>".$LANG['plugin_custom']['config'][2]."</th></tr>";

      echo "<tr>";
      echo "<td>"."##BODY##"."</td>";
      echo "<td>";
      self::colorInput('body', $this->fields['body']);
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
      echo "<td>"."##MENU_LINK##"."</td>";
      echo "<td>";
      self::colorInput('menu_link', $this->fields['menu_link']);
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

      $this->showFormButtons($options);
   }

   static function colorInput($name, $value) {
      echo "<div id='$name' style='width:105px'></div>";

      $JS = <<<JAVASCRIPT
      Ext.onReady(function() {
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
      $CSS = "
      body {
         background: {$this->fields['body']} !important;
      }
      a, a:link {
         color: {$this->fields['link_color']} !important;
      }

      a:hover {
        color: {$this->fields['link_hover_color']} !important;
      }

      ul#menu a.itemP, ul#menu a.itemP1 {
         color: {$this->fields['menu_link']} !important;
      }

      div#c_ssmenu1 ul li a {
         color:{$this->fields['ssmenu1_link']} !important;
      }

      div#c_ssmenu2 ul li a {
         color:{$this->fields['ssmenu2_link']} !important;
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

      ";
      return file_put_contents(CUSTOM_FILES_DIR."glpi_style.css", $CSS);
   }

   function post_addItem() {
      $this->post_updateItem();
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
