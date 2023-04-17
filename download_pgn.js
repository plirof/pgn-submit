function create_download_button(){
	let btn2 = document.createElement("button");
	btn2.innerHTML = "download pgn";
	//btn.onclick = send_pgn_to_lichess(pgn_moves); //NOT working
	btn2.onclick = function(){saveTextAsFile(textToWrite,'pgn.txt',"text/plain")}; 
	document.body.appendChild(btn2);

	/* <input type="button" value="Send to lichess" onclick="send_pgn_to_lichess('<?php echo $_REQUEST["hiddenpgntextarea"]; ?>')"> */
}



function saveTextAsFile(textToWrite, fileNameToSaveAs='pgn.txt', fileType="text/plain") {
    let textFileAsBlob = new Blob([textToWrite], { type: fileType });
    let downloadLink = document.createElement('a');
    downloadLink.download = fileNameToSaveAs;
    downloadLink.innerHTML = 'Download File';

    if (window.webkitURL != null) {
        downloadLink.href = window.webkitURL.createObjectURL(
            textFileAsBlob
        );
    } else {
        downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
        downloadLink.style.display = 'none';
        document.body.appendChild(downloadLink);
    }

    downloadLink.click();
}	





create_download_button();