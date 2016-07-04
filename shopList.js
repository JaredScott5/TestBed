<!--JavaScript -->
<script language="javascript" type="text/javascript">
<!-- Global Var-->
var cartCount = 0;

window.onload = function(){
var note = document.getElementById("notes");
note.innerHTML = "testing";
document.getElementById("cart").innerHTML = 0;
};

function showUser(){
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
			document.getElementById("notes").innerHTML = "testing2";
        } else {
            // code for IE6, IE5
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
	//part 1 known to work
	document.getElementById("cart").innerHTML = ++cartCount;
	document.getElementById("notes").innerHTML = "testing";

	//part 2
	var itemToAddToCart = <?php $array[parent]['item_id']?>;
		document.getElementById("notes").innerHTML = "chldNode 1 value is" + itemToAddToCart;
	//document.getElementById("notes").innerHTML = "testing";

	//showUser();
}
	
function buttonName(){
	
		document.getElementById("notes2").innerHTML = "test again";
		//give each li a name that is the item_id
		//ex) LI1 is now item_id[0], LI2 is now item_id[1], etc
	var length = document.getElementsByName("LI").length;

	for(var i = 0; i < length; i++){
		document.getElementsByName("LI")[i].setAttribute(<?php echo $array[i]['item_id']?>));
		<?php echo $array[i]['item_id']?>
	}//end for
}//end function buttonName

</script>