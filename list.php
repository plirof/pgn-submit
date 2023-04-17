<?php
/* List all SWF files in subfolders
v004 - 20150130c 


To Do : remove HARD CODED str_replace
*/

echo "<h2>list all files</h2>";
$debug=false;
$show_rating=false;
$file_extension='.pgn'; //TODO to implement this variable

$dir_starting ='/home12/trister/public_html/spec12.com/games/swf';
$dir_starting='pgn_saved_data';
//$dir_starting ='E:/incoming_/games_fun_/Flash_SWF_Games_/';
$dir_rating=$dir_starting.'/ratingtxt/';



function checkIfRatingExists($ff){
	global $debug;
	global $show_rating,$rating_array;
	if($debug) 	echo "<h3>checkIfRatingExists  : ff=$ff</H3>";
	foreach ($rating_array as $rated_item) {
		if($rated_item[0]==$ff) {
			if($debug) 	echo "<h1>YESSSSSSSS $ff</H1>";
			
			if ($rated_item[1]>6){
				return "<font color=red> <b>(rating : ".$rated_item[1]." )</b></font>";}
			else {
				return " (rating : ".$rated_item[1]." )";
			}
			
		}
	}	
	
	
return "-";
}


function listFolderFiles($dir){
global $dir_starting,$debug;
global $show_rating,$dir_rating,$file_extension;
    $ffs = scandir($dir);
    //if($debug) echo "<h3>SCANDIR ".$dir."</h3>";
    $sub_dir = str_replace($dir_starting, ".", $dir);
    //if($debug) echo "<h3>SCANDIR ".$sub_dir."</h3>";
    
	echo '<ol>';
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            //echo '<li>'.$ff;
            if(strpos($ff,$file_extension) ) { //if we have an .swf file
            	$average_rating="";
				//if($show_rating)$average_rating=checkIfRatingExists($ff);
				//echo "<h1>$average_rating</h1>";
				//print_r($average_rating);
//				echo "<hr><li><a href=".$sub_dir.'/'.$ff." target='_blank' >$ff</a> " .$average_rating; //file  ORIG line
				echo "<hr><li><a href=opengame_ruffle.php?file=".$sub_dir.'/'.$ff." target='_blank' >$ff</a> " .$average_rating; //file
			}
			
            if(is_dir($dir.'/'.$ff)) {
            	echo "<hr><hr> <li><details><summary>$ff</summary></a>"; //folder
            	listFolderFiles($dir.'/'.$ff);
            	echo "</details>";
            }
            //if($debug) echo "<h3>".$dir.'/'.$ff."</h3>";
            echo '</li>';
        }
    }
    echo '</ol>';
}




function createRatingArray($ratings){
	global $debug;
	global $show_rating;
	$counter=0;
	foreach ($ratings as $line) {
		if($debug) echo "<hr>line: $line<br>";
		$line_exploded=explode('^', $line,4);
		//if($debug) echo "<br>line_exploded: $line_exploded";
		if($debug) print_r($line_exploded);
		$line_exploded[0] = str_replace('rt_', "", $line_exploded[0]);
		$rating_array[$counter][0]=$line_exploded[0];
		$rating_array[$counter][1]=$line_exploded[1]/$line_exploded[2];// AVERAGE rating
		
		$counter++;
	}

	
return $rating_array;
}

//$rating_array = explode('^', file($dir_rating.'rtgitems.txt'));
if($show_rating) {
	$ratings =  file($dir_rating.'rtgitems.txt');
	if($debug) print_r($ratings);
	$rating_array=createRatingArray($ratings);
	if($debug) print_r($rating_array);
}//end of if($show_rating) {

listFolderFiles($dir_starting);

    
//print_r($list);
//var_dump($a);



if($debug) echo "<h3>aaaaaaa</h3>";





?>