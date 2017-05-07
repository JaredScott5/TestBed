function edit_row(id)
{
 //var user_id=document.getElementById("user_id_val"+id).innerHTML;
 //var email=document.getElementById("email_val"+id).innerHTML;
 var orderDate=document.getElementById("orderDate_val"+id).innerHTML;
 var shippedDate=document.getElementById("shippedDate_val"+id).innerHTML;
 var status=document.getElementById("status_val"+id).innerHTML;
 var comments=document.getElementById("comments_val"+id).innerHTML;

 console.log("OD:", orderDate, "SD: ", shippedDate, "Status: ", status, "Comments: ", comments);
 
 //document.getElementById("user_id_val"+id).innerHTML="<input type='text' id='user_id_text"+id+"' value='"+user_id+"'>";
 //document.getElementById("email_val"+id).innerHTML="<input type='text' id='email_text"+id+"' value='"+email+"'>";
 document.getElementById("orderDate_val"+id).innerHTML="<input type='text' id='orderDate_text"+id+"' value='"+orderDate+"'>";
 document.getElementById("shippedDate_val"+id).innerHTML="<input type='text' id='shippedDate_text"+id+"' value='"+shippedDate+"'>";
 document.getElementById("status_val"+id).innerHTML="<input type='text' id='status_text"+id+"' value='"+status+"'>";
 document.getElementById("comments_val"+id).innerHTML="<input type='text' id='comments_text"+id+"' value='"+comments+"'>";
 
 document.getElementById("edit_button"+id).style.display="none";
 document.getElementById("save_button"+id).style.display="block";
}

function save_row(id)
{
 //var user_id=document.getElementById("user_id_text"+id).innerHTML;
 //var email=document.getElementById("email_text"+id).innerHTML;
 var orderDate=document.getElementById("orderDate_text"+id).value;
 var shippedDate=document.getElementById("shippedDate_text"+id).value;
 var status=document.getElementById("status_text"+id).value;
 var comments=document.getElementById("comments_text"+id).value;
 
 console.log("OD:", orderDate, "SD: ", shippedDate, "Status: ", status, "Comments: ", comments);
	
 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   edit_row:'edit_row',
   row_id:id,
   //user_id_val:user_id,
   //email_val:email,
   orderDate_val:orderDate,
   shippedDate_val:shippedDate,
   status_val:status,
   comments_val:comments
  },
  success:function(response) {
   if(response=="success")
   { 
    //document.getElementById("user_id_val"+id).innerHTML=user_id;
    //document.getElementById("email_val"+id).innerHTML=email;
    document.getElementById("orderDate_val"+id).innerHTML=orderDate;
    document.getElementById("shippedDate_val"+id).innerHTML=shippedDate;
    document.getElementById("status_val"+id).innerHTML=status;
    document.getElementById("comments_val"+id).innerHTML=comments;   
    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("save_button"+id).style.display="none";
   }
   else console.log(response);
  }
 });
}

function delete_row(id)
{
 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   delete_row:'delete_row',
   row_id:id,
  },
  success:function(response) {
   if(response=="success")
   {
    var row=document.getElementById("row"+id);
    row.parentNode.removeChild(row);
   }
  }
 });
}
/*
function insert_row()
{
 var name=document.getElementById("new_name").value;
 var age=document.getElementById("new_age").value;

 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   insert_row:'insert_row',
   name_val:name,
   age_val:age
  },
  success:function(response) {
   if(response!="")
   {
    var id=response;
    var table=document.getElementById("user_table");
    var table_len=(table.rows.length)-1;
    var row = table.insertRow(table_len).outerHTML="<tr id='row"+id+"'><td id='name_val"+id+"'>"+name+"</td><td id='age_val"+id+"'>"+age+"</td><td><input type='button' class='edit_button' id='edit_button"+id+"' value='edit' onclick='edit_row("+id+");'/><input type='button' class='save_button' id='save_button"+id+"' value='save' onclick='save_row("+id+");'/><input type='button' class='delete_button' id='delete_button"+id+"' value='delete' onclick='delete_row("+id+");'/></td></tr>";

    document.getElementById("new_name").value="";
    document.getElementById("new_age").value="";
   }
  }
 });
}
*/