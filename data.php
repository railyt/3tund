<?php
	//ühendan sessionniga
	require("functions.php");
	
	//kui ei ole sisse loginud, suunan login lehele
	if(!isset($_SESSION["userId"])){
		//header("Location: login.php");
	}
	
	
	//kas aadressireal on logout
	if (isset($_GET["logout"])) {
		SESSION_destroy();
		header("Location: login.php");
	}
	
?>
<h1>Data</h1>

<p>
	Tere tulemast <?=$_SESSION["userEmail"];?>!
	<a href="?logout=1">logi välja< /a>



</p>
</p>