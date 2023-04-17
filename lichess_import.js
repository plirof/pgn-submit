

url_api="https://lichess.org/api/import";


/* <form method="post" class="form3 import" action="<?php echo $url; ?>">
<textarea id="form3-pgn" name="pgn" class="form-control"></textarea>
<input type="submit" name="">
</form>
*/

/* responce is like this : {"id":"VXuKxPko","url":"https://lichess.org/VXuKxPko"}
must grab URL and open it on new tab


let btn = document.createElement("button");
btn.innerHTML = "Click Me";
document.body.appendChild(btn);


*/

function create_lichess_import_button(){
	let btn = document.createElement("button");
	btn.innerHTML = "Send to lichess";
	//btn.onclick = send_pgn_to_lichess(pgn_moves); //NOT working
	btn.onclick = function(){send_pgn_to_lichess(pgn_moves)}; 
	document.body.appendChild(btn);

	/* <input type="button" value="Send to lichess" onclick="send_pgn_to_lichess('<?php echo $_REQUEST["hiddenpgntextarea"]; ?>')"> */
}


function send_pgn_to_lichess(pgn_moves){
	const url=url_api;
	const data = JSON.stringify({pgn:pgn_moves});
	
	//var data = JSON.stringify({pgn:pgn_moves});
	fetch(url, {
	  method: 'POST',
	  headers: {
	    'Accept': 'application/json, text/plain, */*',
	    'Content-Type': 'application/json'
	  },
	  body: data
	}).then(res => res.json())
	  .then(res => {
	  	console.log(res); 
	  	console.log("send_pgn_to_lichess(pgn_moves)   "+res.url) ;
	  	window.open(res.url,'_blank' ); //open link on new tab

	  }


	  	);
 }// end of send_pgn_to_lichess(pgn_moves){

create_lichess_import_button();
