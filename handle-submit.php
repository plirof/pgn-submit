<html lang="en">
  <head>
    <meta charset="utf-8">
   </head>
   <body>
<form>
 <input type="button" value="Go back!" onclick="history.back()">
</form>

<?php
/*
Changes
- 230516 fixed multiline JS variable assign from PHP problem
- 230416 -v008a -OK working lichess-import,download pgn
- 230416e - v07 Ok Seems lichess send
- 230416c - Ok Seems to work



*/
// file name different each time:  sn101-B2-DATE-paradopoulos.htm
// file contents : textarea + sn101-B2-DATE-paradopoulos

//$Event-
$enable_file_write=true; //Disable for internet (security)
$save_folder="pgn_saved_data";

print_r ($_REQUEST);


$mytext=$_REQUEST["text_entered"] ;

echo "<HR>";
//$cur_date= date('Ymd');
$file_name=$_REQUEST["date"]."-".$_REQUEST["Event"]."-".$_REQUEST["white_name"].'-'.$_REQUEST["black_name"]."-".date('Ymd').".pgn";

echo $file_name;
//$file_name=$cur_date;


//-------------------- CREATE PGN TEXT PART --------------
$txt=
'[Event "'.$_REQUEST["Event"].'"]
[Site "'.$_REQUEST["site"].'"]
[Date "'.$_REQUEST["date"].'"]
[Round "'.$_REQUEST["round"].'"]
[White "'.$_REQUEST["white_name"].'"]
[Black "'.$_REQUEST["black_name"].'"]
[Result "'.$_REQUEST["result"].'"]
[WhiteElo "'.$_REQUEST["white_elo"].'"]
[BlackElo "'.$_REQUEST["black_elo"].'"]
[ECO ""]
'.$_REQUEST["hiddenpgntextarea"];



//-------------------- FILE WRITE PART --------------

if(!$enable_file_write) {echo "<h4>- - filesave disabled - -</h4>";exit(0);};

$myfile = fopen($save_folder."/".$file_name, "w") or die("Unable to open file!");

/*
$txt = "<h2>$file_name</h2>\n"

.$_REQUEST["white_name"].'-'.$_REQUEST["black_name"]." \n"
.$_REQUEST["hiddenpgntextarea"]."

";
*/



fwrite($myfile, $txt);
//$txt = "$mytext\n";
//fwrite($myfile, $txt);
fclose($myfile);

echo "<HR><h2>Η εργασία σας καταχωρήθηκε.</h2> Παρακαλώ κλείστε αυτήν την καρτέλα.";


echo "<pre>$txt</pre>";
?>



<script type="text/javascript" src="lichess_import.js"></script>

<script type="text/javascript" src="download_pgn.js"></script>

<script type="text/javascript">
	//const pgn_moves='<php echo $_REQUEST["hiddenpgntextarea"]; >'; //for lichess_import.js
	const pgn_moves='<?php echo str_replace(array("\n","\r","\r\n"),'',$_REQUEST["hiddenpgntextarea"]); ?>'; //for lichess_import.js - 230516 fixed multiline JS variable assign from PHP problem
	//echo str_replace(array("\n","\r","\r\n"),'',$_REQUEST["hiddenpgntextarea"]);
	const textToWrite=`<?php echo $txt; ?>`; //for download_pgn.js NOTE use backticks
</script>
<HR>

</body> 
</html>