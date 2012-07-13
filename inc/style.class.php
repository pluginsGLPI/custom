<?php
class PluginCustomStyle {
   static function getRegex() {
      return array(
         'link_color'       => '#^a, a:link.*color.*: (.*);#ismU',
         'link_hover_color' => '#^a:hover.*color.*: (.*);#ismU'
      );
   }

   static function getCurrentStyle() {
      $regex_list = self::getRegex();
      $css_file = file_get_contents(GLPI_ROOT."/css/styles.css");

      $styles = array();
      foreach($regex_list as $key => $regex) {
         preg_match($regex, $css_file, $matches);
         $styles[$key] = self::GetColor($matches[1]);
      }

      return $styles;
   }

   static function showForm() {
      global $LANG;

      $current_style = self::getCurrentStyle();

      echo "<form name='form' method='post' action=''>";
      echo "<div class='spaced' id='tabsbody'>";
      echo "<table class='tab_cadre_fixe'>";

      echo "<tr><th colspan='4'>".$LANG['plugin_custom']['config'][2]."</th></tr>";
      

      echo "<tr>";
      echo "<td>"."##LINK_COLOR##"."</td>";
      echo "<td>";
      self::colorInput('link_color', $current_style['link_color']);
      echo "</td>";


      echo "<td>"."##HOVER_LINK_COLOR##"."</td>";
      echo "<td>";
      self::colorInput('link_hover_color', $current_style['link_hover_color']);
      echo "</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td class='tab_bg_2 center'>\n";
      echo "<input type='submit' name='update' value=\"".$LANG['buttons'][7]."\" class='submit'>";
      echo "</td></tr>\n";
      echo "</table></div>";
      echo "</form>";
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
                  name:'backcolor',
                  colorSelector:'mixer'
            }]
         });
      });
