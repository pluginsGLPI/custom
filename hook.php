<?php

function plugin_get_headings_custom($item,$withtemplate) {
   global $LANG;

   if (get_class($item) == 'Profile') {
      if ($item->getField('id') && $item->getField('interface')!='helpdesk') {
         return array(1 => $LANG['plugin_custom']['name']);
      }

   }

   return false;
}

function plugin_headings_actions_custom($item) {
   $type = get_Class($item);

   if (in_array(get_class($item),array('Profile'))) {
      return array(1 => "plugin_headings_custom");
   }

   return false;
}


function plugin_headings_custom($item,$withtemplate=0) {
   global $CFG_GLPI;

   $profile = new PluginCustomProfile();
   switch (get_class($item)) {
      case 'Profile' :
         if (!$profile->getFromDBByProfile($item->getField('id')))
            $profile->createAccess($item->getField('id'));
         $profile->showForm($item->getField('id'),
            array(
               'target' => $CFG_GLPI["root_doc"]."/plugins/custom/front/profile.form.php"
            )
         );
         break;
   }

}


?>
