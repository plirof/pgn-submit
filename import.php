<?php


$url="https://lichess.org/api/import";


?>
<form method="post" class="form3 import" action="<?php echo $url; ?>">
<textarea id="form3-pgn" name="pgn" class="form-control"></textarea>
<input type="submit" name="">
</form>

responce is like this : {"id":"VXuKxPko","url":"https://lichess.org/VXuKxPko"}
must grab URL and open it on new tab


<script type="text/javascript">
	

const Http = new XMLHttpRequest();
const url='<?php echo $url; ?>';
const uri=url;
/*
Http.open("POST", url);
Http.send();

Http.onreadystatechange = (e) => {
  console.log(Http.responseText)
}

*/
var data_pgn="1. e4 e6 2. d4 Nf6 *";
data = JSON.stringify({pgn:data_pgn});

    
    

fetch(url, {
  method: 'POST',
  headers: {
    'Accept': 'application/json, text/plain, */*',
    'Content-Type': 'application/json'
  },
  body: data
}).then(res => res.json())
  .then(res => {console.log(res); console.log(res.url) }


  	);
</script>


