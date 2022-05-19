<?php
$conn = new mysqli("localhost", "root", "");  
if ($conn->connect_error){
    exit("Connessione fallita: " . $conn->connect_error);
}
$conn->query("USE Last");

if(isset($_POST["link"]))
{
    /*
	$condition = substr($condition, 0, -4);

	$query = "SELECT * FROM ldi WHERE `id`= ".substr($_POST["link"], 0, -1); ;
	$statement = $conn->query($query);
	if($statement->num_rows > 0){

	}*/

	echo $_POST["link"];
}


?>