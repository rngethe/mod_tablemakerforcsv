﻿<?php
/**
* @Author  Mostafa Shahiri
*@license	GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/
 defined('_JEXEC') or die();

 $document = JFactory::getDocument();
 $document->addScript('modules/mod_tablemakerforcsv/js/jquery.dataTables.min.js');
 $script="jQuery('document').ready(function(){
	pagination(".$row_num.");

});";
 $document->addCustomTag( '<script type="text/javascript">'.$script.'</script>' );

$style=".csvtable".$moduleclass_sfx."{
    text-align:".$textalign.";
    font:".$tablefont.";
    border-radius:".$borderradius.";
    ".$table_style."
}
.csvtable".$moduleclass_sfx." td{
padding:".$padding.";
}
.csvtable".$moduleclass_sfx." tr:nth-child(even) td{
    background: ".$evenbg.";
}
.csvtable".$moduleclass_sfx." tr:nth-child(odd) td{
    background: ".$oddbg.";
}
.csvtable".$moduleclass_sfx." tr:first-child  td{
background:".$firstrow_bg.";
color:".$firstrow_color.";
font:".$firstrow_font.";
}
#csvpagination a{
background:".$paglink_bg.";
color:".$paglink_color.";
margin:5px;
}
#csvpagination a.active{
background:".$paglink_active.";
}
#csvpagination a:hover{
background:".$paglink_hoverbg.";
color:".$paglink_hovercolor.";
}
#csvpagination{
text-align:".$pagalign.";}";
$document->addStyleDeclaration($style);
 if(trim($pretext)!="")
 {
 echo '<div class="pretext">'.$pretext.'</div>';
 }
 if($fileurl!="")
 {
  $file = fopen('images/'.$fileurl,"r");
 echo '<input type="text" id="csvlookup" onkeyup="lookuptable('.$row_num.','.$min_char.')" placeholder="Search for ..."><br/>';
 echo '<table class="csvtable'.$moduleclass_sfx.'" id="csvtable">';
 if(trim($captions)!="")
 {
  echo '<tr>';
   for($i=0;$i<count($caption);$i++)
  {
   echo '<td>'.$caption[$i].'</td>';
  }
   echo '</tr>';

 }
//setlocale(LC_ALL, 'UTF-8');
//mb_internal_encoding('UTF-8');
while($f=fgetcsv($file,1000,$separator))
{

//$f = array_map("utf8_encode", $f);
echo '<tr>';
for($i=0;$i<count($f);$i++)
{
   echo '<td>'.$f[$i].'</td>';
}
echo '</tr>';
}
echo '</table>';
 echo	'<div id="csvpagination"></div>';
fclose($file);
}
 if(trim($posttext)!="")
 {
 echo '<div class="posttext">'.$posttext.'</div>';
 }