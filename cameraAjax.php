<?php
	$conn = new mysqli("localhost", "root", "");  
	if ($conn->connect_error){
		exit("Connessione fallita: " . $conn->connect_error);
	}
	$conn->query("USE Last");

	if(isset($_POST["link"]) && substr($_POST["link"],strlen("localhost/Last/ldi.php?ldi=",),strlen($_POST["link"])!=0)){
		$link = substr($_POST["link"],strlen("localhost/Last/ldi.php?ldi=",),strlen($_POST["link"]));
		$query = "SELECT * FROM `ldi` WHERE `id` = '$link'";
		$result = $conn->query($query);
		if($result->num_rows == 1){
			$row = $result->fetch_assoc();
			$id = $row["id"];
			$name = $row["name"];
			$description = $row["description"];
			$image = $row["image"];
			
			echo $name;
		}
		else{
			echo "qr code non valido";
		}	
	}


?>