<?php
class PluginCustomTab extends CommonDBTM
{
   static function getTypeName() {
      global $LANG;

      return $LANG['plugin_custom']['type'][0];
   }

   public function canCreate() {
      return plugin_custom_haveRight('add_tabs', 1);
   }

   public function canView() {
      return plugin_custom_haveRight('add_tabs', 1);
   }

   function defineTabs($options=array()) {
      global $LANG, $CFG_GLPI;

      $ong = array();
      $this->addStandardTab('PluginCustomTabProfile', $ong, $options); 

      return $ong;
   }

   public function showForm($ID, $options=array()) {
      global $LANG;

      if ($ID > 0) {
         $this->check($ID,'r');
      } else {
         // Create item
         $this->check(-1,'w');
      }

      $this->showTabs($options);
      $this->showFormHeader($options);

      echo "<tr class='tab_bg_1'>";
      echo "<td>".$LANG['common'][90]."&nbsp;:</td>";
      echo "<td>";
      $this->itemtypeDropdown();
      echo "</td>";
      echo "<td>".$LANG['plugin_custom']['form'][0]."&nbsp;:</td>";
      echo "<td>";
      $this->tabDropdown();
      echo "</td></tr>\n";

      echo "<tr class='tab_bg_1'>";
      echo "<td>".$LANG['plugin_custom']['form'][1]."&nbsp;:</td>";
      echo "<td colspan='3' class='preview-tabs'>";
      foreach($this->getColoredTabs() as $tab) {
         //echo $tab."<br class='clear' />";
         echo $tab;
      }
      echo "</td></tr>\n";

      $this->showFormButtons($options);
      $this->addDivForTabs();

      return true;
   }

   public function getColoredTabs() {
      return array(
         "<div class='tabs-forms'><input type='radio' name='color' value='red' ".
            (($this->fields['color']=='red') ? "checked":"")."/>".$this->getTab('red')."</div>",
         "<div class='tabs-forms'><input type='radio' name='color' value='blue' ".
            (($this->fields['color']=='blue') ? "checked":"")."/>".$this->getTab('blue')."</div>",
         "<div class='tabs-forms'><input type='radio' name='color' value='black' ".
            (($this->fields['color']=='black') ? "checked":"")."/>".$this->getTab('black')."</div>",
         "<div class='tabs-forms'><input type='radio' name='color' value='green' ".
            (($this->fields['color']=='green') ? "checked":"")."/>".$this->getTab('green')."</div>",
         "<div class='tabs-forms'><input type='radio' name='color' value='white' ".
            (($this->fields['color']=='white') ? "checked":"")."/>".$this->getTab('white')."</div>",
         "<div class='tabs-forms'><input type='radio' name='color' value='deleted' ".
            (($this->fields['color']=='deleted') ? "checked":"")."/>".
            $this->getTab('deleted')."</div>"
      );
   }

   public function getTab($color) {
      global $LANG;

      if ($color != "deleted") {
         $out = "<ul class='x-tab-strip x-tab-strip-top'>";
         $out .= "<li class='custom_heading $color'>";
            $out .= "<a class='x-tab-strip-close'></a>";
            $out .= "<a class='x-tab-right right-colored-$color' href='#'>";
            $out .= "<em class='x-tab-left left-colored-$color'>";
               $out .= "<span class='x-tab-strip-inner inner-colored-$color'>";
                  $out .= "<span class='x-tab-strip-text'>";
                     $out .= "<span class='nm_headings custom_headings-$color'>".
                        $LANG['plugin_custom']['form'][0]."</span>";
                  $out .= "</span>";
               $out .= "</span>";
            $out .= "</em>";
            $out .= "</a>";
         $out .= "</li>";
         $out .= "</ul>";
      } else {
         $out = "<img src='../pics/deleted.png' alt='".$LANG['plugin_custom']['color']['deleted']
            ."' title='".$LANG['plugin_custom']['color']['deleted']."' class='picto_del' />&nbsp;";
         $out.= $LANG['plugin_custom']['color']['deleted'];
      }
      return $out;
   }

   public static function getTypes() {
      global $LANG;

      return array(
         'central'           => $LANG['central'][5],
         'computer'           => $LANG['Menu'][0],
         'networkequipment'   => $LANG['Menu'][1],
         'printer'            => $LANG['Menu'][2],
         'monitor'            => $LANG['Menu'][3],
         'software'           => $LANG['Menu'][4],
         'ticket'             => $LANG['Menu'][5],
         'user'               => $LANG['Menu'][14],
         'cartridgeitem'      => $LANG['Menu'][21],
         'contact'            => $LANG['Menu'][22],
         'supplier'           => $LANG['Menu'][23],
         'contract'           => $LANG['Menu'][25],
         'document'           => $LANG['Menu'][27],
         'state'              => $LANG['Menu'][28],
         'consumableitem'     => $LANG['Menu'][32],
         'phone'              => $LANG['Menu'][34],
         'profile'            => $LANG['Menu'][35],
         'group'              => $LANG['Menu'][36],
         'entity'             => $LANG['Menu'][37]
      );
   }

   public function itemtypeDropdown() {
      global $CFG_GLPI;

      $itemtypes = self::getTypes();

      echo "<select name='itemtype' id='tabsitemtype'>";
      echo "<option value='0'>".Dropdown::EMPTY_VALUE."</option>\n";
      foreach ($itemtypes as $key => $value) {
         if ($this->fields['id'] > 0 && $this->fields['itemtype'] == $key)
            echo "<option value='$key' selected='selected'>$value</option>";
         else echo "<option value='$key'>$value</option>";
      }
      echo "</select>";

      $params=array(
         'itemtype'  => '__VALUE__',
         'myname'    => 'tabstab',
         'value'     => $this->fields['tab'],
         'id'     => $this->fields['id']
      );

      Ajax::updateItemOnSelectEvent('tabsitemtype', 'tabstab', $CFG_GLPI["root_doc"].
                                  "/plugins/custom/ajax/dropdowntab.php", $params);

   }

   public function tabDropdown() {
      global $CFG_GLPI;

      echo "<br><span id='tabstab'>&nbsp;</span>\n";

      if ($this->fields['id'] > 0) {
         $params=array(
            'itemtype'  => $this->fields['itemtype'],
            'myname'    => 'tabstab',
            'value'     => $this->fields['tab'],
            'id'     => $this->fields['id']
         );

         Ajax::updateItem('tabstab', $CFG_GLPI["root_doc"].
                                     "/plugins/custom/ajax/dropdowntab.php", $params);
      }
   }

   public static function getItemtype() {

      $file = substr(strrchr($_SERVER['HTTP_REFERER'], "/"), 1);
      $itemtype = substr($file, 0,strpos($file, '.'));

      return $itemtype;
   }

   public static function escapeTabName($name) {
      $name = str_replace("$", "\\\\$", $name);
      return $name;
   }
}

?>
