var cartCount = 0;

window.onload = function(){
var note = document.getElementById("notes");
note.innerHTML = "testing";
document.getElementById("cart").innerHTML = 0;
};

function showUser(){
	if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
			document.getElementById("notes").innerHTML = "testing2";
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			document.getElementById("notes").innerHTML = "testing3";
        }
		
					document.getElementById("notes").innerHTML = "goint to second part";

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("notes").innerHTML = xmlhttp.responseText;
            }else{
				document.getElementById("notes").innerHTML = "failed 3rd part";
			}
		};
		
		xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
}

function myfunction(parent){
	document.getElementById("cart").innerHTML = ++cartCount;
	document.getElementById("notes").innerHTML = "testing";

	var itemToAddToCart = <?php $array[parent]['item_id']?>;
		document.getElementById("notes").innerHTML = "chldNode 1 value is" + itemToAddToCart;
}
	
function buttonName(){
	
		document.getElementById("notes2").innerHTML = "test again";
	var length = document.getElementsByTagName("LI").length;

	for(var i = 0; i < length; i++){
		document.getElementsByTagName("LI")[i].setAttribute(<?php echo $array[i]['item_id']?>));
		<?php echo $array[i]['item_id']?>
	}
}