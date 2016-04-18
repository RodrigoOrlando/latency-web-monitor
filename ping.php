<?php

	$server = "localhost";
    $user="ping";
    $password="pingpassword";  
    $database = "ping";
    //echo "Hola Mundi";
    $conn = new mysqli($server,$user,$password,$database);
    if ($conn->connect_error) {
    	echo "DB Connection failed :(";
    	//die("Connection failed: " . $conn->connect_error);
    }
    else{
		$sql = "SELECT hora, retraso FROM latencia ORDER BY id DESC LIMIT 50";
	    $result = $conn->query($sql);;        
		$dataset = array();
	    while($row = $result->fetch_assoc())
	    {
	        $dataset[] = array(floatval($row['hora']),floatval($row['retraso']));
	    }
	    echo json_encode($dataset);

    }
?>

