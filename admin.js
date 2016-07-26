function search(){
	var searchTerm = document.getElementById("search_bar").value;
	document.getElementById("debug").innerHTML = "search bar variable is " + searchTerm;
	httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = displaySearchResult;
	httpRequest.open('POST', 'search.php');
	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	httpRequest.send("searchTerm="+searchTerm);
}

function displaySearchResult() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
		  //this line populates the page with data
        document.getElementById("finalResult").innerHTML = httpRequest.responseText;
      } else {
        alert('There was a problem with the request.');
      }
    }
  }
  catch( e ) {
    alert('Caught Exception: ' + e.description);
  }
}