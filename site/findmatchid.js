function myFunc(x) {
    // alert(x);
    //var idvalue = document.getElementById("idvalue").value;
    
     $(document).ready(function() {
     	$.ajax({
        	url: "findmatchid.php",
                method: "post",
                //data: $('form').serialize(),
		data: { param1: x },
		dataType: "text",
                success: function(strMessage) {
			alert(strMessage);
                }
          })                     
    })   
}
