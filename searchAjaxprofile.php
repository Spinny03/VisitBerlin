<?php
$conn = new mysqli("localhost", "root", "");  
if ($conn->connect_error){
    exit("Connessione fallita: " . $conn->connect_error);
}
$conn->query("USE my_visitberlin");

function Get_user_avatar($id, $connect){
    $query = "SELECT `image` FROM ldi WHERE `id` = '".$id."'";
	$statement = $connect->query($query);
    if($statement->num_rows > 0){
        while($row = $statement->fetch_assoc()){
            if($row['image'] == ''){
                return '<img src="assets/berlinPhotosProva/noImg.png" width="50" class="" />';
            }
            else{
                return '<img src="assets/berlinPhotosProva/'.$row['image'].'" width="50" class="" />';
            }
        }
    }
}

function wrap_tag($argument){
    return '<b>' . $argument . '</b>';
}

if(isset($_POST["query"]))
{
	$search_query = preg_replace('#[^a-z 0-9?!]#i', '', $_POST["query"]);
	$search_array = explode(" ", $search_query);
	$replace_array = array_map('wrap_tag', $search_array);
	$condition = '';

	foreach($search_array as $search)
	{
		if(trim($search) != '')
		{
			$condition .= "`email` LIKE '%".$search."%' OR ";
		}
	}
	$condition = substr($condition, 0, -4);

	$query = "
	SELECT * FROM username 
    WHERE ".$condition."  
    LIMIT 10
	";
	$statement = $conn->query($query);
	$output = '<div class="list-group">';
	if($statement->num_rows > 0)
	{
		while($row = $statement->fetch_assoc()){
			$temp_text = $row["email"];
			$temp_text = str_ireplace($search_array, $replace_array, $temp_text);
			$output .= '
			<a href="#" class="list-group-item"><div style=""> 
				' . $temp_text . '</div> 
			</a>
			';
		}
	}
	else
	{
		$output .= '<a href="#" class="list-group-item">No Result Found</a>';
	}
	$output .= '</div>';

	echo $output;
}


?>