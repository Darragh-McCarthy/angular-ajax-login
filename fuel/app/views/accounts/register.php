<?php 



echo '<div class="register-form">';
if (is_array($errors) || is_object($errors))
{
	foreach ($errors as $val) {
		# code...
		//echo ' #1: '.$val[0];
        //echo ' #2: '.$val[1];
        echo '<p class="alert alert-danger">'.$val[2].'</p>';
	}
}
echo $form.'</div>';
?>

<script>



(function() {
	/*
  var httpRequest;

  function makeRequest(url, callback) {
    if (window.XMLHttpRequest) { // Mozilla, Safari, ...
      httpRequest = new XMLHttpRequest();
    } else if (window.ActiveXObject) { // IE
      try {
        httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
      } 
      catch (e) {
        try {
          httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
        } 
        catch (e) {}
      }
    }

    if (!httpRequest) {
      alert('Giving up :( Cannot create an XMLHTTP instance');
      return false;
    }
    httpRequest.onreadystatechange = function() {
		if (httpRequest.readyState === 4) {
	      if (httpRequest.status === 200) {
	        callback(httpRequest.responseText);
	      } else {
	        alert('There was a problem with the request.');
	      }
	    }
    };
    httpRequest.open('GET', url);
    httpRequest.send();
  }




document.addEventListener('DOMContentLoaded', function() {
	var registerForm = document.getElementById('register-form');
	registerForm.onsubmit = function(e) {
		e.preventDefault();
		makeRequest('/ajaxlogin/testingajax.json', function(data){
			console.log(data);
		});
	}
});
*/


})();
</script>
