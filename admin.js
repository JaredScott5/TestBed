window.onload = function(){
  var searchTerm = document.getElementById("search_bar");
};

function search(searchTerm){
	
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

function goTo(){
	
	//check if not a number
	if(isNaN(user)){
		//if true, check my username
		
		//if result is false, check by email
	}else{
		
	}
	//if flase, seach by id
	//else if it has a '@', check by email
	//else then just check my username
	

	//else, return as failure aka no such userAgent
}