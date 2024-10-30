function respacio_showModal(text){
		var modal = document.getElementById("myModal");
		modal.style.display = "block";

		document.getElementById("contentText").innerHTML = text;
		document.getElementById("contentText1").value = text;
	}
	function respacio_hideModal(){
		var modal = document.getElementById("myModal");
		modal.style.display = "none";
	}
	function respacio_copyURL(){

		var str = document.getElementById("contentText").innerHTML ;
		var el = document.createElement('textarea');

		// Set value (string to be copied)
	   el.value = str;
	   // Set non-editable to avoid focus and move outside of view
	   el.setAttribute('readonly', '');
	   el.style = {position: 'absolute', left: '-9999px'};
	   document.body.appendChild(el);
	   // Select text inside element
	   el.select();
	   // Copy text to clipboard
	   document.execCommand('copy');
	   // Remove temporary element
	   document.body.removeChild(el);
	   respacio_hideModal();
	}
	var modal = document.getElementById("myModal");
	window.onclick = function(event) {
	  if (event.target == modal) {
		modal.style.display = "none";
	  }
	}