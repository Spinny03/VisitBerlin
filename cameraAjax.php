<?php
	$conn = new mysqli("localhost", "root", "");  
	if ($conn->connect_error){
		exit("Connessione fallita: " . $conn->connect_error);
	}
	$conn->query("USE my_visitberlin");
	if(isset($_POST["link"]) && substr($_POST["link"],strlen("visitberlin.altervista.org/ldi.php?ldi=",),strlen($_POST["link"])!=0)){
		$link = substr($_POST["link"],strlen("visitberlin.altervista.org/ldi.php?ldi=",),strlen($_POST["link"]));
		$query = "SELECT * FROM `ldi` WHERE `id` = '$link'";
		$result = $conn->query($query);
		if($result->num_rows == 1){
			$row = $result->fetch_assoc();
			$id = $row["id"];
			$name = $row["name"];
			$description = $row["description"];
			$image = $row["image"];
			echo '<div class="smallImage" style="background-image: url(assets/berlinPhotosProva/'.$image.');"></div>';
			echo "<a href='ldi.php?ldi=".$id."&scan=1'>".$name."</a>";
		}
		else{
			echo "qr code non valido";
		}	
	}


?>