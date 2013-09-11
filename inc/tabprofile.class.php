<?php
class PluginCustomTabProfile extends CommonDBTM
{
   static function getTypeName($nb=0) {
      global $LANG;

      return $LANG['plugin_custom']['type'][0];
   }

   static function canCreate() {
      return plugin_custom_haveRight('add_tabs', 1);
   }

   static function canView() {
      return plugin_custom_haveRight('add_tabs', 1);
   }

   function getTabNameForItem(CommonGLPI $item, $withtemplate=0) {
      if ($item->getType() == 'PluginCustomTab' && $item->canView()) {
         return Toolbox::ucfirst(_n("Profile", "Profiles", 1));
      }
      return '';
   }

   static function displayTabContentForItem(CommonGLPI $item, $tabnum=1, $withtemplate=0) {
      $profile = new Profile;
      $found_profiles = $profile->find("`interface` = 'central'");

      $tab_profile = new self;
      $found_tab_profiles = $tab_profile->find("`plugin_custom_tabs_id` = ".$item->getID());

      echo "<form method='POST' action='tabprofile.form.php' />";
      echo "<table class='tab_cadre_fixe'>";
      echo "<tr><th colspan='4'>".__("Visibility")."</th></tr>";
      $odd = 0;
      foreach ($found_profiles as $profiles_id => $profile_fields) {
         if (($odd % 2) === 0) echo "<tr>";
         echo "<td>".$profile_fields['name']."</td>";
         echo "<td>";
         Dropdown::showYesNo("tab_profile[$profiles_id]", 0);
         echo "</td>";
         if (($odd % 2) === 1) echo "</tr>";
         
         $odd++;
      }
      if (($odd % 2) === 0) echo "</tr>";
      echo "<tr><td colspan='4'><div class='center'>";
      echo "<input type='submit' name='update' value=\""._sx('button','Post')."\" class='submit'>";
      echo "</div></td></tr>";
      echo "</table>";
      
      Html::closeForm();

      return true;
   }

}