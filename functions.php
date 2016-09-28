<?php 
	$database = "if16_raily_4";
	
	function signup($email, $password) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUE (?,?)");
		echo $mysqli->error;

		$stmt->bind_param("ss",$email, $password);
		if ($stmt->execute() ) {
			echo "õnnestus";
		}	else { "ERROR".$stmt->error;
		}
		
	}
	
	function login($email, $password) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email, password, created FROM user_sample WHERE email = ?"  );
		echo $mysqli->error;
		//asendan küsimärgi
		$stmt->bind_param("s",$email);
		
		//rea kohta tulba väärtus
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		
		//ainult select puhul
		if($stmt->fetch()){
			//oli olemas,rida käes
			$hash=hash("sha512", $password);
			if($hash==$passwordFromDb) {
				echo "Kasutaja $id logis sisse";
			} else {
				echo "Parool vale";
			}
		} else {
			//ei olnud ühtegi rida
			echo "Sellise emailiga $email kasutajat ei ole olemas";
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	/*function sum($x, $y) {
		
		return $x + $y;
		
	}
	echo sum(12312312,12312355553);
	echo "<br>";

	function hello($n, $p) {
		
		return "Tere tulemast ".$n." ". $p;
		
	}
	echo hello("Raily", "T");
	echo "<br>";
	*/
	
?>