JAVASCRIPT;

      echo "<script type='text/javascript'>";
      echo $JS;
      echo "</script>";
   }


 
   static function GetColor($Colorname) { 
      $Colors  =  ARRAY( 
 
         //  Colors  as  they  are  defined  in  HTML  3.2 
         "black"                => "#000000", 
         "maroon"               => "#800000", 
         "green"                => "#008000", 
         "olive"                => "#808000", 
         "navy"                 => "#000080", 
         "purple"               => "#800080", 
         "teal"                 => "#008080", 
         "gray"                 => "#808080", 
         "silver"               => "#C0C0C0", 
         "red"                  => "#FF0000", 
         "lime"                 => "#00FF00", 
         "yellow"               => "#FFFF00", 
         "blue"                 => "#0000FF", 
         "fuchsia"              => "#FF00FF", 
         "aqua"                 => "#00FFFF", 
         "white"                => "#FFFFFF", 
         
         //  Additional  colors  as  they  are  used  by  Netscape  and  IE 
         "aliceblue"            => "#F0F8FF", 
         "antiquewhite"         => "#FAEBD7", 
         "aquamarine"           => "#7FFFD4", 
         "azure"                => "#F0FFFF", 
         "beige"                => "#F5F5DC", 
         "blueviolet"           => "#8A2BE2", 
         "brown"                => "#A52A2A", 
         "burlywood"            => "#DEB887", 
         "cadetblue"            => "#5F9EA0", 
         "chartreuse"           => "#7FFF00", 
         "chocolate"            => "#D2691E", 
         "coral"                => "#FF7F50", 
         "cornflowerblue"       => "#6495ED", 
         "cornsilk"             => "#FFF8DC", 
         "crimson"              => "#DC143C", 
         "darkblue"             => "#00008B", 
         "darkcyan"             => "#008B8B", 
         "darkgoldenrod"        => "#B8860B", 
         "darkgray"             => "#A9A9A9", 
         "darkgreen"            => "#006400", 
         "darkkhaki"            => "#BDB76B", 
         "darkmagenta"          => "#8B008B", 
         "darkolivegreen"       => "#556B2F", 
         "darkorange"           => "#FF8C00", 
         "darkorchid"           => "#9932CC", 
         "darkred"              => "#8B0000", 
         "darksalmon"           => "#E9967A", 
         "darkseagreen"         => "#8FBC8F", 
         "darkslateblue"        => "#483D8B", 
         "darkslategray"        => "#2F4F4F", 
         "darkturquoise"        => "#00CED1", 
         "darkviolet"           => "#9400D3", 
         "deeppink"             => "#FF1493", 
         "deepskyblue"          => "#00BFFF", 
         "dimgray"              => "#696969", 
         "dodgerblue"           => "#1E90FF", 
         "firebrick"            => "#B22222", 
         "floralwhite"          => "#FFFAF0", 
         "forestgreen"          => "#228B22", 
         "gainsboro"            => "#DCDCDC", 
         "ghostwhite"           => "#F8F8FF", 
         "gold"                 => "#FFD700", 
         "goldenrod"            => "#DAA520", 
         "greenyellow"          => "#ADFF2F", 
         "honeydew"             => "#F0FFF0", 
         "hotpink"              => "#FF69B4", 
         "indianred"            => "#CD5C5C", 
         "indigo"               => "#4B0082", 
         "ivory"                => "#FFFFF0", 
         "khaki"                => "#F0E68C", 
         "lavender"             => "#E6E6FA", 
         "lavenderblush"        => "#FFF0F5", 
         "lawngreen"            => "#7CFC00", 
         "lemonchiffon"         => "#FFFACD", 
         "lightblue"            => "#ADD8E6", 
         "lightcoral"           => "#F08080", 
         "lightcyan"            => "#E0FFFF", 
         "lightgoldenrodyellow" => "#FAFAD2", 
         "lightgreen"           => "#90EE90", 
         "lightgrey"            => "#D3D3D3", 
         "lightpink"            => "#FFB6C1", 
         "lightsalmon"          => "#FFA07A", 
         "lightseagreen"        => "#20B2AA", 
         "lightskyblue"         => "#87CEFA", 
         "lightslategray"       => "#778899", 
         "lightsteelblue"       => "#B0C4DE", 
         "lightyellow"          => "#FFFFE0", 
         "limegreen"            => "#32CD32", 
         "linen"                => "#FAF0E6", 
         "mediumaquamarine"     => "#66CDAA", 
         "mediumblue"           => "#0000CD", 
         "mediumorchid"         => "#BA55D3", 
         "mediumpurple"         => "#9370D0", 
         "mediumseagreen"       => "#3CB371", 
         "mediumslateblue"      => "#7B68EE", 
         "mediumspringgreen"    => "#00FA9A", 
         "mediumturquoise"      => "#48D1CC", 
         "mediumvioletred"      => "#C71585", 
         "midnightblue"         => "#191970", 
         "mintcream"            => "#F5FFFA", 
         "mistyrose"            => "#FFE4E1", 
         "moccasin"             => "#FFE4B5", 
         "navajowhite"          => "#FFDEAD", 
         "oldlace"              => "#FDF5E6", 
         "olivedrab"            => "#6B8E23", 
         "orange"               => "#FFA500", 
         "orangered"            => "#FF4500", 
         "orchid"               => "#DA70D6", 
         "palegoldenrod"        => "#EEE8AA", 
         "palegreen"            => "#98FB98", 
         "paleturquoise"        => "#AFEEEE", 
         "palevioletred"        => "#DB7093", 
         "papayawhip"           => "#FFEFD5", 
         "peachpuff"            => "#FFDAB9", 
         "peru"                 => "#CD853F", 
         "pink"                 => "#FFC0CB", 
         "plum"                 => "#DDA0DD", 
         "powderblue"           => "#B0E0E6", 
         "rosybrown"            => "#BC8F8F", 
         "royalblue"            => "#4169E1", 
         "saddlebrown"          => "#8B4513", 
         "salmon"               => "#FA8072", 
         "sandybrown"           => "#F4A460", 
         "seagreen"             => "#2E8B57", 
         "seashell"             => "#FFF5EE", 
         "sienna"               => "#A0522D", 
         "skyblue"              => "#87CEEB", 
         "slateblue"            => "#6A5ACD", 
         "slategray"            => "#708090", 
         "snow"                 => "#FFFAFA", 
         "springgreen"          => "#00FF7F", 
         "steelblue"            => "#4682B4", 
         "tan"                  => "#D2B48C", 
         "thistle"              => "#D8BFD8", 
         "tomato"               => "#FF6347", 
         "turquoise"            => "#40E0D0", 
         "violet"               => "#EE82EE", 
         "wheat"                => "#F5DEB3", 
         "whitesmoke"           => "#F5F5F5", 
         "yellowgreen"          => "#9ACD32"
      );   
      if (array_key_exists($Colorname, $Colors)) return $Colors[$Colorname]; 
      else return $Colorname;
   }
}
?>
