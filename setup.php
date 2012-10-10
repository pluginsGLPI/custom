<?php

include_once (GLPI_ROOT . "/plugins/custom/inc/install.function.php");
define("CUSTOM_FILES_DIR", GLPI_ROOT."/files/_plugins/custom/");

// Init the hooks of the plugins -Needed
function plugin_init_custom() {
   global $PLUGIN_HOOKS, $LANG, $CFG_GLPI;


   $menu_entry   = "front/config.php";
   if (!isset($_SESSION['glpiactiveprofile']['config']) 
      || $_SESSION['glpiactiveprofile']['config'] != "w") $menu_entry  = false;
   $PLUGIN_HOOKS['menu_entry']['custom']  = $menu_entry;
   
   $PLUGIN_HOOKS['config_page']['custom'] = $menu_entry;

   $PLUGIN_HOOKS['submenu_entry']['custom']['options']['tab'] = array(
      'title' => $LANG['plugin_custom']['title'][0],
      'page'  =>'/plugins/custom/front/tab.php',
      'links' => array(
         'search' => '/plugins/custom/front/tab.php',
         'add'    =>'/plugins/custom/front/tab.form.php'
   ));
   $PLUGIN_HOOKS['submenu_entry']['custom']['options']['defaulttab'] = array(
      'title' => $LANG['plugin_custom']['title'][1],
      'page'  =>'/plugins/custom/front/defaulttab.php',
      'links' => array(
         'search' => '/plugins/custom/front/defaulttab.php',
         'add'    =>'/plugins/custom/front/defaulttab.form.php'
   ));   
   $PLUGIN_HOOKS['submenu_entry']['custom']['options']['style'] = array(
      'title' => $LANG['plugin_custom']['title'][2],
      'page'  =>'/plugins/custom/front/style.form.php',
      'links' => array(
         'search' => '/plugins/custom/front/style.form.php',
         'add'    =>'/plugins/custom/front/style.form.php'
   ));
   
   $PLUGIN_HOOKS['helpdesk_menu_entry']['custom'] = false;
   
   $PLUGIN_HOOKS['add_javascript']['custom'][]    = 'selector.js.php';
   $PLUGIN_HOOKS['add_javascript']['custom'][]    = 'lib/colortools/ext.ux.color3.js';
   
   $PLUGIN_HOOKS['add_css']['custom'][]           = 'lib/colortools/ext.ux.color3.css';
   Toolbox::logDebug(getcwd());
   if (file_exists(CUSTOM_FILES_DIR."glpi_style.css")) {
      $PLUGIN_HOOKS['add_css']['custom'][]        = '../../files/_plugins/custom/glpi_style.css';
   }
   $PLUGIN_HOOKS['add_css']['custom'][]           = 'style.css';
   
   
   /*$PLUGIN_HOOKS['change_profile']['custom']      = array('PluginCustomProfile','changeProfile');
   
   $PLUGIN_HOOKS['headings']['custom']            = 'plugin_get_headings_custom';
   $PLUGIN_HOOKS['headings_action']['custom']     = 'plugin_headings_actions_custom';*/
   
   $PLUGIN_HOOKS['csrf_compliant']['custom']      = true;

}


// Get the name and the version of the plugin - Needed
function plugin_version_custom() {
   global $LANG;

   return array('name'           => $LANG['plugin_custom']['name'],
                'version'        => "1.0.1",
                'author'         => "<a href='mailto:adelaunay@teclib.com'>Alexandre DELAUNAY</a> ".
                  "- <a href='http://www.teclib.com'>Teclib'</a>",
                'homepage'       => "http://www.teclib.com/glpi/plugins/color",
                'minGlpiVersion' => "0.83");
}


// Optional : check prerequisites before install : may print errors or add to message after redirect
function plugin_custom_check_prerequisites() {

   if (GLPI_VERSION >= 0.83) {
      return true;
   } else if (!extension_loaded("gd")) {
      echo "php-gd required";
   } else {
      echo "GLPI version not compatible need 0.83";
   }
}


// Check configuration process for plugin : need to return true if succeeded
// Can display a message only if failure and $verbose is true
function plugin_custom_check_config($verbose=false) {
   global $LANG;

   if (true) { // Your configuration check
      return true;
   }
   if ($verbose) {
      echo $LANG['plugins'][2];
   }
   return false;
}


function plugin_custom_haveRight($module,$right) {
   $matches=array(""  => array("","r","w"), // ne doit pas arriver normalement
                  "r" => array("r","w"),
                  "w" => array("w"),
                  "1" => array("1"),
                  "0" => array("0","1")); // ne doit pas arriver non plus

   if (isset($_SESSION["glpi_plugin_custom_profile"][$module])
       && in_array($_SESSION["glpi_plugin_custom_profile"][$module],$matches[$right])) {
      return true;
   }
   return false;
}
?>
