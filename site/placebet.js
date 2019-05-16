function myFunc() {
    // alert(x);



   
     $(document).ready(function() {
        var matchid = document.getElementById("matchid").value;
        var betteam = document.getElementById("betteam").value;
     	if (betteam === "Home" || betteam === "Away") {
		$.ajax({
        	url: "placebet.php",
                method: "post",
                //data: $('form').serialize(),
		data: { param1: matchid, param2: betteam },
		dataType: "text",
                success: function(strMessage) {
			alert(strMessage);
                }
          })
	} else {
	  alert("Enter 'Home' or 'Away'");
	  }
    })
}
