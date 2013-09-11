<?php
include ("../../../inc/includes.php");

if (empty($_GET["id"])) {
   $_GET["id"] = "";
}


if (isset($_POST['itemtype']) && isset($_POST['tab'])
   && (isset($_POST["add"]) || isset($_POST["update"]))) {
   $itemtype = $_POST['itemtype'];
   $obj = new $_POST['itemtype'];
   $obj->fields['id'] = 1;
   if ($itemtype == "ticket") {
      $obj->fields['status'] = "closed";
   }

   //get object tabs
   $tabs = $obj->defineTabs();

   /*//get object plugins tabs
   $tmp_plug_tabs = Plugin::getTabs('', $obj, false);
   $plug_tabs = array();
   foreach($tmp_plug_tabs as $key => $tab) {
      $plug_tabs[$key] = $tab['title'];
   }
   $tabs += $plug_tabs;*/

   //construct name field
   $tabs = $tabs[$_POST['tab']];
   $types = PluginCustomTab::getTypes();
   $itemtype = $types[$_POST['itemtype']];
   $_POST['name'] = $itemtype."-".$tabs;
}

$tabs = new PluginCustomDefaulttab;

if (isset($_POST["add"])) {

   $tabs->check(-1,'w',$_POST);
   $newID = $tabs->add($_POST);
   Html::redirect($CFG_GLPI["root_doc"]."/plugins/custom/front/defaulttab.form.php");

} elseif (isset($_POST["delete"])) {
   $tabs->check($_POST['id'],'d');
   $ok = $tabs->delete($_POST);
   Html::redirect($CFG_GLPI["root_doc"]."/plugins/custom/front/defaulttab.php");

} elseif (isset($_REQUEST["purge"])) {
   $tabs->check($_REQUEST['id'],'d');
   $tabs->delete($_REQUEST,1);
   Html::redirect($CFG_GLPI["root_doc"]."/plugins/custom/front/defaulttab.php");

} elseif (isset($_POST["update"])) {
   $tabs->check($_POST['id'],'w');
   $tabs->update($_POST);
   Html::back();

} else {
   Html::header($LANG['plugin_custom']["name"], $_SERVER['PHP_SELF'], "plugins", "custom",
      "defaulttab"
   );
   $tabs->showForm($_GET["id"]);
   Html::footer();
}


?>
