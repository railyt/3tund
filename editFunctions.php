<?php
 
 	require_once("../../config.php");
 	
 	function getSinglePerosonData($edit_id){
     
         $database = "if16_raily_4";
 
 		//echo "id on ".$edit_id;
 		
 		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
 		
 		$stmt = $mysqli->prepare("SELECT age, color FROM whistle WHERE id=? AND deleted IS NULL");
 
 		$stmt->bind_param("i", $edit_id);
 		$stmt->bind_result($age, $color);
 		$stmt->execute();
 		
 		//tekitan objekti
 		$p = new Stdclass();
 		
 		//saime �he rea andmeid
 		if($stmt->fetch()){
 			// saan siin alles kasutada bind_result muutujaid
 			$p->age = $age;
 			$p->color = $color;
 			
 			
 		}else{
 			// ei saanud rida andmeid k�tte
 			// sellist id'd ei ole olemas
 			// see rida v�ib olla kustutatud
 			header("Location: data.php");
 			exit();
 		}
		
 		$stmt->close();
 		$mysqli->close();
 		
 		return $p;
 		
 	}
 
 
 	function updatePerson($id, $age, $color){
     	
         $database = "if16_raily_4";
 
 		
 		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
 		
 		$stmt = $mysqli->prepare("UPDATE whistle SET age=?, color=? WHERE id=? AND deleted IS NULL");
 		$stmt->bind_param("isi",$age, $color, $id);
 		
 		// kas �nnestus salvestada
 		if($stmt->execute()){
 			// �nnestus
 			echo "salvestus �nnestus!";
 		}
 		
 		$stmt->close();
 		$mysqli->close();
 		
 	}
 	
	
	
	function deletePerson($id){
     	
        $database = "if16_raily_4";
 
 		
 		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
 		
 		$stmt = $mysqli->prepare("UPDATE whistle SET deleted=NOW()
 		WHERE id=? AND deleted IS NULL");
 		$stmt->bind_param("i",$id);
 		
 		// kas �nnestus salvestada
 		if($stmt->execute()){
 			// �nnestus
 			echo "salvestus �nnestus!";
 		}
 		
 		$stmt->close();
 		$mysqli->close();
 		
 	}
	
 	
 ?>