<?php
require_once('connect.php');

if(isset($_POST["result"])){
	$result=$_POST["result"];
}


if(isset($_POST["from"])){
	$from_col = $_POST["from"];
}


if(isset($_POST["to"])){
	$to_col = $_POST["to"];
}

if(!empty($result["rules"][0]["field"])){
if($from_col == $to_col){
	echo "Choose different columns";
} else{
		$rule = json_encode($result);
		$db = Db::getInstance();
		$result = $db->prepare("INSERT INTO rules(from_col,to_col,rule) VALUES (:from_col,:to_col,:rule)");
		$result->execute(array(':from_col' => $from_col, ':to_col' => $to_col,':rule'=>$rule ));
	}

}else{
	echo "Field empty";
}



?>