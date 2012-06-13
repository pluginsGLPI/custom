<?php


if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access directly to this file");
}

class PluginCustomProfile extends CommonDBTM {

   static function getTypeName() {
      global $LANG;

      return $LANG['plugin_custom']['profile'][0];
   }

   function canCreate() {
      return haveRight('profile', 'w');
   }

   function canView() {
      return haveRight('profile', 'r');
   }

   //if profile deleted
   static function purgeProfiles(Profile $prof) {
      $plugprof = new self();
      $plugprof->cleanProfiles($prof->getField("id"));
   }

   function cleanProfiles($ID) {
      global $DB;

      $query = "DELETE
            FROM `".$this->getTable()."`
            WHERE `profiles_id` = '$ID' ";

      $DB->query($query);
   }

   function getFromDBByProfile($profiles_id) {
      global $DB;

      $query = "SELECT * FROM `".$this->getTable()."`
               WHERE `profiles_id` = '" . $profiles_id . "' ";
      if ($result = $DB->query($query)) {
         if ($DB->numrows($result) != 1) {
            return false;
         }
         $this->fields = $DB->fetch_assoc($result);
         if (is_array($this->fields) && count($this->fields)) {
            return true;
         } else {
            return false;
         }
      }
      return false;
   }

   static function createFirstAccess($ID) {

      $myProf = new self();
      if (!$myProf->getFromDBByProfile($ID)) {

         $myProf->add(array(
            'profiles_id' => $ID,
            'view_color' => '1',
            'add_tabs' => 'w'
         ));

      }
   }

   function createAccess($ID) {

      $this->add(array(
      'profiles_id' => $ID));
   }

   static function changeProfile() {
      $prof = new self();
      if ($prof->getFromDBByProfile($_SESSION['glpiactiveprofile']['id'])) {
         $_SESSION["glpi_plugin_custom_profile"]=$prof->fields;
      } else {
         unset($_SESSION["glpi_plugin_custom_profile"]);
      }
   }

   //profiles modification
   function showForm($ID, $options=array()) {
      global $LANG;

      $target = $this->getFormURL();
      if (isset($options['target'])) {
        $target = $options['target'];
      }

      if (!haveRight("profile","r")) {
         return false;
      }

      $prof = new Profile();
      if ($ID) {
         $this->getFromDBByProfile($ID);
         $prof->getFromDB($ID);
      }

      $this->showFormHeader($options);

      echo "<tr class='tab_bg_2'>";
      echo "<td>".$LANG['plugin_custom']['profile'][0] ." : </td><td>";
      if ($prof->fields['interface'] != 'helpdesk') {
         Dropdown::showYesNo("view_color",$this->fields["view_color"]);
      } else {
         echo $LANG['profiles'][12]; // No access;
      }
      echo "</td>";

      echo "<td>".$LANG['plugin_custom']['profile'][1] ." : </td><td>";
      if ($prof->fields['interface'] != 'helpdesk') {
         Profile::dropdownNoneReadWrite("add_tabs",$this->fields["add_tabs"],1,0,1);
      } else {
         echo $LANG['profiles'][12]; // No access;
      }
      echo "</td>";
      echo "</tr>";

      echo "<input type='hidden' name='id' value=".$this->fields["id"].">";

      $options['candel'] = false;
      $this->showFormButtons($options);
   }
}

?>
